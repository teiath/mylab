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
 * @param type $name
 * @param type $equipment_category
 * @return string
 * @throws Exception
 */

function PutEquipmentTypes($equipment_type_id, $name, $equipment_category) {

    global $app,$entityManager;

    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = json_decode($app->request()->getBody());
    $params = loadParameters();

    try {
 
//$equipment_type_id============================================================  
        $fEquipmentTypeId = CRUDUtils::checkIDParam('equipment_type_id', $params, $equipment_type_id, 'EquipmentTypeID');
       
//init entity for update row====================================================
        $EquipmentType= CRUDUtils::findIDParam($fEquipmentTypeId, 'EquipmentTypes', 'EquipmentType');
        
//$name=========================================================================
        if ( Validator::IsExists('name') ){
            CRUDUtils::EntitySetParam($EquipmentType, $name, 'EquipmentTypeName', 'name', $params );
        } else if ( Validator::IsNull($EquipmentType->getName()) ){
            throw new Exception(ExceptionMessages::MissingEquipmentTypeNameValue." : ".$name, ExceptionCodes::MissingEquipmentTypeNameValue);
        } 

//$equipment_category========================================================       
        if ( Validator::IsExists('equipment_category') ){
            CRUDUtils::entitySetAssociation($EquipmentType, $equipment_category, 'EquipmentCategories', 'equipmentCategory', 'EquipmentCategory', $params, 'equipment_category');
        } else if ( Validator::IsNull($EquipmentType->getEquipmentCategory() ) ){
            throw new Exception(ExceptionMessages::MissingEquipmentCategoryValue." : ".$equipment_category, ExceptionCodes::MissingEquipmentCategoryValue);
        } 
        
    //user permisions===========================================================
    //TODO ΒΑΛΕ ΝΑ ΜΠΟΡΕΙ ΝΑ ΤΟ ΚΑΝΕΙ ΕΝΑΣ ΧΡΗΣΤΗΣ ΠΟΥ ΝΑ ΑΝΗΚΕΙ ΣΕ ΜΙΑ ΚΑΤΗΓΟΡΙΑ 
    //
        
//controls======================================================================   

        //check name duplicate==================================================        
        $qb = $entityManager->createQueryBuilder()
                            ->select('COUNT(eqt.equipmentTypeId) AS fresult')
                            ->from('EquipmentTypes', 'eqt')
                            ->where("eqt.name = :name AND eqt.equipmentTypeId != :equipmentTypeId")
                            ->setParameter('name', $EquipmentType->getName())
                            ->setParameter('equipmentTypeId', $EquipmentType->getEquipmentTypeId())    
                            ->getQuery()
                            ->getSingleResult();
      
        if ( $qb["fresult"] != 0 ) {
             throw new Exception(ExceptionMessages::DuplicatedEquipmentTypeValue ,ExceptionCodes::DuplicatedEquipmentTypeValue);
        }
       
//update to db================================================================== 
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