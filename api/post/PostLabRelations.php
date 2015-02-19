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
*                   method="POST",
*                   summary="Εισαγωγή Συσχέτισης Διάταξης Η/Υ - Σχολικής Μονάδας",
*                   notes="Εισαγωγή  Συσχέτισης Διάταξης Η/Υ - Σχολικής Μονάδας",
*                   type="postLabRelations",
*                   nickname="PostLabRelations",
* 
*   @SWG\Parameter( name="lab_id", description="ID Διάταξης Η/Υ [notNull]", required=true, type="integer", paramType="query" ),
*   @SWG\Parameter( name="school_unit_id", description="ID Σχολικής Μονάδας [notNull]", required=true, type="integer", paramType="query" ),
*   @SWG\Parameter( name="relation_type", description="Όνομα ή ID Τύπου Συσχέτισης Διάταξης Η/Υ - Σχολικής Μονάδας [notNull]", required=true, type="mixed(string|integer)", paramType="query" ),
*   @SWG\Parameter( name="circuit_id", description="ID Τηλεπικοινωνιακού Κυκλώματος", required=false, type="integer", paramType="query" ),
*   
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToPostLab, message=ExceptionMessages::NoPermissionToPostLab),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabParam, message=ExceptionMessages::MissingLabParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabValue, message=ExceptionMessages::MissingLabValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabValue, message=ExceptionMessages::InvalidLabValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabType, message=ExceptionMessages::InvalidLabType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateLabUniqueValue, message=ExceptionMessages::DuplicateLabUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingSchoolUnitParam, message=ExceptionMessages::MissingSchoolUnitParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingSchoolUnitValue, message=ExceptionMessages::MissingSchoolUnitValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitValue, message=ExceptionMessages::InvalidSchoolUnitValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitType, message=ExceptionMessages::InvalidSchoolUnitType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateSchoolUnitUniqueValue, message=ExceptionMessages::DuplicateSchoolUnitUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingRelationTypeParam, message=ExceptionMessages::MissingRelationTypeParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingRelationTypeValue, message=ExceptionMessages::MissingRelationTypeValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidRelationTypeValue, message=ExceptionMessages::InvalidRelationTypeValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidRelationTypeType, message=ExceptionMessages::InvalidRelationTypeType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateRelationTypeUniqueValue, message=ExceptionMessages::DuplicateRelationTypeUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingCircuitParam, message=ExceptionMessages::MissingCircuitParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingCircuitValue, message=ExceptionMessages::MissingCircuitValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidCircuitValue, message=ExceptionMessages::InvalidCircuitValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidCircuitType, message=ExceptionMessages::InvalidCircuitType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateCircuitUniqueValue, message=ExceptionMessages::DuplicateCircuitUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::UsedLabRelationServerOnline, message=ExceptionMessages::UsedLabRelationServerOnline),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidCircuitIDType, message=ExceptionMessages::InvalidCircuitIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::ErrorInputCircuitIdParam, message=ExceptionMessages::ErrorInputCircuitIdParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicatedLabRelationValue, message=ExceptionMessages::DuplicatedLabRelationValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="postLabRelations",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="parameters",type="array",description="Οι παράμετροι που δίνει ο χρήστης" ),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="lab_relation_id",type="integer",description="Ο κωδικός ID της εγγραφής στην οποία πραγματοποιήθηκε εισαγωγή δεδομένων.")
* )
* 
*/

function PostLabRelations($lab_id, $school_unit_id, $relation_type, $circuit_id) {
    
    global $app,$entityManager;

    $LabRelations = new LabRelations();
    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"]  = $params;
      
    try {
     
//$lab_id=======================================================================       
        CRUDUtils::entitySetAssociation($LabRelations, $lab_id, 'Labs', 'lab', 'Lab', $params, 'lab_id');
 
//$school_unit_id===============================================================         
        CRUDUtils::entitySetAssociation($LabRelations, $school_unit_id, 'SchoolUnits', 'schoolUnit', 'SchoolUnit', $params, 'school_unit_id');
       
//$relation_type================================================================         
        CRUDUtils::entitySetAssociation($LabRelations, $relation_type, 'RelationTypes', 'relationType', 'RelationType', $params, 'relation_type');

//$circuit_id=================================================================== 
        
        //check relation_type and set circuit if required=======================    
            if ($LabRelations->getRelationType()->getRelationTypeId() == 1) {
                //check if lab has at least one relation served online========== 
                $checkUnique = $entityManager->getRepository('LabRelations')->findOneBy(array(  'lab'          => $LabRelations->getLab(),
                                                                                                'relationType' => $LabRelations->getRelationType()
                                                                                              ));

                if (!Validator::isNull($checkUnique)){
                    throw new Exception(ExceptionMessages::UsedLabRelationServerOnline ,ExceptionCodes::UsedLabRelationServerOnline);
                }   
                
                //find circuit_id and school_unit_id============================
                if (!Validator::IsID($circuit_id)){throw new Exception(ExceptionMessages::InvalidCircuitIDType ,ExceptionCodes::InvalidCircuitIDType);}
                CRUDUtils::entitySetAssociation($LabRelations, $circuit_id, 'Circuits', 'circuit', 'Circuit', $params, 'circuit_id');
             
            } else {            
                if (Validator::Exists('circuit_id', $params))
                    throw new Exception(ExceptionMessages::ErrorInputCircuitIdParam, ExceptionCodes::ErrorInputCircuitIdParam);
            }
     
//user permisions===============================================================
         $permissions = CheckUserPermissions::getUserPermissions($app->request->user);
         
         if (!in_array($LabRelations->getLab()->getLabId(), $permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToPostLab, ExceptionCodes::NoPermissionToPostLab); 
         }; 
       
//controls======================================================================  

        //check duplicates======================================================        
        $checkDuplicate = $entityManager->getRepository('LabRelations')->findOneBy(array( 'lab'            => $LabRelations->getLab(),
                                                                                           'relationType'  => $LabRelations->getRelationType(),
                                                                                           'schoolUnit'    => $LabRelations->getSchoolUnit(),
                                                                                           'circuit'       => $LabRelations->getCircuit()
                                                                                          ));

        if (!Validator::isNull($checkDuplicate)){
            throw new Exception(ExceptionMessages::DuplicatedLabRelationValue ,ExceptionCodes::DuplicatedLabRelationValue);
        }    
        
//insert to db==================================================================
       
           $entityManager->persist($LabRelations);
           $entityManager->flush($LabRelations);
       
           $result["lab_relation_id"] = $LabRelations->getLabRelationId();
            
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