<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $app
 * @param type $lab_relation_id
 * @return string
 * @throws Exception
 */


function DelLabRelations($lab_relation_id) {
    global $db;
    global $app;
    
    $result = array();  
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    
    $input = array(
    "lab_relation_id" => $lab_relation_id
    );
    
    $result["input"]=$input
            ;
    try {
             
        //$lab_relation_id==============================================================      
        if (Validator::isMissing('lab_relation_id'))
            throw new Exception(ExceptionMessages::MissingLabRelationIdParam." : ".$lab_relation_id, ExceptionCodes::MissingLabRelationIdParam);
        else if (Validator::IsNull($lab_relation_id) )
            throw new Exception(ExceptionMessages::MissingLabRelationIdValue." : ".$lab_relation_id, ExceptionCodes::MissingLabRelationIdValue);
        else if (!Validator::IsNumeric($lab_relation_id) || Validator::IsNegative($lab_relation_id))
	    throw new Exception(ExceptionMessages::InvalidLabRelationIdValue." : ".$lab_relation_id, ExceptionCodes::InvalidLabRelationIdValue);    
        else if (Validator::IsID($lab_relation_id)) {
            $filter[] = new DFC(LabRelationsExt::FIELD_LAB_RELATION_ID, Validator::ToID($lab_relation_id), DFC::EXACT);     
            
            $oLabRelations = new LabRelationsExt($db);
            $arrayLabRelations = $oLabRelations->findByFilter($db, $filter, true);
            
            if ( count($arrayLabRelations) === 1 ) { 
                $fLabRelationId = $arrayLabRelations[0]->getLabRelationId();
            } else if ( count( $arrayLabRelations ) > 1 ) { 
                throw new Exception(ExceptionMessages::DuplicateLabRelationIdValue." : ".$lab_relation_id, ExceptionCodes::DuplicateLabRelationIdValue);
            } else {
                throw new Exception(ExceptionMessages::NotFoundLabRelationIDValue." : ".$lab_relation_id, ExceptionCodes::NotFoundLabRelationIDValue);
            }
       
        }
        else
            throw new Exception(ExceptionMessages::UnknownLabRelationIdValue." : ".$lab_relation_id, ExceptionCodes::UnknownLabRelationIdValue);               
        
        //user permisions
         $fLabId = $arrayLabRelations[0]->getLabId();
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array($fLabId,$permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToDeleteLab ,ExceptionCodes::NoPermissionToDeleteLab); 
         };
        
        try{      
        
            $db->beginTransaction();  
            
            //2nd version of delete from db (check primary keys for existed or not in database)     
            $dLabRelation = new LabRelationsExt($db);
            $dLabRelation->setLabRelationId($fLabRelationId);

                if (!$dLabRelation->existsInDatabase($db))
                    throw new Exception(ExceptionMessages::DeleteNotFoundLabRelations ." lab_relation_id: " . $fLabRelationId, ExceptionCodes::DeleteNotFoundLabRelations);
                else{         
                    $dLabRelation->deleteFromDatabase($db);
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