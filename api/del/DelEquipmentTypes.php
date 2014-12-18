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
 * @param type $equipment_type_id
 * @return string
 * @throws Exception
 */

function DelEquipmentTypes($equipment_type_id) {
  
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
        throw new Exception(ExceptionMessages::NoPermissionToDeleteLab, ExceptionCodes::NoPermissionToDeleteLab);
           
//$equipment_type_id============================================================
        $fEquipmentTypeID = CRUDUtils::checkIDParam('equipment_type_id', $params, $equipment_type_id, 'EquipmentTypeID');

//controls======================================================================          
        
        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('EquipmentTypes')->findBy(array( 'equipmentTypeId' => $fEquipmentTypeID ));
        $count= count($check);

        if ($count == 1)
            $EquipmentTypes = $entityManager->find('EquipmentTypes', $fEquipmentTypeID);
        else if ($count == 0)
            throw new Exception(ExceptionMessages::NotFoundDelEquipmentTypeValue." : ".$fEquipmentTypeID ,ExceptionCodes::NotFoundDelEquipmentCategoryValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelEquipmentTypeValue." : ".$fEquipmentTypeID ,ExceptionCodes::DuplicateDelEquipmentTypeValue);
        
        //check for references =================================================   
        $checkReference = $entityManager->getRepository('LabEquipmentTypes')->findOneBy(array( 'equipmentType'  => $fEquipmentTypeID ));

        if (count($checkReference) != 0)
            throw new Exception(ExceptionMessages::ReferencesEquipmentTypeLabEquipmentTypes. $fEquipmentTypeID,ExceptionCodes::ReferencesEquipmentTypeLabEquipmentTypes);  
        
//delete from db================================================================
        $entityManager->remove($EquipmentTypes);
        $entityManager->flush($EquipmentTypes);
           
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