<?php
/**
 *
 * @version 2.0
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
* resourcePath="/find_lab_workers",
* description="Εύρεση Υπεύθυνων Διατάξεων Η/Υ",
* produces="['application/json']",
* @SWG\Api(
*   path="/find_lab_workers",
*   @SWG\Operation(
*                   method="GET",
*                   summary="Εύρεση Υπευθύνων Διατάξεων Η/Υ",
*                   notes="Επιστρέφει τους Υπεύθυνους Διατάξεων Η/Υ, μόνο τα προσωπικά στοιχεία τους.Έχει περισσότερες παραμέτρους για εκτεταμένη αναζήτηση.",
*                   type="getFindLabWorkers",
*                   nickname="GetFindLabWorkers",
* 
*   @SWG\Parameter( name="lab_worker_id", description="ID Υπεύθυνου Διάταξης Η/Υ [notNull]", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="lab_worker_status", description="Κατάσταση Υπεύθυνου [notNull](1=ΕΝΕΡΓΟΣ,3=ΑΝΕΝΕΡΓΟΣ)", required=false, type="integer|array[integer]", paramType="query", enum = "['1','3']" ),
*   @SWG\Parameter( name="lab_worker_start_service", description="Ημερομηνία Ανάληψης Ευθύνης Υπεύθυνου [notNull](μορφή ημερομηνίας dd/mm/yyyy)", required=false, type="string|array[string]", format="date", paramType="query" ),
*   @SWG\Parameter( name="lab_worker_position", description="Όνομα ή ID Θέσης Εργασίας Εργαζόμενου [notNull]", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="worker_registry_no", description="Α.Μ. ή Α.Φ.Μ. Εργαζόμενου [notNull]", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="worker_uid", description="UID Εργαζόμενου (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="worker_firstname", description="Όνομα Εργαζόμενου (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="worker_lastname", description="Επώνυμο Εργαζόμενου (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="lab_id", description="ID Διάταξης Η/Υ [notNull]", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="lab_name", description="Όνομα Διάταξης Η/Υ (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="submitted", description="Υποβεβλημένη Διάταξη Η/Υ [notNull](true=υποβεβλημένη, false=μη υποβεβλημένη)", required=false, type="boolean|array[boolean]", paramType="query" ),
*   @SWG\Parameter( name="lab_type", description="Όνομα ή ID Τύπου Διάταξης Η/Υ", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="lab_state", description="Όνομα ή ID Λειτουργικής Κατάστασης Διάταξης Η/Υ", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ), 
*   @SWG\Parameter( name="school_unit_id", description="ID Σχολικής Μονάδας [notNull]", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="school_unit_name", description="Όνομα Σχολικής Μονάδας (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="region_edu_admin", description="Όνομα ή ID Περιφέρειας", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="edu_admin", description="Όνομα ή ID Διευθύνσης Εκπαίδευσης", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="transfer_area", description="Όνομα ή ID Περιοχής Μετάθεσης", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="municipality", description="Όνομα ή ID Δήμου", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="prefecture", description="Όνομα ή ID Νομού", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="education_level", description="Όνομα ή ID Επίπεδου Εκπαίδευσης", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="school_unit_type", description="Όνομα ή ID Τύπου Σχολικής Μονάδας", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="school_unit_state", description="Όνομα ή ID Λειτουργικής Κατάστασης Σχολικής Μονάδας", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
* 
*   @SWG\Parameter( name="page", description="Αριθμός Σελίδας", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="pagesize", description="Αριθμός Εγγραφών/Σελίδα", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="searchtype", description="Τύπος αναζήτησης", required=false, type="string", paramType="query", enum = "['EXACT','CONTAIN','CONTAINALL','CONTAINANY','STARTWITH','ENDWITH']" ),
*   @SWG\Parameter( name="ordertype", description="Τύπος Ταξινόμησης", required=false, type="string", paramType="query", enum = "['ASC','DESC']" ),
*   @SWG\Parameter( name="orderby", description="Πεδίο Ταξινόμησης", required=false, type="string", paramType="query",
*                   enum = "['worker_id','registry_no','worker_uid','firstname','lastname','fathername','email','worker_specialization_id','worker_specialization_name','worker_lab_source_id','worker_lab_source_name']" ),
*   @SWG\Parameter( name="export", description="Μορφή Εξαγωγής Δεδομενων", required=false, type="string", paramType="query",
*                   enum = "['JSON','XLSX','PHP_ARRAY']" ),
*   @SWG\Parameter( name="debug", description="Επιστροφή SQL/DQL Queries", required=false, type="boolean", paramType="query", enum = "['true','false']" ),  
* 
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerIDType, message=ExceptionMessages::InvalidLabWorkerIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerStatusType, message=ExceptionMessages::InvalidLabWorkerStatusType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerStartServiceType, message=ExceptionMessages::InvalidLabWorkerStartServiceType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidWorkerPositionType, message=ExceptionMessages::InvalidWorkerPositionType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerRegistryNoType, message=ExceptionMessages::InvalidMylabWorkerRegistryNoType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerUidType, message=ExceptionMessages::InvalidMylabWorkerUidType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerFirstnameType, message=ExceptionMessages::InvalidMylabWorkerFirstnameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerLastnameType, message=ExceptionMessages::InvalidMylabWorkerLastnameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabIDType, message=ExceptionMessages::InvalidLabIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabNameType, message=ExceptionMessages::InvalidLabNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabSubmittedType, message=ExceptionMessages::InvalidLabSubmittedType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTypeType, message=ExceptionMessages::InvalidLabTypeType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidStateType, message=ExceptionMessages::InvalidStateType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitIDType, message=ExceptionMessages::InvalidSchoolUnitIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitNameType, message=ExceptionMessages::InvalidSchoolUnitNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidRegionEduAdminType, message=ExceptionMessages::InvalidRegionEduAdminType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEduAdminType, message=ExceptionMessages::InvalidEduAdminType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidTransferAreaType, message=ExceptionMessages::InvalidTransferAreaType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMunicipalityType, message=ExceptionMessages::InvalidMunicipalityType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidPrefectureType, message=ExceptionMessages::InvalidPrefectureType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEducationLevelType, message=ExceptionMessages::InvalidEducationLevelType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitTypeType, message=ExceptionMessages::InvalidSchoolUnitTypeType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidStateType, message=ExceptionMessages::InvalidStateType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerValue, message=ExceptionMessages::InvalidLabWorkerValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidExportType, message=ExceptionMessages::InvalidExportType),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingPageValue, message=ExceptionMessages::MissingPageValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidPageArray, message=ExceptionMessages::InvalidPageArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidPageType, message=ExceptionMessages::InvalidPageType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidPageNumber, message=ExceptionMessages::InvalidPageNumber),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingPageSizeValue, message=ExceptionMessages::MissingPageSizeValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidPageSizeArray, message=ExceptionMessages::InvalidPageSizeArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidPageSizeType, message=ExceptionMessages::InvalidPageSizeType),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingPageSizeNegativeValue, message=ExceptionMessages::MissingPageSizeNegativeValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidPageSizeNumber, message=ExceptionMessages::InvalidPageSizeNumber),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSearchType, message=ExceptionMessages::InvalidSearchType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidOrderType, message=ExceptionMessages::InvalidOrderType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidOrderBy, message=ExceptionMessages::InvalidOrderBy),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMaxPageNumber, message=ExceptionMessages::InvalidMaxPageNumber),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="getFindLabWorkers",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="total",type="integer",description="Το πλήθος των εγγραφών χωρίς τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="count",type="integer",description="Το πλήθος των εγγραφών της κλήσης σύμφωνα με τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="pagination",type="array",description="Οι παράμετροι σελιδοποίησης των εγγραφών της κλήσης",items="$ref:Pagination"),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="data",type="array",description="Ο Πίνακας με τα αποτελέσματα ",items="$ref:FindLabWorker"),
* @SWG\Property(name="DQL",type="string",description="To DQL query που εκτελείται (επιστρεφεται στην περίπτωση debug=true)"),
* @SWG\Property(name="SQL",type="string",description="To SQL query που εκτελείται (επιστρεφεται στην περίπτωση debug=true)"),
* @SWG\Property(name="tmp_xlsx_filepath",type="string",description="To URL με το αρχείο xlsx (επιστρεφεται στην περίπτωση export=XLSX)")
* )
* 
* @SWG\Model(
* id="Pagination",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με πληροφορίες σελιδοποίησης : ",
* @SWG\Property(name="page",type="string",description="Ο αριθμός της σελίδας των αποτελεσμάτων"),
* @SWG\Property(name="maxPage",type="string",description="Ο μέγιστος αριθμός της σελίδας των αποτελεσμάτων"),
* @SWG\Property(name="pagesize",type="integer",description="Ο αριθμός των εγγραφών προς επιστροφή")
* )
* 
* @SWG\Model(
* id="FindLabWorker",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με στοιχεία των υπεύθυνων Διατάξεων Η/Υ : ",
* @SWG\Property(name="worker_id",type="integer",description="Ο Κωδικός ID του Εργαζόμενου"),
* @SWG\Property(name="registry_no",type="integer",description="Ο Α.Μ. ή το Α.Φ.Μ. Εργαζόμενου (Α.Φ.Μ = 9ψηφιο , Α.Μ. = 6ψηφιο)"),
* @SWG\Property(name="worker_uid",type="string",description="Το μοναδικό UID όνομα του Εργαζόμενου (uid name from ldap)"),
* @SWG\Property(name="firstname",type="string",description="Το Όνομα του Εργαζόμενου"),
* @SWG\Property(name="lastname",type="string",description="Το Επώνυμο του Εργαζόμενου"),
* @SWG\Property(name="fathername",type="string",description="Το Όνομα Πατρός του Εργαζόμενου"),
* @SWG\Property(name="email",type="string",description="Το email του Εργαζόμενου"),
* @SWG\Property(name="worker_specialization_id",type="integer",description="Ο Κωδικός ID της Ειδικότητας Εργαζόμενου"),
* @SWG\Property(name="worker_specialization_name",type="string",description="Το Όνομα της Ειδικότητας Εργαζόμενου"),
* @SWG\Property(name="worker_lab_source_id",type="integer",description="Ο Κωδικός ID της Πρωτογενής Πηγής Δεδομένων Εργαζόμενου"),
* @SWG\Property(name="worker_lab_source_name",type="string",description="Το Όνομα της Πρωτογενής Πηγής Δεδομένων Εργαζόμενου")
* )
* 
*/

function FindLabWorkers ( $lab_worker_id, $lab_worker_status, $lab_worker_start_service, $lab_worker_position, 
                          $worker_registry_no, $worker_uid, $worker_firstname, $worker_lastname, 
                          $lab_id, $lab_name, $submitted, $lab_type, $lab_state,
                          $school_unit_id, $school_unit_name,
                          $region_edu_admin, $edu_admin, $transfer_area, $municipality, $prefecture, 
                          $education_level, $school_unit_type, $school_unit_state, 
                          $pagesize, $page, $orderby, $ordertype, $searchtype, $export ) {

    global $entityManager, $app , $Options;

    $qb = $entityManager->createQueryBuilder();
    $result = array();  

    $result["data"] = array();
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();

    try {
        
//user permissions==============================================================
//not required (all users with title 'ΚΕΠΛΗΝΕΤ' or 'ΠΣΔ' or 'ΥΠΕΠΘ' have permissions to GetFindLabWorkers)
    
//$export=======================================================================       
        if ( Validator::Missing('export', $params) )
            $export = ExportDataEnumTypes::JSON;
        else if ( ExportDataEnumTypes::isValidValue( $export ) || ExportDataEnumTypes::isValidName( $export ) ) {
            $export = ExportDataEnumTypes::getValue($export);
        } else
            throw new Exception(ExceptionMessages::InvalidExportType." : ".$export, ExceptionCodes::InvalidExportType);
        
//$page - $pagesize - $searchtype - $ordertype =================================
       $page = Pagination::getPage($page, $params);   
       $searchtype = Filters::getSearchType($searchtype, $params);
       $ordertype =  Filters::getOrderType($ordertype, $params);
  
       if ($export == 'XLSX')
            $pagesize = Parameters::ExportPageSize;
       else
            $pagesize = Pagination::getPagesize($pagesize, $params);
       
//$orderby======================================================================
       $columns = array(
                            "mlw.workerId"     => "worker_id",
                            "mlw.registryNo"   => "registry_no",
                            "mlw.uid"          => "worker_uid",
                            "mlw.firstname"    => "firstname",
                            "mlw.lastname"     => "lastname", 
                            "mlw.fathername"   => "fathername",
                            "mlw.email"        => "email",  
                            "mlwws.workerSpecializationId"  => "worker_specialization_id",
                            "mlwws.name"                    => "worker_specialization_name",
                            "mlwls.labSourceId"             => "worker_lab_source_id",
                            "mlwls.name"                    => "worker_lab_source_name",
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "worker_id";
        else
        {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        } 
        
//$lab_worker_id================================================================
    if (Validator::Exists('lab_worker_id', $params)){
        CRUDUtils::setFilter($qb, $lab_worker_id, "lw", "labWorkerId", "labWorkerId", "id", ExceptionMessages::InvalidLabWorkerIDType, ExceptionCodes::InvalidLabWorkerIDType);
    } 
      
//$lab_worker_status============================================================
    if (Validator::Exists('lab_worker_status', $params)){
        CRUDUtils::setFilter($qb, $lab_worker_status, "lw", "workerStatus", "workerStatus", "numeric", ExceptionMessages::InvalidLabWorkerStatusType, ExceptionCodes::InvalidLabWorkerStatusType);
    }   
         
//$lab_worker_start_service=====================================================
    if (Validator::Exists('lab_worker_start_service', $params)){
        CRUDUtils::setFilter($qb, $lab_worker_start_service, "lw", "workerStartService", "workerStartService", "date", ExceptionMessages::InvalidLabWorkerStartServiceType, ExceptionCodes::InvalidLabWorkerStartServiceType);
    } 
        
//$lab_worker_position==========================================================
    if (Validator::Exists('lab_worker_position', $params)){
        CRUDUtils::setFilter($qb, $lab_worker_position, "wp", "workerPositionId", "name", "id,value", ExceptionMessages::InvalidWorkerPositionType, ExceptionCodes::InvalidWorkerPositionType);
    } 
 
//$worker_registry_no===========================================================
        if (Validator::Exists('worker_registry_no', $params)){
            CRUDUtils::setFilter($qb, $worker_registry_no, "mlw", "registryNo", "registryNo", "numeric", ExceptionMessages::InvalidMylabWorkerRegistryNoType, ExceptionCodes::InvalidMylabWorkerRegistryNoType);    
        }
        
//$worker_uid===================================================================
        if (Validator::Exists('worker_uid', $params)){
            CRUDUtils::setSearchFilter($qb, $worker_uid, "mlw", "uid", $searchtype, ExceptionMessages::InvalidMylabWorkerUidType, ExceptionCodes::InvalidMylabWorkerUidType);    
        } 
   
//$worker_firstname=============================================================
        if (Validator::Exists('worker_firstname', $params)){
            CRUDUtils::setSearchFilter($qb, $worker_firstname, "mlw", "firstname", $searchtype, ExceptionMessages::InvalidMylabWorkerFirstnameType, ExceptionCodes::InvalidMylabWorkerFirstnameType);    
        } 

//$worker_lastname==============================================================
        if (Validator::Exists('worker_lastname', $params)){
            CRUDUtils::setSearchFilter ($qb, $worker_lastname, "mlw", "lastname", $searchtype, ExceptionMessages::InvalidMylabWorkerLastnameType, ExceptionCodes::InvalidMylabWorkerLastnameType);
        }  
        
//$lab_id=======================================================================
        if (Validator::Exists('lab_id', $params)){
            CRUDUtils::setFilter($qb, $lab_id, "l", "labId", "labId", "id", ExceptionMessages::InvalidLabIDType, ExceptionCodes::InvalidLabIDType);
        } 

//$lab_name=====================================================================
        if (Validator::Exists('lab_name', $params)){
            CRUDUtils::setSearchFilter($qb, $lab_name, "l", "name", $searchtype, ExceptionMessages::InvalidLabNameType, ExceptionCodes::InvalidLabNameType);    
        } 
  
//$submitted====================================================================
        if (Validator::Exists('submitted', $params)){
            CRUDUtils::setFilter($qb, $submitted, "l", "submitted", "submitted", "boolean", ExceptionMessages::InvalidLabSubmittedType, ExceptionCodes::InvalidLabSubmittedType);
        }  
        
 //$lab_type====================================================================
        if (Validator::Exists('lab_type', $params)){
            CRUDUtils::setFilter($qb, $lab_type, "lt", "labTypeId", "name", "null,id,value", ExceptionMessages::InvalidLabTypeType, ExceptionCodes::InvalidLabTypeType);
        }
        
//$lab_state====================================================================
        if (Validator::Exists('lab_state', $params)){
            CRUDUtils::setFilter($qb, $lab_state, "s", "stateId", "name", "null,id,value", ExceptionMessages::InvalidStateType, ExceptionCodes::InvalidStateType);
        } 
   
//$school_unit_id===============================================================
        if (Validator::Exists('school_unit_id', $params)){
            CRUDUtils::setFilter($qb, $school_unit_id, "su", "schoolUnitId", "schoolUnitId", "id", ExceptionMessages::InvalidSchoolUnitIDType, ExceptionCodes::InvalidSchoolUnitIDType);
        } 

//$school_unit_name=============================================================
        if (Validator::Exists('school_unit_name', $params)){
            CRUDUtils::setSearchFilter($qb, $school_unit_name, "su", "name", $searchtype, ExceptionMessages::InvalidSchoolUnitNameType, ExceptionCodes::InvalidSchoolUnitNameType);    
        } 
        
 //$region_edu_admin============================================================
        if (Validator::Exists('region_edu_admin', $params)){
            CRUDUtils::setFilter($qb, $region_edu_admin, "rea", "regionEduAdminId", "name", "null,id,value", ExceptionMessages::InvalidRegionEduAdminType, ExceptionCodes::InvalidRegionEduAdminType);
        }
        
//$edu_admin====================================================================
        if (Validator::Exists('edu_admin', $params)){
            CRUDUtils::setFilter($qb, $edu_admin, "ea", "eduAdminId", "name", "null,id,value", ExceptionMessages::InvalidEduAdminType, ExceptionCodes::InvalidEduAdminType);
        }
        
//$transfer_area================================================================
        if (Validator::Exists('transfer_area', $params)){
            CRUDUtils::setFilter($qb, $transfer_area, "ta", "transferAreaId", "name", "null,id,value", ExceptionMessages::InvalidTransferAreaType, ExceptionCodes::InvalidTransferAreaType);
        }
        
//$municipality=================================================================
        if (Validator::Exists('municipality', $params)){
            CRUDUtils::setFilter($qb, $municipality, "m", "municipalityId", "name", "null,id,value", ExceptionMessages::InvalidMunicipalityType, ExceptionCodes::InvalidMunicipalityType);
        }
        
//$prefecture===================================================================
        if (Validator::Exists('prefecture', $params)){
            CRUDUtils::setFilter($qb, $prefecture, "p", "prefectureId", "name", "null,id,value", ExceptionMessages::InvalidPrefectureType, ExceptionCodes::InvalidPrefectureType);
        }
        
//$education_level==============================================================
        if (Validator::Exists('education_level', $params)){
            CRUDUtils::setFilter($qb, $education_level, "el", "educationLevelId", "name", "null,id,value", ExceptionMessages::InvalidEducationLevelType, ExceptionCodes::InvalidEducationLevelType);
        }
        
//$school_unit_type=============================================================
        if (Validator::Exists('school_unit_type', $params)){
            CRUDUtils::setFilter($qb, $school_unit_type, "sut", "schoolUnitTypeId", "name", "null,id,value", ExceptionMessages::InvalidSchoolUnitTypeType, ExceptionCodes::InvalidSchoolUnitTypeType);
        }

//$school_unit_state============================================================
        if (Validator::Exists('school_unit_state', $params)){
            CRUDUtils::setFilter($qb, $school_unit_state, "sus", "stateId", "name", "null,id,value", ExceptionMessages::InvalidStateType, ExceptionCodes::InvalidStateType);
        } 
        
 //execution====================================================================
        
        //get count of mylabWorkers with DICTINCT value
        $qb->select('mlw.workerId')->distinct();     
        $qb->from('LabWorkers', 'lw');   
        $qb->leftjoin('lw.lab', 'l')->leftjoin('lw.worker', 'mlw')->leftjoin('lw.workerPosition', 'wp')->leftjoin('l.schoolUnit', 'su')
           ->leftjoin('l.state', 's')->leftjoin('l.labType', 'lt')->leftjoin('l.labSource', 'ls')->leftjoin('su.regionEduAdmin', 'rea')
           ->leftjoin('su.eduAdmin', 'ea')->leftjoin('su.transferArea', 'ta')->leftjoin('su.municipality', 'm')->leftjoin('su.prefecture', 'p')
           ->leftjoin('su.educationLevel', 'el')->leftjoin('su.schoolUnitType', 'sut')->leftjoin('su.state', 'sus');     
        $qb->orderBy('mlw.workerId', 'ASC');

        $query = $qb->getQuery();
        $workerResults = $query->getResult();
        $result["total"] = count($workerResults);
        
        //create array with lab_workers ids
        if ($result["total"]>0) {
            $prefix = '';$worker_ids ='';
            foreach ($workerResults as $workerResult)
            {
                $worker_ids .= $prefix . $workerResult['workerId'];
                $prefix = ', ';
            }                       
        } else {
            throw new Exception(ExceptionMessages::InvalidLabWorkerValue,ExceptionCodes::ReferencesEquipmentTypeLabEquipmentTypes);  
        }
        
 //=============================================================================
          
        $iqb = $entityManager->createQueryBuilder();
        $iqb->select('mlw.workerId,mlw.registryNo,mlw.uid,mlw.firstname,mlw.lastname,mlw.fathername,mlw.email,
                      mlwws.workerSpecializationId,mlwws.name as workerSpecializationName,
                      mlwls.labSourceId as workerLabSourceId,mlwls.name as workerLabSourceName');
        $iqb->from('MylabWorkers','mlw');
        $iqb->leftjoin('mlw.workerSpecialization', 'mlwws')->
              leftjoin('mlw.labSource', 'mlwls');
        $iqb->where($iqb->expr()->in('mlw.workerId', $worker_ids));
        $iqb->orderBy(array_search($orderby, $columns), $ordertype);
                
        $iquery = $iqb->getQuery();
          
        //pagination and results================================================      
        $iquery->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $iquery->setMaxResults($pagesize) : null;
        $iworkerResults = $iquery->getResult();  
        
        //data results==========================================================              
        $count = 0;
        foreach ($iworkerResults as $iworkerResult) { 
           $wResult[] = array ( 'worker_id' => $iworkerResult['workerId'],
                                'registry_no' => $iworkerResult['registryNo'],
                                'worker_uid' => $iworkerResult['uid'],
                                'firstname' => $iworkerResult['firstname'],
                                'lastname' => $iworkerResult['lastname'],
                                'fathername' => $iworkerResult['fathername'],
                                'email' => $iworkerResult['email'],
                                'worker_specialization_id' => $iworkerResult['workerSpecializationId'],
                                'worker_specialization_name' => $iworkerResult['workerSpecializationName'],
                                'worker_lab_source_id' => $iworkerResult['workerLabSourceId'],
                                'worker_lab_source_name' => $iworkerResult['workerLabSourceName']              
                                );
          
            $count++;
        }
        $result["data"] = $wResult;    
        $result["count"] = $count;
         //print_r($result);
        
//pagination results============================================================     
        $maxPage = Pagination::getMaxPage($result["total"],$page,$pagesize);
        $pagination = array( "page" => $page,   
                             "maxPage" => $maxPage, 
                             "pagesize" => $pagesize 
                            );    
        $result["pagination"] = $pagination;
       
//result_messages===============================================================      
        $result["status"] = ExceptionCodes::NoErrors;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".ExceptionMessages::NoErrors;
    } catch (Exception $e) {
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    
//debug=========================================================================
    
   if ( Validator::IsTrue( $params["debug"]  ) )
   {
        $result["DQL"] =  trim(preg_replace('/\s\s+/', ' ', $qb->getDQL()));
        $result["SQL"] =  trim(preg_replace('/\s\s+/', ' ', $qb->getQuery()->getSQL()));
   }

    if ($export == 'JSON'){
        return $result;
    } else if ($export == 'XLSX') {
       $xlsx_filename = FindLabWorkersExt::ExcelCreate($result);
       unset($result['data']);
       return array("result"=>$result,"tmp_xlsx_filepath" => $Options["WebTmpFolder"].$xlsx_filename);
       // exit;
    } else if ($export == 'PDF'){
       return $result;
    } else if ($export == 'PHP_ARRAY'){
       return print_r($result);
    } else {     
       return $result;
    }
    
}

?>