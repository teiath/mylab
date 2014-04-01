<?php

header("Content-Type: text/html; charset=utf-8");


function PostPrefectures($name) {
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
             $filter[] = new DFC(PrefecturesExt::FIELD_NAME, $name, DFC::EXACT);
        //==============================================================================   

        $oPrefectures = new PrefecturesExt($db);
        $arrayPrefectures = $oPrefectures->findByFilter($db, $filter, true);

            if ( count( $arrayPrefectures ) > 0 ) { 
                throw new Exception(ExceptionMessages::DuplicatePrefectureValue." : ".$name, ExceptionCodes::DuplicatePrefectureValue);
            }

        $oPrefectures->setName($name);
        $oPrefectures->insertIntoDatabase($db);

        $result["prefecture_id"] = $oPrefectures->getPrefectureId();

        $result["status"] = 200;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";
    } catch (Exception $e){ 
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
}

?>