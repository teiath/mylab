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
*                   method="PUT",
*                   summary="Ενημέρωση Συσχέτισης Διάταξης Η/Υ - Σχολικής Μονάδας",
*                   notes="Ενημέρωση Συσχέτισης Διάταξης Η/Υ - Σχολικής Μονάδας",
*                   type="putLabRelations",
*                   nickname="PutLabRelations",
* 
*   @SWG\Parameter( name="lab_relation_id", description="ID Συσχέτισης Διάταξης Η/Υ - Σχολικής Μονάδας [notNull]", required=true, type="integer", paramType="query" ),
*   @SWG\Parameter( name="circuit_id", description="ID Τηλεπικοινωνιακού Κυκλώματος", required=false, type="integer", paramType="query" ),
* 
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToPutLab, message=ExceptionMessages::NoPermissionToPutLab),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabRelationIDParam, message=ExceptionMessages::MissingLabRelationIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabRelationIDValue, message=ExceptionMessages::MissingLabRelationIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabRelationIDType, message=ExceptionMessages::InvalidLabRelationIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabRelationIDArray, message=ExceptionMessages::InvalidLabRelationIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabRelationValue, message=ExceptionMessages::InvalidLabRelationValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateLabRelationUniqueValue, message=ExceptionMessages::DuplicateLabRelationUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingCircuitParam, message=ExceptionMessages::MissingCircuitParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingCircuitValue, message=ExceptionMessages::MissingCircuitValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidCircuitValue, message=ExceptionMessages::InvalidCircuitValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidCircuitType, message=ExceptionMessages::InvalidCircuitType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateCircuitUniqueValue, message=ExceptionMessages::DuplicateCircuitUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidCircuitIDType, message=ExceptionMessages::InvalidCircuitIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingCircuitIDValue, message=ExceptionMessages::MissingCircuitIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::UsedLabRelationServerOnline, message=ExceptionMessages::UsedLabRelationServerOnline),
*   @SWG\ResponseMessage(code=ExceptionCodes::ErrorInputCircuitIdParam, message=ExceptionMessages::ErrorInputCircuitIdParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateLabUniqueValue, message=ExceptionMessages::DuplicateLabUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="putLabRelations",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="parameters",type="array",description="Οι παράμετροι που δίνει ο χρήστης" ),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="lab_relation_id",type="integer",description="Ο κωδικός ID της εγγραφής στην οποία πραγματοποιήθηκε ενημέρωση δεδομένων.")
* )
* 
*/

function PutLabRelations($lab_relation_id, $circuit_id) {

    global $app,$entityManager;

    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"] = $params;

    try {
 
//$lab_relation_id==============================================================    
        $fLabRelationId = CRUDUtils::checkIDParam('lab_relation_id', $params, $lab_relation_id, 'LabRelationID');
       
//init entity for update row====================================================
        $LabRelation = CRUDUtils::findIDParam($fLabRelationId, 'LabRelations', 'LabRelation');
      
//check relation_type and set circuit if required===============================    
            if ($LabRelation->getRelationType()->getRelationTypeId() == 1) {
               
                //$circuit_id===================================================
                if ( Validator::IsExists('circuit_id') ){
                    if (!Validator::IsID($circuit_id)){throw new Exception(ExceptionMessages::InvalidCircuitIDType ,ExceptionCodes::InvalidCircuitIDType);}
                    CRUDUtils::entitySetAssociation($LabRelation, $circuit_id, 'Circuits', 'circuit', 'Circuit', $params, 'circuit_id');
                } else if ( Validator::IsNull($LabRelation->getCircuit() ) ){
                    throw new Exception(ExceptionMessages::MissingCircuitIDValue." : ".$circuit_id, ExceptionCodes::MissingCircuitIDValue);
                } 
 
                //controls====================================================== 
                //check if lab has at least one relation served online========== 
                $qb = $entityManager->createQueryBuilder()
                                    ->select('COUNT(lr.labRelationId) AS fresult')
                                    ->from('LabRelations', 'lr')
                                    ->where("(lr.lab = :lab AND lr.relationType = :relationType) AND lr.labRelationId != :labRelationId")
                                    ->setParameter('lab', $LabRelation->getLab())
                                    ->setParameter('relationType', $LabRelation->getRelationType())
                                    ->setParameter('labRelationId', $LabRelation->getLabRelationId())    
                                    ->getQuery()
                                    ->getSingleResult();

                if ( $qb["fresult"] != 0 ) {
                     throw new Exception(ExceptionMessages::UsedLabRelationServerOnline ,ExceptionCodes::UsedLabRelationServerOnline);
                }

            } else {            
                    throw new Exception(ExceptionMessages::ErrorInputCircuitIdParam, ExceptionCodes::ErrorInputCircuitIdParam);
            }
                
//user permisions===============================================================
         $permissions = CheckUserPermissions::getUserPermissions($app->request->user);
         
         if (!in_array($LabRelation->getLab()->getLabId(), $permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToPostLab, ExceptionCodes::NoPermissionToPostLab); 
         }; 
        
//update to db================================================================== 
        $entityManager->persist($LabRelation);
        $entityManager->flush($LabRelation);

        $result["lab_relation_id"] = $LabRelation->getLabRelationId();  
           
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