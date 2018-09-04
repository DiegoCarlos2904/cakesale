<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('usr_name')) {
			redirect('login');
		}
		$this->load->model('model_orders');
		$this->load->model('model_users');
	}
	public function index() {
		$is_processed = $this->model_orders->process();
		if($is_processed) {
			$this->cart->destroy();
			redirect('order/success');
		}else{
			$this->session->set_flashdata('log_error','Failed To Processed Your Order ! , please try again');
			redirect('tienda/carrito');
		}
	}
	public function success() {
		$data['title'] = 'Pagar';
		$this->load->view('order_success',$data);
	}
}