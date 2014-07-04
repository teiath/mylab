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

function StatisticLabWorkers (  $lab_worker_id, $worker_status, $worker_start_service,
                                $lab_id, $lab_name, $worker_position, $worker, $worker_registry_no,
                                $lab_type, $school_unit_id, $school_unit_name, $lab_state,                      
                                $region_edu_admin, $edu_admin, $transfer_area, $municipality, $prefecture,
                                $education_level, $school_unit_type, $school_unit_state, 
                                $searchtype) {

    global $db;
    global $app;
    
    $filter = array();       
    $result = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
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
    
//======================================================================================================================
//= $lab_worker_id
//======================================================================================================================

        if ( Validator::isExists('lab_worker_id') )
        {
            $table_name = "lab_workers";
            $table_column_id = "lab_worker_id";
            $table_column_name = "lab_worker_id";
            $filter_validators = 'null,id';

            $filter[] = Filters::BasicFilter( $lab_worker_id, $table_name, $table_column_id, $table_column_name, $filter_validators,
                                               ExceptionMessages::InvalidLabWorkerIDType, ExceptionCodes::InvalidLabWorkerIDType);

        }
        
//======================================================================================================================
//= $worker_status
//======================================================================================================================

        if ( Validator::isExists('worker_status') )
        {
            $table_name = "lab_workers";
            $table_column_id = "worker_status";
            $table_column_name = "worker_status";
            $filter_validators = 'null,numeric';

            $filter[] = Filters::BasicFilter( $worker_status, $table_name, $table_column_id, $table_column_name, $filter_validators,
                                               ExceptionMessages::InvalidLabWorkerStatusType, ExceptionCodes::InvalidLabWorkerStatusType);

        }
        
//======================================================================================================================
//= $worker_start_service
//======================================================================================================================

        if ( Validator::isExists('worker_start_service') )
        {
            $table_name = "lab_workers";
            $table_column_name = "worker_start_service";
            $filter_validators = 'null,date';

            $filter[] = Filters::DateBasicFilter( $worker_start_service, $table_name, $table_column_name, $filter_validators,
                                                  ExceptionMessages::InvalidLabWorkerStartServiceType, ExceptionCodes::InvalidLabWorkerStartServiceType);

        }
        
//======================================================================================================================
//= $worker
//======================================================================================================================

        if ( Validator::isExists('worker') )
        {

            $table_name = "workers";
            $table_column_id = "worker_id";
            $table_column_name = "lastname";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $worker, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidWorkerType, ExceptionCodes::InvalidWorkerType);
            
    }  
 
//======================================================================================================================
//= $worker_registry_no
//======================================================================================================================

        if ( Validator::isExists('registry_no') )
        {

            $table_name = "workers";
            $table_column_id = "registry_no";
            $table_column_name = "registry_no";
            $filter_validators = 'null,value';
            
            $filter[] = Filters::BasicFilter( $worker_registry_no, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidWorkerRegistryNoType, ExceptionCodes::InvalidWorkerRegistryNoType);
            
    } 
    
 //======================================================================================================================
//= $worker_position
//======================================================================================================================

        if ( Validator::isExists('worker_position') )
        {

            $table_name = "worker_positions";
            $table_column_id = "worker_position_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $worker_position, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidWorkerPositionType, ExceptionCodes::InvalidWorkerPositionType);
            
    }   
//======================================================================================================================
//= $lab
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
            $table_column_name = "school_unit_id";
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
            $table_column_name = "name";

            $filter[] =  Filters::ExtBasicFilter($school_unit_name, $table_name, $table_column_name, $searchtype, 
                                                 ExceptionMessages::InvalidSchoolUnitNameType, ExceptionCodes::InvalidSchoolUnitNameType ); 
            
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
//= E X E C U T E
//======================================================================================================================

            //set user permissions
           $permissions = UserRoles::getUserPermissions($app->request->user, true);

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
        
        $sqlSelect = "SELECT count(lab_workers.lab_worker_id) as total_lab_workers ";

        $sqlFrom = "FROM lab_workers
                                LEFT JOIN labs using (lab_id)
                                LEFT JOIN workers using (worker_id)
                                LEFT JOIN worker_positions using (worker_position_id)
                                LEFT JOIN worker_specializations ON workers.worker_specialization_id = worker_specializations.worker_specialization_id
                                LEFT JOIN lab_types ON labs.lab_type_id = lab_types.lab_type_id 
                                LEFT JOIN states lab_states ON labs.state_id = lab_states.state_id                               
                                LEFT JOIN school_units using (school_unit_id)
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

        $result["filters"] = $filter ? $filter : null;
        //#############find total total lab_workers without filter of limits(page and pagesize)
        $sql = $sqlSelect . $sqlFrom . $sqlWhere . $sqlPermissions;
        //echo "<br><br>".$sql."<br><br>";

        $stmt = $db->query( $sql );
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        $result["total"] = $rows["total_lab_workers"];
             
        //find lab types per school unit       
        $result["all_labs_by_type"] = Filters::AllLabsCounter($sqlFrom,$sqlWhere,$sqlPermissions);
           
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

    return $result;

}
?>