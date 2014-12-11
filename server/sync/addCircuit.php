<?php
/**
 *
 * @version 2.0
 * @author  ΤΕΙ Αθήνας
 * @package SYNC
 * 
 */
function addCircuit($circuit_id, $phone_number ,$updated_date , $status , $circuit_type_id , $school_unit_id ){

    header("Content-Type: text/html; charset=utf-8");
       
    global $entityManager;

    $error_messages = array();

                    try {

                        //$circuit_id check value and get status(create,update,delete)
                        //==========================================================
                        $fCircuit = CRUDUtils::syncCheckIdParam($circuit_id, 'CircuitID');
                        if (!validator::IsNull($fCircuit['id'])) {

                            $retrievedObject= $entityManager->find('Circuits', $fCircuit['id']);
                            $duplicateValue = 'DuplicateCircuitUniqueValue';

                            if(!isset($retrievedObject)) {
                                $action = 'CREATE';
                                $circuitEntity = new Circuits(); 
                                $circuitEntity->setCircuitId($fCircuit['id']);
                            } else if (count($retrievedObject) == 1) {
                                $action = 'UPDATE';
                                $circuitEntity = $retrievedObject;
                            } else {
                                $action = 'DUPLICATE';  
                                $error_messages["errors"][] = constant('ExceptionMessages::'.$duplicateValue). ' : ' . $circuit_id . constant('ExceptionMessages::SyncExceptionCodePreMessage'). constant('ExceptionCodes::'.$duplicateValue);    

                            }

                        } else {
                            $error_messages["errors"][] = $fCircuit['error_message']; 
                        } 

                        //= $phone_number ==============================================

                        if (Validator::IsNull($phone_number) )
                            $error_messages["errors"][] = ExceptionMessages::MissingCircuitPhoneNumberValue.$phone_number.ExceptionMessages::SyncExceptionCodePreMessage.ExceptionCodes::MissingCircuitPhoneNumberValue;
                        else if (!Validator::IsValue($phone_number) || Validator::IsNegative($phone_number))
                            $error_messages["errors"][] =  ExceptionMessages::InvalidSyncCircuitPhoneNumberValue.$phone_number.ExceptionMessages::SyncExceptionCodePreMessage.ExceptionCodes::InvalidSyncCircuitPhoneNumberValue;
                        else if (Validator::IsValue($phone_number))       
                            $circuitEntity->setPhoneNumber(Validator::ToValue($phone_number));
                        else
                            $error_messages["errors"][] =  ExceptionMessages::UnknownSyncCircuitPhoneNumberType.$phone_number.ExceptionMessages::SyncExceptionCodePreMessage.ExceptionCodes::UnknownSyncCircuitPhoneNumberType;


                        //$updated_date============================================================================

                        if (Validator::IsNull($updated_date) )  
                            $circuitEntity->setUpdatedDate(null);    
                        else
                            $circuitEntity->setUpdatedDate(new \DateTime($updated_date));

                        //= $status ==================================================
                        if (Validator::IsNull($status) )
                            $error_messages["errors"][] = ExceptionMessages::MissingCircuitStatusValue.$status.ExceptionMessages::SyncExceptionCodePreMessage.ExceptionCodes::MissingCircuitStatusValue;
                        else if (!Validator::IsBoolean($status)) 
                            $error_messages["errors"][] =  ExceptionMessages::InvalidCircuitStatusType.$status.ExceptionMessages::SyncExceptionCodePreMessage.ExceptionCodes::InvalidCircuitStatusType;
                        else { 
                            $circuitEntity->setStatus(Validator::ToBoolean($status));
                        }                      

                        //= $circuit_type_id========================================
                        $fCircuitType = CRUDUtils::syncEntitySetAssociation($circuitEntity, $circuit_type_id, 'CircuitTypes', 'circuitType', 'CircuitType', true);
                        if (!validator::IsNull($fCircuitType)) {$error_messages["errors"][] = $fCircuitType; }

                        //$school_unit_id============================================================          
                        $fSchoolUnit = CRUDUtils::syncEntitySetAssociation($circuitEntity, $school_unit_id, 'SchoolUnits', 'schoolUnit', 'SchoolUnit', true);
                        if (!validator::IsNull($fSchoolUnit)) {$error_messages["errors"][] = $fSchoolUnit; }

                        //check unique phone numbers============================================================================
                        $checkDuplicate = $entityManager->getRepository('Circuits')->findOneBy(array('phoneNumber' => $circuitEntity->getPhoneNumber() ));

                        if ((count($checkDuplicate) > 1) || (count($checkDuplicate)==1 && ($circuitEntity->getCircuitId() != $checkDuplicate->getCircuitId()))){
                           $error_messages["errors"][] = ExceptionMessages::DuplicateSyncCircuitsPhoneValue. ':' . $circuitEntity->getCircuitId() .ExceptionMessages::SyncExceptionCodePreMessage.ExceptionCodes::DuplicateSyncCircuitsPhoneValue;                 

                        }

                        //==================================================================================  

                            if (!$error_messages && $action === 'CREATE'){    

                                    $entityManager->persist($circuitEntity);
                                    $entityManager->flush($circuitEntity);

                                $final_results["status"] = ExceptionCodes::SuccessSyncCircuitsRecord;
                                $final_results["message"] = ExceptionMessages::SuccessSyncCircuitsRecord;
                                $final_results["action"] = 'insert';
                                $final_results["circuit_id"] = $circuitEntity->getCircuitId();
           
                            } elseif (!$error_messages && $action === 'UPDATE'){

                                    $entityManager->persist($circuitEntity);
                                    $entityManager->flush($circuitEntity);

                                $final_results["status"] = ExceptionCodes::SuccessSyncUpdateCircuitsRecord;
                                $final_results["message"] = ExceptionMessages::SuccessSyncUpdateCircuitsRecord;
                                $final_results["action"] = 'update';
                                $final_results["circuit_id"] = $circuitEntity->getCircuitId();
                              
                            } else {

                                $final_results["status"] = ExceptionCodes::FailureSyncCircuitsRecord;
                                $final_results["message"] = ExceptionMessages::FailureSyncCircuitsRecord;
                                $final_results["action"] = 'error';
                                $final_results["circuit_id"] = $circuitEntity->getCircuitId();
                                $final_results["school_unit_id"] = $circuitEntity->getSchoolUnit()->getSchoolUnitId();
                                
                            }

                    } catch (Exception $e){
                    $final_results["status"] = $e->getCode();
                    $final_results["message"] = $e->getMessage();
                    $final_results["action"] = 'unexpected_error';
                }

    $result["circuit_results"] = array_merge($error_messages, $final_results);
    return $result;
        
}    
?>