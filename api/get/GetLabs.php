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
* resourcePath="/labs",
* description="Διατάξεις Η/Υ",
* produces="['application/json']",
* @SWG\Api(
*   path="/labs",
*   @SWG\Operation(
*                   method="GET",
*                   summary="Αναζήτηση στις Διατάξεις Η/Υ",
*                   notes="Επιστρέφει τις Διατάξεις Η/Υ",
*                   type="getLabs",
*                   nickname="GetLabs",
* 
*   @SWG\Parameter( name="lab_id", description="ID Διάταξης Η/Υ [notNull]", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="name", description="Όνομα Διάταξης Η/Υ (Συνδυάζεται με την παράμετρο searchtype.)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="special_name", description="Προσωνύμιο Διάταξης Η/Υ (Συνδυάζεται με την παράμετρο searchtype.)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="creation_date", description="Ημερομηνία Δημιουργίας Διάταξης Η/Υ [notNull](μορφή ημερομηνίας dd/mm/yyyy)", required=false, type="string|array[string]", format="date", paramType="query" ),
*   @SWG\Parameter( name="created_by", description="UID χρήστη που Δημιούργησε την Διάταξη Η/Υ (Συνδυάζεται με την παράμετρο searchtype.)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="last_updated", description="Ημερομηνία Ενημέρωσης Στοιχείων Διάταξης Η/Υ [notNull](μορφή ημερομηνίας dd/mm/yyyy)", required=false, type="string|array[string]", format="date", paramType="query"),
*   @SWG\Parameter( name="updated_by", description="UID χρήστη που Ενημέρωσε την Διάταξη Η/Υ (Συνδυάζεται με την παράμετρο searchtype.)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="operational_rating", description="Βαθμολογία Λειτουργικής Κατάστασης Διάταξης Η/Υ [notNull](1=αρνητική - 5=θετική)", required=false, type="integer|array[integer]", paramType="query"),
*   @SWG\Parameter( name="technological_rating", description="Βαθμολογία Τεχνολογικής Κατάστασης Διάταξης Η/Υ [notNull](1=αρνητική - 5=θετική)", required=false, type="integer|array[integer]", paramType="query"),
*   @SWG\Parameter( name="ellak", description="Χρήση ΕΛΛΑΚ στην Διάταξη Η/Υ [notNull](true=ΕΛΛΑΚ, false=ΟΧΙ ΕΛΛΑΚ)", required=false, type="boolean|array[boolean]", paramType="query" ),
*   @SWG\Parameter( name="submitted", description="Υποβεβλημένη Διάταξη Η/Υ [notNull](true=υποβεβλημένη, false=μη υποβεβλημένη)", required=false, type="boolean|array[boolean]", paramType="query" ),
*   @SWG\Parameter( name="lab_type", description="Όνομα ή ID Τύπου Διάταξης Η/Υ", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="school_unit", description="Όνομα ή ID Σχολικής Μονάδας", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="state", description="Όνομα ή ID Λειτουργικής Κατάστασης Διάταξης Η/Υ", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="lab_source", description="Όνομα ή ID Πρωτογενής Πηγής Δεδομένων Διάταξης Η/Υ)", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
* 
*   @SWG\Parameter( name="page", description="Αριθμός Σελίδας", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="pagesize", description="Αριθμός Εγγραφών/Σελίδα", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="searchtype", description="Τύπος αναζήτησης", required=false, type="string", paramType="query", enum = "['EXACT','CONTAIN','CONTAINALL','CONTAINANY','STARTWITH','ENDWITH']" ),
*   @SWG\Parameter( name="ordertype", description="Τύπος Ταξινόμησης", required=false, type="string", paramType="query", enum = "['ASC','DESC']" ),
*   @SWG\Parameter( name="orderby", description="Πεδίο Ταξινόμησης", required=false, type="string", paramType="query",
*                   enum = "['name','special_name','creation_date','created_by','last_updated','updated_by','operational_rating','technological_rating','ellak','submitted','lab_type_id','lab_type_name','school_unit_id','school_unit_name','state_id','state_name','lab_source_id','lab_source_name']" ),
*   @SWG\Parameter( name="debug", description="Επιστροφή SQL/DQL Queries", required=false, type="boolean", paramType="query", enum = "['true','false']" ),  
*
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabIDType, message=ExceptionMessages::InvalidLabIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabNameType, message=ExceptionMessages::InvalidLabNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabSpecialNameType, message=ExceptionMessages::InvalidLabSpecialNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabCreationDateType, message=ExceptionMessages::InvalidLabCreationDateType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabCreatedByType, message=ExceptionMessages::InvalidLabCreatedByType), 
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabLastUpdatedType, message=ExceptionMessages::InvalidLabLastUpdatedType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabUpdatedByType, message=ExceptionMessages::InvalidLabUpdatedByType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTechnologicalRatingType, message=ExceptionMessages::InvalidLabTechnologicalRatingType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabOperationalRatingType, message=ExceptionMessages::InvalidLabOperationalRatingType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabEllakType, message=ExceptionMessages::InvalidLabEllakType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabSubmittedType, message=ExceptionMessages::InvalidLabSubmittedType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTypeType, message=ExceptionMessages::InvalidLabTypeType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitTypeType, message=ExceptionMessages::InvalidSchoolUnitTypeType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidStateType, message=ExceptionMessages::InvalidStateType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabSourceType, message=ExceptionMessages::InvalidLabSourceType),
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
* id="getLabs",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="total",type="integer",description="Το πλήθος των εγγραφών χωρίς τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="count",type="integer",description="Το πλήθος των εγγραφών της κλήσης σύμφωνα με τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="pagination",type="array",description="Οι παράμετροι σελιδοποίησης των εγγραφών της κλήσης",items="$ref:Pagination"),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="data",type="array",description="Ο Πίνακας με τα αποτελέσματα",items="$ref:Lab"),
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
* id="Lab",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με στοιχεία του πίνακα labs: ",
* @SWG\Property(name="lab_id",type="integer",description="Το ID της Διάταξης Η/Υ (mylab_id)"),
* @SWG\Property(name="name",type="string",description="Το Όνομα της Διάταξης Η/Υ"),
* @SWG\Property(name="mmSyncId",type="integer",description="Ο Κωδικός ΜΜ της Διάταξης Η/Υ (mm_id)"),
* @SWG\Property(name="special_name",type="string",description="Το Προσωνύμιο της Διάταξης Η/Υ"),
* @SWG\Property(name="creation_date",type="string",format="date-time",description="Η Ημερομηνία Δημιουργίας της Διάταξης Η/Υ (μορφή ημερομηνίας dd/mm/yyyy hh:mm:ss)"),
* @SWG\Property(name="created_by",type="string",description="Το UID του χρήστη που Δημιούργησε την Διάταξη Η/Υ"),
* @SWG\Property(name="last_updated",type="string",format="date-time",description="Η Ημερομηνία Ενημέρωσης Στοιχείων της Διάταξης Η/Υ (μορφή ημερομηνίας dd/mm/yyyy hh:mm:ss)"),
* @SWG\Property(name="updated_by",type="string",description="Το UID του χρήστη που Ενημέρωσε την Διάταξη Η/Υ"),
* @SWG\Property(name="mmSyncLastUpdateDate",type="string",format="date-time",description="Η Ημερομηνία Συγχρονισμού Στοιχείων της Διάταξης Η/Υ με το ΜΜ (μορφή ημερομηνίας dd/mm/yyyy hh:mm:ss)"),
* @SWG\Property(name="operational_rating",type="integer",description="Η Βαθμολογία Λειτουργικής Κατάστασης της Διάταξης Η/Υ (1=αρνητική - 5=θετική)"),
* @SWG\Property(name="technological_rating",type="integer",description="Η Βαθμολογία Τεχνολογικής Κατάστασης της Διάταξης Η/Υ (1=αρνητική - 5=θετική)"),
* @SWG\Property(name="ellak",type="boolean",description="Χρήση ΕΛΛΑΚ στην Διάταξη Η/Υ.Αρκεί να υπάρχουν UBUNTU LTSP στην Διάταξη Η/Υ για να χαρακτηριστει ως ΕΛΛΑΚ.(true=ΕΛΛΑΚ, false=ΟΧΙ ΕΛΛΑΚ) "),
* @SWG\Property(name="submitted",type="boolean",description="Υποβεβλημένη Διάταξη Η/Υ. Γίνεται επιβεβαίωση από τους αρμοδιους χρήστες.(true=υποβεβλημένη, false=μη υποβεβλημένη)"),
* @SWG\Property(name="lab_type_id",type="integer",description="Ο Κωδικός ID του Τύπου Διάταξης Η/Υ"),
* @SWG\Property(name="lab_type_name",type="string",description="Το Όνομα του Τύπου Διάταξης Η/Υ"),
* @SWG\Property(name="school_unit_id",type="integer",description="Ο Κωδικός ID της Σχολικής Μονάδας"),
* @SWG\Property(name="school_unit_name",type="string",description="Το Όνομα της Σχολικής Μονάδας"),
* @SWG\Property(name="state_id",type="integer",description="Ο Κωδικός ID της Λειτουργικής Κατάστασης Διάταξης Η/Υ"),
* @SWG\Property(name="state_name",type="string",description="Το Όνομα της Λειτουργικής Κατάστασης Διάταξης Η/Υ"),
* @SWG\Property(name="lab_source_id",type="integer",description="Ο Κωδικός ID της Πρωτογενής Πηγής Δεδομένων Διάταξης Η/Υ"),
* @SWG\Property(name="lab_source_name",type="string",description="Το Όνομα της Πρωτογενής Πηγής Δεδομένων Διάταξης Η/Υ")
* )
* 
*/
                    
function GetLabs( $lab_id, $name, $special_name, $creation_date, $created_by, $last_updated, $updated_by, $operational_rating, $technological_rating, $ellak, $submitted, 
                  $lab_type, $school_unit, $state, $lab_source, 
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
                            "l.labId"               => "lab_id",
                            "l.name"                => "name",
                            "l.specialName"         => "special_name",
                            "l.creationDate"        => "creation_date",     
                            "l.createdBy"           => "created_by",
                            "l.lastUpdated"         => "last_updated",
                            "l.updatedBy"           => "updated_by",
                            "l.operationalRating"   => "operational_rating",
                            "l.technologicalRating" => "technological_rating",
                            "l.ellak"               => "ellak",
                            "l.submitted"           => "submitted", 
                            "lt.labTypeId"          => "lab_type_id",
                            "lt.name"               => "lab_type_name",
                            "su.schoolUnitId"       => "school_unit_id",
                            "su.name"               => "school_unit_name",
                            "s.stateId"             => "state_id",
                            "s.name"                => "state_name",
                            "ls.labSourceId"        => "lab_source_id",
                            "ls.name"               => "lab_source_name"
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "lab_id";
        else
        {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        } 
        
//$lab_id=======================================================================
        if (Validator::Exists('lab_id', $params)){
            CRUDUtils::setFilter($qb, $lab_id, "l", "labId", "labId", "id", ExceptionMessages::InvalidLabIDType, ExceptionCodes::InvalidLabIDType);
        } 

//$name=========================================================================
        if (Validator::Exists('name', $params)){
            CRUDUtils::setSearchFilter($qb, $name, "l", "name", $searchtype, ExceptionMessages::InvalidLabNameType, ExceptionCodes::InvalidLabNameType);    
        } 
        
//$special_name=================================================================
        if (Validator::Exists('special_name', $params)){
            CRUDUtils::setSearchFilter($qb, $special_name, "l", "specialName", $searchtype, ExceptionMessages::InvalidLabSpecialNameType, ExceptionCodes::InvalidLabSpecialNameType);    
        } 

//$creation_date================================================================
        if (Validator::Exists('creation_date', $params)){
            CRUDUtils::setFilter($qb, $creation_date, "l", "creationDate", "creationDate", "date", ExceptionMessages::InvalidLabCreationDateType, ExceptionCodes::InvalidLabCreationDateType);
        } 
      
//$created_by===================================================================
        if (Validator::Exists('created_by', $params)){
            CRUDUtils::setSearchFilter($qb, $created_by, "l", "createdBy", $searchtype, ExceptionMessages::InvalidLabCreatedByType, ExceptionCodes::InvalidLabCreatedByType);    
        } 
        
//$last_updated=================================================================
        if (Validator::Exists('last_updated', $params)){
            CRUDUtils::setFilter($qb, $last_updated, "l", "lastUpdated", "lastUpdated", "date", ExceptionMessages::InvalidLabLastUpdatedType, ExceptionCodes::InvalidLabLastUpdatedType);
        }  

//$updated_by===================================================================
        if (Validator::Exists('updated_by', $params)){
            CRUDUtils::setSearchFilter($qb, $updated_by, "l", "updatedBy", $searchtype, ExceptionMessages::InvalidLabUpdatedByType, ExceptionCodes::InvalidLabUpdatedByType);    
        } 

//$operational_rating===========================================================
        if (Validator::Exists('operational_rating', $params)){
            CRUDUtils::setFilter($qb, $operational_rating, "l", "operationalRating", "operationalRating", "numeric", ExceptionMessages::InvalidLabTechnologicalRatingType, ExceptionCodes::InvalidLabTechnologicalRatingType);
        }  
        
//$technological_rating=========================================================
        if (Validator::Exists('technological_rating', $params)){
            CRUDUtils::setFilter($qb, $technological_rating, "l", "technologicalRating", "technologicalRating", "numeric", ExceptionMessages::InvalidLabOperationalRatingType, ExceptionCodes::InvalidLabOperationalRatingType);
        }  
        
//$ellak========================================================================
        if (Validator::Exists('ellak', $params)){
            CRUDUtils::setFilter($qb, $ellak, "l", "ellak", "ellak", "boolean", ExceptionMessages::InvalidLabEllakType, ExceptionCodes::InvalidLabEllakType);
        }  
        
//$submitted====================================================================
        if (Validator::Exists('submitted', $params)){
            CRUDUtils::setFilter($qb, $submitted, "l", "submitted", "submitted", "boolean", ExceptionMessages::InvalidLabSubmittedType, ExceptionCodes::InvalidLabSubmittedType);
        }  
        
//$lab_type=====================================================================
        if (Validator::Exists('lab_type', $params)){
            CRUDUtils::setFilter($qb, $lab_type, "lt", "labTypeId", "name", "null,id,value", ExceptionMessages::InvalidLabTypeType, ExceptionCodes::InvalidLabTypeType);
        } 
        
//$school_unit========================================================================
if (Validator::Exists('school_unit', $params)){
    CRUDUtils::setFilter($qb, $school_unit, "su", "schoolUnitId", "name", "null,id,value", ExceptionMessages::InvalidSchoolUnitTypeType, ExceptionCodes::InvalidSchoolUnitTypeType);
} 
        
//$state========================================================================
        if (Validator::Exists('state', $params)){
            CRUDUtils::setFilter($qb, $state, "s", "stateId", "name", "null,id,value", ExceptionMessages::InvalidStateType, ExceptionCodes::InvalidStateType);
        } 

//$lab_source========================================================================
if (Validator::Exists('lab_source', $params)){
    CRUDUtils::setFilter($qb, $lab_source, "ls", "labSourceId", "name", "null,id,value", ExceptionMessages::InvalidLabSourceType, ExceptionCodes::InvalidLabSourceType);
} 
 
 //execution====================================================================
        $qb->select('l');
        $qb->from('Labs', 'l');
        $qb->leftjoin('l.labType', 'lt');
        $qb->leftjoin('l.schoolUnit', 'su');
        $qb->leftjoin('l.state', 's');
        $qb->leftjoin('l.labSource', 'ls');
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
        foreach ($results as $lab)
        {

            $result["data"][] = array(
                                        "lab_id"                => $lab->getLabId(),
                                        "name"                  => $lab->getName(),
                                        "mmSyncId"              => $lab->getMmSyncId(),
                                        "special_name"          => $lab->getSpecialName(),
                                        "creation_date"         => $lab->getCreationDate(),
                                        "created_by"            => $lab->getCreatedBy(),
                                        "last_updated"          => $lab->getLastUpdated(),
                                        "updated_by"            => $lab->getUpdatedBy(),
                                        "mmSyncLastUpdateDate"  => $lab->getMmSyncLastUpdateDate(),
                                        "operational_rating"    => $lab->getOperationalRating(),
                                        "technological_rating"  => $lab->getTechnologicalRating(),
                                        "ellak"                 => $lab->getEllak(),
                                        "submitted"             => $lab->getSubmitted(),                                     
                                        "lab_type_id"           => Validator::IsNull($lab->getLabType()) ? Validator::ToNull() : $lab->getLabType()->getLabTypeId(),
                                        "lab_type_name"         => Validator::IsNull($lab->getLabType()) ? Validator::ToNull() : $lab->getLabType()->getName(),
                                        "school_unit_id"        => Validator::IsNull($lab->getSchoolUnit()) ? Validator::ToNull() : $lab->getSchoolUnit()->getSchoolUnitId(),
                                        "school_unit_name"      => Validator::IsNull($lab->getSchoolUnit()) ? Validator::ToNull() : $lab->getSchoolUnit()->getName(),
                                        "state_id"              => Validator::IsNull($lab->getState()) ? Validator::ToNull() : $lab->getState()->getStateId(),
                                        "state_name"            => Validator::IsNull($lab->getState()) ? Validator::ToNull() : $lab->getState()->getName(),
                                        "lab_source_id"         => Validator::IsNull($lab->getLabSource()) ? Validator::ToNull() : $lab->getLabSource()->getLabSourceId(),
                                        "lab_source_name"       => Validator::IsNull($lab->getLabSource()) ? Validator::ToNull() : $lab->getLabSource()->getName()
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