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
* resourcePath="/relation_types",
* description="Λεξικό : Τύποι Συσχέτισης Διατάξεων - Μονάδων",
* produces="['application/json']",
* @SWG\Api(
*   path="/relation_types",
*   @SWG\Operation(
*                   method="POST",
*                   summary="Εισαγωγή Τύπου Συσχέτισης Διατάξεων Η/Υ - Μονάδων",
*                   notes="Εισαγωγή Τύπου Συσχέτισης Διατάξεων Η/Υ - Μονάδων",
*                   type="postRelationTypes",
*                   nickname="PostRelationTypes",
*   @SWG\Parameter(
*                   name="name",
*                   description="Όνομα Τύπου Συσχέτισης Διατάξεων Η/Υ - Μονάδων",
*                   required=true,
*                   type="string",
*                   paramType="query"
*                   ),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToPostData, message=ExceptionMessages::NoPermissionToPostData),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingRelationTypeNameParam, message=ExceptionMessages::MissingRelationTypeNameParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingRelationTypeNameValue, message=ExceptionMessages::MissingRelationTypeNameValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidRelationTypeNameType, message=ExceptionMessages::InvalidRelationTypeNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicatedRelationTypeValue, message=ExceptionMessages::DuplicatedRelationTypeValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="postRelationTypes",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="parameters",type="array",description="Οι παράμετροι που δίνει ο χρήστης" ),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="relation_type_id",type="integer",description="Ο κωδικός ID της εγγραφής στην οποία πραγματοποιήθηκε εισαγωγή δεδομένων.")
* )
* 
*/

function PostRelationTypes($name) {

    global $app,$entityManager,$Options;

    $RelationType = new RelationTypes();
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
     CRUDUtils::EntitySetParam($RelationType, $name, 'RelationTypeName', 'name', $params, true, false);
 
//controls======================================================================   

        //check for duplicate ==================================================   
        $checkDuplicate = $entityManager->getRepository('RelationTypes')->findOneBy(array( 'name' => $RelationType->getName() ));
        
        if (count($checkDuplicate) != 0)
            throw new Exception(ExceptionMessages::DuplicatedRelationTypeValue,ExceptionCodes::DuplicatedRelationTypeValue);  
        
//insert to db================================================================== 
        $entityManager->persist($RelationType);
        $entityManager->flush($RelationType);

        $result["relation_type_id"] = $RelationType->getRelationTypeId();
           
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