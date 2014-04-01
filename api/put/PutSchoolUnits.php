<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $school_unit_id
 * @param type $name
 * @param type $fax_number
 * @param type $phone_number
 * @param type $email
 * @param type $street_address
 * @param type $postal_code
 * @param type $region_edu_admin
 * @param type $edu_admin
 * @param type $transfer_area
 * @param type $municipality
 * @param type $prefecture
 * @param type $education_level
 * @param type $school_unit_type
 * @return string
 * @throws Exception
 */

function PutSchoolUnits($school_unit_id,$name,$fax_number,$phone_number,$email,$street_address,$postal_code,
                         $region_edu_admin,$edu_admin,$transfer_area,$municipality,$prefecture,
                         $education_level,$school_unit_type ) {
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
        
        $ffax_number=trim($fax_number);
        $fphone_number=trim($phone_number);
        $femail=trim($email);
        
        //#creation infos================================================================
        $flast_update = date('Y-m-d');
              
        //$name============================================================================
        if (! trim($name) )
            throw new Exception(ExceptionMessages::MissingNameValue." : ".$name, ExceptionCodes::MissingNameValue);
        else
            $filter[] = new DFC(SchoolUnitsExt::FIELD_NAME, $name, DFC::EXACT);       
        
        //$street_address===========================================================================
        if (! trim($street_address) )
            throw new Exception(ExceptionMessages::MissingStreetAddressValue." : ".$street_address, ExceptionCodes::MissingStreetAddressValue);
        else
            $fstreet_address = $street_address;
        
        //$postal_code===========================================================================
        if (! trim($postal_code) )
            throw new Exception(ExceptionMessages::MissingPostalCodeValue." : ".$postal_code, ExceptionCodes::MissingPostalCodeValue);
        else if (!is_numeric($postal_code)) 
            throw new Exception(ExceptionMessages::InvalidPostalCodeValue." : ".$postal_code, ExceptionCodes::InvalidPostalCodeValue);
        else
            $fpostal_code = $postal_code;

        //$region_edu_admin============================================================          
        if (! $region_edu_admin)
            throw new Exception(ExceptionMessages::CreateRegionEduAdminIdValue." : ".$region_edu_admin, ExceptionCodes::CreateRegionEduAdminIdValue);
        else {
              $oRegionEduAdmins = new RegionEduAdminsExt($db);

              if (is_numeric($region_edu_admin)) {
                  $filter[] = new DFC(RegionEduAdminsExt::FIELD_REGION_EDU_ADMIN_ID, $region_edu_admin, DFC::EXACT) ;
              } else { 
                  $filter[] = new DFC(RegionEduAdminsExt::FIELD_NAME, $region_edu_admin, DFC::EXACT);                
              }         
         }

        $arrayRegionEduAdmins = $oRegionEduAdmins->findByFilter($db, $filter, true);
        
        if ( count( $arrayRegionEduAdmins ) === 1 ) { 
            $fRegionEduAdmin = $arrayRegionEduAdmins[0]->getRegionEduAdminId();
        } else if ( count( $arrayRegionEduAdmins ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicateRegionEduAdminIdValue." : ".$region_edu_admin, ExceptionCodes::DuplicateRegionEduAdminIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidRegionEduAdminValue." : ".$region_edu_admin, ExceptionCodes::InvalidRegionEduAdminValue);
        }  
        
        //$edu_admin======================================================================          
        if (! $edu_admin)
            throw new Exception(ExceptionMessages::CreateEduAdminIdValue." : ".$edu_admin, ExceptionCodes::CreateEduAdminIdValue);
        else {
              $oEduAdmins = new EduAdminsExt($db);

              if (is_numeric($edu_admin)) {
                  $filter[] = new DFC(EduAdminsExt::FIELD_EDU_ADMIN_ID, $edu_admin, DFC::EXACT) ;
              } else { 
                  $filter[] = new DFC(EduAdminsExt::FIELD_NAME, $edu_admin, DFC::EXACT);                
              }         
         }

        $arrayEduAdmins = $oEduAdmins->findByFilter($db, $filter, true);
        
        if ( count( $arrayEduAdmins ) === 1 ) { 
            $fEduAdmin = $arrayEduAdmins[0]->getEduAdminId();
        } else if ( count( $arrayEduAdmins ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicateEduAdminIdValue." : ".$edu_admin, ExceptionCodes::DuplicateEduAdminIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidEduAdminValue." : ".$edu_admin, ExceptionCodes::InvalidEduAdminValue);
        }  
        
        //$transfer_area============================================================          
        if (! $transfer_area)
            throw new Exception(ExceptionMessages::CreateTransferAreaIdValue." : ".$transfer_area, ExceptionCodes::CreateTransferAreaIdValue);
        else {
              $oTranferAreas= new TransferAreasExt($db);

              if (is_numeric($transfer_area)) {
                  $filter[] = new DFC(TransferAreasExt::FIELD_TRANSFER_AREA_ID, $transfer_area, DFC::EXACT) ;
              } else { 
                  $filter[] = new DFC(TransferAreasExt::FIELD_NAME, $transfer_area, DFC::EXACT);                
              }         
         }

        $arrayTranferAreas = $oTranferAreas->findByFilter($db, $filter, true);
        
        if ( count( $arrayTranferAreas ) === 1 ) { 
            $fTransferArea = $arrayTranferAreas[0]->getTransferAreaId();
        } else if ( count( $arrayTranferAreas ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicateTransferAreaIdValue." : ".$transfer_area, ExceptionCodes::DuplicateTransferAreaIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidTransferAreaValue." : ".$transfer_area, ExceptionCodes::InvalidTransferAreaValue);
        }  

        //$prefecture============================================================          
        if (! $prefecture)
            throw new Exception(ExceptionMessages::CreatePrefectureIdValue." : ".$prefecture, ExceptionCodes::CreatePrefectureIdValue);
        else {
              $oPrefectures= new PrefecturesExt($db);

              if (is_numeric($prefecture)) {
                  $filter[] = new DFC(PrefecturesExt::FIELD_PREFECTURE_ID, $prefecture, DFC::EXACT) ;
              } else { 
                  $filter[] = new DFC(PrefecturesExt::FIELD_NAME, $prefecture, DFC::EXACT);                
              }         
         }

        $arrayPrefectures = $oPrefectures->findByFilter($db, $filter, true);
        
        if ( count( $arrayPrefectures ) === 1 ) { 
            $fPrefecture = $arrayPrefectures[0]->getPrefectureId();
        } else if ( count( $arrayPrefectures ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicatePrefectureIdValue." : ".$prefecture, ExceptionCodes::DuplicatePrefectureIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidPrefectureValue." : ".$prefecture, ExceptionCodes::InvalidPrefectureValue);
        }  
        
        //$municipality============================================================          
        if (! $municipality)
            throw new Exception(ExceptionMessages::CreateMunicipalityIdValue." : ".$municipality, ExceptionCodes::CreateMunicipalityIdValue);
        else {
              $oMunicipalities= new MunicipalitiesExt($db);

              if (is_numeric($municipality)) {
                  $filter[] = new DFC(MunicipalitiesExt::FIELD_MUNICIPALITY_ID, $municipality, DFC::EXACT) ;
              } else { 
                  $filter[] = new DFC(MunicipalitiesExt::FIELD_NAME, $municipality, DFC::EXACT);                
              }         
         }

        $arrayMunicipalities = $oMunicipalities->findByFilter($db, $filter, true);
        
        if ( count( $arrayMunicipalities ) === 1 ) { 
            $fMunicipality = $arrayMunicipalities[0]->getMunicipalityId();
        } else if ( count( $arrayMunicipalities ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicateMunicipalityIdValue." : ".$municipality, ExceptionCodes::DuplicateMunicipalityIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidMunicipalityValue." : ".$municipality, ExceptionCodes::InvalidMunicipalityValue);
        }  

        //$education_level============================================================          
        if (! $education_level)
            throw new Exception(ExceptionMessages::CreateEducationLevelIdValue." : ".$education_level, ExceptionCodes::CreateEducationLevelIdValue);
        else {
              $oEducationLevels = new EducationLevelsExt($db);

              if (is_numeric($education_level)) {
                  $filter[] = new DFC(EducationLevelsExt::FIELD_EDUCATION_LEVEL_ID, $education_level, DFC::EXACT) ;
              } else { 
                  $filter[] = new DFC(EducationLevelsExt::FIELD_NAME, $education_level, DFC::EXACT);                
              }         
         }

        $arrayEducationLevels = $oEducationLevels->findByFilter($db, $filter, true);
        
        if ( count( $arrayEducationLevels ) === 1 ) { 
            $fEducationLevel = $arrayEducationLevels[0]->getEducationLevelId();
        } else if ( count( $arrayEducationLevels ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicateEducationLevelIdValue." : ".$education_level, ExceptionCodes::DuplicateEducationLevelIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidEducationLevelValue." : ".$education_level, ExceptionCodes::InvalidEducationLevelValue);
        }  
        
        //$school_unit_type============================================================          
        if (! $school_unit_type)
            throw new Exception(ExceptionMessages::CreateSchoolUnitTypeIdValue." : ".$school_unit_type, ExceptionCodes::CreateSchoolUnitTypeIdValue);
        else {
              $oSchoolUnitTypes = new SchoolUnitTypesExt($db);

              if (is_numeric($school_unit_type)) {
                  $filter[] = new DFC(SchoolUnitTypesExt::FIELD_SCHOOL_UNIT_TYPE_ID, $school_unit_type, DFC::EXACT) ;
              } else { 
                  $filter[] = new DFC(SchoolUnitTypesExt::FIELD_NAME, $school_unit_type, DFC::EXACT);                
              }         
         }

        $arraySchoolUnitTypes = $oSchoolUnitTypes->findByFilter($db, $filter, true);
        
        if ( count( $arraySchoolUnitTypes ) === 1 ) { 
            $fSchoolUnitType = $arraySchoolUnitTypes[0]->getSchoolUnitTypeId();
        } else if ( count( $arraySchoolUnitTypes ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicateSchoolUnitTypeIdValue." : ".$school_unit_type, ExceptionCodes::DuplicateSchoolUnitTypeIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidSchoolUnitTypeValue." : ".$school_unit_type, ExceptionCodes::InvalidSchoolUnitTypeValue);
        }  
               
        //$school_unit_id===========================================================================  
        if (! $school_unit_id) {
            throw new Exception(ExceptionMessages::MissingSchoolUnitIdValue." : ".$school_unit_id, ExceptionCodes::MissingSchoolUnitIdValue);
        } else if (!is_numeric($school_unit_id)) {
            throw new Exception(ExceptionMessages::InvalidSchoolUnitIdValue." : ".$school_unit_id, ExceptionCodes::InvalidSchoolUnitIdValue);
        } else {
            $uSchoolUnits = SchoolUnitsExt::findById($db, $school_unit_id);
        }
     
        //=================================================================================================
        $result["total_found"]=count($uSchoolUnits);
                                                                                                            
        if ($result["total_found"]==1){
            
            $values["school_unit_id"] = $uSchoolUnits->getSchoolUnitId();
            $values["name"] = $uSchoolUnits->getName();
            $values["fax_number"] = $uSchoolUnits->getFaxNumber();
            $values["phone_number"] = $uSchoolUnits->getPhoneNumber();
            $values["email"] = $uSchoolUnits->getEmail();
            $values["street_address"] = $uSchoolUnits->getStreetAddress();
            $values["postal_code"] =  $uSchoolUnits->getPostalCode();
            $values["region_edu_admin"] =  $uSchoolUnits->getRegionEduAdminId();
            $values["edu_admin"] =  $uSchoolUnits->getEduAdminId();
            $values["transfer_area"] =  $uSchoolUnits->getTransferAreaId();
            $values["municipality"] =  $uSchoolUnits->getMunicipalityId();
            $values["prefecture"] =  $uSchoolUnits->getPrefectureId();
            $values["education_level"] =  $uSchoolUnits->getEducationLevelId();
            $values["school_unit_type"] =  $uSchoolUnits->getSchoolUnitTypeId();
            $values["last_update"] =  $uSchoolUnits->getLastUpdate();
            $result["values"] = $values;
            
            //check if $name is same as old name of same entry
            $oSchoolUnits = new SchoolUnitsExt($db);
            $arraySchoolUnits = $oSchoolUnits->findByFilter($db, $filter, true);

                if (( count( $arraySchoolUnits ) > 0 ) && ($values["name"]!=$name)) { 
                     throw new Exception(ExceptionMessages::DuplicateSchoolUnitValue." : ".$name, ExceptionCodes::DuplicateSchoolUnitValue);
                }  
                
            $update_values["school_unit_id"] = $school_unit_id;
            $update_values["name"] = $name;
            $update_values["fax_number"] = $ffax_number;
            $update_values["phone_number"] = $fphone_number;
            $update_values["email"] = $femail;
            $update_values["street_address"] = $fstreet_address;
            $update_values["postal_code"] = $fpostal_code;
            $update_values["region_edu_admin"] = $fRegionEduAdmin;
            $update_values["edu_admin"] = $fEduAdmin;
            $update_values["transfer_area"] = $fTransferArea;
            $update_values["municipality"] = $fMunicipality;
            $update_values["prefecture"] = $fPrefecture;
            $update_values["education_level"] = $fEducationLevel;
            $update_values["school_unit_type"] = $fSchoolUnitType;
            $update_values["last_update"] =  $flast_update;
            $result["updated_values"] = $update_values;
            
            $uSchoolUnits->setName($name);     
            $uSchoolUnits->setFaxNumber($ffax_number);
            $uSchoolUnits->setPhoneNumber($fphone_number);
            $uSchoolUnits->setEmail($femail);
            $uSchoolUnits->setStreetAddress($fstreet_address);
            $uSchoolUnits->setPostalCode($fpostal_code);
            $uSchoolUnits->setRegionEduAdminId($fRegionEduAdmin);
            $uSchoolUnits->setEduAdminId($fEduAdmin);
            $uSchoolUnits->setTransferAreaId($fTransferArea);
            $uSchoolUnits->setPrefectureId($fPrefecture);
            $uSchoolUnits->setMunicipalityId($fMunicipality);
            $uSchoolUnits->setEducationLevelId($fEducationLevel);
            $uSchoolUnits->setSchoolUnitTypeId($fSchoolUnitType);
            $uSchoolUnits->setLastUpdate($update_values["last_update"]);
            
            $uSchoolUnits->updateToDatabase($db);

            $result["status"] = 200;
            $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success"; 

        } else if ($result["total_found"]==0){
            throw new Exception(ExceptionMessages::UpdateSchoolUnitIdValue." : ".$school_unit_id, ExceptionCodes::UpdateSchoolUnitIdValue);
        } else {
           throw new Exception(ExceptionMessages::DuplicateSchoolUnitIdValue." : ".$school_unit_id, ExceptionCodes::DuplicateSchoolUnitIdValue);
        }
        
    } catch (Exception $e){      
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    }  
    return $result;
}

?>