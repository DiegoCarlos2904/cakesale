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
	public function carrito( ) {
		$data['title'] = 'Carrito';
		$data['hide_slider'] = true;
		$this->load->view('carrito',$data);
	}
	public function ver($pro_slug) {
		$data['product'] = $this->model_products->showme($pro_slug);
		$data['title'] = 'Tienda';
		$this->load->view('producto',$data);
	}
	public function clear_cart() {
		$this->cart->destroy();
		redirect(base_url());
	}
	public function add_to_cart($pro_slug,$send = '') {
		$this->load->library('cart');
		$product = $this->model_products->showme($pro_slug);


	 	$data_post = $this->security->xss_clean($_POST);
		$data = array(
			'id'      => $product->pro_id,
			'qty'     => 1,
			'price'   => $product->pro_price,
			'name'	  => $product->pro_title,
	        'options' => array( 
	        	'porciones' => $data_post['porciones'],
	        	'mensaje' => $data_post['mensaje'],
	        	'especificaciones' => $data_post['especificaciones'],
	        )
		);
		$this->cart->insert($data);

		$this->session->set_flashdata('log_success','Se agregó el producto al carrito correctamente.');
		if ( $send == 'add' ) {
			redirect('tienda/ver/'.$product->pro_slug);
		} else{
			redirect( base_url() );
		}
	}
}
