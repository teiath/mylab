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
 * @global type $db
 * @global type $app
 * @param type $lab_id
 * @param type $school_unit_id
 * @param type $relation_type
 * @param type $circuit_id
 * @return string
 * @throws Exception
 */

function PostLabRelations($lab_id, $school_unit_id, $relation_type, $circuit_id) {
    
    global $app,$entityManager;

    $LabRelations = new LabRelations();
    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = json_decode($app->request()->getBody());
    $params = loadParameters();
      
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
                
                //find circuit_id and school_unit_id=============================
                if (!Validator::IsID($circuit_id)){throw new Exception(ExceptionMessages::InvalidCircuitIDType ,ExceptionCodes::InvalidCircuitIDType);}
                CRUDUtils::entitySetAssociation($LabRelations, $circuit_id, 'Circuits', 'circuit', 'Circuit', $params, 'circuit_id');
             
            } else {            
                if (Validator::Exists('circuit_id', $params))
                    throw new Exception(ExceptionMessages::ErrorInputCircuitIdParam, ExceptionCodes::ErrorInputCircuitIdParam);
            }
     
//user permisions===============================================================
         $permissions = UserRoles::getUserPermissions($app->request->user);
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