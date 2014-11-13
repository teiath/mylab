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
    require_once('system/includes.php');
    
    global $Options; 
    global $entityManager;
    
    //check with params
    $params = array("page"=>"1",
                    "pagesize"=>"500");
    
    $all_logs = array();
    $check_total_download = 0;

    //init and start timer
    $timer=new Timing;
    $timer->start();
    
try{ 
    echo 'Starting Sync Workers table';

    do{ 
        
        $inserts=$updates=$errors=$unexpected_errors=0;
        $result = array();

//start api request and return a block of data==================================
//==============================================================================
        
        $data = SYNCUtils::apiRequest($Options['Server_Mm'], $Options['Server_Mm_username'], $Options['Server_Mm_password'], 'workers', 'GET', $params);

        //log general infos from received data of the mmsch
        $results["sync_table"] = "Circuits";
        $results["total"] = (int)$data["total"];
   
        $result["block_general"][] = array( "count_page"    => (int)$params["page"],
                                            "count"         => $data["count"],
                                            "status"        => $data["status"],
                                            "message"       => $data["message"]
                                        ); 

        //check if sync with mmsch return error code
       $result["block_error_sync"] = ($data["status"] != 200) ?  true : false;
     
        if (Validator::IsEmptyArray($data["data"]) || Validator::IsNull($data["data"])){echo ' No data to sync at Workers table';die();}        
 	echo '---Count of returned Data ' . $data["count"] . ' :--------';

//get each record of block data ================================================
//==============================================================================
        foreach($data["data"] as $worker)
        {    
          
            $worker_id = $worker["worker_id"];
            $registry_no = $worker["registry_no"];
            $tax_number = $worker["tax_number"];
            $lastname = $worker["lastname"];
            $firstname = $worker["firstname"];
            $fathername = $worker["fathername"];
            $sex = $worker["sex"];
            $worker_specialization_id = $worker["worker_specialization_id"];
            $source_id = $worker["source_id"];
            
            $check_total_download++;
            
                try {
                    $error_messages = array();
                                   
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
                                    
                        $inserts++;
                        $final_results["status"] = ExceptionCodes::SuccessSyncWorkersRecord;
                        $final_results["message"] = ExceptionMessages::SuccessSyncWorkersRecord;
                        $final_results["action"] = 'insert';
                        $final_results["worker_id"] = $workerEntity->getWorkerId();
                        $results["all_inserts"][]=$final_results;
                        
                    } elseif (!$error_messages && $action === 'UPDATE'){
                        
                                    $entityManager->persist($workerEntity);
                                    $entityManager->flush($workerEntity);
                                    
                        $updates++;
                        $final_results["status"] = ExceptionCodes::SuccessSyncUpdateWorkersRecord;
                        $final_results["message"] = ExceptionMessages::SuccessSyncUpdateWorkersRecord;
                        $final_results["action"] = 'update';
                        $final_results["worker_id"] = $workerEntity->getWorkerId();
                        $results["all_updates"][]=$final_results;
                                
                    } else {
                        
                        $errors++;
                        $final_results["status"] = ExceptionCodes::FailureSyncWorkersRecord;
                        $final_results["message"] = ExceptionMessages::FailureSyncWorkersRecord;
                        $final_results["action"] = 'error';
                        $final_results["worker_id"] = $workerEntity->getWorkerId();
                            
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
    
    $filepath = $Options["SyncLogFolder"];
    $filename = $timer->getTimeFileName('workers');

    $cachePath = $filepath.$filename; 
    file_put_contents($cachePath,JsonFunctions::toGreek(json_encode($print_results),TRUE));
    $href = $Options["WebSyncFolder"].$filename;
    
    echo $timer->printFullStats();
    echo "Επεστράφησαν συνολικά " . $results["total"] . " στοιχεία από το mmsch </br>" ;
    echo "Εισαγωγή " . $results["all_logs"]["all_inserts"] . " στοιχεία από το mmsch </br>" ;
    echo "Ενημερώθηκαν " . $results["all_logs"]["all_updates"] . " στοιχεία από το mmsch </br>" ;
    echo "Βρέθηκαν " . $results["all_logs"]["all_errors"] . " προειδοποιήσεις για το συγχρονισμό με το mmsch </br>" ;
    echo "Βρέθηκαν " . $results["all_logs"]["all_unexpected_errors"] . " κρίσιμα λάθη για το συγχρονισμό με το mmsch </br>" ;
    echo '</br> Finished Sync Workers table. </br> View results at <a href='.$href.'>WorkerLog.json</a>  ' ;
    
} catch (Exception $e) {
    throw $e;
}
    
?>