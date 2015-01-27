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
*                   method="PUT",
*                   summary="Ενημέρωση Εργαζόμενου",
*                   notes="Ενημέρωση Εργαζόμενου",
*                   type="putMylabWorkers",
*                   nickname="PutMylabWorkers",
* 
*   @SWG\Parameter( name="worker_id", description="ID Εργαζόμενου [notNull]", required=true, type="integer", paramType="query" ),
*   @SWG\Parameter( name="registry_no", description="Α.Μ. ή Α.Φ.Μ. Εργαζόμενου [notNull]", required=true, type="string", paramType="query" ),
*   @SWG\Parameter( name="uid", description="UID Εργαζόμενου [notNull]", required=true, type="string", paramType="query" ),
*   @SWG\Parameter( name="firstname", description="Όνομα Εργαζόμενου [notNull]", required=true, type="string", paramType="query" ),
*   @SWG\Parameter( name="lastname", description="Επώνυμο Εργαζόμενου [notNull]", required=true, type="string", paramType="query" ),
*   @SWG\Parameter( name="fathername", description="Όνομα Πατρός Εργαζόμενου [notNull]", required=true, type="string", paramType="query" ),
*   @SWG\Parameter( name="email", description="Email Εργαζόμενου [notNull]", required=true, type="string", paramType="query" ),
*   @SWG\Parameter( name="worker_specialization", description="Όνομα ή ID Ειδικότητας Εργαζόμενου [notNull]", required=true, type="mixed(string|integer])", paramType="query" ),
*   @SWG\Parameter( name="lab_source", description="Όνομα ή ID Πρωτογενούς Πηγής Δεδομένων Εργαζόμενου [notNull]", required=true, type="mixed(string|integer)", paramType="query" ),
* 
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToPutLab, message=ExceptionMessages::NoPermissionToPutLab),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingMylabWorkerIDParam, message=ExceptionMessages::MissingMylabWorkerIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingMylabWorkerIDValue, message=ExceptionMessages::MissingMylabWorkerIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerIDType, message=ExceptionMessages::InvalidMylabWorkerIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerIDArray, message=ExceptionMessages::InvalidMylabWorkerIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerValue, message=ExceptionMessages::InvalidMylabWorkerValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateMylabWorkeUniqueValue, message=ExceptionMessages::DuplicateMylabWorkeUniqueValue),
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
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabSourceParam, message=ExceptionMessages::MissingLabSourceParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabSourceValue, message=ExceptionMessages::MissingLabSourceValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabSourceValue, message=ExceptionMessages::InvalidLabSourceValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabSourceType, message=ExceptionMessages::InvalidLabSourceType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicatedMylabWorkerRegistryNoValue, message=ExceptionMessages::DuplicatedMylabWorkerRegistryNoValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicatedMylabWorkerUidValue, message=ExceptionMessages::DuplicatedMylabWorkerUidValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicatedMylabWorkerEmailValue, message=ExceptionMessages::DuplicatedMylabWorkerEmailValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="putMylabWorkers",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="parameters",type="array",description="Οι παράμετροι που δίνει ο χρήστης" ),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="worker_id",type="integer",description="Ο κωδικός ID της εγγραφής στην οποία πραγματοποιήθηκε ενημέρωση δεδομένων.")
* )
* 
*/

function PutMylabWorkers($worker_id, $registry_no, $uid, $firstname, $lastname, $fathername, $email, $worker_specialization, $lab_source) {
    
    global $app,$entityManager;

    $result = array();
    
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"] = $params;
   
    try {
        
 //user permisions===============================================================
    //not required (all users with title 'ΔΙΕΥΘΥΝΤΗΣ' or 'ΤΟΜΕΑΡΧΗΣ' have permissions to PutMyLabWorkers)
         
//$worker_id====================================================================    
        $fWorkerId = CRUDUtils::checkIDParam('worker_id', $params, $worker_id, 'MylabWorkerID');
       
//init entity for update row====================================================
        $MylabWorkers = CRUDUtils::findIDParam($fWorkerId, 'MylabWorkers', 'MylabWorker');
                
//$registry_no==================================================================
        if ( Validator::IsExists('registry_no') ){
            CRUDUtils::entitySetParam($MylabWorkers, $registry_no, 'MylabWorkerRegistryNo', 'registry_no', $params);
        } else if ( Validator::IsNull($MylabWorkers->getRegistryNo()) ){
            throw new Exception(ExceptionMessages::MissingMylabWorkerRegistryNoValue." : ".$registry_no, ExceptionCodes::MissingMylabWorkerRegistryNoValue);
        } 
        
//$uid==========================================================================
        if ( Validator::IsExists('uid') ){
            CRUDUtils::entitySetParam($MylabWorkers, $uid, 'MylabWorkerUid', 'uid', $params);
        } else if ( Validator::IsNull($MylabWorkers->getUid()) ){
            throw new Exception(ExceptionMessages::MissingMylabWorkerUidValue." : ".$uid, ExceptionCodes::MissingMylabWorkerUidValue);
        } 
        
//$firstname====================================================================
        if ( Validator::IsExists('firstname') ){
            CRUDUtils::entitySetParam($MylabWorkers, $firstname, 'MylabWorkerFirstname', 'firstname', $params);
        } else if ( Validator::IsNull($MylabWorkers->getFirstname()) ){
            throw new Exception(ExceptionMessages::MissingMylabWorkerFirstnameValue." : ".$firstname, ExceptionCodes::MissingMylabWorkerFirstnameValue);
        } 
        
//$lastname=====================================================================
        if ( Validator::IsExists('lastname') ){
            CRUDUtils::entitySetParam($MylabWorkers, $lastname, 'MylabWorkerLastname', 'lastname', $params);
        } else if ( Validator::IsNull($MylabWorkers->getLastname()) ){
            throw new Exception(ExceptionMessages::MissingMylabWorkerLastnameValue." : ".$lastname, ExceptionCodes::MissingMylabWorkerLastnameValue);
        } 
        
//$fathername===================================================================
        if ( Validator::IsExists('fathername') ){
            CRUDUtils::entitySetParam($MylabWorkers, $fathername, 'MylabWorkerFathername', 'fathername', $params);
        } else if ( Validator::IsNull($MylabWorkers->getFathername()) ){
            throw new Exception(ExceptionMessages::MissingMylabWorkerFathernameValue." : ".$fathername, ExceptionCodes::MissingMylabWorkerFathernameValue);
        } 
   
//$email========================================================================
        if ( Validator::IsExists('email') ){
            CRUDUtils::entitySetParam($MylabWorkers, $email, 'MylabWorkerEmail', 'email', $params);
        } else if ( Validator::IsNull($MylabWorkers->getEmail()) ){
            throw new Exception(ExceptionMessages::MissingMylabWorkerEmailValue." : ".$email, ExceptionCodes::MissingMylabWorkerEmailValue);
        } 
        
//$worker_specialization========================================================       
        if ( Validator::IsExists('worker_specialization') ){
            CRUDUtils::entitySetAssociation($MylabWorkers, $worker_specialization, 'WorkerSpecializations', 'workerSpecialization', 'WorkerSpecialization', $params, 'worker_specialization');
        } else if ( Validator::IsNull($MylabWorkers->getWorkerSpecialization() ) ){
            throw new Exception(ExceptionMessages::MissingWorkerSpecializationNameValue." : ".$worker_specialization, ExceptionCodes::MissingWorkerSpecializationNameValue);
        } 
        
//$lab_source===================================================================       
        if ( Validator::IsExists('lab_source') ){
            CRUDUtils::entitySetAssociation($MylabWorkers, $lab_source, 'LabSources', 'labSource', 'LabSource', $params, 'lab_source');
        } else if ( Validator::IsNull($MylabWorkers->getLabSource()) ){
            throw new Exception(ExceptionMessages::MissingLabSourceInfosValue." : ".$lab_source, ExceptionCodes::MissingLabSourceInfosValue);
        } 
         
//controls======================================================================  

        //check registry_no duplicate===========================================        
        $qb = $entityManager->createQueryBuilder()
                            ->select('COUNT(mlw.workerId) AS fresult')
                            ->from('MylabWorkers', 'mlw')
                            ->where("mlw.registryNo = :registryNo AND mlw.workerId != :workerId")
                            ->setParameter('registryNo', $MylabWorkers->getRegistryNo())
                            ->setParameter('workerId', $MylabWorkers->getWorkerId())    
                            ->getQuery()
                            ->getSingleResult();
      
        if ( $qb["fresult"] != 0 ) {
             throw new Exception(ExceptionMessages::DuplicatedMylabWorkerRegistryNoValue ,ExceptionCodes::DuplicatedMylabWorkerRegistryNoValue);
        }
        
        //check uid duplicate===================================================    
        $qb = $entityManager->createQueryBuilder()
                    ->select('COUNT(mlw.workerId) AS fresult')
                    ->from('MylabWorkers', 'mlw')
                    ->where("mlw.uid = :uid AND mlw.workerId != :workerId")
                    ->setParameter('uid', $MylabWorkers->getUid())
                    ->setParameter('workerId', $MylabWorkers->getWorkerId())    
                    ->getQuery()
                    ->getSingleResult();

        if ( $qb["fresult"] != 0 ) {
             throw new Exception(ExceptionMessages::DuplicatedMylabWorkerUidValue ,ExceptionCodes::DuplicatedMylabWorkerUidValue);
        }
        
        //check email duplicate=================================================  
        $qb = $entityManager->createQueryBuilder()
                    ->select('COUNT(mlw.workerId) AS fresult')
                    ->from('MylabWorkers', 'mlw')
                    ->where("mlw.email = :email AND mlw.workerId != :workerId")
                    ->setParameter('email', $MylabWorkers->getEmail())
                    ->setParameter('workerId', $MylabWorkers->getWorkerId())    
                    ->getQuery()
                    ->getSingleResult();

        if ( $qb["fresult"] != 0 ) {
             throw new Exception(ExceptionMessages::DuplicatedMylabWorkerEmailValue ,ExceptionCodes::DuplicatedMylabWorkerEmailValue);
        }
        
//update to db==================================================================
         
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