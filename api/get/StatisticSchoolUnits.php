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
* resourcePath="/statistic_school_units",
* description="Στατιστικά Σχολικών Μονάδων",
* produces="['application/json']",
* @SWG\Api(
*   path="/statistic_school_units",
*   @SWG\Operation(
*                   method="GET",
*                   summary="Στατιστικά για Σχολικές Μονάδες",
*                   notes="Επιστρέφει Στατιστικά για τις Σχολικές Μονάδες.Αφορά μόνο τις μονάδες που έχουν υποβεβλημένες Διατάξεις Η/Υ.",
*                   type="getStatisticSchoolUnits",
*                   nickname="GetStatisticSchoolUnits",
* 
*   @SWG\Parameter( name="school_unit_id", description="ID Σχολικής Μονάδας", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="school_unit_name", description="Όνομα Σχολικής Μονάδας (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="school_unit_special_name", description="Προσωνύμιο Σχολικής Μονάδας (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="region_edu_admin", description="Όνομα ή ID Περιφέρειας", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="edu_admin", description="Όνομα ή ID Διευθύνσης Εκπαίδευσης", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="transfer_area", description="Όνομα ή ID Περιοχής Μετάθεσης", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="municipality", description="Όνομα ή ID Δήμου", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="prefecture", description="Όνομα ή ID Νομού", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="education_level", description="Όνομα ή ID Επίπεδου Εκπαίδευσης", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="school_unit_type", description="Όνομα ή ID Τύπου Σχολικής Μονάδας", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="school_unit_state", description="Όνομα ή ID Λειτουργικής Κατάστασης Σχολικής Μονάδας", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="lab_id", description="ID Διάταξης Η/Υ", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="lab_name", description="Όνομα Διάταξης Η/Υ (Συνδυάζεται με την παράμετρο searchtype.)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="lab_special_name", description="Προσωνύμιο Διάταξης Η/Υ (Συνδυάζεται με την παράμετρο searchtype.)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="creation_date", description="Ημερομηνία Δημιουργίας Διάταξης Η/Υ (μορφή ημερομηνίας dd/mm/yyyy)", required=false, type="string|array[string]", format="date", paramType="query" ),
*   @SWG\Parameter( name="operational_rating", description="Βαθμολογία Λειτουργικής Κατάστασης Διάταξης Η/Υ (1=αρνητική - 5=θετική)", required=false, type="integer|array[integer]", paramType="query"),
*   @SWG\Parameter( name="technological_rating", description="Βαθμολογία Τεχνολογικής Κατάστασης Διάταξης Η/Υ (1=αρνητική - 5=θετική)", required=false, type="integer|array[integer]", paramType="query"),
*   @SWG\Parameter( name="submitted", description="Υποβεβλημένη Διάταξη Η/Υ [notNull](true=υποβεβλημένη, false=μη υποβεβλημένη)", required=false, type="boolean|array[boolean]", paramType="query" ),
*   @SWG\Parameter( name="lab_type", description="Όνομα ή ID Τύπου Διάταξης Η/Υ", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="lab_state", description="Όνομα ή ID Λειτουργικής Κατάστασης Διάταξης Η/Υ", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="lab_source", description="Όνομα ή ID Πρωτογενής Πηγής Δεδομένων Διάταξης Η/Υ)", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="aquisition_source", description="Όνομα ή ID Πηγής Χρηματοδότησης", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="equipment_type", description="Όνομα ή ID Τύπου Εξοπλισμού", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="lab_worker", description="Επίθετο ή Α.Μ. Υπεύθυνου Διατάξης Η/Υ", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="searchtype", description="Τύπος αναζήτησης", required=false, type="string", paramType="query", enum = "['EXACT','CONTAIN','CONTAINALL','CONTAINANY','STARTWITH','ENDWITH']" ),
*   @SWG\Parameter( name="debug", description="Επιστροφή SQL/DQL Queries", required=false, type="boolean", paramType="query", enum = "['true','false']" ),  
* 
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionsError, message=ExceptionMessages::NoPermissionsError),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitIDType, message=ExceptionMessages::InvalidSchoolUnitIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitNameType, message=ExceptionMessages::InvalidSchoolUnitNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitSpecialNameType, message=ExceptionMessages::InvalidSchoolUnitSpecialNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidRegionEduAdminType, message=ExceptionMessages::InvalidRegionEduAdminType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEduAdminType, message=ExceptionMessages::InvalidEduAdminType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidTransferAreaType, message=ExceptionMessages::InvalidTransferAreaType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMunicipalityType, message=ExceptionMessages::InvalidMunicipalityType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidPrefectureType, message=ExceptionMessages::InvalidPrefectureType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEducationLevelType, message=ExceptionMessages::InvalidEducationLevelType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitTypeType, message=ExceptionMessages::InvalidSchoolUnitTypeType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidStateType, message=ExceptionMessages::InvalidStateType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabIDType, message=ExceptionMessages::InvalidLabIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabNameType, message=ExceptionMessages::InvalidLabNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabSpecialNameType, message=ExceptionMessages::InvalidLabSpecialNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabCreationDateType, message=ExceptionMessages::InvalidLabCreationDateType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTechnologicalRatingType, message=ExceptionMessages::InvalidLabTechnologicalRatingType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabOperationalRatingType, message=ExceptionMessages::InvalidLabOperationalRatingType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabSubmittedType, message=ExceptionMessages::InvalidLabSubmittedType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTypeType, message=ExceptionMessages::InvalidLabTypeType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidStateType, message=ExceptionMessages::InvalidStateType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabSourceType, message=ExceptionMessages::InvalidLabSourceType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidAquisitionSourceType, message=ExceptionMessages::InvalidAquisitionSourceType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEquipmentTypeType, message=ExceptionMessages::InvalidEquipmentTypeType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerType, message=ExceptionMessages::InvalidLabWorkerType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSearchType, message=ExceptionMessages::InvalidSearchType),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="getStatisticSchoolUnits",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="filters",type="array",description="Οι παράμετροι(φίλτρα) της αναζήτησης που έχουν υποβληθεί"),
* @SWG\Property(name="total",type="integer",description="Το πλήθος των Σχολικών Μονάδων χωρίς τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="all_labs",type="integer",description="Το συνολικό πλήθος των Διατάξεων Η/Υ με βάση τυχόν φίλτρα αναζήτησης"),
* @SWG\Property(name="all_labs_by_type",type="array",description="Το συνολικό πλήθος ανά Διάταξη Η/Υ με βάση τυχόν φίλτρα αναζήτησης"),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="SQL",type="string",description="To SQL query που εκτελείται (επιστρεφεται στην περίπτωση debug=true)")
* )
* 
*/

function StatisticSchoolUnits ( $school_unit_id, $school_unit_name, $school_unit_special_name, 
                                $region_edu_admin, $edu_admin, $transfer_area, $municipality, $prefecture,
                                $education_level, $school_unit_type, $school_unit_state, 
                                $lab_id, $lab_name, $lab_special_name, $creation_date, $operational_rating, $technological_rating, $submitted, $lab_type, $lab_state, $lab_source, 
                                $aquisition_source, $equipment_type, $lab_worker, 
                                $searchtype) {

    global $db;
    global $app;
    
    $filter = array();
    $result = array();
    
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();

    try
    {
        
//$searchtype===================================================================     
       $searchtype = Filters::getSearchType($searchtype, $params);
        
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
//= $submitted
//======================================================================================================================

        if ( Validator::Exists('submitted', $params) )
        {
            $table_name = "labs";
            $table_column_id = "submitted";
            $table_column_name = "submitted";
            $filter_validators = 'boolean';

            $filter[] = Filters::BasicFilter( $submitted, $table_name, $table_column_id, $table_column_name, $filter_validators, 
                                                            ExceptionMessages::InvalidLabSubmittedType, ExceptionCodes::InvalidLabSubmittedType);

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
//= E X E C U T E
//======================================================================================================================

//Registered Labs and User permissions==========================================

        //set registered labs if submitted is missing
            if ( Validator::Missing('submitted', $params) ){            
                    $filter[] = $filter_labs[] = 'labs.submitted = 1';
            }
            
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

//Start SQL Queries=============================================================
           
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
        $sql =  $sqlSelect . $sqlFrom . $sqlWhere . $sqlPermissions;
        //echo "<br><br>".$sql."<br><br>";

        $stmt = $db->query( $sql );
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        $result["total"] = $rows["total_school_units"];
        $result["all_labs"] = $rows["all_labs"];
                
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

    if ( Validator::IsTrue( $params["debug"]  ) )
    {
        $result["SQL"] =  trim(preg_replace('/\s\s+/', ' ', $sql));
    }

    return $result;

}

?>