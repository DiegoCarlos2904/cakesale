<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notfound extends CI_Controller {
	public function __construct () {
		parent::__construct();
	}
	public function index() {
		$data['title'] = 'Página no encontrada';
		$this->load->view('admin/404',$data);
	}
}
