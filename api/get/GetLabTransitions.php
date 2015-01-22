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
* resourcePath="/lab_transitions",
* description="Λειτουργικές Καταστάσεις Διατάξεων",
* produces="['application/json']",
* @SWG\Api(
*   path="/lab_transitions",
*   @SWG\Operation(
*                   method="GET",
*                   summary="Αναζήτηση στις Λειτουργικές Καταστάσεις Διατάξεων Η/Υ",
*                   notes="Επιστρέφει τις Λειτουργικές Καταστάσεις Διατάξεων Η/Υ",
*                   type="getLabTransitions",
*                   nickname="GetLabTransitions",
* 
*   @SWG\Parameter( name="lab_transition_id", description="ID Λειτουργικής Καταστάσης Διατάξης [notNull]", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="transition_date", description="Ημερομηνία Μετάβασης Λειτουργικής Καταστάσης Διατάξης [notNull](μορφή ημερομηνίας dd/mm/yyyy)", required=false, type="string|array[string]", format="date", paramType="query" ),
*   @SWG\Parameter( name="transition_source", description="Πηγή Αλλαγής Μετάβασης Λειτουργικής Καταστάσης Διατάξης [notNull]", required=false, type="string|array[string]", paramType="query", enum="['mylab','mmsch']" ),
*   @SWG\Parameter( name="from_state", description="Όνομα ή ID Προηγούμενης Λειτουργικής Καταστάσης", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="to_state", description="Όνομα ή ID Τρέχουσας Λειτουργικής Καταστάσης [notNull]", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="lab_id", description="ID Διάταξης Η/Υ [notNull]", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="lab_name", description="Όνομα Διάταξης Η/Υ (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
* 
*   @SWG\Parameter( name="page", description="Αριθμός Σελίδας", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="pagesize", description="Αριθμός Εγγραφών/Σελίδα", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="searchtype", description="Τύπος αναζήτησης", required=false, type="string", paramType="query", enum = "['EXACT','CONTAIN','CONTAINALL','CONTAINANY','STARTWITH','ENDWITH']" ),
*   @SWG\Parameter( name="ordertype", description="Τύπος Ταξινόμησης", required=false, type="string", paramType="query", enum = "['ASC','DESC']" ),
*   @SWG\Parameter( name="orderby", description="Πεδίο Ταξινόμησης", required=false, type="string", paramType="query",
*                   enum = "['lab_transition_id','transition_date','transition_source','from_state_id','from_state_name','to_state_id','to_state_name','lab_id','lab_name']" ),
*   @SWG\Parameter( name="debug", description="Επιστροφή SQL/DQL Queries", required=false, type="boolean", paramType="query", enum = "['true','false']" ),  
* 
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionsError, message=ExceptionMessages::NoPermissionsError),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTransitionIDType, message=ExceptionMessages::InvalidLabTransitionIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTransitionDateType, message=ExceptionMessages::InvalidLabTransitionDateType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTransitionSourceType, message=ExceptionMessages::InvalidLabTransitionSourceType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidStateType, message=ExceptionMessages::InvalidStateType),
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
* id="getLabTransitions",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="total",type="integer",description="Το πλήθος των εγγραφών χωρίς τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="count",type="integer",description="Το πλήθος των εγγραφών της κλήσης σύμφωνα με τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="pagination",type="array",description="Οι παράμετροι σελιδοποίησης των εγγραφών της κλήσης",items="$ref:Pagination"),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="data",type="array",description="Ο Πίνακας με τα αποτελέσματα",items="$ref:LabTransition"),
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
* id="LabTransition",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με στοιχεία του πίνακα lab_transitions: ",
* @SWG\Property(name="lab_transition_id",type="integer",description="Ο Κωδικός ID της Λειτουργικής Καταστάσης Διατάξης"),
* @SWG\Property(name="transition_date",type="string",description="Η Ημερομηνία Μετάβασης Λειτουργικής Καταστάσης Διατάξης (μορφή ημερομηνίας dd/mm/yyyy)"),
* @SWG\Property(name="transition_source",type="string",description="Η Πηγή Αλλαγής Μετάβασης Λειτουργικής Καταστάσης Διατάξης (τιμές mylab ή mmsch)"),
* @SWG\Property(name="transition_justification",type="string",description="Η αιτιολογία Αλλαγής Μετάβασης Λειτουργικής Καταστάσης Διατάξης"),
* @SWG\Property(name="from_state_id",type="integer",description="Ο Κωδικός ID της Προηγούμενης Λειτουργικής Καταστάσης"),
* @SWG\Property(name="from_state_name",type="string",description="To Όνομα Προηγούμενης Λειτουργικής Καταστάσης"),
* @SWG\Property(name="to_state_id",type="string",description="Ο Κωδικός ID της Τρέχουσας Λειτουργικής Καταστάσης"),
* @SWG\Property(name="to_state_name",type="string",description="To Όνομα Τρέχουσας Λειτουργικής Καταστάσης"),
* @SWG\Property(name="lab_id",type="integer",description="Ο Κωδικός ID της Διάταξης Η/Υ"),
* @SWG\Property(name="lab_name",type="string",description="Το Όνομα της Διάταξης Η/Υ")
* )
* 
*/
 
function GetLabTransitions( $lab_transition_id, $transition_date, $transition_source, 
                            $from_state, $to_state, $lab_id, $lab_name,
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
    $permissions = UserRoles::getUserPermissions($app->request->user);

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
                            "lt.labTransitionId" => "lab_transition_id",
                            "lt.transitionDate" => "transition_date",
                            "lt.transitionSource" => "transition_source",
                            "fs.stateId" => "from_state_id",
                            "fs.name" => "from_state_name",
                            "ts.stateId" => "to_state_id",
                            "ts.name" => "to_state_name",
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
    
//$lab_transition_id============================================================
    if (Validator::Exists('lab_transition_id', $params)){
        CRUDUtils::setFilter($qb, $lab_transition_id, "lt", "labTransitionId", "labTransitionId", "id", ExceptionMessages::InvalidLabTransitionIDType, ExceptionCodes::InvalidLabTransitionSourceType);
    } 
      
//$transition_date==============================================================
    if (Validator::Exists('transition_date', $params)){
        CRUDUtils::setFilter($qb, $transition_date, "lt", "transitionDate", "transitionDate", "date", ExceptionMessages::InvalidLabTransitionDateType, ExceptionCodes::InvalidLabTransitionSourceType);
    }   
         
//$transition_source============================================================
    if (Validator::Exists('transition_source', $params)){
        CRUDUtils::setFilter($qb, $transition_source, "lt", "transitionSource", "name", "value", ExceptionMessages::InvalidLabTransitionSourceType, ExceptionCodes::InvalidLabTransitionSourceType);
    } 
 
//$from_state===================================================================
    if (Validator::Exists('from_state', $params)){
        CRUDUtils::setFilter($qb, $from_state, "fs", "stateId", "name", "null,id,value", ExceptionMessages::InvalidStateType, ExceptionCodes::InvalidStateType);
    } 
    
//$to_state=====================================================================
    if (Validator::Exists('to_state', $params)){
        CRUDUtils::setFilter($qb, $to_state, "ts", "stateId", "name", "id,value", ExceptionMessages::InvalidStateType, ExceptionCodes::InvalidStateType); 
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

        $qb->select('lt');
        $qb->from('LabTransitions', 'lt');
        $qb->leftjoin('lt.fromState', 'fs');
        $qb->leftjoin('lt.toState', 'ts');
        $qb->leftjoin('lt.lab', 'l');
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
        foreach ($results as $labtransition)
        {

            $result["data"][] = array(              
                                        "lab_transition_id"         => $labtransition->getLabTransitionId(),
                                        "transition_date"           =>  Validator::IsNull($labtransition->getTransitionDate()) ? Validator::ToNull() : $labtransition->getTransitionDate()->format('Y-m-d'),
                                        "transition_source"         => $labtransition->getTransitionSource(),
                                        "transition_justification"  => $labtransition->getTransitionJustification(),
                                        "from_state_id"             => Validator::IsNull($labtransition->getFromState()) ? Validator::ToNull() : $labtransition->getFromState()->getStateId(),
                                        "from_state_name"           => Validator::IsNull($labtransition->getFromState()) ? Validator::ToNull() : $labtransition->getFromState()->getName(),
                                        "to_state_id"               => $labtransition->getToState()->getStateId(),
                                        "to_state_name"             => $labtransition->getToState()->getName(),
                                        "lab_id"                    => $labtransition->getLab()->getLabId(),
                                        "lab_name"                  => $labtransition->getLab()->getName()

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