<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @param string $edu_admin_id
 * @param type $name
 * @param type $region_edu_admin_id
 * @return string
 * @throws Exception
 */

function PostEduAdmins($edu_admin_id, $name, $region_edu_admin, $sync_array) {
    global $db;
    global $Options;
    global $app;
    
    $result = array();  
    //$result["data"] = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();

$error_messages = array();
if (! $sync_array){
    $sync_array = array(
        "edu_admin_id" => $edu_admin_id,
        "name" => $name,
        "region_edu_admin" => $region_edu_admin
    );
} 


    if ($sync_array){
       // $rEduAdmins = new EduAdminsExt;
        //$rEduAdmins->
        
        for ($i=0;$i<count($sync_array);$i++){
           $filter = array();
           $error_messages = array() ;

           echo "\n=============================================================";
          // echo "\n".$sync_array[$i]->edu_admin_id."\n".$sync_array[$i]->name."\n".$sync_array[$i]->region_edu_admin;
           $edu_admin_id = $sync_array[$i]->edu_admin_id;
           $name = $sync_array[$i]->name;
           $region_edu_admin = $sync_array[$i]->region_edu_admin;
                $result["edu_admin_id"] = $edu_admin_id;
                $result["name"] = $name;
                $result["region_edu_admin"] = $region_edu_admin;
    
    try {

         //$edu_admin_id===========================================================================
            if (! trim($edu_admin_id) )
                $error_messages[] = ExceptionMessages::MissingEduAdminIdValue." : ".$edu_admin_id."  Exception Code". ExceptionCodes::MissingEduAdminIdValue;
            else if (!is_numeric($edu_admin_id) || ( $edu_admin_id < 0)  )
                $error_messages[] = ExceptionMessages::InvalidEduAdminIdValue." : ".$edu_admin_id."  Exception Code".  ExceptionCodes::InvalidEduAdminIdValue;
            else { 
                $fEdu_admin_id = trim($edu_admin_id);
                $filter[] = new DFC(EduAdminsExt::FIELD_EDU_ADMIN_ID, $edu_admin_id, DFC::EXACT);
            }
        //$name============================================================================
        if (! trim($name) )
            $error_messages[] = ExceptionMessages::MissingNameValue." : ".$name."  Exception Code".  ExceptionCodes::MissingNameValue;
        else
            $filter[] = new DFC(EduAdminsExt::FIELD_NAME, $name, DFC::EXACT);
        
        //$region_edu_admin============================================================          
        if (! $region_edu_admin)
            $error_messages[] = ExceptionMessages::CreateRegionEduAdminIdValue." : ".$region_edu_admin."  Exception Code".  ExceptionCodes::CreateRegionEduAdminIdValue;
        else {
              $oRegionEduAdmins = new RegionEduAdminsExt($db);

              if (is_numeric($region_edu_admin)) {
                  $filter[] = new DFC(RegionEduAdminsExt::FIELD_REGION_EDU_ADMIN_ID, $region_edu_admin, DFC::EXACT) ;
              } else { 
                  $filter[] = new DFC(RegionEduAdminsExt::FIELD_NAME, $region_edu_admin, DFC::EXACT);                
              }         
         }

        $arrayRegionEduAdmins = $oRegionEduAdmins->findByFilter($db, $filter, true);
        
        if ( count( $arrayRegionEduAdmins ) === 1 ) { 
            $fRegionEduAdmin = $arrayRegionEduAdmins[0]->getRegionEduAdminId();
        } else if ( count( $arrayRegionEduAdmins ) > 1 ) { 
            $error_messages[] = ExceptionMessages::DuplicateRegionEduAdminIdValue." : ".$region_edu_admin."  Exception Code".  ExceptionCodes::DuplicateRegionEduAdminIdValue;
        } else {
            $error_messages[] = ExceptionMessages::InvalidRegionEduAdminValue." : ".$region_edu_admin."  Exception Code".  ExceptionCodes::InvalidRegionEduAdminValue;
        }  
        //==================================================================================  
        
        if (!$error_messages){
            $oEduAdmins = new EduAdminsExt($db);
            $oEduAdmins->setEduAdminId($fEdu_admin_id);
            $oEduAdmins->setName($name);
            $oEduAdmins->setRegionEduAdminId($fRegionEduAdmin);
            $oEduAdmins->updateInsertToDatabase($db);
            $result["edu_admin_id"] = $oEduAdmins->getEduAdminId();
            $result["errors_message"] = null;  
            $result["status"] = 200;
            $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";            
        } else{
            $result["status"] = 800;
            $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."failure";    
            $result["errors_message"] = $error_messages;  
        }
        

    } catch (Exception $e){ 
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    
      
      
    $test[] = $result; 
              
              
    
   
    }
           foreach ($test as $errors){
              echo "\n";
              print_r($errors);
              echo "\n";
          }
    }
     return $test;
}

?>