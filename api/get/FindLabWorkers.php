<?php
/**
 *
 * @version 2.0
 * @author  ΤΕΙ Αθήνας
 * @package GET
 */
 
header("Content-Type: text/html; charset=utf-8");

function FindLabWorkers ( $lab_worker_id, $worker_status, $worker_start_service,
                          $lab_id, $lab_name, $submitted, $worker_position, $lab_worker, $lab_worker_uid,
                          $lab_type, $school_unit_id, $school_unit_name, $lab_state,                      
                          $region_edu_admin, $edu_admin, $transfer_area, $municipality, $prefecture,
                          $education_level, $school_unit_type, $school_unit_state, 
                          $pagesize, $page, $orderby, $ordertype, $searchtype, $export ) {

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
//    $permissions = UserRoles::getUserPermissions($app->request->user);
//
//    if (Validator::IsNull($permissions['permit_labs'])){
//        throw new Exception(ExceptionMessages::NoPermissionsError, ExceptionCodes::NoPermissionsError);     
//    }else { 
//        $permit_labs = $permissions['permit_labs'];
//    }      
 
//$page - $pagesize - $searchtype - $ordertype =================================
       $page = Pagination::getPage($page, $params);
       $pagesize = Pagination::getPagesize($pagesize, $params);     
       $searchtype = Filters::getSearchType($searchtype, $params);
       $ordertype =  Filters::getOrderType($ordertype, $params);
   
//$orderby======================================================================
       $columns = array(
                            "lw.labWorkerId"        => "lab_worker_id",
                            "lw.workerStatus"       => "lab_worker_name",
                            "mlw.workerId"          => "mylab_worker_id",
                            "l.labId"               => "lab_id",
                            "l.name"                => "lab_name",     
                            "su.schoolUnitId"       => "school_unit_id",
                            "su.name"               => "school_unit_name",
                            "sus.stateId"           => "state_id",
                            "sus.name"              => "state_name",
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "mylab_worker_id";
        else
        {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
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
        
        //get count of mylabWorkers with DICTINCT value
        $qb->select('mlw.workerId')->distinct();     
        $qb->from('LabWorkers', 'lw');   
        $qb->leftjoin('lw.lab', 'l')->leftjoin('lw.worker', 'mlw')->leftjoin('lw.workerPosition', 'wp')->leftjoin('l.schoolUnit', 'su')
           ->leftjoin('l.state', 's')->leftjoin('l.labType', 'lt')->leftjoin('l.labSource', 'ls')->leftjoin('su.regionEduAdmin', 'rea')
           ->leftjoin('su.eduAdmin', 'ea')->leftjoin('su.transferArea', 'ta')->leftjoin('su.municipality', 'm')->leftjoin('su.prefecture', 'p')
           ->leftjoin('su.educationLevel', 'el')->leftjoin('su.schoolUnitType', 'sut')->leftjoin('su.state', 'sus');     
        $qb->orderBy(array_search($orderby, $columns), $ordertype);
        $query = $qb->getQuery();
             
        //pagination and results========================================================      
        $query->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $query->setMaxResults($pagesize) : null;
        $workerResults = $query->getResult();
        $result["total"] = count($workerResults);
        
        //create array with lab_workers ids
        if ($result["total"]>0) {
            $prefix = '';$worker_ids ='';
            foreach ($workerResults as $workerResult)
            {
                $worker_ids .= $prefix . $workerResult['workerId'];
                $prefix = ', ';
            }                       
        } else {
            throw new Exception(ExceptionMessages::InvalidLabWorkerValue,ExceptionCodes::ReferencesEquipmentTypeLabEquipmentTypes);  
        }
        
       // var_dump($worker_ids);die();
 //==============================================================================
        //======================================================================
        
        //print_r($worker_ids);
        $iqb = $entityManager->createQueryBuilder();
        $iqb->select('mlw.workerId,mlw.registryNo,mlw.uid,mlw.firstname,mlw.lastname,mlw.fathername,mlw.fathername,mlw.email,
                      mlwws.workerSpecializationId,mlwws.name as workerSpecializationName,
                      mlwls.labSourceId as workerLabSourceId,mlwls.name as workerLabSourceName');
        $iqb->from('MylabWorkers','mlw');
        $iqb->leftjoin('mlw.workerSpecialization', 'mlwws')->
              leftjoin('mlw.labSource', 'mlwls');
        $iqb->where($iqb->expr()->in('mlw.workerId', $worker_ids));
        
        $iquery = $iqb->getQuery();
        $iworkerResults = $iquery->getResult();

            
        
 ////data results==================================================================              
        $count = 0;
        foreach ($iworkerResults as $workerResult1) { 
           $test[] = array ('worker_id' => $workerResult1['workerId'],
                            'registry_no' => $workerResult1['registryNo'],
                            'uid' => $workerResult1['uid'],
                            'firstname' => $workerResult1['firstname'],
                            'lastname' => $workerResult1['lastname'],
                            'fathername' => $workerResult1['fathername'],
                            'email' => $workerResult1['email'],
                            'workerSpecializationId' => $workerResult1['workerSpecializationId'],
                            'workerSpecializationName' => $workerResult1['workerSpecializationName'],
                            'workerLabSourceId' => $workerResult1['workerLabSourceId'],
                            'workerLabSourceName' => $workerResult1['workerLabSourceName']              
                            );
          
            $count++;
        }
        $result["data"] = $test;
        
        $result["count"] = $count;
         //print_r($result);
        

          
//pagination results============================================================     
        $maxPage = Pagination::getMaxPage($result["total"],$page,$pagesize);
        $pagination = array( "page" => $page,   
                             "maxPage" => $maxPage, 
                             "pagesize" => $pagesize 
                            );    
        $result["pagination"] = $pagination;
       
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