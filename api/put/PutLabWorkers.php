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
* resourcePath="/lab_workers",
* description="Υπεύθυνοι Διατάξεων",
* produces="['application/json']",
* @SWG\Api(
*   path="/lab_workers",
*   @SWG\Operation(
*                   method="PUT",
*                   summary="Ενημέρωση Υπεύθυνου Διάταξης Η/Υ",
*                   notes="Ενημέρωση Υπεύθυνου Διάταξης Η/Υ",
*                   type="putLabWorkers",
*                   nickname="PutLabbWorkers",
* 
*   @SWG\Parameter( name="lab_worker_id", description="ID Υπεύθυνου Διάταξης Η/Υ [notNull]", required=true, type="integer", paramType="query" ),
*   @SWG\Parameter( name="worker_status", description="Κατάσταση Υπεύθυνου Διατάξης Η/Υ [notNull](1=Ενεργός,3=Μη Ενεργός)", required=true, type="integer", paramType="query", enum="['1','3']" ),
* 
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToPutLab, message=ExceptionMessages::NoPermissionToPutLab),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabWorkerIDParam, message=ExceptionMessages::MissingLabWorkerIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabWorkerIDValue, message=ExceptionMessages::MissingLabWorkerIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerIDType, message=ExceptionMessages::InvalidLabWorkerIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerIDArray, message=ExceptionMessages::InvalidLabWorkerIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerValue, message=ExceptionMessages::InvalidLabWorkerValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateLabWorkerUniqueValue, message=ExceptionMessages::DuplicateLabWorkerUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabWorkerStatusParam, message=ExceptionMessages::MissingLabWorkerStatusParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabWorkerStatusValue, message=ExceptionMessages::MissingLabWorkerStatusValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerStatusArray, message=ExceptionMessages::InvalidLabWorkerStatusArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerStatusType, message=ExceptionMessages::InvalidLabWorkerStatusType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicatedLabWorkerValue, message=ExceptionMessages::DuplicatedLabWorkerValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="putLabWorkers",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="parameters",type="array",description="Οι παράμετροι που δίνει ο χρήστης" ),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="lab_worker_id",type="integer",description="Ο κωδικός ID της εγγραφής στην οποία πραγματοποιήθηκε ενημέρωση δεδομένων.")
* )
* 
*/

function PutLabWorkers($lab_worker_id, $worker_status) {
    
    global $app,$entityManager;

    $result = array();
    
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"] = $params;
    
    try {
        
//$lab_worker_id================================================================    
        $fLabWorkerId = CRUDUtils::checkIDParam('lab_worker_id', $params, $lab_worker_id, 'LabWorkerID');
       
//init entity for update row====================================================
        $LabWorker = CRUDUtils::findIDParam($fLabWorkerId, 'LabWorkers', 'LabWorker');
      
//$updated infos================================================================
        $username =  $app->request->user['uid'];
        $LabWorker->setDeleteLabWorkerBy(new \DateTime (date('Y-m-d')));  
        $LabWorker->setDeleteBy($username[0]);   
        
//$worker_status================================================================   
        if (Validator::IsExists('worker_status')){
               
            if (Validator::Missing('worker_status', $params))
                throw new Exception(ExceptionMessages::MissingLabWorkerStatusParam." : ".$worker_status, ExceptionCodes::MissingLabWorkerStatusParam);           
            else if (Validator::IsNull($worker_status))
                throw new Exception(ExceptionMessages::MissingLabWorkerStatusValue." : ".$worker_status, ExceptionCodes::MissingLabWorkerStatusValue);
            else if (Validator::IsArray($worker_status))
                throw new Exception(ExceptionMessages::InvalidLabWorkerStatusArray." : ".$worker_status, ExceptionCodes::InvalidLabWorkerStatusArray);                           
            else if ( Validator::IsWorkerState($worker_status) && (Validator::ToWorkerState($worker_status) == 3) ) {
                $LabWorker->setWorkerStatus(Validator::ToWorkerState($worker_status));
            } else {
                 throw new Exception(ExceptionMessages::InvalidLabWorkerStatusType." : ".$worker_status, ExceptionCodes::InvalidLabWorkerStatusType);
            }
        
        } else if ( !Validator::IsWorkerState($LabWorker->getWorkerStatus())){
            throw new Exception(ExceptionMessages::MissingLabWorkerStatusValue." : ".$worker_status, ExceptionCodes::MissingLabWorkerStatusValue);
        } 
        
//user permisions===============================================================
         $permissions = CheckUserPermissions::getUserPermissions($app->request->user);
         
         if (!in_array($LabWorker->getLab()->getLabId(), $permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToPutLab, ExceptionCodes::NoPermissionToPutLab); 
         }; 
 
//controls======================================================================  

        //check duplicates======================================================           
        $checkDuplicate = $entityManager->getRepository('LabWorkers')->findOneBy(array( 'labWorkerId'   => $LabWorker->getLabWorkerId(),
                                                                                        'workerStatus'  => $LabWorker->getWorkerStatus()                                                                                   
                                                                                        ));

        if (!Validator::isNull($checkDuplicate)){
            throw new Exception(ExceptionMessages::DuplicatedLabWorkerValue ,ExceptionCodes::DuplicatedLabWorkerValue);
        }   
        
    
//update to db==================================================================
         
           $entityManager->persist($LabWorker);
           $entityManager->flush($LabWorker);
       
           $result["lab_worker_id"] = $LabWorker->getLabWorkerId();

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