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
* resourcePath="/lab_aquisition_sources",
* description="Διατάξεις Η/Υ με Πηγές Χρηματοδότησης",
* produces="['application/json']",
* @SWG\Api(
*   path="/lab_aquisition_sources",
*   @SWG\Operation(
*                   method="GET",
*                   summary="Αναζήτηση στις Διατάξεις Η/Υ με Πηγές Χρηματοδότησης",
*                   notes="Επιστρέφει τις Διατάξεις Η/Υ με Πηγές Χρηματοδότησης",
*                   type="getLabAquisitionSources",
*                   nickname="GetLabAquisitionSources",
* 
*   @SWG\Parameter( name="lab_aquisition_source_id", description="ID Διάταξης Η/Υ με Πηγή Χρηματοδότησης [notNull]", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="aquisition_year", description="Έτος Απόκτησης της Πηγής Χρηματοδότησης για την Διάταξη Η/Υ (μορφή ημερομηνίας yyyy ή null)", required=false, type="string|array[string]", format="date", paramType="query" ),
*   @SWG\Parameter( name="aquisition_source", description="Όνομα ή ID Πηγής Χρηματοδότησης", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="lab_id", description="ID Διάταξης Η/Υ [notNull]", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="lab_name", description="Όνομα Διάταξης Η/Υ (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
* 
*   @SWG\Parameter( name="page", description="Αριθμός Σελίδας", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="pagesize", description="Αριθμός Εγγραφών/Σελίδα", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="searchtype", description="Τύπος αναζήτησης", required=false, type="string", paramType="query", enum = "['EXACT','CONTAIN','CONTAINALL','CONTAINANY','STARTWITH','ENDWITH']" ),
*   @SWG\Parameter( name="ordertype", description="Τύπος Ταξινόμησης", required=false, type="string", paramType="query", enum = "['ASC','DESC']" ),
*   @SWG\Parameter( name="orderby", description="Πεδίο Ταξινόμησης", required=false, type="string", paramType="query",
*                   enum = "['lab_aquisition_source_id','aquisition_year','aquisition_source_id','aquisition_source_name','lab_id','lab_name']" ),
*   @SWG\Parameter( name="debug", description="Επιστροφή SQL/DQL Queries", required=false, type="boolean", paramType="query", enum = "['true','false']" ),  
* 
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionsError, message=ExceptionMessages::NoPermissionsError),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabAquisitionSourceIDType, message=ExceptionMessages::InvalidLabAquisitionSourceIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabAquisitionSourceYearType, message=ExceptionMessages::InvalidLabAquisitionSourceYearType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabAquisitionSourceType, message=ExceptionMessages::InvalidLabAquisitionSourceType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabIDType, message=ExceptionMessages::InvalidLabIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabNameType, message=ExceptionMessages::InvalidLabNameType),
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
* id="getLabAquisitionSources",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="total",type="integer",description="Το πλήθος των εγγραφών χωρίς τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="count",type="integer",description="Το πλήθος των εγγραφών της κλήσης σύμφωνα με τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="pagination",type="array",description="Οι παράμετροι σελιδοποίησης των εγγραφών της κλήσης",items="$ref:Pagination"),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="data",type="array",description="Ο Πίνακας με τα αποτελέσματα",items="$ref:LabAquisitionSource"),
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
* id="LabAquisitionSource",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με στοιχεία του πίνακα lab_aquisition_sources : ",
* @SWG\Property(name="lab_aquisition_source_id",type="integer",description="Ο Κωδικός ID της Διάταξης Η/Υ με Πηγή Χρηματοδότησης"),
* @SWG\Property(name="aquisition_year",type="string",description="To Έτος Απόκτησης της Πηγής Χρηματοδότησης για την Διάταξη Η/Υ (μορφή yyyy ή null)"),
* @SWG\Property(name="aquisition_comments",type="string",description="Σχόλια και Πληροφορίες σχετικά με την Πηγή Χρηματοδότησης για την Διάταξη Η/Υ "),
* @SWG\Property(name="aquisition_source_id",type="integer",description="Ο Κωδικός ID της Πηγής Χρηματοδότησης"),
* @SWG\Property(name="aquisition_source",type="string",description="Το Όνομα της Πηγής Χρηματοδότησης"),
* @SWG\Property(name="lab_id",type="integer",description="Ο Κωδικός ID της Διάταξης Η/Υ"),
* @SWG\Property(name="lab_name",type="string",description="Το Όνομα της Διάταξης Η/Υ")
* )
* 
*/
 
function GetLabAquisitionSources( $lab_aquisition_source_id, $aquisition_year, 
                                  $aquisition_source, $lab_id, $lab_name, 
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

//set user permissions==========================================================
    $permissions = CheckUserPermissions::getUserPermissions($app->request->user);

    if (Validator::IsNull($permissions['permit_labs'])){
        throw new Exception(ExceptionMessages::NoPermissionsError, ExceptionCodes::NoPermissionsError);     
    }else { 
        $permit_labs = $permissions['permit_labs'];
    }
  
//$page - $pagesize - $searchtype - $ordertype =================================
       $page = Pagination::getPage($page, $params);
       $pagesize = Pagination::getPagesize($pagesize, $params);     
       $searchtype = Filters::getSearchType($searchtype, $params);
       $ordertype =  Filters::getOrderType($ordertype, $params);
       
//$orderby======================================================================
       $columns = array(
                            "las.labAquisitionSourceId" => "lab_aquisition_source_id",
                            "las.aquisitionYear" => "aquisition_year",
                            "aqs.aquisitionSourceId" => "aquisition_source_id",
                            "aqs.name" => "aquisition_source_name",
                            "l.labId" => "lab_id",
                            "l.name" => "lab_name"
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "lab_id";
       else
       {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
       }  
    
//$lab_aquisition_source_id=====================================================
    if (Validator::Exists('lab_aquisition_source_id', $params)){
        CRUDUtils::setFilter($qb, $lab_aquisition_source_id, "las", "labAquisitionSourceId", "labAquisitionSourceId", "id", ExceptionMessages::InvalidLabAquisitionSourceIDType, ExceptionCodes::InvalidLabAquisitionSourceIDType);
    } 
      
//$aquisition_year==============================================================
    if (Validator::Exists('aquisition_year', $params)){
        CRUDUtils::setFilter($qb, $aquisition_year, "las", "aquisitionYear", "aquisitionYear", "null,date", ExceptionMessages::InvalidLabAquisitionSourceYearType, ExceptionCodes::InvalidLabAquisitionSourceYearType);
    }   
         
//$aquisition_source============================================================
    if (Validator::Exists('aquisition_source', $params)){
        CRUDUtils::setFilter($qb, $aquisition_source, "aqs", "aquisitionSourceId", "name", "null,id,value", ExceptionMessages::InvalidLabAquisitionSourceType, ExceptionCodes::InvalidLabAquisitionSourceType);
    } 
    
//$lab_id=======================================================================
    if (Validator::Exists('lab_id', $params)){
        CRUDUtils::setFilter($qb, $lab_id, "l", "labId", "labId", "id", ExceptionMessages::InvalidLabIDType, ExceptionCodes::InvalidLabIDType);
    } 
    
//$lab_name=====================================================================
    if (Validator::Exists('lab_name', $params)){
        CRUDUtils::setSearchFilter($qb, $lab_name, "l", "name", $searchtype, ExceptionMessages::InvalidLabNameType, ExceptionCodes::InvalidLabNameType);   
    }
 
 //execution====================================================================

        $qb->select('las');
        $qb->from('LabAquisitionSources', 'las');
        $qb->leftjoin('las.aquisitionSource', 'aqs');
        $qb->leftjoin('las.lab', 'l');
        $qb->orderBy(array_search($orderby, $columns), $ordertype);
 
        if ($permit_labs !== 'ALLRESULTS'){
            $qb->andWhere($qb->expr()->in('l.labId', ':ids'))
                ->setParameter('ids', $permit_labs);
        }
  
//pagination and results========================================================     
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        $results->getQuery()->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $results->getQuery()->setMaxResults($pagesize) : null;

//data results==================================================================       
        $count = 0;
        foreach ($results as $labaquisitionsource)
        {

            $result["data"][] = array(              
                                        "lab_aquisition_source_id"  => $labaquisitionsource->getLabAquisitionSourceId(),
                                        "aquisition_year"           => $labaquisitionsource->getAquisitionYear(),
                                        "aquisition_comments"       => $labaquisitionsource->getAquisitionComments(),
                                        "aquisition_source_id"      => Validator::IsNull($labaquisitionsource->getAquisitionSource()) ? Validator::ToNull() : $labaquisitionsource->getAquisitionSource()->getAquisitionSourceId(),
                                        "aquisition_source"         => Validator::IsNull($labaquisitionsource->getAquisitionSource()) ? Validator::ToNull() : $labaquisitionsource->getAquisitionSource()->getName(),
                                        "lab_id"                    => $labaquisitionsource->getLab()->getLabId(),
                                        "lab_name"                  => $labaquisitionsource->getLab()->getName()
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