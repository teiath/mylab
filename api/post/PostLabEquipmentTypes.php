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
 * @param type $equipment_type
 * @param type $items
 * @return string
 * @throws Exception
 */

function PostLabEquipmentTypes($lab_id, $equipment_type, $items) {
    
    global $app,$entityManager;

    $LabEquipmentTypes = new LabEquipmentTypes();
    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = json_decode($app->request()->getBody());
    $params = loadParameters();
    
    try
    {
      
//$lab_id=======================================================================       
        CRUDUtils::entitySetAssociation($LabEquipmentTypes, $lab_id, 'Labs', 'lab', 'Lab');
        
//$equipment_type===============================================================       
        CRUDUtils::entitySetAssociation($LabEquipmentTypes, $equipment_type, 'EquipmentTypes', 'equipmentType', 'EquipmentType');
    
//$items========================================================================      
        if (Validator::Missing('items', $params))
            throw new Exception(ExceptionMessages::MissingLabEquipmentTypeItemsParam." : ".$items, ExceptionCodes::MissingLabEquipmentTypeItemsParam);          
        else if (Validator::IsNull($items))
            throw new Exception(ExceptionMessages::MissingLabEquipmentTypeItemsValue." : ".$items, ExceptionCodes::MissingLabEquipmentTypeItemsValue);                        
        else if (Validator::IsArray($items))
            throw new Exception(ExceptionMessages::InvalidLabEquipmentTypeItemsArray." : ".$items, ExceptionCodes::InvalidLabEquipmentTypeItemsArray);
        else if (Validator::ToNumeric($items) <=0 || Validator::ToNumeric($items) > 10000 ) 
            throw new Exception(ExceptionMessages::InvalidLabEquipmentTypeItemsValidType." : ".$items, ExceptionCodes::InvalidLabEquipmentTypeItemsValidType);
        else if (Validator::IsNumeric($items))
            $LabEquipmentTypes->setItems(Validator::ToNumeric($items));
        else
            throw new Exception(ExceptionMessages::InvalidLabEquipmentTypeItemsType." : ".$items, ExceptionCodes::InvalidLabEquipmentTypeItemsType);

//user permisions===============================================================
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array($LabEquipmentTypes->getLab()->getLabId(), $permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToPostLab, ExceptionCodes::NoPermissionToPostLab); 
         };  

//controls======================================================================  

        //check duplicates======================================================        
        $checkDuplicate = $entityManager->getRepository('LabEquipmentTypes')->findOneBy(array(  'lab'           => $LabEquipmentTypes->getLab(),
                                                                                                'equipmentType' => $LabEquipmentTypes->getEquipmentType()
                                                                                              ));

        if (!Validator::isNull($checkDuplicate)){
            throw new Exception(ExceptionMessages::DuplicatedLabEquipmentTypeValue ,ExceptionCodes::DuplicatedLabEquipmentTypeValue);
        } 
       
 //insert to db=================================================================       
        $entityManager->persist($LabEquipmentTypes);
        $entityManager->flush($LabEquipmentTypes);

        $result["lab_id"] = $LabEquipmentTypes->getLab()->getLabId();
        $result["equipment_type_id"] = $LabEquipmentTypes->getEquipmentType()->getEquipmentTypeId();
           
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