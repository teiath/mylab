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

function DelEduAdmins($name) {
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
            throw new Exception(ExceptionMessages::DeleteEduAdminNameValue." : ".$name, ExceptionCodes::DeleteEduAdminNameValue);
        } else {
            $filter = array( new DFC(EduAdminsExt::FIELD_NAME,$name, DFC::EXACT) );   
            $oEduAdmins = new EduAdminsExt($db);
            $arrayEduAdmins = $oEduAdmins->findByFilter($db, $filter, true);
        }

        if ( count($arrayEduAdmins) < 1) {
            throw new Exception(ExceptionMessages::DeleteNotFoundEduAdminNameValue." : ".$name, ExceptionCodes::DeleteNotFoundEduAdminNameValue);
        } else if ( count($arrayEduAdmins) == 1) {
            $EduAdminId = $arrayEduAdmins[0]->getEduAdminId();
            $EduAdminName = $arrayEduAdmins[0]->getName();
            $result["result_found"]="Edu_admin_id = ".$EduAdminId." // Name = ".$EduAdminName;     
        } else {
            throw new Exception(ExceptionMessages::DuplicateDelEduAdminNameValue." : ".$name, ExceptionCodes::DuplicateDelEduAdminNameValue);
        }

        //check for references============================================================================== 
        
        $oTransferAreas = new TransferAreasExt($db);   
        $filter[] = new DFC(TransferAreasExt::FIELD_EDU_ADMIN_ID, $EduAdminId, DFC::EXACT); 
        $countRowsTransferAreas = $oTransferAreas->findByFilter($db, $filter, true);
        $result["references_transfer_areas_count"]=count( $countRowsTransferAreas );
        
        if ($result["references_transfer_areas_count"]!=0){
            foreach ($countRowsTransferAreas as $row) {   
                $result["transfer_areas_references"][] = array( "transfer_area_id" => $row->getTransferAreaId(), 
                                                                "name" => $row->getName(),
                                                                "adu_admin_id" => $row->getEduAdminId()
                                                        );
            }
            throw new Exception(ExceptionMessages::ReferencesTransferAreas, ExceptionCodes::ReferencesTransferAreas);
        }
            
        $oSchoolUnits = new SchoolUnitsExt($db);
        $filter[] = new DFC(SchoolUnitsExt::FIELD_EDU_ADMIN_ID, $EduAdminId, DFC::EXACT); 
        $countRowsSchoolUnits = $oSchoolUnits->findByFilter($db, $filter, true);
        $result["references_school_units_count"]=count( $countRowsSchoolUnits );
     
        if ($result["references_school_units_count"]!=0){
            
            $oRegionEduAdmins = new RegionEduAdminsExt($db);
            $oRegionEduAdmins->getAll($db);
             
            $oSchoolUnitTypes = new SchoolUnitsExt($db);
            $oSchoolUnitTypes->getAll($db);
            
            $oTransferArea = new TransferAreasExt($db);
            $oTransferArea->getAll($db);

            $oMunicipalities = new MunicipalitiesExt($db);
            $oMunicipalities->getAll($db);

            $oPrefectures = new PrefecturesExt($db);
            $oPrefectures->getAll($db);
            
            $oEducationLevels= new EducationLevelsExt($db);
            $oEducationLevels->getAll($db);
            
            $oEduAdmins->getAll($db,$filter);
        
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
            $arrayEduAdmins[0]->deleteByFilter($db, $filter);  
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