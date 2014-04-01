<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $edu_admin_id
 * @param type $name
 * @param type $region_edu_admin
 * @return string
 * @throws Exception
 */

function PutEduAdmins($edu_admin_id,$name,$region_edu_admin) {
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
            $filter[] = new DFC(EduAdminsExt::FIELD_NAME, $name, DFC::EXACT);   
    
        //$region_edu_admin============================================================          
        if (! $region_edu_admin)
            throw new Exception(ExceptionMessages::CreateRegionEduAdminIdValue." : ".$region_edu_admin, ExceptionCodes::CreateRegionEduAdminIdValue);
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
            throw new Exception(ExceptionMessages::DuplicateRegionEduAdminIdValue." : ".$region_edu_admin, ExceptionCodes::DuplicateRegionEduAdminIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidRegionEduAdminValue." : ".$region_edu_admin, ExceptionCodes::InvalidRegionEduAdminValue);
        }  
 

        //$edu_admin_id===========================================================================
            if (! trim($edu_admin_id) )
                throw new Exception(ExceptionMessages::MissingEduAdminIdValue." : ".$edu_admin_id, ExceptionCodes::MissingEduAdminIdValue);
            else if (!is_numeric($edu_admin_id) || ( $edu_admin_id < 0)  )
                throw new Exception(ExceptionMessages::InvalidEduAdminIdValue." : ".$edu_admin_id, ExceptionCodes::InvalidEduAdminIdValue);
            else 
                $uEduAdmins = EduAdminsExt::findById($db, $edu_admin_id);

        //=================================================================================================
        $result["total_found"]=count($uEduAdmins);
                                                                                                            
        if ($result["total_found"]==1){
            
            $values["edu_admin_id"] = $uEduAdmins->getEduAdminId();
            $values["name"] = $uEduAdmins->getName();        
            $values["region_edu_admin"] = $uEduAdmins->getRegionEduAdminId();
            $result["values"] = $values;
            
            //check if $name is same as old name of same entry
            $oEduAdmins = new EduAdminsExt($db);
            $arrayEduAdmins = $oEduAdmins->findByFilter($db, $filter, true);

                if (( count( $arrayEduAdmins ) > 0 ) && ($values["name"]!=$name)) { 
                     throw new Exception(ExceptionMessages::DuplicateEduAdminValue." : ".$name, ExceptionCodes::DuplicateEduAdminValue);
                }  
            
            $update_values["edu_admin_id"] = $edu_admin_id;
            $update_values["name"] = $name;
            $update_values["region_edu_admin"] = $fRegionEduAdmin;
            $result["updated_values"] = $update_values;
            
            $uEduAdmins->setName($name);
            $uEduAdmins->setRegionEduAdminId($fRegionEduAdmin);
            $uEduAdmins->updateToDatabase($db);

            $result["status"] = 200;
            $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success"; 

        } else if ($result["total_found"]==0){
            throw new Exception(ExceptionMessages::UpdateEduAdminIdValue." : ".$edu_admin_id, ExceptionCodes::UpdateEduAdminIdValue);
        } else {
           throw new Exception(ExceptionMessages::DuplicateEduAdminIdValue." : ".$edu_admin_id, ExceptionCodes::DuplicateEduAdminIdValue);
        }
        
    } catch (Exception $e){      
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    }  
    return $result;
}

?>