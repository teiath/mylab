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
* resourcePath="/aquisition_sources",
* description="Λεξικό : Τύποι Πηγών Χρηματοδότησης",
* produces="['application/json']",
* @SWG\Api(
*   path="/aquisition_sources",
*   @SWG\Operation(
*                   method="DELETE",
*                   summary="Διαγραφή Τύπoυ Πηγής Χρηματοδότησης",
*                   notes="Διαγραφή Τύπου Πηγής Χρηματοδότησης",
*                   type="delAquisitionSources",
*                   nickname="DelAquisitionSources",
*   @SWG\Parameter(
*                   name="aquisition_source_id",
*                   description="ID Πηγής Χρηματοδότησης",
*                   required=true,
*                   type="integer",
*                   paramType="query"
*   ),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToDeleteLab, message=ExceptionMessages::NoPermissionToDeleteLab),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingAquisitionSourceIDParam, message=ExceptionMessages::MissingAquisitionSourceIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingAquisitionSourceIDValue, message=ExceptionMessages::MissingAquisitionSourceIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidAquisitionSourceIDType, message=ExceptionMessages::InvalidAquisitionSourceIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidAquisitionSourceIDArray, message=ExceptionMessages::InvalidAquisitionSourceIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::NotFoundDelAquisitionSourceValue, message=ExceptionMessages::NotFoundDelAquisitionSourceValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateDelAquisitionSourceValue, message=ExceptionMessages::DuplicateDelAquisitionSourceValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::ReferencesAquisitionSourceLabAquisitionSources, message=ExceptionMessages::ReferencesAquisitionSourceLabAquisitionSources),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="delAquisitionSources",
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

function DelAquisitionSources($aquisition_source_id) {

    global $app,$entityManager,$Options;

    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"] = $params;

 try {

//user permisions===============================================================
    if (!($app->request->user['uid'][0] == $Options["UserAllCRUDPermissions"]))
        throw new Exception(ExceptionMessages::NoPermissionToDeleteData, ExceptionCodes::NoPermissionToDeleteData);
        
//$aquisition_source_id=========================================================
        $fAquisitionSourceID = CRUDUtils::checkIDParam('aquisition_source_id', $params, $aquisition_source_id, 'AquisitionSourceID');

//controls======================================================================          
        
        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('AquisitionSources')->findBy(array( 'aquisitionSourceId' => $fAquisitionSourceID ));
        $count= count($check);
 
        if ($count == 1)
            $AquisitionSources = $entityManager->find('AquisitionSources', $fAquisitionSourceID);
        else if ($count == 0)
            throw new Exception(ExceptionMessages::NotFoundDelAquisitionSourceValue." : ".$fAquisitionSourceID ,ExceptionCodes::NotFoundDelAquisitionSourceValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelAquisitionSourceValue." : ".$fAquisitionSourceID ,ExceptionCodes::DuplicateDelAquisitionSourceValue);
        
        //check for references =================================================   
        $checkReference = $entityManager->getRepository('LabAquisitionSources')->findOneBy(array( 'aquisitionSource'  => $fAquisitionSourceID ));

        if (count($checkReference) != 0)
            throw new Exception(ExceptionMessages::ReferencesAquisitionSourceLabAquisitionSources. $fAquisitionSourceID,ExceptionCodes::ReferencesAquisitionSourceLabAquisitionSources);  
        
//delete from db================================================================
        $entityManager->remove($AquisitionSources);
        $entityManager->flush($AquisitionSources);
           
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