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
   
    global $app,$entityManager;

    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = json_decode($app->request()->getBody());
    $params = loadParameters();
    
    try {
        
//$equipment_category_id========================================================
        $fEquipmentCategoryID = CRUDUtils::checkIDParam('equipment_category_id', $params, $equipment_category_id, 'EquipmentCategoryID');
        
//user permisions===============================================================
//TODO ΒΑΛΕ ΝΑ ΜΠΟΡΕΙ ΝΑ ΤΟ ΚΑΝΕΙ ΕΝΑΣ ΧΡΗΣΤΗΣ ΠΟΥ ΝΑ ΑΝΗΚΕΙ ΣΕ ΜΙΑ ΚΑΤΗΓΟΡΙΑ 
//

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