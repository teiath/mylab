<?php

class FindLabWorkersExt {
    
 public static function ExcelCreate($data){
     
     global $Options;
 
    $stringDate = date('dmYHis');
    $filename = "LabWorkers".$stringDate.".xlsx";
  
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
    $objPHPExcel->getActiveSheet()->setCellValue('A1', "Κωδικός Β.Δ. Εργαζομενου");
    $objPHPExcel->getActiveSheet()->setCellValue('B1', "Registry_Number Εργαζομενου");
    $objPHPExcel->getActiveSheet()->setCellValue('C1', "UID Εργαζομενου");
    $objPHPExcel->getActiveSheet()->setCellValue('D1', "Όνομα");
    $objPHPExcel->getActiveSheet()->setCellValue('E1', "Επίθετο");
    $objPHPExcel->getActiveSheet()->setCellValue('F1', "Όνομα Πατρός");
    $objPHPExcel->getActiveSheet()->setCellValue('G1', "Email");
    $objPHPExcel->getActiveSheet()->setCellValue('H1', "Ειδικότητα Εργαζόμενου");
    $objPHPExcel->getActiveSheet()->setCellValue('I1', "Πρωτογενής Πηγή");

//Loop throught data result of get api function
$i=2;
foreach($data["data"] as $worker_data)
{    

    $worker_id = $worker_data["worker_id"];
    $registry_no = $worker_data["registry_no"];
    $uid = $worker_data["uid"];
    $firstname = $worker_data["firstname"] ;
    $lastname = $worker_data["lastname"];
    $fathername = $worker_data["fathername"];
    $email = $worker_data["email"];
    $worker_specialization = $worker_data["workerSpecializationName"];
    $worker_lab_source = $worker_data["workerLabSourceName"];
 
    // Set values from get api function to excell cells
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, "$worker_id")
                                    ->setCellValue('B' . $i, "$registry_no")
                                    ->setCellValue('C' . $i, "$uid")
                                    ->setCellValue('D' . $i, "$firstname")
                                    ->setCellValue('E' . $i, "$lastname")
                                    ->setCellValue('F' . $i, "$fathername")
                                    ->setCellValue('G' . $i, "$email")
                                    ->setCellValue('H' . $i, "$worker_specialization")
                                    ->setCellValue('I' . $i, "$worker_lab_source")
            ;

    $i++;
}

    // Set auto size column width
    foreach(range('A','I') as $columnID) {
        $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
            ->setAutoSize(true);
    }
    
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    

//// Redirect output to a client’s web browser (Excel2007)
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

}
?>