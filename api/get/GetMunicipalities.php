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
* resourcePath="/municipalities",
* description="Λεξικό : Δήμοι",
* produces="['application/json']",
* @SWG\Api(
*   path="/municipalities",
*   @SWG\Operation(
*                   method="GET",
*                   summary="Αναζήτηση σε Δήμους",
*                   notes="Επιστρέφει τους Δήμους",
*                   type="getMunicipalities",
*                   nickname="GetMunicipalities",
*   @SWG\Parameter(
*                   name="municipality_id",
*                   description="ID Δήμου [notNull]",
*                   required=false,
*                   type="integer|array[integer]",
*                   paramType="query"
*   ),
*   @SWG\Parameter(
*                   name="name",
*                   description="Όνομα Δήμου (Συνδυάζεται με την παράμετρο searchtype)",
*                   required=false,
*                   type="string|array[string]",
*                   paramType="query"
*                   ),
*   @SWG\Parameter(
*                   name="transfer_area",
*                   description="Όνομα ή ID Περιοχής Μετάθεσης [notNull]",
*                   required=false,
*                   type="mixed(string|integer|array[string|integer])",
*                   paramType="query"
*                   ),
*   @SWG\Parameter(
*                   name="prefecture",
*                   description="Όνομα ή ID Νομού [notNull]",
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
*                   enum = "['municipality_id','name','transfer_area_id','transfer_area_name','prefecture_id','prefecture_name']"
*                   ),
*   @SWG\Parameter( name="debug", description="Επιστροφή SQL/DQL Queries", required=false, type="boolean", paramType="query", enum = "['true','false']" ),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMunicipalityIDType, message=ExceptionMessages::InvalidMunicipalityIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidMunicipalityNameType, message=ExceptionMessages::InvalidMunicipalityNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidTransferAreaType, message=ExceptionMessages::InvalidTransferAreaType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidPrefectureType, message=ExceptionMessages::InvalidPrefectureType),
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
* id="getMunicipalities",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="total",type="integer",description="Το πλήθος των εγγραφών χωρίς τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="count",type="integer",description="Το πλήθος των εγγραφών της κλήσης σύμφωνα με τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="pagination",type="array",description="Οι παράμετροι σελιδοποίησης των εγγραφών της κλήσης",items="$ref:Pagination"),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="data",type="array",description="Ο Πίνακας με το λεξικό",items="$ref:Municipality"),
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
* id="Municipality",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με πεδία του πίνακα municipalities : ",
* @SWG\Property(name="municipality_id",type="integer",description="Ο Κωδικός ID του Δήμου"),
* @SWG\Property(name="name",type="string",description="Το Όνομα του Δήμου"),
* @SWG\Property(name="transfer_area_id",type="integer",description="Ο Κωδικός ID της Περιοχής Μετάθεσης"),
* @SWG\Property(name="transfer_area_name",type="string",description="Το Όνομα της Περιοχής Μετάθεσης"),
* @SWG\Property(name="prefecture_id",type="integer",description="Ο Κωδικός ID του Νομού"),
* @SWG\Property(name="prefecture_name",type="string",description="Το Όνομα του Νομού")
* )
* 
*/

function GetMunicipalities( $municipality_id, $name, $transfer_area, $prefecture,
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
                            "m.municipalityId"      => "municipality_id",
                            "m.name"                => "name",
                            "ta.transferAreaId"     => "transfer_area_id",
                            "ta.name"               => "transfer_area_name" ,
                            "p.prefectureId"        => "prefecture_id",
                            "p.name"                => "prefecture_name"
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "municipality_id";
        else
        {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        } 
        
//$municipality_id=================================================================
        if (Validator::Exists('municipality_id', $params)){
            CRUDUtils::setFilter($qb, $municipality_id, "m", "municipalityId", "municipalityId", "id", ExceptionMessages::InvalidMunicipalityIDType, ExceptionCodes::InvalidMunicipalityIDType);
        } 

//$name=========================================================================
        if (Validator::Exists('name', $params)){
            CRUDUtils::setSearchFilter($qb, $name, "m", "name", $searchtype, ExceptionMessages::InvalidMunicipalityNameType, ExceptionCodes::InvalidMunicipalityNameType);    
        }

//$transfer_area===============================================================
        if (Validator::Exists('transfer_area', $params)){
            CRUDUtils::setFilter($qb, $transfer_area, "ta", "transferAreaId", "name", "id,value", ExceptionMessages::InvalidTransferAreaType, ExceptionCodes::InvalidTransferAreaType);
        } 
        
//$prefecture=============================================================
        if (Validator::Exists('prefecture', $params)){
            CRUDUtils::setFilter($qb, $prefecture, "p", "prefectureId", "name", "id,value", ExceptionMessages::InvalidPrefectureType, ExceptionCodes::InvalidPrefectureType);
        }    
        
//execution=====================================================================
        $qb->select('m');
        $qb->from('Municipalities', 'm');
        $qb->leftjoin('m.transferArea', 'ta');
        $qb->leftjoin('m.prefecture', 'p');
        $qb->orderBy(array_search($orderby, $columns), $ordertype);

//pagination and results========================================================      
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        $results->getQuery()->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $results->getQuery()->setMaxResults($pagesize) : null;

//data results==================================================================       
        $count = 0;
        foreach ($results as $municipality)
        {

            $result["data"][] = array(
                                            "municipality_id"       => $municipality->getMunicipalityId(),
                                            "name"                  => $municipality->getName(),
                                            "transfer_area_id"      => Validator::IsNull($municipality->getTransferArea()) ? Validator::ToNull() : $municipality->getTransferArea()->getTransferAreaId(),                              
                                            "transfer_area_name"    => Validator::IsNull($municipality->getTransferArea()) ? Validator::ToNull() : $municipality->getTransferArea()->getName(),
                                            "prefecture_id"         => Validator::IsNull($municipality->getPrefecture()) ? Validator::ToNull() : $municipality->getPrefecture()->getPrefectureId(),
                                            "prefecture_name"       => Validator::IsNull($municipality->getPrefecture()) ? Validator::ToNull() : $municipality->getPrefecture()->getName()
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
              
//            $result["data"][] = array("municipality_id" => $row->getMunicipalityId(), 
//                                      "name" => $row->getName(),
//                                      "prefecture_id" => $oPrefecture->getPrefectureId(),
//                                      "prefecture" => $oPrefecture->getName(),
//                                      "transfer_area_id" => $oTransferarea->getTransferAreaId(),
//                                      "transfer_area" => $oTransferarea->getName(),
//                                      "edu_admin_id" => $oEduAdmin->getEduAdminId(),
//                                      "edu_admin" => $oEduAdmin->getName(),
//                                      "region_edu_admin_id" => $oRegionEduAdmin->getRegionEduAdminId(),
//                                      "region_edu_admin" => $oRegionEduAdmin->getName()
//                        );
//        }

?>