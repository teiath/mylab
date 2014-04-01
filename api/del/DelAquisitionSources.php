<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @param type $name
 * @return string
 * @throws Exception
 */

function DelAquisitionSources($name) {
    global $db;
    global $Options;
    global $app;
    
    $result = array();  
    $result["data"] = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    $result["del_name"] = $name;

    try {
             
        //$name===========================================================================   
        if (! trim($name) ) {
            throw new Exception(ExceptionMessages::DeleteAquisitionNameValue." : ".$name, ExceptionCodes::DeleteAquisitionNameValue);
        } else {
            $filter = array( new DFC(AquisitionSourcesExt::FIELD_NAME,$name, DFC::EXACT) );   
            $oAquisitionSources = new AquisitionSourcesExt($db);
            $arrayAquisitionSources = $oAquisitionSources->findByFilter($db, $filter, true);
        }

        if ( count($arrayAquisitionSources) < 1) {
            throw new Exception(ExceptionMessages::DeleteNotFoundAquisitionSourceNameValue." : ".$name, ExceptionCodes::DeleteNotFoundAquisitionSourceNameValue);
        } else if ( count($arrayAquisitionSources) == 1) {
            $AquisitionSourceId = $arrayAquisitionSources[0]->getAquisitionSourceId();
            $AquisitionSourceName = $arrayAquisitionSources[0]->getName();
            $result["result_found"]="Aquisition_source_id = ".$AquisitionSourceId." // Name = ".$AquisitionSourceName;     
        } else {
            throw new Exception(ExceptionMessages::DuplicateDelAquisitionNameValue." : ".$name, ExceptionCodes::DuplicateDelAquisitionNameValue);
        }

        //check for references============================================================================== 
        
        $oLabsHaveAquisitionSources = new LabsHaveAquisitionSourcesExt($db);
        $filter[] = new DFC(LabsHaveAquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, $AquisitionSourceId, DFC::EXACT); 
        $countRows = $oLabsHaveAquisitionSources->findByFilter($db, $filter, true);
        $result["references_count"]=count( $countRows );
        
        if ($result["references_count"]!=0){
            $oAquisitionSources->getAll($db);
            
            foreach ($countRows as $row) {
                    $result["data_references"][] = array("lab_id" => $row->getLabId(),
                                                        "aquisition_source_id" => $row->getAquisitionSourceId(),                                    
                                                        "aquisition_source_name"=>$oAquisitionSources->searchArrayForID( $row->getAquisitionSourceId() )->getName()                                                 
                    );
            }
            throw new Exception(ExceptionMessages::ReferencesLabsHaveAquisitionSources, ExceptionCodes::ReferencesLabsHaveAquisitionSources);       
        } else {
            $arrayAquisitionSources[0]->deleteByFilter($db, $filter);  
            $result["status"] = 200;
            $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";           
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