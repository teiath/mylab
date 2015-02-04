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
* resourcePath="/lab_sources",
* description="Λεξικό : Πρωτογενής Πηγές Δεδομένων Διατάξεων",
* produces="['application/json']",
* @SWG\Api(
*   path="/lab_sources",
*   @SWG\Operation(
*                   method="DELETE",
*                   summary="Διαγραφή Πρωτογενής Πηγής Δεδομένων Διάταξης H/Y",
*                   notes="Διαγραφή Πρωτογενής Πηγής Δεδομένων Διάταξης H/Y",
*                   type="delLabSources",
*                   nickname="DelLabSources",
*   @SWG\Parameter(
*                   name="lab_source_id",
*                   description="ID Πρωτογενής Πηγής Δεδομένων Διάταξης H/Y",
*                   required=true,
*                   type="integer",
*                   paramType="query"
*   ),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToDeleteData, message=ExceptionMessages::NoPermissionToDeleteData),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabSourceIDParam, message=ExceptionMessages::MissingLabSourceIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabSourceIDValue, message=ExceptionMessages::MissingLabSourceIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabSourceIDType, message=ExceptionMessages::InvalidLabSourceIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabSourceIDArray, message=ExceptionMessages::InvalidLabSourceIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::NotFoundDelLabSourceValue, message=ExceptionMessages::NotFoundDelLabSourceValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateDelLabSourceValue, message=ExceptionMessages::DuplicateDelLabSourceValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::ReferencesLabSourceLabs, message=ExceptionMessages::ReferencesLabSourceLabs),
*   @SWG\ResponseMessage(code=ExceptionCodes::ReferencesLabSourceMyLabWorkers, message=ExceptionMessages::ReferencesLabSourceMyLabWorkers),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="delLabSources",
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

function DelLabSources($lab_source_id) {
  
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
          
//$lab_source_id================================================================
        $fLabSourceID = CRUDUtils::checkIDParam('lab_source_id', $params, $lab_source_id, 'LabSourceID');

//controls======================================================================          
        
        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('LabSources')->findBy(array( 'labSourceId' => $fLabSourceID ));
        $count= count($check);

        if ($count == 1)
            $LabSources = $entityManager->find('LabSources', $fLabSourceID);
        else if ($count == 0)
            throw new Exception(ExceptionMessages::NotFoundDelLabSourceValue." : ".$fLabSourceID ,ExceptionCodes::NotFoundDelLabSourceValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelLabSourceValue." : ".$fLabSourceID ,ExceptionCodes::DuplicateDelLabSourceValue);
        
        //check for references =================================================   
        $checkReferenceLab = $entityManager->getRepository('Labs')->findOneBy(array( 'labSource'  => $fLabSourceID ));

        if (count($checkReferenceLab) != 0)
            throw new Exception(ExceptionMessages::ReferencesLabSourceLabs. $fLabSourceID,ExceptionCodes::ReferencesLabSourceLabs);  
        
        $checkReferenceMyLabWorker = $entityManager->getRepository('MylabWorkers')->findOneBy(array( 'labSource'  => $fLabSourceID ));

        if (count($checkReferenceMyLabWorker) != 0)
            throw new Exception(ExceptionMessages::ReferencesLabSourceMyLabWorkers. $fLabSourceID,ExceptionCodes::ReferencesLabSourceMyLabWorkers);  
        
//delete from db================================================================
        $entityManager->remove($LabSources);
        $entityManager->flush($LabSources);
           
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