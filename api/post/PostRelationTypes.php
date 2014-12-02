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
 * @return string
 * @throws Exception
 */

function PostRelationTypes($name) {

    global $app,$entityManager;

    $RelationType = new RelationTypes();
    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = json_decode($app->request()->getBody());
    $params = loadParameters();

    try {

    //$name=====================================================================
     CRUDUtils::EntitySetParam($RelationType, $name, 'RelationTypeName', 'name', $params, true, false);
        
    //user permisions===============================================================
    //TODO ΒΑΛΕ ΝΑ ΜΠΟΡΕΙ ΝΑ ΤΟ ΚΑΝΕΙ ΕΝΑΣ ΧΡΗΣΤΗΣ ΠΟΥ ΝΑ ΑΝΗΚΕΙ ΣΕ ΜΙΑ ΚΑΤΗΓΟΡΙΑ 
    //
        
//controls======================================================================   

        //check for duplicate =================================================   
        $checkDuplicate = $entityManager->getRepository('RelationTypes')->findOneBy(array( 'name' => $RelationType->getName() ));
        
        if (count($checkDuplicate) != 0)
            throw new Exception(ExceptionMessages::DuplicatedRelationTypeValue,ExceptionCodes::DuplicatedRelationTypeValue);  
        
//insert to db================================================================== 
        $entityManager->persist($RelationType);
        $entityManager->flush($RelationType);

        $result["relation_type_id"] = $RelationType->getRelationTypeId();
           
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