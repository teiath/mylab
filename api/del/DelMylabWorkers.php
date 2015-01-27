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
*                   method="DELETE",
*                   summary="Διαγραφή Εργαζόμενου",
*                   notes="Διαγραφή Εργαζόμενου",
*                   type="delMylabWorkers",
*                   nickname="DelMylabWorkers",
*
*   @SWG\Parameter( name="worker_id", description="ID Εργαζόμενου [notNull]", required=true, type="integer", paramType="query" ),
*
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToDeleteLab, message=ExceptionMessages::NoPermissionToDeleteLab),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingMylabWorkerIDParam, message=ExceptionMessages::MissingMylabWorkerIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingMylabWorkerIDValue, message=ExceptionMessages::MissingMylabWorkerIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerIDType, message=ExceptionMessages::InvalidMylabWorkerIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerIDArray, message=ExceptionMessages::InvalidMylabWorkerIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::NotFoundDelMyLabWorkerValue, message=ExceptionMessages::NotFoundDelMyLabWorkerValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateDelMyLabWorkerValue, message=ExceptionMessages::DuplicateDelMyLabWorkerValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::ReferencesMyLabWorkerLabWorkers, message=ExceptionMessages::ReferencesMyLabWorkerLabWorkers),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="delMylabWorkers",
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

function DelMylabWorkers($worker_id) {
  
    global $app,$entityManager,$Options;

    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"] = $params;
    
    try {
 
//user permisions===============================================================
    if (!($app->request->user['uid'][0] == $Options["UserAllCRUDPermissions"]))
        throw new Exception(ExceptionMessages::NoPermissionToDeleteData, ExceptionCodes::NoPermissionToDeleteData);
                
//$worker_id====================================================================
        $fMylabWorkerID = CRUDUtils::checkIDParam('worker_id', $params, $worker_id, 'MylabWorkerID');

//controls======================================================================          
        
        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('MylabWorkers')->findBy(array( 'workerId' => $fMylabWorkerID ));
        $count= count($check);

        if ($count == 1)
            $MylabWorkers = $entityManager->find('MylabWorkers', $fMylabWorkerID);
        else if ($count == 0)
            throw new Exception(ExceptionMessages::NotFoundDelMyLabWorkerValue." : ".$fMylabWorkerID ,ExceptionCodes::NotFoundDelMyLabWorkerValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelMyLabWorkerValue." : ".$fMylabWorkerID ,ExceptionCodes::DuplicateDelMyLabWorkerValue);
        
        //check for references =================================================   
        $checkReference = $entityManager->getRepository('LabWorkers')->findOneBy(array( 'worker'  => $fMylabWorkerID ));

        if (count($checkReference) != 0)
            throw new Exception(ExceptionMessages::ReferencesMyLabWorkerLabWorkers. $fMylabWorkerID,ExceptionCodes::ReferencesMyLabWorkerLabWorkers);  
        
//delete from db================================================================
        $entityManager->remove($MylabWorkers);
        $entityManager->flush($MylabWorkers);
           
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