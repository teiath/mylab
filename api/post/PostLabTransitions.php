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
 * @param type $lab_id
 * @param type $to_state
 * @param type $transition_date
 * @param type $transition_justification
 * @param type $transition_source
 * @return string
 * @throws Exception
 */

function PostLabTransitions($lab_id, $state, $transition_date, $transition_justification, $transition_source) {       
        
    global $app,$entityManager,$Options;

    $LabTransitions = new LabTransitions();
    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = json_decode($app->request()->getBody());
    $params = loadParameters();

      
    try {
 
    
//$lab_id=======================================================================       
        CRUDUtils::entitySetAssociation($LabTransitions, $lab_id, 'Labs', 'lab', 'Lab');
        
//$state========================================================================       
       CRUDUtils::entitySetAssociation($LabTransitions, $state, 'States', 'toState', 'State');
        
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
            $LabTransitions->setTransitionDate(new \DateTime($transition_date));
       else
            throw new Exception(ExceptionMessages::InvalidLabTransitionDateType." : ".$transition_date, ExceptionCodes::InvalidLabTransitionDateType);    
 
//$transition_justification===================================================== 
        if (Validator::Missing('transition_justification', $params))
            throw new Exception(ExceptionMessages::MissingLabTransitionJustificationParam." : ".$transition_justification, ExceptionCodes::MissingLabTransitionJustificationParam);          
        else if (Validator::IsNull($transition_justification))
            throw new Exception(ExceptionMessages::MissingLabTransitionDateValue." : ".$transition_justification, ExceptionCodes::MissingLabTransitionDateValue);                        
        else if (Validator::IsValue($transition_justification))
            $LabTransitions->setTransitionJustification(Validator::ToValue($transition_justification));
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
            $LabTransitions->setTransitionSource(Validator::ToTransitionSource($transition_source));
        else
            throw new Exception(ExceptionMessages::InvalidLabTransitionSourceType." : ".$transition_source, ExceptionCodes::InvalidLabTransitionSourceType);

//user permisions===============================================================
         $permissions = UserRoles::getUserPermissions($app->request->user);
   
         if ( ($app->request->user['ou'][0] == 'ΤΕΙ ΑΘΗΝΑΣ') && ($app->request->user['uid'][0] ==  $Options['Server_MyLab_username'])){
                $whatisthat = 'used for syncing with mmsch';
         } else {
                if (!in_array($LabTransitions->getLab()->getLabId(),$permissions['permit_labs'])) {
                    throw new Exception(ExceptionMessages::NoPermissionToPostLab, ExceptionCodes::NoPermissionToPostLab); 
                }; 
         }
       
        //check if lab has submitted value = 0 and restrict insert
        $Labs = $entityManager->find('Labs', Validator::ToID($lab_id));
        if (Validator::IsNull($Labs->getState())){
            throw new Exception(ExceptionMessages::InvalidLabTransitionDemoValue." : ".$lab_id ,ExceptionCodes::InvalidLabTransitionDemoValue);
        }
//controls======================================================================  

        //find last state of lab from labs table================================ 
        $checkLab = $entityManager->getRepository('Labs')->find((Validator::ToID($lab_id)));  
        $fromLabState = $checkLab->getState()->getStateId();
        
       $toLabState = $LabTransitions->getToState()->getStateId();
       
        if ($fromLabState == 3)
            throw new Exception(ExceptionMessages::InvalidDiscontinuedStateValue, ExceptionCodes::InvalidDiscontinuedStateValue);
        else if ($fromLabState == $toLabState)
            throw new Exception(ExceptionMessages::InvalidSameStateValue, ExceptionCodes::InvalidSameStateValue);
        
        //check if post the same active lab transition========================== 
        $checkDuplicate = $entityManager->getRepository('LabTransitions')->findOneBy(array( 'lab'               => $LabTransitions->getLab(),
                                                                                            'fromState'         => $fromLabState,
                                                                                            'toState'           => $toLabState,
                                                                                            'transitionDate'    => $LabTransitions->getTransitionDate()
                                                                                           ));
        
        if (!Validator::isNull($checkDuplicate)){
            throw new Exception(ExceptionMessages::DuplicatedLabTransitionValue ,ExceptionCodes::DuplicatedLabTransitionValue);
        }
        
        //find max date of lab_transition=======================================
        $findAllDates = $entityManager->getRepository('LabTransitions')->findBy(array('lab'=> $LabTransitions->getLab()));
        
            if (!Validator::isNull($findAllDates)){
                $date = $labTransitionId = array(); 
                 foreach($findAllDates as $findAllDate) {
                    $date[] = $findAllDate->getTransitionDate()->format('Y-m-d');
                    
                    //check last state of lab at lab transitions table==========
                    $labTransitionId[] = $findAllDate->getLabTransitionId();
                    $laststate[$findAllDate->getLabTransitionId()] = $findAllDate->getToState()->getStateId();
                 }
            }

        $max_date = max($date);   
        $result['maxDate'] = $max_date;
        
        $maxLabTransitionId = max($labTransitionId);   
        $result['lastTransitionLabState'] = $checkLabTransitionState = $laststate[$maxLabTransitionId];
        
         //validate that new date is greater than previous date=================
        $previous_date = strtotime($max_date);
        $new_date = strtotime(Validator::ToDate($transition_date, 'Y-m-d'));
        
        if (Validator::isLowerThan($new_date, $previous_date, true)) {   
            throw new Exception(ExceptionMessages::NotAllowedLabTransitionDate, ExceptionCodes::NotAllowedLabTransitionDate);  
        }       
             
        //check for previous active lab transition to transition table==========
        if ($fromLabState !== $checkLabTransitionState)
            throw new Exception(ExceptionMessages::SeriousProblemLabTransitionState, ExceptionCodes::SeriousProblemLabTransitionState);
 
//update lab status to labs table===============================================
        $updateLabState = $entityManager->find('Labs',$lab_id);
        CRUDUtils::entitySetAssociation($updateLabState, $state, 'States', 'state', 'State');
        $entityManager->persist($updateLabState);
        $entityManager->flush($updateLabState);
        
 //insert to db=================================================================
        CRUDUtils::entitySetAssociation($LabTransitions, $checkLabTransitionState, 'States', 'fromState', 'State');

        $entityManager->persist($LabTransitions);
        $entityManager->flush($LabTransitions);

        $result["lab_transition_id"] = $LabTransitions->getLabTransitionId();
           
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