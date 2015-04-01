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
* resourcePath="/lab_relations",
* description="Συσχετίσεις Διατάξεων - Μονάδων",
* produces="['application/json']",
* @SWG\Api(
*   path="/lab_relations",
*   @SWG\Operation(
*                   method="DELETE",
*                   summary="Διαγραφή Συσχέτισης Διάταξης Η/Υ - Σχολικής Μονάδας",
*                   notes="Διαγραφή Συσχέτισης Διάταξης Η/Υ - Σχολικής Μονάδας",
*                   type="delLabRelations",
*                   nickname="DelLabRelations",
*
*   @SWG\Parameter( name="lab_id", description="ID Διάταξης Η/Υ [notNull]", required=true, type="integer", paramType="query" ), 
*   @SWG\Parameter( name="lab_relation_id", description="ID Συσχέτισης Διάταξης Η/Υ - Σχολικής Μονάδας [notNull]", required=true, type="integer", paramType="query" ),
*
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToDeleteLab, message=ExceptionMessages::NoPermissionToDeleteLab),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabIDParam, message=ExceptionMessages::MissingLabIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabIDValue, message=ExceptionMessages::MissingLabIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabIDType, message=ExceptionMessages::InvalidLabIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabIDArray, message=ExceptionMessages::InvalidLabIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabRelationIDParam, message=ExceptionMessages::MissingLabRelationIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabRelationIDValue, message=ExceptionMessages::MissingLabRelationIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabRelationIDType, message=ExceptionMessages::InvalidLabRelationIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabRelationIDArray, message=ExceptionMessages::InvalidLabRelationIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::NotFoundDelLabRelationValue, message=ExceptionMessages::NotFoundDelLabRelationValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateDelLabRelationValue, message=ExceptionMessages::DuplicateDelLabRelationValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="delLabRelations",
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

function DelLabRelations($lab_id, $lab_relation_id) {

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

//$lab_relation_id==============================================================
        $fLabRelationID = CRUDUtils::checkIDParam('lab_relation_id', $params, $lab_relation_id, 'LabRelationID');
             
//user permisions===============================================================
         $permissions = CheckUserPermissions::getUserPermissions($app->request->user);
         
         if (!in_array($fLabID, $permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToDeleteLab, ExceptionCodes::NoPermissionToDeleteLab); 
         };  

//controls======================================================================  

        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('LabRelations')->findBy(array( 'lab'            => $fLabID,
                                                                              'labRelationId'  => $fLabRelationID,
                                                                            ));

        $countLabRelations = count($check);
        
        if ($countLabRelations == 1)
            //set entity for delete row
            $LabRelations = $entityManager->find('LabRelations', $fLabRelationID);
        else if ($countLabRelations == 0)
            throw new Exception(ExceptionMessages::NotFoundDelLabRelationValue." : ".$fLabID." - ".$fLabRelationID,ExceptionCodes::NotFoundDelLabRelationValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelLabRelationValue." : ".$fLabID." - ".$fLabRelationID,ExceptionCodes::DuplicateDelLabRelationValue);
      
//delete from db================================================================
         
        $entityManager->remove($LabRelations);
        $entityManager->flush($LabRelations);
           
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