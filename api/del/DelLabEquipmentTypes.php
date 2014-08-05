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
 * @param type $equipment_type_id
 * @return string
 * @throws Exception
 */


function DelLabEquipmentTypes($lab_id,$equipment_type_id) {

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

//$equipment_type_id============================================================ 
        $fEquipmentTypeID = CRUDUtils::checkIDParam($params, $equipment_type_id, 'LabEquipmentTypeID');
             
//user permisions===============================================================
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array(validator::ToID($lab_id),$permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToPostLab, ExceptionCodes::NoPermissionToPostLab); 
         };  

//controls======================================================================  

        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('LabEquipmentTypes')->findBy(array( 'lab'            => Validator::toID($fLabID),
                                                                                   'equipmentType'  => Validator::toID($fEquipmentTypeID),
                                                                                  ));

        $countLabEquipmentTypes = count($check);
        
        if ($countLabEquipmentTypes == 1)
            //set entity for delete row
            $LabEquipmentTypes = $entityManager->find('LabEquipmentTypes', array("lab"           =>  Validator::toID($fLabID), 
                                                                                 "equipmentType" =>  Validator::toID($fEquipmentTypeID))
                                                                                );
        else if ($countLabEquipmentTypes == 0)
            throw new Exception(ExceptionMessages::NotFoundDelLabEquipmentTypeValue." : ".$fLabID." - ".$fEquipmentTypeID,ExceptionCodes::NotFoundDelLabEquipmentTypeValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelLabEquipmentTypeValue." : ".$fLabID." - ".$fEquipmentTypeID,ExceptionCodes::DuplicateDelLabEquipmentTypeValue);
      
//insert to db==================================================================
         
        $entityManager->remove($LabEquipmentTypes);
        $entityManager->flush($LabEquipmentTypes);
           
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