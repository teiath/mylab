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
*                   method="POST",
*                   summary="Εισαγωγή Υπεύθυνου Διάταξης Η/Υ",
*                   notes="Εισαγωγή Υπεύθυνου Διάταξης Η/Υ",
*                   type="postLabWorkers",
*                   nickname="PostLabWorkers",
* 
*   @SWG\Parameter( name="lab_id", description="ID Διάταξης Η/Υ [notNull]", required=true, type="integer", paramType="query" ),
*   @SWG\Parameter( name="worker_id", description="ID Εργαζόμενου από LDAP ΠΣΔ [notNull]", required=true, type="integer", paramType="query" ),
*   @SWG\Parameter( name="worker_position", description="Όνομα ή ID Θέσης Εργασίας Εργαζόμενου [notNull]", required=true, type="mixed(string|integer)", paramType="query" ),
*   @SWG\Parameter( name="worker_status", description="Κατάσταση Υπεύθυνου Διατάξης Η/Υ [notNull](1=Ενεργός,3=Μη Ενεργός)", required=true, type="integer", paramType="query", enum="['1','3']" ),
*   @SWG\Parameter( name="worker_start_service", description="Ημερομηνία Αλλαγής Μετάβασης Λειτουργικής Καταστάσης Διατάξης [notNull](μορφή ημερομηνίας dd/mm/yyyy)", required=true, type="string", format="date", paramType="query" ),
*   
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToPostLab, message=ExceptionMessages::NoPermissionToPostLab),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabParam, message=ExceptionMessages::MissingLabParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabValue, message=ExceptionMessages::MissingLabValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabValue, message=ExceptionMessages::InvalidLabValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabType, message=ExceptionMessages::InvalidLabType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateLabUniqueValue, message=ExceptionMessages::DuplicateLabUniqueValue), 
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingMylabWorkerParam, message=ExceptionMessages::MissingMylabWorkerParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingMylabWorkerValue, message=ExceptionMessages::MissingMylabWorkerValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerArray, message=ExceptionMessages::InvalidMylabWorkerArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerType, message=ExceptionMessages::InvalidMylabWorkerType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerValue, message=ExceptionMessages::InvalidMylabWorkerValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateMylabWorkeUniqueValue, message=ExceptionMessages::DuplicateMylabWorkeUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingWorkerPositionParam, message=ExceptionMessages::MissingWorkerPositionParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabWorkerStatusValue, message=ExceptionMessages::MissingLabWorkerStatusValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerStatusArray, message=ExceptionMessages::InvalidLabWorkerStatusArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerStatusType, message=ExceptionMessages::InvalidLabWorkerStatusType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateWorkerPositionUniqueValue, message=ExceptionMessages::DuplicateWorkerPositionUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabWorkerStatusParam, message=ExceptionMessages::MissingLabWorkerStatusParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabWorkerStatusValue, message=ExceptionMessages::MissingLabWorkerStatusValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerStatusArray, message=ExceptionMessages::InvalidLabWorkerStatusArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerStatusType, message=ExceptionMessages::InvalidLabWorkerStatusType),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabWorkerStartServiceParam, message=ExceptionMessages::MissingLabWorkerStartServiceParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabWorkerStartServiceValue, message=ExceptionMessages::MissingLabWorkerStartServiceValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerStartServiceArray, message=ExceptionMessages::InvalidLabWorkerStartServiceArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerStartServiceValidType, message=ExceptionMessages::InvalidLabWorkerStartServiceValidType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerStartServiceType, message=ExceptionMessages::InvalidLabWorkerStartServiceType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicatedLabWorkerValue, message=ExceptionMessages::DuplicatedLabWorkerValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NotAllowedLabWorkerStartService, message=ExceptionMessages::NotAllowedLabWorkerStartService),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerNewWorkerStatus, message=ExceptionMessages::InvalidLabWorkerNewWorkerStatus),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerSetStatus, message=ExceptionMessages::InvalidLabWorkerSetStatus),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="postLabWorkers",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="parameters",type="array",description="Οι παράμετροι που δίνει ο χρήστης" ),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="lab_worker_id",type="integer",description="Ο κωδικός ID της εγγραφής στην οποία πραγματοποιήθηκε εισαγωγή δεδομένων.")
* )
* 
*/

function PostLabWorkers($lab_id, $worker_id, $worker_position, $worker_status, $worker_start_service) { 
    
    global $app,$entityManager;
    
    $LabWorker = new LabWorkers();
    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"]  = $params;
    
    try
    { 
        
//$creation infos===============================================================
        $username =  $app->request->user['uid'];
        $LabWorker->setInsertLabWorkerBy(new \DateTime (date('Y-m-d')));  
        $LabWorker->setInsertBy($username[0]);  
        
//$lab_id=======================================================================
    CRUDUtils::entitySetAssociation($LabWorker, $lab_id, 'Labs', 'lab', 'Lab', $params, 'lab_id');
    
//$worker_id====================================================================
    //CRUDUtils::entitySetAssociation($LabWorker, $worker_id, 'MylabWorkers', 'worker', 'MylabWorker', $params, 'worker_id');
    //FUTURE TODO add to entitySetAssociation association param e.g. associationParam='firstname' 
    if (Validator::Missing('worker_id', $params))
           throw new Exception(ExceptionMessages::MissingMylabWorkerParam." : ".$worker_id, ExceptionCodes::MissingMylabWorkerParam);           
    else if (Validator::IsNull($worker_id))
        throw new Exception(ExceptionMessages::MissingMylabWorkerValue." : ".$worker_id, ExceptionCodes::MissingMylabWorkerValue);           
    else if (Validator::IsArray($worker_id))
        throw new Exception(ExceptionMessages::InvalidMylabWorkerArray." : ".$worker_id, ExceptionCodes::InvalidMylabWorkerArray);           
    else if ( Validator::IsID($worker_id) )
            $retrievedObject = $entityManager->getRepository('MylabWorkers')->find(Validator::ToID($worker_id));
    else if ( Validator::IsValue($worker_id) )
            $retrievedObject = $entityManager->getRepository('MylabWorkers')->findOneBy(array('lastname' => Validator::ToValue($worker_id)));
    else
         throw new Exception(ExceptionMessages::InvalidMylabWorkerType." : ".$worker_id, ExceptionCodes::InvalidMylabWorkerType);
        
        if ( !isset($retrievedObject) )
            throw new Exception(ExceptionMessages::InvalidMylabWorkerValue." : ".$worker_id, ExceptionCodes::InvalidMylabWorkerValue);
        else if (count($retrievedObject)>1)
            throw new Exception(ExceptionMessages::DuplicateMylabWorkeUniqueValue." : ".$worker_id, ExceptionCodes::DuplicateMylabWorkeUniqueValue);
        else
        {
            $method = 'setWorker';
            $LabWorker->$method($retrievedObject);
        }
    
//$worker_position==============================================================
    CRUDUtils::entitySetAssociation($LabWorker, $worker_position, 'WorkerPositions', 'workerPosition', 'WorkerPosition', $params, 'worker_position');
        
//$worker_status================================================================ 
    
    if (Validator::Missing('worker_status', $params))
        throw new Exception(ExceptionMessages::MissingLabWorkerStatusParam." : ".$worker_status, ExceptionCodes::MissingLabWorkerStatusParam);           
    else if (Validator::IsNull($worker_status))
        throw new Exception(ExceptionMessages::MissingLabWorkerStatusValue." : ".$worker_status, ExceptionCodes::MissingLabWorkerStatusValue);
    else if (Validator::IsArray($worker_status))
        throw new Exception(ExceptionMessages::InvalidLabWorkerStatusArray." : ".$worker_status, ExceptionCodes::InvalidLabWorkerStatusArray);                           
    else if ( Validator::IsWorkerState($worker_status) ) {
        $LabWorker->setWorkerStatus(Validator::ToWorkerState($worker_status));
    } else {
         throw new Exception(ExceptionMessages::InvalidLabWorkerStatusType." : ".$worker_status, ExceptionCodes::InvalidLabWorkerStatusType);
    }

//$worker_start_service=========================================================
    if (Validator::Missing('worker_start_service', $params))
        throw new Exception(ExceptionMessages::MissingLabWorkerStartServiceParam." : ".$worker_start_service, ExceptionCodes::MissingLabWorkerStartServiceParam);
    else if (Validator::IsNull($worker_start_service))
         throw new Exception(ExceptionMessages::MissingLabWorkerStartServiceValue." : ".$worker_start_service, ExceptionCodes::MissingLabWorkerStartServiceValue);
    else if (Validator::IsArray($worker_start_service))
         throw new Exception(ExceptionMessages::InvalidLabWorkerStartServiceArray." : ".$worker_start_service, ExceptionCodes::InvalidLabWorkerStartServiceArray);    
    else if (! Validator::IsValidDate($worker_start_service) )
         throw new Exception(ExceptionMessages::InvalidLabWorkerStartServiceValidType." : ".$worker_start_service, ExceptionCodes::InvalidLabWorkerStartServiceValidType); 
    else if (Validator::IsDate($worker_start_service,'Y-m-d'))
         $LabWorker->setWorkerStartService(new \DateTime($worker_start_service));
    else
         throw new Exception(ExceptionMessages::InvalidLabWorkerStartServiceType." : ".$worker_start_service, ExceptionCodes::InvalidLabWorkerStartServiceType);    
    
//user permisions=============================================================== 
     $permissions = UserRoles::getUserPermissions($app->request->user);
     if (!in_array($LabWorker->getLab()->getLabId(),$permissions['permit_labs'])) {
         throw new Exception(ExceptionMessages::NoPermissionToPostLab, ExceptionCodes::NoPermissionToPostLab); 
     };
 
//controls======================================================================   

        //check if post the same active lab worker==============================  
        $checkDuplicate = $entityManager->getRepository('LabWorkers')->findOneBy(array( 'lab'               => $LabWorker->getLab(),
                                                                                        'worker'            => $LabWorker->getWorker(),
                                                                                        'workerPosition'    => $LabWorker->getWorkerPosition(),
                                                                                        'workerStatus'      => $LabWorker->getWorkerStatus()
                                                                                       ));
 
        if (!Validator::isNull($checkDuplicate)){
            throw new Exception(ExceptionMessages::DuplicatedLabWorkerValue ,ExceptionCodes::DuplicatedLabWorkerValue);
        }
     
        //check for max date====================================================
        $findAllDates = $entityManager->getRepository('LabWorkers')->findBy(array( 'lab'               => $LabWorker->getLab(),
                                                                                   'workerPosition'    => $LabWorker->getWorkerPosition()
                                                                                  ));
           if (!Validator::isNull($findAllDates)){
               $date = array();
                foreach($findAllDates as $findAllDate) {
                   $date[] = $findAllDate->getWorkerStartService()->format('Y-m-d'); 
                }
           }
               
        $max_date = max($date);  
        $result['max_date'] = $max_date;
        
        //validate that new date is greater than previous date==================
        $previous_date = strtotime($max_date);
        $new_date = strtotime(Validator::ToDate($worker_start_service, 'Y-m-d'));
        
        if (Validator::isLowerThan($new_date, $previous_date, true)) {   
            throw new Exception(ExceptionMessages::NotAllowedLabWorkerStartService, ExceptionCodes::NotAllowedLabWorkerStartService);  
        }
            
        //check for previous active lab worker  and set status->3===============
        $findActiveWorkers = $entityManager->getRepository('LabWorkers')->findBy(array( 'lab'               => $LabWorker->getLab(),
                                                                                        'workerPosition'    => $LabWorker->getWorkerPosition(),
                                                                                        'workerStatus'      => Validator::ToWorkerState(1)
                                                                                       ));
        $countFindActiveWorkers = count($findActiveWorkers);
       
            if ($countFindActiveWorkers >= 1){
            //AUTO change labworker state
            //               $toFlush = array();
            //                  foreach($findActiveWorkers as $findActiveWorker) {
            //                      $findActiveWorker->setWorkerStatus(3);
            //                      $toFlush[] = $findActiveWorker;
            //                  }
            //                  $entityManager->flush($toFlush);             
                throw new Exception(ExceptionMessages::InvalidLabWorkerNewWorkerStatus,ExceptionCodes::InvalidLabWorkerNewWorkerStatus);              
            }

        //check if lab has submitted value = 0 and restrict insert
        $Labs = $entityManager->find('Labs', Validator::ToID($lab_id));
        if ($Labs->getSubmitted() == false){
            throw new Exception(ExceptionMessages::InvalidLabWorkerSetStatus." : ".$lab_id ,ExceptionCodes::InvalidLabWorkerSetStatus);
        }

//insert to db================================================================== 
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