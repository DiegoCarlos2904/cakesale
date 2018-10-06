<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_products extends CI_Model {
	
	public function all_products( $cat_id = '' ) {
		if ( $cat_id ) {
			$this->db->select('products.*, categories.name as cat_name, categories.slug as cat_slug');
			$this->db->join('categories', 'categories.cat_id = products.cat_id', 'LEFT');
			$show = $this->db->get_where('products', array('products.stuts'=>'publish', 'products.cat_id' => $cat_id));
		} else {
			$this->db->select('products.*, categories.name as cat_name, categories.slug as cat_slug');
			$this->db->join('categories', 'categories.cat_id = products.cat_id', 'LEFT');
			$show = $this->db->get_where('products', array( 'products.stuts'=>'publish' ));
		}
		if($show->num_rows() > 0 ) {
			return $show->result();
		} else {
			return array();
		}
	}
	
	public function showme($pro_slug) {
		$this->db->select('products.*, categories.name as cat_name, categories.slug as cat_slug');
		$this->db->join('categories', 'categories.cat_id = products.cat_id', 'LEFT');
		$query = $this->db->get_where('products', array( 'products.stuts'=>'publish', 'pro_slug' => $pro_slug));
		return $query->row();
	}
	
	public function find($pro_id) {
		$code = $this->db->where('pro_id',$pro_id)
						->limit(1)
						->get('products');
		if ($code->num_rows() > 0 ) {
			return $code->row();
		}else {
			return array();
		}
			
	}
	
	public function create($data_products) {
		
		$this->db->insert('products',$data_products);
			
	}
	
	public function edit($pro_id,$data_products) {
		
		$this->db->where('pro_id',$pro_id)
				->update('products',$data_products);
	}
	
	public function delete($pro_id) {
		if( !empty($pro_id) ) {
			$update = $this->db->update('products', array( 'stuts'=>'trash' ), array( 'pro_id' =>$pro_id));
			if( $update ){
				return true;
			} else{
				return false; 
			}
		} else {
			return false;
		}
	}
	public function exists( $slug ) {
		$gry = $this->db->where('pro_slug',$slug)
		->limit(1)// retoma al primer  produucto
		->get('products');
		if($gry->num_rows()	> 0) {// numero de filas, a retornado una fila 
			return TRUE;	
		}else{
			return FALSE;
		}
	}
	public function report($report_products) {
		
		$this->db->insert('reports',$report_products);
		
	}
	
	public function reports() {
		$report = $this->db->get('reports');
		if($report->num_rows() > 0 ) {
			return $report->result();
		} else {
			return array();
		} 
		
	}
	
	public function del_report($rep_id_product) {
		$this->db->where('rep_id_product',$rep_id_product)
		->delete('reports');
	}
	
}