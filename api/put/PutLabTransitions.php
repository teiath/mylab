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
*                   method="PUT",
*                   summary="Ενημέρωση Λειτουργικής Κατάστασης Διάταξης Η/Υ",
*                   notes="Ενημέρωση Λειτουργικής Κατάστασης Διάταξης Η/Υ",
*                   type="putLabTransitions",
*                   nickname="PutLabTransitions",
* 
*   @SWG\Parameter( name="lab_transition_id", description="ID Λειτουργικής Κατάστασης Διάταξης Η/Υ [notNull]", required=true, type="integer", paramType="query" ),
*   @SWG\Parameter( name="transition_justification", description="Αιτιολογία Αλλαγής Μετάβασης Λειτουργικής Καταστάσης Διατάξης [notNull]", required=true, type="mixed(string|integer)", paramType="query" ),
*   @SWG\Parameter( name="transition_source", description="Πηγή Αλλαγής Μετάβασης Λειτουργικής Καταστάσης Διατάξης [notNull]", required=true, type="string", paramType="query", enum="['mylab','mmsch']" ),
* 
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToPutLab, message=ExceptionMessages::NoPermissionToPutLab),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTransitionIDParam, message=ExceptionMessages::MissingLabTransitionIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTransitionIDValue, message=ExceptionMessages::MissingLabTransitionIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTransitionIDType, message=ExceptionMessages::InvalidLabTransitionIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTransitionIDArray, message=ExceptionMessages::InvalidLabTransitionIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTransitionValue, message=ExceptionMessages::InvalidLabTransitionValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateLabTransitionUniqueValue, message=ExceptionMessages::DuplicateLabTransitionUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTransitionJustificationParam, message=ExceptionMessages::MissingLabTransitionJustificationParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTransitionDateValue, message=ExceptionMessages::MissingLabTransitionDateValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTransitionJustificationType, message=ExceptionMessages::InvalidLabTransitionJustificationType),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTransitionSourceParam, message=ExceptionMessages::MissingLabTransitionSourceParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTransitionSourceValue, message=ExceptionMessages::MissingLabTransitionSourceValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTransitionSourceArray, message=ExceptionMessages::InvalidLabTransitionSourceArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTransitionSourceType, message=ExceptionMessages::InvalidLabTransitionSourceType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTransitionDemoValue, message=ExceptionMessages::InvalidLabTransitionDemoValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="putLabTransitions",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="parameters",type="array",description="Οι παράμετροι που δίνει ο χρήστης" ),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="lab_transition_id",type="integer",description="Ο κωδικός ID της εγγραφής στην οποία πραγματοποιήθηκε ενημέρωση δεδομένων.")
* )
* 
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