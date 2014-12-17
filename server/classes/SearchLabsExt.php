<?php

class SearchLabsExt {
    
 public static function ExcelCreate($data){
     
     global $Options;
 
    $stringDate = date('dmYHis');
    $filename = "Labs".$stringDate.".xlsx";
  
    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel();

    // Set document properties
    $objPHPExcel->getProperties()->setCreator("MyLab Administrator")
                                 ->setTitle("MyLab Labs xlsx")
                                 ->setSubject("Export Labs xlsx format")
                                 ->setDescription("First level xls data. Saved at server folder.");
    // Set format codes 
    $objPHPExcel->getDefaultStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    
    // Create a first sheet
    $objPHPExcel->getActiveSheet()->setCellValue('A1', "Κωδικός Διάταξης Η/Υ");
    $objPHPExcel->getActiveSheet()->setCellValue('B1', "Όνομασία Διάταξης Η/Υ");
    $objPHPExcel->getActiveSheet()->setCellValue('C1', "Ειδική Όνομασία Διάταξης Η/Υ");
    $objPHPExcel->getActiveSheet()->setCellValue('D1', "Τοποθεσία");
    $objPHPExcel->getActiveSheet()->setCellValue('E1', "Λειτουργικός Δείκτης");
    $objPHPExcel->getActiveSheet()->setCellValue('F1', "Τεχνολογικός Δείκτης");
    $objPHPExcel->getActiveSheet()->setCellValue('G1', "Τύπος Διάταξης Η/Υ");
    $objPHPExcel->getActiveSheet()->setCellValue('H1', "'Όνομα Σχολικής Μονάδας ");
    $objPHPExcel->getActiveSheet()->setCellValue('I1', "Πρωτογενής Πηγή Διάταξης Η/Υ");
    $objPHPExcel->getActiveSheet()->setCellValue('J1', "Λειτουργική Κατάσταση Διάταξης Η/Υ");
    $objPHPExcel->getActiveSheet()->setCellValue('K1', "Λειτουργική Κατάσταση Σχολικής Μονάδας");
    $objPHPExcel->getActiveSheet()->setCellValue('L1', "Περιφερειακή Διεύθυνση Εκπαίδευσης");
    $objPHPExcel->getActiveSheet()->setCellValue('M1', "Διευθύνση Εκπαίδευσης");
    $objPHPExcel->getActiveSheet()->setCellValue('N1', "Περιοχή Μετάθεσης");
    $objPHPExcel->getActiveSheet()->setCellValue('O1', "Δήμος");
    $objPHPExcel->getActiveSheet()->setCellValue('P1', "Περιφερειακή Ενότητα");
    $objPHPExcel->getActiveSheet()->setCellValue('Q1', "Βαθμίδα Εκπαίδευσης");
    $objPHPExcel->getActiveSheet()->setCellValue('R1', "Τύπος Σχολικής Μονάδας");

    //Loop throught data result of get api function
    $i=2;
    foreach($data["data"] as $lab_data)
    {    

        // Set values from get api function to excell cells
        $objPHPExcel->getActiveSheet()->setCellValue("A$i", $lab_data["lab_id"]);
        $objPHPExcel->getActiveSheet()->setCellValue("B$i", $lab_data["lab_name"]);
        $objPHPExcel->getActiveSheet()->setCellValue("C$i", $lab_data["lab_special_name"]);
        $objPHPExcel->getActiveSheet()->setCellValue("D$i", $lab_data["positioning"]);
        $objPHPExcel->getActiveSheet()->setCellValue("E$i", $lab_data["operational_rating"]);
        $objPHPExcel->getActiveSheet()->setCellValue("F$i", $lab_data["technological_rating"]);
        $objPHPExcel->getActiveSheet()->setCellValue("G$i", $lab_data["lab_type"]);
        $objPHPExcel->getActiveSheet()->setCellValue("H$i", $lab_data["school_unit_name"]);
        $objPHPExcel->getActiveSheet()->setCellValue("I$i", $lab_data["lab_source"]);
        $objPHPExcel->getActiveSheet()->setCellValue("J$i", $lab_data["lab_state"]);
        $objPHPExcel->getActiveSheet()->setCellValue("K$i", $lab_data["school_unit_state"]);
        $objPHPExcel->getActiveSheet()->setCellValue("L$i", $lab_data["region_edu_admin"]);
        $objPHPExcel->getActiveSheet()->setCellValue("M$i", $lab_data["edu_admin"]);
        $objPHPExcel->getActiveSheet()->setCellValue("N$i", $lab_data["transfer_area"]);
        $objPHPExcel->getActiveSheet()->setCellValue("O$i", $lab_data["prefecture"]);
        $objPHPExcel->getActiveSheet()->setCellValue("P$i", $lab_data["municipality"]);
        $objPHPExcel->getActiveSheet()->setCellValue("Q$i", $lab_data["education_level"]);
        $objPHPExcel->getActiveSheet()->setCellValue("R$i", $lab_data["school_unit_type"]);

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