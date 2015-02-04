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
*                   method="PUT",
*                   summary="Ενημέρωση Τύπου Εξοπλισμού",
*                   notes="Ενημέρωση Τύπου Εξοπλισμού",
*                   type="putEquipmentTypes",
*                   nickname="PutEquipmentTypes",
*   @SWG\Parameter(
*                   name="equipment_type_id",
*                   description="ID Τύπου Εξοπλισμού",
*                   required=true,
*                   type="string",
*                   paramType="query"
*   ),
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
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToPutData, message=ExceptionMessages::NoPermissionToPutData), 
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingEquipmentTypeIDParam, message=ExceptionMessages::MissingEquipmentTypeIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingEquipmentTypeIDValue, message=ExceptionMessages::MissingEquipmentTypeIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEquipmentTypeIDType, message=ExceptionMessages::InvalidEquipmentTypeIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEquipmentTypeIDArray, message=ExceptionMessages::InvalidEquipmentTypeIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEquipmentTypeValue, message=ExceptionMessages::InvalidEquipmentTypeValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateEquipmentTypeUniqueValue, message=ExceptionMessages::DuplicateEquipmentTypeUniqueValue),
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
* id="putEquipmentTypes",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="parameters",type="array",description="Οι παράμετροι που δίνει ο χρήστης" ),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="equipment_type_id",type="integer",description="Ο κωδικός ID της εγγραφής στην οποία πραγματοποιήθηκε ενημέρωση δεδομένων."),
* )
* 
*/

function PutEquipmentTypes($equipment_type_id, $name, $equipment_category) {

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

//$equipment_type_id============================================================  
        $fEquipmentTypeId = CRUDUtils::checkIDParam('equipment_type_id', $params, $equipment_type_id, 'EquipmentTypeID');
       
//init entity for update row====================================================
        $EquipmentType= CRUDUtils::findIDParam($fEquipmentTypeId, 'EquipmentTypes', 'EquipmentType');
        
//$name=========================================================================
        if ( Validator::IsExists('name') ){
            CRUDUtils::EntitySetParam($EquipmentType, $name, 'EquipmentTypeName', 'name', $params );
        } else if ( Validator::IsNull($EquipmentType->getName()) ){
            throw new Exception(ExceptionMessages::MissingEquipmentTypeNameValue." : ".$name, ExceptionCodes::MissingEquipmentTypeNameValue);
        } 

//$equipment_category========================================================       
        if ( Validator::IsExists('equipment_category') ){
            CRUDUtils::entitySetAssociation($EquipmentType, $equipment_category, 'EquipmentCategories', 'equipmentCategory', 'EquipmentCategory', $params, 'equipment_category');
        } else if ( Validator::IsNull($EquipmentType->getEquipmentCategory() ) ){
            throw new Exception(ExceptionMessages::MissingEquipmentCategoryValue." : ".$equipment_category, ExceptionCodes::MissingEquipmentCategoryValue);
        } 
        
//controls======================================================================   

        //check name duplicate==================================================        
        $qb = $entityManager->createQueryBuilder()
                            ->select('COUNT(eqt.equipmentTypeId) AS fresult')
                            ->from('EquipmentTypes', 'eqt')
                            ->where("eqt.name = :name AND eqt.equipmentTypeId != :equipmentTypeId")
                            ->setParameter('name', $EquipmentType->getName())
                            ->setParameter('equipmentTypeId', $EquipmentType->getEquipmentTypeId())    
                            ->getQuery()
                            ->getSingleResult();
      
        if ( $qb["fresult"] != 0 ) {
             throw new Exception(ExceptionMessages::DuplicatedEquipmentTypeValue ,ExceptionCodes::DuplicatedEquipmentTypeValue);
        }
       
//update to db================================================================== 
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