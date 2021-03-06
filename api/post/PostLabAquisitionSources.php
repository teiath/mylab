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
* 
* 
* @SWG\Resource(
* apiVersion=API_VERSION,
* swaggerVersion=SWAGGER_VERSION,
* basePath=BASE_PATH,
* resourcePath="/lab_aquisition_sources",
* description="Διατάξεις Η/Υ με Πηγές Χρηματοδότησης",
* produces="['application/json']",
* @SWG\Api(
*   path="/lab_aquisition_sources",
*   @SWG\Operation(
*                   method="POST",
*                   summary="Εισαγωγή Διάταξης Η/Υ με Πηγή Χρηματοδότησης",
*                   notes="Εισαγωγή Διάταξης Η/Υ με Πηγή Χρηματοδότησης",
*                   type="postLabAquisitionSources",
*                   nickname="PostLabAquisitionSources",
* 
*   @SWG\Parameter( name="lab_id", description="ID Διάταξης Η/Υ [notNull]", required=true, type="integer", paramType="query" ),
*   @SWG\Parameter( name="aquisition_source", description="Όνομα ή ID Πηγής Χρηματοδότησης [notNull]", required=true, type="mixed(string|integer)", paramType="query" ),
*   @SWG\Parameter( name="aquisition_year", description="Έτος Απόκτησης της Πηγής Χρηματοδότησης για την Διάταξη Η/Υ (μορφή ημερομηνίας yyyy ή null)", required=true, type="string", format="date", paramType="query" ),
*   @SWG\Parameter( name="aquisition_comments", description="Σχόλια για την Πηγή Χρηματοδότησης", required=false, type="string", paramType="query" ),
*   
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToPostLab, message=ExceptionMessages::NoPermissionToPostLab),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabParam, message=ExceptionMessages::MissingLabParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabValue, message=ExceptionMessages::MissingLabValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabValue, message=ExceptionMessages::InvalidLabValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabType, message=ExceptionMessages::InvalidLabType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateLabUniqueValue, message=ExceptionMessages::DuplicateLabUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingAquisitionSourceParam, message=ExceptionMessages::MissingAquisitionSourceParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingAquisitionSourceValue, message=ExceptionMessages::MissingAquisitionSourceValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidAquisitionSourceValue, message=ExceptionMessages::InvalidAquisitionSourceValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidAquisitionSourceType, message=ExceptionMessages::InvalidAquisitionSourceType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateAquisitionSourceUniqueValue, message=ExceptionMessages::DuplicateAquisitionSourceUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabAquisitionSourceYearParam, message=ExceptionMessages::MissingLabAquisitionSourceYearParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabAquisitionSourceYearValue, message=ExceptionMessages::MissingLabAquisitionSourceYearValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabAquisitionSourceYearArray, message=ExceptionMessages::InvalidLabAquisitionSourceYearArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabAquisitionSourceYearValidType, message=ExceptionMessages::InvalidLabAquisitionSourceYearValidType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabAquisitionSourceYearType, message=ExceptionMessages::InvalidLabAquisitionSourceYearType),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabAquisitionSourceCommentsParam, message=ExceptionMessages::MissingLabAquisitionSourceCommentsParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabAquisitionSourceCommentsValue, message=ExceptionMessages::MissingLabAquisitionSourceCommentsValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabAquisitionSourceCommentsType, message=ExceptionMessages::InvalidLabAquisitionSourceCommentsType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicatedLabAquisitionSourceValue, message=ExceptionMessages::DuplicatedLabAquisitionSourceValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="postLabAquisitionSources",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="parameters",type="array",description="Οι παράμετροι που δίνει ο χρήστης" ),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="lab_aquisition_source_id",type="integer",description="Ο κωδικός ID της εγγραφής στην οποία πραγματοποιήθηκε εισαγωγή δεδομένων.")
* )
* 
*/

function PostLabAquisitionSources($lab_id, $aquisition_source, $aquisition_year, $aquisition_comments) {
    
    global $app,$entityManager;

    $LabAquisitionSources = new LabAquisitionSources();
    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"]  = $params;
    
    try
    {
    
//$lab_id=======================================================================       
        CRUDUtils::entitySetAssociation($LabAquisitionSources, $lab_id, 'Labs', 'lab', 'Lab', $params, 'lab_id');
        
//$aquisition_source============================================================       
        CRUDUtils::entitySetAssociation($LabAquisitionSources, $aquisition_source, 'AquisitionSources', 'aquisitionSource', 'AquisitionSource', $params, 'aquisition_source');
        
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
        CRUDUtils::entitySetParam($LabAquisitionSources, $aquisition_comments, 'LabAquisitionSourceComments', 'aquisition_comments', $params, false, true );
        
//user permisions===============================================================
         $permissions = CheckUserPermissions::getUserPermissions($app->request->user);
         
         if (!in_array($LabAquisitionSources->getLab()->getLabId(), $permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToPostLab, ExceptionCodes::NoPermissionToPostLab); 
         }; 
 
//controls======================================================================  

        //check duplicates======================================================        
        $checkDuplicate = $entityManager->getRepository('LabAquisitionSources')->findOneBy(array(   'lab'               => $LabAquisitionSources->getLab(),
                                                                                                    'aquisitionSource'  => $LabAquisitionSources->getAquisitionSource(),
                                                                                                    'aquisitionYear'    => $LabAquisitionSources->getAquisitionYear(),
                                                                                                    'aquisitionComments'    => $LabAquisitionSources->getAquisitionComments()
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