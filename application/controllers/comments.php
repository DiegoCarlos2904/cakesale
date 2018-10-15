<?php
class Comments extends CI_Controller {
	function add_comment($pro_slug) {
		if(!$this->input->post()) {
			redirect(base_url().'/tienda/ver/'.$pro_slug);
		}
		$usr_id = $this->session->userdata('usr_id');
		if(!$usr_id) {
			redirect(base_url().'index.php/users/login');
		}
		$this->load->model('model_comments');
		$this->load->model('model_products');
		$product = $this->model_products->showme($pro_slug);
		if( $product ) {
			$data = array(
				'post_id' => $product->pro_id,
				'user_id' => $this->session->userdata('usr_id'),
				'val' => $this->input->post('estrellas') | 0,
				'comment' => $this->input->post('comment'),
			);
			$this->model_comments->add_comment($data);
		}
		redirect(base_url().'tienda/ver/'.$pro_slug);
	}
}