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
	public function index() {
		$data['title'] = 'Tienda';
		$data['products'] = $this->model_products->all_products();
		$this->load->view('home',$data); 
	}
	public function carrito( ) {
		$data['title'] = 'Carrito';
		$data['hide_slider'] = true;
		$this->load->view('carrito',$data);
	}
	public function ver($pro_slug) {
		$data['product'] = $this->model_products->showme($pro_slug);
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

			$this->cart->destroy();

			
			$this->load->view('review', $cart);
		}
	}

	function DoExpressCheckoutPayment() {
		
		$cart = $this->session->userdata('shopping_cart');

		
		$SetExpressCheckoutPayPalResult = $this->session->userdata('PayPalResult');
		$PayPal_Token = $SetExpressCheckoutPayPalResult['TOKEN'];

		$DECPFields = array(
			'token' => $PayPal_Token,
			'payerid' => $cart['paypal_payer_id'],
		);

		$Payments = array();
		$Payment = array(
			'amt' => number_format($cart['shopping_cart']['grand_total'],2), 
			'itemamt' => number_format($cart['shopping_cart']['subtotal'],2),       
			'currencycode' => 'USD',
			'shippingamt' => number_format($cart['shopping_cart']['shipping'],2),
			'handlingamt' => number_format($cart['shopping_cart']['handling'],2),
			'taxamt' => number_format($cart['shopping_cart']['tax'],2), 	
			'shiptoname' => $cart['shipping_name'], 					      
			'shiptostreet' => $cart['shipping_street'], 	
			'shiptocity' => $cart['shipping_city'], 				
			'shiptostate' => $cart['shipping_state'], 				
			'shiptozip' => $cart['shipping_zip'], 				
			'shiptocountrycode' => $cart['shipping_country_code'], 	
			'shiptophonenum' => $cart['phone_number'],  				            
			'paymentaction' => 'Sale',
		);

		array_push($Payments, $Payment);

		$PayPalRequestData = array(
			'DECPFields' => $DECPFields,
			'Payments' => $Payments,
		);

		$PayPalResult = $this->paypal_pro->DoExpressCheckoutPayment($PayPalRequestData);

		
		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK']))
		{
			$errors = array('Errors'=>$PayPalResult['ERRORS']);

			
			$this->load->vars('errors', $errors);
			$this->load->vars('hide_slider', true );

			$this->load->view('paypal_error');
		}
		else {
			
			foreach($PayPalResult['PAYMENTS'] as $payment)
			{
				$cart['paypal_transaction_id'] = isset($payment['TRANSACTIONID']) ? $payment['TRANSACTIONID'] : '';
				$cart['paypal_fee'] = isset($payment['FEEAMT']) ? $payment['FEEAMT'] : '';
			}

			
			$this->session->set_userdata('shopping_cart', $cart);

			
			redirect('tienda/OrderComplete');
		}
	}

	function OrderComplete() {
		
		$cart = $this->session->userdata('shopping_cart');

		if(empty($cart)) redirect('');

		
		$this->load->vars('hide_slider', true );
		$this->load->vars('cart', $cart);

		
		$this->load->view('payment_complete');
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
}
