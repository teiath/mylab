<?php

class SearchSchoolUnitsExt {
    
 public static function ExcelCreate($data){

    define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

    if (PHP_SAPI == 'cli')
        die('This function should only be run from a Web Browser');
 
    $stringDate = date('dmYHis');
    $filename = "SchoolUnits".$stringDate.".xlsx";
  
    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel();

    // Set document properties
    $objPHPExcel->getProperties()->setCreator("MyLab Administrator")
                                 ->setTitle("MyLab Report")
                                 ->setSubject("SchoolUnits Report")
                                 ->setDescription("First level xls data. on-the-fly (NOT Saved at server folder). Works only with web browser.");
    // Set format codes 
    $objPHPExcel->getDefaultStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

    // Create a first sheet
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('A1', "school_unit_id");
$objPHPExcel->getActiveSheet()->setCellValue('B1', "school_unit_name");
$objPHPExcel->getActiveSheet()->setCellValue('C1', "school_unit_special_name");
$objPHPExcel->getActiveSheet()->setCellValue('D1', "region_edu_admin");
$objPHPExcel->getActiveSheet()->setCellValue('E1', "edu_admin");
$objPHPExcel->getActiveSheet()->setCellValue('F1', "transfer_area");
$objPHPExcel->getActiveSheet()->setCellValue('G1', "municipality");
$objPHPExcel->getActiveSheet()->setCellValue('H1', "prefecture");
$objPHPExcel->getActiveSheet()->setCellValue('I1', "education_level");
$objPHPExcel->getActiveSheet()->setCellValue('J1', "school_unit_type");
$objPHPExcel->getActiveSheet()->setCellValue('K1', "school_unit_state");

//Loop throught data result of get api function
$i=2;
foreach($data["data"] as $school_unit_data)
{    

    $school_unit_id = $school_unit_data["school_unit_id"];
    $school_unit_name = $school_unit_data["school_unit_name"];
    $school_unit_special_name = $school_unit_data["school_unit_special_name"];
    $region_edu_admin = $school_unit_data["region_edu_admin"];
    $edu_admin = $school_unit_data["edu_admin"];
    $transfer_area = $school_unit_data["transfer_area"];
    $municipality = $school_unit_data["municipality"];
    $prefecture = $school_unit_data["prefecture"];
    $education_level = $school_unit_data["education_level"];
    $school_unit_type = $school_unit_data["school_unit_type"];
    $school_unit_state = $school_unit_data["school_unit_state"];
 
    // Set values from get api function to excell cells
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, "$school_unit_id")
                                    ->setCellValue('B' . $i, "$school_unit_name")
                                    ->setCellValue('C' . $i, "$school_unit_special_name")
                                    ->setCellValue('D' . $i, "$region_edu_admin")
                                    ->setCellValue('E' . $i, "$edu_admin")
                                    ->setCellValue('F' . $i, "$transfer_area")
                                    ->setCellValue('G' . $i, "$prefecture")
                                    ->setCellValue('H' . $i, "$municipality")
                                    ->setCellValue('I' . $i, "$education_level")
                                    ->setCellValue('J' . $i, "$school_unit_type")
                                    ->setCellValue('K' . $i, "$school_unit_state")
            ;

    $i++;

}

    // Set auto size column width
    foreach(range('A','K') as $columnID) {
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