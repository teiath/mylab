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
 * @param type $lab_source_id
 * @return string
 * @throws Exception
 */

function DelLabSources($lab_source_id) {
  
    global $app,$entityManager;

    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = json_decode($app->request()->getBody());
    $params = loadParameters();
    
    try {
        
//$lab_source_id================================================================
        $fLabSourceID = CRUDUtils::checkIDParam('lab_source_id', $params, $lab_source_id, 'LabSourceID');
        
//user permisions===============================================================
//TODO ΒΑΛΕ ΝΑ ΜΠΟΡΕΙ ΝΑ ΤΟ ΚΑΝΕΙ ΕΝΑΣ ΧΡΗΣΤΗΣ ΠΟΥ ΝΑ ΑΝΗΚΕΙ ΣΕ ΜΙΑ ΚΑΤΗΓΟΡΙΑ 
//

//controls======================================================================          
        
        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('LabSources')->findBy(array( 'labSourceId' => $fLabSourceID ));
        $count= count($check);

        if ($count == 1)
            $LabSources = $entityManager->find('LabSources', $fLabSourceID);
        else if ($count == 0)
            throw new Exception(ExceptionMessages::NotFoundDelLabSourceValue." : ".$fLabSourceID ,ExceptionCodes::NotFoundDelLabSourceValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelLabSourceValue." : ".$fLabSourceID ,ExceptionCodes::DuplicateDelLabSourceValue);
        
        //check for references =================================================   
        $checkReferenceLab = $entityManager->getRepository('Labs')->findOneBy(array( 'labSource'  => $fLabSourceID ));

        if (count($checkReferenceLab) != 0)
            throw new Exception(ExceptionMessages::ReferencesLabSourceLabs. $fLabSourceID,ExceptionCodes::ReferencesLabSourceLabs);  
        
        $checkReferenceMyLabWorker = $entityManager->getRepository('MylabWorkers')->findOneBy(array( 'labSource'  => $fLabSourceID ));

        if (count($checkReferenceMyLabWorker) != 0)
            throw new Exception(ExceptionMessages::ReferencesLabSourceMyLabWorkers. $fLabSourceID,ExceptionCodes::ReferencesLabSourceMyLabWorkers);  
        
//delete from db================================================================
        $entityManager->remove($LabSources);
        $entityManager->flush($LabSources);
           
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