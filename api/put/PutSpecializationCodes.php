<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $specialization_code_id
 * @param type $code
 * @return string
 * @throws Exception
 */

function PutSpecializationCodes($specialization_code_id,$code) {
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
        
        //$code==========================================================================================
        if (! trim($code) )
            throw new Exception(ExceptionMessages::MissingCodeValue." : ".$code, ExceptionCodes::MissingCodeValue);
        else
            $filter[] = new DFC(SpecializationCodesExt::FIELD_CODE, $code, DFC::EXACT); 

           $oSpecializationCodes = new SpecializationCodesExt($db);
           $arraySpecializationCodes = $oSpecializationCodes->findByFilter($db, $filter, true);

           if ( count( $arraySpecializationCodes ) > 0 ) { 
                throw new Exception(ExceptionMessages::DuplicateSpecializationCodeValue." : ".$code, ExceptionCodes::DuplicateSpecializationCodeValue);
           }     
        
        //$specialization_code_id===========================================================================
        if (! trim($specialization_code_id) )
            throw new Exception(ExceptionMessages::MissingSpecializationCodeIdValue." : ".$specialization_code_id, ExceptionCodes::MissingSpecializationCodeIdValue);
        else if (!is_numeric($specialization_code_id) || ($specialization_code_id < 0)  )
            throw new Exception(ExceptionMessages::InvalidSpecializationCodeIdValue." : ".$specialization_code_id, ExceptionCodes::InvalidSpecializationCodeIdValue);
        else 
            $uSpecializationCodes = SpecializationCodesExt::findById($db, $specialization_code_id);
        
        //=================================================================================================
        $result["total_found"]=count($uSpecializationCodes);
        
        if ($result["total_found"]==1){
              
                $values["specialization_code_id"] = $uSpecializationCodes->getSpecializationCodeId();
                $values["code"] = $uSpecializationCodes->getCode();
                $result["values"] = $values;
                
                $update_values["specialization_code_id"]=$specialization_code_id;
                $update_values["code"] = $code;
                $result["updated_values"] = $update_values;
               
                $uSpecializationCodes->setCode($code);
                $uSpecializationCodes->updateToDatabase($db);
               
                $result["status"] = 200;
                $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success"; 

        } else if ($result["total_found"]==0){
            throw new Exception(ExceptionMessages::UpdateSpecializationCodeIdValue." : ".$specialization_code_id, ExceptionCodes::UpdateSpecializationCodeIdValue);
        } else {
           throw new Exception(ExceptionMessages::DuplicateSpecializationCodeIdValue." : ".$specialization_code_id, ExceptionCodes::DuplicateSpecializationCodeIdValue);
        }
        
    } catch (Exception $e){      
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    }  
    return $result;
}

?>