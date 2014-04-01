<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $transfer_area_id
 * @param type $name
 * @param type $edu_admin
 * @return string
 * @throws Exception
 */

function PutTransferAreas($transfer_area_id,$name,$edu_admin) {
    global $db;
    global $Options;
    global $app;
    
    $result = array();
    $values = array();
    $update_values = array();
    $result["data"] = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    
    try {
       
        //$name==========================================================================================
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
 

        //$transfer_area_id===========================================================================
        if (! trim($transfer_area_id) )
            throw new Exception(ExceptionMessages::MissingTranferAreaIdValue." : ".$transfer_area_id, ExceptionCodes::MissingTranferAreaIdValue);
        else if (!is_numeric($transfer_area_id) || ( $transfer_area_id < 0)  )
            throw new Exception(ExceptionMessages::InvalidTranferAreaIdValue." : ".$transfer_area_id, ExceptionCodes::InvalidTranferAreaIdValue);
        else 
            $uTransferAreas = TransferAreasExt::findById($db, $transfer_area_id);

        //=================================================================================================
        $result["total_found"]=count($uTransferAreas);
                                                                                                            
        if ($result["total_found"]==1){
            
            $values["transfer_area_id"] = $uTransferAreas->getTransferAreaId();
            $values["name"] = $uTransferAreas->getName();        
            $values["edu_admin"] = $uTransferAreas->getEduAdminId();
            $result["values"] = $values;
            
            //check if $name is same as old name of same entry
            $oTransferAreas = new TransferAreasExt($db);
            $arrayTransferAreas = $oTransferAreas->findByFilter($db, $filter, true);

                if (( count( $arrayTransferAreas ) > 0 ) && ($values["name"]!=$name)) { 
                     throw new Exception(ExceptionMessages::DuplicateTransferAreaValue." : ".$name, ExceptionCodes::DuplicateTransferAreaValue);
                }  
            
            $update_values["transfer_area_id"] = $transfer_area_id;
            $update_values["name"] = $name;
            $update_values["edu_admin"] = $fEduAdmin;
            $result["updated_values"] = $update_values;
            
            $uTransferAreas->setName($name);
            $uTransferAreas->setEduAdminId($fEduAdmin);
            $uTransferAreas->updateToDatabase($db);

            $result["status"] = 200;
            $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success"; 

        } else if ($result["total_found"]==0){
            throw new Exception(ExceptionMessages::UpdateTransferAreaIdValue." : ".$transfer_area_id, ExceptionCodes::UpdateTransferAreaIdValue);
        } else {
           throw new Exception(ExceptionMessages::DuplicateTransferAreaIdValue." : ".$transfer_area_id, ExceptionCodes::DuplicateTransferAreaIdValue);
        }
        
    } catch (Exception $e){      
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    }  
    return $result;
}

?>