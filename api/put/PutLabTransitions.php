<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $app
 * @param type $lab_transition_id
 * @param type $transition_justification
 * @param type $transition_source
 * @return string
 * @throws Exception
 */

function PutLabTransitions($lab_transition_id, $transition_justification, $transition_source) {
    global $db;
    global $app;
    
    $result = array();  
    $result["data"] = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    $input = array(
    "lab_transition_id" => $lab_transition_id,
    "transition_justification" => $transition_justification,
    "transition_source" => $transition_source
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
            } else if ( count( $arrayLabTransitions ) > 1 ) { 
                throw new Exception(ExceptionMessages::DuplicateLabTransitionIdValue." : ".$lab_transition_id, ExceptionCodes::DuplicateLabRelationIdValue);
            } else {
                throw new Exception(ExceptionMessages::NotFoundLabTransitionIDValue." : ".$lab_transition_id, ExceptionCodes::NotFoundLabTransitionIDValue);
            }
       
        }
        else
            throw new Exception(ExceptionMessages::UnknownLabTransitionIdValue." : ".$lab_transition_id, ExceptionCodes::UnknownLabTransitionIdValue);             
      
       //$transition_justification=============================================================           
        if (Validator::IsExists('transition_justification')) {
           
            if (Validator::isMissing('transition_justification'))           
                throw new Exception(ExceptionMessages::MissingTransitionJustificationParam." : ".$transition_justification, ExceptionCodes::MissingTransitionJustificationParam);
            else if (Validator::IsNull($transition_justification) ) 
                throw new Exception(ExceptionMessages::MissingTransitionJustificationValue." : ".$transition_justification, ExceptionCodes::MissingTransitionJustificationValue);
            else if (Validator::IsValue($transition_justification)) 
                $fTransitionJustification = Validator::ToValue($transition_justification) ;
            else 
                throw new Exception(ExceptionMessages::InvalidTransitionJustificationValue." : ".$transition_justification, ExceptionCodes::InvalidTransitionJustificationValue);        
  
        } else if (Validator::IsNull($arrayLabTransitions[0]->getTransitionJustification())){
            throw new Exception(ExceptionMessages::MissingTransitionJustificationValue." : ".$transition_justification, ExceptionCodes::MissingTransitionJustificationValue);    
        } else {
            $result["db_Transition_Justification"]= $fTransitionJustification= $arrayLabTransitions[0]->getTransitionJustification();
        } 
        
        
        //$transition_source=============================================================   
        if (Validator::IsExists('transition_source')) {
            
         if (Validator::isMissing('transition_source'))
            throw new Exception(ExceptionMessages::MissingTransitionSourceParam." : ".$transition_source, ExceptionCodes::MissingTransitionSourceParam);      
         else if ( Validator::IsTransitionSource($transition_source) )
                $fTransitionSource = Validator::ToTransitionSource($transition_source);          
         else
             throw new Exception(ExceptionMessages::InvalidTransitionSourceValue." : ".$transition_source, ExceptionCodes::InvalidTransitionSourceValue);
      
        } else if (Validator::IsNull($arrayLabTransitions[0]->getTransitionSource())) {
            throw new Exception(ExceptionMessages::MissingTransitionSourceParam." : ".$transition_source, ExceptionCodes::MissingTransitionSourceParam);           
        } else {
            $result["db_Transition_Source"]= $fTransitionSource = $arrayLabTransitions[0]->getTransitionSource();
        } 
        
              
        try{
            
        $db->beginTransaction();    
        
        //insert to lab_workers table =========================================================
        if ($fLabTransitionId || $fTransitionSource){

                
//                $oLabTransitions->setLabTransitionId( $fLabTransitionId );
//                $oLabTransitions->setTransitionJustification( $fTransitionJustification );
//                $oLabTransitions->setTransitionSource( $fTransitionSource );

                $filter = array();
                $filter  = array(   new DFC(LabTransitionsExt::FIELD_LAB_TRANSITION_ID, $fLabTransitionId, DFC::EXACT),
                                    new DFC(LabTransitionsExt::FIELD_TRANSITION_JUSTIFICATION, $fTransitionJustification, DFC::EXACT),
                                    new DFC(LabTransitionsExt::FIELD_TRANSITION_SOURCE, $fTransitionSource, DFC::EXACT)
                        );   
                
                $oLabTransitions = new LabTransitionsExt($db);
                $checkLabTransitions = $oLabTransitions->findByFilter($db, $filter, true);
                $exist=count($checkLabTransitions);
                $result["transitions_exists"]=$exist;
                    
                if (!Validator::IsEmptyArray($checkLabTransitions) && !Validator::IsArray($checkLabTransitions)) { 
                    throw new Exception(ExceptionMessages::DuplicateLabTransitionValue." found  = ". $exist." lab_transition_id : ".$fLabTransitionId." transition_justification : ".$fTransitionJustification." transition_source : ".$fTransitionSource, ExceptionCodes::DuplicateLabTransitionValue);
                } else {

                    foreach($arrayLabTransitions as $updateLabTransition)
                    {

                        if ((!$updateLabTransition->existsInDatabase($db)) || (count($arrayLabTransitions) != 1 ) ){
                            throw new Exception(ExceptionMessages::ErrorUpdateLabTransitionStatus, ExceptionCodes::ErrorUpdateLabTransitionStatus);
                        } else { 
                            $updateLabTransition->setLabTransitionId( $fLabTransitionId );
                            $updateLabTransition->setTransitionJustification( $fTransitionJustification );
                            $updateLabTransition->setTransitionSource( $fTransitionSource );
                            $updateLabTransition->updateToDatabase($db);
                        }


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