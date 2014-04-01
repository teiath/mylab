<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
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
 
function GetLabWorkers($lab, $worker_id, $worker_position, $worker_status, $pagesize, $page) {
    global $db;
    global $Options;
    global $app;
   
    $filter = array();
    $result = array();  

    $result["data"] = array();
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();

    try {
        
        //= Pages ==============================================================
        if (! $page)
            $page = 1;
        else if (intval($page) < 0)
	        throw new Exception(ExceptionMessages::InvalidPageNumber." : ".$page, ExceptionCodes::InvalidPageNumber);
        else if (!is_numeric($page))
	        throw new Exception(ExceptionMessages::InvalidPageType." : ".$page, ExceptionCodes::InvalidPageType);
        
        if (! $pagesize)
                $pagesize = $Options["PageSize"];
        else if (intval($pagesize) < 0)
	        throw new Exception(ExceptionMessages::InvalidPageSizeNumber." : ".$pagesize, ExceptionCodes::InvalidPageSizeNumber);
        else if (!is_numeric($pagesize))
	        throw new Exception(ExceptionMessages::InvalidPageSizeType." : ".$pagesize, ExceptionCodes::InvalidPageSizeType);
        else if ($pagesize > $Options["MaxPageSize"])
                throw new Exception(ExceptionMessages::InvalidPageSizeNumber." : ".$pagesize, ExceptionCodes::InvalidPageSizeNumber);

        $startat = ($page -1) * $pagesize;
        
           //= $worker_id ==================================================

            $oWorkers= new WorkersExt($db);

            $paramFilter = array();
            $arrayValues = preg_split("/[\s]*[,][\s]*/",$worker_id);

            foreach ($arrayValues as $worker_id)
            {
                $worker_id = trim($worker_id);

                if (is_numeric($worker_id))
                {
                    $paramFilter[] = new DFC(WorkersExt::FIELD_WORKER_ID, $worker_id, DFC::EXACT);
                }
                else if ($worker_id)
                {
                    $paramFilter[] = new DFC(WorkersExt::FIELD_WORKER_ID, $worker_id, DFC::EXACT);
                }
            }
           
            if ( count($paramFilter) > 0 )
            {
                $oWorkers->getAll($db, $paramFilter, false);
            } 
            
            $paramFilter = array();
            foreach ($oWorkers->getObjsArray() as $oWorker)
            {
                 $paramFilter[] = new DFC(LabWorkers::FIELD_WORKER_ID, $oWorker->getWorkerId(), DFC::EXACT);
            }
            
            if ( count($paramFilter) > 0 )
            {
                $filter[] = new DFCAggregate($paramFilter, false);
            }
            
        //= $lab ==================================================

            $oLabs = new LabsExt($db);

            $paramFilter = array();
            $arrayValues = preg_split("/[\s]*[,][\s]*/",$lab);

            foreach ($arrayValues as $lab)
            {
                $lab = trim($lab);

                if (is_numeric($lab))
                {
                    $paramFilter[] = new DFC(LabsExt::FIELD_LAB_ID, $lab, DFC::EXACT);
                }
                else if ($lab)
                {
                    $paramFilter[] = new DFC(LabsExt::FIELD_NAME, $lab, DFC::EXACT);
                }
            }
           
            if ( count($paramFilter) > 0 )
            {
                $oLabs->getAll($db, $paramFilter, false);
            } 
            
            $paramFilter = array();
            foreach ($oLabs->getObjsArray() as $oLab)
            {
                 $paramFilter[] = new DFC(LabWorkers::FIELD_LAB_ID, $oLab->getLabId(), DFC::EXACT);
            }
            
            if ( count($paramFilter) > 0 )
            {
                $filter[] = new DFCAggregate($paramFilter, false);
            }
                     
        //$worker_position==============================================================================
 
            $oWorkerPositions = new WorkerPositionsExt($db);
            $oWorkerPositions ->getAll($db);

            $paramFilter = array();
            $arrayValues = preg_split("/[\s]*[,][\s]*/", $worker_position);

            foreach ($arrayValues as $worker_position)
            {
                $worker_position = trim($worker_position);

                if (is_numeric($worker_position))
                {
                    $paramFilter[] = new DFC(LabWorkers::FIELD_WORKER_POSITION_ID, $worker_position, DFC::EXACT);
                }
                else if ($worker_position)
                {
                    $oWorkerPositions->searchArrayForValue($worker_position);
                    $paramFilter[] = new DFC(LabWorkers::FIELD_WORKER_POSITION_ID, $oWorkerPositions->getWorkerPositionId(), DFC::EXACT);
                }
            }

            if ( count($paramFilter) > 0 )
            {
                $filter[] = new DFCAggregate($paramFilter, false);
            } 
        
        //$worker_status=============================================================            
        
 
        $paramFilter = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/", $worker_status);

        foreach ($arrayValues as $worker_status)
        {
            $worker_status = trim($worker_status);

            if (($worker_status) && (!is_numeric($worker_status)))
            {
                throw new Exception(ExceptionMessages::InvalidWorkerStatusValue." : ".$worker_status, ExceptionCodes::InvalidWorkerStatusValue);
            }
            else if (is_numeric($worker_status))
            {
                $paramFilter[] = new DFC(LabWorkersExt::FIELD_WORKER_STATUS, $worker_status, DFC::EXACT);
            }
        }

        if ( count($paramFilter) > 0 )
        {
            $filter[] = new DFCAggregate($paramFilter, false);
        }
            
            
        //==============================================================================        
  
        $oWorkerSpecializations = new WorkerSpecializationsExt($db);
        $oWorkerSpecializations->getAll($db);
        
        
        $sort = array( new DSC(LabWorkers::FIELD_WORKER_ID, DSC::ASC),
                       new DSC(LabWorkers::FIELD_LAB_ID, DSC::ASC),
                       new DSC(LabWorkers::FIELD_WORKER_POSITION_ID, DSC::ASC)
                      );

        $oLabWorkers = new LabWorkersExt($db);
        $totalRows = $oLabWorkers->findByFilterAsCount($db, $filter, true);
        $result["total"] = $totalRows[0]->getLabWorkerId();
        
        if ($pagesize)        
            $countRows = $oLabWorkers->findByFilterWithLimit($db, $filter, true, $sort, $startat, $pagesize);
        else
            $countRows = $oLabWorkers->findByFilter($db, $filter, true, $sort);
        
        $result["count"] = count( $countRows );
        
        if ($countRows) {         
        $LabsFilter = array();
        $workerFilter = array();

        foreach ($countRows as $rows)
        {                
            $LabsFilter[] = new DFC(LabsExt::FIELD_LAB_ID, $rows->getLabId(), DFC::EXACT);
            $workerFilter[] = new DFC(WorkersExt::FIELD_WORKER_ID, $rows->getWorkerId(), DFC::EXACT);
        }

      //  $LabsFilter = array_unique($LabsFilter,SORT_REGULAR);
      //  $workerFilter = array_unique($workerFilter,SORT_REGULAR);
      //  
//        $counter =count($workerFilter);
//        $check = array_unique($workerFilter,SORT_REGULAR);
//        $found = ($counter != $check) ? false:true;
//        $result["dsbvcds"]= array_values($check);
        
        $oLabs->getAll($db, Validator::ToUniqueObject($LabsFilter), false); 
        $oWorkers->getAll($db, Validator::ToUniqueObject($workerFilter), false); 
            
        foreach ($countRows as $row)
        {        
            
             $data = array( "lab_worker_id"=> $row->getLabWorkerId(),
                            "worker_id" => $row->getWorkerId(),
                            "worker_registry_no" => $oWorkers->searchArrayForID( $row->getWorkerId() )->getRegistryNo(),
                            "lab_id" => $row->getLabId(),
                            "lab" => $oLabs->searchArrayForID( $row->getLabId())->getName(),
                            "worker_position_id" => $row->getWorkerPositionId(),
                            "worker_position" => $oWorkerPositions->searchArrayForID( $row->getWorkerPositionId())->getName(),
                            "worker_email" => $row->getWorkerEmail(),
                            "worker_status" => $row->getWorkerStatus(),
                            "worker_start_service" => $row->getWorkerStartService()
                  );
             
            //$data["worker_details"] = null;
            $data_workers["worker_details"] = null;
            foreach ($oWorkers->getObjsArray() as $oWorker){
               if ($row->getWorkerId()==$oWorker->getWorkerId()) {
                    //$oWorker = $oWorkers->findById($db,$row->getWorkerId()); -->>if used this , you have many many queries!!!!!!
                    
                    //$data["worker_details"][] = array( "worker_id" => $oWorker->getWorkerId(),
                    $data_workers = array( "workers.worker_id" => $oWorker->getWorkerId(),
                                                "registry_no" => $oWorker->getRegistryNo(),
                                                "tax_number" => $oWorker->getTaxNumber(),
                                                "firstname" => $oWorker->getFirstname(),
                                                "lastname" => $oWorker->getLastname(),
                                                "fathername" => $oWorker->getFathername(),
                                                "sex" => $oWorker->getSex(),
                                                "specialization_code" => $oWorkerSpecializations->searchArrayForID( $oWorker->getWorkerSpecializationId() )->getName()
                                );
                }
            }
        //$result["data"][] = $data;
        $result["data"][] = array_merge($data,$data_workers);
        }
        
        }else {
            $result["data"] = $data; 
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