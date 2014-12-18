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
 * @param type $lab_type_id
 * @return string
 * @throws Exception
 */

function DelLabTypes($lab_type_id) {

    global $app,$entityManager,$Options;

    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = json_decode($app->request()->getBody());
    $params = loadParameters();
    
    try {

//user permisions===============================================================
    if (!($app->request->user['uid'][0] == $Options["UserAllCRUDPermissions"]))
        throw new Exception(ExceptionMessages::NoPermissionToDeleteLab, ExceptionCodes::NoPermissionToDeleteLab);
           
//$lab_type_id================================================================
        $fLabTypeID = CRUDUtils::checkIDParam('lab_type_id', $params, $lab_type_id, 'LabTypeID');
 
//controls======================================================================          
        
        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('LabTypes')->findBy(array( 'labTypeId' => $fLabTypeID ));
        $count= count($check);
 
        if ($count == 1)
            $LabTypes = $entityManager->find('LabTypes', $fLabTypeID);
        else if ($count == 0)
            throw new Exception(ExceptionMessages::NotFoundDelLabTypeValue." : ".$fLabTypeID ,ExceptionCodes::NotFoundDelLabTypeValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelLabTypeValue." : ".$fLabTypeID ,ExceptionCodes::DuplicateDelLabTypeValue);
        
        //check for references =================================================   
        $checkReference = $entityManager->getRepository('Labs')->findOneBy(array( 'labType'  => $fLabTypeID ));

        if (count($checkReference) != 0)
            throw new Exception(ExceptionMessages::ReferencesLabTypeLabs. $fLabTypeID,ExceptionCodes::ReferencesLabTypeLabs);  
        
//delete from db================================================================
        $entityManager->remove($LabTypes);
        $entityManager->flush($LabTypes);
           
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