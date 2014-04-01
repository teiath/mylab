
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


function PutLabWorkers($lab_worker_id,$worker_status) {
    global $db;
    global $app;
    
    $result = array();  
    $result["data"] = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    $input = array(
    "worker_id" => $lab_worker_id,
    "worker_status" => $worker_status
    );
    
    $result["input"]=$input;
    
    try {

        //$lab_worker_id================================================================   
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
                // $fLabId = $arrayLabWorkers[0]->getLabId();
            } else if ( count( $arrayLabWorkers ) > 1 ) { 
                throw new Exception(ExceptionMessages::DuplicateLabWorkerIdValue." : ".$lab_worker_id, ExceptionCodes::DuplicateLabWorkerIdValue);
            } else {
                throw new Exception(ExceptionMessages::NotFoundLabWorkerIDValue." : ".$lab_worker_id, ExceptionCodes::NotFoundLabWorkerIDValue);
            }
            
        }
        else
            throw new Exception(ExceptionMessages::UnknownLabWorkerIdValue." : ".$lab_worker_id, ExceptionCodes::UnknownLabWorkerIdValue);           
      
        //$worker_status=============================================================            
         if (Validator::isMissing('worker_status'))
            throw new Exception(ExceptionMessages::MissingWorkerStatusParam." : ".$worker_status, ExceptionCodes::MissingWorkerStatusParam);           
         else if ( Validator::IsWorkerState($worker_status) && (Validator::ToWorkerState($worker_status) == 3)  ) {
            $fWorkerStatus = Validator::ToWorkerState($worker_status);           
        } else {
             throw new Exception(ExceptionMessages::InvalidUpdateWorkerStatusValue." : ".$worker_status, ExceptionCodes::InvalidUpdateWorkerStatusValue);
        }
              
        try{
            
        $db->beginTransaction();    
        
        //insert to lab_workers table =========================================================
        if ($fLabWorkerId){

            $filter = array();
            $filter = array( new DFC(LabWorkersExt::FIELD_LAB_WORKER_ID, $fLabWorkerId, DFC::EXACT),
                             new DFC(LabWorkersExt::FIELD_WORKER_STATUS, $fWorkerStatus, DFC::EXACT)
                            );   
            
            $oLabWorkers = new LabWorkersExt($db);
            $checkLabWorkers = $oLabWorkers->findByFilter($db, $filter, true);
            $exist=count($checkLabWorkers);
            $result["worker_exists"]=$exist;
                    
                if (!Validator::IsEmptyArray($checkLabWorkers) && !Validator::IsArray($checkLabWorkers)) { 
                    throw new Exception(ExceptionMessages::DuplicateLabWorkerValue." found  = ". $exist." lab_worker_id : ".$fLabWorkerId." lab_worker_status : ".$fWorkerStatus, ExceptionCodes::DuplicateLabWorkerValue);
                } else {

                    foreach($arrayLabWorkers as $updateLabWorker)
                    {

                        if ((!$updateLabWorker->existsInDatabase($db)) || ($fWorkerStatus != 3) || (count($arrayLabWorkers) != 1 ) ){
                            throw new Exception(ExceptionMessages::ErrorUpdateLabWorkerStatus, ExceptionCodes::ErrorUpdateLabWorkerStatus);
                        } else { 
                            $updateLabWorker->setWorkerStatus(Validator::ToWorkerState($fWorkerStatus));
                            $updateLabWorker->updateToDatabase($db);
                        }


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