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
*                   method="DELETE",
*                   summary="Διαγραφή Λειτουργικής Κατάστασης Διάταξης Η/Υ",
*                   notes="Διαγραφή Λειτουργικής Κατάστασης Διάταξης Η/Υ",
*                   type="delLabTransitions",
*                   nickname="DelLabTransitions",
*
*   @SWG\Parameter( name="lab_id", description="ID Διάταξης Η/Υ [notNull]", required=true, type="integer", paramType="query" ), 
*   @SWG\Parameter( name="lab_transition_id", description="ID Λειτουργικής Κατάστασης Διάταξης Η/Υ [notNull]", required=true, type="integer", paramType="query" ),
*
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToDeleteLab, message=ExceptionMessages::NoPermissionToDeleteLab),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabIDParam, message=ExceptionMessages::MissingLabIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabIDValue, message=ExceptionMessages::MissingLabIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabIDType, message=ExceptionMessages::InvalidLabIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabIDArray, message=ExceptionMessages::InvalidLabIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTransitionIDParam, message=ExceptionMessages::MissingLabTransitionIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTransitionIDValue, message=ExceptionMessages::MissingLabTransitionIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTransitionIDType, message=ExceptionMessages::InvalidLabTransitionIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTransitionIDArray, message=ExceptionMessages::InvalidLabTransitionIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::NotFoundDelLabTransitionValue, message=ExceptionMessages::NotFoundDelLabTransitionValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateDelLabTransitionValue, message=ExceptionMessages::DuplicateDelLabTransitionValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoDemoDelLabValue, message=ExceptionMessages::NoDemoDelLabValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="delLabTransitions",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="parameters",type="array",description="Οι παράμετροι που δίνει ο χρήστης" ),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης")
* )
* 
*/

function DelLabTransitions($lab_id, $lab_transition_id) {

    global $app,$entityManager;

    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"] = $params;
    
    try
    {
      
//$lab_id=======================================================================
        $fLabID = CRUDUtils::checkIDParam('lab_id', $params, $lab_id, 'LabID');

//$lab_transition_id============================================================
        $fLabTransitionID = CRUDUtils::checkIDParam('lab_transition_id', $params, $lab_transition_id, 'LabTransitionID');
             
//user permisions===============================================================
         $permissions = CheckUserPermissions::getUserPermissions($app->request->user);
         
         if (!in_array($fLabID, $permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToDeleteLab, ExceptionCodes::NoPermissionToDeleteLab); 
         };  

//controls======================================================================  

        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('LabTransitions')->findBy(array( 'lab'            => $fLabID,
                                                                                'labTransitionId'  => $fLabTransitionID,
                                                                               ));

        $countLabTransitions = count($check);
        
        if ($countLabTransitions == 1)
            //set entity for delete row
            $LabTransitions = $entityManager->find('LabTransitions', $fLabTransitionID);
        else if ($countLabTransitions == 0)
            throw new Exception(ExceptionMessages::NotFoundDelLabTransitionValue." : ".$fLabID." - ".$fLabTransitionID,ExceptionCodes::NotFoundDelLabTransitionValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelLabTransitionValue." : ".$fLabID." - ".$fLabTransitionID,ExceptionCodes::DuplicateDelLabTransitionValue);
      
        //check if lab has submitted value = 1 and restrict deletion
       $Labs = $entityManager->find('Labs', $fLabID);
        if ($Labs->getSubmitted() == true){
            throw new Exception(ExceptionMessages::NoDemoDelLabValue." : ".$fLabID ,ExceptionCodes::NoDemoDelLabValue);
        }
        
//delete from db================================================================
        
        $entityManager->remove($LabTransitions);
        $entityManager->flush($LabTransitions);
           
//find max date of remained labs lab_transition=================================
        $findAllDates = $entityManager->getRepository('LabTransitions')->findBy(array('lab'=> $fLabID));
        $countRemainedLabTransitions = count($findAllDates);
       
          $max_date = $maxLabTransitionId = $maxLabTransitionState = $state = null; 
                 
            if ($countRemainedLabTransitions > 0){
                $date = $labTransitionId = array(); 
                 foreach($findAllDates as $findAllDate) {
                    $date[] = $findAllDate->getTransitionDate()->format('Y-m-d');
                    
                    //check last state of lab at lab transitions table==========
                    $labTransitionId[] = $findAllDate->getLabTransitionId();
                    $laststate[$findAllDate->getLabTransitionId()] = $findAllDate->getToState()->getStateId();
                 }
                 
                 $max_date = max($date);
                 $result['maxDate'] = $max_date;
                 $maxLabTransitionId = max($labTransitionId);          
                 $result['lastTransitionLabState'] = $maxLabTransitionState = $laststate[$maxLabTransitionId];
                 $state = $entityManager->getRepository('States')->find(Validator::ToID($maxLabTransitionState));
            }

//update lab status to labs table===============================================
        $updateLabState = $entityManager->find('Labs',$fLabID);
        $updateLabState->setState($state);
        $entityManager->persist($updateLabState);
        $entityManager->flush($updateLabState);
         
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