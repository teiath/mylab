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


function GetEducationLevels( $pagesize, $page) {
    global $db;
    global $Options;
    global $app;
    
    $filter = array();
    $result = array();  

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

        //school_unit_types==============================================================================           
        $oSchoolUnitTypes = new SchoolUnitTypesExt($db);
        $oSchoolUnitTypes->getAll($db);    
        
        //==============================================================================        

        $sort = array( new DSC(EducationLevelsExt::FIELD_NAME, DSC::ASC) );

        $oEducationLevels = new EducationLevelsExt($db);
        $totalRows = $oEducationLevels->findByFilterAsCount($db, $filter, true);
        $result["total"] = $totalRows[0]->getEducationLevelId();
        
        if ($pagesize)        
            $countRows = $oEducationLevels->findByFilterWithLimit($db, $filter, true, $sort, $startat, $pagesize);
        else
            $countRows = $oEducationLevels->findByFilter($db, $filter, true, $sort);
        
        $result["count"] = count( $countRows );

        foreach ($countRows as $row) {
            
            //retrieve school_unit_types
            $school_unit_type["school_unit_type_info"] = array();   
            $filter = array( new DFC(SchoolUnitTypesExt::FIELD_EDUCATION_LEVEL_ID,$row->getEducationLevelId(), DFC::EXACT));
            $sort = array( new DSC(SchoolUnitTypesExt::FIELD_EDUCATION_LEVEL_ID, DSC::ASC) );
            $arraySchoolUnitTypes = $oSchoolUnitTypes->findByFilter($db, $filter, true, $sort);  
                if ($arraySchoolUnitTypes) {
                foreach ($arraySchoolUnitTypes as $arraySchoolUnitType){
                    $school_unit_type["school_unit_type_info"][] = array("school_unit_type_id" => $arraySchoolUnitType->getSchoolUnitTypeId(),
                                                                         "name" => $arraySchoolUnitType->getName()                                                                      
                                                                   );  
                 }
                } else {
                   $school_unit_type["school_unit_type_info"] = null; 
                }
            $result["data"][] = array("education_level_id" => $row->getEducationLevelId(), 
                                      "name" => $row->getName(),
                                      "school_unit_types"=>$school_unit_type
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