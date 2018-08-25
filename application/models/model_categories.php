<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_categories extends CI_Model {

	public function get_all( $cat_id = '' ) {
		if ( $cat_id ) {
			$show = $this->db->get_where('categories', array('cat_id' => $cat_id));
		} else {
			$show = $this->db->get('categories');
		}
		if($show->num_rows() > 0 ) {
			return $show->result();
		} else {
			return array();
		}
	}
		
	public function findBySlug($slug) {
		$code = $this->db->where('slug',$slug)
			->limit(1)
			->get('categories');
		if ($code->num_rows() > 0 ) {
			return $code->row();
		} else {
			return array();
		}
	}
	
	public function create($data_products) {
		$this->db->insert('categories',$data_products);
	}
	
	public function edit($cat_id,$data_products) {
		$this->db->where('cat_id',$cat_id)
				->update('categories',$data_products);
	}
	
	public function delete($cat_id) {
		$this->db->where('cat_id',$cat_id)
				->delete('categories');
	}
		
} 
