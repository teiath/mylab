<?php
/**
 *
 * @version 2.0
 * @author  ΤΕΙ Αθήνας
 * @package POST
 * 
 */

header("Content-Type: text/html; charset=utf-8");
/**
 * 
 * @global type $app
 * @global type $entityManager
 * @param type $lab_id
 * @param type $submitted
 * @param type $transition_date
 * @param type $transition_justification
 * @param type $transition_source
 * @return string
 * @throws Exception
 */

function PutInitialLabs($lab_id, $submitted, $transition_date, $transition_justification, $transition_source ) {
    
    global $app,$entityManager;

    $result = array();
    $LabTransition = new LabTransitions();
    
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = json_decode($app->request()->getBody());
    $params = loadParameters();
       
    try {
        
//$lab_id=======================================================================    
        $fLabID = CRUDUtils::checkIDParam('lab_id', $params, $lab_id, 'LabID');
       
//init entity for update row====================================================
        $Lab = CRUDUtils::findIDParam($fLabID, 'Labs', 'Lab'); 

        //check if lab is already submitted and stop proccess
         if ($Lab->getSubmitted() == true){
            throw new Exception(ExceptionMessages::AlreadyLabSubmittedActiveValue." : ".$submitted, ExceptionCodes::InvalidLabSubmittedType);    
         }
        
//$updated infos================================================================
        $username =  $app->request->user['uid'];
        $Lab->setLastUpdated(new \DateTime (date('Y-m-d H:i:s')));  
        $Lab->setUpdatedBy($username[0]);      
        //$state================================================================
        //because of user cant set up 'state' parameter we use the required parameter 'lab_id' as paspartu to continue 
        CRUDUtils::entitySetAssociation($Lab, 1, 'States', 'state', 'State', $params, 'lab_id');
        
//$submitted====================================================================   
            if (Validator::Missing('submitted', $params))
                throw new Exception(ExceptionMessages::MissingLabSubmittedParam." : ".$submitted, ExceptionCodes::MissingLabSubmittedParam);
            else if (Validator::isNull($submitted))
                throw new Exception(ExceptionMessages::MissingLabSubmittedValue." : ".$submitted, ExceptionCodes::MissingLabSubmittedValue); 
            else if (Validator::IsArray($submitted))
                throw new Exception(ExceptionMessages::InvalidLabSubmittedArray." : ".$submitted, ExceptionCodes::InvalidLabSubmittedArray);
            else if (Validator::IsTrue($submitted)) 
                 $Lab->setSubmitted(1);        
            else
                throw new Exception(ExceptionMessages::InvalidLabSubmittedType." : ".$submitted, ExceptionCodes::InvalidLabSubmittedType); 
        
//$transition_date==============================================================      
        if (Validator::Missing('transition_date', $params))
           throw new Exception(ExceptionMessages::MissingLabTransitionDateParam." : ".$transition_date, ExceptionCodes::MissingLabTransitionDateParam);
       else if (Validator::IsNull($transition_date))
            throw new Exception(ExceptionMessages::MissingLabTransitionDateValue." : ".$transition_date, ExceptionCodes::MissingLabTransitionDateValue);
       else if (Validator::IsArray($transition_date))
            throw new Exception(ExceptionMessages::InvalidLabTransitionDateArray." : ".$transition_date, ExceptionCodes::InvalidLabTransitionDateArray);    
       else if (! Validator::IsValidDate($transition_date) )
            throw new Exception(ExceptionMessages::InvalidLabTransitionValidType." : ".$transition_date, ExceptionCodes::InvalidLabTransitionValidType); 
       else if (Validator::IsDate($transition_date,'Y-m-d'))
            $LabTransition->setTransitionDate (new \DateTime($transition_date));
       else
            throw new Exception(ExceptionMessages::InvalidLabTransitionDateType." : ".$transition_date, ExceptionCodes::InvalidLabTransitionDateType);    
 
//$transition_justification===================================================== 
        if (Validator::Missing('transition_justification', $params))
            throw new Exception(ExceptionMessages::MissingLabTransitionJustificationParam." : ".$transition_justification, ExceptionCodes::MissingLabTransitionJustificationParam);          
        else if (Validator::IsNull($transition_justification))
            throw new Exception(ExceptionMessages::MissingLabTransitionDateValue." : ".$transition_justification, ExceptionCodes::MissingLabTransitionDateValue);                        
        else if (Validator::IsValue($transition_justification))
            $LabTransition->setTransitionJustification(Validator::ToValue($transition_justification));
        else
            throw new Exception(ExceptionMessages::InvalidLabTransitionJustificationType." : ".$transition_justification, ExceptionCodes::InvalidLabTransitionJustificationType);

//$transition_source============================================================ 
        if (Validator::Missing('transition_source', $params))
            throw new Exception(ExceptionMessages::MissingLabTransitionSourceParam." : ".$transition_source, ExceptionCodes::MissingLabTransitionSourceParam);          
        else if (Validator::IsNull($transition_source))
            throw new Exception(ExceptionMessages::MissingLabTransitionSourceValue." : ".$transition_source, ExceptionCodes::MissingLabTransitionSourceValue);                        
        else if (Validator::IsArray($transition_source))
            throw new Exception(ExceptionMessages::InvalidLabTransitionSourceArray." : ".$transition_source, ExceptionCodes::InvalidLabTransitionSourceArray);                        
        else if (Validator::IsTransitionSource($transition_source))
            $LabTransition->setTransitionSource(Validator::ToTransitionSource($transition_source));
        else
            throw new Exception(ExceptionMessages::InvalidLabTransitionSourceType." : ".$transition_source, ExceptionCodes::InvalidLabTransitionSourceType);

//user permisions===============================================================
        
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array($Lab->getLabId(),$permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToPutLab, ExceptionCodes::NoPermissionToPutLab); 
         }; 
    
//controls======================================================================  

        //check if table transition has the initial transition
        $foundLabTransition = $entityManager->getRepository('LabTransitions')->findBy(array('lab'=> $fLabID));

        $hasInitTransition=count($foundLabTransition);
        if ($hasInitTransition >= 1){
           throw new Exception(ExceptionMessages::AlreadyLabSubmittedInitialValue, ExceptionCodes::AlreadyLabSubmittedInitialValue);  
        }
    
        //found lab and school_unit data for name creation
         $school_unit_id = $Lab->getSchoolUnit()->getSchoolUnitId();
         $fLabTypeId = $Lab->getLabType()->getLabTypeId(); 
         $fLabTypeName = $Lab->getLabType()->getName();
          
        $findSchoolUnit = $entityManager->getRepository('SchoolUnits')->findOneBy(array ('schoolUnitId'=>$school_unit_id));
        $fSchoolUnitId = $findSchoolUnit->getSchoolUnitId();
        $fSchoolUnitName = $findSchoolUnit->getName();
        $fSchoolUnitStateId = $findSchoolUnit->getState()->getStateId();
                        
        //$lab_name created auto with format : "lab_type_name.number_lab - school_unit_name"===
        if ($fSchoolUnitStateId == 1){ 
            if (Validator::IsNull($fSchoolUnitId) ) 
                throw new Exception(ExceptionMessages::MissingSchoolUnitIDValue." : ".$fSchoolUnitId, ExceptionCodes::MissingSchoolUnitIDValue);
            else if (Validator::IsNull($fLabTypeId))
                throw new Exception(ExceptionMessages::MissingLabTypeIDValue." : ".$fLabTypeId, ExceptionCodes::MissingLabTypeIDValue);
            else {
                //find count lab types of school unit===========================
                $checkCountLabs = $entityManager->getRepository('Labs')->findBy(array( 'schoolUnit'    => $Lab->getSchoolUnit(),
                                                                                       'labType'       => $Lab->getLabType(),
                                                                                       'submitted'     => 1
                                                                                     )); 

               
                //create lab name 
                $num_of_lab = count($checkCountLabs); 
                $lab_name = $fLabTypeName. '.' . ++$num_of_lab . ' - ' . $fSchoolUnitName;

                if (Validator::isNull($lab_name))
                    throw new Exception(ExceptionMessages::MissingLabNameValue." : ".$lab_name, ExceptionCodes::MissingLabNameValue); 
                else if (Validator::IsArray($lab_name))
                    throw new Exception(ExceptionMessages::InvalidLabNameArray." : ".$lab_name, ExceptionCodes::InvalidLabNameArray);    
                else if (Validator::IsValue($lab_name)) 
                     $Lab->setName(Validator::ToValue($lab_name));              
                else
                    throw new Exception(ExceptionMessages::InvalidLabNameType." : ".$lab_name, ExceptionCodes::InvalidLabNameType);  
                
            }
                
            //check if auto-created lab_name is duplicated to db================
                $checkCountLabsName = $entityManager->getRepository('Labs')->findOneBy(array( 'name'        => Validator::toValue($lab_name),
                                                                                              'schoolUnit'  => $Lab->getSchoolUnit()
                                                                                              //'specialName' => $Lab->getSpecialName()
                                                                                            ));
                
  
                if (!Validator::isNull($checkCountLabsName) || count($checkCountLabsName) !== 0)   
                    throw new Exception(ExceptionMessages::DuplicatedLabNameValue." : ".$lab_name, ExceptionCodes::DuplicatedLabNameValue);
                
        } else {
            throw new Exception(ExceptionMessages::NotAllowedLabNameValue." : ".$fSchoolUnitStateId, ExceptionCodes::NotAllowedLabNameValue); 
        }
            
            
//update to db==================================================================

           $entityManager->persist($Lab);
           $entityManager->flush($Lab);
       
           $result["lab_id"] = $Lab->getLabId();
           $result["lab_name"] = $Lab->getName();
           
            //create lab_transition=============================================
            //because of user cant set up 'lab_id' parameter to entity $LabTransition we use the required parameter 'lab_id' as paspartu to continue 
            CRUDUtils::entitySetAssociation($LabTransition, $fLabID, 'Labs', 'lab', 'Lab', $params, 'lab_id'); 
            //because of user cant set up 'to_state' parameter to entity $LabTransition we use the required parameter 'lab_id' as paspartu to continue 
            CRUDUtils::entitySetAssociation($LabTransition, 1, 'States', 'toState', 'State', $params, 'lab_id');
                $entityManager->persist($LabTransition);
                $entityManager->flush($LabTransition);
                $result["lab_transition_id"] = $LabTransition->getLabTransitionId();
                
//result_messages===============================================================      
        $result["status"] = ExceptionCodes::NoErrors;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".ExceptionMessages::NoErrors;
    } catch (Exception $e) {
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    }                
    
    return $result;
}

?>