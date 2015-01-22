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
 * @param type $special_name
 * @param type $positioning
 * @param type $comments
 * @param type $operational_rating
 * @param type $technological_rating
 * @param type $ellak
 * @param type $lab_type
 * @param type $school_unit_id
 * @param type $lab_source
 * @return string
 * @throws Exception
 */

function PostLabs(  $special_name, $positioning, $comments, $operational_rating, $technological_rating, $ellak,  
                    $lab_type, $school_unit_id, $lab_source ){
    
    global $app,$entityManager;

    $Lab = new Labs();
    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"]  = $params;
      
    try {
    
//$creation infos===============================================================
        $username =  $app->request->user['uid'];
        $Lab->setCreationDate(new \DateTime (date('Y-m-d H:i:s')));  
        $Lab->setCreatedBy($username[0]);  
        $Lab->setLastUpdated(new \DateTime (date('Y-m-d H:i:s')));  
        $Lab->setUpdatedBy($username[0]); 
        $Lab->setSubmitted(0);
        $Lab->setState(null);
        
//$special_name=================================================================
        CRUDUtils::entitySetParam($Lab, $special_name, 'LabSpecialName', 'special_name', $params, false, true );
        
//$positioning==================================================================
        CRUDUtils::entitySetParam($Lab, $positioning, 'LabPositioning', 'positioning', $params, false, true );
        
//$comments=====================================================================
        CRUDUtils::entitySetParam($Lab, $comments, 'LabComments', 'comments', $params, false, true );
         
//$operational_rating===========================================================    
        if (Validator::Exists('operational_rating', $params)) { 
            if (Validator::Missing('operational_rating', $params))
                throw new Exception(ExceptionMessages::MissingLabOperationalRatingParam." : ".$operational_rating, ExceptionCodes::MissingLabOperationalRatingParam);
            else if (Validator::isNull($operational_rating))
                throw new Exception(ExceptionMessages::MissingLabOperationalRatingValue." : ".$operational_rating, ExceptionCodes::MissingLabOperationalRatingValue);
            else if (Validator::IsArray($operational_rating))
                throw new Exception(ExceptionMessages::InvalidLabOperationalRatingArray." : ".$operational_rating, ExceptionCodes::InvalidLabOperationalRatingArray);    
            else if (Validator::IsFiveStarSystem($operational_rating)) 
                 $Lab->setOperationalRating(Validator::ToFiveStarSystem($operational_rating)); 
            else
                throw new Exception(ExceptionMessages::InvalidLabOperationalRatingType." : ".$operational_rating, ExceptionCodes::InvalidLabOperationalRatingType);   
        }
        
//$technological_rating=========================================================
        if (Validator::Exists('technological_rating', $params)) { 
            if (Validator::Missing('technological_rating', $params))
                throw new Exception(ExceptionMessages::MissingLabTechnologicalRatingParam." : ".$technological_rating, ExceptionCodes::MissingLabTechnologicalRatingParam);
            else if (Validator::isNull($technological_rating))
                throw new Exception(ExceptionMessages::MissingLabTechnologicalRatingValue." : ".$technological_rating, ExceptionCodes::MissingLabTechnologicalRatingValue); 
            else if (Validator::IsArray($technological_rating))
                throw new Exception(ExceptionMessages::InvalidLabTechnologicalRatingArray." : ".$technological_rating, ExceptionCodes::InvalidLabTechnologicalRatingArray);    
            else if (Validator::IsFiveStarSystem($technological_rating)) 
                 $Lab->setTechnologicalRating(Validator::ToFiveStarSystem($technological_rating));               
            else
                throw new Exception(ExceptionMessages::InvalidLabTechnologicalRatingType." : ".$technological_rating, ExceptionCodes::InvalidLabTechnologicalRatingType);   
        }    

//$ellak========================================================================
        if (Validator::Exists('ellak', $params)) {    
            if (Validator::Missing('ellak', $params))
                throw new Exception(ExceptionMessages::MissingLabEllakParam." : ".$ellak, ExceptionCodes::MissingLabEllakParam);
            else if (Validator::isNull($ellak))
                throw new Exception(ExceptionMessages::MissingLabEllakValue." : ".$ellak, ExceptionCodes::MissingLabEllakValue); 
            else if (Validator::IsArray($ellak))
                throw new Exception(ExceptionMessages::InvalidLabEllakArray." : ".$ellak, ExceptionCodes::InvalidLabEllakArray);
            else if (Validator::IsTrue($ellak)) 
                 $Lab->setEllak(1);    
            else if (Validator::IsFalse($ellak)) 
                 $Lab->setEllak(Validator::ToFalse($ellak));       
            else
                throw new Exception(ExceptionMessages::InvalidLabEllakType." : ".$ellak, ExceptionCodes::InvalidLabEllakType); 
        }

        
        
//$lab_type=====================================================================       
        CRUDUtils::entitySetAssociation($Lab, $lab_type, 'LabTypes', 'labType', 'LabType', $params, 'lab_type');
        $fLabTypeId = $Lab->getLabType()->getLabTypeId();
        $fLabTypeName = $Lab->getLabType()->getName();

//$school_unit_id=====================================================================       
        CRUDUtils::entitySetAssociation($Lab, $school_unit_id, 'SchoolUnits', 'schoolUnit', 'SchoolUnit', $params, 'school_unit_id');
        $findSchoolUnit = $entityManager->getRepository('SchoolUnits')->findOneBy(array ('schoolUnitId'=>$school_unit_id));
        $fSchoolUnitId = $findSchoolUnit->getSchoolUnitId();
        $fSchoolUnitName = $findSchoolUnit->getName();
        $fSchoolUnitStateId = $findSchoolUnit->getState()->getStateId();

//$lab_source===================================================================      
        CRUDUtils::entitySetAssociation($Lab, $lab_source, 'LabSources', 'labSource', 'LabSource', $params, 'lab_source');

//user permisions===============================================================
         $permissions = UserRoles::getUserPermissions($app->request->user, TRUE);
               
         if (!is_array($permissions["permit_school_units"])) {  
            $permissions["permit_school_units"] = array($permissions["permit_school_units"]);                     
         };
        
         if (!in_array($Lab->getSchoolUnit()->getSchoolUnitId(), $permissions['permit_school_units'])) {
             throw new Exception(ExceptionMessages::NoPermissionToPostLab, ExceptionCodes::NoPermissionToPostLab); 
         }; 
         
//controls======================================================================
         
        //check if wrong lab type characterized as ellak
        $checkLabTypes = array(1,3); 
        if (!in_array($fLabTypeId,$checkLabTypes) && ($Lab->getEllak()== '1')){
           throw new Exception(ExceptionMessages::NotAllowedEllakValue, ExceptionCodes::NotAllowedEllakValue);  
        }
            
        //$lab_name created auto with format : "lab_type_name.number_lab - school_unit_name"===
        if ($fSchoolUnitStateId == 1){ 
            if (Validator::IsNull($fSchoolUnitId) ) 
                throw new Exception(ExceptionMessages::MissingSchoolUnitIDValue." : ".$fSchoolUnitId, ExceptionCodes::MissingSchoolUnitIDValue);
            else if (Validator::IsNull($fLabTypeId))
                throw new Exception(ExceptionMessages::MissingLabTypeIDValue." : ".$fLabTypeId, ExceptionCodes::MissingLabTypeIDValue);
            else {
                //find count lab types of school unit===========================
                $checkCountLabs = $entityManager->getRepository('Labs')->findBy(array( 'schoolUnit'    => $Lab->getSchoolUnit(),
                                                                                       'labType'       => $Lab->getLabType()   
                                                                                     )); 
                //get the last num of lab
                $all_nums = array();
                foreach ($checkCountLabs as $checkCountLab){
                    $lab_num = explode(".",$checkCountLab->getName());
                    $matches = explode(" -",$lab_num[1]);
                    $all_nums[] = $matches[0];
                    
                }  
                            
                //create lab name                
                if (validator::IsEmptyArray($all_nums)){$all_nums[]=0;}
                $max_lab= max($all_nums);
                $lab_name = 'ΑΡΧΙΚΟ - ' . $fLabTypeName. '.' . ++$max_lab . ' - ' . $fSchoolUnitName;
   
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
                       
 //insert to db=================================================================
         
         $entityManager->persist($Lab);
         $entityManager->flush($Lab);
         $result["lab_id"] = $fLabId = $Lab->getLabId();
        
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