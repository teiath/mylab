
<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $app
 * @param type $lab_id
 * @return string
 * @throws Exception
 */


function DelLabs($lab_id) {
    global $db;
    global $app;
    
    $result = array();  
    $result["data"] = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    $input=array("lab_id"=>$lab_id);
    $result["input"] = $input;
    
    try {
        
        //$lab_id===========================================================================  
        
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
        
     //references 
   
    $oLabAquisitionSources = new LabAquisitionSourcesExt($db);
    $oLabEquipmentTypes = new LabEquipmentTypesExt($db);
    $oLabWorkers = new LabWorkersExt($db);
    $oLabRelations = new LabRelationsExt($db);
    $oLabTransitions = new LabTransitionsExt($db);
    
    $labAquisitionSources[] = new DFC(LabAquisitionSourcesExt::FIELD_LAB_ID, $fLabId, DFC::EXACT);
    $labEquipmentTypes[] = new DFC(LabEquipmentTypesExt::FIELD_LAB_ID, $fLabId, DFC::EXACT);
    $labWorkersFilter[] = new DFC(LabWorkersExt::FIELD_LAB_ID, $fLabId, DFC::EXACT);
    $labRelationsFilter[] = new DFC(LabRelationsExt::FIELD_LAB_ID, $fLabId, DFC::EXACT);
    $labTransitionsFilter[] = new DFC(LabTransitionsExt::FIELD_LAB_ID, $fLabId, DFC::EXACT);   
 
    $arrayLabAquisitionSources = $oLabAquisitionSources->findByFilter($db, $labAquisitionSources, false);  
    $arrayLabEquipmentTypes = $oLabEquipmentTypes->findByFilter($db, $labEquipmentTypes, false);
    $arrayLabWorkers = $oLabWorkers->findByFilter($db, $labWorkersFilter, false);
    $arrayLabRelations = $oLabRelations->findByFilter($db, $labRelationsFilter);
    $arrayLabTransitions = $oLabTransitions->findByFilter($db, $labTransitionsFilter, false);
    
    //1rst version
//        $arrayLabRelations = $oLabRelations->findByFilter($db, $labRelationsFilter);  //return array
//        $result["count"] = $countRows = count($arrayLabRelations);                    //return count of array
//        $result["isEmptyArray"] = Validator::IsEmptyArray($arrayLabRelations);        //return 1(true) if array is empty, (false) if not empty , (null) if not array
//        $result["isArrayType"] = Validator::IsArray($arrayLabRelations,'');           //return if true if array type of (value1,values2,....,value)
//        $result["isArray"] = is_array($arrayLabRelations);                            //return if true if array()
//        
//        foreach ($arrayLabRelations as $row){      
//            echo $row->getLabId().'--';
//        }
        
    //2nd version
//        $oLabRelations->getAll($db, $labRelationsFilter,false);                                 //create object array
//        $result["count"] = $countRows = count($oLabRelations->getObjsArray());                 //return count of object array
//        $result["isEmptyArray"] = Validator::IsEmptyArray($oLabRelations->getObjsArray());     //return 1(true) if array is empty, (false) if not empty , (null) if not array
//        $result["isArrayType"] = Validator::IsArray($oLabRelations->getObjsArray());           //return if true if array type of (value1,values2,....,value)
//        $result["isArray"] = is_array($oLabRelations->getObjsArray());                         //return if  true if array()
//
//        foreach ($oLabRelations->getObjsArray() as $row){      
//            echo $row->getLabId().'--';
//        }    

    if ( (count($arrayLabAquisitionSources) > 0) || (!Validator::IsEmptyArray($arrayLabAquisitionSources)) ) {
       throw new Exception(ExceptionMessages::ReferencesLabAquisitionSources." : ".$lab_id, ExceptionCodes::ReferencesLabAquisitionSources);  
    }
    if ( (count($arrayLabEquipmentTypes) > 0) || (!Validator::IsEmptyArray($arrayLabEquipmentTypes)) ) {
       throw new Exception(ExceptionMessages::ReferencesLabEquipmentTypes." : ".$lab_id, ExceptionCodes::ReferencesLabEquipmentTypes);  
    }
    if ( (count($arrayLabWorkers) > 0) || (!Validator::IsEmptyArray($arrayLabWorkers)) ) {
       throw new Exception(ExceptionMessages::ReferencesLabWorkers." : ".$lab_id, ExceptionCodes::ReferencesLabWorkers);  
    }
    if ( (count($arrayLabRelations) > 0) || (!Validator::IsEmptyArray($arrayLabRelations)) ) {
       throw new Exception(ExceptionMessages::ReferencesLabRelations." : ".$lab_id, ExceptionCodes::ReferencesLabRelations);  
    }
    if ( (count($arrayLabTransitions) > 0) || (!Validator::IsEmptyArray($arrayLabTransitions)) ) {
       throw new Exception(ExceptionMessages::ReferencesLabTransitions." : ".$lab_id, ExceptionCodes::ReferencesLabTransitions);  
    }
        
        //delete============================================================================== 
        try{      
        
            $db->beginTransaction();  
            
            //2nd version of delete from db (check primary keys for existed or not in database)     
            $dLabs = new LabsExt($db);
            $dLabs->setLabId($fLabId);

                if (!$dLabs->existsInDatabase($db))
                    throw new Exception(ExceptionMessages::DeleteNotFoundAquisitionSources ." lab_id: " . $fLabId , ExceptionCodes::DeleteNotFoundAquisitionSources);
                else{         
                    $dLabs->deleteFromDatabase($db);
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
        $result["status_external"] = $ex->getCode();
        $result["message_external"] = "[".$result["method"]."][".$result["function"]."]:".$ex->getMessage();
    } 
    return $result;
}
?>