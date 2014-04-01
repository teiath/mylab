<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $region_edu_admin_id
 * @param type $name
 * @return string
 * @throws Exception
 */

function PutRegionEduAdmins($region_edu_admin_id,$name) {
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
            $filter[] = new DFC(RegionEduAdminsExt::FIELD_NAME, $name, DFC::EXACT); 

           $oRegionEduAdmins = new RegionEduAdminsExt($db);
           $arrayRegionEduAdmins = $oRegionEduAdmins->findByFilter($db, $filter, true);

           if ( count( $arrayRegionEduAdmins ) > 0 ) { 
                throw new Exception(ExceptionMessages::DuplicateRegionEduAdminValue." : ".$name, ExceptionCodes::DuplicateRegionEduAdminValue);
           }     
        
        //$region_edu_admin_id===========================================================================
        if (! trim($region_edu_admin_id) )
            throw new Exception(ExceptionMessages::MissingRegionEduAdminIdValue." : ".$region_edu_admin_id, ExceptionCodes::MissingRegionEduAdminIdValue);
        else if (!is_numeric($region_edu_admin_id) || ( $region_edu_admin_id < 0)  )
            throw new Exception(ExceptionMessages::InvalidRegionEduAdminIdValue." : ".$region_edu_admin_id, ExceptionCodes::InvalidRegionEduAdminIdValue);
        else 
            $uRegionEduAdmins = RegionEduAdminsExt::findById($db, $region_edu_admin_id);

        //=================================================================================================
        $result["total_found"]=count($uRegionEduAdmins);
        
        if ($result["total_found"]==1){
              
                $values["region_edu_admin_id"] = $uRegionEduAdmins->getRegionEduAdminId();
                $values["name"] = $uRegionEduAdmins->getName();
                $result["values"] = $values;
               
                $update_values["region_edu_admin_id"] = $region_edu_admin_id;
                $update_values["name"] = $name;
                $result["updated_values"] = $update_values;
                
                $uRegionEduAdmins->setName($name);
                $uRegionEduAdmins->updateToDatabase($db);

                $result["status"] = 200;
                $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success"; 

        } else if ($result["total_found"]==0){
            throw new Exception(ExceptionMessages::UpdateRegionEduAdminIdValue." : ".$region_edu_admin_id, ExceptionCodes::UpdateRegionEduAdminIdValue);
        } else {
           throw new Exception(ExceptionMessages::DuplicateRegionEduAdminIdValue." : ".$region_edu_admin_id, ExceptionCodes::DuplicateRegionEduAdminIdValue);
        }
        
    } catch (Exception $e){      
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    }  
    return $result;
}

?>