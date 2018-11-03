<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_locations extends CI_Model {

	public function get_all( $id = '' ) {
		if ( $id ) {
			$show = $this->db->get_where('locations', array('stuts' => 'publish', 'id' => $id));
			return $show->row();
		} else {
			$show = $this->db->get_where('locations', array('stuts' => 'publish'));
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
		->get('locations');
		if($gry->num_rows()	> 0) {
			return TRUE;	
		}else{
			return FALSE;
		}
	}
		
	public function findBySlug($slug) {
		$code = $this->db->where('slug',$slug)
			->limit(1)
			->get('locations');
		if ($code->num_rows() > 0 ) {
			return $code->row();
		} else {
			return array();
		}
	}
	
	public function insert($data = array()) {
		$insert = $this->db->insert('locations', $data);
		if($insert){
			return $this->db->insert_id();
		} else{
			return false;
		}
	}
	public function update($data, $id) {
		if(!empty($data) && !empty($id)){
			$update = $this->db->update('locations', $data, array( 'id' =>$id));
			if($update){
				return true;
			}else{
				return $this->db->_error_message(); 
			}
		}else{
			return false;
		}
	}
	
	public function delete($id) {
		if( !empty($id) ) {
			$update = $this->db->update('locations', array( 'stuts'=>'trash' ), array( 'id' =>$id));
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
