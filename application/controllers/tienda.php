<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tienda extends CI_Controller {
		
	public function __construct () {
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('session');
		$this->config->load('paypal');

		$config = array(
			'Sandbox' => $this->config->item('Sandbox'),            
			'APIUsername' => $this->config->item('APIUsername'),    
			'APIPassword' => $this->config->item('APIPassword'),    
			'APISignature' => $this->config->item('APISignature'),    
			'APISubject' => '',
			'APIVersion' => $this->config->item('APIVersion'),
			'DeviceID' => $this->config->item('DeviceID'),
			'ApplicationID' => $this->config->item('ApplicationID'),
			'DeveloperEmailAccount' => $this->config->item('DeveloperEmailAccount')
		);
		
		if ($config['Sandbox']) {
			error_reporting(E_ALL);
			ini_set('display_errors', '1');
		}

		$this->load->library('paypal/paypal_pro', $config);

		$this->load->model('model_products');
		$this->load->model('model_orders');
	}
	public function ubicaciones() {
		$data['hide_slider'] = true;
		$data['title'] = 'Ubicaciones';
		$this->load->view('ubicaciones',$data); 
	}
	public function index() {
		$data['title'] = 'Tienda';
		$data['products'] = $this->model_products->all_products();
		$this->load->view('home',$data); 
	}
	public function buscar() {
		$texto = $this->input->get('s');
		$data['hide_slider'] = true;
		$data['title'] = 'Resultados para "'. $texto .'"';
		$data['products'] = $this->model_products->search( $texto );
		$this->load->view('home',$data); 
	}
	public function disena_producto( ) {
		$data['title'] = 'Diseña su propio pedido de torta';
		$data['hide_slider'] = true;

		if ( isset( $_POST ) && count( $_POST ) ) {
			$this->form_validation->set_rules('pro_title','Título','required');
			$this->form_validation->set_rules('mensaje','Mensaje en la torta','required');
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
					$this->upload->initialize($config);
					if ( ! $this->upload->do_upload()) {
						$data['errors'] =  $this->upload->display_errors();
					} else{
						$this->load->model('model_design_products');
						$upload_image = $this->upload->data();
						$data_products = array(
							'pro_title'			=> set_value('pro_title'),
							'pro_image'			=> 'http://cakesale.pe/upload/'.$upload_image['file_name'],
							'stuts'				=> 'publish',
							'user_id'			=> $this->session->userdata['usr_id'],
							'especificaciones'	=> set_value('especificaciones'),
							'mensaje'			=> set_value('mensaje'),
							'hash'				=> sha1( time() ),
						);
						$this->model_design_products->create($data_products);
						$this->session->set_flashdata('log_success','Se registró el diseño correctamente.');
						redirect('/');
					}
				} else {
					$data['errors'] = 'Debes agregar una foto.';
				}
			}
		}

		$this->load->view('disena_producto',$data);
	}
	public function carrito( ) {
		$data['title'] = 'Carrito';
		$data['hide_slider'] = true;
		$this->load->view('carrito',$data);
	}
	public function ver($pro_slug) {
		$this->load->model('model_comments');
		$data['hide_slider'] = true;
		$data['product'] = $this->model_products->showme($pro_slug);
		if ( $data['product'] ) {
			$data['comments'] = $this->model_comments->get_comment( $data['product']->pro_id );
		} else {
			$data['comments'] = array();
		}
		$data['title'] = 'Tienda';
		$this->load->view('producto',$data);
	}
	public function clear_cart() {
		$this->cart->destroy();
		redirect(base_url());
	}
	public function add_to_cart($pro_slug,$send = '') {
		$this->load->library('cart');
		$product = $this->model_products->showme($pro_slug);


	 	$data_post = $this->security->xss_clean($_POST);
		$data = array(
			'id'      => $product->pro_id,
			'qty'     => 1,
			'price'   => $product->pro_price,
			'name'	  => $product->pro_title,
	        'options' => array( 
	        	'porciones' => $data_post['porciones'],
	        	'mensaje' => $data_post['mensaje'],
	        	'especificaciones' => $data_post['especificaciones'],
	        )
		);
		$this->cart->insert($data);

		$this->session->set_flashdata('log_success','Se agregó el producto al carrito correctamente.');
		if ( $send == 'add' ) {
			redirect('tienda/ver/'.$product->pro_slug);
		} else{
			redirect( base_url() );
		}
	}
	public function add_to_cart_design($pro_hash) {
		$this->load->model('model_design_products');
		$this->load->library('cart');
		
		$diseno_producto = $this->model_design_products->findHash($pro_hash);
		if( $diseno_producto ) {
			$product = $this->model_products->find($diseno_producto->product_id);
			if ( $product ) {
				if ( $product->pro_stock ) {
					$data = array(
						'id'      => $product->pro_id,
						'qty'     => $product->pro_stock,
						'price'   => $product->pro_price,
						'name'	  => $product->pro_title,
						'options' => array( 
							'porciones' => '',
							'mensaje' => $diseno_producto->mensaje,
							'especificaciones' => $diseno_producto->especificaciones,
						)
					);
					$this->cart->insert($data);
					$this->session->set_flashdata('log_success','Se agregó el producto al carrito correctamente.');
				} else {
					
				}
			} else {
				$this->session->set_flashdata('log_error','No se encontró el producto.');
			}
		} else {
			$this->session->set_flashdata('log_error','No se encontró el producto.');
		}
		redirect( base_url() );
	}
	public function GetExpressCheckoutDetails() {
		$cart = $this->session->userdata('shopping_cart');

		$SetExpressCheckoutPayPalResult = $this->session->userdata('PayPalResult');
		$PayPal_Token = $SetExpressCheckoutPayPalResult['TOKEN'];

		$PayPalResult = $this->paypal_pro->GetExpressCheckoutDetails($PayPal_Token);

		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])) {
			$errors = array('Errors'=>$PayPalResult['ERRORS']);
			$this->load->vars('errors', $errors);

			$this->load->vars('hide_slider', true );
		}
		else {
			$cart['paypal_payer_id'] = isset($PayPalResult['PAYERID']) ? $PayPalResult['PAYERID'] : '';
			$cart['phone_number'] = isset($PayPalResult['PHONENUM']) ? $PayPalResult['PHONENUM'] : '';
			$cart['email'] = isset($PayPalResult['EMAIL']) ? $PayPalResult['EMAIL'] : '';
			$cart['first_name'] = isset($PayPalResult['FIRSTNAME']) ? $PayPalResult['FIRSTNAME'] : '';
			$cart['last_name'] = isset($PayPalResult['LASTNAME']) ? $PayPalResult['LASTNAME'] : '';

			foreach($PayPalResult['PAYMENTS'] as $payment) {
				$cart['shipping_name'] = isset($payment['SHIPTONAME']) ? $payment['SHIPTONAME'] : '';
				$cart['shipping_street'] = isset($payment['SHIPTOSTREET']) ? $payment['SHIPTOSTREET'] : '';
				$cart['shipping_city'] = isset($payment['SHIPTOCITY']) ? $payment['SHIPTOCITY'] : '';
				$cart['shipping_state'] = isset($payment['SHIPTOSTATE']) ? $payment['SHIPTOSTATE'] : '';
				$cart['shipping_zip'] = isset($payment['SHIPTOZIP']) ? $payment['SHIPTOZIP'] : '';
				$cart['shipping_country_code'] = isset($payment['SHIPTOCOUNTRYCODE']) ? $payment['SHIPTOCOUNTRYCODE'] : '';
				$cart['shipping_country_name'] = isset($payment['SHIPTOCOUNTRYNAME']) ? $payment['SHIPTOCOUNTRYNAME'] : '';
			}
			$cart['shopping_cart']['shipping'] = 0;
			$cart['shopping_cart']['handling'] = 0;
			$cart['shopping_cart']['tax'] = 0;

			$cart['shopping_cart']['grand_total'] = number_format($cart['shopping_cart']['subtotal'],2);

			$this->session->set_userdata('shopping_cart', $cart);

			$cart['hide_slider'] = true;
			$this->load->vars('cart', $cart);


			$is_processed = $this->model_orders->process();
			$cart['invoice_id'] = $is_processed;

			$this->cart->destroy();

			$cart_data = $this->session->userdata('shopping_cart');
			
			$SetExpressCheckoutPayPalResult = $this->session->userdata('PayPalResult');
			$PayPal_Token = $SetExpressCheckoutPayPalResult['TOKEN'];

			$DECPFields = array(
				'token' => $PayPal_Token,
				'payerid' => $cart_data['paypal_payer_id'],
			);

			$Payments = array();
			$Payment = array(
				'amt' => number_format($cart_data['shopping_cart']['grand_total'],2), 
				'itemamt' => number_format($cart_data['shopping_cart']['subtotal'],2),       
				'currencycode' => 'USD',
				'shippingamt' => number_format($cart_data['shopping_cart']['shipping'],2),
				'handlingamt' => number_format($cart_data['shopping_cart']['handling'],2),
				'taxamt' => number_format($cart_data['shopping_cart']['tax'],2), 	
				'shiptoname' => $cart_data['shipping_name'], 					      
				'shiptostreet' => $cart_data['shipping_street'], 	
				'shiptocity' => $cart_data['shipping_city'], 				
				'shiptostate' => $cart_data['shipping_state'], 				
				'shiptozip' => $cart_data['shipping_zip'], 				
				'shiptocountrycode' => $cart_data['shipping_country_code'], 	
				'shiptophonenum' => $cart_data['phone_number'],  				            
				'paymentaction' => 'Sale',
			);

			array_push($Payments, $Payment);

			$PayPalRequestData = array(
				'DECPFields' => $DECPFields,
				'Payments' => $Payments,
			);

			$PayPalResult = $this->paypal_pro->DoExpressCheckoutPayment($PayPalRequestData);

			
			if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])) {
				$errors = array('Errors'=>$PayPalResult['ERRORS']);
				$this->load->vars('errors', $errors);
				$this->load->vars('hide_slider', true );
				$this->load->view('paypal_error');
			}
			else {
				ob_start();
				$this->load->view('review_mail', $cart );
				$contenido = ob_get_contents();
				ob_end_clean();
				
				ob_start();
				$this->load->view('plantilla_correo', array( 'contenido' => $contenido ) );
				$html = ob_get_contents();
				ob_end_clean();
				$name_pdf = 'invoice_'.$is_processed;
				$this->pdf_generate( $html, $name_pdf );
				$send_mail = $this->sendMail( "Compra realizada en CAKESALE", $html, $this->session->userdata['usr_name'], FCPATH.'/upload/'.$name_pdf.'.pdf' );
				foreach($PayPalResult['PAYMENTS'] as $payment) {
					$cart_data['paypal_transaction_id'] = isset($payment['TRANSACTIONID']) ? $payment['TRANSACTIONID'] : '';
					$cart_data['paypal_fee'] = isset($payment['FEEAMT']) ? $payment['FEEAMT'] : '';
				}
				$this->session->set_userdata('shopping_cart', $cart_data);
				$this->load->view('review', $cart);
			}
		}
	}


	private function pdf_generate( $html, $name_view ) {
		$this->load->helper( array( 'dompdf', 'file' ) );
		//pdf_create($html, 'filename');
		$pdf_string = pdf_create($html, '', false);
		file_put_contents( './upload/'.$name_view.'.pdf', $pdf_string ); 
		//write_file('name', $data);
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

	public function pedido_cancelado() {

		$this->load->vars('hide_slider', true);
		$this->session->unset_userdata('PayPalResult');
		$this->session->unset_userdata('shopping_cart');
		$this->load->view('order_cancelled');
	}
	public function setpaypal() {
		$this->session->unset_userdata('PayPalResult');

		$cart = $this->session->userdata('shopping_cart');


		$SECFields = array(
			'maxamt' => round($cart['shopping_cart']['grand_total'] * 2,2), 
			'returnurl' => site_url('tienda/GetExpressCheckoutDetails'), 
			'cancelurl' => site_url('tienda/pedido_cancelado'), 			
			'hdrimg' => 'https://image.ibb.co/ksSRX9/logo.jpg', 	
			'logoimg' => 'https://image.ibb.co/ksSRX9/logo.jpg',
			'brandname' => 'Cake Sale', 
			'customerservicenumber' => '986532360',
		);

		$Payments = array();
		$Payment = array(
			'amt' => $cart['shopping_cart']['grand_total'],
		);
		array_push($Payments, $Payment);

		$PayPalRequestData = array(
			'SECFields' => $SECFields,
			'Payments' => $Payments,
		);

		$PayPalResult = $this->paypal_pro->SetExpressCheckout($PayPalRequestData);

		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])) {
			$errors = array('Errors'=>$PayPalResult['ERRORS']);
			
			$this->load->vars('errors', $errors);

			$this->load->view('paypal_error');
		}
		else {

			$this->session->set_userdata('PayPalResult', $PayPalResult);

			redirect($PayPalResult['REDIRECTURL'],'Location');
			
			redirect($PayPalResult['REDIRECTURL'],'Location');
		}
	}
	public function finalizar_compra() {
		if( !$this->isLoggedin() ) { 
			redirect('login');
			exit();
		}
		$this->session->unset_userdata('PayPalResult');
		$this->session->unset_userdata('shopping_cart');

		$cart = ['items' => array()];
		foreach ($this->cart->contents() as $items) {
			$cart['items'][] = array(
				'id' => $items['id'],
				'name' => $items['name'],
				'qty' =>  $items['qty'],
				'price' =>   $items['price'], 2 ,
			);
			
		}
		
		$cart['hide_slider'] = true;
		
		$cart['shopping_cart'] = array(
			'items' => $cart['items'],
			'shipping' => 0,
			'handling' => 0,
			'tax' => 0,
			'subtotal' =>  $this->cart->total(),
		);

		$cart['shopping_cart']['grand_total'] = $cart['shopping_cart']['subtotal'];

		$this->load->vars('cart', $cart);
		$this->session->set_userdata('shopping_cart', $cart);

		$this->load->view('finalizar_compra', $cart);
	}
	public function isLoggedin() {
		if(!empty($this->session->userdata['usr_id'])) {
			return true;
		}
		else {
			return false;
		}
	}
}
