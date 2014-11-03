<?php
header("Content-Type: text/html; charset=utf-8");
header('Content-Type: application/json');

chdir("..");
require_once('system/includes.php');
require_once('libs/Slim/Slim.php');
 
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();
$app->config('debug', true);

//circuit_types=================================================================
        $app->get('/circuit_types',Authentication, function() use ($app) {  
            $result = syncCircuitTypes();
            ExportDataType($result);
        });
        
//edu_admins====================================================================
        $app->get('/edu_admins',Authentication, function() use ($app) {  
            $result = syncEduAdmins();
            ExportDataType($result);
        });

//region_edu_admins=============================================================
        $app->get('/region_edu_admins',Authentication, function() use ($app) {          
            $result = syncRegionEduAdmins();
            ExportDataType($result);  
        });
   
//education_levels=============================================================
        $app->get('/education_levels',Authentication, function() use ($app) {          
            $result = syncEducationLevels();
            ExportDataType($result);  
        });
        
//municipalities=============================================================
        $app->get('/municipalities',Authentication, function() use ($app) {          
            $result = syncMunicipalities();
            ExportDataType($result);  
        });
        
//prefectures=============================================================
        $app->get('/prefectures',Authentication, function() use ($app) {          
            $result = syncPrefectures();
            ExportDataType($result);  
        });
        
//function not found============================================================
$app->notFound(function () use ($app) 
{
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    try
    {
       if ( strtoupper($app->request()->getMethod()) != 'GET' )
            throw new Exception(ExceptionMessages::MethodNotFound, ExceptionCodes::MethodNotFound);
        else
            throw new Exception(ExceptionMessages::FunctionNotFound, ExceptionCodes::FunctionNotFound);
    } 
    catch (Exception $e) 
    {
        $result["status"] = $e->getCode();
        $result["message"] = "[".$app->request()->getMethod()."][".$controller."]:".$e->getMessage();
    }

    ExportDataType($result); 

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

function ExportDataType($result){
    global $app;
    
    if ($app->request()->get('type') == 'json' ) {
        JsonFunctions::PrepareResponse();    
        return $app->response()->setBody( JsonFunctions::toGreek( json_encode( $result ) ) );
    } else {
        return print_r($result); 
    } 
}

?>