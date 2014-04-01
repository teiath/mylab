<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $app
 * @param type $lab_id
 * @param type $special_name
 * @param type $positioning
 * @param type $comments
 * @param type $lab_type
 * @param type $state
 * @param type $lab_source
 * @return string
 * @throws Exception
 */

function PutLabs($lab_id, $special_name, $positioning, $comments, $operational_rating, $technological_rating, $state, $lab_source
                 ,$transition_date, $transition_justification, $transition_source
                ){
  
    global $db;
    global $app;

    $result = array();  
    $result["data"] = array();
    $filter_duplicate = array();
    $allowTransition = 'false';
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);

    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    //$result["parameters"] = $app->request->getBody();
    
     $input = array(
    "lab_id" => $lab_id,
    "special_name" => $special_name,
    "positioning" => $positioning,
    "comments" => $comments,
    "operational_rating" => $operational_rating,
    "technological_rating" => $technological_rating,
    "state" => $state,
    "lab_source" => $lab_source,
    "transition_date" => $transition_date,
    "transition_justification" => $transition_justification,
    "transition_source" => $transition_source
    );
    
    $result["input"]=$input;
       
    try {
        
        
        //$lab_id===========================================================================  
        
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

        //$updated infos================================================================
        $fLastUpdated = date('Y-m-d H:i:s');
        $fUpdatedBy = 'myLab BetaUser'; //edw na mpei to connection me ton ldap wste na exoume to onoma
        
        //$name===========================================================================  
        $fLabName = $arrayLabs[0]->getName();
        
        if (Validator::IsNull($fLabName) || !Validator::IsValue($fLabName) ){
            throw new Exception(ExceptionMessages::MissingNameValue." : ".$fLabName, ExceptionCodes::MissingNameValue);
        } else {
            $result["db_lab_name"]= $fLabName ;
        }
  
        //$school_unit_id===========================================================================  
        $fSchoolUnit = $arrayLabs[0]->getSchoolUnitId();
        
        if (Validator::IsNull($fSchoolUnit) || !Validator::IsValue($fSchoolUnit) ){
            throw new Exception(ExceptionMessages::MissingSchoolUnitIdValue." : ".$fSchoolUnit, ExceptionCodes::MissingSchoolUnitIdValue);
        } else {
            $result["db_school_unit"]= $fSchoolUnit ;
        } 
        
        //$special_name===========================================================================         
        if (Validator::IsExists('special_name')){
            
            if (Validator::IsNull($special_name) ) {
                $fSpecialName = Validator::ToNull($special_name);
            } else if (Validator::IsValue($special_name)) {
                $fSpecialName = Validator::ToValue($special_name) ;
            } else 
                throw new Exception(ExceptionMessages::InvalidSpecialNameValue." : ".$special_name, ExceptionCodes::InvalidSpecialNameValue); 
        } else {
            $result["db_special_name"]= $fSpecialName =$arrayLabs[0]->getSpecialName();
        } 
   
        //$positioning===========================================================================         
        if (Validator::IsExists('positioning')){
            
            if (Validator::IsNull($positioning) ) {
                $fPositioning = Validator::ToNull($positioning);
            } else if (Validator::IsValue($positioning)) {
                $fPositioning = Validator::ToValue($positioning) ;
            } else 
                throw new Exception(ExceptionMessages::InvalidPositioningValue." : ".$positioning, ExceptionCodes::InvalidPositioningValue); 
        } else {
            $result["db_positioning"]= $fPositioning = $arrayLabs[0]->getPositioning();
        }  
            
        //$comments===========================================================================         
        if (Validator::IsExists('comments')){
            
            if (Validator::IsNull($comments) ) {
                $fComments = Validator::ToNull($comments);  
            } else if (Validator::IsValue($comments)) {
                $fComments = Validator::ToValue($comments) ;
            } else 
                throw new Exception(ExceptionMessages::InvalidCommentsValue." : ".$comments, ExceptionCodes::InvalidCommentsValue); 
        } else {
            $result["db_comments"]= $fComments = $arrayLabs[0]->getComments();
        } 
        
        //$operational_rating=============================================================
        if (Validator::IsExists('operational_rating')){
            
        if (Validator::IsNull($operational_rating) )
            throw new Exception(ExceptionMessages::MissingOperationalRatingValue." : ".$operational_rating, ExceptionCodes::MissingOperationalRatingValue);
        else if (!Validator::IsNumeric($operational_rating) || Validator::IsNegative($operational_rating))
	    throw new Exception(ExceptionMessages::InvalidOperationalRatingValue." : ".$operational_rating, ExceptionCodes::InvalidOperationalRatingValue);    
        else if (Validator::IsFiveStarSystem($operational_rating)) 
             $fOperationalRating = Validator::ToFiveStarSystem($operational_rating);                
        else
            throw new Exception(ExceptionMessages::UnknownOperationalRatingValue." : ".$operational_rating, ExceptionCodes::UnknownOperationalRatingValue);   
       
        } else {
            $result["db_operational_rating"]= $fOperationalRating = $arrayLabs[0]->getOperationalRating();
        }
              
       //$technological_rating=============================================================
        if (Validator::IsExists('technological_rating')){
            
            if (Validator::IsNull($technological_rating) )
                throw new Exception(ExceptionMessages::MissingTechnologicalRatingValue." : ".$technological_rating, ExceptionCodes::MissingTechnologicalRatingValue);
            else if (!Validator::IsNumeric($technological_rating) || Validator::IsNegative($technological_rating))
                throw new Exception(ExceptionMessages::InvalidTechnologicalRatingValue." : ".$technological_rating, ExceptionCodes::InvalidTechnologicalRatingValue);    
            else if (Validator::IsFiveStarSystem($technological_rating)) 
                 $fTechnologicalRating = Validator::ToFiveStarSystem($technological_rating);                
            else
                throw new Exception(ExceptionMessages::UnknownTechnologicalRatingValue." : ".$technological_rating, ExceptionCodes::UnknownTechnologicalRatingValue);   
       
        } else {
            $result["db_technological_rating"]= $fTechnologicalRating = $arrayLabs[0]->getTechnologicalRating();
        }        
     
        //$lab_type=========================================================================== 
        $fLabType = $arrayLabs[0]->getLabTypeId();
        
        if (Validator::IsNull($fLabType) || !Validator::IsValue($fLabType) ){
            throw new Exception(ExceptionMessages::MissingLabTypeValue." : ".$fLabType, ExceptionCodes::MissingLabTypeValue);
        } else {
            $result["db_lab_type"]= $fLabType ;
        }
        
//        if (Validator::IsExists('lab_type')){
//
//            if (Validator::isMissing('lab_type') )
//                throw new Exception(ExceptionMessages::MissingLabTypeParam." : ".$lab_type, ExceptionCodes::MissingLabTypeParam); 
//            else if (Validator::IsNull($lab_type) )
//                throw new Exception(ExceptionMessages::MissingLabTypeValue." : ".$lab_type, ExceptionCodes::MissingLabTypeValue); 
//            else if (Validator::IsID($lab_type)) {
//                 $filter[] = new DFC(LabTypesExt::FIELD_LAB_TYPE_ID, Validator::ToID($lab_type), DFC::EXACT) ;
//            } else if (Validator::IsValue($lab_type)) {
//                 $filter[] = new DFC(LabTypesExt::FIELD_NAME, Validator::ToValue($lab_type), DFC::EXACT);
//            } else 
//                 throw new Exception(ExceptionMessages::UnknownLabTypeValue." : ".$lab_type, ExceptionCodes::UnknownLabTypeValue); 
//
//            $oLabTypes = new LabTypesExt($db);
//            $arrayLabTypes = $oLabTypes->findByFilter($db, $filter, true);
//
//            if ( count( $arrayLabTypes ) === 1 ) { 
//                $fLabType = $arrayLabTypes[0]->getLabTypeId();
//                //$filters[] = "lab_type_id = '". mysql_escape_string( $fLabType ) ."'";
//            } else if ( count( $arrayLabTypes ) > 1 ) { 
//                throw new Exception(ExceptionMessages::DuplicateLabTypeIdValue." : ".$lab_type, ExceptionCodes::DuplicateLabTypeIdValue);
//            } else {
//                throw new Exception(ExceptionMessages::InvalidLabTypeValue." : ".$lab_type, ExceptionCodes::InvalidLabTypeValue);
//            }   
//       
//        } else if (Validator::IsNull($arrayLabs[0]->getLabTypeId())){
//            throw new Exception(ExceptionMessages::MissingLabTypeParam." : ".$lab_type, ExceptionCodes::MissingLabTypeParam);    
//        } else {
//            $result["from_db_lab_type"]= $arrayLabs[0]->getLabTypeId();
//        }  

        //$lab_source===========================================================================     
        if (Validator::IsExists('lab_source')){
            
            if (Validator::isMissing('lab_source'))
                throw new Exception(ExceptionMessages::MissingLabSourceParam." : ".$lab_source, ExceptionCodes::MissingLabSourceParam);               
            else if (Validator::IsNull($lab_source))
                throw new Exception(ExceptionMessages::MissingLabSourceValue." : ".$lab_source, ExceptionCodes::MissingLabSourceValue); 
            else if (Validator::IsID($lab_source)) {
                 $filter[] = new DFC(LabSourcesExt::FIELD_LAB_SOURCE_ID, Validator::ToID($lab_source) , DFC::EXACT) ;
            } else if (Validator::IsValue($lab_source)) {
                 $filter[] = new DFC(LabSourcesExt::FIELD_NAME, Validator::ToValue($lab_source), DFC::EXACT);
            } else 
                 throw new Exception(ExceptionMessages::UnknownLabSourceValue." : ".$lab_source, ExceptionCodes::UnknownLabSourceValue); 

            $oLabSources = new LabSourcesExt($db);
            $arrayLabSource= $oLabSources->findByFilter($db, $filter, true);

            if ( count( $arrayLabSource ) === 1 ) { 
                $fLabSource = $arrayLabSource[0]->getLabSourceId();
            } else if ( count( $arrayLabSource ) > 1 ) { 
                throw new Exception(ExceptionMessages::DuplicateLabSourceIdValue." : ".$lab_source, ExceptionCodes::DuplicateLabSourceIdValue);
            } else {
                throw new Exception(ExceptionMessages::InvalidLabSourceValue." : ".$lab_source, ExceptionCodes::InvalidLabSourceValue);
            }  
       
        } else if (Validator::IsNull($arrayLabs[0]->getLabSourceId())){
            throw new Exception(ExceptionMessages::MissingLabSourceParam." : ".$lab_source, ExceptionCodes::MissingLabSourceParam);    
        } else {
            $result["db_lab_source"]= $fLabSource = $arrayLabs[0]->getLabSourceId();
        }    

        //$state============================================================  
        if (Validator::IsExists('state')){

            if (Validator::isMissing('state'))
                throw new Exception(ExceptionMessages::MissingLabStateParam." : ".$state, ExceptionCodes::MissingLabStateParam);               
            else if (Validator::IsNull($state) )
                throw new Exception(ExceptionMessages::MissingLabStateValue." : ".$state, ExceptionCodes::MissingLabStateValue); 
            else if (Validator::IsID($state)) {
                 $filter[] = new DFC(StatesExt::FIELD_STATE_ID, Validator::ToID($state) , DFC::EXACT) ;
            } else if (Validator::IsValue($state)) {
                 $filter[] = new DFC(StatesExt::FIELD_NAME, Validator::ToValue($state), DFC::EXACT);
            } else 
                 throw new Exception(ExceptionMessages::UnknownLabStateValue." : ".$state, ExceptionCodes::UnknownLabStateValue); 

            $oStates = new StatesExt($db);
            $arrayState= $oStates->findByFilter($db, $filter, true);

            if ( count( $arrayState ) === 1 ) { 
                $chState = $arrayState[0]->getStateId();
                
                $fFromState = (int)$arrayLabs[0]->getStateId();
                if ($fFromState == 3)
                    throw new Exception(ExceptionMessages::InvalidFromDiscontinuedToStateIdValue, ExceptionCodes::InvalidFromDiscontinuedToStateIdValue);
                else if ($fFromState == $chState )
                    throw new Exception(ExceptionMessages::InvalidSameFromToStateValue, ExceptionCodes::InvalidSameFromToStateValue);
                else {
                    $fState = $chState;
                    $allowTransition ='true';
                }
                
            } else if ( count( $arrayState ) > 1 ) { 
                throw new Exception(ExceptionMessages::DuplicateStateIdValue." : ".$state, ExceptionCodes::DuplicateStateIdValue);
            } else {
                throw new Exception(ExceptionMessages::InvalidStateValue." : ".$state, ExceptionCodes::InvalidStateValue);
            }   
       
        } else if (Validator::IsNull($arrayLabs[0]->getStateId())){
            throw new Exception(ExceptionMessages::MissingLabStateParam." : ".$state, ExceptionCodes::MissingLabStateParam);    
        } else {
            $result["db_lab_state"]= $fState = $arrayLabs[0]->getStateId();
        }  
        
//= lab_transitions table#################################################################################################################  
    if (Validator::IsTrue($allowTransition)) {
        
           
       //$transition_date=============================================================           
        if (Validator::IsExists('transition_date') && (Validator::isMissing('transition_justification')))
            throw new Exception(ExceptionMessages::MissingTransitionJustificationValue." : ".$transition_justification, ExceptionCodes::MissingTransitionJustificationValue);    
        else if (Validator::IsExists('transition_date') && (Validator::isMissing('transition_source')))           
            throw new Exception(ExceptionMessages::MissingTransitionSourceValue." : ".$transition_source, ExceptionCodes::MissingTransitionSourceValue);
        else if (Validator::IsExists('transition_date') && (Validator::IsExists('transition_justification')) && Validator::IsExists('transition_source')){
            
            if (! Validator::IsDate($transition_date,'Y-m-d') ){
                throw new Exception(ExceptionMessages::InvalidTransitionDateValue." : ".$transition_date, ExceptionCodes::InvalidTransitionDateValue);    
            } else if (! Validator::IsValidDate($transition_date,'Y-m-d') ){
                throw new Exception(ExceptionMessages::InvalidTransitionDateValidValue." : ".$transition_date, ExceptionCodes::InvalidTransitionDateValidValue); 
            } else {
                $fTransitionDate = Validator::ToDate($transition_date,'Y-m-d');
                //$filters_lab_transitions[] = "transition_date = '". $fTransitionDate ."'";
            }         
        
        } else {
            throw new Exception(ExceptionMessages::MissingTransitionDateValue." : ".$transition_date, ExceptionCodes::MissingTransitionDateValue);      
        }
            
       //$transition_justification=============================================================           
        if (Validator::IsExists('transition_justification') && (Validator::isMissing('transition_date')))
            throw new Exception(ExceptionMessages::MissingTransitionDateValue." : ".$transition_date, ExceptionCodes::MissingTransitionDateValue);      
        else if (Validator::IsExists('transition_justification') && (Validator::isMissing('transition_source')))           
            throw new Exception(ExceptionMessages::MissingTransitionSourceValue." : ".$transition_source, ExceptionCodes::MissingTransitionSourceValue);
        else if (Validator::IsExists('transition_date') && (Validator::IsExists('transition_justification')) && Validator::IsExists('transition_source')){
            
            if (Validator::IsNull($transition_justification) ) {
                $fTransitionJustification = Validator::ToNull($transition_justification);
                //$filters_lab_transitions[] = "transition_justification = '". mysql_escape_string( $fTransitionJustification ) ."'";
            }   else if (Validator::IsValue($transition_justification)) {
                $fTransitionJustification = Validator::ToValue($transition_justification) ;
                //$filters_lab_transitions[] = "transition_justification = '". mysql_escape_string( $fTransitionJustification ) ."'";
            }   else 
                throw new Exception(ExceptionMessages::InvalidTransitionJustificationValue." : ".$transition_justification, ExceptionCodes::InvalidTransitionJustificationValue);        
        
        } else {
            throw new Exception(ExceptionMessages::MissingTransitionJustificationValue." : ".$transition_justification, ExceptionCodes::MissingTransitionJustificationValue);    
        }          
            
        //$transition_source=============================================================            
         if (Validator::IsExists('transition_source') && (Validator::isMissing('transition_date')))
            throw new Exception(ExceptionMessages::MissingTransitionDateValue." : ".$transition_date, ExceptionCodes::MissingTransitionDateValue);      
        else if (Validator::IsExists('transition_source') && (Validator::isMissing('transition_justification')))           
            throw new Exception(ExceptionMessages::MissingTransitionJustificationValue." : ".$transition_justification, ExceptionCodes::MissingTransitionJustificationValue);
        else if (Validator::IsExists('transition_date') && (Validator::IsExists('transition_justification')) && Validator::IsExists('transition_source')){ 
                
            if ( Validator::IsTransitionSource($transition_source) ) {
                $fTransitionSource = Validator::ToTransitionSource($transition_source);
                //$filters_lab_transitions[] = "transition_source = '". mysql_escape_string( $fTransitionSource ) ."'";              
            } else {
                 throw new Exception(ExceptionMessages::InvalidTransitionSourceValue." : ".$transition_source, ExceptionCodes::InvalidTransitionSourceValue);

            }
        } else {
            throw new Exception(ExceptionMessages::MissingTransitionSourceValue." : ".$transition_source, ExceptionCodes::MissingTransitionSourceValue);   
        }
        
    } else if ((Validator::IsExists('transition_date') || Validator::IsExists('transition_justification') || Validator::IsExists('transition_source')) && !Validator::IsExists('state')) {
        throw new Exception(ExceptionMessages::ErrorInputLabTransitionsValues, ExceptionCodes::ErrorInputLabTransitionsValues);  
    }
        
        
        
        
        //=====================================================================================================================================================================    

        try{
            
        $db->beginTransaction();

            $dpcLabs = new LabsExt($db); 
            
            
            //check duplicate for lab
            $filter_duplicate[] = new DFC(LabsExt::FIELD_NAME, $fLabName, DFC::EXACT);
            $filter_duplicate[] = new DFC(LabsExt::FIELD_SCHOOL_UNIT_ID, $fSchoolUnit, DFC::EXACT); 
            $filter_duplicate[] = new DFC(LabsExt::FIELD_LAB_TYPE_ID, $fLabType, DFC::EXACT); 
            $filter_duplicate[] = new DFC(LabsExt::FIELD_STATE_ID, $fState, DFC::EXACT); 
            $filter_duplicate[] = new DFC(LabsExt::FIELD_LAB_SOURCE_ID, $fLabSource, DFC::EXACT); 
            
            if (is_null($fSpecialName)){
                $filter_duplicate[] = new DFC(LabsExt::FIELD_SPECIAL_NAME, $fSpecialName, DFC::IS_NULL);
            } else {
                $filter_duplicate[] = new DFC(LabsExt::FIELD_SPECIAL_NAME, $fSpecialName, DFC::EXACT);
            }
            
            if (is_null($fPositioning)){
                $filter_duplicate[] = new DFC(LabsExt::FIELD_POSITIONING, $fPositioning, DFC::IS_NULL);
            } else {
                $filter_duplicate[] = new DFC(LabsExt::FIELD_POSITIONING, $fPositioning, DFC::EXACT);
            }
            
            if (is_null($fComments)){
                $filter_duplicate[] = new DFC(LabsExt::FIELD_COMMENTS, $fComments, DFC::IS_NULL);
            } else {
                $filter_duplicate[] = new DFC(LabsExt::FIELD_COMMENTS, $fComments, DFC::EXACT);
            }
            
            if (is_null($fOperationalRating)){
                $filter_duplicate[] = new DFC(LabsExt::FIELD_OPERATIONAL_RATING, $fOperationalRating, DFC::IS_NULL);
            } else {
                $filter_duplicate[] = new DFC(LabsExt::FIELD_OPERATIONAL_RATING, $fOperationalRating, DFC::EXACT);
            }
            
            if (is_null($fTechnologicalRating)){
                $filter_duplicate[] = new DFC(LabsExt::FIELD_TECHNOLOGICAL_RATING, $fTechnologicalRating, DFC::IS_NULL);
            } else {
                $filter_duplicate[] = new DFC(LabsExt::FIELD_TECHNOLOGICAL_RATING, $fTechnologicalRating, DFC::EXACT);
            }
            
            
            $duplicateLabs = $dpcLabs->findByFilter($db, $filter_duplicate, true); 
            $exist=count($duplicateLabs);
            $result["labs_duplicate"]=$exist;     

             if (!Validator::IsEmptyArray($duplicateLabs) && !Validator::IsArray($duplicateLabs)){
                    throw new Exception(ExceptionMessages::DuplicateLabsValue." found duplicates = ". $exist." lab_id: " . $fLabId . " special_name: " . $fSpecialName . " positioning: " . $fPositioning. " comments: " . $fComments . " operational_rating: " . $fOperationalRating ." technological_rating: " . $fTechnologicalRating ." state: " . $fState. " lab_source: " . $fLabSource , ExceptionCodes::DuplicateLabsValue);
            } else {
                
                foreach($arrayLabs as $uLabs)
                {                       
                    Validator::IsExists('lab_id')? $uLabs->setLabId($fLabId):null;
                    Validator::IsExists('special_name')? $uLabs->setSpecialName($fSpecialName):null;
                    Validator::IsExists('positioning')? $uLabs->setPositioning($fPositioning):null;
                    Validator::IsExists('comments')? $uLabs->setComments($fComments):null;
                    Validator::IsExists('operational_rating')? $uLabs->setOperationalRating($fOperationalRating):null;
                    Validator::IsExists('technological_rating')? $uLabs->setTechnologicalRating($fTechnologicalRating):null;
                    Validator::IsExists('state')?$uLabs->setStateId($fState):null;
                    Validator::IsExists('lab_source')?$uLabs->setLabSourceId($fLabSource):null;
                    
                    $uLabs->setLastUpdated($fLastUpdated);
                    $uLabs->setUpdatedBy($fUpdatedBy);
                    $uLabs->updateToDatabase($db);
                } 
                
                    //= update to lab_transitions table =========================================================                 
                    if (Validator::IsTrue($allowTransition))
                    {

                        $oLabTransitions = new LabTransitionsExt($db);

                        $oLabTransitions->setLabId($fLabId);
                        $oLabTransitions->setFromState($fFromState);        
                        $oLabTransitions->setToState($fState);
                        $oLabTransitions->setTransitionDate( $fTransitionDate );
                        $oLabTransitions->setTransitionJustification( $fTransitionJustification );
                        $oLabTransitions->setTransitionSource( $fTransitionSource );

                        $filter= array();
                        $filter  = array(   new DFC(LabTransitionsExt::FIELD_LAB_ID, $fLabId, DFC::EXACT),
                                            new DFC(LabTransitionsExt::FIELD_FROM_STATE, $fFromState, DFC::EXACT),
                                            new DFC(LabTransitionsExt::FIELD_TO_STATE, $fState, DFC::EXACT),
                                            new DFC(LabTransitionsExt::FIELD_TRANSITION_DATE, $fTransitionDate, DFC::EXACT)
                                );   
                        $arrayLabTransitions = $oLabTransitions->findByFilter($db, $filter, true);  
                        $result["transitions_exists"]=count($arrayLabTransitions)!=0?true:false;
                        
                        if (count($arrayLabTransitions) != 0 ) { 
                            throw new Exception(ExceptionMessages::DuplicateLabTransitionsValue." lab_id : ".$fLabId."  from_state : ".$fFromState."  to_state : ".$fState , ExceptionCodes::DuplicateLabTransitionsValue);
                        } else {
                            $oLabTransitions->insertIntoDatabase($db); 
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
            $result["message_pdo_internal"] = "[".$result["method"]."]: ".$e->getMessage().", SQL:".$e->getTraceAsString();

         }
            catch (Exception $e) 
         {
            $db->rollBack();
            $result["status_internal"] = $e->getCode();
            $result["message_internal"] = "[".$result["method"]."]: ".$e->getMessage();
         } 
    
        
    } catch (Exception $ex){ 
        $result["status_external"] = $ex->getCode();
        $result["message_external"] = "[".$result["method"]."][".$result["function"]."]:".$ex->getMessage();
    } 
    return $result;
}

?>