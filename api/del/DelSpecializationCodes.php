<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $code
 * @return string
 * @throws Exception
 */

function DelSpecializationCodes($code) {
    global $db;
    global $Options;
    global $app;
    
    $result = array();  
    $result["data"] = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    $result["del_code"] = $code;
    
    try {
        
        //$code==========================================================================================
        if (! trim($code) ) {
            throw new Exception(ExceptionMessages::DeleteSpecializationCodeValue." : ".$code, ExceptionCodes::DeleteSpecializationCodeValue);
        } else {
            $filter[] = new DFC(SpecializationCodesExt::FIELD_CODE, $code, DFC::EXACT); 
            $oSpecializationCodes = new SpecializationCodesExt($db);
            $arraySpecializationCodes = $oSpecializationCodes->findByFilter($db, $filter, true);
        }
        
        if ( count($arraySpecializationCodes ) < 1 ) { 
             throw new Exception(ExceptionMessages::DeleteNotFoundSpecializationCodeNameValue." : ".$code, ExceptionCodes::DeleteNotFoundSpecializationCodeNameValue);
        } else if(count($arraySpecializationCodes ) == 1 ) {
             $SpecializationCodeId = $arraySpecializationCodes[0]->getSpecializationCodeId();
             $SpecializationCode = $arraySpecializationCodes[0]->getCode();
             $result["result_found"]="Specialization_code_id = ".$SpecializationCodeId." // Code = ".$SpecializationCode;
        } else {
             throw new Exception(ExceptionMessages::DuplicateDelSpecializationCodeValue." : ".$code, ExceptionCodes::DuplicateDelSpecializationCodeValue);
        }     
        
        //check for references============================================================================== 
        $oLabResponsibles = new LabResponsiblesExt($db);
        $filter[] = new DFC(LabResponsiblesExt::FIELD_SPECIALIZATION_CODE_ID, $SpecializationCodeId, DFC::EXACT); 
        $countRows = $oLabResponsibles->findByFilter($db, $filter, true);
        $result["references_count"]=count( $countRows );
        
        if ($result["references_count"]!=0){
            $oEmploymentRelationships = new EmploymentRelationshipsExt($db);
            $oEmploymentRelationships->getAll($db);
            $oSpecializationCodes->getAll($db, $filter);
            
            foreach ($countRows as $row) {
                    $result["data_references"][] = array("lab_responsible_id" => $row->getLabResponsibleId(),
                                                        "registry_number" => $row->getRegistryNumber(),
                                                        "firstname"=>$row->getFirstname(),
                                                        "lastname"=>$row->getLastname(),
                                                        "fathername"=>$row->getFathername(),
                                                        "sex"=>$row->getSex(),
                                                        "specialization_code"=>$oSpecializationCodes->searchArrayForID( $row->getSpecializationCodeId() )->getCode() ,
                                                        "employment_relationship"=>$oEmploymentRelationships->searchArrayForID( $row->getEmploymentRelationshipId() )->getName()
                    );
            }
            throw new Exception(ExceptionMessages::ReferencesLabResponsibles, ExceptionCodes::ReferencesLabResponsibles);
        } else {
//            $dSpecializationCodes = new SpecializationCodesExt($db);
//            $dSpecializationCodes->setSpecializationCodeId($SpecializationCodeId);
//            $dSpecializationCodes->setCode($SpecializationCode);              
//        
//            //second check if exist in database and delete==============================================================================        
//            $result["exists"]=$dSpecializationCodes->existsInDatabase($db);    
//                if ($result["exists"]==true)
//                    $dSpecializationCodes->deleteFromDatabase($db);
//                else
//                    throw new Exception(ExceptionMessages::DeleteError, ExceptionCodes::DeleteError);
            
            $arraySpecializationCodes[0]->deleteByFilter($db, $filter);
            
            $result["status"] = 200;
            $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success"; 
        } 
    } catch (Exception $e){  
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    }   
    return $result;
}
?>