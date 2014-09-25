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
 * @param type $special_name
 * @param type $positioning
 * @param type $comments
 * @param type $operational_rating
 * @param type $technological_rating
 * @param type $ellak
 * @return string
 * @throws Exception
 */

function PutLabs($lab_id, $special_name, $positioning, $comments, $operational_rating, $technological_rating, $ellak ) {
    
    global $app,$entityManager;

    $result = array();
    
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = json_decode($app->request()->getBody());
    $params = loadParameters();
       
    try {
        
//$lab_id=====================================================    
        $fLabId = CRUDUtils::checkIDParam('lab_id', $params, $lab_id, 'LabID');
       
//init entity for update row====================================================
        $Lab = CRUDUtils::findIDParam($fLabId, 'Labs', 'Lab'); 

//$updated infos================================================================
        $username =  $app->request->user['uid'];
        $Lab->setLastUpdated(new \DateTime (date('Y-m-d H:i:s')));  
        $Lab->setUpdatedBy($username[0]);  
        
//$special_name==================================================================
        CRUDUtils::entitySetParam($Lab, $special_name, ExceptionMessages::InvalidLabSpecialNameType, 'specialName');
        
//$positioning==================================================================
        CRUDUtils::entitySetParam($Lab, $positioning, ExceptionMessages::InvalidLabSpecialNameType, 'positioning');
        
//$comments=====================================================================
        CRUDUtils::entitySetParam($Lab, $comments, ExceptionMessages::InvalidLabCommentsType, 'comments');
         
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
        if (Validator::Exists('operational_rating', $params)) { 
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

//user permisions===============================================================
        
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array($Lab->getLabId(),$permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToPostLab, ExceptionCodes::NoPermissionToPostLab); 
         }; 
    
//controls======================================================================  

        //check if wrong lab type characterized as ellak 
        $checkLabTypes = array(1,3); 
        if ( !in_array($Lab->getLabType()->getLabTypeId(),$checkLabTypes) && ($Lab->getEllak()== '1')){
           throw new Exception(ExceptionMessages::NotAllowedEllakValue, ExceptionCodes::NotAllowedEllakValue);  
        }
         
        //check duplicates======================================================           
//        $checkDuplicate = $entityManager->getRepository('Labs')->findOneBy(array( 
//                                                                                  'schoolUnit'  => $Lab->getSchoolUnit(),
//                                                                                  'name'        => $Lab->getName(),
//                                                                                  'specialName' => $Lab->getSpecialName(),
//                                                                                  'comments'    => $Lab->getComments(),
//                                                                                  'positioning' => $Lab->getPositioning(),
//                                                                                  'operationalRating'   => $Lab->getOperationalRating(),
//                                                                                  'technologicalRating' => $Lab->getTechnologicalRating(),
//                                                                                  'ellak'               => $Lab->getEllak()
//                                                                                 ));
//
//        if (!Validator::isNull($checkDuplicate)){
//            throw new Exception(ExceptionMessages::DuplicatedLabValue,ExceptionCodes::DuplicatedLabValue);
//        }   
        
    
//update to db==================================================================
         
           $entityManager->persist($Lab);
           $entityManager->flush($Lab);
       
           $result["lab_id"] = $Lab->getLabId();

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