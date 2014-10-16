<?php
header("Content-Type: text/html; charset=utf-8");
header('Content-Type: application/json');

enableCORS();

chdir("../server");

require_once('system/includes.php');
require_once('libs/Slim/Slim.php');

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$app->config('debug', true);

//school units
$app->map('/edu_admins', Authentication, UserRolesPermission, EduAdminsController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/education_levels', Authentication, UserRolesPermission, EducationLevelsController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/municipalities', Authentication, UserRolesPermission, MunicipalitiesController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/prefectures', Authentication, UserRolesPermission, PrefecturesController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/region_edu_admins', Authentication, UserRolesPermission, RegionEduAdminsController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/school_units', Authentication, UserRolesPermission, SchoolUnitsController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/school_unit_types', Authentication, UserRolesPermission, SchoolUnitTypesController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/transfer_areas', Authentication, UserRolesPermission, TranferAreasController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/states', Authentication, UserRolesPermission, StatesController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/school_unit_workers', Authentication, UserRolesPermission, SchoolUnitWorkersController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/circuits', Authentication, UserRolesPermission, CircuitsController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/circuit_types', Authentication, UserRolesPermission, CircuitTypesController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/sources', Authentication, UserRolesPermission, SourcesController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);

//labs
$app->map('/aquisition_sources', Authentication, UserRolesPermission, AquisitionSourcesController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/worker_positions', Authentication, UserRolesPermission, WorkerPositionsController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/equipment_categories', Authentication, UserRolesPermission, EquipmentCategoriesController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/equipment_types', Authentication, UserRolesPermission, EquipmentTypesController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/labs', Authentication, UserRolesPermission, LabsController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/lab_aquisition_sources', Authentication, UserRolesPermission, LabAquisitionSourcesController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/lab_equipment_types', Authentication, UserRolesPermission, LabEquipmentTypesController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/workers', Authentication, UserRolesPermission, WorkersController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/lab_types', Authentication, UserRolesPermission, LabTypesController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/worker_specializations', Authentication, UserRolesPermission, WorkerSpecializationsController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/lab_relations', Authentication, UserRolesPermission, LabRelationsController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/relation_types', Authentication, UserRolesPermission, RelationTypesController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/lab_sources', Authentication, UserRolesPermission, LabSourcesController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/lab_transitions', Authentication, UserRolesPermission, LabTransitionsController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/lab_workers', Authentication, UserRolesPermission, LabWorkersController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);
$app->map('/mylab_workers', Authentication, UserRolesPermission, MylabWorkersController)
    ->via(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE);

$app->map('/search_school_units', Authentication, UserRolesPermission, SearchSchoolUnitsController)->via(MethodTypes::GET);
$app->map('/search_labs', Authentication, UserRolesPermission, SearchLabsController)->via(MethodTypes::GET);
$app->map('/search_lab_workers', Authentication, UserRolesPermission, SearchLabWorkersController)->via(MethodTypes::GET);

$app->map('/statistic_school_units', Authentication, UserRolesPermission, StatisticSchoolUnitsController)->via(MethodTypes::GET);
$app->map('/statistic_labs', Authentication, UserRolesPermission, StatisticLabsController)->via(MethodTypes::GET);
$app->map('/statistic_lab_workers', Authentication, UserRolesPermission, StatisticLabWorkersController)->via(MethodTypes::GET);
$app->map('/stat_labs', Authentication, UserRolesPermission, StatLabsController)->via(MethodTypes::GET);

$app->map('/report_keplhnet', Authentication, UserRolesPermission, ReportKeplhnetController)->via(MethodTypes::GET);

$app->map('/user_permits', Authentication, UserRolesPermission, UserPermitsController)->via(MethodTypes::GET);

$app->get('/docs/*', function () use ($app) {
    $app->redirect("http://mmsch.teiath.gr/mylab/docs/");
});

//function not found
$app->notFound(function () use ($app) 
{
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);

    try
    {
       if ( !in_array( strtoupper($app->request()->getMethod()), array(MethodTypes::GET, MethodTypes::POST, MethodTypes::PUT, MethodTypes::DELETE)))
            throw new Exception(ExceptionMessages::MethodNotFound, ExceptionCodes::MethodNotFound);
        else
            throw new Exception(ExceptionMessages::MethodNotFound, ExceptionCodes::MethodNotFound);
    } 
    catch (Exception $e) 
    {
        $result["status"] = $e->getCode();
        $result["message"] = "[".$app->request()->getMethod()."][".$controller."]:".$e->getMessage();
    }

    echo toGreek( json_encode( $result ) ); 

});

$app->run();

function enableCORS() {
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400'); // cache for 1 day
    }
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    }
}

#===== authentication controller ====================================================================

function Authentication()
{
    global $app;
    global $ldapOptions;
    global $frontendOptions;

    try
    {
        if(isset($app->request->headers['Php-Auth-User']) && isset($app->request->headers['Php-Auth-Pw'])) {
            $apcKey = 'mm_auth_'.md5($app->request->headers['Php-Auth-User'].$app->request->headers['Php-Auth-Pw']);
            if(!($userObj = apc_fetch($apcKey))) {
                $ldap = new \Zend\Ldap\Ldap($ldapOptions); 
                $ldap->bind('uid='.$app->request->headers['Php-Auth-User'].',ou=people,dc=sch,dc=gr', $app->request->headers['Php-Auth-Pw']);
                $result = $ldap->search('(&(objectClass=*)(uid='.$app->request->headers['Php-Auth-User'].'))', null, \Zend\Ldap\Ldap::SEARCH_SCOPE_ONE);
            
                if($result->count() == 1) {
                    $userObj = $result->getFirst();
                    apc_store($apcKey, $userObj, 3600); // Cache for 1 hour to prevent requests on every call
                } else {
                    throw new Exception(ExceptionMessages::UserAccesDenied, ExceptionCodes::UserAccesDenied); // Multiple users with this username?? Fail
                }
            }
            
            // userObj has all the user attributes now - We can check roles
            if ($app->request->get('user') != null) {  
                
                if ($app->request()->getMethod() == 'POST' || $app->request()->getMethod() == 'PUT' || $app->request()->getMethod() == 'DELETE' ){
                    $user = $app->request->get('user');
                    $userdecode = json_decode(urldecode($user),TRUE);
                    $app->request->user = array_map("convertCasTOLdap", $userdecode);
                }else{                    
                    $app->request->user = array_map("convertCasTOLdap", $app->request->get('user'));              
                }
                    
            } else if (($app->request->get('user') == null) && ($userObj['uid'][0] == $frontendOptions['frontendUsername'])){
                throw new Exception(ExceptionMessages::UserAccesFrontDenied, ExceptionCodes::UserAccesFrontDenied); 
            }else { 
                $app->request->user = $userObj;
            }
        
        } else {
            throw new Exception(ExceptionMessages::UserAccesEmptyDenied, ExceptionCodes::UserAccesEmptyDenied); // Empty username/pass - Maybe guest access?
        }
    }
    catch (Exception $e)
    {
        if($e instanceof \Zend\Ldap\Exception\LdapException) {
            $result["message"] = "[".$app->request()->getMethod()."][".__FUNCTION__."]:Invalid credentials";
        } else {
            $result["message"] = "[".$app->request()->getMethod()."][".__FUNCTION__."]:".$e->getMessage();
        }
        $result["status"] = $e->getCode();

        PrepareResponse();
        $app->response()->setBody( toGreek( json_encode( $result ) ) );
        $app->stop();
    }
}

#===== user roles controller ====================================================================

function UserRolesPermission(){

    global $app;  

    $controller = substr($app->request()->getPathInfo(),1);
    $method = $app->request()->getMethod();

    try {
           
        $check = UserRoles::checkUserRolePermissions($controller,$method,$app->request->user);
  
        if ($check!=true){
                    throw new Exception(ExceptionMessages::Unauthorized, ExceptionCodes::Unauthorized);
        }
        
    }
    catch (Exception $e)
    {
        $result["user"] =  $app->request->user['uid'];
        //$result["user_all"] = $app->request->user;       
        $result["user_role"] = UserRoles::getRole($app->request->user);
        $result["status"] = $e->getCode();
        $result["message"] = "[".$method."][".$controller."]:".$e->getMessage();

        PrepareResponse();
        $app->response()->setBody( toGreek( json_encode( $result ) ) );
        $app->stop();
    }

}

#=========================================================================

function PrepareResponse()
{
    global $app;

    $app->contentType('application/json');
    $app->response()->headers()->set('Content-Type', 'application/json; charset=utf-8');
    $app->response()->headers()->set('X-Powered-By', 'ΤΕΙ Αθήνας');
    $app->response()->setStatus(200);
}


function UrlParamstoArray($params)
{
    $items = array();
    foreach (explode('&', $params) as $chunk) {
        $param = explode("=", $chunk);
        $items = array_merge($items, array($param[0] => urldecode($param[1])));
    }
    return $items;

}

function loadParameters()
{
    global $app;

    if ($app->request->getBody())
    {
        if ( is_array( $app->request->getBody() ) )
            $params = $app->request->getBody();
        else if ( json_decode( $app->request->getBody() ) )
            $params = get_object_vars( json_decode($app->request->getBody(), false) );
        else
            $params = UrlParamstoArray($app->request->getBody());
    }
    else
    {
        if ( json_decode( key($_REQUEST) ) )
            $params = get_object_vars( json_decode(key($_REQUEST), false) );
        else
            $params = $_REQUEST;
    }
    
    // array to object
    //$params = json_decode (json_encode ($params), FALSE);

    return $params;
}

function replace_unicode_escape_sequence($match) {
    return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
}

function toGreek($value)
{
    return preg_replace_callback('/\\\\u([0-9a-f]{4})/i', 'replace_unicode_escape_sequence', $value ? $value : array());
}

//used to convert cas results to ldap results format
function convertCasTOLdap($casResults) {

   $ldapResults = is_array($casResults) ? $casResults : array($casResults);

    return $ldapResults;
}

#======= school units controllers ==========================================================
#===========================================================================================
function EduAdminsController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetEduAdmins(
                $params["edu_admin_id"],
                $params["name"],
                $params["edu_admin_code"],
                $params["region_edu_admin"],
                $params["pagesize"],
                $params["page"],
                $params["searchtype"],
                $params["ordertype"],
                $params["orderby"]
                
            );      
            break;
        case MethodTypes::POST :
            $result = PostEduAdmins(
                $params["edu_admin_id"], 
                $params["name"], 
                $params["region_edu_admin"],
                $params["sync_array"]
            );      
            break;
      case MethodTypes::PUT :
            $result = PutEduAdmins(
                $params["edu_admin_id"],
                $params["name"],
                $params["region_edu_admin"]
            );      
            break;
       case MethodTypes::DELETE :
            $result = DelEduAdmins(
                $params["name"] 
            );      
            break;  
    }
    
    //echo toGreek( json_encode( $result ) );
    // echo json_encode($result ? $result : array());
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}

function EducationLevelsController()
{
    global $app;
    $params = loadParameters();    
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetEducationLevels(
                $params["education_level_id"], 
                $params["name"],
                $params["pagesize"],
                $params["page"],
                $params["searchtype"],
                $params["ordertype"],
                $params["orderby"]
            );      
            break;
        case MethodTypes::POST :
            $result = PostEducationLevels(
                $params["name"]
            );      
            break;
      case MethodTypes::PUT :
            $result = PutEducationLevels(
                 $params["education_level_id"],
                 $params["name"]
            );      
            break;
       case MethodTypes::DELETE :
            $result = DelEducationLevels(
                $params["name"]
            );      
            break;  
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}

function MunicipalitiesController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetMunicipalities(
                $params["municipality_id"],
                $params["name"],
                $params["transfer_area"],
                $params["prefecture"],
                $params["pagesize"],
                $params["page"],
                $params["searchtype"],
                $params["ordertype"],
                $params["orderby"]
            );      
            break;
        case MethodTypes::POST :
            $result = PostMunicipalities(
                $params["name"], 
                $params["transfer_area"],
                $params["prefecture"]
            );      
            break;
      case MethodTypes::PUT :
            $result = PutMunicipalities(
                $params["municipality_id"],
                $params["name"], 
                $params["transfer_area"],
                $params["prefecture"]
            );      
            break;
       case MethodTypes::DELETE :
            $result = DelMunicipalities(
                $params["name"]
            );      
            break;  
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}

function PrefecturesController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetPrefectures(
                $params["prefecture_id"],
                $params["name"],
                $params["pagesize"],
                $params["page"],
                $params["searchtype"],
                $params["ordertype"],
                $params["orderby"]
            );      
            break;
        case MethodTypes::POST :
            $result = PostPrefectures(
                $params["name"]
            );      
            break;
      case MethodTypes::PUT :
            $result = PutPrefectures(
                $params["prefecture_id"],
                $params["name"]
            );      
            break;
       case MethodTypes::DELETE :
            $result = DelPrefectures(
                $params["name"]
            );      
            break;  
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}

function RegionEduAdminsController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetRegionEduAdmins(
                $params["region_edu_admin_id"],
                $params["name"],
                $params["pagesize"],
                $params["page"],
                $params["searchtype"],
                $params["ordertype"],
                $params["orderby"]
            );      
            break;
        case MethodTypes::POST :
            $result = PostRegionEduAdmins(
                $params["name"]
            );      
            break;
      case MethodTypes::PUT :
            $result = PutRegionEduAdmins(
                $params["region_edu_admin_id"],
                $params["name"]
            );      
            break;
       case MethodTypes::DELETE :
            $result = DelRegionEduAdmins(
                $params["name"]
            );      
            break;  
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}

function SchoolUnitsController()
{
    global $app;
  
    $params = loadParameters();

    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetSchoolUnits(
                $params["school_unit_id"],
                $params["name"],
                $params["special_name"],
                $params["last_update"],
                $params["fax_number"],
                $params["phone_number"],
                $params["email"],
                $params["street_address"],
                $params["postal_code"],
                $params["unit_dns"],     
                $params["region_edu_admin"],
                $params["edu_admin"],
                $params["transfer_area"],
                $params["municipality"],
                $params["prefecture"], 
                $params["education_level"], 
                $params["school_unit_type"],
                $params["state"],
                $params["school_unit"],
                $params["pagesize"],
                $params["page"],
                $params["searchtype"],
                $params["ordertype"],
                $params["orderby"]           
            );      
            break;
        case MethodTypes::POST :
//            $result = PostSchoolUnits(
//                $params["name"],
//                $params["fax_number"],
//                $params["phone_number"],
//                $params["email"],
//                $params["street_address"],
//                $params["postal_code"],
//                $params["region_edu_admin"],
//                $params["edu_admin"],
//                $params["transfer_area"],
//                $params["municipality"],
//                $params["prefecture"], 
//                $params["education_level"], 
//                $params["school_unit_type"]  
//            );      
//            break;
      case MethodTypes::PUT :
//            $result = PutSchoolUnits(
//                $params["school_unit_id"],
//                $params["name"],
//                $params["fax_number"],
//                $params["phone_number"],
//                $params["email"],
//                $params["street_address"],
//                $params["postal_code"],
//                $params["region_edu_admin"],
//                $params["edu_admin"],
//                $params["transfer_area"],
//                $params["municipality"],
//                $params["prefecture"], 
//                $params["education_level"], 
//                $params["school_unit_type"]  
//            );      
//            break;
       case MethodTypes::DELETE :
//            $result = DelSchoolUnits(
//                $params["name"]
//            );      
//            break;  
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}

function SchoolUnitTypesController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetSchoolUnitTypes(
                $params["school_unit_type_id"], 
                $params["name"], 
                $params["education_level"], 
                $params["pagesize"],
                $params["page"],
                $params["searchtype"],
                $params["ordertype"],
                $params["orderby"]
            );      
            break;
        case MethodTypes::POST :
            $result = PostSchoolUnitTypes(
                $params["name"],
                $params["education_level"]
            );      
            break;
      case MethodTypes::PUT :
            $result = PutSchoolUnitTypes(
                $params["school_unit_type_id"],
                $params["name"],
                $params["education_level"]
            );      
            break;
       case MethodTypes::DELETE :
            $result = DelSchoolUnitTypes(
                $params["name"]
            );      
            break;  
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}

function TranferAreasController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetTransferAreas(
                $params["transfer_area_id"],
                $params["name"],
                $params["edu_admin"],
                $params["pagesize"],
                $params["page"],
                $params["searchtype"],
                $params["ordertype"],
                $params["orderby"]
            );      
            break;
        case MethodTypes::POST :
            $result = PostTransferAreas(
                $params["name"], 
                $params["edu_admin"]
            );      
            break;
      case MethodTypes::PUT :
            $result = PutTransferAreas(
                $params["transfer_area_id"],
                $params["name"], 
                $params["edu_admin"]
            );      
            break;
       case MethodTypes::DELETE :
            $result = DelTransferAreas(
                $params["name"]
            );      
            break;  
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}

function StatesController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetStates(    
                $params["pagesize"], 
                $params["page"]
            );      
            break;
//        case MethodTypes::POST :
//            $result = PostStates(
//                $params["name"]
//            );      
//            break;
//      case MethodTypes::PUT :
//            $result = PutStates(
//                $params["state_id"],
//                $params["name"]
//            );      
//            break;
//       case MethodTypes::DELETE :
//            $result = DelStates(
//                $params["name"]
//            );      
//            break;  
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}

function SchoolUnitWorkersController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetSchoolUnitWorkers(
                $params["school_unit"], 
                $params["worker"], 
                $params["worker_position"], 
                $params["pagesize"], 
                $params["page"]
            );      
            break;
//        case MethodTypes::POST :
//            $result = PostSchoolUnitWorkers(
//         
//            );      
//            break;
//      case MethodTypes::PUT :
//            $result = PutSchoolUnitWorkers(
//       
//            );      
//            break;
//       case MethodTypes::DELETE :
//            $result = DelSchoolUnitWorkers(
//            );      
//            break;  
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}

function CircuitsController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetCircuits(
                $params["circuit_id"],
                $params["phone_number"],
                $params["updated_date"],
                $params["status"],
                $params["circuit_type"],
                $params["school_unit_id"],
                $params["school_unit_name"], 
                $params["pagesize"],
                $params["page"],
                $params["searchtype"],
                $params["ordertype"],
                $params["orderby"]
            );      
            break;
//        case MethodTypes::POST :
//            $result = PostCircuits(
//         
//            );      
//            break;
//      case MethodTypes::PUT :
//            $result = PutCircuits(
//       
//            );      
//            break;
//       case MethodTypes::DELETE :
//            $result = DelCircuits(
//            );      
//            break;  
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}

function CircuitTypesController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetCircuitTypes(
                $params["circuit_type_id"], 
                $params["name"],
                $params["pagesize"],
                $params["page"],
                $params["searchtype"],
                $params["ordertype"],
                $params["orderby"]
            );      
            break;
//        case MethodTypes::POST :
//            $result = PostCircuitTypes(
//         
//            );      
//            break;
//      case MethodTypes::PUT :
//            $result = PutCircuitTypes(
//       
//            );      
//            break;
//       case MethodTypes::DELETE :
//            $result = DelCircuitTypes(
//            );      
//            break;  
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}

function SourcesController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetSources(
                $params["source_id"], 
                $params["name"],
                $params["pagesize"],
                $params["page"],
                $params["searchtype"],
                $params["ordertype"],
                $params["orderby"]
            );      
            break;
//        case MethodTypes::POST :
//            $result = PostCircuitTypes(
//         
//            );      
//            break;
//      case MethodTypes::PUT :
//            $result = PutCircuitTypes(
//       
//            );      
//            break;
//       case MethodTypes::DELETE :
//            $result = DelCircuitTypes(
//            );      
//            break;  
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}

#======= labs controllers ===================================================================
#============================================================================================

function AquisitionSourcesController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetAquisitionSources(                             
                $params["aquisition_source_id"], 
                $params["name"],
                $params["pagesize"], 
                $params["page"],
                $params["searchtype"],
                $params["ordertype"],
                $params["orderby"]
            );      
            break;
        case MethodTypes::POST :
            $result = PostAquisitionSources(
                $params["name"]
            );      
            break;
      case MethodTypes::PUT :
            $result = PutAquisitionSources(
                $params["aquisition_source_id"],
                $params["name"]
            );      
            break;
       case MethodTypes::DELETE :
            $result = DelAquisitionSources(
                $params["name"]
            );      
            break;  
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}


function WorkerPositionsController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetWorkerPositions(    
                $params["pagesize"], 
                $params["page"]
            );      
            break;
        case MethodTypes::POST :
            $result = PostWorkerPositions(
                $params["name"]
            );      
            break;
      case MethodTypes::PUT :
            $result = PutWorkerPositions(
                $params["employment_relationship_id"],
                $params["name"]
            );      
            break;
       case MethodTypes::DELETE :
            $result = DelWorkerPositions(
                $params["name"]
            );      
            break;  
    }   
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}

function EquipmentCategoriesController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetEquipmentCategories( 
                $params["equipment_category_id"],
                $params["name"],
                $params["pagesize"],
                $params["page"],
                $params["searchtype"],
                $params["ordertype"],
                $params["orderby"]
            );      
            break;
        case MethodTypes::POST :
            $result = PostEquipmentCategories(
                $params["name"]
            );      
            break;
      case MethodTypes::PUT :
            $result = PutEquipmentCategories(
                $params["equipment_category_id"],
                $params["name"]
            );      
            break;
       case MethodTypes::DELETE :
            $result = DelEquipmentCategories(
                $params["name"]
            );      
            break;  
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}

function EquipmentTypesController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetEquipmentTypes(
                $params["equipment_type_id"],
                $params["name"],
                $params["equipment_category"],
                $params["pagesize"],
                $params["page"],
                $params["searchtype"],
                $params["ordertype"],
                $params["orderby"]
            );      
            break;
        case MethodTypes::POST :
            $result = PostEquipmentTypes(
                $params["name"],
                $params["number"],
                $params["equipment_category"]
            );      
            break;
      case MethodTypes::PUT :
            $result = PutEquipmentTypes(
                $params["equipment_type_id"],
                $params["name"],
                $params["number"],
                $params["equipment_category"]
            );      
            break;
       case MethodTypes::DELETE :
            $result = DelEquipmentTypes(
                $params["name"]
            );      
            break;  
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}


function LabsController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetLabs(
                $params["lab_id"],
                $params["name"],
                $params["special_name"],
                $params["creation_date"],
                $params["operational_rating"],
                $params["technological_rating"],
                $params["lab_worker"],
                $params["lab_type"],
                $params["school_unit"],
                $params["state"],
                $params["source"],
                $params["aquisition_source"],
                $params["equipment_type"],
                $params["pagesize"], 
                $params["page"],
                $params["sort_field"],
                $params["sort_mode"]
            );      
            break;
        case MethodTypes::POST :
            $result = PostLabs(
                $params["special_name"],
                $params["positioning"],
                $params["comments"],
                $params["operational_rating"],
                $params["technological_rating"],
                $params["ellak"],
                $params["lab_type"],
                $params["school_unit_id"],
                $params["state"],
                $params["lab_source"],
                $params["transition_date"], 
                $params["transition_justification"], 
                $params["transition_source"]
            );      
            break;
      case MethodTypes::PUT :
            $result = PutLabs(
                $params["lab_id"],
                $params["special_name"],
                $params["positioning"],
                $params["comments"],
                $params["operational_rating"],
                $params["technological_rating"],
                $params["ellak"]
            );      
            break;
       case MethodTypes::DELETE :
            $result = DelLabs(
                $params["lab_id"]
            );      
            break;  
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}

function LabAquisitionSourcesController()
{
    global $app;
    $params = loadParameters();
   
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetLabAquisitionSources(
                $params["lab_aquisition_source_id"],
                $params["aquisition_year"],
                $params["aquisition_source"],
                $params["lab_id"],
                $params["lab_name"],
                $params["pagesize"],
                $params["page"],
                $params["searchtype"],
                $params["ordertype"],
                $params["orderby"]
            );      
            break;
        case MethodTypes::POST :
            $result = PostLabAquisitionSources(
                $params["lab_id"],
                $params["aquisition_source"],
                $params["aquisition_year"],
                $params["aquisition_comments"]
            );
      
            break;
      case MethodTypes::PUT :
            $result = PutLabAquisitionSources(
                $params["lab_aquisition_source_id"],
                $params["lab_id"],
                $params["aquisition_source"],
                $params["aquisition_year"],
                $params["aquisition_comments"]
            );      
            break;
       case MethodTypes::DELETE :
            $result = DelLabAquisitionSources(
                $params["lab_id"],
                $params["lab_aquisition_source_id"]
            );      
            break;  
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}

function LabEquipmentTypesController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetLabEquipmentTypes(
                $params["lab_id"],
                $params["lab_name"],
                $params["equipment_type_id"],
                $params["equipment_type_name"],
                $params["items"],
                $params["pagesize"],
                $params["page"],
                $params["searchtype"],
                $params["ordertype"],
                $params["orderby"]
            );      
            break;
        case MethodTypes::POST :
            $result = PostLabEquipmentTypes(
                $params["lab_id"],
                $params["equipment_type"],
                $params["items"]
            );      
            break;
      case MethodTypes::PUT :
            $result = PutLabEquipmentTypes(
                $params["lab_id"],
                $params["equipment_type_id"],
                $params["items"]
            );      
            break;
       case MethodTypes::DELETE :
            $result = DelLabEquipmentTypes(
                $params["lab_id"],
                $params["equipment_type_id"]
            );     
            break;  
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}


function WorkersController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetWorkers(
                $params["worker_id"],
                $params["registry_no"],
                $params["tax_number"],          
                $params["firstname"],
                $params["lastname"],
                $params["fathername"],   
                $params["sex"],
                $params["worker_specialization"],
                $params["source"],
                $params["worker"],
                $params["pagesize"],
                $params["page"],
                $params["searchtype"],
                $params["ordertype"],
                $params["orderby"]
            );   
            break;
        case MethodTypes::POST :
            $result = PostWorkers(
                $params["registry_number"],
                $params["firstname"],
                $params["lastname"], 
                $params["fathername"],
                $params["sex"],
                $params["specialization_code"],
                $params["employment_relationship"]
            );      
            break;
      case MethodTypes::PUT :
            $result = PutWorkers(
                $params["lab_responsible_id"],
                $params["registry_number"],
                $params["firstname"],
                $params["lastname"], 
                $params["fathername"],
                $params["sex"],
                $params["specialization_code"],
                $params["employment_relationship"]    
            );      
            break;
       case MethodTypes::DELETE :
            $result = DelWorkers(
                $params["registry_number"]
            );      
            break;  
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}

function LabTypesController()
{
    global $app;  
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetLabTypes(    
                $params["lab_type_id"],
                $params["name"],
                $params["full_name"],
                $params["pagesize"],
                $params["page"],
                $params["searchtype"],
                $params["ordertype"],
                $params["orderby"]
            );      
            break;
        case MethodTypes::POST :
            $result = PostLabTypes(
                $params["name"],
                $params["info_name"]
            );      
            break;
      case MethodTypes::PUT :
            $result = PutLabTypes(
                $params["lab_type_id"],
                $params["name"],
                $params["info_name"]
            );      
            break;
       case MethodTypes::DELETE :
            $result = DelLabTypes(
                $params["name"]
            );      
            break;  
    }   
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}


function WorkerSpecializationsController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetWorkerSpecializations(    
                $params["pagesize"], 
                $params["page"]
            );      
            break;
        case MethodTypes::POST :
            $result = PostWorkerSpecializations(
                $params["code"]
            );      
            break;
      case MethodTypes::PUT :
            $result = PutWorkerSpecializations(
                $params["specialization_code_id"],
                $params["code"]
            );      
            break;
       case MethodTypes::DELETE :
            $result = DelWorkerSpecializations(
                $params["code"]
            );      
            break;  
    }   
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}

function LabRelationsController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetLabRelations(
                $params["lab_relation_id"],
                $params["relation_type"],
                $params["circuit_id"],
                $params["circuit_phone_number"],
                $params["school_unit_id"],
                $params["school_unit_name"],
                $params["lab_id"],                 
                $params["lab_name"],
                $params["pagesize"],
                $params["page"],
                $params["searchtype"],
                $params["ordertype"],
                $params["orderby"]
            );      
            break;
        case MethodTypes::POST :
            $result = PostLabRelations(
                $params["lab_id"], 
                $params["school_unit_id"],
                $params["relation_type"], 
                $params["circuit_id"]
            );      
            break;
      case MethodTypes::PUT :
            $result = PutLabRelations(
                $params["lab_relation_id"],
                $params["lab_id"], 
                $params["school_unit_id"],
                $params["relation_type"], 
                $params["circuit_id"]
            );      
            break;
       case MethodTypes::DELETE :
            $result = DelLabRelations(
                $params["lab_id"],
                $params["lab_relation_id"]
            );      
            break;  
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}

function RelationTypesController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetRelationTypes(
                $params["relation_type_id"], 
                $params["name"],
                $params["pagesize"],
                $params["page"],
                $params["searchtype"],
                $params["ordertype"],
                $params["orderby"]
            );      
            break;
//        case MethodTypes::POST :
//            $result = PostRelationTypes(
// 
//            );      
//            break;
//      case MethodTypes::PUT :
//            $result = PutRelationTypes(
//       
//            );      
//            break;
//       case MethodTypes::DELETE :
//            $result = DelRelationTypes(
//            );      
//            break;  
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}

function LabSourcesController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetLabSources(
                $params["lab_source_id"], 
                $params["name"],
                $params["pagesize"],
                $params["page"],
                $params["searchtype"],
                $params["ordertype"],
                $params["orderby"]
            );      
            break;
//        case MethodTypes::POST :
//            $result = PostLabSources(
//         
//            );      
//            break;
//      case MethodTypes::PUT :
//            $result = PutLabSources(
//       
//            );      
//            break;
//       case MethodTypes::DELETE :
//            $result = DelLabSources(
//            );      
//            break;  
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}

function LabTransitionsController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetLabTransitions(
                $params["lab_transition_id"],                 
                $params["transition_date"], 
                $params["transition_source"],
                $params["from_state"], 
                $params["to_state"],
                $params["lab_id"], 
                $params["lab_name"], 
                $params["pagesize"],
                $params["page"],
                $params["searchtype"],
                $params["ordertype"],
                $params["orderby"]
            );      
            break;
        case MethodTypes::POST :
            $result = PostLabTransitions(
                $params["lab_id"], 
                $params["state"],
                $params["transition_date"], 
                $params["transition_justification"], 
                $params["transition_source"]
            );      
            break;
      case MethodTypes::PUT :
            $result = PutLabTransitions(
                $params["lab_transition_id"],
                $params["transition_justification"], 
                $params["transition_source"]
            );      
            break;
       case MethodTypes::DELETE :
            $result = DelLabTransitions(
                $params["lab_transition_id"]
            );      
            break;  
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}

function LabWorkersController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetLabWorkers(
                $params["lab_worker_id"], 
                $params["worker_status"], 
                $params["worker_start_service"], 
                $params["worker_id"],
                $params["worker_position"], 
                $params["lab_id"],
                $params["lab_name"],
                $params["pagesize"],
                $params["page"],
                $params["searchtype"],
                $params["ordertype"],
                $params["orderby"]
            );      
            break;
        case MethodTypes::POST :
            $result = PostLabWorkers(
                    $params["lab_id"],
                    $params["worker_id"],
                    $params["worker_position"],
                    $params["worker_email"],
                    $params["worker_status"],
                    $params["worker_start_service"]
            );      
            break;
      case MethodTypes::PUT :
            $result = PutLabWorkers(
                    $params["lab_worker_id"],
                    $params["worker_status"]
            );      
            break;
       case MethodTypes::DELETE :
            $result = DelLabWorkers(
                    $params["lab_worker_id"]
            );      
            break;  
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );

}

function MylabWorkersController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetMylabWorkers(
                $params["worker_id"],
                $params["registry_no"],
                $params["tax_number"],          
                $params["firstname"],
                $params["lastname"],
                $params["fathername"],   
                $params["sex"],
                $params["worker_specialization"],
                $params["lab_source"],
                $params["worker"],
                $params["pagesize"],
                $params["page"],
                $params["searchtype"],
                $params["ordertype"],
                $params["orderby"]
            );   
            break;
        case MethodTypes::POST :
            $result = PostMylabWorkers(
                $params["registry_number"],
                $params["firstname"],
                $params["lastname"], 
                $params["fathername"],
                $params["sex"],
                $params["specialization_code"],
                $params["lab_source"]
            );      
            break;
      case MethodTypes::PUT :
            $result = PutMylabWorkers(
                $params["worker_id"],
                $params["registry_number"],
                $params["firstname"],
                $params["lastname"], 
                $params["fathername"],
                $params["sex"],
                $params["specialization_code"],
                $params["lab_source"]    
            );      
            break;
       case MethodTypes::DELETE :
            $result = DelMylabWorkers(
                $params["worker_id"]
            );      
            break;  
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );
}

function SearchSchoolUnitsController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = SearchSchoolUnits(
                $params["school_unit_id"],
                $params["school_unit_name"],
                $params["school_unit_special_name"],
                $params["region_edu_admin"],
                $params["edu_admin"],
                $params["transfer_area"],
                $params["municipality"],
                $params["prefecture"], 
                $params["education_level"], 
                $params["school_unit_type"],
                $params["school_unit_state"],
                $params["lab_id"],
                $params["lab_name"],
                $params["lab_special_name"],
                $params["creation_date"],
                $params["operational_rating"],
                $params["technological_rating"],
                $params["submitted"],
                $params["lab_type"],
                $params["lab_state"],
                $params["lab_source"],
                $params["aquisition_source"],
                $params["equipment_type"],
                $params["lab_worker"],
                $params["pagesize"], 
                $params["page"],
                $params["orderby"],
                $params["ordertype"],
                $params["searchtype"],
                $params["export"],
                $params["debug"]
            );      
            break;
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );

}

function SearchLabsController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = SearchLabs(
                $params["lab_id"],
                $params["lab_name"],
                $params["lab_special_name"],
                $params["creation_date"],
                $params["operational_rating"],
                $params["technological_rating"],
                $params["submitted"],
                $params["lab_type"],
                $params["school_unit_id"],
                $params["school_unit_name"],
                $params["school_unit_special_name"],
                $params["lab_state"],
                $params["lab_source"],
                $params["aquisition_source"],
                $params["equipment_type"],                    
                $params["lab_worker"],
                $params["region_edu_admin"],
                $params["edu_admin"],
                $params["transfer_area"],
                $params["municipality"],
                $params["prefecture"],
                $params["education_level"], 
                $params["school_unit_type"],
                $params["school_unit_state"],
                $params["pagesize"], 
                $params["page"],
                $params["orderby"],
                $params["ordertype"],
                $params["searchtype"],
                $params["export"],
                $params["debug"]
            );      
            break;
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );

}

function SearchLabWorkersController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = SearchLabWorkers(
                $params["lab_worker_id"],
                $params["worker_status"],
                $params["worker_start_service"],
                $params["lab_id"],
                $params["lab_name"],
                $params["worker_position"],
                $params["worker"],
                $params["worker_registry_no"],
                $params["lab_type"],
                $params["school_unit_id"],
                $params["school_unit_name"],
                $params["lab_state"],
                $params["region_edu_admin"],
                $params["edu_admin"],
                $params["transfer_area"],
                $params["municipality"],
                $params["prefecture"],
                $params["education_level"], 
                $params["school_unit_type"],
                $params["school_unit_state"],
                $params["pagesize"], 
                $params["page"],
                $params["orderby"],
                $params["ordertype"],
                $params["searchtype"],
                $params["export"],
                $params["debug"]
            );      
            break;
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );

}

function StatisticSchoolUnitsController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = StatisticSchoolUnits(
                $params["school_unit_id"],
                $params["school_unit_name"],
                $params["school_unit_special_name"],
                $params["region_edu_admin"],
                $params["edu_admin"],
                $params["transfer_area"],
                $params["municipality"],
                $params["prefecture"], 
                $params["education_level"], 
                $params["school_unit_type"],
                $params["school_unit_state"],
                $params["lab_id"],
                $params["lab_name"],
                $params["lab_special_name"],
                $params["creation_date"],
                $params["operational_rating"],
                $params["technological_rating"],
                $params["lab_type"],
                $params["lab_state"],
                $params["lab_source"],
                $params["aquisition_source"],
                $params["equipment_type"],
                $params["lab_worker"],
                $params["searchtype"],
                $params["debug"]
            );      
            break;
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );

}

function StatisticLabsController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = StatisticLabs(
                $params["lab_id"],
                $params["lab_name"],
                $params["lab_special_name"],
                $params["creation_date"],
                $params["operational_rating"],
                $params["technological_rating"],
                $params["lab_type"],
                $params["school_unit_id"],
                $params["school_unit_name"],
                $params["school_unit_special_name"],
                $params["lab_state"],
                $params["lab_source"],
                $params["aquisition_source"],
                $params["equipment_type"],                    
                $params["lab_worker"],
                $params["region_edu_admin"],
                $params["edu_admin"],
                $params["transfer_area"],
                $params["municipality"],
                $params["prefecture"],
                $params["education_level"], 
                $params["school_unit_type"],
                $params["school_unit_state"],
                $params["searchtype"],
                $params["debug"]
            );      
            break;
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );

}

function StatisticLabWorkersController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = StatisticLabWorkers(
                $params["lab_worker_id"],
                $params["worker_status"],
                $params["worker_start_service"],
                $params["lab_id"],
                $params["lab_name"],
                $params["worker_position"],
                $params["worker"],
                $params["worker_registry_no"],
                $params["lab_type"],
                $params["school_unit_id"],
                $params["school_unit_name"],
                $params["lab_state"],
                $params["region_edu_admin"],
                $params["edu_admin"],
                $params["transfer_area"],
                $params["municipality"],
                $params["prefecture"],
                $params["education_level"], 
                $params["school_unit_type"],
                $params["school_unit_state"],
                $params["searchtype"],
                $params["debug"]
            );      
            break;
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );

}

function StatLabsController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = StatLabs(
                $params["x_axis"],
                $params["y_axis"],                
                $params["operational_rating"],
                $params["technological_rating"],
                $params["lab_type"],
                $params["lab_state"],
                $params["region_edu_admin"],
                $params["edu_admin"],
                $params["transfer_area"],
                $params["municipality"],
                $params["prefecture"],
                $params["education_level"],
                $params["school_unit_type"],
                $params["school_unit_state"],
                $params["debug"]
            );      
            break;
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );

}

function ReportKeplhnetController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = ReportKeplhnet(
                $params["edu_admin_code"]
            );      
            break;
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );

}

function UserPermitsController()
{
    global $app;
    $params = loadParameters();
    
    switch ( strtoupper( $app->request()->getMethod() ) )
    {
        case MethodTypes::GET : 
            $result = GetUserPermits(
            );      
            break;
    }
    
    PrepareResponse();
    $app->response()->setBody( toGreek( json_encode( $result ) ) );

}

?>