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
 * @param type $aquisition_source_id
 * @return string
 * @throws Exception
 */

function DelAquisitionSources($aquisition_source_id) {

    global $app,$entityManager;

    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = json_decode($app->request()->getBody());
    $params = loadParameters();

 try {
        
//$aquisition_source_id================================================================
        $fAquisitionSourceID = CRUDUtils::checkIDParam('aquisition_source_id', $params, $aquisition_source_id, 'AquisitionSourceID');
        
//user permisions===============================================================
//TODO ΒΑΛΕ ΝΑ ΜΠΟΡΕΙ ΝΑ ΤΟ ΚΑΝΕΙ ΕΝΑΣ ΧΡΗΣΤΗΣ ΠΟΥ ΝΑ ΑΝΗΚΕΙ ΣΕ ΜΙΑ ΚΑΤΗΓΟΡΙΑ 
//
 
//controls======================================================================          
        
        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('AquisitionSources')->findBy(array( 'aquisitionSourceId' => $fAquisitionSourceID ));
        $count= count($check);
 
        if ($count == 1)
            $AquisitionSources = $entityManager->find('AquisitionSources', $fAquisitionSourceID);
        else if ($count == 0)
            throw new Exception(ExceptionMessages::NotFoundDelAquisitionSourceValue." : ".$fAquisitionSourceID ,ExceptionCodes::NotFoundDelAquisitionSourceValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelAquisitionSourceValue." : ".$fAquisitionSourceID ,ExceptionCodes::DuplicateDelAquisitionSourceValue);
        
        //check for references =================================================   
        $checkReference = $entityManager->getRepository('LabAquisitionSources')->findOneBy(array( 'aquisitionSource'  => $fAquisitionSourceID ));

        if (count($checkReference) != 0)
            throw new Exception(ExceptionMessages::ReferencesAquisitionSourceLabAquisitionSources. $fAquisitionSourceID,ExceptionCodes::ReferencesAquisitionSourceLabAquisitionSources);  
        
//delete from db================================================================
        $entityManager->remove($AquisitionSources);
        $entityManager->flush($AquisitionSources);
           
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