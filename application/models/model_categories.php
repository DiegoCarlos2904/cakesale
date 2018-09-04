<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_categories extends CI_Model {

	public function get_all( $cat_id = '' ) {
		if ( $cat_id ) {
			$show = $this->db->get_where('categories', array('stuts' => 'publish', 'cat_id' => $cat_id));
			return $show->row();
		} else {
			$show = $this->db->get_where('categories', array('stuts' => 'publish'));
		}
		if($show->num_rows() > 0 ) {
			return $show->result();
		} else {
			return array();
		}
	}

	public function exists( $slug ) {
		$gry = $this->db->where('slug',$slug)
		->limit(1)
		->get('categories');
		if($gry->num_rows()	> 0) {
			return TRUE;	
		}else{
			return FALSE;
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
	
	public function insert($data = array()) {
		$insert = $this->db->insert('categories', $data);
		if($insert){
			return $this->db->insert_id();
		} else{
			return false;
		}
	}
	public function update($data, $id) {
		if(!empty($data) && !empty($id)){
			$update = $this->db->update('categories', $data, array( 'cat_id' =>$id));
			if($update){
				return true;
			}else{
				return $this->db->_error_message(); 
			}
		}else{
			return false;
		}
	}
	
	public function delete($cat_id) {
		if( !empty($cat_id) ) {
			$update = $this->db->update('categories', array( 'stuts'=>'trash' ), array( 'cat_id' =>$cat_id));
			if( $update ){
				return true;
			} else{
				return $this->db->_error_message(); 
			}
		} else {
			return false;
		}
	}

		
} 
