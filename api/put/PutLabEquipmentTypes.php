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
 * @param type $items
 * @return string
 * @throws Exception
 */

function PutLabEquipmentTypes($lab_id, $equipment_type_id, $items) {
    
    global $app,$entityManager;

    $result = array();
    
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = $app->request()->getBody();
    $params = loadParameters();
    
    try
    {
        
//$lab_id=======================================================================       
        $fLabID = CRUDUtils::checkIDParam('lab_id', $params, $lab_id, 'LabID');

//$equipment_type_id============================================================
        $fEquipmentTypeID = CRUDUtils::checkIDParam('equipment_type_id', $params, $equipment_type_id, 'EquipmentTypeID');
  
//init entity for update row====================================================         
        $LabEquipmentTypes = $entityManager->find('LabEquipmentTypes',array("lab" => $fLabID, "equipmentType" => $fEquipmentTypeID));

//$items========================================================================     
    if (!Validator::isNull($LabEquipmentTypes)){  
        
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

    }     
//user permisions===============================================================
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array(validator::ToID($lab_id),$permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToPostLab, ExceptionCodes::NoPermissionToPostLab); 
         };  

//controls======================================================================  
        
        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('LabEquipmentTypes')->findBy(array( 'lab'            => $fLabID,
                                                                                   'equipmentType'  => $fEquipmentTypeID,
                                                                                  ));

        $countLabEquipmentTypes = count($check);    
        if ($countLabEquipmentTypes == 0)
            throw new Exception(ExceptionMessages::NotFoundDelLabEquipmentTypeValue." : ".$fLabID." - ".$fEquipmentTypeID,ExceptionCodes::NotFoundDelLabEquipmentTypeValue);
        else if ($countLabEquipmentTypes > 1) 
            throw new Exception(ExceptionMessages::DuplicateDelLabEquipmentTypeValue." : ".$fLabID." - ".$fEquipmentTypeID,ExceptionCodes::DuplicateDelLabEquipmentTypeValue);
        else 
            $result["update"] = true;
        
 //insert to db==================================================================
        $entityManager->persist($LabEquipmentTypes);
        $entityManager->flush($LabEquipmentTypes);

        $result["lab_id"] = $LabEquipmentTypes->getLab()->getLabId();
        $result["equipment_type_id"] = $LabEquipmentTypes->getEquipmentType()->getEquipmentTypeId();
        $result["items"] = $LabEquipmentTypes->getItems();   
        
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