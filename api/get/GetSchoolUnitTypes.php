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
* resourcePath="/school_unit_types",
* description="Λεξικό : Τύποι Σχολικών Μονάδων",
* produces="['application/json']",
* @SWG\Api(
*   path="/school_unit_types",
*   @SWG\Operation(
*                   method="GET",
*                   summary="Αναζήτηση σε Τύπους Σχολικών Μονάδων",
*                   notes="Επιστρέφει τους Τύπους Σχολικών Μονάδων",
*                   type="getSchoolUnitTypes",
*                   nickname="GetSchoolUnitTypes",
*   @SWG\Parameter(
*                   name="school_unit_type_id",
*                   description="ID Τύπου Σχολικής Μονάδας [notNull]",
*                   required=false,
*                   type="integer|array[integer]",
*                   paramType="query"
*                   ),
*   @SWG\Parameter(
*                   name="name",
*                   description="Όνομα Τύπου Σχολικής Μονάδας (Συνδυάζεται με την παράμετρο searchtype)",
*                   required=false,
*                   type="string|array[string]",
*                   paramType="query"
*                   ),
*   @SWG\Parameter(
*                   name="education_level",
*                   description="Όνομα ή ID Επίπεδου Εκπαίδευσης [notNull]",
*                   required=false,
*                   type="mixed(string|integer|array[string|integer])",
*                   paramType="query"
*                   ),
*   @SWG\Parameter(
*                   name="page",
*                   description="Αριθμός Σελίδας",
*                   required=false,
*                   type="integer",
*                   paramType="query"
*                   ),
*   @SWG\Parameter(
*                   name="pagesize",
*                   description="Αριθμός Εγγραφών/Σελίδα",
*                   required=false,
*                   type="integer",
*                   paramType="query"
*                   ),
*   @SWG\Parameter(
*                   name="searchtype",
*                   description="Τύπος αναζήτησης",
*                   required=false,
*                   type="string",
*                   paramType="query",
*                   enum = "['EXACT','CONTAIN','CONTAINALL','CONTAINANY','STARTWITH','ENDWITH']"
*                   ),
*   @SWG\Parameter(
*                   name="ordertype",
*                   description="Τύπος Ταξινόμησης",
*                   required=false,
*                   type="string",
*                   paramType="query",
*                   enum = "['ASC','DESC']"
*                   ),
*   @SWG\Parameter(
*                   name="orderby",
*                   description="Πεδίο Ταξινόμησης",
*                   required=false,
*                   type="string",
*                   paramType="query",
*                   enum = "['school_unit_type_id','name','education_level_id','education_level_name']"
*                   ),
*   @SWG\Parameter( name="debug", description="Επιστροφή SQL/DQL Queries", required=false, type="boolean", paramType="query", enum = "['true','false']" ),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitTypeIDType, message=ExceptionMessages::InvalidSchoolUnitTypeIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitTypeNameType, message=ExceptionMessages::InvalidSchoolUnitTypeNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEducationLevelType, message=ExceptionMessages::InvalidEducationLevelType),
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
* id="getSchoolUnitTypes",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="total",type="integer",description="Το πλήθος των εγγραφών χωρίς τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="count",type="integer",description="Το πλήθος των εγγραφών της κλήσης σύμφωνα με τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="pagination",type="array",description="Οι παράμετροι σελιδοποίησης των εγγραφών της κλήσης",items="$ref:Pagination"),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="data",type="array",description="Ο Πίνακας με το λεξικό",items="$ref:SchoolUnitType"),
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
* id="SchoolUnitType",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με πεδία του πίνακα school_unit_types : ",
* @SWG\Property(name="school_unit_type_id",type="integer",description="Ο Κωδικός ID του Τύπου Σχολικής Μονάδας"),
* @SWG\Property(name="name",type="string",description="Το Όνομα του Τύπου Σχολικής Μονάδας"),
* @SWG\Property(name="initials",type="string",description="Τα Αρχικά του Ονόματος του Τύπου Σχολικής Μονάδας"),
* @SWG\Property(name="education_level_id",type="integer",description="O Κωδικός ID του Επιπέδου Εκπαίδευσης"),
* @SWG\Property(name="education_level_name",type="string",description="Το Όνομα του Επιπέδου Εκπαίδευσης")
* )
* 
*/

function GetSchoolUnitTypes( $school_unit_type_id, $name, $education_level,
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
       $pagesize = Pagination::getPagesize($pagesize, $params, true);     
       $searchtype = Filters::getSearchType($searchtype, $params);
       $ordertype =  Filters::getOrderType($ordertype, $params);
    
 //$orderby=====================================================================
       $columns = array(
                            "sut.schoolUnitTypeId"  => "school_unit_type_id",
                            "sut.name"              => "name",
                            "el.educationLevelId"   => "education_level_id",
                            "el.name"               => "education_level_name"
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "school_unit_type_id";
        else
        {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        } 
        
//$school_unit_type_id==========================================================
        if (Validator::Exists('school_unit_type_id', $params)){
            CRUDUtils::setFilter($qb, $school_unit_type_id, "sut", "schoolUnitTypeId", "schoolUnitTypeId", "id", ExceptionMessages::InvalidSchoolUnitTypeIDType, ExceptionCodes::InvalidSchoolUnitTypeIDType);
        } 

//$name=========================================================================
        if (Validator::Exists('name', $params)){
            CRUDUtils::setSearchFilter($qb, $name, "sut", "name", $searchtype, ExceptionMessages::InvalidSchoolUnitTypeNameType, ExceptionCodes::InvalidSchoolUnitTypeNameType);    
        }  

//$education_level==================================================================
        if (Validator::Exists('education_level', $params)){
            CRUDUtils::setFilter($qb, $education_level, "el", "educationLevelId", "name", "id,value", ExceptionMessages::InvalidEducationLevelType, ExceptionCodes::InvalidEducationLevelType);
        } 
        
//execution=====================================================================
        $qb->select('sut');
        $qb->from('SchoolUnitTypes', 'sut');
        $qb->leftjoin('sut.educationLevel', 'el');
        $qb->orderBy(array_search($orderby, $columns), $ordertype);

//pagination and results========================================================      
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        $results->getQuery()->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $results->getQuery()->setMaxResults($pagesize) : null;

//data results==================================================================       
        $count = 0;
        foreach ($results as $schoolunittype)
        {

            $result["data"][] = array(
                                        "school_unit_type_id"     => $schoolunittype->getSchoolUnitTypeId(),
                                        "name"                    => $schoolunittype->getName(),
                                        "initials"                => $schoolunittype->getInitials(),
                                        "education_level_id"      => Validator::IsNull($schoolunittype->getEducationLevel()) ? Validator::ToNull() : $schoolunittype->getEducationLevel()->getEducationLevelId(),
                                        "education_level_name"    => Validator::IsNull($schoolunittype->getEducationLevel()) ? Validator::ToNull() : $schoolunittype->getEducationLevel()->getName()
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