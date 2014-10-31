<?php
header("Content-Type: text/html; charset=utf-8");
header('Content-Type: application/json');

chdir("..");
require_once('system/includes.php');
require_once('libs/Slim/Slim.php');
 
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$app->config('debug', true);

$app->get('/circuit_types',Authentication, function () use ($app) {  
    $result = syncCircuitTypes();
    print_r($result);

//uncomment if want return json results   
//    JsonFunctions::PrepareResponse();    
//    $app->response()->setBody( JsonFunctions::toGreek( json_encode( $result ) ) );
             
});

$app->get('/edu_admins',Authentication, function () use ($app) {  
    $result = syncEduAdmins();
    print_r($result);             
});

$app->get('/region_edu_admins/:test',Authentication, function($test) {  
    $result = syncRegionEduAdmins($test);
    print_r($result);             
});

$app->run();

//Authentication Function=======================================================
function Authentication()
{
    global $app, $Options;

    try
    { 
        if (! (($_SERVER['PHP_AUTH_USER'] == $Options["ServerSyncUsername"] ) && ($_SERVER['PHP_AUTH_PW'] == $Options["ServerSyncPassword"] )))
            throw new Exception(ExceptionMessages::Unauthorized, ExceptionCodes::Unauthorized);
    }
    catch (Exception $e)
    {
        $result["status"] = $e->getCode();
        $result["message"] = "[".$app->request()->getMethod()."][".__FUNCTION__."]:".$e->getMessage();
        $app->response()->setBody( JsonFunctions::toGreek( json_encode( $result ) ) );
        $app->stop();
    }
}

?>