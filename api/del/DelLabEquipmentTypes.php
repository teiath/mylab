
<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $app
 * @param type $lab_id
 * @param type $equipment_type
 * @return string
 * @throws Exception
 */


function DelLabEquipmentTypes($lab_id,$equipment_type) {
    global $db;
    global $app;
    
    $result = array();  
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    $result["lab_id"] = $lab_id;
    $result["equipment_type"] = $equipment_type;
    
    try {
             
        //$lab_id==============================================================      
        if (Validator::isMissing('lab_id'))
            throw new Exception(ExceptionMessages::MissingLabParam." : ".$lab_id, ExceptionCodes::MissingLabParam);
        else if (Validator::IsNull($lab_id) )
            throw new Exception(ExceptionMessages::MissingLabValue." : ".$lab_id, ExceptionCodes::MissingLabValue);
        else if (!Validator::IsNumeric($lab_id) || Validator::IsNegative($lab_id))
	    throw new Exception(ExceptionMessages::InvalidLabValue." : ".$lab_id, ExceptionCodes::InvalidLabValue);    
        else if (Validator::IsID($lab_id)) {
            $filter[] = new DFC(LabsExt::FIELD_LAB_ID, Validator::ToID($lab_id), DFC::EXACT);     
            
            $oLabs = new LabsExt($db);
            $arrayLabs = $oLabs->findByFilter($db, $filter, true);
            
            if ( count($arrayLabs) === 1 ) { 
                $fLabId = $arrayLabs[0]->getLabId();
            } else if ( count( $arrayLabs ) > 1 ) { 
                throw new Exception(ExceptionMessages::DuplicateLabsIdValue." : ".$lab_id, ExceptionCodes::DuplicateLabsIdValue);
            } else {
                throw new Exception(ExceptionMessages::InvalidLabIdValue." : ".$lab_id, ExceptionCodes::InvalidLabIdValue);
            }
       
        }
        else
            throw new Exception(ExceptionMessages::UnknownLabIdValue." : ".$lab_id, ExceptionCodes::UnknownLabIdValue);             
  
        //$equipment_type========================================================================
        $oEquipmentTypes = new EquipmentTypesExt($db);
        $oEquipmentTypes->getAll($db);
        
         if (Validator::IsMissing('equipment_type'))
              throw new Exception(ExceptionMessages::MissingEquipmentTypeParam." : ".$equipment_type, ExceptionCodes::MissingEquipmentTypeParam);    
         else if (Validator::IsNull($equipment_type))
             throw new Exception(ExceptionMessages::MissingEquipmentTypeValue." : ".$equipment_type, ExceptionCodes::MissingEquipmentTypeValue); 
         else if (Validator::IsID($equipment_type)) 
             $filter = array( new DFC(EquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, Validator::ToID($equipment_type),DFC::EXACT) );                      
         else if (Validator::IsValue($equipment_type)) {
             $oEquipmentTypes->searchArrayForValue(Validator::ToValue($equipment_type));
             $filter  =array(  new DFC(EquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $oEquipmentTypes->getEquipmentTypeId(), DFC::EXACT) );          
         }  else 
             throw new Exception(ExceptionMessages::InvalidEquipmentTypeInputValue." : ".$equipment_type, ExceptionCodes::InvalidEquipmentTypeInputValue); 

         $arrayEquipmentTypes = $oEquipmentTypes->findByFilter($db, $filter, true);  

         if ( count( $arrayEquipmentTypes ) === 1 ) { 
             $fEquipmentType= $arrayEquipmentTypes[0]->getEquipmentTypeId();
         } else if ( count( $arrayEquipmentTypes ) > 1 ) { 
             throw new Exception(ExceptionMessages::DuplicateEquipmentTypeIdValue." : ".$equipment_type, ExceptionCodes::DuplicateEquipmentTypeIdValue);
         } else {
             throw new Exception(ExceptionMessages::InvalidEquipmentTypeValue." : ".$equipment_type, ExceptionCodes::InvalidEquipmentTypeValue);                            
         }     
        
        try{      
        
            $db->beginTransaction();  
       
            

            //1rst version of delete from db by filter
            //if filter is null, this delete all rows from db!!!
            //           
//            $dLabEquipmentTypes = new LabEquipmentTypesExt($db);
//            $filter= array();
//            $filter = array(new DFC(LabEquipmentTypesExt::FIELD_LAB_ID, $fLabId, DFC::EXACT),
//                            new DFC(LabEquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID,$fEquipmentType, DFC::EXACT)
//                        );   
//            
//            $arrayLabEquipmentTypes = $dLabEquipmentTypes->findByFilter($db, $filter, true); 
//            $exist=count($arrayLabEquipmentTypes);
//            $result["lab_equipment_type_exists"]=$exist;
//
//            if (Validator::IsEmptyArray($arrayLabEquipmentTypes)){
//                throw new Exception(ExceptionMessages::DeleteNotFoundAquisitionSources ." found row = ". $exist." lab_id: " . $fLabId . " equipment_type: " . $fEquipmentType , ExceptionCodes::DeleteNotFoundAquisitionSources);
//            } else {
//                $dLabEquipmentTypes->deleteByFilter($db, $filter);
//            }
            
            
            //2nd version of delete from db (check primary keys for existed or not in database)     
            $dLabEquipmentType = new LabEquipmentTypesExt($db);
            $dLabEquipmentType->setLabId($fLabId);
            $dLabEquipmentType->setEquipmentTypeId($fEquipmentType);

                if (!$dLabEquipmentType->existsInDatabase($db))
                    throw new Exception(ExceptionMessages::DeleteNotFoundAquisitionSources ." lab_id: " . $fLabId . " equipment_type: " . $fEquipmentType  , ExceptionCodes::DeleteNotFoundAquisitionSources);
                else{         
                    $dLabEquipmentType->deleteFromDatabase($db);
                }
            
        
                   
            $db->commit();  
            $result["status"] = 200;
            $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success"; 
            
        }
        
            catch (PDOException $e)
        {
            $db->rollBack();
            $result["status_pdo_internal"] = $e->getCode();
            $result["message_pdo_internal"] = "[".$result["method"]."]: ".$e->getMessage().", SQL:".$e->getTraceAsString();

        }
            catch (Exception $e) 
        {
            $db->rollBack();
            $result["status_internal"] = $e->getCode();
            $result["message_internal"] = "[".$result["method"]."]: ".$e->getMessage();
        }
        
    } catch (Exception $ex){ 
        $result["status"] = $ex->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$ex->getMessage();
    } 
    return $result;
}

?>