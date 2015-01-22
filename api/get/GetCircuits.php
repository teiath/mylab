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
* resourcePath="/circuits",
* description="Συγχρονισμός : Τηλεπικοινωνιακά Κυκλωματα",
* produces="['application/json']",
* @SWG\Api(
*   path="/circuits",
*   @SWG\Operation(
*                   method="GET",
*                   summary="Αναζήτηση στα Τηλεπικοινωνιακά Κυκλωματα",
*                   notes="Επιστρέφει τα Τηλεπικοινωνιακά Κυκλωματα. Τα τηλεπικοινωνικά Κυκλώματα τα λαμβάνουμε κατά την διάρκεια του συγχρονισμού σχολικών μονάδων mylab-mm.",
*                   type="getCircuits",
*                   nickname="GetCircuits",
* 
*   @SWG\Parameter( name="circuit_id", description="ID Τηλεπικοινωνιακού Κυκλωματος [notNull]", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="phone_number", description="Τηλεφωνικός Αριθμός Τηλεπικοινωνιακού Κυκλώματος (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="updated_date", description="Ημερομηνία Ενημέρωσης Τηλεπικοινωνιακού Κυκλώματος [notNull](μορφή ημερομηνίας dd/mm/yyyy)", required=false, type="string|array[string]", format="date", paramType="query" ),
*   @SWG\Parameter( name="status", description="Ενεργό/Ανενεργό Τηλεπικοινωνιακό Κύκλωμα [notNull](1=ενεργό, 0=ανενεργό)", required=false, type="integer|array[integer]", paramType="query", enum = "['0','1']" ),
*   @SWG\Parameter( name="circuit_type", description="Όνομα ή ID Τύπου Τηλεπικοινωνιακού Κυκλώματος [notNull]", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="school_unit_id", description="ID Σχολικής Μονάδας [notNull]", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="school_unit_name", description="Όνομα Σχολικής Μονάδας (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
* 
*   @SWG\Parameter( name="page", description="Αριθμός Σελίδας", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="pagesize", description="Αριθμός Εγγραφών/Σελίδα", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="searchtype", description="Τύπος αναζήτησης", required=false, type="string", paramType="query", enum = "['EXACT','CONTAIN','CONTAINALL','CONTAINANY','STARTWITH','ENDWITH']" ),
*   @SWG\Parameter( name="ordertype", description="Τύπος Ταξινόμησης", required=false, type="string", paramType="query", enum = "['ASC','DESC']" ),
*   @SWG\Parameter( name="orderby", description="Πεδίο Ταξινόμησης", required=false, type="string", paramType="query",
*                   enum = "['circuit_id','phone_number','updated_date','status','circuit_type_id','circuit_type_name','school_unit_id','school_unit_name']" ),
*   @SWG\Parameter( name="debug", description="Επιστροφή SQL/DQL Queries", required=false, type="boolean", paramType="query", enum = "['true','false']" ),  
* 
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidCircuitIDType, message=ExceptionMessages::InvalidCircuitIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidCircuitPhoneNumberType, message=ExceptionMessages::InvalidCircuitPhoneNumberType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidCircuitUpdatedDateType, message=ExceptionMessages::InvalidCircuitUpdatedDateType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidCircuitStatusType, message=ExceptionMessages::InvalidCircuitStatusType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidCircuitTypeType, message=ExceptionMessages::InvalidCircuitTypeType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitIDType, message=ExceptionMessages::InvalidSchoolUnitIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitNameType, message=ExceptionMessages::InvalidSchoolUnitNameType),
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
* id="getCircuits",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="total",type="integer",description="Το πλήθος των εγγραφών χωρίς τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="count",type="integer",description="Το πλήθος των εγγραφών της κλήσης σύμφωνα με τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="pagination",type="array",description="Οι παράμετροι σελιδοποίησης των εγγραφών της κλήσης",items="$ref:Pagination"),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="data",type="array",description="Ο Πίνακας με τα αποτελέσματα",items="$ref:Circuit"),
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
* id="Circuit",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με στοιχεία του πίνακα circuits : ",
* @SWG\Property(name="circuit_id",type="integer",description="Ο Κωδικός ID του Τηλεπικοινωνιακού Κυκλώματος"),
* @SWG\Property(name="phone_number",type="integer",description="Ο Τηλεφωνικός Αριθμός του Τηλεπικοινωνιακού Κυκλώματος"),
* @SWG\Property(name="updated_date",type="string",format="date-time",description="Η Ημερομηνία Ενημέρωσης του Τηλεπικοινωνιακού Κυκλώματος (μορφή dd/mm/yyyy hh:mm:ss)"),
* @SWG\Property(name="status",type="boolean",description="Λειτουργική κατάσταση Ενεργό ή Ανενεργό Τηλεπικοινωνιακού Κυκλώματος (true = ενεργό , false = ανενεργό)"),
* @SWG\Property(name="circuit_type_id",type="integer",description=" Ο Κωδικός ID του Τύπου του Τηλεπικοινωνιακού Κυκλώματος"),
* @SWG\Property(name="circuit_type_name",type="string",description="Το Όνομα του Τύπου του Τηλεπικοινωνιακού Κυκλώματος"),
* @SWG\Property(name="school_unit_id",type="integer",description=" Ο Κωδικός ID της Σχολικής Μονάδας"),
* @SWG\Property(name="school_unit_name",type="string",description="To Όνομα της Σχολικής Μονάδας")
* )
* 
*/
 
function GetCircuits( $circuit_id, $phone_number, $updated_date, $status, $circuit_type, $school_unit_id, $school_unit_name,
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
    
 //$orderby=====================================================================
       $columns = array(
                            "c.circuitId"       => "circuit_id",
                            "c.phoneNumber"     => "phone_number",
                            "c.updatedDate"     => "updated_date",
                            "c.status"          => "status" ,
                            "ct.circuitTypeId"  => "circuit_type_id",
                            "ct.name"           => "circuit_type_name",
                            "su.schoolUnitId"   => "school_unit_id",
                            "su.name"           => "school_unit_name",
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "circuit_id";
        else
        {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        } 
        
//$circuit_id===================================================================
        if (Validator::Exists('circuit_id', $params)){
            CRUDUtils::setFilter($qb, $circuit_id, "c", "circuitId", "circuitId", "id", ExceptionMessages::InvalidCircuitIDType, ExceptionCodes::InvalidCircuitIDType);
        } 

//$phone_number=================================================================
        if (Validator::Exists('phone_number', $params)){
            CRUDUtils::setSearchFilter($qb, $phone_number, "c", "phoneNumber", $searchtype, ExceptionMessages::InvalidCircuitPhoneNumberType, ExceptionCodes::InvalidCircuitPhoneNumberType);    
        }  

//$updated_date=================================================================
        if (Validator::Exists('updated_date', $params)){
            CRUDUtils::setFilter($qb, $updated_date, "c", "updatedDate", "updatedDate", "date", ExceptionMessages::InvalidCircuitUpdatedDateType, ExceptionCodes::InvalidCircuitUpdatedDateType);
        } 
        
//$status=======================================================================
        if (Validator::Exists('status', $params)){
            CRUDUtils::setFilter($qb, $status, "c", "status", "status", "numeric", ExceptionMessages::InvalidCircuitStatusType, ExceptionCodes::InvalidCircuitStatusType);
        }    
 
//$circuit_type=================================================================
        if (Validator::Exists('circuit_type', $params)){
            CRUDUtils::setFilter($qb, $circuit_type, "ct", "circuitTypeId", "name", "id,value", ExceptionMessages::InvalidCircuitTypeType, ExceptionCodes::InvalidCircuitTypeType);
        }  
        
//$school_unit_id===============================================================
        if (Validator::Exists('school_unit_id', $params)){
            CRUDUtils::setFilter($qb, $school_unit_id, "su", "schoolUnitId", "schoolUnitId", "id", ExceptionMessages::InvalidSchoolUnitIDType, ExceptionCodes::InvalidSchoolUnitIDType);
        }  
 
//$school_unit_name=============================================================
        if (Validator::Exists('school_unit_name', $params)){
            CRUDUtils::setSearchFilter($qb, $school_unit_name, "su", "name", $searchtype, ExceptionMessages::InvalidSchoolUnitNameType, ExceptionCodes::InvalidSchoolUnitNameType);    
        }
        
//execution=====================================================================
        $qb->select('c');
        $qb->from('Circuits', 'c');
        $qb->leftjoin('c.circuitType', 'ct');
        $qb->leftjoin('c.schoolUnit', 'su');
        $qb->orderBy(array_search($orderby, $columns), $ordertype);

//pagination and results========================================================      
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        $results->getQuery()->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $results->getQuery()->setMaxResults($pagesize) : null;

//data results==================================================================       
        $count = 0;
        foreach ($results as $circuit)
        {

            $result["data"][] = array(
                                            "circuit_id"         => $circuit->getCircuitId(),
                                            "phone_number"       => $circuit->getPhoneNumber(),
                                            "updated_date"       => $circuit->getUpdatedDate()->format('Y-m-d H:i:s'),
                                            "status"             => $circuit->getStatus(),
                                            "circuit_type_id"    => $circuit->getCircuitType()->getCircuitTypeId(),
                                            "circuit_type_name"  => $circuit->getCircuitType()->getName(),
                                            "school_unit_id"     => $circuit->getSchoolUnit()->getSchoolUnitId(),
                                            "school_unit_name"   => $circuit->getSchoolUnit()->getName()
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