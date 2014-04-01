<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $app
 * @param type $lab_relation_id
 * @return string
 * @throws Exception
 */


function DelLabTransitions($lab_transition_id) {
    global $db;
    global $app;
    
    $result = array();  
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    
    $input = array(
    "lab_transition_id" => $lab_transition_id
    );
    
    $result["input"]=$input;
    
    try {
             
        //$lab_transition_id==============================================================      
        if (Validator::isMissing('lab_transition_id'))
            throw new Exception(ExceptionMessages::MissingLabTransitionIdParam." : ".$lab_transition_id, ExceptionCodes::MissingLabRelationIdParam);
        else if (Validator::IsNull($lab_transition_id) )
            throw new Exception(ExceptionMessages::MissingLabTransitionIdParam." : ".$lab_transition_id, ExceptionCodes::MissingLabTransitionIdParam);
        else if (!Validator::IsNumeric($lab_transition_id) || Validator::IsNegative($lab_transition_id))
	    throw new Exception(ExceptionMessages::InvalidLabTransitionIdValue." : ".$lab_transition_id, ExceptionCodes::InvalidLabTransitionIdValue);    
        else if (Validator::IsID($lab_transition_id)) {
            $filter[] = new DFC(LabTransitionsExt::FIELD_LAB_TRANSITION_ID, Validator::ToID($lab_transition_id), DFC::EXACT);     
            
            $oLabTransitions = new LabTransitionsExt($db);
            $arrayLabTransitions = $oLabTransitions->findByFilter($db, $filter, true);
            
            if ( count($arrayLabTransitions) === 1 ) { 
                $fLabTransitionId = $arrayLabTransitions[0]->getLabTransitionId();
                $fLabId = $arrayLabTransitions[0]->getLabId();
            } else if ( count( $arrayLabTransitions ) > 1 ) { 
                throw new Exception(ExceptionMessages::DuplicateLabTransitionIdValue." : ".$lab_transition_id, ExceptionCodes::DuplicateLabRelationIdValue);
            } else {
                throw new Exception(ExceptionMessages::NotFoundLabTransitionIDValue." : ".$lab_transition_id, ExceptionCodes::NotFoundLabTransitionIDValue);
            }
       
        }
        else
            throw new Exception(ExceptionMessages::UnknownLabTransitionIdValue." : ".$lab_transition_id, ExceptionCodes::UnknownLabTransitionIdValue);               
        
        try{      
        
            $db->beginTransaction();  
                                      
                //find all date transitions of lab 
                $sort = new DSC(LabTransitionsExt::FIELD_LAB_ID,DSC::ASC);
                $oLabTransitions = new LabTransitionsExt($db);
                $oLabTransition = $oLabTransitions->findByFilter($db, new DFC(LabTransitionsExt::FIELD_LAB_ID, $fLabId, DFC::EXACT), true, $sort );

                foreach($oLabTransition as $LabTransition) {
                    $date_array[]=$LabTransition->getTransitionDate();
                }
                
                //find max date of lab_transition 
                $max_date = max($date_array);   
                $result['max_date'] = $max_date;

                //find state of lab and lab_transition_id by max date
               $fFilter = array();
               $fFilter = array(  new DFC(LabTransitionsExt::FIELD_LAB_ID, $fLabId, DFC::EXACT),
                                      new DFC(LabTransitionsExt::FIELD_TRANSITION_DATE, $max_date, DFC::EXACT)
                                    ); 

               $checkLabTransitions = new LabTransitionsExt($db);
               $checkLabTransition = $checkLabTransitions->findByFilter($db, $fFilter, true);

               foreach ($checkLabTransition as $chLabTransition)
                   {
                   $state_lab_transition = $chLabTransition->getToState();
                   $lab_transition_id = $chLabTransition->getLabTransitionId();
                   }

                //check current state of lab 
                $oLab = LabsExt::findById($db, $fLabId);
                $lab_state = $oLab->getStateId();
                

             //check if user try to delete max transition state of lab and throw exception else delete            
            if ($fLabTransitionId == $lab_transition_id){
                 $result["current_lab_status"] = $lab_state;
                 $result["max_lab_trasition_state"] = $state_lab_transition;
                 $result["max_lab_transition_id"] = $lab_transition_id;
                 $result["for_delete_lab_transition_id"] = $fLabTransitionId;
                 throw new Exception(ExceptionMessages::ReferencesLabTransitionsValue." : ".$lab_transition_id, ExceptionCodes::ReferencesLabTransitionsValue); 
            } else{ 

                 $result["current_lab_status"] = $lab_state;
                 $result["max_lab_trasition_state"] = $state_lab_transition;
                 $result["max_lab_transition_id"] = $lab_transition_id;
                 $result["for_delete_lab_transition_id"] = $fLabTransitionId;


            //2nd version of delete from db (check primary keys for existed or not in database)     
            $dLabTransition = new LabTransitionsExt($db);
            $dLabTransition->setLabTransitionId($fLabTransitionId);

                 if (!$dLabTransition->existsInDatabase($db))
                     throw new Exception(ExceptionMessages::DeleteNotFoundLabTransitions ." lab_transition_id: " . $fLabTransitionId, ExceptionCodes::DeleteNotFoundLabTransitions);
                 else{         
                    $dLabTransition->deleteFromDatabase($db);
                    $db->commit();  
                    $result["status"] = 200;
                    $result["message"] = "[".$result["method"]."][".$result["function"]."]:"."success";
                 }
            }                  
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
        $result["status"] = $ex->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$ex->getMessage();
    } 
    return $result;
}

?>