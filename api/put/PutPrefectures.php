<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $prefecture_id
 * @param type $name
 * @return string
 * @throws Exception
 */

function PutPrefectures($prefecture_id,$name) {
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
            $filter[] = new DFC(PrefecturesExt::FIELD_NAME, $name, DFC::EXACT); 

           $oPrefectures = new PrefecturesExt($db);
           $arrayPrefectures = $oPrefectures->findByFilter($db, $filter, true);

           if ( count( $arrayPrefectures ) > 0 ) { 
                throw new Exception(ExceptionMessages::DuplicatePrefectureValue." : ".$name, ExceptionCodes::DuplicatePrefectureValue);
           }     
        
        //$prefecture_id===========================================================================
        if (! trim($prefecture_id) )
            throw new Exception(ExceptionMessages::MissingPrefectureIdValue." : ".$prefecture_id, ExceptionCodes::MissingPrefectureIdValue);
        else if (!is_numeric($prefecture_id) || ( $prefecture_id < 0)  )
            throw new Exception(ExceptionMessages::InvalidPrefectureIdValue." : ".$prefecture_id, ExceptionCodes::InvalidPrefectureIdValue);
        else 
            $uPrefectures = PrefecturesExt::findById($db, $prefecture_id);

        //=================================================================================================
        $result["total_found"]=count($uPrefectures);
        
        if ($result["total_found"]==1){
              
                $values["prefecture_id"] = $uPrefectures->getPrefectureId();
                $values["name"] = $uPrefectures->getName();
                $result["values"] = $values;
               
                $update_values["prefecture_id"] = $prefecture_id;
                $update_values["name"] = $name;
                $result["updated_values"] = $update_values;
                
                $uPrefectures->setName($name);
                $uPrefectures->updateToDatabase($db);

                $result["status"] = 200;
                $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success"; 

        } else if ($result["total_found"]==0){
            throw new Exception(ExceptionMessages::UpdatePrefectureIdValue." : ".$prefecture_id, ExceptionCodes::UpdatePrefectureIdValue);
        } else {
           throw new Exception(ExceptionMessages::DuplicatePrefectureIdValue." : ".$prefecture_id, ExceptionCodes::DuplicatePrefectureIdValue);
        }
        
    } catch (Exception $e){      
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    }  
    return $result;
}

?>