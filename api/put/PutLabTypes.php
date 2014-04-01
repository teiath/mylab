<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $lab_type_id
 * @param type $name
 * @return string
 * @throws Exception
 */

function PutLabTypes($lab_type_id,$name,$info_name) {
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
        
        $oLabTypes = new LabTypesExt($db);
        //$name==========================================================================================
        if (! trim($name) )
            throw new Exception(ExceptionMessages::MissingNameValue." : ".$name, ExceptionCodes::MissingNameValue);
        else
            $filter = new DFC(LabTypesExt::FIELD_NAME, $name, DFC::EXACT); 

           $nameLabTypes = $oLabTypes->findByFilter($db, $filter, true);

           if ( count( $nameLabTypes ) > 0 ) { 
                throw new Exception(ExceptionMessages::DuplicateLabTypeValue." : ".$name, ExceptionCodes::DuplicateLabTypeValue);
           }
           
        //$info_name==========================================================================================
        if (! trim($info_name) )
            throw new Exception(ExceptionMessages::MissingInfoNameValue." : ".$info_name, ExceptionCodes::MissingInfoNameValue);
        else
            $filter = new DFC(LabTypesExt::FIELD_INFO_NAME, $info_name, DFC::EXACT); 

           $infoNameLabTypes = $oLabTypes->findByFilter($db, $filter, true);

           if ( count( $infoNameLabTypes ) > 0 ) { 
                throw new Exception(ExceptionMessages::DuplicateInfoLabTypeValue." : ".$info_name, ExceptionCodes::DuplicateInfoLabTypeValue);
           }
        
        //$lab_type_id===========================================================================
        if (! trim($lab_type_id) )
            throw new Exception(ExceptionMessages::MissingLabTypeIdValue." : ".$lab_type_id, ExceptionCodes::MissingLabTypeIdValue);
        else if (!is_numeric($lab_type_id) || ( $lab_type_id < 0)  )
            throw new Exception(ExceptionMessages::InvalidLabTypeIdValue." : ".$lab_type_id, ExceptionCodes::InvalidLabTypeIdValue);
        else 
            $uLabTypes = LabTypesExt::findById($db, $lab_type_id);

        //=================================================================================================
        $result["total_found"]=count($uLabTypes);
        
        if ($result["total_found"]==1){
              
                $values["lab_type_id"] = $uLabTypes->getLabTypeId();
                $values["name"] = $uLabTypes->getName();
                $values["info_name"] = $uLabTypes->getInfoName();
                $result["values"] = $values;
                
                $update_values["lab_type_id"]=$lab_type_id;
                $update_values["name"] = $name;
                $update_values["info_name"] = $info_name;
                $result["updated_values"] = $update_values;
                
                $uLabTypes->setName($name);
                $uLabTypes->setInfoName($info_name);
                $uLabTypes->updateToDatabase($db);
               
                $result["status"] = 200;
                $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success"; 

        } else if ($result["total_found"]==0){
            throw new Exception(ExceptionMessages::UpdateLabTypeIdValue." : ".$lab_type_id, ExceptionCodes::UpdateLabTypeIdValue);
        } else {
           throw new Exception(ExceptionMessages::DuplicateLabTypeIdValue." : ".$lab_type_id, ExceptionCodes::DuplicateLabTypeIdValue);
        }
        
    } catch (Exception $e){      
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    }  
    return $result;
}

?>