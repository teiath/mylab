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
 * @param type $infos
 * @return string
 * @throws Exception
 */

function PostLabSources($name, $infos) {

    global $app,$entityManager,$Options;

    $LabSource = new LabSources();
    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"]  = $params;

    try {

    //user permisions===========================================================
    if (!($app->request->user['uid'][0] == $Options["UserAllCRUDPermissions"]))
        throw new Exception(ExceptionMessages::NoPermissionToPostData, ExceptionCodes::NoPermissionToPostData);
        
    //$name=====================================================================
     CRUDUtils::EntitySetParam($LabSource, $name, 'LabSourceName', 'name', $params, true, false);
     
    //$infos====================================================================
     CRUDUtils::EntitySetParam($LabSource, $infos, 'LabSourceInfos', 'infos', $params, true, false);

//controls======================================================================   

        //check for duplicate ==================================================   
        $checkDuplicate = $entityManager->getRepository('LabSources')->findOneBy(array( 'name' => $LabSource->getName() ));
        
        if (count($checkDuplicate) != 0)
            throw new Exception(ExceptionMessages::DuplicatedLabSourceValue,ExceptionCodes::DuplicatedLabSourceValue);  
        
//insert to db================================================================== 
        $entityManager->persist($LabSource);
        $entityManager->flush($LabSource);

        $result["lab_source_id"] = $LabSource->getLabSourceId();
           
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