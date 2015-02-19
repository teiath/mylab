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
* resourcePath="/lab_workers",
* description="Υπεύθυνοι Διατάξεων",
* produces="['application/json']",
* @SWG\Api(
*   path="/lab_workers",
*   @SWG\Operation(
*                   method="GET",
*                   summary="Αναζήτηση στους Υπεύθυνους Διατάξεων Η/Υ",
*                   notes="Επιστρέφει τους Υπεύθυνους Διατάξεων Η/Υ",
*                   type="getLabWorkers",
*                   nickname="GetLabWorkers",
* 
*   @SWG\Parameter( name="lab_worker_id", description="ID Υπεύθυνου Διατάξης Η/Υ [notNull]", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="worker_status", description="Κατάσταση Υπεύθυνου Διατάξης Η/Υ [notNull](1=Ενεργός,3=Μη Ενεργός)", required=false, type="integer|array[integer]", paramType="query", enum="['1','3']" ),
*   @SWG\Parameter( name="worker_start_service", description="Ημερομηνία Αλλαγής Μετάβασης Λειτουργικής Καταστάσης Διατάξης [notNull](μορφή ημερομηνίας dd/mm/yyyy)", required=false, type="string", format="date", paramType="query" ),
*   @SWG\Parameter( name="worker_id", description="ID Εργαζόμενου από LDAP ΠΣΔ [notNull]", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="worker_position", description="Όνομα ή ID Θέσης Εργασίας Εργαζόμενου [notNull]", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="lab_id", description="ID Διάταξης Η/Υ [notNull]", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="lab_name", description="Όνομα Διάταξης Η/Υ (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
* 
*   @SWG\Parameter( name="page", description="Αριθμός Σελίδας", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="pagesize", description="Αριθμός Εγγραφών/Σελίδα", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="searchtype", description="Τύπος αναζήτησης", required=false, type="string", paramType="query", enum = "['EXACT','CONTAIN','CONTAINALL','CONTAINANY','STARTWITH','ENDWITH']" ),
*   @SWG\Parameter( name="ordertype", description="Τύπος Ταξινόμησης", required=false, type="string", paramType="query", enum = "['ASC','DESC']" ),
*   @SWG\Parameter( name="orderby", description="Πεδίο Ταξινόμησης", required=false, type="string", paramType="query",
*                   enum = "['lab_worker_id','worker_status','worker_start_service','worker_id','worker_position_id','worker_position_name','lab_id','lab_name']" ),
*   @SWG\Parameter( name="debug", description="Επιστροφή SQL/DQL Queries", required=false, type="boolean", paramType="query", enum = "['true','false']" ),  
* 
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionsError, message=ExceptionMessages::NoPermissionsError),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerIDType, message=ExceptionMessages::InvalidLabWorkerIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerStatusType, message=ExceptionMessages::InvalidLabWorkerStatusType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabWorkerStartServiceType, message=ExceptionMessages::InvalidLabWorkerStartServiceType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMylabWorkerIDType, message=ExceptionMessages::InvalidMylabWorkerIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidWorkerPositionType, message=ExceptionMessages::InvalidWorkerPositionType), 
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
* id="getLabWorkers",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="total",type="integer",description="Το πλήθος των εγγραφών χωρίς τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="count",type="integer",description="Το πλήθος των εγγραφών της κλήσης σύμφωνα με τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="pagination",type="array",description="Οι παράμετροι σελιδοποίησης των εγγραφών της κλήσης",items="$ref:Pagination"),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="data",type="array",description="Ο Πίνακας με τα αποτελέσματα",items="$ref:LabWorker"),
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
* id="LabWorker",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με στοιχεία του πίνακα lab_workers: ",
* @SWG\Property(name="lab_worker_id",type="integer",description="Το ID του Υπεύθυνου Διατάξης Η/Υ"),
* @SWG\Property(name="worker_status",type="string",description="Η Κατάσταση του Υπεύθυνου Διατάξης Η/Υ (1=Ενεργός,3=Μη Ενεργός)"),
* @SWG\Property(name="worker_start_service",type="string",description="Ημερομηνία Αλλαγής Μετάβασης Λειτουργικής Καταστάσης Διατάξης (μορφή ημερομηνίας dd/mm/yyyy)"),
* @SWG\Property(name="worker_id",type="integer",description="Ο Κωδικός ID του Εργαζόμενου από LDAP ΠΣΔ"),
* @SWG\Property(name="worker_registry_no",type="integer",description="Ο Α.Μ. ή το Α.Φ.Μ. Εργαζόμενου (Α.Φ.Μ = 9ψηφιο , Α.Μ. = 6ψηφιο)"),
* @SWG\Property(name="uid",type="string",description="Το μοναδικό UID όνομα του Εργαζόμενου (uid name from ldap)"),
* @SWG\Property(name="firstname",type="string",description="Το Όνομα του Εργαζόμενου"),
* @SWG\Property(name="lastname",type="string",description="Το Επώνυμο του Εργαζόμενου"),
* @SWG\Property(name="fathername",type="string",description="Το Όνομα Πατρός του Εργαζόμενου"),
* @SWG\Property(name="email",type="string",description="Το email του Εργαζόμενου"),
* @SWG\Property(name="specialization_code_id",type="integer",description="Ο Κωδικός ID της Ειδικότητας του Εργαζόμενου"),
* @SWG\Property(name="specialization_code_name",type="string",description="Το Όνομα της Ειδικότητας του Εργαζόμενου"),
* @SWG\Property(name="worker_position_id",type="integer",description="Ο Κωδικός ID της Θέσης Εργασίας του Εργαζόμενου"),
* @SWG\Property(name="worker_position_name",type="string",description="Το Όνομα της Θέσης Εργασίας του Εργαζόμενου"),
* @SWG\Property(name="lab_id",type="integer",description="Ο Κωδικός ID της Διάταξης Η/Υ"),
* @SWG\Property(name="lab_name",type="string",description="Το Όνομα της Διάταξης Η/Υ")
* )
* 
*/

function GetLabWorkers( $lab_worker_id, $worker_status, $worker_start_service,
                        $worker_id, $worker_position, $lab_id, $lab_name,
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
                            "lw.labWorkerId" => "lab_worker_id",
                            "lw.workerStatus" => "worker_status",
                            "lw.workerStartService" => "worker_start_service",
                            "mlw.workerId" => "worker_id",
                            "wp.workerPositionId" => "worker_position_id",
                            "wp.name" => "worker_position_name",
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
    
//$lab_worker_id================================================================
    if (Validator::Exists('lab_worker_id', $params)){
        CRUDUtils::setFilter($qb, $lab_worker_id, "lw", "labWorkerId", "labWorkerId", "id", ExceptionMessages::InvalidLabWorkerIDType, ExceptionCodes::InvalidLabWorkerIDType);
    } 
      
//$worker_status================================================================
    if (Validator::Exists('worker_status', $params)){
        CRUDUtils::setFilter($qb, $worker_status, "lw", "workerStatus", "workerStatus", "numeric", ExceptionMessages::InvalidLabWorkerStatusType, ExceptionCodes::InvalidLabWorkerStatusType);
    }   
         
//$worker_start_service=========================================================
    if (Validator::Exists('worker_start_service', $params)){
        CRUDUtils::setFilter($qb, $worker_start_service, "lw", "workerStartService", "workerStartService", "date", ExceptionMessages::InvalidLabWorkerStartServiceType, ExceptionCodes::InvalidLabWorkerStartServiceType);
    } 
  
//$worker_id====================================================================
    if (Validator::Exists('worker_id', $params)){
        CRUDUtils::setFilter($qb, $worker_id, "mlw", "workerId", "workerId", "id", ExceptionMessages::InvalidMylabWorkerIDType, ExceptionCodes::InvalidMylabWorkerIDType);
    } 
    
//$worker_position==============================================================
    if (Validator::Exists('worker_position', $params)){
        CRUDUtils::setFilter($qb, $worker_position, "wp", "workerPositionId", "name", "id,value", ExceptionMessages::InvalidWorkerPositionType, ExceptionCodes::InvalidWorkerPositionType);
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

        $qb->select('lw');
        $qb->from('LabWorkers', 'lw');
        $qb->leftjoin('lw.worker', 'mlw');
        $qb->leftjoin('lw.workerPosition', 'wp');
        $qb->leftjoin('mlw.workerSpecialization', 'ws');
        $qb->leftjoin('lw.lab', 'l');
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
        foreach ($results as $labworker)
        {

            $result["data"][] = array(              
                                        "lab_worker_id"         => $labworker->getLabWorkerId(),
                                        "worker_status"         => $labworker->getWorkerStatus(),
                                        "worker_start_service"  => $labworker->getWorkerStartService()->format('Y-m-d'),
                                        "worker_id"             => $labworker->getWorker()->getWorkerId(),
                                        "worker_registry_no"    => $labworker->getWorker()->getRegistryNo(),
                                        "uid"                   => $labworker->getWorker()->getUid(),
                                        "firstname"             => Validator::IsNull($labworker->getWorker()->getFirstname()) ? Validator::ToNull() : $labworker->getWorker()->getFirstname(),
                                        "lastname"              => Validator::IsNull($labworker->getWorker()->getLastname()) ? Validator::ToNull() : $labworker->getWorker()->getLastname(),
                                        "fathername"            => Validator::IsNull($labworker->getWorker()->getFathername()) ? Validator::ToNull() : $labworker->getWorker()->getFathername(),
                                        "email"                 => $labworker->getWorker()->getEmail(),
                                        "specialization_code_id"     => Validator::IsNull($labworker->getWorker()->getWorkerSpecialization()) ? Validator::ToNull() : $labworker->getWorker()->getWorkerSpecialization()->getWorkerSpecializationId(),
                                        "specialization_code_name"   => Validator::IsNull($labworker->getWorker()->getWorkerSpecialization()) ? Validator::ToNull() : $labworker->getWorker()->getWorkerSpecialization()->getName(),
                                        "worker_position_id"         => $labworker->getWorkerPosition()->getWorkerPositionId(),
                                        "worker_position_name"       => $labworker->getWorkerPosition()->getName(),
                                        "lab_id"                => $labworker->getLab()->getLabId(),
                                        "lab_name"              => $labworker->getLab()->getName()
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