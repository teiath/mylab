<?php
/**
 *
 * @version 2.0
 * @author  ΤΕΙ Αθήνας
 * @package SYNC
 * 
 */
function syncTransferAreas(){
    header("Content-Type: text/html; charset=utf-8");
    
    global $Options; 
    global $entityManager;
    
    //check with params
    $params = array("page"=>"1",
                    "pagesize"=>"500");
    
    $sync_results = $all_logs = array();
    $check_total_download = 0;
    $syncTable = 'transfer_areas';

    //init and start timer
    $timer=new Timing;
    $timer->start();
    
try{ 
    $sync_results['syncTable'] = $syncTable;

    do{ 
        
        $inserts=$updates=$errors=$unexpected_errors=0;
        $result = array();

//start api request and return a block of data==================================
//==============================================================================
        
        $data = SYNCUtils::apiRequest($Options['Server_Mm'], $Options['Server_Mm_username'], $Options['Server_Mm_password'], $syncTable, 'GET', $params);

        //log general infos from received data of the mmsch
        $results["syncTable"] = $syncTable;
        $results["total"] = (int)$data["total"];
   
        $result["block_general"][] = array( "count_page"    => (int)$params["page"],
                                            "count"         => $data["count"],
                                            "status"        => $data["status"],
                                            "message"       => $data["message"]
                                        ); 

        //check if sync with mmsch return error code
        $result["block_error_sync"] = ($data["status"] != 200) ?  true : false;

        if (Validator::IsEmptyArray($data["data"]) || Validator::IsNull($data["data"])){$sync_results['noData'] =  ' No data to sync at ' . $syncTable . ' table ';return $sync_results;}        
 	$sync_results['countData'] =  'Count of returned Data ' . $data["count"] ;

//get each record of block data ================================================
//==============================================================================
        foreach($data["data"] as $transfer_area)
        {    
          
            $transfer_area_id = $transfer_area["transfer_area_id"];
            $name = $transfer_area["transfer_area"];
            $edu_admin_id = $transfer_area["edu_admin_id"];
            
            $check_total_download++;
           
                try {
                    $error_messages = array();
                                   
                    //$transfer_area_id check value and get status(create,update,delete)
                    //==========================================================
                    $fTransferArea = CRUDUtils::syncCheckIdParam($transfer_area_id, 'TransferAreaID');
                    if (!validator::IsNull($fTransferArea['id'])) {

                        $retrievedObject= $entityManager->find('TransferAreas', $fTransferArea['id']);
                        $duplicateValue = 'DuplicateTransferAreaUniqueValue';

                        if(!isset($retrievedObject)) {
                            $action = 'CREATE';
                            $transferAreaEntity = new TransferAreas(); 
                            $transferAreaEntity->setTransferAreaId($fTransferArea['id']);
                        } else if (count($retrievedObject) == 1) {
                            $action = 'UPDATE';
                            $transferAreaEntity = $retrievedObject;
                        } else {
                            $action = 'DUPLICATE';  
                            $error_messages["errors"][] = constant('ExceptionMessages::'.$duplicateValue). ' : ' . $transfer_area_id . constant('SyncExceptionMessages::SyncExceptionCodePreMessage'). constant('ExceptionCodes::'.$duplicateValue);    

                        }

                    } else {
                        $error_messages["errors"][] = $fTransferArea['error_message']; 
                    } 
                      
                //$name=========================================================
                $fName = CRUDUtils::syncEntitySetParam($transferAreaEntity, $name, 'TransferAreaName', 'name', true, false);
                if (!validator::IsNull($fName)) {$error_messages["errors"][] = $fName; }

                //$edu_admin_id===========================================================================                  
                $fEduAdmin = CRUDUtils::syncEntitySetAssociation($transferAreaEntity, $edu_admin_id, 'EduAdmins', 'eduAdmin', 'EduAdmin', true); 
                if (!validator::IsNull($fEduAdmin)) {$error_messages["errors"][] = $fEduAdmin; }
                
                //check unique transfer_area name===================================
                $checkNameDuplicate = $entityManager->getRepository('TransferAreas')->findOneBy(array('name' => $transferAreaEntity->getName() ));

                if ((count($checkNameDuplicate) > 1) || (count($checkNameDuplicate)==1 && ($transferAreaEntity->getName() != $checkNameDuplicate->getName() ))){
                   $error_messages["errors"][] = SyncExceptionMessages::DuplicateSyncTransferAreaNameValue. ':' . $transferAreaEntity->getName() .SyncExceptionMessages::SyncExceptionCodePreMessage.SyncExceptionCodes::DuplicateSyncTransferAreaNameValue;                 

                }
                
                //==============================================================
        
                    if (!$error_messages && $action === 'CREATE'){    
                        
                                    $entityManager->persist($transferAreaEntity);
                                    $entityManager->flush($transferAreaEntity);
                                    
                        $inserts++;
                        $final_results["status"] = SyncExceptionCodes::SuccessSyncTransferAreasRecord;
                        $final_results["message"] = SyncExceptionMessages::SuccessSyncTransferAreasRecord;
                        $final_results["action"] = 'insert';
                        $final_results["transfer_area_id"] = $transferAreaEntity->getTransferAreaId();
                        $results["all_inserts"][]=$final_results;
                        
                    } elseif (!$error_messages && $action === 'UPDATE'){
                        
                                    $entityManager->persist($transferAreaEntity);
                                    $entityManager->flush($transferAreaEntity);
                                    
                        $updates++;
                        $final_results["status"] = SyncExceptionCodes::SuccessSyncUpdateTransferAreasRecord;
                        $final_results["message"] = SyncExceptionMessages::SuccessSyncUpdateTransferAreasRecord;
                        $final_results["action"] = 'update';
                        $final_results["transfer_area_id"] = $transferAreaEntity->getTransferAreaId();
                        $results["all_updates"][]=$final_results;
                                
                    } else {
                        
                        $errors++;
                        $final_results["status"] = SyncExceptionCodes::FailureSyncTransferAreasRecord;
                        $final_results["message"] = SyncExceptionMessages::FailureSyncTransferAreasRecord;
                        $final_results["action"] = 'error';
                        $final_results["transfer_area_id"] = $transferAreaEntity->getTransferAreaId();
                            
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
        
         $sync_results['resultsData'] = ' Results ' . $params["page"] . ' page block of ' . $params["pagesize"];
         $sync_results['paginationData']  = ' Pagination ' . ($params["page"]-1) * $params["pagesize"];
         $sync_results['totalData'] = ' Total Data ' .  $data["total"];
        
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
    
    $filepath = JsonFunctions::truepath();
    $filename = $timer->getTimeFileName($syncTable);

    $cachePath = $filepath.$filename;
    file_put_contents($cachePath, JsonFunctions::toGreek(json_encode($print_results), TRUE));
    $href = $Options["SyncFolder"].$filename;

    $sync_results['executeTime'] = $timer->getFullStats();
    $sync_results['returnedData'] =  "Επεστράφησαν συνολικά " . $results["total"] . " στοιχεία από το mmsch" ;
    $sync_results['insertData'] =  "Εισαγωγή " . $results["all_logs"]["all_inserts"] . " στοιχεία από το mmsch" ;
    $sync_results['updateData'] =  "Ενημερώθηκαν " . $results["all_logs"]["all_updates"] . " στοιχεία από το mmsch" ;
    $sync_results['errorData'] =  "Βρέθηκαν " . $results["all_logs"]["all_errors"] . " προειδοποιήσεις για το συγχρονισμό με το mmsch" ;
    $sync_results['unexpectedErrorData'] =  "Βρέθηκαν " . $results["all_logs"]["all_unexpected_errors"] . " κρίσιμα λάθη για το συγχρονισμό με το mmsch" ;
    $sync_results['hrefLog'] =  'Finished Sync ' . $syncTable . ' table.View results at <a href='.$href.' target="_blank" >' . $syncTable . 'Log.json</a>  ' ;
    
    return $sync_results;
} catch (Exception $e) {
    throw $e;
}
}    
?>