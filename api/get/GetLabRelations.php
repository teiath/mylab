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
 
function GetLabRelations($lab, $school_unit, $relation_type, $circuit, $phone_number, $pagesize, $page) {
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
                 $paramFilter[] = new DFC(LabRelationsExt::FIELD_LAB_ID, $oLab->getLabId(), DFC::EXACT);
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
                 $paramFilter[] = new DFC(LabRelationsExt::FIELD_SCHOOL_UNIT_ID, $oSchoolUnit->getSchoolUnitId(), DFC::EXACT); 
            }
       } else {
             $paramFilter[] = new DFC(LabRelationsExt::FIELD_SCHOOL_UNIT_ID, "0", DFC::EXACT);
        }
            
        //if ( count($paramFilter) > 0 )
       // {
            $filter[] = $school_unit_filter[] = new DFCAggregate($paramFilter, false);
                      
        //}

        }
                     
        //$relation_type==============================================================================
 
            $oRelationTypes = new RelationTypesExt($db);
            $oRelationTypes ->getAll($db);

            $paramFilter = array();
            $arrayValues = preg_split("/[\s]*[,][\s]*/", $relation_type);

            foreach ($arrayValues as $relation_type)
            {
                $relation_type = trim($relation_type);

                if (is_numeric($relation_type))
                {
                    $paramFilter[] = new DFC(LabRelationsExt::FIELD_RELATION_TYPE_ID, $relation_type, DFC::EXACT);
                }
                else if ($relation_type)
                {
                    $oRelationTypes->searchArrayForValue($relation_type);
                    $paramFilter[] = new DFC(LabRelationsExt::FIELD_RELATION_TYPE_ID, $oRelationTypes->getRelationTypeId(), DFC::EXACT);
                }
            }

            if ( count($paramFilter) > 0 )
            {
                $filter[] = new DFCAggregate($paramFilter, false);
            } 
        
        //= $circuit ==================================================

        $oCircuits = new CircuitsExt($db);
        
        if ($circuit){
        
            $paramFilter = array();
            $arrayValues = preg_split("/[\s]*[,][\s]*/",$circuit);

            foreach ($arrayValues as $circuit)
            {
                $circuit = trim($circuit);
                $paramFilter[] = new DFC(CircuitsExt::FIELD_CIRCUIT_ID, $circuit, DFC::EXACT);
            }


            if ( count($paramFilter) > 0 )
            {
                $oCircuits->getAll($db, $paramFilter, false);
            } 

           if (count($oCircuits->getObjsArray()) != 0 ) {

                $paramFilter = array();
                foreach ($oCircuits->getObjsArray() as $oCircuit)
                {  
                     $paramFilter[] = new DFC(LabRelationsExt::FIELD_CIRCUIT_ID, $oCircuit->getCircuitId(), DFC::EXACT); 
                }
           } else {
                 $paramFilter[] = new DFC(LabRelationsExt::FIELD_CIRCUIT_ID, "0", DFC::EXACT);
            }

            //if ( count($paramFilter) > 0 )
           // {
                $filter[] = new DFCAggregate($paramFilter, false);

            //}

        }
       //= $phone_number ==================================================

        $oPhoneNumbers = new CircuitsExt($db);
        
        if ($phone_number){
        
            $paramFilter = array();
            $arrayValues = preg_split("/[\s]*[,][\s]*/",$phone_number);

            foreach ($arrayValues as $phone_number)
            {
                $phone_number = trim($phone_number);
                $paramFilter[] = new DFC(CircuitsExt::FIELD_PHONE_NUMBER, $phone_number, DFC::EXACT);
            }


            if ( count($paramFilter) > 0 )
            {
                $oPhoneNumbers->getAll($db, $paramFilter, false);
            } 

           if (count($oPhoneNumbers->getObjsArray()) != 0 ) {

                $paramFilter = array();
                foreach ($oPhoneNumbers->getObjsArray() as $oPhoneNumber)
                {  
                     $paramFilter[] = new DFC(LabRelationsExt::FIELD_CIRCUIT_ID, $oPhoneNumber->getCircuitId(), DFC::EXACT); 
                }
           } else {
                 $paramFilter[] = new DFC(LabRelationsExt::FIELD_CIRCUIT_ID, "0", DFC::EXACT);
            }

            //if ( count($paramFilter) > 0 )
           // {
                $filter[] = new DFCAggregate($paramFilter, false);

            //}

        }
        //==============================================================================        
    
        $sort = array( new DSC(LabRelationsExt::FIELD_LAB_ID, DSC::ASC),
                       new DSC(LabRelationsExt::FIELD_SCHOOL_UNIT_ID, DSC::ASC),
                       new DSC(LabRelationsExt::FIELD_RELATION_TYPE_ID, DSC::ASC),
                       new DSC(LabRelationsExt::FIELD_CIRCUIT_ID, DSC::ASC)
                      );

        $oLabRelations = new LabRelationsExt($db);
        $totalRows = $oLabRelations->findByFilterAsCount($db, $filter, true);
        $result["total"] = $totalRows[0]->getLabRelationId();
        
        if ($pagesize)        
            $countRows = $oLabRelations->findByFilterWithLimit($db, $filter, true, $sort, $startat, $pagesize);
        else
            $countRows = $oLabRelations->findByFilter($db, $filter, true, $sort);
        
        $result["count"] = count( $countRows );
        
        if ($countRows) {         
        $schoolUnitsFilter = array();
        $labsFilter = array();
        $circuitsFilter = array();
        
        foreach ($countRows as $rows)
        {                
            $schoolUnitsFilter[] = new DFC(SchoolUnitsExt::FIELD_SCHOOL_UNIT_ID, $rows->getSchoolUnitId(), DFC::EXACT);
            $labsFilter[] = new DFC(LabsExt::FIELD_LAB_ID, $rows->getLabId(), DFC::EXACT);
            $circuitsFilter[] = new DFC(CircuitsExt::FIELD_CIRCUIT_ID, $rows->getCircuitId(), DFC::EXACT);
        }

        $oSchoolUnits->getAll($db, $schoolUnitsFilter, false); 
        $oLabs->getAll($db, $labsFilter, false); 
        $oCircuits->getAll($db, $circuitsFilter, false); 
          
        foreach ($countRows as $row)
        {        
            
             $data = array( "lab_relation_id"=> $row->getLabRelationId(),
                            "lab_id" => $row->getLabId(),
                            "lab_name" => $oLabs->searchArrayForID($row->getLabId())->getName(),
                            "school_unit_id" => $row->getSchoolUnitId(),
                            "school_unit" => $oSchoolUnits->searchArrayForID( $row->getSchoolUnitId())->getName(),
                            "relation_type_id" => $row->getRelationTypeId(),
                            "relation_type_name" => $oRelationTypes->searchArrayForID( $row->getRelationTypeId())->getName(),
                            "circuit_id" => $row->getCircuitId(),
                            "circuit_phone_number" => $oCircuits->searchArrayForID( $row->getCircuitId())->getPhoneNumber()
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