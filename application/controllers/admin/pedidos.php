<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos extends CI_Controller {
	public function __construct () {
		parent::__construct();
		if( !in_array( $this->session->userdata('usr_group'), array( '1', '2' )  ) ) {
			$this->session->set_flashdata('log_error','No tiene los accesos necesarios');
			redirect('');
		}
		$this->load->model('model_orders');
	}
	public function index() {
		$data['title'] = 'Pedidos';
		$data['invoices'] = $this->model_orders->all_invoices();
		$this->load->view('admin/pedidos',$data);
	}
	
	public function detalle($invoice_id) {
		$data['orders']	= $this->model_orders->get_orders_by_invoice($invoice_id);
		$data['invoice'] = $this->model_orders->get_invoice_by_id($invoice_id);
		$this->load->view('admin/pedido_detalle',$data);
	}
}
