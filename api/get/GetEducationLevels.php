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
 * @param type $pagesize
 * @param int $page
 * @return string
 * @throws Exception
 */


function GetEducationLevels( $education_level, $name,
                             $pagesize, $page, $searchtype, $ordertype, $orderby ) {
        
//            //retrieve school_unit_types
//            $school_unit_type["school_unit_type_info"] = array();   
//            $filter = array( new DFC(SchoolUnitTypesExt::FIELD_EDUCATION_LEVEL_ID,$row->getEducationLevelId(), DFC::EXACT));
//            $sort = array( new DSC(SchoolUnitTypesExt::FIELD_EDUCATION_LEVEL_ID, DSC::ASC) );
//            $arraySchoolUnitTypes = $oSchoolUnitTypes->findByFilter($db, $filter, true, $sort);  
//                if ($arraySchoolUnitTypes) {
//                foreach ($arraySchoolUnitTypes as $arraySchoolUnitType){
//                    $school_unit_type["school_unit_type_info"][] = array("school_unit_type_id" => $arraySchoolUnitType->getSchoolUnitTypeId(),
//                                                                         "name" => $arraySchoolUnitType->getName()                                                                      
//                                                                   );  
//                 }
//                } else {
//                   $school_unit_type["school_unit_type_info"] = null; 
//                }
//            $result["data"][] = array("education_level_id" => $row->getEducationLevelId(), 
//                                      "name" => $row->getName(),
//                                      "school_unit_types"=>$school_unit_type
//                                );
//        }
    
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
                            "el.educationLevelId"  => "education_level",
                            "el.name"              => "name"
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "education_level";
        else
        {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        } 
        
//$education_level==============================================================
        if (Validator::Exists('education_level', $params)){
            CRUDUtils::setFilter($qb, $education_level, "el", "educationLevelId", "educationLevelId", "id", ExceptionMessages::InvalidEducationLevelIDType, ExceptionCodes::InvalidEducationLevelIDType);
        } 

//$name=========================================================================
        if (Validator::Exists('name', $params)){
            CRUDUtils::setSearchFilter($qb, $name, "el", "name", $searchtype, ExceptionMessages::InvalidEducationLevelNameType, ExceptionCodes::InvalidEducationLevelNameType);    
        }  
        
//execution=====================================================================
        $qb->select('el');
        $qb->from('EducationLevels', 'el');
        $qb->orderBy(array_search($orderby, $columns), $ordertype);

//pagination and results========================================================      
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        $results->getQuery()->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $results->getQuery()->setMaxResults($pagesize) : null;

//data results==================================================================       
        $count = 0;
        foreach ($results as $educationlevel)
        {

            $result["data"][] = array(
                                        "education_level_id"     => $educationlevel->getEducationLevelId(),
                                        "name"                   => $educationlevel->getName()
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