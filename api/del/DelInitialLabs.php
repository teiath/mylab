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
 * @param type $lab_id
 * @return string
 * @throws Exception
 */


function DelInitialLabs($lab_id) {

    global $app,$entityManager;

    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"] = $params;
    
    try
    {
      
//$lab_id=======================================================================
        $fLabID = CRUDUtils::checkIDParam('lab_id', $params, $lab_id, 'LabID');
            
//user permisions===============================================================
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array($fLabID, $permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToDeleteLab, ExceptionCodes::NoPermissionToDeleteLab); 
         };  

//controls======================================================================  

        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('Labs')->findBy(array( 'labId' => $fLabID ));
        $countLabRelations = count($check);

        if ($countLabRelations == 1)
            //set entity for delete row
            $Labs = $entityManager->find('Labs', $fLabID);
        else if ($countLabRelations == 0)
            throw new Exception(ExceptionMessages::NotFoundDelLabValue." : ".$fLabID ,ExceptionCodes::NotFoundDelLabValue);
        else 
            throw new Exception(ExceptionMessages::NotFoundDelLabValue." : ".$fLabID ,ExceptionCodes::NotFoundDelLabValue);
  
        //check if lab has submitted value = 1 and restrict deletion
        if ($Labs->getSubmitted() == true){
            throw new Exception(ExceptionMessages::NoDemoDelLabValue." : ".$fLabID ,ExceptionCodes::NoDemoDelLabValue);
        }
        
       //check for lab references
        
        $checkLabAquisitionSources = $entityManager->getRepository('LabAquisitionSources')->findBy(array( 'lab' => $fLabID ));
        if (count($checkLabAquisitionSources)!== 0){
            foreach ($checkLabAquisitionSources as $checkLabAquisitionSource){
            $entityManager->remove($checkLabAquisitionSource);
            $entityManager->flush($checkLabAquisitionSource);
            }
        }

        $checkLabEquipmentTypes = $entityManager->getRepository('LabEquipmentTypes')->findBy(array( 'lab' => $fLabID ));
        if (count($checkLabEquipmentTypes) !== 0){
            foreach ($checkLabEquipmentTypes as $checkLabEquipmentType){
            $entityManager->remove($checkLabEquipmentType);
            $entityManager->flush($checkLabEquipmentType);
            }
        }

        $checkLabRelations = $entityManager->getRepository('LabRelations')->findBy(array( 'lab' => $fLabID ));
        if (count($checkLabRelations) !== 0){
            foreach ($checkLabRelations as $checkLabRelation){
            $entityManager->remove($checkLabRelation);
            $entityManager->flush($checkLabRelation);
            }
        }
        
//        $checkLabWorkers = $entityManager->getRepository('LabWorkers')->findBy(array( 'lab' => $fLabID ));
//        if (count($checkLabWorkers) !== 0){
//               throw new Exception(ExceptionMessages::ReferencesLabWorkers." : ".$fLabID ,ExceptionCodes::ReferencesLabWorkers);
//        }
//        
//        $checkLabTransitions = $entityManager->getRepository('LabTransitions')->findBy(array( 'lab' => $fLabID ));
//        if (count($checkLabTransitions) !== 0){
//               throw new Exception(ExceptionMessages::ReferencesLabTransitions." : ".$fLabID ,ExceptionCodes::ReferencesLabTransitions);
//        }

//delete from db================================================================
   
        $entityManager->remove($Labs);
        $entityManager->flush($Labs);
           
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