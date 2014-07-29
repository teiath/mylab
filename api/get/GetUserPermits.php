<?php
 
header("Content-Type: text/html; charset=utf-8");

function GetUserPermits() {
    global $app;
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["data"] = array();
    $result["controller"] = __FUNCTION__;
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();

   try
   { 
 
        //set user role and permissions
       $role = UserRoles::getRole($app->request->user);
       $permissions = UserRoles::getUserPermissions($app->request->user, true);
       
       $result = array("user_role" => $role,
                       "user_permissions" => $permissions
                        );
           
    }
    catch (Exception $e) 
    {
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();

    }
    return $result;
}
?>