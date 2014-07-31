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
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $lab
 * @param type $relation_type
 * @param type $pagesize
 * @param int $page
 * @return string
 * @throws Exception
 */
 
function GetCircuits( $circuit_id, $phone_number, $updated_date, $status, $circuit_type, $school_unit_id, $school_unit_name,
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
        
//$page - $pagesize - $searchtype - $ordertype =================================
       $page = Pagination::getPage($page, $params);
       $pagesize = Pagination::getPagesize($pagesize, $params);     
       $searchtype = Filters::getSearchType($searchtype, $params);
       $ordertype =  Filters::getOrderType($ordertype, $params);
    
 //$orderby=====================================================================
       $columns = array(
                            "c.circuitId"       => "circuit_id",
                            "c.phoneNumber"     => "phone_number",
                            "c.updatedDate"     => "updated_date",
                            "c.status"          => "status" ,
                            "ct.circuitTypeId"  => "circuit_type_id",
                            "ct.name"           => "circuit_type_name",
                            "su.schoolUnitId"   => "school_unit_id",
                            "su.name"           => "school_unit_name",
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "circuit_id";
        else
        {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        } 
        
//$circuit_id===================================================================
        if (Validator::Exists('circuit_id', $params)){
            CRUDUtils::setFilter($qb, $circuit_id, "c", "circuitId", "circuitId", "id", ExceptionMessages::InvalidCircuitIDType, ExceptionCodes::InvalidCircuitIDType);
        } 

//$phone_number=================================================================
        if (Validator::Exists('phone_number', $params)){
            CRUDUtils::setSearchFilter($qb, $phone_number, "c", "phoneNumber", $searchtype, ExceptionMessages::InvalidCircuitPhoneNumberType, ExceptionCodes::InvalidCircuitPhoneNumberType);    
        }  

//$updated_date=================================================================
        if (Validator::Exists('updated_date', $params)){
            CRUDUtils::setFilter($qb, $updated_date, "c", "updatedDate", "updatedDate", "date", ExceptionMessages::InvalidCircuitUpdatedDateType, ExceptionCodes::InvalidCircuitUpdatedDateType);
        } 
        
//$status=======================================================================
        if (Validator::Exists('status', $params)){
            CRUDUtils::setFilter($qb, $status, "c", "status", "status", "numeric", ExceptionMessages::InvalidCircuitStatusType, ExceptionCodes::InvalidCircuitStatusType);
        }    
 
//$circuit_type=================================================================
        if (Validator::Exists('circuit_type', $params)){
            CRUDUtils::setFilter($qb, $circuit_type, "ct", "circuitTypeId", "name", "id,value", ExceptionMessages::InvalidCircuitTypeType, ExceptionCodes::InvalidCircuitTypeType);
        }  
        
//$school_unit_id===============================================================
        if (Validator::Exists('school_unit_id', $params)){
            CRUDUtils::setFilter($qb, $school_unit_id, "su", "schoolUnitId", "schoolUnitId", "id", ExceptionMessages::InvalidSchoolUnitIDType, ExceptionCodes::InvalidSchoolUnitIDType);
        }  
 
//$school_unit_name=============================================================
        if (Validator::Exists('school_unit_name', $params)){
            CRUDUtils::setSearchFilter($qb, $school_unit_name, "su", "name", $searchtype, ExceptionMessages::InvalidSchoolUnitNameType, ExceptionCodes::InvalidSchoolUnitNameType);    
        }
        
//execution=====================================================================
        $qb->select('c');
        $qb->from('Circuits', 'c');
        $qb->leftjoin('c.circuitType', 'ct');
        $qb->leftjoin('c.schoolUnit', 'su');
        $qb->orderBy(array_search($orderby, $columns), $ordertype);

//pagination and results========================================================      
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        $results->getQuery()->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $results->getQuery()->setMaxResults($pagesize) : null;

//data results==================================================================       
        $count = 0;
        foreach ($results as $circuit)
        {

            $result["data"][] = array(
                                            "circuit_id"         => $circuit->getCircuitId(),
                                            "phone_number"       => $circuit->getPhoneNumber(),
                                            "updated_date"       => $circuit->getUpdatedDate()->format('Y-m-d H:i:s'),
                                            "status"             => $circuit->getStatus(),
                                            "circuit_type_id"    => $circuit->getCircuitType()->getCircuitTypeId(),
                                            "circuit_type_name"  => $circuit->getCircuitType()->getName(),
                                            "school_unit_id"     => $circuit->getSchoolUnit()->getSchoolUnitId(),
                                            "school_unit_name"   => $circuit->getSchoolUnit()->getName()
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