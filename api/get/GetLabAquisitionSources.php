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
 * @param type $lab_aquisition_source_id
 * @param type $aquisition_year
 * @param type $aquisition_source
 * @param type $lab_id
 * @param type $lab_name
 * @param type $pagesize
 * @param type $page
 * @param type $searchtype
 * @param type $ordertype
 * @param type $orderby
 * @return type
 * @throws Exception
 */
 
function GetLabAquisitionSources( $lab_aquisition_source_id, $aquisition_year, 
                                  $aquisition_source, $lab_id, $lab_name, 
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
            "las.labAquisitionSourceId" => "lab_aquisition_source_id",
            "las.aquisitionYear" => "aquisition_year",
            "aqs.aquisitionSourceId" => "aquisition_source_id",
            "aqs.name" => "aquisition_source_name",
            "l.labId" => "lab_id",
            "l.name" => "lab_name"
             );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "lab_id";
       else
       {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
       }  
    
//$lab_aquisition_source_id=====================================================
    if (Validator::Exists('lab_aquisition_source_id', $params)){
        CRUDUtils::setFilter($qb, $lab_aquisition_source_id, "las", "labAquisitionSourceId", "labAquisitionSourceId", "id", ExceptionMessages::InvalidLabAquisitionSourceIDType, ExceptionCodes::InvalidLabAquisitionSourceIDType);
    } 
      
//$aquisition_year==============================================================
    if (Validator::Exists('aquisition_year', $params)){
        CRUDUtils::setFilter($qb, $aquisition_year, "las", "aquisitionYear", "aquisitionYear", "null,date", ExceptionMessages::InvalidLabAquisitionSourceYearType, ExceptionCodes::InvalidLabAquisitionSourceYearType);
    }   
         
//$aquisition_source============================================================
    if (Validator::Exists('aquisition_source', $params)){
        CRUDUtils::setFilter($qb, $aquisition_source, "aqs", "aquisitionSourceId", "name", "null,id,value", ExceptionMessages::InvalidLabAquisitionSourceType, ExceptionCodes::InvalidLabAquisitionSourceType);
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

        $qb->select('las');
        $qb->from('LabAquisitionSources', 'las');
        $qb->leftjoin('las.aquisitionSource', 'aqs');
        $qb->leftjoin('las.lab', 'l');
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
        foreach ($results as $labaquisitionsource)
        {

            $result["data"][] = array(              
                                        "lab_aquisition_source_id"  => $labaquisitionsource->getLabAquisitionSourceId(),
                                        "aquisition_year"           => $labaquisitionsource->getAquisitionYear(),
                                        "aquisition_comments"       => $labaquisitionsource->getAquisitionComments(),
                                        "aquisition_source_id"      => Validator::IsNull($labaquisitionsource->getAquisitionSource()) ? Validator::ToNull() : $labaquisitionsource->getAquisitionSource()->getAquisitionSourceId(),
                                        "aquisition_source"         => Validator::IsNull($labaquisitionsource->getAquisitionSource()) ? Validator::ToNull() : $labaquisitionsource->getAquisitionSource()->getName(),
                                        "lab_id"                    => $labaquisitionsource->getLab()->getLabId(),
                                        "lab_name"                  => $labaquisitionsource->getLab()->getName()

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