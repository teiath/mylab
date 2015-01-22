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
 * @param type $lab_transition_id
 * @param type $transition_justification
 * @param type $transition_source
 * @return string
 * @throws Exception
 */

function PutLabTransitions($lab_transition_id, $transition_justification, $transition_source) {

    global $app,$entityManager;

    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"] = $params;

    try {
 
//$lab_transition_id============================================================    
        $fLabTransitionId = CRUDUtils::checkIDParam('lab_transition_id', $params, $lab_transition_id, 'LabTransitionID');
       
//init entity for update row====================================================
        $LabTransition = CRUDUtils::findIDParam($fLabTransitionId, 'LabTransitions', 'LabTransition');
    
//$transition_justification=====================================================   
        if (Validator::IsExists('transition_justification')){
   
            if (Validator::Missing('transition_justification', $params))
                throw new Exception(ExceptionMessages::MissingLabTransitionJustificationParam." : ".$transition_justification, ExceptionCodes::MissingLabTransitionJustificationParam);          
            else if (Validator::IsNull($transition_justification))
                throw new Exception(ExceptionMessages::MissingLabTransitionDateValue." : ".$transition_justification, ExceptionCodes::MissingLabTransitionDateValue);                        
            else if (Validator::IsValue($transition_justification))
                $LabTransition->setTransitionJustification(Validator::ToValue($transition_justification));
            else
                throw new Exception(ExceptionMessages::InvalidLabTransitionJustificationType." : ".$transition_justification, ExceptionCodes::InvalidLabTransitionJustificationType);
             
        } else if ( Validator::IsNull($LabTransition->getTransitionJustification()) ){
            throw new Exception(ExceptionMessages::MissingLabTransitionJustificationValue." : ".$transition_justification, ExceptionCodes::MissingLabTransitionJustificationValue);
        } 
        
//$transition_source============================================================   
        if (Validator::IsExists('transition_source')){
   
            if (Validator::Missing('transition_source', $params))
                throw new Exception(ExceptionMessages::MissingLabTransitionSourceParam." : ".$transition_source, ExceptionCodes::MissingLabTransitionSourceParam);          
            else if (Validator::IsNull($transition_source))
                throw new Exception(ExceptionMessages::MissingLabTransitionSourceValue." : ".$transition_source, ExceptionCodes::MissingLabTransitionSourceValue);                        
            else if (Validator::IsArray($transition_source))
                throw new Exception(ExceptionMessages::InvalidLabTransitionSourceArray." : ".$transition_source, ExceptionCodes::InvalidLabTransitionSourceArray);                        
            else if (Validator::IsTransitionSource($transition_source))
                $LabTransition->setTransitionSource(Validator::ToTransitionSource($transition_source));
            else
                throw new Exception(ExceptionMessages::InvalidLabTransitionSourceType." : ".$transition_source, ExceptionCodes::InvalidLabTransitionSourceType);
            
        } else if ( Validator::IsNull($LabTransition->getTransitionSource()) ){
            throw new Exception(ExceptionMessages::MissingLabTransitionSourceValue." : ".$transition_source, ExceptionCodes::MissingLabTransitionSourceValue);
        } 
        
    //user permisions===========================================================
        $permissions = UserRoles::getUserPermissions($app->request->user);
                
        if (!in_array($LabTransition->getLab()->getLabId(), $permissions['permit_labs'])) {
            throw new Exception(ExceptionMessages::NoPermissionToPutLab, ExceptionCodes::NoPermissionToPutLab); 
        }; 
        
        //check if lab has submitted value = 0 and restrict update
        $Labs = $entityManager->find('Labs', Validator::ToID($LabTransition->getLab()->getLabId()));
        if ($Labs->getSubmitted() == false){
            throw new Exception(ExceptionMessages::InvalidLabTransitionDemoValue." : ".$LabTransition->getLab()->getLabId() ,ExceptionCodes::InvalidLabTransitionDemoValue);
        }
        
//controls======================================================================   
       
//update to db================================================================== 
        $entityManager->persist($LabTransition);
        $entityManager->flush($LabTransition);

        $result["lab_transition_id"] = $LabTransition->getLabTransitionId();  
           
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