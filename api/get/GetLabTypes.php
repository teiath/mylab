<?php
/**
 *
 * @version 2.0
 * @author  ΤΕΙ Αθήνας
 * @package GET
 */

header("Content-Type: text/html; charset=utf-8");

/** 
 * Λεξικό : Τύποι Εργαστηρίων
 * 
 * 
 * 
 * Η συνάρτηση αυτή επιστρέφει όλους τους Τύπους Εργαστηρίων σύμφωνα με τις παραμέτρους που έγινε η κλήση
 * <br>Τα αποτελέσματα είναι ταξινομημένα ως προς το όνομα του Τύπου Εργαστηρίου κατά αύξουσα φορά.
 * 
 * Η κλήση μπορεί να γίνει μέσω της παρακάτω διεύθυνσης με τη μέθοδο GET :
 * <br> http://mmsch.teiath.gr/mylab/api/lab_types
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
 * Παρακάτω εμφανίζεται μια σειρά από παραδείγματα κλήσης της συνάρτησης με διάφορους τρόπους :
 * <br><a href="#cURL">cURL</a> | <a href="#JavaScript">JavaScript</a> | <a href="#PHP">PHP</a> | <a href="#Ajax">Ajax</a>
 * 
 * 
 * <br>
 * 
 * <a id="cURL"></a>Παράδειγμα κλήσης της συνάρτησης με <b>cURL</b> (console) :
 * <code>
 *    curl -X GET http://mmsch.teiath.gr/mylab/api/lab_types \
 *       -H "Content-Type: application/json" \
 *       -H "Accept: application/json" \
 *       -u username:password
 * </code>
 * <br>
 * 
 * 
 * 
 * <a id="JavaScript"></a>Παράδειγμα κλήσης της συνάρτησης με <b>JavaScript</b> :
 * <code>
 * <script>
 *    var http = new XMLHttpRequest();
 *    http.open("GET", "http://mmsch.teiath.gr/mylab/api/lab_types");
 *    http.setRequestHeader("Accept", "application/json");
 *    http.setRequestHeader("Content-type", "application/json; charset=utf-8");
 *    http.setRequestHeader("Authorization", "Basic " + btoa('username' + ':' + 'password') );
 *     
 *    http.onreadystatechange = function() 
 *    {
 *        if(http.readyState == 4 && http.status == 200) 
 *        {
 *            var result = JSON.parse(http.responseText);
 *            document.write(result.status + " : " + result.message + " : " + result.data);
 *        }
 *    }
 *    
 *    http.send(params);
 * </script>
 * </code>
 * <br>
 * 
 * 
 * 
 * <a id="PHP"></a>Παράδειγμα κλήσης της συνάρτησης με <b>PHP</b> :
 * <code>
 * <?php
 * header("Content-Type: text/html; charset=utf-8");
 * 
 * $curl = curl_init("http://mmsch.teiath.gr/mylab/api/lab_types");
 * 
 * curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
 * curl_setopt($curl, CURLOPT_USERPWD, "username:password");
 * curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
 * curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 * 
 * $data = curl_exec($curl);
 * $data = json_decode($data);
 * echo "<pre>"; var_dump( $data ); echo "</pre>";
 * ?>
 * </code>
 * <br>
 * 
 * 
 * 
 * <a id="Ajax"></a>Παράδειγμα κλήσης της συνάρτησης με <b>Ajax</b> :
 * <code>
 * <script>
 *    $.ajax({
 *        type: 'GET',
 *        url: 'http://mmsch.teiath.gr/mylab/api/lab_types',
 *        dataType: "json",
 *        beforeSend: function(req) {
 *            req.setRequestHeader('Authorization', btoa('username' + ":" + 'password'));
 *        },
 *        success: function(data){
 *            console.log(data);
 *        }
 *    });
 * </script>
 * </code>
 * <br>
 * 
 * 
 * 
 * <a id="data"></a>Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης :
 * <code>
 * {
 *   "data": [
 *        {
 *            "lab_type_id": 4,
 *           "name": "ΓΩΝΙΑ",
 *            "full_name": "ΓΩΝΙΑ Η/Υ"
 *        },
 *        {
 *            "lab_type_id": 5,
 *            "name": "ΔΙΑΔΡΑΣΤΙΚΟ ΣΥΣΤΗΜΑ",
 *           "full_name": "ΔΙΑΔΡΑΣΤΙΚΟ ΣΥΣΤΗΜΑ"
 *        },
 *        {
 *            "lab_type_id": 3,
 *            "name": "ΕΡΓΑΣΤΗΡΙΟ ΤΟΜΕΑ",
 *           "full_name": "ΕΡΓΑΣΤΗΡΙΟ ΤΟΜΕΑ"
 *        },
 *        {
 *            "lab_type_id": 1,
 *            "name": "ΣΕΠΕΗΥ",
 *            "full_name": "ΣΕΠΕΗ/Υ"
 *        },
 *        {
 *            "lab_type_id": 2,
 *            "name": "ΤΡΟΧΗΛΑΤΟ",
 *            "full_name": "ΤΡΟΧΗΛΑΤΟ (ΨΗΦΙΑΚΟ ΣΧΟΛΕΙΟ)"
 *        }
 *   ],
 *   "function": "lab_types",
 *   "method": "GET",
 *   "total": "5",
 *   "count": 5,
 *   "pagination": {
 *              "page": 1,
 *              "maxPage": 1,
 *              "pagesize": 200
 *          },
 *   "status": 200,
 *   "message": "[GET][lab_types]:success"
 * }
 * </code>
 * <br>
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
 * 
 * 
 * @return Array<JSON> Επιστρέφει ένα πίνακα σε JSON μορφή με πεδία : 
 * <br>
 * <ul>
 *  <li>string : <b>function</b> : Η συνάρτηση που εκτελείτε από το σύστημα</li>
 *  <li>string : <b>method</b> : Η μέθοδος κλήσης της συνάρτησης</li>
 *  <li>integer : <b>total</b> : Το πλήθος των εγγραφών χωρίς τις παραμέτρους σελιδοποίησης</li>
 *  <li>integer : <b>count</b> : Το πλήθος των εγγραφών της κλήσης σύμφωνα με τις παραμέτρους σελιδοποίησης</li>
 *  <li>array : <b>pagination</b> : Οι παράμετροι σελιδοποίησης των εγγραφών της κλήσης {@see Pagination}
 *    <ul>
 *      <li>integer : <b>page</b> : Ο αριθμός της σελίδας των αποτελεσμάτων</li>
 *      <li>integer : <b>maxPage</b> : Ο μέγιστος αριθμός της σελίδας των αποτελεσμάτων</li>
 *      <li>integer : <b>pagesize</b> : Ο αριθμός των εγγραφών προς επιστροφή</li>
 *    </ul>
 * </li>
 *  <li>integer : <b>status</b> : Ο Κωδικός {@see ExceptionCodes} του αποτελέσματος της κλήσης</li>
 *  <li>string : <b>message</b> : Το Μήνυμα {@see ExceptionMessages} του αποτελέσματος της κλήσης</li>
 *
 *  <li>array : <b>data</b> : Ο Πίνακας με το λεξικό
 *    <ul>
 *      <li>integer : <b>worker_position_id</b> : Ο Κωδικός του Τύπου Εργαστηρίου</li>
 *      <li>string : <b>name</b> : Το Όνομα του Τύπου Εργαστηρίου</li>
 *      <li>string : <b>full_name</b> : Ολόκληρο τo όνομα του Τύπου Εργαστηρίου</li>
 *    </ul>
 *   </li>
 * </ul>
 * 
 * 
 * 
 * @throws InvalidPageNumber {@see ExceptionMessages::InvalidPageNumber}
 * @throws InvalidPageType {@see ExceptionMessages::InvalidPageType}
 * @throws InvalidPageSizeNumber {@see ExceptionMessages::InvalidPageSizeNumber}
 * @throws InvalidPageSizeType {@see ExceptionMessages::InvalidPageSizeType}
 * @throws InvalidMaxPageNumber {@see ExceptionMessages::InvalidMaxPageNumber}
 * 
 * 
 * 
 */

function GetLabTypes( $lab_type_id, $name, $full_name, 
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
        
//$page - $pagesize - $searchtype - $ordertype =================================
       $page = Pagination::getPage($page, $params);
       $pagesize = Pagination::getPagesize($pagesize, $params, true);     
       $searchtype = Filters::getSearchType($searchtype, $params);
       $ordertype =  Filters::getOrderType($ordertype, $params);
    
 //$orderby=====================================================================
       $columns = array(
            "lt.labTypeId" => "lab_type_id",
            "lt.name" => "name",
            "lt.fullName" => "full_name" 
             );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "lab_type_id";
        else
        {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        } 
        
//$lab_type_id==================================================================
        if (Validator::Exists('lab_type_id', $params)){
            CRUDUtils::setFilter($qb, $lab_type_id, "lt", "labTypeId", "labTypeId", "id", ExceptionMessages::InvalidLabTypeIDType, ExceptionCodes::InvalidLabTypeIDType);
        } 

//$name=========================================================================
        if (Validator::Exists('name', $params)){
            CRUDUtils::setSearchFilter($qb, $name, "lt", "name", $searchtype, ExceptionMessages::InvalidLabTypeNameType, ExceptionCodes::InvalidLabTypeNameType);    
        }  
 
//$full_name====================================================================
        if (Validator::Exists('full_name', $params)){
            CRUDUtils::setSearchFilter($qb, $full_name, "lt", "fullName", $searchtype, ExceptionMessages::InvalidLabTypeFullNameType, ExceptionCodes::InvalidLabTypeFullNameType);    
        } 
        
//execution=====================================================================
        $qb->select('lt');
        $qb->from('LabTypes', 'lt');     
        $qb->orderBy(array_search($orderby, $columns), $ordertype);

//pagination and results========================================================      
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        $results->getQuery()->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $results->getQuery()->setMaxResults($pagesize) : null;

//data results==================================================================       
        $count = 0;
        foreach ($results as $labtype)
        {

            $result["data"][] = array(
                                        "lab_type_id"       => $labtype->getLabTypeId(),
                                        "name"              => $labtype->getName(),
                                        "full_name"         => $labtype->getFullName(),
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