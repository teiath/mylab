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
 * @param type $lab_aquisition_source_id
 * @return string
 * @throws Exception
 */


function DelLabAquisitionSources($lab_id, $lab_aquisition_source_id) {
    
    global $app,$entityManager;

    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = $app->request()->getBody();
    $params = loadParameters();
    
    try {
 
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
        
//$lab_aquisition_source_id=====================================================      
        if (Validator::Missing('lab_aquisition_source_id', $params))
            throw new Exception(ExceptionMessages::MissingLabAquisitionSourceIDParam." : ".$lab_aquisition_source_id, ExceptionCodes::MissingLabAquisitionSourceIDParam);
        else if (Validator::IsNull($lab_aquisition_source_id) )
            throw new Exception(ExceptionMessages::MissingLabAquisitionSourceIdValue." : ".$lab_aquisition_source_id, ExceptionCodes::MissingLabAquisitionSourceIdValue);
        else if (Validator::IsArray($lab_aquisition_source_id))
	    throw new Exception(ExceptionMessages::InvalidLabAquisitionSourceIDArray." : ".$lab_aquisition_source_id, ExceptionCodes::InvalidLabAquisitionSourceIDArray);    
        else if (Validator::IsID($lab_aquisition_source_id)) 
            $fLabAquisitionSourceId = Validator::ToID($lab_aquisition_source_id);
        else
            throw new Exception(ExceptionMessages::InvalidLabAquisitionSourceIDType." : ".$lab_aquisition_source_id, ExceptionCodes::InvalidLabAquisitionSourceIDType);                
        
//user permisions===============================================================
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array(validator::ToID($lab_id),$permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToPostLab, ExceptionCodes::NoPermissionToPostLab); 
         }; 
        
//controls======================================================================  

        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('LabAquisitionSources')->findBy(array( 'lab'                    => Validator::toID($fLabId),
                                                                                      'labAquisitionSourceId'  => Validator::toID($fLabAquisitionSourceId)
                                                                                    ));

        $countLabAquisitionSources = count($check);     
        if ($countLabAquisitionSources == 1)
        //set entity for delete row
        $LabAquisitionSources= $entityManager->find('LabAquisitionSources', array( "lab" => Validator::toID($fLabId), 
                                                                                   "labAquisitionSourceId" => Validator::toID($fLabAquisitionSourceId)
                                                                                  ));
        else if ($countLabAquisitionSources == 0)
            throw new Exception(ExceptionMessages::NotFoundDelLabEquipmentTypeValue." : ".$fLabId." - ".$fLabAquisitionSourceId,ExceptionCodes::NotFoundDelLabEquipmentTypeValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelLabEquipmentTypeValue." : ".$fLabId." - ".$fLabAquisitionSourceId,ExceptionCodes::DuplicateDelLabEquipmentTypeValue);
      
//insert to db==================================================================
         
        $entityManager->remove($LabAquisitionSources);
        $entityManager->flush($LabAquisitionSources);
           
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