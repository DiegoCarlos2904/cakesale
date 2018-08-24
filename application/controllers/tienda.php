<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda extends CI_Controller {
		
	public function __construct () {
		parent::__construct();
		$this->load->model('model_products');
	}
	public function index() {
		$data['title'] = 'Tienda';
		$data['products'] = $this->model_products->all_products();
		$this->load->view('home',$data);
	}
	public function cart( $cuenta ) {
		$data['title'] = 'Carrito';
		$this->load->view('show_cart',$data);
	}
	public function ver($pro_slug) {
		$data['comes'] = $this->model_products->showme($pro_slug);
		$data['title'] = 'Tienda';
		$this->load->view('this_products',$data);
	}
	public function clear_cart() {
		$this->cart->destroy();
		redirect(base_url());
	}
	public function add_to_cart($pro_id,$send = '') {
		$this->load->library('cart');
		$product = $this->model_products->find($pro_id);
		$data = array(
			'id'      => $product->pro_id,
			'qty'     => 1,
			'price'   => $product->pro_price,
			'name'	  => $product->pro_title
		);
		$this->cart->insert($data);
		if ( $send == 'add' ) {
			redirect('tienda/'.$product->pro_slug);
		} else{
			redirect( base_url() );
		}
	}
}
