<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {
	public function __construct () {
		parent::__construct();
		if( !in_array( $this->session->userdata('usr_group'), array( '1', '2' )  ) ) {
			$this->session->set_flashdata('log_error','No tiene los accesos necesarios');
			redirect('');
		}
		$this->load->model('model_products');
		$this->load->model('model_categories');
	}
	public function index() {
		$data['title'] = 'Productos';
		$data['list'] = $this->model_products->all_products_admin();
		$this->load->view('admin/productos',$data);
	}
	public function delete($pro_id) {
		$check = $this->model_products->delete($pro_id);
		if($check) {
			$this->session->set_flashdata('log_success','Producto eliminado correctamente');
		}
		else {
			$this->session->set_flashdata('log_error','Ocurruó un error al eliminar el producto');
		}
		redirect('admin/productos');
	}
	
	public function registrar() {
		$data['categories'] = $this->model_categories->get_all( );
		
		if ( isset( $_POST ) && count( $_POST ) ) {
			$this->form_validation->set_rules('pro_title','Título','required');
			$this->form_validation->set_rules('pro_description','Descripción','required');
			$this->form_validation->set_rules('cat_id','Categoría','required|integer');
			$this->form_validation->set_rules('pro_price','Precio','required|decimal');
			$this->form_validation->set_rules('pro_stock','Stock','required|integer');

			if ($this->form_validation->run() == FALSE) {
				$data['errors'] = validation_errors();
			} else {
				$photo_correct = true;
				$pro_slug = '';
				if($_FILES['userfile']['name'] != '') {
					$config['upload_path']          = './upload/';
					$config['allowed_types']        = 'jpg|png';
					$config['max_size']             = 2000;
					$config['max_width']            = 2000;
					$config['max_height']           = 2000;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ( ! $this->upload->do_upload()) {
						$photo_correct = false;
						$data['errors'] =  $this->upload->display_errors();
					} else{
						$upload_image = $this->upload->data();
						$pro_image = 'http://cakesale.pe/upload/'.$upload_image['file_name'];
					}
				}
				if( $photo_correct ){
	 				$data_prt = $this->security->xss_clean($_POST);
	 				$pro_slug = url_title(set_value('pro_title'), 'dash', true);
	 				if ( !$this->model_products->exist( $pro_slug, '' ) ) {
						$data_products = array(
							'pro_title'			=> set_value('pro_title'),
							'pro_description'	=> set_value('pro_description'),
							'pro_price'			=> set_value('pro_price'),
							'pro_stock'			=> set_value('pro_stock'),
								'stuts'			=> set_value('stuts'),
							'pro_slug'			=> $pro_slug,
							'cat_id'			=> set_value('cat_id'),
						);
						if ( $pro_image ) {
							$data_products['pro_image'] = $pro_image;
						}
						$this->model_products->create($data_products);
						redirect('admin/productos');
	 				} else {
	 					$data['errors'] = 'Ya existe un producto con ese nombre';
						$this->load->view('admin/registrar_producto',$data);
	 				}
				
				}
			}
		}
		$this->load->view('admin/registrar_producto', $data);
	}
	
	public function editar($pro_id) {
		$data['categories'] = $this->model_categories->get_all( );
		$data['product'] = $this->model_products->find($pro_id);
		if ( isset( $_POST ) && count( $_POST ) ) {
			$this->form_validation->set_rules('pro_title','Título','required');
			$this->form_validation->set_rules('pro_description','Descripción','required');
			$this->form_validation->set_rules('cat_id','Categoría','required|integer');
			$this->form_validation->set_rules('pro_price','Precio','required|decimal');
			$this->form_validation->set_rules('pro_stock','Stock','required|integer');

			if ($this->form_validation->run() == FALSE) {
				$data['errors'] = validation_errors();
			} else {
				$photo_correct = true;
				$pro_slug = '';
				if($_FILES['userfile']['name'] != '') {
					$config['upload_path']          = './upload/';
					$config['allowed_types']        = 'jpg|png';
					$config['max_size']             = 2000;
					$config['max_width']            = 2000;
					$config['max_height']           = 2000;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ( ! $this->upload->do_upload()) {
						$photo_correct = false;
	 					$data['errors'] =  $this->upload->display_errors();
					} else{
						$upload_image = $this->upload->data();
						$pro_image = 'http://cakesale.pe/upload/'.$upload_image['file_name'];
					}
				}
				if( $photo_correct ){
	 				$data_prt = $this->security->xss_clean($_POST);
	 				$pro_slug = url_title(set_value('pro_title'), 'dash', true);
	 				if ( !$this->model_products->exist( $pro_slug, $pro_id ) ) {
						$data_products = array(
							'pro_title'			=> set_value('pro_title'),
							'pro_description'	=> set_value('pro_description'),
							'pro_price'			=> set_value('pro_price'),
							'pro_stock'			=> set_value('pro_stock'),
								'stuts'			=> set_value('stuts'),
							'pro_slug'			=> $pro_slug,
							'cat_id'			=> set_value('cat_id'),
						);
						$this->model_products->edit($pro_id,$data_products);
						redirect('admin/productos');
					}
					else {
	 					$data['errors'] = 'Ya existe un producto con ese nombre';
					}
				}
			}
		}

		$this->load->view('admin/editar_producto',$data);
	}
}
