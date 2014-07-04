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


function DelLabAquisitionSources($lab_aquisition_source_id) {
    global $db;
    global $app;
    
    $result = array();  
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    $input=array("lab_aquisition_source_id"=>$lab_aquisition_source_id);
    $result["input"] = $input;
    
    try {
             
        //$lab_aquisition_source_id==============================================================      
        if (Validator::isMissing('lab_aquisition_source_id'))
            throw new Exception(ExceptionMessages::MissingLabAquisitionSourceIdParam." : ".$lab_aquisition_source_id, ExceptionCodes::MissingLabAquisitionSourceIdParam);
        else if (Validator::IsNull($lab_aquisition_source_id) )
            throw new Exception(ExceptionMessages::MissingLabAquisitionSourceIdValue." : ".$lab_aquisition_source_id, ExceptionCodes::MissingLabAquisitionSourceIdValue);
        else if (!Validator::IsNumeric($lab_aquisition_source_id) || Validator::IsNegative($lab_aquisition_source_id))
	    throw new Exception(ExceptionMessages::InvalidLabAquisitionSourceIdValue." : ".$lab_aquisition_source_id, ExceptionCodes::InvalidLabAquisitionSourceIdValue);    
        else if (Validator::IsID($lab_aquisition_source_id)) {
            $filter[] = new DFC(LabAquisitionSourcesExt::FIELD_LAB_AQUISITION_SOURCE_ID, Validator::ToID($lab_aquisition_source_id), DFC::EXACT);     
            
            $oLabAquisitionSources= new LabAquisitionSourcesExt($db);
            $arrayLabAquisitionSources = $oLabAquisitionSources->findByFilter($db, $filter, true);
            
            if ( count($arrayLabAquisitionSources) === 1 ) {           
                $fLabAquisitionSourceId = $arrayLabAquisitionSources[0]->getLabAquisitionSourceId();
            } else if ( count( $arrayLabAquisitionSources ) > 1 ) { 
                throw new Exception(ExceptionMessages::DuplicateLabAquisitionSourceIdValue." : ".$lab_aquisition_source_id, ExceptionCodes::DuplicateLabAquisitionSourceIdValue);
            } else {
                throw new Exception(ExceptionMessages::NotFoundLabAquisitionSourceIdValue." : ".$lab_aquisition_source_id, ExceptionCodes::NotFoundLabAquisitionSourceIdValue);
            }
       
        }
        else
            throw new Exception(ExceptionMessages::UnknownLabAquisitionSourceIdValue." : ".$lab_aquisition_source_id, ExceptionCodes::UnknownLabAquisitionSourceIdValue);                
        
        //user permisions
         $fLabId = $arrayLabAquisitionSources[0]->getLabId();
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array($fLabId,$permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToDeleteLab ,ExceptionCodes::NoPermissionToDeleteLab); 
         };
        
        try{      
        
            $db->beginTransaction();  
            
            //2nd version of delete from db (check primary keys for existed or not in database)     
            $dLabAquisitionSource = new LabAquisitionSourcesExt($db);
            $dLabAquisitionSource->setLabAquisitionSourceId($fLabAquisitionSourceId);

                if (!$dLabAquisitionSource->existsInDatabase($db))
                    throw new Exception(ExceptionMessages::DeleteNotFoundAquisitionSources ." lab_aquisition_source_id: " . $fLabAquisitionSourceId , ExceptionCodes::DeleteNotFoundAquisitionSources);
                else{         
                    $dLabAquisitionSource->deleteFromDatabase($db);
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