<?php

class SearchLabWorkersExt {
    
 public static function ExcelCreate($data){

    global $Options;
 
    $stringDate = date('dmYHis');
    $filename = "LabWorkers".$stringDate.".xlsx";
  
    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel();

    // Set document properties
    $objPHPExcel->getProperties()->setCreator("MyLab Administrator")
                                 ->setTitle("MyLab Report")
                                 ->setSubject("LabWorkers Report")
                                 ->setDescription("First level xls data. on-the-fly (NOT Saved at server folder). Works only with web browser.");
    // Set format codes 
    $objPHPExcel->getDefaultStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

    // Create a first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->setCellValue('A1', "lab_worker_id");
    $objPHPExcel->getActiveSheet()->setCellValue('B1', "worker_status");
    $objPHPExcel->getActiveSheet()->setCellValue('C1', "worker_start_service");
    $objPHPExcel->getActiveSheet()->setCellValue('D1', "registry_no");
    $objPHPExcel->getActiveSheet()->setCellValue('E1', "tax_number");
    $objPHPExcel->getActiveSheet()->setCellValue('F1', "firstname");
    $objPHPExcel->getActiveSheet()->setCellValue('G1', "lastname");
    $objPHPExcel->getActiveSheet()->setCellValue('H1', "fathername");
    $objPHPExcel->getActiveSheet()->setCellValue('I1', "worker_specialization");
    $objPHPExcel->getActiveSheet()->setCellValue('J1', "worker_position");
    $objPHPExcel->getActiveSheet()->setCellValue('K1', "lab_id");
    $objPHPExcel->getActiveSheet()->setCellValue('L1', "lab");
    $objPHPExcel->getActiveSheet()->setCellValue('M1', "special_name");
    $objPHPExcel->getActiveSheet()->setCellValue('N1', "lab_state");
    $objPHPExcel->getActiveSheet()->setCellValue('O1', "school_unit_id");
    $objPHPExcel->getActiveSheet()->setCellValue('P1', "school_unit");
    $objPHPExcel->getActiveSheet()->setCellValue('Q1', "school_unit_state");
    $objPHPExcel->getActiveSheet()->setCellValue('R1', "region_edu_admin");
    $objPHPExcel->getActiveSheet()->setCellValue('S1', "edu_admin");
    $objPHPExcel->getActiveSheet()->setCellValue('T1', "transfer_area");

    //Loop throught data result of get api function
    $i=2;
    foreach($data["data"] as $worker_data)
    {    

        $lab_worker_id = $worker_data["lab_worker_id"];
        $worker_status = $worker_data["worker_status"];
        $worker_start_service = $worker_data["worker_start_service"];
        $registry_no = $worker_data["registry_no"];
        $tax_number = $worker_data["tax_number"];
        $firstname = $worker_data["firstname"] ;
        $lastname = $worker_data["lastname"];
        $fathername = $worker_data["fathername"];
        $worker_specialization = $worker_data["worker_specialization"];
        $worker_position = $worker_data["worker_position"];
        $lab_id = $worker_data["lab_id"];
        $lab = $worker_data["lab"];
        $special_name = $worker_data["special_name"];
        $lab_state = $worker_data["lab_state"];
        $school_unit_id = $worker_data["school_unit_id"];
        $school_unit = $worker_data["school_unit"];
        $school_unit_state = $worker_data["school_unit_state"];
        $region_edu_admin = $worker_data["region_edu_admin"];
        $edu_admin = $worker_data["edu_admin"];
        $transfer_area = $worker_data["transfer_area"];

        // Set values from get api function to excell cells
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, "$lab_worker_id")
                                        ->setCellValue('B' . $i, "$worker_status")
                                        ->setCellValue('C' . $i, "$worker_start_service")
                                        ->setCellValueExplicit('D' . $i, "$registry_no", PHPExcel_Cell_DataType::TYPE_STRING)
                                        ->setCellValueExplicit('E' . $i,"$tax_number", PHPExcel_Cell_DataType::TYPE_STRING) 
                                        ->setCellValue('F' . $i, "$firstname")
                                        ->setCellValue('G' . $i, "$lastname")
                                        ->setCellValue('H' . $i, "$fathername")
                                        ->setCellValue('I' . $i, "$worker_specialization")
                                        ->setCellValue('J' . $i, "$worker_position")
                                        ->setCellValue('K' . $i, "$lab_id")
                                        ->setCellValue('L' . $i, "$lab")
                                        ->setCellValue('M' . $i, "$special_name")
                                        ->setCellValue('N' . $i, "$lab_state")
                                        ->setCellValue('O' . $i, "$school_unit_id")
                                        ->setCellValue('P' . $i, "$school_unit")
                                        ->setCellValue('Q' . $i, "$school_unit_state")
                                        ->setCellValue('R' . $i, "$region_edu_admin")
                                        ->setCellValue('S' . $i, "$edu_admin")
                                        ->setCellValue('T' . $i, "$transfer_area")
                ;

        $i++;

    }

    // Set auto size column width
    foreach(range('A','T') as $columnID) {
        $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
            ->setAutoSize(true);
    }
    
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);

//    // Redirect output to a client’s web browser (Excel2007)
//    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//    header("Content-Disposition: attachment;filename=\"".$filename."\"");
//    header('Cache-Control: max-age=0');
//    // If you're serving to IE 9, then the following may be needed
//    header('Cache-Control: max-age=1');
//
//    // Save Excel 2007 file
//    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//    $objWriter->save('php://output');
    
    // Save Excel 2007 file
    $file = $Options["TmpFolder"].$filename;
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save(str_replace('.php', '.xlsx', $file));

    return $filename;
}

public static function PdfCreate($data){

require_once('../server/libs/PHPExcel/Classes/PHPExcel.php');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

if (PHP_SAPI == 'cli')
    die('This function should only be run from a Web Browser');

$rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
$rendererLibrary = 'tcpdf';
$rendererLibraryPath =  '../server/libs/' . $rendererLibrary;

$stringDate = date('dmYHis');
$filename = "LabWorkers".$stringDate.".pdf";
   
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("MyLab Administrator")
                             ->setTitle("MyLab Report")
                             ->setSubject("LabWorker Report")
                             ->setDescription("First level pdf data. on-the-fly (NOT Saved at server folder). Works only with web browser.");
// Set format codes 
$objPHPExcel->getDefaultStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);



// Create a first sheet
$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet()->setCellValue('A1', "lab_worker_id");
$objPHPExcel->getActiveSheet()->setCellValue('B1', "worker_status");
$objPHPExcel->getActiveSheet()->setCellValue('C1', "worker_start_service");
$objPHPExcel->getActiveSheet()->setCellValue('D1', "registry_no");
$objPHPExcel->getActiveSheet()->setCellValue('E1', "tax_number");
$objPHPExcel->getActiveSheet()->setCellValue('F1', "firstname");
$objPHPExcel->getActiveSheet()->setCellValue('G1', "lastname");
$objPHPExcel->getActiveSheet()->setCellValue('H1', "fathername");
$objPHPExcel->getActiveSheet()->setCellValue('I1', "worker_specialization");
$objPHPExcel->getActiveSheet()->setCellValue('J1', "worker_position");
$objPHPExcel->getActiveSheet()->setCellValue('K1', "lab_id");
$objPHPExcel->getActiveSheet()->setCellValue('L1', "lab");
$objPHPExcel->getActiveSheet()->setCellValue('M1', "special_name");
$objPHPExcel->getActiveSheet()->setCellValue('N1', "lab_state");
$objPHPExcel->getActiveSheet()->setCellValue('O1', "school_unit_id");
$objPHPExcel->getActiveSheet()->setCellValue('P1', "school_unit");
$objPHPExcel->getActiveSheet()->setCellValue('Q1', "school_unit_state");
$objPHPExcel->getActiveSheet()->setCellValue('R1', "region_edu_admin");
$objPHPExcel->getActiveSheet()->setCellValue('S1', "edu_admin");
$objPHPExcel->getActiveSheet()->setCellValue('T1', "transfer_area");

//Loop throught data result of get api function
$i=2;
foreach($data["data"] as $worker_data)
{    

    $lab_worker_id = $worker_data["lab_worker_id"];
    $worker_status = $worker_data["worker_status"];
    $worker_start_service = $worker_data["worker_start_service"];
    $registry_no = $worker_data["registry_no"];
    $tax_number = $worker_data["tax_number"];
    $firstname = $worker_data["firstname"] ;
    $lastname = $worker_data["lastname"];
    $fathername = $worker_data["fathername"];
    $worker_specialization = $worker_data["worker_specialization"];
    $worker_position = $worker_data["worker_position"];
    $lab_id = $worker_data["lab_id"];
    $lab = $worker_data["lab"];
    $special_name = $worker_data["special_name"];
    $lab_state = $worker_data["lab_state"];
    $school_unit_id = $worker_data["school_unit_id"];
    $school_unit = $worker_data["school_unit"];
    $school_unit_state = $worker_data["school_unit_state"];
    $region_edu_admin = $worker_data["region_edu_admin"];
    $edu_admin = $worker_data["edu_admin"];
    $transfer_area = $worker_data["transfer_area"];
 
    // Set values from get api function to excell cells
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, "$lab_worker_id")
                                    ->setCellValue('B' . $i, "$worker_status")
                                    ->setCellValue('C' . $i, "$worker_start_service")
                                    ->setCellValueExplicit('D' . $i, "$registry_no", PHPExcel_Cell_DataType::TYPE_STRING)
                                    ->setCellValueExplicit('E' . $i,"$tax_number", PHPExcel_Cell_DataType::TYPE_STRING) 
                                    ->setCellValue('F' . $i, "$firstname")
                                    ->setCellValue('G' . $i, "$lastname")
                                    ->setCellValue('H' . $i, "$fathername")
                                    ->setCellValue('I' . $i, "$worker_specialization")
                                    ->setCellValue('J' . $i, "$worker_position")
                                    ->setCellValue('K' . $i, "$lab_id")
                                    ->setCellValue('L' . $i, "$lab")
                                    ->setCellValue('M' . $i, "$special_name")
                                    ->setCellValue('N' . $i, "$lab_state")
                                    ->setCellValue('O' . $i, "$school_unit_id")
                                    ->setCellValue('P' . $i, "$school_unit")
                                    ->setCellValue('Q' . $i, "$school_unit_state")
                                    ->setCellValue('R' . $i, "$region_edu_admin")
                                    ->setCellValue('S' . $i, "$edu_admin")
                                    ->setCellValue('T' . $i, "$transfer_area")
            ;

    $i++;

}

// Set auto size column width
foreach(range('A','T') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
}

// Set header and footer. When no different headers for odd/even are used, odd header is assumed.
//$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('TestHeader');
//$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('TestFooterStart' . $objPHPExcel->getProperties()->getTitle() . 'TestFooterEnd');

// Set page orientation , size and page margins
// remember external pdf libraries as tcpdf,dompdf e.t.c
// not works with print properties(fit to page,zoom)
// one solution to use print properties is convertion of array to html to pdf   
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
//$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.1); 
//$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.1); 
//$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.1); 
//$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.1);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

if (!PHPExcel_Settings::setPdfRenderer(
		$rendererName,
		$rendererLibraryPath
	)) {
	die(
		'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
		'<br />' .
		'at the top of this script as appropriate for your directory structure'
	);
}

// Redirect output to a client’s web browser (PDF)
header('Content-Type: application/pdf');
header("Content-Disposition: attachment;filename=\"".$filename."\"");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
$objWriter->save('php://output');

}

}
?>