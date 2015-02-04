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
*                   method="DELETE",
*                   summary="Διαγραφή Τύπου Συσχέτισης Διατάξεων Η/Υ - Μονάδων",
*                   notes="Διαγραφή Τύπου Συσχέτισης Διατάξεων Η/Υ - Μονάδων",
*                   type="delRelationTypes",
*                   nickname="DelRelationTypes",
*   @SWG\Parameter(
*                   name="relation_type_id",
*                   description="ID Τύπου Συσχέτισης Διατάξεων Η/Υ - Μονάδων",
*                   required=true,
*                   type="integer",
*                   paramType="query"
*   ),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToDeleteData, message=ExceptionMessages::NoPermissionToDeleteData),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingRelationTypeIDParam, message=ExceptionMessages::MissingRelationTypeIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingRelationTypeIDValue, message=ExceptionMessages::MissingRelationTypeIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidRelationTypeIDType, message=ExceptionMessages::InvalidRelationTypeIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidRelationTypeIDArray, message=ExceptionMessages::InvalidRelationTypeIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::NotFoundDelRelationTypeValue, message=ExceptionMessages::NotFoundDelRelationTypeValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateDelRelationTypeValue, message=ExceptionMessages::DuplicateDelRelationTypeValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::ReferencesRelationTypeLabRelationTypes, message=ExceptionMessages::ReferencesRelationTypeLabRelationTypes),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="delRelationTypes",
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

function DelRelationTypes($relation_type_id) {
  
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
           
//$relation_type_id=============================================================
        $fRelationTypeID = CRUDUtils::checkIDParam('relation_type_id', $params, $relation_type_id, 'RelationTypeID');

//controls======================================================================          
        
        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('RelationTypes')->findBy(array( 'relationTypeId' => $fRelationTypeID ));
        $count= count($check);

        if ($count == 1)
            $RelationTypes = $entityManager->find('RelationTypes', $fRelationTypeID);
        else if ($count == 0)
            throw new Exception(ExceptionMessages::NotFoundDelRelationTypeValue." : ".$fRelationTypeID ,ExceptionCodes::NotFoundDelRelationTypeValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelRelationTypeValue." : ".$fRelationTypeID ,ExceptionCodes::DuplicateDelRelationTypeValue);
        
        //check for references =================================================   
        $checkReference = $entityManager->getRepository('LabRelations')->findOneBy(array( 'relationType'  => $fRelationTypeID ));

        if (count($checkReference) != 0)
            throw new Exception(ExceptionMessages::ReferencesRelationTypeLabRelationTypes. $fRelationTypeID,ExceptionCodes::ReferencesRelationTypeLabRelationTypes);  
        
//delete from db================================================================
        $entityManager->remove($RelationTypes);
        $entityManager->flush($RelationTypes);
           
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