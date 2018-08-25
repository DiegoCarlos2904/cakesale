<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facturas extends CI_Controller {
	public function __construct () {
		parent::__construct();
		if($this->session->userdata('usr_group')!=	('1' ||'2') ) {
			$this->session->set_flashdata('error','Sorry You Are Not Logged in !');
			redirect('login');	
		}
	}
	public function index() {
		$data['title'] = 'Facturas';
		$this->load->view('admin/facturas',$data);
	}
}
