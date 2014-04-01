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


function DelEducationLevels($name) {
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
            throw new Exception(ExceptionMessages::DeleteEducationLevelNameValue." : ".$name, ExceptionCodes::DeleteEducationLevelNameValue);
        } else {
            $filter = array( new DFC(EducationLevelsExt::FIELD_NAME,$name, DFC::EXACT) );
            $oEducationLevels = new EducationLevelsExt($db);
            $arrayEducationLevels = $oEducationLevels->findByFilter($db, $filter, true);
        }
  
        if ( count($arrayEducationLevels) < 1 ) {
            throw new Exception(ExceptionMessages::DeleteNotFoundEducationLevelNameValue." : ".$name, ExceptionCodes::DeleteNotFoundEducationLevelNameValue);
        } else if (count($arrayEducationLevels) == 1) {
            $EducationLevelId = $arrayEducationLevels[0]->getEducationLevelId();
            $EducationLevelName = $arrayEducationLevels[0]->getName();
            $result["result_found"]="Education_level_id = ".$EducationLevelId." // Name = ".$EducationLevelName;
        } else {
            throw new Exception(ExceptionMessages::DuplicateDelEducationLevelNameValue." : ".$name, ExceptionCodes::DuplicateDelEducationLevelNameValue);
        }
        
        //check for references============================================================================== 
        
        $oSchoolUnitTypes = new SchoolUnitTypesExt($db);   
        $filter[] = new DFC(SchoolUnitTypesExt::FIELD_EDUCATION_LEVEL_ID, $EducationLevelId, DFC::EXACT); 
        $countRowsSchoolUnitTypes = $oSchoolUnitTypes->findByFilter($db, $filter, true);
        $result["references_school_unit_types_count"]=count( $countRowsSchoolUnitTypes );
        
        if ($result["references_school_unit_types_count"]!=0){
            foreach ($countRowsSchoolUnitTypes as $row) {   
                $result["school_unit_types_references"][] = array(  "school_unit_type_id" => $row->getSchoolUnitTypeId(), 
                                                                    "name" => $row->getName(),
                                                                    "education_id" => $row->getEducationLevelId()
                                                        );
            }
            throw new Exception(ExceptionMessages::ReferencesSchoolUnitTypes, ExceptionCodes::ReferencesSchoolUnitTypes);
        }
        
        $oSchoolUnits = new SchoolUnitsExt($db);
        $filter[] = new DFC(SchoolUnitsExt::FIELD_EDUCATION_LEVEL_ID, $EducationLevelId, DFC::EXACT); 
        $countRowsSchoolUnits = $oSchoolUnits->findByFilter($db, $filter, true);
        $result["references_school_units_count"]=count( $countRowsSchoolUnits );
        
         if ($result["references_school_units_count"]!=0){
            
            $oRegionEduAdmins = new RegionEduAdminsExt($db);
            $oRegionEduAdmins->getAll($db);
             
            $oEduAdmins = new EduAdminsExt($db);
            $oEduAdmins->getAll($db);
            
            $oTransferArea = new TransferAreasExt($db);
            $oTransferArea->getAll($db);

            $oMunicipalities = new MunicipalitiesExt($db);
            $oMunicipalities->getAll($db);

            $oPrefectures = new PrefecturesExt($db);
            $oPrefectures->getAll($db);

            $oSchoolUnitTypes = new SchoolUnitTypesExt($db);
            $oSchoolUnitTypes->getAll($db);
            
            $oEducationLevels->getAll($db, $filter);
            
            foreach ($countRowsSchoolUnits as $row) {   
                $result["school_units_references"][] = array(   "school_unit_id" => $row->getSchoolUnitId(), 
                                                        "name" => $row->getName(),
                                                        "last_update"=>$row->getLastUpdate(),
                                                        "fax_number"=>$row->getFaxNumber(),
                                                        "phone_number"=>$row->getPhoneNumber(),
                                                        "email"=>$row->getEmail(),
                                                        "street_address"=>$row->getStreetAddress(),
                                                        "postal_code"=>$row->getPostalCode(),
                                                        "region_edu_admin" => $oRegionEduAdmins->searchArrayForID($row->getRegionEduAdminId())->getName(),
                                                        "edu_admin" => $oEduAdmins->searchArrayForID($row->getEduAdminId())->getName(),
                                                        "transfer_area"=> $oTransferArea->searchArrayForID($row->getTransferAreaId())->getName(),
                                                        "municipality"=> $oMunicipalities->searchArrayForID($row->getMunicipalityId())->getName(),
                                                        "prefecture"=> $oPrefectures->searchArrayForID($row->getPrefectureId())->getName(),
                                                        "education_level"=> $oEducationLevels->searchArrayForID($row->getEducationLevelId())->getName(),
                                                        "school_unit_type"=> $oSchoolUnitTypes->searchArrayForID($row->getSchoolUnitTypeId())->getName() 
                                                    );
            }
            throw new Exception(ExceptionMessages::ReferencesSchoolUnits, ExceptionCodes::ReferencesSchoolUnits);         
        } else {
            $arrayEducationLevels[0]->deleteByFilter($db, $filter);  
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