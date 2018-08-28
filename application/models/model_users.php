<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_users extends CI_Model {
		
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
		