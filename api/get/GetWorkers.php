<?php
 
header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @param type $specialization_code
 * @param type $employment_relationship
 * @param type $pagesize
 * @param int $page
 * @return string
 * @throws Exception
 */

function GetWorkers($registry_no, $worker_specialization, $lastname, $worker, $pagesize, $page) {
    global $db;
    global $app;
    
    $filter = array();
    $result = array();  

    $result["data"] = array();
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    
    try {
        
//$page - $pagesize=============================================================

        
//        if (! $page)
//            $page = 1;
//        else if (intval($page) < 0)
//	        throw new Exception(ExceptionMessages::InvalidPageNumber." : ".$page, ExceptionCodes::InvalidPageNumber);
//        else if (!is_numeric($page))
//	        throw new Exception(ExceptionMessages::InvalidPageType." : ".$page, ExceptionCodes::InvalidPageType);
//        
//        if (! $pagesize)
//            $pagesize = $Options["PageSize"];
//        else if (intval($pagesize) < 0)
//	        throw new Exception(ExceptionMessages::InvalidPageSizeNumber." : ".$pagesize, ExceptionCodes::InvalidPageSizeNumber);
//        else if (!is_numeric($pagesize))
//	        throw new Exception(ExceptionMessages::InvalidPageSizeType." : ".$pagesize, ExceptionCodes::InvalidPageSizeType);
//        else if ($pagesize > $Options["MaxPageSize"])
//                throw new Exception(ExceptionMessages::InvalidPageSizeNumber." : ".$pagesize, ExceptionCodes::InvalidPageSizeNumber);
//    
        $page = Pagination::Page($page);
        $pagesize = Pagination::Pagesize($pagesize);
        $startat = Pagination::StartPagesizeFrom($page, $pagesize);

//$registry_number==============================================================
        
        $paramFilter = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/", $registry_no);

        foreach ($arrayValues as $registry_no)
        {
            $registry_no = trim($registry_no);

            if (($registry_no) && (!is_numeric($registry_no)))
            {
                throw new Exception(ExceptionMessages::InvalidRegistryNumberValue." : ".$registry_no, ExceptionCodes::InvalidRegistryNumberValue);
            }
            else if (is_numeric($registry_no))
            {
                $paramFilter[] = new DFC(WorkersExt::FIELD_REGISTRY_NO, $registry_no, DFC::EXACT);
            }
        }

        if ( count($paramFilter) > 0 )
        {
            $filter[] = new DFCAggregate($paramFilter, false);
        }
                 
        //= $worker_specialization  =======================================================
        $oWorkerSpecializations = new WorkerSpecializationsExt($db);
        $oWorkerSpecializations->getAll($db);
        
        $paramFilter = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/", $worker_specialization);

        foreach ($arrayValues as $worker_specialization)
        {
            $worker_specialization = trim($worker_specialization);
            
            if (is_numeric($worker_specialization))
            {
                $paramFilter[] = new DFC(WorkersExt::FIELD_WORKER_SPECIALIZATION_ID, $worker_specialization, DFC::EXACT);
            }
            else if ($worker_specialization)
            {
                $oWorkerSpecializations->searchArrayForValue($worker_specialization);
                $paramFilter[] = new DFC(WorkersExt::FIELD_WORKER_SPECIALIZATION_ID, $oWorkerSpecializations->getWorkerSpecializationId(), DFC::EXACT);
            }
        }
        
        if ( count($paramFilter) > 0 )
        {
            $filter[] = new DFCAggregate($paramFilter, false);
        } 
        
        //= $lastname ==========================================================
        $paramFilter = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/", $lastname);

        foreach ($arrayValues as $lastname)
        {
            $lastname = trim($lastname);

            if (($lastname) && (is_numeric($lastname)))
            {
                throw new Exception(ExceptionMessages::InvalidLastNameValue." : ".$lastname, ExceptionCodes::InvalidLastNameValue);
            }
            else if ($lastname)
            {
                $paramFilter[] = new DFC(WorkersExt::FIELD_LASTNAME, $lastname, DFC::EXACT);
            }
        }

        if ( count($paramFilter) > 0 )
        {
            $filter[] = new DFCAggregate($paramFilter, false);
        }        
        
        //= $worker ==========================================================
        if ($worker){
            
            $paramFilter = array();
            $arrayValues = preg_split("/[\s]*[,][\s]*/", $worker);

            foreach ($arrayValues as $worker)
            {
                $worker = trim($worker);

                if (is_numeric($worker))
                {
                    $paramFilter[] = new DFC(WorkersExt::FIELD_REGISTRY_NO, $worker, DFC::BEGINS_WITH);
                }
                else 
                {
                    $paramFilter[] = new DFC(WorkersExt::FIELD_LASTNAME, $worker, DFC::BEGINS_WITH);
                }
            }

            if ( count($paramFilter) > 0 )
            {
                $filter[] = new DFCAggregate($paramFilter, false);
            }
        
        }
        //==============================================================================
     

        $sort = array( new DSC(WorkersExt::FIELD_REGISTRY_NO, DSC::ASC) );

        $oWorkers = new WorkersExt($db);
        $totalRows = $oWorkers->findByFilterAsCount($db, $filter, true);
        $result["total"] = $totalRows[0]->getWorkerId();
        
        $maxPage = Pagination::checkMaxPage($result["total"],$page,$pagesize);
        
    //    if ($pagesize)
            $countRows = $oWorkers->findByFilterWithLimit($db, $filter, true, $sort, $startat, $pagesize);
     //   else
     //       $countRows = $oLabResponsibles->findByFilter($db, $filter, true, $sort);
        
        $result["count"] = count( $countRows );

        foreach ($countRows as $row) {
            $result["data"][] = array("worker_id" => $row->getWorkerId(), 
                                      "registry_no" => $row->getRegistryNo(),
                                      "tax_number" => $row->getTaxNumber(),
                                      "firstname" => $row->getFirstname(),
                                      "lastname" => $row->getLastname(),
                                      "fathername" => $row->getFathername(),
                                      "sex" => $row->getSex(),
                                      "worker_specialization" => $oWorkerSpecializations->searchArrayForID( $row->getWorkerSpecializationId() )->getName()
                                      //"employment_relationship" => $oEmploymentRelationships->searchArrayForID( $row->getEmploymentRelationshipId() )->getName()
                                );
        }
        
        $pagination = array(
            "page" => $page,
            "maxPage" => $maxPage,
            "pagesize" => $pagesize
        ); 
        
        $result["pagination"]=$pagination;
        $result["status"] = ExceptionCodes::NoErrors;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".ExceptionMessages::NoErrors;
    } catch (Exception $e) {
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
} 

?>