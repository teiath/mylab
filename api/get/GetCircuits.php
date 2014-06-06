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
 
function GetCircuits($school_unit, $circuit_type, $phone_number, $circuit, $pagesize, $page) {
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
                 $paramFilter[] = new DFC(CircuitsExt::FIELD_SCHOOL_UNIT_ID, $oSchoolUnit->getSchoolUnitId(), DFC::EXACT); 
            }
       } else {
             $paramFilter[] = new DFC(CircuitsExt::FIELD_SCHOOL_UNIT_ID, "0", DFC::EXACT);
        }
            
        //if ( count($paramFilter) > 0 )
       // {
            $filter[] = $school_unit_filter[] = new DFCAggregate($paramFilter, false);
                      
        //}

        }
                     
        //$circuit_type==============================================================================
 
            $oCircuitTypes = new CircuitTypesExt($db);
            $oCircuitTypes ->getAll($db);

            $paramFilter = array();
            $arrayValues = preg_split("/[\s]*[,][\s]*/", $circuit_type);

            foreach ($arrayValues as $circuit_type)
            {
                $circuit_type = trim($circuit_type);

                if (is_numeric($circuit_type))
                {
                    $paramFilter[] = new DFC(CircuitsExt::FIELD_CIRCUIT_TYPE_ID, $circuit_type, DFC::EXACT);
                }
                else if ($circuit_type)
                {
                    $oCircuitTypes->searchArrayForValue($circuit_type);
                    $paramFilter[] = new DFC(CircuitsExt::FIELD_CIRCUIT_TYPE_ID, $oCircuitTypes->getCircuitTypeId(), DFC::EXACT);
                }
            }

            if ( count($paramFilter) > 0 )
            {
                $filter[] = new DFCAggregate($paramFilter, false);
            } 
        
    //$phone_number==============================================================
        
        $paramFilter = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/", $phone_number);

        foreach ($arrayValues as $phone_number)
        {
            $phone_number = trim($phone_number);

            if (($phone_number) && (!is_numeric($phone_number)))
            {
                throw new Exception(ExceptionMessages::InvalidPhoneNumberValue." : ".$phone_number, ExceptionCodes::InvalidPhoneNumberValue);
            }
            else if (is_numeric($phone_number))
            {
                $paramFilter[] = new DFC(CircuitsExt::FIELD_PHONE_NUMBER, $phone_number, DFC::EXACT);
            }
        }

        if ( count($paramFilter) > 0 )
        {
            $filter[] = new DFCAggregate($paramFilter, false);
        }
        
        //= $circuit ==========================================================
        if ($circuit){
            
            $school_unit=$circuit;
            
        $paramFilter = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/",$school_unit);

        foreach ($arrayValues as $school_unit)
        {
            $school_unit = trim($school_unit);

            if (is_numeric($school_unit))
            {
                $paramFilter[] = new DFC(SchoolUnitsExt::FIELD_SCHOOL_UNIT_ID, $school_unit, DFC::BEGINS_WITH);
            }
            else if ($school_unit)
            {
                $paramFilter[] = new DFC(SchoolUnitsExt::FIELD_NAME, $school_unit, DFC::CONTAINS);
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
                 $paramFilter[] = new DFC(CircuitsExt::FIELD_SCHOOL_UNIT_ID, $oSchoolUnit->getSchoolUnitId(), DFC::EXACT); 
            }
       } else {
             $paramFilter[] = new DFC(CircuitsExt::FIELD_SCHOOL_UNIT_ID, "0", DFC::EXACT);
        }
            
        //if ( count($paramFilter) > 0 )
       // {
          $multi_filter[] = new DFCAggregate($paramFilter, false);
                      
            
            
            
            
            
            $paramFilter = array();
            $arrayValues = preg_split("/[\s]*[,][\s]*/", $circuit);

            foreach ($arrayValues as $circuit)
            {
                $circuit = trim($circuit);

                    $paramFilter[] = new DFC(CircuitsExt::FIELD_PHONE_NUMBER, $circuit, DFC::BEGINS_WITH);

            }
            
            if ( count($paramFilter) > 0 )
            {
                $multi_filter[] = new DFCAggregate($paramFilter, false);
            }
            
            $filter[] = new DFCAggregate($multi_filter, false);
        
        }
        //==============================================================================        
    
        $sort = array( new DSC(CircuitsExt::FIELD_SCHOOL_UNIT_ID, DSC::ASC),
                       new DSC(CircuitsExt::FIELD_CIRCUIT_TYPE_ID, DSC::ASC)
                      );

        $oCircuits = new CircuitsExt($db);
        $totalRows = $oCircuits->findByFilterAsCount($db, $filter, true);
        $result["total"] = $totalRows[0]->getCircuitId();
        
        if ($pagesize)        
            $countRows = $oCircuits->findByFilterWithLimit($db, $filter, true, $sort, $startat, $pagesize);
        else
            $countRows = $oCircuits->findByFilter($db, $filter, true, $sort);
        
        $result["count"] = count( $countRows );
        
        if ($countRows) {         
        $schoolUnitsFilter = array();
       

        foreach ($countRows as $rows)
        {                
            $schoolUnitsFilter[] =  new DFC(SchoolUnitsExt::FIELD_SCHOOL_UNIT_ID, $rows->getSchoolUnitId(), DFC::EXACT);       
        }

        $oSchoolUnits->getAll($db, $schoolUnitsFilter, false); 
       
            
        foreach ($countRows as $row)
        {        
            
             $data = array( "circuit_id"=> $row->getCircuitId(),
                            "phone_number" => $row->getPhoneNumber(),
                            "updated_date" => $row->getUpdatedDate(),
                            "status" => $row->getStatus(),
                            "circuit_type" => $row->getCircuitTypeId(),
                            "circuit_type_name" => $oCircuitTypes->searchArrayForID( $row->getCircuitTypeId())->getName(),
                            "school_unit_id" => $row->getSchoolUnitId(),
                            "school_unit_name" => $oSchoolUnits->searchArrayForID( $row->getSchoolUnitId())->getName()
                  );
        $result["data"][] = $data;
        }
        
        }
        //else {
       //     $result["data"] = $data; 
       // }  
        
        
        $result["status"] = ExceptionCodes::NoErrors;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".ExceptionMessages::NoErrors;
    } catch (Exception $e) {
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
} 

?>