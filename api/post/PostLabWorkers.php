<?php
/**
 *
 * @version 2.0
 * @author  ΤΕΙ Αθήνας
 * @package POST
 * 
 */
 
header("Content-Type: text/html; charset=utf-8");
/**
 * 
 * @global type $app
 * @global type $entityManager
 * @param type $lab_id
 * @param type $worker_id
 * @param type $worker_position
 * @param type $worker_status
 * @param type $worker_start_service
 * @return string
 * @throws Exception
 */

function PostLabWorkers($lab_id, $worker_id, $worker_position, $worker_status, $worker_start_service) { 
    
    global $app,$entityManager;
    
    $LabWorker = new LabWorkers();
    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"]  = $params;
    
    try
    { 
        
//$creation infos===============================================================
        $username =  $app->request->user['uid'];
        $LabWorker->setInsertLabWorkerBy(new \DateTime (date('Y-m-d')));  
        $LabWorker->setInsertBy($username[0]);  
        
//$lab_id=======================================================================
    CRUDUtils::entitySetAssociation($LabWorker, $lab_id, 'Labs', 'lab', 'Lab', $params, 'lab_id');
    
//$worker_id====================================================================
    //CRUDUtils::entitySetAssociation($LabWorker, $worker_id, 'MylabWorkers', 'worker', 'MylabWorker', $params, 'worker_id');
    //FUTURE TODO add to entitySetAssociation association param e.g. associationParam='firstname' 
    if (Validator::Missing('worker_id', $params))
           throw new Exception(ExceptionMessages::MissingMylabWorkerParam." : ".$worker_id, ExceptionCodes::MissingMylabWorkerParam);           
    else if (Validator::IsNull($worker_id))
        throw new Exception(ExceptionMessages::MissingMylabWorkerValue." : ".$worker_id, ExceptionCodes::MissingMylabWorkerValue);           
    else if (Validator::IsArray($worker_id))
        throw new Exception(ExceptionMessages::InvalidMylabWorkerArray." : ".$worker_id, ExceptionCodes::InvalidMylabWorkerArray);           
    else if ( Validator::IsID($worker_id) )
            $retrievedObject = $entityManager->getRepository('MylabWorkers')->find(Validator::ToID($worker_id));
    else if ( Validator::IsValue($worker_id) )
            $retrievedObject = $entityManager->getRepository('MylabWorkers')->findOneBy(array('lastname' => Validator::ToValue($worker_id)));
    else
         throw new Exception(ExceptionMessages::InvalidMylabWorkerType." : ".$worker_id, ExceptionCodes::InvalidMylabWorkerType);
        
        if ( !isset($retrievedObject) )
            throw new Exception(ExceptionMessages::InvalidMylabWorkerValue." : ".$worker_id, ExceptionCodes::InvalidMylabWorkerValue);
        else if (count($retrievedObject)>1)
            throw new Exception(ExceptionMessages::InvalidMylabWorkerType." : ".$worker_id, ExceptionCodes::InvalidMylabWorkerType);
        else
        {
            $method = 'setWorker';
            $LabWorker->$method($retrievedObject);
        }
    
//$worker_position==============================================================
    CRUDUtils::entitySetAssociation($LabWorker, $worker_position, 'WorkerPositions', 'workerPosition', 'WorkerPosition', $params, 'worker_position');
        
//$worker_status================================================================ 
    
    if (Validator::Missing('worker_status', $params))
        throw new Exception(ExceptionMessages::MissingLabWorkerStatusParam." : ".$worker_status, ExceptionCodes::MissingLabWorkerStatusParam);           
    else if (Validator::IsNull($worker_status))
        throw new Exception(ExceptionMessages::MissingLabWorkerStatusValue." : ".$worker_status, ExceptionCodes::MissingLabWorkerStatusValue);
    else if (Validator::IsArray($worker_status))
        throw new Exception(ExceptionMessages::InvalidLabWorkerStatusArray." : ".$worker_status, ExceptionCodes::InvalidLabWorkerStatusArray);                           
    else if ( Validator::IsWorkerState($worker_status) ) {
        $LabWorker->setWorkerStatus(Validator::ToWorkerState($worker_status));
    } else {
         throw new Exception(ExceptionMessages::InvalidLabWorkerStatusType." : ".$worker_status, ExceptionCodes::InvalidLabWorkerStatusType);
    }

//$worker_start_service=========================================================
    if (Validator::Missing('worker_start_service', $params))
        throw new Exception(ExceptionMessages::MissingLabWorkerStartServiceParam." : ".$worker_start_service, ExceptionCodes::MissingLabWorkerStartServiceParam);
    else if (Validator::IsNull($worker_start_service))
         throw new Exception(ExceptionMessages::MissingLabWorkerStartServiceValue." : ".$worker_start_service, ExceptionCodes::MissingLabWorkerStartServiceValue);
    else if (Validator::IsArray($worker_start_service))
         throw new Exception(ExceptionMessages::InvalidLabWorkerStartServiceArray." : ".$worker_start_service, ExceptionCodes::InvalidLabWorkerStartServiceArray);    
    else if (! Validator::IsValidDate($worker_start_service) )
         throw new Exception(ExceptionMessages::InvalidLabWorkerStartServiceValidType." : ".$worker_start_service, ExceptionCodes::InvalidLabWorkerStartServiceValidType); 
    else if (Validator::IsDate($worker_start_service,'Y-m-d'))
         $LabWorker->setWorkerStartService(new \DateTime($worker_start_service));
    else
         throw new Exception(ExceptionMessages::InvalidLabWorkerStartServiceType." : ".$worker_start_service, ExceptionCodes::InvalidLabWorkerStartServiceType);    
    
//user permisions=============================================================== 
     $permissions = UserRoles::getUserPermissions($app->request->user);
     if (!in_array($LabWorker->getLab()->getLabId(),$permissions['permit_labs'])) {
         throw new Exception(ExceptionMessages::NoPermissionToPostLab, ExceptionCodes::NoPermissionToPostLab); 
     };
 
//controls======================================================================   

        //check if post the same active lab worker==============================  
        $checkDuplicate = $entityManager->getRepository('LabWorkers')->findOneBy(array( 'lab'               => $LabWorker->getLab(),
                                                                                        'worker'            => $LabWorker->getWorker(),
                                                                                        'workerPosition'    => $LabWorker->getWorkerPosition(),
                                                                                        'workerStatus'      => $LabWorker->getWorkerStatus()
                                                                                       ));
 
        if (!Validator::isNull($checkDuplicate)){
            throw new Exception(ExceptionMessages::DuplicatedLabWorkerValue ,ExceptionCodes::DuplicatedLabWorkerValue);
        }
     
        //check for max date====================================================
        $findAllDates = $entityManager->getRepository('LabWorkers')->findBy(array( 'lab'               => $LabWorker->getLab(),
                                                                                   'workerPosition'    => $LabWorker->getWorkerPosition()
                                                                                  ));
           if (!Validator::isNull($findAllDates)){
               $date = array();
                foreach($findAllDates as $findAllDate) {
                   $date[] = $findAllDate->getWorkerStartService()->format('Y-m-d'); 
                }
           }
               
        $max_date = max($date);  
        $result['max_date'] = $max_date;
        
        //validate that new date is greater than previous date==================
        $previous_date = strtotime($max_date);
        $new_date = strtotime(Validator::ToDate($worker_start_service, 'Y-m-d'));
        
        if (Validator::isLowerThan($new_date, $previous_date, true)) {   
            throw new Exception(ExceptionMessages::NotAllowedLabWorkerStartService, ExceptionCodes::NotAllowedLabWorkerStartService);  
        }
            
        //check for previous active lab worker  and set status->3===============
        $findActiveWorkers = $entityManager->getRepository('LabWorkers')->findBy(array( 'lab'               => $LabWorker->getLab(),
                                                                                        'workerPosition'    => $LabWorker->getWorkerPosition(),
                                                                                        'workerStatus'      => Validator::ToWorkerState(1)
                                                                                       ));
        $countFindActiveWorkers = count($findActiveWorkers);
       
            if ($countFindActiveWorkers >= 1){
            //AUTO change labworker state
            //               $toFlush = array();
            //                  foreach($findActiveWorkers as $findActiveWorker) {
            //                      $findActiveWorker->setWorkerStatus(3);
            //                      $toFlush[] = $findActiveWorker;
            //                  }
            //                  $entityManager->flush($toFlush);             
                throw new Exception(ExceptionMessages::InvalidLabWorkerNewWorkerStatus,ExceptionCodes::InvalidLabWorkerNewWorkerStatus);              
            }

        //check if lab has submitted value = 0 and restrict insert
        $Labs = $entityManager->find('Labs', Validator::ToID($lab_id));
        if ($Labs->getSubmitted() == false){
            throw new Exception(ExceptionMessages::InvalidLabWorkerSetStatus." : ".$lab_id ,ExceptionCodes::InvalidLabWorkerSetStatus);
        }

//insert to db================================================================== 
        $entityManager->persist($LabWorker);
        $entityManager->flush($LabWorker);

        $result["worker_id"] = $LabWorker->getLabWorkerId();  
           
//result_messages===============================================================      
        $result["status"] = ExceptionCodes::NoErrors;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".ExceptionMessages::NoErrors;
    } catch (Exception $e) {
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    }                
        
    return $result;
}
?>