<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $lab_id
 * @param type $aquisition_source
 * @return string
 * @throws Exception
 */

function DelLabsHaveAquisitionSources($lab_id,$aquisition_source) {
    global $db;
    global $Options;
    global $app;
    
    $result = array();  
    $result["data"] = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    $result["del_lab_id"] = $lab_id;
    $result["aquisition_source"] = $aquisition_source;
    
    try {
             
        //$lab===========================================================================   
        if (! trim($lab_id) ) {
            throw new Exception(ExceptionMessages::DeleteLabHasAquisitionSourceLabIdValue." : ".$lab_id, ExceptionCodes::DeleteLabHasAquisitionSourceLabIdValue);
        } else if (!is_numeric($lab_id)) {
            throw new Exception(ExceptionMessages::InvalidLabValue." : ".$lab_id, ExceptionCodes::InvalidLabValue);
        } else {
            $oLabsHaveAquisitionSources = new LabsHaveAquisitionSourcesExt($db);
            $filter = new DFC(LabsHaveAquisitionSourcesExt::FIELD_LAB_ID, $lab_id, DFC::EXACT);
            $arrayLabs = $oLabsHaveAquisitionSources->findByFilter($db, $filter, true);
        }

        if ( count($arrayLabs) < 1) {
            throw new Exception(ExceptionMessages::DeleteNotFoundLabHasAquisitionSourceLabIdValue." : ".$lab_id, ExceptionCodes::DeleteNotFoundLabHasAquisitionSourceLabIdValue);
        } else {
            $fLabId = $arrayLabs[0]->getLabId();
        }

        //$aquisition_source============================================================    
        if (! $aquisition_source) {
            throw new Exception(ExceptionMessages::MissingAquisitionSourceIdValue." : ".$aquisition_source, ExceptionCodes::MissingAquisitionSourceIdValue);
        } else  if (is_numeric($aquisition_source)) {
            $oLabsHaveAquisitionSources = new LabsHaveAquisitionSourcesExt($db);
            $filter = array( new DFC(LabsHaveAquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, $aquisition_source, DFC::EXACT) );
            $arrayLabsHaveAquisitionSources = $oLabsHaveAquisitionSources->findByFilter($db, $filter, true);  
        } else if ($aquisition_source) {
            $oAquisitionSources = new AquisitionSourcesExt($db);
            $filter = array( new DFC(AquisitionSourcesExt::FIELD_NAME, $aquisition_source, DFC::EXACT) );
            $arrayAquisitionSources = $oAquisitionSources->findByFilter($db, $filter, true);
        
                if ( count( $arrayAquisitionSources ) == 1 ) { 
                    $oAquisitionSource = $arrayAquisitionSources[0]->getAquisitionSourceId();
                    $oLabsHaveAquisitionSources = new LabsHaveAquisitionSourcesExt($db);
                    $filter = array( new DFC(LabsHaveAquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, $oAquisitionSource, DFC::EXACT) );
                    $arrayLabsHaveAquisitionSources = $oLabsHaveAquisitionSources->findByFilter($db, $filter, true);  
                } else if ( count( $arrayAquisitionSources ) > 1 ) { 
                    throw new Exception(ExceptionMessages::DuplicateAquisitionSourceIdValue." : ".$aquisition_source, ExceptionCodes::DuplicateAquisitionSourceIdValue);
                } else {
                    throw new Exception(ExceptionMessages::InvalidAquisitionSourceValue." : ".$aquisition_source, ExceptionCodes::InvalidAquisitionSourceValue);
                }
        } 
            
            if ( count( $arrayLabsHaveAquisitionSources ) < 1 ) { 
                throw new Exception(ExceptionMessages::DeleteNotFoundLabHasAquisitionSourceValue." : ".$aquisition_source, ExceptionCodes::DeleteNotFoundLabHasAquisitionSourceValue);
            } else {
                $fAquisitionSource = $arrayLabsHaveAquisitionSources[0]->getAquisitionSourceId();
            } 
              
        
        //check for availability============================================================================== 
        
        $dLabsHaveAquisitionSources = LabsHaveAquisitionSourcesExt::findById($db, $fLabId, $fAquisitionSource);     
        $result["total_found"]=count($dLabsHaveAquisitionSources);
     
        if ($result["total_found"]!=0){
  
                $values["lab_id"] = $dLabsHaveAquisitionSources->getLabId();
                $values["aquisition_source"] = $dLabsHaveAquisitionSources->getAquisitionSourceId();
                $result["values"] = $values;
                $dLabsHaveAquisitionSources->deleteFromDatabase($db);
                
                $result["status"] = 200;
                $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";  
        } else {
       
                  throw new Exception(ExceptionMessages::DeleteNotFoundAquisitionSources." : Lab_id = ".$fLabId." // Aquisition_source = ".$fAquisitionSource, ExceptionCodes::DeleteNotFoundAquisitionSources);
                     
        }
    }
    catch (Exception $e) 
    {
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
}

?>