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
* 
* 
* @SWG\Resource(
* apiVersion=API_VERSION,
* swaggerVersion=SWAGGER_VERSION,
* basePath=BASE_PATH,
* resourcePath="/lab_transitions",
* description="Λειτουργικές Καταστάσεις Διατάξεων",
* produces="['application/json']",
* @SWG\Api(
*   path="/lab_transitions",
*   @SWG\Operation(
*                   method="POST",
*                   summary="Εισαγωγή Λειτουργικής Κατάστασης Διάταξης Η/Υ",
*                   notes="Εισαγωγή Λειτουργικής Κατάστασης Διάταξης Η/Υ",
*                   type="postLabTransitions",
*                   nickname="PostLabTransitions",
* 
*   @SWG\Parameter( name="lab_id", description="ID Διάταξης Η/Υ [notNull]", required=true, type="integer", paramType="query" ),
*   @SWG\Parameter( name="state", description="Όνομα ή ID Τρέχουσας Λειτουργικής Καταστάσης [notNull]", required=true, type="mixed(string|integer)", paramType="query" ),
*   @SWG\Parameter( name="transition_date", description="Ημερομηνία Μετάβασης Λειτουργικής Καταστάσης Διατάξης [notNull](μορφή ημερομηνίας dd/mm/yyyy)", required=true, type="string|array[string]", format="date", paramType="query" ),
*   @SWG\Parameter( name="transition_justification", description="Αιτιολογία Αλλαγής Μετάβασης Λειτουργικής Καταστάσης Διατάξης [notNull]", required=true, type="mixed(string|integer)", paramType="query" ),
*   @SWG\Parameter( name="transition_source", description="Πηγή Αλλαγής Μετάβασης Λειτουργικής Καταστάσης Διατάξης [notNull]", required=true, type="string", paramType="query", enum="['mylab','mmsch']" ),
*
*   
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToPostLab, message=ExceptionMessages::NoPermissionToPostLab),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabParam, message=ExceptionMessages::MissingLabParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabValue, message=ExceptionMessages::MissingLabValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabValue, message=ExceptionMessages::InvalidLabValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabType, message=ExceptionMessages::InvalidLabType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateLabUniqueValue, message=ExceptionMessages::DuplicateLabUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingStateParam, message=ExceptionMessages::MissingStateParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingStateValue, message=ExceptionMessages::MissingStateValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidStateValue, message=ExceptionMessages::InvalidStateValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidStateType, message=ExceptionMessages::InvalidStateType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateStateUniqueValue, message=ExceptionMessages::DuplicateStateUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTransitionDateParam, message=ExceptionMessages::MissingLabTransitionDateParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTransitionDateValue, message=ExceptionMessages::MissingLabTransitionDateValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTransitionDateArray, message=ExceptionMessages::InvalidLabTransitionDateArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTransitionValidType, message=ExceptionMessages::InvalidLabTransitionValidType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTransitionDateType, message=ExceptionMessages::InvalidLabTransitionDateType),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTransitionJustificationParam, message=ExceptionMessages::MissingLabTransitionJustificationParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTransitionDateValue, message=ExceptionMessages::MissingLabTransitionDateValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTransitionJustificationType, message=ExceptionMessages::InvalidLabTransitionJustificationType),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTransitionSourceParam, message=ExceptionMessages::MissingLabTransitionSourceParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTransitionSourceValue, message=ExceptionMessages::MissingLabTransitionSourceValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTransitionSourceArray, message=ExceptionMessages::InvalidLabTransitionSourceArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTransitionSourceType, message=ExceptionMessages::InvalidLabTransitionSourceType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTransitionDemoValue, message=ExceptionMessages::InvalidLabTransitionDemoValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidDiscontinuedStateValue, message=ExceptionMessages::InvalidDiscontinuedStateValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSameStateValue, message=ExceptionMessages::InvalidSameStateValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicatedLabTransitionValue, message=ExceptionMessages::DuplicatedLabTransitionValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NotAllowedLabTransitionDate, message=ExceptionMessages::NotAllowedLabTransitionDate),
*   @SWG\ResponseMessage(code=ExceptionCodes::SeriousProblemLabTransitionState, message=ExceptionMessages::SeriousProblemLabTransitionState),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="postLabTransitions",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="parameters",type="array",description="Οι παράμετροι που δίνει ο χρήστης" ),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="lab_transition_id",type="integer",description="Ο κωδικός ID της εγγραφής στην οποία πραγματοποιήθηκε εισαγωγή δεδομένων.")
* )
* 
*/

function PostLabTransitions($lab_id, $state, $transition_date, $transition_justification, $transition_source) {       
        
    global $app,$entityManager,$Options;

    $LabTransitions = new LabTransitions();
    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"]  = $params;

    try {
 
    
//$lab_id=======================================================================       
        CRUDUtils::entitySetAssociation($LabTransitions, $lab_id, 'Labs', 'lab', 'Lab', $params, 'lab_id');
        
//$state========================================================================       
       CRUDUtils::entitySetAssociation($LabTransitions, $state, 'States', 'toState', 'State', $params, 'state');
        
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
         $permissions = CheckUserPermissions::getUserPermissions($app->request->user);
   
         if ( ($app->request->user['ou'][0] == 'ΤΕΙ ΑΘΗΝΑΣ') && ($app->request->user['uid'][0] ==  $Options['Server_MyLab_username'])){
                $whatisthat = 'used for syncing with mmsch.Only admin can sync lab_transitions';
         } else {
                if (!in_array($LabTransitions->getLab()->getLabId(),$permissions['permit_labs'])) {
                    throw new Exception(ExceptionMessages::NoPermissionToPostLab, ExceptionCodes::NoPermissionToPostLab); 
                }; 
         }
       
        //check if lab has submitted value = 0 and restrict insert
        $Labs = $entityManager->find('Labs', Validator::ToID($lab_id));
        if ($Labs->getSubmitted() == false){
            throw new Exception(ExceptionMessages::InvalidLabTransitionDemoValue." : ".$lab_id ,ExceptionCodes::InvalidLabTransitionDemoValue);
        }
        
//controls======================================================================  

        //find last state of lab from labs table================================ 
        $checkLab = $entityManager->getRepository('Labs')->find((Validator::ToID($lab_id)));  
        //$fromLabState = $checkLab->getState()->getStateId();
        $fromLabState = Validator::IsNull($checkLab->getState()) ? Validator::ToNull() : $checkLab->getState()->getStateId();

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
        CRUDUtils::entitySetAssociation($updateLabState, $state, 'States', 'state', 'State', $params, 'state');
        $entityManager->persist($updateLabState);
        $entityManager->flush($updateLabState);
        
 //insert to db=================================================================
        //because of user cant set up 'from_state' parameter we use the required parameter 'lab_id' as paspartu to continue
        //$checkLabTransitionState variable retrieved from mylab system 
        CRUDUtils::entitySetAssociation($LabTransitions, $checkLabTransitionState, 'States', 'fromState', 'State', $params, 'lab_id');

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