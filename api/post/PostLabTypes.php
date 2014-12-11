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
 * @param type $name
 * @param type $full_name
 * @return string
 * @throws Exception
 */

function PostLabTypes($name, $full_name) {

    global $app,$entityManager;

    $LabType = new LabTypes();
    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = json_decode($app->request()->getBody());
    $params = loadParameters();

    try {

    //$name=====================================================================
     CRUDUtils::EntitySetParam($LabType, $name, 'LabTypeName', 'name', $params, true, false);
     
    //$full_name================================================================
     CRUDUtils::EntitySetParam($LabType, $full_name, 'LabTypeFullName', 'full_name', $params, true, false);
        
    //user permisions===========================================================
    //TODO ΒΑΛΕ ΝΑ ΜΠΟΡΕΙ ΝΑ ΤΟ ΚΑΝΕΙ ΕΝΑΣ ΧΡΗΣΤΗΣ ΠΟΥ ΝΑ ΑΝΗΚΕΙ ΣΕ ΜΙΑ ΚΑΤΗΓΟΡΙΑ 
    //
        
//controls======================================================================   

        //check for duplicate ==================================================   
        $checkDuplicate = $entityManager->getRepository('LabTypes')->findOneBy(array( 'name'  => $LabType->getName() ));
        $checkDuplicateFullName = $entityManager->getRepository('LabTypes')->findOneBy(array( 'fullName'  => $LabType->getFullName() ));
        
        if ((count($checkDuplicate) != 0) || (count($checkDuplicateFullName) != 0))
            throw new Exception(ExceptionMessages::DuplicatedLabTypeValue,ExceptionCodes::DuplicatedLabTypeValue);  
        
//insert to db================================================================== 
        $entityManager->persist($LabType);
        $entityManager->flush($LabType);

        $result["lab_type_id"] = $LabType->getLabTypeId();
           
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