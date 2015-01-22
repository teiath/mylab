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
 * @param type $lab_id
 * @param type $lab_relation_id
 * @return string
 * @throws Exception
 */


function DelLabWorkers($lab_id, $lab_worker_id) {

    global $app,$entityManager;

    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"] = $params;
    
    try
    {
      
//$lab_id=======================================================================
        $fLabID = CRUDUtils::checkIDParam('lab_id', $params, $lab_id, 'LabID');

//$lab_worker_id================================================================
        $fLabWorkerID = CRUDUtils::checkIDParam('lab_worker_id', $params, $lab_worker_id, 'LabWorkerID');
             
//user permisions===============================================================
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array($fLabID, $permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToDeleteLab, ExceptionCodes::NoPermissionToDeleteLab); 
         };  

//controls======================================================================  

        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('LabWorkers')->findBy(array( 'lab'          => $fLabID,
                                                                            'labWorkerId'  => $fLabWorkerID,
                                                                           ));

        $countLabWorkers = count($check);
        
        if ($countLabWorkers == 1)
            //set entity for delete row
            $LabWorkers = $entityManager->find('LabWorkers', $fLabWorkerID);
        else if ($countLabWorkers == 0)
            throw new Exception(ExceptionMessages::NotFoundDelLabWorkerValue." : ".$fLabID." - ".$fLabWorkerID,ExceptionCodes::NotFoundDelLabWorkerValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelLabWorkerValue." : ".$fLabID." - ".$fLabWorkerID,ExceptionCodes::DuplicateDelLabWorkerValue);
      
        //check if lab has more than one active worker and restrict deletion   
        $findActiveWorkers = $entityManager->getRepository('LabWorkers')->findBy(array( 'lab'           => $fLabID,
                                                                                        'workerStatus'  => Validator::ToWorkerState(1)
                                                                                       ));
        
        $countActiveLabWorkers = count($findActiveWorkers);
        
        if ($countActiveLabWorkers > 1){
              throw new Exception(ExceptionMessages::InvalidLabWorkerActiveStatus." : ".$fLabID ,ExceptionCodes::InvalidLabWorkerActiveStatus);
        }
        
        if ($LabWorkers->getWorkerStatus() != 1){
            throw new Exception(ExceptionMessages::NoPermissionDelLabWorkerValue." : ".$fLabID ,ExceptionCodes::NoPermissionDelLabWorkerValue);
        }
        
//delete from db================================================================

        $entityManager->remove($LabWorkers);
        $entityManager->flush($LabWorkers);
           
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