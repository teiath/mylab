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
* resourcePath="/mylab_workers",
* description="Εργαζόμενοι",
* produces="['application/json']",
* @SWG\Api(
*   path="/mylab_workers",
*   @SWG\Operation(
*                   method="GET",
*                   summary="Αναζήτηση στους Εργαζόμενους",
*                   notes="Επιστρέφει τους Εργαζόμενους.Τα στοιχεία τα αποθηκεύουμε με χρήση της function ldap_workers από το ΠΣΔ LDAP.",
*                   type="getMylabWorkers",
*                   nickname="GetMylabWorkers",
* 
*   @SWG\Parameter( name="worker_id", description="ID Εργαζόμενου [notNull]", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="registry_no", description="Α.Μ. ή Α.Φ.Μ. Εργαζόμενου [notNull]", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="uid", description="UID Εργαζόμενου (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="firstname", description="Όνομα Εργαζόμενου (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="lastname", description="Επώνυμο Εργαζόμενου (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="fathername", description="Όνομα Πατρός Εργαζόμενου (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="email", description="Email Εργαζόμενου (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="worker_specialization", description="Όνομα ή ID Ειδικότητας Εργαζόμενου", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="lab_source", description="Όνομα ή ID Πρωτογενούς Πηγής Δεδομένων Εργαζόμενου", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="worker", description="Διπλή Παράμετρος(balander): Α.Μ./Α.Φ.Μ. Εργαζόμενου(με παράμετρο searchtype=startwith) ή Επώνυμο Εργαζόμενου (συνδυάζεται με την παράμετρο searchtype)", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*
*   @SWG\Parameter( name="page", description="Αριθμός Σελίδας", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="pagesize", description="Αριθμός Εγγραφών/Σελίδα", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="searchtype", description="Τύπος αναζήτησης", required=false, type="string", paramType="query", enum = "['EXACT','CONTAIN','CONTAINALL','CONTAINANY','STARTWITH','ENDWITH']" ),
*   @SWG\Parameter( name="ordertype", description="Τύπος Ταξινόμησης", required=false, type="string", paramType="query", enum = "['ASC','DESC']" ),
*   @SWG\Parameter( name="orderby", description="Πεδίο Ταξινόμησης", required=false, type="string", paramType="query",
*                   enum = "['worker_id','registry_no','uid','firstname','lastname','fathername','email','worker_specialization_id','worker_specialization_name','lab_source_id','lab_source_name']" ),
*   @SWG\Parameter( name="debug", description="Επιστροφή SQL/DQL Queries", required=false, type="boolean", paramType="query", enum = "['true','false']" ),  
* 
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerIDType, message=ExceptionMessages::InvalidMylabWorkerIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerRegistryNoType, message=ExceptionMessages::InvalidMylabWorkerRegistryNoType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerUidType, message=ExceptionMessages::InvalidMylabWorkerUidType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerFirstnameType, message=ExceptionMessages::InvalidMylabWorkerFirstnameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerLastnameType, message=ExceptionMessages::InvalidMylabWorkerLastnameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerFathernameType, message=ExceptionMessages::InvalidMylabWorkerFathernameType), 
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerEmailType, message=ExceptionMessages::InvalidMylabWorkerEmailType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidWorkerSpecializationType, message=ExceptionMessages::InvalidWorkerSpecializationType),
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
* id="getMylabWorkers",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="total",type="integer",description="Το πλήθος των εγγραφών χωρίς τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="count",type="integer",description="Το πλήθος των εγγραφών της κλήσης σύμφωνα με τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="pagination",type="array",description="Οι παράμετροι σελιδοποίησης των εγγραφών της κλήσης",items="$ref:Pagination"),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="data",type="array",description="Ο Πίνακας με τα αποτελέσματα",items="$ref:MylabWorker"),
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
* id="MylabWorker",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με στοιχεία του πίνακα mylab_workers: ",
* @SWG\Property(name="worker_id",type="integer",description="Ο Κωδικός ID του Εργαζόμενου"),
* @SWG\Property(name="registry_no",type="integer",description="Ο Α.Μ. ή το Α.Φ.Μ. Εργαζόμενου (Α.Φ.Μ = 9ψηφιο , Α.Μ. = 6ψηφιο)"),
* @SWG\Property(name="uid",type="string",description="Το μοναδικό UID όνομα του Εργαζόμενου (uid name from ldap)"),
* @SWG\Property(name="firstname",type="string",description="Το Όνομα του Εργαζόμενου"),
* @SWG\Property(name="lastname",type="string",description="Το Επώνυμο του Εργαζόμενου"),
* @SWG\Property(name="fathername",type="string",description="Το Όνομα Πατρός του Εργαζόμενου"),
* @SWG\Property(name="email",type="string",description="Το email του Εργαζόμενου"),
* @SWG\Property(name="worker_specialization",type="integer",description="Ο Κωδικός ID της Ειδικότητας Εργαζόμενου"),
* @SWG\Property(name="worker_specialization_name",type="string",description="Το Όνομα της Ειδικότητας Εργαζόμενου"),
* @SWG\Property(name="lab_source_id",type="integer",description="Ο Κωδικός ID της Πρωτογενούς Πηγής Δεδομένων Εργαζόμενων"),
* @SWG\Property(name="lab_source_name",type="string",description="Το Όνομα της Πρωτογενούς Πηγής Δεδομένων Εργαζόμενων")
* )
* 
*/

function GetMylabWorkers( $worker_id, $registry_no, $uid, $firstname, $lastname, $fathername, $email,
                          $worker_specialization, $lab_source,
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
                            "mlw.workerId" => "worker_id",
                            "mlw.registryNo" => "registry_no",
                            "mlw.uid" => "uid" ,
                            "mlw.firstname" => "firstname",
                            "mlw.lastname" => "lastname",
                            "mlw.fathername" => "fathername",
                            "mlw.fathername" => "email",
                            "ws.workerSpecializationId" => "worker_specialization_id",
                            "ws.name" => "worker_specialization_name",
                            "ls.labSourceId" => "lab_source_id",
                            "ls.name" => "lab_source_name"
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
            CRUDUtils::setFilter($qb, $worker_id, "mlw", "workerId", "workerId", "id", ExceptionMessages::InvalidMylabWorkerIDType, ExceptionCodes::InvalidMylabWorkerIDType);
        } 

//$registry_number==============================================================
        if (Validator::Exists('registry_no', $params)){
            CRUDUtils::setFilter($qb, $registry_no, "mlw", "registryNo", "registryNo", "numeric", ExceptionMessages::InvalidMylabWorkerRegistryNoType, ExceptionCodes::InvalidMylabWorkerRegistryNoType);    
        }
        
//$uid===================================================================
        if (Validator::Exists('uid', $params)){
            CRUDUtils::setSearchFilter($qb, $uid, "mlw", "uid", $searchtype, ExceptionMessages::InvalidMylabWorkerUidType, ExceptionCodes::InvalidMylabWorkerUidType);    
        } 

//$firstname====================================================================
        if (Validator::Exists('firstname', $params)){
            CRUDUtils::setSearchFilter($qb, $firstname, "mlw", "firstname", $searchtype, ExceptionMessages::InvalidMylabWorkerFirstnameType, ExceptionCodes::InvalidMylabWorkerFirstnameType);    
        } 

//$lastname=====================================================================
        if (Validator::Exists('lastname', $params)){
            CRUDUtils::setSearchFilter ($qb, $lastname, "mlw", "lastname", $searchtype, ExceptionMessages::InvalidMylabWorkerLastnameType, ExceptionCodes::InvalidMylabWorkerLastnameType);
        }  

//$fathername===================================================================
        if (Validator::Exists('fathername', $params)){
            CRUDUtils::setSearchFilter($qb, $fathername, "mlw", "fathername", $searchtype, ExceptionMessages::InvalidMylabWorkerFathernameType, ExceptionCodes::InvalidMylabWorkerFathernameType);    
        } 

//$email========================================================================
        if (Validator::Exists('email', $params)){
            CRUDUtils::setSearchFilter($qb, $email, "mlw", "email", $searchtype, ExceptionMessages::InvalidMylabWorkerEmailType, ExceptionCodes::InvalidMylabWorkerEmailType);    
        } 
        
//$worker_specialization========================================================
        if (Validator::Exists('worker_specialization', $params)){
            CRUDUtils::setFilter($qb, $worker_specialization, "ws", "workerSpecializationId", "name", "null,id,value", ExceptionMessages::InvalidWorkerSpecializationType, ExceptionCodes::InvalidWorkerSpecializationType);    
        }  
        
//$lab_source=======================================================================
        if (Validator::Exists('lab_source', $params)){
            CRUDUtils::setFilter($qb, $lab_source, "ls", "labSourceId", "name", "null,id,value", ExceptionMessages::InvalidLabSourceType, ExceptionCodes::InvalidLabSourceType);    
        } 
        
//balander parameter============================================================        
        if (Validator::Exists('worker', $params)){

            if (Validator::IsID($worker))
                CRUDUtils::setFilter($qb, $worker, "mlw", "registryNo", "registryNo", "startWith", ExceptionMessages::InvalidMylabWorkerRegistryNoType, ExceptionCodes::InvalidMylabWorkerRegistryNoType);    
            else
                CRUDUtils::setSearchFilter ($qb, $worker, "mlw", "lastname", $searchtype, ExceptionMessages::InvalidMylabWorkerLastnameType, ExceptionCodes::InvalidMylabWorkerLastnameType);
        } 

//execution=====================================================================
        $qb->select('mlw');
        $qb->from('MylabWorkers', 'mlw');
        $qb->leftjoin('mlw.workerSpecialization', 'ws');
        $qb->leftjoin('mlw.labSource', 'ls');
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
                                        "uid"              => $worker->getUid(),
                                        "firstname"        => $worker->getFirstname(),
                                        "lastname"         => $worker->getLastname(),
                                        "fathername"       => $worker->getFathername(),
                                        "email"            => $worker->getEmail(),
                                        "worker_specialization"      => Validator::IsNull($worker->getWorkerSpecialization()) ? Validator::ToNull() : $worker->getWorkerSpecialization()->getWorkerSpecializationId(),
                                        "worker_specialization_name" => Validator::IsNull($worker->getWorkerSpecialization()) ? Validator::ToNull() : $worker->getWorkerSpecialization()->getName(),
                                        "lab_source"      => Validator::IsNull($worker->getLabSource()) ? Validator::ToNull() : $worker->getLabSource()->getLabSourceId(),
                                        "lab_source_name" => Validator::IsNull($worker->getLabSource()) ? Validator::ToNull() : $worker->getLabSource()->getName()
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