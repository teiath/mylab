<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @param string $employment_relationship_id
 * @param type $name
 * @return string
 * @throws Exception
 */

function PostEmploymentRelationships($name) {
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
            $filter[] = new DFC(EmploymentRelationshipsExt::FIELD_NAME, $name, DFC::EXACT);
        //=================================================================================      

        $oEmploymentRelationships = new EmploymentRelationshipsExt($db);
        $arrayEmploymentRelationships = $oEmploymentRelationships->findByFilter($db, $filter, true);

            if ( count( $arrayEmploymentRelationships ) > 0 ) { 
                throw new Exception(ExceptionMessages::DuplicateEmploymentRelationshipValue." : ".$name, ExceptionCodes::DuplicateEmploymentRelationshipValue);
            }

        $oEmploymentRelationships->setName($name);
        $oEmploymentRelationships->insertIntoDatabase($db);

        $result["employment_relationship_id"] = $oEmploymentRelationships->getEmploymentRelationshipId();

        $result["status"] = 200;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";
    } catch (Exception $e){ 
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
}

?>