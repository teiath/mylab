<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @param string $region_edu_admin_id
 * @param type $name
 * @return string
 * @throws Exception
 */

function PostRegionEduAdmins($name) {
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
             $filter[] = new DFC(RegionEduAdminsExt::FIELD_NAME, $name, DFC::EXACT);
        //==============================================================================   

        $oRegionEduAdmins = new RegionEduAdminsExt($db);
        $arrayRegionEduAdmins = $oRegionEduAdmins->findByFilter($db, $filter, true);

            if ( count( $arrayRegionEduAdmins ) > 0 ) { 
                throw new Exception(ExceptionMessages::DuplicateRegionEduAdminValue." : ".$name, ExceptionCodes::DuplicateRegionEduAdminValue);
            }

        $oRegionEduAdmins->setName($name);
        $oRegionEduAdmins->insertIntoDatabase($db);

        $result["region_edu_admin_id"] = $oRegionEduAdmins->getRegionEduAdminId();

        $result["status"] = 200;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";
    } catch (Exception $e){ 
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
}

?>