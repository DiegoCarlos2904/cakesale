<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ubicaciones extends CI_Controller {
	public function __construct () {
		parent::__construct();
		if( !in_array( $this->session->userdata('usr_group'), array( '1', '2' )  ) ) {
			$this->session->set_flashdata('log_error','No tiene los accesos necesarios');
			redirect('');
		}
		$this->load->model('model_locations');
	}
	public function index() {
		$data['title'] = 'Ubicaciones';
		$data['list'] = $this->model_locations->get_all();
		$this->load->view('admin/ubicaciones',$data);
	}
	public function delete($usr_id) {
		$this->model_locations->delete($usr_id);
		redirect('admin/ubicaciones');
	}
	
	public function registrar() {
		if ( isset( $_POST ) && count( $_POST ) ) {
			$this->form_validation->set_rules('name','Nombre','required');
			$this->form_validation->set_rules('description','Descripción','required');

			if ($this->form_validation->run() == FALSE) {
				$data['errors'] = validation_errors();
			} else {
	 			$data_post = $this->security->xss_clean($_POST);
				unset( $data_post['is_submitted'] );
				$data_post['stuts'] = 'publish';

				$user_id = $this->model_locations->insert($data_post );
				if( $user_id ) {
					$this->session->set_flashdata('log_success','Se registró la ubicación correctamente.');
					redirect('admin/ubicaciones');
				}
				$data['errors'] = 'Ocurrió un error al registrar los datos de la ubicación';
			}
		}
		$data['ubicacion'] =array();
		$this->load->view('admin/registrar_ubicacion', $data);
	}
	
	public function editar($usr_id) {
		$data['ubicacion'] = $this->model_locations->get_all($usr_id);
		if ( isset( $_POST ) && count( $_POST ) ) {
			$this->form_validation->set_rules('name','Nombre','required');
			$this->form_validation->set_rules('description','Descripción','required');

			if ($this->form_validation->run() == FALSE) {
				$data['errors'] = validation_errors();
			} else {
	 			$data_post = $this->security->xss_clean($_POST);
				unset( $data_post['is_submitted'] );
				$user_id = $this->model_locations->update($data_post, $usr_id );
				if( $user_id ) {
					$this->session->set_flashdata('log_success','Se actualizó la ubicación correctamente.');
					redirect('admin/ubicaciones');
				}
				$data['errors'] = 'Ocurrió un error al actualizar los datos de la ubicación';
			}
		}

		$this->load->view('admin/editar_ubicacion',$data);
	}
}
