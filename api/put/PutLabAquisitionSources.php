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
 * @global type $db
 * @global type $app
 * @param type $lab_aquisition_source_id
 * @param type $lab_id
 * @param type $aquisition_source
 * @param type $aquisition_year
 * @param type $aquisition_comments
 * @return string
 * @throws Exception
 */

function PutLabAquisitionSources($lab_aquisition_source_id, $lab_id, $aquisition_source, $aquisition_year, $aquisition_comments) {
    
    global $app,$entityManager;

    $result = array();
    
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = json_decode($app->request()->getBody());
    $params = loadParameters();
   
    try {
        
//$lab_aquisition_source_id=====================================================    
        $fLabAquisitionSourceId = CRUDUtils::checkIDParam('lab_aquisition_source_id', $params, $lab_aquisition_source_id, 'LabAquisitionSourceID');
       
//init entity for update row====================================================
        $LabAquisitionSources = CRUDUtils::findIDParam($fLabAquisitionSourceId, 'LabAquisitionSources', 'LabAquisitionSource');
        
//$lab_id=======================================================================
        if ( Validator::IsExists('lab_id') ){
            CRUDUtils::entitySetAssociation($LabAquisitionSources, $lab_id, 'Labs', 'lab', 'Lab');
        } else if ( Validator::IsNull($LabAquisitionSources->getLab()) ){
            throw new Exception(ExceptionMessages::MissingLabValue." : ".$lab_id, ExceptionCodes::MissingLabValue);
        } 
      
//$aquisition_source============================================================       
        if ( Validator::IsExists('aquisition_source') ){
            CRUDUtils::entitySetAssociation($LabAquisitionSources, $aquisition_source, 'AquisitionSources', 'aquisitionSource', 'AquisitionSource');
        } else if ( Validator::IsNull($LabAquisitionSources->getAquisitionSource()) ){
            throw new Exception(ExceptionMessages::MissingAquisitionSourceValue." : ".$aquisition_source, ExceptionCodes::MissingAquisitionSourceValue);
        } 
        
//$aquisition_year===============================================================
        if (Validator::IsExists('aquisition_year')){
            
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
               
        } else if ( Validator::IsNull($LabAquisitionSources->getAquisitionYear()) ){
            throw new Exception(ExceptionMessages::MissingLabAquisitionSourceYearValue." : ".$aquisition_source, ExceptionCodes::MissingLabAquisitionSourceYearValue);
        } 

//$aquisition_comments==========================================================
        CRUDUtils::entitySetParam($LabAquisitionSources, $aquisition_comments, 'LabAquisitionSourceComments', 'aquisition_comments', $params, false, true );

//user permisions===============================================================
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array($LabAquisitionSources->getLab()->getLabId(), $permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToPostLab, ExceptionCodes::NoPermissionToPostLab); 
         }; 
         
//controls======================================================================  

        //check duplicates======================================================           
        $checkDuplicate = $entityManager->getRepository('LabAquisitionSources')->findOneBy(array( 'lab'               => $LabAquisitionSources->getLab(),
                                                                                                  'aquisitionSource'  => $LabAquisitionSources->getAquisitionSource(),
                                                                                                  'aquisitionYear'    => $LabAquisitionSources->getAquisitionYear(),
                                                                                                  'aquisitionComments'    => $LabAquisitionSources->getAquisitionComments()
                                                                                                ));

        if (!Validator::isNull($checkDuplicate)){
            throw new Exception(ExceptionMessages::DuplicatedLabAquisitionSourceValue ,ExceptionCodes::DuplicatedLabAquisitionSourceValue);
        }    
    
//update to db==================================================================
         
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