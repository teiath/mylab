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
* resourcePath="/initial_labs",
* description="Επικύρωση Διαταξης Η/Υ",
* produces="['application/json']",
* @SWG\Api(
*   path="/initial_labs",
*   @SWG\Operation(
*                   method="DELETE",
*                   summary="Διαγραφή Διάταξης Η/Υ",
*                   notes="Διαγραφή Διάταξης Η/Υ. Χρησιμοποιείται για να επικυρώσει την ΔΙΑΓΡΑΦΗ ΔΟΚΙΜΣΤΙΚΗΣ Διαταξης Η/Υ",
*                   type="delInitialLabs",
*                   nickname="DelInitialLabs",
*
*   @SWG\Parameter( name="lab_id", description="ID Διάταξης Η/Υ [notNull]", required=true, type="integer", paramType="query" ), 
*
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToDeleteLab, message=ExceptionMessages::NoPermissionToDeleteLab),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabIDParam, message=ExceptionMessages::MissingLabIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabIDValue, message=ExceptionMessages::MissingLabIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabIDType, message=ExceptionMessages::InvalidLabIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabIDArray, message=ExceptionMessages::InvalidLabIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::NotFoundDelLabValue, message=ExceptionMessages::NotFoundDelLabValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateDelLabValue, message=ExceptionMessages::DuplicateDelLabValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoDemoDelLabValue, message=ExceptionMessages::NoDemoDelLabValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="delInitialLabs",
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

function DelInitialLabs($lab_id) {

    global $app,$entityManager;

    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"] = $params;
    
    try
    {
      
//$lab_id=======================================================================
        $fLabID = CRUDUtils::checkIDParam('lab_id', $params, $lab_id, 'LabID');
            
//user permisions===============================================================
         $permissions = CheckUserPermissions::getUserPermissions($app->request->user);

         if (!in_array($fLabID, $permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToDeleteLab, ExceptionCodes::NoPermissionToDeleteLab); 
         };  

//controls======================================================================  

        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('Labs')->findBy(array( 'labId' => $fLabID ));
        $countLabRelations = count($check);

        if ($countLabRelations == 1)
            //set entity for delete row
            $Labs = $entityManager->find('Labs', $fLabID);
        else if ($countLabRelations == 0)
            throw new Exception(ExceptionMessages::NotFoundDelLabValue." : ".$fLabID ,ExceptionCodes::NotFoundDelLabValue);
        else 
            throw new Exception(ExceptionMessages::NotFoundDelLabValue." : ".$fLabID ,ExceptionCodes::NotFoundDelLabValue);
  
        //check if lab has submitted value = 1 and restrict deletion
        if ($Labs->getSubmitted() == true){
            throw new Exception(ExceptionMessages::NoDemoDelLabValue." : ".$fLabID ,ExceptionCodes::NoDemoDelLabValue);
        }
        
       //check for lab references
        
        $checkLabAquisitionSources = $entityManager->getRepository('LabAquisitionSources')->findBy(array( 'lab' => $fLabID ));
        if (count($checkLabAquisitionSources)!== 0){
            foreach ($checkLabAquisitionSources as $checkLabAquisitionSource){
            $entityManager->remove($checkLabAquisitionSource);
            $entityManager->flush($checkLabAquisitionSource);
            }
        }

        $checkLabEquipmentTypes = $entityManager->getRepository('LabEquipmentTypes')->findBy(array( 'lab' => $fLabID ));
        if (count($checkLabEquipmentTypes) !== 0){
            foreach ($checkLabEquipmentTypes as $checkLabEquipmentType){
            $entityManager->remove($checkLabEquipmentType);
            $entityManager->flush($checkLabEquipmentType);
            }
        }

        $checkLabRelations = $entityManager->getRepository('LabRelations')->findBy(array( 'lab' => $fLabID ));
        if (count($checkLabRelations) !== 0){
            foreach ($checkLabRelations as $checkLabRelation){
            $entityManager->remove($checkLabRelation);
            $entityManager->flush($checkLabRelation);
            }
        }
        
//        $checkLabWorkers = $entityManager->getRepository('LabWorkers')->findBy(array( 'lab' => $fLabID ));
//        if (count($checkLabWorkers) !== 0){
//               throw new Exception(ExceptionMessages::ReferencesLabWorkers." : ".$fLabID ,ExceptionCodes::ReferencesLabWorkers);
//        }
//        
//        $checkLabTransitions = $entityManager->getRepository('LabTransitions')->findBy(array( 'lab' => $fLabID ));
//        if (count($checkLabTransitions) !== 0){
//               throw new Exception(ExceptionMessages::ReferencesLabTransitions." : ".$fLabID ,ExceptionCodes::ReferencesLabTransitions);
//        }

//delete from db================================================================
   
        $entityManager->remove($Labs);
        $entityManager->flush($Labs);
           
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