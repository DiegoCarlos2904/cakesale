<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_orders extends CI_Model {
	public function get_user_id_by_session() {
		$usr_name = $this->session->userdata('username');
		$gry = $this->db->where('usr_name',$usr_name)
				->select('usr_id')
				->limit(1)
				->get('users');
		if( $gry->num_rows() > 0 ) {
			return $gry->row()->usr_id;
		} else {
			return 0;
		}	
	}
	
	public function process() {
		$invoice = array(
				'data'		=>	date('Y-m-d H:i:s'),
				'due_date'	=>	date('Y-m-d H:i:s',mktime(date('H'),date('i'),date('s'),date('m'),date('d') + 1,date('Y'))),
				'user_id'	=> $this->get_user_id_by_session(),
				'user_id'	=> $this->get_user_id_by_session(),
				'total'	=>	$this->cart->total()
		);
		$this->db->insert('invoices',$invoice);
		$invoice_id = $this->db->insert_id();
		foreach ($this->cart->contents() as $item) {
			$data = array(
				'invoice_id'		=> $invoice_id,
				'product_id'		=> $item['id'],
				'product_title'		=> $item['name'],
				'qty'				=> $item['qty'],
				'price'				=> $item['price'],
				'options'				=> serialize( $item['options'] )
			 );
			$this->db->insert('orders',$data);
		}
		
		return TRUE;
	}
	public function all_invoices() {
		$get_orders = $this->db->get('invoices');
		if($get_orders->num_rows() > 0 ) {
			return $get_orders->result();
		} else {
			 return array();
		}
	}
	public function get_invoice_by_id($invoice_id) {
		$get_invoice_by = $this->db->where('id',$invoice_id)->limit(1)->get('invoices');
		if( $get_invoice_by->num_rows() > 0 ) {
			return $get_invoice_by->result();
		} else {
			return FALSE;
		}
	}
	public function get_orders_by_invoice($invoice_id) {
		$get_orders_by = $this->db->where('invoice_id',$invoice_id)->get('orders');
		if($get_orders_by->num_rows() > 0 ) {
			return $get_orders_by->result();
		} else {
			return FALSE;
		}
	}
}