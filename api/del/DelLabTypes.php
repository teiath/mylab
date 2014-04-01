<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $name
 * @return string
 * @throws Exception
 */


function DelLabTypes($name) {
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
            throw new Exception(ExceptionMessages::DeleteLabTypeNameValue." : ".$name, ExceptionCodes::DeleteLabTypeNameValue);
        } else {
            $filter = array( new DFC(LabTypesExt::FIELD_NAME,$name, DFC::EXACT) );
            $oLabTypes = new LabTypesExt($db);
            $arrayLabTypes = $oLabTypes->findByFilter($db, $filter, true);
        }
  
        if ( count($arrayLabTypes) < 1 ) {
            throw new Exception(ExceptionMessages::DeleteNotFoundLabTypeNameValue." : ".$name, ExceptionCodes::DeleteNotFoundLabTypeNameValue);
        } else if (count($arrayLabTypes) == 1) {
            $LabTypeId = $arrayLabTypes[0]->getLabTypeId();
            $LabTypeName = $arrayLabTypes[0]->getName();
            $result["result_found"]="Lab_type_id = ".$LabTypeId." // Name = ".$LabTypeName;
        } else {
            throw new Exception(ExceptionMessages::DuplicateDelLabTypeNameValue." : ".$name, ExceptionCodes::DuplicateDelLabTypeNameValue);
        }
        
        //check for references============================================================================== 
        
        $oLabs = new LabsExt($db);
        $filter[] = new DFC(LabsExt::FIELD_LAB_TYPE_ID, $LabTypeId, DFC::EXACT); 
        $countRows = $oLabs->findByFilter($db, $filter, true);
        $result["references_count"]=count( $countRows );
        
         if ($result["references_count"]!=0){
            $oLabResponsibles = new LabResponsiblesExt($db);
            $oLabResponsibles->getAll($db); //TODO improve for speed of deletion
            $oLabTypes->getAll($db, $filter);
            
            foreach ($countRows as $row) {
                $oSchoolUnit = $row->fetchSchoolUnits($db);
                $result["data_references"][] = array(   "lab_id" => $row->getLabId(),
                                                        "name" => $row->getName(),
                                                        "creation_date"=>$row->getCreationDate(),
                                                        "created_by"=>$row->getCreatedBy(),
                                                        "last_updated"=>$row->getLastUpdated(),
                                                        "updated_by"=>$row->getUpdatedBy(),
                                                        "positioning"=>$row->getPositioning(),
                                                        "lab_responsible"=>$oLabResponsibles->searchArrayForID( $row->getLabResponsibleId() )->getRegistryNumber(),
                                                        "lab_type" => $oLabTypes->searchArrayForID( $row->getLabTypeId() )->getName(), 
                                                        "school_unit" => $oSchoolUnit->getName()
                                                    );
            }
            throw new Exception(ExceptionMessages::ReferencesLabs, ExceptionCodes::ReferencesLabs);         
        } else {
            $arrayLabTypes[0]->deleteByFilter($db, $filter);  
            $result["status"] = 200;
            $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";           
        }
    } catch (Exception $e)  {
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
}

?>