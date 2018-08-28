<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	
	public function __construct () {
		parent::__construct();
		$this->load->model('model_users');
	}
		
	public function index() {
		
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

		$this->load->view('register/form_register',$data); 
	}
}