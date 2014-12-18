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
 * @param type $name
 * @param type $equipment_category
 * @return string
 * @throws Exception
 */

function PostEquipmentTypes($name, $equipment_category) {

    global $app,$entityManager,$Options;

    $EquipmentType = new EquipmentTypes();
    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = json_decode($app->request()->getBody());
    $params = loadParameters();

    try {

    //user permisions===========================================================
    if (!($app->request->user['uid'][0] == $Options["UserAllCRUDPermissions"]))
        throw new Exception(ExceptionMessages::NoPermissionToPostLab, ExceptionCodes::NoPermissionToPostLab);
        
    //$name=====================================================================
     CRUDUtils::EntitySetParam($EquipmentType, $name, 'EquipmentTypeName', 'name', $params, true, false);
     
    //$equipment_type===========================================================      
    CRUDUtils::entitySetAssociation($EquipmentType, $equipment_category, 'EquipmentCategories', 'equipmentCategory', 'EquipmentCategory', $params, 'equipment_category');
        
//controls======================================================================   

        //check for duplicate ==================================================   
        $checkDuplicate = $entityManager->getRepository('EquipmentTypes')->findOneBy(array( 'name'  => $EquipmentType->getName() ));

        if (count($checkDuplicate) != 0)
            throw new Exception(ExceptionMessages::DuplicatedEquipmentTypeValue,ExceptionCodes::DuplicatedEquipmentTypeValue);  
        
//insert to db================================================================== 
        $entityManager->persist($EquipmentType);
        $entityManager->flush($EquipmentType);

        $result["equipment_type_id"] = $EquipmentType->getEquipmentTypeId();
           
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