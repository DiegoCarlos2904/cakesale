<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda extends CI_Controller {
	public function __construct () {
		parent::__construct();
		if( !in_array( $this->session->userdata('usr_group'), array( '1', '2' )  ) ) {
			$this->session->set_flashdata('log_error','No tiene los accesos necesarios');
			redirect('');
		}
	}
	public function index() {
		redirect('admin/productos');	
		$data['title'] = 'Dashboard';
		$this->load->view('admin/tienda',$data);
	}
}
