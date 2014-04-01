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

function DelTransferAreas($name) {
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
            throw new Exception(ExceptionMessages::DeleteTransferAreaNameValue." : ".$name, ExceptionCodes::DeleteTransferAreaNameValue);
        } else {
            $filter = array( new DFC(TransferAreasExt::FIELD_NAME,$name, DFC::EXACT) );   
            $oTransferAreas = new TransferAreasExt($db);
            $arrayTransferAreas = $oTransferAreas->findByFilter($db, $filter, true);
        }

        if ( count($arrayTransferAreas) < 1) {
            throw new Exception(ExceptionMessages::DeleteNotFoundEduAdminNameValue." : ".$name, ExceptionCodes::DeleteNotFoundEduAdminNameValue);
        } else if ( count($arrayTransferAreas) == 1) {
            $TransferAreaId = $arrayTransferAreas[0]->getTransferAreaId();
            $TransferAreaName = $arrayTransferAreas[0]->getName();
            $result["result_found"]="Transfer_area_id = ".$TransferAreaId." // Name = ".$TransferAreaName;     
        } else {
            throw new Exception(ExceptionMessages::DuplicateDelTransferAreaNameValue." : ".$name, ExceptionCodes::DuplicateDelTransferAreaNameValue);
        }

        //check for references============================================================================== 
        
        $oMunicipalities = new MunicipalitiesExt($db);   
        $filter[] = new DFC(MunicipalitiesExt::FIELD_TRANSFER_AREA_ID, $TransferAreaId, DFC::EXACT); 
        $countRowsMunicipalities = $oMunicipalities->findByFilter($db, $filter, true);
        $result["references_municipalities_count"]=count( $countRowsMunicipalities );
        
        if ($result["references_municipalities_count"]!=0){
            foreach ($countRowsMunicipalities as $row) {   
                $result["municipalities_references"][] = array( "municipality_id" => $row->getMunicipalityId(), 
                                                                "name" => $row->getName(),
                                                                "transfer_area_id" => $row->getTransferAreaId(),
                                                                "prefecture_id"=>$row->getPrefectureId()
                                                        );
            }
            throw new Exception(ExceptionMessages::ReferencesMunicipalities, ExceptionCodes::ReferencesMunicipalities);
        }
            
        $oSchoolUnits = new SchoolUnitsExt($db);
        $filter[] = new DFC(SchoolUnitsExt::FIELD_TRANSFER_AREA_ID, $TransferAreaId, DFC::EXACT); 
        $countRowsSchoolUnits = $oSchoolUnits->findByFilter($db, $filter, true);
        $result["references_school_units_count"]=count( $countRowsSchoolUnits );
     
        if ($result["references_school_units_count"]!=0){
            
            $oRegionEduAdmins = new RegionEduAdminsExt($db);
            $oRegionEduAdmins->getAll($db);
             
            $oSchoolUnitTypes = new SchoolUnitsExt($db);
            $oSchoolUnitTypes->getAll($db);
            
            $oEduAdmins = new EduAdminsExt($db);
            $oEduAdmins->getAll($db);

            $oMunicipalities = new MunicipalitiesExt($db);
            $oMunicipalities->getAll($db);

            $oPrefectures = new PrefecturesExt($db);
            $oPrefectures->getAll($db);
            
            $oEducationLevels= new EducationLevelsExt($db);
            $oEducationLevels->getAll($db);
            
            $oTransferAreas->getAll($db,$filter);
       
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
                                                        "transfer_area"=> $oTransferAreas->searchArrayForID($row->getTransferAreaId())->getName(),
                                                        "municipality"=> $oMunicipalities->searchArrayForID($row->getMunicipalityId())->getName(),
                                                        "prefecture"=> $oPrefectures->searchArrayForID($row->getPrefectureId())->getName(),
                                                        "education_level"=> $oEducationLevels->searchArrayForID($row->getEducationLevelId())->getName(),
                                                        "school_unit_type"=> $oSchoolUnitTypes->searchArrayForID($row->getSchoolUnitTypeId())->getName() 
                                                    );
            }
            throw new Exception(ExceptionMessages::ReferencesSchoolUnits, ExceptionCodes::ReferencesSchoolUnits);
        } else {
            $arrayTransferAreas[0]->deleteByFilter($db, $filter);  
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