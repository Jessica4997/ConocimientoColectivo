<?php
//============================================================+
// File name   : example_005.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 005 for TCPDF class
//               Multicell
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Multicell
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
//require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Conocimiento Colectivo');
$pdf->SetTitle('Conocimiento Colectivo');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 005', PDF_HEADER_STRING);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 10);

// add a page
$pdf->AddPage();

// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->SetFillColor(255, 255, 127);

// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
$title = <<<OED
<h2>REPORTE CONOCIMIENTO COLECTIVO</h2>
OED;

$pdf->WriteHTMLCell(0, 0, '', '', $title, 0, 1, 0, true, 'C', true);

$subtitle1 = <<<OE
<h3>Inscripciones a Talleres en el mes de Junio</h3>
OE;
$pdf->WriteHTMLCell(0, 0, '', '', $subtitle1, 0, 1, 0, true, 'C', true);

$total_inscriptions = '<h4>Total de Inscripciones: </h4>'.$inscription_number;
$pdf->WriteHTMLCell(0, 0, '', '', $total_inscriptions, 0, 1, 0, true, 'C', true);

$table = '<table style="border:1px solid #000; padding:6px;">';
$table .= '<tr>
				<th style="border:1px solid #000">Estado</th>
				<th style="border:1px solid #000">Nombres</th>
				<th style="border:1px solid #000">Taller</th>
				<th style="border:1px solid #000">Categorías</th>
		   </tr>';

		   foreach($inscriptions_month as $rows){
$table .=	'<tr>
			   <td>' .$rows['iu_status']. '</td>
			   <td>' .$rows['u_name'].' '.$rows['u_last_name'] . '</td>
			   <td>' .$rows['w_title']. '</td>
	     	   <td>' .$rows['c_name'].'-'. $rows['sc_name']. '</td>
    	   </tr>';
		   }
$table .= '</table>';

$pdf->WriteHTMLCell(0, 0, '', '', $table, 0, 1, true, 'C', true);





$subtitle2 = <<<OE
<br pagebreak="true" /> <h3>Solicitudes de Talleres en el mes de Junio</h3>
OE;
$pdf->WriteHTMLCell(0, 0, '', '', $subtitle2, 0, 1, 0, true, 'C', true);

$workshops_request = '<h4>Total de Solicitudes de Talleres: </h4>'.$pw_number;
$pdf->WriteHTMLCell(0, 0, '', '', $workshops_request, 0, 1, 0, true, 'C', true);

$table2 = '<table style="border:1px solid #000; padding:6px;">';
$table2 .= '<tr>
				<th style="border:1px solid #000">Taller</th>
				<th style="border:1px solid #000">Categoría</th>
				<th style="border:1px solid #000">Creado por</th>
				<th style="border:1px solid #000">Cantidad de Votos</th>
				<th style="border:1px solid #000">Estado de la Solicitud</th>
		   </tr>';

		   foreach($pw_month as $rows){
$table2 .=	'<tr>
			   <td>' .$rows['title']. '</td>
			   <td>' .$rows['c_name'] .'-'. $rows['sc_name']. '</td>
			   <td>' .$rows['u_name'].' '.$rows['u_last_name']. '</td>
	     	   <td>' .$rows['votes_quantity']. '</td>
	     	   <td>' .$rows['pw_status']. '</td>
    	   </tr>';
		   }
$table2 .= '</table>';

$pdf->WriteHTMLCell(0, 0, '', '', $table2, 0, 1, true, 'C', true);




$subtitle3 = <<<OE
<br pagebreak="true" /> <h3>Solicitudes de Talleres en el mes de Junio</h3>
OE;
$pdf->WriteHTMLCell(0, 0, '', '', $subtitle3, 0, 1, 0, true, 'C', true);

$subcategories_request = '<h4>Total de Solicitudes de Temas: </h4>'.$psc_number;
$pdf->WriteHTMLCell(0, 0, '', '', $subcategories_request, 0, 1, 0, true, 'C', true);

$table3 = '<table style="border:1px solid #000; padding:6px;">';
$table3 .= '<tr>
				<th style="border:1px solid #000">Subcategoría Propuesta</th>
				<th style="border:1px solid #000">Categoría Principal</th>
				<th style="border:1px solid #000">Creado por</th>
				<th style="border:1px solid #000">Cantidad de Votos</th>
				<th style="border:1px solid #000">Estado de la Solicitud</th>
		   </tr>';

		   foreach($psc_month as $rows){
$table3 .=	'<tr>
			   <td>' .$rows['name']. '</td>
			   <td>' .$rows['c_name']. '</td>
			   <td>' .$rows['u_name'].' '.$rows['u_last_name']. '</td>
	     	   <td>' .$rows['votes_quantity']. '</td>
	     	   <td>' .$rows['psc_status']. '</td>
    	   </tr>';
		   }
$table3 .= '</table>';

$pdf->WriteHTMLCell(0, 0, '', '', $table3, 0, 1, true, 'C', true);




$subtitle4 = <<<OE
<br pagebreak="true" /> <h3>Usuarios Registrados en el mes de Junio</h3>
OE;
$pdf->WriteHTMLCell(0, 0, '', '', $subtitle4, 0, 1, 0, true, 'C', true);

$registers = '<h4>Total de Solicitudes de Temas: </h4>'.$users_number;
$pdf->WriteHTMLCell(0, 0, '', '', $subcategories_request, 0, 1, 0, true, 'C', true);

$table4 = '<table style="border:1px solid #000; padding:6px;">';
$table4 .= '<tr>
				<th style="border:1px solid #000">Nombres</th>
				<th style="border:1px solid #000">Email</th>
				<th style="border:1px solid #000">Fecha de Nacimiento</th>
				<th style="border:1px solid #000">Género</th>
				<th style="border:1px solid #000">Calificación</th>
		   </tr>';

		   foreach($users_month as $rows){
$table4 .=	'<tr>
			   <td>' .$rows['name'].' '.$rows['last_name']. '</td>
			   <td>' .$rows['email']. '</td>
			   <td>' .date("d-m-Y",strtotime($rows['date_birth'])). '</td>
	     	   <td>' .$rows['gender']. '</td>
	     	   <td>' .$rows['student_rating']. '</td>
    	   </tr>';
		   }
$table4 .= '</table>';

$pdf->WriteHTMLCell(0, 0, '', '', $table4, 0, 1, true, 'C', true);
// move pointer to last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
ob_clean();
$pdf->Output('reporte.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+


