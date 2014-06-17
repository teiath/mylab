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


function DelSchoolUnits($name) {
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
            throw new Exception(ExceptionMessages::DeleteSchoolUnitNameValue." : ".$name, ExceptionCodes::DeleteSchoolUnitNameValue);
        } else {
            $filter = array( new DFC(SchoolUnitsExt::FIELD_NAME,$name, DFC::EXACT) );
            $oSchoolUnits = new SchoolUnitsExt($db);
            $arraySchoolUnits = $oSchoolUnits->findByFilter($db, $filter, true);
        }
  
        if ( count($arraySchoolUnits) < 1 ) {
            throw new Exception(ExceptionMessages::DeleteNotFoundSchoolUnitNameValue." : ".$name, ExceptionCodes::DeleteNotFoundSchoolUnitNameValue);
        } else if (count($arraySchoolUnits) == 1) {
            $SchoolUnitId = $arraySchoolUnits[0]->getSchoolUnitId();
            $SchoolUnitName = $arraySchoolUnits[0]->getName();
            $result["result_found"]="School_unit_id = ".$SchoolUnitId." // Name = ".$SchoolUnitName;
        } else {
            throw new Exception(ExceptionMessages::DuplicateDelSchoolUnitNameValue." : ".$name, ExceptionCodes::DuplicateDelSchoolUnitNameValue);
        }
        
        //delete============================================================================== 
        
        $oSchoolUnits = new SchoolUnitsExt($db);
        $filter[] = new DFC(SchoolUnitsExt::FIELD_SCHOOL_UNIT_ID, $SchoolUnitId, DFC::EXACT); 
        $countRows = $oSchoolUnits->findByFilter($db, $filter, true);
        $result["references_count"]=count( $countRows );
        
         if ($result["references_count"] == 1){ 
            $arraySchoolUnits[0]->deleteByFilter($db, $filter);  
            $result["status"] = 200;
            $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";          
        } else {
            throw new Exception(ExceptionMessages::DeleteError, ExceptionCodes::DeleteError);          
        }
    } catch (Exception $e)  {
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
}

?>