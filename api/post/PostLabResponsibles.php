<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @param type $registry_number
 * @param type $firstname
 * @param type $lastname
 * @param type $fathername
 * @param type $sex
 * @param type $specialization_code
 * @param type $employment_relationship
 * @return string
 * @throws Exception
 */

function PostLabResponsibles($registry_number,$firstname,$lastname,$fathername,$sex,
                             $specialization_code,$employment_relationship) {
    global $db;
    global $Options;
    global $app;
    
    $result = array();  
    $result["data"] = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    $result["registry_number"] = $registry_number;
    $result["firstname"] = $firstname;
    $result["lastname"] = $lastname;
    $result["fathername"] = $fathername;
    $result["sex"] = $sex;
    $result["specialization_code"] = $specialization_code;
    $result["employment_relationship"] = $employment_relationship;
    
    try {
     
        //$registry_number============================================================================
        if (! trim($registry_number) )
            throw new Exception(ExceptionMessages::MissingRegistryNumberValue." : ".$registry_number, ExceptionCodes::MissingRegistryNumberValue);
        else if (!is_numeric($registry_number))
	    throw new Exception(ExceptionMessages::InvalidRegistryNumberValue." : ".$registry_number, ExceptionCodes::InvalidRegistryNumberValue);    
        else
            $filter[] = new DFC(LabResponsiblesExt::FIELD_REGISTRY_NUMBER, $registry_number, DFC::EXACT);
        
        //$firstname============================================================================
        if (! trim($firstname) )
            throw new Exception(ExceptionMessages::MissingFirstNameValue." : ".$firstname, ExceptionCodes::MissingFirstNameValue);
        else
            $ffirstname = $firstname;
        
        //$lastname===========================================================================
        if (! trim($lastname) )
            throw new Exception(ExceptionMessages::MissingLastNameValue." : ".$lastname, ExceptionCodes::MissingLastNameValue);
        else
            $flastname = $lastname;
        
        //$fathername===========================================================================
        if (! trim($fathername) )
            throw new Exception(ExceptionMessages::MissingFathernameValue." : ".$fathername, ExceptionCodes::MissingFathernameValue);
        else
            $ffathername = $fathername;
        
        //$sex===========================================================================
        if (! trim($sex)  )
            throw new Exception(ExceptionMessages::MissingSexValue." : ".$sex, ExceptionCodes::MissingSexValue);
        else if (($sex !="Θ") && ($sex !="Α") )   
            throw new Exception(ExceptionMessages::InvalidSexValue." : ".$sex, ExceptionCodes::InvalidSexValue);
        else
            $fsex = $sex;
     
       //$specialization_code============================================================          
        if (! $specialization_code)
            throw new Exception(ExceptionMessages::CreateSpecializationCodeIdValue." : ".$specialization_code, ExceptionCodes::CreateSpecializationCodeIdValue);
        else {
              $oSpecializationCodes = new SpecializationCodesExt($db);

              if (is_numeric($specialization_code)) {
                  $filter[] = new DFC(SpecializationCodesExt::FIELD_SPECIALIZATION_CODE_ID, $specialization_code, DFC::EXACT) ;
              } else { 
                  $filter[] = new DFC(SpecializationCodesExt::FIELD_CODE, $specialization_code, DFC::EXACT);                
              }         
         }

        $arraySpecializationCodes = $oSpecializationCodes->findByFilter($db, $filter, true);
        
        if ( count( $arraySpecializationCodes ) === 1 ) { 
            $fSpecializationCode = $arraySpecializationCodes[0]->getSpecializationCodeId();
        } else if ( count( $arraySpecializationCodes ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicateSpecializationCodeIdValue." : ".$specialization_code, ExceptionCodes::DuplicateSpecializationCodeIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidSpecializationCodeValue." : ".$specialization_code, ExceptionCodes::InvalidSpecializationCodeValue);
        }  
        
        //$employment_relationship============================================================          
        if (! $employment_relationship)
            throw new Exception(ExceptionMessages::CreateEmploymentRelationshipIdValue." : ".$employment_relationship, ExceptionCodes::CreateEmploymentRelationshipIdValue);
        else {
              $oEmploymentRelationships = new EmploymentRelationshipsExt($db);

              if (is_numeric($employment_relationship)) {
                  $filter[] = new DFC(EmploymentRelationshipsExt::FIELD_EMPLOYMENT_RELATIONSHIP_ID, $employment_relationship, DFC::EXACT) ;
              } else { 
                  $filter[] = new DFC(EmploymentRelationshipsExt::FIELD_NAME, $employment_relationship, DFC::EXACT);                
              }         
         }

        $arrayEmploymentRelationships = $oEmploymentRelationships->findByFilter($db, $filter, true);
        
        if ( count( $arrayEmploymentRelationships ) === 1 ) { 
            $fEmploymentRelationship = $arrayEmploymentRelationships[0]->getEmploymentRelationshipId();
        } else if ( count( $arrayEmploymentRelationships ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicateEmploymentRelationshipIdValue." : ".$employment_relationship, ExceptionCodes::DuplicateEmploymentRelationshipIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidEmploymentRelationshipValue." : ".$employment_relationship, ExceptionCodes::InvalidEmploymentRelationshipValue);
        }  
       
       //==================================================================================          
        
        $oLabResponsibles = new LabResponsiblesExt($db);
        $arrayLabResponsible = $oLabResponsibles->findByFilter($db, $filter, true);
        
            if ( count( $arrayLabResponsible ) > 0 ) { 
                throw new Exception(ExceptionMessages::DuplicateRegistryNumberValue." : ".$registry_number, ExceptionCodes::DuplicateRegistryNumberValue);
            }
            
        $oLabResponsibles->setRegistryNumber($registry_number);
        $oLabResponsibles->setFirstname($ffirstname);
        $oLabResponsibles->setLastname($flastname);
        $oLabResponsibles->setFathername($ffathername);
        $oLabResponsibles->setSex($fsex);
        $oLabResponsibles->setSpecializationCodeId($fSpecializationCode);
        $oLabResponsibles->setEmploymentRelationshipId($fEmploymentRelationship);
        
        $oLabResponsibles->insertIntoDatabase($db);

        $result["lab_responsible_id"] = $oLabResponsibles->getLabResponsibleId();
        
        $result["status"] = 200;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";
    } catch (Exception $e){ 
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
}

?>