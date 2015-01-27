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
*                   method="DELETE",
*                   summary="Διαγραφή Υπεύθυνου Διάταξης Η/Υ",
*                   notes="Διαγραφή Υπεύθυνου Διάταξης Η/Υ",
*                   type="delLabWorkers",
*                   nickname="DelLabWorkers",
*
*   @SWG\Parameter( name="lab_id", description="ID Διάταξης Η/Υ [notNull]", required=true, type="integer", paramType="query" ), 
*   @SWG\Parameter( name="lab_worker_id", description="ID Υπεύθυνου Διάταξης Η/Υ [notNull]", required=true, type="integer", paramType="query" ),
*
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToDeleteLab, message=ExceptionMessages::NoPermissionToDeleteLab),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabIDParam, message=ExceptionMessages::MissingLabIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabIDValue, message=ExceptionMessages::MissingLabIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabIDType, message=ExceptionMessages::InvalidLabIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabIDArray, message=ExceptionMessages::InvalidLabIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabWorkerIDParam, message=ExceptionMessages::MissingLabWorkerIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabWorkerIDValue, message=ExceptionMessages::MissingLabWorkerIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerIDType, message=ExceptionMessages::InvalidLabWorkerIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerIDArray, message=ExceptionMessages::InvalidLabWorkerIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::NotFoundDelLabWorkerValue, message=ExceptionMessages::NotFoundDelLabWorkerValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateDelLabWorkerValue, message=ExceptionMessages::DuplicateDelLabWorkerValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerActiveStatus, message=ExceptionMessages::InvalidLabWorkerActiveStatus),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionDelLabWorkerValue, message=ExceptionMessages::NoPermissionDelLabWorkerValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="delLabWorkers",
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

function DelLabWorkers($lab_id, $lab_worker_id) {

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

//$lab_worker_id================================================================
        $fLabWorkerID = CRUDUtils::checkIDParam('lab_worker_id', $params, $lab_worker_id, 'LabWorkerID');
             
//user permisions===============================================================
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array($fLabID, $permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToDeleteLab, ExceptionCodes::NoPermissionToDeleteLab); 
         };  

//controls======================================================================  

        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('LabWorkers')->findBy(array( 'lab'          => $fLabID,
                                                                            'labWorkerId'  => $fLabWorkerID,
                                                                           ));

        $countLabWorkers = count($check);
        
        if ($countLabWorkers == 1)
            //set entity for delete row
            $LabWorkers = $entityManager->find('LabWorkers', $fLabWorkerID);
        else if ($countLabWorkers == 0)
            throw new Exception(ExceptionMessages::NotFoundDelLabWorkerValue." : ".$fLabID." - ".$fLabWorkerID,ExceptionCodes::NotFoundDelLabWorkerValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelLabWorkerValue." : ".$fLabID." - ".$fLabWorkerID,ExceptionCodes::DuplicateDelLabWorkerValue);
      
        //check if lab has more than one active worker and restrict deletion   
        $findActiveWorkers = $entityManager->getRepository('LabWorkers')->findBy(array( 'lab'           => $fLabID,
                                                                                        'workerStatus'  => Validator::ToWorkerState(1)
                                                                                       ));
        
        $countActiveLabWorkers = count($findActiveWorkers);
        
        if ($countActiveLabWorkers > 1){
              throw new Exception(ExceptionMessages::InvalidLabWorkerActiveStatus." : ".$fLabID ,ExceptionCodes::InvalidLabWorkerActiveStatus);
        }
        
        if ($LabWorkers->getWorkerStatus() != 1){
            throw new Exception(ExceptionMessages::NoPermissionDelLabWorkerValue." : ".$fLabID ,ExceptionCodes::NoPermissionDelLabWorkerValue);
        }
        
//delete from db================================================================

        $entityManager->remove($LabWorkers);
        $entityManager->flush($LabWorkers);
           
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