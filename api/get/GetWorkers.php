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
* resourcePath="/workers",
* description="Εργαζόμενοι Σχολικών Μονάδων",
* produces="['application/json']",
* @SWG\Api(
*   path="/workers",
*   @SWG\Operation(
*                   method="GET",
*                   summary="Αναζήτηση στους Εργαζόμενους Σχολικών Μονάδων",
*                   notes="Επιστρέφει τους Εργαζόμενους Σχολικών Μονάδων.Τα στοιχεία τα λαμβάνουμε με συγχρονισμό από το ΜΜ.",
*                   type="getWorkers",
*                   nickname="GetWorkers",
* 
*   @SWG\Parameter( name="worker_id", description="ID Εργαζόμενου Σχολικής Μονάδας [notNull]", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="registry_no", description="Α.Μ. Εργαζόμενου Σχολικής Μονάδας [notNull]", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="tax_number", description=" Α.Φ.Μ. Εργαζόμενου Σχολικής Μονάδας", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="firstname", description="Όνομα Εργαζόμενου Σχολικής Μονάδας (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="lastname", description="Επώνυμο Εργαζόμενου Σχολικής Μονάδας (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="fathername", description="Όνομα Πατρός Εργαζόμενου Σχολικής Μονάδας (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="sex", description="Φύλο Εργαζόμενου Σχολικής Μονάδας", required=false, type="string|array[string]", paramType="query", enum="['Α','Γ']" ),
*   @SWG\Parameter( name="worker_specialization", description="Όνομα ή ID Ειδικότητας Εργαζόμενου Σχολικής Μονάδας", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="source", description="Όνομα ή ID Πρωτογενούς Πηγής Δεδομένων Εργαζόμενου Σχολικής Μονάδας", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="worker", description="Διπλή Παράμετρος(balander): Α.Μ. Εργαζόμενου Σχολικής Μονάδας (με παράμετρο searchtype=startwith) ή Επώνυμο Εργαζόμενου Σχολικής Μονάδας (συνδυάζεται με την παράμετρο searchtype)", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*
*   @SWG\Parameter( name="page", description="Αριθμός Σελίδας", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="pagesize", description="Αριθμός Εγγραφών/Σελίδα", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="searchtype", description="Τύπος αναζήτησης", required=false, type="string", paramType="query", enum = "['EXACT','CONTAIN','CONTAINALL','CONTAINANY','STARTWITH','ENDWITH']" ),
*   @SWG\Parameter( name="ordertype", description="Τύπος Ταξινόμησης", required=false, type="string", paramType="query", enum = "['ASC','DESC']" ),
*   @SWG\Parameter( name="orderby", description="Πεδίο Ταξινόμησης", required=false, type="string", paramType="query",
*                   enum = "['worker_id','registry_no','tax_number','firstname','lastname','fathername','sex','worker_specialization_id','worker_specialization_name','source_id','source_name']" ),
*   @SWG\Parameter( name="debug", description="Επιστροφή SQL/DQL Queries", required=false, type="boolean", paramType="query", enum = "['true','false']" ),  
* 
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidWorkerIDType, message=ExceptionMessages::InvalidWorkerIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidWorkerRegistryNoType, message=ExceptionMessages::InvalidWorkerRegistryNoType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidWorkerTaxNumberType, message=ExceptionMessages::InvalidWorkerTaxNumberType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidWorkerFirstnameType, message=ExceptionMessages::InvalidWorkerFirstnameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidWorkerLastnameType, message=ExceptionMessages::InvalidWorkerLastnameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidWorkerFatherNameType, message=ExceptionMessages::InvalidWorkerFatherNameType), 
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidWorkerSexTypeType, message=ExceptionMessages::InvalidWorkerSexTypeType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidWorkerSpecializationType, message=ExceptionMessages::InvalidWorkerSpecializationType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSourceType, message=ExceptionMessages::InvalidSourceType),
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
* id="getWorkers",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="total",type="integer",description="Το πλήθος των εγγραφών χωρίς τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="count",type="integer",description="Το πλήθος των εγγραφών της κλήσης σύμφωνα με τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="pagination",type="array",description="Οι παράμετροι σελιδοποίησης των εγγραφών της κλήσης",items="$ref:Pagination"),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="data",type="array",description="Ο Πίνακας με τα αποτελέσματα",items="$ref:Worker"),
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
* id="Worker",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με στοιχεία του πίνακα workers: ",
* @SWG\Property(name="worker_id",type="integer",description="Ο Κωδικός ID του Εργαζόμενου Σχολικής Μονάδας"),
* @SWG\Property(name="registry_no",type="integer",description="Ο Α.Μ. του Εργαζόμενου Σχολικής Μονάδας"),
* @SWG\Property(name="tax_number",type="integer",description="Το Α.Φ.Μ. του Εργαζόμενου Σχολικής Μονάδας"),
* @SWG\Property(name="firstname",type="string",description="Το Όνομα του Εργαζόμενου Σχολικής Μονάδας"),
* @SWG\Property(name="lastname",type="string",description="Το Επώνυμο του Εργαζόμενου Σχολικής Μονάδας"),
* @SWG\Property(name="fathername",type="string",description="Το Όνομα Πατρός του Εργαζόμενου Σχολικής Μονάδας"),
* @SWG\Property(name="sex",type="string",description="Το Φύλο του Εργαζόμενου Σχολικής Μονάδας (Α=Αντρας,Γ=Γυναίκα)"),
* @SWG\Property(name="worker_specialization",type="integer",description="Ο Κωδικός ID της Ειδικότητας Εργαζόμενου Σχολικής Μονάδας"),
* @SWG\Property(name="worker_specialization_name",type="string",description="Το Όνομα της Ειδικότητας Εργαζόμενου Σχολικής Μονάδας"),
* @SWG\Property(name="source_id",type="integer",description="Ο Κωδικός ID της Πρωτογενούς Πηγής Δεδομένων Εργαζόμενου Σχολικής Μονάδας"),
* @SWG\Property(name="source_name",type="string",description="Το Όνομα της Πρωτογενούς Πηγής Δεδομένων Εργαζόμενου Σχολικής Μονάδας")
* )
* 
*/

function GetWorkers( $worker_id, $registry_no, $tax_number, $firstname, $lastname, $fathername, $sex,
                     $worker_specialization, $source,
                     $worker,
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
                            "w.workerId" => "worker_id",
                            "w.registryNo" => "registry_no",
                            "w.taxNumber" => "tax_number" ,
                            "w.firstname" => "firstname",
                            "w.lastname" => "lastname",
                            "w.fathername" => "fathername",
                            "w.sex" => "sex",
                            "ws.workerSpecializationId" => "worker_specialization_id",
                            "ws.name" => "worker_specialization_name",
                            "s.sourceId" => "source_id",
                            "s.name" => "source_name"
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "worker_id";
        else
        {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        }
                      
//$worker_id====================================================================
        if (Validator::Exists('worker_id', $params)){
            CRUDUtils::setFilter($qb, $worker_id, "w", "workerId", "workerId", "id", ExceptionMessages::InvalidWorkerIDType, ExceptionCodes::InvalidWorkerIDType);
        } 

//$registry_number==============================================================
        if (Validator::Exists('registry_no', $params)){
            CRUDUtils::setFilter($qb, $registry_no, "w", "registryNo", "registryNo", "numeric", ExceptionMessages::InvalidWorkerRegistryNoType, ExceptionCodes::InvalidWorkerRegistryNoType);    
        }
        
//$tax_number===================================================================
        if (Validator::Exists('tax_number', $params)){
            CRUDUtils::setFilter($qb, $tax_number, "w", "taxNumber", "taxNumber", "null,numeric", ExceptionMessages::InvalidWorkerTaxNumberType, ExceptionCodes::InvalidWorkerTaxNumberType);    
        } 

//$firstname====================================================================
        if (Validator::Exists('firstname', $params)){
            CRUDUtils::setSearchFilter($qb, $firstname, "w", "firstname", $searchtype, ExceptionMessages::InvalidWorkerFirstnameType, ExceptionCodes::InvalidWorkerFirstnameType);    
        } 

//$lastname=====================================================================
        if (Validator::Exists('lastname', $params)){
            CRUDUtils::setSearchFilter ($qb, $lastname, "w", "lastname", $searchtype, ExceptionMessages::InvalidWorkerLastnameType, ExceptionCodes::InvalidWorkerLastnameType);
        }  

//$fathername===================================================================
        if (Validator::Exists('fathername', $params)){
            CRUDUtils::setSearchFilter($qb, $fathername, "w", "fathername", $searchtype, ExceptionMessages::InvalidWorkerFatherNameType, ExceptionCodes::InvalidWorkerFatherNameType);    
        } 

//$sex==========================================================================
        if (Validator::Exists('sex', $params)){
            CRUDUtils::setFilter($qb, $sex, "w", "sex", "sex", "null,value", ExceptionMessages::InvalidWorkerSexTypeType, ExceptionCodes::InvalidWorkerSexTypeType);    
        } 

//$worker_specialization========================================================
        if (Validator::Exists('worker_specialization', $params)){
            CRUDUtils::setFilter($qb, $worker_specialization, "ws", "workerSpecializationId", "name", "null,id,value", ExceptionMessages::InvalidWorkerSpecializationType, ExceptionCodes::InvalidWorkerSpecializationType);    
        }  
        
//$source=======================================================================
        if (Validator::Exists('source', $params)){
            CRUDUtils::setFilter($qb, $source, "s", "sourceId", "name", "null,id,value", ExceptionMessages::InvalidSourceType, ExceptionCodes::InvalidSourceType);    
        } 
        
//balander parameter============================================================        
        if (Validator::Exists('worker', $params)){

            if (Validator::IsID($worker))
                CRUDUtils::setFilter($qb, $worker, "w", "registryNo", "registryNo", "startWith", ExceptionMessages::InvalidWorkerRegistryNoType, ExceptionCodes::InvalidWorkerRegistryNoType);    
            else
                CRUDUtils::setSearchFilter ($qb, $worker, "w", "lastname", $searchtype, ExceptionMessages::InvalidWorkerLastnameType, ExceptionCodes::InvalidWorkerLastnameType);
        } 

//execution=====================================================================
        $qb->select('w');
        $qb->from('Workers', 'w');
        $qb->leftjoin('w.workerSpecialization', 'ws');
        $qb->leftjoin('w.source', 's');
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
                                        "worker_id"        => $worker->getWorkerId(),
                                        "registry_no"      => $worker->getRegistryNo(),
                                        "tax_number"       => $worker->getTaxNumber(),
                                        "firstname"        => $worker->getFirstname(),
                                        "lastname"         => $worker->getLastname(),
                                        "fathername"       => $worker->getFathername(),
                                        "sex"              => $worker->getSex(),
                                        "worker_specialization"      => Validator::IsNull($worker->getWorkerSpecialization()) ? Validator::ToNull() : $worker->getWorkerSpecialization()->getWorkerSpecializationId(),
                                        "worker_specialization_name" => Validator::IsNull($worker->getWorkerSpecialization()) ? Validator::ToNull() : $worker->getWorkerSpecialization()->getName(),
                                        "source"      => Validator::IsNull($worker->getSource()) ? Validator::ToNull() : $worker->getSource()->getSourceId(),
                                        "source_name" => Validator::IsNull($worker->getSource()) ? Validator::ToNull() : $worker->getSource()->getName()
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