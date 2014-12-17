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
 * @param type $relation_type_id
 * @param type $name
 * @return string
 * @throws Exception
 */

function PutRelationTypes($relation_type_id, $name) {

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
 
//$relation_type_id=============================================================    
        $fRelationTypeId = CRUDUtils::checkIDParam('relation_type_id', $params, $relation_type_id, 'RelationTypeID');
       
//init entity for update row====================================================
        $RelationType = CRUDUtils::findIDParam($fRelationTypeId, 'RelationTypes', 'RelationType');
        
//$name=========================================================================
        if ( Validator::IsExists('name') ){
            CRUDUtils::EntitySetParam($RelationType, $name, 'RelationTypeName', 'name', $params );
        } else if ( Validator::IsNull($RelationType->getName()) ){
            throw new Exception(ExceptionMessages::MissingRelationTypeNameValue." : ".$name, ExceptionCodes::MissingRelationTypeNameValue);
        } 

//controls======================================================================   

        //check duplicate=======================================================        
        $qb = $entityManager->createQueryBuilder()
                            ->select('COUNT(rt.relationTypeId) AS fresult')
                            ->from('RelationTypes', 'rt')
                            ->where("rt.name = :name AND rt.relationTypeId != :relationTypeId")
                            ->setParameter('name', $RelationType->getName())
                            ->setParameter('relationTypeId', $RelationType->getRelationTypeId())    
                            ->getQuery()
                            ->getSingleResult();
      
        if ( $qb["fresult"] != 0 ) {
             throw new Exception(ExceptionMessages::DuplicatedRelationTypeValue ,ExceptionCodes::DuplicatedRelationTypeValue);
        }
       
//update to db================================================================== 
        $entityManager->persist($RelationType);
        $entityManager->flush($RelationType);

        $result["relation_type_id"] = $RelationType->getRelationTypeId();  
           
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