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

function PostEducationLevels($name) {
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
             $filter[] = new DFC(EducationLevelsExt::FIELD_NAME, $name, DFC::EXACT);
        //==============================================================================   

        $oEducationLevels = new EducationLevelsExt($db);
        $arrayEducationLevels = $oEducationLevels->findByFilter($db, $filter, true);

            if ( count( $arrayEducationLevels ) > 0 ) { 
                throw new Exception(ExceptionMessages::DuplicateEducationLevelValue." : ".$name, ExceptionCodes::DuplicateEducationLevelValue);
            }

        $oEducationLevels->setName($name);
        $oEducationLevels->insertIntoDatabase($db);

        $result["aquisition_source_id"] = $oEducationLevels->getEducationLevelId();

        $result["status"] = 200;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";
    } catch (Exception $e){ 
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
}

?>