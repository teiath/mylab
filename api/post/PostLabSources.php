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
*                   method="POST",
*                   summary="Εισαγωγή Πρωτογενής Πηγής Δεδομένων Διάταξης H/Y",
*                   notes="Εισαγωγή Πρωτογενής Πηγής Δεδομένων Διάταξης H/Y",
*                   type="postLabSources",
*                   nickname="PostLabSources",
*   @SWG\Parameter(
*                   name="name",
*                   description="Όνομα Πρωτογενής Πηγής Δεδομένων Διάταξης H/Y",
*                   required=true,
*                   type="string",
*                   paramType="query"
*                   ),
*   @SWG\Parameter(
*                   name="infos",
*                   description="Πληροφορίες για την Πρωτογενής Πηγή Δεδομένων Διάταξης H/Y",
*                   required=true,
*                   type="string",
*                   paramType="query"
*                   ),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToPostData, message=ExceptionMessages::NoPermissionToPostData),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabSourceNameParam, message=ExceptionMessages::MissingLabSourceNameParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabSourceNameValue, message=ExceptionMessages::MissingLabSourceNameValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabSourceNameType, message=ExceptionMessages::InvalidLabSourceNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabSourceInfosParam, message=ExceptionMessages::MissingLabSourceInfosParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabSourceInfosValue, message=ExceptionMessages::MissingLabSourceInfosValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabSourceInfosType, message=ExceptionMessages::InvalidLabSourceInfosType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicatedLabSourceValue, message=ExceptionMessages::DuplicatedLabSourceValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="postLabSources",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="parameters",type="array",description="Οι παράμετροι που δίνει ο χρήστης" ),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="lab_source_id",type="integer",description="Ο κωδικός ID της εγγραφής στην οποία πραγματοποιήθηκε εισαγωγή δεδομένων.")
* )
* 
*/

function PostLabSources($name, $infos) {

    global $app,$entityManager,$Options;

    $LabSource = new LabSources();
    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"]  = $params;

    try {

    //user permisions===========================================================
    if (!($app->request->user['uid'][0] == $Options["UserAllCRUDPermissions"]))
        throw new Exception(ExceptionMessages::NoPermissionToPostData, ExceptionCodes::NoPermissionToPostData);
        
    //$name=====================================================================
     CRUDUtils::EntitySetParam($LabSource, $name, 'LabSourceName', 'name', $params, true, false);
     
    //$infos====================================================================
     CRUDUtils::EntitySetParam($LabSource, $infos, 'LabSourceInfos', 'infos', $params, true, false);

//controls======================================================================   

        //check for duplicate ==================================================   
        $checkDuplicate = $entityManager->getRepository('LabSources')->findOneBy(array( 'name' => $LabSource->getName() ));
        
        if (count($checkDuplicate) != 0)
            throw new Exception(ExceptionMessages::DuplicatedLabSourceValue,ExceptionCodes::DuplicatedLabSourceValue);  
        
//insert to db================================================================== 
        $entityManager->persist($LabSource);
        $entityManager->flush($LabSource);

        $result["lab_source_id"] = $LabSource->getLabSourceId();
           
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