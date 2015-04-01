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
* resourcePath="/school_unit_workers",
* description="Υπεύθυνοι Σχολικών Μονάδων",
* produces="['application/json']",
* @SWG\Api(
*   path="/school_unit_workers",
*   @SWG\Operation(
*                   method="GET",
*                   summary="Αναζήτηση στους Υπεύθυνους Σχολικών Μονάδων",
*                   notes="Επιστρέφει τους Υπεύθυνους Σχολικών Μονάδων.Τα στοιχεία τα λαμβάνουμε με συγχρονισμό από το ΜΜ.",
*                   type="getSchoolUnitWorkers",
*                   nickname="GetSchoolUnitWorkers",
* 
*   @SWG\Parameter( name="school_unit_worker_id", description="ID Υπεύθυνου Σχολικής Μονάδας [notNull]", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="school_unit_id", description="ID Σχολικής Μονάδας [notNull]", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="school_unit_name", description="Όνομα Σχολικής Μονάδας (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="worker_id", description="ID Εργαζόμενου από Mητρώο Mονάδων [notNull]", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="worker_position", description="Όνομα ή ID Θέσης Εργασίας Υπεύθυνου Σχολικής Μονάδας [notNull]", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
* 
*   @SWG\Parameter( name="page", description="Αριθμός Σελίδας", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="pagesize", description="Αριθμός Εγγραφών/Σελίδα", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="searchtype", description="Τύπος αναζήτησης", required=false, type="string", paramType="query", enum = "['EXACT','CONTAIN','CONTAINALL','CONTAINANY','STARTWITH','ENDWITH']" ),
*   @SWG\Parameter( name="ordertype", description="Τύπος Ταξινόμησης", required=false, type="string", paramType="query", enum = "['ASC','DESC']" ),
*   @SWG\Parameter( name="orderby", description="Πεδίο Ταξινόμησης", required=false, type="string", paramType="query",
*                   enum = "['school_unit_worker_id','school_unit_id','school_unit_name','worker_id','worker_position_id','worker_position_name']" ),
*   @SWG\Parameter( name="debug", description="Επιστροφή SQL/DQL Queries", required=false, type="boolean", paramType="query", enum = "['true','false']" ),  
* 
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionsError, message=ExceptionMessages::NoPermissionsError),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitWorkerIDType, message=ExceptionMessages::InvalidSchoolUnitWorkerIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitIDType, message=ExceptionMessages::InvalidSchoolUnitIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitNameType, message=ExceptionMessages::InvalidSchoolUnitNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidWorkerIDType, message=ExceptionMessages::InvalidWorkerIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidWorkerPositionType, message=ExceptionMessages::InvalidWorkerPositionType), 
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
* id="getSchoolUnitWorkers",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="total",type="integer",description="Το πλήθος των εγγραφών χωρίς τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="count",type="integer",description="Το πλήθος των εγγραφών της κλήσης σύμφωνα με τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="pagination",type="array",description="Οι παράμετροι σελιδοποίησης των εγγραφών της κλήσης",items="$ref:Pagination"),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="data",type="array",description="Ο Πίνακας με τα αποτελέσματα",items="$ref:SchoolUnitWorker"),
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
* id="SchoolUnitWorker",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με στοιχεία του πίνακα school_unit_workers: ",
* @SWG\Property(name="school_unit_worker_id",type="integer",description="Το ID του Υπεύθυνου Σχολικής Μονάδας"),
* @SWG\Property(name="worker_id",type="integer",description="Ο Κωδικός ID του Εργαζόμενου από Μητρώο Μονάδων"),
* @SWG\Property(name="worker_registry_no",type="integer",description="Ο Α.Μ. του Εργαζόμενου"),
* @SWG\Property(name="tax_number",type="integer",description="Το Α.Φ.Μ. του Εργαζόμενου"),
* @SWG\Property(name="firstname",type="string",description="Το Όνομα του Εργαζόμενου"),
* @SWG\Property(name="lastname",type="string",description="Το Επώνυμο του Εργαζόμενου"),
* @SWG\Property(name="fathername",type="string",description="Το Όνομα Πατρός του Εργαζόμενου"),
* @SWG\Property(name="sex",type="string",description="Το Φύλο του Εργαζόμενου (Α=Άντρας,Γ=Γυναίκα)"),
* @SWG\Property(name="specialization_code_id",type="integer",description="Ο Κωδικός ID της Ειδικότητας του Εργαζόμενου"),
* @SWG\Property(name="specialization_code_name",type="string",description="Το Όνομα της Ειδικότητας του Εργαζόμενου"),
* @SWG\Property(name="worker_position_id",type="integer",description="Ο Κωδικός ID της Θέσης Εργασίας του Εργαζόμενου"),
* @SWG\Property(name="worker_position_name",type="string",description="Το Όνομα της Θέσης Εργασίας του Εργαζόμενου"),
* @SWG\Property(name="school_unit_id",type="integer",description="Ο Κωδικός ID της Σχολικής Μονάδας"),
* @SWG\Property(name="school_unit_name",type="string",description="Το Όνομα της Σχολικής Μονάδας")
* )
* 
*/
 
function GetSchoolUnitWorkers( $school_unit_worker_id, $school_unit_id, $school_unit_name, $worker_id, $worker_position, 
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

    if (Validator::IsNull($permissions['permit_school_units'])){
        throw new Exception(ExceptionMessages::NoPermissionsError, ExceptionCodes::NoPermissionsError);     
    }else { 
        $permit_school_units = $permissions['permit_school_units'];
    }
  
//$page - $pagesize - $searchtype - $ordertype =================================
       $page = Pagination::getPage($page, $params);
       $pagesize = Pagination::getPagesize($pagesize, $params);     
       $searchtype = Filters::getSearchType($searchtype, $params);
       $ordertype =  Filters::getOrderType($ordertype, $params);

//$orderby======================================================================
       $columns = array(
                            "suw.schoolUnitWorkerId"    => "school_unit_worker_id",
                            "su.schoolUnitId"           => "school_unit_id",
                            "su.name"                   => "school_unit_name",
                            "w.workerId"                => "worker_id",
                            "wp.workerPositionId"       => "worker_position_id",
                            "wp.name"                   => "worker_position_name"
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "school_unit_id";
       else
       {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
       }
       
//$school_unit_worker_id================================================================
    if (Validator::Exists('school_unit_worker_id', $params)){
        CRUDUtils::setFilter($qb, $school_unit_worker_id, "suw", "schoolUnitWorkerId", "schoolUnitWorkerId", "id", ExceptionMessages::InvalidSchoolUnitWorkerIDType, ExceptionCodes::InvalidSchoolUnitWorkerIDType);
    }         
     
//$school_unit_id=======================================================================
    if (Validator::Exists('school_unit_id', $params)){
        CRUDUtils::setFilter($qb, $school_unit_id, "su", "schoolUnitId", "schoolUnitId", "id", ExceptionMessages::InvalidSchoolUnitIDType, ExceptionCodes::InvalidSchoolUnitIDType);
    } 
    
//$school_unit_name=====================================================================
    if (Validator::Exists('school_unit_name', $params)){
        CRUDUtils::setSearchFilter($qb, $school_unit_name, "su", "name", $searchtype, ExceptionMessages::InvalidSchoolUnitNameType, ExceptionCodes::InvalidSchoolUnitNameType);   
    }
    
  //$worker_id====================================================================
    if (Validator::Exists('worker_id', $params)){
        CRUDUtils::setFilter($qb, $worker_id, "w", "workerId", "workerId", "id", ExceptionMessages::InvalidWorkerIDType, ExceptionCodes::InvalidWorkerIDType);
    } 
    
//$worker_position==============================================================
    if (Validator::Exists('worker_position', $params)){
        CRUDUtils::setFilter($qb, $worker_position, "wp", "workerPositionId", "name", "id,value", ExceptionMessages::InvalidWorkerPositionType, ExceptionCodes::InvalidWorkerPositionType);
    }       
 
 //execution====================================================================

        $qb->select('suw');
        $qb->from('SchoolUnitWorkers', 'suw');
        $qb->leftjoin('suw.worker', 'w');
        $qb->leftjoin('suw.workerPosition', 'wp');
        $qb->leftjoin('w.workerSpecialization', 'ws');
        $qb->leftjoin('suw.schoolUnit', 'su');
        $qb->orderBy(array_search($orderby, $columns), $ordertype);
 
        if ($permit_school_units !== 'ALLRESULTS'){
            $qb->andWhere($qb->expr()->in('su.schoolUnitId', ':ids'))
                ->setParameter('ids', $permit_school_units);
        }
  
//pagination and results========================================================     
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        $results->getQuery()->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $results->getQuery()->setMaxResults($pagesize) : null;

 //data results==================================================================       
        $count = 0;
        foreach ($results as $schoolUnitWorker)
        {

            $result["data"][] = array(              
                                        "school_unit_worker_id"     => $schoolUnitWorker->getSchoolUnitWorkerId(),
                                        "worker_id"                 => $schoolUnitWorker->getWorker()->getWorkerId(),
                                        "worker_registry_no"        => $schoolUnitWorker->getWorker()->getRegistryNo(),
                                        "tax_number"                => Validator::IsNull($schoolUnitWorker->getWorker()->getTaxNumber()) ? Validator::ToNull() : $schoolUnitWorker->getWorker()->getTaxNumber(),
                                        "firstname"                 => Validator::IsNull($schoolUnitWorker->getWorker()->getFirstname()) ? Validator::ToNull() : $schoolUnitWorker->getWorker()->getFirstname(),
                                        "lastname"                  => Validator::IsNull($schoolUnitWorker->getWorker()->getLastname()) ? Validator::ToNull() : $schoolUnitWorker->getWorker()->getLastname(),
                                        "fathername"                => Validator::IsNull($schoolUnitWorker->getWorker()->getFathername()) ? Validator::ToNull() : $schoolUnitWorker->getWorker()->getFathername(),
                                        "sex"                       => Validator::IsNull($schoolUnitWorker->getWorker()->getSex()) ? Validator::ToNull() : $schoolUnitWorker->getWorker()->getSex(),
                                        "specialization_code_id"    => Validator::IsNull($schoolUnitWorker->getWorker()->getWorkerSpecialization()) ? Validator::ToNull() : $schoolUnitWorker->getWorker()->getWorkerSpecialization()->getWorkerSpecializationId(),
                                        "specialization_code_name"  => Validator::IsNull($schoolUnitWorker->getWorker()->getWorkerSpecialization()) ? Validator::ToNull() : $schoolUnitWorker->getWorker()->getWorkerSpecialization()->getName(),
                                        "worker_position_id"        => $schoolUnitWorker->getWorkerPosition()->getWorkerPositionId(),
                                        "worker_position_name"      => $schoolUnitWorker->getWorkerPosition()->getName(),
                                        "school_unit_id"            => $schoolUnitWorker->getSchoolUnit()->getSchoolUnitId(),
                                        "school_unit_name"          => $schoolUnitWorker->getSchoolUnit()->getName()
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