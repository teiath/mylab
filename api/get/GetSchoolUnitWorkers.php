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
 * @param type $school_unit_worker_id
 * @param type $school_unit_id
 * @param type $school_unit_name
 * @param type $worker_id
 * @param type $worker_position
 * @param type $pagesize
 * @param int $page
 * @param type $searchtype
 * @param type $ordertype
 * @param type $orderby
 * @return string
 * @throws Exception
 */
 
function GetSchoolUnitWorkers( $school_unit_worker_id, $school_unit_id, $school_unit_name, $worker_id, $worker_position, 
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

    if (Validator::IsNull($permissions['permit_school_units'])){
        throw new Exception(ExceptionMessages::NoPermissionsError, ExceptionCodes::NoPermissionsError);     
    }else { 
        $permit_school_units = $permissions['permit_school_units'];
    }
  
//$page - $pagesize - $searchtype - $ordertype =================================
       $page = Pagination::getPage($page, $params);
       $pagesize = Pagination::getPagesize($pagesize, $params);     
       $searchtype = Filters::getSearchType($searchtype, $params);
       $ordertype =  Filters::getOrderType($ordertype, $params);

//$orderby======================================================================
       $columns = array(
                            "suw.schoolUnitWorkerId"    => "school_unit_worker_id",
                            "su.schoolUnitId"           => "school_unit_id",
                            "su.name"                   => "school_unit_name",
                            "w.workerId"                => "worker_id",
                            "wp.workerPositionId"       => "worker_position_id",
                            "wp.name"                   => "worker_position_name"
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "school_unit_id";
       else
       {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
       }
       
//$school_unit_worker_id================================================================
    if (Validator::Exists('school_unit_worker_id', $params)){
        CRUDUtils::setFilter($qb, $school_unit_worker_id, "suw", "schoolUnitWorkerId", "schoolUnitWorkerId", "id", ExceptionMessages::InvalidSchoolUnitWorkerIDType, ExceptionCodes::InvalidSchoolUnitWorkerIDType);
    }         
     
//$school_unit_id=======================================================================
    if (Validator::Exists('school_unit_id', $params)){
        CRUDUtils::setFilter($qb, $school_unit_id, "su", "schoolUnitId", "schoolUnitId", "id", ExceptionMessages::InvalidSchoolUnitIDType, ExceptionCodes::InvalidSchoolUnitIDType);
    } 
    
//$school_unit_name=====================================================================
    if (Validator::Exists('school_unit_name', $params)){
        CRUDUtils::setSearchFilter($qb, $school_unit_name, "su", "name", $searchtype, ExceptionMessages::InvalidSchoolUnitNameType, ExceptionCodes::InvalidSchoolUnitNameType);   
    }
    
  //$worker_id====================================================================
    if (Validator::Exists('worker_id', $params)){
        CRUDUtils::setFilter($qb, $worker_id, "w", "workerId", "workerId", "id", ExceptionMessages::InvalidWorkerIDType, ExceptionCodes::InvalidWorkerIDType);
    } 
    
//$worker_position==============================================================
    if (Validator::Exists('worker_position', $params)){
        CRUDUtils::setFilter($qb, $worker_position, "wp", "workerPositionId", "name", "id,value", ExceptionMessages::InvalidWorkerPositionType, ExceptionCodes::InvalidWorkerPositionType);
    }       
 
 //execution====================================================================

        $qb->select('suw');
        $qb->from('SchoolUnitWorkers', 'suw');
        $qb->leftjoin('suw.worker', 'w');
        $qb->leftjoin('suw.workerPosition', 'wp');
        $qb->leftjoin('w.workerSpecialization', 'ws');
        $qb->leftjoin('suw.schoolUnit', 'su');
        $qb->orderBy(array_search($orderby, $columns), $ordertype);
 
        if ($permit_school_units !== 'ALLRESULTS'){
            $qb->andWhere($qb->expr()->in('su.schoolUnitId', ':ids'))
                ->setParameter('ids', $permit_school_units);
        }
  
//pagination and results========================================================     
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        $results->getQuery()->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $results->getQuery()->setMaxResults($pagesize) : null;

 //data results==================================================================       
        $count = 0;
        foreach ($results as $schoolUnitWorker)
        {

            $result["data"][] = array(              
                                        "school_unit_worker_id"     => $schoolUnitWorker->getSchoolUnitWorkerId(),
                                        "worker_id"                 => $schoolUnitWorker->getWorker()->getWorkerId(),
                                        "worker_registry_no"        => $schoolUnitWorker->getWorker()->getRegistryNo(),
                                        "tax_number"                => Validator::IsNull($schoolUnitWorker->getWorker()->getTaxNumber()) ? Validator::ToNull() : $schoolUnitWorker->getWorker()->getTaxNumber(),
                                        "firstname"                 => Validator::IsNull($schoolUnitWorker->getWorker()->getFirstname()) ? Validator::ToNull() : $schoolUnitWorker->getWorker()->getFirstname(),
                                        "lastname"                  => Validator::IsNull($schoolUnitWorker->getWorker()->getLastname()) ? Validator::ToNull() : $schoolUnitWorker->getWorker()->getLastname(),
                                        "fathername"                => Validator::IsNull($schoolUnitWorker->getWorker()->getFathername()) ? Validator::ToNull() : $schoolUnitWorker->getWorker()->getFathername(),
                                        "sex"                       => Validator::IsNull($schoolUnitWorker->getWorker()->getSex()) ? Validator::ToNull() : $schoolUnitWorker->getWorker()->getSex(),
                                        "specialization_code_id"    => Validator::IsNull($schoolUnitWorker->getWorker()->getWorkerSpecialization()) ? Validator::ToNull() : $schoolUnitWorker->getWorker()->getWorkerSpecialization()->getWorkerSpecializationId(),
                                        "specialization_code_name"  => Validator::IsNull($schoolUnitWorker->getWorker()->getWorkerSpecialization()) ? Validator::ToNull() : $schoolUnitWorker->getWorker()->getWorkerSpecialization()->getName(),
                                        "worker_position_id"        => $schoolUnitWorker->getWorkerPosition()->getWorkerPositionId(),
                                        "worker_position_name"      => $schoolUnitWorker->getWorkerPosition()->getName(),
                                        "school_unit_id"            => $schoolUnitWorker->getSchoolUnit()->getSchoolUnitId(),
                                        "school_unit_name"          => $schoolUnitWorker->getSchoolUnit()->getName()
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