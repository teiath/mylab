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
* resourcePath="/lab_equipment_types",
* description="Διατάξεις Η/Υ με Εξοπλισμό",
* produces="['application/json']",
* @SWG\Api(
*   path="/lab_equipment_types",
*   @SWG\Operation(
*                   method="POST",
*                   summary="Εισαγωγή Διάταξης Η/Υ με Εξοπλισμό",
*                   notes="Εισαγωγή Διάταξης Η/Υ με Εξοπλισμό",
*                   type="postLabEquipmentTypes",
*                   nickname="PostLabEquipmentTypes",
* 
*   @SWG\Parameter( name="lab_id", description="ID Διάταξης Η/Υ [notNull]", required=true, type="integer", paramType="query" ),
*   @SWG\Parameter( name="equipment_type", description="Όνομα ή ID Εξοπλισμού [notNull]", required=true, type="mixed(string|integer)", paramType="query" ),
*   @SWG\Parameter( name="items", description="Πλήθος Εξοπλισμού [notNull]", required=true, type="integer", paramType="query" ),
*   
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToPostLab, message=ExceptionMessages::NoPermissionToPostLab),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabParam, message=ExceptionMessages::MissingLabParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabValue, message=ExceptionMessages::MissingLabValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabValue, message=ExceptionMessages::InvalidLabValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabType, message=ExceptionMessages::InvalidLabType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateLabUniqueValue, message=ExceptionMessages::DuplicateLabUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingEquipmentTypeParam, message=ExceptionMessages::MissingEquipmentTypeParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingEquipmentTypeValue, message=ExceptionMessages::MissingEquipmentTypeValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEquipmentTypeValue, message=ExceptionMessages::InvalidEquipmentTypeValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEquipmentTypeType, message=ExceptionMessages::InvalidEquipmentTypeType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateEquipmentTypeUniqueValue, message=ExceptionMessages::DuplicateEquipmentTypeUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabEquipmentTypeItemsParam, message=ExceptionMessages::MissingLabEquipmentTypeItemsParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabEquipmentTypeItemsValue, message=ExceptionMessages::MissingLabEquipmentTypeItemsValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabEquipmentTypeItemsArray, message=ExceptionMessages::InvalidLabEquipmentTypeItemsArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabEquipmentTypeItemsValidType, message=ExceptionMessages::InvalidLabEquipmentTypeItemsValidType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabEquipmentTypeItemsType, message=ExceptionMessages::InvalidLabEquipmentTypeItemsType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicatedLabEquipmentTypeValue, message=ExceptionMessages::DuplicatedLabEquipmentTypeValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="postLabEquipmentTypes",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="parameters",type="array",description="Οι παράμετροι που δίνει ο χρήστης" ),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="lab_id",type="integer",description="Ο κωδικός ID της Διάταξης Η/Υ στην οποία πραγματοποιήθηκε εισαγωγή δεδομένων."),
* @SWG\Property(name="equipment_type_id",type="integer",description="Ο κωδικός ID του Τύπου Εξοπλισμού στην οποία πραγματοποιήθηκε εισαγωγή δεδομένων.")
* )
* 
*/

function PostLabEquipmentTypes($lab_id, $equipment_type, $items) {
    
    global $app,$entityManager;

    $LabEquipmentTypes = new LabEquipmentTypes();
    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"]  = $params;
    
    try
    {
      
//$lab_id=======================================================================       
        CRUDUtils::entitySetAssociation($LabEquipmentTypes, $lab_id, 'Labs', 'lab', 'Lab', $params, 'lab_id');
        
//$equipment_type===============================================================       
        CRUDUtils::entitySetAssociation($LabEquipmentTypes, $equipment_type, 'EquipmentTypes', 'equipmentType', 'EquipmentType', $params, 'equipment_type');
    
//$items========================================================================      
        if (Validator::Missing('items', $params))
            throw new Exception(ExceptionMessages::MissingLabEquipmentTypeItemsParam." : ".$items, ExceptionCodes::MissingLabEquipmentTypeItemsParam);          
        else if (Validator::IsNull($items))
            throw new Exception(ExceptionMessages::MissingLabEquipmentTypeItemsValue." : ".$items, ExceptionCodes::MissingLabEquipmentTypeItemsValue);                        
        else if (Validator::IsArray($items))
            throw new Exception(ExceptionMessages::InvalidLabEquipmentTypeItemsArray." : ".$items, ExceptionCodes::InvalidLabEquipmentTypeItemsArray);
        else if (Validator::ToNumeric($items) <=0 || Validator::ToNumeric($items) > 10000 ) 
            throw new Exception(ExceptionMessages::InvalidLabEquipmentTypeItemsValidType." : ".$items, ExceptionCodes::InvalidLabEquipmentTypeItemsValidType);
        else if (Validator::IsNumeric($items))
            $LabEquipmentTypes->setItems(Validator::ToNumeric($items));
        else
            throw new Exception(ExceptionMessages::InvalidLabEquipmentTypeItemsType." : ".$items, ExceptionCodes::InvalidLabEquipmentTypeItemsType);

//user permisions===============================================================
         $permissions = CheckUserPermissions::getUserPermissions($app->request->user);
         
         if (!in_array($LabEquipmentTypes->getLab()->getLabId(), $permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToPostLab, ExceptionCodes::NoPermissionToPostLab); 
         };  

//controls======================================================================  

        //check duplicates======================================================        
        $checkDuplicate = $entityManager->getRepository('LabEquipmentTypes')->findOneBy(array(  'lab'           => $LabEquipmentTypes->getLab(),
                                                                                                'equipmentType' => $LabEquipmentTypes->getEquipmentType()
                                                                                              ));

        if (!Validator::isNull($checkDuplicate)){
            throw new Exception(ExceptionMessages::DuplicatedLabEquipmentTypeValue ,ExceptionCodes::DuplicatedLabEquipmentTypeValue);
        } 
       
 //insert to db=================================================================       
        $entityManager->persist($LabEquipmentTypes);
        $entityManager->flush($LabEquipmentTypes);

        $result["lab_id"] = $LabEquipmentTypes->getLab()->getLabId();
        $result["equipment_type_id"] = $LabEquipmentTypes->getEquipmentType()->getEquipmentTypeId();
           
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