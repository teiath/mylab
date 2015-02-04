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
*                   method="DELETE",
*                   summary="Διαγραφή Διάταξης Η/Υ με Εξοπλισμό",
*                   notes="Διαγραφή Διάταξης Η/Υ με Εξοπλισμό",
*                   type="delLabEquipmentTypes",
*                   nickname="DelLabEquipmentTypes",
*
*   @SWG\Parameter( name="lab_id", description="ID Διάταξης Η/Υ [notNull]", required=true, type="integer", paramType="query" ), 
*   @SWG\Parameter( name="equipment_type_id", description="ID Εξοπλισμού [notNull]", required=true, type="integer", paramType="query" ),
*
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToDeleteLab, message=ExceptionMessages::NoPermissionToDeleteLab),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabIDParam, message=ExceptionMessages::MissingLabIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabIDValue, message=ExceptionMessages::MissingLabIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabIDType, message=ExceptionMessages::InvalidLabIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabIDArray, message=ExceptionMessages::InvalidLabIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingEquipmentTypeIDParam, message=ExceptionMessages::MissingEquipmentTypeIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingEquipmentTypeIDValue, message=ExceptionMessages::MissingEquipmentTypeIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEquipmentTypeIDType, message=ExceptionMessages::InvalidEquipmentTypeIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEquipmentTypeIDArray, message=ExceptionMessages::InvalidEquipmentTypeIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::NotFoundDelLabEquipmentTypeValue, message=ExceptionMessages::NotFoundDelLabEquipmentTypeValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateDelLabEquipmentTypeValue, message=ExceptionMessages::DuplicateDelLabEquipmentTypeValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="delLabEquipmentTypes",
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

function DelLabEquipmentTypes($lab_id,$equipment_type_id) {

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
        $fEquipmentTypeID = CRUDUtils::checkIDParam('equipment_type_id', $params, $equipment_type_id, 'LabEquipmentTypeID');
             
//user permisions===============================================================
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array($fLabID, $permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToDeleteLab, ExceptionCodes::NoPermissionToDeleteLab); 
         };  

//controls======================================================================  

        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('LabEquipmentTypes')->findBy(array( 'lab'            => $fLabID,
                                                                                   'equipmentType'  => $fEquipmentTypeID,
                                                                                  ));

        $countLabEquipmentTypes = count($check);
        
        if ($countLabEquipmentTypes == 1)
            //set entity for delete row
            $LabEquipmentTypes = $entityManager->find('LabEquipmentTypes', array("lab"           =>  $fLabID, 
                                                                                 "equipmentType" =>  $fEquipmentTypeID)
                                                                                );
        else if ($countLabEquipmentTypes == 0)
            throw new Exception(ExceptionMessages::NotFoundDelLabEquipmentTypeValue." : ".$fLabID." - ".$fEquipmentTypeID,ExceptionCodes::NotFoundDelLabEquipmentTypeValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelLabEquipmentTypeValue." : ".$fLabID." - ".$fEquipmentTypeID,ExceptionCodes::DuplicateDelLabEquipmentTypeValue);
      
//delete from db================================================================
         
        $entityManager->remove($LabEquipmentTypes);
        $entityManager->flush($LabEquipmentTypes);
           
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