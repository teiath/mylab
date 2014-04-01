<?php
/**
 *
 * @version 1.4
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

function GetLabTypes($pagesize, $page) {
    global $db;
    global $app;
    
    $filter = array();
    $result = array();  

    $result["data"] = array();
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();

    try {
        
//        //= Pages/Pagination ==============================================================
//        if (! $page)
//            $page = 1;
//        else if (intval($page) < 0)
//	        throw new Exception(ExceptionMessages::InvalidPageNumber." : ".$page, ExceptionCodes::InvalidPageNumber);
//        else if (!is_numeric($page))
//	        throw new Exception(ExceptionMessages::InvalidPageType." : ".$page, ExceptionCodes::InvalidPageType);
//        
//        if (! $pagesize)
//                $pagesize = $Options["PageSize"];
//        else if (intval($pagesize) < 0)
//	        throw new Exception(ExceptionMessages::InvalidPageSizeNumber." : ".$pagesize, ExceptionCodes::InvalidPageSizeNumber);
//        else if (!is_numeric($pagesize))
//	        throw new Exception(ExceptionMessages::InvalidPageSizeType." : ".$pagesize, ExceptionCodes::InvalidPageSizeType);
//        else if ($pagesize > $Options["MaxPageSize"])
//                throw new Exception(ExceptionMessages::InvalidPageSizeNumber." : ".$pagesize, ExceptionCodes::InvalidPageSizeNumber);
// 
//        $startat = ($page -1) * $pagesize;
//        $pagesize = 0;
       
        //pagination ==============================================================    
        $page = Pagination::Page($page);
        $pagesize = Pagination::Pagesize($pagesize);
        $startAt = Pagination::StartPagesizeFrom($page, $pagesize);
         
        //sort lab_types by name and initialize object $oLabType
        $sort = array( new DSC(LabTypesExt::FIELD_NAME, DSC::ASC) );
        $oLabTypes = new LabTypesExt($db);
        
        //find total results by filter
        $totalRows = $oLabTypes->findByFilterAsCount($db, $filter, true);
        $total = $totalRows[0]->getLabTypeId();
        $result["total"] = (int)$total;

        //check if $page input from user, is valid
        $maxPage = Pagination::checkMaxPage($total, $page, $pagesize);
        
        //find all results by filter ,return array of objects into variable $countRows (1st ver)
        //if ($pagesize)        
        //    $countRows = $oLabType->findByFilterWithLimit($db, $filter, true, $sort, $startat, $pagesize);
        //else
        //    $countRows = $oLabType->findByFilter($db, $filter, true, $sort);
      
        //find all results by filter or not ,return objects with key-value 
        //from getObjsArray and complete set as getObjsArray 
        if ($pagesize)        
            $oLabTypes->getAllWithLimit($db, $filter, true, $sort, $startAt, $pagesize);
        else
            $oLabTypes->getAll($db, $filter, true, $sort);

        //find total results by filter with limits of $page and $pagesize
        //$result["count"] = count($countRows)  1st ver
        $result["count"] = count( $oLabTypes->getObjsArray() );

        //loop for results
        //foreach ($countRows as $row) {   1st ver
        foreach ($oLabTypes->getObjsArray() as $row) {
            $result["data"][] = array("lab_type_id" => (int)$row->getLabTypeId(), 
                                      "name" => $row->getName(),
                                      "full_name" => $row->getFullName()
                                     );
        }
        
        //return pagination values 
        $pagination = array(
            "page" => (int)$page,
            "maxPage" => (int)$maxPage,
            "pagesize" => (int)$pagesize
        ); 
        
        $result["pagination"]=$pagination;        
        $result["status"] = ExceptionCodes::NoErrors;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".ExceptionMessages::NoErrors;
    } catch (Exception $e) {
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    }   
    return $result;
}

?>