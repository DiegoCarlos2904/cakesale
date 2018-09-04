<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_users extends CI_Model {

	public function get_users( $user_id = '' ) {
		if ( $user_id ) {
			$show = $this->db->get_where('users', array('usr_id' => $user_id, 'stuts'=>'publish'));
			return $show->row();
		} else {
			$show = $this->db->get_where('users', array('stuts'=>'publish'));
		}
		if($show->num_rows() > 0 ) {
			return $show->result();
		} else {
			return array();
		}
	}
		
	public function check_usr() {
		$username = set_value('username');	
		$password = set_value('password');	
		$stuts = '1';
		$st=$this->db->SELECT('*')->from('users')
			->WHERE('usr_name',$username)
			->WHERE('usr_password',sha1(md5($password)))
			->where('stuts',$stuts)
			->get()->result_array();
		if(count($st)>0) {
			return $st[0];	
		}else{
			return false;
		}
	}
	
	public function register_new($data_register_new) {
		$this->db->insert('users',$data_register_new);		
	}
	public function delete($usr_id) {
		if( !empty($usr_id) ) {
			$update = $this->db->update('users', array( 'stuts'=>'trash' ), array( 'usr_id' =>$usr_id));
			if( $update ){
				return true;
			} else{
				return $this->db->_error_message(); 
			}
		} else {
			return false;
		}
	}
	public function is_usr() {
		$username = set_value('rusername');	
		$gry = $this->db->where('usr_name',$username)
		->limit(1)
		->get('users');
		if($gry->num_rows()	> 0) {
			return TRUE;	
		}else{
			return FALSE;
		}
	}
	public function exists_email( $username ) {
		$gry = $this->db->where('usr_name',$username)
		->limit(1)
		->get('users');
		if($gry->num_rows()	> 0) {
			return TRUE;	
		}else{
			return FALSE;
		}
	}

	public function insert($data = array()) {
		$insert = $this->db->insert('users', $data);
		if($insert){
			return $this->db->insert_id();
		} else{
			return false;
		}
	}

	public function update($data, $id) {
		if(!empty($data) && !empty($id)){
			$update = $this->db->update('users', $data, array( 'usr_id' =>$id));
			if($update){
				return true;
			}else{
				return $this->db->_error_message(); 
			}
		}else{
			return false;
		}
	}
	
	public function check() {
		$username = set_value('rusername');	
		$password = set_value('rpassword');	
		$stuts = '1';
		$gry = $this->db->where('usr_name',$username)
		->where('usr_password',$password)
		->where('stuts',$stuts)
		->limit(1)
		->get('users');
		if($gry->num_rows()	>	0) {
			return $gry->row();	
			}else{
			return array();
		}
		
	}
}
?>
		