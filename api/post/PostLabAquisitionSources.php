<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $app
 * @param type $lab_id
 * @param type $equipment_type
 * @param type $items
 * @param type $equipment_types
 * @return string
 * @throws Exception
 */

function PostLabAquisitionSources($lab_id, $aquisition_source, $aquisition_year, $aquisition_comments, $multiple_aquisition_sources) 

{
    
    global $db;
    global $app;


    $result = array();  
    $result["data"] = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);

    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = $app->request->getBody();
    
    $result["lab_id"] = $lab_id;
    $result["aquisition_source"] = $aquisition_source;
    $result["aquisition_year"] = $aquisition_year;
    $result["aquisition_comments"] = $aquisition_comments;
    $result["multiple_aquisition_sources"] = $multiple_aquisition_sources;
     
    try {
        
         //$lab_id==============================================================
         
        if (Validator::isMissing('lab_id'))
            throw new Exception(ExceptionMessages::MissingLabParam." : ".$lab_id, ExceptionCodes::MissingLabParam);
        else if (Validator::IsNull($lab_id) )
            throw new Exception(ExceptionMessages::MissingLabValue." : ".$lab_id, ExceptionCodes::MissingLabValue);
        else if (!Validator::IsNumeric($lab_id) || Validator::IsNegative($lab_id))
	    throw new Exception(ExceptionMessages::InvalidLabValue." : ".$lab_id, ExceptionCodes::InvalidLabValue);    
        else if (Validator::IsID($lab_id)) {
            $filter[] = new DFC(LabsExt::FIELD_LAB_ID, Validator::ToID($lab_id), DFC::EXACT);     
            
            $oLabs = new LabsExt($db);
            $arrayLabs = $oLabs->findByFilter($db, $filter, true);
            
            if ( count($arrayLabs) === 1 ) { 
                $fLabId = $arrayLabs[0]->getLabId();
            } else if ( count( $arrayLabs ) > 1 ) { 
                throw new Exception(ExceptionMessages::DuplicateLabsIdValue." : ".$lab_id, ExceptionCodes::DuplicateLabsIdValue);
            } else {
                throw new Exception(ExceptionMessages::InvalidLabIdValue." : ".$lab_id, ExceptionCodes::InvalidLabIdValue);
            }
       
        }
        else
            throw new Exception(ExceptionMessages::UnknownLabIdValue." : ".$lab_id, ExceptionCodes::UnknownLabIdValue);           
        
        //check if aquisition_source is multiple input or not ============================================================         
        if (Validator::IsExists('aquisition_source') && Validator::isMissing('multiple_aquisition_sources')) 
            $aquisition_sources = $aquisition_source . '=' .$aquisition_year . '=' . $aquisition_comments;
         else if (Validator::IsExists('multiple_aquisition_sources') && Validator::isMissing('aquisition_source')) 
            $aquisition_sources = $multiple_aquisition_sources;
        else if (Validator::isMissing('aquisition_source') && Validator::isMissing('aquisition_source')) 
            throw new Exception(ExceptionMessages::MissingLabAquisitionSourceParam." : ".$lab_id, ExceptionCodes::MissingLabAquisitionSourceParam);
         else 
            throw new Exception(ExceptionMessages::NotAllowedLabAquisitionSources." : ".$lab_id, ExceptionCodes::NotAllowedLabAquisitionSources);      
        
   //$aquisition_source_id============================================================
            if (Validator::IsValue($aquisition_sources)){
        // if ($aquisition_sources) {
             
            //count aquisition_sources data from aquisition_sources table and return at AquisitionSourceId
//            $count_vbl_aquisition_sources = AquisitionSourcesExt::getAllCount($db);
//            $count_aquisitions_sources_vbl = $count_vbl_aquisition_sources[0]->getAquisitionSourceId();

            //count aquisition_sources data from user input at GET request
              if (Validator::IsNull($aquisition_sources))
                throw new Exception(ExceptionMessages::MissingLabAquisitionSourceParam." : ".$aquisition_sources, ExceptionCodes::MissingLabAquisitionSourceParam); 
            else if (Validator::IsValue($aquisition_sources))
                $count_aquisition_sources = Validator::ToArray($aquisition_sources);
            else if (Validator::IsArray($aquisition_sources))
                $count_aquisition_sources  = Validator::ToArray($aquisition_sources);
            else 
                throw new Exception(ExceptionMessages::InvalidAquisitionSourceInputValue." : ".$aquisition_sources, ExceptionCodes::InvalidAquisitionSourceInputValue); 
             
//            //$count_aquisition_sources = preg_split("/[\s]*[,][\s]*/", $aquisition_sources);  
//            $count_aquisitions_sources_usr = count( $count_aquisition_sources ); 

            //check if user has input more variable than aquisition_sources vocabulary
//            if ( $count_aquisitions_sources_usr <= $count_aquisitions_sources_vbl ) {         
        
                $oAquisitionSources = new AquisitionSourcesExt($db);
                $oAquisitionSources->getAll($db);
                
                foreach ($count_aquisition_sources as $aquisition_source){
                    
                    //split equipment_types data to equipment_type and items
                    if (Validator::IsArray($aquisition_source,'='))
                        $split_aquisition_sources  = Validator::ToArray($aquisition_source,'=');
                    else 
                        throw new Exception(ExceptionMessages::InvalidAquisitionSourceInputValue." : ".$aquisition_source, ExceptionCodes::InvalidAquisitionSourceInputValue); 
                    
                   // $split_aquisition_sources = preg_split("/[\s]*[=][\s]*/", $aquisition_source);  
                    $count_aquisition_sources_internal = count( $split_aquisition_sources );

                    if ($count_aquisition_sources_internal < 4 ) {
      
                        //aquisition_sources==============================================================================================
                        if (Validator::IsNull($split_aquisition_sources[0])){
                            throw new Exception(ExceptionMessages::MissingAquisitionSourceIdValue." : ".$split_aquisition_sources[0], ExceptionCodes::MissingAquisitionSourceIdValue); 
                        }else if (Validator::IsID($split_aquisition_sources[0])) {
                            $filter = array( new DFC(AquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, Validator::ToID($split_aquisition_sources[0]), DFC::EXACT) );
                            //$arrayAquisitionSources = $oAquisitionSources->findByFilter($db, $filter, true);      
                        } else if (Validator::IsValue($split_aquisition_sources[0])) {
                            $oAquisitionSources->searchArrayForValue(Validator::ToValue($split_aquisition_sources[0]));
                            $filter  =array(  new DFC(AquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, $oAquisitionSources->getAquisitionSourceId(), DFC::EXACT) );
                            //$arrayAquisitionSources = $oAquisitionSources->findByFilter($db, $filter, true);             
                        } else 
                            throw new Exception(ExceptionMessages::InvalidAquisitionSourceInputValue." : ".$split_aquisition_sources[0], ExceptionCodes::InvalidAquisitionSourceInputValue); 
             

                        $arrayAquisitionSources = $oAquisitionSources->findByFilter($db, $filter, true);      
                        
                        if ( count( $arrayAquisitionSources ) === 1 ) { 
                           $fAquisitionSource = $arrayAquisitionSources[0]->getAquisitionSourceId();
                           //$values_aq_src[] = $fAquisitionSource;
                        } else if ( count( $arrayAquisitionSources ) > 1 ) { 
                           throw new Exception(ExceptionMessages::DuplicateAquisitionSourceIdValue." : ".$split_aquisition_sources[0], ExceptionCodes::DuplicateAquisitionSourceValue);
                        } else {
                           throw new Exception(ExceptionMessages::InvalidAquisitionSourceValue." : ".$split_aquisition_sources[0], ExceptionCodes::InvalidAquisitionSourceValue);
                        }
                        
                        //aquisition_year=================================================================================================                         
                        if (! Validator::IsYear($split_aquisition_sources[1]) ){
                             throw new Exception(ExceptionMessages::InvalidAquisitionYearValue." : ".$split_aquisition_sources[1], ExceptionCodes::InvalidAquisitionYearValue);    
                        } else if (! Validator::IsValidYear($split_aquisition_sources[1]) ){
                             throw new Exception(ExceptionMessages::InvalidAquisitionYearValidValue." : ".$split_aquisition_sources[1], ExceptionCodes::InvalidAquisitionYearValidValue); 
                        } else {
                            $fAquisitionYear = $split_aquisition_sources[1]? $split_aquisition_sources[1] : NULL;
                        }
                  
                        //aquisition_comments=================================================================================================                         
                            $fAquisitionComment = $split_aquisition_sources[2]? $split_aquisition_sources[2] : NULL; 
                            
                        if ($fAquisitionSource!="") {
                            $values_aq_src[] = array("aquisition_source"=>$fAquisitionSource , "aquisition_year"=>$fAquisitionYear, "aquisition_comments"=>$fAquisitionComment ) ;
                        } 
                        
                    }else {
                      throw new Exception(ExceptionMessages::InsertErrorFormatAquisitionSources.$aquisition_source, ExceptionCodes::InsertErrorFormatAquisitionSources);   
                    }
                }

                sort($values_aq_src);
             
                
                
                $check_values_aq_src = array_unique($values_aq_src, SORT_REGULAR);
                
                
                if (count($check_values_aq_src)!=count($values_aq_src)){
                    $result["duplicate_aquisition_sources"]=$check_values_aq_src;
                    throw new Exception(ExceptionMessages::InsertDuplicateAquisitionSources, ExceptionCodes::InsertDuplicateAquisitionSources);
                } else {    
                    
                   
                    $results_aq_src = array();
                    foreach ($values_aq_src as $val) {
                       //$result["echo"][] = $val["aquisition_source"];
                            //if (!isset($results_aq_src[$val['aquisition_source']]))
                            $results_aq_src[] = $val;
                            //$results_aq_src[$val['aquisition_source']] = $val;
                    }
                    
                    
                    $result["final_aquisition_sources"]=$results_aq_src;
                }   
//            }else{
//                throw new Exception(ExceptionMessages::InsertMoreVariablesAquisitionSources.$count_aquisitions_sources_vbl, ExceptionCodes::InsertMoreVariablesAquisitionSources); 
//            }
              
        }  
        //=====================================================================================================================================================================    
  

        try{
            
        $db->beginTransaction();    
        
        //insert to aquisition_sources table =========================================================
        if (count($results_aq_src) > 0){
                
            foreach ($results_aq_src as $AquisitionSource) {
                
            $oLabAquisitionSources = new LabAquisitionSourcesExt($db);
            $oLabAquisitionSources->setLabId($fLabId);
            $oLabAquisitionSources->setAquisitionSourceId($AquisitionSource["aquisition_source"]);
            $oLabAquisitionSources->setAquisitionYear($AquisitionSource["aquisition_year"]);
            $oLabAquisitionSources->setAquisitionComments($AquisitionSource["aquisition_comments"]);
           
//           $filter= array();
//           $filter  = array(    new DFC(LabAquisitionSourcesExt::FIELD_LAB_ID, $fLabId, DFC::EXACT),
//                                new DFC(LabAquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, $AquisitionSource["aquisition_source"], DFC::EXACT),
//                                new DFC(LabAquisitionSourcesExt::FIELD_AQUISITION_YEAR, $AquisitionSource["aquisition_year"], DFC::EXACT),
//                                new DFC(LabAquisitionSourcesExt::FIELD_AQUISITION_COMMENTS, $AquisitionSource["aquisition_comments"], DFC::EXACT)
//                            ); 
//
//            $arrayEquipmentTypes = $oLabAquisitionSources->findByFilter($db, $filter, true);  
//            $result["aquisitions_exists"]=count($arrayEquipmentTypes)!=0?true:false;
           
            //check for duplicates values (maybe a bug about null values at aquisition_comments)
            //check with is_null because db allow NULL
     
            $filter_duplicate= array();
            $filter_duplicate[] = new DFC(LabAquisitionSourcesExt::FIELD_LAB_ID, $fLabId, DFC::EXACT);
            $filter_duplicate[] = new DFC(LabAquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, $AquisitionSource["aquisition_source"], DFC::EXACT);
            $filter_duplicate[] = new DFC(LabAquisitionSourcesExt::FIELD_AQUISITION_YEAR, $AquisitionSource["aquisition_year"], DFC::EXACT);
            
            if (is_null($AquisitionSource["aquisition_comments"])){
                $filter_duplicate[] = new DFC(LabAquisitionSourcesExt::FIELD_AQUISITION_COMMENTS, $AquisitionSource["aquisition_comments"], DFC::IS_NULL);
            } else {
                $filter_duplicate[] = new DFC(LabAquisitionSourcesExt::FIELD_AQUISITION_COMMENTS, $AquisitionSource["aquisition_comments"], DFC::EXACT);
            } 
            
         
            $arrayLabAquisitionSources = $oLabAquisitionSources->findByFilter($db, $filter_duplicate, true);  
            $result["aquisitions_exists"]=count($arrayLabAquisitionSources)!=0?true:false;
            
            //check with double primary keys (lab_id,equipment_type_id)
            //$result["exists"]=$oLabAquisitionSources->existsInDatabase($db);

                if (count($arrayLabAquisitionSources) != 0 ) { 
                    throw new Exception(ExceptionMessages::DuplicateLabHasAquisitionSourceValue." lab_id : ".$fLabId."  aquisition_source_id : ".$fAquisitionSource , ExceptionCodes::DuplicateLabHasAquisitionSourceValue);
                } else {
                    $oLabAquisitionSources->insertIntoDatabase($db); 
                }
            }

        }  
       
        $db->commit();  
        $result["status"] = 200;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";
        
        
         }
            catch (PDOException $e)
        {
            $db->rollBack();
            $result["status_pdo_internal"] = $e->getCode();
            $result["message_pdo_internal"] = "[".$result["method_pdo_internal"]."]: ".$e->getMessage().", SQL:".$e->getTraceAsString();

        }
            catch (Exception $e) 
        {
            $db->rollBack();
            $result["status_internal"] = $e->getCode();
            $result["message_internal"] = "[".$result["method_internal"]."]: ".$e->getMessage();
        } 
    
        
    } catch (Exception $ex){ 
        $result["status"] = $ex->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$ex->getMessage();
    } 
    return $result;
}

?>