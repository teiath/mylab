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
 * @param type $lab_aquisition_source_id
 * @return string
 * @throws Exception
 */


function DelLabAquisitionSources($lab_id, $lab_aquisition_source_id) {
    
    global $app,$entityManager;

    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = $app->request()->getBody();
    $params = loadParameters();
    
    try {
 
//$lab_id=======================================================================             
        $fLabID = CRUDUtils::checkIDParam($params, $lab_id, 'LabID');
        
//$lab_aquisition_source_id=====================================================      
        $fLabAquisitionSourceID = CRUDUtils::checkIDParam($params, $lab_aquisition_source_id, 'LabAquisitionSourceID');
        
//user permisions===============================================================
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array(validator::ToID($lab_id),$permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToPostLab, ExceptionCodes::NoPermissionToPostLab); 
         }; 
        
//controls======================================================================  

        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('LabAquisitionSources')->findBy(array( 'lab'                    => Validator::toID($fLabID),
                                                                                      'labAquisitionSourceId'  => Validator::toID($fLabAquisitionSourceID)
                                                                                    ));

        $countLabAquisitionSources = count($check);     
        if ($countLabAquisitionSources == 1)
        //set entity for delete row
        $LabAquisitionSources= $entityManager->find('LabAquisitionSources', array( "lab" => Validator::toID($fLabID), 
                                                                                   "labAquisitionSourceId" => Validator::toID($fLabAquisitionSourceID)
                                                                                  ));
        else if ($countLabAquisitionSources == 0)
            throw new Exception(ExceptionMessages::NotFoundDelLabEquipmentTypeValue." : ".$fLabID." - ".$fLabAquisitionSourceID,ExceptionCodes::NotFoundDelLabEquipmentTypeValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelLabEquipmentTypeValue." : ".$fLabID." - ".$fLabAquisitionSourceID,ExceptionCodes::DuplicateDelLabEquipmentTypeValue);
      
//insert to db==================================================================
         
        $entityManager->remove($LabAquisitionSources);
        $entityManager->flush($LabAquisitionSources);
           
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