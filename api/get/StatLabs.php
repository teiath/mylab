<?php
/**
 *
 * @version 2.0
 * @author  ΤΕΙ Αθήνας
 * @package GET
 */
 
header("Content-Type: text/html; charset=utf-8");

function StatLabs(
    $x_axis, $y_axis, $operational_rating, $technological_rating, 
    $lab_type, $lab_state, $has_lab_worker,
    $region_edu_admin, $edu_admin, $transfer_area, $municipality, $prefecture, $education_level, $school_unit_type, $school_unit_state
    )
{
    global $db,$app;
    
    $filter = array();
    $result = array();
    $join_filter = array();

    $result["method"] = __FUNCTION__;

    $params = loadParameters();
    
    $lab_axis = array ( "lab_type" => "lab_types",
                        "lab_state" => "lab_states"
                    );
    
    $school_unit_axis = array(  "region_edu_admin"  => "region_edu_admins",
                                "edu_admin"         => "edu_admins",
                                "transfer_area"     => "transfer_areas",
                                "prefecture"        => "prefectures",
                                "municipality"      => "municipalities",
                                "education_level"   => "education_levels",      
                                "school_unit_type"  => "school_unit_types",           
                                "school_unit_state" => "school_unit_states"
                            );
        
    try
    {

//statLabs function must used only for submitted labs 
       $filter[] = 'labs.submitted=1';
        
//default_joins=================================================================
       $join_filter[] = ' JOIN school_units ON school_units.school_unit_id = labs.school_unit_id ';

       
//= check if user set same x,y axes=============================================    
        if (Validator::ToValue($x_axis) == Validator::ToValue($y_axis)) {
             throw new Exception(ExceptionMessages::DuplicateXYAxisParam, ExceptionCodes::DuplicateXYAxisParam);
        }
        
//==============================================================================
//= $x_axis
//==============================================================================
  
        if ( !Validator::Missing('x_axis', $params) ) {
                
            if (Validator::isArray($x_axis))
                throw new Exception(ExceptionMessages::InvalidXAxisArray." : ".$x_axis, ExceptionCodes::InvalidXAxisArray);
            else if (Validator::isNull($x_axis))
                throw new Exception(ExceptionMessages::MissingXAxisValue." : ".$x_axis, ExceptionCodes::MissingYAxisValue);
            else if (Validator::isValue($x_axis)){ 
                if (array_key_exists(Validator::toValue($x_axis), $lab_axis)) {
                    $name_x_axis = $x_axis.'_name';
                    $field_x_axis = $lab_axis[Validator::toValue($x_axis)].'.name';
                    
                        if ($x_axis != 'lab_state'){
                            $join_filter[] = ' JOIN '. $lab_axis[Validator::toValue($x_axis)] . ' ON labs.' . $x_axis . '_id = ' . $lab_axis[Validator::toValue($x_axis)] . '.' . $x_axis .'_id';                     
                        }else{
                            $join_filter[] = ' JOIN states '. $lab_axis[Validator::toValue($x_axis)] . ' ON labs.state_id = ' . $lab_axis[Validator::toValue($x_axis)] . '.state_id';
                        }
                    
                } else if (array_key_exists(Validator::toValue($x_axis), $school_unit_axis)) {
                    $name_x_axis = $x_axis.'_name';
                    $field_x_axis = $school_unit_axis[Validator::toValue($x_axis)].'.name';
                      
                        if ($x_axis != 'school_unit_state'){
                            $join_filter[] = ' JOIN '. $school_unit_axis[Validator::toValue($x_axis)] . ' ON school_units.' . $x_axis . '_id = ' . $school_unit_axis[Validator::toValue($x_axis)] . '.' . $x_axis .'_id';                     
                        }else{
                            $join_filter[] = ' JOIN states '. $school_unit_axis[Validator::toValue($x_axis)] . ' ON school_units.state_id = ' . $school_unit_axis[Validator::toValue($x_axis)] . '.state_id';
                        }                  
                    
                } else {
                     throw new Exception(ExceptionMessages::InvalidXAxis." : ".$x_axis, ExceptionCodes::InvalidXAxis);                   
                }

            } else 
                throw new Exception(ExceptionMessages::InvalidXAxisType." : ".$x_axis, ExceptionCodes::InvalidXAxisType); 
            
        } else { 
           throw new Exception(ExceptionMessages::MissingXAxisParam." : ".$x_axis, ExceptionCodes::MissingXAxisParam);  
        }

//==============================================================================
//= $y_axis
//==============================================================================
 
        if ( !Validator::Missing('y_axis', $params) ) {
                
            if (Validator::isArray($y_axis))
                throw new Exception(ExceptionMessages::InvalidYAxisArray." : ".$y_axis, ExceptionCodes::InvalidYAxisArray);
            else if (Validator::isNull($y_axis))
                throw new Exception(ExceptionMessages::MissingYAxisValue." : ".$y_axis, ExceptionCodes::MissingYAxisValue);
            else if (Validator::isValue($y_axis)){              
                if (array_key_exists(Validator::toValue($y_axis), $lab_axis)) {
                    $name_y_axis = $y_axis.'_name';
                    $field_y_axis = $lab_axis[Validator::toValue($y_axis)].'.name';
                    
                    if ($y_axis != 'lab_state'){
                        $join_filter[] = ' JOIN '. $lab_axis[Validator::toValue($y_axis)] . ' ON labs.' . $y_axis .'_id = ' . $lab_axis[Validator::toValue($y_axis)] . '.' . $y_axis .'_id';                 
                    }else{
                        $join_filter[] = ' JOIN states '. $lab_axis[Validator::toValue($y_axis)] . ' ON labs.state_id = ' . $lab_axis[Validator::toValue($y_axis)] . '.state_id';
                    }
                                     
                } else if (array_key_exists(Validator::toValue($y_axis), $school_unit_axis)) {
                    $name_y_axis = $y_axis.'_name';
                    $field_y_axis = $school_unit_axis[Validator::toValue($y_axis)].'.name';
     
                    if ($y_axis != 'school_unit_state'){
                        $join_filter[] = ' JOIN '. $school_unit_axis[Validator::toValue($y_axis)] . ' ON school_units.' . $y_axis .'_id = ' . $school_unit_axis[Validator::toValue($y_axis)] . '.' . $y_axis .'_id';                   
                    } else {
                        $join_filter[] = ' JOIN states ' . $school_unit_axis[Validator::toValue($y_axis)] . ' ON school_units.state_id = ' . $school_unit_axis[Validator::toValue($y_axis)] . '.state_id';                 
                    }
                    
                } else {
                     throw new Exception(ExceptionMessages::InvalidYAxis." : ".$y_axis, ExceptionCodes::InvalidYAxis);                   
                }
 
            } else 
                throw new Exception(ExceptionMessages::InvalidYAxisType." : ".$y_axis, ExceptionCodes::InvalidYAxisType); 
            
        } else { 
           throw new Exception(ExceptionMessages::MissingYAxisParam." : ".$y_axis, ExceptionCodes::MissingYAxisParam);  
        }
          
//======================================================================================================================
//= $operational_rating
//======================================================================================================================

        if ( Validator::Exists('operational_rating', $params) )
        {
            $table_name = "labs";
            $table_column_id = "operational_rating";
            $table_column_name = "operational_rating";

            $param = Validator::toArray($operational_rating);

            $paramFilters = array();

            foreach ($param as $values)
            {
                if ( Validator::isNull($values) )
                    $paramFilters[] = "$table_name.$table_column_name is null";
                else if ( Validator::isNumeric($values) )
                    $paramFilters[] = "$table_name.$table_column_id = ". $db->quote( Validator::ToNumeric($values) );
                else
                    throw new Exception(ExceptionMessages::InvalidLabOperationalRatingType." : ".$values, ExceptionCodes::InvalidLabOperationalRatingType);
            }

            $filter[] = "(" . implode(" OR ", $paramFilters) . ")";

        }
//======================================================================================================================
//= $technological_rating
//======================================================================================================================

        if ( Validator::Exists('technological_rating', $params) )
        {
            $table_name = "labs";
            $table_column_id = "technological_rating";
            $table_column_name = "technological_rating";
            
            $param = Validator::toArray($technological_rating);

            $paramFilters = array();

            foreach ($param as $values)
            {
                if ( Validator::isNull($values) )
                    $paramFilters[] = "$table_name.$table_column_name is null";
                else if ( Validator::isNumeric($values) )
                    $paramFilters[] = "$table_name.$table_column_id = ". $db->quote( Validator::ToNumeric($values) );
                else
                    throw new Exception(ExceptionMessages::InvalidLabTechnologicalRatingType." : ".$values, ExceptionCodes::InvalidLabTechnologicalRatingType);
            }

            $filter[] = "(" . implode(" OR ", $paramFilters) . ")";

        }
        
        
//======================================================================================================================
//= $lab_type
//======================================================================================================================

        if ( Validator::Exists('lab_type', $params) )
        {

            $table_name = "lab_types";
            $table_column_id = "lab_type_id";
            $table_column_name = "name";

            $param = Validator::toArray($lab_type);

            $paramFilters = array();

            foreach ($param as $values)
            {
                if ( Validator::isNull($values) )
                    $paramFilters[] = "$table_name.$table_column_name is null";
                else if ( Validator::isID($values) )
                    $paramFilters[] = "$table_name.$table_column_id = ". $db->quote( Validator::toID($values) );
                else if ( Validator::isValue($values) )
                    $paramFilters[] = "$table_name.$table_column_name = ". $db->quote( Validator::toValue($values) );
                else
                    throw new Exception(ExceptionMessages::InvalidLabTypeType." : ".$values, ExceptionCodes::InvalidLabTypeType);
            }

            $filter[] = "(" . implode(" OR ", $paramFilters) . ")";
            $join_filter[]  = " JOIN $table_name ON labs.$table_column_id = $table_name.$table_column_id";

        }

//======================================================================================================================
//= $lab_state
//======================================================================================================================

        if ( Validator::Exists('lab_state', $params) )
        {
            $table_name = "lab_states";
            $table_column_id = "state_id";
            $table_column_name = "name";

            $param = Validator::toArray($lab_state);

            $paramFilters = array();

            foreach ($param as $values)
            {
                if ( Validator::isNull($values) )
                    $paramFilters[] = "$table_name.$table_column_name is null";
                else if ( Validator::isID($values) )
                    $paramFilters[] = "$table_name.$table_column_id = ". $db->quote( Validator::toID($values) );
                else if ( Validator::isValue($values) )
                    $paramFilters[] = "$table_name.$table_column_name = ". $db->quote( Validator::toValue($values) );
                else
                    throw new Exception(ExceptionMessages::InvalidStateType." : ".$values, ExceptionCodes::InvalidStateType);
            }

            $filter[] = "(" . implode(" OR ", $paramFilters) . ")";
            $join_filter[]  = " JOIN states $table_name ON labs.$table_column_id = $table_name.$table_column_id";
            
        }
//======================================================================================================================
//= $has_lab_worker
//======================================================================================================================
        if ( Validator::Exists('has_lab_worker', $params) )
        {
            $table_name = "lab_workers";
            $table_column_id = "lab_id";
            $table_column_name = "worker_status";
            
            $param = Validator::toArray($has_lab_worker);

            $paramFilters = array();

            foreach ($param as $values)
            {
                if ( Validator::isNull($values) )
                    $paramFilters[] = "$table_name.$table_column_name is null";
                else if ( $values==1 )
                    $paramFilters[] = "$table_name.$table_column_name like '". $db->quote( Validator::toValue($values) )."'";
                else if ($values==3 )
                    $paramFilters[] = "$table_name.$table_column_name like '". $db->quote( Validator::toValue($values) )."'";
                else
                    throw new Exception(ExceptionMessages::InvalidLabWorkerStatusType." : ".$values, ExceptionCodes::InvalidLabWorkerStatusType);
            }

            $filter[] = "(" . implode(" OR ", $paramFilters) . ")";
            $join_filter[]  = " JOIN $table_name ON labs.$table_column_id = $table_name.$table_column_id";       
        }

//======================================================================================================================
//= $region_edu_admin
//======================================================================================================================

        if ( Validator::Exists('region_edu_admin', $params) )
        {
            $table_name = "region_edu_admins";
            $table_column_id = "region_edu_admin_id";
            $table_column_name = "name";

            $param = Validator::toArray($region_edu_admin);

            $paramFilters = array();

            foreach ($param as $values)
            {
                if ( Validator::isNull($values) )
                    $paramFilters[] = "$table_name.$table_column_name is null";
                else if ( Validator::isID($values) )
                    $paramFilters[] = "$table_name.$table_column_id = ". $db->quote( Validator::toID($values) );
                else if ( Validator::isValue($values) )
                    $paramFilters[] = "$table_name.$table_column_name = ". $db->quote( Validator::toValue($values) );
                else
                    throw new Exception(ExceptionMessages::InvalidRegionEduAdminType." : ".$values, ExceptionCodes::InvalidRegionEduAdminType);
            }

            $filter[] = "(" . implode(" OR ", $paramFilters) . ")";
            $join_filter[]  = " JOIN $table_name ON school_units.$table_column_id = $table_name.$table_column_id";
            
        }

//======================================================================================================================
//= $edu_admin
//======================================================================================================================

        if ( Validator::Exists('edu_admin', $params) )
        {
            $table_name = "edu_admins";
            $table_column_id = "edu_admin_id";
            $table_column_name = "name";

            $param = Validator::toArray($edu_admin);

            $paramFilters = array();

            foreach ($param as $values)
            {
                if ( Validator::isNull($values) )
                    $paramFilters[] = "$table_name.$table_column_name is null";
                else if ( Validator::isID($values) )
                    $paramFilters[] = "$table_name.$table_column_id = ". $db->quote( Validator::toID($values) );
                else if ( Validator::isValue($values) )
                    $paramFilters[] = "$table_name.$table_column_name = ". $db->quote( Validator::toValue($values) );
                else
                    throw new Exception(ExceptionMessages::InvalidEduAdminType." : ".$values, ExceptionCodes::InvalidEduAdminType);
            }

            $filter[] = "(" . implode(" OR ", $paramFilters) . ")";
            $join_filter[]  = " JOIN $table_name ON school_units.$table_column_id = $table_name.$table_column_id";
            
        }

//======================================================================================================================
//= $transfer_area
//======================================================================================================================

        if ( Validator::Exists('transfer_area', $params) )
        {
            $table_name = "transfer_areas";
            $table_column_id = "transfer_area_id";
            $table_column_name = "name";

            $param = Validator::toArray($transfer_area);

            $paramFilters = array();

            foreach ($param as $values)
            {
                if ( Validator::isNull($values) )
                    $paramFilters[] = "$table_name.$table_column_name is null";
                else if ( Validator::isID($values) )
                    $paramFilters[] = "$table_name.$table_column_id = ". $db->quote( Validator::toID($values) );
                else if ( Validator::isValue($values) )
                    $paramFilters[] = "$table_name.$table_column_name = ". $db->quote( Validator::toValue($values) );
                else
                    throw new Exception(ExceptionMessages::InvalidTransferAreaType." : ".$values, ExceptionCodes::InvalidTransferAreaType);
            }

            $filter[] = "(" . implode(" OR ", $paramFilters) . ")";
            $join_filter[]  = " JOIN $table_name ON school_units.$table_column_id = $table_name.$table_column_id";
            
        }

//======================================================================================================================
//= $prefecture
//======================================================================================================================

        if ( Validator::Exists('prefecture', $params) )
        {
            $table_name = "prefectures";
            $table_column_id = "prefecture_id";
            $table_column_name = "name";

            $param = Validator::toArray($prefecture);

            $paramFilters = array();

            foreach ($param as $values)
            {
                if ( Validator::isNull($values) )
                    $paramFilters[] = "$table_name.$table_column_name is null";
                else if ( Validator::isID($values) )
                    $paramFilters[] = "$table_name.$table_column_id = ". $db->quote( Validator::toID($values) );
                else if ( Validator::isValue($values) )
                    $paramFilters[] = "$table_name.$table_column_name = ". $db->quote( Validator::toValue($values) );
                else
                    throw new Exception(ExceptionMessages::InvalidPrefectureType." : ".$values, ExceptionCodes::InvalidPrefectureType);
            }

            $filter[] = "(" . implode(" OR ", $paramFilters) . ")";
            $join_filter[]  = " JOIN $table_name ON school_units.$table_column_id = $table_name.$table_column_id";
            
        }

//======================================================================================================================
//= $municipality
//======================================================================================================================

        if ( Validator::Exists('municipality', $params) )
        {
            $table_name = "municipalities";
            $table_column_id = "municipality_id";
            $table_column_name = "name";

            $param = Validator::toArray($municipality);

            $paramFilters = array();

            foreach ($param as $values)
            {
                if ( Validator::isNull($values) )
                    $paramFilters[] = "$table_name.$table_column_name is null";
                else if ( Validator::isID($values) )
                    $paramFilters[] = "$table_name.$table_column_id = ". $db->quote( Validator::toID($values) );
                else if ( Validator::isValue($values) )
                    $paramFilters[] = "$table_name.$table_column_name = ". $db->quote( Validator::toValue($values) );
                else
                    throw new Exception(ExceptionMessages::InvalidMunicipalityType." : ".$values, ExceptionCodes::InvalidMunicipalityType);
            }

            $filter[] = "(" . implode(" OR ", $paramFilters) . ")";
            $join_filter[]  = " JOIN $table_name ON school_units.$table_column_id = $table_name.$table_column_id";
            
        }

//======================================================================================================================
//= $education_level
//======================================================================================================================

        if ( Validator::Exists('education_level', $params) )
        {
            $table_name = "education_levels";
            $table_column_id = "education_level_id";
            $table_column_name = "name";

            $param = Validator::toArray($education_level);

            $paramFilters = array();

            foreach ($param as $values)
            {
                if ( Validator::isNull($values) )
                    $paramFilters[] = "$table_name.$table_column_name is null";
                else if ( Validator::isID($values) )
                    $paramFilters[] = "$table_name.$table_column_id = ". $db->quote( Validator::toID($values) );
                else if ( Validator::isValue($values) )
                    $paramFilters[] = "$table_name.$table_column_name = ". $db->quote( Validator::toValue($values) );
                else
                    throw new Exception(ExceptionMessages::InvalidEducationLevelType." : ".$values, ExceptionCodes::InvalidEducationLevelType);
            }

            $filter[] = "(" . implode(" OR ", $paramFilters) . ")";
            $join_filter[]  = " JOIN $table_name ON school_units.$table_column_id = $table_name.$table_column_id";
            
        }

//======================================================================================================================
//= $school_unit_type
//======================================================================================================================

        if ( Validator::Exists('school_unit_type', $params) )
        {
            $table_name = "school_unit_types";
            $table_column_id = "school_unit_type_id";
            $table_column_name = "name";

            $param = Validator::toArray($school_unit_type);

            $paramFilters = array();

            foreach ($param as $values)
            {
                if ( Validator::isNull($values) )
                    $paramFilters[] = "$table_name.$table_column_name is null";
                else if ( Validator::isID($values) )
                    $paramFilters[] = "$table_name.$table_column_id = ". $db->quote( Validator::toID($values) );
                else if ( Validator::isValue($values) )
                    $paramFilters[] = "$table_name.$table_column_name = ". $db->quote( Validator::toValue($values) );
                else
                    throw new Exception(ExceptionMessages::InvalidSchoolUnitTypeType." : ".$values, ExceptionCodes::InvalidSchoolUnitTypeType);
            }

            $filter[] = "(" . implode(" OR ", $paramFilters) . ")";
            $join_filter[]  = " JOIN $table_name ON school_units.$table_column_id = $table_name.$table_column_id";
            
        }

//======================================================================================================================
//= $school_unit_state
//======================================================================================================================

        if ( Validator::Exists('school_unit_state', $params) )
        {
            $table_name = "school_unit_states";
            $table_column_id = "state_id";
            $table_column_name = "name";

            $param = Validator::toArray($school_unit_state);

            $paramFilters = array();

            foreach ($param as $values)
            {
                if ( Validator::isNull($values) )
                    $paramFilters[] = "$table_name.$table_column_name is null";
                else if ( Validator::isID($values) )
                    $paramFilters[] = "$table_name.$table_column_id = ". $db->quote( Validator::toID($values) );
                else if ( Validator::isValue($values) )
                    $paramFilters[] = "$table_name.$table_column_name = ". $db->quote( Validator::toValue($values) );
                else
                    throw new Exception(ExceptionMessages::InvalidStateType." : ".$values, ExceptionCodes::InvalidStateType);
            }

            $filter[] = "(" . implode(" OR ", $paramFilters) . ")";
            $join_filter[]  = " JOIN states $table_name ON school_units.$table_column_id = $table_name.$table_column_id";
            
        }
        
//======================================================================================================================
//= E X E C U T E
//======================================================================================================================

        
        $join_filter = array_unique($join_filter);
        //var_dump($join_filter);die();
        
        $sqlSelect = "SELECT  $field_x_axis as $name_x_axis, $field_y_axis as $name_y_axis, count(labs.lab_id) as total_labs ";
           
        $sqlFrom = "FROM labs";
        $sqlFilter = (count($join_filter) > 0 ? implode("", $join_filter) : "" );
        $sqlWhere = (count($filter) > 0 ? " WHERE " . implode(" AND ", $filter) : "" );
        $sqlGroupBy = " GROUP BY $field_x_axis , $field_y_axis";
       
        $result["filters"] = $filter ? $filter : null;

        $sql =  $sqlSelect . $sqlFrom . $sqlFilter . $sqlWhere . $sqlGroupBy;
        //echo "<br><br>".$sql."<br><br>";
        
        $stmt = $db->query( $sql );
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $result["results"] = $rows;
        
        $result["status"] = ExceptionCodes::NoErrors;;
        $result["message"] = ExceptionMessages::NoErrors;
    } 
    catch (Exception $e) 
    {
        $result["status"] = $e->getCode();
        $result["message"] = "[".__FUNCTION__."]:".$e->getMessage();
    }

    if ( Validator::isTrue( $params["debug"] ) )
    {
        $result["sql"] =  trim(preg_replace('/\s\s+/', ' ', $sql));
    }
    
    return $result;
}

?>