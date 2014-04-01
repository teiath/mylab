<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $school_unit_type_id
 * @param type $name
 * @param type $education_level
 * @return string
 * @throws Exception
 */

function PutSchoolUnitTypes($school_unit_type_id,$name,$education_level) {
    global $db;
    global $Options;
    global $app;
    
    $result = array();
    $values = array();
    $update_values = array();
    $result["data"] = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    
    try {
       
        //$name==========================================================================================
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

        //$school_unit_type_id===========================================================================
            if (! trim($school_unit_type_id) )
                throw new Exception(ExceptionMessages::MissingSchoolUnitTypeIdValue." : ".$school_unit_type_id, ExceptionCodes::MissingSchoolUnitTypeIdValue);
            else if (!is_numeric($school_unit_type_id) || ( $school_unit_type_id < 0)  )
                throw new Exception(ExceptionMessages::InvalidSchoolUnitTypeIdValue." : ".$school_unit_type_id, ExceptionCodes::InvalidSchoolUnitTypeIdValue);
            else 
                $uSchoolUnitTypes = SchoolUnitTypesExt::findById($db, $school_unit_type_id);

        //=================================================================================================
        $result["total_found"]=count($uSchoolUnitTypes);
                                                                                                            
        if ($result["total_found"]==1){
            
            $values["school_unit_type_id"] = $uSchoolUnitTypes->getSchoolUnitTypeId();
            $values["name"] = $uSchoolUnitTypes->getName();        
            $values["education_level"] = $uSchoolUnitTypes->getEducationLevelId();
            $result["values"] = $values;
            
            //check if $name is same as old name of same entry
            $oSchoolUnitTypes = new SchoolUnitTypesExt($db);
            $arraySchoolUnitTypes = $oSchoolUnitTypes->findByFilter($db, $filter, true);

                if (( count( $arraySchoolUnitTypes ) > 0 ) && ($values["name"]!=$name)) { 
                     throw new Exception(ExceptionMessages::DuplicateSchoolUnitTypeValue." : ".$name, ExceptionCodes::DuplicateSchoolUnitTypeValue);
                }  
            
            $update_values["school_unit_type_id"] = $school_unit_type_id;
            $update_values["name"] = $name;
            $update_values["education_level"] = $fEducationLevel;
            $result["updated_values"] = $update_values;
            
            $uSchoolUnitTypes->setName($name);
            $uSchoolUnitTypes->setEducationLevelId($fEducationLevel);
            $uSchoolUnitTypes->updateToDatabase($db);

            $result["status"] = 200;
            $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success"; 

        } else if ($result["total_found"]==0){
            throw new Exception(ExceptionMessages::UpdateSchoolUnitTypeIdValue." : ".$school_unit_type_id, ExceptionCodes::UpdateSchoolUnitTypeIdValue);
        } else {
           throw new Exception(ExceptionMessages::DuplicateSchoolUnitTypeIdValue." : ".$school_unit_type_id, ExceptionCodes::DuplicateSchoolUnitTypeIdValue);
        }
        
    } catch (Exception $e){      
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    }  
    return $result;
}

?>