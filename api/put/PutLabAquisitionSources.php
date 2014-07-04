<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $app
 * @param type $lab_aquisition_source_id
 * @param type $lab_id
 * @param type $aquisition_source
 * @param type $aquisition_year
 * @param type $aquisition_comments
 * @return string
 * @throws Exception
 */


function PutLabAquisitionSources($lab_aquisition_source_id, $lab_id, $aquisition_source, $aquisition_year, $aquisition_comments) {
    
    global $db;
    global $app;
    
    $result = array();  
    $result["data"] = array();
    $filter_duplicate = array();

    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod(); 
    
    $input = array(
    "lab_aquisition_source_id" => $lab_aquisition_source_id,
    "lab_id" => $lab_id,
    "aquisition_source" => $aquisition_source,
    "aquisition_year" => $aquisition_year,
    "aquisition_comment" => $aquisition_comments
    );
    
    $result["input"]=$input;
   
    try {
        
        //$lab_aquisition_source_id==============================================================      
        if (Validator::isMissing('lab_aquisition_source_id'))
            throw new Exception(ExceptionMessages::MissingLabAquisitionSourceIdParam." : ".$lab_aquisition_source_id, ExceptionCodes::MissingLabAquisitionSourceIdParam);
        else if (Validator::IsNull($lab_aquisition_source_id) )
            throw new Exception(ExceptionMessages::MissingLabAquisitionSourceIdValue." : ".$lab_aquisition_source_id, ExceptionCodes::MissingLabAquisitionSourceIdValue);
        else if (!Validator::IsNumeric($lab_aquisition_source_id) || Validator::IsNegative($lab_aquisition_source_id))
	    throw new Exception(ExceptionMessages::InvalidLabAquisitionSourceIdValue." : ".$lab_aquisition_source_id, ExceptionCodes::InvalidLabAquisitionSourceIdValue);    
        else if (Validator::IsID($lab_aquisition_source_id)) {
            $filter[] = new DFC(LabAquisitionSourcesExt::FIELD_LAB_AQUISITION_SOURCE_ID, Validator::ToID($lab_aquisition_source_id), DFC::EXACT);     
            
            $oLabAquisitionSources= new LabAquisitionSourcesExt($db);
            $arrayLabAquisitionSources = $oLabAquisitionSources->findByFilter($db, $filter, true);
            
            if ( count($arrayLabAquisitionSources) === 1 ) {           
                $fLabAquisitionSourceId = $arrayLabAquisitionSources[0]->getLabAquisitionSourceId();
            } else if ( count( $arrayLabAquisitionSources ) > 1 ) { 
                throw new Exception(ExceptionMessages::DuplicateLabAquisitionSourceIdValue." : ".$lab_aquisition_source_id, ExceptionCodes::DuplicateLabAquisitionSourceIdValue);
            } else {
                throw new Exception(ExceptionMessages::NotFoundLabAquisitionSourceIdValue." : ".$lab_aquisition_source_id, ExceptionCodes::NotFoundLabAquisitionSourceIdValue);
            }
       
        }
        else
            throw new Exception(ExceptionMessages::UnknownLabAquisitionSourceIdValue." : ".$lab_aquisition_source_id, ExceptionCodes::UnknownLabAquisitionSourceIdValue);               
      

        //$lab_id==============================================================      
        if (Validator::IsExists('lab_id')){
        
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

        } else if (Validator::IsNull($arrayLabAquisitionSources[0]->getLabId())){
            throw new Exception(ExceptionMessages::MissingLabParam." : ".$lab_id, ExceptionCodes::MissingLabParam);
        } else {
            $result["db_lab_id"]= $fLabId = $arrayLabAquisitionSources[0]->getLabId();
        }
        
        //$aquisition_source=======================================================================      
        if (Validator::IsExists('aquisition_source')){
        
            $oAquisitionSources = new AquisitionSourcesExt($db);
            $oAquisitionSources->getAll($db);

             if (Validator::IsMissing('aquisition_source'))
                  throw new Exception(ExceptionMessages::MissingLabAquisitionSourceParam." : ".$aquisition_source, ExceptionCodes::MissingLabAquisitionSourceParam);    
             else if (Validator::IsNull($aquisition_source))
                 throw new Exception(ExceptionMessages::MissingAquisitionSourceValue." : ".$aquisition_source, ExceptionCodes::MissingAquisitionSourceValue); 
             else if (Validator::IsID($aquisition_source)) 
                 $filter = array( new DFC(AquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, Validator::ToID($aquisition_source),DFC::EXACT) );                      
             else if (Validator::IsValue($aquisition_source)) {
                 $oAquisitionSources->searchArrayForValue(Validator::ToValue($aquisition_source));       
             }  else 
                 throw new Exception(ExceptionMessages::InvalidAquisitionSourceInputValue." : ".$aquisition_source, ExceptionCodes::InvalidAquisitionSourceInputValue); 

             $arrayAquisitionSources = $oAquisitionSources->findByFilter($db, $filter, true);  

             //if ( count( $arrayAquisitionSources ) === 1 ) { 
             if ( count( $arrayAquisitionSources ) > 1 ) { 
                $fAquisitionSource = $arrayAquisitionSources[0]->getAquisitionSourceId();
           //  } else if ( count( $arrayAquisitionSources ) > 1 ) { 
           //      throw new Exception(ExceptionMessages::DuplicateAquisitionSourceIdValue." : ".$aquisition_source, ExceptionCodes::DuplicateAquisitionSourceIdValue);
             } else {
                 throw new Exception(ExceptionMessages::InvalidAquisitionSourceValue." : ".$aquisition_source, ExceptionCodes::InvalidAquisitionSourceValue);                            
             }
         
        } else if (Validator::IsNull($arrayLabAquisitionSources[0]->getAquisitionSourceId())){
            throw new Exception(ExceptionMessages::MissingLabAquisitionSourceParam." : ".$aquisition_source, ExceptionCodes::MissingLabAquisitionSourceParam);    
        } else {
            $result["db_aquisition_source"]= $fAquisitionSource = $arrayLabAquisitionSources[0]->getLabAquisitionSourceId();
        }   
                 
        //$aquisition_year================================================================================================= 
        if (Validator::IsExists('aquisition_year')){
        
            if (Validator::IsMissing('aquisition_year')) {
                throw new Exception(ExceptionMessages::MissingAquisitionYearParam." : ".$aquisition_year, ExceptionCodes::MissingItemsParam);              
            } else if (Validator::IsNull($aquisition_year)) {
                throw new Exception(ExceptionMessages::MissingAquisitionYearValue." : ".$aquisition_year, ExceptionCodes::MissingAquisitionYearValue);
            } else if (! Validator::IsYear($aquisition_year)){
                 throw new Exception(ExceptionMessages::InvalidAquisitionYearValue." : ".$aquisition_year, ExceptionCodes::InvalidAquisitionYearValue);    
            } else if (! Validator::IsValidYear($aquisition_year)){
                 throw new Exception(ExceptionMessages::InvalidAquisitionYearValidValue." : ".$aquisition_year, ExceptionCodes::InvalidAquisitionYearValidValue); 
            } else {
                $fAquisitionYear = $aquisition_year;
            }
        
        } else if (Validator::IsNull($arrayLabAquisitionSources[0]->getAquisitionComments())){
            throw new Exception(ExceptionMessages::MissingAquisitionYearParam." : ".$aquisition_year, ExceptionCodes::MissingItemsParam);  
        } else {
            $result["db_aquisition_year"]= $fAquisitionYear = $arrayLabAquisitionSources[0]->getAquisitionYear();
        }
        
        //$aquisition_comments=================================================================================================  
         if (Validator::IsExists('aquisition_comments')){
             if (Validator::IsNull($aquisition_comments)){
                $fAquisitionComments = Validator::ToNull($aquisition_comments);
             } else {
                 $fAquisitionComments = Validator::ToValue($aquisition_comments);
             }  
         } else {
            $result["db_aquisition_comments"]= $fAquisitionComments =$arrayLabAquisitionSources[0]->getAquisitionComments();
         }
      
        //user permisions
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array($fLabId,$permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToPutLab ,ExceptionCodes::NoPermissionToPutLab); 
         };
         
        try{
            
        $db->beginTransaction();    
             
            //check for duplicates values (maybe a bug about null values at aquisition_comments)
            //check with is_null because db allow NULL
            $dpcLabAquisitionSources = new LabAquisitionSourcesExt($db); 
            
            $filter_duplicate[] = new DFC(LabAquisitionSourcesExt::FIELD_LAB_ID, $fLabId, DFC::EXACT);
            $filter_duplicate[] = new DFC(LabAquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, $fAquisitionSource, DFC::EXACT);
            $filter_duplicate[] = new DFC(LabAquisitionSourcesExt::FIELD_AQUISITION_YEAR, $fAquisitionYear, DFC::EXACT);
            
            if (is_null($fAquisitionComments)){
                $filter_duplicate[] = new DFC(LabAquisitionSourcesExt::FIELD_AQUISITION_COMMENTS, $fAquisitionComments, DFC::IS_NULL);
            } else {
                $filter_duplicate[] = new DFC(LabAquisitionSourcesExt::FIELD_AQUISITION_COMMENTS, $fAquisitionComments, DFC::EXACT);
            }  
            
            
            $duplicateLabAquisitionSources = $dpcLabAquisitionSources->findByFilter($db, $filter_duplicate, true); 
            $exist=count($duplicateLabAquisitionSources);
            $result["lab_aquisition_source_duplicate"]=$exist;

                         
                if (!Validator::IsEmptyArray($duplicateLabAquisitionSources) && !Validator::IsArray($duplicateLabAquisitionSources)){
                    throw new Exception(ExceptionMessages::DuplicateLabAquisitionSourceValue ." found duplicates = ". $exist." lab_id: " . $fLabId . " aquisition_source: " . $fAquisitionSource . " aquisition_year: " . $fAquisitionYear. " aquisition_comments: " . $fAquisitionComments  , ExceptionCodes::DuplicateLabAquisitionSourceValue);
                } else {

                    foreach($arrayLabAquisitionSources as $uLabAquisitionSource)
                    {                       
                        Validator::IsExists('lab_aquisition_source_id')? $uLabAquisitionSource->setLabAquisitionSourceId($fLabAquisitionSourceId):null;
                        Validator::IsExists('lab_id')? $uLabAquisitionSource->setLabId($fLabId):null;
                        Validator::IsExists('aquisition_source')? $uLabAquisitionSource->setAquisitionSourceId($fAquisitionSource):null;
                        Validator::IsExists('aquisition_year')? $uLabAquisitionSource->setAquisitionYear($fAquisitionYear):null;
                        Validator::IsExists('aquisition_comments')?$uLabAquisitionSource->setAquisitionComments($fAquisitionComments):null;

                        $uLabAquisitionSource->updateToDatabase($db);
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
        $result["status_external"] = $ex->getCode();
        $result["message_external"] = "[".$result["method"]."][".$result["function"]."]:".$ex->getMessage();
    } 
    return $result;
}
?>