<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @param type $name
 * @return string
 * @throws Exception
 */


function DelEmploymentRelationships($name) {
    global $db;
    global $Options;
    global $app;
    
    $result = array();  
    $result["data"] = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    $result["del_name"] = $name;
    
    try {
        
        //$name===========================================================================
        if (! trim($name) ) {
            throw new Exception(ExceptionMessages::DeleteEmploymentRelationshipNameValue." : ".$name, ExceptionCodes::DeleteEmploymentRelationshipNameValue);
        } else {
            $filter = array( new DFC(EmploymentRelationshipsExt::FIELD_NAME,$name, DFC::EXACT) );
            $oEmploymentRelationships = new EmploymentRelationshipsExt($db);
            $arrayEmploymentRelationships = $oEmploymentRelationships->findByFilter($db, $filter, true);
        }
  
        if ( count($arrayEmploymentRelationships) < 1 ) {
            throw new Exception(ExceptionMessages::DeleteNotFoundEmploymentRelationshipNameValue." : ".$name, ExceptionCodes::DeleteNotFoundEmploymentRelationshipNameValue);
        } else if (count($arrayEmploymentRelationships) == 1) {
            $EmploymentRelationshipId = $arrayEmploymentRelationships[0]->getEmploymentRelationshipId();
            $EmploymentRelationshipName = $arrayEmploymentRelationships[0]->getName();
            $result["result_found"]="Employment_relationship_id = ".$EmploymentRelationshipId." // Name = ".$EmploymentRelationshipName;
        } else {
            throw new Exception(ExceptionMessages::DuplicateDelEmploymentRelationshipNameValue." : ".$name, ExceptionCodes::DuplicateDelEmploymentRelationshipNameValue);
        }
        
        //check for references============================================================================== 
        
        $oLabResponsibles = new LabResponsiblesExt($db);
        $filter[] = new DFC(LabResponsiblesExt::FIELD_EMPLOYMENT_RELATIONSHIP_ID, $EmploymentRelationshipId, DFC::EXACT); 
        $countRows = $oLabResponsibles->findByFilter($db, $filter, true);
        $result["references_count"]=count( $countRows );
        
         if ($result["references_count"]!=0){
            $oSpecializationCodes = new SpecializationCodesExt($db);
            $oSpecializationCodes->getAll($db);
            $oEmploymentRelationships->getAll($db, $filter);
            
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
            $arrayEmploymentRelationships[0]->deleteByFilter($db, $filter);  
            $result["status"] = 200;
            $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";           
        }
    }
    catch (Exception $e) 
    {
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
}

?>