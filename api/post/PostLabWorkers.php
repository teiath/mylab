<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $app
 * @param type $lab_id
 * @param type $worker_id
 * @param type $worker_position
 * @param type $worker_email
 * @param type $worker_status
 * @param type $worker_start_service
 * @return string
 * @throws Exception
 */

function PostLabWorkers($lab_id, $worker_id, $worker_position, $worker_email, $worker_status, $worker_start_service) 

{
    
    global $db;
    global $app;


    $result = array();  
    $date_array= array();
    $result["data"] = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);

    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = $app->request->getBody();
    
    $result["lab_id"] = $lab_id;
    $result["worker_id"] = $worker_id;
    $result["worker_position"] = $worker_position;
    $result["worker_email"] = $worker_email;
    $result["worker_status"] = $worker_status;
    $result["worker_start_service"] = $worker_start_service;
      
    try {
        
         $fWorkerEmail = $worker_email ? $worker_email : NULL;
         
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
        
        
        //$worker_id===============================================================       
        if (Validator::isMissing('worker_id'))
            throw new Exception(ExceptionMessages::MissingWorkerIdParam." : ".$worker_id, ExceptionCodes::MissingWorkerIdParam);    
        else if (Validator::IsNull($worker_id))
            $fWorker =  Validator::IsNull($worker_id);   
        else if (Validator::IsNumeric($worker_id)) {
            
            $filter[] = new DFC(WorkersExt::FIELD_WORKER_ID,Validator::ToValue($worker_id), DFC::EXACT) ;
            
            $oWorkers = new WorkersExt($db);           
            $arrayWorkers = $oWorkers->findByFilter($db, $filter, true);
            
 
            if ( count( $arrayWorkers ) === 1 ) { 
                $fWorker = $arrayWorkers[0]->getWorkerId();
            } else if ( count( $arrayWorkers ) > 1 ) { 
                throw new Exception(ExceptionMessages::DuplicateWorkerIdValue." : ".$worker_id, ExceptionCodes::DuplicateWorkerIdValue);
            } else {
                throw new Exception(ExceptionMessages::InvalidWorkerValue." : ".$worker_id, ExceptionCodes::InvalidWorkerValue);
            }
        
        } else
            throw new Exception(ExceptionMessages::InvalidWorkerInputValue." : ".$worker_id, ExceptionCodes::InvalidRegistryNumberValue);                  

        //$worker_position============================================================          
        if (Validator::isMissing('worker_position'))
            throw new Exception(ExceptionMessages::MissingWorkerPositionParam." : ".$worker_position, ExceptionCodes::MissingWorkerPositionParam);     
        else if (Validator::IsNull($worker_position))
            throw new Exception(ExceptionMessages::MissingWorkerPositionValue." : ".$worker_position, ExceptionCodes::MissingWorkerPositionValue); 
        else if (Validator::IsID($worker_position))
            $filter[] = new DFC(WorkerPositionsExt::FIELD_WORKER_POSITION_ID, Validator::ToID($worker_position), DFC::EXACT) ;
        else if (Validator::IsValue($worker_position)) 
            $filter[] = new DFC(WorkerPositionsExt::FIELD_NAME, Validator::ToValue($worker_position), DFC::EXACT);
        else 
            throw new Exception(ExceptionMessages::UnknownWorkerPositionValue." : ".$worker_position, ExceptionCodes::UnknownWorkerPositionValue); 

            $oWorkerPositions = new WorkerPositionsExt($db);
            $arrayWorkerPositions = $oWorkerPositions->findByFilter($db, $filter, true);

            if ( count($arrayWorkerPositions) === 1 ) { 
                $fWorkerPosition = $arrayWorkerPositions[0]->getWorkerPositionId();
                //$filters[] = "lab_type_id = '". mysql_escape_string( $fLabType ) ."'";
            } else if ( count($arrayWorkerPositions) > 1 ) { 
                throw new Exception(ExceptionMessages::DuplicateWorkerPositionIdValue." : ".$worker_position, ExceptionCodes::DuplicateWorkerPositionIdValue);
            } else {
                throw new Exception(ExceptionMessages::InvalidWorkerPositionValue." : ".$worker_position, ExceptionCodes::InvalidWorkerPositionValue);
            }     
         
        //$worker_status=============================================================            
         if (Validator::isMissing('worker_status'))
            throw new Exception(ExceptionMessages::MissingWorkerStatusParam." : ".$worker_status, ExceptionCodes::MissingWorkerStatusParam);           
         else if ( Validator::IsWorkerState($worker_status) ) {
            $fWorkerStatus = Validator::ToWorkerState($worker_status);           
        } else {
             throw new Exception(ExceptionMessages::InvalidWorkerStatusValue." : ".$worker_status, ExceptionCodes::InvalidWorkerStatusValue);
        }
        
      //$worker_start_service=============================================================
       if (Validator::isMissing('worker_start_service'))
           throw new Exception(ExceptionMessages::MissingWorkerStartServiceParam." : ".$worker_start_service, ExceptionCodes::MissingWorkerStartServiceParam);
       else if (Validator::IsNull($worker_start_service))
            throw new Exception(ExceptionMessages::MissingWorkerStartServiceValue." : ".$worker_start_service, ExceptionCodes::MissingWorkerStartServiceValue);
       else if (! Validator::IsDate($worker_start_service,'Y-m-d') )
            throw new Exception(ExceptionMessages::InvalidWorkerStartServiceValue." : ".$worker_start_service, ExceptionCodes::InvalidWorkerStartServiceValue);    
       else if (! Validator::IsValidDate($worker_start_service) )
            throw new Exception(ExceptionMessages::InvalidWorkerStartServiceValidValue." : ".$worker_start_service, ExceptionCodes::InvalidWorkerStartServiceValidValue); 
       else 
            $fWorkerStartService = $worker_start_service;
        
        
  

        try{
            
        $db->beginTransaction();    
        
        //insert to lab_workers table =========================================================
        if ($fWorker){
               
            //check if post the same active lab worker  
            $oLabWorkers = new LabWorkersExt($db);

            $filter= array();
            $filter  = array(   new DFC(LabWorkersExt::FIELD_LAB_ID, $fLabId, DFC::EXACT),
                                new DFC(LabWorkersExt::FIELD_WORKER_ID, $fWorker, DFC::EXACT),
                                new DFC(LabWorkersExt::FIELD_WORKER_POSITION_ID, $fWorkerPosition, DFC::EXACT),
                                new DFC(LabWorkersExt::FIELD_WORKER_STATUS,Validator::ToWorkerState(1), DFC::EXACT)
                        );   
            $arrayLabWorkers = $oLabWorkers->findByFilter($db, $filter, true); 
            $exist=count($arrayLabWorkers);
            $result["worker_exists"]=$exist;                          
            
             if (!Validator::IsEmptyArray($arrayLabWorkers) && !Validator::IsArray($arrayLabWorkers)){
                    throw new Exception(ExceptionMessages::DuplicateLabWorkerValue.$fWorker." lab_id : ".$fLabId, ExceptionCodes::DuplicateLabWorkerValue);
                } else {
               

                        //check for previous active lab worker  and set status = 3
                        $activeFilter = array();
                        $activeFilter = array(  new DFC(LabWorkersExt::FIELD_LAB_ID, $fLabId, DFC::EXACT),
                                                new DFC(LabWorkersExt::FIELD_WORKER_POSITION_ID, $fWorkerPosition, DFC::EXACT),
                                                new DFC(LabWorkersExt::FIELD_WORKER_STATUS,Validator::ToWorkerState(1), DFC::EXACT)
                                                ); 
                            
                        $activeLabWorker = new LabWorkersExt($db);
                        $activeLabWorkers = $activeLabWorker->findByFilter($db, $activeFilter, true);
                    
                        if (Validator::IsEmptyArray($activeLabWorkers)){
                            
                            //check if has no active lab worker and find max date 
                            $inactiveFilter = array();
                            $inactiveFilter = array( new DFC(LabWorkersExt::FIELD_LAB_ID, $fLabId, DFC::EXACT),
                                                     new DFC(LabWorkersExt::FIELD_WORKER_POSITION_ID, $fWorkerPosition, DFC::EXACT),
                                                     new DFC(LabWorkersExt::FIELD_WORKER_STATUS,Validator::ToWorkerState(3), DFC::EXACT)
                                                    ); 

                            $inactiveLabWorker = new LabWorkersExt($db);
                            $inactiveLabWorkers = $inactiveLabWorker->findByFilter($db, $inactiveFilter, true);  
                            
                            
                            foreach($inactiveLabWorkers as $inactiveLabWorker)
                                {
                                    $date_array[] = $inactiveLabWorker->getWorkerStartService();
                                }                         
                             
                        } else {
                            
                            foreach($activeLabWorkers as $activeLabWorker)
                                {
                                 $date_array[]=$activeLabWorker->getWorkerStartService();
                                }                
                            
                        }
                        
                        //validate that new date is greater than previous date
                        $max_date = max($date_array);   
                        $result['max_date'] = $max_date;
                        $previous_date = strtotime($max_date);
                        
                        $new_date = strtotime($fWorkerStartService);
                        
                        if (Validator::isGreaterThan($new_date, $previous_date, true)) {   

                
                            
                        
                         if (!Validator::IsEmptyArray($activeLabWorkers)) {
                             
                                foreach($activeLabWorkers as $activeLabWorker)
                                {
                                    $activeLabWorker->setWorkerStatus(Validator::ToWorkerState(3));
                                    $activeLabWorker->updateToDatabase($db);
                                }
                        }
                        
                                $oLabWorkers->setLabId($fLabId);
                                $oLabWorkers->setWorkerId($fWorker);
                                $oLabWorkers->setWorkerPositionId($fWorkerPosition);
                                $oLabWorkers->setWorkerEmail($fWorkerEmail);
                                $oLabWorkers->setWorkerStatus($fWorkerStatus);
                                $oLabWorkers->setWorkerStartService($fWorkerStartService);
                                $oLabWorkers->insertIntoDatabase($db); 
                                        
                    } else {
                         throw new Exception(ExceptionMessages::NotAllowedLabWorkerStartService, ExceptionCodes::NotAllowedLabWorkerStartService);  
                    }
                 
                        
//  bug with this function updateByFilter                      
//                        $updateFields='worker_status = ' . Validator::ToWorkerState(0) . ',worker_position_id = '.$fWorkerPosition;
//                        $updateLabWorkers = $oLabWorkers->updateByFilter($db, $updateFields, $updateFilter, true);
//                        $result["lab_worker_update"]=$updateLabWorkers;
                               
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
        $result["status"] = $ex->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$ex->getMessage();
    } 
    return $result;
}

?>