<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facturas extends CI_Controller {
	public function __construct () {
		parent::__construct();
		if( !in_array( $this->session->userdata('usr_group'), array( '1', '2' )  ) ) {
			$this->session->set_flashdata('error','No tiene los accesos necesarios');
			redirect('');
		}
	}
	public function index() {
		$data['title'] = 'Facturas';
		$this->load->view('admin/facturas',$data);
	}
}
