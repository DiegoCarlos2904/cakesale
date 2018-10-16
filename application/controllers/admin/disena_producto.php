
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disena_producto extends CI_Controller {
	public function __construct () {
		parent::__construct();
		if( !in_array( $this->session->userdata('usr_group'), array( '1', '2' )  ) ) {
			$this->session->set_flashdata('log_error','No tiene los accesos necesarios');
			redirect('');
		}
		$this->load->model('model_design_products');
	}
	public function index() {
		$data['title'] = 'Diseños de productos';
		$data['list'] = $this->model_design_products->all_design_products_admin();
		$this->load->view('admin/design_productos',$data);
	}
	public function delete($pro_id) {
		$check = $this->model_design_products->delete($pro_id);
		if($check) {
			$this->session->set_flashdata('log_success','Producto eliminado correctamente');
		}
		else {
			$this->session->set_flashdata('log_error','Ocurruó un error al eliminar el producto');
		}
		redirect('admin/disena_producto');
	}

	public function editar($pro_id) {
		$data['title'] = 'Ver diseño';
		$data['product'] = $this->model_design_products->find($pro_id);
		if ( !$data['product'] ) {
			$data['product'] = 'El producto no existe';
		} else {
			if ( isset( $_POST ) && count( $_POST ) ) {
				$this->load->model('model_products');
				$this->form_validation->set_rules('pro_title','Título','required');
				$this->form_validation->set_rules('pro_description','Descripción','required');
				$this->form_validation->set_rules('pro_price','Precio','required|decimal');
				$this->form_validation->set_rules('pro_stock','Stock','required|integer');

				if ($this->form_validation->run() == FALSE) {
					$data['errors'] = validation_errors();
				} else {
					$data_products = array(
						'pro_title'			=> set_value('pro_title'),
						'pro_description'	=> set_value('pro_description'),
						'pro_price'			=> set_value('pro_price'),
						'pro_stock'			=> set_value('pro_stock'),
						'stuts'				=> set_value('stuts'),
						'pro_slug'			=> url_title(set_value('pro_title'), 'dash', true),
						'pro_image'			=> $data['product']->pro_image,
						'user_id'			=> $data['product']->user_id,
					);
					$new_prod_id = $this->model_products->create( $data_products );
					$this->model_design_products->edit( $pro_id, array( 'product_id' => $new_prod_id ) );

					$this->load->model('model_users');
					$user = $this->model_users->get_users( $data['product']->user_id );

					if ( $user ) {
						$contenido = '<p style="font-size: 20px;">
							<font color="#8b4513"><b><i>Diseño de producto aprobado - CAKESALE</i></b></font>
						</p>
						<p style="font-size: 18px;"><span style="font-size:16px;">Hola '. $user->full_name .', Por favor, ingresa a esta url para poder agregar un producto al carrito. Enlace: http://cakesale.pe/tienda/add_to_cart_design/'. $data['product']->hash . '</span></p>
						</p>';
						ob_start();
						$this->load->view('plantilla_correo', array( 'contenido' => $contenido ) );
						$html = ob_get_contents();
						ob_end_clean();
						$restablecer = $this->sendMail( "Diseño de producto aprobado - CAKESALE", $html, $user->usr_name );
						$this->session->set_flashdata('log_success','Se le notificó al usuario.');
					}
					redirect('admin/disena_producto');
				}
			}

		}
		$this->load->view('admin/editar_design_product',$data);
	}


	private function sendMail( $asunto, $contenido, $para, $attach = '' ) {
		$config = Array(
			'protocol' 		=> 'smtp',
			'smtp_host' 	=> 'ssl://smtp.googlemail.com',
			'smtp_port' 	=> 465, //465 o 587
			'smtp_user' 	=> 'cakesalepe@gmail.com', //para que no llega spam
			'smtp_pass' 	=> 'cakesale12345',
			'mailtype' 		=> 'html',
			'charset' 		=> 'UTF-8',
			'wordwrap' 		=> TRUE
		);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from( 'Cake Sale <cakesalepe@gmail.com>' );
		$this->email->to( $para );
		if ( $attach ) {
			$this->email->attach( $attach );
		}
		$this->email->subject( mb_convert_encoding( $asunto, "UTF-8" ) );
		$this->email->message( mb_convert_encoding( $contenido, "UTF-8" ) );
		return $this->email->send();
	}
}
