<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notfound extends CI_Controller {
	public function index() {
		$data['title'] = 'Página no encontrada';
		$data['hide_slider'] = true;
		$this->load->view('404', $data);
	}
}
