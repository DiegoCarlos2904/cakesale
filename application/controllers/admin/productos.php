<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {
	public function __construct () {
		parent::__construct();
		if($this->session->userdata('usr_group')!=	('1' ||'2') ) {
			$this->session->set_flashdata('error','No tiene una sesión iniciada');
			redirect('login');	
		}
		$this->load->model('model_products');
		$this->load->model('model_categories');
	}
	public function index() {
		$data['title'] = 'Productos';
		$data['list'] = $this->model_products->all_products();
		$this->load->view('admin/productos',$data);
	}
	public function delete($pro_id) {
		$this->model_products->delete($pro_id);
		redirect('admin/productos');
	}
	
	public function registrar() {
		$data['categories'] = $this->model_categories->get_all( );
		
		if ( isset( $_POST ) && count( $_POST ) ) {
			$this->form_validation->set_rules('pro_title','Título','required');
			$this->form_validation->set_rules('pro_description','Descripción','required');
			$this->form_validation->set_rules('cat_id','Categoría','required|integer');
			$this->form_validation->set_rules('pro_price','Precio','required|integer');
			$this->form_validation->set_rules('pro_stock','Stock','required|integer');

			if ($this->form_validation->run() == FALSE) {
				$data['errors'] = validation_errors();
			} else {
				if($_FILES['userfile']['name'] != '') {
					$config['upload_path']          = './upload/';
					$config['allowed_types']        = 'jpg|png';
					$config['max_size']             = 2000;
					$config['max_width']            = 2000;
					$config['max_height']           = 2000;
					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload()) {
						$this->load->view('admin/editar_producto',$data);
					} else{
						$upload_image = $this->upload->data();
						$data_products = array(
							'pro_title'			=> set_value('pro_title'),
							'pro_description'	=> set_value('pro_description'),
							'pro_price'			=> set_value('pro_price'),
							'pro_stock'			=> set_value('pro_stock'),
							'pro_slug'			=> url_title(set_value('pro_title'), 'dash', true),
							'cat_id'			=> set_value('cat_id'),
							'pro_image'			=> 'http://cakesale.pe/upload/'.$upload_image['file_name']
						);
						$this->model_products->create($data_products);
						redirect('admin/productos');
					}
				}else{
	 				$data_user = $this->security->xss_clean($_POST);
					$data_products = array(
						'pro_title'			=> set_value('pro_title'),
						'pro_description'	=> set_value('pro_description'),
						'pro_price'			=> set_value('pro_price'),
						'pro_stock'			=> set_value('pro_stock'),
						'pro_slug'			=> url_title(set_value('pro_title'), 'dash', true),
						'cat_id'			=> set_value('cat_id'),
					);
					$this->model_products->create($data_products);
					redirect('admin/productos');
				}
			}
		}
		$this->load->view('admin/crear_producto', $data);
	}
	
	public function editar($pro_id) {
		$data['categories'] = $this->model_categories->get_all( );
		$data['product'] = $this->model_products->find($pro_id);
		if ( isset( $_POST ) && count( $_POST ) ) {
			$this->form_validation->set_rules('pro_title','Título','required');
			$this->form_validation->set_rules('pro_description','Descripción','required');
			$this->form_validation->set_rules('cat_id','Categoría','required|integer');
			$this->form_validation->set_rules('pro_price','Precio','required|integer');
			$this->form_validation->set_rules('pro_stock','Stock','required|integer');

			if ($this->form_validation->run() == FALSE) {
				$data['errors'] = validation_errors();
			} else {
				if($_FILES['userfile']['name'] != '') {
					$config['upload_path']          = './upload/';
					$config['allowed_types']        = 'jpg|png';
					$config['max_size']             = 2000;
					$config['max_width']            = 2000;
					$config['max_height']           = 2000;
					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload()) {
						$this->load->view('admin/editar_producto',$data);
					} else{
						$upload_image = $this->upload->data();
						$data_products = array(
							'pro_title'			=> set_value('pro_title'),
							'pro_description'	=> set_value('pro_description'),
							'pro_price'			=> set_value('pro_price'),
							'pro_stock'			=> set_value('pro_stock'),
							'cat_id'			=> set_value('cat_id'),
							'pro_slug'			=> url_title(set_value('pro_title'), 'dash', true),
							'pro_image'			=> 'http://cakesale.pe/upload/'.$upload_image['file_name']
						);
						$this->model_products->edit($pro_id,$data_products);
						redirect('admin/productos');
					}
				}else{
	 				$data_user = $this->security->xss_clean($_POST);
					$data_products = array(
						'pro_title'			=> set_value('pro_title'),
						'pro_description'	=> set_value('pro_description'),
						'pro_price'			=> set_value('pro_price'),
						'pro_stock'			=> set_value('pro_stock'),
						'pro_slug'			=> url_title(set_value('pro_title'), 'dash', true),
						'cat_id'			=> set_value('cat_id'),
					);
					$this->model_products->edit($pro_id,$data_products);
					redirect('admin/productos');
				}
			}
		}

		$this->load->view('admin/editar_producto',$data);
	}
}
