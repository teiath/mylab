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
 * @global type $db
 * @global type $app
 * @param type $lab_id
 * @param type $lab_relation_id
 * @return string
 * @throws Exception
 */


function DelLabRelations($lab_id, $lab_relation_id) {

    global $app,$entityManager;

    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = $app->request()->getBody();
    $params = loadParameters();
    
    try
    {
      
//$lab_id=======================================================================
        $fLabID = CRUDUtils::checkIDParam($params, $lab_id, 'LabID');

//$lab_relation_id==============================================================
        $fLabRelationID = CRUDUtils::checkIDParam($params, $lab_relation_id, 'LabRelationID');
             
//user permisions===============================================================
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array(validator::ToID($lab_id),$permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToPostLab, ExceptionCodes::NoPermissionToPostLab); 
         };  

//controls======================================================================  

        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('LabRelations')->findBy(array( 'lab'            => Validator::toID($fLabID),
                                                                              'labRelationId'  => Validator::toID($fLabRelationID),
                                                                            ));

        $countLabRelations = count($check);
        
        if ($countLabRelations == 1)
            //set entity for delete row
            $LabRelations = $entityManager->find('LabRelations',array( 'lab'            => Validator::toID($fLabID),
                                                                       'labRelationId'  => Validator::toID($fLabRelationID),
                                                                      ));
        else if ($countLabRelations == 0)
            throw new Exception(ExceptionMessages::NotFoundDelLabRelationValue." : ".$fLabID." - ".$fLabRelationID,ExceptionCodes::NotFoundDelLabRelationValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelLabRelationValue." : ".$fLabID." - ".$fLabRelationID,ExceptionCodes::DuplicateDelLabRelationValue);
      
//insert to db==================================================================
         
        $entityManager->remove($LabRelations);
        $entityManager->flush($LabRelations);
           
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