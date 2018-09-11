<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuenta extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('model_users');
		$this->load->library('form_validation');
	}
	function sendMail() {
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'nicanor.quisp@gmail.com', // change it to yours
			'smtp_pass' => 'Consultora1', // change it to yours
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE
		);

		$message = '';
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('nico@ebp.pe'); // change it to yours
		$this->email->to('nico@ebp.pe');// change it to yours
		$this->email->subject('Resume from JobsBuddy for your Job posting');
		$this->email->message($message);
		if($this->email->send()) {
			echo 'Email sent.';
		}
		else {
			show_error($this->email->print_debugger());
		}
	}
	public function index() {
		if( !$this->isLoggedin() ) { 
			redirect('login');
		}
		$usr_id = $this->session->userdata['usr_id'];
		$data = array();
		$data['title'] = 'Cuenta';

		if ( isset( $_POST ) && count( $_POST ) ) {
			$this->form_validation->set_rules('usr_name','Correo','required');
			$this->form_validation->set_rules('telephone','Telefono','required|integer');
			$this->form_validation->set_rules('first_name','Nombres','required');
			$this->form_validation->set_rules('last_name','Apellidos','required');
			$this->form_validation->set_rules('direccion','Dirección','required');

			if ($this->form_validation->run() == FALSE) {
				$data['errors'] = validation_errors();
			} else {
	 			$data_post = $this->security->xss_clean($_POST);
	 			if ( !$this->model_users->exist( $data_post['usr_name'], $usr_id ) ) {
					unset( $data_post['is_submitted'] );
					if ( isset( $data_post['usr_password'] ) ) {
						$data_post['usr_password'] = sha1(md5($data_post['usr_password']));
					} else {
						unset( $data_post['usr_password'] );
					}
					$data_post['full_name'] = $data_post['first_name'] . ' ' . $data_post['last_name'];
					if( $this->model_users->update($data_post, $usr_id ) ) {
						$user = $this->model_users->get_users( $usr_id);
						$this->session->set_userdata( (array) $user);
						$this->session->set_flashdata('log_success','Se actualizó la cuenta correctamente.');
					} else {
						$data['errors'] = 'Ocurrió un error al actualizar los datos del usuario.';
					}
	 			} else {
					$data['errors'] = 'Ya existe una cuenta con el correo.';
	 			}
			}
		}

		$data['user'] = $this->model_users->get_users($usr_id);

		$data['hide_slider'] = true;
		$this->load->view('cuenta',$data);
	}
	public function pedidos() {
		if( !$this->isLoggedin() ) { 
			redirect('login');
		}
		$this->load->model('model_orders');
		$usr_id = $this->session->userdata['usr_id'];
		$data = array();
		$data['invoices'] = $this->model_orders->all_invoices_by_user( $usr_id );
		$data['title'] = 'Mis Pedidos';
		$data['hide_slider'] = true;
		$this->load->view('pedidos',$data);
	}
	public function pedidos_detalle( $invoice_id ) {
		if( !$this->isLoggedin() ) { 
			redirect('login');
		}
		$this->load->model('model_orders');
		$usr_id = $this->session->userdata['usr_id'];

		$data['invoice'] = $this->model_orders->get_invoice_by_id( $invoice_id );
		if ( $data['invoice']->usr_id == $usr_id ) {
			$data['orders']	= $this->model_orders->get_orders_by_invoice($invoice_id);
			$data['invoice'] = $this->model_orders->get_invoice_by_id($invoice_id);
		} else {

		}
		$data['title'] = 'Detalle del pedido';
		$data['hide_slider'] = true;
		$this->load->view('pedido_detalle',$data);
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
				$data_post = $this->security->xss_clean($_POST);
				$user = $this->model_users->check_usr($data_post);
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
