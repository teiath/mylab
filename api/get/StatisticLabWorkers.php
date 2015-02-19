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
* resourcePath="/statistic_lab_workers",
* description="Στατιστικά Υπεύθυνων Διατάξεων",
* produces="['application/json']",
* @SWG\Api(
*   path="/statistic_lab_workers",
*   @SWG\Operation(
*                   method="GET",
*                   summary="Στατιστικά για τους Υπεύθυνους Διατάξεων Η/Υ",
*                   notes="Επιστρέφει Στατιστικά για τους Υπεύθυνους Διατάξεων Η/Υ.Αφορά μόνο υποβεβλημένες Διατάξεις Η/Υ.",
*                   type="getStatisticLabWorkers",
*                   nickname="GetStatisticLabWorkers",
* 
*   @SWG\Parameter( name="lab_worker_id", description="ID Υπεύθυνου Διατάξης Η/Υ", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="worker_status", description="Κατάσταση Υπεύθυνου Διατάξης Η/Υ (1=Ενεργός,3=Μη Ενεργός)", required=false, type="integer|array[integer]", paramType="query", enum="['1','3']" ),
*   @SWG\Parameter( name="worker_start_service", description="Ημερομηνία Αλλαγής Μετάβασης Λειτουργικής Καταστάσης Διατάξης (μορφή ημερομηνίας dd/mm/yyyy)", required=false, type="string", format="date", paramType="query" ),
*   @SWG\Parameter( name="lab_id", description="ID Διάταξης Η/Υ", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="lab_name", description="Όνομα Διάταξης Η/Υ (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="submitted", description="Υποβεβλημένη Διάταξη Η/Υ [notNull](true=υποβεβλημένη, false=μη υποβεβλημένη)", required=false, type="boolean|array[boolean]", paramType="query" ),
*   @SWG\Parameter( name="worker_position", description="Όνομα ή ID Θέσης Εργασίας Εργαζόμενου", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="lab_worker", description="Επίθετο ή Α.Μ. Υπεύθυνου Διατάξης Η/Υ", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="lab_worker_uid", description="UID Εργαζόμενου", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="lab_type", description="Όνομα ή ID Τύπου Διάταξης Η/Υ", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="school_unit_id", description="ID Σχολικής Μονάδας", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="school_unit_name", description="Όνομα Σχολικής Μονάδας (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="lab_state", description="Όνομα ή ID Λειτουργικής Κατάστασης Διάταξης Η/Υ", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="region_edu_admin", description="Όνομα ή ID Περιφέρειας", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="edu_admin", description="Όνομα ή ID Διευθύνσης Εκπαίδευσης", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="transfer_area", description="Όνομα ή ID Περιοχής Μετάθεσης", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="municipality", description="Όνομα ή ID Δήμου", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="prefecture", description="Όνομα ή ID Νομού", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="education_level", description="Όνομα ή ID Επίπεδου Εκπαίδευσης", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="school_unit_type", description="Όνομα ή ID Τύπου Σχολικής Μονάδας", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="school_unit_state", description="Όνομα ή ID Λειτουργικής Κατάστασης Σχολικής Μονάδας", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="searchtype", description="Τύπος αναζήτησης", required=false, type="string", paramType="query", enum = "['EXACT','CONTAIN','CONTAINALL','CONTAINANY','STARTWITH','ENDWITH']" ),
*   @SWG\Parameter( name="debug", description="Επιστροφή SQL/DQL Queries", required=false, type="boolean", paramType="query", enum = "['true','false']" ),  
* 
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionsError, message=ExceptionMessages::NoPermissionsError),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerIDType, message=ExceptionMessages::InvalidLabWorkerIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerStatusType, message=ExceptionMessages::InvalidLabWorkerStatusType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerStartServiceType, message=ExceptionMessages::InvalidLabWorkerStartServiceType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerType, message=ExceptionMessages::InvalidMylabWorkerType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerUidType, message=ExceptionMessages::InvalidMylabWorkerUidType), 
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidWorkerPositionType, message=ExceptionMessages::InvalidWorkerPositionType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabIDType, message=ExceptionMessages::InvalidLabIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabNameType, message=ExceptionMessages::InvalidLabNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabSubmittedType, message=ExceptionMessages::InvalidLabSubmittedType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTypeType, message=ExceptionMessages::InvalidLabTypeType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitIDType, message=ExceptionMessages::InvalidSchoolUnitIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitNameType, message=ExceptionMessages::InvalidSchoolUnitNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidStateType, message=ExceptionMessages::InvalidStateType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidRegionEduAdminType, message=ExceptionMessages::InvalidRegionEduAdminType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEduAdminType, message=ExceptionMessages::InvalidEduAdminType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidTransferAreaType, message=ExceptionMessages::InvalidTransferAreaType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMunicipalityType, message=ExceptionMessages::InvalidMunicipalityType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidPrefectureType, message=ExceptionMessages::InvalidPrefectureType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEducationLevelType, message=ExceptionMessages::InvalidEducationLevelType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitTypeType, message=ExceptionMessages::InvalidSchoolUnitTypeType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidStateType, message=ExceptionMessages::InvalidStateType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSearchType, message=ExceptionMessages::InvalidSearchType),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="getStatisticLabWorkers",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="filters",type="array",description="Οι παράμετροι(φίλτρα) της αναζήτησης που έχουν υποβληθεί"),
* @SWG\Property(name="total",type="integer",description="Το πλήθος των Υπεύθυνων Διατάξεων Η/Υ"),
* @SWG\Property(name="all_labs_by_type",type="array",description="Το συνολικό πλήθος ανά Διάταξη Η/Υ με βάση τυχόν φίλτρα αναζήτησης"),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="SQL",type="string",description="To SQL query που εκτελείται (επιστρεφεται στην περίπτωση debug=true)"),
* @SWG\Property(name="tmp_xlsx_filepath",type="string",description="To URL με το αρχείο xlsx (επιστρεφεται στην περίπτωση export=XLSX)")
* )
* 
*/

function StatisticLabWorkers (  $lab_worker_id, $worker_status, $worker_start_service,
                                $lab_id, $lab_name, $submitted, $worker_position, $worker, $worker_registry_no,
                                $lab_type, $school_unit_id, $school_unit_name, $lab_state,                      
                                $region_edu_admin, $edu_admin, $transfer_area, $municipality, $prefecture,
                                $education_level, $school_unit_type, $school_unit_state, 
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
//= $lab_worker_id
//======================================================================================================================

        if ( Validator::Exists('lab_worker_id', $params) )
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

        if ( Validator::Exists('worker_status', $params) )
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

        if ( Validator::Exists('worker_start_service', $params) )
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

        if ( Validator::Exists('worker', $params) )
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

        if ( Validator::Exists('registry_no', $params) )
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

        if ( Validator::Exists('worker_position', $params) )
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

        if ( Validator::Exists('lab_id', $params) )
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

        if ( Validator::Exists('lab_name', $params) )
        {
            $table_name = "labs";
            $table_column_name = "name";

            $filter[] =  Filters::ExtBasicFilter($lab_name, $table_name, $table_column_name, $searchtype, 
                                                 ExceptionMessages::InvalidLabNameType, ExceptionCodes::InvalidLabNameType ); 
            
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
            
            $filter[] = Filters::BasicFilter( $lab_type, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidLabTypeType, ExceptionCodes::InvalidLabTypeType);
            
        }
        
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
//= $lab_state
//======================================================================================================================

        if ( Validator::Exists('lab_state', $params) )
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
//= E X E C U T E
//======================================================================================================================

//Registered Labs and User permissions==========================================

        //set registered labs if submitted is missing
            if ( Validator::Missing('submitted', $params) ){            
                    $filter[] = 'labs.submitted = 1';
            }
            
            //set user permissions
           $permissions = CheckUserPermissions::getUserPermissions($app->request->user, true, true);

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

    if ( Validator::IsTrue( $params["debug"]  ) )
    {
        $result["sql"] =  trim(preg_replace('/\s\s+/', ' ', $sql));
    }

    return $result;

}
?>