<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once 'dompdf/lib/html5lib/Parser.php';
require_once 'dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
require_once 'dompdf/lib/php-svg-lib/src/autoload.php';
require_once 'dompdf/src/Autoloader.php';
function pdf_create($html, $filename='', $stream=TRUE) {
	Dompdf\Autoloader::register();
	$options = new Dompdf\Options();
	$options->set('isRemoteEnabled', TRUE);
	$options->set('debugKeepTemp', TRUE);
	$options->set('isHtml5ParserEnabled', true);
	
	$dompdf = new Dompdf\Dompdf( $options );
	$dompdf->load_html($html);
	$dompdf->setPaper('A4', 'portrait');
	$dompdf->render();
	if ($stream) {
		$dompdf->stream($filename.".pdf");
	} else {
		return $dompdf->output();
	}
}?>