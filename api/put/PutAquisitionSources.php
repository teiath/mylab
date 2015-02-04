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
* resourcePath="/aquisition_sources",
* description="Λεξικό : Τύποι Πηγών Χρηματοδότησης",
* produces="['application/json']",
* @SWG\Api(
*   path="/aquisition_sources",
*   @SWG\Operation(
*                   method="PUT",
*                   summary="Ενημέρωση Τύπoυ Πηγής Χρηματοδότησης",
*                   notes="Ενημέρωση Τύπου Πηγής Χρηματοδότησης",
*                   type="putAquisitionSources",
*                   nickname="PutAquisitionSources",
*   @SWG\Parameter(
*                   name="aquisition_source_id",
*                   description="ID Πηγής Χρηματοδότησης",
*                   required=true,
*                   type="string",
*                   paramType="query"
*   ),
*   @SWG\Parameter(
*                   name="name",
*                   description="Όνομα Πηγής Χρηματοδότησης",
*                   required=true,
*                   type="string",
*                   paramType="query"
*                   ),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToPutData, message=ExceptionMessages::NoPermissionToPutData),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingAquisitionSourceIDParam, message=ExceptionMessages::MissingAquisitionSourceIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingAquisitionSourceIDValue, message=ExceptionMessages::MissingAquisitionSourceIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidAquisitionSourceIDType, message=ExceptionMessages::InvalidAquisitionSourceIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidAquisitionSourceIDArray, message=ExceptionMessages::InvalidAquisitionSourceIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidAquisitionSourceValue, message=ExceptionMessages::InvalidAquisitionSourceValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateAquisitionSourceUniqueValue, message=ExceptionMessages::DuplicateAquisitionSourceUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingAquisitionSourceNameParam, message=ExceptionMessages::MissingAquisitionSourceNameParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingAquisitionSourceNameValue, message=ExceptionMessages::MissingAquisitionSourceNameValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidAquisitionSourceNameType, message=ExceptionMessages::InvalidAquisitionSourceNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicatedAquisitionSourceValue, message=ExceptionMessages::DuplicatedAquisitionSourceValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="putAquisitionSources",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="parameters",type="array",description="Οι παράμετροι που δίνει ο χρήστης" ),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="aquisition_source_id",type="integer",description="Ο κωδικός ID της εγγραφής στην οποία πραγματοποιήθηκε ενημέρωση δεδομένων."),
* )
* 
*/

function PutAquisitionSources($aquisition_source_id, $name) {

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
        throw new Exception(ExceptionMessages::NoPermissionToPutData, ExceptionCodes::NoPermissionToPutData);

//$aquisition_source_id=========================================================    
        $fAquisitionSourceId = CRUDUtils::checkIDParam('aquisition_source_id', $params, $aquisition_source_id, 'AquisitionSourceID');
       
//init entity for update row====================================================
        $AquisitionSource = CRUDUtils::findIDParam($fAquisitionSourceId, 'AquisitionSources', 'AquisitionSource');
        
//$name=========================================================================
        if ( Validator::IsExists('name') ){
            CRUDUtils::EntitySetParam($AquisitionSource, $name, 'AquisitionSourceName', 'name', $params );
        } else if ( Validator::IsNull($AquisitionSource->getName()) ){
            throw new Exception(ExceptionMessages::MissingAquisitionSourceNameValue." : ".$name, ExceptionCodes::MissingAquisitionSourceNameValue);
        } 
        
//controls======================================================================   

        //check name duplicate==================================================        
        $qb = $entityManager->createQueryBuilder()
                            ->select('COUNT(aqs.aquisitionSourceId) AS fresult')
                            ->from('AquisitionSources', 'aqs')
                            ->where("aqs.name = :name AND aqs.aquisitionSourceId != :aquisitionSourceId")
                            ->setParameter('name', $AquisitionSource->getName())
                            ->setParameter('aquisitionSourceId', $AquisitionSource->getAquisitionSourceId())    
                            ->getQuery()
                            ->getSingleResult();
      
        if ( $qb["fresult"] != 0 ) {
             throw new Exception(ExceptionMessages::DuplicatedAquisitionSourceValue ,ExceptionCodes::DuplicatedAquisitionSourceValue);
        }
       
//update to db================================================================== 
        $entityManager->persist($AquisitionSource);
        $entityManager->flush($AquisitionSource);

        $result["aquisition_source_id"] = $AquisitionSource->getAquisitionSourceId();  
           
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