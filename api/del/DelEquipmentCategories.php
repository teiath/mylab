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
*                   method="DELETE",
*                   summary="Διαγραφή Κατηγορίας Εξοπλισμού",
*                   notes="Διαγραφή Κατηγορίας Εξοπλισμού",
*                   type="delEquipmentCategories",
*                   nickname="DelEquipmentCategories",
*   @SWG\Parameter(
*                   name="equipment_category_id",
*                   description="ID Κατηγορίας Εξοπλισμού",
*                   required=true,
*                   type="integer",
*                   paramType="query"
*   ),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToDeleteData, message=ExceptionMessages::NoPermissionToDeleteData),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingEquipmentCategoryIDParam, message=ExceptionMessages::MissingEquipmentCategoryIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingEquipmentCategoryIDValue, message=ExceptionMessages::MissingEquipmentCategoryIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEquipmentCategoryIDType, message=ExceptionMessages::InvalidEquipmentCategoryIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEquipmentCategoryIDArray, message=ExceptionMessages::InvalidEquipmentCategoryIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::NotFoundDelEquipmentCategoryValue, message=ExceptionMessages::NotFoundDelEquipmentCategoryValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateDelEquipmentCategoryValue, message=ExceptionMessages::DuplicateDelEquipmentCategoryValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::ReferencesEquipmentCategoryEquipmentTypes, message=ExceptionMessages::ReferencesEquipmentCategoryEquipmentTypes),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="delEquipmentCategories",
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

function DelEquipmentCategories($equipment_category_id) {
   
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
          
//$equipment_category_id========================================================
        $fEquipmentCategoryID = CRUDUtils::checkIDParam('equipment_category_id', $params, $equipment_category_id, 'EquipmentCategoryID');

//controls======================================================================          
        
        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('EquipmentCategories')->findBy(array( 'equipmentCategoryId' => $fEquipmentCategoryID ));
        $count= count($check);

        if ($count == 1)
            $EquipmentCategories = $entityManager->find('EquipmentCategories', $fEquipmentCategoryID);
        else if ($count == 0)
            throw new Exception(ExceptionMessages::NotFoundDelEquipmentCategoryValue." : ".$fEquipmentCategoryID ,ExceptionCodes::NotFoundDelEquipmentCategoryValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelEquipmentCategoryValue." : ".$fEquipmentCategoryID ,ExceptionCodes::DuplicateDelEquipmentCategoryValue);
        
        //check for references =================================================   
        $checkReference = $entityManager->getRepository('EquipmentTypes')->findOneBy(array( 'equipmentCategory'  => $fEquipmentCategoryID ));

        if (count($checkReference) != 0)
            throw new Exception(ExceptionMessages::ReferencesEquipmentCategoryEquipmentTypes. $fEquipmentCategoryID,ExceptionCodes::ReferencesEquipmentCategoryEquipmentTypes);  
        
//delete from db================================================================
        $entityManager->remove($EquipmentCategories);
        $entityManager->flush($EquipmentCategories);
           
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