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
* resourcePath="/lab_relations",
* description="Συσχετίσεις Διατάξεων - Μονάδων",
* produces="['application/json']",
* @SWG\Api(
*   path="/lab_relations",
*   @SWG\Operation(
*                   method="GET",
*                   summary="Αναζήτηση στις Συσχετίσεις Διατάξεων Η/Υ - Σχολικών Μονάδων",
*                   notes="Επιστρέφει τις Συσχετίσεις Διατάξεων Η/Υ - Σχολικών Μονάδων",
*                   type="getLabRelations",
*                   nickname="GetLabRelations",
* 
*   @SWG\Parameter( name="lab_relation_id", description="ID Συσχέτισης Διάταξης Η/Υ - Σχολικής Μονάδας [notNull]", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="relation_type", description="Όνομα ή ID Τύπου Συσχέτισης Διάταξης Η/Υ - Σχολικής Μονάδας [notNull]", required=false, type="mixed(string|integer|array[string|integer])", paramType="query" ),
*   @SWG\Parameter( name="circuit_id", description="ID Τηλεπικοινωνιακού Κυκλώματος", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="circuit_phone_number", description="Τηλεφωνικός Αριθμός Τηλεπικοινωνιακού Κυκλώματος", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="school_unit_id", description="ID Σχολικής Μονάδας [notNull]", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="school_unit_name", description="Όνομα Σχολικής Μονάδας (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
*   @SWG\Parameter( name="lab_id", description="ID Διάταξης Η/Υ [notNull]", required=false, type="integer|array[integer]", paramType="query" ),
*   @SWG\Parameter( name="lab_name", description="Όνομα Διάταξης Η/Υ (Συνδυάζεται με την παράμετρο searchtype)", required=false, type="string|array[string]", paramType="query" ),
* 
*   @SWG\Parameter( name="page", description="Αριθμός Σελίδας", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="pagesize", description="Αριθμός Εγγραφών/Σελίδα", required=false, type="integer", paramType="query" ),
*   @SWG\Parameter( name="searchtype", description="Τύπος αναζήτησης", required=false, type="string", paramType="query", enum = "['EXACT','CONTAIN','CONTAINALL','CONTAINANY','STARTWITH','ENDWITH']" ),
*   @SWG\Parameter( name="ordertype", description="Τύπος Ταξινόμησης", required=false, type="string", paramType="query", enum = "['ASC','DESC']" ),
*   @SWG\Parameter( name="orderby", description="Πεδίο Ταξινόμησης", required=false, type="string", paramType="query",
*                   enum = "['lab_relation_id','relation_type_id','relation_type_name','circuit_id','circuit_phone_number','school_unit_id','school_unit_name','lab_id','lab_name']" ),
*   @SWG\Parameter( name="debug", description="Επιστροφή SQL/DQL Queries", required=false, type="boolean", paramType="query", enum = "['true','false']" ),  
* 
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionsError, message=ExceptionMessages::NoPermissionsError),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabRelationIDType, message=ExceptionMessages::InvalidLabRelationIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidCircuitIDType, message=ExceptionMessages::InvalidCircuitIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidCircuitPhoneNumberType, message=ExceptionMessages::InvalidCircuitPhoneNumberType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidRelationTypeType, message=ExceptionMessages::InvalidRelationTypeType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitIDType, message=ExceptionMessages::InvalidSchoolUnitIDType), 
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitNameType, message=ExceptionMessages::InvalidSchoolUnitNameType),
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
* id="getLabRelations",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="total",type="integer",description="Το πλήθος των εγγραφών χωρίς τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="count",type="integer",description="Το πλήθος των εγγραφών της κλήσης σύμφωνα με τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="pagination",type="array",description="Οι παράμετροι σελιδοποίησης των εγγραφών της κλήσης",items="$ref:Pagination"),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="data",type="array",description="Ο Πίνακας με τα αποτελέσματα",items="$ref:LabRelation"),
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
* id="LabRelation",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με στοιχεία του πίνακα lab_relations: ",
* @SWG\Property(name="lab_relation_id",type="integer",description="Ο Κωδικός ID της Συσχέτισης Διατάξεων Η/Υ - Μονάδων"),
* @SWG\Property(name="relation_type_id",type="integer",description="Ο Κωδικός ID του Τύπου Συσχέτισης Διατάξεων Η/Υ - Μονάδων"),
* @SWG\Property(name="relation_type_name",type="string",description="Το Όνομα του Τύπου Συσχέτισης Διατάξεων Η/Υ - Μονάδων"),
* @SWG\Property(name="circuit_id",type="integer",description="Ο Κωδικός ID του του Τηλεπικοινωνιακού Κυκλώματος"),
* @SWG\Property(name="circuit_phone_number",type="integer",description="Ο Τηλεφωνικός Αριθμός του Τηλεπικοινωνιακού Κυκλώματος"),
* @SWG\Property(name="school_unit_id",type="integer",description=" Ο Κωδικός ID της Σχολικής Μονάδας"),
* @SWG\Property(name="school_unit_name",type="string",description="To Όνομα της Σχολικής Μονάδας"),
* @SWG\Property(name="lab_id",type="integer",description="Ο Κωδικός ID της Διάταξης Η/Υ"),
* @SWG\Property(name="lab_name",type="string",description="Το Όνομα της Διάταξης Η/Υ")
* )
* 
*/
 
function GetLabRelations( $lab_relation_id,
                          $relation_type, $circuit_id, $circuit_phone_number,
                          $school_unit_id, $school_unit_name, $lab_id, $lab_name,  
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
                            "lr.labRelationId" => "lab_relation_id",
                            "rt.relationTypeId" => "relation_type_id",
                            "rt.name" => "relation_type_name",
                            "c.circuitId" => "circuit_id",         
                            "c.phoneNumber" => "circuit_phone_number",
                            "su.schoolUnitId" => "school_unit_id",
                            "su.name" => "school_unit_name",
                            "l.labId" => "lab_id",
                            "l.name" => "lab_name",
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "lab_id";
       else
       {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
       }  
    
//$lab_relation_id==============================================================
    if (Validator::Exists('lab_relation_id', $params)){
        CRUDUtils::setFilter($qb, $lab_relation_id, "lr", "labRelationId", "labRelationId", "id", ExceptionMessages::InvalidLabRelationIDType, ExceptionCodes::InvalidLabRelationIDType);
    } 
 
//$circuit_id===================================================================
    if (Validator::Exists('circuit_id', $params)){
        CRUDUtils::setFilter($qb, $circuit_id, "c", "circuitId", "circuitId", "null,numeric", ExceptionMessages::InvalidCircuitIDType, ExceptionCodes::InvalidCircuitIDType);
    } 
 
//$circuit_phone_number=========================================================
    if (Validator::Exists('circuit_phone_number', $params)){
        CRUDUtils::setFilter($qb, $circuit_phone_number, "c", "phoneNumber", "phoneNumber", "null,numeric", ExceptionMessages::InvalidCircuitPhoneNumberType, ExceptionCodes::InvalidCircuitPhoneNumberType);
    } 
    
//$relation_type================================================================
    if (Validator::Exists('relation_type', $params)){
        CRUDUtils::setFilter($qb, $relation_type, "rt", "relationTypeId", "name", "id,value", ExceptionMessages::InvalidRelationTypeType, ExceptionCodes::InvalidRelationTypeType);
    } 
 
//$school_unit_id===============================================================
    if (Validator::Exists('school_unit_id', $params)){
        CRUDUtils::setFilter($qb, $school_unit_id, "su", "schoolUnitId", "schoolUnitId", "id", ExceptionMessages::InvalidSchoolUnitIDType, ExceptionCodes::InvalidSchoolUnitIDType);
    }   
         
//$school_unit_name=============================================================
    if (Validator::Exists('school_unit_name', $params)){
        CRUDUtils::setSearchFilter($qb, $school_unit_name, "su", "name", $searchtype, ExceptionMessages::InvalidSchoolUnitNameType, ExceptionCodes::InvalidSchoolUnitNameType);  
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

        $qb->select('lr');
        $qb->from('LabRelations', 'lr');
        $qb->leftjoin('lr.relationType', 'rt');
        $qb->leftjoin('lr.circuit', 'c');
        $qb->leftjoin('lr.schoolUnit', 'su');
        $qb->leftjoin('lr.lab', 'l');
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
        foreach ($results as $labrelation)
        {

            $result["data"][] = array(              
                                        "lab_relation_id"       => $labrelation->getLabRelationId(),
                                        "relation_type_id"      => $labrelation->getRelationType()->getRelationTypeId(),
                                        "relation_type_name"    => $labrelation->getRelationType()->getName(), 
                                        "circuit_id"            => Validator::IsNull($labrelation->getCircuit()) ? Validator::ToNull() : $labrelation->getCircuit()->getCircuitId(),
                                        "circuit_phone_number"  => Validator::IsNull($labrelation->getCircuit()) ? Validator::ToNull() : $labrelation->getCircuit()->getPhoneNumber(),
                                        "school_unit_id"        => $labrelation->getSchoolUnit()->getSchoolUnitId(),
                                        "school_unit_name"      => $labrelation->getSchoolUnit()->getName(),
                                        "lab_id"                => $labrelation->getLab()->getLabId(),
                                        "lab_name"              => $labrelation->getLab()->getName()
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