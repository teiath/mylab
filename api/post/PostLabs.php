<?php

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @global type $app
 * @param type $special_name
 * @param type $positioning
 * @param type $comments
 * @param type $operational_rating
 * @param type $technological_rating
 * @param type $lab_type
 * @param type $school_unit
 * @param type $state
 * @param type $lab_source
 * @param type $lab_worker
 * @param type $worker_start_service
 * @param type $transition_date
 * @param type $transition_justification
 * @param type $transition_source
 * @param type $relation_served_service
 * @param type $relation_served_online
 * @param type $aquisition_sources
 * @param type $equipment_types
 * @return string
 * @throws Exception
 */

function PostLabs(  $special_name, $positioning, $comments, $operational_rating, $technological_rating, 
                    $lab_type, $school_unit, $state, $lab_source, 
                    $lab_worker, $worker_start_service,
                    $transition_date, $transition_justification, $transition_source,
                    $relation_served_service, $relation_served_online,
                    $aquisition_sources, $equipment_types) 
{
    
    global $db;
    global $Options;
    global $app;


    $result = array();  
    $result["data"] = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);

    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = $app->request->getBody();
    
    $result["positioning"] = $positioning;
    $result["comments"] = $comments;
    $result["operational_rating"] = $operational_rating;
    $result["technological_rating"] = $technological_rating;
    $result["lab_type"] = $lab_type;
    $result["school_unit"] = $school_unit;
    $result["state"] = $state;
    $result["source"] = $lab_source;
  
    $result["lab_worker"] = $lab_worker;
    $result["worker_start_service"] = $worker_start_service;  
    
    $result["transition_date"] = $transition_date;
    $result["transition_justification"] = $transition_justification;
    $result["transition_source"] = $transition_source;
    
    $result["relation_served_service"] = $relation_served_service;
    $result["relation_served_online"] = $relation_served_online;
    
    $result["aquisition_sources"] = $aquisition_sources;
    $result["equipment_types"] = $equipment_types;
      
    try {
        
       //= labs table#################################################################################################################

         $fpositioning = $positioning ? $positioning : NULL;
         $fcomments = $comments? $comments : NULL;

        //$creation infos================================================================
        $creation_date = date('Y-m-d H:i:s');
        $created_by = 'myLab BetaUser'; //edw na mpei to connection me ton ldap wste na exoume to onoma
        
        $result["creation_date"] = $creation_date;
        $result["created_by"] = $created_by;
    
       //$special_name=============================================================
       if ($special_name){
         
            if (! Validator::IsValue($special_name) ){
                 throw new Exception(ExceptionMessages::InvalidSpecialNameValue." : ".$special_name, ExceptionCodes::InvalidSpecialNameValue);    
            } else {
               // $fspecial_name = $special_name? $special_name : NULL;
                $fspecial_name = $special_name;
            }
      
       } else{
           $fspecial_name = NULL;
       }
       
       //$operational_rating=============================================================           
        if (Validator::isMissing('operational_rating'))
            throw new Exception(ExceptionMessages::MissingOperationalRatingParam." : ".$operational_rating, ExceptionCodes::MissingOperationalRatingParam);
        else if (Validator::IsNull($operational_rating) )
            throw new Exception(ExceptionMessages::MissingOperationalRatingValue." : ".$operational_rating, ExceptionCodes::MissingOperationalRatingValue);
        else if (!Validator::IsNumeric($operational_rating) || Validator::IsNegative($operational_rating))
	    throw new Exception(ExceptionMessages::InvalidOperationalRatingValue." : ".$operational_rating, ExceptionCodes::InvalidOperationalRatingValue);    
        else if (Validator::IsFiveStarSystem($operational_rating)) 
             $fOperationalRating = Validator::ToFiveStarSystem($operational_rating);                
        else
            throw new Exception(ExceptionMessages::UnknownOperationalRatingValue." : ".$operational_rating, ExceptionCodes::UnknownOperationalRatingValue);   
      
       //$technological_rating=============================================================
        if (Validator::isMissing('technological_rating'))
            throw new Exception(ExceptionMessages::MissingTechnologicalRatingParam." : ".$technological_rating, ExceptionCodes::MissingTechnologicalRatingParam);
        else if (Validator::IsNull($technological_rating) )
            throw new Exception(ExceptionMessages::MissingTechnologicalRatingValue." : ".$technological_rating, ExceptionCodes::MissingTechnologicalRatingValue);
        else if (!Validator::IsNumeric($technological_rating) || Validator::IsNegative($technological_rating))
	    throw new Exception(ExceptionMessages::InvalidTechnologicalRatingValue." : ".$technological_rating, ExceptionCodes::InvalidTechnologicalRatingValue);    
        else if (Validator::IsFiveStarSystem($technological_rating)) 
             $fTechnologicalRating = Validator::ToFiveStarSystem($technological_rating);                
        else
            throw new Exception(ExceptionMessages::UnknownTechnologicalRatingValue." : ".$technological_rating, ExceptionCodes::UnknownTechnologicalRatingValue);   
     
        //$lab_type============================================================          
        if (! $lab_type)
            throw new Exception(ExceptionMessages::CreateLabTypeIdValue." : ".$lab_type, ExceptionCodes::CreateLabTypeIdValue);
        else {
             $oLabTypes = new LabTypesExt($db);

              if (is_numeric($lab_type)) {
                  $filter[] = new DFC(LabTypesExt::FIELD_LAB_TYPE_ID, $lab_type, DFC::EXACT) ;
              } else { 
                  $filter[] = new DFC(LabTypesExt::FIELD_NAME, $lab_type, DFC::EXACT);                
              }         
         }

        $arrayLabTypes = $oLabTypes->findByFilter($db, $filter, true);
        
        if ( count( $arrayLabTypes ) === 1 ) { 
            $fLabType = $arrayLabTypes[0]->getLabTypeId();
            $fLabTypeName = $arrayLabTypes[0]->getName();
        } else if ( count( $arrayLabTypes ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicateLabTypeIdValue." : ".$lab_type, ExceptionCodes::DuplicateLabTypeIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidLabTypeValue." : ".$lab_type, ExceptionCodes::InvalidLabTypeValue);
        }     

        //$school_unit============================================================          
        if (! $school_unit)
            throw new Exception(ExceptionMessages::CreateSchoolUnitIdValue." : ".$school_unit, ExceptionCodes::CreateSchoolUnitIdValue);
        else {
             $oSchoolUnit = new SchoolUnitsExt($db);

              if (is_numeric($school_unit)) {
                  $filter[] = new DFC(SchoolUnitsExt::FIELD_SCHOOL_UNIT_ID, $school_unit, DFC::EXACT) ;
              } else { 
                  $filter[] = new DFC(SchoolUnitsExt::FIELD_NAME, $school_unit, DFC::EXACT);                
              }         
         }

        $arraySchoolUnit = $oSchoolUnit->findByFilter($db, $filter, true);
        
        if ( count( $arraySchoolUnit ) === 1 ) { 
            $fSchoolUnit = $arraySchoolUnit[0]->getSchoolUnitId();
            $fSchoolUnitName = $arraySchoolUnit[0]->getName();
            $fSchoolUnitState = $arraySchoolUnit[0]->getStateId();
        } else if ( count( $arraySchoolUnit ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicateSchoolUnitIdValue." : ".$school_unit, ExceptionCodes::DuplicateSchoolUnitIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidSchoolUnitValue." : ".$school_unit, ExceptionCodes::InvalidSchoolUnitValue);
        }  

        //$state============================================================          
        if (! $state)
            throw new Exception(ExceptionMessages::CreateStateIDValue." : ".$state, ExceptionCodes::CreateStateIDValue);
        else {
             $oStates = new StatesExt($db);

              if (is_numeric($state)) {
                  $filter[] = new DFC(StatesExt::FIELD_STATE_ID, $state, DFC::EXACT) ;
              } else { 
                  $filter[] = new DFC(StatesExt::FIELD_NAME, $state, DFC::EXACT);                
              }         
         }

        $arrayState= $oStates->findByFilter($db, $filter, true);
        
        if ( count( $arrayState ) === 1 ) { 
            $fState = $arrayState[0]->getStateId();
            //$fStateName = $arrayState[0]->getName();
        } else if ( count( $arrayState ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicateStateIdValue." : ".$state, ExceptionCodes::DuplicateStateIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidStateValue." : ".$state, ExceptionCodes::InvalidStateValue);
        } 
        
        //$lab_source============================================================          
        if (! $lab_source)
            throw new Exception(ExceptionMessages::CreateLabSourceIdValue." : ".$lab_source, ExceptionCodes::CreateLabSourceIdValue);
        else {
             $oLabSources = new LabSourcesExt($db);

              if (is_numeric($lab_source)) {
                  $filter[] = new DFC(LabSourcesExt::FIELD_LAB_SOURCE_ID, $lab_source, DFC::EXACT) ;
              } else { 
                  $filter[] = new DFC(LabSourcesExt::FIELD_NAME, $lab_source, DFC::EXACT);                
              }         
         }

        $arrayLabSource= $oLabSources->findByFilter($db, $filter, true);
        
        if ( count( $arrayLabSource ) === 1 ) { 
            $fLabSource = $arrayLabSource[0]->getLabSourceId();
            //$fSourceName = $arraySource[0]->getName();
        } else if ( count( $arrayLabSource ) > 1 ) { 
            throw new Exception(ExceptionMessages::DuplicateLabSourceIdValue." : ".$lab_source, ExceptionCodes::DuplicateLabSourceIdValue);
        } else {
            throw new Exception(ExceptionMessages::InvalidLabSourceValue." : ".$lab_source, ExceptionCodes::InvalidLabSourceValue);
        } 
        
        //$lab_name created auto with format : "lab_type_name.number_lab - school_unit_name" ============================================
        if ($fSchoolUnitState == 1){ 
            if (!($fSchoolUnit) && !($fLabType) ) {
                throw new Exception(ExceptionMessages::MissingNameValue." : ".$fSchoolUnitName, ExceptionCodes::MissingNameValue);
            } else {

                $check_filter =array (new DFC(LabsExt::FIELD_SCHOOL_UNIT_ID, $fSchoolUnit, DFC::EXACT),
                                      new DFC(LabsExt::FIELD_LAB_TYPE_ID, $fLabType, DFC::EXACT)
                                      );

                $oLabs = new LabsExt($db); 
                $countRows = $oLabs->findByFilterBeta($db, $check_filter, true);

                $num_of_lab = count($countRows);
                //$num_of_lab = count($countRows) > 0 ? count($countRows) : 1;      
                $lab_name = $fLabTypeName. '.' . ++$num_of_lab . ' - ' . $fSchoolUnitName;
            }
                
            //check if auto-created lab_name is duplicated to db
            $filter[] = new DFC(LabsExt::FIELD_NAME, $lab_name, DFC::EXACT) ;
            $checkNameLab = new LabsExt($db);
            $arrayCheckNameLab = $checkNameLab->findByFilter($db, $filter, true);

          //  if ( count( $arrayCheckNameLab ) > 0 ) { 
          //       throw new Exception(ExceptionMessages::DuplicateLabValue." : ".$lab_name, ExceptionCodes::DuplicateLabValue);
          //  } else {
                $fname = $lab_name;
          //  }
        
        } else {
            throw new Exception(ExceptionMessages::NotAllowedLabNameValue." : ".$fSchoolUnitState, ExceptionCodes::NotAllowedLabNameValue); 
        }
  
       //= lab_workers table#################################################################################################################       

        //$lab_worker===============================================================       
        
         if ($lab_worker) { 
             
        if (!$worker_start_service) { 
            throw new Exception(ExceptionMessages::MissingWorkerStartServiceValue." : ".$worker_start_service, ExceptionCodes::MissingWorkerStartServiceValue);    
        }
             
            $oWorkers = new WorkersExt($db);

            if (is_numeric($lab_worker)) {
                $filter[] = new DFC(WorkersExt::FIELD_REGISTRY_NO, $lab_worker, DFC::EXACT) ;
            } else { 
                throw new Exception(ExceptionMessages::InvalidRegistryNumberValue." : ".$lab_worker, ExceptionCodes::InvalidRegistryNumberValue);                  
            }         
       
            $arrayWorkers = $oWorkers->findByFilter($db, $filter, true);

            if ( count( $arrayWorkers ) === 1 ) { 
                $fWorker = $arrayWorkers[0]->getWorkerId();
            } else if ( count( $arrayWorkers ) > 1 ) { 
                throw new Exception(ExceptionMessages::DuplicateWorkerIdValue." : ".$lab_worker, ExceptionCodes::DuplicateWorkerIdValue);
            } else {
                throw new Exception(ExceptionMessages::InvalidWorkerValue." : ".$lab_worker, ExceptionCodes::InvalidWorkerValue);
            }
            
        } else {
            $fWorker=null; 
        }

        //$worker_start_service=============================================================
       if ($worker_start_service){
        if (!$lab_worker) { 
            throw new Exception(ExceptionMessages::MissingLabWorkerValue." : ".$lab_worker, ExceptionCodes::MissingLabWorkerValue);    
        }
        
            if (! Validator::IsDate($worker_start_service,'Y-m-d') ){
                throw new Exception(ExceptionMessages::InvalidWorkerStartServiceValue." : ".$worker_start_service, ExceptionCodes::InvalidWorkerStartServiceValue);    
            } else if (! Validator::IsValidDate($worker_start_service) ){
                throw new Exception(ExceptionMessages::InvalidWorkerStartServiceValidValue." : ".$worker_start_service, ExceptionCodes::InvalidWorkerStartServiceValidValue); 
            } else {
                //$fWorkerStartService = $worker_start_service? $worker_start_service : NULL;
                $fWorkerStartService = $worker_start_service;
            }
        
       }

       //= lab_transitions table#################################################################################################################
       
        //$transition_date=============================================================
       if ($transition_date){
           
           if (!$transition_justification) { 
                throw new Exception(ExceptionMessages::MissingTransitionJustificationValue." : ".$transition_justification, ExceptionCodes::MissingTransitionJustificationValue);    
            }
           if (!$transition_source) { 
                throw new Exception(ExceptionMessages::MissingTransitionSourceValue." : ".$transition_source, ExceptionCodes::MissingTransitionSourceValue);    
            }
        
            if (! Validator::IsDate($transition_date,'Y-m-d') ){
                throw new Exception(ExceptionMessages::InvalidTransitionDateValue." : ".$transition_date, ExceptionCodes::InvalidTransitionDateValue);    
            } else if (! Validator::IsValidDate($transition_date) ){
                throw new Exception(ExceptionMessages::InvalidTransitionDateValidValue." : ".$transition_date, ExceptionCodes::InvalidTransitionDateValidValue); 
            } else {
                $fTransitionDate = $transition_date;
            }
        
       }
       
        //$transition_justification=============================================================
       if ($transition_justification){

           if (!$transition_date) { 
                throw new Exception(ExceptionMessages::MissingTransitionDateValue." : ".$transition_date, ExceptionCodes::MissingTransitionDateValue);    
            }
           if (!$transition_source) { 
                throw new Exception(ExceptionMessages::MissingTransitionSourceValue." : ".$transition_source, ExceptionCodes::MissingTransitionSourceValue);    
            }
                $fTransitionJustification = $transition_justification;  
        
       }
       
         //$transition_source=============================================================
        if ($transition_source) {
        
        if (!$transition_date) { 
                throw new Exception(ExceptionMessages::MissingTransitionDateValue." : ".$transition_date, ExceptionCodes::MissingTransitionDateValue);    
            }
        if (!$transition_justification) { 
             throw new Exception(ExceptionMessages::MissingTransitionJustificationValue." : ".$transition_justification, ExceptionCodes::MissingTransitionJustificationValue);    
         }
            
         if (($transition_source !="mylab") && ($transition_source !="mmsch") )   
                throw new Exception(ExceptionMessages::InvalidTransitionSourceValue." : ".$transition_source, ExceptionCodes::InvalidTransitionSourceValue);
            else
                $fTransitionSource = $transition_source;  
            
        }
        
        //= lab_relations table#################################################################################################################
        
        //$relation_served_service============================================================
        
         if ($relation_served_service) {
             
            //count school_units data from school_units table and return at getSchoolUnitId
            $count_vbl_school_units = SchoolUnitsExt::getAllCount($db);
            $count_school_units_vbl = $count_vbl_school_units[0]->getSchoolUnitId();

            //count school_units data from user input at GET request
            $count_school_units = preg_split("/[\s]*[,][\s]*/", $relation_served_service);  
            $count_school_units_usr = count( $count_school_units ); 

            //check if user has input more variable than school_units vocabulary
            if ( $count_school_units_usr <= $count_school_units_vbl ) {         
           
                $rssSchoolUnits = new SchoolUnitsExt($db);
 
                foreach ($count_school_units as $relation_school_unit){        
                    if (is_numeric($relation_school_unit)) {
                        $filter = array (new DFC(SchoolUnitsExt::FIELD_SCHOOL_UNIT_ID, $relation_school_unit, DFC::EXACT) );
                    } else { 
                        $filter = array (new DFC(SchoolUnitsExt::FIELD_NAME, $relation_school_unit, DFC::EXACT));                
                    }         


                    $arrayRelationSsSchoolUnit = $rssSchoolUnits->findByFilter($db, $filter, true);

                    if ( count( $arrayRelationSsSchoolUnit ) === 1 ) { 
                        $fRelationSchoolUnitId = $arrayRelationSsSchoolUnit[0]->getSchoolUnitId();
                       // $values_rel_ss_school_units[] = $fRelationSchoolUnitId;  
                        $values_rel_ss_school_units[] = array("relation_school_unit_id"=>$fRelationSchoolUnitId); 
                    } else if ( count( $arrayRelationSsSchoolUnit ) > 1 ) { 
                        throw new Exception(ExceptionMessages::DuplicateSchoolUnitIdValue." : ".$relation_school_unit, ExceptionCodes::DuplicateSchoolUnitIdValue);
                    } else {
                        throw new Exception(ExceptionMessages::InvalidSchoolUnitValue." : ".$relation_school_unit, ExceptionCodes::InvalidSchoolUnitValue);
                    }
                }

                sort($values_rel_ss_school_units);
             
                $check_values_rel_ss_school_units = array_unique($values_rel_ss_school_units, SORT_REGULAR);
                //$check_values_rel_ss_school_units=  Validator::ToUniqueObject($values_rel_ss_school_units)
                //$result["echo"]=$check_values_rel_ss_school_units;
                
                if (count($check_values_rel_ss_school_units)!=count($values_rel_ss_school_units)){
                    $result["duplicate_school_unit_id"]=$check_values_rel_ss_school_units;
                        throw new Exception(ExceptionMessages::InsertDuplicateSchoolUnits, ExceptionCodes::InsertDuplicateSchoolUnits);
                } else {                 
                     
                    $results_rel_ss_school_units = array();
                    foreach ($check_values_rel_ss_school_units as $rel_ss_school_units) {

                        if (!isset($results_rel_ss_school_units[$rel_ss_school_units['relation_school_unit_id']]))
                            $results_rel_ss_school_units[] = $rel_ss_school_units;
                        
                    }
                    //$result["insert_count_aquisition_first"]=count($results_rel_ss_school_units);
                } 
                

            }else{
                throw new Exception(ExceptionMessages::InsertMoreVariablesSchoolUnits.$count_school_units_vbl, ExceptionCodes::InsertMoreVariablesSchoolUnits); 
            }
              
        }
        
        
        //$relation_served_online============================================================
          if ($relation_served_online) {
            
            //split $relation_served_online data to school_unit_id and circuit_id
            $split_relation_served_online = preg_split("/[\s]*[=][\s]*/", $relation_served_online);  
            $count_relation_served_online = count( $split_relation_served_online );

                    if ($count_relation_served_online == '2') {
                       
                        //$school_unit========================================================================
                        $rsoSchoolUnits = new SchoolUnitsExt($db);

                            if (is_numeric($split_relation_served_online[0])) {
                                $filter = array (new DFC(SchoolUnitsExt::FIELD_SCHOOL_UNIT_ID, $split_relation_served_online[0], DFC::EXACT) );
                            } else { 
                                $filter = array (new DFC(SchoolUnitsExt::FIELD_NAME, $split_relation_served_online[0], DFC::EXACT));                
                            }         


                            $arrayRelationSoSchoolUnit = $rsoSchoolUnits->findByFilter($db, $filter, true);

                            if ( count( $arrayRelationSoSchoolUnit ) === 1 ) { 
                                $fRelationSoSchoolUnitId = $arrayRelationSoSchoolUnit[0]->getSchoolUnitId();
                            } else if ( count( $arrayRelationSoSchoolUnit ) > 1 ) { 
                                throw new Exception(ExceptionMessages::DuplicateSchoolUnitIdValue." : ".$split_relation_served_online[0], ExceptionCodes::DuplicateSchoolUnitIdValue);
                            } else {
                                throw new Exception(ExceptionMessages::InvalidSchoolUnitValue." : ".$split_relation_served_online[0], ExceptionCodes::InvalidSchoolUnitValue);
                            }
                        
                            
                        //$circuit_id==================================================================================        
                        $rsoCircuits = new CircuitsExt($db);
                        
                        if (is_numeric($split_relation_served_online[1])) {
                             $filter = array (new DFC(CircuitsExt::FIELD_PHONE_NUMBER, $split_relation_served_online[1], DFC::EXACT) );
                         } else { 
                            throw new Exception(ExceptionMessages::InvalidCircuitPhoneNumberValue." : ".$split_relation_served_online[1], ExceptionCodes::InvalidCircuitPhoneNumberValue);       
                        }   
                        
                        $arrayRelationSoCircuits = $rsoCircuits->findByFilter($db, $filter, true);

                        if ( count( $arrayRelationSoCircuits ) === 1 ) { 
                            $fRelationSoCircuitId = $arrayRelationSoCircuits[0]->getCircuitId();
                        } else if ( count( $arrayRelationSoCircuits ) > 1 ) { 
                            throw new Exception(ExceptionMessages::DuplicateCircuitPhoneNumberValue." : ".$split_relation_served_online[1], ExceptionCodes::DuplicateCircuitPhoneNumberValue);
                        } else {
                            throw new Exception(ExceptionMessages::InvalidCircuitPhoneNumberValue." : ".$split_relation_served_online[1], ExceptionCodes::InvalidCircuitPhoneNumberValue);
                        }
      
                    }else {
                      throw new Exception(ExceptionMessages::InsertErrorFormatRelationServedOnline.$relation_served_online, ExceptionCodes::InsertErrorFormatRelationServedOnline);   
                    }
    
          }
        
        
       //= lab_aquisition_sources table#################################################################################################################
        
        //$aquisition_source_id============================================================
        
         if ($aquisition_sources) {
             
            //count aquisition_sources data from aquisition_sources table and return at AquisitionSourceId
//            $count_vbl_aquisition_sources = AquisitionSourcesExt::getAllCount($db);
//            $count_aquisitions_sources_vbl = $count_vbl_aquisition_sources[0]->getAquisitionSourceId();
//
//            //count aquisition_sources data from user input at GET request
//            $count_aquisition_sources = preg_split("/[\s]*[,][\s]*/", $aquisition_sources);  
//            $count_aquisitions_sources_usr = count( $count_aquisition_sources ); 

            //check if user has input more variable than aquisition_sources vocabulary
//            if ( $count_aquisitions_sources_usr <= $count_aquisitions_sources_vbl ) {         
        
                $oAquisitionSources = new AquisitionSourcesExt($db);
                $oAquisitionSources->getAll($db);
                
                foreach ($count_aquisition_sources as $aquisition_source){
                    
                    //split equipment_types data to equipment_type and items
                    $split_aquisition_sources = preg_split("/[\s]*[=][\s]*/", $aquisition_source);  
                    $count_aquisition_sources_internal = count( $split_aquisition_sources );

                    if ($count_aquisition_sources_internal < 4 ) {
      
                        //aquisition_sources==============================================================================================
                        if (is_numeric($split_aquisition_sources[0])) {
                            $filter = array( new DFC(AquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, $split_aquisition_sources[0], DFC::EXACT) );
                            $arrayAquisitionSources = $oAquisitionSources->findByFilter($db, $filter, true);                       
                        } else if ($split_aquisition_sources[0]) {
                            $oAquisitionSources->searchArrayForValue($split_aquisition_sources[0]);
                            $filter  =array(  new DFC(AquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, $oAquisitionSources->getAquisitionSourceId(), DFC::EXACT) );
                            $arrayAquisitionSources = $oAquisitionSources->findByFilter($db, $filter, true);             
                        }

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
                    $result["duplicate_aquistion_sources"]=$check_values_aq_src;
                    throw new Exception(ExceptionMessages::InsertDuplicateAquisitionSources, ExceptionCodes::InsertDuplicateAquisitionSources);
                } else {                 
                    $results_aq_src = array();
                    foreach ($values_aq_src as $val) {
                      //  if (!isset($results_aq_src[$val['aquisition_source']]))
                            $results_aq_src[] = $val; 
                            //$results_aq_src[$val['aquisition_source']] = $val; //old method
                    }
                }   
//             }else{
//                throw new Exception(ExceptionMessages::InsertMoreVariablesAquisitionSources.$count_aquisitions_sources_vbl, ExceptionCodes::InsertMoreVariablesAquisitionSources); 
//            }
              
        }  
        
       //= lab_equipment_types table#################################################################################################################
        
        //$equipment_type_id============================================================    
        if ($equipment_types) {
            
            //count equipment_types data from equipment_types table and return at EquipmentTypeId
            $count_vbl_equipment_types = EquipmentTypesExt::getAllCount($db);
            $count_equipment_types_vbl = $count_vbl_equipment_types[0]->getEquipmentTypeId();

            //count equipment_types data from user input at GET request
            $count_equipment_types = preg_split("/[\s]*[,][\s]*/", $equipment_types);  
            $count_equipment_types_usr = count( $count_equipment_types );
            
            //check if user has input more variable than equipment_types vocabulary
            if ( $count_equipment_types_usr <= $count_equipment_types_vbl ) {     
                
                $oEquipmentTypes = new EquipmentTypesExt($db);
                $oEquipmentTypes->getAll($db);
                
                foreach ($count_equipment_types as $equipment_type){
                    
                    //split equipment_types data to equipment_type and items
                    $split_equipment_types = preg_split("/[\s]*[=][\s]*/", $equipment_type);  
                    $count_equipment_types_internal = count( $split_equipment_types );

                    if ($count_equipment_types_internal == '2') {
                       
                        //$equipment_types========================================================================
                        if (is_numeric($split_equipment_types[0])) {
                            $filter = array( new DFC(EquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $split_equipment_types[0], DFC::EXACT) );
                            $arrayEquipmentTypes = $oEquipmentTypes->findByFilter($db, $filter, true);                       
                        } else if ($split_equipment_types[0]) {
                            $oEquipmentTypes->searchArrayForValue($split_equipment_types[0]);
                            $filter  =array(  new DFC(EquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $oEquipmentTypes->getEquipmentTypeId(), DFC::EXACT) );
                            $arrayEquipmentTypes = $oEquipmentTypes->findByFilter($db, $filter, true);             
                        }

                        if ( count( $arrayEquipmentTypes ) === 1 ) { 
                            $fEquipmentType= $arrayEquipmentTypes[0]->getEquipmentTypeId();
                        } else if ( count( $arrayEquipmentTypes ) > 1 ) { 
                            throw new Exception(ExceptionMessages::DuplicateEquipmentTypeIdValue." : ".$split_equipment_types[0], ExceptionCodes::DuplicateEquipmentTypeIdValue);
                        } else {
                            throw new Exception(ExceptionMessages::InvalidEquipmentTypeValue." : ".$split_equipment_types[0], ExceptionCodes::InvalidEquipmentTypeValue);                            
                        }
                            
                        //$items==================================================================================        
                        if (!$split_equipment_types[1]) {
                            throw new Exception(ExceptionMessages::MissingItemValue." : ".$split_equipment_types[1], ExceptionCodes::MissingItemValue);
                        } else if (!is_numeric($split_equipment_types[1]) || $split_equipment_types[1]<=0 || $split_equipment_types[1] > 10000 ){
                            throw new Exception(ExceptionMessages::InvalidItemValue." : ".$split_equipment_types[1], ExceptionCodes::InvalidItemValue);
                        } else {
                            $fitems=$split_equipment_types[1];
                        }
                        
                       if (($fEquipmentType!="") && ($fitems!="")){
                            $values_eqt_src[] = array("equipment_type"=>$fEquipmentType , "items"=>$fitems ) ;
                        }
      
                    }else {
                      throw new Exception(ExceptionMessages::InsertErrorFormatEquipmentTypes.$equipment_type, ExceptionCodes::InsertErrorFormatEquipmentTypes);   
                    }
                }
               
                sort($values_eqt_src);

                $results_eqt_src = array();
                foreach ($values_eqt_src as $val) {
                    if (!isset($results_eqt_src[$val['equipment_type']]))
                        $results_eqt_src[$val['equipment_type']] = $val;                      
                    else
                        //$result["duplicate_equipment_types"]=$values_eqt_src;
                        throw new Exception(ExceptionMessages::InsertDuplicateEquipmentTypes.$equipment_type, ExceptionCodes::InsertDuplicateEquipmentTypes);
                }
                
            }else{
               throw new Exception(ExceptionMessages::InsertMoreVariablesEquipmentTypes.$count_equipment_types_vbl, ExceptionCodes::InsertMoreVariablesEquipmentTypes); 
           }
        
        }
        //=====================================================================================================================================================================    
        
        try{
            
        $db->beginTransaction();    
        
        
        
        $oLabs = new LabsExt($db);
        // $arrayLabs = $oLabs->findByFilter($db, $filter, true);
        // 
        //     if ( count( $arrayLabs ) > 0 ) { 
        //         throw new Exception(ExceptionMessages::DuplicateRegistryNumberValue." : ".$registry_number, ExceptionCodes::DuplicateRegistryNumberValue);
        //     }

        $oLabs->setName($fname);
        $oLabs->setSpecialName($fspecial_name);
        $oLabs->setCreationDate($creation_date);
        $oLabs->setCreatedBy($created_by);
        $oLabs->setPositioning($fpositioning);
        //$oLabs->setAquisitionYear($faquisition_year);
        $oLabs->setComments($fcomments);
        $oLabs->setOperationalRating($fOperationalRating);
        $oLabs->setTechnologicalRating($fTechnologicalRating);
       // $oLabs->setLabResponsibleId($fLabResponsible);
        $oLabs->setLabTypeId($fLabType);
        $oLabs->setSchoolUnitId($fSchoolUnit);
        $oLabs->setStateId($fState);
        $oLabs->setLabSourceId($fLabSource);
        
        $fFromState = $oLabs->getOldInstance()->getStateId();
        $result["old_instance_State"] = $fFromState;  
        
        $filter= array();
        $filter  = array(   new DFC(LabsExt::FIELD_NAME, $fname, DFC::EXACT),
                            new DFC(LabsExt::FIELD_SPECIAL_NAME, $fspecial_name, DFC::EXACT),
                            new DFC(LabsExt::FIELD_SCHOOL_UNIT_ID, $fSchoolUnit, DFC::EXACT)
                );   
        $arrayLabs = $oLabs->findByFilter($db, $filter, true);  
        $result["labs_exists"]=count($arrayLabs)!=0?true:false;

            if (count($arrayLabs) != 0 ) { 
                throw new Exception(ExceptionMessages::DuplicateLabsValue." name : ".$fname."  special_name : ".$fspecial_name."  school_unit_id : ".$fSchoolUnit , ExceptionCodes::DuplicateLabsValue);
            } else {
                $oLabs->insertIntoDatabase($db); 
            }        
        
        
        
        
        $result["lab_id"] = $oLabs->getLabId();
        $result["lab_name"] = $fname;
   
     
        
        
        //= insert to lab_transitions table =========================================================

            if ( $fFromState <> $oLabs->getStateId() )
            {
                $oLabTransitions = new LabTransitionsExt($db);
        
                $oLabTransitions->setLabId( $oLabs->getLabId() );
                $oLabTransitions->setFromState($fFromState);        
                $oLabTransitions->setToState( $oLabs->getStateId());
                $oLabTransitions->setTransitionDate( $fTransitionDate );
                $oLabTransitions->setTransitionJustification( $fTransitionJustification );
                $oLabTransitions->setTransitionSource( $fTransitionSource );

                $filter= array();
                $filter  = array(   new DFC(LabTransitionsExt::FIELD_LAB_ID, $oLabs->getLabId(), DFC::EXACT),
                                    new DFC(LabTransitionsExt::FIELD_FROM_STATE, $fFromState, DFC::EXACT),
                                    new DFC(LabTransitionsExt::FIELD_TO_STATE, $oLabs->getStateId(), DFC::EXACT)
                        );   
                $arrayLabTransitions = $oLabTransitions->findByFilter($db, $filter, true);  
                $result["transitions_exists"]=count($arrayLabTransitions)!=0?true:false;

                    if (count($arrayLabTransitions) != 0 ) { 
                        throw new Exception(ExceptionMessages::DuplicateLabTransitionsValue." lab_id : ".$oLabs->getLabId()."  from_state : ".$fFromState."  to_state : ".$oLabs->getStateId() , ExceptionCodes::DuplicateLabTransitionsValue);
                    } else {
                        $oLabTransitions->insertIntoDatabase($db); 
                    }               
            }
        
        //insert to lab_workers table =========================================================
        if ($fWorker){
               
            $oLabWorkers = new LabWorkersExt($db);
            $oLabWorkers->setLabId($oLabs->getLabId());
            $oLabWorkers->setWorkerId($fWorker);
            $oLabWorkers->setWorkerPositionId(2);
            $oLabWorkers->setWorkerEmail(null);
            $oLabWorkers->setWorkerStatus(1);
            $oLabWorkers->setWorkerStartService($fWorkerStartService);

            $filter= array();
            $filter  = array(   new DFC(LabWorkersExt::FIELD_LAB_ID, $oLabs->getLabId(), DFC::EXACT),
                                new DFC(LabWorkersExt::FIELD_WORKER_ID, $fWorker, DFC::EXACT),
                                new DFC(LabWorkersExt::FIELD_WORKER_POSITION_ID, 2, DFC::EXACT)
                        );   
            $arrayLabWorkers = $oLabWorkers->findByFilter($db, $filter, true);  
            $result["worker_exists"]=count($arrayLabWorkers)!=0?true:false;

                if (count($arrayLabWorkers) != 0 ) { 
                    throw new Exception(ExceptionMessages::DuplicateLabWorkerValue.$fWorker." lab_id : ".$oLabs->getLabId(), ExceptionCodes::DuplicateLabWorkerValue);
                } else {
                    $oLabWorkers->insertIntoDatabase($db); 
                }
          
        }
        
        //insert $relation_served_service to lab_relations table 
        if (count($results_rel_ss_school_units) > 0){
            
            //$result["insert_count_aquisition"]=$results_rel_ss_school_units;
            
            foreach ($results_rel_ss_school_units as $fRelationSSSchoolUnit) {
                 
            //$result["edwwwwwwww"]=$fRelationSSSchoolUnit["relation_school_unit_id"];
                 
            $oLabRelationsSS= new LabRelationsExt($db);
            $oLabRelationsSS->setLabId($oLabs->getLabId());
            $oLabRelationsSS->setSchoolUnitId($fRelationSSSchoolUnit["relation_school_unit_id"]);
            $oLabRelationsSS->setRelationTypeId(2);
            $oLabRelationsSS->setCircuitId(NULL);

            $filter= array();
            $filter  = array(   new DFC(LabRelationsExt::FIELD_LAB_ID, $oLabs->getLabId(), DFC::EXACT),
                                new DFC(LabRelationsExt::FIELD_SCHOOL_UNIT_ID, $fRelationSSSchoolUnit["relation_school_unit_id"], DFC::EXACT),
                                new DFC(LabRelationsExt::FIELD_RELATION_TYPE_ID, 2, DFC::EXACT)
                        );   
            $arrayLabRelationSS = $oLabRelationsSS->findByFilter($db, $filter, true);  
            $result["relation_served_service_exists"]=count($arrayLabRelationSS)!=0?true:false;

                if (count($arrayLabRelationSS) != 0 ) { 
                    throw new Exception(ExceptionMessages::DuplicateRelationServedServiceValue." lab_id : ".$oLabs->getLabId()."  school_unit_id : ".$fRelationSSSchoolUnit["relation_school_unit_id"], ExceptionCodes::DuplicateRelationServedServiceValue);
                } else {
                    $oLabRelationsSS->insertIntoDatabase($db); 
                }    
            }
        }
      
        //insert $relation_served_online to lab_relations table 
        if ($fRelationSoSchoolUnitId!="" && $fRelationSoCircuitId!=""){
                           
            $oLabRelationsSO= new LabRelationsExt($db);
            $oLabRelationsSO->setLabId($oLabs->getLabId());
            $oLabRelationsSO->setSchoolUnitId($fRelationSoSchoolUnitId);
            $oLabRelationsSO->setRelationTypeId(1);
            $oLabRelationsSO->setCircuitId($fRelationSoCircuitId);

            
            $filter= array();
            $filter  = array(   new DFC(LabRelationsExt::FIELD_LAB_ID, $oLabs->getLabId(), DFC::EXACT),
                                new DFC(LabRelationsExt::FIELD_SCHOOL_UNIT_ID, $fRelationSoSchoolUnitId, DFC::EXACT),
                                new DFC(LabRelationsExt::FIELD_RELATION_TYPE_ID, 1, DFC::EXACT)
                        );   
            $arrayLabRelationSO = $oLabRelationsSO->findByFilter($db, $filter, true);  
            $result["relation_served_online_exists"]=count($arrayLabRelationSO)!=0?true:false;

                if (count($arrayLabRelationSO) != 0 ) { 
                    throw new Exception(ExceptionMessages::DuplicateRelationServedOnlineValue." lab_id : ".$oLabs->getLabId()."  school_unit_id : ".$fRelationSoSchoolUnitId , ExceptionCodes::DuplicateRelationServedOnlineValue);
                } else {
                    $oLabRelationsSO->insertIntoDatabase($db); 
                }
           
        }
           
        //insert to aquisition_sources table =========================================================
        if (count($results_aq_src) > 0){
            foreach ($results_aq_src as $AquisitionSource) {
                
            $oLabAquisitionSources = new LabAquisitionSourcesExt($db);
            $oLabAquisitionSources->setLabId($oLabs->getLabId());
            $oLabAquisitionSources->setAquisitionSourceId($AquisitionSource["aquisition_source"]);
            $oLabAquisitionSources->setAquisitionYear($AquisitionSource["aquisition_year"]);
            $oLabAquisitionSources->setAquisitionComments($AquisitionSource["aquisition_comments"]);
           
           $filter= array();
           $filter  = array(    new DFC(LabAquisitionSourcesExt::FIELD_LAB_ID, $oLabs->getLabId(), DFC::EXACT),
                                new DFC(LabAquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, $AquisitionSource["aquisition_source"], DFC::EXACT),
                                new DFC(LabAquisitionSourcesExt::FIELD_AQUISITION_YEAR, $AquisitionSource["aquisition_year"], DFC::EXACT),
                                new DFC(LabAquisitionSourcesExt::FIELD_AQUISITION_COMMENTS, $AquisitionSource["aquisition_comments"], DFC::EXACT)
                        );   
            $arrayLabAquisitionSources = $oLabAquisitionSources->findByFilter($db, $filter, true);  
            $result["aquisitions_exists"]=count($arrayLabAquisitionSources)!=0?true:false;
           // $result["exists"]=$oLabAquisitionSources->findByFilter($db);  
                if (count($arrayLabAquisitionSources) != 0 ) { 
                    throw new Exception(ExceptionMessages::DuplicateLabHasAquisitionSourceValue." lab_id : ".$oLabs->getLabId()."  aquisition_source_id : ".$fAquisitionSource , ExceptionCodes::DuplicateLabHasAquisitionSourceValue);
                } else {
                    $oLabAquisitionSources->insertIntoDatabase($db); 
                }
            }
        }
        
        //insert to equipment_types table =========================================================
        if (count($results_eqt_src ) > 0){     
            foreach ($results_eqt_src as $EquipmentType) {

            $oLabEquipmentTypes = new LabEquipmentTypesExt($db);
            $oLabEquipmentTypes->setLabId($oLabs->getLabId());
            $oLabEquipmentTypes->setEquipmentTypeId($EquipmentType["equipment_type"]);
            $oLabEquipmentTypes->setItems($EquipmentType["items"]);

            $result["equipment_exists"]=$oLabEquipmentTypes->existsInDatabase($db);

                if ( $result["equipment_exists"]==true ) { 
                    throw new Exception(ExceptionMessages::DuplicateLabHasEquipmentTypeValue." lab_id : ".$oLabs->getLabId()."  equipment_type_id : ".$EquipmentType["equipment_type"] , ExceptionCodes::DuplicateLabHasEquipmentTypeValue);
                } else {
                    $oLabEquipmentTypes->insertIntoDatabase($db);;    
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
            $result["message_pdo_internal"] = "[".$result["method_pdo_internal"]."]: ".$e->getMessage().", SQL:".$stmt;

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