<?php
/**
 *
 * @version 2.0
 * @author  ΤΕΙ Αθήνας
 * @package SYNC
 * 
 */

    header("Content-Type: text/html; charset=utf-8");
    
    chdir("../");
    require_once('/system/includes.php');
    
    global $Options; 
    global $entityManager;
    
    //check with params
    $params = array("circuit_type" => "aDSLoPSTN,aDSLoISDN,ISDN,PSTN",
                    "orderby" => "circuit_id",
                    "ordertype" => "ASC",
                    "page"=>"1",
                    "pagesize"=>"500");
    
    $all_logs = array();
    $check_total_download = 0;

    //init and start timer
    $timer=new Timing;
    $timer->start();
    
try{ 
    echo 'Starting Sync Circuits table \n\n';

    do{ 
        
        $inserts=$updates=$errors=$unexpected_errors=0;
        $result = array();

//start api request and return a block of data==================================
//==============================================================================
        
        // $result = SYNCUtils::apiRequest($Options['Server_Mmsch'], $Options['Server_Mmsch_username'], $Options['Server_Mmsch_password'], 'circuits', 'GET', $params);

        //make the http request to mmsch with cURL 
        $curl = curl_init($Options['Server_Mm']."circuits");
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $Options['Server_Mm_username'] . ":" . $Options['Server_Mm_password']);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode( $params ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $data = json_decode( curl_exec($curl), true );

        //log general infos from received data of the mmsch
        $results["sync_table"] = "Circuits";
        $results["total"] = (int)$data["total"];
   
        //$result["data_mmsch"] = $data["data"];//show all mmsch_circuits data from get_function of curl 
        $result["block_general"][] = array( "count_page"    => (int)$params["page"],
                                            "count"         => $data["count"],
                                            "status"        => $data["status"],
                                            "message"       => $data["message"]
                                        ); 

        //CHECKING STATE (1) 
        //check if sync with mmsch return error code        
        if ($data["status"] != 200){
            $result["block_error_sync"] = true;                 
        } else {
            $result["block_error_sync"] = false;
        }
     
        if (Validator::IsEmptyArray($data["data"]) || Validator::IsNull($data["data"])){echo ' No data to sync at circuits table';die();}        
 	echo '---Count of returned Data ' . $data["count"] . ' :--------';

//get each record of block data ================================================
//==============================================================================
        foreach($data["data"] as $circuit)
        {    
       
            $circuit_id= $circuit["circuit_id"];
            $phone_number = $circuit["phone_number"];
            $updated_date = $circuit["updated_date"];
            $status = $circuit["status"];
            $circuit_type_id = $circuit["circuit_type_id"];
            $school_unit_id = $circuit["mm_id"];
    
            $check_total_download++;
            
            $circuit_data["circuit_data"] = array(  "circuit_id" => $circuit_id,
                                                    "phone_number"=> $phone_number,
                                                    "updated_date"=> $updated_date,
                                                    "status"=> $status,
                                                    "circuit_type_id"=> $circuit_type_id,
                                                    "school_unit_id"=> $school_unit_id
                                                );
           
                try {
                    $error_messages = array();
                                   
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
                            $error_messages["errors"][] = constant('ExceptionMessages::'.$duplicateValue). ' : ' . $circuit_id . constant('SyncExceptionMessages::SyncExceptionCodePreMessage'). constant('ExceptionCodes::'.$duplicateValue);    

                        }

                    } else {
                        $error_messages["errors"][] = $fCircuit['error_message']; 
                    } 
      
                //= $phone_number ==============================================

                if (Validator::IsNull($phone_number) )
                    $error_messages["errors"][] = SyncExceptionMessages::MissingSyncCircuitPhoneNumberValue.$phone_number.SyncExceptionMessages::SyncExceptionCodePreMessage.SyncExceptionCodes::MissingSyncCircuitPhoneNumberValue;
                else if (!Validator::IsValue($phone_number) || Validator::IsNegative($phone_number))
                    $error_messages["errors"][] =  SyncExceptionMessages::InvalidSyncCircuitPhoneNumberValue.$phone_number.SyncExceptionMessages::SyncExceptionCodePreMessage.SyncExceptionCodes::InvalidSyncCircuitPhoneNumberValue;
                else if (Validator::IsValue($phone_number))       
                    $circuitEntity->setPhoneNumber(Validator::ToValue($phone_number));
                else
                    $error_messages["errors"][] =  SyncExceptionMessages::UnknownSyncCircuitPhoneNumberType.$phone_number.SyncExceptionMessages::SyncExceptionCodePreMessage.SyncExceptionCodes::UnknownSyncCircuitPhoneNumberType;
     
        
                //$updated_date============================================================================

                if (Validator::IsNull($updated_date) )  
                    $circuitEntity->setUpdatedDate(null);    
                else
                    $circuitEntity->setUpdatedDate(new \DateTime($updated_date));
           
                //= $status ==================================================
                if (Validator::IsNull($status) )
                    $error_messages["errors"][] = SyncExceptionMessages::MissingSyncCircuitStatusValue.$status.SyncExceptionMessages::SyncExceptionCodePreMessage.SyncExceptionCodes::MissingSyncCircuitStatusValue;
                else if (!Validator::IsBoolean($status)) 
                    $error_messages["errors"][] =  SyncExceptionMessages::InvalidSyncCircuitStatusValue.$status.SyncExceptionMessages::SyncExceptionCodePreMessage.SyncExceptionCodes::InvalidSyncCircuitStatusValue;
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
                   $error_messages["errors"][] = SyncExceptionMessages::DuplicateSyncCircuitsPhoneValue. ':' . $circuitEntity->getCircuitId() .SyncExceptionMessages::SyncExceptionCodePreMessage.SyncExceptionCodes::DuplicateSyncCircuitsPhoneValue;                 

                }

                //==================================================================================  
        
                    if (!$error_messages && $action === 'CREATE'){    
                        
                                    $entityManager->persist($circuitEntity);
                                    $entityManager->flush($circuitEntity);
                                    
                        $inserts++;
                        $final_results["status"] = SyncExceptionCodes::SuccessSyncInsertCircuitsRecord;
                        $final_results["message"] = SyncExceptionMessages::SuccessSyncInsertCircuitsRecord;
                        $final_results["action"] = 'insert';
                        $final_results["circuit_id"] = $circuitEntity->getCircuitId();
                        $results["all_inserts"][]=$final_results;
                        
                    } elseif (!$error_messages && $action === 'UPDATE'){
                        
                                    $entityManager->persist($circuitEntity);
                                    $entityManager->flush($circuitEntity);
                                    
                        $updates++;
                        $final_results["status"] = SyncExceptionCodes::SuccessSyncUpdateCircuitsRecord;
                        $final_results["message"] = SyncExceptionMessages::SuccessSyncUpdateCircuitsRecord;
                        $final_results["action"] = 'update';
                        $final_results["circuit_id"] = $circuitEntity->getCircuitId();
                        $results["all_updates"][]=$final_results;
                                
                    } else {
                        
                        $errors++;
                        $final_results["status"] = SyncExceptionCodes::FailureSyncCircuitsRecord;
                        $final_results["message"] = SyncExceptionMessages::FailureSyncCircuitsRecord;
                        $final_results["action"] = 'error';
                        $final_results["circuit_id"] = $circuitEntity->getCircuitId();
                            
                    }
                       
                    $combinedData = array_merge( $error_messages,$final_results);
                    $result["block_results"][] = $combinedData; 


                  if ($error_messages){  
                      $results["all_error_messages"][]=$error_messages;                  
                  }
                                       
            } catch (Exception $e){
            $unexpected_errors++;
            $result["status"] = $e->getCode();
            $result["message"] = $e->getMessage();
            $result["action"] = 'unexpected_error';
        }
                
        }

        //block log time,errors and success statistics
        $block_log = array();
        $result["block_time"] = $timer->getElapsedTime();
        $block_log["block_log"]= array( "inserts" => $inserts,
                                        "updates" => $updates,
                                        "errors" => $errors,
                                        "unexpected_errors" => $unexpected_errors
                                );
        $all_logs["block_logs"][] = $block_log["block_log"];
      
        
        //merge block results and go to next block 
        $result_block[] = array_merge($result,$block_log); 
        
        echo ' Results ' . $params["page"] . ' page block of ' . $params["pagesize"]."\n";
        echo ' Pagination ' . ($params["page"]-1) * $params["pagesize"]."\n" ;
        echo ' Total Data ' .  $data["total"]."\n";
        
        $params["page"]++;
    }while( ($params["page"]-1) * $params["pagesize"] < $data["total"]);

    //count log time,errors and success statistics
    foreach ($all_logs["block_logs"] as $option) {
      $all_inserts += $option['inserts'];
      $all_updates += $option['updates'];
      $all_errors += $option['errors'];
      $all_unexpected_errors += $option['unexpected_errors'];
    }
    
    $results["all_logs"] = array( "all_inserts" => $all_inserts,
                                  "all_updates" => $all_updates,
                                  "all_errors" => $all_errors,
                                  "all_unexpected_errors" => $all_unexpected_errors
                           );
        
    $false_block = $true_block =0;
    foreach ($result_block as $check_error_code){
      ($check_error_code["block_error_sync"] == true) ?  $false_block++ :  $true_block++;
    }
    
    $timer->stop();
    $results["time_stats"] = $timer->getFullStats();  
    
    $print_results = array_merge($result_block,$results);
    
    $filepath = realpath(basename(getenv("SCRIPT_NAME")));
    $filename = $timer->getTimeFileName('circuits');

    $cachePath = $filepath.$filename; 
    file_put_contents($cachePath,JsonFunctions::toGreek(json_encode($print_results),TRUE));
    $href = $Options["SyncFolder"].$filename;
    
    echo $timer->printFullStats();
    echo "Επεστράφησαν συνολικά " . $results["total"] . " στοιχεία από το mmsch </br>" ;
    echo "Εισαγωγή " . $results["all_logs"]["all_inserts"] . " στοιχεία από το mmsch </br>" ;
    echo "Ενημερώθηκαν " . $results["all_logs"]["all_updates"] . " στοιχεία από το mmsch </br>" ;
    echo "Βρέθηκαν " . $results["all_logs"]["all_errors"] . " προειδοποιήσεις για το συγχρονισμό με το mmsch </br>" ;
    echo "Βρέθηκαν " . $results["all_logs"]["all_unexpected_errors"] . " κρίσιμα λάθη για το συγχρονισμό με το mmsch </br>" ;
    echo '</br> Finished Sync Circuits table. </br> View results at <a href='.$href.'>CircuitLog.json</a>  ' ;
    
} catch (Exception $e) {
    throw $e;
}
    
?>