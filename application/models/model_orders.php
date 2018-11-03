<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_orders extends CI_Model {
	public function get_user_id_by_session() {
		$usr_name = $this->session->userdata('usr_name');
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

	public function find_product($pro_id) {
		$code = $this->db->where('pro_id',$pro_id)
						->limit(1)
						->get('products');
		if ($code->num_rows() > 0 ) {
			return $code->row();
		}else {
			return array();
		}
	}

	public function process() {
		$invoice = array(
				'data'		=>	date('Y-m-d H:i:s'),
				'due_date'	=>	date('Y-m-d H:i:s',mktime(date('H'),date('i'),date('s'),date('m'),date('d') + 1,date('Y'))),
				'usr_id'	=> $this->session->userdata['usr_id'],
				'status'	=> 'paid',
				'total'	=>	$this->cart->total()
		);
		$this->db->insert('invoices',$invoice);
		$invoice_id = $this->db->insert_id();
		$update_products_qty = [];
		foreach ($this->cart->contents() as $item) {
			$data = array(
				'invoice_id'		=> $invoice_id,
				'product_id'		=> $item['id'],
				'product_title'		=> $item['name'],
				'qty'				=> $item['qty'],
				'price'				=> $item['price'],
				'options'				=> serialize( $item['options'] )
			 );
			if ( isset( $update_products_qty[$item['id']] ) && $update_products_qty[$item['id']] ) {
				$update_products_qty[$item['id']]['qty'] += $item['qty'];
			} else {
				$update_products_qty[$item['id']] = array(
					'product_id'		=> $item['id'],
					'qty'		=> $item['qty'],
				);
			}
			$this->db->insert('orders',$data);
		}
		foreach ( $update_products_qty as $key => $product_qty ) {
			$product = $this->find_product( $product_qty['product_id'] );
			if ( $product ) {
				$pro_stock = $product->pro_stock - $product_qty['qty'];
				$this->db->where('pro_id', $product_qty['product_id'])
				->update('products', array( 'pro_stock' => $pro_stock ) );
			}
		}
		return $invoice_id;
	}
	public function all_invoices() {
		$this->db->select('invoices.*, users.full_name as usuario');
		$this->db->join('users', 'users.usr_id = invoices.usr_id', 'LEFT');
		$get_orders = $this->db->get('invoices');
		if($get_orders->num_rows() > 0 ) {
			return $get_orders->result();
		} else {
			 return array();
		}
	}
	public function all_invoices_by_user( $usr_id ) {
		$get_orders = $this->db->get_where( 'invoices', array( 'usr_id' => $usr_id ) );
		if($get_orders->num_rows() > 0 ) {
			return $get_orders->result();
		} else {
			 return array();
		}
	}
	public function get_invoice_by_id($invoice_id) {
		$get_invoice_by = $this->db->where('id',$invoice_id)->limit(1)->get('invoices');
		if( $get_invoice_by->num_rows() > 0 ) {
			return $get_invoice_by->row();
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
	public function get_productos_reporte($from, $to) {
		$this->db->select('product_title as nombre, count( orders.id ) as count, SUM( price * qty ) as total, SUM( qty ) as qty');
		$this->db->where('dateCreate >=', $from.' 00:00:00');
		$this->db->where('dateCreate <=', $to.' 23:59:59' );
		$this->db->where('stuts', 'publish' );
		$this->db->group_by('product_id');
		$list = $this->db->get('orders');
		return $list->result_array();
	}
	public function get_categorias_reporte($from, $to) {
		$this->db->select('categories.*, categories.name as nombre, count( orders.id ) as count, SUM( price * qty ) as total, SUM( qty ) as qty');
		$this->db->join('products', 'products.pro_id = orders.product_id', 'LEFT');
		$this->db->join('categories', 'categories.cat_id = products.cat_id', 'LEFT');
		$this->db->where('dateCreate >=', $from.' 00:00:00');
		$this->db->where('dateCreate <=', $to.' 23:59:59' );
		$this->db->where('orders.stuts', 'publish' );
		$this->db->where('categories.name !=', '' );
		$this->db->group_by('categories.cat_id');
		$list = $this->db->get('orders');
		return $list->result_array();
	}
	public function get_cliente_reporte($from, $to) {
		$this->db->select('users.full_name as nombre, count( invoices.id ) as count, SUM( total ) as total');
		$this->db->join('users', 'users.usr_id = invoices.usr_id', 'LEFT');
		$this->db->where('due_date >=', $from.' 00:00:00');
		$this->db->where('due_date <=', $to.' 23:59:59' );
		$this->db->where('invoices.status', 'paid' );
		$this->db->group_by('invoices.usr_id');
		$list = $this->db->get('invoices');
		return $list->result_array();
	}
}