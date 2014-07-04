<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $app
 * @param type $lab_worker_id
 * @return string
 * @throws Exception
 */


function DelLabWorkers($lab_worker_id) {
    global $db;
    global $app;
    
    $result = array();  
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    $result["worker_id"] = $lab_worker_id;
    
    try {
        
        if (Validator::isMissing('lab_worker_id'))
            throw new Exception(ExceptionMessages::DeleteLabWorkerIdValue." : ".$lab_worker_id, ExceptionCodes::DeleteLabNameValue);
        else if (Validator::IsNull($lab_worker_id) )
            throw new Exception(ExceptionMessages::MissingLabWorkerIdValue." : ".$lab_worker_id, ExceptionCodes::MissingLabWorkerIdValue);
        else if (!Validator::IsNumeric($lab_worker_id) || Validator::IsNegative($lab_worker_id))
	    throw new Exception(ExceptionMessages::InvalidLabWorkerIdValue." : ".$lab_worker_id, ExceptionCodes::InvalidLabWorkerIdValue);    
        else if (Validator::IsID($lab_worker_id)) {
            $filter[] = new DFC(LabWorkersExt::FIELD_LAB_WORKER_ID, Validator::ToID($lab_worker_id), DFC::EXACT);     
            
            $oLabWorkers = new LabWorkersExt($db);
            $arrayLabWorkers = $oLabWorkers->findByFilter($db, $filter, true);
            
            if ( count($arrayLabWorkers) === 1 ) { 
                 $fLabWorkerId = $arrayLabWorkers[0]->getLabWorkerId();
                 //$arrayLabWorkers[0]->deleteByFilter($db, $filter);
            } else if ( count( $arrayLabWorkers ) > 1 ) { 
                throw new Exception(ExceptionMessages::DuplicateLabWorkerIdValue." : ".$lab_worker_id, ExceptionCodes::DuplicateLabWorkerIdValue);
            } else {
                throw new Exception(ExceptionMessages::NotFoundLabWorkerIDValue." : ".$lab_worker_id, ExceptionCodes::NotFoundLabWorkerIDValue);
            }
            
        }
        else
            throw new Exception(ExceptionMessages::UnknownLabWorkerIdValue." : ".$lab_worker_id, ExceptionCodes::UnknownLabWorkerIdValue);           
        
        //user permisions
         $fLabId = $arrayLabWorkers[0]->getLabId();
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array($fLabId,$permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToDeleteLab ,ExceptionCodes::NoPermissionToDeleteLab); 
         };
                
        try{
            $db->beginTransaction();  
        
            $dLabWorker = new LabWorkersExt($db);
            $dLabWorker->setLabWorkerId($fLabWorkerId);

                if (!$dLabWorker->existsInDatabase($db))
                    throw new Exception(ExceptionMessages::DeleteNotFoundLabWorkers ." lab_worker_id: " . $fLabWorkerId  , ExceptionCodes::DeleteNotFoundLabWorkers);
                else{         
                    $dLabWorker->deleteFromDatabase($db);
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

  }
      catch (Exception $ex) 
  {
      $result["status_external"] = $ex->getCode();
      $result["message_external"] = "[".$result["method"]."]: ".$ex->getMessage();
  }  
    return $result;
}

?>