<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $aquisition_source_id
 * @param type $name
 * @return string
 * @throws Exception
 */

function PutAquisitionSources($aquisition_source_id,$name) {
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
        
        //$name==========================================================================================
        if (! trim($name) )
            throw new Exception(ExceptionMessages::MissingNameValue." : ".$name, ExceptionCodes::MissingNameValue);
        else
            $filter[] = new DFC(AquisitionSourcesExt::FIELD_NAME, $name, DFC::EXACT); 

           $oAquisitionSources = new AquisitionSourcesExt($db);
           $arrayAquisitionSources = $oAquisitionSources->findByFilter($db, $filter, true);

           if ( count( $arrayAquisitionSources ) > 0 ) { 
                throw new Exception(ExceptionMessages::DuplicateAquisitionSourceValue." : ".$name, ExceptionCodes::DuplicateAquisitionSourceValue);
           }     
        
        //$aquisition_source_id===========================================================================
        if (! trim($aquisition_source_id) )
            throw new Exception(ExceptionMessages::MissingAquisitionSourceIdValue." : ".$aquisition_source_id, ExceptionCodes::MissingAquisitionSourceIdValue);
        else if (!is_numeric($aquisition_source_id) || ( $aquisition_source_id < 0)  )
            throw new Exception(ExceptionMessages::InvalidAquisitionSourceIdValue." : ".$aquisition_source_id, ExceptionCodes::InvalidAquisitionSourceIdValue);
        else 
            $uAquisitionSources = AquisitionSourcesExt::findById($db, $aquisition_source_id);

        //=================================================================================================
        $result["total_found"]=count($uAquisitionSources);
        
        if ($result["total_found"]==1){
              
                $values["aquisition_source_id"] = $uAquisitionSources->getAquisitionSourceId();
                $values["name"] = $uAquisitionSources->getName();
                $result["values"] = $values;
               
                $update_values["aquisition_source_id"] = $aquisition_source_id;
                $update_values["name"] = $name;
                $result["updated_values"] = $update_values;
                
                $uAquisitionSources->setName($name);
                $uAquisitionSources->updateToDatabase($db);

                $result["status"] = 200;
                $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success"; 

        } else if ($result["total_found"]==0){
            throw new Exception(ExceptionMessages::UpdateAquisitionSourceIdValue." : ".$aquisition_source_id, ExceptionCodes::UpdateAquisitionSourceIdValue);
        } else {
           throw new Exception(ExceptionMessages::DuplicateAquisitionSourceIdValue." : ".$aquisition_source_id, ExceptionCodes::DuplicateAquisitionSourceIdValue);
        }
        
    } catch (Exception $e){      
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    }  
    return $result;
}

?>