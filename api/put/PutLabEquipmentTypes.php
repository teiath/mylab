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
*                   method="PUT",
*                   summary="Ενημέρωση Διάταξης Η/Υ με Εξοπλισμό",
*                   notes="Ενημέρωση Διάταξης Η/Υ με Εξοπλισμό",
*                   type="putLabEquipmentTypes",
*                   nickname="PutLabEquipmentTypes",
* 
*   @SWG\Parameter( name="lab_id", description="ID Διάταξης Η/Υ [notNull]", required=true, type="integer", paramType="query" ),
*   @SWG\Parameter( name="equipment_type_id", description="ID Εξοπλισμού [notNull]", required=true, type="integer", paramType="query" ),
*   @SWG\Parameter( name="items", description="Πλήθος Εξοπλισμού [notNull]", required=true, type="integer", paramType="query" ),
* 
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToPutLab, message=ExceptionMessages::NoPermissionToPutLab),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabIDParam, message=ExceptionMessages::MissingLabIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabIDValue, message=ExceptionMessages::MissingLabIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabIDType, message=ExceptionMessages::InvalidLabIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabIDArray, message=ExceptionMessages::InvalidLabIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingEquipmentTypeIDParam, message=ExceptionMessages::MissingEquipmentTypeIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingEquipmentTypeIDValue, message=ExceptionMessages::MissingEquipmentTypeIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEquipmentTypeIDType, message=ExceptionMessages::InvalidEquipmentTypeIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEquipmentTypeIDArray, message=ExceptionMessages::InvalidEquipmentTypeIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabEquipmentTypeValue, message=ExceptionMessages::InvalidLabEquipmentTypeValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateLabEquipmentTypeUniqueValue, message=ExceptionMessages::DuplicateLabEquipmentTypeUniqueValue),
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
* id="putLabEquipmentTypes",
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

function PutLabEquipmentTypes($lab_id, $equipment_type_id, $items) {
    
    global $app,$entityManager;

    $result = array();
    
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"] = $params;
    
    try
    {
        
//$lab_id=======================================================================       
        $fLabID = CRUDUtils::checkIDParam('lab_id', $params, $lab_id, 'LabID');

//$equipment_type_id============================================================
        $fEquipmentTypeID = CRUDUtils::checkIDParam('equipment_type_id', $params, $equipment_type_id, 'EquipmentTypeID');
  
//init entity for update row====================================================         
        $LabEquipmentTypes = CRUDUtils::findIDParam(array("lab" => $fLabID, "equipmentType" => $fEquipmentTypeID), 'LabEquipmentTypes', 'LabEquipmentType');

//$items========================================================================     
        if (!Validator::isNull($LabEquipmentTypes)){  

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

        } else if ( Validator::IsNull($LabEquipmentTypes->getItems()) ){
                throw new Exception(ExceptionMessages::MissingLabEquipmentTypeValue." : ".$items, ExceptionCodes::MissingLabEquipmentTypeValue);
        }      

//user permisions===============================================================
         $permissions = CheckUserPermissions::getUserPermissions($app->request->user);
         
         if (!in_array($LabEquipmentTypes->getLab()->getLabId(), $permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToPutLab, ExceptionCodes::NoPermissionToPutLab); 
         };  

//controls======================================================================  
        
        //check duplicates and unique row=======================================        
        $checkDuplicate= $entityManager->getRepository('LabEquipmentTypes')->findOneBy(array( 'lab'             => $LabEquipmentTypes->getLab(),
                                                                                               'equipmentType'  => $LabEquipmentTypes->getEquipmentType(),
                                                                                               'items'          => $LabEquipmentTypes->getItems(),
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