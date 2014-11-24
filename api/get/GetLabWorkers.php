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
 * @param type $lab_worker_id
 * @param type $worker_status
 * @param type $worker_start_service
 * @param type $worker_id
 * @param type $worker_position
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
 
function GetLabWorkers( $lab_worker_id, $worker_status, $worker_start_service,
                        $worker_id, $worker_position, $lab_id, $lab_name,
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
                            "lw.labWorkerId" => "lab_worker_id",
                            "lw.workerStatus" => "worker_status",
                            "lw.workerStartService" => "worker_start_service",
                            "mlw.workerId" => "worker_id",
                            "wp.workerPositionId" => "worker_position_id",
                            "wp.name" => "worker_position_name",
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
    
//$lab_worker_id================================================================
    if (Validator::Exists('lab_worker_id', $params)){
        CRUDUtils::setFilter($qb, $lab_worker_id, "lw", "labWorkerId", "labWorkerId", "id", ExceptionMessages::InvalidLabWorkerIDType, ExceptionCodes::InvalidLabWorkerIDType);
    } 
      
//$worker_status================================================================
    if (Validator::Exists('worker_status', $params)){
        CRUDUtils::setFilter($qb, $worker_status, "lw", "workerStatus", "workerStatus", "numeric", ExceptionMessages::InvalidLabWorkerStatusType, ExceptionCodes::InvalidLabWorkerStatusType);
    }   
         
//$worker_start_service=========================================================
    if (Validator::Exists('worker_start_service', $params)){
        CRUDUtils::setFilter($qb, $worker_start_service, "lw", "workerStartService", "workerStartService", "date", ExceptionMessages::InvalidLabWorkerStartServiceType, ExceptionCodes::InvalidLabWorkerStartServiceType);
    } 
  
//$worker_id====================================================================
    if (Validator::Exists('worker_id', $params)){
        CRUDUtils::setFilter($qb, $worker_id, "mlw", "workerId", "workerId", "id", ExceptionMessages::InvalidMylabWorkerIDType, ExceptionCodes::InvalidMylabWorkerIDType);
    } 
    
//$worker_position==============================================================
    if (Validator::Exists('worker_position', $params)){
        CRUDUtils::setFilter($qb, $worker_position, "wp", "workerPositionId", "name", "id,value", ExceptionMessages::InvalidWorkerPositionType, ExceptionCodes::InvalidWorkerPositionType);
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

        $qb->select('lw');
        $qb->from('LabWorkers', 'lw');
        $qb->leftjoin('lw.worker', 'mlw');
        $qb->leftjoin('lw.workerPosition', 'wp');
        $qb->leftjoin('mlw.workerSpecialization', 'ws');
        $qb->leftjoin('lw.lab', 'l');
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
        foreach ($results as $labworker)
        {

            $result["data"][] = array(              
                                        "lab_worker_id"         => $labworker->getLabWorkerId(),
                                        "worker_email"          => $labworker->getWorkerEmail(),
                                        "worker_status"         => $labworker->getWorkerStatus(),
                                        "worker_start_service"  => $labworker->getWorkerStartService()->format('Y-m-d'),
                                        "worker_id"             => $labworker->getWorker()->getWorkerId(),
                                        "worker_registry_no"    => $labworker->getWorker()->getRegistryNo(),
                                        "uid"                   => $labworker->getWorker()->getUid(),
                                        "firstname"             => Validator::IsNull($labworker->getWorker()->getFirstname()) ? Validator::ToNull() : $labworker->getWorker()->getFirstname(),
                                        "lastname"              => Validator::IsNull($labworker->getWorker()->getLastname()) ? Validator::ToNull() : $labworker->getWorker()->getLastname(),
                                        "fathername"            => Validator::IsNull($labworker->getWorker()->getFathername()) ? Validator::ToNull() : $labworker->getWorker()->getFathername(),
                                        "specialization_code_id"     => Validator::IsNull($labworker->getWorker()->getWorkerSpecialization()) ? Validator::ToNull() : $labworker->getWorker()->getWorkerSpecialization()->getWorkerSpecializationId(),
                                        "specialization_code_name"   => Validator::IsNull($labworker->getWorker()->getWorkerSpecialization()) ? Validator::ToNull() : $labworker->getWorker()->getWorkerSpecialization()->getName(),
                                        "worker_position_id"         => $labworker->getWorkerPosition()->getWorkerPositionId(),
                                        "worker_position_name"       => $labworker->getWorkerPosition()->getName(),
                                        "lab_id"                => $labworker->getLab()->getLabId(),
                                        "lab_name"              => $labworker->getLab()->getName()
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