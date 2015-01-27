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
* resourcePath="/mylab_workers",
* description="Εργαζόμενοι",
* produces="['application/json']",
* @SWG\Api(
*   path="/mylab_workers",
*   @SWG\Operation(
*                   method="POST",
*                   summary="Εισαγωγή Εργαζόμενου",
*                   notes="Εισαγωγή Εργαζόμενου.Τα στοιχεία τα αποθηκεύουμε με συνδυασμό της function ldap_workers από το ΠΣΔ LDAP",
*                   type="postMylabWorkers",
*                   nickname="PostMylabWorkers",
* 
*   @SWG\Parameter( name="registry_no", description="Α.Μ. ή Α.Φ.Μ. Εργαζόμενου [notNull]", required=true, type="string", paramType="query" ),
*   @SWG\Parameter( name="uid", description="UID Εργαζόμενου [notNull]", required=true, type="string", paramType="query" ),
*   @SWG\Parameter( name="firstname", description="Όνομα Εργαζόμενου [notNull]", required=true, type="string", paramType="query" ),
*   @SWG\Parameter( name="lastname", description="Επώνυμο Εργαζόμενου [notNull]", required=true, type="string", paramType="query" ),
*   @SWG\Parameter( name="fathername", description="Όνομα Πατρός Εργαζόμενου [notNull]", required=true, type="string", paramType="query" ),
*   @SWG\Parameter( name="email", description="Email Εργαζόμενου [notNull]", required=true, type="string", paramType="query" ),
*   @SWG\Parameter( name="worker_specialization", description="Όνομα ή ID Ειδικότητας Εργαζόμενου [notNull]", required=true, type="mixed(string|integer])", paramType="query" ),
*   @SWG\Parameter( name="lab_source", description="Όνομα ή ID Πρωτογενούς Πηγής Δεδομένων Εργαζόμενου [notNull]", required=true, type="mixed(string|integer)", paramType="query" ),
*   
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToPostLab, message=ExceptionMessages::NoPermissionToPostLab),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingMylabWorkerRegistryNoParam, message=ExceptionMessages::MissingMylabWorkerRegistryNoParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingMylabWorkerRegistryNoValue, message=ExceptionMessages::MissingMylabWorkerRegistryNoValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerRegistryNoType, message=ExceptionMessages::InvalidMylabWorkerRegistryNoType),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingMylabWorkerUidParam, message=ExceptionMessages::MissingMylabWorkerUidParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingMylabWorkerUidValue, message=ExceptionMessages::MissingMylabWorkerUidValue), 
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerUidType, message=ExceptionMessages::InvalidMylabWorkerUidType),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingMylabWorkerLastnameParam, message=ExceptionMessages::MissingMylabWorkerLastnameParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingMylabWorkerLastnameValue, message=ExceptionMessages::MissingMylabWorkerLastnameValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerLastnameType, message=ExceptionMessages::InvalidMylabWorkerLastnameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingMylabWorkerFirstnameParam, message=ExceptionMessages::MissingMylabWorkerFirstnameParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingMylabWorkerFirstnameValue, message=ExceptionMessages::MissingMylabWorkerFirstnameValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerFirstnameType, message=ExceptionMessages::InvalidMylabWorkerFirstnameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingMylabWorkerFathernameParam, message=ExceptionMessages::MissingMylabWorkerFathernameParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingMylabWorkerFathernameValue, message=ExceptionMessages::MissingMylabWorkerFathernameValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerFathernameType, message=ExceptionMessages::InvalidMylabWorkerFathernameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingMylabWorkerEmailParam, message=ExceptionMessages::MissingMylabWorkerEmailParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingMylabWorkerEmailValue, message=ExceptionMessages::MissingMylabWorkerEmailValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerEmailType, message=ExceptionMessages::InvalidMylabWorkerEmailType),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingWorkerSpecializationParam, message=ExceptionMessages::MissingWorkerSpecializationParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingWorkerSpecializationValue, message=ExceptionMessages::MissingWorkerSpecializationValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidWorkerSpecializationValue, message=ExceptionMessages::InvalidWorkerSpecializationValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidWorkerSpecializationType, message=ExceptionMessages::InvalidWorkerSpecializationType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateWorkerSpecializationUniqueValue, message=ExceptionMessages::DuplicateWorkerSpecializationUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabSourceParam, message=ExceptionMessages::MissingLabSourceParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabSourceValue, message=ExceptionMessages::MissingLabSourceValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabSourceValue, message=ExceptionMessages::InvalidLabSourceValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabSourceType, message=ExceptionMessages::InvalidLabSourceType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateLabSourceUniqueValue, message=ExceptionMessages::DuplicateLabSourceUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicatedMylabWorkerRegistryNoValue, message=ExceptionMessages::DuplicatedMylabWorkerRegistryNoValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicatedMylabWorkerUidValue, message=ExceptionMessages::DuplicatedMylabWorkerUidValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicatedMylabWorkerEmailValue, message=ExceptionMessages::DuplicatedMylabWorkerEmailValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="postMylabWorkers",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="parameters",type="array",description="Οι παράμετροι που δίνει ο χρήστης" ),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="worker_id",type="integer",description="Ο κωδικός ID της εγγραφής στην οποία πραγματοποιήθηκε εισαγωγή δεδομένων.")
* )
* 
*/

function PostMylabWorkers($registry_no, $uid, $firstname, $lastname, $fathername, $email, $worker_specialization, $lab_source) {
    
    global $app,$entityManager;

    $MylabWorkers = new MylabWorkers();
    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"]  = $params;

    try {
      
//user permisions===============================================================
    //not required (all users with title 'ΔΙΕΥΘΥΝΤΗΣ' or 'ΤΟΜΕΑΡΧΗΣ' have permissions to PostMyLabWorkers)
  
//$registry_number==============================================================
        CRUDUtils::entitySetParam($MylabWorkers, $registry_no, 'MylabWorkerRegistryNo', 'registry_no', $params);
        
//$uid==========================================================================
        CRUDUtils::entitySetParam($MylabWorkers, $uid, 'MylabWorkerUid', 'uid', $params);
        
//$lastname=====================================================================
       CRUDUtils::entitySetParam($MylabWorkers, $lastname, 'MylabWorkerLastname', 'lastname', $params);
       
//$firstname====================================================================
        CRUDUtils::entitySetParam($MylabWorkers, $firstname, 'MylabWorkerFirstname', 'firstname', $params);
                
//$fathername===================================================================
        CRUDUtils::entitySetParam($MylabWorkers, $fathername, 'MylabWorkerFathername', 'fathername', $params);
 
//$email========================================================================
        CRUDUtils::entitySetParam($MylabWorkers, $email, 'MylabWorkerEmail', 'email', $params);
        
//$worker_specialization========================================================  
        if ($worker_specialization == "ΠΕ20-ΠΛΗΡΟΦΟΡΙΚΗΣ ΤΕΙ" ){$worker_specialization = 2;}
        if ($worker_specialization == "ΠΕ19-ΠΛΗΡΟΦΟΡΙΚΗΣ ΑΕΙ" ){$worker_specialization = 1;}
        CRUDUtils::entitySetAssociation($MylabWorkers, $worker_specialization, 'WorkerSpecializations', 'workerSpecialization', 'WorkerSpecialization', $params, 'worker_specialization');
       
//$lab_source===================================================================         
        CRUDUtils::entitySetAssociation($MylabWorkers, $lab_source, 'LabSources', 'labSource', 'LabSource', $params, 'lab_source');

//controls======================================================================  

        //check duplicates======================================================        
        $checkDuplicateRegistryNo = $entityManager->getRepository('MylabWorkers')->findOneBy(array( 'registryNo' => $MylabWorkers->getRegistryNo() ));

        if (!Validator::isNull($checkDuplicateRegistryNo)){
            throw new Exception(ExceptionMessages::DuplicatedMylabWorkerRegistryNoValue ,ExceptionCodes::DuplicatedMylabWorkerRegistryNoValue);
        }    
        
        $checkDuplicateUid = $entityManager->getRepository('MylabWorkers')->findOneBy(array( 'uid' => $MylabWorkers->getUid() ));

        if (!Validator::isNull($checkDuplicateUid)){
            throw new Exception(ExceptionMessages::DuplicatedMylabWorkerUidValue ,ExceptionCodes::DuplicatedMylabWorkerUidValue);
        } 
        
        $checkDuplicateEmail = $entityManager->getRepository('MylabWorkers')->findOneBy(array( 'email' => $MylabWorkers->getEmail() ));

        if (!Validator::isNull($checkDuplicateEmail)){
            throw new Exception(ExceptionMessages::DuplicatedMylabWorkerEmailValue ,ExceptionCodes::DuplicatedMylabWorkerEmailValue);
        } 
        
//insert to db==================================================================
       
           $entityManager->persist($MylabWorkers);
           $entityManager->flush($MylabWorkers);
       
           $result["worker_id"] = $MylabWorkers->getWorkerId();
            
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