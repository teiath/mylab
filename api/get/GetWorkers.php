<?php
 
header("Content-Type: text/html; charset=utf-8");

function GetWorkers($worker, 
                    $registry_no, $tax_number, $firstname, $lastname, $fathername, $sex,
                    $worker_specialization, 
                    $pagesize, $page , $orderby, $ordertype, $searchtype) {
  
    global $entityManager, $app;

    $qb = $entityManager->createQueryBuilder();
    $result = array();  

    $result["data"] = array();   
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    
    try {
        
//$page - $pagesize - $searchtype - $ordertype =================================
       $page = Pagination::getPage($page, $params);
       $pagesize = Pagination::getPagesize($pagesize, $params);     
       $searchtype = Filters::getSearchType($searchtype, $params);
       $ordertype =  Filters::getOrderType($ordertype, $params);
               
//$orderby======================================================================
       $columns = array(
            "w.workerId" => "worker_id",
            "w.registryNo" => "registry_no",
            "w.taxNumber" => "tax_number" ,
            "w.firstname" => "firstname",
            "w.lastname" => "lastname",
            "w.fathername" => "fathername",
            "w.sex" => "sex",
            "ws.bandwidth" => "worker_specialization",
            "ws.name" => "worker_specialization_name",
             );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "worker_id";
        else
        {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        }
                      
//$worker=======================================================================
if (Validator::Exists('worker', $params)){
    Filters::setFilter($qb, $worker, "w", "workerId", "workerId", "null,id", ExceptionMessages::InvalidWorkerIDType, ExceptionCodes::InvalidWorkerIDType);
} 

//$registry_number==============================================================
if (Validator::Exists('registry_no', $params)){
    Filters::setFilter($qb, $registry_no, "w", "registryNo", "registryNo", "null,numeric", ExceptionMessages::InvalidRegistryNumberValue, ExceptionCodes::InvalidRegistryNumberValue);    
}
//$tax_number===================================================================
if (Validator::Exists('tax_number', $params)){
    Filters::setFilter($qb, $tax_number, "w", "taxNumber", "taxNumber", "null,numeric", ExceptionMessages::InvalidTaxNumberType, ExceptionCodes::InvalidTaxNumberType);    
} 

//$firstname====================================================================
if (Validator::Exists('firstname', $params)){
    Filters::setSearchFilter($qb, $firstname, "w", "firstname", $searchtype, ExceptionMessages::InvalidFirstNameValue, ExceptionCodes::InvalidFirstNameValue);    
} 

//$lastname=====================================================================
if (Validator::Exists('lastname', $params)){
    Filters::setSearchFilter ($qb, $lastname, "w", "lastname", $searchtype, ExceptionMessages::InvalidLastNameValue, ExceptionCodes::InvalidLastNameValue);
}  

//$fathername===================================================================
if (Validator::Exists('fathername', $params)){
    Filters::setSearchFilter($qb, $fathername, "w", "fathername", $searchtype, ExceptionMessages::InvalidLastNameValue, ExceptionCodes::InvalidLastNameValue);    
} 

//$sex==========================================================================
if (Validator::Exists('sex', $params)){
    Filters::setFilter($qb, $sex, "w", "sex", "sex", "null,value", ExceptionMessages::InvalidSexValue, ExceptionCodes::InvalidSexValue);    
} 

//= $worker_specialization  ====================================================
if (Validator::Exists('worker_specialization', $params)){
    Filters::setFilter($qb, $worker_specialization, "ws", "workerSpecializationId", "name", "null,id,value", ExceptionMessages::InvalidWorkerSpecializationType, ExceptionCodes::InvalidWorkerSpecializationType);    
}  
             
//execution=====================================================================
        $qb->select('w');
        $qb->from('Workers', 'w');
        $qb->leftjoin('w.workerSpecialization', 'ws');        
        $qb->orderBy(array_search($orderby, $columns), $ordertype);

//results=======================================================================      
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        $results->getQuery()->setFirstResult($pagesize * ($page-1));
        $results->getQuery()->setMaxResults($pagesize);

//data==========================================================================       
        $count = 0;
        foreach ($results as $worker)
        {

            $result["data"][] = array(
               "worker_id"        => $worker->getWorkerId(),
               "registry_no"      => $worker->getRegistryNo(),
               "tax_number"       => $worker->getTaxNumber(),
               "firstname"        => $worker->getFirstname(),
               "lastname"         => $worker->getLastname(),
               "fathername"       => $worker->getFathername(),
               "sex"              => $worker->getSex(),
               "worker_specialization"      => Validator::IsNull($worker->getWorkerSpecialization()) ? Validator::ToNull() : $worker->getWorkerSpecialization()->getWorkerSpecializationId(),
               "worker_specialization_name" => Validator::IsNull($worker->getWorkerSpecialization()) ? Validator::ToNull() : $worker->getWorkerSpecialization()->getName(),
            );
            $count++;
        }
        $result["count"] = $count;
   
//pagination====================================================================     
        $maxPage = Pagination::checkMaxPage($result["total"],$page,$pagesize);
        $pagination = array( "page" => $page, "maxPage" => $maxPage, "pagesize" => $pagesize );    
        $result["pagination"]=$pagination;
        
  //debug=======================================================================
        if ( Validator::IsTrue( $params["debug"]  ) )
        {
             $result["DQL"] =  trim(preg_replace('/\s\s+/', ' ', $qb->getDQL()));
             $result["SQL"] =  trim(preg_replace('/\s\s+/', ' ', $qb->getQuery()->getSQL()));
        }
    
        
        $result["status"] = ExceptionCodes::NoErrors;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".ExceptionMessages::NoErrors;
    } catch (Exception $e) {
        $result["status"] = $e->getCode();

        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    
    return $result;
} 
?>