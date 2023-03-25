<?php

include '../vendor/autoload.php';
include "./Constant.php";

session_start();

$phpWord = new \PhpOffice\PhpWord\PhpWord();

$section = $phpWord->addSection();
$fontStyle_1 = ['italic' => true, 'name' => 'Inter UI', 'size' => 16, 'color' => '000000', 'bold' => true];
$fontStyle_2 = ['name' => 'Inter UI', 'size' => 12, 'color' => '222222', 'bold' => true];
$fontStyle_3 = 'userDefinedStyle 3';
$phpWord->addFontStyle($fontStyle_3, array('name' => 'Vazir FD', 'size' => 8, 'color' => '777777', 'bold' => false));
$fontStyle_4 = ['name' => 'Inter UI', 'size' => 10, 'color' => '444444', 'bold' => true];
$fontStyle_5 = 'userDefinedStyle 5';
$phpWord->addFontStyle($fontStyle_5, array('name' => 'Inter UI', 'size' => 8, 'color' => 'dddddd', 'bold' => false));
foreach ($_SESSION["ExporterWord"] as $Ckey => $Cvalue) :
        if (!is_array($Cvalue)) :
                $phpWord->addTitleStyle(1, $fontStyle_1, array('alignment' => "center"));
                $section->addTitle($Cvalue, 1);
                $section->addTextBreak(2);
        else :
                $phpWord->addTitleStyle(2, $fontStyle_2);
                $section->addTitle($Cvalue["name"], 2);
                $section->addText(htmlspecialchars($Cvalue["create"], ENT_COMPAT, 'UTF-8'), $fontStyle_3);
                $section->addText(htmlspecialchars($Cvalue["update"], ENT_COMPAT, 'UTF-8'), $fontStyle_3);
                $section->addTextBreak(1);
                foreach ($Cvalue as $key => $value) :
                        if (is_array($value)) {
                                $phpWord->addTitleStyle(3, $fontStyle_4, array('alignment' => "left"));
                                $section->addTitle($value["name"], 3);
                                $section->addText($value["user"], $fontStyle_3);
                                $section->addText($value["pass"], $fontStyle_3);
                                $section->addText($value["discription"], $fontStyle_3);
                                $section->addText($value["create"], $fontStyle_3);
                                $section->addText($value["update"], $fontStyle_3);
                                $section->addTextBreak(1);
                        }
                endforeach;
                $section->addText("----------------------------------------------------------------------------------------------------", $fontStyle_5, array("alignment" => "center"));
                $section->addTextBreak(1);
        endif;
endforeach;
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('../' . Controller\Constant::EXPORTER_FILE . '/ExporterFile.docx');

$path = '../' . Controller\Constant::EXPORTER_FILE . '/ExporterFile.docx';
//Define header information
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: 0");
header('Content-Disposition: attachment; filename="' . basename($path) . '"');
header('Content-Length: ' . filesize($path));
header('Pragma: public');
flush();        //Clear system output buffer
readfile($path);        //Read the size of the file
// die();  //Terminate from the script

header("Location: " . Controller\Constant::URL);









// website : https://phpword.readthedocs.io/en/latest/

// // Creating the new document...
// $phpWord = new \PhpOffice\PhpWord\PhpWord();

// /* Note: any element you append to a document must reside inside of a Section. */

// // Adding an empty Section to the document...
// $section = $phpWord->addSection();
// // Adding Text element to the Section having font styled by default...
// $section->addText(
//     '"Learn from yesterday, live for today, hope for tomorrow. '
//         . 'The important thing is not to stop questioning." '
//         . '(Albert Einstein)'
// );

// /*
//  * Note: it's possible to customize font style of the Text element you add in three ways:
//  * - inline;
//  * - using named font style (new font style object will be implicitly created);
//  * - using explicitly created font style object.
//  */

// // Adding Text element with font customized inline...
// $section->addText(
//     '"Great achievement is usually born of great sacrifice, '
//         . 'and is never the result of selfishness." '
//         . '(Napoleon Hill)',
//     array('name' => 'Tahoma', 'size' => 10)
// );

// // Adding Text element with font customized using named font style...
// $fontStyleName = 'oneUserDefinedStyle';
// $phpWord->addFontStyle(
//     $fontStyleName,
//     array('name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true)
// );
// $section->addText(
//     '"The greatest accomplishment is not in never falling, '
//         . 'but in rising again after you fall." '
//         . '(Vince Lombardi)',
//     $fontStyleName
// );

// // Adding Text element with font customized using explicitly created font style object...
// $fontStyle = new \PhpOffice\PhpWord\Style\Font();
// $fontStyle->setBold(true);
// $fontStyle->setName('Tahoma');
// $fontStyle->setSize(13);
// $myTextElement = $section->addText('"Believe you can and you\'re halfway there." (Theodor Roosevelt)');
// $myTextElement->setFontStyle($fontStyle);

// // Saving the document as OOXML file...
// $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
// $objWriter->save('helloWorld.docx');

// // Saving the document as ODF file...
// $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
// $objWriter->save('helloWorld.odt');

// // Saving the document as HTML file...
// $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
// $objWriter->save('helloWorld.html');

// /* Note: we skip RTF, because it's not XML-based and requires a different example. */
// /* Note: we skip PDF, because "HTML-to-PDF" approach is used to create PDF documents. */