<?php
/**
 *
 * @version 1.0.1
 * @author  ΤΕΙ Αθήνας
 * @package GET
 * 
 * 
 */
 
header("Content-Type: text/html; charset=utf-8");

function GetUserPermits($user, $getSchoolUnits) {
    global $db;
    global $app;
    
    $filter = array();
            
    $result = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["data"] = array();
    $result["controller"] = __FUNCTION__;
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();

   try
   { 
    
   $user_role = UserRoles::getRole($user);
   
     switch ($user_role){
        case 'ΔΙΕΥΘΥΝΤΗΣ' :
            $result = self::getSchoolUnitWorkerPermissions($user);
        case 'ΚΕΠΛΗΝΕΤ' :
             $result = self::getKeplhnetWorkerPermissions($user,$getSchoolUnits);
        case 'ΣΕΠΕΗΥ' :
             $result = self::getLabWorkerPermissions($user,$getSchoolUnits);
        case 'ΠΣΔ' :
             $result = self::getAllPermissions();
        case 'ΥΠΕΠΘ' :
             $result = self::getAllPermissions();
        default:
            throw new Exception(ExceptionMessages::NotFoundUserPermissions, ExceptionCodes::NotFoundUserPermissions);
    }
     
  }
  
  
    catch (Exception $e) 
    {
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();

    }

    return $result;

}
?>