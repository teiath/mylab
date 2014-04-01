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
 * @param type $pagesize
 * @param int $page
 * @return string
 * @throws Exception
 */
function GetWorkerPositions($pagesize, $page) {
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
        $pagesize = 0;
        
        //==============================================================================

        $sort = array( new DSC(WorkerPositionsExt::FIELD_NAME, DSC::ASC) );

        $oWorkerPositions = new WorkerPositionsExt($db);
        $totalRows = $oWorkerPositions->findByFilterAsCount($db, $filter, true);
        $result["total"] = $totalRows[0]->getWorkerPositionId();
        
        if ($pagesize)
            $countRows = $oWorkerPositions->findByFilterWithLimit($db, $filter, true, $sort, $startat, $pagesize);
        else
            $countRows = $oWorkerPositions->findByFilter($db, $filter, true, $sort);
        
        $result["count"] = count( $countRows );

        foreach ($countRows as $row) {
            $result["data"][] = array("worker_position_id" => $row->getWorkerPositionId(), 
                                      "name" => $row->getName()
                                );
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