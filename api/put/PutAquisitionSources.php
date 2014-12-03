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
 * @param type $name
 * @return string
 * @throws Exception
 */

function PutAquisitionSources($aquisition_source_id, $name) {

    global $app,$entityManager;

    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = json_decode($app->request()->getBody());
    $params = loadParameters();

    try {
 
//$aquisition_source_id==========================================================    
        $fAquisitionSourceId = CRUDUtils::checkIDParam('aquisition_source_id', $params, $aquisition_source_id, 'AquisitionSourceID');
       
//init entity for update row====================================================
        $AquisitionSource = CRUDUtils::findIDParam($fAquisitionSourceId, 'AquisitionSources', 'AquisitionSource');
        
//$name=========================================================================
        if ( Validator::IsExists('name') ){
            CRUDUtils::EntitySetParam($AquisitionSource, $name, 'AquisitionSourceName', 'name', $params );
        } else if ( Validator::IsNull($AquisitionSource->getName()) ){
            throw new Exception(ExceptionMessages::MissingAquisitionSourceNameValue." : ".$name, ExceptionCodes::MissingAquisitionSourceNameValue);
        } 
                
    //user permisions===========================================================
    //TODO ΒΑΛΕ ΝΑ ΜΠΟΡΕΙ ΝΑ ΤΟ ΚΑΝΕΙ ΕΝΑΣ ΧΡΗΣΤΗΣ ΠΟΥ ΝΑ ΑΝΗΚΕΙ ΣΕ ΜΙΑ ΚΑΤΗΓΟΡΙΑ 
    //
        
//controls======================================================================   

        //check name duplicate==================================================        
        $qb = $entityManager->createQueryBuilder()
                            ->select('COUNT(aqs.aquisitionSourceId) AS fresult')
                            ->from('AquisitionSources', 'aqs')
                            ->where("aqs.name = :name AND aqs.aquisitionSourceId != :aquisitionSourceId")
                            ->setParameter('name', $AquisitionSource->getName())
                            ->setParameter('aquisitionSourceId', $AquisitionSource->getAquisitionSourceId())    
                            ->getQuery()
                            ->getSingleResult();
      
        if ( $qb["fresult"] != 0 ) {
             throw new Exception(ExceptionMessages::DuplicatedAquisitionSourceValue ,ExceptionCodes::DuplicatedAquisitionSourceValue);
        }
       
//update to db================================================================== 
        $entityManager->persist($AquisitionSource);
        $entityManager->flush($AquisitionSource);

        $result["aquisition_source_id"] = $AquisitionSource->getAquisitionSourceId();  
           
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