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


function DelRegionEduAdmins($name) {
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
            throw new Exception(ExceptionMessages::DeleteRegionEduAdminNameValue." : ".$name, ExceptionCodes::DeleteRegionEduAdminNameValue);
        } else {
            $filter = array( new DFC(RegionEduAdminsExt::FIELD_NAME,$name, DFC::EXACT) );
            $oRegionEduAdmins = new RegionEduAdminsExt($db);
            $arrayRegionEduAdmins = $oRegionEduAdmins->findByFilter($db, $filter, true);
        }
  
        if ( count($arrayRegionEduAdmins) < 1 ) {
            throw new Exception(ExceptionMessages::DeleteNotFoundRegionEduAdminNameValue." : ".$name, ExceptionCodes::DeleteNotFoundRegionEduAdminNameValue);
        } else if (count($arrayRegionEduAdmins) == 1) {
            $RegionEduAdminId = $arrayRegionEduAdmins[0]->getRegionEduAdminId();
            $RegionEduAdminName = $arrayRegionEduAdmins[0]->getName();
            $result["result_found"]="Region_edu_admin_id = ".$RegionEduAdminId." // Name = ".$RegionEduAdminName;
        } else {
            throw new Exception(ExceptionMessages::DuplicateDelRegionEduAdminNameValue." : ".$name, ExceptionCodes::DuplicateDelRegionEduAdminNameValue);
        }
        
        //check for references============================================================================== 
                       
        $oEduAdmins = new EduAdminsExt($db);   
        $filter[] = new DFC(EduAdminsExt::FIELD_REGION_EDU_ADMIN_ID, $RegionEduAdminId, DFC::EXACT); 
        $countRowsEduAdmins = $oEduAdmins->findByFilter($db, $filter, true);
        $result["references_edu_admins_count"]=count( $countRowsEduAdmins );
        
        if ($result["references_edu_admins_count"]!=0){
            foreach ($countRowsEduAdmins as $row) {   
                $result["edu_admin_references"][] = array(  "edu_admin_id" => $row->getEduAdminId(), 
                                                            "name" => $row->getName(),
                                                            "region_edu_admin_id"=>$row->getRegionEduAdminId()
                                                        );
            }
            throw new Exception(ExceptionMessages::ReferencesEduAdmins, ExceptionCodes::ReferencesEduAdmins);
        }
        
        $oSchoolUnits = new SchoolUnitsExt($db);
        $filter[] = new DFC(SchoolUnitsExt::FIELD_REGION_EDU_ADMIN_ID, $RegionEduAdminId, DFC::EXACT); 
        $countRowsSchoolUnits = $oSchoolUnits->findByFilter($db, $filter, true);
        $result["references_school_units_count"]=count( $countRowsSchoolUnits );
        
         if ($result["references_school_units_count"]!=0){
            
            $oPrefectures = new PrefecturesExt($db);
            $oPrefectures->getAll($db);
             
            $oEduAdmins = new EduAdminsExt($db);
            $oEduAdmins->getAll($db);
            
            $oTransferArea = new TransferAreasExt($db);
            $oTransferArea->getAll($db);

            $oMunicipalities = new MunicipalitiesExt($db);
            $oMunicipalities->getAll($db);

            $oSchoolUnitTypes = new SchoolUnitTypesExt($db);
            $oSchoolUnitTypes->getAll($db);
            
            $oEducationLevels = new EducationLevelsExt($db);
            $oEducationLevels->getAll($db);
            
            $oRegionEduAdmins->getAll($db, $filter);
            
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
            $arrayRegionEduAdmins[0]->deleteByFilter($db, $filter);  
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