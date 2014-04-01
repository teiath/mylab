<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $equipment_type_id
 * @param type $name
 * @param type $number
 * @param type $equipment_category
 * @return string
 * @throws Exception
 */

function PutEquipmentTypes($equipment_type_id,$name,$number,$equipment_category) {
    global $db;
    global $Options;
    global $app;
    
    $result = array();
    $values = array();
    $update_values = array();
    $result["data"] = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    
    try {
        
        $fnumber=trim($number);
        
        //$name==========================================================================================
        if (! trim($name) )
            throw new Exception(ExceptionMessages::MissingNameValue." : ".$name, ExceptionCodes::MissingNameValue);
        else
            $filter[] = new DFC(EquipmentTypesExt::FIELD_NAME, $name, DFC::EXACT);   
    
        //$equipment_category============================================================          
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

        //$equipment_type_id===========================================================================
            if (! trim($equipment_type_id) )
                throw new Exception(ExceptionMessages::MissingEquipmentTypeIdValue." : ".$equipment_type_id, ExceptionCodes::MissingEquipmentTypeIdValue);
            else if (!is_numeric($equipment_type_id) || ( $equipment_type_id < 0)  )
                throw new Exception(ExceptionMessages::InvalidEquipmentTypeIdValue." : ".$equipment_type_id, ExceptionCodes::InvalidEquipmentTypeIdValue);
            else 
                $uEquipmentTypes = EquipmentTypesExt::findById($db, $equipment_type_id);

        //=================================================================================================
        $result["total_found"]=count($uEquipmentTypes);
                                                                                                            
        if ($result["total_found"]==1){
            
            $values["equipment_type_id"] = $uEquipmentTypes->getEquipmentTypeId();
            $values["name"] = $uEquipmentTypes->getName();
            $values["number"] = $uEquipmentTypes->getNumber();             
            $values["equipment_category"] = $uEquipmentTypes->getEquipmentCategoryId();
            $result["values"] = $values;
            
            //check if $name is same as old name of same entry
            $oEquipmentTypes = new EquipmentTypesExt($db);
            $arrayEquipmentTypes = $oEquipmentTypes->findByFilter($db, $filter, true);

                if (( count( $arrayEquipmentTypes ) > 0 ) && ($values["name"]!=$name)) { 
                     throw new Exception(ExceptionMessages::DuplicateEquipmentTypeValue." : ".$name, ExceptionCodes::DuplicateEquipmentTypeValue);
                }  
            
            $update_values["equipment_type_id"] = $equipment_type_id;
            $update_values["name"] = $name;
            $update_values["number"] = $fnumber;
            $update_values["equipment_category"] = $fEquipmentCategory;
            $result["updated_values"] = $update_values;
            
            $uEquipmentTypes->setName($name);
            $uEquipmentTypes->setNumber($fnumber);
            $uEquipmentTypes->setEquipmentCategoryId($fEquipmentCategory);
            $uEquipmentTypes->updateToDatabase($db);

            $result["status"] = 200;
            $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success"; 

        } else if ($result["total_found"]==0){
            throw new Exception(ExceptionMessages::UpdateEquipmentTypeIdValue." : ".$equipment_type_id, ExceptionCodes::UpdateEquipmentTypeIdValue);
        } else {
           throw new Exception(ExceptionMessages::DuplicateEquipmentTypeIdValue." : ".$equipment_type_id, ExceptionCodes::DuplicateEquipmentTypeIdValue);
        }
        
    } catch (Exception $e){      
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    }  
    return $result;
}

?>