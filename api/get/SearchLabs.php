<?php
/**
 *
 * @version 1.0.1
 * @author  ΤΕΙ Αθήνας
 * @package GET
 * 
 * 
 */
 
header("Content-Type: text/html; charset=utf-8");

function SearchLabs ( $lab_id, $lab_name, $special_name, $creation_date, $operational_rating, $technological_rating,
                      $lab_type, $school_unit_id, $school_unit_name, $lab_state, $lab_source,
                      $aquisition_source, $equipment_type, $lab_worker,
                      $region_edu_admin, $edu_admin, $transfer_area, $municipality, $prefecture,
                      $education_level, $school_unit_type, $school_unit_state, 
                      $pagesize, $page, $orderby, $ordertype, $searchtype, $export ) {

    global $db;
    global $app;
    
    $filter = array();
    $filter_aquisition_sources = array();
    $filter_equipment_types = array();
    $filter_lab_relations = array();
    $filter_lab_transitions = array();
            
    $result = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["data"] = array();
    $result["controller"] = __FUNCTION__;
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();

    try
    {
    //======================================================================================================================
    //= Paging
    //======================================================================================================================

        if ( Validator::isMissing('searchtype') )
            $searchtype = SearchEnumTypes::Contain;
        else if ( SearchEnumTypes::isValidValue( $searchtype ) || SearchEnumTypes::isValidName( $searchtype ) )
            $searchtype = SearchEnumTypes::getValue($searchtype);
        else
            throw new Exception(ExceptionMessages::InvalidSearchType." : ".$searchtype, ExceptionCodes::InvalidSearchType);

        if ( Validator::isMissing('page') )
            $page = 1;
        else if ( Validator::isNull($page) )
            throw new Exception(ExceptionMessages::MissingPageValue, ExceptionCodes::MissingPageValue);
        elseif ( Validator::isArray($page) )
            throw new Exception(ExceptionMessages::InvalidPageArray, ExceptionCodes::InvalidPageArray);
        elseif (Validator::isLowerThan($page, 0, true) )
            throw new Exception(ExceptionMessages::InvalidPageNumber, ExceptionCodes::InvalidPageNumber);
        elseif (!Validator::isGreaterThan($page, 0) )
            throw new Exception(ExceptionMessages::InvalidPageType, ExceptionCodes::InvalidPageType);
        else
            $page = Validator::toInteger($page);



        if ( Validator::isMissing('pagesize') )
            $pagesize = Parameters::DefaultPageSize;
        else if ( Validator::isEqualTo($pagesize, 0) )
            $pagesize = Parameters::AllPageSize;
        else if ( Validator::isNull($pagesize) )
            throw new Exception(ExceptionMessages::MissingPageSizeValue, ExceptionCodes::MissingPageSizeValue);
        elseif ( Validator::isArray($pagesize) )
            throw new Exception(ExceptionMessages::InvalidPageSizeArray, ExceptionCodes::InvalidPageSizeArray);
        elseif ( (Validator::isLowerThan($pagesize, 0) ) )
            throw new Exception(ExceptionMessages::InvalidPageSizeNumber, ExceptionCodes::InvalidPageSizeNumber);
        elseif (!Validator::isGreaterThan($pagesize, 0) )
            throw new Exception(ExceptionMessages::InvalidPageSizeType, ExceptionCodes::InvalidPageSizeType);
        else
            $pagesize = Validator::toInteger($pagesize);

//======================================================================================================================
//= $lab_id
//======================================================================================================================

        if ( Validator::isExists('lab_id') )
        {
            $table_name = "labs";
            $table_column_id = "lab_id";
            $table_column_name = "lab_id";
            $filter_validators = 'null,id';

            $filter[] = Filters::BasicFilter( $lab_id, $table_name, $table_column_id, $table_column_name, $filter_validators,
                                               ExceptionMessages::InvalidLabIDType, ExceptionCodes::InvalidLabIDType);

        }
        
//======================================================================================================================
//= $lab_name
//======================================================================================================================

        if ( Validator::isExists('lab_name') )
        {
            $table_name = "labs";
            $table_column_name = "name";

            $filter[] =  Filters::ExtBasicFilter($lab_name, $table_name, $table_column_name, $searchtype, 
                                                 ExceptionMessages::InvalidLabNameType, ExceptionCodes::InvalidLabNameType ); 
            
        }
        
//======================================================================================================================
//= $special_name
//======================================================================================================================

        if ( Validator::isExists('special_name') )
        {
            $table_name = "labs";
            $table_column_name = "special_name";

            $filter[] =  Filters::ExtBasicFilter($special_name, $table_name, $table_column_name, $searchtype, 
                                                 ExceptionMessages::InvalidLabSpecialNameType, ExceptionCodes::InvalidLabSpecialNameType ); 
            
        }

//======================================================================================================================
//= $creation_date
//======================================================================================================================

        if ( Validator::isExists('creation_date') )
        {
            $table_name = "labs";
            $table_column_name = "creation_date";
            $filter_validators = 'null,date';

            $filter[] =  Filters::DateBasicFilter($creation_date, $table_name, $table_column_name, $filter_validators, 
                                                 ExceptionMessages::InvalidLabCreationDateType, ExceptionCodes::InvalidLabCreationDateType ); 
            
        }

//======================================================================================================================
//= $operational_rating
//======================================================================================================================

        if ( Validator::isExists('operational_rating') )
        {
            $table_name = "labs";
            $table_column_id = "operational_rating";
            $table_column_name = "operational_rating";
            $filter_validators = 'null,numeric';
            
            $filter[] = Filters::BasicFilter( $operational_rating, $table_name, $table_column_id, $table_column_name, $filter_validators, 
                                                               ExceptionMessages::InvalidLabOperationalRatingType, ExceptionCodes::InvalidLabOperationalRatingType);

        }
//======================================================================================================================
//= $technological_rating
//======================================================================================================================

        if ( Validator::isExists('technological_rating') )
        {
            $table_name = "labs";
            $table_column_id = "technological_rating";
            $table_column_name = "technological_rating";
            $filter_validators = 'null,numeric';

            $filter[] = Filters::BasicFilter( $technological_rating, $table_name, $table_column_id, $table_column_name, $filter_validators, 
                                                               ExceptionMessages::InvalidLabTechnologicalRatingType, ExceptionCodes::InvalidLabTechnologicalRatingType);

        }
        
//======================================================================================================================
//= $lab_type
//======================================================================================================================

        if ( Validator::isExists('lab_type') )
        {

            $table_name = "lab_types";
            $table_column_id = "lab_type_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $lab_type, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidLabTypeType, ExceptionCodes::InvalidLabTypeType);
            
        }
        
//======================================================================================================================
//= $school_unit_id
//======================================================================================================================

        if ( Validator::isExists('school_unit_id') )
        {

            $table_name = "school_units";
            $table_column_id = "school_unit_id";
            $table_column_name = "name";
            $filter_validators = 'null,id';
            
            $filter[] = Filters::BasicFilter( $school_unit_id, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidSchoolUnitIDType, ExceptionCodes::InvalidSchoolUnitIDType);
            
    }
    
//======================================================================================================================
//= $school_unit_name
//======================================================================================================================

        if ( Validator::isExists('school_unit_name') )
        {

            $table_name = "school_units";
            $table_column_id = "school_unit_id";
            $table_column_name = "name";
            $filter_validators = 'null,name';
            
            $filter[] = Filters::BasicFilter( $school_unit_name, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidSchoolUnitNameType, ExceptionCodes::InvalidSchoolUnitNameType);
            
    }
    
//======================================================================================================================
//= $lab_state
//======================================================================================================================

        if ( Validator::isExists('lab_state') )
        {

            $table_name = "lab_states";
            $table_column_id = "state_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $lab_state, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidStateType, ExceptionCodes::InvalidStateType);
            
        }
        
//======================================================================================================================
//= $lab_source
//======================================================================================================================

        if ( Validator::isExists('lab_source') )
        {

            $table_name = "lab_sources";
            $table_column_id = "lab_source_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $lab_source, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidLabSourceType, ExceptionCodes::InvalidLabSourceType);
            
        }
 //======================================================================================================================
//= $aquisition_source
//======================================================================================================================

        if ( Validator::isExists('aquisition_source') )
        {
            $table_name = "aquisition_sources";
            $table_column_id = "aquisition_source_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';

            $filter[] = $filter_aquisition_sources[] = Filters::BasicFilter( $aquisition_source, $table_name, $table_column_id, $table_column_name, $filter_validators, 
                                                                              ExceptionMessages::InvalidAquisitionSourceType, ExceptionCodes::InvalidAquisitionSourceType);      

        }
 
//======================================================================================================================
//= $equipment_type
//======================================================================================================================

        if ( Validator::isExists('equipment_type') )
        {
            $table_name = "equipment_types";
            $table_column_id = "equipment_type_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';

            $filter[] = $filter_equipment_types[] = Filters::BasicFilter( $equipment_type, $table_name, $table_column_id, $table_column_name, $filter_validators, 
                                                                          ExceptionMessages::InvalidEquipmentTypeType, ExceptionCodes::InvalidEquipmentTypeType);      

        }
 
//======================================================================================================================
//= $lab_worker
//======================================================================================================================

        if ( Validator::isExists('lab_worker') )
        {
            $table_name = "workers";
            $table_column_id = "registry_no";
            $table_column_name = "lastname";
            $filter_validators = 'null,id,value';

            $filter[] = $filter_lab_workers[] = Filters::BasicFilter( $lab_worker, $table_name, $table_column_id, $table_column_name, $filter_validators, 
                                                                      ExceptionMessages::InvalidLabWorkerType, ExceptionCodes::InvalidLabWorkerType);           

        }
        
//======================================================================================================================
//= $region_edu_admin
//======================================================================================================================

        if ( Validator::isExists('region_edu_admin') )
        {

            $table_name = "region_edu_admins";
            $table_column_id = "region_edu_admin_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $region_edu_admin, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidRegionEduAdminType, ExceptionCodes::InvalidRegionEduAdminType);
            
        }

//======================================================================================================================
//= $edu_admin
//======================================================================================================================

        if ( Validator::isExists('edu_admin') )
        {

            $table_name = "edu_admins";
            $table_column_id = "edu_admin_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $edu_admin, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidEduAdminType, ExceptionCodes::InvalidEduAdminType);

        }

//======================================================================================================================
//= $transfer_area
//======================================================================================================================

        if ( Validator::isExists('transfer_area') )
        {
            $table_name = "transfer_areas";
            $table_column_id = "transfer_area_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $transfer_area, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidTransferAreaType, ExceptionCodes::InvalidTransferAreaType);

        }

//======================================================================================================================
//= $municipality
//======================================================================================================================

        if ( Validator::isExists('municipality') )
        {
            
            $table_name = "municipalities";
            $table_column_id = "municipality_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
              
            $filter[] = Filters::BasicFilter( $municipality, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidMunicipalityType, ExceptionCodes::InvalidMunicipalityType);

        }
        
//======================================================================================================================
//= $prefecture
//======================================================================================================================

        if ( Validator::isExists('prefecture') )
        {
            $table_name = "prefectures";
            $table_column_id = "prefecture_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';

            $filter[] = Filters::BasicFilter( $prefecture, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidPrefectureType, ExceptionCodes::InvalidPrefectureType);

        }

//======================================================================================================================
//= $education_level
//======================================================================================================================

        if ( Validator::isExists('education_level') )
        {
            $table_name = "education_levels";
            $table_column_id = "education_level_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $education_level, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidEducationLevelType, ExceptionCodes::InvalidEducationLevelType);

        }
        
 //======================================================================================================================
//= $school_unit_type
//======================================================================================================================

        if ( Validator::isExists('school_unit_type') )
        {
            $table_name = "school_unit_types";
            $table_column_id = "school_unit_type_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $school_unit_type, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidSchoolUnitTypeType, ExceptionCodes::InvalidSchoolUnitTypeType);
            
        }     
        
//======================================================================================================================
//= $school_unit_state
//======================================================================================================================

        if ( Validator::isExists('school_unit_state') )
        {
            $table_name = "school_unit_states";
            $table_column_id = "state_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $school_unit_state, $table_name, $table_column_id, $table_column_name, $filter_validators, 
                                              ExceptionMessages::InvalidStateType, ExceptionCodes::InvalidStateType);

        }
      
//======================================================================================================================
//= $export
//======================================================================================================================
        
        if ( Validator::isMissing('export') )
            $export = ExportDataEnumTypes::JSON;
        else if ( ExportDataEnumTypes::isValidValue( $export ) || ExportDataEnumTypes::isValidName( $export ) ) {
           $export = ExportDataEnumTypes::getValue($export);
        //    $pagesize = Parameters::AllPageSize;
        } else
            throw new Exception(ExceptionMessages::InvalidExport." : ".$export, ExceptionCodes::InvalidExport);

//======================================================================================================================
//= $ordertype
//======================================================================================================================

        if ( Validator::isMissing('ordertype') )
            $ordertype = OrderEnumTypes::ASC ;
        else if ( OrderEnumTypes::isValidValue( $ordertype ) || OrderEnumTypes::isValidName( $ordertype ) )
            $ordertype = OrderEnumTypes::getValue($ordertype);
        else
            throw new Exception(ExceptionMessages::InvalidOrderType." : ".$ordertype, ExceptionCodes::InvalidOrderType);      

//======================================================================================================================
//= $orderby
//======================================================================================================================

        if ( Validator::isExists('orderby') )
        {
            $columns = array(
                "lab_id",
                "lab_name", "special_name", "creation_date", "operational_rating", "technological_rating",
                "lab_type_id", "lab_type",
                "school_unit_id", "school_unit_name",
                "lab_state_id", "lab_state",
                "lab_source_id", "lab_source"
            );

            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        }
        else
            $orderby = "lab_id";

//======================================================================================================================
//= E X E C U T E
//======================================================================================================================

       $sqlSelect = "SELECT 
                     DISTINCT   labs.lab_id,
                                labs.name as lab_name,
                                labs.special_name,
                                labs.creation_date,
                                labs.created_by,
                                labs.last_updated,
                                labs.updated_by,
                                labs.positioning,
                                labs.comments,
                                labs.operational_rating,
                                labs.technological_rating,
                                lab_types.lab_type_id, 
                                lab_types.name as lab_type, 
                                school_units.school_unit_id, 
                                school_units.name as school_unit_name, 
                                lab_sources.lab_source_id, 
                                lab_sources.name as lab_source,
                                lab_states.state_id as lab_state_id, 
                                lab_states.name as lab_state,
                                school_unit_states.state_id as school_unit_state_id, 
                                school_unit_states.name as school_unit_state,
                                region_edu_admins.region_edu_admin_id, 
                                region_edu_admins.name as region_edu_admin, 
                                edu_admins.edu_admin_id, 
                                edu_admins.name as edu_admin, 
                                transfer_areas.transfer_area_id, 
                                transfer_areas.name as transfer_area, 
                                prefectures.prefecture_id, 
                                prefectures.name as prefecture, 
                                municipalities.municipality_id, 
                                municipalities.name as municipality, 
                                education_levels.education_level_id, 
                                education_levels.name as education_level, 
                                school_unit_types.school_unit_type_id, 
                                school_unit_types.name as school_unit_type
                       ";

        $sqlFrom = "FROM labs
                                LEFT JOIN lab_types using (lab_type_id)
                                LEFT JOIN school_units using (school_unit_id)
                                LEFT JOIN lab_sources using (lab_source_id)
                                LEFT JOIN states lab_states ON labs.state_id = lab_states.state_id
                                LEFT JOIN lab_aquisition_sources using (lab_id)
                                LEFT JOIN aquisition_sources ON lab_aquisition_sources.aquisition_source_id=aquisition_sources.aquisition_source_id
                                LEFT JOIN lab_equipment_types using (lab_id)
                                LEFT JOIN equipment_types ON lab_equipment_types.equipment_type_id=equipment_types.equipment_type_id
                                LEFT JOIN lab_workers using (lab_id)
                                LEFT JOIN workers ON lab_workers.worker_id=workers.worker_id
                                LEFT JOIN lab_relations using (lab_id)
                                LEFT JOIN relation_types ON relation_types.relation_type_id=lab_relations.relation_type_id
                                LEFT JOIN lab_transitions using (lab_id)
                                LEFT JOIN region_edu_admins using (region_edu_admin_id) 
                                LEFT JOIN edu_admins using (edu_admin_id) 
                                LEFT JOIN transfer_areas using (transfer_area_id)
                                LEFT JOIN prefectures using (prefecture_id)
                                LEFT JOIN municipalities using (municipality_id)
                                LEFT JOIN education_levels using (education_level_id)
                                LEFT JOIN school_unit_types using (school_unit_type_id)
                                LEFT JOIN states school_unit_states ON school_units.state_id = school_unit_states.state_id
                                ";

        $sqlWhere = (count($filter) > 0 ? " WHERE " . implode(" AND ", $filter) : "" );
        $sqlOrder = " ORDER BY ". $orderby ." ". $ordertype;
        $sqlLimit = ($page && $pagesize) ? " LIMIT ".(($page - 1) * $pagesize).", ".$pagesize : "";

        $result["filters"] = $filter;
        //#############find total total labs without filter of limits(page and pagesize)
        $sql = "SELECT count(DISTINCT labs.lab_id) as total_labs " . $sqlFrom . $sqlWhere;
        //echo "<br><br>".$sql."<br><br>";

        $stmt = $db->query( $sql );
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        $result["total"] = $rows["total_labs"];
        
        //check if $page input from user, is valid
        $maxPage = Pagination::checkMaxPage($rows["total_labs"], $page, $pagesize);
        
        //#############find count labs with filter of limits(page and pagesize)
        $sql = $sqlSelect . $sqlFrom . $sqlWhere . $sqlOrder . $sqlLimit ;
        //echo "<br><br>".$sql."<br><br>";

        $stmt = $db->query( $sql );
        $array_labs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result["count"] = $stmt->rowCount();
        
        //create array with school_unit ids
        if (count($array_labs)>0){
            $prefix = '';
            $lab_ids= '';
            $school_unit_ids = '';
            foreach ($array_labs as $array_lab)
            {
                $lab_ids .= $prefix . '"' . $array_lab["lab_id"] . '"';
                $school_unit_ids .= $prefix . '"' . $array_lab["school_unit_id"] . '"';
                $prefix = ', ';
            }                       
        } else {
            $lab_ids = "0";
            $school_unit_ids = "0";
        }
                
        //find lab types per school unit       
        $result["all_labs_by_type"] = Filters::AllLabsCounter($sqlFrom,$sqlWhere);
        
        $school_unit_ids = Validator::ToUniqueString($school_unit_ids);
        
//======================================================================================================================
//= $array_lab_aquisition_sources
//======================================================================================================================

        $sqlSelect = "SELECT
                        lab_aquisition_sources.lab_aquisition_source_id,
                        lab_aquisition_sources.lab_id,
                        lab_aquisition_sources.aquisition_year,
                        lab_aquisition_sources.aquisition_comments,
                        aquisition_sources.aquisition_source_id,
                        aquisition_sources.name as aquisition_source
                     ";

        $sqlFrom   = "FROM lab_aquisition_sources
                      LEFT JOIN aquisition_sources using (aquisition_source_id)
                      ";

        $sqlWhere = " WHERE lab_aquisition_sources.lab_id in (".$lab_ids.")";
        $sqlWhereFilters = (count($filter_aquisition_sources) > 0 ? " AND " . implode(" AND ", $filter_aquisition_sources) : "" );
        $sqlOrder = " ORDER BY lab_aquisition_sources.lab_id ASC";

        $sql = $sqlSelect . $sqlFrom . $sqlWhere .$sqlWhereFilters . $sqlOrder;
        //echo "<br><br>".$sql."<br><br>";

        $stmt = $db->query( $sql );
        $array_lab_aquisition_sources = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($array_lab_aquisition_sources as $lab_aquisition_source)
        {
            $lab_aquisition_sources[ $lab_aquisition_source["lab_id"] ][ $lab_aquisition_source["lab_aquisition_source_id"] ] = $lab_aquisition_source;
        }
    
//======================================================================================================================
//= $array_lab_equipment_types
//======================================================================================================================

        $sqlSelect = "SELECT
                        lab_equipment_types.equipment_type_id,
                        lab_equipment_types.lab_id,
                        lab_equipment_types.items,
                        equipment_types.name as equipment_type,
                        equipment_types.equipment_category_id,
                        equipment_categories.equipment_category_id,
                        equipment_categories.name as equipment_category
                     ";

        $sqlFrom   = "FROM lab_equipment_types
                      LEFT JOIN equipment_types using (equipment_type_id)
                      LEFT JOIN equipment_categories ON equipment_types.equipment_category_id=equipment_categories.equipment_category_id
                      ";

        $sqlWhere = " WHERE lab_equipment_types.lab_id in (".$lab_ids.")";
        $sqlWhereFilters = (count($filter_equipment_types) > 0 ? " AND " . implode(" AND ", $filter_equipment_types) : "" );
        $sqlOrder = " ORDER BY lab_equipment_types.lab_id ASC";

        $sql = $sqlSelect . $sqlFrom . $sqlWhere .$sqlWhereFilters . $sqlOrder;
        //echo "<br><br>".$sql."<br><br>";

        $stmt = $db->query( $sql );
        $array_lab_equipment_types = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($array_lab_equipment_types as $lab_equipment_type)
        {
            $lab_equipment_types[ $lab_equipment_type["lab_id"] ][ $lab_equipment_type["equipment_type_id"] ] = $lab_equipment_type;
        }
        
//======================================================================================================================
//= $array_lab_workers
//======================================================================================================================

        $sqlSelect = "SELECT
                        lab_workers.lab_worker_id,
                        lab_workers.lab_id,
                        lab_workers.worker_email,
                        lab_workers.worker_status,
                        lab_workers.worker_start_service,
                        workers.worker_id,
                        workers.registry_no,
                        workers.tax_number,
                        workers.firstname,
                        workers.lastname,
                        workers.fathername,
                        workers.sex,
                        worker_specializations.worker_specialization_id,
                        worker_specializations.name as worker_specialization,
                        worker_positions.worker_position_id,
                        worker_positions.name as worker_position
                     ";

        $sqlFrom   = "FROM lab_workers
                      LEFT JOIN worker_positions using (worker_position_id)
                      LEFT JOIN workers using (worker_id)
                      LEFT JOIN worker_specializations ON workers.worker_specialization_id = worker_specializations.worker_specialization_id
                      ";

        $sqlWhere = " WHERE lab_workers.lab_id in (".$lab_ids.")";
        $sqlWhereFilters = (count($filter_lab_workers) > 0 ? " AND " . implode(" AND ", $filter_lab_workers) : "" );
        $sqlOrder = " ORDER BY lab_workers.lab_id ASC";

        $sql = $sqlSelect . $sqlFrom . $sqlWhere . $sqlWhereFilters . $sqlOrder;
        //echo "<br><br>".$sql."<br><br>";

        $stmt = $db->query( $sql );
        $array_lab_workers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($array_lab_workers as $lab_worker)
        {
            $lab_workers[ $lab_worker["lab_id"] ][ $lab_worker["lab_worker_id"] ] = $lab_worker;
        }
        
//======================================================================================================================
//= $array_lab_relations
//======================================================================================================================

        $sqlSelect = "SELECT
                        lab_relations.lab_relation_id,
                        lab_relations.lab_id,
                        lab_relations.school_unit_id,
                        relation_types.relation_type_id,
                        relation_types.name as relation_type_name,
                        circuits.circuit_id,
                        circuits.phone_number
                     ";

        $sqlFrom   = "FROM lab_relations
                      LEFT JOIN relation_types using (relation_type_id)
                      LEFT JOIN circuits using (circuit_id)
                      ";

        $sqlWhere = " WHERE lab_relations.lab_id in (".$lab_ids.")";
        $sqlWhereFilters = (count($filter_lab_relations) > 0 ? " AND " . implode(" AND ", $filter_lab_relations) : "" );
        $sqlOrder = " ORDER BY lab_relations.lab_id ASC";

        $sql = $sqlSelect . $sqlFrom . $sqlWhere . $sqlWhereFilters . $sqlOrder;
        //echo "<br><br>".$sql."<br><br>";

        $stmt = $db->query( $sql );
        $array_lab_relations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($array_lab_relations as $lab_relation)
        {
            $lab_relations[ $lab_relation["lab_id"] ][ $lab_relation["lab_relation_id"] ] = $lab_relation;
        }

//======================================================================================================================
//= $array_lab_transitions
//======================================================================================================================

        $sqlSelect = "SELECT
                        lab_transitions.lab_transition_id,
                        lab_transitions.lab_id,
                        lab_transitions.from_state,
                        lab_transitions.to_state,
                        lab_transitions.transition_date,
                        lab_transitions.transition_justification,
                        lab_transitions.transition_source,
                        from_states.state_id as from_state_id,
                        from_states.name as from_state_name,
                        to_states.state_id as to_state_id,
                        to_states.name as to_state_name
                     ";

        $sqlFrom   = "FROM lab_transitions
                        LEFT JOIN states from_states ON lab_transitions.from_state = from_states.state_id
                        LEFT JOIN states to_states ON lab_transitions.to_state = to_states.state_id
                      ";

        $sqlWhere = " WHERE lab_transitions.lab_id in (".$lab_ids.")";
        $sqlWhereFilters = (count($filter_lab_transitions) > 0 ? " AND " . implode(" AND ", $filter_lab_transitions) : "" );
        $sqlOrder = " ORDER BY lab_transitions.lab_id ASC";

        $sql = $sqlSelect . $sqlFrom . $sqlWhere . $sqlWhereFilters . $sqlOrder;
        //echo "<br><br>".$sql."<br><br>";

        $stmt = $db->query( $sql );
        $array_lab_transitions= $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($array_lab_transitions as $lab_transition)
        {
            $lab_transitions[ $lab_transition["lab_id"] ][ $lab_transition["lab_transition_id"] ] = $lab_transition;
        }


//======================================================================================================================
//= $array_school_units_workers
//======================================================================================================================
        
        $sqlSelect = "SELECT
                        school_unit_workers.school_unit_worker_id,
                        school_unit_workers.school_unit_id,
                        workers.worker_id,
                        workers.registry_no,
                        workers.tax_number,
                        workers.firstname,
                        workers.lastname,
                        workers.fathername,
                        workers.sex,
                        worker_specializations.worker_specialization_id,
                        worker_specializations.name as worker_specialization,
                        worker_positions.worker_position_id,
                        worker_positions.name as worker_position
                     ";

        $sqlFrom   = "FROM school_unit_workers
                      LEFT JOIN worker_positions using (worker_position_id)
                      LEFT JOIN workers using (worker_id)
                      LEFT JOIN worker_specializations ON workers.worker_specialization_id = worker_specializations.worker_specialization_id
                      ";

        $sqlWhere = " WHERE school_unit_workers.school_unit_id in (".$school_unit_ids.")";
        $sqlWhereFilters = (count($filter_school_unit_workers) > 0 ? " AND " . implode(" AND ", $filter_school_unit_workers) : "" );
        $sqlOrder = " ORDER BY school_unit_workers.school_unit_id ASC";

        $sql = $sqlSelect . $sqlFrom . $sqlWhere . $sqlWhereFilters . $sqlOrder;
        //echo "<br><br>".$sql."<br><br>";

        $stmt = $db->query( $sql );
        $array_school_unit_workers= $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($array_school_unit_workers as $school_unit_worker)
        {
            $school_unit_workers[ $school_unit_worker["school_unit_id"] ][ $school_unit_worker["school_unit_worker_id"] ] = $school_unit_worker;
        }
        
//======================================================/**================================================================
//= $array_circuits
//======================================================================================================================

        $sqlSelect = "SELECT
                        circuits.circuit_id,
                        circuits.phone_number,
                        circuits.updated_date,
                        circuits.status,
                        circuits.school_unit_id,
                        circuit_types.circuit_type_id,
                        circuit_types.name as circuit_type
                     ";

        $sqlFrom   = "FROM circuits
                      LEFT JOIN circuit_types using (circuit_type_id)
                      ";

        $sqlWhere = " WHERE circuits.school_unit_id in (".$school_unit_ids.")";
        $sqlOrder = " ORDER BY circuits.school_unit_id ASC";

        $sql = $sqlSelect . $sqlFrom . $sqlWhere . $sqlOrder;
        //echo "<br><br>".$sql."<br><br>";

        $stmt = $db->query( $sql );
        $array_circuits = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($array_circuits as $circuit)
        {
            $circuits[ $circuit["school_unit_id"] ][ $circuit["circuit_id"] ] = $circuit;
        }
        
//======================================================================================================================
//= R E S U L T S
//======================================================================================================================
        
        foreach ($array_labs as $lab)
        {
            $data = array(
                "lab_id"                    => $lab["lab_id"] ? (int)$lab["lab_id"] : null,
                "lab_name"                  => $lab["lab_name"],
                "special_name"              => $lab["special_name"],
                "creation_date"             => $lab["creation_date"],
                "created_by"                => $lab["created_by"],
                "last_updated"              => $lab["last_updated"] ,
                "updated_by"                => $lab["updated_by"] ,
                "positioning"               => $lab["positioning"] ,
                "comments"                  => $lab["comments"] ,
                "operational_rating"        => $lab["operational_rating"],
                "technological_rating"      => $lab["technological_rating"],
                "lab_type_id"               => $lab["lab_type_id"],
                "lab_type"                  => $lab["lab_type"] ,
                "school_unit_id"            => $lab["school_unit_id"]? (int)$lab["school_unit_id"] : null,
                "school_unit_name"          => $lab["school_unit_name"] ,
                "lab_source_id"             => $lab["lab_source_id"]? (int)$lab["lab_source_id"] : null,
                "lab_source"                => $lab["lab_source"],
                "lab_state_id"              => $lab["lab_state_id"]? (int)$lab["lab_state_id"] : null,
                "lab_state"                 => $lab["lab_state"],
                "school_unit_state_id"      => $lab["school_unit_state_id"]? (int)$lab["school_unit_state_id"] : null,
                "school_unit_state"         => $lab["school_unit_state"],         
                "region_edu_admin_id"       => $lab["region_edu_admin_id"] ? (int)$lab["region_edu_admin_id"] : null,
                "region_edu_admin"          => $lab["region_edu_admin"],
                "edu_admin_id"              => $lab["edu_admin_id"] ? (int)$lab["edu_admin_id"] : null,
                "edu_admin"                 => $lab["edu_admin"],
                "transfer_area_id"          => $lab["transfer_area_id"] ? (int)$lab["transfer_area_id"] : null,
                "transfer_area"             => $lab["transfer_area"],
                "prefecture_id"             => $lab["prefecture_id"] ? (int)$lab["prefecture_id"] : null,
                "prefecture"                => $lab["prefecture"],
                "municipality_id"           => $lab["municipality_id"] ? (int)$lab["municipality_id"] : null,
                "municipality"              => $lab["municipality"],
                "education_level_id"        => $lab["education_level_id"] ? (int)$lab["education_level_id"] : null,
                "education_level"           => $lab["education_level"],
                "school_unit_type_id"       => $lab["school_unit_type_id"] ? (int)$lab["school_unit_type_id"] : null,
                "school_unit_type"          => $lab["school_unit_type"]

            );
                            
                //$array_lab_aquisition_sources
                $data["aquisition_sources"] = array();
                 foreach ($lab_aquisition_sources[ $lab["lab_id"] ] as $lab_aquisition_source)
                {
                    $data["aquisition_sources"][] = array(
                        "lab_aquisition_source_id"  => $lab_aquisition_source["lab_aquisition_source_id"] ? (int)$lab_aquisition_source["lab_aquisition_source_id"] : null,
                        "lab_id"                    => $lab_aquisition_source["lab_id"],
                        "aquisition_source_id"      => $lab_aquisition_source["aquisition_source_id"] ? (int)$lab_aquisition_source["aquisition_source_id"] : null,
                        "aquisition_year"           => $lab_aquisition_source["aquisition_year"] ,
                        "aquisition_comments"       => $lab_aquisition_source["aquisition_comments"] ,
                        "aquisition_source"         => $lab_aquisition_source["aquisition_source"]
                    );
                }

                //$array_lab_equipment_types
                $data["equipment_types"] = array();
                 foreach ($lab_equipment_types[ $lab["lab_id"] ] as $lab_equipment_type)
                {
                    $data["equipment_types"][] = array(
                        "lab_id"                    => $lab_equipment_type["lab_id"],
                        "equipment_type_id"         => $lab_equipment_type["equipment_type_id"],
                        "items"                     => $lab_equipment_type["items"] ,
                        "equipment_type"            => $lab_equipment_type["equipment_type"],
                        "equipment_category_id"     => $lab_equipment_type["equipment_category_id"] ? (int)$lab_equipment_type["equipment_category_id"] : null,
                        "equipment_category"        => $lab_equipment_type["equipment_category"]
                    );
                }

                // $array_lab_workers
                $data["lab_workers"] = array();
                 foreach ($lab_workers[ $lab["lab_id"] ] as $lab_worker)
                {
                    $data["lab_workers"][] = array(
                        "lab_worker_id"             => $lab_worker["lab_worker_id"] ? (int)$lab_worker["lab_worker_id"] : null,
                        "lab_id"                    => $lab_worker["lab_id"],
                        "email"                     => $lab_worker["worker_email"] ,
                        "worker_status"             => $lab_worker["worker_status"] ? (int)$lab_worker["worker_status"] : null,
                        "worker_start_service"      => $lab_worker["worker_start_service"],
                        "worker_id"                 => $lab_worker["worker_id"] ? (int)$lab_worker["worker_id"] : null,
                        "registry_no"               => $lab_worker["registry_no"],
                        "tax_number"                => $lab_worker["tax_number"],
                        "firstname"                 => $lab_worker["firstname"] ,
                        "lastname"                  => $lab_worker["lastname"] ,
                        "fathername"                => $lab_worker["fathername"] ,
                        "sex"                       => $lab_worker["sex"],
                        "worker_specialization_id"  => $lab_worker["worker_specialization_id"],
                        "worker_specialization"     => $lab_worker["worker_specialization"] ,
                        "worker_position_id"        => $lab_worker["worker_position_id"] ,
                        "worker_position"           => $lab_worker["worker_position"]
                    );
                }
            
                //$array_lab_relations
                $data["lab_relations"] = array();
                 foreach ($lab_relations[ $lab["lab_id"] ] as $lab_relation)
                {
                    $data["lab_relations"][] = array(
                        "lab_relation_id"     => $lab_relation["lab_relation_id"] ? (int)$lab_relation["lab_relation_id"] : null,
                        "lab_id"              => $lab_relation["lab_id"] ? (int)$lab_relation["lab_id"] : null,
                        "school_unit_id"      => $lab_relation["school_unit_id"] ? (int)$lab_relation["school_unit_id"] : null,
                        "relation_type_id"    => $lab_relation["relation_type_id"] ? (int)$lab_relation["relation_type_id"] : null,
                        "relation_type"       => $lab_relation["relation_type_name"],
                        "circuit_id"          => $lab_relation["circuit_id"] ? (int)$lab_relation["circuit_id"] : null,
                        "phone_number"        => $lab_relation["phone_number"]
                    );
                }
                
                //$array_lab_transitions
                $data["lab_transitions"] = array();
                 foreach ($lab_transitions[ $lab["lab_id"] ] as $lab_transition)
                {
                    $data["lab_transitions"][] = array(
                        "lab_transition_id"         => $lab_transition["lab_transition_id"] ? (int)$lab_transition["lab_transition_id"] : null,
                        "lab_id"                    => $lab_transition["lab_id"] ? (int)$lab_transition["lab_id"] : null,
                        "from_state"                => $lab_transition["from_state"] ? (int)$lab_transition["from_state"] : null,
                        "to_state"                  => $lab_transition["to_state"] ? (int)$lab_transition["to_state"] : null,
                        "transition_date"           => $lab_transition["transition_date"] ,
                        "transition_justification"  => $lab_transition["transition_justification"] ,
                        "transition_source"         => $lab_transition["transition_source"],
                        "from_state_id"             => $lab_transition["from_state_id"] ? (int)$lab_transition["from_state_id"] : null,
                        "from_state_name"           => $lab_transition["from_state_name"],
                        "to_state_id"               => $lab_transition["to_state_id"] ? (int)$lab_transition["to_state_id"] : null,
                        "to_state_name"             => $lab_transition["to_state_name"]
                    );
                }            
            
            //$array_school_unit_workers
            $data["school_unit_worker"] = array();
            foreach ($school_unit_workers[ $lab["school_unit_id"] ] as $school_unit_worker)
            {
                $data["school_unit_worker"][] = array(
                    "school_unit_worker_id"     => $school_unit_worker["school_unit_worker_id"] ? (int)$school_unit_worker["school_unit_worker_id"] : null,
                    "school_unit_id"            => $school_unit_worker["school_unit_id"] ? (int)$school_unit_worker["school_unit_id"] : null,
                    "worker_id"                 => $school_unit_worker["worker_id"] ? (int)$school_unit_worker["worker_id"] : null,
                    "registry_no"               => $school_unit_worker["registry_no"],
                    "tax_number"                => $school_unit_worker["tax_number"],
                    "firstname"                 => $school_unit_worker["firstname"] ,
                    "lastname"                  => $school_unit_worker["lastname"] ,
                    "fathername"                => $school_unit_worker["fathername"] ,
                    "sex"                       => $school_unit_worker["sex"],
                    "worker_specialization_id"  => $school_unit_worker["worker_specialization_id"],
                    "worker_specialization"     => $school_unit_worker["worker_specialization"] ,
                    "worker_position_id"        => $school_unit_worker["worker_position_id"] ,
                    "worker_position"           => $school_unit_worker["worker_position"]
                );
            } 
                
            $data["school_circuits"] = array();
            foreach ($circuits[ $lab["school_unit_id"] ] as $circuit)
            {
                $data["school_circuits"][] = array(
                    "circuit_id"       => $circuit["circuit_id"] ? (int)$circuit["circuit_id"] : null,
                    "phone_number"     => $circuit["phone_number"],
                    "updated_date"     => $circuit["updated_date"],
                    "status"           => $circuit["status"] ? (bool)$circuit["status"] : null,
                    "school_unit_id"   => $circuit["school_unit_id"] ? (int)$circuit["school_unit_id"] : null,
                    "circuit_type_id"  => $circuit["circuit_type_id"] ? (int)$circuit["circuit_type_id"] : null,
                    "circuit_type"     => $circuit["circuit_type"]
                );
            }
  
                
                $result["data"][] = $data;
        }  
        
        //return pagination values 
        $pagination = array(
            "page" => (int)$page,
            "maxPage" => (int)$maxPage,
            "pagesize" => (int)$pagesize
        ); 
        
        $result["pagination"]=$pagination;     
        $result["status"] = ExceptionCodes::NoErrors;;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".ExceptionMessages::NoErrors;

    } 
    catch (Exception $e) 
    {
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();

    }

   if ( Validator::IsExists('debug') )
   {
        $result["sql"] =  trim(preg_replace('/\s\s+/', ' ', $sql));
    }
    
    if ($export == 'JSON'){
        return $result;
    } else if ($export == 'XLSX') {
        SearchSchoolUnitsExt::ExcelCreate($result);
        exit;
    } else if ($export == 'PDF'){
       return $result;
    } else {     
       return $result;
    }
    
}

?>