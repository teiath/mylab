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
* resourcePath="/edu_admins",
* description="Λεξικό : Διευθύνσεις Εκπαίδευσης",
* produces="['application/json']",
* @SWG\Api(
*   path="/edu_admins",
*   @SWG\Operation(
*                   method="GET",
*                   summary="Αναζήτηση σε Διευθύνσεις Εκπαίδευσης",
*                   notes="Επιστρέφει τις Διευθύνσεις Εκπαίδευσης",
*                   type="getEduAdmins",
*                   nickname="GetEduAdmins",
*   @SWG\Parameter(
*                   name="edu_admin_id",
*                   description="ID Διεύθυνσης Εκπαίδευσης [notNull]",
*                   required=false,
*                   type="integer|array[integer]",
*                   paramType="query"
*   ),
*   @SWG\Parameter(
*                   name="name",
*                   description="Όνομα Διεύθυνσης Εκπαίδευσης (Συνδυάζεται με την παράμετρο searchtype)",
*                   required=false,
*                   type="string|array[string]",
*                   paramType="query"
*                   ),
*   @SWG\Parameter(
*                   name="edu_admin_code",
*                   description="Κωδικός Dns Διεύθυνσης Εκπαίδευσης [notNull]",
*                   required=false,
*                   type="string|array[string]",
*                   paramType="query"
*                   ),
*   @SWG\Parameter(
*                   name="region_edu_admin",
*                   description="Όνομα ή ID Περιφέρειας [notNull]",
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
*                   enum = "['edu_admin_id','name','edu_admin_code','region_edu_admin_id','region_edu_admin_name']"
*                   ),
*   @SWG\Parameter( name="debug", description="Επιστροφή SQL/DQL Queries", required=false, type="boolean", paramType="query", enum = "['true','false']" ),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEduAdminIDType, message=ExceptionMessages::InvalidEduAdminIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEduAdminNameType, message=ExceptionMessages::InvalidEduAdminNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidEduAdminCodeType, message=ExceptionMessages::InvalidEduAdminCodeType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidRegionEduAdminType, message=ExceptionMessages::InvalidRegionEduAdminType),
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
* id="getEduAdmins",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="total",type="integer",description="Το πλήθος των εγγραφών χωρίς τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="count",type="integer",description="Το πλήθος των εγγραφών της κλήσης σύμφωνα με τις παραμέτρους σελιδοποίησης"),
* @SWG\Property(name="pagination",type="array",description="Οι παράμετροι σελιδοποίησης των εγγραφών της κλήσης",items="$ref:Pagination"),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="data",type="array",description="Ο Πίνακας με το λεξικό",items="$ref:EduAdmin"),
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
* id="EduAdmin",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με πεδία του πίνακα edu_admins : ",
* @SWG\Property(name="edu_admin_id",type="integer",description="Ο Κωδικός ID της Διεύθυνσης Εκπαίδευσης"),
* @SWG\Property(name="name",type="string",description="Το Όνομα της Διεύθυνσης Εκπαίδευσης"),
* @SWG\Property(name="edu_admin_code",type="string",description="Ο Κωδικός DNS της Διεύθυνσης Εκπαίδευσης"),
* @SWG\Property(name="region_edu_admin_id",type="integer",description="Ο Κωδικός ID της Περιφέρειας"),
* @SWG\Property(name="region_edu_admin_name",type="string",description="Το Όνομα της Περιφέρειας")
* )
* 
*/

function GetEduAdmins( $edu_admin_id, $name, $edu_admin_code, $region_edu_admin,
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
                            "ea.eduAdminId"         => "edu_admin_id",
                            "ea.name"               => "name",
                            "ea.eduAdminCode"       => "edu_admin_code",
                            "rea.regionEduAdminId"  => "region_edu_admin_id" ,
                            "rea.name"              => "region_edu_admin_name"
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "edu_admin_id";
        else
        {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        } 
        
//$edu_admin_id=================================================================
        if (Validator::Exists('edu_admin_id', $params)){
            CRUDUtils::setFilter($qb, $edu_admin_id, "ea", "eduAdminId", "eduAdminId", "id", ExceptionMessages::InvalidEduAdminIDType, ExceptionCodes::InvalidCircuitIDType);
        } 

//$name=========================================================================
        if (Validator::Exists('name', $params)){
            CRUDUtils::setSearchFilter($qb, $name, "ea", "name", $searchtype, ExceptionMessages::InvalidEduAdminNameType, ExceptionCodes::InvalidEduAdminNameType);    
        }

//$edu_admin_code===============================================================
        if (Validator::Exists('edu_admin_code', $params)){
            CRUDUtils::setFilter($qb, $edu_admin_code, "ea", "eduAdminCode", "eduAdminCode", "value", ExceptionMessages::InvalidEduAdminCodeType, ExceptionCodes::InvalidCircuitUpdatedDateType);
        } 
        
//$region_edu_admin=============================================================
        if (Validator::Exists('region_edu_admin', $params)){
            CRUDUtils::setFilter($qb, $region_edu_admin, "rea", "regionEduAdminId", "name", "id,value", ExceptionMessages::InvalidRegionEduAdminType, ExceptionCodes::InvalidCircuitStatusType);
        }    
        
//execution=====================================================================
        $qb->select('ea');
        $qb->from('EduAdmins', 'ea');
        $qb->leftjoin('ea.regionEduAdmin', 'rea');
        $qb->orderBy(array_search($orderby, $columns), $ordertype);

//pagination and results========================================================      
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        $results->getQuery()->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $results->getQuery()->setMaxResults($pagesize) : null;

//data results==================================================================       
        $count = 0;
        foreach ($results as $eduadmin)
        {

            $result["data"][] = array(
                                            "edu_admin_id"           => $eduadmin->getEduAdminId(),
                                            "name"                   => $eduadmin->getName(),
                                            "edu_admin_code"         => $eduadmin->getEduAdminCode(),                              
                                            "region_edu_admin_id"    => Validator::IsNull($eduadmin->getRegionEduAdmin()) ? Validator::ToNull() : $eduadmin->getRegionEduAdmin()->getRegionEduAdminId(),
                                            "region_edu_admin_name"  => Validator::IsNull($eduadmin->getRegionEduAdmin()) ? Validator::ToNull() : $eduadmin->getRegionEduAdmin()->getName()
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


   
        

                    
//        foreach ($countRows as $row) {
//  
//        //retrieve transfer_area
//        $transfer_area["transfer_area_info"] = array();   
//        $filter = array( new DFC(TransferAreasExt::FIELD_EDU_ADMIN_ID,$row->getEduAdminId(), DFC::EXACT));
//        $sort = array( new DSC(TransferAreasExt::FIELD_EDU_ADMIN_ID, DSC::ASC) );
//        $arrayTransferAreas = $oTransferAreas->findByFilter($db, $filter, true, $sort);  
//            
//            foreach ($arrayTransferAreas as $arrayTransferArea){
//             
//                //retrieve municipality
//                $municipality["municipality_info"] = array();   
//                $filter = array( new DFC(MunicipalitiesExt::FIELD_TRANSFER_AREA_ID,$arrayTransferArea->getTransferAreaId(), DFC::EXACT));
//                $sort = array( new DSC(MunicipalitiesExt::FIELD_TRANSFER_AREA_ID, DSC::ASC) );
//                $arrayMunicipalities = $oMunicipalities->findByFilter($db, $filter, true, $sort);
//
//                    foreach ($arrayMunicipalities as $arrayMunicipality){ 
//                        
//                        $municipality["municipality_info"][] = array("municipality_id" => $arrayMunicipality->getMunicipalityId(),
//                                                                     "name" => $arrayMunicipality->getName()  
//                                                                   );
//                    }
//
//                $transfer_area["transfer_area_info"][] = array("transfer_area_id" => $arrayTransferArea->getTransferAreaId(),
//                                                                "name" => $arrayTransferArea->getName(),
//                                                                "municipalities"=>$municipality
//                                                               );  
//             }            
//            
//        $result["data"][] = array("edu_admin_id" => $row->getEduAdminId(), 
//                                  "name" => $row->getName(),
//                                  "region_edu_admin_id" => $oRegionEduAdmins->searchArrayForID( $row->getRegionEduAdminId() )->getRegionEduAdminId(),
//                                  "region_edu_admin" => $oRegionEduAdmins->searchArrayForID( $row->getRegionEduAdminId() )->getName(),
//                                  "transfer_areas"=>$transfer_area
//                            );
//        }

?>