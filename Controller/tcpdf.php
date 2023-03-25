<?php

include_once "../vendor/autoload.php";

session_start();

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Hosein Abdollahpoor');
$pdf->SetTitle('Content Management');
$pdf->SetSubject('Export Content with tecnickcom/tcpdf');
$pdf->SetKeywords('TCPDF, PDF');

// set default header data
// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 018', PDF_HEADER_STRING);
$pdf->SetHeaderData(PDF_HEADER_LOGO, 20, "Export Content with tecnickcom/tcpdf" . '', "Content Management\nby Hosein Abdollahpoor");

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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

// set some language dependent data:
$lg = array();
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_dir'] = 'ltr';
$lg['a_meta_language'] = 'fa';
$lg['w_page'] = 'page';

// set some language-dependent strings (optional)
$pdf->setLanguageArray($lg);

// set font
$pdf->SetFont('dejavusans', '', 12);

// add a page
$pdf->AddPage();

// Persian and English content
$htmlpersian = $_SESSION["ExporterPdf"];
$pdf->WriteHTML($htmlpersian, true, 0, true, 0);

// set font
$pdf->SetFont('aefurat', '', 18);

// print newline
$pdf->Ln();

//Close and output PDF document
$pdf->Output('ExporterPdf.pdf', 'I');


// website : https://tcpdf.org/docs/