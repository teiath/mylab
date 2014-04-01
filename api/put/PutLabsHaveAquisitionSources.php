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

function PutLabsHaveAquisitionSources($lab_id,$aquisition_source,$new_aquisition_source) {
    global $db;
    global $Options;
    global $app;
    
    $result = array();  
    $values = array();
    $update_values = array();
    $result["data"] = array();
    
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    
    try {
        
        //$lab_id===========================================================================  
        if (! $lab_id) {
            throw new Exception(ExceptionMessages::MissingLabValue." : ".$lab_id, ExceptionCodes::MissingLabValue);
        } else if (!is_numeric($lab_id)) {
            throw new Exception(ExceptionMessages::InvalidLabValue." : ".$lab_id, ExceptionCodes::InvalidLabValue);
        } else {
            $oLabs = new LabsExt($db);
            $filter = new DFC(LabsExt::FIELD_LAB_ID, $lab_id, DFC::EXACT);
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
            throw new Exception(ExceptionMessages::DuplicateAquisitionSourceIdValue." : ".$aquisition_source, ExceptionCodes::DuplicateAquisitionSourceIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidAquisitionSourceValue." : ".$aquisition_source, ExceptionCodes::InvalidAquisitionSourceValue);
        }
        
         //$new_aquisition_source============================================================    
        if (! $new_aquisition_source) {
            throw new Exception(ExceptionMessages::MissingNewAquisitionSourceIdValue." : ".$new_aquisition_source, ExceptionCodes::MissingNewAquisitionSourceIdValue);
        } else  if (is_numeric($new_aquisition_source)) {
            $oAquisitionSources = new AquisitionSourcesExt($db);
            $filter = array( new DFC(AquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, $new_aquisition_source, DFC::EXACT) );
            $arrayAquisitionSources = $oAquisitionSources->findByFilter($db, $filter, true);  
        } else if ($new_aquisition_source) {
            $oAquisitionSources = new AquisitionSourcesExt($db);
            $filter = array( new DFC(AquisitionSourcesExt::FIELD_NAME, $new_aquisition_source, DFC::EXACT) );
            $arrayAquisitionSources = $oAquisitionSources->findByFilter($db, $filter, true);
        }
        
        if ( count( $arrayAquisitionSources ) === 1 ) { 
            $fnewAquisitionSource = $arrayAquisitionSources[0]->getAquisitionSourceId();
        } else if ( count( $arrayAquisitionSources ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicateAquisitionSourceIdValue." : ".$new_aquisition_source, ExceptionCodes::Duplicateaq);
        } else {
            throw new Exception(ExceptionMessages::InvalidNewAquisitionSourceValue." : ".$new_aquisition_source, ExceptionCodes::InvalidNewAquisitionSourceValue);
        }
            
        //==================================================================================   
        
        $uLabsHaveAquisitionSources = LabsHaveAquisitionSourcesExt::findById($db, $fLabId, $fAquisitionSource);
        $unewLabsHaveAquisitionSources = LabsHaveAquisitionSourcesExt::findById($db, $fLabId, $fnewAquisitionSource);
        $result["total_found"]=count($uLabsHaveAquisitionSources);
        $result["new_total_found"]=count($unewLabsHaveAquisitionSources);
        
        if (($result["total_found"]==1) && ($result["new_total_found"]==0)) {
              
                $values["lab_id"] = $uLabsHaveAquisitionSources->getLabId();
                $values["aquisition_source"] = $uLabsHaveAquisitionSources->getAquisitionSourceId();
                $result["values"] = $values;
               
                $update_values["lab_id"] = $fLabId;
                $update_values["aquisition_source"] = $fnewAquisitionSource;
                $result["updated_values"] = $update_values;
                
                $uLabsHaveAquisitionSources->deleteFromDatabase($db);
                
                $uLabsHaveAquisitionSources->setLabId($fLabId);
                $uLabsHaveAquisitionSources->setAquisitionSourceId($fnewAquisitionSource);
                $uLabsHaveAquisitionSources->insertIntoDatabase($db);

                $result["status"] = 200;
                $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success"; 
                
        } else if (($result["total_found"]==1) && ($result["new_total_found"]==1)){
            throw new Exception(ExceptionMessages::DuplicateLabHasAquisitionSourceValue." lab_id : ".$fLabId."  new_aquisition_source : ".$fnewAquisitionSource ,  ExceptionCodes::DuplicateLabHasAquisitionSourceValue);
        } else if ($result["total_found"]==0){
            throw new Exception(ExceptionMessages::UpdateLabHasAquisitionSourceIdValue." lab_id : ".$fLabId."  aquisition_source : ".$fAquisitionSource ,  ExceptionCodes::UpdateLabHasAquisitionSourceIdValue);
        } else {
           throw new Exception(ExceptionMessages::DuplicateLabHasAquisitionSourceIdValue." lab_id : ".$fLabId."  aquisition_source : ".$fAquisitionSource ,  ExceptionCodes::DuplicateLabHasAquisitionSourceIdValue);
        }
        
    } catch (Exception $e){      
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    }  
    return $result;
}

?>