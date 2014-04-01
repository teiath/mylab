<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $equipment_category_id
 * @param type $name
 * @return string
 * @throws Exception
 */

function PutEquipmentCategories($equipment_category_id,$name) {
    global $db;
    global $Options;
    global $app;
    
    $result = array();  

    $result["data"] = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    
    try {
        
        //$name==========================================================================================
        if (! trim($name) )
            throw new Exception(ExceptionMessages::MissingNameValue." : ".$name, ExceptionCodes::MissingNameValue);
        else
            $filter[] = new DFC(EquipmentCategoriesExt::FIELD_NAME, $name, DFC::EXACT); 

           $oEquipmentCategories = new EquipmentCategoriesExt($db);
           $arrayEquipmentCategories = $oEquipmentCategories->findByFilter($db, $filter, true);

           if ( count( $arrayEquipmentCategories ) > 0 ) { 
                throw new Exception(ExceptionMessages::DuplicateEquipmentCategoryValue." : ".$name, ExceptionCodes::DuplicateEquipmentCategoryValue);
           }     
        
        //$equipment_category_id===========================================================================
        if (! trim($equipment_category_id) )
            throw new Exception(ExceptionMessages::MissingEquipmentCategoryIdValue." : ".$equipment_category_id, ExceptionCodes::MissingEquipmentCategoryIdValue);
        else if (!is_numeric($equipment_category_id) || ( $equipment_category_id < 0)  )
            throw new Exception(ExceptionMessages::InvalidEquipmentCategoryIdValue." : ".$equipment_category_id, ExceptionCodes::InvalidEquipmentCategoryIdValue);
        else 
            $uEquipmentCategories = EquipmentCategoriesExt::findById($db, $equipment_category_id);

        //=================================================================================================
        $result["total_found"]=count($uEquipmentCategories);
        
        if ($result["total_found"]==1){
              
                $values["equipment_category_id"] = $uEquipmentCategories->getEquipmentCategoryId();
                $values["name"] = $uEquipmentCategories->getName();
                $result["values"] = $values;
               
                $update_values["equipment_category_id"] = $equipment_category_id;
                $update_values["name"] = $name;
                $result["updated_values"] = $update_values;
                              
                $uEquipmentCategories->setName($name);
                $uEquipmentCategories->updateToDatabase($db);
               
                $result["status"] = 200;
                $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success"; 

        } else if ($result["total_found"]==0){
            throw new Exception(ExceptionMessages::UpdateEquipmentCategoryIdValue." : ".$equipment_category_id, ExceptionCodes::UpdateEquipmentCategoryIdValue);
        } else {
           throw new Exception(ExceptionMessages::DuplicateEquipmentCategoryIdValue." : ".$equipment_category_id, ExceptionCodes::DuplicateEquipmentCategoryIdValue);
        }
        
    } catch (Exception $e){      
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    }  
    return $result;
}

?>