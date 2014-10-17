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
 * @param type $lab_id
 * @param type $lab_relation_id
 * @return string
 * @throws Exception
 */


function DelLabTransitions($lab_id, $lab_transition_id) {

    global $app,$entityManager;

    $result = array();

    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $result["parameters"] = json_decode($app->request()->getBody());
    $params = loadParameters();
    
    try
    {
      
//$lab_id=======================================================================
        $fLabID = CRUDUtils::checkIDParam('lab_id', $params, $lab_id, 'LabID');

//$lab_transition_id============================================================
        $fLabTransitionID = CRUDUtils::checkIDParam('lab_transition_id', $params, $lab_transition_id, 'LabTransitionID');
             
//user permisions===============================================================
         $permissions = UserRoles::getUserPermissions($app->request->user);
         if (!in_array($fLabID, $permissions['permit_labs'])) {
             throw new Exception(ExceptionMessages::NoPermissionToDeleteLab, ExceptionCodes::NoPermissionToDeleteLab); 
         };  

//controls======================================================================  

        //check duplicates and unique row=======================================        
        $check = $entityManager->getRepository('LabTransitions')->findBy(array( 'lab'            => $fLabID,
                                                                                'labTransitionId'  => $fLabTransitionID,
                                                                               ));

        $countLabTransitions = count($check);
        
        if ($countLabTransitions == 1)
            //set entity for delete row
            $LabTransitions = $entityManager->find('LabTransitions', $fLabTransitionID);
        else if ($countLabTransitions == 0)
            throw new Exception(ExceptionMessages::NotFoundDelLabTransitionValue." : ".$fLabID." - ".$fLabTransitionID,ExceptionCodes::NotFoundDelLabTransitionValue);
        else 
            throw new Exception(ExceptionMessages::DuplicateDelLabTransitionValue." : ".$fLabID." - ".$fLabTransitionID,ExceptionCodes::DuplicateDelLabTransitionValue);
      
        //check if lab has submitted value = 1 and restrict deletion
       $Labs = $entityManager->find('Labs', $fLabID);
        if ($Labs->getSubmitted() == 'true'){
            throw new Exception(ExceptionMessages::NoDemoDelLabValue." : ".$fLabID ,ExceptionCodes::NoDemoDelLabValue);
        }
        
//delete from db================================================================
        
        $entityManager->remove($LabTransitions);
        $entityManager->flush($LabTransitions);
           
//find max date of remained labs lab_transition=================================
        $findAllDates = $entityManager->getRepository('LabTransitions')->findBy(array('lab'=> $fLabID));
        $countRemainedLabTransitions = count($findAllDates);
       
          $max_date = $maxLabTransitionId = $maxLabTransitionState = $state = null; 
                 
            if ($countRemainedLabTransitions > 0){
                $date = $labTransitionId = array(); 
                 foreach($findAllDates as $findAllDate) {
                    $date[] = $findAllDate->getTransitionDate()->format('Y-m-d');
                    
                    //check last state of lab at lab transitions table==========
                    $labTransitionId[] = $findAllDate->getLabTransitionId();
                    $laststate[$findAllDate->getLabTransitionId()] = $findAllDate->getToState()->getStateId();
                 }
                 
                 $max_date = max($date);
                 $result['maxDate'] = $max_date;
                 $maxLabTransitionId = max($labTransitionId);          
                 $result['lastTransitionLabState'] = $maxLabTransitionState = $laststate[$maxLabTransitionId];
                 $state = $entityManager->getRepository('States')->find(Validator::ToID($maxLabTransitionState));
            }

//update lab status to labs table===============================================
        $updateLabState = $entityManager->find('Labs',$fLabID);
        $updateLabState->setState($state);
        $entityManager->persist($updateLabState);
        $entityManager->flush($updateLabState);
         
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