<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $name
 * @param type $number
 * @param type $equipment_category
 * @return string
 * @throws Exception
 */


function PostEquipmentTypes($name,$number,$equipment_category) {
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
    $result["number"] = $number;
    $result["equipment_category"] = $equipment_category;
    
    try {
         
        //$name============================================================================
        if (! trim($name) )
            throw new Exception(ExceptionMessages::MissingNameValue." : ".$name, ExceptionCodes::MissingNameValue);
        else
            $filter[] = new DFC(EquipmentTypesExt::FIELD_NAME, $name, DFC::EXACT);
        
        //$number===========================================================================
        $fnumber = $number ? $number : NULL;
            
        //$equipment_category_id============================================================          
        if (! $equipment_category)
            throw new Exception(ExceptionMessages::CreateEquipmentCategoryIdValue." : ".$equipment_category, ExceptionCodes::CreateEquipmentCategoryIdValue);
        else {
              $oEquipmentCategories = new EquipmentCategoriesExt($db);

              if (is_numeric($equipment_category)) {
                  $filter[] = new DFC(EquipmentCategoriesExt::FIELD_EQUIPMENT_CATEGORY_ID, $equipment_category, DFC::EXACT) ;
              } else { 
                  $filter[] = new DFC(EquipmentCategoriesExt::FIELD_NAME, $equipment_category, DFC::EXACT);                
              }         
         }

        $arrayEquipmentCategories = $oEquipmentCategories->findByFilter($db, $filter, true);
        
        if ( count( $arrayEquipmentCategories ) == 1 ) { 
            $fEquipmentCategory = $arrayEquipmentCategories[0]->getEquipmentCategoryId();
        } else if ( count( $arrayEquipmentCategories ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicateEquipmentCategoryIdValue." : ".$equipment_category, ExceptionCodes::DuplicateEquipmentCategoryIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidEquipmentCategoryValue." : ".$equipment_category, ExceptionCodes::InvalidEquipmentCategoryValue);
        }  
        //==================================================================================       

        $oEquipmentTypes = new EquipmentTypesExt($db);
        $arrayEquipmentTypes = $oEquipmentTypes->findByFilter($db, $filter, true);

            if ( count( $arrayEquipmentTypes ) > 0 ) { 
                throw new Exception(ExceptionMessages::DuplicateEquipmentTypeValue." : ".$name, ExceptionCodes::DuplicateEquipmentTypeValue);
            }

        $oEquipmentTypes->setName($name);
        $oEquipmentTypes->setNumber($fnumber);
        $oEquipmentTypes->setEquipmentCategoryId($fEquipmentCategory);
        $oEquipmentTypes->insertIntoDatabase($db);

        $result["equipment_type_id"] = $oEquipmentTypes->getEquipmentTypeId();
        
        $result["status"] = 200;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";
    } catch (Exception $e){ 
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
}

?>