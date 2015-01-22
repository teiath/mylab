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
    $params = loadParameters();
    $result["parameters"] = $params;
    
    try {
 
//$lab_id=======================================================================             
        $fLabID = CRUDUtils::checkIDParam('lab_id', $params, $lab_id, 'LabID');
        
//$lab_aquisition_source_id=====================================================      
        $fLabAquisitionSourceID = CRUDUtils::checkIDParam('lab_aquisition_source_id', $params, $lab_aquisition_source_id, 'LabAquisitionSourceID');

//user permisions===============================================================
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array($fLabID, $permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToDeleteLab, ExceptionCodes::NoPermissionToDeleteLab); 
         }; 
        
//controls======================================================================  

        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('LabAquisitionSources')->findBy(array( 'lab'                    => $fLabID,
                                                                                      'labAquisitionSourceId'  => $fLabAquisitionSourceID
                                                                                    ));

        $countLabAquisitionSources = count($check); 
        
        if ($countLabAquisitionSources == 1)
            //set entity for delete row
            $LabAquisitionSources= $entityManager->find('LabAquisitionSources', $fLabAquisitionSourceID);
        else if ($countLabAquisitionSources == 0)
            throw new Exception(ExceptionMessages::NotFoundDelLabAquisitionSourceValue." : ".$fLabID." - ".$fLabAquisitionSourceID,ExceptionCodes::NotFoundDelLabAquisitionSourceValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelLabAquisitionSourceValue." : ".$fLabID." - ".$fLabAquisitionSourceID,ExceptionCodes::DuplicateDelLabAquisitionSourceValue);
      
//delete from db================================================================
         
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