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
* resourcePath="/lab_types",
* description="Λεξικό : Τύποι Διάτάξεων Η/Υ",
* produces="['application/json']",
* @SWG\Api(
*   path="/lab_types",
*   @SWG\Operation(
*                   method="DELETE",
*                   summary="Διαγραφή Τύπου Διάταξης H/Y",
*                   notes="Διαγραφή Τύπου Διάταξης H/Y",
*                   type="delLabTypes",
*                   nickname="DelLabTypes",
*   @SWG\Parameter(
*                   name="lab_type_id",
*                   description="ID Τύπου Διάταξης H/Y",
*                   required=true,
*                   type="integer",
*                   paramType="query"
*   ),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToDeleteData, message=ExceptionMessages::NoPermissionToDeleteData),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTypeIDParam, message=ExceptionMessages::MissingLabTypeIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTypeIDValue, message=ExceptionMessages::MissingLabTypeIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTypeIDType, message=ExceptionMessages::InvalidLabTypeIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTypeIDArray, message=ExceptionMessages::InvalidLabTypeIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::NotFoundDelLabTypeValue, message=ExceptionMessages::NotFoundDelLabTypeValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateDelLabTypeValue, message=ExceptionMessages::DuplicateDelLabTypeValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::ReferencesLabTypeLabs, message=ExceptionMessages::ReferencesLabTypeLabs),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="delLabTypes",
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

function DelLabTypes($lab_type_id) {

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
           
//$lab_type_id================================================================
        $fLabTypeID = CRUDUtils::checkIDParam('lab_type_id', $params, $lab_type_id, 'LabTypeID');
 
//controls======================================================================          
        
        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('LabTypes')->findBy(array( 'labTypeId' => $fLabTypeID ));
        $count= count($check);
 
        if ($count == 1)
            $LabTypes = $entityManager->find('LabTypes', $fLabTypeID);
        else if ($count == 0)
            throw new Exception(ExceptionMessages::NotFoundDelLabTypeValue." : ".$fLabTypeID ,ExceptionCodes::NotFoundDelLabTypeValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelLabTypeValue." : ".$fLabTypeID ,ExceptionCodes::DuplicateDelLabTypeValue);
        
        //check for references =================================================   
        $checkReference = $entityManager->getRepository('Labs')->findOneBy(array( 'labType'  => $fLabTypeID ));

        if (count($checkReference) != 0)
            throw new Exception(ExceptionMessages::ReferencesLabTypeLabs. $fLabTypeID,ExceptionCodes::ReferencesLabTypeLabs);  
        
//delete from db================================================================
        $entityManager->remove($LabTypes);
        $entityManager->flush($LabTypes);
           
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