<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @param type $name
 * @return string
 * @throws Exception
 */

function DelEquipmentTypes($name) {
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
            throw new Exception(ExceptionMessages::DeleteEquipmentTypeNameValue." : ".$name, ExceptionCodes::DeleteEquipmentTypeNameValue);
        } else {
            $filter = array( new DFC(EquipmentTypesExt::FIELD_NAME,$name, DFC::EXACT) );   
            $oEquipmentTypes = new EquipmentTypesExt($db);
            $arrayEquipmentTypes = $oEquipmentTypes->findByFilter($db, $filter, true);
        }

        if ( count($arrayEquipmentTypes) < 1) {
            throw new Exception(ExceptionMessages::DeleteNotFoundEquipmentTypeNameValue." : ".$name, ExceptionCodes::DeleteNotFoundEquipmentTypeNameValue);
        } else if ( count($arrayEquipmentTypes) == 1) {
            $EquipmentTypeId = $arrayEquipmentTypes[0]->getEquipmentTypeId();
            $EquipmentTypeName = $arrayEquipmentTypes[0]->getName();
            $result["result_found"]="Equipment_type_id = ".$EquipmentTypeId." // Name = ".$EquipmentTypeName;     
        } else {
            throw new Exception(ExceptionMessages::DuplicateDelEquipmentTypeNameValue." : ".$name, ExceptionCodes::DuplicateDelEquipmentTypeNameValue);
        }

        //check for references============================================================================== 
        
        $oLabsHaveEquipmentTypes = new LabsHaveEquipmentTypesExt($db);
        $filter[] = new DFC(LabsHaveEquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $EquipmentTypeId, DFC::EXACT); 
        $countRows = $oLabsHaveEquipmentTypes->findByFilter($db, $filter, true);
        $result["references_count"]=count( $countRows );
        
        if ($result["references_count"]!=0){
            $oEquipmentTypes->getAll($db);
            
            foreach ($countRows as $row) {
                    $result["data_references"][] = array("lab_id" => $row->getLabId(),                            
                                                        "equipment_type_id" => $row->getEquipmentTypeId(),                                    
                                                        "equipment_type_name"=>$oEquipmentTypes->searchArrayForID( $row->getEquipmentTypeId() )->getName(),
                                                        "items"=>$row->getItems()
                    );
            }
            throw new Exception(ExceptionMessages::ReferencesLabsHaveEquipmentTypes, ExceptionCodes::ReferencesLabsHaveEquipmentTypes);       
        } else {
            $arrayEquipmentTypes[0]->deleteByFilter($db, $filter);  
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