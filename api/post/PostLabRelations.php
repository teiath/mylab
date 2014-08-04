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
    $result["parameters"] = $app->request()->getBody();
    $params = loadParameters();
      
    try {
     
//$lab_id=======================================================================       
        CRUDUtils::entitySetAssociation($LabRelations, $lab_id, 'Labs', 'lab', 'Lab');
 
//$school_unit_id===============================================================         
        CRUDUtils::entitySetAssociation($LabRelations, $school_unit_id, 'SchoolUnits', 'schoolUnit', 'SchoolUnit');
       
//$relation_type================================================================         
        CRUDUtils::entitySetAssociation($LabRelations, $relation_type, 'RelationTypes', 'relationType', 'RelationType');

//$circuit_id=================================================================== 
        
        //check relation_type and set circuit if required=======================
        if (!Validator::IsID($relation_type)){
            $findRelationTypeId = $entityManager->getRepository('RelationTypes')->findOneBy(array ('name'=>$relation_type));
            $fRelationTypeId = $findRelationTypeId->getRelationTypeId();
        } else {
            $fRelationTypeId = $relation_type;
        }
            
            if ($fRelationTypeId == 1) {
                //check if lab has at least one relation served online========== 
                $checkDuplicate = $entityManager->getRepository('LabRelations')->findOneBy(array(  'lab'          => Validator::toID($lab_id),
                                                                                                   'relationType' => $fRelationTypeId
                                                                                                 ));

                if (!Validator::isNull($checkDuplicate)){
                    throw new Exception(ExceptionMessages::UsedLabRelationServerOnline ,ExceptionCodes::UsedLabRelationServerOnline);
                }   
                
                //find circuit_id and school_unit_id=============================
                CRUDUtils::entitySetAssociation($LabRelations, $circuit_id, 'Circuits', 'circuit', 'Circuit');
                //$findSchoolUnit= $entityManager->getRepository('Circuits')->find((Validator::ToID($circuit_id)));  
                //$circuitSchoolUnit = $findSchoolUnit->getSchoolUnit()->getSchoolUnitId(); 
             
            } else {            
                if (Validator::Exists('circuit_id', $params))
                    throw new Exception(ExceptionMessages::ErrorInputCircuitIdParam, ExceptionCodes::ErrorInputCircuitIdParam);
            }
     
//user permisions===============================================================
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array(validator::ToID($lab_id),$permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToPostLab, ExceptionCodes::NoPermissionToPostLab); 
         }; 
       
//controls======================================================================  

        //check duplicates======================================================        
        $checkDuplicate = $entityManager->getRepository('LabRelations')->findOneBy(array( 'lab'            => Validator::toID($lab_id),
                                                                                           'relationType'  => Validator::toID(2),
                                                                                           'schoolUnit'    => Validator::toID($school_unit_id),
                                                                                           'circuit'       => Validator::isNull($circuit_id)?Validator::ToNull($circuit_id):Validator::ToID($circuit_id)
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