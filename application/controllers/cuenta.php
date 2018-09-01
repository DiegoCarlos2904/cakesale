<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuenta extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('model_users');
		$this->load->library('form_validation');
	}
	public function index() {
	}

	public function login() {
		if( $this->isLoggedin() ) { 
			redirect( base_url().'admin');
		}
		$data['hide_slider'] = true;
		$data['title'] = '';
		if ( isset( $_POST ) && count( $_POST ) ) {
			$config = array(
				array(
					'field' => 'username',
					'label' => 'Correo',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'password',
					'label' => 'Contraseña',
					'rules' => 'trim|required'
				)
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == false) {
				$data['errors'] = validation_errors();
			} else {
				$data_user = $this->security->xss_clean($_POST);
				$user = $this->model_users->check_usr($data_user);
				if ($user) {
					$this->session->set_userdata($user);
					$this->session->set_flashdata('log_success','Sesión iniciada correctamente');
					redirect(base_url() . 'admin');
				} else {
					$data['errors'] = 'Las credenciales ingresadas no son válidas.';
				}
			}
		}
		$this->load->view('login',$data);
	}

	public function register() {
		
		$data['hide_slider'] = true;
		$data['title'] = '';
		
		if ( isset( $_POST ) && count( $_POST ) ) {
			$this->form_validation->set_rules('rusername','Correo','required');
			$this->form_validation->set_rules('rpassword','Contraseña','required|alpha_numeric|matches[repassword]');
			$this->form_validation->set_rules('repassword','Repetir contraseña','required|alpha_numeric');
			if ($this->form_validation->run() == false) {
				$data['errors'] = validation_errors();
			} else {
				$data_register_new = array (
					'usr_name'			=> set_value('rusername'),
					'usr_password'		=> sha1(md5( set_value('rpassword') ) ),
					'stuts'				=> '1',
					'usr_group'				=>'3'
				);
				if($this->model_users->is_usr() == FALSE) {
					$this->model_users->register_new($data_register_new);
					redirect(base_url().'login');
				}else{
					$data['errors'] = 'Ya existe un usuario con ese correo.';
				}
			}
		}

		$this->load->view('register',$data); 
	}
	public function logout() {
		$this->session->sess_destroy();
		redirect('login');
	}
	public function isLoggedin() {
		if(!empty($this->session->userdata['usr_id'])) {
			return true;
		}
		else {
			return false;
		}
	}
}
