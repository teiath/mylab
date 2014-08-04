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
        if (Validator::Missing('lab_id', $params))
            throw new Exception(ExceptionMessages::MissingLabIDParam." : ".$lab_id, ExceptionCodes::MissingLabIDParam);          
        else if (Validator::IsNull($lab_id))
            throw new Exception(ExceptionMessages::MissingLabIDValue." : ".$lab_id, ExceptionCodes::MissingLabIDValue);                        
        else if (Validator::IsArray($lab_id))
            throw new Exception(ExceptionMessages::InvalidLabIDArray." : ".$lab_id, ExceptionCodes::InvalidLabIDArray);
        else if (Validator::IsID($lab_id))
            $fLabId = Validator::ToID($lab_id);
        else
            throw new Exception(ExceptionMessages::InvalidLabIDType." : ".$lab_id, ExceptionCodes::InvalidLabIDType);

//$lab_relation_id============================================================== 
        if (Validator::Missing('lab_relation_id', $params))
            throw new Exception(ExceptionMessages::MissingLabRelationIDParam." : ".$lab_relation_id, ExceptionCodes::MissingLabRelationIDParam);          
        else if (Validator::IsNull($lab_relation_id))
            throw new Exception(ExceptionMessages::MissingLabRelationIDValue." : ".$lab_relation_id, ExceptionCodes::MissingLabRelationIDValue);                        
        else if (Validator::IsArray($lab_relation_id))
            throw new Exception(ExceptionMessages::InvalidLabRelationIDArray." : ".$lab_relation_id, ExceptionCodes::InvalidLabRelationIDArray);
        else if (Validator::IsID($lab_relation_id))
            $fLabRelationId = Validator::ToID($lab_relation_id);
        else
            throw new Exception(ExceptionMessages::InvalidLabRelationIDType." : ".$lab_relation_id, ExceptionCodes::InvalidLabRelationIDType);
             
//user permisions===============================================================
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array(validator::ToID($lab_id),$permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToPostLab, ExceptionCodes::NoPermissionToPostLab); 
         };  

//controls======================================================================  

        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('LabRelations')->findBy(array( 'lab'            => Validator::toID($fLabId),
                                                                              'labRelationId'  => Validator::toID($fLabRelationId),
                                                                            ));

        $countLabRelations = count($check);
        
        if ($countLabRelations == 1)
            //set entity for delete row
            $LabRelations = $entityManager->find('LabRelations',array( 'lab'            => Validator::toID($fLabId),
                                                                       'labRelationId'  => Validator::toID($fLabRelationId),
                                                                      ));
        else if ($countLabRelations == 0)
            throw new Exception(ExceptionMessages::NotFoundDelLabRelationValue." : ".$fLabId." - ".$fLabRelationId,ExceptionCodes::NotFoundDelLabRelationValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelLabRelationValue." : ".$fLabId." - ".$fLabRelationId,ExceptionCodes::DuplicateDelLabRelationValue);
      
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