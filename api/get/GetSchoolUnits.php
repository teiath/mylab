<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $school_unit_id
 * @param type $name
 * @param type $region_edu_admin
 * @param type $edu_admin
 * @param type $transfer_area
 * @param type $municipality
 * @param type $prefecture
 * @param type $education_level
 * @param type $school_unit_type
 * @param type $state
 * @param type $lab_type
 * @param type $operational_rating
 * @param type $technological_rating
 * @param type $lab_state
 * @param type $aquisition_source
 * @param type $equipment_type
 * @param type $lab_id
 * @param type $lab_worker
 * @param type $pagesize
 * @param int $page
 * @param string $sort_field
 * @param type $sort_mode
 * @return string
 * @throws Exception
 */

function GetSchoolUnits($school_unit_id, $name, $region_edu_admin, $edu_admin, $transfer_area, $municipality, $prefecture, $education_level, $school_unit_type,
                        $state, $lab_type, $operational_rating, $technological_rating, $lab_state, $aquisition_source, $equipment_type, $lab_id, $lab_worker, 
                        $pagesize, $page, $sort_field, $sort_mode ) {
    global $db;
    global $Options;
    global $app;
    
    $filter = array();
    $result = array();
    
    $lab_type_filters = array();
    $lab_state_filters = array();
    $operational_rating_filters = array();
    $technological_rating_filters = array();
    $aquisition_filters = array();
    $equipment_type_filters = array();
    $municipalities_filters = array();
    $lab_worker_filters = array();
    $result["data"] = array();
   
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();

    try {
       
        //= $page ==============================================================
        if (! $page)
            $page = 1;
        else if (intval($page) < 0)
	        throw new Exception(ExceptionMessages::InvalidPageNumber." : ".$page, ExceptionCodes::InvalidPageNumber);
        else if (!is_numeric($page))
	        throw new Exception(ExceptionMessages::InvalidPageType." : ".$page, ExceptionCodes::InvalidPageType);
         //= $pagesize ==============================================================
        if (! $pagesize)
            $pagesize = $Options["PageSize"];
        else if (intval($pagesize) < 0)
	        throw new Exception(ExceptionMessages::InvalidPageSizeNumber." : ".$pagesize, ExceptionCodes::InvalidPageSizeNumber);
        else if (!is_numeric($pagesize))
	        throw new Exception(ExceptionMessages::InvalidPageSizeType." : ".$pagesize, ExceptionCodes::InvalidPageSizeType);
        
        $startat = ($page -1) * $pagesize;
        
        //= Sort Mode Labs=================================================
//         if (! $sort_mode)
//            $sort_mode = $Options["SortMode"];
//         else if ( ( $sort_mode != ("ASC" | 0) ) && ( $sort_mode != ("DESC" | 1) ) )   
//            throw new Exception(ExceptionMessages::InvalidSortModeType." : ".$sort_mode, ExceptionCodes::InvalidSortModeType);
//         else if ($sort_mode === "ASC") 
//             $sort_mode=0;
//         else if ($sort_mode === "DESC") 
//             $sort_mode=1;
        
        if (isset($sort_mode))
        {
            $columns = array("ASC", "DESC");
            
            if (!in_array(strtoupper($sort_mode), $columns))
                throw new Exception(ExceptionMessages::InvalidSortModeType." : ".$sort_mode, ExceptionCodes::InvalidSortModeType);
  
            if ($sort_mode === "DESC")
                $sort_mode = 1;
            else if ($sort_mode === "ASC")
                $sort_mode = 0;
  
        }
        else
            $sort_mode = 0;
        
        //= Sort Field Labs=================================================
//           if (! $sort_field){
//               $sort_field = SchoolUnitsExt::FIELD_NAME; 
//           }else if ($sort_field === "name")     
//               $sort_field = SchoolUnitsExt::FIELD_NAME;
//           else if ($sort_field === "school_unit_type")     
//               $sort_field = SchoolUnitTypesExt::FIELD_NAME; 
//           else if ($sort_field === "municipality")     
//               $sort_field = MunicipalitiesExt::FIELD_NAME;
//           else if ($sort_field === "edu_admin")     
//               $sort_field = EduAdminsExt::FIELD_NAME; 
//           else
//               throw new Exception(ExceptionMessages::InvalidSortFieldType." : ".$sort_field, ExceptionCodes::InvalidSortFieldType);
         
          if (isset($sort_field))
        {
            $columns = array("school_unit_id","name","region_edu_admin","edu_admin","transfer_area","municipality","prefecture","education_level","school_unit_type");
             
            if (!in_array($sort_field, $columns))
                throw new Exception(ExceptionMessages::InvalidSortFieldType." : ".$sort_field, ExceptionCodes::InvalidSortFieldType);
        }
        else
            $sort_field = "school_unit_id";
    
        //= $school_unit ================================================== 
        
        $paramFilter = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/", $school_unit_id);

        foreach ($arrayValues as $school_unit_id)
        {
            $school_unit_id = trim($school_unit_id);

            if (($school_unit_id) && (!is_numeric($school_unit_id)))
            {
                throw new Exception(ExceptionMessages::InvalidSchoolUnitIdValue." : ".$school_unit_id, ExceptionCodes::InvalidSchoolUnitIdValue);
            }
            else if (is_numeric($school_unit_id))
            {
                $paramFilter[] = new DFC(SchoolUnitsExt::FIELD_SCHOOL_UNIT_ID, $school_unit_id, DFC::EXACT);
            }
        }
        
        if ( count($paramFilter) > 0 )
        {
            $filter[] = new DFCAggregate($paramFilter, false);
        }
        
        //= $name ======================================================================================================================================================
        
        if ($name){
            
        $groups = preg_split("/[\s]*[,][\s]*/", $name);    //regexp ","
       
            foreach ($groups as $group)
            {       
                    $lines = preg_split("/[\s]*[ ][\s]*/", $group);  //regexp "&"

                    $wordset = array();
                    foreach ($lines as $lineword)
                    {
                            $wordset[] = preg_split("/[\s]*[|][\s]*/", $lineword);  //regexp "|"
                    }
                    
                    $names_filters = array();
                    $names_filters_or = array();
                    
                    foreach($wordset as $words)
                    {
                        if (count($words) == 1)
                        {
                            $isNot = substr($words[0], 0, 1) == "!" ? true : false;
                                if ($isNot)
                                {
                                  $rm_regexp_name= ltrim ($words[0],'!');
                                  $names_filters[] = new DFC(SchoolUnitsExt::FIELD_NAME, $rm_regexp_name, DFC::NOT|DFC::CONTAINS);   
                                }
                                else
                                {
                                  $names_filters[] = new DFC(SchoolUnitsExt::FIELD_NAME, $words[0], DFC::CONTAINS);   
                                }
                        }
                        else 
                        {
                            foreach ($words as $word)                  
                            { 
                                $isNot = substr($word, 0, 1) == "!" ? true : false;                         
                                    if ($isNot)
                                    {
                                      $rm_regexp_name= ltrim ($word,'!');                            
                                      $names_filters_or[] = new DFC(SchoolUnitsExt::FIELD_NAME, $rm_regexp_name, DFC::NOT|DFC::CONTAINS);   
                                    }
                                    else
                                    {
                                      $names_filters_or[] = new DFC(SchoolUnitsExt::FIELD_NAME, $word, DFC::CONTAINS);   
                                    }
                            } 
                            $filter[] =  new DFCAggregate($names_filters_or, false);                      
                        }
                    }                
                   $filter[] = new DFCAggregate($names_filters, true);   
            }         
                       
        }
        
        //= $region_edu_admin ==========================================================================================================================================
        $oRegionEduAdmins = new RegionEduAdminsExt($db);
        $oRegionEduAdmins->getAll($db);

        if (is_numeric($region_edu_admin)) {
            $filter[] = new DFC(SchoolUnitsExt::FIELD_REGION_EDU_ADMIN_ID, $region_edu_admin, DFC::EXACT);
        } else if (count(preg_split("/[\s]*[,][\s]*/", $region_edu_admin)) > 1) {
            
            $count_region_edu_admins=preg_split("/[\s]*[,][\s]*/", $region_edu_admin);
            foreach ($count_region_edu_admins as $region_edu_admins){
                if(is_numeric($region_edu_admins)){
                    $region_edu_admins_filters[] = new DFC(SchoolUnitsExt::FIELD_REGION_EDU_ADMIN_ID, $region_edu_admins, DFC::EXACT);
                } else if ($region_edu_admins) { 
                    $oRegionEduAdmins->searchArrayForValue($region_edu_admins);
                    $region_edu_admins_filters[] = new DFC(SchoolUnitsExt::FIELD_REGION_EDU_ADMIN_ID, $oRegionEduAdmins->getr, DFC::EXACT);
                }     
            }
            $filter[] =  new DFCAggregate($region_edu_admins_filters, false);
            
        } else if ($region_edu_admin) {
            $oRegionEduAdmins->searchArrayForValue($region_edu_admin);
            $filter[] = new DFC(SchoolUnitsExt::FIELD_REGION_EDU_ADMIN_ID, $oRegionEduAdmins->getRegionEduAdminId(), DFC::EXACT);
        }

        //= $edu_admin =================================================================================================================================================
//        $oEduAdmins = new EduAdminsExt($db);
//        $oEduAdmins->getAll($db);
//
//        if (is_numeric($edu_admin)) {
//            $filter[] = new DFC(SchoolUnitsExt::FIELD_EDU_ADMIN_ID, $edu_admin, DFC::EXACT);
//        } else if (count(preg_split("/[\s]*[,][\s]*/", $edu_admin)) > 1) {
//            
//            $count_edu_admins=preg_split("/[\s]*[,][\s]*/", $edu_admin);
//            foreach ($count_edu_admins as $edu_admins){
//                if(is_numeric($edu_admins)){
//                    $edu_admins_filters[] = new DFC(SchoolUnitsExt::FIELD_EDU_ADMIN_ID, $edu_admins, DFC::EXACT);
//                } else if ($edu_admins) { 
//                    $oEduAdmins->searchArrayForValue($edu_admins);
//                    $edu_admins_filters[] = new DFC(SchoolUnitsExt::FIELD_EDU_ADMIN_ID, $oEduAdmins->getEduAdminId(), DFC::EXACT);
//                }     
//            }
//            $filter[] =  new DFCAggregate($edu_admins_filters, false);
//            
//        } else if ($edu_admin) {
//            $oEduAdmins->searchArrayForValue($edu_admin);
//            $filter[] = new DFC(SchoolUnitsExt::FIELD_EDU_ADMIN_ID, $oEduAdmins->getEduAdminId(), DFC::EXACT);
//        }
        
        $oEduAdmins = new EduAdminsExt($db);
        $oEduAdmins->getAll($db);

        $paramFilter = array();
       
        $arrayValues = preg_split("/[\s]*[,][\s]*/", $edu_admin);

        foreach ($arrayValues as $edu_admin)
        {
            $edu_admin = trim($edu_admin);
            
            if (is_numeric($edu_admin))
            {
                $paramFilter[] = new DFC(SchoolUnitsExt::FIELD_EDU_ADMIN_ID, $edu_admin, DFC::EXACT);
            }
            else if ($edu_admin)
            {
                $oEduAdmins->searchArrayForValue($edu_admin);
                $paramFilter[] = new DFC(SchoolUnitsExt::FIELD_EDU_ADMIN_ID, $oEduAdmins->getEduAdminId(), DFC::EXACT);
            }
        }

        //$paramFilter = array_map("unserialize", array_unique(array_map("serialize", $paramFilter))); //---->>>>>>>TODO FOR DUPLICATED OBJECTS
        //var_dump($paramFilter);
        
        if ( count($paramFilter) > 0 )
        {
            $filter[] = new DFCAggregate($paramFilter, false);
        }
        
        //= $transfer_area =============================================================================================================================================
        $oTransferArea = new TransferAreasExt($db);
        $oTransferArea->getAll($db);

        if (is_numeric($transfer_area)) {
            $filter[] = new DFC(SchoolUnitsExt::FIELD_TRANSFER_AREA_ID, $transfer_area, DFC::EXACT);
        } else if (count(preg_split("/[\s]*[,][\s]*/", $transfer_area)) > 1) {
            
            $count_transfer_areas=preg_split("/[\s]*[,][\s]*/", $transfer_area);
            //$count_transfer_areas=explode(',',$transfer_area); //is better ?!!!
            foreach ($count_transfer_areas as $transfer_areas){
                if(is_numeric($transfer_areas)){
                    $transfer_areas_filters[] = new DFC(SchoolUnitsExt::FIELD_TRANSFER_AREA_ID, $transfer_areas, DFC::EXACT);
                } else if ($transfer_areas) { 
                    $oTransferArea->searchArrayForValue($transfer_areas);
                    $transfer_areas_filters[] = new DFC(SchoolUnitsExt::FIELD_TRANSFER_AREA_ID, $oTransferArea->getTransferAreaId(), DFC::EXACT);
                }     
            }
            $filter[] =  new DFCAggregate($transfer_areas_filters, false);
            
        } else if ($transfer_area) {
            $oTransferArea->searchArrayForValue($transfer_area);
            $filter[] = new DFC(SchoolUnitsExt::FIELD_TRANSFER_AREA_ID, $oTransferArea->getTransferAreaId(), DFC::EXACT);
        }
        
        //= $municipality =============================================================================================================================================
        $oMunicipalities = new MunicipalitiesExt($db);
        $oMunicipalities->getAll($db);

        if (is_numeric($municipality)) {
            $filter[] = new DFC(SchoolUnitsExt::FIELD_MUNICIPALITY_ID, $municipality, DFC::EXACT);  
        } else if (count(preg_split("/[\s]*[,][\s]*/", $municipality)) > 1) {
            
            $count_municipalities=preg_split("/[\s]*[,][\s]*/", $municipality);
            foreach ($count_municipalities as $municipalities){
                if(is_numeric($municipalities)){
                    $municipalities_filters[] = new DFC(SchoolUnitsExt::FIELD_MUNICIPALITY_ID, $municipalities, DFC::EXACT);
                } else if ($municipalities) { 
                    $oMunicipalities->searchArrayForValue($municipalities);
                    $municipalities_filters[] = new DFC(SchoolUnitsExt::FIELD_MUNICIPALITY_ID, $oMunicipalities->getMunicipalityId(), DFC::EXACT);
                }     
            }
            $filter[] =  new DFCAggregate($municipalities_filters, false);
            
        } else if ($municipality) {
            $oMunicipalities->searchArrayForValue($municipality);
            $filter[] = new DFC(SchoolUnitsExt::FIELD_MUNICIPALITY_ID, $oMunicipalities->getMunicipalityId(), DFC::EXACT);
        }
               
        //= $prefecture ===============================================================================================================================================
        $oPrefectures = new PrefecturesExt($db);
        $oPrefectures->getAll($db);

        if (is_numeric($prefecture)) {
            $filter[] = new DFC(SchoolUnitsExt::FIELD_PREFECTURE_ID, $prefecture, DFC::EXACT);
        } else if (count(preg_split("/[\s]*[,][\s]*/", $prefecture)) > 1) {
            
            $count_prefectures=preg_split("/[\s]*[,][\s]*/", $prefecture);
            foreach ($count_prefectures as $prefectures){
                if(is_numeric($prefectures)){
                    $prefectures_filters[] = new DFC(SchoolUnitsExt::FIELD_PREFECTURE_ID, $prefectures, DFC::EXACT);
                } else if ($prefectures) { 
                    $oPrefectures->searchArrayForValue($prefectures);
                    $prefectures_filters[] = new DFC(SchoolUnitsExt::FIELD_PREFECTURE_ID, $oPrefectures->getPrefectureId(), DFC::EXACT);
                }     
            }
            $filter[] =  new DFCAggregate($prefectures_filters, false);
            
        } else if ($prefecture) {
            $oPrefectures->searchArrayForValue($prefecture);
            $filter[] = new DFC(SchoolUnitsExt::FIELD_PREFECTURE_ID, $oPrefectures->getPrefectureId(), DFC::EXACT);
        }
        
        //= $education_level ===========================================================================================================================================
        $oEducationLevels = new EducationLevelsExt($db);
        $oEducationLevels->getAll($db);

        if (is_numeric($education_level)) {
            $filter[] = new DFC(SchoolUnitsExt::FIELD_EDUCATION_LEVEL_ID, $education_level, DFC::EXACT);
        } else if (count(preg_split("/[\s]*[,][\s]*/", $education_level)) > 1) {
            
            $count_education_level=preg_split("/[\s]*[,][\s]*/", $education_level);
            foreach ($count_education_level as $education_levels){
                if(is_numeric($education_levels)){
                    $education_levels_filters[] = new DFC(SchoolUnitsExt::FIELD_EDUCATION_LEVEL_ID, $education_levels, DFC::EXACT);
                } else if ($education_levels) { 
                    $oEducationLevels->searchArrayForValue($education_levels);
                    $education_levels_filters[] = new DFC(SchoolUnitsExt::FIELD_EDUCATION_LEVEL_ID, $oEducationLevels->getEducationLevelId(), DFC::EXACT);
                }     
            }
            $filter[] =  new DFCAggregate($education_levels_filters, false);
            
        } else if ($education_level) {
            $oEducationLevels->searchArrayForValue($education_level);
            $filter[] = new DFC(SchoolUnitsExt::FIELD_EDUCATION_LEVEL_ID, $oEducationLevels->getEducationLevelId(), DFC::EXACT);
        }
        
        //= $school_unit_types ==========================================================================================================================================
        $oSchoolUnitTypes = new SchoolUnitTypesExt($db);
        $oSchoolUnitTypes->getAll($db);

        if (is_numeric($school_unit_type)) {
            $filter[] = new DFC(SchoolUnitsExt::FIELD_SCHOOL_UNIT_TYPE_ID, $school_unit_type, DFC::EXACT);
        } else if (count(preg_split("/[\s]*[,][\s]*/", $school_unit_type)) > 1) {
            
            $count_school_unit_type=preg_split("/[\s]*[,][\s]*/", $school_unit_type);
            foreach ($count_school_unit_type as $school_unit_types){
                if(is_numeric($school_unit_types)){
                    $school_unit_types_filters[] = new DFC(SchoolUnitsExt::FIELD_SCHOOL_UNIT_TYPE_ID, $school_unit_types, DFC::EXACT);
                } else if ($school_unit_types) { 
                    $oSchoolUnitTypes->searchArrayForValue($school_unit_types);
                    $school_unit_types_filters[] = new DFC(SchoolUnitsExt::FIELD_SCHOOL_UNIT_TYPE_ID, $oSchoolUnitTypes->getSchoolUnitTypeId(), DFC::EXACT);
                }     
            }
            $filter[] =  new DFCAggregate($school_unit_types_filters, false);
                  
        } else if ($school_unit_type) {
            $oSchoolUnitTypes->searchArrayForValue($school_unit_type);
            $filter[] = new DFC(SchoolUnitsExt::FIELD_SCHOOL_UNIT_TYPE_ID, $oSchoolUnitTypes->getSchoolUnitTypeId(), DFC::EXACT);
        }
 
        //= $state ==========================================================================================================================================
        $oStates = new StatesExt($db);
        $oStates->getAll($db);

        if (is_numeric($state)) {
            $filter[] = new DFC(SchoolUnitsExt::FIELD_STATE_ID, $state, DFC::EXACT);
        } else if (count(preg_split("/[\s]*[,][\s]*/", $state)) > 1) {
            
            $count_state=preg_split("/[\s]*[,][\s]*/", $state);
            foreach ($count_state as $states){
                if(is_numeric($states)){
                    $states_filters[] = new DFC(SchoolUnitsExt::FIELD_STATE_ID, $states, DFC::EXACT);
                } else if ($states) { 
                    $oStates->searchArrayForValue($states);
                    $states_filters[] = new DFC(SchoolUnitsExt::FIELD_STATE_ID, $oStates->getStateId(), DFC::EXACT);
                }     
            }
            $filter[] =  new DFCAggregate($states_filters, false);
                  
        } else if ($state) {
            $oStates->searchArrayForValue($state);
            $filter[] = new DFC(SchoolUnitsExt::FIELD_STATE_ID, $oStates->getStateId(), DFC::EXACT);
        }
        
        //= $lab_type ======================================================================================================================================================
        $oLabTypes = new LabTypesExt($db);
        $oLabTypes->getAll($db);

        if(is_numeric($lab_type)){
             $lab_type_filters[] = new DFC(LabsExt::FIELD_LAB_TYPE_ID, $lab_type, DFC::EXACT);
        } else if (count(preg_split("/[\s]*[,][\s]*/", $lab_type)) > 1) {
            
            $count_lab_types=preg_split("/[\s]*[,][\s]*/", $lab_type);
            foreach ($count_lab_types as $lab_types){
                if(is_numeric($lab_types)){
                    $lab_type_filters[] = new DFC(LabsExt::FIELD_LAB_TYPE_ID, $lab_types, DFC::EXACT);
                }else if ($lab_types){
                    $oLabTypes->searchArrayForValue($lab_types);
                    if ($oLabTypes->getLabTypeId()!=null){
                        $lab_type_filters[] = new DFC(LabsExt::FIELD_LAB_TYPE_ID, $oLabTypes->getLabTypeId(), DFC::EXACT);
                    }
                }
            }
            
        }else if ($lab_type){
             $oLabTypes->searchArrayForValue($lab_type);
             if ($oLabTypes->getLabTypeId()!=null){
                $lab_type_filters[] = new DFC(LabsExt::FIELD_LAB_TYPE_ID, $oLabTypes->getLabTypeId(), DFC::EXACT);
             }
         }   
         
         
        //= $lab_state ==========================================================================================================================================
        $oLabStates = new StatesExt($db);
        $oLabStates->getAll($db);

        if(is_numeric($lab_state)){
             $lab_state_filters[] = new DFC(LabsExt::FIELD_STATE_ID, $lab_state, DFC::EXACT);
        } else if (count(preg_split("/[\s]*[,][\s]*/", $lab_state)) > 1) {
            
            $count_lab_states=preg_split("/[\s]*[,][\s]*/", $lab_state);
            foreach ($count_lab_states as $lab_states){
                if(is_numeric($lab_states)){
                    $lab_state_filters[] = new DFC(LabsExt::FIELD_STATE_ID, $lab_states, DFC::EXACT);
                }else if ($lab_states){
                    $oLabStates->searchArrayForValue($lab_states);
                    if ($oLabStates->getStateId()!=null){
                        $lab_state_filters[] = new DFC(LabsExt::FIELD_STATE_ID, $oLabStates->getStateId(), DFC::EXACT);
                    }
                }
            }
            
        }else if ($lab_state){
             $oLabStates->searchArrayForValue($lab_state);
             if ($oLabStates->getStateId()!=null){
                $lab_state_filters[] = new DFC(LabsExt::FIELD_STATE_ID, $oLabStates->getStateId(), DFC::EXACT);
             }
         }   
  
        //= $operational_rating ==========================================================================================================================================
        if(is_numeric($operational_rating)){
             $operational_rating_filters[] = new DFC(LabsExt::FIELD_OPERATIONAL_RATING, $operational_rating, DFC::EXACT);
        } else if (count(preg_split("/[\s]*[,][\s]*/", $operational_rating)) > 1) {
            
            $count_operational_ratings=preg_split("/[\s]*[,][\s]*/", $operational_rating);
            foreach ($count_operational_ratings as $operational_ratings){
                if(is_numeric($operational_ratings)){
                    $operational_rating_filters[] = new DFC(LabsExt::FIELD_OPERATIONAL_RATING, $operational_ratings, DFC::EXACT);
                }
            }
            
        }
         
        //= $technological_rating ==========================================================================================================================================
        if(is_numeric($technological_rating)){
             $technological_rating_filters[] = new DFC(LabsExt::FIELD_TECHNOLOGICAL_RATING, $technological_rating, DFC::EXACT);
        } else if (count(preg_split("/[\s]*[,][\s]*/", $technological_rating)) > 1) {
            
            $count_technological_ratings=preg_split("/[\s]*[,][\s]*/", $technological_rating);
            foreach ($count_technological_ratings as $technological_ratings){
                if(is_numeric($technological_ratings)){
                    $technological_rating_filters[] = new DFC(LabsExt::FIELD_TECHNOLOGICAL_RATING, $technological_ratings, DFC::EXACT);
                }
            }
            
        }
         
        //= $aquisition_source==============================================================================================================================================
        $oAquisitionSources = new AquisitionSourcesExt($db);
        $oAquisitionSources->getAll($db);
        
        if(is_numeric($aquisition_source)){
            $aquisition_filters[] = new DFC(LabAquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, $aquisition_source, DFC::EXACT);
        } else if (count(preg_split("/[\s]*[,][\s]*/", $aquisition_source)) > 1) {
            
            $count_aquisition_sources=preg_split("/[\s]*[,][\s]*/", $aquisition_source);
            foreach ($count_aquisition_sources as $aquisition_sources){
                if(is_numeric($aquisition_sources)){
                    $aquisition_filters[] = new DFC(LabAquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, $aquisition_sources, DFC::EXACT);
                }else if ($aquisition_sources){
                    $oAquisitionSources->searchArrayForValue($aquisition_sources);  //allagi apo $oLabTypes
                    if ($oAquisitionSources->getAquisitionSourceId()!=null) {
                        $aquisition_filters[] = new DFC(LabAquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, $oAquisitionSources->getAquisitionSourceId(), DFC::EXACT);
                    }
                }
            }
            
        }else if ($aquisition_source){
            $oAquisitionSources->searchArrayForValue($aquisition_source);
            if ($oAquisitionSources->getAquisitionSourceId()!=null) {
                $aquisition_filters[] = new DFC(LabAquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, $oAquisitionSources->getAquisitionSourceId(), DFC::EXACT);
            }
        }
            
        //=$equipment_type====================================================================================================================================================
        $oEquipmentTypes = new EquipmentTypesExt($db);
        $oEquipmentTypes->getAll($db);
 
        if(is_numeric($equipment_type)){
            $equipment_type_filters[] = new DFC(LabEquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $equipment_type, DFC::EXACT);
        } else if (count(preg_split("/[\s]*[,][\s]*/", $equipment_type)) > 1) {
            
            $count_equipment_types=preg_split("/[\s]*[,][\s]*/", $equipment_type);
            foreach ($count_equipment_types as $equipment_types){
                if(is_numeric($equipment_types)){
                    $equipment_type_filters[] = new DFC(LabEquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $equipment_types, DFC::EXACT);
                }else if ($equipment_types){
                    $oEquipmentTypes->searchArrayForValue($equipment_types);
                    if ($oEquipmentTypes->getEquipmentTypeId()!=null) {
                        $equipment_type_filters[] = new DFC(LabEquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $oEquipmentTypes->getEquipmentTypeId(), DFC::EXACT);
                    }
                }
            }
            
        }else if ($equipment_type){
            $oEquipmentTypes->searchArrayForValue($equipment_type);
            $equipment_type=$oEquipmentTypes->getEquipmentTypeId();
            if ($oEquipmentTypes->getEquipmentTypeId()!=null) {
                $equipment_type_filters[] = new DFC(LabEquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $equipment_type, DFC::EXACT);
            }
        }
               
        //=$lab_id====================================================================================================================================================
           
        $lab_id_filters = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/", $lab_id);

        foreach ($arrayValues as $lab_id)
        {
            $lab_id = trim($lab_id);

            if (($lab_id) && (!is_numeric($lab_id)))
            {
                throw new Exception(ExceptionMessages::InvalidLabValue." : ".$lab_id, ExceptionCodes::InvalidLabValue);
            }
            else if (is_numeric($lab_id))
            {
                $lab_id_filters[] = new DFC(LabsExt::FIELD_LAB_ID, $lab_id, DFC::EXACT);
            }
        }

        //=$lab_worker====================================================================================================================================================
//        $fWorkers = new WorkersExt($db);
// 
//        if(is_numeric($lab_worker)){
//            $lab_worker_filters[] = new DFC(WorkersExt::FIELD_REGISTRY_NO, $lab_worker, DFC::EXACT);
//        } else if (count(preg_split("/[\s]*[,][\s]*/", $lab_worker)) > 1) {
//            
//            $count_worker_filters=preg_split("/[\s]*[,][\s]*/", $lab_worker);
//            foreach ($count_worker_filters as $worker_filters){
//                if(is_numeric($worker_filters)){
//                    $lab_worker_filters[] = new DFC(WorkersExt::FIELD_REGISTRY_NO, $worker_filters, DFC::EXACT);
//                }else if ($worker_filters){
//                    $fWorkers->searchArrayForValue($worker_filters);
//                    print_r($fWorkers);
//                    die();
//                    if ($fWorkers->getWorkerId()!=null) {
//                        $lab_worker_filters[] = new DFC(WorkersExt::FIELD_REGISTRY_NO, $fWorkers->getRegistryNo(), DFC::EXACT);
//                    }
//                }
//            }
//            
//        }else if ($lab_worker){
//            $fWorkers->searchArrayForValue($lab_worker);
//            $lab_worker=$fWorkers->getRegistryNo();
//            if ($fWorkers->getRegistryNo()!=null) {
//                $lab_worker_filters[] = new DFC(WorkersExt::FIELD_REGISTRY_NO, $lab_worker, DFC::EXACT);
//            }
//        }                       
 
        $fWorkers = new WorkersExt($db);
        
        if($lab_worker) {
        $paramFilter = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/",$lab_worker);

        foreach ($arrayValues as $lab_worker)
        {
            $lab_worker = trim($lab_worker);

            if (($lab_worker) && (!is_numeric($lab_worker)))
            {
                $paramFilter[] = new DFC(WorkersExt::FIELD_LASTNAME, $lab_worker, DFC::EXACT);
            }
            else if ($lab_worker)
            {
                $paramFilter[] = new DFC(WorkersExt::FIELD_REGISTRY_NO, $lab_worker, DFC::EXACT);
            }
        }
        
        if ( count($paramFilter) > 0 )
        {
            $fWorkers->getAll($db, $paramFilter, false);
        } 
        
        $lab_worker_filters = array();
        if (count($fWorkers->getObjsArray()) != 0 ) {
        
        foreach ($fWorkers->getObjsArray() as $fWorker)
        {
             $lab_worker_filters[] = new DFC(LabWorkersExt::FIELD_WORKER_ID, $fWorker->getWorkerId(), DFC::EXACT);
        }
        } else {
             $lab_worker_filters[] = new DFC(LabWorkersExt::FIELD_WORKER_ID,"0", DFC::EXACT);
        }


           //$filter_labs[] = new DFCAggregate($lab_worker_filters, false);

//        $oLabWorkers = new LabWorkersExt($db);
//        $totalRows = $oLabWorkers->findByFilterAsCount($db, $filter_labs, true);
//        echo $totalRows[0]->getLabWorkerId();
//        die();
        }
        
//        print_r($lab_worker_filters);
//        die();
        //===================================================================================================================================================================== 
       
        
        $oEquipmentCategories = new EquipmentCategoriesExt($db);
        $oEquipmentCategories->getAll($db);
        
//        $oStates = new StatesExt($db);
//        $oStates->getAll($db);
        
        $oLabSources = new LabSourcesExt($db);
        $oLabSources->getAll($db);

        $oCircuitTypes = new CircuitTypesExt($db);
        $oCircuitTypes->getAll($db);
        
        $oWorkerPositions = new WorkerPositionsExt($db);
        $oWorkerPositions->getAll($db);
        
        $oWorkerSpecializations = new WorkerSpecializationsExt($db);
        $oWorkerSpecializations->getAll($db);
        
        $oWorkers = new WorkersExt($db);
        $oLabWorkers = new LabWorkersExt($db);
        //===================================================================================================================================================================== 

        //multiple filters for Labs 
        $ext_filters = array(
            "lab_id"=>$lab_id_filters,
            "lab_type"=>$lab_type_filters,
            "lab_state"=>$lab_state_filters,
            "operational_rating"=>$operational_rating_filters,
            "technological_rating"=>$technological_rating_filters,
            "aquisition_source"=>$aquisition_filters,
            "equipment_type"=>$equipment_type_filters,
            "lab_worker"=>$lab_worker_filters
        );
        
       // $sort = array( new DSC($sort_field, $sort_mode));
        //$sort = array( new DSC(SchoolUnitsExt::FIELD_SCHOOL_UNIT_ID, DSC::ASC) );

        $oSchoolUnits = new SchoolUnitsExt($db);
        $totalRows = $oSchoolUnits->findBySqlJoinAsCount($db, $filter, $ext_filters, true); 

        $result["total"] = $totalRows[0]->getSchoolUnitId(); //return sum of school units
        $result["all_labs"] = $totalRows[0]->getName(); //todo total_labs must reurned by name field of school_units
        
        $totalLabsRows = $oSchoolUnits->findBySqlJoinAsLabsCount($db, $filter, $ext_filters, true, $oLabTypes);
        $result["all_labs_by_type"] =  $totalLabsRows;
  
  
        //=======================================================================================================================================================================

        if ($pagesize)         
            $countRows = $oSchoolUnits->findBySqlJoinWithLimitBeta($db, $filter, $ext_filters, $sort_field, $sort_mode, true, $startat, $pagesize);
        else
            $countRows = $oSchoolUnits->findBySqlJoinBeta ($db, $filter, $ext_filters, $sort_field, $sort_mode, true);
                
        $result["count"] = count( $countRows );
      
        $prefix='';
        if (count( $countRows ) > 0){
            foreach ($countRows as $SchoolUnits)
            {
                $SchoolUnitsIds .= $prefix . $SchoolUnits->getSchoolUnitId() ;
                $prefix = ', ';
            }
            //$arraySchoolUnits = $oSchoolUnits->findByIDs($db, $SchoolUnitsIds);
            $arraySchoolUnits = $oSchoolUnits->findByIDs($db, $SchoolUnitsIds);
        }    
 
        //var_dump($countRows);
        /**TODO CHECK FOR RIGHT MESSAGEs 
        if ($result["count"]=='0' && $region_edu_admin!=""){
            throw new Exception(ExceptionMessages::InvalidRegionEduAdminValue." : ".$region_edu_admin, ExceptionCodes::InvalidRegionEduAdminValue);
        }
        if ($result["count"]=='0' && $edu_admin!=""){
            throw new Exception(ExceptionMessages::InvalidEduAdminValue." : ".$edu_admin, ExceptionCodes::InvalidEduAdminValue);
        }
        if ($result["count"]=='0' && $transfer_area!=""){
            throw new Exception(ExceptionMessages::InvalidTransferAreaValue." : ".$transfer_area, ExceptionCodes::InvalidTransferAreaValue);
        }
        if ($result["count"]=='0' && $municipality!=""){
            throw new Exception(ExceptionMessages::InvalidMunicipalityValue." : ".$municipality, ExceptionCodes::InvalidMunicipalityValue);
        }
        if ($result["count"]=='0' && $prefecture!=""){
            throw new Exception(ExceptionMessages::InvalidPrefectureValue." : ".$prefecture, ExceptionCodes::InvalidPrefectureValue);
        }     
        */
   
        

        
        
        
        
    //check if found school units by join select and loop    
    if (count($arraySchoolUnits ) > 0) { 
        foreach ($arraySchoolUnits as $row) {  
           
          $data= array("school_unit_id" => $row->getSchoolUnitId(), 
                         "name" => $row->getName(),
                         "special_name" => $row->getSpecialName(),
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
                         "school_unit_type"=> $oSchoolUnitTypes->searchArrayForID($row->getSchoolUnitTypeId())->getName(),
                         "state"=> $oStates->searchArrayForID($row->getStateId())->getName() 
                         );
            
          //check if user select lab properties for filter
          $filter_multi = array();
          
            if ($lab_type){
                $counter=count($lab_type_filters);
                $filter_set =array();
                if ($counter==1){              
                   $filter_multi = array_merge($filter_multi, array ( new DFC(LabsExt::FIELD_SCHOOL_UNIT_ID, $row->getSchoolUnitId(), DFC::EXACT),
                                                                      new DFC(LabsExt::FIELD_LAB_TYPE_ID, $lab_type_filters[0]->getValue(), DFC::EXACT)));
                } else {                  
                   foreach ($lab_type_filters as $LabType){
                      $filter_set[] = new DFC(LabsExt::FIELD_LAB_TYPE_ID, $LabType->getValue(), DFC::EXACT);     
                   }
                   
                   $filter_multi = array_merge($filter_multi, array ( new DFCAggregate($filter_set, false),
                                                                      new DFC(LabsExt::FIELD_SCHOOL_UNIT_ID, $row->getSchoolUnitId(), DFC::EXACT)));
                }
            }
            
            //check if user select lab states for filter
            if ($lab_state){
                $counter=count($lab_state_filters);
                $filter_set =array();
                
                if ($counter==1){
                    
                 $filter_multi = array_merge($filter_multi,  array ( new DFC(LabsExt::FIELD_SCHOOL_UNIT_ID, $row->getSchoolUnitId(), DFC::EXACT),
                                                                     new DFC(LabsExt::FIELD_STATE_ID, $lab_state_filters[0]->getValue(), DFC::EXACT)));
                } else {                  
                   foreach ($lab_state_filters as $LabState){
                      $filter_set[] = new DFC(LabsExt::FIELD_STATE_ID, $LabState->getValue(), DFC::EXACT);     
                   }
                  $filter_multi = array_merge($filter_multi,  array ( new DFCAggregate($filter_set, false),
                                                                      new DFC(LabsExt::FIELD_SCHOOL_UNIT_ID, $row->getSchoolUnitId(), DFC::EXACT)));
                }       
            }
            
            //check if user select lab operational_rating for filter
            if ($operational_rating){
                $counter=count($operational_rating_filters);
                $filter_set =array();
                
                if ($counter==1){
                   $filter_multi = array_merge($filter_multi, array ( new DFC(LabsExt::FIELD_SCHOOL_UNIT_ID, $row->getSchoolUnitId(), DFC::EXACT),
                                                                      new DFC(LabsExt::FIELD_OPERATIONAL_RATING, $operational_rating_filters[0]->getValue(), DFC::EXACT)));
                } else {                  
                   foreach ($operational_rating_filters as $LabOperationalRating){
                      $filter_set[] = new DFC(LabsExt::FIELD_OPERATIONAL_RATING, $LabOperationalRating->getValue(), DFC::EXACT);     
                   }
                   $filter_multi = array_merge($filter_multi,  array ( new DFCAggregate($filter_set, false),
                                                                       new DFC(LabsExt::FIELD_SCHOOL_UNIT_ID, $row->getSchoolUnitId(), DFC::EXACT)));
                }       
            }
            
            //check if user select lab technological_rating for filter
            if ($technological_rating){
                $counter=count($technological_rating_filters);
                $filter_set =array();
                
                if ($counter==1){
                  $filter_multi = array_merge($filter_multi,  array ( new DFC(LabsExt::FIELD_SCHOOL_UNIT_ID, $row->getSchoolUnitId(), DFC::EXACT),
                                                                      new DFC(LabsExt::FIELD_TECHNOLOGICAL_RATING, $technological_rating_filters[0]->getValue(), DFC::EXACT)));
                } else {                  
                   foreach ($technological_rating_filters as $LabTechnologicalRating){
                      $filter_set[] = new DFC(LabsExt::FIELD_TECHNOLOGICAL_RATING, $LabTechnologicalRating->getValue(), DFC::EXACT);     
                   }
                   $filter_multi = array_merge($filter_multi, array ( new DFCAggregate($filter_set, false),
                                                                      new DFC(LabsExt::FIELD_SCHOOL_UNIT_ID, $row->getSchoolUnitId(), DFC::EXACT)));
                }       
            } 
            
            if (Validator::isMissing(lab_type)&&Validator::isMissing(lab_state)&&Validator::isMissing(operational_rating)&&Validator::isMissing(technological_rating))
            {
                $filter_multi = array( new DFC(LabsExt::FIELD_SCHOOL_UNIT_ID, $row->getSchoolUnitId(), DFC::EXACT)); 
            }

            //find labs with user filters
            $sort = array( new DSC(LabsExt::FIELD_NAME, DSC::ASC) );      
            $oLabs = new LabsExt($db);    
            $arrayLabs = $oLabs->findByFilter($db, $filter_multi, true, $sort);          
            
            
//            if ($arrayLabs){
//                $totalLabsRows = $oLabs->findBySqlJoinAsLabsCount($db, $filter_multi,$ext_filters, true);
//                $data["total_labs_by_type"] =  $totalLabsRows;
//            } else { 
//                $totalLabsRowsNull = $oLabs->findBySqlJoinAsLabsCountNull($db);
//                $data["total_labs_by_type"] = $totalLabsRowsNull;        
//            }
//            
//            $data["total_labs"] =  count($arrayLabs);
            
                //check if user select aquisition sources filters and found labs with these critiria
                if ( count($aquisition_filters) > 0 )
                {
                    $aquisition_sources_Filter = array();
                
                    foreach ($arrayLabs as $arrayLaba) 
                    {
                        $aquisition_sources_Filter[] = new DFC(LabAquisitionSourcesExt::FIELD_LAB_ID, $arrayLaba->getLabId(), DFC::EXACT);                     
                    }
                    $test = array ( new DFCAggregate($aquisition_sources_Filter, false),
                                    new DFCAggregate($aquisition_filters, false) );
                    
                    $oLabsHaveAquisitionSources = new LabAquisitionSourcesExt($db);  
                    $oLabsAquisitionSources = $oLabsHaveAquisitionSources->findByFilter($db, $test, true, $sort);
               
                    $oLabs = new LabsExt($db);
                    $arrayLabs= "";
                    $prefix='';
                    $LabIds='';
                    if (count( $oLabsAquisitionSources ) > 0) 
                    {
                        foreach ($oLabsAquisitionSources as $LabId)
                        {
                            $LabIds .= $prefix . '"' . $LabId->getLabId() . '"';
                            $prefix = ', ';
                        }
                    $arrayLabs = $oLabs->findByIDs($db, $LabIds);
                    }       
                } 
                
                //check if user select equipment types filters and found labs with these critiria
                if ( count($equipment_type_filters) > 0 )
                {
                    $equipment_types_Filter = array();
                
                    foreach ($arrayLabs as $arrayLabb) 
                    {
                        $equipment_types_Filter[] = new DFC(LabEquipmentTypesExt::FIELD_LAB_ID, $arrayLabb->getLabId(), DFC::EXACT);                     
                    }
                    $test1 = array ( new DFCAggregate($equipment_types_Filter, false),
                                    new DFCAggregate($equipment_type_filters, false) );
                    
                    $oLabsHaveEquipmentTypes = new LabEquipmentTypesExt($db);  
                    $oLabsEquipmentTypes = $oLabsHaveEquipmentTypes->findByFilter($db, $test1, true, $sort);
               
                    $oLabs = new LabsExt($db);
                    $arrayLabs= "";
                    $prefix='';
                    $LabIds='';
                    if (count( $oLabsEquipmentTypes ) > 0) 
                    {
                        foreach ($oLabsEquipmentTypes as $LabId)
                        {
                            $LabIds .= $prefix . '"' . $LabId->getLabId() . '"';
                            $prefix = ', ';
                        }
                    $arrayLabs = $oLabs->findByIDs($db, $LabIds);
                    }       
                } 
                
                //check if user select lab_workers filters and found labs with these critiria
                if ( count($lab_worker_filters) > 0 )
                {
                    $lab_worker_Filters = array();
                
                    foreach ($arrayLabs as $arrayLabb) 
                    {
                        $lab_worker_Filters[] = new DFC(LabWorkersExt::FIELD_LAB_ID, $arrayLabb->getLabId(), DFC::EXACT);                     
                    }
                    $test2 = array ( new DFCAggregate($lab_worker_Filters, false),
                                     new DFCAggregate($lab_worker_filters, false) );
                    
                    $oLabWorkers = new LabWorkersExt($db);  
                    $oLabWorkerFound = $oLabWorkers->findByFilter($db, $test2, true, $sort);
               
                    $oLabs = new LabsExt($db);
                    $arrayLabs= "";
                    $prefix='';
                    $LabIds='';
                    if (count( $oLabWorkerFound ) > 0) 
                    {
                        foreach ($oLabWorkerFound as $LabId)
                        {
                            $LabIds .= $prefix . '"' . $LabId->getLabId() . '"';
                            $prefix = ', ';
                        }
                    $arrayLabs = $oLabs->findByIDs($db, $LabIds);
                    }       
                } 
                
//                
//                $labWorkerFilter = array();
//                foreach ($arrayLabs as $arrayLabq) {
//                    $labWorkerFilter[] = new DFC(LabWorkersExt::FIELD_LAB_ID, $arrayLabq->getLabId(), DFC::EXACT);              
//                }
//                
//                $lab_workers_filter_multi = array ( new DFCAggregate($labWorkerFilter, false)
//                                            ,new DFCAggregate($lab_worker_filters, false)
//                                            //,new DFC(LabWorkersExt::FIELD_WORKER_STATUS, 1, DFC::EXACT)
//                );
//                $oLabWorkers->getAll($db, $lab_workers_filter_multi, true); 

                
            if ($arrayLabs){
                $totalLabsRows = $oLabs->findBySqlJoinAsLabsCount($db, $filter_multi,$ext_filters, true, $oLabTypes);
                $data["total_labs_by_type"] =  $totalLabsRows;
            } else { 
                $totalLabsRowsNull = $oLabs->findBySqlJoinAsLabsCountNull($db, $oLabTypes);
                $data["total_labs_by_type"] = $totalLabsRowsNull;        
            }
            
            $data["total_labs"] =  count($arrayLabs);   
                
     //   ===================================          ===================================          ===================================          ===================================              
                        $school_unit_filter = array( new DFC(SchoolUnitWorkersExt::FIELD_SCHOOL_UNIT_ID, $row->getSchoolUnitId(), DFC::EXACT));
                        $sort = array( new DSC(SchoolUnitWorkersExt::FIELD_SCHOOL_UNIT_ID, DSC::ASC) );
                        $oSchoolUnitWorkers = new SchoolUnitWorkersExt($db);
                        $oSchoolUnitWorker = $oSchoolUnitWorkers->findByFilter($db, $school_unit_filter, true, $sort);
                        $data["school_unit_worker"] = null;
                        if ($oSchoolUnitWorker){
                            //$lab["equipment_types"] = array();
                            
                            foreach ($oSchoolUnitWorker as $sworker) {
                                    //$idEquipmentType=$oEquipmentTypes->searchArrayForID($EquipmentTypes->getEquipmentTypeId());
                                    //$idEquipmentCategory=$oEquipmentCategories->searchArrayForID($idEquipmentType->getEquipmentCategoryId());
                                    $oWorkerss = $oWorkers->findById($db,$sworker->getWorkerId());
                                    $data["school_unit_worker"][] = array("school_unit_worker_id"=> $sworker->getSchoolUnitWorkerId(),
                                                                "worker_id" => $sworker->getWorkerId(),
                                                                "registry_no" => $oWorkerss->getRegistryNo(),
                                                                "tax_number" => $oWorkerss->getTaxNumber(),
                                                                "firstname" => $oWorkerss->getFirstname(),
                                                                "lastname" => $oWorkerss->getLastname(),
                                                                "fathername" => $oWorkerss->getFathername(),
                                                                "sex" => $oWorkerss->getSex(),
                                                                "specialization_code" => $oWorkerSpecializations->searchArrayForID( $oWorkerss->getWorkerSpecializationId() )->getName(),
                                                                "school_unit_id" => $sworker->getSchoolUnitId(),
                                                                "school_unit" => $row->getName(),
                                                                //"school_unit" => $oSchoolUnits->searchArrayForID( $sworker->getSchoolUnitId())->getName(),
                                                                "worker_position_id" => $sworker->getWorkerPositionId(),
                                                                "worker_position" => $oWorkerPositions->searchArrayForID( $sworker->getWorkerPositionId())->getName()
                                                                     );
                           }
                        }
      
        // circuits
            $school_circuit_filter = array( new DFC(CircuitsExt::FIELD_SCHOOL_UNIT_ID, $row->getSchoolUnitId(), DFC::EXACT));
            $sort = array( new DSC(CircuitsExt::FIELD_SCHOOL_UNIT_ID, DSC::ASC) );
            $oCircuits = new CircuitsExt($db);
            $oCircuit = $oCircuits->findByFilter($db, $school_circuit_filter, true, $sort);
            $data["school_circuits"] = null;
            if ($oCircuit){
                //$lab["equipment_types"] = array();
                $oSchoolUnitCircuits = new SchoolUnitsExt($db);
                foreach ($oCircuit as $circuit) {
                        //$idEquipmentType=$oEquipmentTypes->searchArrayForID($EquipmentTypes->getEquipmentTypeId());
                        //$idEquipmentCategory=$oEquipmentCategories->searchArrayForID($idEquipmentType->getEquipmentCategoryId());
                        $oSchoolUnitCircuit = $oSchoolUnitCircuits->findById($db,$circuit->getSchoolUnitId())->getName();
                        $data["school_circuits"][] = array("circuit_id"=> $circuit->getCircuitId(),
                                                            "phone_number" => $circuit->getPhoneNumber(),
                                                            "updated_date" => $circuit->getUpdatedDate(),
                                                            "status" => $circuit->getStatus(),
                                                            "circuit_type" => $circuit->getCircuitTypeId(),
                                                            "relation_type_name" => $oCircuitTypes->searchArrayForID( $circuit->getCircuitTypeId())->getName(),
                                                            "school_unit_id" => $circuit->getSchoolUnitId(),
                                                            "school_unit__name" => $oSchoolUnitCircuit
                                                            );
               }
            }
                        
                        
   //===================================            ===================================          ===================================          ===================================          ===================================       
            
            
                
            //loop at filtering labs    
            if (count($arrayLabs ) > 0) { 
               

                
               //var_dump($data["count_labs_sepey"]) ;
               
               
//                    foreach ($arrayLabs as $arrayLab) {
//                          //count labs by lab_type
//                        if ($arrayLab->getLabTypeId()==1){
//                            $data["count_labs_sepey"]++; 
//                        } else if ($arrayLab->getLabTypeId()==2) {
//                            $data["count_labs_troxilato"]++; 
//                        } else if ($arrayLab->getLabTypeId()==3) {
//                            $data["count_labs_general"]++; 
//                        } else if ($arrayLab->getLabTypeId()==4) {
//                            $data["count_labs_gwnia"]++; 
//                        } else if ($arrayLab->getLabTypeId()==5){
//                            $data["count_labs_allo"]++; 
//                        }
//                
//                    }
                    
                    foreach ($arrayLabs as $arrayLab) {
                                        
                        $lab = array("lab_id"=>$arrayLab->getLabId(),
                                     "name"=>$arrayLab->getName(),
                                     //"email"=>$arrayLab->getEmail(),
                                     "creation_date"=>$arrayLab->getCreationDate(),
                                     "created_by"=>$arrayLab->getCreatedBy(),
                                     "last_updated"=>$arrayLab->getLastUpdated(),
                                     "updated_by"=>$arrayLab->getUpdatedBy(),
                                     "positioning"=>$arrayLab->getPositioning(),
                                     "comments"=>$arrayLab->getComments(),
                                     "operational_rating"=>$arrayLab->getOperationalRating(),
                                     "technological_rating"=>$arrayLab->getTechnologicalRating(),
//"lab_responsible_id"=>$arrayLab->getLabResponsibleId(),
                                     "lab_type_id"=> $oLabTypes->searchArrayForID( $arrayLab->getLabTypeId())->getName(),
                                     "school_unit_id"=>$arrayLab->getSchoolUnitId(),
                                     "lab_state"=> $oStates->searchArrayForID( $arrayLab->getStateId())->getName(),
                                     "lab_source"=> $oLabSources->searchArrayForID( $arrayLab->getLabSourceId())->getName(),
                                      );
                                              
                        //= lab_responsibles ===================================================================================================================================================================
//new version for checking
//            $data["lab_workers"] = null;          
//            foreach ($oLabWorkers->getObjsArray() as $oLabWorker)
//            {
//                if ($oLabWorker->getLabId() == $arrayLab->getLabId()) {   
//                    $oWorkerLab = $oWorkers->findById($db,$oLabWorker->getWorkerId());
//                    $data["lab_workers"][] = array( "lab_worker_id"=> $oLabWorker->getLabWorkerId(),
//                                                    "worker_id" => $oLabWorker->getWorkerId(),
//                                                    "registry_no" => $oWorkerLab->getRegistryNo(),
//                                                    "tax_number" => $oWorkerLab->getTaxNumber(),
//                                                    "firstname" => $oWorkerLab->getFirstname(),
//                                                    "lastname" => $oWorkerLab->getLastname(),
//                                                    "fathername" => $oWorkerLab->getFathername(),
//                                                    "sex" => $oWorkerLab->getSex(),
//                                                    "specialization_code" => $oWorkerSpecializations->searchArrayForID( $oWorkerLab->getWorkerSpecializationId() )->getName(),
//                                                    "lab_id" => $oLabWorker->getLabId(),
//                                                    //"lab" => $oLabs->searchArrayForID( $worker->getLabId())->getName(),
//                                                    "worker_position_id" => $oLabWorker->getWorkerPositionId(),
//                                                    "worker_position" => $oWorkerPositions->searchArrayForID( $oLabWorker->getWorkerPositionId())->getName(),
//                                                    "worker_email" => $oLabWorker->getWorkerEmail(),
//                                                    "worker_status" => $oLabWorker->getWorkerStatus(),
//                                                    "worker_start_service" => $oLabWorker->getWorkerStartService()                                 
//                                                  );   
//                }
//            }

//old version lab_worker
                        
                        
                        $lab_worker_filter = array( new DFC(LabWorkersExt::FIELD_LAB_ID, $arrayLab->getLabId(), DFC::EXACT)
                                                    ,new DFCAggregate($lab_worker_filters, false)
                                                    ,new DFC(LabWorkersExt::FIELD_WORKER_STATUS, 1, DFC::EXACT)
                                                    );
                        
                        $sort = array( new DSC(LabWorkersExt::FIELD_LAB_ID, DSC::ASC) );
                        $oLabWorkers = new LabWorkersExt($db);
                        $oLabWorker = $oLabWorkers->findByFilter($db, $lab_worker_filter, true, $sort);
                        
                        $lab["lab_workers"] = null;
                        if ($oLabWorker){
                            //$lab["equipment_types"] = array();
                            
                            foreach ($oLabWorker as $worker) {
                                    //$idEquipmentType=$oEquipmentTypes->searchArrayForID($EquipmentTypes->getEquipmentTypeId());
                                    //$idEquipmentCategory=$oEquipmentCategories->searchArrayForID($idEquipmentType->getEquipmentCategoryId());
                                    $oWorkerLab = $oWorkers->findById($db,$worker->getWorkerId());
                                    $lab["lab_workers"][] = array("lab_worker_id"=> $worker->getLabWorkerId(),
                                                                "worker_id" => $worker->getWorkerId(),                                          
                                                                "registry_no" => $oWorkerLab->getRegistryNo(),
                                                                "tax_number" => $oWorkerLab->getTaxNumber(),
                                                                "firstname" => $oWorkerLab->getFirstname(),
                                                                "lastname" => $oWorkerLab->getLastname(),
                                                                "fathername" => $oWorkerLab->getFathername(),
                                                                "sex" => $oWorkerLab->getSex(),
                                                                "specialization_code" => $oWorkerSpecializations->searchArrayForID( $oWorkerLab->getWorkerSpecializationId() )->getName(),
                                                                "lab_id" => $worker->getLabId(),
                                                                //"lab" => $oLabs->searchArrayForID( $worker->getLabId())->getName(),
                                                                "worker_position_id" => $worker->getWorkerPositionId(),
                                                                "worker_position" => $oWorkerPositions->searchArrayForID( $worker->getWorkerPositionId())->getName(),
                                                                "worker_email" => $worker->getWorkerEmail(),
                                                                "worker_status" => $worker->getWorkerStatus(),
                                                                "worker_start_service" => $worker->getWorkerStartService()
                                                                     );
                           }
                        }
                        //= aquisition_sources ==================================================================================================================================================================
                       
                  
                        if ($aquisition_source){
                            $count_aq_filters=count($aquisition_filters);
                            $aquisition_source_filter_set =array();
                            if ($count_aq_filters==1){
                                $aquisition_source_filter_multi = array( new DFC(LabAquisitionSourcesExt::FIELD_LAB_ID, $arrayLab->getLabId(), DFC::EXACT),
                                                                         new DFC(LabAquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, $aquisition_filters[0]->getValue(), DFC::EXACT));
                            } else {
                                foreach ($aquisition_filters as $AquisitionSource){
                                    $aquisition_source_filter_set[] = new DFC(LabquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, $AquisitionSource->getValue(), DFC::EXACT);     
                                }
                                $aquisition_source_filter_multi = array ( new DFCAggregate($aquisition_source_filter_set, false),
                                                                          new DFC(LabAquisitionSourcesExt::FIELD_LAB_ID, $arrayLab->getLabId(), DFC::EXACT));
                            }    
                        } else {
                                $aquisition_source_filter_multi = array( new DFC(LabAquisitionSourcesExt::FIELD_LAB_ID, $arrayLab->getLabId(), DFC::EXACT));
                        }

                        $sort = array( new DSC(LabAquisitionSourcesExt::FIELD_LAB_ID, DSC::ASC) );
                        $oLabsHaveAquisitionSources = new LabAquisitionSourcesExt($db);
                        $oLabsAquisitionSources = $oLabsHaveAquisitionSources->findByFilter($db, $aquisition_source_filter_multi, true, $sort);
                        $lab["aquisition_sources"] = null;
                        $lab["aquisition_sources_formatted"] = null;
                         if ($oLabsAquisitionSources){
                             
                            foreach ($oLabsAquisitionSources as $AquisitionSources) {
                                $lab["aquisition_sources"][] = array("name" => $oAquisitionSources->searchArrayForID($AquisitionSources->getAquisitionSourceId())->getName(),
                                                                    //"aquisition_source" => $oAquisitionSources->searchArrayForID( $row->getAquisitionSourceId())->getName(), //$oAquisitionSources->getName()
                                                                    "aquisition_year" => $AquisitionSources->getAquisitionYear(),
                                                                    "aquisition_comments" => $AquisitionSources->getAquisitionComments()
                                        );                                
                            }
                            $lab["aquisition_sources_formatted"] = implode(', ', array_map(function($entry){ return $entry['name']; }, $lab["aquisition_sources"]));
                         } 
                            
                        //= equipment_types ========================================================================================================================================================================

                        if ($equipment_type){
                            $count_eqt_filters=count($equipment_type_filters);
                            $equipment_type_filter_set =array();
                            if ($count_eqt_filters==1){
                                $equipment_type_filter_multi = array( new DFC(LabEquipmentTypesExt::FIELD_LAB_ID, $arrayLab->getLabId(), DFC::EXACT),
                                                                      new DFC(LabEquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $equipment_type_filters[0]->getValue(), DFC::EXACT));
                            } else {
                                foreach ($equipment_type_filters as $EquipmentType){
                                    $equipment_type_filter_set[] = new DFC(LabquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $EquipmentType->getValue(), DFC::EXACT);     
                                }
                                $equipment_type_filter_multi = array ( new DFCAggregate($equipment_type_filter_set, false),
                                                                       new DFC(LabEquipmentTypesExt::FIELD_LAB_ID, $arrayLab->getLabId(), DFC::EXACT));
                            }    
                        } else {
                                $equipment_type_filter_multi = array( new DFC(LabEquipmentTypesExt::FIELD_LAB_ID, $arrayLab->getLabId(), DFC::EXACT));
                        }
                        
                        $sort = array( new DSC(LabEquipmentTypesExt::FIELD_LAB_ID, DSC::ASC) );
                        $oLabsHaveEquipmentTypes = new LabEquipmentTypesExt($db);
                        $oLabsEquipmentTypes = $oLabsHaveEquipmentTypes->findByFilter($db, $equipment_type_filter_multi, true, $sort);
                        $lab["equipment_types"] = null;
                        if ($oLabsEquipmentTypes){
                            //$lab["equipment_types"] = array();
                            
                            foreach ($oLabsEquipmentTypes as $EquipmentTypes) {
                                    $idEquipmentType=$oEquipmentTypes->searchArrayForID($EquipmentTypes->getEquipmentTypeId());
                                    $idEquipmentCategory=$oEquipmentCategories->searchArrayForID($idEquipmentType->getEquipmentCategoryId());
                                    $lab["equipment_types"][] = array("equipment_type_id" => $idEquipmentType->getEquipmentTypeId(),      
                                                                      "equipment_type_name" => $idEquipmentType->getName(),
                                                                      "equipment_category_id" => $idEquipmentType->getEquipmentCategoryId(),
                                                                      "equipment_category_name" => $idEquipmentCategory->getName(),
                                                                      "items" => $EquipmentTypes->getItems()
                                                                     );
                           }
                        }
                        
                       $data["labs"][] = $lab;
                  }
                
                  $result["data"][] = $data;   
               } 
                else 
            {
             $data["labs"] = null;
             //$data["labs_info"]="Δεν υπάρχει κανένα εργαστήριο";
             $result["data"][] = $data; 
            }
          //$result["total_labs_by_pagesize"]+= $data["count_labs"]; counter of labs at pagesize
            $result["pagesize"]=$pagesize;
            $result["page"]=$page;
        }
    }
        $result["status"] = 200;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";
    } catch (Exception $e) {
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
}

?>