<?php

class UserRoles {
 
private static $Permissions = array(
    //school units(SYNC from mmsch)
    'circuits'              => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('none'),
                                        'PUT' => array('none'),
                                        'DELETE' => array('none'),
                                        ) , 
    'circuit_types'         => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('none'),
                                        'PUT' => array('none'),
                                        'DELETE' => array('none'),
                                        ) , 
    'edu_admins'            => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('none'),
                                        'PUT' => array('none'),
                                        'DELETE' => array('none'),
                                        ) , 
    'education_levels'      => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('none'),
                                        'PUT' => array('none'),
                                        'DELETE' => array('none'),
                                        ) ,  
    'municipalities'        => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('none'),
                                        'PUT' => array('none'),
                                        'DELETE' => array('none'),
                                        ) , 
    'prefectures'           => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('none'),
                                        'PUT' => array('none'),
                                        'DELETE' => array('none'),
                                        ) ,                  
    'region_edu_admins'     => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('none'),
                                        'PUT' => array('none'),
                                        'DELETE' => array('none'),
                                        ) , 
    'school_units'          => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('none'),
                                        'PUT' => array('none'),
                                        'DELETE' => array('none'),
                                        ) ,     
    'school_unit_types'     => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('none'),
                                        'PUT' => array('none'),
                                        'DELETE' => array('none'),
                                        ) ,
    'school_unit_workers'   => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('none'),
                                        'PUT' => array('none'),
                                        'DELETE' => array('none'),
                                        ) , 
    'sources'               => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('none'),
                                        'PUT' => array('none'),
                                        'DELETE' => array('none'),
                                        ) ,
    'states'                => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('none'),
                                        'PUT' => array('none'),
                                        'DELETE' => array('none'),
                                        ) ,
    'transfer_areas'        => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('none'),
                                        'PUT' => array('none'),
                                        'DELETE' => array('none'),
                                        ) , 
    'workers'               => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('none'),
                                        'PUT' => array('none'),
                                        'DELETE' => array('none'),
                                        ) ,    
    'worker_positions'      => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('none'),
                                        'PUT' => array('none'),
                                        'DELETE' => array('none'),
                                        ) ,
    'worker_specializations'=> array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('none'),
                                        'PUT' => array('none'),
                                        'DELETE' => array('none'),
                                        ) ,
    //labs
    'aquisition_sources'    => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('ΠΣΔ'),
                                        'PUT' => array('ΠΣΔ'),
                                        'DELETE' => array('ΠΣΔ'),
                                        ) ,
    'equipment_categories'  => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('ΠΣΔ'),
                                        'PUT' => array('ΠΣΔ'),
                                        'DELETE' => array('ΠΣΔ'),
                                        ) ,
    'equipment_types'       => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('ΠΣΔ'),
                                        'PUT' => array('ΠΣΔ'),
                                        'DELETE' => array('ΠΣΔ'),
                                        ) ,
    'labs'                  => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('ΔΙΕΥΘΥΝΤΗΣ','ΤΟΜΕΑΡΧΗΣ'),
                                        'PUT' => array('ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'DELETE' => array('ΔΙΕΥΘΥΝΤΗΣ','ΤΟΜΕΑΡΧΗΣ'),
                                        ) ,
    'lab_aquisition_sources'=> array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'PUT' => array('ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'DELETE' => array('ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        ) ,
    'lab_equipment_types'   => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'PUT' => array('ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'DELETE' => array('ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        ) ,
    'lab_relations'         => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'PUT' => array('ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'DELETE' => array('ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        ) ,
    'lab_sources'           => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('ΠΣΔ'),
                                        'PUT' => array('ΠΣΔ'),
                                        'DELETE' => array('ΠΣΔ'),
                                        ) ,
    'lab_transitions'       => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'PUT' => array('ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'DELETE' => array('ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        ) ,
    'lab_types'             => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('ΠΣΔ'),
                                        'PUT' => array('ΠΣΔ'),
                                        'DELETE' => array('ΠΣΔ'),
                                        ) ,
    'lab_workers'           => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('ΔΙΕΥΘΥΝΤΗΣ','ΤΟΜΕΑΡΧΗΣ'),
                                        'PUT' => array('ΔΙΕΥΘΥΝΤΗΣ','ΤΟΜΕΑΡΧΗΣ'),
                                        'DELETE' => array('ΔΙΕΥΘΥΝΤΗΣ','ΤΟΜΕΑΡΧΗΣ'),
                                        ) ,
    'mylab_workers'         => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('ΔΙΕΥΘΥΝΤΗΣ','ΤΟΜΕΑΡΧΗΣ'),
                                        'PUT' => array('ΔΙΕΥΘΥΝΤΗΣ','ΤΟΜΕΑΡΧΗΣ'),
                                        'DELETE' => array('ΠΣΔ'),
                                        ) ,
    'relation_types'        => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ'),
                                        'POST' => array('ΠΣΔ'),
                                        'PUT' => array('ΠΣΔ'),
                                        'DELETE' => array('ΠΣΔ'),
                                        ) ,
    //extra GET functions
    'find_lab_workers'      => array(
                                       'GET' => array('ΚΕΠΛΗΝΕΤ','ΠΣΔ','ΥΠΕΠΘ')
                                        ) ,
    'ldap_workers'          => array(
                                       'GET' => array('ΔΙΕΥΘΥΝΤΗΣ','ΤΟΜΕΑΡΧΗΣ')
                                        ) ,
    'report_keplhnet'       => array(
                                       'GET' => array('ΚΕΠΛΗΝΕΤ','ΠΣΔ','ΥΠΕΠΘ')
                                        ) ,
    'search_school_units'   => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ')                                       
                                        ) ,
    'search_labs'           => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ')
                                        ) ,
    'search_lab_workers'    => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΠΣΔ','ΥΠΕΠΘ')
                                        ) ,
    'statistic_school_units'=> array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΠΣΔ','ΥΠΕΠΘ')
                                        ) ,
    'statistic_labs'        => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΠΣΔ','ΥΠΕΠΘ')
                                        ) ,
    'statistic_lab_workers' => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΠΣΔ','ΥΠΕΠΘ')
                                        ) ,
    'stat_labs'             => array(
                                        'GET' => array('ΚΕΠΛΗΝΕΤ','ΠΣΔ','ΥΠΕΠΘ')
                                        ) ,
    'user_permits'          => array(
                                       'GET' => array('ΚΕΠΛΗΝΕΤ','ΔΙΕΥΘΥΝΤΗΣ','ΣΕΠΕΗΥ','ΠΣΔ','ΥΠΕΠΘ','ΤΟΜΕΑΡΧΗΣ','ΕΤΠ')
                                        ),
    'view_lab_workers'      => array(
                                       'GET' => array('ΚΕΠΛΗΝΕΤ','ΠΣΔ','ΥΠΕΠΘ')
                                        ) ,
    'initial_labs'          => array(
                                        'PUT' => array('ΔΙΕΥΘΥΝΤΗΣ','ΤΟΜΕΑΡΧΗΣ'),
                                        'DELETE' => array('ΔΙΕΥΘΥΝΤΗΣ','ΤΟΜΕΑΡΧΗΣ')
                                        ) 
    );

 public static function checkUserRolePermissions($controller, $method, $user){

    if (array_key_exists($controller, UserRoles::$Permissions)) {
        
        $role = UserRoles::getRole($user) ;
        if ( $role == 'noAccess' ){
             throw new Exception(ExceptionMessages::UserNoRoleAccess, ExceptionCodes::UserNoRoleAccess);
        }else if (in_array( $role , UserRoles::$Permissions[$controller][$method] ) ) {
             return true;
         } else {
             throw new Exception(ExceptionMessages::UserNoRolePermissions, ExceptionCodes::UserNoRolePermissions);
         }
         
    }
    return false; 
}

 public static function getLdapRoleRanking($user){

     $value_ranks = array();

     foreach ($user['title'] as $user_title){
           
            switch ($user_title){

                case 'ΠΡΟΣΩΠΙΚΟ ΚΕΠΛΗΝΕΤ' :
                    $value_ranks[] = array (  "ldap_title"=>"ΠΡΟΣΩΠΙΚΟ ΚΕΠΛΗΝΕΤ",
                                             "ranking"=>10,
                                             "role"=> "ΚΕΠΛΗΝΕΤ"  
                                          );
                    break;
                case 'ΤΕΧΝΙΚΟΣ ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ' :
                    $value_ranks[] = array (  "ldap_title"=>"ΤΕΧΝΙΚΟΣ ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ",
                                             "ranking"=>10,
                                             "role"=> "ΚΕΠΛΗΝΕΤ"  
                                          );
                    break;
                case 'ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ' :
                    $value_ranks[] = array (  "ldap_title"=>"ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ",
                                             "ranking"=>10,
                                             "role"=> "ΚΕΠΛΗΝΕΤ"  
                                          );
                    break;
                case 'ΥΠΕΥΘΥΝΟΣ ΣΧΟΛΙΚΟΥ ΕΡΓΑΣΤΗΡΙΟΥ ΣΕΠΕΗΥ' :
                    $value_ranks[] = array (  "ldap_title"=>"ΥΠΕΥΘΥΝΟΣ ΣΧΟΛΙΚΟΥ ΕΡΓΑΣΤΗΡΙΟΥ ΣΕΠΕΗΥ",
                                             "ranking"=>20,
                                             "role"=> "ΣΕΠΕΗΥ"  
                                          );
                    break;
                case 'ΥΠΕΥΘΥΝΟΣ ΕΡΓΑΣΤΗΡΙΟΥ ΠΛΗΡΟΦΟΡΙΚΗΣ ΠΡΩΤΟΒΑΘΜΙΑΣ' :
                    $value_ranks[] = array (  "ldap_title"=>"ΥΠΕΥΘΥΝΟΣ ΕΡΓΑΣΤΗΡΙΟΥ ΠΛΗΡΟΦΟΡΙΚΗΣ ΠΡΩΤΟΒΑΘΜΙΑΣ",
                                             "ranking"=>20,
                                             "role"=> "ΣΕΠΕΗΥ"
                                          );
                    break;
                case 'ΥΠΕΥΘΥΝΟΣ ΕΡΓΑΣΤΗΡΙΟΥ ΠΛΗΡΟΦΟΡΙΚΗΣ ΕΚ' :
                    $value_ranks[] = array (  "ldap_title"=>"ΥΠΕΥΘΥΝΟΣ ΕΡΓΑΣΤΗΡΙΟΥ ΠΛΗΡΟΦΟΡΙΚΗΣ ΕΚ",
                                             "ranking"=>20,
                                             "role"=> "ΕΤΠ"  
                                          );
                    break;
                case 'ΠΡΟΣΩΠΙΚΟ ΠΣΔ' :
                    $value_ranks[] = array (  "ldap_title"=>"ΠΡΟΣΩΠΙΚΟ ΠΣΔ",
                                             "ranking"=>25,
                                             "role"=> "ΠΣΔ"  
                                          );
                    break;
                case 'ΔΙΕΥΘΥΝΤΗΣ ΣΧΟΛΕΙΟΥ' :
                    $value_ranks[] = array (  "ldap_title"=>"ΔΙΕΥΘΥΝΤΗΣ ΣΧΟΛΕΙΟΥ",
                                             "ranking"=>15,
                                             "role"=> "ΔΙΕΥΘΥΝΤΗΣ"  
                                          );
                    break;
                case 'ΥΠΕΥΘΥΝΟΣ ΤΟΜΕΑ ΠΛΗΡΟΦΟΡΙΚΗΣ ΕΚ' :
                    $value_ranks[] = array (  "ldap_title"=>"ΥΠΕΥΘΥΝΟΣ ΤΟΜΕΑ ΠΛΗΡΟΦΟΡΙΚΗΣ ΕΚ",
                                             "ranking"=>15,
                                             "role"=> "ΤΟΜΕΑΡΧΗΣ"  
                                          );
                    break;
//                case 'ΕΚΠΑΙΔΕΥΤΙΚΟΣ' :
//                    $value_ranks[] = array (  "ldap_title"=>"ΕΚΠΑΙΔΕΥΤΙΚΟΣ",
//                                             "ranking"=>35,
//                                             "role"=> "ΕΚΠΑΙΔΕΥΤΙΚΟΣ"  
//                                          );
//                    break;
                case 'ΠΡΟΣΩΠΙΚΟ ΥΠΟΥΡΓΕΙΟΥ ΠΑΙΔΕΙΑΣ' :
                    $value_ranks[] = array (  "ldap_title"=>"ΠΡΟΣΩΠΙΚΟ ΥΠΟΥΡΓΕΙΟΥ ΠΑΙΔΕΙΑΣ",
                                             "ranking"=>30,
                                             "role"=> "ΥΠΕΠΘ"  
                                          );
                    break; 	       
                default:
                    $value_ranks[] = array (  "ldap_title" => "",
                                              "ranking" => 50,
                                              "role" => "noAccess"  
                                           );
            }
        
        }
     
    $maxRanking = 50;
    $maxRole = "noAccess";
    
    foreach ($value_ranks as $ranking) {
       if ($ranking['ranking'] < $maxRanking) {
           $maxRanking = $ranking['ranking'] ;
           $maxRole = $ranking['role'] ;
           $maxLdapRole = $ranking['ldap_title'] ;
       }          
    }    
        
    return array( "max_role" => $maxRole, "maxLdapRole"=>$maxLdapRole );
    
}

public static function getRole($user) {

    if (!validator::IsNull($user['title'])) {  
    //if (isset($user['title'])) {      
        $role =  self::getLdapRoleRanking($user);
        return $role['max_role'];
    } else{
        return false;
    }

}

 public static function getUserPermissions($user, $getSchoolUnits, $implodeData) {
 
   $user_role = UserRoles::getRole($user);
   
     switch ($user_role){
        case 'ΔΙΕΥΘΥΝΤΗΣ' :
            return self::getSchoolUnitWorkerPermissions($user, $getSchoolUnits, $implodeData);
            //return self::getSchoolUnitWorkerPermissionsV2($user, $implodeData);
            break;
        case 'ΤΟΜΕΑΡΧΗΣ' :
            return self::getSchoolUnitWorkerPermissions($user, $getSchoolUnits, $implodeData);
            break;
        case 'ΚΕΠΛΗΝΕΤ' :
            return self::getKeplhnetWorkerPermissions($user, $getSchoolUnits, $implodeData);
            break;
        case 'ΣΕΠΕΗΥ' :
            return self::getLabWorkerPermissions($user, $getSchoolUnits, $implodeData);
            break;
        case 'ΕΤΠ' :
            return self::getLabWorkerPermissions($user, $getSchoolUnits, $implodeData);
            break;
        case 'ΠΣΔ' :
            return self::getAllPermissions();
            break;
        case 'ΥΠΕΠΘ' :
            return self::getAllPermissions();
            break;
        default:
            throw new Exception(ExceptionMessages::NotFoundUserPermissions, ExceptionCodes::NotFoundUserPermissions);
    }
     
  }
 
  public static function getLabWorkerPermissions($user, $getSchoolUnits = false, $implodeData = false) {
    global $app;
    $method = strtoupper($app->request()->getMethod());  
    
    $registry_no = $user['employeenumber'][0];
    
    if (Validator::IsNull($registry_no)) throw new Exception(ExceptionMessages::MissingLdapEmployeeNumberAttribute, ExceptionCodes::MissingLdapEmployeeNumberAttribute); 
    
    $lab_ids = Filters::getLabsfromRegistryNo($registry_no);
    $school_units = $getSchoolUnits == true ? Filters::getSchoolUnitsfromRegistryNo($registry_no): NULL;
        
        if ($implodeData == true) {
           $lab_ids = implode(",", $lab_ids);
           $school_units = implode(",", $school_units);  
        }
        
        $results = array (
                            'permit_labs' => $lab_ids,             
                            'permit_school_units' => $school_units
                          );
        
    return $results;
    
  }            

  public static function getKeplhnetWorkerPermissions($user, $getSchoolUnits = false, $implodeData = false) {
    global $app;
    $method = strtoupper($app->request()->getMethod());
    
    $dns = null;
    $dns = explode(',', $user['l'][0]);

    if (Validator::IsNull($dns[1])){
        throw new Exception(ExceptionMessages::MissingLdapLAttribute, ExceptionCodes::MissingLdapLAttribute); 
    }

    $edu_admin_code = explode('=', $dns[1]);  
      
    $lab_ids = Filters::getLabsfromEduAdminCode($edu_admin_code[1]);
    $school_units = $getSchoolUnits == true ? Filters::getSchoolUnitsfromEduAdminCode($edu_admin_code[1]) : NULL;
    
        if ($implodeData == true) {
           $lab_ids = implode(",", $lab_ids);
           $school_units = implode(",", $school_units);  
        }
        
        $results = array (
                            'permit_labs' => $lab_ids,             
                            'permit_school_units' => $school_units
                          );
        
    return $results;
   }
   
  public static function getSchoolUnitWorkerPermissions($user, $getSchoolUnits = false, $implodeData = false ) {
    global $app;
    $method = strtoupper($app->request()->getMethod());
    
    $dns = null;
    $dns = explode(',', $user['l'][0]);
    
    if (Validator::IsNull($dns)) throw new Exception(ExceptionMessages::MissingLdapLAttribute, ExceptionCodes::MissingLdapLAttribute); 
    
    $dns_name = explode('=', $dns[0]);
    $edu_admin_code = explode('=', $dns[1]);
    $full_unit_dns = Filters::getFullSchoolUnitDns($dns_name[1], $edu_admin_code[1]);
    
    if (count($full_unit_dns) == 1) {

        $school_units = $full_unit_dns[0]['school_unit_id'];
        $lab_ids = Filters::getLabsfromSchoolUnit($school_units);

        if ($implodeData == true) {
           $lab_ids = implode(",", $lab_ids);
        }
            
        $results = array ('permit_labs' => $lab_ids,             
                          'permit_school_units' => $school_units);    
            
        return $results;
    
    }else if (count($full_unit_dns) == 0){
        throw new Exception(ExceptionMessages::NotFoundFullSchoolUnitDnsName, ExceptionCodes::NotFoundFullSchoolUnitDnsName);
    } else {
        throw new Exception(ExceptionMessages::DuplicateFullSchoolUnitDnsName, ExceptionCodes::DuplicateFullSchoolUnitDnsName);
    }
  }
  
    public static function getSchoolUnitWorkerPermissionsV2($user, $implodeData = false ) {
 
        if (count($user['edupersonorgunitdn:gsnregistrycode']) > 1)
            throw new Exception(ExceptionMessages::DuplicateFullSchoolUnitDnsName, ExceptionCodes::DuplicateFullSchoolUnitDnsName);
        else if (count($user['edupersonorgunitdn:gsnregistrycode']) == 1) {

           $mm_id = $user['edupersonorgunitdn:gsnregistrycode'][0];
           if (Validator::IsNull($mm_id)) throw new Exception(ExceptionMessages::MissingGsnRegistryCodeAttribute, ExceptionCodes::MissingGsnRegistryCodeAttribute); 

               $lab_ids = Filters::getLabsfromSchoolUnit($mm_id);

               if ($implodeData == true) {
                  $lab_ids = implode(",", $lab_ids);
               }

               $results = array ('permit_labs' => $lab_ids,             
                                 'permit_school_units' => $mm_id);    

               return $results;

        } else
           throw new Exception(ExceptionMessages::NotFoundFullSchoolUnitDnsName, ExceptionCodes::NotFoundFullSchoolUnitDnsName);

    }
  
  public static function getAllPermissions() {
      
       $results = array (
                            'permit_labs' => 'ALLRESULTS',             
                            'permit_school_units' => 'ALLRESULTS'
                          );   
       
        return $results;
  }
   
  
}
?>