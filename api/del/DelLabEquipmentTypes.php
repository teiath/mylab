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
 * @return string
 * @throws Exception
 */


function DelLabEquipmentTypes($lab_id,$equipment_type_id) {

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
        if (Validator::Missing('lab_id', $params))
            throw new Exception(ExceptionMessages::MissingLabIDParam." : ".$lab_id, ExceptionCodes::MissingLabIDParam);          
        else if (Validator::IsNull($lab_id))
            throw new Exception(ExceptionMessages::MissingLabIDValue." : ".$lab_id, ExceptionCodes::MissingLabIDValue);                        
        else if (Validator::IsArray($lab_id))
            throw new Exception(ExceptionMessages::InvalidLabIDArray." : ".$lab_id, ExceptionCodes::InvalidLabIDArray);
        else if (Validator::IsID($lab_id))
            $fLabId = Validator::ToID($lab_id);
        else
            throw new Exception(ExceptionMessages::InvalidLabIDType." : ".$lab_id, ExceptionCodes::InvalidLabIDType);

//$equipment_type_id=============================================================== 
        if (Validator::Missing('equipment_type_id', $params))
            throw new Exception(ExceptionMessages::MissingLabEquipmentTypeIDParam." : ".$equipment_type_id, ExceptionCodes::MissingLabEquipmentTypeIDParam);          
        else if (Validator::IsNull($equipment_type_id))
            throw new Exception(ExceptionMessages::MissingLabEquipmentTypeIDValue." : ".$equipment_type_id, ExceptionCodes::MissingLabEquipmentTypeIDValue);                        
        else if (Validator::IsArray($equipment_type_id))
            throw new Exception(ExceptionMessages::InvalidLabEquipmentTypeIDArray." : ".$equipment_type_id, ExceptionCodes::InvalidLabEquipmentTypeIDArray);
        else if (Validator::IsID($equipment_type_id))
            $fEquipmentType = Validator::ToID($equipment_type_id);
        else
            throw new Exception(ExceptionMessages::InvalidLabEquipmentTypeIDType." : ".$equipment_type_id, ExceptionCodes::InvalidLabEquipmentTypeIDType);
             
//user permisions===============================================================
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array(validator::ToID($lab_id),$permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToPostLab, ExceptionCodes::NoPermissionToPostLab); 
         };  

//controls======================================================================  

        //check duplicates======================================================        
        $checkDuplicate = $entityManager->getRepository('LabEquipmentTypes')->findOneBy(array(  'lab'           => Validator::toID($fLabId),
                                                                                                'equipmentType' => Validator::toID($fEquipmentType),
                                                                                              ));

        if (Validator::isNull($checkDuplicate)){
            throw new Exception(ExceptionMessages::DuplicatedLabEquipmentTypeValue ,ExceptionCodes::DuplicatedLabEquipmentTypeValue);
        } 
       
        //set entity for delete row
        $LabEquipmentTypes = $entityManager->find('LabEquipmentTypes',array("lab" => $fLabId, "equipmentType" => $fEquipmentType));
      
//insert to db==================================================================
         
        $entityManager->remove($LabEquipmentTypes);
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