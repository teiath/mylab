<?php
class CheckUserRole {
 
/**
 * 
 * Check user attributes for permissions to api functions
 * 
 * @param type $controller Api function 
 * @param type $method Api method 
 * @param type $user Ldap user attributes
 * @return strong Return true if found role or exception if not
 */
 public static function checkUserRolePermissions($controller, $method, $user){

    if (array_key_exists($controller, UserRoles::$Permissions)) {

        $role = self::getRole($user)['max_role'];
        
        if ( $role == 'noAccess' ){
             throw new Exception(ExceptionMessages::UserNoRoleAccess, ExceptionCodes::UserNoRoleAccess);
        }else if (in_array( $role , UserRoles::$Permissions[$controller][$method] ) ) {
           return true;
        } else {
            throw new Exception(ExceptionMessages::UserRoleHasNoPermissions, ExceptionCodes::UserRoleHasNoPermissions);
        }
         
    }
    
    return false; 
}


/**
 * 
 * Check user attributes for max_role mylab system
 * 
 * @param type $user Ldap user attributes
 * @return string Return user role description
 */
public static function getRole($user) {
               
    if (!Validator::IsNull($user)) { 
        $role = self::getLdapRoleRanking($user) ; 
        return $role;
    } else{
        return false;
    }

}

/**
 * 
 * Check user attributes and get max user role 
 * 
 * @param type $user Ldap user attributes
 * @return array Return max_role(mylab system role) and maxLdapRole(ldap role)
 */
 public static function getLdapRoleRanking($user){
     
    //check if user has KEPLINET OR PLINET role
    if (!Validator::IsNull($user["memberof"])){ 
        $data = null;
        $data = self::checkKeplinetRole($user);  
        if ($data != 'noGroup'){
            return array( "max_role" => $data['role'], "maxLdapRole"=>$data['ldap_role_name'] , "edu_admin"=>$data['edu_admin'] );
        }
    }

    if (!Validator::IsNull($user["gsnuserroleon;school-principal"])) {
       $data = null;
       $data = self::checkPrincipalRole($user["gsnuserroleon;school-principal"]);
            return array( "max_role" => $data['role'], "maxLdapRole"=>$data['ldap_role_name'], "mm_id"=>$data['mm_id'] );
    } 
    
    if (!Validator::IsNull($user["gsnuserroleon;itsector-responsible"])) {
       $data = null;
       $data = self::checkItSectorResponsibleRole($user["gsnuserroleon;itsector-responsible"]);
            return array( "max_role" => $data['role'], "maxLdapRole"=>$data['ldap_role_name'], "mm_id"=>$data['mm_id'] );
    } 
  
     if (!Validator::IsNull($user["gsnuserroleon;itlab-responsible"])) {
       $data = null;
       $data = self::checkItLabResponsibleRole($user["gsnuserroleon;itlab-responsible"]);
            return array( "max_role" => $data['role'], "maxLdapRole"=>$data['ldap_role_name'], "mm_id"=>$data['mm_id'], "registry_no"=>$user['employeenumber'][0] );
    }    

    //check if user has PSD role
    if (!Validator::IsNull($user["edupersonorgunitdn"])){
        $data = null;
        $data = self::checkPsdRole($user["edupersonorgunitdn"]);  
        if ($data != 'noGroup'){
            return array( "max_role" => $data['role'], "maxLdapRole"=>$data['ldap_role_name'] );
        }
    }    
    
     if (!Validator::IsNull($user["gsnuserroleon;ypepth-personnel"])) {
       $data= null;  
       $data = self::checkYpepthPersonnelRole($user["gsnuserroleon;ypepth-personnel"]);
            return array( "max_role" => $data['role'], "maxLdapRole"=>$data['ldap_role_name'], "unit_name"=>$data['unit_name'] );
    }    

    return array( "max_role" => "noAccess", "maxLdapRole"=>"noAccess");

        
 }
 
    /**
    * 
    * Check 'memberof' ldap attribute and check if 
    * user is member of group plinet or keplinet
    * 
    * @param type $user Ldap user attributes
    * @return array return role(mylab role),ldap_role(plinet or keplinet),ldap_role_name(greek) and edu_admin(of user)
    */
    public static function checkKeplinetRole($user){
       $data = array();
       $numOfGroups = 0;

       foreach ($user['memberof'] as $memberof){
           $member = explode(',', $memberof);

           if (($member[0] == 'cn=plinet') && ($member[1] =='ou=Groups')) {
               $numOfGroups++;
               $data = array (
                              "role"=> "ΚΕΠΛΗΝΕΤ",
                              'ldap_role' => 'plinet',
                              'ldap_role_name' => 'ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ',
                              'edu_admin' => $member[2]
                              );
           }

          if (($member[0] == 'cn=keplinet') && ($member[1] =='ou=Groups')) {
              $numOfGroups++;
              $data = array (
                             "role"=> "ΚΕΠΛΗΝΕΤ",
                             'ldap_role' => 'keplinet',
                             'ldap_role_name' => 'ΤΕΧΝΙΚΟΣ ΥΠΕΥΘΥΝΟΣ ΚΕΠΛΗΝΕΤ',
                             'edu_admin' => $member[2]
                             );
           }
      }

      if ($numOfGroups == 0 )
          return $data='noGroup';
      else if ($numOfGroups == 1 )
          return $data;
      else
          throw new Exception(ExceptionMessages::UserIsMemberOfDuplicate, ExceptionCodes::UserIsMemberOfDuplicate); 

    }

    /**
    * 
    * Check 'edupersonorgunitdn' ldap attribute and check if 
    * user is member of PSD
    * 
    * @param type $user Ldap user attributes
    * @return array return role(mylab role),ldap_role(plinet or keplinet),ldap_role_name(greek) and edu_admin(of user)
    */
    public static function checkPsdRole($edupersonorgunitdn){
  
        foreach ($edupersonorgunitdn as $value){
            if ($value=='ou=partners,ou=units,dc=sch,dc=gr'){
                $found = true;
                $data = array (
                       "role"=> "ΠΣΔ",
                       'ldap_role' => 'psd-user',
                       'ldap_role_name' => 'ΠΡΟΣΩΠΙΚΟ ΠΣΔ'
                       );
            }      
        }
        
        if ($found == true) 
            return $data;
        else 
            return $data='noGroup';
    }
    
    /**
     * 
     * Check the dn value of 'gsnuserroleon;school-principal' ldap attribute and check if 
     * user is principal of school unit
     * 
     * @param type $dn Ldap dn attribute
     * @return array return role(mylab role),ldap_role(pricipal),ldap_role_name(greek) and mm_id(school unit of user)
     */
    public static function checkPrincipalRole($dn){
        
        if (count($dn)>1)
            throw new Exception(ExceptionMessages::UserMultiplePrincipal, ExceptionCodes::UserMultiplePrincipal);
        else
            $gsnRegistryCode = self::getGsnRegistryCode($dn[0]);   
        //$gsnRegistryCode = self::getGsnRegistryCode('ou=2lyk-argous,ou=arg,ou=units,dc=sch,dc=gr');  
        
        $data = array (
                       "role"=> "ΔΙΕΥΘΥΝΤΗΣ",
                       'ldap_role' => 'pricipal',
                       'ldap_role_name' => 'ΔΙΕΥΘΥΝΤΗΣ ΣΧΟΛΕΙΟΥ',
                       'mm_id' => $gsnRegistryCode
                       );
        return $data;     
    }
  
    /**
     * 
     * Check the dn value of 'gsnuserroleon;itsector-responsible' ldap attribute and check if 
     * user is itsector-responsible of school unit
     * 
     * @param type $dn Ldap dn attribute
     * @return array return role(mylab role),ldap_role(itsector-responsible),ldap_role_name(greek) and mm_id(school unit of user)
     */
    public static function checkItSectorResponsibleRole($dn){
        
        if (count($dn)>1)
            throw new Exception(ExceptionMessages::UserMultipleItSectorResponsible, ExceptionCodes::UserMultipleItSectorResponsible);
        else
            $gsnRegistryCode = self::getGsnRegistryCode($dn[0]);   
        
        $data = array (
                       "role"=> "ΤΟΜΕΑΡΧΗΣ",
                       'ldap_role' => 'itsector-responsible',
                       'ldap_role_name' => 'ΥΠΕΥΘΥΝΟΣ ΤΟΜΕΑ ΠΛΗΡΟΦΟΡΙΚΗΣ ΕΚ',
                       'mm_id' => $gsnRegistryCode
                       );
        return $data;     
    }
    
    /**
     * 
     * Check the dn value of 'gsnuserroleon;itlab-responsible' ldap attribute and check if 
     * user is itsector-responsible of school unit
     * 
     * @param type $dn Ldap dn attribute
     * @return array return role(mylab role),ldap_role(itlab-responsible),ldap_role_name(greek) and mm_id(school unit of user)
     */
    public static function checkItLabResponsibleRole($dn){
  
        foreach ($dn as $value){
           $gsnRegistryCode[] = self::getGsnRegistryCode($value);
        }

        $data = array (
                       "role"=> "ΥΠΕΥΘΥΝΟΣ-ΔΙΑΤΑΞΗΣ",
                       'ldap_role' => 'itlab-responsible',
                       'ldap_role_name' => 'ΥΠΕΥΘΥΝΟΣ ΔΙΑΤΑΞΗΣ H/Y',
                       'mm_id' => $gsnRegistryCode
                       );
        return $data;     
    }
        
    /**
     * 
     * Check the dn value of 'gsnuserroleon;ypepth-personnel' ldap attribute and check if 
     * user is ypepth-personnel of unit
     * 
     * @param type $dn Ldap dn attribute
     * @return array return role(mylab role),ldap_role(ypepth-personnel),ldap_role_name(greek) and unit_name(name unit of user)
     */
    public static function checkYpepthPersonnelRole($dn){
  
        foreach ($dn as $value){
           $unitName[] = self::getUnitName($value);
        }

        $data = array (
                       "role"=> "ΥΠΕΠΘ",
                       'ldap_role' => 'ypepth-personnel',
                       'ldap_role_name' => 'ΠΡΟΣΩΠΙΚΟ ΥΠΟΥΡΓΕΙΟΥ ΠΑΙΔΕΙΑΣ',
                       'unit_name' => $unitName
                       );
        return $data;     
    }
    
     /**
     * 
     * Check the dn value of role ldap attribute and found  
     * the GsnRegistryCode of unit
     * 
     * @param type $dn Ldap dn attribute
     * @return string GsnRegistryCode value
     */
    public static function getGsnRegistryCode($dn){

      global $ldapOptions, $ldapSearchOptions;

      $ldap = new \Zend\Ldap\Ldap($ldapOptions);
      $ldap->bind($ldapSearchOptions['username'],$ldapSearchOptions['password']);
      $lresult = $ldap->getEntry($dn);

      if (!Validator::IsNull($lresult)) {
          if (count($lresult["gsnregistrycode"]) == 1)
              return $lresult["gsnregistrycode"][0];
          else if (count($lresult["gsnregistrycode"]) == 0) 
              throw new Exception(ExceptionMessages::GsnRegistryCodeNotFound, ExceptionCodes::GsnRegistryCodeNotFound); 
          else 
              throw new Exception(ExceptionMessages::GsnRegistryCodeMultiple, ExceptionCodes::GsnRegistryCodeMultiple);
      } else {
          throw new Exception(ExceptionMessages::DnNotFound, ExceptionCodes::DnNotFound);      
      }  
    }
    
    /**
     * 
     * Check the dn value of role ldap attribute and found  
     * the Name of unit
     * 
     * @param type $dn Ldap dn attribute
     * @return string Name value
     */
    public static function getUnitName($dn){

      global $ldapOptions, $ldapSearchOptions;

      $ldap = new \Zend\Ldap\Ldap($ldapOptions);
      $ldap->bind($ldapSearchOptions['username'],$ldapSearchOptions['password']);
      $lresult = $ldap->getEntry($dn);
      
      if (!Validator::IsNull($lresult)) {
          if (count($lresult["description"]) == 1)
              return $lresult["description"][0];
          else if (count($lresult["description"]) == 0) 
              throw new Exception(ExceptionMessages::UnitNameNotFound, ExceptionCodes::UnitNameNotFound); 
          else 
              throw new Exception(ExceptionMessages::UnitNameMultiple, ExceptionCodes::UnitNameMultiple);
      } else {
          throw new Exception(ExceptionMessages::DnNotFound, ExceptionCodes::DnNotFound);      
      }  
    }

}
?>