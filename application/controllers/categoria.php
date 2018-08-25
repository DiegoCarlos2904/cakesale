<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {
		
	public function __construct () {
		parent::__construct();
		$this->load->model('model_products');
		$this->load->model('model_categories');
	}

	public function index() {
		$data['products'] = $this->model_products->all_products();
		$this->load->view('category',$data);
	}
	public function ver( $slug ) {
		$data['category'] = $this->model_categories->findBySlug( $slug );
		if ( $data['category'] ) {
			$data['products'] = $this->model_products->all_products( $data['category']->cat_id );
			$data['title'] = $data['category']->name;
		} else {
			$data['title'] = 'Categoría no encontrada';
			$data['hide_slider'] = true;
			$this->load->view('404', $data);
			return;
		}
		$this->load->view('category',$data);
	}
}
