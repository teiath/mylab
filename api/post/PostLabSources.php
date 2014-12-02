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

    global $app,$entityManager;

    $LabSource = new LabSources();
    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = json_decode($app->request()->getBody());
    $params = loadParameters();

    try {

    //$name=====================================================================
     CRUDUtils::EntitySetParam($LabSource, $name, 'LabSourceName', 'name', $params, true, false);
     
    //$full_name================================================================
     CRUDUtils::EntitySetParam($LabSource, $infos, 'LabSourceInfos', 'infos', $params, true, false);
        
    //user permisions===============================================================
    //TODO ΒΑΛΕ ΝΑ ΜΠΟΡΕΙ ΝΑ ΤΟ ΚΑΝΕΙ ΕΝΑΣ ΧΡΗΣΤΗΣ ΠΟΥ ΝΑ ΑΝΗΚΕΙ ΣΕ ΜΙΑ ΚΑΤΗΓΟΡΙΑ 
    //
        
//controls======================================================================   

        //check for duplicate =================================================   
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