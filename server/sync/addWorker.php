<?php
/**
 *
 * @version 2.0
 * @author  ΤΕΙ Αθήνας
 * @package SYNC
 * 
 */
function addWorker($worker_id, $registry_no, $tax_number, $lastname, $firstname, $fathername, $sex, $worker_specialization_id, $source_id ){
    
    header("Content-Type: text/html; charset=utf-8");

    global $entityManager;
    
    $error_messages = array();
              
            try {
                               
                    //$worker_id check value and get status(create,update,delete)
                    //==========================================================
                    $fWorker = CRUDUtils::syncCheckIdParam($worker_id, 'WorkerID');
                    if (!validator::IsNull($fWorker['id'])) {

                        $retrievedObject= $entityManager->find('Workers', $fWorker['id']);
                        $duplicateValue = 'DuplicateWorkerUniqueValue';

                        if(!isset($retrievedObject)) {
                            $action = 'CREATE';
                            $workerEntity = new Workers(); 
                            $workerEntity->setWorkerId($fWorker['id']);
                        } else if (count($retrievedObject) == 1) {
                            $action = 'UPDATE';
                            $workerEntity = $retrievedObject;
                        } else {
                            $action = 'DUPLICATE';  
                            $error_messages["errors"][] = constant('ExceptionMessages::'.$duplicateValue). ' : ' . $worker_id . constant('ExceptionMessages::SyncExceptionCodePreMessage'). constant('ExceptionCodes::'.$duplicateValue);    

                        }

                    } else {
                        $error_messages["errors"][] = $fWorker['error_message']; 
                    } 
      
                    //= $registry_no ===============================================
                    $fRegistryNo = CRUDUtils::syncEntitySetParam($workerEntity, $registry_no, 'WorkerRegistryNo', 'registry_no', true, false);
                    if (!validator::IsNull($fRegistryNo)) {$error_messages["errors"][] = $fRegistryNo; }

                    //= $tax_number ================================================
                    $fTaxNumber = CRUDUtils::syncEntitySetParam($workerEntity, $tax_number, 'WorkerTaxNumber', 'tax_number', false, true);
                    if (!validator::IsNull($fTaxNumber)) {$error_messages["errors"][] = $fTaxNumber; }

                    //$lastname=====================================================
                    $fLastName = CRUDUtils::syncEntitySetParam($workerEntity, $lastname, 'WorkerLastName', 'lastname', false, true);
                    if (!validator::IsNull($fLastName)) {$error_messages["errors"][] = $fLastName; }

                    //$firstname====================================================
                    $fFirstName = CRUDUtils::syncEntitySetParam($workerEntity, $firstname, 'WorkerFirstName', 'firstname', false, true);
                    if (!validator::IsNull($fFirstName)) {$error_messages["errors"][] = $fFirstName; }

                    //$fathername===================================================
                    $fFatherName = CRUDUtils::syncEntitySetParam($workerEntity, $fathername, 'WorkerFatherName', 'fathername', false, true);
                    if (!validator::IsNull($fFatherName)) {$error_messages["errors"][] = $fFatherName; }

                    //$sex==========================================================
                    $fSex= CRUDUtils::syncEntitySetParam($workerEntity, $sex, 'WorkerSex', 'sex', false, true);
                    if (!validator::IsNull($fSex)) {$error_messages["errors"][] = $fSex; }

                    //$worker_specialization_id=====================================
                    $fWorkerSpecialization = CRUDUtils::syncEntitySetAssociation($workerEntity, $worker_specialization_id, 'WorkerSpecializations', 'workerSpecialization', 'WorkerSpecialization', false);
                    if (!validator::IsNull($fWorkerSpecialization)) {$error_messages["errors"][] = $fWorkerSpecialization; }

                    //$source_id====================================================
                    $fSource = CRUDUtils::syncEntitySetAssociation($workerEntity, $source_id, 'Sources', 'source', 'Source', true);
                    if (!validator::IsNull($fSource)) {$error_messages["errors"][] = $fSource; }

                    //check unique registry_no======================================
                    $checkDuplicate = $entityManager->getRepository('Workers')->findOneBy(array('registryNo' => $workerEntity->getRegistryNo() ));

                    if ((count($checkDuplicate) > 1) || (count($checkDuplicate)==1 && ($workerEntity->getWorkerId() != $checkDuplicate->getWorkerId()))){
                       $error_messages["errors"][] = ExceptionMessages::DuplicateSyncWorkerValue. ':' . $workerEntity->getWorkerId() .ExceptionMessages::SyncExceptionCodePreMessage.ExceptionCodes::DuplicateSyncWorkerValue;                 

                    }

                    //==================================================================================  
        
                    if (!$error_messages && $action === 'CREATE'){    
                        
                            $entityManager->persist($workerEntity);
                            $entityManager->flush($workerEntity);
                                    
                        $final_results["status"] = ExceptionCodes::SuccessSyncWorkersRecord;
                        $final_results["message"] = ExceptionMessages::SuccessSyncWorkersRecord;
                        $final_results["action"] = 'insert';
                        $final_results["worker_id"] = $workerEntity->getWorkerId();
                        
                    } elseif (!$error_messages && $action === 'UPDATE'){
                        
                            $entityManager->persist($workerEntity);
                            $entityManager->flush($workerEntity);
                                    
                        $final_results["status"] = ExceptionCodes::SuccessSyncUpdateWorkersRecord;
                        $final_results["message"] = ExceptionMessages::SuccessSyncUpdateWorkersRecord;
                        $final_results["action"] = 'update';
                        $final_results["worker_id"] = $workerEntity->getWorkerId();
                                
                    } else {
                        
                        $final_results["status"] = ExceptionCodes::FailureSyncWorkersRecord;
                        $final_results["message"] = ExceptionMessages::FailureSyncWorkersRecord;
                        $final_results["action"] = 'error';
                        $final_results["worker_id"] = $workerEntity->getWorkerId();
                            
                    }
                                                 
            } catch (Exception $e){
            $final_results["status"] = $e->getCode();
            $final_results["message"] = $e->getMessage();
            $final_results["action"] = 'unexpected_error';
        }

    $result["worker_results"] = array_merge($error_messages, $final_results);
    return $result;

}    
?>