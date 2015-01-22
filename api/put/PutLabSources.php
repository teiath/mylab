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
 * @param type $name
 * @param type $infos
 * @return string
 * @throws Exception
 */

function PutLabSources($lab_source_id, $name, $infos) {

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
        throw new Exception(ExceptionMessages::NoPermissionToPutData, ExceptionCodes::NoPermissionToPutData);

//$lab_source_id================================================================    
        $fLabSourceId = CRUDUtils::checkIDParam('lab_source_id', $params, $lab_source_id, 'LabSourceID');
       
//init entity for update row====================================================
        $LabSource = CRUDUtils::findIDParam($fLabSourceId, 'LabSources', 'LabSource');
        
//$name=========================================================================
        if ( Validator::IsExists('name') ){
            CRUDUtils::EntitySetParam($LabSource, $name, 'LabSourceName', 'name', $params );
        } else if ( Validator::IsNull($LabSource->getName()) ){
            throw new Exception(ExceptionMessages::MissingLabSourceNameValue." : ".$name, ExceptionCodes::MissingLabSourceNameValue);
        } 

//$infos========================================================================       
        if ( Validator::IsExists('infos') ){
            CRUDUtils::EntitySetParam($LabSource, $infos, 'LabSourceInfos', 'infos', $params );
        } else if ( Validator::IsNull($LabSource->getInfos()) ){
            throw new Exception(ExceptionMessages::MissingLabSourceInfosValue." : ".$infos, ExceptionCodes::MissingLabSourceInfosValue);
        } 

//controls======================================================================   

        //check duplicate=======================================================        
        $qb = $entityManager->createQueryBuilder()
                            ->select('COUNT(ls.labSourceId) AS fresult')
                            ->from('LabSources', 'ls')
                            ->where("ls.name = :name AND ls.labSourceId != :labSourceId")
                            ->setParameter('name', $LabSource->getName())
                            ->setParameter('labSourceId', $LabSource->getLabSourceId())    
                            ->getQuery()
                            ->getSingleResult();
      
        if ( $qb["fresult"] != 0 ) {
             throw new Exception(ExceptionMessages::DuplicatedLabSourceValue ,ExceptionCodes::DuplicatedLabSourceValue);
        }
       
//update to db================================================================== 
        $entityManager->persist($LabSource);
        $entityManager->flush($LabSource);

        $result["lab_source_id"] = $LabSource->getLabSourceId();  
           
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