<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {
	public function __construct () { //que es lo que carga el function_construct
		parent::__construct();
		if( !in_array( $this->session->userdata('usr_group'), array( '1', '2' )  ) ) {
			$this->session->set_flashdata('log_error','No tiene los accesos necesarios');
			redirect('');
		}
		$this->load->model('model_categories');
	}
	public function index() {
		$data['title'] = 'Categorías';
		$data['list'] = $this->model_categories->get_all();
		$this->load->view('admin/categorias',$data);
	}
	public function delete($usr_id) {
		$this->model_categories->delete($usr_id);
		$this->session->set_flashdata('log_success','Se eliminó la categoría correctamente.');
		redirect('admin/categorias');
	}
	
	public function registrar() {
		if ( isset( $_POST ) && count( $_POST ) ) {
			$this->form_validation->set_rules('name','Nombre','required');

			if ($this->form_validation->run() == FALSE) {
				$data['errors'] = validation_errors();
			} else {
	 			$data_post = $this->security->xss_clean($_POST);
				unset( $data_post['is_submitted'] );
				$data_post['stuts'] = 'publish';
				$data_post['slug'] =  url_title(set_value('name'), 'dash', true);
				if($this->model_categories->exists($data_post['slug']) == FALSE) {
					$user_id = $this->model_categories->insert($data_post );
					if( $user_id ) {
						$this->session->set_flashdata('log_success','Se registró la categoría correctamente.');
						redirect('admin/categorias');
					}
					$data_post['is_submitted'] = 1;
					$data['errors'] = 'Ocurrió un error al registrar la categoría';
				}else{
					$data['errors'] = 'Ya existe una categoría con ese nombre.';
				}
			}
		}
		$data['category'] =array();
		$this->load->view('admin/registrar_categoria', $data);
	}
	
	public function editar($usr_id) {
		$data['category'] = $this->model_categories->get_all($usr_id);
		if ( isset( $_POST ) && count( $_POST ) ) {
			$this->form_validation->set_rules('name','Nombre','required');

			if ($this->form_validation->run() == FALSE) {
				$data['errors'] = validation_errors();
			} else {
	 			$data_post = $this->security->xss_clean($_POST);
				unset( $data_post['is_submitted'] );
				$data_post['slug'] =  url_title(set_value('name'), 'dash', true);
				$user_id = $this->model_categories->update($data_post, $usr_id );
				if( $user_id ) {
					$this->session->set_flashdata('log_success','Se actualizó la categoría correctamente.');
					redirect('admin/categorias');
				} 
				$data['errors'] = 'Ocurrió un error al actualizar la categoría';
			}
		}

		$this->load->view('admin/editar_categoria',$data);
	}
}
