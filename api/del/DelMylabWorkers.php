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
  
    global $app,$entityManager,$Options;

    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"] = $params;
    
    try {
 
//user permisions===============================================================
    if (!($app->request->user['uid'][0] == $Options["UserAllCRUDPermissions"]))
        throw new Exception(ExceptionMessages::NoPermissionToDeleteData, ExceptionCodes::NoPermissionToDeleteData);
                
//$worker_id====================================================================
        $fMylabWorkerID = CRUDUtils::checkIDParam('worker_id', $params, $worker_id, 'MylabWorkerID');

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