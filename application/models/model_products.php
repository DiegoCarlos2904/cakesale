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
	public function all_products_admin( $cat_id = '' ) {
		if ( $cat_id ) {
			$this->db->select('products.*, categories.name as cat_name, categories.slug as cat_slug');
			$this->db->join('categories', 'categories.cat_id = products.cat_id', 'LEFT');
			$show = $this->db->get_where('products', array('products.stuts !='=>'trash', 'products.cat_id' => $cat_id));
		} else {
			$this->db->select('products.*, categories.name as cat_name, categories.slug as cat_slug');
			$this->db->join('categories', 'categories.cat_id = products.cat_id', 'LEFT');
			$show = $this->db->get_where('products', array( 'products.stuts !='=>'trash' ));
		}
		if($show->num_rows() > 0 ) {
			return $show->result();
		} else {
			return array();
		}
	}
	
	public function search( $texto = '' ) {
		$this->db->select('products.*, categories.name as cat_name, categories.slug as cat_slug');
		$this->db->join('categories', 'categories.cat_id = products.cat_id', 'LEFT');
		$this->db->group_start();
		$this->db->like('pro_title', $texto);
		$this->db->or_like('pro_description', $texto);
		$this->db->group_end();
		$show = $this->db->get_where('products', array( 'products.stuts'=>'publish' ));
		if($show->num_rows() > 0 ) {
			return $show->result();
		} else {
			return array();
		}
	}
	
	public function showme($pro_slug) {
		$this->db->select('products.*, categories.name as cat_name, categories.slug as cat_slug, SUM(CASE WHEN comments.val != 0 && comments.status = \'publish\' THEN 1 ELSE 0 END) as total_cal, avg(CASE WHEN comments.val != 0 && comments.status = \'publish\' THEN comments.val ELSE null END) as avg_comment');
		$this->db->join('categories', 'categories.cat_id = products.cat_id', 'LEFT');
		$this->db->join('comments', 'comments.post_id = products.pro_id', 'LEFT');
		$this->db->group_by('products.pro_id');
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
		$insert = $this->db->insert('products',$data_products);
		if($insert){
			return $this->db->insert_id();
		} else{
			return false;
		}
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
	
	function exist($slug = "", $id = ""){
		if(!empty($slug)){
			$query = $this->db->get_where( 'products', array( 'products.pro_slug' => $slug, 'pro_id !=' => $id ));
			return $query->row_array();
		}else{
			return array();
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