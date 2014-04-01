<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $lab_id
 * @param type $equipment_type
 * @return string
 * @throws Exception
 */

function DelLabsHaveEquipmentTypes($lab_id,$equipment_type) {
    global $db;
    global $Options;
    global $app;
    
    $result = array();  
    $result["data"] = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    $result["del_lab_id"] = $lab_id;
    $result["equipment_type"] = $equipment_type;
    
    try {
             
        //$lab===========================================================================   
        if (! trim($lab_id) ) {
            throw new Exception(ExceptionMessages::DeleteLabHasEquipmentTypeLabIdValue." : ".$lab_id, ExceptionCodes::DeleteLabHasEquipmentTypeLabIdValue);
        } else if (!is_numeric($lab_id)) {
            throw new Exception(ExceptionMessages::InvalidLabValue." : ".$lab_id, ExceptionCodes::InvalidLabValue);
        } else {
            $oLabsHaveEquipmentTypes = new LabsHaveEquipmentTypesExt($db);
            $filter = new DFC(LabsHaveEquipmentTypesExt::FIELD_LAB_ID, $lab_id, DFC::EXACT);
            $arrayLabs = $oLabsHaveEquipmentTypes->findByFilter($db, $filter, true);
        }

        if ( count($arrayLabs) < 1) {
            throw new Exception(ExceptionMessages::DeleteNotFoundLabHasEquipmentTypeLabIdValue." : ".$lab_id, ExceptionCodes::DeleteNotFoundLabHasEquipmentTypeLabIdValue);
        } else {
            $fLabId = $arrayLabs[0]->getLabId();
        }

        //$equipment_type============================================================    
        if (! $equipment_type) {
            throw new Exception(ExceptionMessages::MissingEquipmentTypeIdValue." : ".$equipment_type, ExceptionCodes::MissingEquipmentTypeIdValue);
        } else  if (is_numeric($equipment_type)) {
            $oLabsHaveEquipmentTypes = new LabsHaveEquipmentTypesExt($db);
            $filter = array( new DFC(LabsHaveEquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $equipment_type, DFC::EXACT) );
            $arrayLabsHaveEquipmentTypes = $oLabsHaveEquipmentTypes->findByFilter($db, $filter, true);  
        } else if ($equipment_type) {
            $oEquipmentTypes = new EquipmentTypesExt($db);
            $filter = array( new DFC(EquipmentTypesExt::FIELD_NAME, $equipment_type, DFC::EXACT) );
            $arrayEquipmentTypes = $oEquipmentTypes->findByFilter($db, $filter, true);
        
                if ( count( $arrayEquipmentTypes ) == 1 ) { 
                    $oEquipmentType = $arrayEquipmentTypes[0]->getEquipmentTypeId();
                    $oLabsHaveEquipmentTypes = new LabsHaveEquipmentTypesExt($db);
                    $filter = array( new DFC(LabsHaveEquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $oEquipmentType, DFC::EXACT) );
                    $arrayLabsHaveEquipmentTypes = $oLabsHaveEquipmentTypes->findByFilter($db, $filter, true);  
                } else if ( count( $arrayEquipmentTypes ) > 1 ) { 
                    throw new Exception(ExceptionMessages::DuplicateEquipmentTypeIdValue." : ".$equipment_type, ExceptionCodes::DuplicateEquipmentTypeIdValue);
                } else {
                    throw new Exception(ExceptionMessages::InvalidEquipmentTypeValue." : ".$equipment_type, ExceptionCodes::InvalidEquipmentTypeValue);
                }
        } 
            
            if ( count( $arrayLabsHaveEquipmentTypes ) < 1 ) { 
                throw new Exception(ExceptionMessages::DeleteNotFoundLabHasEquipmentTypeLabIdValue." : ".$equipment_type, ExceptionCodes::DeleteNotFoundLabHasEquipmentTypeLabIdValue);
            } else {
                $fEquipmentType = $arrayLabsHaveEquipmentTypes[0]->getEquipmentTypeId();
            } 
              
        
        //check for availability============================================================================== 
        
        $dLabsHaveEquipmentTypes = LabsHaveEquipmentTypesExt::findById($db, $fLabId, $fEquipmentType);     
        $result["total_found"]=count($dLabsHaveEquipmentTypes);
     
        if ($result["total_found"]!=0){
  
                $values["lab_id"] = $dLabsHaveEquipmentTypes->getLabId();
                $values["equipment_type"] = $dLabsHaveEquipmentTypes->getEquipmentTypeId();
                $result["values"] = $values;
                $dLabsHaveEquipmentTypes->deleteFromDatabase($db);
                
                $result["status"] = 200;
                $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";  
        } else {
       
                  throw new Exception(ExceptionMessages::DeleteNotFoundEquipmentTypes." : Lab_id = ".$fLabId." // Equipment_type = ".$fEquipmentType, ExceptionCodes::DeleteNotFoundEquipmentTypes);
                     
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