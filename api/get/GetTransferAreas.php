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
* resourcePath="/transfer_areas",
* description="Λεξικό : Περιοχές Μετάθεσης",
* produces="['application/json']",
* @SWG\Api(
*   path="/transfer_areas",
*   @SWG\Operation(
*                   method="GET",
*                   summary="Αναζήτηση σε Περιοχές Μετάθεσης",
*                   notes="Επιστρέφει τις Περιοχές Μετάθεσης",
*                   type="getTransferAreas",
*                   nickname="GetTransferAreas",
*   @SWG\Parameter(
*                   name="tranfer_area_id",
*                   description="ID Περιοχής Μετάθεσης [notNull]",
*                   required=false,
*                   type="integer|array[integer]",
*                   paramType="query"
*   ),
*   @SWG\Parameter(
*                   name="name",
*                   description="Όνομα Περιοχής Μετάθεσης (Συνδυάζεται με την παράμετρο searchtype)",
*                   required=false,
*                   type="string|array[string]",
*                   paramType="query"
*                   ),
*   @SWG\Parameter(
*                   name="edu_admin",
*                   description="Όνομα ή ID Διεύθυνσης Εκπαίδευσης [notNull]",
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
*                   enum = "['tranfer_area_id','name','edu_admin_id','edu_admin_name']"
*                   ),
*   @SWG\Parameter( name="debug", description="Επιστροφή SQL/DQL Queries", required=false, type="boolean", paramType="query", enum = "['true','false']" ),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidTransferAreaIDType, message=ExceptionMessages::InvalidTransferAreaIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidTransferAreaNameType, message=ExceptionMessages::InvalidTransferAreaNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEduAdminType, message=ExceptionMessages::InvalidEduAdminType),
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
* id="getTransferAreas",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="total",type="integer",description="Το πλήθος των εγγραφών χωρίς τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="count",type="integer",description="Το πλήθος των εγγραφών της κλήσης σύμφωνα με τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="pagination",type="array",description="Οι παράμετροι σελιδοποίησης των εγγραφών της κλήσης",items="$ref:Pagination"),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="data",type="array",description="Ο Πίνακας με το λεξικό",items="$ref:TransferArea"),
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
* id="TransferArea",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με πεδία του πίνακα transfer_areas : ",
* @SWG\Property(name="transfer_area_id",type="integer",description="Ο Κωδικός ID της Περιοχής Μετάθεσης"),
* @SWG\Property(name="name",type="string",description="Το Όνομα της Περιοχής Μετάθεσης"),
* @SWG\Property(name="edu_admin_id",type="integer",description="Ο Κωδικός ID της Διεύθυνσης Εκπαίδευσης"),
* @SWG\Property(name="name",type="string",description="Το Όνομα της Διεύθυνσης Εκπαίδευσης")
* )
* 
*/

function GetTransferAreas( $transfer_area_id, $name, $edu_admin,
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
                            "ta.transferAreaId"    => "transfer_area_id",
                            "ta.name"              => "name",
                            "ea.eduAdminId"        => "edu_admin_id" ,
                            "ea.name"              => "edu_admin_name"
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "transfer_area_id";
        else
        {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        } 
        
//$transfer_area_id=================================================================
        if (Validator::Exists('transfer_area_id', $params)){
            CRUDUtils::setFilter($qb, $transfer_area_id, "ta", "transferAreaId", "transferAreaId", "id", ExceptionMessages::InvalidTransferAreaIDType, ExceptionCodes::InvalidTransferAreaIDType);
        } 

//$name=========================================================================
        if (Validator::Exists('name', $params)){
            CRUDUtils::setSearchFilter($qb, $name, "ta", "name", $searchtype, ExceptionMessages::InvalidTransferAreaNameType, ExceptionCodes::InvalidTransferAreaNameType);    
        }

//$edu_admin===============================================================
        if (Validator::Exists('edu_admin', $params)){
            CRUDUtils::setFilter($qb, $edu_admin, "ea", "eduAdminId", "name", "id,value", ExceptionMessages::InvalidEduAdminType, ExceptionCodes::InvalidEduAdminType);
        }  
        
//execution=====================================================================
        $qb->select('ta');
        $qb->from('TransferAreas', 'ta');
        $qb->leftjoin('ta.eduAdmin', 'ea');
        $qb->orderBy(array_search($orderby, $columns), $ordertype);

//pagination and results========================================================      
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        $results->getQuery()->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $results->getQuery()->setMaxResults($pagesize) : null;

//data results==================================================================       
        $count = 0;
        foreach ($results as $transferarea)
        {

            $result["data"][] = array(
                                            "transfer_area_id"      => $transferarea->getTransferAreaId(),
                                            "name"                  => $transferarea->getName(),                         
                                            "edu_admin_id"          => Validator::IsNull($transferarea->getEduAdmin()) ? Validator::ToNull() : $transferarea->getEduAdmin()->getEduAdminId(),
                                            "edu_admin_name"        => Validator::IsNull($transferarea->getEduAdmin()) ? Validator::ToNull() : $transferarea->getEduAdmin()->getName()
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
     
        
      
//                foreach ($arrayMunicipalities as $arrayMunicipality){ 
//
//                    $municipality["municipality_info"][] = array("municipality_id" => $arrayMunicipality->getMunicipalityId(),
//                                                                 "name" => $arrayMunicipality->getName()  
//                                                               );
//                }
//            
//            $result["data"][] = array("transfer_area_id" => $row->getTransferAreaId(), 
//                                      "name" => $row->getName(),
//                                      "edu_admin_id" => $oEduAdmin->getEduAdminId(),
//                                      "edu_admin" => $oEduAdmin->getName(),
//                                      "region_edu_admin_id" => $oRegionEduAdmin->getRegionEduAdminId(),
//                                      "region_edu_admin" => $oRegionEduAdmin->getName(),
//                                      "municipalities"=>$municipality
//                                );
//        }

?>