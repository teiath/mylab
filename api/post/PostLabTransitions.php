<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $app
 * @param type $lab_id
 * @param type $to_state
 * @param type $transition_date
 * @param type $transition_justification
 * @param type $transition_source
 * @return string
 * @throws Exception
 */

function PostLabTransitions($lab_id, $state, $transition_date, $transition_justification, $transition_source) {       
    
    global $db;
    global $app;
    
    $result = array();  
    $date_array= array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);

    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    
    $input = array(
    "lab_id" => $lab_id,
    "to_state" => $state,
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
                $fFromState = (int)$arrayLabs[0]->getStateId();
            } else if ( count( $arrayLabs ) > 1 ) { 
                throw new Exception(ExceptionMessages::DuplicateLabsIdValue." : ".$lab_id, ExceptionCodes::DuplicateLabsIdValue);
            } else {
                throw new Exception(ExceptionMessages::InvalidLabIdValue." : ".$lab_id, ExceptionCodes::InvalidLabIdValue);
            }
       
        }
        else
            throw new Exception(ExceptionMessages::UnknownLabIdValue." : ".$lab_id, ExceptionCodes::UnknownLabIdValue);   
 
       //$to_state============================================================          

            if (Validator::isMissing('state'))
                throw new Exception(ExceptionMessages::MissingLabStateParam." : ".$state, ExceptionCodes::MissingLabStateParam);               
            else if (Validator::IsNull($state) )
                throw new Exception(ExceptionMessages::MissingLabStateValue." : ".$state, ExceptionCodes::MissingLabStateValue); 
            else if (Validator::IsID($state)) 
                 $filter[] = new DFC(StatesExt::FIELD_STATE_ID, Validator::ToID($state) , DFC::EXACT) ;
            else if (Validator::IsValue($state)) 
                 $filter[] = new DFC(StatesExt::FIELD_NAME, Validator::ToValue($state), DFC::EXACT);
            else 
                 throw new Exception(ExceptionMessages::UnknownLabStateValue." : ".$state, ExceptionCodes::UnknownLabStateValue); 

            $oStates = new StatesExt($db);
            $arrayState= $oStates->findByFilter($db, $filter, true);

            if ( count( $arrayState ) === 1 ) { 
                $chState = $arrayState[0]->getStateId();
                
                if ($fFromState == 3)
                    throw new Exception(ExceptionMessages::InvalidFromDiscontinuedToStateIdValue, ExceptionCodes::InvalidFromDiscontinuedToStateIdValue);
                else if ($fFromState == $chState )
                    throw new Exception(ExceptionMessages::InvalidSameFromToStateValue, ExceptionCodes::InvalidSameFromToStateValue);
                else {
                    $fToState = $chState;
                    $allowTransition ='true';
                }
                
            } else if ( count( $arrayState ) > 1 ) { 
                throw new Exception(ExceptionMessages::DuplicateStateIdValue." : ".$state, ExceptionCodes::DuplicateStateIdValue);
            } else {
                throw new Exception(ExceptionMessages::InvalidStateValue." : ".$state, ExceptionCodes::InvalidStateValue);
            }   
       
       
        //$transition_date=============================================================           
        if (Validator::IsExists('transition_date') && (Validator::isMissing('transition_justification')))
            throw new Exception(ExceptionMessages::MissingTransitionJustificationParam." : ".$transition_justification, ExceptionCodes::MissingTransitionJustificationParam);    
        else if (Validator::IsExists('transition_date') && (Validator::isMissing('transition_source')))           
            throw new Exception(ExceptionMessages::MissingTransitionSourceParam." : ".$transition_source, ExceptionCodes::MissingTransitionSourceParam);
        else if (Validator::IsExists('transition_date') && (Validator::IsExists('transition_justification')) && Validator::IsExists('transition_source')){
            
            if (! Validator::IsDate($transition_date,'Y-m-d') ){
                throw new Exception(ExceptionMessages::InvalidTransitionDateValue." : ".$transition_date, ExceptionCodes::InvalidTransitionDateValue);    
            } else if (! Validator::IsValidDate($transition_date,'Y-m-d') ){
                throw new Exception(ExceptionMessages::InvalidTransitionDateValidValue." : ".$transition_date, ExceptionCodes::InvalidTransitionDateValidValue); 
            } else {
                $fTransitionDate = Validator::ToDate($transition_date,'Y-m-d');
            }         
        
        } else {
            throw new Exception(ExceptionMessages::MissingTransitionDateParam." : ".$transition_date, ExceptionCodes::MissingTransitionDateParam);      
        }
            
       //$transition_justification=============================================================           
        if (Validator::IsExists('transition_justification') && (Validator::isMissing('transition_date')))
            throw new Exception(ExceptionMessages::MissingTransitionDateParam." : ".$transition_date, ExceptionCodes::MissingTransitionDateParam);      
        else if (Validator::IsExists('transition_justification') && (Validator::isMissing('transition_source')))           
            throw new Exception(ExceptionMessages::MissingTransitionSourceParam." : ".$transition_source, ExceptionCodes::MissingTransitionSourceParam);
        else if (Validator::IsExists('transition_date') && (Validator::IsExists('transition_justification')) && Validator::IsExists('transition_source')){
            
            if (Validator::IsNull($transition_justification) ) {
                //$fTransitionJustification = Validator::ToNull($transition_justification);
                 throw new Exception(ExceptionMessages::MissingTransitionJustificationValue." : ".$transition_justification, ExceptionCodes::MissingTransitionJustificationValue);
            }   else if (Validator::IsValue($transition_justification)) {
                $fTransitionJustification = Validator::ToValue($transition_justification) ;
            }   else 
                throw new Exception(ExceptionMessages::InvalidTransitionJustificationValue." : ".$transition_justification, ExceptionCodes::InvalidTransitionJustificationValue);        
        
        } else {
            throw new Exception(ExceptionMessages::MissingTransitionJustificationParam." : ".$transition_justification, ExceptionCodes::MissingTransitionJustificationParam);    
        }          
            
        //$transition_source=============================================================            
         if (Validator::IsExists('transition_source') && (Validator::isMissing('transition_date')))
            throw new Exception(ExceptionMessages::MissingTransitionDateParam." : ".$transition_date, ExceptionCodes::MissingTransitionDateParam);      
        else if (Validator::IsExists('transition_source') && (Validator::isMissing('transition_justification')))           
            throw new Exception(ExceptionMessages::MissingTransitionJustificationParam." : ".$transition_justification, ExceptionCodes::MissingTransitionJustificationParam);
        else if (Validator::IsExists('transition_date') && (Validator::IsExists('transition_justification')) && Validator::IsExists('transition_source')){ 
                
            if ( Validator::IsTransitionSource($transition_source) ) {
                $fTransitionSource = Validator::ToTransitionSource($transition_source);          
            } else {
                 throw new Exception(ExceptionMessages::InvalidTransitionSourceValue." : ".$transition_source, ExceptionCodes::InvalidTransitionSourceValue);

            }
        } else {
            throw new Exception(ExceptionMessages::MissingTransitionSourceParam." : ".$transition_source, ExceptionCodes::MissingTransitionSourceParam);   
        }       
        
        
    $result["old_instance_State"] = $fFromState; 
        
    try{
    $db->beginTransaction();
        
        if (($fFromState) == 3){ 
            throw new Exception(ExceptionMessages::InvalidFromDiscontinuedToStateIdValue, ExceptionCodes::InvalidFromDiscontinuedToStateIdValue);
        } else if ( $fFromState <> $fToState ) {
                
                $oLabTransitions = new LabTransitionsExt($db);
        
                $oLabTransitions->setLabId( $fLabId);
                $oLabTransitions->setFromState($fFromState);        
                $oLabTransitions->setToState( $fToState);
                $oLabTransitions->setTransitionDate( $fTransitionDate );
                $oLabTransitions->setTransitionJustification( $fTransitionJustification );
                $oLabTransitions->setTransitionSource( $fTransitionSource );

                $filter= array();
                $filter  = array(   new DFC(LabTransitionsExt::FIELD_LAB_ID, $fLabId, DFC::EXACT),
                                    new DFC(LabTransitionsExt::FIELD_FROM_STATE, $fFromState, DFC::EXACT),
                                    new DFC(LabTransitionsExt::FIELD_TO_STATE, $fToState, DFC::EXACT),
                                    new DFC(LabTransitionsExt::FIELD_TRANSITION_DATE, $fTransitionDate, DFC::EXACT)
                        );   
                
                $arrayLabTransitions = $oLabTransitions->findByFilter($db, $filter, true);  
                $result["transitions_exists"]=count($arrayLabTransitions)!=0?true:false;

                if (count($arrayLabTransitions) != 0 ) { 
                    throw new Exception(ExceptionMessages::DuplicateLabTransitionsValue." lab_id : ".$fLabId."  from_state : ".$fFromState."  to_state : ".$fToState , ExceptionCodes::DuplicateLabTransitionsValue);
                } else {
                    
                    //find all date transitions of lab                          
                    $activeLabTransitions = new LabTransitionsExt($db);
                    $activeLabTransition = $activeLabTransitions->findByFilter($db, new DFC(LabTransitionsExt::FIELD_LAB_ID, $fLabId, DFC::EXACT), true, $sort );

                    foreach($activeLabTransition as $LabTransition) {
                        $date_array[]=$LabTransition->getTransitionDate();
                    }
                       
                        
                     //find max date of lab_transition     
                    $max_date = max($date_array);   
                    $result['max_date'] = $max_date;
                    $previous_date = strtotime($max_date);                       
                    $new_date = strtotime($fTransitionDate);
                        
                    //validate that new date is greater than previous date
                    if (Validator::isGreaterThan($new_date, $previous_date, true)) {  

                         //find state of lab and lab_transition_id by max date
                        $checkFilter = array();
                        $checkFilter = array(  new DFC(LabTransitionsExt::FIELD_LAB_ID, $fLabId, DFC::EXACT),
                                               new DFC(LabTransitionsExt::FIELD_TRANSITION_DATE, $max_date, DFC::EXACT)
                                                ); 

                        $checkLabTransitions = new LabTransitionsExt($db);
                        $checkLabTransition = $checkLabTransitions->findByFilter($db, $checkFilter, true);

                        foreach ($checkLabTransition as $chLabTransition) {
                            $state_lab_transition = $chLabTransition->getToState();
                        }

                        //check if current state of lab at Lab table is same as ToState value of last lab transition state
                        //at LabTransitions table and update else throw exception
                        if ($fFromState == $state_lab_transition){
                            $oLabTransitions->insertIntoDatabase($db); 
                        } else {
                           throw new Exception(ExceptionMessages::ConflictLabTransitionWithLabsValue , ExceptionCodes::ConflictLabTransitionWithLabsValue); 
                        }

                        //update lab value
                        $oLabs = new LabsExt($db);
                        $updateLabs = $oLabs->findByFilter($db, new DFC(LabsExt::FIELD_LAB_ID, $fLabId, DFC::EXACT), true);

                        if (Validator::IsEmptyArray($updateLabs))
                            throw new Exception(ExceptionMessages::UpdateLabIdValue , ExceptionCodes::UpdateLabIdValue);
                        else{
                            foreach($updateLabs as $updateLab) {
                                $updateLab->setStateId($fToState);
                                $updateLab->updateToDatabase($db);
                            }   
                        }  

                    } else {
                     throw new Exception(ExceptionMessages::NotAllowedLabTransitionService, ExceptionCodes::NotAllowedLabTransitionService);  
                    }
                }
                       
        } else {
            throw new Exception(ExceptionMessages::InvalidSameFromToStateValue, ExceptionCodes::InvalidSameFromToStateValue);
        }                    

                                    
// set comments about transitions into comments of lab by pdo bind values
//                                      
//                                    $last_updated = date('Y-m-d H:i:s');
//                                    $updated_by = 'myLab BetaUser';
//                                    $comment = LabComments::StartComment.LabComments::UpdatedDate.$last_updated.LabComments::UpdatedBy.$updated_by.LabComments::PostLabTransitionComment.$fLabId.LabComments::From.$fFromState.LabComments::To.$fToState.LabComments::EndComment;
//                                    
//                                    	$sql = "UPDATE labs SET last_updated=?, updated_by=?, state_id=?, comments=CONCAT(comments,?) WHERE lab_id=?";
//                                        $stmt = $db->prepare($sql);
//                                        $stmt->bindValue(1, $last_updated);
//                                        $stmt->bindValue(2, $updated_by);
//                                        $stmt->bindValue(3, $fToState);
//                                        $stmt->bindValue(4, $comment);
//                                        $stmt->bindValue(5, $fLabId);
//                               
//                                        $affected=$stmt->execute();
//                                        if (false===$affected) {
//                                                $stmt->closeCursor();
//                                                throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
//                                        } else {
//                                            $oLabTransitions->insertIntoDatabase($db); 
//                                            $db->commit();  
//                                        }
                             
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
            $result["status"] = $e->getCode();
            $result["message"] = "[".$result["method"]."]: ".$e->getMessage();
         } 
    
        
    } catch (Exception $ex){ 
        $result["status"] = $ex->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$ex->getMessage();
    } 
    return $result;
}

?>