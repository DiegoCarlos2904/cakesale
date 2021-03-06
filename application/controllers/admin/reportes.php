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
		
		if ( isset( $_POST ) && count( $_POST ) ) {
			$this->form_validation->set_rules('type','Tipo','required');
			$this->form_validation->set_rules('date_from','Desde','required');
			$this->form_validation->set_rules('date_to','Hasta','required');

			if ($this->form_validation->run() == FALSE) {
				$data['errors'] = validation_errors();
			} else {
				$data_post = $this->security->xss_clean($_POST);
				$data_graf = array();
				switch ( $data_post['type'] ) {
					case 'ventas_productos':
						$this->load->model('model_orders');
						$list = $this->model_orders->get_productos_reporte( $data_post['date_from'], $data_post['date_to'] );
						if ( $list && count( $list ) ) {
							foreach ($list as $key => $lt) {
								$data_graf[] = array(
									'name' =>  $lt['nombre'],
									'total' => $lt['total'],
									'qty' => $lt['qty'],
								); 
							}
						}
						break;
					case 'ventas_categorias':
						$this->load->model('model_orders');
						$list = $this->model_orders->get_categorias_reporte( $data_post['date_from'], $data_post['date_to'] );
						if ( $list && count( $list ) ) {
							foreach ($list as $key => $lt) {
								$data_graf[] = array(
									'name' =>  $lt['nombre'],
									'total' => $lt['total'],
									'qty' => $lt['qty'],
								); 
							}
						}
						break;
					case 'pedidos':
						$this->load->model('model_orders');
						$list = $this->model_orders->get_cliente_reporte( $data_post['date_from'], $data_post['date_to'] );
						if ( $list && count( $list ) ) {
							foreach ($list as $key => $lt) {
								$data_graf[] = array(
									'name' =>  $lt['nombre'],
									'total' => $lt['total'],
									'qty' => $lt['count'],
								); 
							}
						}
						break;
					case 'valoracion':
						$this->load->model('model_comments');
						$list = $this->model_comments->get_reporte( $data_post['date_from'], $data_post['date_to'] );
						if ( $list && count( $list ) ) {
							foreach ($list as $key => $lt) {
								$data_graf[] = array(
									'name' =>  $lt['nombre'],
									'total' => $lt['avg_comment'],
								); 
							}
						}
						break;
				}
				$data['data_graf'] = $data_graf;
				$data['list'] = $list;
				$data['data_post'] = $data_post;
				$this->load->view('admin/reporte', $data);
				return;
			}
		}
		$data['reporte'] = array();
		$this->load->view('admin/registrar_reporte', $data);
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
}
