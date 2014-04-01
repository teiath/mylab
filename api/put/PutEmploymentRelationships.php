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

function PutEmploymentRelationships($employment_relationship_id,$name) {
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
            $filter[] = new DFC(EmploymentRelationshipsExt::FIELD_NAME, $name, DFC::EXACT); 

           $oEmploymentRelationships= new EmploymentRelationshipsExt($db);
           $arrayEmploymentRelationships = $oEmploymentRelationships->findByFilter($db, $filter, true);

           if ( count( $arrayEmploymentRelationships ) > 0 ) { 
                throw new Exception(ExceptionMessages::DuplicateEmploymentRelationshipValue." : ".$name, ExceptionCodes::DuplicateEmploymentRelationshipValue);
           }     
       
        //$employment_relationship_id===========================================================================
        if (! trim($employment_relationship_id) )
            throw new Exception(ExceptionMessages::MissingEmploymentRelationshipIdValue." : ".$employment_relationship_id, ExceptionCodes::MissingEmploymentRelationshipIdValue);
        else if (!is_numeric($employment_relationship_id) || ($employment_relationship_id < 0)  )
            throw new Exception(ExceptionMessages::InvalidEmploymentRelationshipIdValue." : ".$employment_relationship_id, ExceptionCodes::InvalidEmploymentRelationshipIdValue);
        else 
            $uEmploymentRelationships = EmploymentRelationshipsExt::findById($db, $employment_relationship_id);

        //=================================================================================================
        $result["total_found"]=count($uEmploymentRelationships);
        
        if ($result["total_found"]==1){
            
                $values["employment_relationship_id"] = $uEmploymentRelationships->getEmploymentRelationshipId();
                $values["name"] = $uEmploymentRelationships->getName();
                $result["values"] = $values;
               
                $update_values["employment_relationship_id"] = $employment_relationship_id;
                $update_values["name"] = $name;
                $result["updated_values"] = $update_values;

               $uEmploymentRelationships->setName($name);
               $uEmploymentRelationships->updateToDatabase($db);
               
               $result["status"] = 200;
               $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success"; 

        } else if ($result["total_found"]==0){
            throw new Exception(ExceptionMessages::UpdateEmploymentRelationshipIdValue." : ".$employment_relationship_id, ExceptionCodes::UpdateEmploymentRelationshipIdValue);
        } else {
           throw new Exception(ExceptionMessages::DuplicateEmploymentRelationshipIdValue." : ".$employment_relationship_id, ExceptionCodes::DuplicateEmploymentRelationshipIdValue);
        }
        
    } catch (Exception $e){      
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    }  
    return $result;
}

?>