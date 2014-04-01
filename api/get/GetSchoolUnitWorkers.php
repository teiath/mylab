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
 
function GetSchoolUnitWorkers($school_unit, $worker, $worker_position, $pagesize, $page) {
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
        
           //= $worker ==================================================

            $oWorkers= new WorkersExt($db);

            $paramFilter = array();
            $arrayValues = preg_split("/[\s]*[,][\s]*/",$worker);

            foreach ($arrayValues as $worker)
            {
                $worker = trim($worker);

                if (is_numeric($worker))
                {
                    $paramFilter[] = new DFC(WorkersExt::FIELD_WORKER_ID, $worker, DFC::EXACT);
                }
                else if ($worker)
                {
                    $paramFilter[] = new DFC(WorkersExt::FIELD_WORKER_ID, $worker, DFC::EXACT);
                }
            }
           
            if ( count($paramFilter) > 0 )
            {
                $oWorkers->getAll($db, $paramFilter, false);
            } 
            
            $paramFilter = array();
            foreach ($oWorkers->getObjsArray() as $oWorker)
            {
                 $paramFilter[] = new DFC(SchoolUnitWorkersExt::FIELD_WORKER_ID, $oWorker->getWorkerId(), DFC::EXACT);
            }
            
            if ( count($paramFilter) > 0 )
            {
                $filter[] = new DFCAggregate($paramFilter, false);
            }
            
        //= $school_unit ==================================================
        $oSchoolUnits = new SchoolUnitsExt($db);

        if ($school_unit){
        
        $paramFilter = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/",$school_unit);

        foreach ($arrayValues as $school_unit)
        {
            $school_unit = trim($school_unit);

            if (is_numeric($school_unit))
            {
                $paramFilter[] = new DFC(SchoolUnitsExt::FIELD_SCHOOL_UNIT_ID, $school_unit, DFC::EXACT);
            }
            else if ($school_unit)
            {
                $paramFilter[] = new DFC(SchoolUnitsExt::FIELD_NAME, $school_unit, DFC::EXACT);
            }
        }
        
        
        if ( count($paramFilter) > 0 )
        {
            $oSchoolUnits->getAll($db, $paramFilter, false);
        } 

       if (count($oSchoolUnits->getObjsArray()) != 0 ) {

            $paramFilter = array();
            foreach ($oSchoolUnits->getObjsArray() as $oSchoolUnit)
            {  
                 $paramFilter[] = new DFC(SchoolUnitWorkersExt::FIELD_SCHOOL_UNIT_ID, $oSchoolUnit->getSchoolUnitId(), DFC::EXACT); 
            }
       } else {
             $paramFilter[] = new DFC(SchoolUnitWorkersExt::FIELD_SCHOOL_UNIT_ID, "0", DFC::EXACT);
        }
            
        //if ( count($paramFilter) > 0 )
       // {
            $filter[] = $school_unit_filter[] = new DFCAggregate($paramFilter, false);
                      
        //}

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
                    $paramFilter[] = new DFC(SchoolUnitWorkersExt::FIELD_WORKER_POSITION_ID, $worker_position, DFC::EXACT);
                }
                else if ($worker_position)
                {
                    $oWorkerPositions->searchArrayForValue($worker_position);
                    $paramFilter[] = new DFC(SchoolUnitWorkersExt::FIELD_WORKER_POSITION_ID, $oWorkerPositions->getWorkerPositionId(), DFC::EXACT);
                }
            }

            if ( count($paramFilter) > 0 )
            {
                $filter[] = new DFCAggregate($paramFilter, false);
            } 
        
        //==============================================================================        
  
        $sort = array( new DSC(SchoolUnitWorkersExt::FIELD_WORKER_ID, DSC::ASC),
                       new DSC(SchoolUnitWorkersExt::FIELD_SCHOOL_UNIT_ID, DSC::ASC),
                       new DSC(SchoolUnitWorkersExt::FIELD_WORKER_POSITION_ID, DSC::ASC)
                      );

        $oSchoolUnitWorkers = new SchoolUnitWorkersExt($db);
        $totalRows = $oSchoolUnitWorkers->findByFilterAsCount($db, $filter, true);
        $result["total"] = $totalRows[0]->getSchoolUnitWorkerId();
        
        if ($pagesize)        
            $countRows = $oSchoolUnitWorkers->findByFilterWithLimit($db, $filter, true, $sort, $startat, $pagesize);
        else
            $countRows = $oSchoolUnitWorkers->findByFilter($db, $filter, true, $sort);
        
        $result["count"] = count( $countRows );
        
        if ($countRows) {         
        $schoolUnitsFilter = array();
        $workerFilter = array();

        foreach ($countRows as $rows)
        {                
            $schoolUnitsFilter[] = new DFC(SchoolUnitsExt::FIELD_SCHOOL_UNIT_ID, $rows->getSchoolUnitId(), DFC::EXACT);
            $workerFilter[] = new DFC(WorkersExt::FIELD_WORKER_ID, $rows->getWorkerId(), DFC::EXACT);
        }

        $oSchoolUnits->getAll($db, $schoolUnitsFilter, false); 
        $oWorkers->getAll($db, $workerFilter, false); 
            
        foreach ($countRows as $row)
        {        
            
             $data = array( "school_unit_worker_id"=> $row->getSchoolUnitWorkerId(),
                            "worker_id" => $row->getWorkerId(),
                            "worker" => $oWorkers->searchArrayForID($row->getWorkerId())->getRegistryNo(),
                            "school_unit_id" => $row->getSchoolUnitId(),
                            "school_unit" => $oSchoolUnits->searchArrayForID( $row->getSchoolUnitId())->getName(),
                            "worker_position_id" => $row->getWorkerPositionId(),
                            "worker_position" => $oWorkerPositions->searchArrayForID( $row->getWorkerPositionId())->getName()
                  );
        $result["data"][] = $data;
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