<?php

class Model_comments extends CI_Model
{
	function add_comment($data) {
		$this->db->insert('comments',$data);
		return $this->db->insert_id();
	}
	
	function get_comment($post_id) {
		$this->db->select('comments.*,users.usr_name,users.full_name');
		$this->db->from('comments');
		$this->db->join('users','users.usr_id = comments.user_id', 'left');
		$this->db->where('post_id',$post_id);
		$this->db->where('comments.status','publish');
		$this->db->order_by('date_added','asc');
		$query = $this->db->get();
		return $query->result_array();
	}
	function get_reporte() {
		$this->db->select('products.pro_title, avg( comments.val ) as avg_comment, sum( comments.val ) as total, count( comments.comment_id ) as count');
		$this->db->join('products', 'products.pro_id = comments.post_id', 'LEFT');
		$this->db->from('comments');
		$this->db->join('users','users.usr_id = comments.user_id', 'left');
		$this->db->where('comments.status','publish');
		$this->db->where('comments.val != ', 0 );
		$this->db->order_by('date_added','asc');
		$this->db->group_by('post_id');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function update_coment($data, $id) {
		if(!empty($data) && !empty($id)){
			$update = $this->db->update('comments', $data, array( 'comments.comment_id' =>$id));
			return $update?true:false;
		}else{
			return false;
		}
	}
}

