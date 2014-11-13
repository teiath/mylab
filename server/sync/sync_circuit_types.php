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
                    "page"=>"1",
                    "pagesize"=>"500");
    
    $all_logs = array();
    $check_total_download = 0;

    //init and start timer
    $timer=new Timing;
    $timer->start();
    
try{ 
    echo 'Starting Sync Circuit Types table';

    do{ 
        
        $inserts=$updates=$errors=$unexpected_errors=0;
        $result = array();

//start api request and return a block of data==================================
//==============================================================================
        
        $data = SYNCUtils::apiRequest($Options['Server_Mm'], $Options['Server_Mm_username'], $Options['Server_Mm_password'], 'circuit_types', 'GET', $params);

        //log general infos from received data of the mmsch
        $results["sync_table"] = "CircuitTypes";
        $results["total"] = (int)$data["total"];
   
        $result["block_general"][] = array( "count_page"    => (int)$params["page"],
                                            "count"         => $data["count"],
                                            "status"        => $data["status"],
                                            "message"       => $data["message"]
                                        ); 

        //check if sync with mmsch return error code
       $result["block_error_sync"] = ($data["status"] != 200) ?  true : false;
   
        if (Validator::IsEmptyArray($data["data"]) || Validator::IsNull($data["data"])){echo ' No data to sync at CircuitTypes table ';die();}        
 	echo '---Count of returned Data ' . $data["count"] . ' :--------';

//get each record of block data ================================================
//==============================================================================
        foreach($data["data"] as $circuit_type)
        {    
          
            $circuit_type_id = $circuit_type["circuit_type_id"];
            $name = $circuit_type["circuit_type"];
            
            $check_total_download++;
           
                try {
                    $error_messages = array();
                                   
                    //$circuit_type_id check value and get status(create,update,delete)
                    //==========================================================
                    $fCircuitType = CRUDUtils::syncCheckIdParam($circuit_type_id, 'CircuitTypeID');
                    if (!validator::IsNull($fCircuitType['id'])) {

                        $retrievedObject= $entityManager->find('CircuitTypes', $fCircuitType['id']);
                        $duplicateValue = 'DuplicateCircuitTypeUniqueValue';

                        if(!isset($retrievedObject)) {
                            $action = 'CREATE';
                            $circuitTypeEntity = new CircuitTypes(); 
                            $circuitTypeEntity->setCircuitTypeId($fCircuitType['id']);
                        } else if (count($retrievedObject) == 1) {
                            $action = 'UPDATE';
                            $circuitTypeEntity = $retrievedObject;
                        } else {
                            $action = 'DUPLICATE';  
                            $error_messages["errors"][] = constant('ExceptionMessages::'.$duplicateValue). ' : ' . $circuit_type_id . constant('ExceptionMessages::SyncExceptionCodePreMessage'). constant('ExceptionCodes::'.$duplicateValue);    

                        }

                    } else {
                        $error_messages["errors"][] = $fCircuitType['error_message']; 
                    } 
                      
                //$name=========================================================
                $fName = CRUDUtils::syncEntitySetParam($circuitTypeEntity, $name, 'CircuitTypeName', 'name', true, true);
                if (!validator::IsNull($fName)) {$error_messages["errors"][] = $fName; }
                
                //check unique circuit_types====================================
                $checkDuplicate = $entityManager->getRepository('CircuitTypes')->findOneBy(array('name' => $circuitTypeEntity->getName() ));

                if ((count($checkDuplicate) > 1) || (count($checkDuplicate)==1 && ($circuitTypeEntity->getName() != $checkDuplicate->getName() ))){
                   $error_messages["errors"][] = ExceptionMessages::DuplicateSyncCircuitTypesNameValue. ':' . $circuitTypeEntity->getName() .ExceptionMessages::SyncExceptionCodePreMessage.ExceptionCodes::DuplicateSyncCircuitTypesNameValue;                 

                }

                //==============================================================
        
                    if (!$error_messages && $action === 'CREATE'){    
                        
                                    $entityManager->persist($circuitTypeEntity);
                                    $entityManager->flush($circuitTypeEntity);
                                    
                        $inserts++;
                        $final_results["status"] = ExceptionCodes::SuccessSyncCircuitTypesRecord;
                        $final_results["message"] = ExceptionMessages::SuccessSyncCircuitTypesRecord;
                        $final_results["action"] = 'insert';
                        $final_results["circuit_type_id"] = $circuitTypeEntity->getCircuitTypeId();
                        $results["all_inserts"][]=$final_results;
                        
                    } elseif (!$error_messages && $action === 'UPDATE'){
                        
                                    $entityManager->persist($circuitTypeEntity);
                                    $entityManager->flush($circuitTypeEntity);
                                    
                        $updates++;
                        $final_results["status"] = ExceptionCodes::SuccessSyncUpdateCircuitTypesRecord;
                        $final_results["message"] = ExceptionMessages::SuccessSyncUpdateCircuitTypesRecord;
                        $final_results["action"] = 'update';
                        $final_results["circuit_type_id"] = $circuitTypeEntity->getCircuitTypeId();
                        $results["all_updates"][]=$final_results;
                                
                    } else {
                        
                        $errors++;
                        $final_results["status"] = ExceptionCodes::FailureSyncCircuitTypesRecord;
                        $final_results["message"] = ExceptionMessages::FailureSyncCircuitTypesRecord;
                        $final_results["action"] = 'error';
                        $final_results["circuit_type_id"] = $circuitTypeEntity->getCircuitTypeId();
                            
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
    $filename = $timer->getTimeFileName('circuit_types');

    $cachePath = $filepath.$filename; 
    file_put_contents($cachePath,JsonFunctions::toGreek(json_encode($print_results),TRUE));
    $href = $Options["WebSyncFolder"].$filename;
   
    echo $timer->printFullStats();
    echo "Επεστράφησαν συνολικά " . $results["total"] . " στοιχεία από το mmsch </br>" ;
    echo "Εισαγωγή " . $results["all_logs"]["all_inserts"] . " στοιχεία από το mmsch </br>" ;
    echo "Ενημερώθηκαν " . $results["all_logs"]["all_updates"] . " στοιχεία από το mmsch </br>" ;
    echo "Βρέθηκαν " . $results["all_logs"]["all_errors"] . " προειδοποιήσεις για το συγχρονισμό με το mmsch </br>" ;
    echo "Βρέθηκαν " . $results["all_logs"]["all_unexpected_errors"] . " κρίσιμα λάθη για το συγχρονισμό με το mmsch </br>" ;
    echo '</br> Finished Sync CircuitTypes table. </br> View results at <a href='.$href.'>CircuitTypesLog.json</a>  ' ;
    
} catch (Exception $e) {
    throw $e;
}
    
?>