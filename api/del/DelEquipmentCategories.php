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
 * @param type $equipment_category_id
 * @return string
 * @throws Exception
 */

function DelEquipmentCategories($equipment_category_id) {
   
    global $app,$entityManager,$Options;

    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"] = $params;
    
    try {
 
//user permisions===============================================================
    if (!($app->request->user['uid'][0] == $Options["UserAllCRUDPermissions"]))
        throw new Exception(ExceptionMessages::NoPermissionToDeleteData, ExceptionCodes::NoPermissionToDeleteData);
          
//$equipment_category_id========================================================
        $fEquipmentCategoryID = CRUDUtils::checkIDParam('equipment_category_id', $params, $equipment_category_id, 'EquipmentCategoryID');

//controls======================================================================          
        
        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('EquipmentCategories')->findBy(array( 'equipmentCategoryId' => $fEquipmentCategoryID ));
        $count= count($check);

        if ($count == 1)
            $EquipmentCategories = $entityManager->find('EquipmentCategories', $fEquipmentCategoryID);
        else if ($count == 0)
            throw new Exception(ExceptionMessages::NotFoundDelEquipmentCategoryValue." : ".$fEquipmentCategoryID ,ExceptionCodes::NotFoundDelEquipmentCategoryValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelEquipmentCategoryValue." : ".$fEquipmentCategoryID ,ExceptionCodes::DuplicateDelEquipmentCategoryValue);
        
        //check for references =================================================   
        $checkReference = $entityManager->getRepository('EquipmentTypes')->findOneBy(array( 'equipmentCategory'  => $fEquipmentCategoryID ));

        if (count($checkReference) != 0)
            throw new Exception(ExceptionMessages::ReferencesEquipmentCategoryEquipmentTypes. $fEquipmentCategoryID,ExceptionCodes::ReferencesEquipmentCategoryEquipmentTypes);  
        
//delete from db================================================================
        $entityManager->remove($EquipmentCategories);
        $entityManager->flush($EquipmentCategories);
           
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