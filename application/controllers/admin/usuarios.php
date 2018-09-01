<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	public function __construct () {
		parent::__construct();
		if( !in_array( $this->session->userdata('usr_group'), array( '1', '2' )  ) ) {
			$this->session->set_flashdata('error','No tiene los accesos necesarios');
			redirect('');
		}
		$this->load->model('model_users');
	}
	public function index() {
		$data['title'] = 'Usuarios';
		$data['list'] = $this->model_users->get_users();
		$this->load->view('admin/usuarios',$data);
	}
	public function delete($pro_id) {
		$this->model_products->delete($pro_id);
		redirect('admin/productos');
	}
	
	public function registrar() {
		if ( isset( $_POST ) && count( $_POST ) ) {
			$this->form_validation->set_rules('usr_name','Correo','required');
			$this->form_validation->set_rules('telephone','Telefono','required|integer');
			$this->form_validation->set_rules('first_name','Nombres','required');
			$this->form_validation->set_rules('last_name','Apellidos','required');
			$this->form_validation->set_rules('direccion','Dirección','required');
			$this->form_validation->set_rules('usr_password','Contraseña','required');

			if ($this->form_validation->run() == FALSE) {
				$data['errors'] = validation_errors();
			} else {
	 			$data_user = $this->security->xss_clean($_POST);
				unset( $data_user['is_submitted'] );
				$data_user['stuts'] = '1';
				$data_user['usr_password'] = sha1(md5($data_user['usr_password']));
				$data_user['full_name'] = $data_user['first_name'] . ' ' . $data_user['last_name'];

				if($this->model_users->exists_email($data_user['usr_name']) == FALSE) {
					$user_id = $this->model_users->insert($data_user );
					if( $user_id ) {
						$this->session->set_flashdata('log_success','Se registró la cuenta correctamente.');
						redirect('admin/usuarios');
					}
					$data_user['is_submitted'] = 1;
					$data['errors'] = 'Ocurrió un error al registrar los datos del usuario';
				}else{
					$data['errors'] = 'Ya existe un usuario con ese correo.';
				}
			}
		}
		$data['user'] =array();
		$this->load->view('admin/registrar_usuario', $data);
	}
	
	public function editar($usr_id) {
		$data['user'] = $this->model_users->get_users($usr_id);
		if ( isset( $_POST ) && count( $_POST ) ) {
			$this->form_validation->set_rules('usr_name','Correo','required');
			$this->form_validation->set_rules('telephone','Telefono','required|integer');
			$this->form_validation->set_rules('first_name','Nombres','required');
			$this->form_validation->set_rules('last_name','Apellidos','required');
			$this->form_validation->set_rules('direccion','Dirección','required');

			if ($this->form_validation->run() == FALSE) {
				$data['errors'] = validation_errors();
			} else {
	 			$data_user = $this->security->xss_clean($_POST);
				unset( $data_user['is_submitted'] );
				if ( isset( $data_user['usr_password'] ) ) {
					$data_user['usr_password'] = sha1(md5($data_user['usr_password']));
				} else {
					unset( $data_user['usr_password'] );
				}
				$data_user['full_name'] = $data_user['first_name'] . ' ' . $data_user['last_name'];
				$user_id = $this->model_users->update($data_user, $usr_id );
				if( $user_id ) {
					$this->session->set_flashdata('log_success','Se actualizó la cuenta correctamente.');
					redirect('admin/usuarios');
				}
				$data_user['is_submitted'] = 1;
				$data['errors'] = 'Ocurrió un error al actualizar los datos del usuario';
			}
		}

		$this->load->view('admin/editar_usuario',$data);
	}
}
