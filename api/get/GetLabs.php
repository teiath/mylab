<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $lab_id
 * @param type $name
 * @param type $creation_date
 * @param type $aquisition_year
 * @param type $lab_responsible
 * @param type $lab_type
 * @param type $school_unit
 * @param type $state
 * @param type $source
 * @param type $aquisition_source
 * @param type $equipment_type
 * @param type $pagesize
 * @param type $page
 * @param string $sort_field
 * @param type $sort_mode
 * @return string
 * @throws Exception
 */

function GetLabs($lab_id, $name, $special_name,  $creation_date, $operational_rating, $technological_rating, $lab_worker, $lab_type, $school_unit, $state, $source, $aquisition_source, $equipment_type, $pagesize, $page, $sort_field, $sort_mode) {
    global $db;
    global $Options;
    global $app;
    
    $filter = array();
    $result = array();  

    $result["data"] = array();
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();

    try {
                
        //= Page ==============================================================
        if (! $page)
            $page = Parameters::DefaultPage;
        else if (intval($page) < 0)
	        throw new Exception(ExceptionMessages::InvalidPageNumber." : ".$page, ExceptionCodes::InvalidPageNumber);
        else if (!is_numeric($page))
	        throw new Exception(ExceptionMessages::InvalidPageType." : ".$page, ExceptionCodes::InvalidPageType);
        
        //= Pagesize ==========================================================

        if ($pagesize == (string)$Options["AllPageSize"])
            $pagesize = $Options["AllPageSize"];
        else if (! $pagesize)
            $pagesize = $Options["PageSize"];
        else if (intval($pagesize) < 0)
	        throw new Exception(ExceptionMessages::InvalidPageSizeNumber." : ".$pagesize, ExceptionCodes::InvalidPageSizeNumber);
        else if (!is_numeric($pagesize))
	        throw new Exception(ExceptionMessages::InvalidPageSizeType." : ".$pagesize, ExceptionCodes::InvalidPageSizeType);
        else if ($pagesize > $Options["MaxPageSize"])
                throw new Exception(ExceptionMessages::InvalidPageSizeNumber." : ".$pagesize, ExceptionCodes::InvalidPageSizeNumber);

        $startat = ($page -1) * $pagesize;

//        $page = Pagination::Page($page);
//        $pagesize = Pagination::Pagesize($pagesize);
//        $startat = Pagination::StartPagesizeFrom($page, $pagesize);
        //= Sort Mode Labs=================================================
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
          if (isset($sort_field))
        {  
            $columns = array_values(LabsExt::getFieldNames());
            array_push($columns, "lab_type","school_unit");
        //    $columns = array("lab_id","name","creation_date","lab_type","school_unit");
             
            if (!in_array($sort_field, $columns))
                throw new Exception(ExceptionMessages::InvalidSortFieldType." : ".$sort_field, ExceptionCodes::InvalidSortFieldType);
        }
        else
            $sort_field = "name";
        
        //$lab_id==============================================================
        
        $paramFilter = array();
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
                $paramFilter[] = new DFC(LabsExt::FIELD_LAB_ID, $lab_id, DFC::EXACT);
            }
        }

        if ( count($paramFilter) > 0 )
        {
            $filter[] = new DFCAggregate($paramFilter, false);
        }
        
         //$name==============================================================
        
        $paramFilter = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/", $name);

        foreach ($arrayValues as $name)
        {
            $name = trim($name);

            if ($name)
            {
                $paramFilter[] = new DFC(LabsExt::FIELD_NAME, $name, DFC::CONTAINS);
            }
        }

        if ( count($paramFilter) > 0 )
        {
            $filter[] = new DFCAggregate($paramFilter, false);
        }
  
         //$special_name==============================================================
        
        $paramFilter = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/", $special_name);

        foreach ($arrayValues as $special_name)
        {
            $special_name = trim($special_name);

            if ($special_name)
            {
                $paramFilter[] = new DFC(LabsExt::FIELD_SPECIAL_NAME, $special_name, DFC::CONTAINS);
            }
        }

        if ( count($paramFilter) > 0 )
        {
            $filter[] = new DFCAggregate($paramFilter, false);
        }
        
        //$creation_date==============================================================
        
        $paramFilter = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/", $creation_date);

        foreach ($arrayValues as $creation_date)
        {
            $creation_date = trim($creation_date);

            if ($creation_date)
            {
                $paramFilter[] = new DFC(LabsExt::FIELD_CREATION_DATE, $creation_date, DFC::CONTAINS);
            }
        }

        if ( count($paramFilter) > 0 )
        {
            $filter[] = new DFCAggregate($paramFilter, false);
        }
         
        //$operational_rating==============================================================
        
        $paramFilter = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/", $operational_rating);

        foreach ($arrayValues as $operational_rating)
        {
            $operational_rating = trim($operational_rating);

            if ($operational_rating)
            {
                $paramFilter[] = new DFC(LabsExt::FIELD_OPERATIONAL_RATING, $operational_rating, DFC::EXACT);
            }
        }

        if ( count($paramFilter) > 0 )
        {
            $filter[] = new DFCAggregate($paramFilter, false);
        }
        
        //$technological_rating==============================================================
        
        $paramFilter = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/", $technological_rating);

        foreach ($arrayValues as $technological_rating)
        {
            $technological_rating = trim($technological_rating);

            if ($technological_rating)
            {
                $paramFilter[] = new DFC(LabsExt::FIELD_TECHNOLOGICAL_RATING, $technological_rating, DFC::EXACT);
            }
        }

        if ( count($paramFilter) > 0 )
        {
            $filter[] = new DFCAggregate($paramFilter, false);
        }
        
        //= $lab_responsible ==================================================
//        
//        $oLabResponsibles = new LabResponsiblesExt($db);
//        
//        if($lab_responsible) {
//        $paramFilter = array();
//        $arrayValues = preg_split("/[\s]*[,][\s]*/",$lab_responsible);
//
//        foreach ($arrayValues as $lab_responsible)
//        {
//            $lab_responsible = trim($lab_responsible);
//
//            if (($lab_responsible) && (!is_numeric($lab_responsible)))
//            {
//                throw new Exception(ExceptionMessages::InvalidLabResponsibleIdValue." : ".$lab_responsible, ExceptionCodes::InvalidLabResponsibleIdValue);
//            }
//            else if ($lab_responsible)
//            {
//                $paramFilter[] = new DFC(LabResponsiblesExt::FIELD_REGISTRY_NUMBER, $lab_responsible, DFC::EXACT);
//            }
//        }
//        
//        if ( count($paramFilter) > 0 )
//        {
//            $oLabResponsibles->getAll($db, $paramFilter, false);
//        } 
//        
//        if (count($oLabResponsibles->getObjsArray()) != 0 ) {
//        
//        $paramFilter = array();
//        foreach ($oLabResponsibles->getObjsArray() as $oLabResponsible)
//        {
//             $paramFilter[] = new DFC(LabsExt::FIELD_LAB_RESPONSIBLE_ID, $oLabResponsible->getLabResponsibleId(), DFC::EXACT);
//        }
//        } else {
//             $paramFilter[] = new DFC(LabsExt::FIELD_LAB_RESPONSIBLE_ID,"0", DFC::EXACT);
//        }
//
//        //if ( count($paramFilter) > 0 )
//        //{
//            $filter[] = new DFCAggregate($paramFilter, false);
//        //} 
//        
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
         
        }
        //= $lab_type ==================================================
        
        $oLabTypes = new LabTypesExt($db);
        $oLabTypes->getAll($db);

        $paramFilter = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/", $lab_type);

        foreach ($arrayValues as $lab_type)
        {
            $lab_type = trim($lab_type);

            
            if (is_numeric($lab_type))
            {
                $paramFilter[] = new DFC(LabsExt::FIELD_LAB_TYPE_ID, $lab_type, DFC::EXACT);
            }
            else if ($lab_type)
            {
                $oLabTypes->searchArrayForValue($lab_type);
                $paramFilter[] = new DFC(LabsExt::FIELD_LAB_TYPE_ID, $oLabTypes->getLabTypeId(), DFC::EXACT);
            }
        }

        if ( count($paramFilter) > 0 )
        {
            $filter[] = new DFCAggregate($paramFilter, false);
        } 
        
        //= $school_unit ==================================================
        $oSchoolUnits = new SchoolUnitsExt($db);

        if ($school_unit){
        
        $paramFilter = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/",$school_unit);

        foreach ($arrayValues as $school_unit)
        {
            $school_unit = trim($school_unit);

            if (is_numeric($school_unit))
            {
                $paramFilter[] = new DFC(SchoolUnitsExt::FIELD_SCHOOL_UNIT_ID, $school_unit, DFC::EXACT);
            }
            else if ($school_unit)
            {
                $paramFilter[] = new DFC(SchoolUnitsExt::FIELD_NAME, $school_unit, DFC::EXACT);
            }
        }
        
        
        if ( count($paramFilter) > 0 )
        {
            $oSchoolUnits->getAll($db, $paramFilter, false);
        } 

        
        $paramFilter = array();
       if (count($oSchoolUnits->getObjsArray()) != 0 ) {     
            foreach ($oSchoolUnits->getObjsArray() as $oSchoolUnit)
            {  
                 $paramFilter[] = new DFC(LabsExt::FIELD_SCHOOL_UNIT_ID, $oSchoolUnit->getSchoolUnitId(), DFC::EXACT); 
            }
       } else {
             $paramFilter[] = new DFC(LabsExt::FIELD_SCHOOL_UNIT_ID, "0", DFC::EXACT);
        }
            
        //if ( count($paramFilter) > 0 )
       // {
            $filter[] = $school_unit_filter[] = new DFCAggregate($paramFilter, false);
                      
        //}

        }
        
        //= $state ==================================================
        
        $oStates = new StatesExt($db);
        $oStates->getAll($db);

        $paramFilter = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/", $state);

        foreach ($arrayValues as $state)
        {
            $state = trim($state);

            
            if (is_numeric($state))
            {
                $paramFilter[] = new DFC(LabsExt::FIELD_STATE_ID, $state, DFC::EXACT);
            }
            else if ($state)
            {
                $oStates->searchArrayForValue($state);
                $paramFilter[] = new DFC(LabsExt::FIELD_STATE_ID, $oStates->getStateId(), DFC::EXACT);
            }
        }

        if ( count($paramFilter) > 0 )
        {
            $filter[] = new DFCAggregate($paramFilter, false);
        } 
        
        //= $source ==================================================
        
        $oSources = new LabSourcesExt($db);
        $oSources->getAll($db);

        $paramFilter = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/", $source);

        foreach ($arrayValues as $source)
        {
            $source = trim($source);

            
            if (is_numeric($source))
            {
                $paramFilter[] = new DFC(LabsExt::FIELD_SOURCE_ID, $source, DFC::EXACT);
            }
            else if ($source)
            {
                $oSources->searchArrayForValue($source);
                $paramFilter[] = new DFC(LabsExt::FIELD_SOURCE_ID, $oSources->getSourceId(), DFC::EXACT);
            }
        }

        if ( count($paramFilter) > 0 )
        {
            $filter[] = new DFCAggregate($paramFilter, false);
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
        //==============================================================================   
        
        
        
        
        //$oAquisitionSources = new AquisitionSourcesExt($db);
        //$oAquisitionSources->getAll($db);
        
        //$oLabsHaveAquisitionSources = new LabAquisitionSourcesExt($db);
        //$oAquisitionSources->getAll($db);
        
        //$oEquipmentTypes = new EquipmentTypesExt($db);
        //$oEquipmentTypes->getAll($db);
//        
//        $oSpecializationCodes = new WorkerSpecializationsExt($db);
//        $oSpecializationCodes->getAll($db);
//        
//        $oEmploymentRelationships = new WorkerPositionsExt($db);
//        $oEmploymentRelationships->getAll($db);
        
        $oEquipmentCategories = new EquipmentCategoriesExt($db);
        $oEquipmentCategories->getAll($db);
        
        $oRelationTypes = new RelationTypesExt($db);
        $oRelationTypes->getAll($db);
        
        $oLabRelations = new LabRelationsExt($db);
        
        $oLabTransitions = new LabTransitionsExt($db);
        
        $oLabWorkers = new LabWorkersExt($db);
        
        $oWorkerPositions = new WorkerPositionsExt($db);
        $oWorkerPositions->getAll($db);
        
        $oWorkerSpecializations = new WorkerSpecializationsExt($db);
        $oWorkerSpecializations->getAll($db);
        
        $oWorkers = new WorkersExt($db);
        //============================================================================= 
        
        //$sort = array( new DSC($sort_field, $sort_mode));
        //$sort = array( new DSC(LabsExt::FIELD_LAB_ID,DSC::ASC)); 
        
        //multiple filters for Labs 
        $ext_filters = array(
            "aquisition_source"=>$aquisition_filters,
            "equipment_type"=>$equipment_type_filters,
            "lab_worker"=>$lab_worker_filters
        );
             
     
        
        $oLabs = new LabsExt($db);
        //$totalRows = $oLabs->findByFilterAsCount($db, $filter, true); 
       // $result["total"] = $totalRows[0]->getLabId();
        
       $totalRows = $oLabs->findByFilterJoinAsCount($db, $filter, $ext_filters, true); 
       $result["total"] = (int)$totalRows[0]->getLabId();
      
        $countRows = $oLabs->findByFilterBeta($db, $filter, $ext_filters, true, $sort_field, $sort_mode, $startat, $pagesize);

       //  if ($pagesize)        
       //     $countRows = $oLabs->findByFilterWithLimit($db, $filter, true, $sort, $startat, $pagesize);  
       // else
       //     $countRows = $oLabs->findByFilter($db, $filter, true, $sort);
        
        //$result['UNIQUE_LABS'] =  Validator::ToUniqueObject($countRows);
        //$countRows = Validator::ToUniqueObject($countRows);//edwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww
        $result["count"] = count( $countRows );

        $totalLabsRows = $oLabs->findBySqlJoinAsLabsCount($db, $filter, $ext_filters, true, $oLabTypes);  
        $result["all_labs_by_type"] =  $totalLabsRows;
   
                         
            //more info about lab_types of school_unit       
            foreach ($school_unit_filter[0] as $vals){
               
                if (($vals->getValue())!=0){
                    $totalLabsRowsWithFilterSchoolUnit = $oLabs->findBySqlJoinAsLabsCount($db, array($vals), null , true, $oLabTypes);   
                    $result["all_labs_by_type_from_school_unit"][$vals->getValue()] =  $totalLabsRowsWithFilterSchoolUnit;
                    //$result["all_labs_by_type_from_school_unit"] =  $totalLabsRowsWithFilterSchoolUnit;
                }
             
                else {
                      $totalLabsRowsWithFilterSchoolUnit = $oLabs->findBySqlJoinAsLabsCountNull($db, $oLabTypes);
                      $result["all_labs_by_type_from_school_unit"] = $totalLabsRowsWithFilterSchoolUnit; 
                  }
            }
         
        $data=null; //if lab not found then set $data=null

        if (count( $countRows ) > 0)
        {
                       
                //check if user select aquisition sources filters and found labs with these critiria
                if ( count($aquisition_filters) > 0 )
                {
                    $aquisition_sources_Filter = array();
                
                    foreach ($countRows as $arrayLaba) 
                    {
                        $aquisition_sources_Filter[] = new DFC(LabAquisitionSourcesExt::FIELD_LAB_ID, $arrayLaba->getLabId(), DFC::EXACT);                     
                    }
                    $test = array ( new DFCAggregate($aquisition_sources_Filter, false),
                                    new DFCAggregate($aquisition_filters, false) );
                    
                    $oLabsHaveAquisitionSources = new LabAquisitionSourcesExt($db);  
                    $oLabsAquisitionSources = $oLabsHaveAquisitionSources->findByFilter($db, $test, true, $sort);
               
                    $oLabs = new LabsExt($db);
                    $countRows= "";
                    $prefix='';
                    $LabIds='';
                    if (count( $oLabsAquisitionSources ) > 0) 
                    {
                        foreach ($oLabsAquisitionSources as $LabId)
                        {
                            $LabIds .= $prefix . '"' . $LabId->getLabId() . '"';
                            $prefix = ', ';
                        }
                    $countRows = $oLabs->findByIDs($db, $LabIds);
                    }       
                } 
                
                //check if user select equipment types filters and found labs with these critiria
                if ( count($equipment_type_filters) > 0 )
                {
                    $equipment_types_Filter = array();
                
                    foreach ($countRows as $arrayLabb) 
                    {
                        $equipment_types_Filter[] = new DFC(LabEquipmentTypesExt::FIELD_LAB_ID, $arrayLabb->getLabId(), DFC::EXACT);                     
                    }
                    $test1 = array ( new DFCAggregate($equipment_types_Filter, false),
                                    new DFCAggregate($equipment_type_filters, false) );
                    
                    $oLabsHaveEquipmentTypes = new LabEquipmentTypesExt($db);  
                    $oLabsEquipmentTypes = $oLabsHaveEquipmentTypes->findByFilter($db, $test1, true, $sort);
               
                    $oLabs = new LabsExt($db);
                    $countRows= "";
                    $prefix='';
                    $LabIds='';
                    if (count( $oLabsEquipmentTypes ) > 0) 
                    {
                        foreach ($oLabsEquipmentTypes as $LabId)
                        {
                            $LabIds .= $prefix . '"' . $LabId->getLabId() . '"';
                            $prefix = ', ';
                        }
                    $countRows = $oLabs->findByIDs($db, $LabIds);
                    }       
                }   
            
           
                //check if user select lab_workers filters and found labs with these critiria  
//                if ( count($lab_worker_filters) > 0 )
//                {
//                    $lab_worker_Filters = array();
//                
//                    foreach ($countRows as $arrayLabb) 
//                    {
//                        $lab_worker_Filters[] = new DFC(LabWorkersExt::FIELD_LAB_ID, $arrayLabb->getLabId(), DFC::EXACT);                     
//                    }
//                    $test2 = array ( new DFCAggregate($lab_worker_Filters, false),
//                                     new DFCAggregate($lab_worker_filters, false) );
//                    
//                    $oLabWorkers = new LabWorkersExt($db);  
//                    $oLabWorkerFound = $oLabWorkers->findByFilter($db, $test2, true, $sort);
//               
//                    $oLabs = new LabsExt($db);
//                    $countRows= "";
//                    $prefix='';
//                    $LabIds='';
//                    if (count( $oLabWorkerFound ) > 0) 
//                    {
//                        foreach ($oLabWorkerFound as $LabId)
//                        {
//                            $LabIds .= $prefix . '"' . $LabId->getLabId() . '"';
//                            $prefix = ', ';
//                        }
//                    $countRows = $oLabs->findByIDs($db, $LabIds);
//                    }       
//                }     
                
                
                
                
            $schoolUnitsFilter = array();
            //$labResponsibleFilter = array();
            $labWorkerFilter = array();
            $labRelationFilter = array();
            $labTransitionFilter = array();
            
//            $labsHaveAquisitionSourcesFilter = array();
//            $equipmentTypesFilter = array();
//            $specializationCodesFilter = array();
//            $employmentRelationshipsFilter = array();
//            $equipmentCategoriesFilter = array();
            
            foreach ($countRows as $rows)
            {
                
                $schoolUnitsFilter[] = new DFC(SchoolUnitsExt::FIELD_SCHOOL_UNIT_ID, $rows->getSchoolUnitId(), DFC::EXACT);
                //$labResponsibleFilter[] = new DFC(LabResponsiblesExt::FIELD_LAB_RESPONSIBLE_ID, $rows->getLabResponsibleId(), DFC::EXACT);
                $labWorkerFilter[] = new DFC(LabWorkersExt::FIELD_LAB_ID, $rows->getLabId(), DFC::EXACT);
                $labRelationFilter[] = new DFC(LabRelationsExt::FIELD_LAB_ID, $rows->getLabId(), DFC::EXACT);
                $labTransitionFilter[] = new DFC(LabTransitionsExt::FIELD_LAB_ID, $rows->getLabId(), DFC::EXACT);
//                $labsHaveAquisitionSourcesFilter[] = new DFC(LabAquisitionSourcesExt::FIELD_LAB_ID, $rows->getLabId(), DFC::EXACT);
//                $equipmentTypesFilter[] = new DFC(EquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $rows->getLabId(), DFC::EXACT);
//                $specializationCodesFilter[] = new DFC(SpecializationCodesExt::FIELD_SPECIALIZATION_CODE_ID, $rows->getLabResponsibleId(), DFC::EXACT);
//                $employmentRelationshipsFilter[] = new DFC(EmploymentRelationshipsExt::FIELD_EMPLOYMENT_RELATIONSHIP_ID, $rows->getLabResponsibleId(), DFC::EXACT);
//                $equipmentCategoriesFilter[] = new DFC(EquipmentCategoriesExt::FIELD_EQUIPMENT_CATEGORY_ID, $rows->getLabId(), DFC::EXACT);                       
                
            }

            //$schoolUnitsFilter = array_unique($schoolUnitsFilter, SORT_REGULAR);
            $oSchoolUnits->getAll($db, $schoolUnitsFilter, false); 
            
            //$labResponsibleFilter = array_unique($labResponsibleFilter, SORT_REGULAR);
            //$oLabResponsibles->getAll($db, $labResponsibleFilter, false);
            $lab_workers_filter_multi = array ( new DFCAggregate($labWorkerFilter, false)
                                                ,new DFCAggregate($lab_worker_filters, false)
                                                //,new DFC(LabWorkersExt::FIELD_WORKER_STATUS, 1, DFC::EXACT)
                    );

            $oLabWorkers->getAll($db, $lab_workers_filter_multi, true); 
            
            //$labRelationFilter = array_unique($labRelationFilter, SORT_REGULAR);
            $oLabRelations->getAll($db, $labRelationFilter, false); 
            
            $oLabTransitions->getAll($db, $labTransitionFilter, false); 
//            $oLabsHaveAquisitionSources->getAll($db, $labsHaveAquisitionSourcesFilter, false);  //do overright duplicate keys
            
            
//            $oEquipmentTypes->getAll($db, $equipmentTypesFilter, false); 
//            array(new DSC(UnitIpDnsExt::FIELD_MM_ID, DSC::ASC), new DSC(UnitIpDnsExt::FIELD_IP_DNS_ID, DSC::ASC))
//            );
//            
//            $oSpecializationCodes->getAll($db, $specializationCodesFilter, false); 
//            array(new DSC(GroupsExt::FIELD_MM_ID, DSC::ASC), new DSC(GroupsExt::FIELD_NAME, DSC::ASC))
//            );
//            
//            $oEmploymentRelationships->getAll($db, $employmentRelationshipsFilter, false); 
//            array(new DSC(LevelsExt::FIELD_MM_ID, DSC::ASC), new DSC(LevelsExt::FIELD_NAME, DSC::ASC))
//            );
//            
//            $oEquipmentCategories->getAll($db, $equipmentCategoriesFilter, false); 
//            array(new DSC(RelationsExt::FIELD_HOST_MM_ID, DSC::ASC), new DSC(RelationsExt::FIELD_GUEST_MM_ID, DSC::ASC))
//            );
               
            
            //used for relation school_units
            $guest_schools = array();
            $all_school_units = array();
           
            foreach ($oLabRelations->getObjsArray() as $oLabRelation)
            {       
                   
                        $guest_schools[] = new DFC(SchoolUnitsExt::FIELD_SCHOOL_UNIT_ID, $oLabRelation->getSchoolUnitId(), DFC::EXACT);
            }
            
            if ($guest_schools){
                //$guest_schools = array_unique($guest_schools, SORT_REGULAR);
                $all_school_units = array_unique(array_merge($guest_schools, $schoolUnitsFilter), SORT_REGULAR);
                $oSchoolUnits->getAll($db, $all_school_units , false);             
            }
            
        foreach ($countRows as $row)
        {        
            
             $data = array( "lab_id" => $row->getLabId(),
                            "name" => $row->getName(),
                            "special_name" => $row->getSpecialName(),
                            "creation_date"=>$row->getCreationDate(),
                            "created_by"=>$row->getCreatedBy(),
                            "last_updated"=>$row->getLastUpdated(),
                            "updated_by"=>$row->getUpdatedBy(),
                            "positioning"=>$row->getPositioning(),
                            //"aquisition_year"=>$row->getAquisitionYear(),
                            "comments"=>$row->getComments(),
                            "operational_rating"=>$row->getOperationalRating(),
                            "technological_rating"=>$row->getTechnologicalRating(),
                            //"lab_responsible"=>$oLabResponsibles->searchArrayForID( $row->getLabResponsibleId())->getRegistryNumber(),
                            "lab_type_id" => $row->getLabTypeId(),
                            "lab_type" => $oLabTypes->searchArrayForID( $row->getLabTypeId() )->getName(),
                            "school_unit_id" => $row->getSchoolUnitId(),
                            "school_unit" => $oSchoolUnits->searchArrayForID( $row->getSchoolUnitId())->getName(),
                            "state_id" => $row->getStateId(),
                            "state" => $oStates->searchArrayForID( $row->getStateId())->getName(),
                            "lab_source_id" => $row->getLabSourceId(),
                            "lab_source" => $oSources->searchArrayForID( $row->getLabSourceId())->getName()
                  );
             
            //= lab_relations=====================================================================
            $data["lab_relations"] = null;          
            foreach ($oLabRelations->getObjsArray() as $oLabRelation)
            {
                if ($oLabRelation->getLabId() == $row->getLabId()) {   
                    $oCircuit = new CircuitsExt($db);
                    $oCircuits = $oCircuit->findById($db,$oLabRelation->getCircuitId());
                   
                    $data["lab_relations"][] = array(  "lab_relation_id"=> $oLabRelation->getLabRelationId(),
                                                       "lab_id" => $oLabRelation->getLabId(),
                                                       "lab_name" => $row->getName(),
                                                       "school_unit_id" => $oLabRelation->getSchoolUnitId(),
                                                       "school_unit_name" => $oSchoolUnits->searchArrayForID( $oLabRelation->getSchoolUnitId())->getName(),
                                                       "relation_type_id" => $oLabRelation->getRelationTypeId(),
                                                       "relation_type_name" => $oRelationTypes->searchArrayForID( $oLabRelation->getRelationTypeId())->getName(),
                                                       "circuit_id" => $oLabRelation->getCircuitId(),
                                                       "circuit_phone_number" => $oCircuits==null?null:$oCircuits->getPhoneNumber()
                                               );   
                }
            }
           
            
            //= lab_transitions=====================================================================
            $data["lab_transitions"] = null;          
            foreach ($oLabTransitions->getObjsArray() as $oLabTransition)
            {
                if ($oLabTransition->getLabId() == $row->getLabId()) {   
                    
                    $data["lab_transitions"][] = array( "lab_transition_id"=> $oLabTransition->getLabTransitionId(),
                                                        "lab_id" => $oLabTransition->getLabId(),
                                                        "from_state_id" => $oLabTransition->getFromState(),
                                                        "from_state" => $oStates->searchArrayForID($oLabTransition->getFromState())->getName(),
                                                        "to_state_id" => $oLabTransition->getToState(),
                                                        "to_state" => $oStates->searchArrayForID($oLabTransition->getToState())->getName(),
                                                        "transition_date" => $oLabTransition->getTransitionDate(),
                                                        "transition_justification" => $oLabTransition->getTransitionJustification(),
                                                        "transition_source" => $oLabTransition->getTransitionSource()
                                               );   
                }
            }
            
            //= lab_responsibles ================================================================

            $data["lab_workers"] = null;          
            foreach ($oLabWorkers->getObjsArray() as $oLabWorker)
            {
                if ($oLabWorker->getLabId() == $row->getLabId()) {   
                    $oWorkerLab = $oWorkers->findById($db,$oLabWorker->getWorkerId());
                    $data["lab_workers"][] = array( "lab_worker_id"=> $oLabWorker->getLabWorkerId(),
                                                    "worker_id" => $oLabWorker->getWorkerId(),
                                                    "registry_no" => $oWorkerLab->getRegistryNo(),
                                                    "tax_number" => $oWorkerLab->getTaxNumber(),
                                                    "firstname" => $oWorkerLab->getFirstname(),
                                                    "lastname" => $oWorkerLab->getLastname(),
                                                    "fathername" => $oWorkerLab->getFathername(),
                                                    "sex" => $oWorkerLab->getSex(),
                                                    "specialization_code" => $oWorkerSpecializations->searchArrayForID( $oWorkerLab->getWorkerSpecializationId() )->getName(),
                                                    "lab_id" => $oLabWorker->getLabId(),
                                                    //"lab" => $oLabs->searchArrayForID( $worker->getLabId())->getName(),
                                                    "worker_position_id" => $oLabWorker->getWorkerPositionId(),
                                                    "worker_position" => $oWorkerPositions->searchArrayForID( $oLabWorker->getWorkerPositionId())->getName(),
                                                    "worker_email" => $oLabWorker->getWorkerEmail(),
                                                    "worker_status" => $oLabWorker->getWorkerStatus(),
                                                    "worker_start_service" => $oLabWorker->getWorkerStartService()                                 
                                                  );   
                }
            }
            
            
//old version doing one more query for every result
//
//
//                        $lab_worker_filter = array( new DFC(LabWorkersExt::FIELD_LAB_ID, $row->getLabId(), DFC::EXACT));
//                        $sort = array( new DSC(LabWorkersExt::FIELD_LAB_ID, DSC::ASC) );
//                        $oLabWorkers = new LabWorkersExt($db);
//                        $oLabWorker = $oLabWorkers->findByFilter($db, $lab_worker_filter, true, $sort);
//                        $data["lab_workers"] = null;
//                        if ($oLabWorker){
//                            //$lab["equipment_types"] = array();
//                            
//                            foreach ($oLabWorker as $worker) {
//                                    //$idEquipmentType=$oEquipmentTypes->searchArrayForID($EquipmentTypes->getEquipmentTypeId());
//                                    //$idEquipmentCategory=$oEquipmentCategories->searchArrayForID($idEquipmentType->getEquipmentCategoryId());
//                                   $oWorkerLab = $oWorkers->findById($db,$worker->getWorkerId());
//                                    $data["lab_workers"][] = array("lab_worker_id"=> $worker->getLabWorkerId(),
//                                                                "worker_id" => $worker->getWorkerId(),                                          
//                                                                "registry_no" => $oWorkerLab->getRegistryNo(),
//                                                                "tax_number" => $oWorkerLab->getTaxNumber(),
//                                                                "firstname" => $oWorkerLab->getFirstname(),
//                                                                "lastname" => $oWorkerLab->getLastname(),
//                                                                "fathername" => $oWorkerLab->getFathername(),
//                                                                "sex" => $oWorkerLab->getSex(),
//                                                                "specialization_code" => $oWorkerSpecializations->searchArrayForID( $oWorkerLab->getWorkerSpecializationId() )->getName(),
//                                                                "lab_id" => $worker->getLabId(),
//                                                                //"lab" => $oLabs->searchArrayForID( $worker->getLabId())->getName(),
//                                                                "worker_position_id" => $worker->getWorkerPositionId(),
//                                                                "worker_position" => $oWorkerPositions->searchArrayForID( $worker->getWorkerPositionId())->getName(),
//                                                                "worker_email" => $worker->getWorkerEmail(),
//                                                                "worker_status" => $worker->getWorkerStatus(),
//                                                                "worker_start_service" => $worker->getWorkerStartService()
//                                                                     );
//                           }
//                        }
        
        
            
          
            
//!!!!!!!!!!!!!!!!!!!!!!!!!!!             change aquisition sources and equipment_types loop filter with this query
//               SELECT * FROM labs 
//               LEFT JOIN labs_have_aquisition_sources ON labs_have_aquisition_sources.lab_id=labs.lab_id 
//               LEFT JOIN labs_have_equipment_types ON labs_have_equipment_types.lab_id=labs.lab_id 
//                WHERE 
//                                labs_have_aquisition_sources.aquisition_source_id in ("1") 
//                AND 	labs_have_equipment_types.equipment_type_id in ("1") 
//                AND 	labs.lab_id in ("3529", "3591", "3596", "3597", "3598", "3599", "3600", "3601", "3602", "3603", "3604", "3605")
                              
            //= aquisition_sources ================================================================
            
            if ($aquisition_source){
                $count_aq_filters=count($aquisition_filters);
                $aquisition_source_filter_set =array();
                if ($count_aq_filters==1){
                    $aquisition_source_filter_multi = array( new DFC(LabAquisitionSourcesExt::FIELD_LAB_ID, $row->getLabId(), DFC::EXACT),
                                                             new DFC(LabAquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, $aquisition_filters[0]->getValue(), DFC::EXACT));
                } else {
                    foreach ($aquisition_filters as $AquisitionSource){
                        $aquisition_source_filter_set[] = new DFC(LabAquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, $AquisitionSource->getValue(), DFC::EXACT);     
                    }
                    $aquisition_source_filter_multi = array ( new DFCAggregate($aquisition_source_filter_set, false),
                                                              new DFC(LabAquisitionSourcesExt::FIELD_LAB_ID, $row->getLabId(), DFC::EXACT));
                }    
            } else {
                    $aquisition_source_filter_multi = array( new DFC(LabAquisitionSourcesExt::FIELD_LAB_ID, $row->getLabId(), DFC::EXACT));
            }

            
            $data["aquisition_sources"] = null;
            $data["aquisition_sources_formatted"] = null;
            //$filter = array( new DFC(LabAquisitionSourcesExt::FIELD_LAB_ID, $row->getLabId(), DFC::EXACT) );
            $sort = array( new DSC(LabAquisitionSourcesExt::FIELD_LAB_ID, DSC::ASC) );
            $oLabsHaveAquisitionSources = new LabAquisitionSourcesExt($db);
           // $oLabsAquisitionSources = $oLabsHaveAquisitionSources->findByFilter($db, $filter, true, $sort);
            $oLabsAquisitionSources = $oLabsHaveAquisitionSources->findByFilter($db, $aquisition_source_filter_multi, true, $sort);
            
            if ($oLabsAquisitionSources){
                foreach ($oLabsAquisitionSources as $oAquisitionSource) {
                     $data["aquisition_sources"][] = array("name" => $oAquisitionSources->searchArrayForID($oAquisitionSource->getAquisitionSourceId())->getName(),
                                                           "aquisition_year" => $oAquisitionSource->getAquisitionYear(),
                                                           "aquisition_comments" => $oAquisitionSource->getAquisitionComments()
                             );   
                }
                $data["aquisition_sources_formatted"] = implode(', ', array_map(function($entry){ return $entry['name']; }, $data["aquisition_sources"]));
           } 
            
            //= equipment_types ================================================================
           
            if ($equipment_type){
               $count_eqt_filters=count($equipment_type_filters);
               $equipment_type_filter_set =array();
               if ($count_eqt_filters==1){
                   $equipment_type_filter_multi = array( new DFC(LabEquipmentTypesExt::FIELD_LAB_ID, $row->getLabId(), DFC::EXACT),
                                                         new DFC(LabEquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $equipment_type_filters[0]->getValue(), DFC::EXACT));
               } else {
                   foreach ($equipment_type_filters as $EquipmentType){
                       $equipment_type_filter_set[] = new DFC(LabEquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $EquipmentType->getValue(), DFC::EXACT);     
                   }
                   $equipment_type_filter_multi = array ( new DFCAggregate($equipment_type_filter_set, false),
                                                          new DFC(LabEquipmentTypesExt::FIELD_LAB_ID, $row->getLabId(), DFC::EXACT));
               }    
           } else {
                   $equipment_type_filter_multi = array( new DFC(LabEquipmentTypesExt::FIELD_LAB_ID, $row->getLabId(), DFC::EXACT));
           }          
           
           
           
           
            $data["equipment_types"] = null;         
            //$filter = array( new DFC(LabEquipmentTypesExt::FIELD_LAB_ID, $row->getLabId(), DFC::EXACT) );
            $sort = array( new DSC(LabEquipmentTypesExt::FIELD_LAB_ID, DSC::ASC) );
            $oLabsHaveEquipmentTypes = new LabEquipmentTypesExt($db);
           // $oLabsEquipmentTypes = $oLabsHaveEquipmentTypes->findByFilter($db, $filter, true, $sort);
            $oLabsEquipmentTypes = $oLabsHaveEquipmentTypes->findByFilter($db, $equipment_type_filter_multi, true, $sort);
            
            
            if ($oLabsEquipmentTypes) {    
                foreach ($oLabsEquipmentTypes as $EquipmentTypes) {
                        $idEquipmentType=$oEquipmentTypes->searchArrayForID($EquipmentTypes->getEquipmentTypeId());
                        $idEquipmentCategory=$oEquipmentCategories->searchArrayForID($idEquipmentType->getEquipmentCategoryId());
                        $data["equipment_types"][] = array("equipment_type_id" => $idEquipmentType->getEquipmentTypeId(),      
                                                           "equipment_type_name" => $idEquipmentType->getName(),
                                                           //"equipment_type_number" => $idEquipmentType->getNumber(),
                                                           "equipment_category_id" => $idEquipmentType->getEquipmentCategoryId(),
                                                           "equipment_category_name" => $idEquipmentCategory->getName(),
                                                           "items" => $EquipmentTypes->getItems()
                                                            );
                }
            } 
            
            $result["data"][] = $data;    
        }   
        
        } else {
            //$data["lab"] = null;
           // $labs["labs_info"]="Δεν υπάρχει κανένα εργαστήριο";
            $result["data"] = $data; 
        }   

        $result["pagesize"]=$pagesize;
        $result["page"]=$page;
        $result["status"] = ExceptionCodes::NoErrors;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".ExceptionMessages::NoErrors;
    } catch (Exception $e) {
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
}

?>