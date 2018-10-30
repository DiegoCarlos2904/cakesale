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
		$this->model_reportes->delete($reporte_id);
		redirect('admin/reportes');
	}
	
	private function pdf_generate( $html, $name_view ) {
		$this->load->helper( array( 'dompdf', 'file' ) );
		$pdf_string = pdf_create($html, '', false);
		file_put_contents( './upload/'.$name_view.'.pdf', $pdf_string ); 
	}
	private function procesing_data( $data, $name ) {
		$list = array();
		if ( $data && count( $data ) ) {
			$list[0] = array();
			foreach ($data as $key => $dt) {
				$list[0][] = $dt[ $name ];
			}
		}
		return $list;
	}
	private function jpg_generate_bar( $title, $data, $name_view ) {
		require_once (APPPATH.'/libraries/JpGraph/jpgraph.php');
		require_once (APPPATH.'/libraries/JpGraph/jpgraph_bar.php');

		$graph = new Graph(350,200,'auto');
		$graph->SetScale("textlin");

		$theme_class=new UniversalTheme;
		$graph->SetTheme($theme_class);

		$graph->SetBox(false);

		$graph->ygrid->SetFill(false);
		$graph->yaxis->HideLine(false);
		$graph->yaxis->HideTicks(false,false);

		if ( $data && count( $data ) ) {
			$list_BarPlot = [];
			foreach ($data as $key => $dt) {
				$b1plot = new BarPlot($dt);
				$list_BarPlot[] = $b1plot;
			}
		}

		$gbplot = new GroupBarPlot( $list_BarPlot );
		$graph->Add($gbplot);

		$graph->title->Set( $title );

		$graph->Stroke( 'upload/'.$name_view.'.jpg' );
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
				$time = time();
				$file_name = 'reporte_'.$time.'.'.$data_post['formato'];
				$data_post['url'] = 'http://cakesale.pe/upload/'.$file_name;
				$this->load->library('excel');
				switch ( $data_post['type'] ) {
					case 'ventas_productos':
						$this->load->model('model_orders');
						$list = $this->model_orders->get_productos_reporte( $data_post['date_from'], $data_post['date_to'] );
						if ( $data_post['formato'] == 'pdf' ) {
							$data_grafics = array();
							ob_start();
							$list_data_1 = $this->procesing_data($list, 'total');
							$name_jpg = 'reporte_jpg_'.$time.'_1';
							$this->jpg_generate_bar( "Ventas por precio", $list_data_1, $name_jpg );
							ob_end_clean();
							$data_grafics[] = array(
								'photo' => 'http://cakesale.pe/upload/'.$name_jpg.'.jpg',
								'names' => $list,
								'campo' => 'total',
							);

							ob_start();
							$list_data_2 = $this->procesing_data($list, 'qty');
							$name_jpg = 'reporte_jpg_'.$time.'_2';
							$this->jpg_generate_bar( "Ventas por cantidad", $list_data_2, $name_jpg );
							ob_end_clean();
							$data_grafics[] = array(
								'photo' => 'http://cakesale.pe/upload/'.$name_jpg.'.jpg',
								'names' => $list,
								'campo' => 'qty',
							);
							ob_start();
							$this->load->view('reporte_pdf', array( 'list' => $list, 'data_grafics' => $data_grafics, 'data_post' => $data_post ) );
							$contenido = ob_get_contents();
							ob_end_clean();
							ob_start();
							$this->load->view('plantilla_pdf', array( 'contenido' => $contenido ) );
							$html = ob_get_contents();
							ob_end_clean();
							$name_pdf = 'reporte_'.$time;
							$this->pdf_generate( $html, $name_pdf );
						}
						if ( $data_post['formato'] == 'xls' ) {
							$new_list = array(
								array(
									'index' => '#',
									'name' => 'Nombre',
									'val' => 'Valor',
								)
							);
							if ( $list && count( $list ) ) {
								foreach ($list as $key => $lt) {
									$new_list[] = array(
										'index' => $key + 1,
										'name' => $lt['nombre'],
										'val' => $lt['total'],
									);
								}
							}
							$this->excel->setActiveSheetIndex(0);
							$this->excel->getActiveSheet()->setTitle('Ventas de productos');
							$this->excel->getActiveSheet()->fromArray($new_list);
							header('Content-Type: application/vnd.ms-excel');
							header('Content-Disposition: attachment;filename="'.$file_name.'"');
							header('Cache-Control: max-age=0'); //no cache
										
							$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
							$objWriter->save( 'upload/'.$file_name );
						}
						$generate_file = true;
						break;
					case 'ventas_categorias':
						$this->load->model('model_orders');
						$list = $this->model_orders->get_categorias_reporte( $data_post['date_from'], $data_post['date_to'] );
						if ( $data_post['formato'] == 'pdf' ) {
							$data_grafics = array();
							ob_start();
							$list_data_1 = $this->procesing_data($list, 'total');
							$name_jpg = 'reporte_jpg_'.$time.'_1';
							$this->jpg_generate_bar( "Ventas por precio", $list_data_1, $name_jpg );
							ob_end_clean();
							$data_grafics[] = array(
								'photo' => 'http://cakesale.pe/upload/'.$name_jpg.'.jpg',
								'names' => $list,
								'campo' => 'total',
							);

							ob_start();
							$list_data_2 = $this->procesing_data($list, 'qty');
							$name_jpg = 'reporte_jpg_'.$time.'_2';
							$this->jpg_generate_bar( "Ventas por cantidad", $list_data_2, $name_jpg );
							ob_end_clean();
							$data_grafics[] = array(
								'photo' => 'http://cakesale.pe/upload/'.$name_jpg.'.jpg',
								'names' => $list,
								'campo' => 'qty',
							);
							ob_start();
							$this->load->view('reporte_pdf', array( 'list' => $list, 'data_grafics' => $data_grafics, 'data_post' => $data_post ) );
							$contenido = ob_get_contents();
							ob_end_clean();
							ob_start();
							$this->load->view('plantilla_pdf', array( 'contenido' => $contenido ) );
							$html = ob_get_contents();
							ob_end_clean();
							$name_pdf = 'reporte_'.$time;
							$this->pdf_generate( $html, $name_pdf );
						}
						if ( $data_post['formato'] == 'xls' ) {
							$new_list = array(
								array(
									'index' => '#',
									'name' => 'Nombre',
									'val' => 'Valor',
								)
							);
							if ( $list && count( $list ) ) {
								foreach ($list as $key => $lt) {
									$new_list[] = array(
										'index' => $key + 1,
										'name' => $lt['nombre'],
										'val' => $lt['total'],
									);
								}
							}
							$this->excel->setActiveSheetIndex(0);
							$this->excel->getActiveSheet()->setTitle('Ventas por categoría');
							$this->excel->getActiveSheet()->fromArray($new_list);
							header('Content-Type: application/vnd.ms-excel');
							header('Content-Disposition: attachment;filename="'.$file_name.'"');
							header('Cache-Control: max-age=0'); //no cache
										
							$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
							$objWriter->save( 'upload/'.$file_name );
						}
						$generate_file = true;
						break;
					case 'pedidos':
						$this->load->model('model_orders');
						$list = $this->model_orders->get_cliente_reporte( $data_post['date_from'], $data_post['date_to'] );
						if ( $data_post['formato'] == 'pdf' ) {
							$data_grafics = array();
							ob_start();
							$list_data_1 = $this->procesing_data($list, 'total');
							$name_jpg = 'reporte_jpg_'.$time.'_1';
							$this->jpg_generate_bar( "Pedidos por cliente", $list_data_1, $name_jpg );
							ob_end_clean();
							$data_grafics[] = array(
								'photo' => 'http://cakesale.pe/upload/'.$name_jpg.'.jpg',
								'names' => $list,
								'campo' => 'total',
							);
							ob_start();
							$this->load->view('reporte_pdf', array( 'list' => $list, 'data_grafics' => $data_grafics, 'data_post' => $data_post ) );
							$contenido = ob_get_contents();
							ob_end_clean();
							ob_start();
							$this->load->view('plantilla_pdf', array( 'contenido' => $contenido ) );
							$html = ob_get_contents();
							ob_end_clean();
							$name_pdf = 'reporte_'.$time;
							$this->pdf_generate( $html, $name_pdf );
						}
						if ( $data_post['formato'] == 'xls' ) {
							$new_list = array(
								array(
									'index' => '#',
									'name' => 'Nombre',
									'val' => 'Valor',
								)
							);
							if ( $list && count( $list ) ) {
								foreach ($list as $key => $lt) {
									$new_list[] = array(
										'index' => $key + 1,
										'name' => $lt['nombre'],
										'val' => $lt['total'],
									);
								}
							}
							$this->excel->setActiveSheetIndex(0);
							$this->excel->getActiveSheet()->setTitle('Pedidos por cliente');
							$this->excel->getActiveSheet()->fromArray($new_list);
							header('Content-Type: application/vnd.ms-excel');
							header('Content-Disposition: attachment;filename="'.$file_name.'"');
							header('Cache-Control: max-age=0'); //no cache
										
							$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
							$objWriter->save( 'upload/'.$file_name );
						}
						$generate_file = true;
						break;
					case 'valoracion':
						$this->load->model('model_comments');
						$list = $this->model_comments->get_reporte( $data_post['date_from'], $data_post['date_to'] );
						if ( $data_post['formato'] == 'pdf' ) {
							$data_grafics = array();
							ob_start();
							$list_data_1 = $this->procesing_data($list, 'total');
							$name_jpg = 'reporte_jpg_'.$time.'_1';
							$this->jpg_generate_bar( "Valoración de tortas", $list_data_1, $name_jpg );
							ob_end_clean();
							$data_grafics[] = array(
								'photo' => 'http://cakesale.pe/upload/'.$name_jpg.'.jpg',
								'names' => $list,
								'campo' => 'total',
							);
							ob_start();
							$this->load->view('reporte_pdf', array( 'list' => $list, 'data_grafics' => $data_grafics, 'data_post' => $data_post ) );
							$contenido = ob_get_contents();
							ob_end_clean();
							ob_start();
							$this->load->view('plantilla_pdf', array( 'contenido' => $contenido ) );
							$html = ob_get_contents();
							ob_end_clean();
							$name_pdf = 'reporte_'.$time;
							$this->pdf_generate( $html, $name_pdf );
						}
						if ( $data_post['formato'] == 'xls' ) {
							$new_list = array(
								array(
									'index' => '#',
									'name' => 'Nombre',
									'val' => 'Valor',
								)
							);
							if ( $list && count( $list ) ) {
								foreach ($list as $key => $lt) {
									$new_list[] = array(
											'index' => $key + 1,
											'name' => $lt['nombre'],
											'val' => $lt['total'],
									);
								}
							}
							$this->excel->setActiveSheetIndex(0);
							$this->excel->getActiveSheet()->setTitle('Valoración de tortas');
							$this->excel->getActiveSheet()->fromArray($new_list);
							header('Content-Type: application/vnd.ms-excel');
							header('Content-Disposition: attachment;filename="'.$file_name.'"');
							header('Cache-Control: max-age=0'); //no cache
										
							$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
							$objWriter->save( 'upload/'.$file_name );
						}
						$generate_file = true;
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
				$data['errors'] = 'Ocurrió un error al registrar losel reporte';
			}
		}
		$data['reporte'] = array();
		$this->load->view('admin/registrar_reporte', $data);
	}
	
}
