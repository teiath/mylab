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
 * @global type $app
 * @global type $entityManager
 * @param type $lab_relation_id
 * @param type $circuit_id
 * @return string
 * @throws Exception
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
         $permissions = UserRoles::getUserPermissions($app->request->user);
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