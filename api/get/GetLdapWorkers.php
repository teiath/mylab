<?php
/**
 *
 * @version 2.0
 * @author  ΤΕΙ Αθήνας
 * @package GET
 */

header("Content-Type: text/html; charset=utf-8");
function GetLdapWorkers( $uid ) {
   
    global $app, $ldapOptions, $ldapSearchOptions;

    $result = array();  

    $result["data"] = array();
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    
    try {
        
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
        
//user permissions===============================================================
        
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