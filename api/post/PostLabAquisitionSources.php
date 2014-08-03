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
 * @param type $aquisition_source
 * @param type $aquisition_year
 * @param type $aquisition_comments
 * @return string
 * @throws Exception
 */

function PostLabAquisitionSources($lab_id, $aquisition_source, $aquisition_year, $aquisition_comments) {
    
    global $app,$entityManager;

    $LabAquisitionSources = new LabAquisitionSources();
    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = $app->request()->getBody();
    $params = loadParameters();
    
    try
    {
    
//$lab_id=======================================================================       
        CRUDUtils::entitySetAssociation($LabAquisitionSources, $lab_id, 'Labs', 'lab', 'Lab');
        
//$aquisition_source============================================================       
        CRUDUtils::entitySetAssociation($LabAquisitionSources, $aquisition_source, 'AquisitionSources', 'aquisitionSource', 'AquisitionSource');

//aquisition_year===============================================================
        if (Validator::Missing('aquisition_year', $params))
            throw new Exception(ExceptionMessages::MissingLabAquisitionSourceYearParam." : ".$aquisition_year, ExceptionCodes::MissingLabAquisitionSourceYearParam);          
        else if (Validator::IsNull($aquisition_year))
            throw new Exception(ExceptionMessages::MissingLabAquisitionSourceYearValue." : ".$aquisition_year, ExceptionCodes::MissingLabAquisitionSourceYearValue);                           
        else if (Validator::IsArray($aquisition_year))
             throw new Exception(ExceptionMessages::InvalidLabAquisitionSourceYearArray." : ".$aquisition_year, ExceptionCodes::InvalidLabAquisitionSourceYearArray); 
        else if (! Validator::IsValidYear($aquisition_year) )
             throw new Exception(ExceptionMessages::InvalidLabAquisitionSourceYearValidType." : ".$aquisition_year, ExceptionCodes::InvalidLabAquisitionSourceYearValidType); 
        else if (Validator::IsYear($aquisition_year))
            //$aquisition_year = new \DateTime($aquisition_year);
            $LabAquisitionSources->setAquisitionYear(Validator::ToYear($aquisition_year));
        else 
            throw new Exception(ExceptionMessages::InvalidLabAquisitionSourceYearType." : ".$aquisition_year, ExceptionCodes::InvalidLabAquisitionSourceYearType);      
//$aquisition_comments==========================================================
        CRUDUtils::entitySetParam($LabAquisitionSources, $aquisition_comments, ExceptionMessages::InvalidLabAquisitionSourceCommentsType, 'aquisitionComments');  

//user permisions===============================================================
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array(validator::ToID($lab_id),$permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToPostLab, ExceptionCodes::NoPermissionToPostLab); 
         }; 
 
//controls======================================================================  

        //check duplicates======================================================        
        $checkDuplicate = $entityManager->getRepository('LabAquisitionSources')->findOneBy(array(   'lab'               => Validator::toID($lab_id),
                                                                                                    'aquisitionSource'  => Validator::toID($aquisition_source),
                                                                                                    'aquisitionYear'    => Validator::toID($aquisition_year),
                                                                                                ));

        if (!Validator::isNull($checkDuplicate)){
            throw new Exception(ExceptionMessages::DuplicatedLabAquisitionSourceValue ,ExceptionCodes::DuplicatedLabAquisitionSourceValue);
        }    
        
//insert to db==================================================================
         
           $entityManager->persist($LabAquisitionSources);
           $entityManager->flush($LabAquisitionSources);
       
           $result["lab_aquisition_source_id"] = $LabAquisitionSources->getLabAquisitionSourceId();
            
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