<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @param type $name
 * @param type $edu_admin
 * @return string
 * @throws Exception
 */

function PostTransferAreas($name,$edu_admin) {
    global $db;
    global $Options;
    global $app;
    
    $result = array();  
    $result["data"] = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    $result["name"] = $name;
    $result["edu_admin"] = $edu_admin;
    
    try {
     
        //$name============================================================================
        if (! trim($name) )
            throw new Exception(ExceptionMessages::MissingNameValue." : ".$name, ExceptionCodes::MissingNameValue);
        else
            $filter[] = new DFC(TransferAreasExt::FIELD_NAME, $name, DFC::EXACT); 
 
        //$edu_admin======================================================================          
        if (! $edu_admin)
            throw new Exception(ExceptionMessages::CreateEduAdminIdValue." : ".$edu_admin, ExceptionCodes::CreateEduAdminIdValue);
        else {
              $oEduAdmins = new EduAdminsExt($db);

              if (is_numeric($edu_admin)) {
                  $filter[] = new DFC(EduAdminsExt::FIELD_EDU_ADMIN_ID, $edu_admin, DFC::EXACT) ;
              } else { 
                  $filter[] = new DFC(EduAdminsExt::FIELD_NAME, $edu_admin, DFC::EXACT);                
              }         
         }

        $arrayEduAdmins = $oEduAdmins->findByFilter($db, $filter, true);
        
        if ( count( $arrayEduAdmins ) === 1 ) { 
            $fEduAdmin = $arrayEduAdmins[0]->getEduAdminId();
        } else if ( count( $arrayEduAdmins ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicateEduAdminIdValue." : ".$edu_admin, ExceptionCodes::DuplicateEduAdminIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidEduAdminValue." : ".$edu_admin, ExceptionCodes::InvalidEduAdminValue);
        }  
        //==================================================================================
                   
        $oTransferAreas = new TransferAreasExt($db);
        $arrayTransferAreas = $oTransferAreas->findByFilter($db, $filter, true);
        
            if ( count( $arrayTransferAreas ) > 0 ) { 
                throw new Exception(ExceptionMessages::DuplicateTransferAreaValue." : ".$name, ExceptionCodes::DuplicateTransferAreaValue);
            }

        $oTransferAreas->setName($name);
        $oTransferAreas->setEduAdminId($fEduAdmin);
        $oTransferAreas->insertIntoDatabase($db);

        $result["transfer_area_id"] = $oTransferAreas->getTransferAreaId();
        
        $result["status"] = 200;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";
    } catch (Exception $e){ 
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
}

?>