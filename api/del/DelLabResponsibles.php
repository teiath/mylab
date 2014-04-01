<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $registry_number
 * @return string
 * @throws Exception
 */

function DelLabResponsibles($registry_number) {
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

    try {
             
        //$name===========================================================================   
        if (! trim($registry_number) ) {
            throw new Exception(ExceptionMessages::DeleteLabResponsibleRegistryNumberValue." : ".$registry_number, ExceptionCodes::DeleteLabResponsibleRegistryNumberValue);
        } else {
            $filter = array( new DFC(LabResponsiblesExt::FIELD_REGISTRY_NUMBER,$registry_number, DFC::EXACT) );   
            $oLabResponsibles = new LabResponsiblesExt($db);
            $arrayLabResponsibles = $oLabResponsibles->findByFilter($db, $filter, true);
        }

        if ( count($arrayLabResponsibles) < 1) {
            throw new Exception(ExceptionMessages::DeleteNotFoundLabResponsibleRegistryNumberValue." : ".$registry_number, ExceptionCodes::DeleteNotFoundLabResponsibleRegistryNumberValue);
        } else if ( count($arrayLabResponsibles) == 1) {
            $LabResponsibleId = $arrayLabResponsibles[0]->getLabResponsibleId();
            $LabResponsibleRegistryNumber = $arrayLabResponsibles[0]->getRegistryNumber();
            $result["result_found"]="Lab_Responsible_id = ".$LabResponsibleId." // Registry_number = ".$LabResponsibleRegistryNumber;     
        } else {
            throw new Exception(ExceptionMessages::DuplicateDelLabResponsibleRegistryNumberValue." : ".$registry_number, ExceptionCodes::DuplicateDelLabResponsibleRegistryNumberValue);
        }

        //check for references============================================================================== 
        
        $oLabs = new LabsExt($db);
        $filter[] = new DFC(LabsExt::FIELD_LAB_RESPONSIBLE_ID, $LabResponsibleId, DFC::EXACT); 
        $countRows = $oLabs->findByFilter($db, $filter, true);
        $result["references_count"]=count( $countRows );
        
         if ($result["references_count"]!=0){
            $oLabTypes = new LabTypesExt($db);
            $oLabTypes->getAll($db);
            $oLabResponsibles->getAll($db, $filter);
            
            foreach ($countRows as $row) {
                $oSchoolUnit = $row->fetchSchoolUnits($db); //TODO improve speed code
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
            $arrayLabResponsibles[0]->deleteByFilter($db, $filter);  
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