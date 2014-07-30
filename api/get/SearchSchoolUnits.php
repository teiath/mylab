<?php
/**
 *
 * @version 1.0.1
 * @author  ΤΕΙ Αθήνας
 * @package GET
 * 
 * 
 * This version not contain documentations 
 * 
 * 
 */
 
header("Content-Type: text/html; charset=utf-8");

function SearchSchoolUnits ($school_unit_id, $school_unit_name, $school_unit_special_name,
                            $region_edu_admin, $edu_admin, $transfer_area, $municipality, $prefecture,
                            $education_level, $school_unit_type, $school_unit_state, 
                            $lab_id, $lab_name, $lab_special_name, $creation_date, $operational_rating, $technological_rating, $lab_type, $lab_state, $lab_source, 
                            $aquisition_source, $equipment_type, $lab_worker, 
                            $pagesize, $page, $orderby, $ordertype, $searchtype , $export ) {

    global $db;
    global $app;
    
    $filter = array();
    $filter_labs = array();
    $filter_aquisition_sources = array();
    $filter_equipment_types = array();
    $filter_lab_workers = array();
    $result = array();
    
    $result["data"] = array();
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();

    try
    {
        
//$page - $pagesize - $searchtype - $ordertype =================================
       $page = Pagination::getPage($page, $params);
       $pagesize = Pagination::getPagesize($pagesize, $params);     
       $searchtype = Filters::getSearchType($searchtype, $params);
       $ordertype =  Filters::getOrderType($ordertype, $params);
                                        
//======================================================================================================================
//= $school_unit_id
//======================================================================================================================

        if ( Validator::Exists('school_unit_id', $params) )
        {
            $table_name = "school_units";
            $table_column_id = "school_unit_id";
            $table_column_name = "school_unit_id";
            $filter_validators = 'null,id';
            
            $filter[] = Filters::BasicFilter( $school_unit_id, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidSchoolUnitIDType, ExceptionCodes::InvalidSchoolUnitIDType);

        }
        
//======================================================================================================================
//= $school_unit_name
//======================================================================================================================

        if ( Validator::Exists('school_unit_name', $params) )
        {
            $table_name = "school_units";
            $table_column_name = "name";

            $filter[] =  Filters::ExtBasicFilter($school_unit_name, $table_name, $table_column_name, $searchtype, 
                                                 ExceptionMessages::InvalidSchoolUnitNameType, ExceptionCodes::InvalidSchoolUnitNameType ); 
            
        }

//======================================================================================================================
//= $school_unit_special_name
//======================================================================================================================

        if ( Validator::Exists('school_unit_special_name', $params) )
        {
            $table_name = "school_units";
            $table_column_name = "special_name";

            $filter[] =  Filters::ExtBasicFilter($school_unit_special_name, $table_name, $table_column_name, $searchtype, 
                                                 ExceptionMessages::InvalidSchoolUnitSpecialNameType, ExceptionCodes::InvalidSchoolUnitSpecialNameType ); 
            
        }
        
//======================================================================================================================
//= $region_edu_admin
//======================================================================================================================

        if ( Validator::Exists('region_edu_admin', $params) )
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

        if ( Validator::Exists('edu_admin', $params) )
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

        if ( Validator::Exists('transfer_area', $params) )
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

        if ( Validator::Exists('municipality', $params) )
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

        if ( Validator::Exists('prefecture', $params) )
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

        if ( Validator::Exists('education_level', $params) )
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

        if ( Validator::Exists('school_unit_type', $params) )
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

        if ( Validator::Exists('school_unit_state', $params) )
        {
            $table_name = "school_unit_states";
            $table_column_id = "state_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $school_unit_state, $table_name, $table_column_id, $table_column_name, $filter_validators, 
                                              ExceptionMessages::InvalidStateType, ExceptionCodes::InvalidStateType);

        }
        
//======================================================================================================================
//= $lab_id
//======================================================================================================================

        if ( Validator::Exists('lab_id', $params) )
        {
            $table_name = "labs";
            $table_column_id = "lab_id";
            $table_column_name = "lab_id";
            $filter_validators = 'null,id';

            $filter[] = $filter_labs[] = Filters::BasicFilter( $lab_id, $table_name, $table_column_id, $table_column_name, $filter_validators, 
                                                                ExceptionMessages::InvalidLabIDType, ExceptionCodes::InvalidLabIDType);

        }
        
//======================================================================================================================
//= $lab_name
//======================================================================================================================

        if ( Validator::Exists('lab_name', $params) )
        {
            $table_name = "labs";
            $table_column_name = "name";

            $filter[] = $filter_labs[] = Filters::ExtBasicFilter($lab_name, $table_name, $table_column_name, $searchtype, 
                                                 ExceptionMessages::InvalidLabNameType, ExceptionCodes::InvalidLabNameType ); 
            
        }
        
 //======================================================================================================================
//= $lab_special_name
//======================================================================================================================

        if ( Validator::Exists('lab_special_name', $params) )
        {
            $table_name = "labs";
            $table_column_name = "special_name";

            $filter[] = $filter_labs[] = Filters::ExtBasicFilter($lab_special_name, $table_name, $table_column_name, $searchtype, 
                                                 ExceptionMessages::InvalidLabSpecialNameType, ExceptionCodes::InvalidLabSpecialNameType ); 
            
        }   
 
//======================================================================================================================
//= $creation_date
//======================================================================================================================

        if ( Validator::Exists('creation_date', $params) )
        {
            $table_name = "labs";
            $table_column_name = "creation_date";
            $filter_validators = 'null,date';

            $filter[] = $filter_labs[] = Filters::DateBasicFilter($creation_date, $table_name, $table_column_name, $filter_validators, 
                                                 ExceptionMessages::InvalidLabCreationDateType, ExceptionCodes::InvalidLabCreationDateType ); 
            
        }
        
//======================================================================================================================
//= $operational_rating
//======================================================================================================================

        if ( Validator::Exists('operational_rating', $params) )
        {
            $table_name = "labs";
            $table_column_id = "operational_rating";
            $table_column_name = "operational_rating";
            $filter_validators = 'null,numeric';
            
            $filter[] = $filter_labs[] = Filters::BasicFilter( $operational_rating, $table_name, $table_column_id, $table_column_name, $filter_validators, 
                                                               ExceptionMessages::InvalidLabOperationalRatingType, ExceptionCodes::InvalidLabOperationalRatingType);

        }
//======================================================================================================================
//= $technological_rating
//======================================================================================================================

        if ( Validator::Exists('technological_rating', $params) )
        {
            $table_name = "labs";
            $table_column_id = "technological_rating";
            $table_column_name = "technological_rating";
            $filter_validators = 'null,numeric';

            $filter[] = $filter_labs[] = Filters::BasicFilter( $technological_rating, $table_name, $table_column_id, $table_column_name, $filter_validators, 
                                                               ExceptionMessages::InvalidLabTechnologicalRatingType, ExceptionCodes::InvalidLabTechnologicalRatingType);

        }
//======================================================================================================================
//= $lab_type
//======================================================================================================================

        if ( Validator::Exists('lab_type', $params) )
        {
            $table_name = "lab_types";
            $table_column_id = "lab_type_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';

            $filter[] = $filter_labs[] = Filters::BasicFilter( $lab_type, $table_name, $table_column_id, $table_column_name, $filter_validators, 
                                                               ExceptionMessages::InvalidLabTypeType, ExceptionCodes::InvalidLabTypeType);

        }
        
//======================================================================================================================
//= $lab_state
//======================================================================================================================

        if ( Validator::Exists('lab_state', $params) )
        {
            $table_name = "lab_states";
            $table_column_id = "state_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';

            $filter[] = $filter_labs[] = Filters::BasicFilter( $lab_state, $table_name, $table_column_id, $table_column_name, $filter_validators, 
                                                               ExceptionMessages::InvalidStateType, ExceptionCodes::InvalidStateType);

        }
        
//======================================================================================================================
//= $lab_source
//======================================================================================================================

        if ( Validator::Exists('lab_source', $params) )
        {

            $table_name = "lab_sources";
            $table_column_id = "lab_source_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = $filter_labs[] = Filters::BasicFilter( $lab_source, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidLabSourceType, ExceptionCodes::InvalidLabSourceType);
            
        }
//======================================================================================================================
//= $aquisition_source
//======================================================================================================================

        if ( Validator::Exists('aquisition_source', $params) )
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

        if ( Validator::Exists('equipment_type', $params) )
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

        if ( Validator::Exists('lab_worker', $params) )
        {
            $table_name = "workers";
            $table_column_id = "registry_no";
            $table_column_name = "lastname";
            $filter_validators = 'null,id,value';

            $filter[] = $filter_lab_workers[] = Filters::BasicFilter( $lab_worker, $table_name, $table_column_id, $table_column_name, $filter_validators, 
                                                                      ExceptionMessages::InvalidLabWorkerType, ExceptionCodes::InvalidLabWorkerType);           

        }    
               
//======================================================================================================================
//= $export
//======================================================================================================================
        
        if ( Validator::Missing('export', $params) )
            $export = ExportDataEnumTypes::JSON;
        else if ( ExportDataEnumTypes::isValidValue( $export ) || ExportDataEnumTypes::isValidName( $export ) ) {
            $export = ExportDataEnumTypes::getValue($export);
            //$pagesize = Parameters::AllPageSize;
        } else
            throw new Exception(ExceptionMessages::InvalidExport." : ".$export, ExceptionCodes::InvalidExport);
        
//======================================================================================================================
//= $orderby
//======================================================================================================================

        if ( Validator::Exists('orderby', $params) )
        {
            $columns = array(
                "school_unit_id",
                "school_unit_name","school_unit_special_name",
                "region_edu_admin_id", "region_edu_admin",
                "edu_admin_id", "edu_admin",
                "transfer_area_id", "transfer_area",
                "prefecture_id", "prefecture",
                "municipality_id", "municipality",
                "education_level_id", "education_level",
                "school_unit_type_id", "school_unit_type",
                "school_unit_state_id", "school_unit_state",
            );

            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        }
        else
            $orderby = "school_unit_id";

 
        
//======================================================================================================================
//= E X E C U T E
//======================================================================================================================

       //set user permissions
       $permissions = UserRoles::getUserPermissions($app->request->user, true, true);
       
       if (Validator::IsNull($permissions['permit_labs'])){
           $permit_labs = null;
       } else if ($permissions['permit_labs'] === 'ALLRESULTS') { 
           $permit_labs = null;
       } else {
           $permit_labs = " AND labs.lab_id IN (" . $permissions['permit_labs'] . ")";
       }
       
       if (Validator::IsNull($permissions['permit_school_units'])){
           throw new Exception(ExceptionMessages::NoPermissionsError, ExceptionCodes::NoPermissionsError); 
       } else if ($permissions['permit_school_units'] === 'ALLRESULTS') { 
           $permit_school_units = null;
           $sqlPermissions = null;
       } else {
           $permit_school_units = " school_units.school_unit_id IN (" . $permissions['permit_school_units'] . ")";
            $sqlPermissions = (count($filter) > 0 ? " AND " . $permit_school_units.$permit_labs : " WHERE " . $permit_school_units.$permit_labs ); 
       }

        $sqlSelect = "SELECT 
                      DISTINCT  school_units.school_unit_id,
                                school_units.name as school_unit_name,
                                school_units.special_name as school_unit_special_name,
                                school_units.last_update,
                                school_units.fax_number,
                                school_units.phone_number,
                                school_units.email,
                                school_units.street_address,
                                school_units.postal_code,
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
                                school_unit_types.name as school_unit_type,
                                school_unit_states.state_id as school_unit_state_id, 
                                school_unit_states.name as school_unit_state,
                                lab_states.state_id as lab_state_id, 
                                lab_states.name as lab_state
                       ";

        $sqlFrom = "FROM school_units
                                LEFT JOIN region_edu_admins using (region_edu_admin_id) 
                                LEFT JOIN edu_admins using (edu_admin_id) 
                                LEFT JOIN transfer_areas using (transfer_area_id)
                                LEFT JOIN prefectures using (prefecture_id)
                                LEFT JOIN municipalities using (municipality_id)
                                LEFT JOIN education_levels using (education_level_id)
                                LEFT JOIN school_unit_types using (school_unit_type_id)
                                LEFT JOIN states school_unit_states ON school_units.state_id = school_unit_states.state_id
                                LEFT JOIN labs using (school_unit_id)
                                LEFT JOIN lab_types ON labs.lab_type_id = lab_types.lab_type_id
                                LEFT JOIN states lab_states ON labs.state_id = lab_states.state_id
                                LEFT JOIN lab_sources ON labs.lab_source_id = lab_sources.lab_source_id
                                LEFT JOIN lab_aquisition_sources ON labs.lab_id=lab_aquisition_sources.lab_id
                                LEFT JOIN aquisition_sources ON lab_aquisition_sources.aquisition_source_id=aquisition_sources.aquisition_source_id
                                LEFT JOIN lab_equipment_types ON labs.lab_id=lab_equipment_types.lab_id
                                LEFT JOIN equipment_types ON lab_equipment_types.equipment_type_id=equipment_types.equipment_type_id
                                LEFT JOIN lab_workers ON labs.lab_id=lab_workers.lab_id
                                LEFT JOIN workers ON lab_workers.worker_id=workers.worker_id
                                ";

        $sqlWhere = (count($filter) > 0 ? " WHERE " . implode(" AND ", $filter) : "" );
        $sqlOrder = " ORDER BY ". $orderby ." ". $ordertype;
        $sqlLimit = ($page && $pagesize) ? " LIMIT ".(($page - 1) * $pagesize).", ".$pagesize : "";

        $result["filters"] = $filter ? $filter : null;
        
        //#############find total school_units and total labs without filter of limits(page and pagesize)
        $sql = "SELECT count(DISTINCT school_units.school_unit_id) as total_school_units, count(DISTINCT labs.lab_id) as all_labs " . $sqlFrom . $sqlWhere . $sqlPermissions ;
        //echo "<br><br>".$sql."<br><br>";

        $stmt = $db->query( $sql );
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        $result["total"] = $rows["total_school_units"];
        $result["all_labs"] = $rows["all_labs"];
        
        //check if $page input from user, is valid
        $maxPage = Pagination::getMaxPage($rows["total_school_units"], $page, $pagesize);
        
        //#############find count school_units with filter of limits(page and pagesize)
        $sql = $sqlSelect . $sqlFrom . $sqlWhere . $sqlPermissions . $sqlOrder . $sqlLimit ;
        //echo "<br><br>".$sql."<br><br>";

        $stmt = $db->query( $sql );
        $array_school_units = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result["count"] = $stmt->rowCount();
        
        //create array with school_unit ids
        if (count($array_school_units)>0){
            $prefix = '';
            $school_unit_ids ='';
            foreach ($array_school_units as $array_school_unit)
            {
                $school_unit_ids .= $prefix . '"' . $array_school_unit["school_unit_id"] . '"';
                $prefix = ', ';
            }                       
        } else {
            $school_unit_ids = "0";
        }
                
        //find lab types per school unit       
        $result["all_labs_by_type"] = Filters::AllLabsCounter($sqlFrom,$sqlWhere,$sqlPermissions);
    

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
//= $array_school_unit_workers
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
        $sqlOrder = " ORDER BY school_unit_workers.school_unit_id ASC";

        $sql = $sqlSelect . $sqlFrom . $sqlWhere . $sqlOrder;
        //echo "<br><br>".$sql."<br><br>";

        $stmt = $db->query( $sql );
        $array_school_unit_workers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($array_school_unit_workers as $school_unit_worker)
        {
            $school_unit_workers[ $school_unit_worker["school_unit_id"] ][ $school_unit_worker["school_unit_worker_id"] ] = $school_unit_worker;
        }

//======================================================================================================================
//= $array_labs
//======================================================================================================================

        $sqlSelect = "SELECT
                        labs.lab_id,
                        labs.name as lab_name,
                        labs.special_name as lab_special_name,
                        labs.creation_date,
                        labs.created_by,
                        labs.last_updated,
                        labs.updated_by,
                        labs.positioning,
                        labs.comments,
                        labs.operational_rating,
                        labs.technological_rating,
                        labs.school_unit_id,
                        lab_types.lab_type_id,
                        lab_types.name as lab_type,
                        lab_states.state_id as lab_state_id, 
                        lab_states.name as lab_state_name,
                        lab_sources.lab_source_id,
                        lab_sources.name as lab_source
                     ";

        $sqlFrom   = "FROM labs
                      LEFT JOIN lab_types using (lab_type_id)
                      LEFT JOIN states lab_states ON labs.state_id = lab_states.state_id
                      LEFT JOIN lab_sources using (lab_source_id)
                      LEFT JOIN lab_aquisition_sources using (lab_id)
                      LEFT JOIN lab_equipment_types using (lab_id)
                      LEFT JOIN lab_workers using (lab_id)
                      LEFT JOIN aquisition_sources ON lab_aquisition_sources.aquisition_source_id=aquisition_sources.aquisition_source_id
                      LEFT JOIN equipment_types ON lab_equipment_types.equipment_type_id=equipment_types.equipment_type_id
                      LEFT JOIN workers ON lab_workers.worker_id=workers.worker_id
                      ";

        $sqlWhere = " WHERE labs.school_unit_id in (".$school_unit_ids.")";
        
        $sqlWhereFilterLabs = (count($filter_labs) > 0 ? " AND " . implode(" AND ", $filter_labs) : "" );
        $sqlWhereFilterLabWorkers = (count($filter_lab_workers) > 0 ? " AND " . implode(" AND ", $filter_lab_workers) : "" );
        $sqlWhereFilterLabAquisitions = (count($filter_aquisition_sources) > 0 ? " AND " . implode(" AND ", $filter_aquisition_sources) : "" );
        $sqlWhereFilterLabEquipments = (count($filter_equipment_types) > 0 ? " AND " . implode(" AND ", $filter_equipment_types) : "" );
        
        $sqlOrder = " ORDER BY labs.school_unit_id ASC";

        $sql = $sqlSelect . $sqlFrom . $sqlWhere .$sqlWhereFilterLabs . $sqlWhereFilterLabWorkers . $sqlWhereFilterLabAquisitions . $sqlWhereFilterLabEquipments . $sqlOrder;
        //echo "<br><br>".$sql."<br><br>";

        $stmt = $db->query( $sql );
        $array_labs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $array_labs=  Validator::ToUniqueObject($array_labs);
                
        foreach ($array_labs as $lab)
        {
            $labs[ $lab["school_unit_id"] ][ $lab["lab_id"] ] = $lab;
        }

        //create array with lab ids
        if (count($array_labs)>0){
            $prefix = '';
            $lab_ids='';
            foreach ($array_labs as $array_lab)
            {
                $lab_ids .= $prefix . '"' . $array_lab["lab_id"] . '"';
                $prefix = ', ';
            }                       
        } else {
            $lab_ids = "0";
        }
            
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
//= R E S U L T S
//======================================================================================================================
//       $array_school_units=  Validator::ToUniqueObject($array_school_units);
        
        //find count of lab_types per school_units
        $sqlFromLabs = ' FROM `labs`';
        $sqlWhereLabs = ' WHERE labs.school_unit_id IN ('. $school_unit_ids .') ';
        $array_count_labs = Filters::LabsCounter($sqlFromLabs,$sqlWhereLabs);
        $sql_array = Filters::AllLabTypes();
        
        
        foreach ($array_school_units as $school_unit)
        {
            $data = array(
                "school_unit_id"           => $school_unit["school_unit_id"] ? (int)$school_unit["school_unit_id"] : null,
                "school_unit_name"         => $school_unit["school_unit_name"],
                "school_unit_special_name" => $school_unit["school_unit_special_name"],
                "last_update"              => $school_unit["last_update"],
                "fax_number"               => $school_unit["fax_number"] ? (int)$school_unit["fax_number"] : null,
                "phone_number"             => $school_unit["phone_number"] ? (int)$school_unit["phone_number"] : null,
                "email"                    => $school_unit["email"],
                "street_address"           => $school_unit["street_address"],
                "postal_code"              => $school_unit["postal_code"] ? (int)$school_unit["postal_code"] : null,
                "region_edu_admin_id"      => $school_unit["region_edu_admin_id"] ? (int)$school_unit["region_edu_admin_id"] : null,
                "region_edu_admin"         => $school_unit["region_edu_admin"],
                "edu_admin_id"             => $school_unit["edu_admin_id"] ? (int)$school_unit["edu_admin_id"] : null,
                "edu_admin"                => $school_unit["edu_admin"],
                "transfer_area_id"         => $school_unit["transfer_area_id"] ? (int)$school_unit["transfer_area_id"] : null,
                "transfer_area"            => $school_unit["transfer_area"],
                "prefecture_id"            => $school_unit["prefecture_id"] ? (int)$school_unit["prefecture_id"] : null,
                "prefecture"               => $school_unit["prefecture"],
                "municipality_id"          => $school_unit["municipality_id"] ? (int)$school_unit["municipality_id"] : null,
                "municipality"             => $school_unit["municipality"],
                "education_level_id"       => $school_unit["education_level_id"] ? (int)$school_unit["education_level_id"] : null,
                "education_level"          => $school_unit["education_level"],
                "school_unit_type_id"      => $school_unit["school_unit_type_id"] ? (int)$school_unit["school_unit_type_id"] : null,
                "school_unit_type"         => $school_unit["school_unit_type"],
                "school_unit_state_id"     => $school_unit["school_unit_state_id"]? (int)$school_unit["school_unit_state_id"] : null,
                "school_unit_state"        => $school_unit["school_unit_state"]

            );
            
            //find lab types per school unit without filters       
               
                $all_labs_counts=array();                           
                $i=1;
                
//                    $array_count_labs                
//                    "count_lab_type_1": "1",
//                    "count_lab_type_2": "0",
//                    "count_lab_type_3": "57",
//                    "count_lab_type_4": "0",
//                    "count_lab_type_5": "1",
//                    "school_unit_id": "1000019"
                if (!Validator::IsNull($array_count_labs[$school_unit["school_unit_id"]])){
                    
                    array_pop($array_count_labs[$school_unit["school_unit_id"]]);   
                    foreach ($array_count_labs[$school_unit["school_unit_id"]] as $lab_type_count) {
                        $all_labs_counts[$sql_array[$i]] = $lab_type_count;
                        $i++;     
                    }
                    $data["total_labs_by_type"] = $all_labs_counts;
                } else {
                    $data["total_labs_by_type"] = Filters::LabsCounterNull();
                }   
                           
            //$array_circuits
            $data["school_circuits"] = null;
            foreach ($circuits[ $school_unit["school_unit_id"] ] as $circuit)
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

            //$array_school_unit_workers
            $data["school_unit_worker"] = null;
            foreach ($school_unit_workers[ $school_unit["school_unit_id"] ] as $school_unit_worker)
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

            //$array_labs
            $data["labs"] = null;
            foreach ($labs[ $school_unit["school_unit_id"] ] as $lab)
            {
                                
                $summary_labs = array(
                                "lab_id"                    => $lab["lab_id"] ? (int)$lab["lab_id"] : null,
                                "lab_name"                  => $lab["lab_name"],
                                "lab_special_name"          => $lab["lab_special_name"],
                                "creation_date"             => $lab["creation_date"],
                                "created_by"                => $lab["created_by"],
                                "last_updated"              => $lab["last_updated"] ,
                                "updated_by"                => $lab["updated_by"] ,
                                "positioning"               => $lab["positioning"] ,
                                "comments"                  => $lab["comments"] ,
                                "operational_rating"        => $lab["operational_rating"],
                                "technological_rating"      => $lab["technological_rating"],
                                "school_unit_id"            => $lab["school_unit_id"] ,
                                "lab_type_id"               => $lab["lab_type_id"],
                                "lab_type"                  => $lab["lab_type"] ,
                                "lab_state_id"              => $lab["lab_state_id"]? (int)$lab["lab_state_id"] : null,
                                "lab_state"                 => $lab["lab_state"],
                                "lab_source_id"             => $lab["lab_source_id"] ,
                                "lab_source"                => $lab["lab_source"] 
                            );
                             
                //$array_lab_workers
                    $summary_labs["lab_workers"] = null;
                     foreach ($lab_workers[ $lab["lab_id"] ] as $lab_worker)
                    {
                        $summary_labs["lab_workers"][] = array(
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
                     
                    //$array_lab_aquisition_sources
                    $summary_labs["aquisition_sources"] = null;
                     foreach ($lab_aquisition_sources[ $lab["lab_id"] ] as $lab_aquisition_source)
                    {
                        $summary_labs["aquisition_sources"][] = array(
                            "lab_aquisition_source_id"  => $lab_aquisition_source["lab_aquisition_source_id"] ? (int)$lab_aquisition_source["lab_aquisition_source_id"] : null,
                            "lab_id"                    => $lab_aquisition_source["lab_id"],
                            "aquisition_source_id"      => $lab_aquisition_source["aquisition_source_id"] ? (int)$lab_aquisition_source["aquisition_source_id"] : null,
                            "aquisition_year"           => $lab_aquisition_source["aquisition_year"] ,
                            "aquisition_comments"       => $lab_aquisition_source["aquisition_comments"] ,
                            "aquisition_source"         => $lab_aquisition_source["aquisition_source"]
                        );
                    }
                    
                    //$array_lab_equipment_types
                    $summary_labs["equipment_types"] = null;
                     foreach ($lab_equipment_types[ $lab["lab_id"] ] as $lab_equipment_type)
                    {
                        $summary_labs["equipment_types"][] = array(
                            "lab_id"                    => $lab_equipment_type["lab_id"],
                            "equipment_type_id"         => $lab_equipment_type["equipment_type_id"],
                            "items"                     => $lab_equipment_type["items"] ,
                            "equipment_type"            => $lab_equipment_type["equipment_type"],
                            "equipment_category_id"     => $lab_equipment_type["equipment_category_id"] ? (int)$lab_equipment_type["equipment_category_id"] : null,
                            "equipment_category"        => $lab_equipment_type["equipment_category"]
                        );
                    }
                                   
                $data["labs"][] = $summary_labs;
        
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

   if ( Validator::IsTrue( $params["debug"]  ) )
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