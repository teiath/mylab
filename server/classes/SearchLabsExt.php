<?php

class SearchLabsExt {
    
 public static function ExcelCreate($data){

    require_once('../server/libs/PHPExcel/Classes/PHPExcel.php');

    define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

    if (PHP_SAPI == 'cli')
        die('This function should only be run from a Web Browser');
 
    $stringDate = date('dmYHis');
    $filename = "Labs".$stringDate.".xlsx";
  
    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel();

    // Set document properties
    $objPHPExcel->getProperties()->setCreator("MyLab Administrator")
                                 ->setTitle("MyLab Report")
                                 ->setSubject("Labs Report")
                                 ->setDescription("First level xls data. on-the-fly (NOT Saved at server folder). Works only with web browser.");
    // Set format codes 
    $objPHPExcel->getDefaultStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

    // Create a first sheet
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1', "lab_id");
$objPHPExcel->getActiveSheet()->setCellValue('B1', "lab");
$objPHPExcel->getActiveSheet()->setCellValue('C1', "special_name");
$objPHPExcel->getActiveSheet()->setCellValue('D1', "positioning");
$objPHPExcel->getActiveSheet()->setCellValue('E1', "operational_rating");
$objPHPExcel->getActiveSheet()->setCellValue('F1', "technological_rating");
$objPHPExcel->getActiveSheet()->setCellValue('G1', "lab_type");
$objPHPExcel->getActiveSheet()->setCellValue('H1', "school_unit");
$objPHPExcel->getActiveSheet()->setCellValue('I1', "lab_source");
$objPHPExcel->getActiveSheet()->setCellValue('J1', "lab_state");
$objPHPExcel->getActiveSheet()->setCellValue('K1', "school_unit_state");
$objPHPExcel->getActiveSheet()->setCellValue('L1', "region_edu_admin");
$objPHPExcel->getActiveSheet()->setCellValue('M1', "edu_admin");
$objPHPExcel->getActiveSheet()->setCellValue('N1', "transfer_area");
$objPHPExcel->getActiveSheet()->setCellValue('O1', "prefecture");
$objPHPExcel->getActiveSheet()->setCellValue('P1', "municipality");
$objPHPExcel->getActiveSheet()->setCellValue('Q1', "education_level");
$objPHPExcel->getActiveSheet()->setCellValue('R1', "school_unit_type");

//Loop throught data result of get api function
$i=2;
foreach($data["data"] as $lab_data)
{    

    $lab_id = $lab_data["lab_id"];
    $lab = $lab_data["lab"];
    $special_name = $lab_data["special_name"];
    $positioning = $lab_data["positioning"];
    $operational_rating = $lab_data["operational_rating"];
    $technological_rating = $lab_data["technological_rating"] ;
    $lab_type = $lab_data["lab_type"];
    $school_unit = $lab_data["school_unit"];
    $lab_source = $lab_data["lab_source"];
    $lab_state = $lab_data["lab_state"];
    $school_unit_state = $lab_data["school_unit_state"];
    $region_edu_admin = $lab_data["region_edu_admin"];
    $edu_admin = $lab_data["edu_admin"];
    $transfer_area = $lab_data["transfer_area"];
    $prefecture = $lab_data["prefecture"];
    $municipality = $lab_data["municipality"];
    $education_level = $lab_data["education_level"];
    $school_unit_type = $lab_data["school_unit_type"];
 
    // Set values from get api function to excell cells
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, "$lab_id")
                                    ->setCellValue('B' . $i, "$lab")
                                    ->setCellValue('C' . $i, "$special_name")
                                    ->setCellValue('D' . $i, "$positioning")
                                    ->setCellValue('E' . $i, "$operational_rating")
                                    ->setCellValue('F' . $i, "$technological_rating")
                                    ->setCellValue('G' . $i, "$lab_type")
                                    ->setCellValue('H' . $i, "$school_unit")
                                    ->setCellValue('I' . $i, "$lab_source")
                                    ->setCellValue('J' . $i, "$lab_state")
                                    ->setCellValue('K' . $i, "$school_unit_state")
                                    ->setCellValue('L' . $i, "$region_edu_admin")
                                    ->setCellValue('M' . $i, "$edu_admin")
                                    ->setCellValue('N' . $i, "$transfer_area")
                                    ->setCellValue('O' . $i, "$prefecture")
                                    ->setCellValue('P' . $i, "$municipality")
                                    ->setCellValue('Q' . $i, "$education_level")
                                    ->setCellValue('R' . $i, "$school_unit_type")
            ;

    $i++;

}

    // Set auto size column width
    foreach(range('A','R') as $columnID) {
        $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
            ->setAutoSize(true);
    }
    
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);

    // Redirect output to a client’s web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment;filename=\"".$filename."\"");
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');

    // Save Excel 2007 file
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    
}

}
?>