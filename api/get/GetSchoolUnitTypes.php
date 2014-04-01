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
 * @param type $education_level
 * @param type $pagesize
 * @param int $page
 * @return string
 * @throws Exception
 */

function GetSchoolUnitTypes($education_level, $pagesize, $page) {
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
       
        //= $education_level ==================================================
        $oEducationLevels = new EducationLevelsExt($db);
        $oEducationLevels->getAll($db);
        
        $paramFilter = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/", $education_level);

        foreach ($arrayValues as $education_level)
        {
            $education_level = trim($education_level);
            
            if (is_numeric($education_level))
            {
                $paramFilter[] = new DFC(SchoolUnitTypesExt::FIELD_EDUCATION_LEVEL_ID, $education_level, DFC::EXACT);
            }
            else if ($education_level)
            {
                $oEducationLevels->searchArrayForValue($education_level);
                $paramFilter[] = new DFC(SchoolUnitTypesExt::FIELD_EDUCATION_LEVEL_ID, $oEducationLevels->getEducationLevelId(), DFC::EXACT);
            }
        }
        
        if ( count($paramFilter) > 0 )
        {
            $filter[] = new DFCAggregate($paramFilter, false);
        }   
        
        //==============================================================================    
    
        $sort = array( new DSC(SchoolUnitTypesExt::FIELD_NAME, DSC::ASC) );

        $oSchoolUnits = new SchoolUnitTypesExt($db);
        
        $totalRows = $oSchoolUnits->findByFilterAsCount($db, $filter, true);
        $result["total"] = $totalRows[0]->getSchoolUnitTypeId();
        
        if ($pagesize)
            $countRows = $oSchoolUnits->findByFilterWithLimit($db, $filter, true, $sort, $startat, $pagesize);
        else
            $countRows = $oSchoolUnits->findByFilter($db, $filter, true, $sort);
       
        $result["count"] = count( $countRows );
                    
        foreach ($countRows as $row) {
            $result["data"][] = array("school_unit_type_id" => $row->getSchoolUnitTypeId(), 
                                      "name" => $row->getName(),
                                      "initials" => $row->getInitials(),
                                      "education_level" => $oEducationLevels->searchArrayForID( $row->getEducationLevelId() )->getName()
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