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
 * @param type $name
 * @return string
 * @throws Exception
 */

function PutEquipmentCategories($equipment_category_id, $name) {

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
        throw new Exception(ExceptionMessages::NoPermissionToPutData, ExceptionCodes::NoPermissionToPutData);

//$equipment_category_id========================================================   
        $fEquipmentCategoryId = CRUDUtils::checkIDParam('equipment_category_id', $params, $equipment_category_id, 'EquipmentCategoryID');
       
//init entity for update row====================================================
        $EquipmentCategory = CRUDUtils::findIDParam($fEquipmentCategoryId, 'EquipmentCategories', 'EquipmentCategory');
        
//$name=========================================================================
        if ( Validator::IsExists('name') ){
            CRUDUtils::EntitySetParam($EquipmentCategory, $name, 'EquipmentCategoryName', 'name', $params );
        } else if ( Validator::IsNull($EquipmentCategory->getName()) ){
            throw new Exception(ExceptionMessages::MissingEquipmentCategoryNameValue." : ".$name, ExceptionCodes::MissingEquipmentCategoryNameValue);
        } 
        
//controls======================================================================   

        //check name duplicate==================================================        
        $qb = $entityManager->createQueryBuilder()
                            ->select('COUNT(eqc.equipmentCategoryId) AS fresult')
                            ->from('EquipmentCategories', 'eqc')
                            ->where("eqc.name = :name AND eqc.equipmentCategoryId != :equipmentCategoryId")
                            ->setParameter('name', $EquipmentCategory->getName())
                            ->setParameter('equipmentCategoryId', $EquipmentCategory->getEquipmentCategoryId())    
                            ->getQuery()
                            ->getSingleResult();
      
        if ( $qb["fresult"] != 0 ) {
             throw new Exception(ExceptionMessages::DuplicatedEquipmentCategoryValue ,ExceptionCodes::DuplicatedEquipmentCategoryValue);
        }
       
//update to db================================================================== 
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