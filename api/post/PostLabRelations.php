<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $app
 * @param type $lab_id
 * @param type $school_unit
 * @param type $relation_type
 * @param type $circuit_id
 * @return string
 * @throws Exception
 */

function PostLabRelations($lab_id, $school_unit, $relation_type, $circuit_id) {
                       
    global $db;
    global $app;
    
    $result = array();  
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    
    $result["lab_id"] = $lab_id;
    $result["school_unit"] = $school_unit;
    $result["relation_type"] = $relation_type;
    $result["circuit_id"] = $circuit_id;
      
    try {
     
        //$lab_id============================================================================
        $filter = array();
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
 
       //$school_unit_id============================================================          
        $filter = array();
        if (Validator::isMissing('school_unit'))
            throw new Exception(ExceptionMessages::MissingSchoolUnitParam." : ".$school_unit, ExceptionCodes::MissingSchoolUnitParam);
        else if (Validator::IsNull($school_unit) )
            throw new Exception(ExceptionMessages::MissingSchoolUnitIdValue." : ".$school_unit, ExceptionCodes::MissingSchoolUnitIdValue);
//        else if (!Validator::IsNumeric($school_unit) || Validator::IsNegative($school_unit))
//	    throw new Exception(ExceptionMessages::InvalidSchoolUnitIdValue." : ".$school_unit, ExceptionCodes::InvalidSchoolUnitIdValue);    
        else if (Validator::IsID($school_unit)) 
            $filter[] = new DFC(SchoolUnitsExt::FIELD_SCHOOL_UNIT_ID, Validator::ToID($school_unit), DFC::EXACT);     
        else  if (Validator::IsValue($school_unit)) 
            $filter[] = new DFC(SchoolUnitsExt::FIELD_NAME, Validator::ToValue($school_unit), DFC::EXACT); 
        else
            throw new Exception(ExceptionMessages::UnknownSchoolUnitValue." : ".$school_unit, ExceptionCodes::UnknownSchoolUnitValue); 
            
        $oSchoolUnits = new SchoolUnitsExt($db);
        $arraySchoolUnit = $oSchoolUnits->findByFilter($db, $filter, true);

        if ( count( $arraySchoolUnit ) === 1 ) { 
            $fSchoolUnitId = $arraySchoolUnit[0]->getSchoolUnitId();                
        } else if ( count( $arraySchoolUnit ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicateSchoolUnitIdValue." : ".$school_unit, ExceptionCodes::DuplicateSchoolUnitIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidSchoolUnitValue." : ".$school_unit, ExceptionCodes::InvalidSchoolUnitValue);
        }
       

        //$relation_type============================================================          
        $filter = array();
        if (Validator::isMissing('relation_type'))
            throw new Exception(ExceptionMessages::MissingRelationTypeParam." : ".$relation_type, ExceptionCodes::MissingRelationTypeParam);
        else if (Validator::IsNull($relation_type) )
            throw new Exception(ExceptionMessages::MissingRelationTypeValue." : ".$relation_type, ExceptionCodes::MissingRelationTypeValue);
        else if (Validator::IsID($relation_type)) 
            $filter[] = new DFC(RelationTypesExt::FIELD_RELATION_TYPE_ID, $relation_type, DFC::EXACT);    
        else  if (Validator::IsValue($relation_type)) 
            $filter[] = new DFC(RelationTypesExt::FIELD_NAME, $relation_type, DFC::EXACT);
        else
            throw new Exception(ExceptionMessages::UnknownRelationTypeValue." : ".$relation_type, ExceptionCodes::UnknownRelationTypeValue); 
            
        $oRelationTypes = new RelationTypesExt($db);
        $arrayRelationTypes = $oRelationTypes->findByFilter($db, $filter, true);

        if ( count( $arrayRelationTypes ) === 1 ) { 
            $fLabRelationTypeId = $arrayRelationTypes[0]->getRelationTypeId();                
        } else if ( count( $arrayRelationTypes ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicateRelationTypeIdValue." : ".$relation_type, ExceptionCodes::DuplicateRelationTypeIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidRelationTypeValue." : ".$relation_type, ExceptionCodes::InvalidRelationTypeValue);
        }

        //check relation_type and set circuit if required   
        if ($fLabRelationTypeId == 1) {
         
            //check if lab has at least one relation served online   
           $duplicate_filter = array();    
           $duplicate_filter = array (  new DFC(LabRelationsExt::FIELD_LAB_ID, Validator::ToID($fLabId), DFC::EXACT),
                                        new DFC(LabRelationsExt::FIELD_RELATION_TYPE_ID, Validator::ToID($fLabRelationTypeId), DFC::EXACT)); 

           $dplLabRelations = new LabRelationsExt($db);
           $dplLabRelation = $dplLabRelations->findByFilter($db, $duplicate_filter, true);  
           $result["relation_exists"]=count($dplLabRelation)!=0?true:false;
           if (count($dplLabRelation) != 0 ) { 
                throw new Exception(ExceptionMessages::DuplicateLabRelationServerOnlineValue , ExceptionCodes::DuplicateLabRelationServerOnlineValue);
            } else {    

               $filter= array();

               //$circuit_id
               if (Validator::isMissing('circuit_id'))
                   throw new Exception(ExceptionMessages::MissingCircuitIdParam." : ".$circuit_id, ExceptionCodes::MissingCircuitIdParam);
               else if (Validator::IsNull($circuit_id))
                   throw new Exception(ExceptionMessages::MissingCircuitIdValue." : ".$circuit_id, ExceptionCodes::MissingCircuitIdValue);
               else if (!Validator::IsNumeric($circuit_id) || Validator::IsNegative($circuit_id))
                   throw new Exception(ExceptionMessages::InvalidCircuitIdValue." : ".$circuit_id, ExceptionCodes::InvalidCircuitIdValue);    
               else if (Validator::IsID($circuit_id)) 
                   $filter = array (new DFC(CircuitsExt::FIELD_CIRCUIT_ID, Validator::ToID($circuit_id), DFC::EXACT),
                                    new DFC(CircuitsExt::FIELD_SCHOOL_UNIT_ID, Validator::ToID($fSchoolUnitId), DFC::EXACT));     
               else 
                   throw new Exception(ExceptionMessages::UnknownCircuitIdValue." : ".$circuit_id, ExceptionCodes::UnknownCircuitIdValue);    


               $oCircuits = new CircuitsExt($db);
               $arrayCircuits = $oCircuits->findByFilter($db, $filter, true);


               if ( count( $arrayCircuits ) === 1 ) { 
                   $fCircuitId = $arrayCircuits[0]->getCircuitId();
               } else if ( count( $arrayCircuits ) > 1 ) { 
                   throw new Exception(ExceptionMessages::DuplicateCircuitValue." : ". " circuit_id = " . $circuit_id . " school_unit_id =  " .$fSchoolUnitId , ExceptionCodes::DuplicateCircuitValue);
               } else {
                   throw new Exception(ExceptionMessages::InvalidCircuitValue." : ". " circuit_id = " . $circuit_id . " school_unit_id =  " .$fSchoolUnitId, ExceptionCodes::InvalidCircuitValue);
               }
            }
        } else {
            if (Validator::IsExists('circuit_id'))
                throw new Exception(ExceptionMessages::ErrorInputCircuitIdParam." : ".$circuit_id, ExceptionCodes::ErrorInputCircuitIdParam);
            else 
                 $fCircuitId = Validator::ToNull($circuit_id);
       }
       
       //==================================================================================          
       try{
            
        $db->beginTransaction();    
                      
            $oLabRelations = new LabRelationsExt($db);
            $oLabRelations->setLabId($fLabId);
            $oLabRelations->setSchoolUnitId($fSchoolUnitId);
            $oLabRelations->setRelationTypeId($fLabRelationTypeId);
            $oLabRelations->setCircuitId($fCircuitId);
           
            
           $circuit_query = $fLabRelationTypeId ==1 ? DFC::EXACT:DFC::IS_NULL;
            
           $filter= array();
           $filter  = array(    new DFC(LabRelationsExt::FIELD_LAB_ID, $fLabId, DFC::EXACT),
                                new DFC(LabRelationsExt::FIELD_SCHOOL_UNIT_ID, $fSchoolUnitId, DFC::EXACT),
                                new DFC(LabRelationsExt::FIELD_RELATION_TYPE_ID, $fLabRelationTypeId, DFC::EXACT),
                                new DFC(LabRelationsExt::FIELD_CIRCUIT_ID, $fCircuitId, $circuit_query)
                        );   
            $arrayLabRelations = $oLabRelations->findByFilter($db, $filter, true);  
            $result["relation_exists"]=count($arrayLabRelations)!=0?true:false;

                if (count($arrayLabRelations) != 0 ) { 
                    throw new Exception(ExceptionMessages::DuplicateLabRelationValue , ExceptionCodes::DuplicateLabRelationValue);
                } else {
                    $oLabRelations->insertIntoDatabase($db); 
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