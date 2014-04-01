<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $name
 * @param type $transfer_area
 * @param type $prefecture
 * @return string
 * @throws Exception
 */

function PostMunicipalities($name,$transfer_area,$prefecture) {
    global $db;
    global $Options;
    global $app;
    
    $result = array();  
    $result["data"] = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    $result["name"] = $name;
    $result["transfer_area"] = $transfer_area;
    $result["prefecture"] = $prefecture;
      
    try {
     
        //$name============================================================================
        if (! trim($name) )
            throw new Exception(ExceptionMessages::MissingNameValue." : ".$name, ExceptionCodes::MissingNameValue);
        else
            $filter[] = new DFC(MunicipalitiesExt::FIELD_NAME, $name, DFC::EXACT); 

        //$transfer_area============================================================          
        if (! $transfer_area)
            throw new Exception(ExceptionMessages::CreateTransferAreaIdValue." : ".$transfer_area, ExceptionCodes::CreateTransferAreaIdValue);
        else {
              $oTranferAreas= new TransferAreasExt($db);

              if (is_numeric($transfer_area)) {
                  $filter[] = new DFC(TransferAreasExt::FIELD_TRANSFER_AREA_ID, $transfer_area, DFC::EXACT) ;
              } else { 
                  $filter[] = new DFC(TransferAreasExt::FIELD_NAME, $transfer_area, DFC::EXACT);                
              }         
         }

        $arrayTranferAreas = $oTranferAreas->findByFilter($db, $filter, true);
        
        if ( count( $arrayTranferAreas ) === 1 ) { 
            $fTranferArea = $arrayTranferAreas[0]->getTransferAreaId();
        } else if ( count( $arrayTranferAreas ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicateTransferAreaIdValue." : ".$transfer_area, ExceptionCodes::DuplicateTransferAreaIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidTransferAreaValue." : ".$transfer_area, ExceptionCodes::InvalidTransferAreaValue);
        }  

        //$prefecture============================================================          
        if (! $prefecture)
            throw new Exception(ExceptionMessages::CreatePrefectureIdValue." : ".$prefecture, ExceptionCodes::CreatePrefectureIdValue);
        else {
              $oPrefectures= new PrefecturesExt($db);

              if (is_numeric($prefecture)) {
                  $filter[] = new DFC(PrefecturesExt::FIELD_PREFECTURE_ID, $prefecture, DFC::EXACT) ;
              } else { 
                  $filter[] = new DFC(PrefecturesExt::FIELD_NAME, $prefecture, DFC::EXACT);                
              }         
         }

        $arrayPrefectures = $oPrefectures->findByFilter($db, $filter, true);
        
        if ( count( $arrayPrefectures ) === 1 ) { 
            $fPrefecture = $arrayPrefectures[0]->getPrefectureId();
        } else if ( count( $arrayPrefectures ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicatePrefectureIdValue." : ".$prefecture, ExceptionCodes::DuplicatePrefectureIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidPrefectureValue." : ".$prefecture, ExceptionCodes::InvalidPrefectureValue);
        }  
        //=================================================================================
                
        $oMunicipalities = new MunicipalitiesExt($db);
        $arrayMunicipalities = $oMunicipalities->findByFilter($db, $filter, true);
        
            if ( count( $arrayMunicipalities ) > 0 ) { 
                throw new Exception(ExceptionMessages::DuplicateMunicipalityValue." : ".$name, ExceptionCodes::DuplicateMunicipalityValue);
            }

        $oMunicipalities->setName($name);
        $oMunicipalities->setTransferAreaId($fTranferArea);
        $oMunicipalities->setPrefectureId($fPrefecture);
        $oMunicipalities->insertIntoDatabase($db);

        $result["municipality_id"] = $oMunicipalities->getMunicipalityId();
        
        $result["status"] = 200;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";
    } catch (Exception $e){ 
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
}

?>