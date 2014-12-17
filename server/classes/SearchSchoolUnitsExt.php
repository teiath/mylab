<?php

class SearchSchoolUnitsExt {
    
 public static function ExcelCreate($data){

    global $Options;
 
    $stringDate = date('dmYHis');
    $filename = "SchoolUnits".$stringDate.".xlsx";
  
    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel();

    // Set document properties
    $objPHPExcel->getProperties()->setCreator("MyLab Administrator")
                                 ->setTitle("MyLab SchoolUnits xlsx")
                                 ->setSubject("Export SchoolUnits xlsx format")
                                 ->setDescription("First level xls data. Saved at server folder.");
    // Set format codes 
    $objPHPExcel->getDefaultStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    
    // Create a first sheet
    $objPHPExcel->getActiveSheet()->setCellValue('A1', "Κωδικός ΜΜ (Μητρώο Μονάδων)");
    $objPHPExcel->getActiveSheet()->setCellValue('B1', "'Όνομα");
    $objPHPExcel->getActiveSheet()->setCellValue('C1', "Ειδικό Όνομα");
    $objPHPExcel->getActiveSheet()->setCellValue('D1', "Περιφέρεια");
    $objPHPExcel->getActiveSheet()->setCellValue('E1', "Διευθύνση Εκπαίδευσης");
    $objPHPExcel->getActiveSheet()->setCellValue('F1', "Περιοχή Μετάθεσης");
    $objPHPExcel->getActiveSheet()->setCellValue('G1', "Δήμος ΟΤΑ");
    $objPHPExcel->getActiveSheet()->setCellValue('H1', "Νομός");
    $objPHPExcel->getActiveSheet()->setCellValue('I1', "Επίπεδο Εκπαίδευσης");
    $objPHPExcel->getActiveSheet()->setCellValue('J1', "Τύπος");
    $objPHPExcel->getActiveSheet()->setCellValue('K1', "Λειτουργική Κατάσταση");

    //Loop throught data result of get api function
    $i=2;
    foreach($data["data"] as $school_unit_data)
    {    
        // Set values from get api function to excell cells
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $school_unit_data["school_unit_id"]);
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $school_unit_data["school_unit_name"]);
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $school_unit_data["school_unit_special_name"]);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $school_unit_data["region_edu_admin"]);
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $school_unit_data["edu_admin"]);
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $school_unit_data["transfer_area"]);
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $school_unit_data["prefecture"]);
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $school_unit_data["municipality"]);
        $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $school_unit_data["education_level"]);
        $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $school_unit_data["school_unit_type"]);
        $objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $school_unit_data["school_unit_state"]);

        $i++;
    }
    
    // Save Excel 2007 file
    $file = $Options["TmpFolder"].$filename;
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save($file);

    return $filename;
    
}

}
?>