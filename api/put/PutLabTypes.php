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
 * @param type $lab_type_id
 * @param type $name
 * @param type $full_name
 * @return string
 * @throws Exception
 */

function PutLabTypes($lab_type_id, $name, $full_name) {

    global $app,$entityManager,$Options;

    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = json_decode($app->request()->getBody());
    $params = loadParameters();

    try {
   
//user permisions===============================================================
    if (!($app->request->user['uid'][0] == $Options["UserAllCRUDPermissions"]))
        throw new Exception(ExceptionMessages::NoPermissionToPutLab, ExceptionCodes::NoPermissionToPutLab);

//$lab_type_id==================================================================    
        $fLabTypeId = CRUDUtils::checkIDParam('lab_type_id', $params, $lab_type_id, 'LabTypeID');
       
//init entity for update row====================================================
        $LabType= CRUDUtils::findIDParam($fLabTypeId, 'LabTypes', 'LabType');
        
//$name=========================================================================
        if ( Validator::IsExists('name') ){
            CRUDUtils::EntitySetParam($LabType, $name, 'LabTypeName', 'name', $params );
        } else if ( Validator::IsNull($LabType->getName()) ){
            throw new Exception(ExceptionMessages::MissingLabTypeNameValue." : ".$name, ExceptionCodes::MissingLabTypeNameValue);
        } 

//$full_name====================================================================       
        if ( Validator::IsExists('full_name') ){
            CRUDUtils::EntitySetParam($LabType, $full_name, 'LabTypeFullName', 'full_name', $params, true, false);
        } else if ( Validator::IsNull($LabType->getFullName() ) ){
            throw new Exception(ExceptionMessages::MissingLabTypeFullNameValue." : ".$full_name, ExceptionCodes::MissingLabTypeFullNameValue);
        } 
        
//controls======================================================================   

        //check duplicate=======================================================        
        $qb = $entityManager->createQueryBuilder()
                            ->select('COUNT(lt.labTypeId) AS fresult')
                            ->from('LabTypes', 'lt')
                            ->where("(lt.name = :name OR lt.fullName = :fullName) AND lt.labTypeId != :labTypeId")
                            ->setParameter('name', $LabType->getName())
                            ->setParameter('fullName', $LabType->getFullName())
                            ->setParameter('labTypeId', $LabType->getLabTypeId())    
                            ->getQuery()
                            ->getSingleResult();
      
        if ( $qb["fresult"] != 0 ) {
             throw new Exception(ExceptionMessages::DuplicatedLabTypeValue ,ExceptionCodes::DuplicatedLabTypeValue);
        }
       
//update to db================================================================== 
        $entityManager->persist($LabType);
        $entityManager->flush($LabType);

        $result["lab_type_id"] = $LabType->getLabTypeId();  
           
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