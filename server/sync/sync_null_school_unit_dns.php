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
    
    //check for null unit_dns
    $params = array("page"=>"1","pagesize"=>"500","unit_dns"=>"null");
        
    $all_logs = array();
    $check_total_download = $previous_data_total = 0;

    //init and start timer
    $timer=new Timing;
    $timer->start();
    
try{ 
    echo "Starting Sync ONLY NULL Unit Dns field of School_Units table \n\n";   
 
    do{ 
        
        $updates=$errors=$unexpected_errors=0;
        $result = array();
        
        //make the http request to mmsch with cURL 
        $curl = curl_init($Options['ServerURL']."school_units");
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $Options['Server_MyLab_username'] . ":" . $Options['Server_MyLab_password']);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode( $params ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $data = json_decode( curl_exec($curl), true );

        //log general infos from received data of the mmsch
        $results["sync_table"] = "School_Units";
        $results["total"] = (int)$data["total"];
        
        //$result["data_mmsch"] = $data["data"];//show all mmsch data from get_function of curl  
        $result["block_general"][] = array( "page" => $params["page"],
                                            "count"      => $data["count"],
                                            "status"     => $data["status"],
                                            "message"    => $data["message"]
                                          ); 

        //CHECKING STATE (1) 
        //check if sync with mylab return error code        
        if ($data["status"] != 200){
            $result["block_error_sync"] = true;                 
        } else {
            $result["block_error_sync"] = false;
        }

        if (Validator::IsEmptyArray($data["data"]) || Validator::IsNull($data["data"])){echo ' No data to sync school_units table';die();}      
 	echo '---Count of returned Data ' . count($data["data"]) . ' :--------';
        
	//get each school_unit data record 
        foreach($data["data"] as $school_unit)
        {    
       
            //get records
            $school_unit_id = $school_unit["school_unit_id"];
            
            $check_total_download++;
            
                try {
                    $error_messages = array();

                    //mmsch parameters
                    $params_unit_dns = array("unit" => $school_unit_id);

                    //make the http request to mmsch with cURL 
                    $curl_unit_dns = curl_init($Options['Server_Mmsch']."/unit_dns");
                    curl_setopt($curl_unit_dns, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                    curl_setopt($curl_unit_dns, CURLOPT_USERPWD, $Options['Server_Mmsch_username'] . ":" . $Options['Server_Mmsch_password']);
                    curl_setopt($curl_unit_dns, CURLOPT_CUSTOMREQUEST, "GET");
                    curl_setopt($curl_unit_dns, CURLOPT_POSTFIELDS, json_encode( $params_unit_dns ));
                    curl_setopt($curl_unit_dns, CURLOPT_RETURNTRANSFER, true);
                    $data_unit_dns = json_decode( curl_exec($curl_unit_dns), true );

                         if ($data_unit_dns["status"] != 200){
                            $error_messages["errors"][] = $data_unit_dns["message"] . " Κωδικός Σχολικής Μονάδας : " . $school_unit_id ; 
                         } else if (Validator::IsEmptyArray($data_unit_dns["data"])){
                            $error_messages["errors"][] = "Δεν υπαρχει ακόμα dns_name για τον Κωδικό Σχολικής Μονάδας : " . $school_unit_id ;                         
                         } else {
                            echo  "Found unit_dns = " . $data_unit_dns["data"][0]["unit_dns"] . " with school_unit_id " .$school_unit_id . "\n";
                         
                        
                            //init entity for update row================================     
                            $fSchoolUnit = CRUDUtils::syncCheckIdParam($school_unit_id, 'SchoolUnitID');

                            if (!validator::IsNull($fSchoolUnit['id'])) {

                             $retrievedObject= $entityManager->find('SchoolUnits', $fSchoolUnit['id']);
                             $duplicateValue = 'DuplicateSchoolUnitUniqueValue';

                                if (count($retrievedObject) == 1) {
                                    $status = 'UPDATE';
                                    $unit = $retrievedObject;
                                } else {
                                    $status = 'DUPLICATE';  
                                    $error_messages["errors"][] = constant('ExceptionMessages::'.$duplicateValue). ' : ' . $school_unit_id . constant('ExceptionMessages::SyncExceptionCodePreMessage'). constant('ExceptionCodes::'.$duplicateValue);    

                                }

                            } else {
                                $error_messages["errors"][] = $fSchoolUnit['error_message']; 
                            }

                            //$unit_dns=================================================                 
                            $fUnitDns = CRUDUtils::syncEntitySetParam($unit, $data_unit_dns["data"][0]["unit_dns"], 'UnitDns', 'unitDns'); 
                            if (!validator::IsNull($fUnitDns)) {$error_messages["errors"][] = $fUnitDns; }    
             
                             
                         }
        //counter
        if (!$error_messages && ($status == ('UPDATE') ) ){                        

            //insert to db==================================================================  
            $entityManager->persist($unit);
            $entityManager->flush($unit);

            //various messages======================================================                         
            $updates++;
            $final_results["status"] = ExceptionCodes::SuccessSyncUpdateSchoolUnitsRecord;
            $final_results["message"] = ExceptionMessages::SuccessSyncUpdateSchoolUnitsRecord;
            $final_results["action"] = 'update';
            $final_results["school_unit_id"] = $unit->getSchoolUnitId();
            $results["all_updates"][]=$final_results;

        } else {

                $final_results["school_unit_id"] = $school_unit_id;
                $final_results["status"] = ExceptionCodes::FailureSyncSchoolUnitsRecord;
                $final_results["message"] = ExceptionMessages::FailureSyncSchoolUnitsRecord;
                $final_results["action"] = 'error';
                $errors++;

        }
        
            //merge and show messagew
            $combinedData = array_merge($error_messages,$final_results); 
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
        $block_log["block_log"]= array( "updates" => $updates,
                                        "errors" => $errors,
                                        "unexpected_errors" => $unexpected_errors
                                );
        $all_logs["block_logs"][] = $block_log["block_log"];
      

        //merge block results and go to next block 
        $result_block[] = array_merge($result,$block_log); 

        echo ' Results ' . $params["page"] . ' page block of ' . $params["pagesize"]."\n";
        echo ' Pagination ' . ($params["page"]-1) * $params["pagesize"]."\n" ;
        echo ' Total Data ' .  $data["total"]."\n";
        
        echo $params["page"];
        
        echo "Data blog has " . $updates . " updates and has page number = " . $params["page"] ."/n";        
    	if ($params["page"]==1 && $updates!=0){
            $params["page"] = 1;
        } else if ($updates!=0){
            $params["page"] = $params["page"] - 1;
        } else {
            $params["page"]++;
        }
        
        echo "Goto page number=". $params["page"] ."/n";  
        
	
    }while( ($params["page"]-1) * $params["pagesize"] < $data["total"]);

    //count log time,errors and success statistics
    foreach ($all_logs["block_logs"] as $option) {
      $all_updates += $option['updates'];
      $all_errors += $option['errors'];
      $all_unexpected_errors += $option['unexpected_errors'];
    }
    
    $results["all_logs"] = array( "all_updates" => $all_updates,
                                  "all_errors" => $all_errors,                        
                                  "all_unexpected_errors" => $all_unexpected_errors,
                           );
    
        
    $false_block = $true_block =0;
    foreach ($result_block as $check_error_code){
      ($check_error_code["block_error_sync"] == true) ?  $false_block++ :  $true_block++;
    }
    
    $timer->stop();
    $results["time_stats"] = $timer->getFullStats();  
    
    $print_results = array_merge($result_block,$results);

    
    $filepath = realpath(basename(getenv("SCRIPT_NAME")));
    $filename = $timer->getTimeFileName('null_school_units_dns');

    $cachePath = $filepath.$filename; 
    file_put_contents($cachePath,JsonFunctions::toGreek(json_encode($print_results),TRUE));
    $href = $Options["SyncFolder"].$filename;
  
    echo $timer->printFullStats();
    echo "Επεστράφησαν συνολικά " . $results["total"] . " στοιχεία από το mmsch \n" ;//todo must change, because shown the last total results
    echo "Ενημερώθηκαν " . $results["all_logs"]["all_updates"] . " στοιχεία από το mmsch [UPDATE] \n\n" ;
    echo "Βρέθηκαν " . $results["all_logs"]["all_errors"] . " προειδοποιήσεις για το συγχρονισμό με το mmsch [ERRORS] \n" ;
    echo "Βρέθηκαν " . $results["all_logs"]["all_unexpected_errors"] . " κρίσιμα λάθη για το συγχρονισμό με το mmsch [CRITICAL ERRORS] \n" ;
    echo "\n Finished Sync School_Units table. View results at " . $href . "\n";
    
} catch (Exception $e) {
    throw $e;
}
    
?>