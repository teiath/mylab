<?php

class StatLabsExt {
    
 public static function multiKeyExists( Array $array, $key ) {
        if (array_key_exists($key, $array)) {
            return true;
        }
        foreach ($array as $k=>$v) {
            if (!is_array($v)) {
                continue;
            }
            if (array_key_exists($key, $v)) {
                return true;
            }
        }
    return false;
    } 
    
 public static function ExcelCreate($data, $x_axis, $y_axis){
     
    global $Options;
 
    $stringDate = date('dmYHis');
    $filename = "StatLabs".$stringDate.".xlsx";   
    $AxisAndFilters = " X Άξονας = $x_axis\n Y Άξονας = $y_axis" ;
      
    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel();

    // Set document properties
    $objPHPExcel->getProperties()->setCreator("MyLab Administrator")
                                 ->setTitle("MyLab Stats")
                                 ->setSubject("Labs Statistics")
                                 ->setDescription("Added xy axis statistic data to xls format. Saved at server folder.");
    // Set format codes 
    $objPHPExcel->getDefaultStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

    // Create a first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->setCellValue('A1', $AxisAndFilters );
    $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);

    //get row cell 
    $xStartRow = 'B'; //B1->C1->D1....
    $yStartRow = 2;   //A2->A3->A4....
   
    $create_x_axis = $all_x_axis = array();
    $create_y_axis = $all_y_axis = array();
        
    foreach($data["results"] as $result)
    { 

        $xname = $result[$x_axis.'_name'];
        $yname = $result[$y_axis.'_name'];
        
       //array transformation
            //create x axis row
            if (!array_search($xname, $all_x_axis)) {
                $xRow = $xStartRow++ ;
                $xResult = $xRow. '1';
                $all_x_axis[] = $xname;
                $create_x_axis[$xname] = array(  $xname => $xResult,
                                            'x_row' => $xRow
                                          );
//                print_r($all_x_axis); 
//                print_r($create_x_axis); 
            } else {
               $xRow = $create_x_axis[$xname]['x_row'];
               $xResult = $create_x_axis[$xname][$xname];
//            die();
               
            }

            //create y axis row
            if (!array_search($yname, $all_y_axis)) {
                $yRow = $yStartRow++;
                $yResult = 'A' . $yRow;
                $all_y_axis[] = $yname;
                $create_y_axis[$yname] = array(  $yname => $yResult,
                                            'y_row' => $yRow
                                         );
            } else {
                $yRow = $create_y_axis[$yname]['y_row'];
                $yResult = $create_y_axis[$yname][$yname];
            }
               
        $xyResult = $xRow . $yRow;

        $objPHPExcel->getActiveSheet()->setCellValue($xResult, $result[$x_axis.'_name']);
        $objPHPExcel->getActiveSheet()->setCellValue($yResult, $result[$y_axis.'_name']);
        $objPHPExcel->getActiveSheet()->setCellValue($xyResult, $result["total_labs"]); 

    }

//    var_dump($create_x_axis);
//    var_dump($all_x_axis);
//    die();
    
    // Set auto size column width
    foreach(range('A',$xRow) as $columnID) {
        $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
            ->setAutoSize(true);
    }
    
//set null cell with 0 value====================================================
//    $xStartRow = 'B'; 
//    $yStartRow = 2;  
//    $lastXStartRow = ++$xRow;
//    
//    while($xStartRow<>$lastXStartRow){
//        for ($i=$yStartRow;$i<=$yRow;$i++) {
//            $colB = $objPHPExcel->getActiveSheet()->getCell($xStartRow.$i)->getValue();
//
//            if ($colB == NULL || $colB == '') {
//                $objPHPExcel->getActiveSheet()->setCellValue($xStartRow.$i, '0');
//            }
//
//        }     
//    $xStartRow++;
//    } 
//==============================================================================
    
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    
    // Save Excel 2007 file
    $file = $Options["TmpFolder"].$filename;
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save(str_replace('.php', '.xlsx', $file));

    return $filename;
}

public static function PdfCreate($data, $x_axis, $y_axis){

    global $Options;    
    require_once('../server/libs/PHPExcel/Classes/PHPExcel.php');

    $rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
    $rendererLibrary = 'tcpdf';
    $rendererLibraryPath =  '../server/libs/' . $rendererLibrary;

    $stringDate = date('dmYHis');
    $filename = "StatLabs".$stringDate.".pdf";
    $AxisAndFilters = " X Άξονας = $x_axis\n Y Άξονας = $y_axis" ;

    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel();

    // Set document properties
    $objPHPExcel->getProperties()->setCreator("MyLab Administrator")
                                 ->setTitle("MyLab Stats")
                                 ->setSubject("Labs Statistics")
                                 ->setDescription("Added xy axis statistic data to xls format. Saved at server folder.");
    // Set format codes 
    $objPHPExcel->getDefaultStyle()->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

    // Create a first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->setCellValue('A1', $AxisAndFilters );
    $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);

    //get row cell 
    $xStartRow = 'B'; //B1->C1->D1....
    $yStartRow = 2;   //A2->A3->A4....

    $create_x_axis = array();
    $create_y_axis = array();
    
    foreach($data["results"] as $result)
    { 

        $xname = $result[$x_axis.'_name'];
        $yname = $result[$y_axis.'_name'];
        
       //array transformation
        
            //create x axis row
            if (!array_key_exists($xname, $create_x_axis)) {
                $xRow = $xStartRow++ ;
                $xResult = $xRow. '1';
                $create_x_axis = array(  $xname => $xResult,
                                            'x_row' => $xRow
                                          );
            } else {
                $xRow = $create_x_axis['x_row'];
                $xResult = $create_x_axis[$xname];
            }

            //create y axis row
            if (!array_key_exists($yname, $create_y_axis) ) {
                $yRow = $yStartRow++;
                $yResult = 'A' . $yRow;
                $create_y_axis = array(  $yname => $yResult,
                                            'y_row' => $yRow
                                         );
            } else {
                $yRow = $create_y_axis['y_row'];
                $yResult = $create_y_axis[$yname];
            }
            
        $xyResult = $xRow . $yRow;

        $objPHPExcel->getActiveSheet()->setCellValue($xResult, $result[$x_axis.'_name']);
        $objPHPExcel->getActiveSheet()->setCellValue($yResult, $result[$y_axis.'_name']);
        $objPHPExcel->getActiveSheet()->setCellValue($xyResult, $result["total_labs"]); 

    }
                  
    // Set auto size column width
    foreach(range('A',$xRow) as $columnID) {
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

    if (!PHPExcel_Settings::setPdfRenderer( $rendererName, $rendererLibraryPath )) {
            die(   'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
                    '<br />' .
                    'at the top of this script as appropriate for your directory structure'
            );
    }

    // Save Excel 2007 file
    $file = $Options["TmpFolder"].$filename;
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
    $objWriter->save(str_replace('.php', '.PDF', $file));

    return $filename;

}

}
?>