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
* resourcePath="/search_lab_workers",
* description="Υπεύθυνοι Διατάξεων(all_tree)",
* produces="['application/json']",
* @SWG\Api(
*   path="/search_lab_workers",
*   @SWG\Operation(
*                   method="GET",
*                   summary="Εκτεταμένη Αναζήτηση στους Υπεύθυνους Διατάξεων Η/Υ",
*                   notes="Επιστρέφει τους Υπεύθυνους Διατάξεων Η/Υ και στοιχεία για την Σχολική Μονάδα και την ίδια την Διάταξη Η/Υ που ανήκει ο Υπεύθυνος.Έχει περισσότερες παραμέτρους για εκτεταμένη αναζήτηση.",
*                   type="getSearchLabWorkers",
*                   nickname="GetSearchLabWorkers",
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
*
*   @SWG\Parameter( name="page", description="Αριθμός Σελίδας", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="pagesize", description="Αριθμός Εγγραφών/Σελίδα", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="searchtype", description="Τύπος αναζήτησης", required=false, type="string", paramType="query", enum = "['EXACT','CONTAIN','CONTAINALL','CONTAINANY','STARTWITH','ENDWITH']" ),
*   @SWG\Parameter( name="ordertype", description="Τύπος Ταξινόμησης", required=false, type="string", paramType="query", enum = "['ASC','DESC']" ),
*   @SWG\Parameter( name="orderby", description="Πεδίο Ταξινόμησης", required=false, type="string", paramType="query",
*                   enum = "['lab_worker_id','lab_id','lab','worker_id','registry_no','worker_position_id','worker_position','worker_status','worker_start_service']" ),
*   @SWG\Parameter( name="export", description="Μορφή Εξαγωγής Δεδομενων", required=false, type="string", paramType="query",
*                   enum = "['JSON','XLSX','PHP_ARRAY']" ),
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
* id="getSearchLabWorkers",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="filters",type="array",description="Οι παράμετροι(φίλτρα) της αναζήτησης που έχουν υποβληθεί"),
* @SWG\Property(name="total",type="integer",description="Το πλήθος των Υπεύθυνων Διατάξεων Η/Υ χωρίς τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="count",type="integer",description="Το πλήθος των Υπεύθυνων Διατάξεων Η/Υ της κλήσης σύμφωνα με τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="all_labs_by_type",type="array",description="Το συνολικό πλήθος ανά Διάταξη Η/Υ με βάση τυχόν φίλτρα αναζήτησης και χωρίς τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="pagination",type="array",description="Οι παράμετροι σελιδοποίησης των εγγραφών της κλήσης",items="$ref:Pagination"),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="data",type="array",description="Ο Πίνακας με τα αποτελέσματα",items="$ref:SearchLabWorker"),
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
* id="SearchLabWorker",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με τα αποτελέσματα: ",
* @SWG\Property(name="lab_worker_id",type="integer",description="Το ID του Υπεύθυνου Διατάξης Η/Υ"),
* @SWG\Property(name="worker_status",type="string",description="Η Κατάσταση του Υπεύθυνου Διατάξης Η/Υ (1=Ενεργός,3=Μη Ενεργός)"),
* @SWG\Property(name="worker_start_service",type="string",description="Ημερομηνία Αλλαγής Μετάβασης Λειτουργικής Καταστάσης Διατάξης (μορφή ημερομηνίας dd/mm/yyyy)"),
* @SWG\Property(name="worker_id",type="integer",description="Ο Κωδικός ID του Εργαζόμενου από LDAP ΠΣΔ"),
* @SWG\Property(name="registry_no",type="integer",description="Ο Α.Μ. ή το Α.Φ.Μ. Εργαζόμενου (Α.Φ.Μ = 9ψηφιο , Α.Μ. = 6ψηφιο)"),
* @SWG\Property(name="uid",type="string",description="Το μοναδικό UID όνομα του Εργαζόμενου (uid name from ldap)"),
* @SWG\Property(name="firstname",type="string",description="Το Όνομα του Εργαζόμενου"),
* @SWG\Property(name="lastname",type="string",description="Το Επώνυμο του Εργαζόμενου"),
* @SWG\Property(name="fathername",type="string",description="Το Όνομα Πατρός του Εργαζόμενου"),
* @SWG\Property(name="email",type="string",description="Το email του Εργαζόμενου"),
* @SWG\Property(name="worker_specialization_id",type="integer",description="Ο Κωδικός ID της Ειδικότητας του Εργαζόμενου"),
* @SWG\Property(name="worker_specialization",type="string",description="Το Όνομα της Ειδικότητας του Εργαζόμενου"),
* @SWG\Property(name="worker_position_id",type="integer",description="Ο Κωδικός ID της Θέσης Εργασίας του Εργαζόμενου"),
* @SWG\Property(name="worker_position",type="string",description="Το Όνομα της Θέσης Εργασίας του Εργαζόμενου"),
* @SWG\Property(name="lab_id",type="integer",description="Ο Κωδικός ID της Διάταξης Η/Υ"),
* @SWG\Property(name="lab",type="array",description="Ο Πίνακας με τα στοιχεία από τις Διατάξεις Η/Υ της Σχολικής Μονάδας",items="$ref:SearchLabWorkerLab"),
* @SWG\Property(name="school_unit",type="array",description="Ο Πίνακας με τα στοιχεία της Σχολικής Μονάδας",items="$ref:SearchLabWorkerSchoolUnit")
* )
* 
* @SWG\Model(
* id="SearchLabWorkerLab",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με δεδομένα Διατάξεων Η/Υ: ",
* @SWG\Property(name="lab_id",type="integer",description="Το ID της Διάταξης Η/Υ (mylab_id)"),
* @SWG\Property(name="lab",type="string",description="Το Όνομα της Διάταξης Η/Υ"),
* @SWG\Property(name="mmSyncId",type="integer",description="Ο Κωδικός ΜΜ της Διάταξης Η/Υ (mm_id)"),
* @SWG\Property(name="special_name",type="string",description="Το Προσωνύμιο της Διάταξης Η/Υ"),
* @SWG\Property(name="creation_date",type="string",format="date-time",description="Η Ημερομηνία Δημιουργίας της Διάταξης Η/Υ (μορφή ημερομηνίας dd/mm/yyyy hh:mm:ss)"),
* @SWG\Property(name="created_by",type="string",description="Το UID του χρήστη που Δημιούργησε την Διάταξη Η/Υ"),
* @SWG\Property(name="last_updated",type="string",format="date-time",description="Η Ημερομηνία Ενημέρωσης Στοιχείων της Διάταξης Η/Υ (μορφή ημερομηνίας dd/mm/yyyy hh:mm:ss)"),
* @SWG\Property(name="updated_by",type="string",description="Το UID του χρήστη που Ενημέρωσε την Διάταξη Η/Υ"),
* @SWG\Property(name="mmSyncLastUpdateDate",type="string",format="date-time",description="Η Ημερομηνία Συγχρονισμού Στοιχείων της Διάταξης Η/Υ με το ΜΜ (μορφή ημερομηνίας dd/mm/yyyy hh:mm:ss)"),
* @SWG\Property(name="positioning",type="string",description="Η χωροταξική θέση της Διάταξη Η/Υ (Είναι της μορφής Κτήριο: ... , Όροφος: ... , Αίθουσα: ... )"),
* @SWG\Property(name="comments",type="string",description="Πληροφορίες σε σχόλια για την Διάταξη Η/Υ"),
* @SWG\Property(name="operational_rating",type="integer",description="Η Βαθμολογία Λειτουργικής Κατάστασης της Διάταξης Η/Υ (1=αρνητική - 5=θετική)"),
* @SWG\Property(name="technological_rating",type="integer",description="Η Βαθμολογία Τεχνολογικής Κατάστασης της Διάταξης Η/Υ (1=αρνητική - 5=θετική)"),
* @SWG\Property(name="ellak",type="integer",description="Χρήση ΕΛΛΑΚ στην Διάταξη Η/Υ.Αρκεί να υπάρχουν UBUNTU LTSP στην Διάταξη Η/Υ για να χαρακτηριστει ως ΕΛΛΑΚ.(1=ΕΛΛΑΚ, 0=ΟΧΙ ΕΛΛΑΚ) "),
* @SWG\Property(name="submitted",type="integer",description="Υποβεβλημένη Διάταξη Η/Υ. Γίνεται επιβεβαίωση από τους αρμοδιους χρήστες.(1=υποβεβλημένη, 0=μη υποβεβλημένη)"),
* @SWG\Property(name="school_unit_id",type="integer",description="Ο Κωδικός ID της Σχολικής Μονάδας"),
* @SWG\Property(name="lab_type_id",type="integer",description="Ο Κωδικός ID του Τύπου Διάταξης Η/Υ"),
* @SWG\Property(name="lab_type",type="string",description="Το Όνομα του Τύπου Διάταξης Η/Υ"),
* @SWG\Property(name="lab_state_id",type="integer",description="Ο Κωδικός ID της Λειτουργικής Κατάστασης Διάταξης Η/Υ"),
* @SWG\Property(name="lab_state",type="string",description="Το Όνομα της Λειτουργικής Κατάστασης Διάταξης Η/Υ")
* )
* 
* @SWG\Model(
* id="SearchLabWorkerSchoolUnit",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με δεδομένα Σχολικής Μονάδας : ",
* @SWG\Property(name="school_unit_id",type="integer",description="Ο Κωδικός ID της Σχολικής Μονάδας"),
* @SWG\Property(name="school_unit",type="string",description="Το Όνομα της Σχολικής Μονάδας"),
* @SWG\Property(name="school_unit_state_id",type="integer",description="Ο Κωδικός ID του Λειτουργικής Κατάστασης Σχολικής Μονάδας"),
* @SWG\Property(name="school_unit_state",type="string",description="Το Όνομα της Πρωτογενούς Πηγής Δεδομένων Εργαζόμενου Σχολικής Μονάδας"),
* @SWG\Property(name="region_edu_admin_id",type="integer",description="Ο Κωδικός ID της Περιφέρειας"),
* @SWG\Property(name="region_edu_admin",type="string",description="Το Όνομα της Περιφέρειας"),
* @SWG\Property(name="edu_admin_id",type="integer",description="Ο Κωδικός ID της Διευθύνσης Εκπαίδευσης"),
* @SWG\Property(name="edu_admin",type="string",description="Το Όνομα της Διευθύνσης Εκπαίδευσης"),
* @SWG\Property(name="transfer_area_id",type="integer",description="Ο Κωδικός ID της Περιοχής Μετάθεσης"),
* @SWG\Property(name="transfer_area",type="string",description="Το Όνομα της Περιοχής Μετάθεσης"),
* @SWG\Property(name="municipality_id",type="integer",description="Ο Κωδικός ID του Δήμου"),
* @SWG\Property(name="municipality",type="string",description="Το Όνομα του Δήμου"),
* @SWG\Property(name="prefecture_id",type="integer",description="Ο Κωδικός ID του Νομού"),
* @SWG\Property(name="prefecture",type="string",description="Το Όνομα του Νομού"),
* @SWG\Property(name="education_level_id",type="integer",description="Ο Κωδικός ID του Επίπεδου Εκπαίδευσης"),
* @SWG\Property(name="education_level",type="string",description="Το Όνομα του Επίπεδου Εκπαίδευσης"),
* @SWG\Property(name="school_unit_type_id",type="integer",description="Ο Κωδικός ID του Τύπου Σχολικής Μονάδας"),
* @SWG\Property(name="school_unit_type",type="string",description="Το Όνομα του Τύπου Σχολικής Μονάδας")
* )
* 
*/

function SearchLabWorkers ( $lab_worker_id, $worker_status, $worker_start_service,
                            $lab_id, $lab_name, $submitted, $worker_position, $lab_worker, $lab_worker_uid,
                            $lab_type, $school_unit_id, $school_unit_name, $lab_state,                      
                            $region_edu_admin, $edu_admin, $transfer_area, $municipality, $prefecture,
                            $education_level, $school_unit_type, $school_unit_state, 
                            $pagesize, $page, $orderby, $ordertype, $searchtype, $export ) {

    global $db,$Options;
    global $app;
    
    $filter = array();
            
    $result = array();
    
    $result["data"] = array();
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();

    try
    {
           
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
       
//$lab_worker_id================================================================
        if ( Validator::Exists('lab_worker_id', $params) )
        {
            $table_name = "lab_workers";
            $table_column_id = "lab_worker_id";
            $table_column_name = "lab_worker_id";
            $filter_validators = 'null,id';

            $filter[] = Filters::BasicFilter( $lab_worker_id, $table_name, $table_column_id, $table_column_name, $filter_validators,
                                               ExceptionMessages::InvalidLabWorkerIDType, ExceptionCodes::InvalidLabWorkerIDType);

        }
        
//$worker_status================================================================
        if ( Validator::Exists('worker_status', $params) )
        {
            $table_name = "lab_workers";
            $table_column_id = "worker_status";
            $table_column_name = "worker_status";
            $filter_validators = 'null,numeric';

            $filter[] = Filters::BasicFilter( $worker_status, $table_name, $table_column_id, $table_column_name, $filter_validators,
                                               ExceptionMessages::InvalidLabWorkerStatusType, ExceptionCodes::InvalidLabWorkerStatusType);

        }
       
//$worker_start_service=========================================================
        if ( Validator::Exists('worker_start_service', $params) )
        {
            $table_name = "lab_workers";
            $table_column_name = "worker_start_service";
            $filter_validators = 'null,date';

            $filter[] = Filters::DateBasicFilter( $worker_start_service, $table_name, $table_column_name, $filter_validators,
                                                  ExceptionMessages::InvalidLabWorkerStartServiceType, ExceptionCodes::InvalidLabWorkerStartServiceType);

        }
        
//$lab_worker===================================================================
        if ( Validator::Exists('lab_worker', $params) )
        {
            $table_name = "mylab_workers";
            $table_column_id = "registry_no";
            $table_column_name = "lastname";
            $filter_validators = 'null,id,value';

            $filter[] = $filter_lab_workers[] = Filters::BasicFilter( $lab_worker, $table_name, $table_column_id, $table_column_name, $filter_validators, 
                                                                      ExceptionMessages::InvalidMylabWorkerType, ExceptionCodes::InvalidMylabWorkerType);           

        }  
 
//$lab_worker_uid===============================================================
        if ( Validator::Exists('lab_worker_uid', $params) )
        {

            $table_name = "mylab_workers";
            $table_column_id = "uid";
            $table_column_name = "uid";
            $filter_validators = 'value';
            
            $filter[] = Filters::BasicFilter( $lab_worker_uid, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidMylabWorkerUidType, ExceptionCodes::InvalidMylabWorkerUidType);
            
    } 
    
//$worker_position==============================================================
        if ( Validator::Exists('worker_position', $params) )
        {

            $table_name = "worker_positions";
            $table_column_id = "worker_position_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $worker_position, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidWorkerPositionType, ExceptionCodes::InvalidWorkerPositionType);
            
    }   

//$lab==========================================================================
        if ( Validator::Exists('lab_id', $params) )
        {
            $table_name = "labs";
            $table_column_id = "lab_id";
            $table_column_name = "lab_id";
            $filter_validators = 'null,id';

            $filter[] = Filters::BasicFilter( $lab_id, $table_name, $table_column_id, $table_column_name, $filter_validators,
                                               ExceptionMessages::InvalidLabIDType, ExceptionCodes::InvalidLabIDType);

        }
        
//$lab_name=====================================================================
        if ( Validator::Exists('lab_name', $params) )
        {
            $table_name = "labs";
            $table_column_name = "name";

            $filter[] =  Filters::ExtBasicFilter($lab_name, $table_name, $table_column_name, $searchtype, 
                                                 ExceptionMessages::InvalidLabNameType, ExceptionCodes::InvalidLabNameType ); 
            
        }
 
//$submitted====================================================================
        if ( Validator::Exists('submitted', $params) )
        {
            $table_name = "labs";
            $table_column_id = "submitted";
            $table_column_name = "submitted";
            $filter_validators = 'boolean';

            $filter[] = Filters::BasicFilter( $submitted, $table_name, $table_column_id, $table_column_name, $filter_validators, 
                                            ExceptionMessages::InvalidLabSubmittedType, ExceptionCodes::InvalidLabSubmittedType);

        }
        
//$lab_type=====================================================================
        if ( Validator::Exists('lab_type', $params) )
        {

            $table_name = "lab_types";
            $table_column_id = "lab_type_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $lab_type, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidLabTypeType, ExceptionCodes::InvalidLabTypeType);
            
        }
        
//$school_unit_id===============================================================
        if ( Validator::Exists('school_unit_id', $params) )
        {

            $table_name = "school_units";
            $table_column_id = "school_unit_id";
            $table_column_name = "school_unit_id";
            $filter_validators = 'null,id';
            
            $filter[] = Filters::BasicFilter( $school_unit_id, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidSchoolUnitIDType, ExceptionCodes::InvalidSchoolUnitIDType);
            
    }
        
//$school_unit_name=============================================================
        if ( Validator::Exists('school_unit_name', $params) )
        {
            $table_name = "school_units";
            $table_column_name = "name";

            $filter[] =  Filters::ExtBasicFilter($school_unit_name, $table_name, $table_column_name, $searchtype, 
                                                 ExceptionMessages::InvalidSchoolUnitNameType, ExceptionCodes::InvalidSchoolUnitNameType ); 
            
        }
    
//$lab_state====================================================================
        if ( Validator::Exists('lab_state', $params) )
        {

            $table_name = "lab_states";
            $table_column_id = "state_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $lab_state, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidStateType, ExceptionCodes::InvalidStateType);
            
        }

//$region_edu_admin=============================================================
        if ( Validator::Exists('region_edu_admin', $params) )
        {

            $table_name = "region_edu_admins";
            $table_column_id = "region_edu_admin_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $region_edu_admin, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidRegionEduAdminType, ExceptionCodes::InvalidRegionEduAdminType);
            
        }

//$edu_admin====================================================================
        if ( Validator::Exists('edu_admin', $params) )
        {

            $table_name = "edu_admins";
            $table_column_id = "edu_admin_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $edu_admin, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidEduAdminType, ExceptionCodes::InvalidEduAdminType);

        }

//$transfer_area================================================================
        if ( Validator::Exists('transfer_area', $params) )
        {
            $table_name = "transfer_areas";
            $table_column_id = "transfer_area_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $transfer_area, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidTransferAreaType, ExceptionCodes::InvalidTransferAreaType);

        }

//$municipality=================================================================
        if ( Validator::Exists('municipality', $params) )
        {
            
            $table_name = "municipalities";
            $table_column_id = "municipality_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
              
            $filter[] = Filters::BasicFilter( $municipality, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidMunicipalityType, ExceptionCodes::InvalidMunicipalityType);

        }
        
//$prefecture===================================================================
        if ( Validator::Exists('prefecture', $params) )
        {
            $table_name = "prefectures";
            $table_column_id = "prefecture_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';

            $filter[] = Filters::BasicFilter( $prefecture, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidPrefectureType, ExceptionCodes::InvalidPrefectureType);

        }

//$education_level==============================================================
        if ( Validator::Exists('education_level', $params) )
        {
            $table_name = "education_levels";
            $table_column_id = "education_level_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $education_level, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidEducationLevelType, ExceptionCodes::InvalidEducationLevelType);

        }
        
//$school_unit_type=============================================================
        if ( Validator::Exists('school_unit_type', $params) )
        {
            $table_name = "school_unit_types";
            $table_column_id = "school_unit_type_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $school_unit_type, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidSchoolUnitTypeType, ExceptionCodes::InvalidSchoolUnitTypeType);
            
        }     
        
//$school_unit_state============================================================
        if ( Validator::Exists('school_unit_state', $params) )
        {
            $table_name = "school_unit_states";
            $table_column_id = "state_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $school_unit_state, $table_name, $table_column_id, $table_column_name, $filter_validators, 
                                              ExceptionMessages::InvalidStateType, ExceptionCodes::InvalidStateType);

        }
        
//$orderby======================================================================
        if ( Validator::Exists('orderby', $params) )
        {
            $columns = array(
                "lab_worker_id",
                "lab_id", "lab",
                "worker_id", "registry_no",
                "worker_position_id", "worker_position",
                "worker_status", "worker_start_service"
            );

            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        }
        else
            $orderby = "lab_worker_id";

//==============================================================================
//= E X E C U T E
//==============================================================================

//Registered Labs and User permissions==========================================
//
        //set registered labs only available for ΔΙΕΥΘΥΝΤΗΣ/ΔΙΕΥΘΥΝΤΗΣ
            if ( Validator::Missing('submitted', $params) ){                        
                $user_role= CheckUserRole::getRole($app->request->user)['max_role'];
                if ( $user_role == 'ΔΙΕΥΘΥΝΤΗΣ' ||  $user_role == 'ΤΟΜΕΑΡΧΗΣ' ){
                    $filter[] = '(labs.submitted = 1 OR labs.submitted = 0)';
                } else {
                    $filter[] = 'labs.submitted = 1';
                }
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
       
       $sqlSelect = "SELECT 
                        lab_workers.lab_worker_id,
                        lab_workers.worker_status,
                        lab_workers.worker_start_service,
                        mylab_workers.worker_id,
                        mylab_workers.registry_no,
                        mylab_workers.uid,
                        mylab_workers.firstname,
                        mylab_workers.lastname,
                        mylab_workers.fathername,
                        mylab_workers.email,
                        worker_specializations.worker_specialization_id,
                        worker_specializations.name as worker_specialization,
                        worker_positions.worker_position_id,
                        worker_positions.name as worker_position,     
                        labs.lab_id,
                        labs.name as lab,
                        labs.mmSyncId,
                        labs.special_name,
                        labs.creation_date,
                        labs.created_by,
                        labs.last_updated,
                        labs.updated_by,
                        labs.positioning,
                        labs.comments,
                        labs.operational_rating,
                        labs.technological_rating,
                        labs.ellak,
                        labs.submitted,
                        lab_types.lab_type_id, 
                        lab_types.name as lab_type, 
                        lab_states.state_id as lab_state_id, 
                        lab_states.name as lab_state_name,
                        school_units.school_unit_id, 
                        school_units.name as school_unit,                                
                        school_unit_states.state_id as school_unit_state_id, 
                        school_unit_states.name as school_unit_state_name,
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

        $sqlFrom = "FROM lab_workers
                                LEFT JOIN labs using (lab_id)
                                LEFT JOIN mylab_workers using (worker_id)
                                LEFT JOIN worker_positions using (worker_position_id)
                                LEFT JOIN worker_specializations ON mylab_workers.worker_specialization_id = worker_specializations.worker_specialization_id
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
        $sqlOrder = " ORDER BY ". $orderby ." ". $ordertype;
        $sqlLimit = ($page && $pagesize) ? " LIMIT ".(($page - 1) * $pagesize).", ".$pagesize : "";

        $result["filters"] = $filter ? $filter : null;
        //#############find total total lab_workers without filter of limits(page and pagesize)
        $sql = "SELECT count(lab_workers.lab_worker_id) as total_lab_workers " . $sqlFrom . $sqlWhere . $sqlPermissions;
        //echo "<br><br>".$sql."<br><br>";

        $stmt = $db->query( $sql );
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        $result["total"] = $rows["total_lab_workers"];
        
        //check if $page input from user, is valid
        $maxPage = Pagination::getMaxPage($rows["total_lab_workers"], $page, $pagesize);
        
        //#############find count lab_workers with filter of limits(page and pagesize)
        $sql = $sqlSelect . $sqlFrom . $sqlWhere . $sqlPermissions . $sqlOrder . $sqlLimit ;
        //echo "<br><br>".$sql."<br><br>";

        $stmt = $db->query( $sql );
        $array_lab_workers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result["count"] = $stmt->rowCount();
     
       
        //create array with lab_workers,labs,school_units ids
        if (count($array_lab_workers)>0){
            $prefix = '';
            $worker_ids = '';
            $lab_ids = '';
            $school_unit_ids = '';
            
            foreach ($array_lab_workers as $array_lab_worker)
            {
                $worker_ids .= $prefix . '"' . $array_lab_worker["worker_id"] . '"';
                $lab_ids .= $prefix . '"' . $array_lab_worker["lab_id"] . '"';
                $school_unit_ids .= $prefix . '"' . $array_lab_worker["school_unit_id"] . '"';
                $prefix = ', ';
            }                       
        } else {
            $worker_ids = "0";
            $lab_ids = "0";
            $school_unit_ids = "0";
        }
                
        //find lab types per school unit       
        $result["all_labs_by_type"] = Filters::AllLabsCounter($sqlFrom,$sqlWhere,$sqlPermissions);

        $school_unit_ids = Validator::ToUniqueString($school_unit_ids);
                  
//==============================================================================
//= R E S U L T S
//==============================================================================
        
        foreach ($array_lab_workers as $lab_worker)
        {
            $data = array(
                "lab_worker_id"             => $lab_worker["lab_worker_id"] ? (int)$lab_worker["lab_worker_id"] : null,                
                "worker_status"             => $lab_worker["worker_status"] ? (int)$lab_worker["worker_status"] : null,
                "worker_start_service"      => $lab_worker["worker_start_service"],
                "worker_id"                 => $lab_worker["worker_id"] ? (int)$lab_worker["worker_id"] : null,
                "registry_no"               => $lab_worker["registry_no"],
                "uid"                       => $lab_worker["uid"],
                "firstname"                 => $lab_worker["firstname"] ,
                "lastname"                  => $lab_worker["lastname"] ,
                "fathername"                => $lab_worker["fathername"] ,
                "email"                     => $lab_worker["email"],
                "worker_specialization_id"  => $lab_worker["worker_specialization_id"],
                "worker_specialization"     => $lab_worker["worker_specialization"] ,
                "worker_position_id"        => $lab_worker["worker_position_id"] ,
                "worker_position"           => $lab_worker["worker_position"],
                
            );
            
                //$array_lab
                $data["lab"][] = array(
                    "lab_id"                    => $lab_worker["lab_id"] ? (int)$lab_worker["lab_id"] : null,
                    "lab"                       => $lab_worker["lab"],
                    "mmSyncId"                  => $lab_worker["mmSyncId"],
                    "special_name"              => $lab_worker["special_name"],
                    "creation_date"             => $lab_worker["creation_date"],
                    "created_by"                => $lab_worker["created_by"],
                    "last_updated"              => $lab_worker["last_updated"] ,
                    "updated_by"                => $lab_worker["updated_by"] ,
                    "positioning"               => $lab_worker["positioning"] ,
                    "comments"                  => $lab_worker["comments"] ,
                    "operational_rating"        => $lab_worker["operational_rating"],
                    "technological_rating"      => $lab_worker["technological_rating"],
                    "ellak"                     => $lab_worker["ellak"] ,
                    "submitted"                 => $lab_worker["submitted"] ,
                    "lab_type_id"               => $lab_worker["lab_type_id"],
                    "lab_type"                  => $lab_worker["lab_type"] ,
                    "lab_state_id"              => $lab_worker["lab_state_id"]? (int)$lab_worker["lab_state_id"] : null,
                    "lab_state"                 => $lab_worker["lab_state_name"],
                );

                //$array_school_unit
                $data["school_unit"][] = array(
                    "school_unit_id"            => $lab_worker["school_unit_id"]? (int)$lab_worker["school_unit_id"] : null,
                    "school_unit"               => $lab_worker["school_unit"] ,
                    "school_unit_state_id"      => $lab_worker["school_unit_state_id"]? (int)$lab_worker["school_unit_state_id"] : null,
                    "school_unit_state"         => $lab_worker["school_unit_state_name"],         
                    "region_edu_admin_id"       => $lab_worker["region_edu_admin_id"] ? (int)$lab_worker["region_edu_admin_id"] : null,
                    "region_edu_admin"          => $lab_worker["region_edu_admin"],
                    "edu_admin_id"              => $lab_worker["edu_admin_id"] ? (int)$lab_worker["edu_admin_id"] : null,
                    "edu_admin"                 => $lab_worker["edu_admin"],
                    "transfer_area_id"          => $lab_worker["transfer_area_id"] ? (int)$lab_worker["transfer_area_id"] : null,
                    "transfer_area"             => $lab_worker["transfer_area"],
                    "prefecture_id"             => $lab_worker["prefecture_id"] ? (int)$lab_worker["prefecture_id"] : null,
                    "prefecture"                => $lab_worker["prefecture"],
                    "municipality_id"           => $lab_worker["municipality_id"] ? (int)$lab_worker["municipality_id"] : null,
                    "municipality"              => $lab_worker["municipality"],
                    "education_level_id"        => $lab_worker["education_level_id"] ? (int)$lab_worker["education_level_id"] : null,
                    "education_level"           => $lab_worker["education_level"],
                    "school_unit_type_id"       => $lab_worker["school_unit_type_id"] ? (int)$lab_worker["school_unit_type_id"] : null,
                    "school_unit_type"          => $lab_worker["school_unit_type"]
                );  
            
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
        $xlsx_filename = SearchLabWorkersExt::ExcelCreate($result);
        unset($result['data']);
        return array("result"=>$result,"tmp_xlsx_filepath" => $Options["WebTmpFolder"].$xlsx_filename);
        //exit;
    } else if ($export == 'PDF'){
       return $result;
    } else if ($export == 'PHP_ARRAY'){
       return print_r($result);
    } else {     
       return $result;
    }

}
?>