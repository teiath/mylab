<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @param string $equipment_category_id
 * @param type $name
 * @return string
 * @throws Exception
 */

function PostEquipmentCategories($name) {
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
        $filter[] = new DFC(EquipmentCategoriesExt::FIELD_NAME, $name, DFC::EXACT);
        //===============================================================================       

        $oEquipmentCategories = new EquipmentCategoriesExt($db);
        $arrayEquipmentCategories = $oEquipmentCategories->findByFilter($db, $filter, true);

            if ( count( $arrayEquipmentCategories ) > 0 ) { 
                throw new Exception(ExceptionMessages::DuplicateEquipmentCategoryValue." : ".$name, ExceptionCodes::DuplicateEquipmentCategoryValue);
            }

        $oEquipmentCategories->setName($name);
        $oEquipmentCategories->insertIntoDatabase($db);

        $result["equipment_category_id"] = $oEquipmentCategories->getEquipmentCategoryId();
             
        $result["status"] = 200;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";
    } catch (Exception $e){ 
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
}

?>