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
    $params = loadParameters();
    $result["parameters"] = $params;
    
    try
    {
      
//$lab_id=======================================================================       
        $fLabID = CRUDUtils::checkIDParam('lab_id', $params, $lab_id, 'LabID');

//$equipment_type_id============================================================ 
        $fEquipmentTypeID = CRUDUtils::checkIDParam('equipment_type_id', $params, $equipment_type_id, 'LabEquipmentTypeID');
             
//user permisions===============================================================
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array($fLabID, $permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToDeleteLab, ExceptionCodes::NoPermissionToDeleteLab); 
         };  

//controls======================================================================  

        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('LabEquipmentTypes')->findBy(array( 'lab'            => $fLabID,
                                                                                   'equipmentType'  => $fEquipmentTypeID,
                                                                                  ));

        $countLabEquipmentTypes = count($check);
        
        if ($countLabEquipmentTypes == 1)
            //set entity for delete row
            $LabEquipmentTypes = $entityManager->find('LabEquipmentTypes', array("lab"           =>  $fLabID, 
                                                                                 "equipmentType" =>  $fEquipmentTypeID)
                                                                                );
        else if ($countLabEquipmentTypes == 0)
            throw new Exception(ExceptionMessages::NotFoundDelLabEquipmentTypeValue." : ".$fLabID." - ".$fEquipmentTypeID,ExceptionCodes::NotFoundDelLabEquipmentTypeValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelLabEquipmentTypeValue." : ".$fLabID." - ".$fEquipmentTypeID,ExceptionCodes::DuplicateDelLabEquipmentTypeValue);
      
//delete from db================================================================
         
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