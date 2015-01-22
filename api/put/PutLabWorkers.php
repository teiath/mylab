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
 * @global type $db
 * @global type $app
 * @param type $lab_worker_id
 * @return string
 * @throws Exception
 */


function PutLabWorkers($lab_worker_id,$worker_status) {
    
    global $app,$entityManager;

    $result = array();
    
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"] = $params;
    
    try {
        
//$lab_worker_id================================================================    
        $fLabWorkerId = CRUDUtils::checkIDParam('lab_worker_id', $params, $lab_worker_id, 'LabWorkerID');
       
//init entity for update row====================================================
        $LabWorker = CRUDUtils::findIDParam($fLabWorkerId, 'LabWorkers', 'LabWorker');
      
//$updated infos================================================================
        $username =  $app->request->user['uid'];
        $LabWorker->setDeleteLabWorkerBy(new \DateTime (date('Y-m-d')));  
        $LabWorker->setDeleteBy($username[0]);   
        
//$worker_status================================================================   
        if (Validator::IsExists('worker_status')){
               
            if (Validator::Missing('worker_status', $params))
                throw new Exception(ExceptionMessages::MissingLabWorkerStatusParam." : ".$worker_status, ExceptionCodes::MissingLabWorkerStatusParam);           
            else if (Validator::IsNull($worker_status))
                throw new Exception(ExceptionMessages::MissingLabWorkerStatusValue." : ".$worker_status, ExceptionCodes::MissingLabWorkerStatusValue);
            else if (Validator::IsArray($worker_status))
                throw new Exception(ExceptionMessages::InvalidLabWorkerStatusArray." : ".$worker_status, ExceptionCodes::InvalidLabWorkerStatusArray);                           
            else if ( Validator::IsWorkerState($worker_status) && (Validator::ToWorkerState($worker_status) == 3) ) {
                $LabWorker->setWorkerStatus(Validator::ToWorkerState($worker_status));
            } else {
                 throw new Exception(ExceptionMessages::InvalidLabWorkerStatusType." : ".$worker_status, ExceptionCodes::InvalidLabWorkerStatusType);
            }
        
        } else if ( !Validator::IsWorkerState($LabWorker->getWorkerStatus())){
            throw new Exception(ExceptionMessages::MissingLabWorkerStatusValue." : ".$worker_status, ExceptionCodes::MissingLabWorkerStatusValue);
        } 
        
//user permisions===============================================================
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array($LabWorker->getLab()->getLabId(), $permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToPutLab, ExceptionCodes::NoPermissionToPutLab); 
         }; 
 
//controls======================================================================  

        //check duplicates======================================================           
        $checkDuplicate = $entityManager->getRepository('LabWorkers')->findOneBy(array( 'labWorkerId'   => $LabWorker->getLabWorkerId(),
                                                                                        'workerStatus'  => $LabWorker->getWorkerStatus()                                                                                   
                                                                                        ));

        if (!Validator::isNull($checkDuplicate)){
            throw new Exception(ExceptionMessages::DuplicatedLabWorkerValue ,ExceptionCodes::DuplicatedLabWorkerValue);
        }   
        
    
//update to db==================================================================
         
           $entityManager->persist($LabWorker);
           $entityManager->flush($LabWorker);
       
           $result["lab_worker_id"] = $LabWorker->getLabWorkerId();

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