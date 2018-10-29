<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reportes extends CI_Controller {
	public function __construct () {
		parent::__construct();
		if( !in_array( $this->session->userdata('usr_group'), array( '1', '2' )  ) ) {
			$this->session->set_flashdata('log_error','No tiene los accesos necesarios');
			redirect('');
		}
		$this->load->model('model_reportes');
	}
	public function index() {
		$data['title'] = 'Reportes';
		$data['list'] = $this->model_reportes->get_reportes();
		$this->load->view('admin/reportes',$data);
	}
	public function delete($reporte_id) {
		$this->model_users->delete($reporte_id);
		redirect('admin/reportes');
	}
	
	public function registrar() {
		if ( isset( $_POST ) && count( $_POST ) ) {
			$this->form_validation->set_rules('type','Tipo','required');
			$this->form_validation->set_rules('date_from','Desde','required');
			$this->form_validation->set_rules('date_to','Hasta','required');
			$this->form_validation->set_rules('formato','Formato','required');

			if ($this->form_validation->run() == FALSE) {
				$data['errors'] = validation_errors();
			} else {
				$data_post = $this->security->xss_clean($_POST);
				$generate_file = false;
				$this->load->library('excel');
				if ( $data_post['formato'] == 'xls' ) {
				}
				$time = time();
				$file_name = 'reporte_'.$time.'.'.$data_post['formato'];
				$data_post['url'] = 'http://cakesale.pe/uploads/'.$file_name;
				switch ( $data_post['type'] ) {
					case 'ventas_productos':
						$this->load->model('model_orders');
						$list = $this->model_orders->get_productos_reporte( $data_post['date_from'], $data_post['date_to'] );
						$this->excel->setActiveSheetIndex(0);
						$this->excel->getActiveSheet()->setTitle('Ventas de productos');
						$this->excel->getActiveSheet()->fromArray($list);
						header('Content-Type: application/vnd.ms-excel');
						header('Content-Disposition: attachment;filename="'.$file_name.'"');
						header('Cache-Control: max-age=0'); //no cache
									
						$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
						$objWriter->save('php://output');
						$generate_file = false;
						break;
					case 'ventas_categorias':
						$this->load->model('model_orders');
						$list = $this->model_orders->get_categorias_reporte( $data_post['date_from'], $data_post['date_to'] );
						$this->excel->setActiveSheetIndex(0);
						$this->excel->getActiveSheet()->setTitle('Ventas de productos');
						$this->excel->getActiveSheet()->fromArray($list);
						header('Content-Type: application/vnd.ms-excel');
						header('Content-Disposition: attachment;filename="'.$file_name.'"');
						header('Cache-Control: max-age=0'); //no cache
									
						$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
						$objWriter->save('php://output');
						$generate_file = false;
						break;
					case 'pedidos':
						$this->load->model('model_orders');
						$list = $this->model_orders->get_cliente_reporte( $data_post['date_from'], $data_post['date_to'] );
						$this->excel->setActiveSheetIndex(0);
						$this->excel->getActiveSheet()->setTitle('Ventas de productos');
						$this->excel->getActiveSheet()->fromArray($list);
						header('Content-Type: application/vnd.ms-excel');
						header('Content-Disposition: attachment;filename="'.$file_name.'"');
						header('Cache-Control: max-age=0'); //no cache
									
						$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
						$objWriter->save('php://output');
						$generate_file = false;
						break;
					case 'valoracion':
						$this->load->model('model_comments');
						$list = $this->model_comments->get_reporte( $data_post['date_from'], $data_post['date_to'] );
						$this->excel->setActiveSheetIndex(0);
						$this->excel->getActiveSheet()->setTitle('Ventas de productos');
						$this->excel->getActiveSheet()->fromArray($list);
						header('Content-Type: application/vnd.ms-excel');
						header('Content-Disposition: attachment;filename="'.$file_name.'"');
						header('Cache-Control: max-age=0'); //no cache
									
						$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
						$objWriter->save('php://output');
						$generate_file = false;
						break;
				}
				if( $generate_file ) {
					$data_post['status'] = 'publish';
					unset( $data_post['is_submitted'] );
					$reporte_id = $this->model_reportes->insert($data_post );
					if( $reporte_id ) {
						$this->session->set_flashdata('log_success','Se registró la cuenta correctamente.');
						redirect('admin/reportes');
					}
				}
				$data['errors'] = 'Ocurrió un error al registrar los datos del usuario';
			}
		}
		$data['reporte'] = array();
		$this->load->view('admin/registrar_reporte', $data);
	}
	
}
