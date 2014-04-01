<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $name
 * @return string
 * @throws Exception
 */


function PostLabTypes($name,$info_name) {
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
    $result["info_name"] = $info_name;
    
    try {
        
        $oLabTypes = new LabTypesExt($db);
        //$name===========================================================================   
        if (! trim($name) )
            throw new Exception(ExceptionMessages::MissingNameValue." : ".$name, ExceptionCodes::MissingNameValue);
        else 
            $filter = new DFC(LabTypesExt::FIELD_NAME,$name, DFC::EXACT);
                     
        $nameLabTypes = $oLabTypes->findByFilter($db, $filter, true);

            if ( count( $nameLabTypes ) > 0 ) { 
                throw new Exception(ExceptionMessages::DuplicateLabTypeValue." : ".$name, ExceptionCodes::DuplicateLabTypeValue);
            }
        
        //$info_name===========================================================================   
        if (! trim($info_name) )
            throw new Exception(ExceptionMessages::MissingInfoNameValue." : ".$info_name, ExceptionCodes::MissingInfoNameValue);
        else 
            $filter = new DFC(LabTypesExt::FIELD_INFO_NAME,$info_name, DFC::EXACT);
        
        $infoNameLabTypes = $oLabTypes->findByFilter($db, $filter, true);

            if ( count( $infoNameLabTypes ) > 0 ) { 
                throw new Exception(ExceptionMessages::DuplicateInfoLabTypeValue." : ".$info_name, ExceptionCodes::DuplicateInfoLabTypeValue);
            }
        //===============================================================================       

        $oLabTypes->setName($name);
        $oLabTypes->setInfoName($info_name);
        $oLabTypes->insertIntoDatabase($db);

        $result["lab_type_id"] = $oLabTypes->getLabTypeId();
        
        $result["status"] = 200;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";
    } catch (Exception $e){ 
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
}

?>