<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_design_products extends CI_Model {
	
	public function all_design_products_admin() {
		$this->db->select('design_products.*, users.full_name');
		$this->db->join('users', 'users.usr_id = design_products.user_id', 'LEFT');
		$show = $this->db->get_where('design_products', array( 'design_products.stuts !='=>'trash' ));
		if($show->num_rows() > 0 ) {
			return $show->result();
		} else {
			return array();
		}
	}
	public function showme($pro_slug) {
		$this->db->select('design_products.*, categories.name as cat_name, categories.slug as cat_slug, SUM(CASE WHEN comments.val != 0 THEN 1 ELSE 0 END) as total_cal, avg(CASE WHEN comments.val != 0 THEN comments.val ELSE null END) as avg_comment');
		$this->db->join('categories', 'categories.cat_id = design_products.cat_id', 'LEFT');
		$this->db->join('comments', 'comments.post_id = design_products.pro_id', 'LEFT');
		$this->db->group_by('design_products.pro_id');
		$query = $this->db->get_where('design_products', array( 'design_products.stuts'=>'publish', 'pro_slug' => $pro_slug));
		return $query->row();
	}
	public function find($pro_id) {
		$code = $this->db->where('pro_id',$pro_id)
						->limit(1)
						->get('design_products');
		if ($code->num_rows() > 0 ) {
			return $code->row();
		}else {
			return array();
		}
	}
	public function findHash($hash) {
		$code = $this->db->where('hash',$hash)
						->limit(1)
						->get('design_products');
		if ($code->num_rows() > 0 ) {
			return $code->row();
		}else {
			return array();
		}
	}
	public function create($data_design_products) {
		$this->db->insert('design_products',$data_design_products);
	}
	public function edit($pro_id,$data_design_products) {
		$this->db->where('pro_id',$pro_id)
				->update('design_products',$data_design_products);
	}
	public function delete($pro_id) {
		if( !empty($pro_id) ) {
			$update = $this->db->update('design_products', array( 'stuts'=>'trash' ), array( 'pro_id' =>$pro_id));
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
		->get('design_products');
		if($gry->num_rows()	> 0) {// numero de filas, a retornado una fila 
			return TRUE;	
		}else{
			return FALSE;
		}
	}
	public function report($report_design_products) {
		$this->db->insert('reports',$report_design_products);
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