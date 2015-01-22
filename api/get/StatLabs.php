<?php
/**
 *
 * @version 1.0.1
 * @author  ΤΕΙ Αθήνας
 * @package GET
 */
 
header("Content-Type: text/html; charset=utf-8");

/**
* 
* 
* 
* @SWG\Resource(
* apiVersion=API_VERSION,
* swaggerVersion=SWAGGER_VERSION,
* basePath=BASE_PATH,
* resourcePath="/stat_labs",
* description="Δημιουργία Στατιστικών Διατάξεων Η/Υ",
* produces="['application/json']",
* @SWG\Api(
*   path="/stat_labs",
*   @SWG\Operation(
*                   method="GET",
*                   summary="Δημιουργία Στατιστικών Διατάξεων Η/Υ",
*                   notes="Eπιστρέφει στατιστικά για τις Διατάξεις Η/Υ σε δύο άξονες x,y και με φίλτρα επί των αξόνων αυτών.Αφορά μόνο υποβεβλημένες Διατάξεις Η/Υ.
                           Στον Πίνακα Axis περιέχονται τα ονόματα των παραμέτρων, με βαση τα οποίο ο χρήστης μπορέι δημιουργήσει δισδιαστατο πίνακα αποτελεσματων με άξονες x,y για την προβολή στατιστικων αποτελεσμάτων.
                           Πίνακας Axis με αποδεκτές τιμές
                                lab_type = Τύπος Διάταξης Η/Υ 
                                lab_state = Λειτουργική Κατάσταση Διάταξης Η/Υ
                                region_edu_admin = Περιφέρεια
                                edu_admin = Διεύθυνση Εκπαίδευσης
                                transfer_area = Περιοχή Μετάθεσης
                                prefecture = Νομός
                                municipality = Δήμος
                                education_level = Επίπεδο Εκπαίδευσης
                                school_unit_type = Τύπος Σχολικής Μονάδας
                                school_unit_state = Λειτουργική Κατάσταση Σχολικής Μονάδας                             
                          ",   
*                   type="getStatLabs",
*                   nickname="GetStatLabs",
* 
*   @SWG\Parameter( name="x_axis", description="Παράμετρος άξονα x", required=true, type="string|array[string])", paramType="query", enum = "['lab_type','lab_state','region_edu_admin','edu_admin','transfer_area','prefecture','municipality','education_level','school_unit_type','school_unit_state']" ),
*   @SWG\Parameter( name="y_axis", description="Παράμετρος άξονα y", required=true, type="string|array[string])", paramType="query", enum = "['lab_type','lab_state','region_edu_admin','edu_admin','transfer_area','prefecture','municipality','education_level','school_unit_type','school_unit_state']" ),
*   @SWG\Parameter( name="operational_rating", description="Βαθμολογία Λειτουργικής Κατάστασης Διάταξης Η/Υ [notNull](1=αρνητική - 5=θετική)", required=false, type="integer|array[integer]", paramType="query"),
*   @SWG\Parameter( name="technological_rating", description="Βαθμολογία Τεχνολογικής Κατάστασης Διάταξης Η/Υ [notNull](1=αρνητική - 5=θετική)", required=false, type="integer|array[integer]", paramType="query"),
*   @SWG\Parameter( name="lab_type", description="Όνομα ή ID Τύπου Διάταξης Η/Υ", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="lab_state", description="Όνομα ή ID Λειτουργικής Κατάστασης Διάταξης Η/Υ", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="has_lab_worker", description="Επευθυνος Διαταξης Η/Υ  [notNULL](1=Ενεργός Υπεύθυνος,3=Ανενεργός Υπεύθυνος)", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="region_edu_admin", description="Όνομα ή ID Περιφέρειας", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="edu_admin", description="Όνομα ή ID Διευθύνσης Εκπαίδευσης", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="transfer_area", description="Όνομα ή ID Περιοχής Μετάθεσης", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="municipality", description="Όνομα ή ID Δήμου", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="prefecture", description="Όνομα ή ID Νομού", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="education_level", description="Όνομα ή ID Επίπεδου Εκπαίδευσης", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="school_unit_type", description="Όνομα ή ID Τύπου Σχολικής Μονάδας", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="school_unit_state", description="Όνομα ή ID Λειτουργικής Κατάστασης Σχολικής Μονάδας", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="export", description="Μορφή Εξαγωγής Δεδομενων", required=false, type="string", paramType="query", enum = "['JSON','XLSX','PHP_ARRAY']" ),
* 
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateXYAxisParam, message=ExceptionMessages::DuplicateXYAxisParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidXAxisArray, message=ExceptionMessages::InvalidXAxisArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingXAxisValue, message=ExceptionMessages::MissingXAxisValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidXAxis, message=ExceptionMessages::InvalidXAxis),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidXAxisType, message=ExceptionMessages::InvalidXAxisType),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingXAxisParam, message=ExceptionMessages::MissingXAxisParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidYAxisArray, message=ExceptionMessages::InvalidYAxisArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingYAxisValue, message=ExceptionMessages::MissingYAxisValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidYAxis, message=ExceptionMessages::InvalidYAxis),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidYAxisType, message=ExceptionMessages::InvalidYAxisType),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingYAxisParam, message=ExceptionMessages::MissingYAxisParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabOperationalRatingType, message=ExceptionMessages::InvalidLabOperationalRatingType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTechnologicalRatingType, message=ExceptionMessages::InvalidLabTechnologicalRatingType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTypeType, message=ExceptionMessages::InvalidLabTypeType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidStateType, message=ExceptionMessages::InvalidStateType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerStatusType, message=ExceptionMessages::InvalidLabWorkerStatusType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidRegionEduAdminType, message=ExceptionMessages::InvalidRegionEduAdminType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEduAdminType, message=ExceptionMessages::InvalidEduAdminType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidTransferAreaType, message=ExceptionMessages::InvalidTransferAreaType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMunicipalityType, message=ExceptionMessages::InvalidMunicipalityType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidPrefectureType, message=ExceptionMessages::InvalidPrefectureType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEducationLevelType, message=ExceptionMessages::InvalidEducationLevelType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitTypeType, message=ExceptionMessages::InvalidSchoolUnitTypeType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidStateType, message=ExceptionMessages::InvalidStateType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidExportType, message=ExceptionMessages::InvalidExportType),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="getStatLabs",
* description="Παρακάτω εμφανίζεται τα δεδομένα σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="filters",type="array",description="Οι παράμετροι(φίλτρα) της αναζήτησης που έχουν υποβληθεί"),
* @SWG\Property(name="results",type="array",description="Ο Πίνακας με τα αποτελέσματα",items="$ref:StatLab")
* )
*  
* @SWG\Model(
* id="StatLab",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με τα στατιστικά σε 2 αξονες και το αποτέλεσμα τους : ",
* @SWG\Property(name="x_axis parameter",type="string",description="Η τιμή του άξονα x"),
* @SWG\Property(name="y_axis parameter",type="string",description="Η τιμή του άξονα y"),
* @SWG\Property(name="total_labs",type="integer",description="Το πλήθος των Διατάξεων Η/Υ του συνδιασμού x,y")
* )
* 
**/

function StatLabs(
    $x_axis, $y_axis, $operational_rating, $technological_rating, 
    $lab_type, $lab_state, $has_lab_worker,
    $region_edu_admin, $edu_admin, $transfer_area, $municipality, $prefecture, $education_level, $school_unit_type, $school_unit_state,
    $export
    )
{
    global $db, $Options;
    
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

//user permissions==============================================================
//not required (all users with title 'ΚΕΠΛΗΝΕΤ' or 'ΠΣΔ' or 'ΥΠΕΠΘ' have permissions to GetStatLabs)
       
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
            $table_column_id = "worker_id";
            $table_join_column_id = "lab_id";
            $table_join_column_name = "worker_status";
            
            $paramFilters = array();
//var_dump($has_lab_worker);die();
                if (Validator::IsWorkerState($has_lab_worker) && $has_lab_worker == 1 )
                    $paramFilters[] = "$table_name.$table_column_id is NOT NULL ";
                else if (Validator::IsWorkerState($has_lab_worker) && $has_lab_worker == 3 )
                    $paramFilters[] = "$table_name.$table_column_id is NULL ";
                else
                    throw new Exception(ExceptionMessages::InvalidLabWorkerStatusType." : ".$has_lab_worker, ExceptionCodes::InvalidLabWorkerStatusType);

            $filter[] = "(" . implode(" OR ", $paramFilters) . ")";
            $join_filter[]  = " LEFT JOIN (SELECT * FROM $table_name WHERE $table_join_column_name = 1) $table_name ON labs.$table_join_column_id = $table_name.$table_join_column_id";       
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
//= $export
//======================================================================================================================
        
        if ( Validator::Missing('export', $params) )
            $export = ExportDataEnumTypes::JSON;
        else if ( ExportDataEnumTypes::isValidValue( $export ) || ExportDataEnumTypes::isValidName( $export ) ) {
            $export = ExportDataEnumTypes::getValue($export);
        } else
            throw new Exception(ExceptionMessages::InvalidExportType." : ".$export, ExceptionCodes::InvalidExportType);
        
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
    
    if ($export == 'JSON'){
        return $result;
    } else if ($export == 'XLSX') {
       $xlsx_filename = StatLabsExt::ExcelCreate($result, $x_axis, $y_axis);
       unset($result['results']);
       return array("result"=>$result,"tmp_xlsx_filepath" => $Options["WebTmpFolder"].$xlsx_filename);
       // exit;
    } else if ($export == 'PDF'){
//       $pdf_filename = StatLabsExt::PdfCreate($result, $x_axis, $y_axis);
//       unset($result['results']);
//       return array("result"=>$result,"tmp_pdf_filepath" => $Options["WebTmpFolder"].$pdf_filename);
        return $result;
    } else if ($export == 'PHP_ARRAY'){
       return print_r($result);
    } else {     
       return $result;
    }
    
}

?>