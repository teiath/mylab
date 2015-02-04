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
* resourcePath="/user_permits",
* description="Πληροφορίες/Δικαιωματα Χρήστη",
* produces="['application/json']",
* @SWG\Api(
*   path="/user_permits",
*   @SWG\Operation(
*                   method="GET",
*                   summary="Αναζήτηση σε Πληροφορίες/Δικαιωματα Χρήστη",
*                   notes="Επιστρέφει τις Πληροφορίες/Δικαιωματα Χρήστη, με βάση τo username που έχει κάνει login στο mylab οποιοσδήποτε χρήστης.",
*                   type="getUserPermits",
*                   nickname="GetUserPermits",
* 
*   @SWG\ResponseMessage(code=ExceptionCodes::NotFoundUserPermissions, message=ExceptionMessages::NotFoundUserPermissions),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLdapLAttribute, message=ExceptionMessages::MissingLdapLAttribute),
*   @SWG\ResponseMessage(code=ExceptionCodes::NotFoundFullSchoolUnitDnsName, message=ExceptionMessages::NotFoundFullSchoolUnitDnsName),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateFullSchoolUnitDnsName, message=ExceptionMessages::DuplicateFullSchoolUnitDnsName),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLdapEmployeeNumberAttribute, message=ExceptionMessages::MissingLdapEmployeeNumberAttribute),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingGsnRegistryCodeAttribute, message=ExceptionMessages::MissingGsnRegistryCodeAttribute),
*   @SWG\ResponseMessage(code=ExceptionCodes::ErrorEduAdminReportKeplhnet, message=ExceptionMessages::ErrorEduAdminReportKeplhnet),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="getUserPermits",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="data",type="array",description="Ο Πίνακας με τα αποτελέσματα",items="$ref:UserPermit")
* )
*  
* @SWG\Model(
* id="UserPermit",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με δεδομένα του χρήστη : ",
* @SWG\Property(name="user_role",type="string",description="Ο ρόλος του Χρήστη"),
* @SWG\Property(name="user_permissions",type="array",description="Τα δικαιώματα πρόσβασης του χρήστη σε Διατάξεις Η/Υ και Σχολικές Μονάδες",items="$ref:UserPermissions"),
* @SWG\Property(name="user_infos",type="array",description="Τα προσσωπικά στοιχεία του χρήστη",items="$ref:UserInfos"),
* )
* 
* @SWG\Model(
* id="UserPermissions",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με δικαιώματα πρόσβασης του χρήστη : ",
* @SWG\Property(name="permit_labs",type="string",description="Οι Διατάξεις Η/Υ στις οποίες έχει πρόσβαση ο χρήστης (ALLRESULTS=πρόσβαση σε όλες τις Διατάξεις Η/Υ)"),
* @SWG\Property(name="permit_school_units",type="string",description="Οι Σχολικές Μονάδες στις οποίες έχει πρόσβαση ο χρήστης (ALLRESULTS=πρόσβαση σε όλες τις Σχολικές Μονάδες)")
* )
* 
* @SWG\Model(
* id="UserInfos",
* description="Επιστρέφει ένα πίνακα σε JSON μορφή με προσωπικά στοιχεία του χρήστη από το ΠΣΔ LDAP: ",
* @SWG\Property(name="user_name",type="string",description="Ονοματεπώνυμο χρήστη"),
* @SWG\Property(name="user_unit",type="string",description="Μονάδα που ανήκει ο χρήστης"),
* @SWG\Property(name="ldap_role",type="string",description="Ο ρόλος του χρήστη που του έχει αποδωθεί το το ΠΣΔ LDAP"),
* @SWG\Property(name="unit_name",type="string",description="Όνομα Σχολικής Μονάδας"),
* @SWG\Property(name="street_address",type="string",description="Διεύθυνση Σχολικής Μονάδας"),
* @SWG\Property(name="fax_number",type="integer",description="Φαξ Σχολικής Μονάδας"),
* @SWG\Property(name="phone_number",type="integer",description="Τηλεφωνικός Αριθμός Σχολικής Μονάδας"),
* @SWG\Property(name="email",type="string",description="Email Σχολικής Μονάδας")
* )
* 
**/

function GetUserPermits() {
    
    global $app;
    
    $result = array();
        
    $result["data"] = array();
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    
   try { 
       
 //user permissions==============================================================
//not required

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
                                "email" => $info_keplhnet['data'][0]['email']
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