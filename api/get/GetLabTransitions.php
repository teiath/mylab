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
 
function GetLabTransitions($lab, $pagesize, $page) {
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
                 $paramFilter[] = new DFC(LabTransitionsExt::FIELD_LAB_ID, $oLab->getLabId(), DFC::EXACT);
            }
            
            if ( count($paramFilter) > 0 )
            {
                $filter[] = new DFCAggregate($paramFilter, false);
            }
     
        
        //==============================================================================        
        $oStates = new StatesExt($db);
        $oStates ->getAll($db);
        
        $sort = array( new DSC(LabTransitionsExt::FIELD_LAB_ID, DSC::ASC));

        $oLabTransitions = new LabTransitionsExt($db);
        $totalRows = $oLabTransitions->findByFilterAsCount($db, $filter, true);
        $result["total"] = $totalRows[0]->getLabTransitionId();
        
        if ($pagesize)        
            $countRows = $oLabTransitions->findByFilterWithLimit($db, $filter, true, $sort, $startat, $pagesize);
        else
            $countRows = $oLabTransitions->findByFilter($db, $filter, true, $sort);
        
        $result["count"] = count( $countRows );
        
        if ($countRows) {         
      //  $schoolUnitsFilter = array();
        $labsFilter = array();

        foreach ($countRows as $rows)
        {                
          //  $schoolUnitsFilter[] = new DFC(SchoolUnitsExt::FIELD_SCHOOL_UNIT_ID, $rows->getSchoolUnitId(), DFC::EXACT);
            $labsFilter[] = new DFC(LabsExt::FIELD_LAB_ID, $rows->getLabId(), DFC::EXACT);
        }

       // $oSchoolUnits->getAll($db, $schoolUnitsFilter, false); 
        $oLabs->getAll($db, $labsFilter, false); 
            
        foreach ($countRows as $row)
        {        
            
             $data = array( "lab_transition_id"=> $row->getLabTransitionId(),
                            "lab_id" => $row->getLabId(),
                            "from_state_id" => $row->getFromState(),
                            "from_state" => $oStates->searchArrayForID($row->getFromState())->getName(),
                            "to_state_id" => $row->getToState(),
                            "to_state" => $oStates->searchArrayForID($row->getToState())->getName(),
                            "transition_date" => $row->getTransitionDate(),
                            "transition_justification" => $row->getTransitionJustification(),
                            "transition_source" => $row->getTransitionSource()
                 
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