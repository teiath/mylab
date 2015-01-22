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
 * @param type $worker_id
 * @param type $registry_no
 * @param type $uid
 * @param type $firstname
 * @param type $lastname
 * @param type $fathername
 * @param type $email
 * @param type $worker_specialization
 * @param type $lab_source
 * @return string
 * @throws Exception
 */

function PutMylabWorkers($worker_id, $registry_no, $uid, $firstname, $lastname, $fathername, $email, $worker_specialization, $lab_source) {
    
    global $app,$entityManager;

    $result = array();
    
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"] = $params;
   
    try {
        
 //user permisions===============================================================
    //not required (all users with title 'ΔΙΕΥΘΥΝΤΗΣ' or 'ΤΟΜΕΑΡΧΗΣ' have permissions to PutMyLabWorkers)
         
//$worker_id====================================================================    
        $fWorkerId = CRUDUtils::checkIDParam('worker_id', $params, $worker_id, 'MylabWorkerID');
       
//init entity for update row====================================================
        $MylabWorkers = CRUDUtils::findIDParam($fWorkerId, 'MylabWorkers', 'MylabWorker');
                
//$registry_no==================================================================
        if ( Validator::IsExists('registry_no') ){
            CRUDUtils::entitySetParam($MylabWorkers, $registry_no, 'MylabWorkerRegistryNo', 'registry_no', $params);
        } else if ( Validator::IsNull($MylabWorkers->getRegistryNo()) ){
            throw new Exception(ExceptionMessages::MissingMylabWorkerRegistryNoValue." : ".$registry_no, ExceptionCodes::MissingMylabWorkerRegistryNoValue);
        } 
        
//$uid==========================================================================
        if ( Validator::IsExists('uid') ){
            CRUDUtils::entitySetParam($MylabWorkers, $uid, 'MylabWorkerUid', 'uid', $params);
        } else if ( Validator::IsNull($MylabWorkers->getUid()) ){
            throw new Exception(ExceptionMessages::MissingMylabWorkerUidValue." : ".$uid, ExceptionCodes::MissingMylabWorkerUidValue);
        } 
        
//$firstname====================================================================
        if ( Validator::IsExists('firstname') ){
            CRUDUtils::entitySetParam($MylabWorkers, $firstname, 'MylabWorkerFirstname', 'firstname', $params);
        } else if ( Validator::IsNull($MylabWorkers->getFirstname()) ){
            throw new Exception(ExceptionMessages::MissingMylabWorkerFirstnameValue." : ".$firstname, ExceptionCodes::MissingMylabWorkerFirstnameValue);
        } 
        
//$lastname=====================================================================
        if ( Validator::IsExists('lastname') ){
            CRUDUtils::entitySetParam($MylabWorkers, $lastname, 'MylabWorkerLastname', 'lastname', $params);
        } else if ( Validator::IsNull($MylabWorkers->getLastname()) ){
            throw new Exception(ExceptionMessages::MissingMylabWorkerLastnameValue." : ".$lastname, ExceptionCodes::MissingMylabWorkerLastnameValue);
        } 
        
//$fathername===================================================================
        if ( Validator::IsExists('fathername') ){
            CRUDUtils::entitySetParam($MylabWorkers, $fathername, 'MylabWorkerFathername', 'fathername', $params);
        } else if ( Validator::IsNull($MylabWorkers->getFathername()) ){
            throw new Exception(ExceptionMessages::MissingMylabWorkerFathernameValue." : ".$fathername, ExceptionCodes::MissingMylabWorkerFathernameValue);
        } 
   
//$email========================================================================
        if ( Validator::IsExists('email') ){
            CRUDUtils::entitySetParam($MylabWorkers, $email, 'MylabWorkerEmail', 'email', $params);
        } else if ( Validator::IsNull($MylabWorkers->getEmail()) ){
            throw new Exception(ExceptionMessages::MissingMylabWorkerEmailValue." : ".$email, ExceptionCodes::MissingMylabWorkerEmailValue);
        } 
        
//$worker_specialization========================================================       
        if ( Validator::IsExists('worker_specialization') ){
            CRUDUtils::entitySetAssociation($MylabWorkers, $worker_specialization, 'WorkerSpecializations', 'workerSpecialization', 'WorkerSpecialization', $params, 'worker_specialization');
        } else if ( Validator::IsNull($MylabWorkers->getWorkerSpecialization() ) ){
            throw new Exception(ExceptionMessages::MissingWorkerSpecializationNameValue." : ".$worker_specialization, ExceptionCodes::MissingWorkerSpecializationNameValue);
        } 
        
//$lab_source===================================================================       
        if ( Validator::IsExists('lab_source') ){
            CRUDUtils::entitySetAssociation($MylabWorkers, $lab_source, 'LabSources', 'labSource', 'LabSource', $params, 'lab_source');
        } else if ( Validator::IsNull($MylabWorkers->getLabSource()) ){
            throw new Exception(ExceptionMessages::MissingLabSourceInfosValue." : ".$lab_source, ExceptionCodes::MissingLabSourceInfosValue);
        } 
         
//controls======================================================================  

        //check registry_no duplicate===========================================        
        $qb = $entityManager->createQueryBuilder()
                            ->select('COUNT(mlw.workerId) AS fresult')
                            ->from('MylabWorkers', 'mlw')
                            ->where("mlw.registryNo = :registryNo AND mlw.workerId != :workerId")
                            ->setParameter('registryNo', $MylabWorkers->getRegistryNo())
                            ->setParameter('workerId', $MylabWorkers->getWorkerId())    
                            ->getQuery()
                            ->getSingleResult();
      
        if ( $qb["fresult"] != 0 ) {
             throw new Exception(ExceptionMessages::DuplicatedMylabWorkerRegistryNoValue ,ExceptionCodes::DuplicatedMylabWorkerRegistryNoValue);
        }
        
        //check uid duplicate===================================================    
        $qb = $entityManager->createQueryBuilder()
                    ->select('COUNT(mlw.workerId) AS fresult')
                    ->from('MylabWorkers', 'mlw')
                    ->where("mlw.uid = :uid AND mlw.workerId != :workerId")
                    ->setParameter('uid', $MylabWorkers->getUid())
                    ->setParameter('workerId', $MylabWorkers->getWorkerId())    
                    ->getQuery()
                    ->getSingleResult();

        if ( $qb["fresult"] != 0 ) {
             throw new Exception(ExceptionMessages::DuplicatedMylabWorkerUidValue ,ExceptionCodes::DuplicatedMylabWorkerUidValue);
        }
        
        //check email duplicate=================================================  
        $qb = $entityManager->createQueryBuilder()
                    ->select('COUNT(mlw.workerId) AS fresult')
                    ->from('MylabWorkers', 'mlw')
                    ->where("mlw.email = :email AND mlw.workerId != :workerId")
                    ->setParameter('email', $MylabWorkers->getEmail())
                    ->setParameter('workerId', $MylabWorkers->getWorkerId())    
                    ->getQuery()
                    ->getSingleResult();

        if ( $qb["fresult"] != 0 ) {
             throw new Exception(ExceptionMessages::DuplicatedMylabWorkerEmailValue ,ExceptionCodes::DuplicatedMylabWorkerEmailValue);
        }
        
//update to db==================================================================
         
           $entityManager->persist($MylabWorkers);
           $entityManager->flush($MylabWorkers);
       
           $result["worker_id"] = $MylabWorkers->getWorkerId();

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