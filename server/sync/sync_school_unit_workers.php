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
    $params = array("page"=>"1",
                    "pagesize"=>"500");
    
    $all_logs = array();
    $check_total_download = 0;

    //init and start timer
    $timer=new Timing;
    $timer->start();
    
try{ 
    echo 'Starting Sync School Unit Workers table';

    do{ 
        
        $inserts=$updates=$errors=$unexpected_errors=0;
        $result = array();

//start api request and return a block of data==================================
//==============================================================================
        
        $data = SYNCUtils::apiRequest($Options['Server_Mm'], $Options['Server_Mm_username'], $Options['Server_Mm_password'], 'unit_workers', 'GET', $params);

        //log general infos from received data of the mmsch
        $results["sync_table"] = "SchoolUnitWorkers";
        $results["total"] = (int)$data["total"];
   
        $result["block_general"][] = array( "count_page"    => (int)$params["page"],
                                            "count"         => $data["count"],
                                            "status"        => $data["status"],
                                            "message"       => $data["message"]
                                        ); 

        //check if sync with mmsch return error code
       $result["block_error_sync"] = ($data["status"] != 200) ?  true : false;
     
        if (Validator::IsEmptyArray($data["data"]) || Validator::IsNull($data["data"])){echo ' No data to sync at SchoolUnitWorkers table ';die();}        
 	echo '---Count of returned Data ' . $data["count"] . ' :--------';

//get each record of block data ================================================
//==============================================================================
        foreach($data["data"] as $school_unit_worker)
        {    
          
            $school_unit_worker_id = $school_unit_worker["unit_worker_id"];
            $school_unit_id = $school_unit_worker["mm_id"];
            $worker_id = $school_unit_worker["worker_id"];
            $worker_position_id = $school_unit_worker["worker_position_id"];
            
            $check_total_download++;
           
                try {
                    $error_messages = array();
                                   
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
                            $error_messages["errors"][] = constant('ExceptionMessages::'.$duplicateValue). ' : ' . $school_unit_worker_id . constant('SyncExceptionMessages::SyncExceptionCodePreMessage'). constant('ExceptionCodes::'.$duplicateValue);    

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
                   $error_messages["errors"][] = SyncExceptionMessages::DuplicateSyncSchoolUnitWorkerValue. ':' . $schoolUnitWorkerEntity->getSchoolUnitWorkerId() .SyncExceptionMessages::SyncExceptionCodePreMessage.SyncExceptionCodes::DuplicateSyncSchoolUnitWorkerValue;                 

                }
 
                //==================================================================================  
        
                    if (!$error_messages && $action === 'CREATE'){    
                        
                                    $entityManager->persist($schoolUnitWorkerEntity);
                                    $entityManager->flush($schoolUnitWorkerEntity);
                                    
                        $inserts++;
                        $final_results["status"] = SyncExceptionCodes::SuccessSyncSchoolUnitWorkersRecord;
                        $final_results["message"] = SyncExceptionMessages::SuccessSyncSchoolUnitWorkersRecord;
                        $final_results["action"] = 'insert';
                        $final_results["school_unit_worker_id"] = $schoolUnitWorkerEntity->getSchoolUnitWorkerId();
                        $results["all_inserts"][]=$final_results;
                        
                    } elseif (!$error_messages && $action === 'UPDATE'){
                        
                                    $entityManager->persist($schoolUnitWorkerEntity);
                                    $entityManager->flush($schoolUnitWorkerEntity);
                                    
                        $updates++;
                        $final_results["status"] = SyncExceptionCodes::SuccessSyncUpdateSchoolUnitWorkersRecord;
                        $final_results["message"] = SyncExceptionMessages::SuccessSyncUpdateSchoolUnitWorkersRecord;
                        $final_results["action"] = 'update';
                        $final_results["school_unit_worker_id"] = $schoolUnitWorkerEntity->getSchoolUnitWorkerId();
                        $results["all_updates"][]=$final_results;
                                
                    } else {
                        
                        $errors++;
                        $final_results["status"] = SyncExceptionCodes::FailureSyncSchoolUnitWorkersRecord;
                        $final_results["message"] = SyncExceptionMessages::FailureSyncSchoolUnitWorkersRecord;
                        $final_results["action"] = 'error';
                        $final_results["school_unit_worker_id"] = $schoolUnitWorkerEntity->getSchoolUnitWorkerId();
                            
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
    $filename = $timer->getTimeFileName('school_unit_workers');

    $cachePath = $filepath.$filename; 
    file_put_contents($cachePath,JsonFunctions::toGreek(json_encode($print_results),TRUE));
    $href = $Options["SyncFolder"].$filename;
    
    echo $timer->printFullStats();
    echo "Επεστράφησαν συνολικά " . $results["total"] . " στοιχεία από το mmsch </br>" ;
    echo "Εισαγωγή " . $results["all_logs"]["all_inserts"] . " στοιχεία από το mmsch </br>" ;
    echo "Ενημερώθηκαν " . $results["all_logs"]["all_updates"] . " στοιχεία από το mmsch </br>" ;
    echo "Βρέθηκαν " . $results["all_logs"]["all_errors"] . " προειδοποιήσεις για το συγχρονισμό με το mmsch </br>" ;
    echo "Βρέθηκαν " . $results["all_logs"]["all_unexpected_errors"] . " κρίσιμα λάθη για το συγχρονισμό με το mmsch </br>" ;
    echo '</br> Finished Sync SchoolUnitWorkers table. </br> View results at <a href='.$href.'>SchoolUnitWorkerLog.json</a>  ' ;
    
} catch (Exception $e) {
    throw $e;
}
    
?>