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
* resourcePath="/equipment_types",
* description="Λεξικό : Τύποι Εξοπλισμού",
* produces="['application/json']",
* @SWG\Api(
*   path="/equipment_types",
*   @SWG\Operation(
*                   method="POST",
*                   summary="Εισαγωγή Τύπου Εξοπλισμού",
*                   notes="Εισαγωγή Τύπου Εξοπλισμού",
*                   type="postEquipmentTypes",
*                   nickname="PostEquipmentTypes",
*   @SWG\Parameter(
*                   name="name",
*                   description="Όνομα Τύπου Εξοπλισμού",
*                   required=true,
*                   type="string",
*                   paramType="query"
*                   ),
*   @SWG\Parameter(
*                   name="equipment_category",
*                   description="Όνομα Κατηγορίας Εξοπλισμού",
*                   required=true,
*                   type="string",
*                   paramType="query"
*                   ),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToPostData, message=ExceptionMessages::NoPermissionToPostData),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingEquipmentTypeNameParam, message=ExceptionMessages::MissingEquipmentTypeNameParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingEquipmentTypeNameValue, message=ExceptionMessages::MissingEquipmentTypeNameValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEquipmentTypeNameType, message=ExceptionMessages::InvalidEquipmentTypeNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingEquipmentCategoryParam, message=ExceptionMessages::MissingEquipmentCategoryParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingEquipmentCategoryValue, message=ExceptionMessages::MissingEquipmentCategoryValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEquipmentCategoryValue, message=ExceptionMessages::InvalidEquipmentCategoryValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEquipmentCategoryType, message=ExceptionMessages::InvalidEquipmentCategoryType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateEquipmentCategoryUniqueValue, message=ExceptionMessages::DuplicateEquipmentCategoryUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicatedEquipmentTypeValue, message=ExceptionMessages::DuplicatedEquipmentTypeValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="postEquipmentTypes",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="parameters",type="array",description="Οι παράμετροι που δίνει ο χρήστης" ),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="equipment_type_id",type="integer",description="Ο κωδικός ID της εγγραφής στην οποία πραγματοποιήθηκε εισαγωγή δεδομένων.")
* )
* 
*/

function PostEquipmentTypes($name, $equipment_category) {

    global $app,$entityManager,$Options;

    $EquipmentType = new EquipmentTypes();
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
     CRUDUtils::EntitySetParam($EquipmentType, $name, 'EquipmentTypeName', 'name', $params, true, false);
     
    //$equipment_type===========================================================      
    CRUDUtils::entitySetAssociation($EquipmentType, $equipment_category, 'EquipmentCategories', 'equipmentCategory', 'EquipmentCategory', $params, 'equipment_category');
        
//controls======================================================================   

        //check for duplicate ==================================================   
        $checkDuplicate = $entityManager->getRepository('EquipmentTypes')->findOneBy(array( 'name'  => $EquipmentType->getName() ));

        if (count($checkDuplicate) != 0)
            throw new Exception(ExceptionMessages::DuplicatedEquipmentTypeValue,ExceptionCodes::DuplicatedEquipmentTypeValue);  
        
//insert to db================================================================== 
        $entityManager->persist($EquipmentType);
        $entityManager->flush($EquipmentType);

        $result["equipment_type_id"] = $EquipmentType->getEquipmentTypeId();
           
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