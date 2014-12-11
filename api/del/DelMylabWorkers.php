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
 * @return string
 * @throws Exception
 */

function DelMylabWorkers($worker_id) {
  
    global $app,$entityManager;

    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = json_decode($app->request()->getBody());
    $params = loadParameters();
    
    try {
        
//$worker_id====================================================================
        $fMylabWorkerID = CRUDUtils::checkIDParam('worker_id', $params, $worker_id, 'MylabWorkerID');
        
//user permisions===============================================================
//TODO ΒΑΛΕ ΝΑ ΜΠΟΡΕΙ ΝΑ ΤΟ ΚΑΝΕΙ ΕΝΑΣ ΧΡΗΣΤΗΣ ΠΟΥ ΝΑ ΑΝΗΚΕΙ ΣΕ ΜΙΑ ΚΑΤΗΓΟΡΙΑ 
//

//controls======================================================================          
        
        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('MylabWorkers')->findBy(array( 'workerId' => $fMylabWorkerID ));
        $count= count($check);

        if ($count == 1)
            $MylabWorkers = $entityManager->find('MylabWorkers', $fMylabWorkerID);
        else if ($count == 0)
            throw new Exception(ExceptionMessages::NotFoundDelMyLabWorkerValue." : ".$fMylabWorkerID ,ExceptionCodes::NotFoundDelMyLabWorkerValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelMyLabWorkerValue." : ".$fMylabWorkerID ,ExceptionCodes::DuplicateDelMyLabWorkerValue);
        
        //check for references =================================================   
        $checkReference = $entityManager->getRepository('LabWorkers')->findOneBy(array( 'worker'  => $fMylabWorkerID ));

        if (count($checkReference) != 0)
            throw new Exception(ExceptionMessages::ReferencesMyLabWorkerLabWorkers. $fMylabWorkerID,ExceptionCodes::ReferencesMyLabWorkerLabWorkers);  
        
//delete from db================================================================
        $entityManager->remove($MylabWorkers);
        $entityManager->flush($MylabWorkers);
           
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