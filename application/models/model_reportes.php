<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_reportes extends CI_Model {

	public function get_reportes( ) {
		$show = $this->db->get_where('reportes', array('status !='=>'trash'));
		if($show->num_rows() > 0 ) {
			return $show->result();
		} else {
			return array();
		}
	}
	
	public function delete($id) {
		if( !empty($id) ) {
			$update = $this->db->update('reportes', array( 'status'=>'trash' ), array( 'id' =>$id));
			if( $update ){
				return true;
			} else{
				return $this->db->_error_message(); 
			}
		} else {
			return false;
		}
	}
	public function insert($data = array()) {
		$insert = $this->db->insert('reportes', $data);
		if($insert){
			return $this->db->insert_id();
		} else{
			return false;
		}
	}

	public function update($data, $id) {
		if(!empty($data) && !empty($id)){
			$update = $this->db->update('reportes', $data, array( 'id' =>$id));
			return $update ? true : false;
		}else{
			return false;
		}
	}
}
?>