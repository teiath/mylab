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
 * @global type $app
 * @return string
 * @throws Exception
 */

function GetUserPermits() {
    
    global $app;
    
    $result = array();
        
    $result["data"] = array();
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    
   try { 
 
        //set user role and permissions=========================================
       $user = $app->request->user;
       $role = UserRoles::getRole($user);
       $permissions = UserRoles::getUserPermissions($user, true);
       $role_ldap = UserRoles::getLdapRoleRanking($user);

        if ($role == 'ΚΕΠΛΗΝΕΤ'){
               
            $dns = explode(',', $user['l'][0]);
            $edu_admin_code = explode('=', $dns[1]);
            
            $edu_admins  = Reports::getKeplhnetfromEduAdminCode(Validator::ToValue($edu_admin_code[1]));
            if ( ($edu_admins->counter != 2) || (!Validator::IsNumeric($edu_admins->secondary)) || (!Validator::IsNumeric($edu_admins->primary)) ) {
                throw new Exception(ExceptionMessages::ErrorEduAdminReportKeplhnet, ExceptionCodes::ErrorEduAdminReportKeplhnet);
            }
            
            $params = array("state"=>1, "unit_type" => 24,"edu_admin"=>$edu_admins->secondary);            
            $info_keplhnet = Reports::getKeplhnetInfo($params);
 
        } 
        
        $user_infos = array(    "user_name" => $user['cn'][0],
                                "user_unit" => $user['ou'][0],
                                "ldap_role" => $role_ldap['maxLdapRole'],//$user['title'][0],
                                "unit_name" => $info_keplhnet['data'][0]['name'],
                                "street_address" => $info_keplhnet['data'][0]['street_address'],
                                "fax_number" => $info_keplhnet['data'][0]['fax_number'],
                                "phone_number" => $info_keplhnet['data'][0]['phone_number'],
                                "email" => $info_keplhnet['data'][0]['email'],

                            );

        $result["data"][] = array(  "user_role" => $role,
                                    "user_permissions" => $permissions,
                                    "user_infos" => $user_infos
                                 );
 
//result_messages===============================================================      
        $result["status"] = ExceptionCodes::NoErrors;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".ExceptionMessages::NoErrors;
    } catch (Exception $e) {
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    
    return $result;
}
?>