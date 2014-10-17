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
 * @param type $submitted
 * @param type $transition_date
 * @param type $transition_justification
 * @param type $transition_source
 * @return string
 * @throws Exception
 */

function LabSubmit($lab_id, $submitted, $transition_date, $transition_justification, $transition_source ) {
    
    global $app,$entityManager;

    $result = array();
    $LabTransition = new LabTransitions();
    
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = json_decode($app->request()->getBody());
    $params = loadParameters();
       
    try {
        
//$lab_id=====================================================    
        $fLabID = CRUDUtils::checkIDParam('lab_id', $params, $lab_id, 'LabID');
       
//init entity for update row====================================================
        $Lab = CRUDUtils::findIDParam($fLabID, 'Labs', 'Lab'); 

        //check if lab is already submitted and stop proccess
         if ($Lab->getSubmitted() == true){
            throw new Exception(ExceptionMessages::AlreadyLabSubmittedActiveValue." : ".$submitted, ExceptionCodes::InvalidLabSubmittedType);    
         }
        
//$updated infos================================================================
        $username =  $app->request->user['uid'];
        $Lab->setLastUpdated(new \DateTime (date('Y-m-d H:i:s')));  
        $Lab->setUpdatedBy($username[0]);  
        
//$submitted====================================================================   
            if (Validator::Missing('submitted', $params))
                throw new Exception(ExceptionMessages::MissingLabSubmittedParam." : ".$submitted, ExceptionCodes::MissingLabSubmittedParam);
            else if (Validator::isNull($submitted))
                throw new Exception(ExceptionMessages::MissingLabSubmittedValue." : ".$submitted, ExceptionCodes::MissingLabSubmittedValue); 
            else if (Validator::IsArray($submitted))
                throw new Exception(ExceptionMessages::InvalidLabSubmittedArray." : ".$submitted, ExceptionCodes::InvalidLabSubmittedArray);
            else if (Validator::IsTrue($submitted)) 
                 $Lab->setSubmitted(1);    
//            else if (Validator::IsFalse($submitted)) 
//                 $Lab->setEllak(Validator::ToFalse($submitted));       
            else
                throw new Exception(ExceptionMessages::InvalidLabSubmittedType." : ".$submitted, ExceptionCodes::InvalidLabSubmittedType); 
        
//$transition_date==============================================================      
        if (Validator::Missing('transition_date', $params))
           throw new Exception(ExceptionMessages::MissingLabTransitionDateParam." : ".$transition_date, ExceptionCodes::MissingLabTransitionDateParam);
       else if (Validator::IsNull($transition_date))
            throw new Exception(ExceptionMessages::MissingLabTransitionDateValue." : ".$transition_date, ExceptionCodes::MissingLabTransitionDateValue);
       else if (Validator::IsArray($transition_date))
            throw new Exception(ExceptionMessages::InvalidLabTransitionDateArray." : ".$transition_date, ExceptionCodes::InvalidLabTransitionDateArray);    
       else if (! Validator::IsValidDate($transition_date) )
            throw new Exception(ExceptionMessages::InvalidLabTransitionValidType." : ".$transition_date, ExceptionCodes::InvalidLabTransitionValidType); 
       else if (Validator::IsDate($transition_date,'Y-m-d'))
            $LabTransition->setTransitionDate (new \DateTime($transition_date));
       else
            throw new Exception(ExceptionMessages::InvalidLabTransitionDateType." : ".$transition_date, ExceptionCodes::InvalidLabTransitionDateType);    
 
//$transition_justification===================================================== 
        if (Validator::Missing('transition_justification', $params))
            throw new Exception(ExceptionMessages::MissingLabTransitionJustificationParam." : ".$transition_justification, ExceptionCodes::MissingLabTransitionJustificationParam);          
        else if (Validator::IsNull($transition_justification))
            throw new Exception(ExceptionMessages::MissingLabTransitionDateValue." : ".$transition_justification, ExceptionCodes::MissingLabTransitionDateValue);                        
        else if (Validator::IsValue($transition_justification))
            $LabTransition->setTransitionJustification(Validator::ToValue($transition_justification));
        else
            throw new Exception(ExceptionMessages::InvalidLabTransitionJustificationType." : ".$transition_justification, ExceptionCodes::InvalidLabTransitionJustificationType);

//$transition_source============================================================ 
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

//user permisions===============================================================
        
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array($Lab->getLabId(),$permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToPostLab, ExceptionCodes::NoPermissionToPostLab); 
         }; 
    
//controls======================================================================  

            //check if table transition has the initial transition
            $foundLabTransition = $entityManager->getRepository('LabTransitions')->findBy(array('lab'=> $fLabID));
        
            $hasInitTransition=count($foundLabTransition);
            if ($hasInitTransition >= 1){
               throw new Exception(ExceptionMessages::AlreadyLabSubmittedInitialValue, ExceptionCodes::AlreadyLabSubmittedInitialValue);  
            }
    
//update to db==================================================================

           $entityManager->persist($Lab);
           $entityManager->flush($Lab);
       
           $result["lab_id"] = $Lab->getLabId();

            //create lab_transition=============================================
            CRUDUtils::entitySetAssociation($LabTransition, $fLabID, 'Labs', 'lab', 'Lab');      
            CRUDUtils::entitySetAssociation($LabTransition, 1, 'States', 'toState', 'State');
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