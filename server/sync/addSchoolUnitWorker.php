<?php
/**
 *
 * @version 2.0
 * @author  ΤΕΙ Αθήνας
 * @package SYNC
 * 
 */
function addSchoolUnitWorker($school_unit_worker_id, $school_unit_id, $worker_id, $worker_position_id  ){
    
    header("Content-Type: text/html; charset=utf-8");
    
    global $entityManager;
    
    $error_messages = array();
    
                try {
                                   
                    //$school_unit_worker_id check value and get status(create,update,delete)
                    //==========================================================
                    $fSchoolUnitWorker = CRUDUtils::syncCheckIdParam($school_unit_worker_id, 'SchoolUnitWorkerID');
                    if (!validator::IsNull($fSchoolUnitWorker['id'])) {

                        $retrievedObject= $entityManager->find('SchoolUnitWorkers', $fSchoolUnitWorker['id']);
                        $duplicateValue = 'DuplicateSchoolWorkerUniqueValue';

                        if(!isset($retrievedObject)) {
                            $action = 'CREATE';
                            $schoolUnitWorkerEntity = new SchoolUnitWorkers(); 
                            $schoolUnitWorkerEntity->setSchoolUnitWorkerId($fSchoolUnitWorker['id']);
                        } else if (count($retrievedObject) == 1) {
                            $action = 'UPDATE';
                            $schoolUnitWorkerEntity = $retrievedObject;
                        } else {
                            $action = 'DUPLICATE';  
                            $error_messages["errors"][] = constant('ExceptionMessages::'.$duplicateValue). ' : ' . $school_unit_worker_id . constant('ExceptionMessages::SyncExceptionCodePreMessage'). constant('ExceptionCodes::'.$duplicateValue);    

                        }

                    } else {
                        $error_messages["errors"][] = $fSchoolUnitWorker['error_message']; 
                    } 
                      
                //$school_unit_id=====================================
                $fSchoolUnit = CRUDUtils::syncEntitySetAssociation($schoolUnitWorkerEntity, $school_unit_id, 'SchoolUnits', 'schoolUnit', 'SchoolUnit', true);
                if (!validator::IsNull($fSchoolUnit)) {$error_messages["errors"][] = $fSchoolUnit; }

                //$worker_id====================================================
                $fWorker = CRUDUtils::syncEntitySetAssociation($schoolUnitWorkerEntity, $worker_id, 'Workers', 'worker', 'Worker', true);
                if (!validator::IsNull($fWorker)) {$error_messages["errors"][] = $fWorker; }
                
                //$worker_position_id====================================================
                $fWorkerPosition = CRUDUtils::syncEntitySetAssociation($schoolUnitWorkerEntity, $worker_position_id, 'WorkerPositions', 'workerPosition', 'WorkerPosition', true);
                if (!validator::IsNull($fWorkerPosition)) {$error_messages["errors"][] = $fWorkerPosition; }
                
                //check unique school_unit_worker======================================
                $checkDuplicate = $entityManager->getRepository('SchoolUnitWorkers')->findOneBy(array('schoolUnit' => $schoolUnitWorkerEntity->getSchoolUnit(),
                                                                                                      'worker' => $schoolUnitWorkerEntity->getWorker(),
                                                                                                      'workerPosition' => $schoolUnitWorkerEntity->getWorkerPosition()));

                if ((count($checkDuplicate) > 1) || (count($checkDuplicate)==1 && ($schoolUnitWorkerEntity->getSchoolUnitWorkerId() != $checkDuplicate->getSchoolUnitWorkerId()))){
                 
                       #remove previous unit worker at the same school unit
                       $checkPosition = $checkDuplicate->getWorkerPosition()->getWorkerPositionId();
                       if ($checkPosition != 1) { 
                            $error_messages["errors"][] = ExceptionMessages::DuplicateSyncSchoolUnitWorkerValue. ':' . $schoolUnitWorkerEntity->getSchoolUnitWorkerId() .ExceptionMessages::SyncExceptionCodePreMessage.ExceptionCodes::DuplicateSyncSchoolUnitWorkerValue;                 
                       } else {
                            $entityManager->remove($checkDuplicate);
                            $entityManager->flush($checkDuplicate);
                       }
                }
 
                //==================================================================================  
        
                    if (!$error_messages && $action === 'CREATE'){    
                        
                            $entityManager->persist($schoolUnitWorkerEntity);
                            $entityManager->flush($schoolUnitWorkerEntity);
                                    
                        $final_results["status"] = ExceptionCodes::SuccessSyncSchoolUnitWorkersRecord;
                        $final_results["message"] = ExceptionMessages::SuccessSyncSchoolUnitWorkersRecord;
                        $final_results["action"] = 'insert';
                        $final_results["school_unit_worker_id"] = $schoolUnitWorkerEntity->getSchoolUnitWorkerId();
                        
                    } elseif (!$error_messages && $action === 'UPDATE'){
                        
                            $entityManager->persist($schoolUnitWorkerEntity);
                            $entityManager->flush($schoolUnitWorkerEntity);
                                    
                        $final_results["status"] = ExceptionCodes::SuccessSyncUpdateSchoolUnitWorkersRecord;
                        $final_results["message"] = ExceptionMessages::SuccessSyncUpdateSchoolUnitWorkersRecord;
                        $final_results["action"] = 'update';
                        $final_results["school_unit_worker_id"] = $schoolUnitWorkerEntity->getSchoolUnitWorkerId();
                                
                    } else {
                        
                        $final_results["status"] = ExceptionCodes::FailureSyncSchoolUnitWorkersRecord;
                        $final_results["message"] = ExceptionMessages::FailureSyncSchoolUnitWorkersRecord;
                        $final_results["action"] = 'error';
                        $final_results["school_unit_worker_id"] = $schoolUnitWorkerEntity->getSchoolUnitWorkerId();
                        $final_results["school_unit_id"] = $schoolUnitWorkerEntity->getSchoolUnit()->getSchoolUnitId();    
                    }
                                       
            } catch (Exception $e){
            $final_results["status"] = $e->getCode();
            $final_results["message"] = $e->getMessage();
            $final_results["action"] = 'unexpected_error';
        }
        
    $result["school_unit_worker_results"] = array_merge($error_messages, $final_results);
    return $result;
    
}    
?>