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

function StatisticSchoolUnits ( $school_unit_id, $school_unit_name, $school_unit_special_name, 
                                $region_edu_admin, $edu_admin, $transfer_area, $municipality, $prefecture,
                                $education_level, $school_unit_type, $school_unit_state, 
                                $lab_id, $lab_name, $lab_special_name, $creation_date, $operational_rating, $technological_rating, $lab_type, $lab_state, $lab_source, 
                                $aquisition_source, $equipment_type, $lab_worker, 
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
//= $school_unit_special_name
//======================================================================================================================

        if ( Validator::isExists('school_unit_special_name') )
        {
            $table_name = "school_units";
            $table_column_name = "special_name";

            $filter[] =  Filters::ExtBasicFilter($school_unit_special_name, $table_name, $table_column_name, $searchtype, 
                                                 ExceptionMessages::InvalidSchoolUnitSpecialNameType, ExceptionCodes::InvalidSchoolUnitSpecialNameType ); 
            
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
//= $lab_id
//======================================================================================================================

        if ( Validator::isExists('lab_id') )
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

        if ( Validator::isExists('lab_name') )
        {
            $table_name = "labs";
            $table_column_name = "name";

            $filter[] = $filter_labs[] = Filters::ExtBasicFilter($lab_name, $table_name, $table_column_name, $searchtype, 
                                                 ExceptionMessages::InvalidLabNameType, ExceptionCodes::InvalidLabNameType ); 
            
        }
        
 //======================================================================================================================
//= $lab_special_name
//======================================================================================================================

        if ( Validator::isExists('lab_special_name') )
        {
            $table_name = "labs";
            $table_column_name = "special_name";

            $filter[] = $filter_labs[] = Filters::ExtBasicFilter($lab_special_name, $table_name, $table_column_name, $searchtype, 
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

            $filter[] = $filter_labs[] = Filters::DateBasicFilter($creation_date, $table_name, $table_column_name, $filter_validators, 
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
            
            $filter[] = $filter_labs[] = Filters::BasicFilter( $operational_rating, $table_name, $table_column_id, $table_column_name, $filter_validators, 
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

            $filter[] = $filter_labs[] = Filters::BasicFilter( $technological_rating, $table_name, $table_column_id, $table_column_name, $filter_validators, 
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

            $filter[] = $filter_labs[] = Filters::BasicFilter( $lab_type, $table_name, $table_column_id, $table_column_name, $filter_validators, 
                                                               ExceptionMessages::InvalidLabTypeType, ExceptionCodes::InvalidLabTypeType);

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

            $filter[] = $filter_labs[] = Filters::BasicFilter( $lab_state, $table_name, $table_column_id, $table_column_name, $filter_validators, 
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
            
            $filter[] = $filter_labs[] = Filters::BasicFilter( $lab_source, $table_name, $table_column_id, $table_column_name, $filter_validators,  
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
//= E X E C U T E
//======================================================================================================================


        $sqlSelect = "SELECT count(DISTINCT school_units.school_unit_id) as total_school_units, count(DISTINCT labs.lab_id) as all_labs ";

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
                                LEFT JOIN lab_aquisition_sources ON labs.lab_id=lab_aquisition_sources.lab_id
                                LEFT JOIN aquisition_sources ON lab_aquisition_sources.aquisition_source_id=aquisition_sources.aquisition_source_id
                                LEFT JOIN lab_equipment_types ON labs.lab_id=lab_equipment_types.lab_id
                                LEFT JOIN equipment_types ON lab_equipment_types.equipment_type_id=equipment_types.equipment_type_id
                                LEFT JOIN lab_workers ON labs.lab_id=lab_workers.lab_id
                                LEFT JOIN workers ON lab_workers.worker_id=workers.worker_id
                                ";

        $sqlWhere = (count($filter) > 0 ? " WHERE " . implode(" AND ", $filter) : "" );
        
        $result["filters"] = $filter ? $filter : null;
        //#############find total school_units and total labs without filter of limits(page and pagesize)
        $sql =  $sqlSelect . $sqlFrom . $sqlWhere;
        //echo "<br><br>".$sql."<br><br>";

        $stmt = $db->query( $sql );
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        $result["total"] = $rows["total_school_units"];
        $result["all_labs"] = $rows["all_labs"];
                
        //find lab types per school unit       
        $result["all_labs_by_type"] = Filters::AllLabsCounter($sqlFrom,$sqlWhere);
   
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