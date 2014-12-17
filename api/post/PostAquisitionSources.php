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
 * @global type $Options
 * @param type $name
 * @return string
 * @throws Exception
 */

function PostAquisitionSources($name) {

    global $app,$entityManager,$Options;

    $AquisitionSource = new AquisitionSources();
    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = json_decode($app->request()->getBody());
    $params = loadParameters();

    try {
 
    //user permisions===========================================================
    if (!($app->request->user['uid'][0] == $Options["UserAllCRUDPermissions"]))
        throw new Exception(ExceptionMessages::NoPermissionToPostLab, ExceptionCodes::NoPermissionToPostLab);
        
    //$name=====================================================================
     CRUDUtils::EntitySetParam($AquisitionSource, $name, 'AquisitionSourceName', 'name', $params, true, false);
         
//controls======================================================================   

        //check for duplicate ==================================================   
        $checkDuplicate = $entityManager->getRepository('AquisitionSources')->findOneBy(array( 'name'  => $AquisitionSource->getName() ));

        if (count($checkDuplicate) != 0)
            throw new Exception(ExceptionMessages::DuplicatedAquisitionSourceValue,ExceptionCodes::DuplicatedAquisitionSourceValue);  
        
//insert to db================================================================== 
        $entityManager->persist($AquisitionSource);
        $entityManager->flush($AquisitionSource);

        $result["aquisition_source_id"] = $AquisitionSource->getAquisitionSourceId();  
           
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