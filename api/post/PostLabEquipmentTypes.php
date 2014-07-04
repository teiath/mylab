<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $app
 * @param type $lab_id
 * @param type $equipment_type
 * @param type $items
 * @param type $equipment_types
 * @return string
 * @throws Exception
 */

function PostLabEquipmentTypes($lab_id, $equipment_type, $items, $multiple_equipment_types) 

{
    
    global $db;
    global $app;


    $result = array();  
    $result["data"] = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);

    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = $app->request->getBody();
    
    $result["lab_id"] = $lab_id;
    $result["equipment_type"] = $equipment_type;
    $result["items"] = $items;
    $result["equipment_types"] = $multiple_equipment_types;
      
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
        
        //check if equipment_type is multiple input or not============================================================         
        if (Validator::IsExists('equipment_type') && Validator::isMissing('items')) 
            throw new Exception(ExceptionMessages::MissingItemsParam." : ".$lab_id, ExceptionCodes::MissingItemsParam);      
         else if (Validator::IsExists('items') && Validator::isMissing('equipment_type')) 
            throw new Exception(ExceptionMessages::MissingEquipmentTypeParam." : ".$lab_id, ExceptionCodes::MissingEquipmentTypeParam);      
         else if (Validator::IsExists('equipment_type') && Validator::IsExists('items') && Validator::isMissing('multiple_equipment_types')) 
            $equipment_types = $equipment_type . '=' .$items; 
         else if (Validator::isMissing('equipment_type') && Validator::isMissing('items') && Validator::IsExists('multiple_equipment_types')) 
            $equipment_types = $multiple_equipment_types;
         else if (Validator::isMissing('equipment_type') && Validator::isMissing('items') && Validator::isMissing('multiple_equipment_types')) 
            throw new Exception(ExceptionMessages::MissingLabEquipmentTypeParam." : ".$lab_id, ExceptionCodes::MissingLabEquipmentTypeParam);
         else 
            throw new Exception(ExceptionMessages::NotAllowedLabEquipmentTypes." : ".$lab_id, ExceptionCodes::NotAllowedLabEquipmentTypes);      
        
        
        
         //$equipment_types============================================================    
//        if (Validator::IsMissing('equipment_types'))
//            throw new Exception(ExceptionMessages::MissingEquipmentTypesParam." : ".$lab_id, ExceptionCodes::MissingEquipmentTypesParam);      
//        else {
 
         if (Validator::IsValue($equipment_types)){
     
            //count equipment_types data from equipment_types table and return at EquipmentTypeId
            $count_vbl_equipment_types = EquipmentTypesExt::getAllCount($db);
            $count_equipment_types_vbl = $count_vbl_equipment_types[0]->getEquipmentTypeId();

            //count equipment_types data from user input at GET request
            if (Validator::IsNull($equipment_types))
                throw new Exception(ExceptionMessages::MissingEquipmentTypeIdValue." : ".$equipment_types, ExceptionCodes::MissingEquipmentTypeIdValue);  
            else if (Validator::IsValue($equipment_types))
                $count_equipment_types = Validator::ToArray($equipment_types);
            else if (Validator::IsArray($equipment_types))
                $count_equipment_types  = Validator::ToArray($equipment_types);
            else 
                throw new Exception(ExceptionMessages::InvalidEquipmentTypeInputValue." : ".$equipment_types, ExceptionCodes::InvalidEquipmentTypeInputValue); 

            //$count_equipment_types = preg_split("/[\s]*[,][\s]*/", $equipment_types);  
            $count_equipment_types_usr = count( $count_equipment_types );
                
            //check if user has input more variable than equipment_types vocabulary
             if ( $count_equipment_types_usr <= $count_equipment_types_vbl ) {     
                
                $oEquipmentTypes = new EquipmentTypesExt($db);
                $oEquipmentTypes->getAll($db);
                 
                foreach ($count_equipment_types as $equipment_type){
                    
                    //split equipment_types data to equipment_type and items
                    if (Validator::IsArray($equipment_type,'='))
                        $split_equipment_types  = Validator::ToArray($equipment_type,'=');
                    else 
                        throw new Exception(ExceptionMessages::InvalidEquipmentTypeInputValue." : ".$equipment_type, ExceptionCodes::InvalidEquipmentTypeInputValue); 
                   

                    //$split_equipment_types = preg_split("/[\s]*[=][\s]*/", $equipment_type);  
                    $count_equipment_types_internal = count( $split_equipment_types );

                    if ($count_equipment_types_internal == '2') {
                       
                        //$equipment_types========================================================================
                        if (Validator::IsNull($split_equipment_types[0])){
                            throw new Exception(ExceptionMessages::MissingEquipmentTypeIdValue." : ".$split_equipment_types[0], ExceptionCodes::MissingEquipmentTypeIdValue); 
                        }else if (Validator::IsID($split_equipment_types[0])) {
                            $filter = array( new DFC(EquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, Validator::ToID($split_equipment_types[0]),DFC::EXACT) );
                           // $arrayEquipmentTypes = $oEquipmentTypes->findByFilter($db, $filter, true);                       
                        } else if (Validator::IsValue($split_equipment_types[0])) {
                            $oEquipmentTypes->searchArrayForValue(Validator::ToValue($split_equipment_types[0]));
                            $filter  =array(  new DFC(EquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $oEquipmentTypes->getEquipmentTypeId(), DFC::EXACT) );
                           // $arrayEquipmentTypes = $oEquipmentTypes->findByFilter($db, $filter, true);             
                        }  else 
                            throw new Exception(ExceptionMessages::InvalidEquipmentTypeInputValue." : ".$split_equipment_types[0], ExceptionCodes::InvalidEquipmentTypeInputValue); 
             

                        $arrayEquipmentTypes = $oEquipmentTypes->findByFilter($db, $filter, true);  
                        
                        if ( count( $arrayEquipmentTypes ) === 1 ) { 
                            $fEquipmentType= $arrayEquipmentTypes[0]->getEquipmentTypeId();
                        } else if ( count( $arrayEquipmentTypes ) > 1 ) { 
                            throw new Exception(ExceptionMessages::DuplicateEquipmentTypeIdValue." : ".$split_equipment_types[0], ExceptionCodes::DuplicateEquipmentTypeIdValue);
                        } else {
                            throw new Exception(ExceptionMessages::InvalidEquipmentTypeValue." : ".$split_equipment_types[0], ExceptionCodes::InvalidEquipmentTypeValue);                            
                        }
                            
                        //$items==================================================================================        
                        if (Validator::IsNull($split_equipment_types[1])) {
                            throw new Exception(ExceptionMessages::MissingItemValue." : ".$split_equipment_types[1], ExceptionCodes::MissingItemValue);
                        } else if (!Validator::IsNumeric($split_equipment_types[1]) || Validator::ToNumeric($split_equipment_types[1])<=0 || Validator::ToNumeric($split_equipment_types[1]) > 10000 ){
                            throw new Exception(ExceptionMessages::InvalidItemValue." : ".$split_equipment_types[1], ExceptionCodes::InvalidItemValue);
                        } else {
                            $fitems=Validator::ToNumeric($split_equipment_types[1]);
                        }
                        
                       if (($fEquipmentType!="") && ($fitems!="")){
                            $values_eqt_src [] = array("equipment_type"=>$fEquipmentType , "items"=>$fitems ) ;
                        }
      
                    }else {
                      throw new Exception(ExceptionMessages::InsertErrorFormatEquipmentTypes.$equipment_type, ExceptionCodes::InsertErrorFormatEquipmentTypes);   
                    }
                }
               
                sort($values_eqt_src);

                $results_eqt_src = array();
                foreach ($values_eqt_src as $val) {
                    if (!isset($results_eqt_src[$val['equipment_type']]))
                        $results_eqt_src[$val['equipment_type']] = $val;                      
                    else
                        //$result["duplicate_equipment_types"]=$values_eqt_src;
                        throw new Exception(ExceptionMessages::InsertDuplicateEquipmentTypes.$equipment_type, ExceptionCodes::InsertDuplicateEquipmentTypes);
                }
                
            }else{
               throw new Exception(ExceptionMessages::InsertMoreVariablesEquipmentTypes.$count_equipment_types_vbl, ExceptionCodes::InsertMoreVariablesEquipmentTypes); 
           }
        
        }
        //=====================================================================================================================================================================    
  
        //user permisions 
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array($fLabId,$permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToPostLab, ExceptionCodes::NoPermissionToPostLab); 
         };
     
        try{
            
        $db->beginTransaction();    
        
        //insert to equipment_types table =========================================================
        if ((count($results_eqt_src ) > 0)){     
                    
            //$result["test_equipment"]= $results_eqt_src;
            foreach ($results_eqt_src as $EquipmentType) {

            $oLabEquipmentTypes = new LabEquipmentTypesExt($db);
            $oLabEquipmentTypes->setLabId($fLabId);
            $oLabEquipmentTypes->setEquipmentTypeId($EquipmentType["equipment_type"]);
            $oLabEquipmentTypes->setItems($EquipmentType["items"]);

            //check with double primary keys (lab_id,equipment_type_id)
            $result["equipment_exists"]=$oLabEquipmentTypes->existsInDatabase($db);

                if ( $result["equipment_exists"]==true ) { 
                    throw new Exception(ExceptionMessages::DuplicateLabHasEquipmentTypeValue." lab_id : ".$fLabId."  equipment_type_id : ".$EquipmentType["equipment_type"] , ExceptionCodes::DuplicateLabHasEquipmentTypeValue);
                } else {
                    $oLabEquipmentTypes->insertIntoDatabase($db);;    
                }
           }
            
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