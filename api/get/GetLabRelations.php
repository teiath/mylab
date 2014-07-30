<?php
/**
 *
 * @version 2.0
 * @author  ΤΕΙ Αθήνας
 * @package GET
 */

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $entityManager
 * @global type $app
 * @param type $lab_relation_id
 * @param type $lab_id
 * @param type $lab_name
 * @param type $school_unit_id
 * @param type $school_unit_name
 * @param type $relation_type
 * @param type $circuit_id
 * @param type $circuit_phone_number
 * @param type $pagesize
 * @param type $page
 * @param type $searchtype
 * @param type $ordertype
 * @param type $orderby
 * @return type
 * @throws Exception
 */
 
function GetLabRelations( $lab_relation_id,
                          $relation_type, $circuit_id, $circuit_phone_number,
                          $school_unit_id, $school_unit_name, $lab_id, $lab_name,  
                          $pagesize, $page, $searchtype, $ordertype, $orderby ) {

    global $entityManager, $app;

    $qb = $entityManager->createQueryBuilder();
    $result = array();  

    $result["data"] = array();
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    
    try {

//set user permissions==========================================================
    $permissions = UserRoles::getUserPermissions($app->request->user);

    if (Validator::IsNull($permissions['permit_labs'])){
        throw new Exception(ExceptionMessages::NoPermissionsError, ExceptionCodes::NoPermissionsError);     
    }else { 
        $permit_labs = $permissions['permit_labs'];
    }
 
//$page - $pagesize - $searchtype - $ordertype =================================
       $page = Pagination::getPage($page, $params);
       $pagesize = Pagination::getPagesize($pagesize, $params);     
       $searchtype = Filters::getSearchType($searchtype, $params);
       $ordertype =  Filters::getOrderType($ordertype, $params);
       
//$orderby======================================================================
       $columns = array(
                            "lr.labRelationId" => "lab_relation_id",
                            "rt.relationTypeId" => "relation_type_id",
                            "rt.name" => "relation_type_name",
                            "c.circuitId" => "circuit_id",         
                            "c.phoneNumber" => "circuit_phone_number",
                            "su.schoolUnitId" => "school_unit_id",
                            "su.name" => "school_unit_name",
                            "l.labId" => "lab_id",
                            "l.name" => "lab_name",
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "lab_id";
       else
       {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
       }  
    
//$lab_relation_id==============================================================
    if (Validator::Exists('lab_relation_id', $params)){
        CRUDUtils::setFilter($qb, $lab_relation_id, "lr", "labRelationId", "labRelationId", "id", ExceptionMessages::InvalidLabRelationIDType, ExceptionCodes::InvalidLabRelationIDType);
    } 
 
//$circuit_id===================================================================
    if (Validator::Exists('circuit_id', $params)){
        CRUDUtils::setFilter($qb, $circuit_id, "c", "circuitId", "circuitId", "null,numeric", ExceptionMessages::InvalidCircuitIDType, ExceptionCodes::InvalidCircuitIDType);
    } 
 
//$circuit_phone_number=========================================================
    if (Validator::Exists('circuit_phone_number', $params)){
        CRUDUtils::setFilter($qb, $circuit_phone_number, "c", "phoneNumber", "phoneNumber", "null,numeric", ExceptionMessages::InvalidCircuitPhoneNumberType, ExceptionCodes::InvalidCircuitPhoneNumberType);
    } 
    
//$relation_type================================================================
    if (Validator::Exists('relation_type', $params)){
        CRUDUtils::setFilter($qb, $relation_type, "rt", "relationType", "name", "id,name", ExceptionMessages::InvalidRelationTypeType, ExceptionCodes::InvalidRelationTypeType);
    } 
 
//$school_unit_id===============================================================
    if (Validator::Exists('school_unit_id', $params)){
        CRUDUtils::setFilter($qb, $school_unit_id, "su", "schoolUnitId", "schoolUnitId", "id", ExceptionMessages::InvalidSchoolUnitIDType, ExceptionCodes::InvalidSchoolUnitIDType);
    }   
         
//$school_unit_name=============================================================
    if (Validator::Exists('school_unit_name', $params)){
        CRUDUtils::setSearchFilter($qb, $school_unit_name, "su", "name", $searchtype, ExceptionMessages::InvalidSchoolUnitNameType, ExceptionCodes::InvalidSchoolUnitNameType);  
    }
    
//$lab_id=======================================================================
    if (Validator::Exists('lab_id', $params)){
        CRUDUtils::setFilter($qb, $lab_id, "l", "labId", "labId", "id", ExceptionMessages::InvalidLabIDType, ExceptionCodes::InvalidLabIDType);
    } 
    
//$lab_name=====================================================================
    if (Validator::Exists('lab_name', $params)){
        CRUDUtils::setSearchFilter($qb, $lab_name, "l", "name", $searchtype, ExceptionMessages::InvalidLabNameType, ExceptionCodes::InvalidLabNameType);   
    }
    
 //execution====================================================================

        $qb->select('lr');
        $qb->from('LabRelations', 'lr');
        $qb->leftjoin('lr.relationType', 'rt');
        $qb->leftjoin('lr.circuit', 'c');
        $qb->leftjoin('lr.schoolUnit', 'su');
        $qb->leftjoin('lr.lab', 'l');
        $qb->orderBy(array_search($orderby, $columns), $ordertype);

        if ($permit_labs !== 'ALLRESULTS'){
            $qb->andWhere($qb->expr()->in('l.labId', ':ids'))
                ->setParameter('ids', $permit_labs);
        }
  
//pagination and results========================================================     
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        $results->getQuery()->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $results->getQuery()->setMaxResults($pagesize) : null;

//data results==================================================================       
        $count = 0;
        foreach ($results as $labrelation)
        {

            $result["data"][] = array(              
                                        "lab_relation_id"       => $labrelation->getLabRelationId(),
                                        "relation_type_id"      => $labrelation->getRelationType()->getRelationTypeId(),
                                        "relation_type_name"    => $labrelation->getRelationType()->getName(), 
                                        "circuit_id"            => Validator::IsNull($labrelation->getCircuit()) ? Validator::ToNull() : $labrelation->getCircuit()->getCircuitId(),
                                        "circuit_phone_number"  => Validator::IsNull($labrelation->getCircuit()) ? Validator::ToNull() : $labrelation->getCircuit()->getPhoneNumber(),
                                        "school_unit_id"        => $labrelation->getSchoolUnit()->getSchoolUnitId(),
                                        "school_unit_name"      => $labrelation->getSchoolUnit()->getName(),
                                        "lab_id"                => $labrelation->getLab()->getLabId(),
                                        "lab_name"              => $labrelation->getLab()->getName()
                                       );
            $count++;
        }
        $result["count"] = $count;

//pagination results============================================================     
        $maxPage = Pagination::getMaxPage($result["total"],$page,$pagesize);
        $pagination = array( "page" => $page,   
                             "maxPage" => $maxPage, 
                             "pagesize" => $pagesize 
                            );    
        $result["pagination"]=$pagination;
           
//result_messages===============================================================    
        $result["status"] = ExceptionCodes::NoErrors;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".ExceptionMessages::NoErrors;
    } catch (Exception $e) {
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    
//debug=========================================================================       
        if ( Validator::IsTrue( $params["debug"]  ) )
        {
             $result["DQL"] =  trim(preg_replace('/\s\s+/', ' ', $qb->getDQL()));
             $result["SQL"] =  trim(preg_replace('/\s\s+/', ' ', $qb->getQuery()->getSQL()));
        }
    
    return $result;       
           
}

?>