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

function DelSchoolUnitTypes($name) {
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
            throw new Exception(ExceptionMessages::DeleteSchoolUnitTypeNameValue." : ".$name, ExceptionCodes::DeleteSchoolUnitTypeNameValue);
        } else {
            $filter = array( new DFC(SchoolUnitTypesExt::FIELD_NAME,$name, DFC::EXACT) );   
            $oSchoolUnitTypes = new SchoolUnitTypesExt($db);
            $arraySchoolUnitTypes = $oSchoolUnitTypes->findByFilter($db, $filter, true);
        }

        if ( count($arraySchoolUnitTypes) < 1) {
            throw new Exception(ExceptionMessages::DeleteNotFoundSchoolUnitTypeNameValue." : ".$name, ExceptionCodes::DeleteNotFoundSchoolUnitTypeNameValue);
        } else if ( count($arraySchoolUnitTypes) == 1) {
            $SchoolUnitTypeId = $arraySchoolUnitTypes[0]->getSchoolUnitTypeId();
            $SchoolUnitTypeName = $arraySchoolUnitTypes[0]->getName();
            $result["result_found"]="School_unit_type_id = ".$SchoolUnitTypeId." // Name = ".$SchoolUnitTypeName;     
        } else {
            throw new Exception(ExceptionMessages::DuplicateDelSchoolUnitTypeNameValue." : ".$name, ExceptionCodes::DuplicateDelSchoolUnitTypeNameValue);
        }

        //check for references============================================================================== 
        
        $oSchoolUnits = new SchoolUnitsExt($db);
        $filter[] = new DFC(SchoolUnitsExt::FIELD_SCHOOL_UNIT_TYPE_ID, $SchoolUnitTypeId, DFC::EXACT); 
        $countRows = $oSchoolUnits->findByFilter($db, $filter, true);
        $result["references_count"]=count( $countRows );
     
        if ($result["references_count"]!=0){
            
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
            
            $oEducationLevels= new EducationLevelsExt($db);
            $oEducationLevels->getAll($db);
            
            $oSchoolUnitTypes->getAll($db,$filter);
        
            foreach ($countRows as $row) {   
                $result["data_references"][] = array(   "school_unit_id" => $row->getSchoolUnitId(), 
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
            $arraySchoolUnitTypes[0]->deleteByFilter($db, $filter);  
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