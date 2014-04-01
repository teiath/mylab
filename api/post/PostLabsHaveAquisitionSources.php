<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @param type $lab_id
 * @param type $aquisition_source
 * @return string
 * @throws Exception
 */

function PostLabsHaveAquisitionSources($lab_id,$aquisition_source) {
    global $db;
    global $Options;
    global $app;
    
    $result = array();  
    $result["data"] = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    $result["lab_id"] = $lab_id;
    $result["aquisition_source"] = $aquisition_source;

    try {
        
        //$lab_id===========================================================================  
        if (! $lab_id) {
            throw new Exception(ExceptionMessages::MissingLabValue." : ".$lab_id, ExceptionCodes::MissingLabValue);
        } else if (!is_numeric($lab_id)) {
            throw new Exception(ExceptionMessages::InvalidLabValue." : ".$lab_id, ExceptionCodes::InvalidLabValue);
        } else {
            $oLabs = new LabsExt($db);
            $filter = new DFC(labsExt::FIELD_LAB_ID, $lab_id, DFC::EXACT);
            $arrayLabs = $oLabs->findByFilter($db, $filter, true);
        }
                
        if ( count( $arrayLabs ) === 1 ) { 
            $fLabId = $arrayLabs[0]->getLabId();
        } else if ( count( $arrayLabs ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicateLabsIdValue." : ".$lab_id, ExceptionCodes::DuplicateLabsIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidLabIdValue." : ".$lab_id, ExceptionCodes::InvalidLabIdValue);
        }
    
        //$aquisition_source_id============================================================    
        if (! $aquisition_source) {
            throw new Exception(ExceptionMessages::MissingAquisitionSourceIdValue." : ".$aquisition_source, ExceptionCodes::MissingAquisitionSourceIdValue);
        } else  if (is_numeric($aquisition_source)) {
            $oAquisitionSources = new AquisitionSourcesExt($db);
            $filter = array( new DFC(AquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, $aquisition_source, DFC::EXACT) );
            $arrayAquisitionSources = $oAquisitionSources->findByFilter($db, $filter, true);  
        } else if ($aquisition_source) {
            $oAquisitionSources = new AquisitionSourcesExt($db);
            $filter = array( new DFC(AquisitionSourcesExt::FIELD_NAME, $aquisition_source, DFC::EXACT) );
            $arrayAquisitionSources = $oAquisitionSources->findByFilter($db, $filter, true);
        }
        
        if ( count( $arrayAquisitionSources ) === 1 ) { 
            $fAquisitionSource = $arrayAquisitionSources[0]->getAquisitionSourceId();
        } else if ( count( $arrayAquisitionSources ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicateAquisitionSourceIdValue." : ".$aquisition_source, ExceptionCodes::Duplicateaq);
        } else {
            throw new Exception(ExceptionMessages::InvalidAquisitionSourceValue." : ".$aquisition_source, ExceptionCodes::InvalidAquisitionSourceValue);
        }
            
        //==================================================================================       

        $oLabsHaveAquisitionSources = new LabsHaveAquisitionSourcesExt($db);
        $oLabsHaveAquisitionSources->setLabId($fLabId);
        $oLabsHaveAquisitionSources->setAquisitionSourceId($fAquisitionSource);
       
        $result["exists"]=$oLabsHaveAquisitionSources->existsInDatabase($db);
        
            if ( $result["exists"]==true ) { 
                throw new Exception(ExceptionMessages::DuplicateLabHasAquisitionSourceValue." lab_id : ".$fLabId."  aquisition_source_id : ".$fAquisitionSource , ExceptionCodes::DuplicateLabHasAquisitionSourceValue);
            } else {
                $oLabsHaveAquisitionSources->insertIntoDatabase($db); 
            }
            
        $result["status"] = 200;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";
    } catch (Exception $e){ 
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
}

?>