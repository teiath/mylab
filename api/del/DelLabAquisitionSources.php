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
*                   method="DELETE",
*                   summary="Διαγραφή Διάταξης Η/Υ με Πηγή Χρηματοδότησης",
*                   notes="Διαγραφή Διάταξης Η/Υ με Πηγή Χρηματοδότησης",
*                   type="delLabAquisitionSources",
*                   nickname="DelLabAquisitionSources",
*
*   @SWG\Parameter( name="lab_id", description="ID Διάταξης Η/Υ [notNull]", required=true, type="integer", paramType="query" ), 
*   @SWG\Parameter( name="lab_aquisition_source_id", description="ID Διάταξης Η/Υ με Πηγή Χρηματοδότησης [notNull]", required=true, type="integer", paramType="query" ),
*
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToDeleteLab, message=ExceptionMessages::NoPermissionToDeleteLab),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabIDParam, message=ExceptionMessages::MissingLabIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabIDValue, message=ExceptionMessages::MissingLabIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabIDType, message=ExceptionMessages::InvalidLabIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabIDArray, message=ExceptionMessages::InvalidLabIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabAquisitionSourceIDParam, message=ExceptionMessages::MissingLabAquisitionSourceIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabAquisitionSourceIDValue, message=ExceptionMessages::MissingLabAquisitionSourceIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabAquisitionSourceIDType, message=ExceptionMessages::InvalidLabAquisitionSourceIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabAquisitionSourceIDArray, message=ExceptionMessages::InvalidLabAquisitionSourceIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::NotFoundDelLabAquisitionSourceValue, message=ExceptionMessages::NotFoundDelLabAquisitionSourceValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateDelLabAquisitionSourceValue, message=ExceptionMessages::DuplicateDelLabAquisitionSourceValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="delLabAquisitionSources",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="parameters",type="array",description="Οι παράμετροι που δίνει ο χρήστης" ),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης")
* )
* 
*/

function DelLabAquisitionSources($lab_id, $lab_aquisition_source_id) {
    
    global $app,$entityManager;

    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"] = $params;
    
    try {
 
//$lab_id=======================================================================             
        $fLabID = CRUDUtils::checkIDParam('lab_id', $params, $lab_id, 'LabID');
        
//$lab_aquisition_source_id=====================================================      
        $fLabAquisitionSourceID = CRUDUtils::checkIDParam('lab_aquisition_source_id', $params, $lab_aquisition_source_id, 'LabAquisitionSourceID');

//user permisions===============================================================
         $permissions = CheckUserPermissions::getUserPermissions($app->request->user);
         
         if (!in_array($fLabID, $permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToDeleteLab, ExceptionCodes::NoPermissionToDeleteLab); 
         }; 
        
//controls======================================================================  

        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('LabAquisitionSources')->findBy(array( 'lab'                    => $fLabID,
                                                                                      'labAquisitionSourceId'  => $fLabAquisitionSourceID
                                                                                    ));

        $countLabAquisitionSources = count($check); 
        
        if ($countLabAquisitionSources == 1)
            //set entity for delete row
            $LabAquisitionSources= $entityManager->find('LabAquisitionSources', $fLabAquisitionSourceID);
        else if ($countLabAquisitionSources == 0)
            throw new Exception(ExceptionMessages::NotFoundDelLabAquisitionSourceValue." : ".$fLabID." - ".$fLabAquisitionSourceID,ExceptionCodes::NotFoundDelLabAquisitionSourceValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelLabAquisitionSourceValue." : ".$fLabID." - ".$fLabAquisitionSourceID,ExceptionCodes::DuplicateDelLabAquisitionSourceValue);
      
//delete from db================================================================
         
        $entityManager->remove($LabAquisitionSources);
        $entityManager->flush($LabAquisitionSources);
           
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