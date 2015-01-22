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
 * @param type $registry_no
 * @param type $uid
 * @param type $firstname
 * @param type $lastname
 * @param type $fathername
 * @param type $email
 * @param type $specialization_code
 * @param type $lab_source
 * @return string
 * @throws Exception
 */

function PostMylabWorkers($registry_no, $uid, $firstname, $lastname, $fathername, $email, $worker_specialization, $lab_source) {
    
    global $app,$entityManager;

    $MylabWorkers = new MylabWorkers();
    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"]  = $params;

    try {
      
//user permisions===============================================================
    //not required (all users with title 'ΔΙΕΥΘΥΝΤΗΣ' or 'ΤΟΜΕΑΡΧΗΣ' have permissions to PostMyLabWorkers)
  
//$registry_number==============================================================
        CRUDUtils::entitySetParam($MylabWorkers, $registry_no, 'MylabWorkerRegistryNo', 'registry_no', $params);
        
//$uid==========================================================================
        CRUDUtils::entitySetParam($MylabWorkers, $uid, 'MylabWorkerUid', 'uid', $params);
        
//$lastname=====================================================================
       CRUDUtils::entitySetParam($MylabWorkers, $lastname, 'MylabWorkerLastname', 'lastname', $params);
       
//$firstname====================================================================
        CRUDUtils::entitySetParam($MylabWorkers, $firstname, 'MylabWorkerFirstname', 'firstname', $params);
                
//$fathername===================================================================
        CRUDUtils::entitySetParam($MylabWorkers, $fathername, 'MylabWorkerFathername', 'fathername', $params);
 
//$email========================================================================
        CRUDUtils::entitySetParam($MylabWorkers, $email, 'MylabWorkerEmail', 'email', $params);
        
//$worker_specialization========================================================  
        if ($worker_specialization == "ΠΕ20-ΠΛΗΡΟΦΟΡΙΚΗΣ ΤΕΙ" ){$worker_specialization = 2;}
        if ($worker_specialization == "ΠΕ19-ΠΛΗΡΟΦΟΡΙΚΗΣ ΑΕΙ" ){$worker_specialization = 1;}
        CRUDUtils::entitySetAssociation($MylabWorkers, $worker_specialization, 'WorkerSpecializations', 'workerSpecialization', 'WorkerSpecialization', $params, 'worker_specialization');
       
//$lab_source===================================================================         
        CRUDUtils::entitySetAssociation($MylabWorkers, $lab_source, 'LabSources', 'labSource', 'LabSource', $params, 'lab_source');

//controls======================================================================  

        //check duplicates======================================================        
        $checkDuplicateRegistryNo = $entityManager->getRepository('MylabWorkers')->findOneBy(array( 'registryNo' => $MylabWorkers->getRegistryNo() ));

        if (!Validator::isNull($checkDuplicateRegistryNo)){
            throw new Exception(ExceptionMessages::DuplicatedMylabWorkerRegistryNoValue ,ExceptionCodes::DuplicatedMylabWorkerRegistryNoValue);
        }    
        
        $checkDuplicateUid = $entityManager->getRepository('MylabWorkers')->findOneBy(array( 'uid' => $MylabWorkers->getUid() ));

        if (!Validator::isNull($checkDuplicateUid)){
            throw new Exception(ExceptionMessages::DuplicatedMylabWorkerUidValue ,ExceptionCodes::DuplicatedMylabWorkerUidValue);
        } 
        
        $checkDuplicateEmail = $entityManager->getRepository('MylabWorkers')->findOneBy(array( 'email' => $MylabWorkers->getEmail() ));

        if (!Validator::isNull($checkDuplicateEmail)){
            throw new Exception(ExceptionMessages::DuplicatedMylabWorkerEmailValue ,ExceptionCodes::DuplicatedMylabWorkerEmailValue);
        } 
        
//insert to db==================================================================
       
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