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
*                   method="PUT",
*                   summary="Ενημέρωση Τύπου Συσχέτισης Διατάξεων Η/Υ - Μονάδων",
*                   notes="Ενημέρωση Τύπου Συσχέτισης Διατάξεων Η/Υ - Μονάδων",
*                   type="putRelationTypes",
*                   nickname="PutRelationTypes",
*   @SWG\Parameter(
*                   name="relation_type_id",
*                   description="ID Τύπου Συσχέτισης Διατάξεων Η/Υ - Μονάδων",
*                   required=true,
*                   type="string",
*                   paramType="query"
*   ),
*   @SWG\Parameter(
*                   name="name",
*                   description="Όνομα Τύπου Συσχέτισης Διατάξεων Η/Υ - Μονάδων",
*                   required=true,
*                   type="string",
*                   paramType="query"
*                   ),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToPutData, message=ExceptionMessages::NoPermissionToPutData), 
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingRelationTypeIDParam, message=ExceptionMessages::MissingRelationTypeIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingRelationTypeIDValue, message=ExceptionMessages::MissingRelationTypeIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidRelationTypeIDType, message=ExceptionMessages::InvalidRelationTypeIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidRelationTypeIDArray, message=ExceptionMessages::InvalidRelationTypeIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidRelationTypeValue, message=ExceptionMessages::InvalidRelationTypeValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateRelationTypeUniqueValue, message=ExceptionMessages::DuplicateRelationTypeUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingRelationTypeNameParam, message=ExceptionMessages::MissingRelationTypeNameParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingRelationTypeNameValue, message=ExceptionMessages::MissingRelationTypeNameValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidRelationTypeNameType, message=ExceptionMessages::InvalidRelationTypeNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicatedRelationTypeValue, message=ExceptionMessages::DuplicatedRelationTypeValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="putRelationTypes",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="parameters",type="array",description="Οι παράμετροι που δίνει ο χρήστης" ),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="relation_type_id",type="integer",description="Ο κωδικός ID της εγγραφής στην οποία πραγματοποιήθηκε ενημέρωση δεδομένων."),
* )
* 
*/

function PutRelationTypes($relation_type_id, $name) {

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
 
//$relation_type_id=============================================================    
        $fRelationTypeId = CRUDUtils::checkIDParam('relation_type_id', $params, $relation_type_id, 'RelationTypeID');
       
//init entity for update row====================================================
        $RelationType = CRUDUtils::findIDParam($fRelationTypeId, 'RelationTypes', 'RelationType');
        
//$name=========================================================================
        if ( Validator::IsExists('name') ){
            CRUDUtils::EntitySetParam($RelationType, $name, 'RelationTypeName', 'name', $params );
        } else if ( Validator::IsNull($RelationType->getName()) ){
            throw new Exception(ExceptionMessages::MissingRelationTypeNameValue." : ".$name, ExceptionCodes::MissingRelationTypeNameValue);
        } 

//controls======================================================================   

        //check duplicate=======================================================        
        $qb = $entityManager->createQueryBuilder()
                            ->select('COUNT(rt.relationTypeId) AS fresult')
                            ->from('RelationTypes', 'rt')
                            ->where("rt.name = :name AND rt.relationTypeId != :relationTypeId")
                            ->setParameter('name', $RelationType->getName())
                            ->setParameter('relationTypeId', $RelationType->getRelationTypeId())    
                            ->getQuery()
                            ->getSingleResult();
      
        if ( $qb["fresult"] != 0 ) {
             throw new Exception(ExceptionMessages::DuplicatedRelationTypeValue ,ExceptionCodes::DuplicatedRelationTypeValue);
        }
       
//update to db================================================================== 
        $entityManager->persist($RelationType);
        $entityManager->flush($RelationType);

        $result["relation_type_id"] = $RelationType->getRelationTypeId();  
           
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