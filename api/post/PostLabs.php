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
*                   method="POST",
*                   summary="Εισαγωγή Διάταξης Η/Υ",
*                   notes="Εισαγωγή Διάταξης Η/Υ",
*                   type="postLabs",
*                   nickname="PostLabs",
* 
*   @SWG\Parameter( name="special_name", description="Προσωνύμιο Διάταξης Η/Υ", required=false, type="string", paramType="query" ),
*   @SWG\Parameter( name="positioning", description="Τοποθεσία Διάταξης Η/Υ", required=false, type="string", paramType="query"),
*   @SWG\Parameter( name="comments", description="Σχόλια Διάταξης Η/Υ", required=false, type="string", paramType="query"),
*   @SWG\Parameter( name="operational_rating", description="Βαθμολογία Λειτουργικής Κατάστασης Διάταξης Η/Υ [notNull](1=αρνητική - 5=θετική)", required=false, type="integer", paramType="query"),
*   @SWG\Parameter( name="technological_rating", description="Βαθμολογία Τεχνολογικής Κατάστασης Διάταξης Η/Υ [notNull](1=αρνητική - 5=θετική)", required=false, type="integer", paramType="query"),
*   @SWG\Parameter( name="ellak", description="Χρήση ΕΛΛΑΚ στην Διάταξη Η/Υ [notNull](true=ΕΛΛΑΚ, false=ΟΧΙ ΕΛΛΑΚ)", required=true, type="boolean", paramType="query" ),
*   @SWG\Parameter( name="lab_type", description="Όνομα ή ID Τύπου Διάταξης Η/Υ [notNull]", required=true, type="mixed(string|integer)", paramType="query" ),
*   @SWG\Parameter( name="school_unit_id", description="ID Σχολικής Μονάδας [notNull]", required=true, type="integer", paramType="query" ),
*   @SWG\Parameter( name="lab_source", description="Όνομα ή ID Πρωτογενής Πηγής Δεδομένων Διάταξης Η/Υ [notNull]", required=true, type="mixed(string|integer)", paramType="query" ),
*  
*   @SWG\ResponseMessage(code=ExceptionCodes::NoPermissionToPostLab, message=ExceptionMessages::NoPermissionToPostLab),
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
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTypeParam, message=ExceptionMessages::MissingLabTypeParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTypeValue, message=ExceptionMessages::MissingLabTypeValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTypeValue, message=ExceptionMessages::InvalidLabTypeValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabTypeType, message=ExceptionMessages::InvalidLabTypeType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateLabTypeUniqueValue, message=ExceptionMessages::DuplicateLabTypeUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingSchoolUnitParam, message=ExceptionMessages::MissingSchoolUnitParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingSchoolUnitValue, message=ExceptionMessages::MissingSchoolUnitValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitValue, message=ExceptionMessages::InvalidSchoolUnitValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidSchoolUnitType, message=ExceptionMessages::InvalidSchoolUnitType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateSchoolUnitUniqueValue, message=ExceptionMessages::DuplicateSchoolUnitUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabSourceParam, message=ExceptionMessages::MissingLabSourceParam),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabSourceValue, message=ExceptionMessages::MissingLabSourceValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabSourceValue, message=ExceptionMessages::InvalidLabSourceValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabSourceType, message=ExceptionMessages::InvalidLabSourceType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicateLabSourceUniqueValue, message=ExceptionMessages::DuplicateLabSourceUniqueValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NotAllowedEllakValue, message=ExceptionMessages::NotAllowedEllakValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingSchoolUnitIDValue, message=ExceptionMessages::MissingSchoolUnitIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabTypeIDValue, message=ExceptionMessages::MissingLabTypeIDValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::MissingLabNameValue, message=ExceptionMessages::MissingLabNameValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabNameArray, message=ExceptionMessages::InvalidLabNameArray),
*   @SWG\ResponseMessage(code=ExceptionCodes::InvalidLabNameType, message=ExceptionMessages::InvalidLabNameType),
*   @SWG\ResponseMessage(code=ExceptionCodes::DuplicatedLabNameValue, message=ExceptionMessages::DuplicatedLabNameValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NotAllowedLabNameValue, message=ExceptionMessages::NotAllowedLabNameValue),
*   @SWG\ResponseMessage(code=ExceptionCodes::NoErrors, message=ExceptionMessages::NoErrors)
*  )
* )
* )
* 
* @SWG\Model(
* id="postLabs",
* description="Παρακάτω εμφανίζεται το λεξικό σε μορφή JSON και πληροφορίες για την κλήση της συνάρτησης ",
* @SWG\Property(name="controller",type="string",description="Ο controller που χρησιμοποιείται"),
* @SWG\Property(name="function",type="string",description="Η συνάρτηση που υλοποιείται από το σύστημα"),
* @SWG\Property(name="method",type="string",description="Η μέθοδος κλήσης της συνάρτησης"),
* @SWG\Property(name="parameters",type="array",description="Οι παράμετροι που δίνει ο χρήστης" ),
* @SWG\Property(name="status",type="string",description="Ο Κωδικός του αποτελέσματος της κλήσης"),
* @SWG\Property(name="message",type="string",description="Το Μήνυμα του αποτελέσματος της κλήσης"),
* @SWG\Property(name="lab_id",type="integer",description="Ο κωδικός ID της εγγραφής στην οποία πραγματοποιήθηκε εισαγωγή δεδομένων.")
* )
* 
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