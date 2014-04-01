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


function DelPrefectures($name) {
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
            throw new Exception(ExceptionMessages::DeletePrefectureNameValue." : ".$name, ExceptionCodes::DeletePrefectureNameValue);
        } else {
            $filter = array( new DFC(PrefecturesExt::FIELD_NAME,$name, DFC::EXACT) );
            $oPrefectures = new PrefecturesExt($db);
            $arrayPrefectures = $oPrefectures->findByFilter($db, $filter, true);
        }
  
        if ( count($arrayPrefectures) < 1 ) {
            throw new Exception(ExceptionMessages::DeleteNotFoundPrefectureNameValue." : ".$name, ExceptionCodes::DeleteNotFoundPrefectureNameValue);
        } else if (count($arrayPrefectures) == 1) {
            $PrefectureId = $arrayPrefectures[0]->getPrefectureId();
            $PrefectureName = $arrayPrefectures[0]->getName();
            $result["result_found"]="Prefecture_id = ".$PrefectureId." // Name = ".$PrefectureName;
        } else {
            throw new Exception(ExceptionMessages::DuplicateDelPrefectureNameValue." : ".$name, ExceptionCodes::DuplicateDelPrefectureNameValue);
        }
        
        //check for references============================================================================== 
        
        $oMunicipalities = new MunicipalitiesExt($db);   
        $filter[] = new DFC(MunicipalitiesExt::FIELD_PREFECTURE_ID, $PrefectureId, DFC::EXACT); 
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
        $filter[] = new DFC(SchoolUnitsExt::FIELD_PREFECTURE_ID, $PrefectureId, DFC::EXACT); 
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

            $oSchoolUnitTypes = new SchoolUnitTypesExt($db);
            $oSchoolUnitTypes->getAll($db);
            
            $oEducationLevels = new EducationLevelsExt($db);
            $oEducationLevels->getAll($db);
            
            $oPrefectures->getAll($db, $filter);
            
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
            $arrayPrefectures[0]->deleteByFilter($db, $filter);  
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