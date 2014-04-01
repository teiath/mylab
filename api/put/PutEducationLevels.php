<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $education_level_id
 * @param type $name
 * @return string
 * @throws Exception
 */

function PutEducationLevels($education_level_id,$name) {
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
            $filter[] = new DFC(EducationLevelsExt::FIELD_NAME, $name, DFC::EXACT); 

           $oEducationLevels = new EducationLevelsExt($db);
           $arrayEducationLevels = $oEducationLevels->findByFilter($db, $filter, true);

           if ( count( $arrayEducationLevels ) > 0 ) { 
                throw new Exception(ExceptionMessages::DuplicateEducationLevelValue." : ".$name, ExceptionCodes::DuplicateEducationLevelValue);
           }     
        
        //$education_level_id===========================================================================
        if (! trim($education_level_id) )
            throw new Exception(ExceptionMessages::MissingEducationLevelIdValue." : ".$education_level_id, ExceptionCodes::MissingEducationLevelIdValue);
        else if (!is_numeric($education_level_id) || ( $education_level_id < 0)  )
            throw new Exception(ExceptionMessages::InvalidEducationLevelIdValue." : ".$education_level_id, ExceptionCodes::InvalidEducationLevelIdValue);
        else 
            $uEducationLevels = EducationLevelsExt::findById($db, $education_level_id);

        //=================================================================================================
        $result["total_found"]=count($uEducationLevels);
        
        if ($result["total_found"]==1){
              
                $values["education_level_id"] = $uEducationLevels->getEducationLevelId();
                $values["name"] = $uEducationLevels->getName();
                $result["values"] = $values;
               
                $update_values["education_level_id"] = $education_level_id;
                $update_values["name"] = $name;
                $result["updated_values"] = $update_values;
                
                $uEducationLevels->setName($name);
                $uEducationLevels->updateToDatabase($db);

                $result["status"] = 200;
                $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success"; 

        } else if ($result["total_found"]==0){
            throw new Exception(ExceptionMessages::UpdateEducationLevelIdValue." : ".$education_level_id, ExceptionCodes::UpdateEducationLevelIdValue);
        } else {
           throw new Exception(ExceptionMessages::DuplicateEducationLevelIdValue." : ".$education_level_id, ExceptionCodes::DuplicateEducationLevelIdValue);
        }
        
    } catch (Exception $e){      
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    }  
    return $result;
}

?>