<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $name
 * @param type $education_level
 * @return string
 * @throws Exception
 */


function PostSchoolUnitTypes($name,$education_level) {
    global $db;
    global $Options;
    global $app;
    
    $result = array();  
    $result["data"] = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    $result["name"] = $name;
    $result["education_level"] = $education_level;
    
    try {
     
        //$name============================================================================
        if (! trim($name) )
            throw new Exception(ExceptionMessages::MissingNameValue." : ".$name, ExceptionCodes::MissingNameValue);
        else
            $filter[] = new DFC(SchoolUnitTypesExt::FIELD_NAME, $name, DFC::EXACT); 

        //$education_level============================================================          
        if (! $education_level)
            throw new Exception(ExceptionMessages::CreateEducationLevelIdValue." : ".$education_level, ExceptionCodes::CreateEducationLevelIdValue);
        else {
              $oEducationLevels = new EducationLevelsExt($db);

              if (is_numeric($education_level)) {
                  $filter[] = new DFC(EducationLevelsExt::FIELD_EDUCATION_LEVEL_ID, $education_level, DFC::EXACT) ;
              } else { 
                  $filter[] = new DFC(EducationLevelsExt::FIELD_NAME, $education_level, DFC::EXACT);                
              }         
         }

        $arrayEducationLevels = $oEducationLevels->findByFilter($db, $filter, true);
        
        if ( count( $arrayEducationLevels ) === 1 ) { 
            $fEducationLevel = $arrayEducationLevels[0]->getEducationLevelId();
        } else if ( count( $arrayEducationLevels ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicateEducationLevelIdValue." : ".$education_level, ExceptionCodes::DuplicateEducationLevelIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidEducationLevelValue." : ".$education_level, ExceptionCodes::InvalidEducationLevelValue);
        }  
        //==================================================================================  
                
        $oSchoolUnitTypes = new SchoolUnitTypesExt($db);
        $arraySchoolUnitTypes = $oSchoolUnitTypes->findByFilter($db, $filter, true);
        
            if ( count( $arraySchoolUnitTypes ) > 0 ) { 
                throw new Exception(ExceptionMessages::DuplicateSchoolUnitTypeValue." : ".$name, ExceptionCodes::DuplicateSchoolUnitTypeValue);
            }

        $oSchoolUnitTypes->setName($name);
        $oSchoolUnitTypes->setEducationLevelId($fEducationLevel);
        $oSchoolUnitTypes->insertIntoDatabase($db);

        $result["school_unit_type_id"] = $oSchoolUnitTypes->getSchoolUnitTypeId();
        
        $result["status"] = 200;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";
    } catch (Exception $e){ 
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
}

?>