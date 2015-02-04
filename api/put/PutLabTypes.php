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
*                   method="PUT",
*                   summary="Ενημέρωση Τύπου Διάταξης H/Y",
*                   notes="Ενημέρωση Τύπου Διάταξης H/Y",
*                   type="putLabTypes",
*                   nickname="PutLabTypes",
*   @SWG\Parameter(
*                   name="lab_type_id",
*                   description="ID Τύπου Διάταξης H/Y",
*                   required=true,
*                   type="string",
*                   paramType="query"
*   ),
*   @SWG\Parameter(
*                   name="name",
*                   description="Όνομα Τύπου Διάταξης H/Y",
*                   required=true,
*                   type="string",
*                   paramType="query"
*                   ),
*   @SWG\Parameter(
*                   name="full_name",
*                   description="Πλήρης Όνομα Τύπου Διάταξης H/Y",
*                   required=true,
*                   type="string",
*                   paramType="query"
*                   ),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToPutData, message=ExceptionMessages::NoPermissionToPutData), 
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTypeIDParam, message=ExceptionMessages::MissingLabTypeIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTypeIDValue, message=ExceptionMessages::MissingLabTypeIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTypeIDType, message=ExceptionMessages::InvalidLabTypeIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTypeIDArray, message=ExceptionMessages::InvalidLabTypeIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTypeValue, message=ExceptionMessages::InvalidLabTypeValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateLabTypeUniqueValue, message=ExceptionMessages::DuplicateLabTypeUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTypeNameParam, message=ExceptionMessages::MissingLabTypeNameParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTypeNameValue, message=ExceptionMessages::MissingLabTypeNameValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTypeNameType, message=ExceptionMessages::InvalidLabTypeNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTypeFullNameParam, message=ExceptionMessages::MissingLabTypeFullNameParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTypeFullNameValue, message=ExceptionMessages::MissingLabTypeFullNameValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTypeFullNameType, message=ExceptionMessages::InvalidLabTypeFullNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicatedLabTypeValue, message=ExceptionMessages::DuplicatedLabTypeValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="putLabTypes",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="parameters",type="array",description="Οι παράμετροι που δίνει ο χρήστης" ),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="lab_type_id",type="integer",description="Ο κωδικός ID της εγγραφής στην οποία πραγματοποιήθηκε ενημέρωση δεδομένων."),
* )
* 
*/

function PutLabTypes($lab_type_id, $name, $full_name) {

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

//$lab_type_id==================================================================    
        $fLabTypeId = CRUDUtils::checkIDParam('lab_type_id', $params, $lab_type_id, 'LabTypeID');
       
//init entity for update row====================================================
        $LabType= CRUDUtils::findIDParam($fLabTypeId, 'LabTypes', 'LabType');
        
//$name=========================================================================
        if ( Validator::IsExists('name') ){
            CRUDUtils::EntitySetParam($LabType, $name, 'LabTypeName', 'name', $params );
        } else if ( Validator::IsNull($LabType->getName()) ){
            throw new Exception(ExceptionMessages::MissingLabTypeNameValue." : ".$name, ExceptionCodes::MissingLabTypeNameValue);
        } 

//$full_name====================================================================       
        if ( Validator::IsExists('full_name') ){
            CRUDUtils::EntitySetParam($LabType, $full_name, 'LabTypeFullName', 'full_name', $params, true, false);
        } else if ( Validator::IsNull($LabType->getFullName() ) ){
            throw new Exception(ExceptionMessages::MissingLabTypeFullNameValue." : ".$full_name, ExceptionCodes::MissingLabTypeFullNameValue);
        } 
        
//controls======================================================================   

        //check duplicate=======================================================        
        $qb = $entityManager->createQueryBuilder()
                            ->select('COUNT(lt.labTypeId) AS fresult')
                            ->from('LabTypes', 'lt')
                            ->where("(lt.name = :name OR lt.fullName = :fullName) AND lt.labTypeId != :labTypeId")
                            ->setParameter('name', $LabType->getName())
                            ->setParameter('fullName', $LabType->getFullName())
                            ->setParameter('labTypeId', $LabType->getLabTypeId())    
                            ->getQuery()
                            ->getSingleResult();
      
        if ( $qb["fresult"] != 0 ) {
             throw new Exception(ExceptionMessages::DuplicatedLabTypeValue ,ExceptionCodes::DuplicatedLabTypeValue);
        }
       
//update to db================================================================== 
        $entityManager->persist($LabType);
        $entityManager->flush($LabType);

        $result["lab_type_id"] = $LabType->getLabTypeId();  
           
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