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

function DelMunicipalities($name) {
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
            throw new Exception(ExceptionMessages::DeleteMunicipalityNameValue." : ".$name, ExceptionCodes::DeleteMunicipalityNameValue);
        } else {
            $filter = array( new DFC(MunicipalitiesExt::FIELD_NAME,$name, DFC::EXACT) );   
            $oMunicipalities = new MunicipalitiesExt($db);
            $arrayMunicipalities = $oMunicipalities->findByFilter($db, $filter, true);
        }

        if ( count($arrayMunicipalities) < 1) {
            throw new Exception(ExceptionMessages::DeleteNotFoundMunicipalityNameValue." : ".$name, ExceptionCodes::DeleteNotFoundMunicipalityNameValue);
        } else if ( count($arrayMunicipalities) == 1) {
            $MunicipalityId = $arrayMunicipalities[0]->getMunicipalityId();
            $MunicipalityName = $arrayMunicipalities[0]->getName();
            $result["result_found"]="Municipality_id = ".$MunicipalityId." // Name = ".$MunicipalityName;     
        } else {
            throw new Exception(ExceptionMessages::DuplicateDelMunicipalityNameValue." : ".$name, ExceptionCodes::DuplicateDelMunicipalityNameValue);
        }

        //check for references============================================================================== 
        
        $oSchoolUnits = new SchoolUnitsExt($db);
        $filter[] = new DFC(SchoolUnitsExt::FIELD_MUNICIPALITY_ID, $MunicipalityId, DFC::EXACT); 
        $countRows = $oSchoolUnits->findByFilter($db, $filter, true);
        $result["references_count"]=count( $countRows );
     
        if ($result["references_count"]!=0){
            
            $oRegionEduAdmins = new RegionEduAdminsExt($db);
            $oRegionEduAdmins->getAll($db);
             
            $oEduAdmins = new EduAdminsExt($db);
            $oEduAdmins->getAll($db);
            
            $oTransferArea = new TransferAreasExt($db);
            $oTransferArea->getAll($db);

            $oSchoolUnitTypes = new SchoolUnitTypesExt($db);
            $oSchoolUnitTypes->getAll($db);

            $oPrefectures = new PrefecturesExt($db);
            $oPrefectures->getAll($db);
            
            $oEducationLevels= new EducationLevelsExt($db);
            $oEducationLevels->getAll($db);
            
            $oMunicipalities->getAll($db,$filter);
        
            foreach ($countRows as $row) {   
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
            $arrayMunicipalities[0]->deleteByFilter($db, $filter);  
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