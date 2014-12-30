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
* apiVersion="2.0",
* swaggerVersion="2.0",
* basePath=BASE_PATH,
* resourcePath="/aquisition_sources",
* description="Τύποι Πηγών Χρηματοδότησης",
* produces="['application/json']",
* @SWG\Api(
*   path="/aquisition_sources",
*   @SWG\Operation(
*                   method="GET",
*                   summary="Αναζήτηση σε Τύπoυς Πηγών Χρηματοδότησης",
*                   notes="Επιστρέφει τους Τύπους Πηγών Χρηματοδότησης",
*                   type="GetAquisitionSource",
*                   nickname="getAquisitionSources",
*   @SWG\Parameter(
*                   name="aquisition_source_id",
*                   description="ID Πηγής Χρηματοδότησης",
*                   required=false,
*                   type="integer",
*                   paramType="query"
*   ),
*   @SWG\Parameter(
*                   name="name",
*                   description="Όνομα Πηγής Χρηματοδότησης",
*                   required=false,
*                   type="text",
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
*                   type="text",
*                   paramType="query",
*                   enum = "['EXACT','CONTAIN','CONTAINALL','CONTAINANY','STARTWITH','ENDWITH']"
*                   ),
*   @SWG\Parameter(
*                   name="ordertype",
*                   description="Τύπος Ταξινόμησης",
*                   required=false,
*                   type="text",
*                   paramType="query",
*                   enum = "['ASC','DESC']"
*                   ),
*   @SWG\Parameter(
*                   name="orderby",
*                   description="Πεδίο Ταξινόμησης",
*                   required=false,
*                   type="text",
*                   paramType="query",
*                   enum = "['aquisition_source_id','name']"
*                   ),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidAquisitionSourceIDType, message=ExceptionMessages::InvalidAquisitionSourceIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidAquisitionSourceNameType, message=ExceptionMessages::InvalidAquisitionSourceNameType),
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
* id="GetAquisitionSource",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που εκτελείτε από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="total",type="integer",description="Το πλήθος των εγγραφών χωρίς τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="count",type="integer",description="Το πλήθος των εγγραφών της κλήσης σύμφωνα με τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="pagination",type="array",description="Οι παράμετροι σελιδοποίησης των εγγραφών της κλήσης",items="$ref:Pagination"),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="data",type="array",description="Ο Πίνακας με το λεξικό",items="$ref:AquisitionSource"),
* )
* 
* @SWG\Model(
* id="Pagination",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με πληροφορίες σελιδοποίησης : ",
* @SWG\Property(name="page",type="string",description="Ο αριθμός της σελίδας των αποτελεσμάτων"),
* @SWG\Property(name="maxPage",type="string",description="Ο μέγιστος αριθμός της σελίδας των αποτελεσμάτων"),
* @SWG\Property(name="pagesize",type="integer",description="Ο αριθμός των εγγραφών προς επιστροφή"),
* )
* 
* @SWG\Model(
* id="AquisitionSource",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με πεδία του πίνακα Aquisition_sources : ",
* @SWG\Property(name="aquisition_source_id",type="integer",description="Ο Κωδικός της Πηγής Χρηματοδότησης"),
* @SWG\Property(name="name",type="string",description="Το Όνομα της Πηγής Χρηματοδότησης")
* )
* 
*/

/** 
 * 
 * Η συνάρτηση αυτή επιστρέφει όλους τους Τύπους Πηγών Χρηματοδότησης σύμφωνα με τις παραμέτρους που έγινε η κλήση
 * <br>Τα αποτελέσματα είναι ταξινομημένα ως προς το όνομα του Τύπου Πηγής Χρηματοδότησης κατά αύξουσα φορά.
 * 
 * Η κλήση μπορεί να γίνει μέσω της παρακάτω διεύθυνσης με τη μέθοδο GET :
 * <br> http://mmsch.teiath.gr/mylab/api/aquisition_sources
 *
 * Στον πίνακα <a href="#parameters">Parameters summary</a> εμφανίζονται όλοι οι παράμετροι με τους οποίους μπορεί να γίνει η κλήση
 * <br>Όλοι οι παράμετροι είναι προαιρετικοί εκτός από αυτές που έχουν χαρακτηριστεί ως υποχρεωτικοί
 * <br>Οι παράμετροι μπορούν να χρησιμοποιηθούν με οποιαδήποτε σειρά
 * 
 * Στον πίνακα <a href="#returns">Return value summary</a> εμφανίζονται οι μεταβλητές που επιστρέφει η συνάρτηση
 * <br>Όλες οι μεταβλητές επιστρέφονται σε ένα πίνακα σε JSON μορφή
 * <br>Η μεταβλητή data είναι ο πίνακας με το λεξικό
 * 
 * Στον πίνακα <a href="#data">Results</a> εμφανίζονται τα αποτελεσματα της κλήσης της συνάρτησης.
 *
 * Στον πίνακα <a href="#throws">Thrown exceptions summary</a> εμφανίζονται τα Μηνύματα Σφαλμάτων που μπορεί να προκύψουν κατά την κλήση της συνάρτησης
 * <br>Η περιγραφή των σφαλμάτων αυτών είναι διαθέσιμη μέσω του πίνακα Μηνύματα Σφαλμάτων {@see ExceptionMessages} 
 * 
 * 
 *  
 * 
 * @param integer $pagesize Αριθμός Εγγραφών/Σελίδα
 * <br>Ο αριθμός των εγγραφών που θα επιστρέψουν ανα σελίδα (κλήση)
 * <br>Αν η παράμετρος δεν έχει τιμή τότε θα επιστραφούν οι προκαθορισμένες εγγραφές
 * <br>Η τιμή της παραμέτρου μπορεί να είναι : integer
 *    <ul>
 *       <li>integer : Αριθμητική {@see Parameters}</li>
 *    </ul>
 * 
 * @param integer $page Αριθμός Σελίδας
 * <br>Ο αριθμός της σελίδας με τις $pagesize εγγραφές που βρέθηκαν σύμφωμα με τις παραμέτρους
 * <br>Αν η παράμετρος δεν έχει τιμή τότε θα επιστραφεί η πρώτη σελίδα
 * <br>Η τιμή της παραμέτρου μπορεί να είναι : integer
 *    <ul>
 *       <li>integer : Αριθμητική {@see Parameters}</li>
 *    </ul>
 * 
 */

function GetAquisitionSources( $aquisition_source_id, $name, 
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
      
//$orderby======================================================================
       $columns = array(
                            "aqs.aquisitionSourceId" => "aquisition_source_id",
                            "aqs.name" => "name"
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "aquisition_source_id";
       else
       {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
       }
                      
//$aquisition_source_id=========================================================
        if (Validator::Exists('aquisition_source_id', $params)){
            CRUDUtils::setFilter($qb, $aquisition_source_id, "aqs", "aquisitionSourceId", "aquisitionSourceId", "id", ExceptionMessages::InvalidAquisitionSourceIDType, ExceptionCodes::InvalidAquisitionSourceIDType);
        } 

//$name=========================================================================
        if (Validator::Exists('name', $params)){
            CRUDUtils::setSearchFilter($qb, $name, "aqs", "name", $searchtype, ExceptionMessages::InvalidAquisitionSourceNameType, ExceptionCodes::InvalidAquisitionSourceNameType);    
        } 
             
//execution=====================================================================
        $qb->select('aqs');
        $qb->from('AquisitionSources', 'aqs');  
        $qb->orderBy(array_search($orderby, $columns), $ordertype);

//pagination and results========================================================      
        
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        $results->getQuery()->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $results->getQuery()->setMaxResults($pagesize) : null;
       
//data results==================================================================       
        $count = 0;
        foreach ($results as $worker)
        {

            $result["data"][] = array(
                                        "aquisition_source_id"  => $worker->getAquisitionSourceId(),
                                        "name"                  => $worker->getName(),
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