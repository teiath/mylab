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

    global $app,$entityManager;

    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = json_decode($app->request()->getBody());
    $params = loadParameters();

    try {
 
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
                
    //user permisions===========================================================
    //TODO ΒΑΛΕ ΝΑ ΜΠΟΡΕΙ ΝΑ ΤΟ ΚΑΝΕΙ ΕΝΑΣ ΧΡΗΣΤΗΣ ΠΟΥ ΝΑ ΑΝΗΚΕΙ ΣΕ ΜΙΑ ΚΑΤΗΓΟΡΙΑ 
    //
        
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