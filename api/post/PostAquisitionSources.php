<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @param type $aquisition_source_id
 * @param type $name
 * @return string
 * @throws Exception
 */

function PostAquisitionSources($name) {
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

    try {
        
        
        //$name===========================================================================
        if (! trim($name) )
            throw new Exception(ExceptionMessages::MissingNameValue." : ".$name, ExceptionCodes::MissingNameValue);
        else
             $filter[] = new DFC(AquisitionSourcesExt::FIELD_NAME, $name, DFC::EXACT);
        //==============================================================================        

        $oAquisitionSources = new AquisitionSourcesExt($db);
        $arrayAquisitionSources = $oAquisitionSources->findByFilter($db, $filter, true);

            if ( count( $arrayAquisitionSources ) > 0 ) { 
                throw new Exception(ExceptionMessages::DuplicateAquisitionSourceValue." : ".$name, ExceptionCodes::DuplicateAquisitionSourceValue);
            }

        $oAquisitionSources->setName($name);
        $oAquisitionSources->insertIntoDatabase($db);

        $result["aquisition_source_id"] = $oAquisitionSources->getAquisitionSourceId();

        $result["status"] = 200;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";
    } catch (Exception $e){ 
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
}

?>