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
* resourcePath="/equipment_categories",
* description="Λεξικό : Κατηγορίες Εξοπλισμού",
* produces="['application/json']",
* @SWG\Api(
*   path="/equipment_categories",
*   @SWG\Operation(
*                   method="PUT",
*                   summary="Ενημέρωση Κατηγορίας Εξοπλισμού",
*                   notes="Ενημέρωση Κατηγορίας Εξοπλισμού",
*                   type="putEquipmentCategories",
*                   nickname="PutEquipmentCategories",
*   @SWG\Parameter(
*                   name="equipment_category_id",
*                   description="ID Κατηγορίας Εξοπλισμού",
*                   required=true,
*                   type="string",
*                   paramType="query"
*   ),
*   @SWG\Parameter(
*                   name="name",
*                   description="Όνομα Κατηγορίας Εξοπλισμού",
*                   required=true,
*                   type="string",
*                   paramType="query"
*                   ),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToPutData, message=ExceptionMessages::NoPermissionToPutData), 
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingEquipmentCategoryIDParam, message=ExceptionMessages::MissingEquipmentCategoryIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingEquipmentCategoryIDValue, message=ExceptionMessages::MissingEquipmentCategoryIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEquipmentCategoryIDType, message=ExceptionMessages::InvalidEquipmentCategoryIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEquipmentCategoryIDArray, message=ExceptionMessages::InvalidEquipmentCategoryIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEquipmentCategoryValue, message=ExceptionMessages::InvalidEquipmentCategoryValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateEquipmentCategoryUniqueValue, message=ExceptionMessages::DuplicateEquipmentCategoryUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingEquipmentCategoryNameParam, message=ExceptionMessages::MissingEquipmentCategoryNameParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingEquipmentCategoryNameValue, message=ExceptionMessages::MissingEquipmentCategoryNameValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEquipmentCategoryNameType, message=ExceptionMessages::InvalidEquipmentCategoryNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicatedEquipmentCategoryValue, message=ExceptionMessages::DuplicatedEquipmentCategoryValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="putEquipmentCategories",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="parameters",type="array",description="Οι παράμετροι που δίνει ο χρήστης" ),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="equipment_category_id",type="integer",description="Ο κωδικός ID της εγγραφής στην οποία πραγματοποιήθηκε ενημέρωση δεδομένων."),
* )
* 
*/

function PutEquipmentCategories($equipment_category_id, $name) {

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

//$equipment_category_id========================================================   
        $fEquipmentCategoryId = CRUDUtils::checkIDParam('equipment_category_id', $params, $equipment_category_id, 'EquipmentCategoryID');
       
//init entity for update row====================================================
        $EquipmentCategory = CRUDUtils::findIDParam($fEquipmentCategoryId, 'EquipmentCategories', 'EquipmentCategory');
        
//$name=========================================================================
        if ( Validator::IsExists('name') ){
            CRUDUtils::EntitySetParam($EquipmentCategory, $name, 'EquipmentCategoryName', 'name', $params );
        } else if ( Validator::IsNull($EquipmentCategory->getName()) ){
            throw new Exception(ExceptionMessages::MissingEquipmentCategoryNameValue." : ".$name, ExceptionCodes::MissingEquipmentCategoryNameValue);
        } 
        
//controls======================================================================   

        //check name duplicate==================================================        
        $qb = $entityManager->createQueryBuilder()
                            ->select('COUNT(eqc.equipmentCategoryId) AS fresult')
                            ->from('EquipmentCategories', 'eqc')
                            ->where("eqc.name = :name AND eqc.equipmentCategoryId != :equipmentCategoryId")
                            ->setParameter('name', $EquipmentCategory->getName())
                            ->setParameter('equipmentCategoryId', $EquipmentCategory->getEquipmentCategoryId())    
                            ->getQuery()
                            ->getSingleResult();
      
        if ( $qb["fresult"] != 0 ) {
             throw new Exception(ExceptionMessages::DuplicatedEquipmentCategoryValue ,ExceptionCodes::DuplicatedEquipmentCategoryValue);
        }
       
//update to db================================================================== 
        $entityManager->persist($EquipmentCategory);
        $entityManager->flush($EquipmentCategory);

        $result["equipment_category_id"] = $EquipmentCategory->getEquipmentCategoryId();  
           
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