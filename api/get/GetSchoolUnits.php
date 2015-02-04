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
* resourcePath="/school_units",
* description="Σχολικές Μονάδες",
* produces="['application/json']",
* @SWG\Api(
*   path="/school_units",
*   @SWG\Operation(
*                   method="GET",
*                   summary="Αναζήτηση στις Σχολικές Μονάδες",
*                   notes="Επιστρέφει τις Σχολικές Μονάδες",
*                   type="getSchoolUnits",
*                   nickname="GetSchoolUnits",
* 
*   @SWG\Parameter( name="school_unit_id", description="ID Σχολικής Μονάδας [notNull]", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="name", description="Όνομα Σχολικής Μονάδας (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="special_name", description="Προσωνύμιο Σχολικής Μονάδας (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="last_update", description="Ημερομηνία Ενημέρωσης Σχολικής Μονάδας [notNull](Mορφή ημερομηνίας dd/mm/yyyy)", required=false, type="string|array[string]", format="date", paramType="query" ),
*   @SWG\Parameter( name="fax_number", description="Φαξ Σχολικής Μονάδας (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="phone_number", description="Τηλέφωνο Σχολικής Μονάδας (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="email", description="Email Σχολικής Μονάδας", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="street_address", description="Διεύθυνση Σχολικής Μονάδας (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="postal_code", description="Ταχυδρομικός Κώδικας Σχολικής Μονάδας (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="unit_dns", description="DNS Σχολικής Μονάδας", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="region_edu_admin", description="Όνομα ή ID Περιφέρειας", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="edu_admin", description="Όνομα ή ID Διευθύνσης Εκπαίδευσης", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="transfer_area", description="Όνομα ή ID Περιοχής Μετάθεσης", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="municipality", description="Όνομα ή ID Δήμου", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="prefecture", description="Όνομα ή ID Νομού", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="education_level", description="Όνομα ή ID Επίπεδου Εκπαίδευσης", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="school_unit_type", description="Όνομα ή ID Τύπου Σχολικής Μονάδας", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="state", description="Όνομα ή ID Λειτουργικής Κατάστασης Σχολικής Μονάδας", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="school_unit", description="Διπλή Παράμετρος(balander): Κωδικός Σχολικής Μονάδας (Συνδυάζεται μόνο με παράμετρο searchtype=startwith) ή Όνομα Σχολικής Μονάδας (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*
*   @SWG\Parameter( name="page", description="Αριθμός Σελίδας", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="pagesize", description="Αριθμός Εγγραφών/Σελίδα", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="searchtype", description="Τύπος αναζήτησης", required=false, type="string", paramType="query", enum = "['EXACT','CONTAIN','CONTAINALL','CONTAINANY','STARTWITH','ENDWITH']" ),
*   @SWG\Parameter( name="ordertype", description="Τύπος Ταξινόμησης", required=false, type="string", paramType="query", enum = "['ASC','DESC']" ),
*   @SWG\Parameter( name="orderby", description="Πεδίο Ταξινόμησης", required=false, type="string", paramType="query",
*                   enum = "['school_unit_id','name','special_name','last_update','postal_code','unit_dns','region_edu_admin_id','region_edu_admin_name','edu_admin_id','edu_admin_name',
                             'transfer_area_id','transfer_area_name','municipality_id','municipality_name','prefecture_id','prefecture_name','education_level_id','education_level_name',
                             'school_unit_type_id','school_unit_type_name','state_id','state_name']" ),
*   @SWG\Parameter( name="debug", description="Επιστροφή SQL/DQL Queries", required=false, type="boolean", paramType="query", enum = "['true','false']" ),  
* 
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitIDType, message=ExceptionMessages::InvalidSchoolUnitIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitNameType, message=ExceptionMessages::InvalidSchoolUnitNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitSpecialNameType, message=ExceptionMessages::InvalidSchoolUnitSpecialNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitLastUpdateType, message=ExceptionMessages::InvalidSchoolUnitLastUpdateType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitFaxNumberType, message=ExceptionMessages::InvalidSchoolUnitFaxNumberType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitPhoneNumberType, message=ExceptionMessages::InvalidSchoolUnitPhoneNumberType), 
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitEmailType, message=ExceptionMessages::InvalidSchoolUnitEmailType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitStreetAddressType, message=ExceptionMessages::InvalidSchoolUnitStreetAddressType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitPostalCodeType, message=ExceptionMessages::InvalidSchoolUnitPostalCodeType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitUnitDnsType, message=ExceptionMessages::InvalidSchoolUnitUnitDnsType),
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
* id="getSchoolUnits",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="total",type="integer",description="Το πλήθος των εγγραφών χωρίς τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="count",type="integer",description="Το πλήθος των εγγραφών της κλήσης σύμφωνα με τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="pagination",type="array",description="Οι παράμετροι σελιδοποίησης των εγγραφών της κλήσης",items="$ref:Pagination"),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="data",type="array",description="Ο Πίνακας με τα αποτελέσματα",items="$ref:SchoolUnit"),
* @SWG\Property(name="DQL",type="string",description="To DQL query που εκτελείται (επιστρεφεται στην περίπτωση debug=true)"),
* @SWG\Property(name="SQL",type="string",description="To SQL query που εκτελείται (επιστρεφεται στην περίπτωση debug=true)")
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
* id="SchoolUnit",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με στοιχεία του πίνακα school_units: ",
* @SWG\Property(name="school_unit_id",type="integer",description="Ο Κωδικός ID της Σχολικής Μονάδας"),
* @SWG\Property(name="name",type="string",description="Το Όνομα της Σχολικής Μονάδας"),
* @SWG\Property(name="special_name",type="string",description="Το Προσωνύμιο της Σχολικής Μονάδας"),
* @SWG\Property(name="last_update",type="string",format="date-time",description="Η Ημερομηνία Ενημέρωσης της Σχολικής Μονάδας (μορφή ημερομηνίας dd/mm/yyyy hh:mm:ss)"),
* @SWG\Property(name="fax_number",type="integer",description="Ο Αριθμός Τηλεομοιοτυπίας (φαξ) της Σχολικής Μονάδας"),
* @SWG\Property(name="phone_number",type="integer",description="Το Τηλέφωνο Επικοινωνίας της Σχολικής Μονάδας"),
* @SWG\Property(name="email",type="string",description="Η Ηλεκτρονική Αλληλογραφία της Σχολικής Μονάδας"),
* @SWG\Property(name="street_address",type="string",description="Η Διεύθυνση (Οδός και Αριθμός) της Σχολικής Μονάδας"),
* @SWG\Property(name="postal_code",type="integer",description="Ο Ταχυδρομικός Κώδικας της Σχολικής Μονάδας"),
* @SWG\Property(name="unit_dns",type="string",description="Το DNS της Σχολικής Μονάδας"),
* @SWG\Property(name="region_edu_admin_id",type="integer",description="Ο Κωδικός ID της Περιφέρειας"),
* @SWG\Property(name="region_edu_admin_name",type="string",description="Το Όνομα της Περιφέρειας"),
* @SWG\Property(name="edu_admin_id",type="integer",description="Ο Κωδικός ID της Διευθύνσης Εκπαίδευσης"),
* @SWG\Property(name="edu_admin_name",type="string",description="Το Όνομα της Διευθύνσης Εκπαίδευσης"),
* @SWG\Property(name="transfer_area_id",type="integer",description="Ο Κωδικός ID της Περιοχής Μετάθεσης"),
* @SWG\Property(name="transfer_area_name",type="string",description="Το Όνομα της Περιοχής Μετάθεσης"),
* @SWG\Property(name="municipality_id",type="integer",description="Ο Κωδικός ID του Δήμου"),
* @SWG\Property(name="municipality_name",type="string",description="Το Όνομα του Δήμου"),
* @SWG\Property(name="prefecture_id",type="integer",description="Ο Κωδικός ID του Νομού"),
* @SWG\Property(name="prefecture_name",type="string",description="Το Όνομα του Νομού"),
* @SWG\Property(name="education_level_id",type="integer",description="Ο Κωδικός ID του Επίπεδου Εκπαίδευσης"),
* @SWG\Property(name="education_level_name",type="string",description="Το Όνομα του Επίπεδου Εκπαίδευσης"),
* @SWG\Property(name="school_unit_type_id",type="integer",description="Ο Κωδικός ID του Τύπου Σχολικής Μονάδας"),
* @SWG\Property(name="school_unit_type_name",type="string",description="Το Όνομα του Τύπου Σχολικής Μονάδας"),
* @SWG\Property(name="state_id",type="integer",description="Ο Κωδικός ID του Λειτουργικής Κατάστασης Σχολικής Μονάδας"),
* @SWG\Property(name="state_name",type="string",description="Το Όνομα της Πρωτογενούς Πηγής Δεδομένων Εργαζόμενου Σχολικής Μονάδας")
* )
* 
*/

function GetSchoolUnits( $school_unit_id, $name, $special_name, $last_update, $fax_number, $phone_number, $email, $street_address, $postal_code, $unit_dns,
                         $region_edu_admin, $edu_admin, $transfer_area, $municipality, $prefecture, $education_level, $school_unit_type, $state,
                         $school_unit,
                         $pagesize, $page, $searchtype, $ordertype, $orderby ) {
   
    global $entityManager, $app;

    $qb = $entityManager->createQueryBuilder();
    $result = array();  

    $result["data"] = array();
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    
    try {
  
//user permissions==============================================================
//not required 
    
//$page - $pagesize - $searchtype - $ordertype =================================
       $page = Pagination::getPage($page, $params);
       $pagesize = Pagination::getPagesize($pagesize, $params);     
       $searchtype = Filters::getSearchType($searchtype, $params);
       $ordertype =  Filters::getOrderType($ordertype, $params);
  
//$orderby======================================================================
       $columns = array(
                            "su.schoolUnitId"       => "school_unit_id",
                            "su.name"               => "name",
                            "su.specialName"        => "special_name",
                            "su.lastUpdate"         => "last_update",
                            "su.postalCode"         => "postal_code",
                            "su.unitDns"            => "unit_dns",
                            "rea.regionEduAdminId"  => "region_edu_admin_id",
                            "rea.name"              => "region_edu_admin_name",
                            "ea.eduAdminId"         => "edu_admin_id",
                            "ea.name"               => "edu_admin_name",
                            "ta.transferAreaId"     => "transfer_area_id",
                            "ta.name"               => "transfer_area_name",
                            "m.municipalityId"      => "municipality_id",
                            "m.name"                => "municipality_name",
                            "p.prefectureId"        => "prefecture_id",
                            "p.name"                => "prefecture_name",
                            "el.educationLevelId"   => "education_level_id",
                            "el.name"               => "education_level_name",
                            "sut.schoolUnitTypeId"  => "school_unit_type_id",
                            "sut.name"              => "school_unit_type_name",
                            "s.stateId"             => "state_id",
                            "s.name"                => "state_name"
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "school_unit_id";
        else
        {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        } 
    
//$school_unit_id===============================================================
        if (Validator::Exists('school_unit_id', $params)){
            CRUDUtils::setFilter($qb, $school_unit_id, "su", "schoolUnitId", "schoolUnitId", "id", ExceptionMessages::InvalidSchoolUnitIDType, ExceptionCodes::InvalidSchoolUnitIDType);
        } 

//$name=========================================================================
        if (Validator::Exists('name', $params)){
            CRUDUtils::setSearchFilter($qb, $name, "su", "name", $searchtype, ExceptionMessages::InvalidSchoolUnitNameType, ExceptionCodes::InvalidSchoolUnitNameType);    
        } 
        
//$special_name=================================================================
        if (Validator::Exists('special_name', $params)){
            CRUDUtils::setSearchFilter($qb, $special_name, "su", "specialName", $searchtype, ExceptionMessages::InvalidSchoolUnitSpecialNameType, ExceptionCodes::InvalidSchoolUnitSpecialNameType);    
        } 
        
//$last_update==================================================================
        if (Validator::Exists('last_update', $params)){
            CRUDUtils::setFilter($qb, $last_update, "su", "lastUpdate", "lastUpdate", "date", ExceptionMessages::InvalidSchoolUnitLastUpdateType, ExceptionCodes::InvalidSchoolUnitLastUpdateType);
        }  
        
//$fax_number===================================================================
        if (Validator::Exists('fax_number', $params)){
            CRUDUtils::setSearchFilter($qb, $fax_number, "su", "faxNumber", $searchtype, ExceptionMessages::InvalidSchoolUnitFaxNumberType, ExceptionCodes::InvalidSchoolUnitFaxNumberType);    
        } 
        
//$phone_number=================================================================
        if (Validator::Exists('phone_number', $params)){
            CRUDUtils::setSearchFilter($qb, $phone_number, "su", "phoneNumber", $searchtype, ExceptionMessages::InvalidSchoolUnitPhoneNumberType, ExceptionCodes::InvalidSchoolUnitPhoneNumberType);    
        } 
        
//$email========================================================================
        if (Validator::Exists('email', $params)){
            CRUDUtils::setFilter($qb, $email, "su", "email", "email", "null,value", ExceptionMessages::InvalidSchoolUnitEmailType, ExceptionCodes::InvalidSchoolUnitEmailType);
        } 
        
//$street_address===============================================================
        if (Validator::Exists('street_address', $params)){
            CRUDUtils::setSearchFilter($qb, $street_address, "su", "streetAddress", $searchtype, ExceptionMessages::InvalidSchoolUnitStreetAddressType, ExceptionCodes::InvalidSchoolUnitStreetAddressType);    
        } 
        
//$postal_code==================================================================
        if (Validator::Exists('postal_code', $params)){
            CRUDUtils::setSearchFilter($qb, $postal_code, "su", "postalCode", $searchtype, ExceptionMessages::InvalidSchoolUnitPostalCodeType, ExceptionCodes::InvalidSchoolUnitPostalCodeType);    
        }
        
//$unit_dns=====================================================================
        if (Validator::Exists('unit_dns', $params)){
            CRUDUtils::setFilter($qb, $unit_dns, "su", "unitDns", "unitDns", "null,value", ExceptionMessages::InvalidSchoolUnitUnitDnsType, ExceptionCodes::InvalidSchoolUnitUnitDnsType);
        } 
               
//$region_edu_admin=============================================================
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

//$state========================================================================
        if (Validator::Exists('state', $params)){
            CRUDUtils::setFilter($qb, $state, "s", "stateId", "name", "null,id,value", ExceptionMessages::InvalidStateType, ExceptionCodes::InvalidStateType);
        } 

//balander parameter============================================================        
if (Validator::Exists('school_unit', $params)){

    if (Validator::IsID($school_unit))
        CRUDUtils::setFilter($qb, $school_unit, "su", "schoolUnitId", "schoolUnitId", "startWith", ExceptionMessages::InvalidSchoolUnitIDType, ExceptionCodes::InvalidSchoolUnitIDType);
    else
        CRUDUtils::setSearchFilter($qb, $school_unit, "su", "name", $searchtype, ExceptionMessages::InvalidSchoolUnitNameType, ExceptionCodes::InvalidSchoolUnitNameType);    
} 

 //execution====================================================================
        $qb->select('su');
        $qb->from('SchoolUnits', 'su');
        $qb->leftjoin('su.regionEduAdmin', 'rea');
        $qb->leftjoin('su.eduAdmin', 'ea');
        $qb->leftjoin('su.transferArea', 'ta');
        $qb->leftjoin('su.municipality', 'm');
        $qb->leftjoin('su.prefecture', 'p');
        $qb->leftjoin('su.educationLevel', 'el');
        $qb->leftjoin('su.schoolUnitType', 'sut');
        $qb->leftjoin('su.state', 's');
        $qb->orderBy(array_search($orderby, $columns), $ordertype);

//        if ($permit_labs !== 'ALLRESULTS'){
//            $qb->andWhere($qb->expr()->in('l.labId', ':ids'))
//                ->setParameter('ids', $permit_labs);
//        }
        
//pagination and results========================================================      
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        $results->getQuery()->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $results->getQuery()->setMaxResults($pagesize) : null;

//data results==================================================================       
        $count = 0;
        foreach ($results as $schoolunit)
        {

            $result["data"][] = array(
                                        "school_unit_id"            => $schoolunit->getSchoolUnitId(),
                                        "name"                      => $schoolunit->getName(),
                                        "special_name"              => $schoolunit->getSpecialName(),
                                        "last_update"               => $schoolunit->getLastUpdate(),
                                        "fax_number"                => $schoolunit->getFaxNumber(),
                                        "phone_number"              => $schoolunit->getPhoneNumber(),
                                        "email"                     => $schoolunit->getEmail(),
                                        "street_address"            => $schoolunit->getStreetAddress(),
                                        "postal_code"               => $schoolunit->getPostalCode(),
                                        "unit_dns"                  => $schoolunit->getUnitDns(),
                                        "region_edu_admin_id"       => Validator::IsNull($schoolunit->getRegionEduAdmin()) ? Validator::ToNull() : $schoolunit->getRegionEduAdmin()->getRegionEduAdminId(),
                                        "region_edu_admin_name"     => Validator::IsNull($schoolunit->getRegionEduAdmin()) ? Validator::ToNull() : $schoolunit->getRegionEduAdmin()->getRegionEduAdminId(),
                                        "edu_admin_id"              => Validator::IsNull($schoolunit->getEduAdmin()) ? Validator::ToNull() : $schoolunit->getEduAdmin()->getEduAdminId(),
                                        "edu_admin_name"            => Validator::IsNull($schoolunit->getEduAdmin()) ? Validator::ToNull() : $schoolunit->getEduAdmin()->getName(),
                                        "transfer_area_id"          => Validator::IsNull($schoolunit->getTransferArea()) ? Validator::ToNull() : $schoolunit->getTransferArea()->getTransferAreaId(),
                                        "transfer_area_name"        => Validator::IsNull($schoolunit->getTransferArea()) ? Validator::ToNull() : $schoolunit->getTransferArea()->getName(),
                                        "municipality_id"           => Validator::IsNull($schoolunit->getMunicipality()) ? Validator::ToNull() : $schoolunit->getMunicipality()->getMunicipalityId(),
                                        "municipality_name"         => Validator::IsNull($schoolunit->getMunicipality()) ? Validator::ToNull() : $schoolunit->getMunicipality()->getName(),
                                        "prefecture_id"             => Validator::IsNull($schoolunit->getPrefecture()) ? Validator::ToNull() : $schoolunit->getPrefecture()->getPrefectureId(),
                                        "prefecture_name"           => Validator::IsNull($schoolunit->getPrefecture()) ? Validator::ToNull() : $schoolunit->getPrefecture()->getName(),
                                        "education_level_id"        => Validator::IsNull($schoolunit->getEducationLevel()) ? Validator::ToNull() : $schoolunit->getEducationLevel()->getEducationLevelId(),
                                        "education_level_name"      => Validator::IsNull($schoolunit->getEducationLevel()) ? Validator::ToNull() : $schoolunit->getEducationLevel()->getName(),
                                        "school_unit_type_id"       => Validator::IsNull($schoolunit->getSchoolUnitType()) ? Validator::ToNull() : $schoolunit->getSchoolUnitType()->getSchoolUnitTypeId(),
                                        "school_unit_type_name"     => Validator::IsNull($schoolunit->getSchoolUnitType()) ? Validator::ToNull() : $schoolunit->getSchoolUnitType()->getName(),
                                        "state_id"                  => Validator::IsNull($schoolunit->getState()) ? Validator::ToNull() : $schoolunit->getState()->getStateId(),
                                        "state_name"                => Validator::IsNull($schoolunit->getState()) ? Validator::ToNull() : $schoolunit->getState()->getName()
                                     );
            $count++;
        }
        $result["count"] = $count;
          
//pagination results============================================================     
        $maxPage = Pagination::getMaxPage($result["total"],$page,$pagesize);
        $pagination = array( "page" => $page,   
                             "maxPage" => $maxPage, 
                             "pagesize" => $pagesize 
                            );    
        $result["pagination"]=$pagination;
        
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
    
    return $result;
    
}   
    
?>