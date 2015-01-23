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
*                   method="DELETE",
*                   summary="Διαγραφή Τύπου Εξοπλισμού",
*                   notes="Διαγραφή Τύπου Εξοπλισμού",
*                   type="delEquipmentTypes",
*                   nickname="DelEquipmentTypes",
*   @SWG\Parameter(
*                   name="equipment_type_id",
*                   description="ID Τύπου Εξοπλισμού",
*                   required=true,
*                   type="integer",
*                   paramType="query"
*   ),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToDeleteData, message=ExceptionMessages::NoPermissionToDeleteData),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingEquipmentTypeIDParam, message=ExceptionMessages::MissingEquipmentTypeIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingEquipmentTypeIDValue, message=ExceptionMessages::MissingEquipmentTypeIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEquipmentTypeIDType, message=ExceptionMessages::InvalidEquipmentTypeIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEquipmentTypeIDArray, message=ExceptionMessages::InvalidEquipmentTypeIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::NotFoundDelEquipmentTypeValue, message=ExceptionMessages::NotFoundDelEquipmentTypeValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateDelEquipmentTypeValue, message=ExceptionMessages::DuplicateDelEquipmentTypeValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::ReferencesEquipmentTypeLabEquipmentTypes, message=ExceptionMessages::ReferencesEquipmentTypeLabEquipmentTypes),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="delEquipmentTypes",
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

function DelEquipmentTypes($equipment_type_id) {
  
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
           
//$equipment_type_id============================================================
        $fEquipmentTypeID = CRUDUtils::checkIDParam('equipment_type_id', $params, $equipment_type_id, 'EquipmentTypeID');

//controls======================================================================          
        
        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('EquipmentTypes')->findBy(array( 'equipmentTypeId' => $fEquipmentTypeID ));
        $count= count($check);

        if ($count == 1)
            $EquipmentTypes = $entityManager->find('EquipmentTypes', $fEquipmentTypeID);
        else if ($count == 0)
            throw new Exception(ExceptionMessages::NotFoundDelEquipmentTypeValue." : ".$fEquipmentTypeID ,ExceptionCodes::NotFoundDelEquipmentCategoryValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelEquipmentTypeValue." : ".$fEquipmentTypeID ,ExceptionCodes::DuplicateDelEquipmentTypeValue);
        
        //check for references =================================================   
        $checkReference = $entityManager->getRepository('LabEquipmentTypes')->findOneBy(array( 'equipmentType'  => $fEquipmentTypeID ));

        if (count($checkReference) != 0)
            throw new Exception(ExceptionMessages::ReferencesEquipmentTypeLabEquipmentTypes. $fEquipmentTypeID,ExceptionCodes::ReferencesEquipmentTypeLabEquipmentTypes);  
        
//delete from db================================================================
        $entityManager->remove($EquipmentTypes);
        $entityManager->flush($EquipmentTypes);
           
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