<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $app
 * @param type $lab_id
 * @param type $lab_equipment_type
 * @param type $items
 * @return string
 * @throws Exception
 */


function PutLabEquipmentTypes($lab_id,$equipment_type,$items) {
    global $db;
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
              
        //$items==================================================================================
        if (Validator::IsMissing('items')) {
            throw new Exception(ExceptionMessages::MissingItemsParam." : ".$items, ExceptionCodes::MissingItemsParam);              
        } else if (Validator::IsNull($items)) {
            throw new Exception(ExceptionMessages::MissingItemValue." : ".$items, ExceptionCodes::MissingItemValue);
      //} else if (!Validator::IsNumeric($items) || Validator::ToNumeric($items)<=0 || Validator::ToNumeric($items) > 10000 ){
        } else if (!Validator::IsNumeric($items) || Validator::isLowerThan($items, 0, true) || Validator::isGreaterThan($items, 10000, true) ){
            throw new Exception(ExceptionMessages::InvalidItemValue." : ".$items, ExceptionCodes::InvalidItemValue);
        } else {
            $fitems=Validator::ToNumeric($items);
        }
        
        try{
            
        $db->beginTransaction();    

               
            $oLabEquipmentTypes = new LabEquipmentTypesExt($db);

            //check if user update a row with same values of row
            $filter= array();
            $filter = array(new DFC(LabEquipmentTypesExt::FIELD_LAB_ID, $fLabId, DFC::EXACT),
                            new DFC(LabEquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID,$fEquipmentType, DFC::EXACT),
                            new DFC(LabEquipmentTypesExt::FIELD_ITEMS,$fitems, DFC::EXACT)
                        );   
            
            $arrayLabEquipmentTypes = $oLabEquipmentTypes->findByFilter($db, $filter, true); 
            $exist=count($arrayLabEquipmentTypes);
            $result["lab_equipment_type_exists"]=$exist;

                         
                if (!Validator::IsEmptyArray($arrayLabEquipmentTypes) && !Validator::IsArray($arrayLabEquipmentTypes)){
                    throw new Exception(ExceptionMessages::DuplicateLabEquipmentTypeValue ." found duplicates = ". $exist." lab_id: " . $fLabId . " equipment_type: " . $fEquipmentType . " items: " . $fitems , ExceptionCodes::DuplicateLabEquipmentTypeValue);
                } else {
                     
               //1rst version
//                        $updateFilter=array();
//                        $updateFilter  = array( new DFC(LabEquipmentTypesExt::FIELD_LAB_ID, $fLabId, DFC::EXACT),
//                                                new DFC(LabEquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID,$fEquipmentType, DFC::EXACT)
//                                                ); 
//            
//                        
//                        $oLabEquipmentType = new LabEquipmentTypesExt($db);
//                        $updateLabEquipmentTypes = $oLabEquipmentType->findByFilter($db, $updateFilter, true);
//                          
//                        if (Validator::IsEmptyArray($updateLabEquipmentTypes))
//                            throw new Exception(ExceptionMessages::UpdateLabEquipmentTypesValue , ExceptionCodes::UpdateLabEquipmentTypesValue);
//                        else{
//                            
//                            foreach($updateLabEquipmentTypes as $updateLabEquipmentType)
//                            {
//                                $updateLabEquipmentType->setItems($fitems);
//                                $updateLabEquipmentType->updateToDatabase($db);
//                            }   
//                        }    
                    
               //2nd version (check primary keys for existed or not in database)     
                     $uLabEquipmentType = new LabEquipmentTypesExt($db);
                     $uLabEquipmentType->setLabId($fLabId);
                     $uLabEquipmentType->setEquipmentTypeId($fEquipmentType);
                                     
                     if (!$uLabEquipmentType->existsInDatabase($db))
                        throw new Exception(ExceptionMessages::UpdateLabEquipmentTypesValue ." lab_id: " . $fLabId . " equipment_type: " . $fEquipmentType  , ExceptionCodes::UpdateLabEquipmentTypesValue);
                    else{         
                        $uLabEquipmentType->setItems($fitems);
                        $uLabEquipmentType->updateToDatabase($db);
                    }
                        
            
                    
      
                    
                        
   //3rd version (has bug at self::bindValuesForFilter($stmt, $filter) )
//
//                        $updateFilter = array();
//                        $updateFilter = array( new DFC(LabEquipmentTypesExt::FIELD_LAB_ID, $fLabId, DFC::EXACT),
//                                               new DFC(LabEquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID,$fEquipmentType, DFC::EXACT)
//                                              ); 
//
//                        $oLabEquipmentType = new LabEquipmentTypesExt($db);
//                        $updateLabEquipmentTypes = $oLabEquipmentType->findByFilter($db, $updateFilter, true);
//                          
//                        if (Validator::IsEmptyArray($updateLabEquipmentTypes))
//                            throw new Exception(ExceptionMessages::UpdateLabEquipmentTypesValue , ExceptionCodes::UpdateLabEquipmentTypesValue);
//                        else{
//                                          
//                      
//                        $updateFields='items = ' . $fitems;
//                        $updateLabWorkers = $oLabEquipmentType->updateByFilter($db, $updateFilter, $updateFields, true);
//                        $result["items_update"]=$updateLabWorkers;
//                        }

        //4th version
                    
//                     $uLabEquipmentType = new LabEquipmentTypesExt($db);
//                     $uLabEquipmentType->setLabId($fLabId);
//                     $uLabEquipmentType->setEquipmentTypeId($fEquipmentType);
//                                     
//                     if (!$uLabEquipmentType->existsInDatabase($db))
//                        throw new Exception(ExceptionMessages::UpdateLabEquipmentTypesValue ." lab_id: " . $fLabId . " equipment_type: " . $fEquipmentType , ExceptionCodes::UpdateLabEquipmentTypesValue);
//                    else{  
//                    
//                            $sqlUpdate = "UPDATE lab_equipment_types SET ";
//                            $sqlFields = "items = " . $fitems ." ";
//                            $sqlWhere  = "WHERE lab_id = " . $fLabId . " AND equipment_type_id = " . $fEquipmentType;
//                            $sql = $sqlUpdate . $sqlFields . $sqlWhere;
//                            $db->query( $sql );
//                    }
                    
                }
   

       
        $db->commit();  
        $result["status"] = 200;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";
        
        
         }
            catch (PDOException $e)
        {
            $db->rollBack();
            $result["status_pdo_internal"] = $e->getCode();
            $result["message_pdo_internal"] = "[".$result["method_pdo_internal"]."]: ".$e->getMessage().", SQL:".$e->getTraceAsString();

        }
            catch (Exception $e) 
        {
            $db->rollBack();
            $result["status_internal"] = $e->getCode();
            $result["message_internal"] = "[".$result["method_internal"]."]: ".$e->getMessage();
        } 
    
        
    } catch (Exception $ex){ 
        $result["status"] = $ex->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$ex->getMessage();
    } 
    return $result;
}

?>