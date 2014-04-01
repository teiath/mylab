<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $lab_id
 * @param type $equipment_type
 * @param type $new_equipment_type
 * @param type $items
 * @return string
 * @throws Exception
 */

function PutLabsHaveEquipmentTypes($lab_id,$equipment_type,$new_equipment_type,$items) {
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
        
        //$lab_id===========================================================================  
        if (! $lab_id) {
            throw new Exception(ExceptionMessages::MissingLabValue." : ".$lab_id, ExceptionCodes::MissingLabValue);
        } else if (!is_numeric($lab_id)) {
            throw new Exception(ExceptionMessages::InvalidLabValue." : ".$lab_id, ExceptionCodes::InvalidLabValue);
        } else {
            $oLabs = new LabsExt($db);
            $filter = new DFC(labsExt::FIELD_LAB_ID, $lab_id, DFC::EXACT);
            $arrayLabs = $oLabs->findByFilter($db, $filter, true);
        }
                
        if ( count( $arrayLabs ) === 1 ) { 
            $fLabId = $arrayLabs[0]->getLabId();
        } else if ( count( $arrayLabs ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicateLabsIdValue." : ".$lab_id, ExceptionCodes::DuplicateLabsIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidLabIdValue." : ".$lab_id, ExceptionCodes::InvalidLabIdValue);
        }
        
        //$equipment_type_id============================================================    
        if (! $equipment_type) {
            throw new Exception(ExceptionMessages::MissingEquipmentTypeIdValue." : ".$equipment_type, ExceptionCodes::MissingEquipmentTypeIdValue);
        } else  if (is_numeric($equipment_type)) {
            $oEquipmentTypes = new EquipmentTypesExt($db);
            $filter = array( new DFC(EquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $equipment_type, DFC::EXACT) );
            $arrayEquipmentTypes = $oEquipmentTypes->findByFilter($db, $filter, true);  
        } else if ($equipment_type) {
            $oEquipmentTypes = new EquipmentTypesExt($db);
            $filter = array( new DFC(EquipmentTypesExt::FIELD_NAME, $equipment_type, DFC::EXACT) );
            $arrayEquipmentTypes = $oEquipmentTypes->findByFilter($db, $filter, true);
        }
        
        if ( count( $arrayEquipmentTypes ) === 1 ) { 
            $fEquipmentType= $arrayEquipmentTypes[0]->getEquipmentTypeId();
        } else if ( count( $arrayEquipmentTypes ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicateEquipmentTypeIdValue." : ".$equipment_type, ExceptionCodes::DuplicateEquipmentTypeIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidEquipmentTypeValue." : ".$equipment_type, ExceptionCodes::InvalidEquipmentTypeValue);
        }
        
        //$new_equipment_type_id============================================================    
        if (! $new_equipment_type) {
            throw new Exception(ExceptionMessages::MissingNewEquipmentTypeIdValue." : ".$new_equipment_type, ExceptionCodes::MissingNewEquipmentTypeIdValue);
        } else  if (is_numeric($new_equipment_type)) {
            $oEquipmentTypes = new EquipmentTypesExt($db);
            $filter = array( new DFC(EquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $new_equipment_type, DFC::EXACT) );
            $arrayEquipmentTypes = $oEquipmentTypes->findByFilter($db, $filter, true);  
        } else if ($new_equipment_type) {
            $oEquipmentTypes = new EquipmentTypesExt($db);
            $filter = array( new DFC(EquipmentTypesExt::FIELD_NAME, $new_equipment_type, DFC::EXACT) );
            $arrayEquipmentTypes = $oEquipmentTypes->findByFilter($db, $filter, true);
        }
        
        if ( count( $arrayEquipmentTypes ) === 1 ) { 
            $fnewEquipmentType= $arrayEquipmentTypes[0]->getEquipmentTypeId();
        } else if ( count( $arrayEquipmentTypes ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicateEquipmentTypeIdValue." : ".$new_equipment_type, ExceptionCodes::DuplicateEquipmentTypeIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidNewEquipmentTypeValue." : ".$new_equipment_type, ExceptionCodes::InvalidNewEquipmentTypeValue);
        }

        //$items==================================================================================        
        if (!$items) {
            throw new Exception(ExceptionMessages::MissingItemValue." : ".$items, ExceptionCodes::MissingItemValue);
        } else if (!is_numeric($items) || $items<=0 || $items>10000 ){
            throw new Exception(ExceptionMessages::InvalidItemValue." : ".$items, ExceptionCodes::InvalidItemValue);
        } else {
            $fitems=$items;
        }
            
        //==================================================================================   
        
        $uLabsHaveEquipmentTypes = LabsHaveEquipmentTypesExt::findById($db, $fLabId, $fEquipmentType);
        $unewLabsHaveEquipmentTypes = LabsHaveEquipmentTypesExt::findById($db, $fLabId, $fnewEquipmentType);
        $result["total_found"]=count($uLabsHaveEquipmentTypes);
        $result["new_total_found"]=count($unewLabsHaveEquipmentTypes);
        
        if (($result["total_found"]==1) && ($result["new_total_found"]==0)) {
              
                $values["lab_id"] = $uLabsHaveEquipmentTypes->getLabId();
                $values["equipment_type"] = $uLabsHaveEquipmentTypes->getEquipmentTypeId();
                $values["items"] = $uLabsHaveEquipmentTypes->getItems();
                $result["values"] = $values;
               
                $update_values["lab_id"] = $fLabId;
                $update_values["equipment_type"] = $fnewEquipmentType;
                $update_values["items"] = $fitems;
                $result["updated_values"] = $update_values;
                
                $uLabsHaveEquipmentTypes->deleteFromDatabase($db);
                
                $uLabsHaveEquipmentTypes->setLabId($fLabId);
                $uLabsHaveEquipmentTypes->setEquipmentTypeId($fnewEquipmentType);
                $uLabsHaveEquipmentTypes->setItems($fitems);
                $uLabsHaveEquipmentTypes->insertIntoDatabase($db);

                $result["status"] = 200;
                $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success"; 
                
        } else if (($result["total_found"]==1) && ($result["new_total_found"]==1)){
            throw new Exception(ExceptionMessages::DuplicateLabHasEquipmentTypeValue." lab_id : ".$fLabId."  new_equipment_type : ".$fnewEquipmentType ,  ExceptionCodes::DuplicateLabHasEquipmentTypeValue);
        } else if ($result["total_found"]==0){
            throw new Exception(ExceptionMessages::UpdateLabHasEquipmentTypeIdValue." lab_id : ".$fLabId."  equipment_type : ".$fEquipmentType,  ExceptionCodes::UpdateLabHasEquipmentTypeIdValue);
        } else {
           throw new Exception(ExceptionMessages::DuplicateLabHasEquipmentTypeIdValue." lab_id : ".$fLabId."  equipment_type : ".$fEquipmentType ,  ExceptionCodes::DuplicateLabHasEquipmentTypeIdValue);
        }
        
    } catch (Exception $e){      
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    }  
    return $result;
}

?>