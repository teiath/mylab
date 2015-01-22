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
* resourcePath="/ldap_workers",
* description="Εργαζομενοι στον ΠΣΔ LDAP",
* produces="['application/json']",
* @SWG\Api(
*   path="/ldap_workers",
*   @SWG\Operation(
*                   method="GET",
*                   summary="Αναζήτηση Εργαζόμενων στο ΠΣΔ LDAP",
*                   notes="Μόνο οι χρήστες που έχουν ρόλο 'ΔΙΕΥΘΥΝΤΗΣ' ή 'ΤΟΜΕΑΡΧΗΣ', έχουν δικαιώματα πρόσβασης.
                           Επιστρέφει στοιχεία εργαζομένου,ο οποίος είναι καταχωρημένος στο ΠΣΔ LDAP. Για την αναζήτηση εργαζομένου είναι απαραίτητη η χρήση του UID του LDAP λογαριασμού του Καθηγητή ΠΕ19-ΠΕ20. Επίσης θα πρέπει ο εργαζόμενος στο ldap να έχει ένα από τα παρακάτω ldap attribute['title']
                         'ΥΠΕΥΘΥΝΟΣ ΕΡΓΑΣΤΗΡΙΟΥ ΠΛΗΡΟΦΟΡΙΚΗΣ ΠΡΩΤΟΒΑΘΜΙΑΣ', 'ΥΠΕΥΘΥΝΟΣ ΕΡΓΑΣΤΗΡΙΟΥ ΠΛΗΡΟΦΟΡΙΚΗΣ ΕΚ', 'ΥΠΕΥΘΥΝΟΣ ΣΧΟΛΙΚΟΥ ΕΡΓΑΣΤΗΡΙΟΥ ΣΕΠΕΗΥ' ",
*                   type="getLdapWorkers",
*                   nickname="GetLdapWorkers",
*   @SWG\Parameter(
*                   name="uid",
*                   description="UID Εργαζόμενου [notNull]",
*                   required=true,
*                   type="string",
*                   paramType="query"
*   ), 
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLdapWorkerUidParam, message=ExceptionMessages::MissingLdapWorkerUidParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLdapWorkerUidValue, message=ExceptionMessages::MissingLdapWorkerUidValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLdapWorkerUidArray, message=ExceptionMessages::InvalidLdapWorkerUidArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLdapWorkerUidType, message=ExceptionMessages::InvalidLdapWorkerUidType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLdapWorkerUidValue, message=ExceptionMessages::InvalidLdapWorkerUidValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MultipleLdapWorkerUidValue, message=ExceptionMessages::MultipleLdapWorkerUidValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NotAcceptedLdapWorkerPosition, message=ExceptionMessages::NotAcceptedLdapWorkerPosition),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="getLdapWorkers",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="ldap_uid_found",type="string",description="Έλεγχος εάν βρέθηκε το uid στο ΠΣΔ LDAP (yes=βρέθηκε, null=δεν βρέθηκε)"),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="data",type="array",description="Ο Πίνακας με τα αποτελέσματα",items="$ref:LdapWorker")
* )
*  
* @SWG\Model(
* id="LdapWorker",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με στοιχεία του πίνακα ldap_worker : ",
* @SWG\Property(name="common name",type="string",description="Ονοματεπώνυμο Εργαζόμενου καταχωρημένου στο ΠΣΔ LDAP"),
* @SWG\Property(name="UID",type="string",description="Το UID του Εργαζόμενου (μοναδικό)"),
* @SWG\Property(name="registry_no",type="integer",description="Ο Α.Μ. ή το Α.Φ.Μ. Εργαζόμενου (Α.Φ.Μ = 9ψηφιο , Α.Μ. = 6ψηφιο)"),
* @SWG\Property(name="name",type="string",description="Το Όνομα του Εργαζόμενου"),
* @SWG\Property(name="surname",type="string",description="Το Επίθετο του Εργαζόμενου"),
* @SWG\Property(name="fathername",type="string",description="Το Όνομα Πατρός του Εργαζόμενου"),
* @SWG\Property(name="mail",type="string",description="Το email του Εργαζόμενου"),
* @SWG\Property(name="worker_specialization",type="string",description="Το Όνομα της Ειδικότητας του Εργαζόμενου"),
* @SWG\Property(name="title",type="string",description="Το ldap attrribute['title'] που δηλώνει την υπηρεσιακή ιδιότητα του Εργαζόμενου")
* )
* 
*/

function GetLdapWorkers( $uid ) {
   
    global $app, $ldapOptions, $ldapSearchOptions;

    $result = array();  

    $result["data"] = array();
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    
    try {
 
//user permissions==============================================================
//not required (all users with title 'ΔΙΕΥΘΥΝΤΗΣ' or 'ΤΟΜΕΑΡΧΗΣ' have permissions to GetLdapWorkers)
        
//$uid==========================================================================
      $fUid = CRUDUtils::checkNameParam('uid', $params, $uid, 'LdapWorkerUid');
        
//ldap connection===============================================================
        $ldap = new \Zend\Ldap\Ldap($ldapOptions);
        $ldap->bind($ldapSearchOptions['username'],$ldapSearchOptions['password']);
        
        //example about ldap filters
        // $filter = \Zend\Ldap\Filter::begins('uid', 'kts')->addAnd(\Zend\Ldap\Filter::ends('uid', 's'));
        //$lresult = $ldap->search($filter, 'ou=people,dc=sch,dc=gr', \Zend\Ldap\Ldap::SEARCH_SCOPE_SUB);     
        
        //ldap search with uid 
        $lresult = $ldap->search('(uid='.$fUid.')', 'ou=people,dc=sch,dc=gr', \Zend\Ldap\Ldap::SEARCH_SCOPE_SUB);
     
        if ($lresult->count() == 1)
             $result["ldap_uid_found"] = 'yes';
        else if ($lresult->count() == 0) 
            throw new Exception(ExceptionMessages::InvalidLdapWorkerUidValue, ExceptionCodes::InvalidLdapWorkerUidValue); 
        else 
            throw new Exception(ExceptionMessages::MultipleLdapWorkerUidValue, ExceptionCodes::MultipleLdapWorkerUidValue);
                
//controls======================================================================
       
       $rows = iterator_to_array($lresult);

       //check if user has the right position at ldap title attribute
       $haystack = array ('ΥΠΕΥΘΥΝΟΣ ΕΡΓΑΣΤΗΡΙΟΥ ΠΛΗΡΟΦΟΡΙΚΗΣ ΠΡΩΤΟΒΑΘΜΙΑΣ',
                          'ΥΠΕΥΘΥΝΟΣ ΕΡΓΑΣΤΗΡΙΟΥ ΠΛΗΡΟΦΟΡΙΚΗΣ ΕΚ',
                          'ΥΠΕΥΘΥΝΟΣ ΣΧΟΛΙΚΟΥ ΕΡΓΑΣΤΗΡΙΟΥ ΣΕΠΕΗΥ');
       $target = $rows[0]['title'];
       
        if(count(array_intersect($haystack, $target)) == 0){
            throw new Exception(ExceptionMessages::NotAcceptedLdapWorkerPosition, ExceptionCodes::NotAcceptedLdapWorkerPosition);
        }
 
 //data_results=================================================================     
        foreach ($rows as $item) {
            //print_r($item) . PHP_EOL;
            $result["data"][] = array ( 'common name' => $item['cn'][0],
                                        'UID' => $item['uid'][0],
                                        'registry_no' => $item['employeenumber'][0],
                                        'name' => $item['givenname'][0],
                                        'surname' => $item['sn'][0],
                                        'fathername' => $item['gsnfathername'][0],
                                        'mail' => $item['mail'][0],
                                        'worker_specialization' => $item['gsnbranch'][0],
                                        'title' => $item['title']
                                      );            
        }
        
//result_messages===============================================================      
        $result["status"] = ExceptionCodes::NoErrors;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".ExceptionMessages::NoErrors;
    } catch (Exception $e) {
        
        $result["status"] = $e->getCode();
         
        if ($e instanceof \Zend\Ldap\Exception\LdapException) {
            $result["message"] = "[".$result["method"]."][".$result["function"]."]:Invalid credentials. Zend Ldap Exception : ".$e->getMessage();
        } else {
            $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
        }
     
    } 
    
    return $result;
    
}

?>