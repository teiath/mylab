<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @param type $lab_id
 * @param type $equipment_type
 * @return string
 * @throws Exception
 */


function PostLabsHaveEquipmentTypes($lab_id,$equipment_type,$items) {
    global $db;
    global $Options;
    global $app;
    
    $result = array();  
    $result["data"] = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    $result["lab_id"] = $lab_id;
    $result["equipment_type"] = $equipment_type;
    $result["items"] = $items;
    
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

        //$items==================================================================================        
        if (!$items) {
            throw new Exception(ExceptionMessages::MissingItemValue." : ".$items, ExceptionCodes::MissingItemValue);
        } else if (!is_numeric($items) || $items<=0 || $items>10000 ){
            throw new Exception(ExceptionMessages::InvalidItemValue." : ".$items, ExceptionCodes::InvalidItemValue);
        } else {
            $fitems=$items;
        }
        
        //========================================================================================    

        $oLabsHaveEquipmentTypes = new LabsHaveEquipmentTypesExt($db);
        $oLabsHaveEquipmentTypes->setLabId($fLabId);
        $oLabsHaveEquipmentTypes->setEquipmentTypeId($fEquipmentType);
        $oLabsHaveEquipmentTypes->setItems($fitems);
        
        $result["exists"]=$oLabsHaveEquipmentTypes->existsInDatabase($db);
        
            if ( $result["exists"]==true ) { 
                throw new Exception(ExceptionMessages::DuplicateLabHasEquipmentTypeValue." lab_id : ".$fLabId."  equipment_type_id : ".$fEquipmentType , ExceptionCodes::DuplicateLabHasEquipmentTypeValue);
            } else {
                $oLabsHaveEquipmentTypes->insertIntoDatabase($db);;    
            }
            
        $result["status"] = 200;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";
    } catch (Exception $e){ 
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
}

?>