<?php
class CheckUserPermissions {
 
    /**
     * Get user max_role from mylab system and 
     * returned user labs and school_units
     * 
     * @param array $user LDAP user attributes
     * @param boolean $getSchoolUnits True if want return school units mm_ids or false if not 
     * @param boolean $implodeData True if implode mm_id and labs_id with ',' in a string or false if not and return in arrays 
     * @return array Return permit_labs,permit_school_units of users
     * @throws Exception
     */   
    public static function getUserPermissions($user, $getSchoolUnits, $implodeData) {

     $user_role_desc = CheckUserRole::getRole($user);

        switch ($user_role_desc['max_role']){
           case 'ΔΙΕΥΘΥΝΤΗΣ' :
               return self::getUnitWorkerPermissions($user_role_desc, $getSchoolUnits, $implodeData);
               //return self::getSchoolUnitWorkerPermissionsV2($user, $implodeData);
               break;
           case 'ΤΟΜΕΑΡΧΗΣ' :
               return self::getUnitWorkerPermissions($user_role_desc, $getSchoolUnits, $implodeData);
               break;
           case 'ΚΕΠΛΗΝΕΤ' :
               return self::getKeplhnetWorkerPermissions($user_role_desc, $getSchoolUnits, $implodeData);
               break;
           case 'ΥΠΕΥΘΥΝΟΣ-ΔΙΑΤΑΞΗΣ' :
               return self::getLabWorkerPermissions($user_role_desc, $getSchoolUnits, $implodeData);
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
  
    /**
     * Get principal,itsector-responsible user attributes and 
     * returned user labs and school_units
     * 
     * @param type $user LDAP user attributes
     * @param boolean $getSchoolUnits True if want return school units mm_ids or false if not 
     * @param boolean $implodeData True if implode mm_id and labs_id with ',' in a string or false if not and return in arrays 
     * @return array Return permit_labs,permit_school_units of users
     * @throws Exception
     */
    public static function getUnitWorkerPermissions($user, $getSchoolUnits = false, $implodeData = false ) {

           $mm_id = $user['mm_id'];
           if (Validator::IsNull($mm_id)) throw new Exception(ExceptionMessages::MissingMmIdAttribute, ExceptionCodes::MissingMmIdAttribute); 

           $check_mm_id = Filters::checkSchoolUnits($mm_id);
           if (Validator::IsNull($check_mm_id[0])) throw new Exception(ExceptionMessages::MissingMmIdFromMylabDb, ExceptionCodes::MissingMmIdFromMylabDb); 
           
               $lab_ids = Filters::getLabsfromSchoolUnit($mm_id);

               if ($implodeData == true) {
                  $lab_ids = implode(",", $lab_ids);
               }

               $results = array ('permit_labs' => $lab_ids,             
                                 'permit_school_units' => $mm_id);    

               return $results;
    }

  
    /**
     * Get plinet,keplinet user attributes and 
     * returned user labs and school_units
     * 
     * @param type $user LDAP user attributes
     * @param boolean $getSchoolUnits True if want return school units mm_ids or false if not 
     * @param boolean $implodeData True if implode mm_id and labs_id with ',' in a string or false if not and return in arrays 
     * @return array Return permit_labs,permit_school_units of users
     * @throws Exception
     */
    public static function getKeplhnetWorkerPermissions($user, $getSchoolUnits = false, $implodeData = false) {

      $edu_admin_code = explode('=', $user['edu_admin']);
      if (Validator::IsNull($edu_admin_code[1])){
          throw new Exception(ExceptionMessages::MissingEduAdminLAttribute, ExceptionCodes::MissingEduAdminLAttribute); 
      }

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

    /**
     * Get itlab-responsible user attributes and 
     * returned user labs and school_units
     * 
     * @param type $user LDAP user attributes
     * @param boolean $getSchoolUnits True if want return school units mm_ids or false if not 
     * @param boolean $implodeData True if implode mm_id and labs_id with ',' in a string or false if not and return in arrays 
     * @return array Return permit_labs,permit_school_units of users and mm_ids_from_ldap,mm_ids_from_mylab for confirmation
     * @throws Exception
     */
    public static function getLabWorkerPermissions($user, $getSchoolUnits = true, $implodeData = false) {

        $registry_no = $user['registry_no'];
        if (Validator::IsNull($registry_no)) throw new Exception(ExceptionMessages::MissingLdapEmployeeNumberAttribute, ExceptionCodes::MissingLdapEmployeeNumberAttribute); 

        $lab_ids = Filters::getLabsfromRegistryNo($registry_no);
        $school_units = $getSchoolUnits == true ? Filters::getSchoolUnitsfromRegistryNo($registry_no): NULL;

        if (count($school_units)>0) {
            if (count(array_intersect($school_units, $user['mm_id'])) != count($school_units) ) {
                throw new Exception(ExceptionMessages::InconsistencyLdapMylabMMIds, ExceptionCodes::InconsistencyLdapMylabMMIds);
            }
        }
    
          if ($implodeData == true) {
             $lab_ids = implode(",", $lab_ids);
             $school_units = implode(",", $school_units);  
          }

          $results = array (
                              'permit_labs' => $lab_ids,             
                              'permit_school_units' => $school_units,
                              'mm_ids_from_ldap' => $user['mm_id'],
                              'mm_ids_from_mylab' => $school_units
                            );

      return $results;

    } 

   /**
     * Get psd-user or ypepth-personnel user attributes and 
     * returned user labs and school_units
     * 
     * @return array Return permit_labs,permit_school_units of users
     */
    public static function getAllPermissions() {

      $results = array (
                           'permit_labs' => 'ALLRESULTS',             
                           'permit_school_units' => 'ALLRESULTS'
                         );   

       return $results;
    }
    
}
?>