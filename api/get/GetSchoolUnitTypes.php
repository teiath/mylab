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
 * @param type $school_unit_type_id
 * @param type $name
 * @param type $education_level
 * @param type $pagesize
 * @param type $page
 * @param type $searchtype
 * @param type $ordertype
 * @param type $orderby
 * @return type
 * @throws Exception
 */

function GetSchoolUnitTypes( $school_unit_type_id, $name, $education_level,
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
       $pagesize = Pagination::getPagesize($pagesize, $params, true);     
       $searchtype = Filters::getSearchType($searchtype, $params);
       $ordertype =  Filters::getOrderType($ordertype, $params);
    
 //$orderby=====================================================================
       $columns = array(
                            "sut.schoolUnitTypeId"  => "school_unit_type_id",
                            "sut.name"              => "name",
                            "el.educationLevelId"   => "education_level_id",
                            "el.name"               => "education_level_name"
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "school_unit_type_id";
        else
        {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        } 
        
//$school_unit_type_id==========================================================
        if (Validator::Exists('school_unit_type_id', $params)){
            CRUDUtils::setFilter($qb, $school_unit_type_id, "sut", "schoolUnitTypeId", "schoolUnitTypeId", "id", ExceptionMessages::InvalidSchoolUnitTypeIDType, ExceptionCodes::InvalidSchoolUnitTypeIDType);
        } 

//$name=========================================================================
        if (Validator::Exists('name', $params)){
            CRUDUtils::setSearchFilter($qb, $name, "sut", "name", $searchtype, ExceptionMessages::InvalidSchoolUnitTypeNameType, ExceptionCodes::InvalidSchoolUnitTypeNameType);    
        }  

//$education_level==================================================================
        if (Validator::Exists('education_level', $params)){
            CRUDUtils::setFilter($qb, $education_level, "el", "educationLevelId", "name", "id,value", ExceptionMessages::InvalidEducationLevelType, ExceptionCodes::InvalidEducationLevelType);
        } 
        
//execution=====================================================================
        $qb->select('sut');
        $qb->from('SchoolUnitTypes', 'sut');
        $qb->leftjoin('sut.educationLevel', 'el');
        $qb->orderBy(array_search($orderby, $columns), $ordertype);

//pagination and results========================================================      
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        $results->getQuery()->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $results->getQuery()->setMaxResults($pagesize) : null;

//data results==================================================================       
        $count = 0;
        foreach ($results as $schoolunittype)
        {

            $result["data"][] = array(
                                        "school_unit_type_id"     => $schoolunittype->getSchoolUnitTypeId(),
                                        "name"                    => $schoolunittype->getName(),
                                        "initials"                => $schoolunittype->getInitials(),
                                        "education_level_id"      => $schoolunittype->getEducationLevel()->getEducationLevelId(),
                                        "education_level_name"    => $schoolunittype->getEducationLevel()->getName()
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