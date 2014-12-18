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
 * @return string
 * @throws Exception
 */

function PostEquipmentCategories($name) {

    global $app,$entityManager,$Options;

    $EquipmentCategory = new EquipmentCategories();
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
     CRUDUtils::EntitySetParam($EquipmentCategory, $name, 'EquipmentCategoryName', 'name', $params, true, false);
        
//controls======================================================================   

        //check for duplicate ==================================================   
        $checkDuplicate = $entityManager->getRepository('EquipmentCategories')->findOneBy(array( 'name'  => $EquipmentCategory->getName() ));

        if (count($checkDuplicate) != 0)
            throw new Exception(ExceptionMessages::DuplicatedEquipmentCategoryValue,ExceptionCodes::DuplicatedEquipmentCategoryValue);  
        
//insert to db================================================================== 
        $entityManager->persist($EquipmentCategory);
        $entityManager->flush($EquipmentCategory);

        $result["equipment_category_id"] = $EquipmentCategory->getEquipmentCategoryId();  
           
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