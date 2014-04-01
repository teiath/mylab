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

function DelEquipmentCategories($name) {
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
            throw new Exception(ExceptionMessages::DeleteEquipmentCategoryNameValue." : ".$name, ExceptionCodes::DeleteEquipmentCategoryNameValue);
        } else {
            $filter = array( new DFC(EquipmentCategoriesExt::FIELD_NAME,$name, DFC::EXACT) );   
            $oEquipmentCategories = new EquipmentCategoriesExt($db);
            $arrayEquipmentCategories = $oEquipmentCategories->findByFilter($db, $filter, true);
        }

        if ( count($arrayEquipmentCategories) < 1) {
            throw new Exception(ExceptionMessages::DeleteNotFoundEquipmentCategoryNameValue." : ".$name, ExceptionCodes::DeleteNotFoundEquipmentCategoryNameValue);
        } else if ( count($arrayEquipmentCategories) == 1) {
            $EquipmentCategoryId= $arrayEquipmentCategories[0]->getEquipmentCategoryId();
            $EquipmentCategoryName = $arrayEquipmentCategories[0]->getName();
            $result["result_found"]="Equipment_category_id = ".$EquipmentCategoryId." // Name = ".$EquipmentCategoryName;     
        } else {
            throw new Exception(ExceptionMessages::DuplicateDelEquipmentCategoryNameValue." : ".$name, ExceptionCodes::DuplicateDelEquipmentCategoryNameValue);
        }

        //check for references============================================================================== 
        
        $oEquipmentTypes = new EquipmentTypesExt($db);
        $filter[] = new DFC(EquipmentTypesExt::FIELD_EQUIPMENT_CATEGORY_ID, $EquipmentCategoryId, DFC::EXACT); 
        $countRows = $oEquipmentTypes->findByFilter($db, $filter, true);
        $result["references_count"]=count( $countRows );
        
        if ($result["references_count"]!=0){
            $oEquipmentCategories = new EquipmentCategoriesExt($db);
            $oEquipmentCategories->getAll($db);
            $oEquipmentTypes->getAll($db);
            
            foreach ($countRows as $row) {
                    $result["data_references"][] = array("equipment_type" => $row->getEquipmentTypeId(),
                                                        "name" => $row->getName(),
                                                        "number" => $row->getNumber(),
                                                        "equipment_category"=> $oEquipmentCategories->searchArrayForID( $row->getEquipmentCategoryId() )->getName()                                                
                    );
            }
            throw new Exception(ExceptionMessages::ReferencesEquipmentTypes, ExceptionCodes::ReferencesEquipmentTypes);       
        } else {
            $arrayEquipmentCategories[0]->deleteByFilter($db, $filter);  
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