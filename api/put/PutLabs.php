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
* resourcePath="/labs",
* description="Διατάξεις Η/Υ",
* produces="['application/json']",
* @SWG\Api(
*   path="/labs",
*   @SWG\Operation(
*                   method="PUT",
*                   summary="Ενημέρωση Διάταξης Η/Υ",
*                   notes="Ενημέρωση Διάταξης Η/Υ",
*                   type="putLabs",
*                   nickname="PutLabs",
* 
*   @SWG\Parameter( name="lab_id", description="ID Διάταξης Η/Υ [notNull]", required=true, type="integer", paramType="query" ),
*   @SWG\Parameter( name="positioning", description="Τοποθεσία Διάταξης Η/Υ", required=false, type="string", paramType="query"),
*   @SWG\Parameter( name="comments", description="Σχόλια Διάταξης Η/Υ", required=false, type="string", paramType="query"),
*   @SWG\Parameter( name="operational_rating", description="Βαθμολογία Λειτουργικής Κατάστασης Διάταξης Η/Υ [notNull](1=αρνητική - 5=θετική)", required=false, type="integer", paramType="query"),
*   @SWG\Parameter( name="technological_rating", description="Βαθμολογία Τεχνολογικής Κατάστασης Διάταξης Η/Υ [notNull](1=αρνητική - 5=θετική)", required=false, type="integer", paramType="query"),
*   @SWG\Parameter( name="ellak", description="Χρήση ΕΛΛΑΚ στην Διάταξη Η/Υ [notNull](true=ΕΛΛΑΚ, false=ΟΧΙ ΕΛΛΑΚ)", required=true, type="boolean", paramType="query" ),
* 
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToPutLab, message=ExceptionMessages::NoPermissionToPutLab),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabIDParam, message=ExceptionMessages::MissingLabIDParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabIDValue, message=ExceptionMessages::MissingLabIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabIDType, message=ExceptionMessages::InvalidLabIDType),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabIDArray, message=ExceptionMessages::InvalidLabIDArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabValue, message=ExceptionMessages::InvalidLabValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateLabUniqueValue, message=ExceptionMessages::DuplicateLabUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabSpecialNameParam, message=ExceptionMessages::MissingLabSpecialNameParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabSpecialNameValue, message=ExceptionMessages::MissingLabSpecialNameValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabSpecialNameType, message=ExceptionMessages::InvalidLabSpecialNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabPositioningParam, message=ExceptionMessages::MissingLabPositioningParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabPositioningValue, message=ExceptionMessages::MissingLabPositioningValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabPositioningType, message=ExceptionMessages::InvalidLabPositioningType),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabCommentsParam, message=ExceptionMessages::MissingLabCommentsParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabCommentsValue, message=ExceptionMessages::MissingLabCommentsValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabCommentsType, message=ExceptionMessages::InvalidLabCommentsType),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabOperationalRatingParam, message=ExceptionMessages::MissingLabOperationalRatingParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabOperationalRatingValue, message=ExceptionMessages::MissingLabOperationalRatingValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabOperationalRatingArray, message=ExceptionMessages::InvalidLabOperationalRatingArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabOperationalRatingType, message=ExceptionMessages::InvalidLabOperationalRatingType),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTechnologicalRatingParam, message=ExceptionMessages::MissingLabTechnologicalRatingParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTechnologicalRatingValue, message=ExceptionMessages::MissingLabTechnologicalRatingValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTechnologicalRatingArray, message=ExceptionMessages::InvalidLabTechnologicalRatingArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTechnologicalRatingType, message=ExceptionMessages::InvalidLabTechnologicalRatingType),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabEllakParam, message=ExceptionMessages::MissingLabEllakParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabEllakValue, message=ExceptionMessages::MissingLabEllakValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabEllakArray, message=ExceptionMessages::InvalidLabEllakArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabEllakType, message=ExceptionMessages::InvalidLabEllakType), 
*   @SWG\ResponseMessage(code=ExceptionCodes::NotAllowedEllakValue, message=ExceptionMessages::NotAllowedEllakValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="putLabs",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="parameters",type="array",description="Οι παράμετροι που δίνει ο χρήστης" ),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="lab_id",type="integer",description="Ο κωδικός ID της εγγραφής στην οποία πραγματοποιήθηκε ενημέρωση δεδομένων.")
* )
* 
*/

function PutLabs($lab_id, $special_name, $positioning, $comments, $operational_rating, $technological_rating, $ellak ) {
    
    global $app,$entityManager;

    $result = array();
    
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $result["parameters"] = $params;
       
    try {
        
//$lab_id=======================================================================    
        $fLabId = CRUDUtils::checkIDParam('lab_id', $params, $lab_id, 'LabID');
       
//init entity for update row====================================================
        $Lab = CRUDUtils::findIDParam($fLabId, 'Labs', 'Lab'); 

//$updated infos================================================================
        $username =  $app->request->user['uid'];
        $Lab->setLastUpdated(new \DateTime (date('Y-m-d H:i:s')));  
        $Lab->setUpdatedBy($username[0]);  
        
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
             throw new Exception(ExceptionMessages::NoPermissionToPutLab, ExceptionCodes::NoPermissionToPutLab); 
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