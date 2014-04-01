<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $code
 * @return string
 * @throws Exception
 */

function PostSpecializationCodes($code) {
    global $db;
    global $Options;
    global $app;
    
    $result = array();  
    $result["data"] = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    $result["code"] = $code;
    
    try {
           
        //$code===========================================================================
        if (! trim($code) )
            throw new Exception(ExceptionMessages::MissingCodeValue." : ".$code, ExceptionCodes::MissingCodeValue);
        else
            $filter[] = new DFC(SpecializationCodesExt::FIELD_CODE, $code, DFC::EXACT);
        //=================================================================================      

        $oSpecializationCodes = new SpecializationCodesExt($db);
        $arraySpecializationCodes = $oSpecializationCodes->findByFilter($db, $filter, true);

            if ( count( $arraySpecializationCodes ) > 0 ) { 
                throw new Exception(ExceptionMessages::DuplicateSpecializationCodeValue." : ".$code, ExceptionCodes::DuplicateSpecializationCodeValue);
            }

        $oSpecializationCodes->setCode($code);
        $oSpecializationCodes->insertIntoDatabase($db);

        $result["specialization_code_id"] = $oSpecializationCodes->getSpecializationCodeId();

        $result["status"] = 200;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";
    } catch (Exception $e){ 
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
}

?>