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
* resourcePath="/search_labs",
* description="Διατάξεις Η/Υ(all_tree)",
* produces="['application/json']",
* @SWG\Api(
*   path="/search_labs",
*   @SWG\Operation(
*                   method="GET",
*                   summary="Εκτεταμένη Αναζήτηση στις Διατάξεις Η/Υ",
*                   notes="Επιστρέφει τις Διατάξεις Η/Υ και τα στοιχεία τους.Έχει περισσότερες παραμέτρους για εκτεταμένη αναζήτηση.",
*                   type="getSearchLabs",
*                   nickname="GetSearchLabs",
* 
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
*   @SWG\Parameter( name="school_unit_id", description="ID Σχολικής Μονάδας", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="school_unit_name", description="Όνομα Σχολικής Μονάδας (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="school_unit_special_name", description="Προσωνύμιο Σχολικής Μονάδας (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="aquisition_source", description="Όνομα ή ID Πηγής Χρηματοδότησης", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="equipment_type", description="Όνομα ή ID Τύπου Εξοπλισμού", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="lab_worker", description="Επίθετο ή Α.Μ. Υπεύθυνου Διατάξης Η/Υ", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="region_edu_admin", description="Όνομα ή ID Περιφέρειας", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="edu_admin", description="Όνομα ή ID Διευθύνσης Εκπαίδευσης", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="transfer_area", description="Όνομα ή ID Περιοχής Μετάθεσης", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="municipality", description="Όνομα ή ID Δήμου", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="prefecture", description="Όνομα ή ID Νομού", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="education_level", description="Όνομα ή ID Επίπεδου Εκπαίδευσης", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="school_unit_type", description="Όνομα ή ID Τύπου Σχολικής Μονάδας", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="school_unit_state", description="Όνομα ή ID Λειτουργικής Κατάστασης Σχολικής Μονάδας", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="page", description="Αριθμός Σελίδας", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="pagesize", description="Αριθμός Εγγραφών/Σελίδα", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="searchtype", description="Τύπος αναζήτησης", required=false, type="string", paramType="query", enum = "['EXACT','CONTAIN','CONTAINALL','CONTAINANY','STARTWITH','ENDWITH']" ),
*   @SWG\Parameter( name="ordertype", description="Τύπος Ταξινόμησης", required=false, type="string", paramType="query", enum = "['ASC','DESC']" ),
*   @SWG\Parameter( name="orderby", description="Πεδίο Ταξινόμησης", required=false, type="string", paramType="query",
*                   enum = "['lab_id','lab_name','lab_special_name','creation_date','operational_rating','technological_rating',
                             'lab_type_id','lab_type','school_unit_id','school_unit_name','lab_state_id','lab_state','lab_source_id','lab_source']" ),
*   @SWG\Parameter( name="export", description="Μορφή Εξαγωγής Δεδομενων", required=false, type="string", paramType="query",
*                   enum = "['JSON','XLSX','PHP_ARRAY']" ),
*   @SWG\Parameter( name="debug", description="Επιστροφή SQL/DQL Queries", required=false, type="boolean", paramType="query", enum = "['true','false']" ),  
* 
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionsError, message=ExceptionMessages::NoPermissionsError),
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
* id="getSearchLabs",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="filters",type="array",description="Οι παράμετροι(φίλτρα) της αναζήτησης που έχουν υποβληθεί"),
* @SWG\Property(name="total",type="integer",description="Το πλήθος των Διατάξεων Η/Υ χωρίς τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="count",type="integer",description="Το πλήθος των Διατάξεων Η/Υ της κλήσης σύμφωνα με τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="all_labs_by_type",type="array",description="Το συνολικό πλήθος ανά Διάταξη Η/Υ με βάση τυχόν φίλτρα αναζήτησης και χωρίς τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="pagination",type="array",description="Οι παράμετροι σελιδοποίησης των εγγραφών της κλήσης",items="$ref:Pagination"),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="data",type="array",description="Ο Πίνακας με τα αποτελέσματα",items="$ref:SearchLab"),
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
* id="SearchLab",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με δεδομένα Διατάξεων Η/Υ: ",
* @SWG\Property(name="lab_id",type="integer",description="Το ID της Διάταξης Η/Υ (mylab_id)"),
* @SWG\Property(name="lab_name",type="string",description="Το Όνομα της Διάταξης Η/Υ"),
* @SWG\Property(name="mmSyncId",type="integer",description="Ο Κωδικός ΜΜ της Διάταξης Η/Υ (mm_id)"),
* @SWG\Property(name="lab_special_name",type="string",description="Το Προσωνύμιο της Διάταξης Η/Υ"),
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
* @SWG\Property(name="lab_type_id",type="integer",description="Ο Κωδικός ID του Τύπου Διάταξης Η/Υ"),
* @SWG\Property(name="lab_type",type="string",description="Το Όνομα του Τύπου Διάταξης Η/Υ"),
* @SWG\Property(name="school_unit_id",type="integer",description="Ο Κωδικός ID της Σχολικής Μονάδας"),
* @SWG\Property(name="school_unit_name",type="string",description="Το Όνομα της Σχολικής Μονάδας"),
* @SWG\Property(name="school_unit_special_name",type="string",description="Το Προσωνύμιο της Σχολικής Μονάδας"),
* @SWG\Property(name="lab_source_id",type="integer",description="Ο Κωδικός ID της Πρωτογενής Πηγής Δεδομένων Διάταξης Η/Υ"),
* @SWG\Property(name="lab_source",type="string",description="Το Όνομα της Πρωτογενής Πηγής Δεδομένων Διάταξης Η/Υ"), 
* @SWG\Property(name="lab_state_id",type="integer",description="Ο Κωδικός ID της Λειτουργικής Κατάστασης Διάταξης Η/Υ"),
* @SWG\Property(name="lab_state",type="string",description="Το Όνομα της Λειτουργικής Κατάστασης Διάταξης Η/Υ"),
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
* @SWG\Property(name="school_unit_type",type="string",description="Το Όνομα του Τύπου Σχολικής Μονάδας"),
* @SWG\Property(name="aquisition_sources",type="array",description="Ο Πίνακας με τα στοιχεία από τις Πηγές Χρηματοδότησης της Διάταξης Η/Υ",items="$ref:SearchLabLabAquisitionSource"),
* @SWG\Property(name="equipment_types",type="array",description="Ο Πίνακας με τα στοιχεία από τον Εξοπλισμό της Διάταξης Η/Υ",items="$ref:SearchLabLabEquipmentType"),
* @SWG\Property(name="lab_workers",type="array",description="Ο Πίνακας με τα στοιχεία από τους Εργαζόμενους της Διάταξης Η/Υ",items="$ref:SearchLabLabWorker"),
* @SWG\Property(name="lab_relations",type="array",description="Ο Πίνακας με τα στοιχεία από τις Συσχετίσεις της Διάταξης Η/Υ με Σχολικές Μονάδες",items="$ref:SearchLabLabRelation"),
* @SWG\Property(name="lab_transitions",type="array",description="Ο Πίνακας με τα στοιχεία από τις Καταστάσεις Μεταβάσεων της Διάταξης Η/Υ",items="$ref:SearchLabLabTransition"),
* @SWG\Property(name="school_unit_worker",type="array",description="Ο Πίνακας με τα στοιχεία από τους Εργαζόμενους της Σχολικής Μονάδας",items="$ref:SearchLabSchoolUnitWorker"),
* @SWG\Property(name="school_circuits",type="array",description="Ο Πίνακας με τα στοιχεία από τα Τηλεπικοινωνιακά Κυκλώματα της Σχολικής Μονάδας",items="$ref:SearchLabSchoolCircuit")
* )
*
* @SWG\Model(
* id="SearchLabLabAquisitionSource",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με δεδομένα των Πηγών Χρηματοδότησης : ",
* @SWG\Property(name="lab_aquisition_source_id",type="integer",description="Ο Κωδικός ID της Διάταξης Η/Υ με Πηγή Χρηματοδότησης"),
* @SWG\Property(name="lab_id",type="integer",description="Ο Κωδικός ID της Διάταξης Η/Υ"),
* @SWG\Property(name="aquisition_source_id",type="integer",description="Ο Κωδικός ID της Πηγής Χρηματοδότησης"),
* @SWG\Property(name="aquisition_year",type="string",description="To Έτος Απόκτησης της Πηγής Χρηματοδότησης για την Διάταξη Η/Υ (μορφή yyyy ή null)"),
* @SWG\Property(name="aquisition_comments",type="string",description="Σχόλια και Πληροφορίες σχετικά με την Πηγή Χρηματοδότησης για την Διάταξη Η/Υ "),
* @SWG\Property(name="aquisition_source",type="string",description="Το Όνομα της Πηγής Χρηματοδότησης")
* ) 
*
* @SWG\Model(
* id="SearchLabLabEquipmentType",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με στοιχεία του πίνακα lab_equipment_types : ",
* @SWG\Property(name="lab_id",type="integer",description="Ο Κωδικός ID της Διάταξης Η/Υ"),
* @SWG\Property(name="equipment_type_id",type="integer",description="Ο Κωδικός ID του Εξοπλισμού"),
* @SWG\Property(name="items",type="integer",description="Το πλήθος του Εξοπλισμού"),
* @SWG\Property(name="equipment_type",type="string",description="Το Όνομα του Εξοπλισμού"),
* @SWG\Property(name="equipment_category_id",type="integer",description="Ο Κωδικός ID της Κατηγορίας Εξοπλισμού"),
* @SWG\Property(name="equipment_category",type="string",description="Το Όνομα της Κατηγορίας Εξοπλισμού")
* )
*
* @SWG\Model(
* id="SearchLabLabWorker",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με δεδομένα των υπεύθυνων Διατάξεων Η/Υ : ",
* @SWG\Property(name="lab_worker_id",type="integer",description="Το ID του Υπεύθυνου Διατάξης Η/Υ"),
* @SWG\Property(name="lab_id",type="integer",description="Ο Κωδικός ID της Διάταξης Η/Υ"),
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
* @SWG\Property(name="worker_position",type="string",description="Το Όνομα της Θέσης Εργασίας του Εργαζόμενου")
* )
*
* @SWG\Model(
* id="SearchLabLabRelation",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με δεδομένα από τις Συσχετίσεις: ",
* @SWG\Property(name="lab_relation_id",type="integer",description="Ο Κωδικός ID της Συσχέτισης Διατάξεων Η/Υ - Μονάδων"),
* @SWG\Property(name="lab_id",type="integer",description="Ο Κωδικός ID της Διάταξης Η/Υ"),
* @SWG\Property(name="school_unit_id",type="integer",description=" Ο Κωδικός ID της Σχολικής Μονάδας"),
* @SWG\Property(name="relation_type_id",type="integer",description="Ο Κωδικός ID του Τύπου Συσχέτισης Διατάξεων Η/Υ - Μονάδων"),
* @SWG\Property(name="relation_type",type="string",description="Το Όνομα του Τύπου Συσχέτισης Διατάξεων Η/Υ - Μονάδων"),
* @SWG\Property(name="circuit_id",type="integer",description="Ο Κωδικός ID του του Τηλεπικοινωνιακού Κυκλώματος"),
* @SWG\Property(name="phone_number",type="integer",description="Ο Τηλεφωνικός Αριθμός του Τηλεπικοινωνιακού Κυκλώματος")
* )
* 
* @SWG\Model(
* id="SearchLabLabTransition",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με με δεδομένα από τις Καταστάσεις Μεταβάσεων: ",
* @SWG\Property(name="lab_transition_id",type="integer",description="Ο Κωδικός ID της Λειτουργικής Καταστάσης Διατάξης"),
* @SWG\Property(name="lab_id",type="integer",description="Ο Κωδικός ID της Διάταξης Η/Υ"),
* @SWG\Property(name="from_state",type="integer",description="Ο Κωδικός ID της Προηγούμενης Λειτουργικής Καταστάσης"),
* @SWG\Property(name="to_state",type="string",description="Ο Κωδικός ID της Τρέχουσας Λειτουργικής Καταστάσης"),
* @SWG\Property(name="transition_date",type="string",description="Η Ημερομηνία Μετάβασης Λειτουργικής Καταστάσης Διατάξης (μορφή ημερομηνίας dd/mm/yyyy)"),
* @SWG\Property(name="transition_source",type="string",description="Η Πηγή Αλλαγής Μετάβασης Λειτουργικής Καταστάσης Διατάξης (τιμές mylab ή mmsch)"),
* @SWG\Property(name="transition_justification",type="string",description="Η αιτιολογία Αλλαγής Μετάβασης Λειτουργικής Καταστάσης Διατάξης"),
* @SWG\Property(name="from_state_id",type="integer",description="Ο Κωδικός ID της Προηγούμενης Λειτουργικής Καταστάσης"),
* @SWG\Property(name="from_state_name",type="string",description="To Όνομα Προηγούμενης Λειτουργικής Καταστάσης"),
* @SWG\Property(name="to_state_id",type="string",description="Ο Κωδικός ID της Τρέχουσας Λειτουργικής Καταστάσης"),
* @SWG\Property(name="to_state_name",type="string",description="To Όνομα Τρέχουσας Λειτουργικής Καταστάσης")
* )
* 
* @SWG\Model(
* id="SearchLabSchoolUnitWorker",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με δεδομένα Εργαζόμενων : ",
* @SWG\Property(name="school_unit_worker_id",type="integer",description="Το ID του Υπεύθυνου Σχολικής Μονάδας"),
* @SWG\Property(name="school_unit_id",type="integer",description="Ο Κωδικός ID της Σχολικής Μονάδας"),
* @SWG\Property(name="worker_id",type="integer",description="Ο Κωδικός ID του Εργαζόμενου από Μητρώο Μονάδων"),
* @SWG\Property(name="registry_no",type="integer",description="Ο Α.Μ. του Εργαζόμενου"),
* @SWG\Property(name="tax_number",type="integer",description="Το Α.Φ.Μ. του Εργαζόμενου"),
* @SWG\Property(name="firstname",type="string",description="Το Όνομα του Εργαζόμενου"),
* @SWG\Property(name="lastname",type="string",description="Το Επώνυμο του Εργαζόμενου"),
* @SWG\Property(name="fathername",type="string",description="Το Όνομα Πατρός του Εργαζόμενου"),
* @SWG\Property(name="sex",type="string",description="Το Φύλο του Εργαζόμενου (Α=Άντρας,Γ=Γυναίκα)"),
* @SWG\Property(name="worker_specialization_id",type="integer",description="Ο Κωδικός ID της Ειδικότητας του Εργαζόμενου"),
* @SWG\Property(name="worker_specialization",type="string",description="Το Όνομα της Ειδικότητας του Εργαζόμενου"),
* @SWG\Property(name="worker_position_id",type="integer",description="Ο Κωδικός ID της Θέσης Εργασίας του Εργαζόμενου"),
* @SWG\Property(name="worker_position",type="string",description="Το Όνομα της Θέσης Εργασίας του Εργαζόμενου")
* )
*  
* @SWG\Model(
* id="SearchLabSchoolCircuit",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με δεδομένα Τηλεπικοινωνιακών Κυκλωμάτων : ",
* @SWG\Property(name="circuit_id",type="integer",description="Ο Κωδικός ID του Τηλεπικοινωνιακού Κυκλώματος"),
* @SWG\Property(name="phone_number",type="integer",description="Ο Τηλεφωνικός Αριθμός του Τηλεπικοινωνιακού Κυκλώματος"),
* @SWG\Property(name="updated_date",type="string",description="Η Ημερομηνία Ενημέρωσης του Τηλεπικοινωνιακού Κυκλώματος (μορφή dd/mm/yyyy hh:mm:ss)"),
* @SWG\Property(name="status",type="boolean",description="Λειτουργική κατάσταση Ενεργό ή Ανενεργό Τηλεπικοινωνιακού Κυκλώματος (true = ενεργό , false = ανενεργό)"),
* @SWG\Property(name="school_unit_id",type="integer",description=" Ο Κωδικός ID της Σχολικής Μονάδας"),
* @SWG\Property(name="circuit_type_id",type="integer",description=" Ο Κωδικός ID του Τύπου του Τηλεπικοινωνιακού Κυκλώματος"),
* @SWG\Property(name="circuit_type",type="string",description="Το Όνομα του Τύπου του Τηλεπικοινωνιακού Κυκλώματος")
* )
* 
*/

function SearchLabs ( $lab_id, $lab_name, $lab_special_name, $creation_date, $operational_rating, $technological_rating, $submitted,
                      $lab_type, $school_unit_id, $school_unit_name, $school_unit_special_name, $lab_state, $lab_source,
                      $aquisition_source, $equipment_type, $lab_worker,
                      $region_edu_admin, $edu_admin, $transfer_area, $municipality, $prefecture,
                      $education_level, $school_unit_type, $school_unit_state, 
                      $pagesize, $page, $orderby, $ordertype, $searchtype, $export ) {

    global $db,$Options;
    global $app;
    
    $filter = array();
    $filter_aquisition_sources = array();
    $filter_equipment_types = array();
    $filter_lab_relations = array();
    $filter_lab_transitions = array();         
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
       
//$lab_id=======================================================================
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
        
//$lab_special_name=============================================================
        if ( Validator::Exists('lab_special_name', $params) )
        {
            $table_name = "labs";
            $table_column_name = "special_name";

            $filter[] =  Filters::ExtBasicFilter($lab_special_name, $table_name, $table_column_name, $searchtype, 
                                                 ExceptionMessages::InvalidLabSpecialNameType, ExceptionCodes::InvalidLabSpecialNameType ); 
            
        }

//$creation_date================================================================
        if ( Validator::Exists('creation_date', $params) )
        {
            $table_name = "labs";
            $table_column_name = "creation_date";
            $filter_validators = 'null,date';

            $filter[] =  Filters::DateBasicFilter($creation_date, $table_name, $table_column_name, $filter_validators, 
                                                 ExceptionMessages::InvalidLabCreationDateType, ExceptionCodes::InvalidLabCreationDateType ); 
            
        }

//$operational_rating===========================================================
        if ( Validator::Exists('operational_rating', $params) )
        {
            $table_name = "labs";
            $table_column_id = "operational_rating";
            $table_column_name = "operational_rating";
            $filter_validators = 'null,numeric';
            
            $filter[] = Filters::BasicFilter( $operational_rating, $table_name, $table_column_id, $table_column_name, $filter_validators, 
                                                               ExceptionMessages::InvalidLabOperationalRatingType, ExceptionCodes::InvalidLabOperationalRatingType);

        }

//$technological_rating=========================================================
        if ( Validator::Exists('technological_rating', $params) )
        {
            $table_name = "labs";
            $table_column_id = "technological_rating";
            $table_column_name = "technological_rating";
            $filter_validators = 'null,numeric';

            $filter[] = Filters::BasicFilter( $technological_rating, $table_name, $table_column_id, $table_column_name, $filter_validators, 
                                                               ExceptionMessages::InvalidLabTechnologicalRatingType, ExceptionCodes::InvalidLabTechnologicalRatingType);

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
            $table_column_name = "name";
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
 
//$school_unit_special_name===================================================== 
        if ( Validator::Exists('school_unit_special_name', $params) )
        {
            $table_name = "school_units";
            $table_column_name = "special_name";

            $filter[] =  Filters::ExtBasicFilter($school_unit_special_name, $table_name, $table_column_name, $searchtype, 
                                                 ExceptionMessages::InvalidLabSpecialNameType, ExceptionCodes::InvalidLabSpecialNameType ); 
            
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
        

//$lab_source=================================================================== 
        if ( Validator::Exists('lab_source', $params) )
        {

            $table_name = "lab_sources";
            $table_column_id = "lab_source_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $lab_source, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidLabSourceType, ExceptionCodes::InvalidLabSourceType);
            
        }
 
//$aquisition_sou=============================================================== 
        if ( Validator::Exists('aquisition_source', $params) )
        {
            $table_name = "aquisition_sources";
            $table_column_id = "aquisition_source_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';

            $filter[] = $filter_aquisition_sources[] = Filters::BasicFilter( $aquisition_source, $table_name, $table_column_id, $table_column_name, $filter_validators, 
                                                                              ExceptionMessages::InvalidAquisitionSourceType, ExceptionCodes::InvalidAquisitionSourceType);      

        }
 
//$equipment_type=============================================================== 
        if ( Validator::Exists('equipment_type', $params) )
        {
            $table_name = "equipment_types";
            $table_column_id = "equipment_type_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';

            $filter[] = $filter_equipment_types[] = Filters::BasicFilter( $equipment_type, $table_name, $table_column_id, $table_column_name, $filter_validators, 
                                                                          ExceptionMessages::InvalidEquipmentTypeType, ExceptionCodes::InvalidEquipmentTypeType);      

        }
 
//$lab_worker=================================================================== 
        if ( Validator::Exists('lab_worker', $params) )
        {
            $table_name = "mylab_workers";
            $table_column_id = "registry_no";
            $table_column_name = "lastname";
            $filter_validators = 'null,id,value';

            $filter[] = $filter_lab_workers[] = Filters::BasicFilter( $lab_worker, $table_name, $table_column_id, $table_column_name, $filter_validators, 
                                                                      ExceptionMessages::InvalidLabWorkerType, ExceptionCodes::InvalidLabWorkerType);           

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

//==============================================================================
//= E X E C U T E
//==============================================================================
       
//Registered Labs and User permissions==========================================
        
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
                     DISTINCT   labs.lab_id,
                                labs.name as lab_name,
                                labs.mmSyncId,
                                labs.special_name as lab_special_name,
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
                                school_units.school_unit_id, 
                                school_units.name as school_unit_name,
                                school_units.special_name as school_unit_special_name,
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
                                LEFT JOIN mylab_workers ON lab_workers.worker_id=mylab_workers.worker_id
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

        $result["filters"] = $filter ? $filter : null;
        //#############find total total labs without filter of limits(page and pagesize)
        $sql = "SELECT count(DISTINCT labs.lab_id) as total_labs " . $sqlFrom . $sqlWhere . $sqlPermissions ;
        //echo "<br><br>".$sql."<br><br>";die();

        $stmt = $db->query( $sql );
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        $result["total"] = $rows["total_labs"];
        
        //check if $page input from user, is valid
        $maxPage = Pagination::getMaxPage($rows["total_labs"], $page, $pagesize);
        
        //#############find count labs with filter of limits(page and pagesize)
        $sql = $sqlSelect . $sqlFrom . $sqlWhere . $sqlPermissions . $sqlOrder . $sqlLimit ;
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
        $result["all_labs_by_type"] = Filters::AllLabsCounter($sqlFrom,$sqlWhere,$sqlPermissions);
        
        $school_unit_ids = Validator::ToUniqueString($school_unit_ids);
        
//==============================================================================
//= $array_lab_aquisition_sources
//==============================================================================

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
    
//==============================================================================
//= $array_lab_equipment_types
//==============================================================================

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
        
//==============================================================================
//= $array_lab_workers
//==============================================================================

        $sqlSelect = "SELECT
                        lab_workers.lab_worker_id,
                        lab_workers.lab_id,
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
                        worker_positions.name as worker_position
                     ";

        $sqlFrom   = "FROM lab_workers
                      LEFT JOIN worker_positions using (worker_position_id)
                      LEFT JOIN mylab_workers using (worker_id)
                      LEFT JOIN worker_specializations ON mylab_workers.worker_specialization_id = worker_specializations.worker_specialization_id
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
        
//==============================================================================
//= $array_lab_relations
//==============================================================================

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

//==============================================================================
//= $array_lab_transitions
//==============================================================================

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


//==============================================================================
//= $array_school_units_workers
//==============================================================================
        
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
        
//==============================================================================
//= $array_circuits
//==============================================================================

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
        
//==============================================================================
//= R E S U L T S
//==============================================================================
        
        foreach ($array_labs as $lab)
        {
            $data = array(
                "lab_id"                    => $lab["lab_id"] ? (int)$lab["lab_id"] : null,
                "lab_name"                  => $lab["lab_name"],
                "mmSyncId"                  => $lab["mmSyncId"],
                "lab_special_name"          => $lab["lab_special_name"],
                "creation_date"             => $lab["creation_date"],
                "created_by"                => $lab["created_by"],
                "last_updated"              => $lab["last_updated"] ,
                "updated_by"                => $lab["updated_by"] ,
                "positioning"               => $lab["positioning"] ,
                "comments"                  => $lab["comments"] ,
                "operational_rating"        => $lab["operational_rating"],
                "technological_rating"      => $lab["technological_rating"],
                "ellak"                     => $lab["ellak"] ,
                "submitted"                 => $lab["submitted"] ,
                "lab_type_id"               => $lab["lab_type_id"],
                "lab_type"                  => $lab["lab_type"] ,
                "school_unit_id"            => $lab["school_unit_id"]? (int)$lab["school_unit_id"] : null,
                "school_unit_name"          => $lab["school_unit_name"] ,
                "school_unit_special_name"  => $lab["school_unit_special_name"],
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
                $data["aquisition_sources"] = null;
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
                $data["equipment_types"] = null;
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
                $data["lab_workers"] = null;
                 foreach ($lab_workers[ $lab["lab_id"] ] as $lab_worker)
                {
                    $data["lab_workers"][] = array(
                        "lab_worker_id"             => $lab_worker["lab_worker_id"] ? (int)$lab_worker["lab_worker_id"] : null,
                        "lab_id"                    => $lab_worker["lab_id"],
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
                        "worker_position"           => $lab_worker["worker_position"]
                    );
                }
            
                //$array_lab_relations
                $data["lab_relations"] = null;
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
                $data["lab_transitions"] = null;
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
            $data["school_unit_worker"] = null;
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
                
            $data["school_circuits"] = null;
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

   if ( Validator::IsTrue( $params["debug"]  ) )
   {
        $result["sql"] =  trim(preg_replace('/\s\s+/', ' ', $sql));
    }
    
    if ($export == 'JSON'){
        return $result;
    } else if ($export == 'XLSX') {
       $xlsx_filename = SearchLabsExt::ExcelCreate($result);
       unset($result['data']);
       return array("result"=>$result,"tmp_xlsx_filepath" => $Options["WebTmpFolder"].$xlsx_filename);
    } else if ($export == 'PDF'){
       return $result;
    } else if ($export == 'PHP_ARRAY'){
       return print_r($result);
    } else {     
       return $result;
    }
    
}

?>