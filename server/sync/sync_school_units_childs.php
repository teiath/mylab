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
    
    //mmsch parameters
    $params = array(
    //"mm_id" => "1016860",
    "legal_character" => 1, //"ΔΗΜΟΣΙΟ",
    "category" => 1, //"ΣΧΟΛΙΚΕΣ ΜΟΝΑΔΕΣ",
    "orderby" => "mm_id",
    "ordertype" => "ASC",
    "pagesize" => "500",
    "page" => "1"
    );
    
    
    $all_logs = array();
    $check_total_download = 0;
    $circuit_success=$circuit_failure=$worker_failure=$worker_success=$school_unit_worker_success=$school_unit_worker_failure=0; 
    
    //init and start timer
    $timer=new Timing;
    $timer->start();
  
try{ 
    echo "Starting Sync School_Units table \n\n";   
 
    do{ 
        
        $inserts=$updates=$errors=$garbages=$unexpected_errors=$ignore_updates=0;
         $result = array();
       
        //make the http request to MMSCH with cURL 
        $data = SYNCUtils::apiRequest($Options['Server_Mm'], $Options['Server_Mm_username'], $Options['Server_Mm_password'], 'units', 'GET', $params);

        //log general infos from received data of the mmsch
        $results["sync_table"] = "School_Units";
        $results["total"] = (int)$data["total"];
        
        //$result["data_mmsch"] = $data["data"];//show all mmsch data from get_function of curl  
        $result["block_general"][] = array( "page" => (int)$params["page"],
                                            "count"      => $data["count"],
                                            "status"     => $data["status"],
                                            "message"    => $data["message"]
                                          ); 
  
        //CHECKING STATE (1) 
        //check if sync with mmsch return error code        
        if ($data["status"] != 200){
            $result["block_error_sync"] = true;                 
        } else {
            $result["block_error_sync"] = false;
        }
   
        if (Validator::IsEmptyArray($data["data"]) || Validator::IsNull($data["data"])){echo ' No data to sync at units table';die();}     
 	echo '---Count of returned Data ' . $data["count"] . ' :--------';
        
        //get each school_unit data record 
        foreach($data["data"] as $school_unit)
        {    
    
            $school_unit_id = $school_unit["mm_id"];
            $name = $school_unit["name"];
            $special_name = $school_unit["special_name"];
            $last_update = $school_unit["last_sync"];//school_unit["last_update"]
            $fax_number = $school_unit["fax_number"];
            $phone_number = $school_unit["phone_number"];
            $email = $school_unit["email"];
            $street_address = $school_unit["street_address"];
            $postal_code = $school_unit["postal_code"];
            $region_edu_admin = $school_unit["region_edu_admin_id"];
            $edu_admin = $school_unit["edu_admin_id"];
            $transfer_area = $school_unit["transfer_area_id"];
            $municipality = $school_unit["municipality_id"];
            $prefecture = $school_unit["prefecture_id"];
            $education_level = $school_unit["education_level_id"];
            $school_unit_type = $school_unit["unit_type_id"];
            $state = $school_unit["state_id"];
            $unit_dns = $school_unit["unit_dns"][0]["unit_dns"];
          
            $check_total_download++;
            
            $mmsch_data["mmsch_data"] = array( "school_unit_id" => $school_unit_id,
                                               "name"=> $name,
                                               "special_name"=> $special_name,                                              
                                               "last_sync"=> $last_update,//"last_update"=> $last_update,
                                               "fax_number"=> $fax_number,
                                               "phone_number"=> $phone_number,
                                               "email"=> $email,
                                               "street_address"=> $street_address,
                                               "postal_code"=> $postal_code,                                             
                                               "region_edu_admin_id"=> $region_edu_admin,
                                               "edu_admin_id"=> $edu_admin,
                                               "transfer_area_id"=> $transfer_area,
                                               "municipality_id"=> $municipality,
                                               "prefecture_id"=> $prefecture,                                            
                                               "education_level_id"=> $education_level,
                                               "school_unit_type_id"=> $school_unit_type,
                                               "state_id"=> $state,
                                               "unit_dns"=> $unit_dns
                                                );
                              
                try {
                    $error_messages = $all_circuit_infos = $all_worker_infos = $all_school_unit_worker_infos = array();
                 
//TODO vale 3 elegxous na exei id,onoma,imerominia
    
                    //$school_unit_id===========================================================================  
                    $fSchoolUnit = CRUDUtils::syncCheckIdParam($school_unit_id, 'SchoolUnitID');
                    if (!validator::IsNull($fSchoolUnit['id'])) {

                        $retrievedObject= $entityManager->find('SchoolUnits', $fSchoolUnit['id']);
                        $duplicateValue = 'DuplicateSchoolUnitUniqueValue';

                        if(!isset($retrievedObject)) {
                            $status = 'CREATE';
                            $unit = new SchoolUnits(); 
                            $unit->setSchoolUnitId($fSchoolUnit['id']);

                        } else if (count($retrievedObject) == 1) {
                            $status = 'UPDATE';
                            $unit = $retrievedObject;
                            $lastUpdateTableRow = $unit->getLastUpdate();

                        } else {
                            $status = 'DUPLICATE';  
                            $error_messages["errors"][] = constant('ExceptionMessages::'.$duplicateValue). ' : ' . $school_unit_id . constant('ExceptionMessages::SyncExceptionCodePreMessage'). constant('ExceptionCodes::'.$duplicateValue);    

                        }

                    } else {
                        $error_messages["errors"][] = $fSchoolUnit['error_message']; 
                    } 
                                
//$last_update============================================================================
                       
       if (Validator::IsNull($last_update))
            $error_messages["errors"][] = constant('ExceptionMessages::MissingLabTransitionDateValue') . ':' . $last_update . constant('ExceptionMessages::SyncExceptionCodePreMessage'). constant('ExceptionCodes::MissingLabTransitionDateValue');
       else if (Validator::IsArray($last_update))
            $error_messages["errors"][] = constant('ExceptionMessages::InvalidLabTransitionDateArray') . ':' . $last_update . constant('ExceptionMessages::SyncExceptionCodePreMessage'). constant('ExceptionCodes::InvalidLabTransitionDateArray');
       else if (! Validator::IsValidDate($last_update) )
            $error_messages["errors"][] = constant('ExceptionMessages::InvalidLabTransitionValidType') . ':' . $last_update . constant('ExceptionMessages::SyncExceptionCodePreMessage'). constant('ExceptionCodes::InvalidLabTransitionValidType'); 
       else if (Validator::IsDate($last_update))
           $dateTime = new \DateTime($last_update);
       else
            $error_messages["errors"][] = constant('ExceptionMessages::InvalidLabTransitionDateType') . ':' . $last_update . constant('ExceptionMessages::SyncExceptionCodePreMessage'). constant('ExceptionCodes::InvalidLabTransitionDateType');
 
// var_dump($lastUpdateTableRow->format('Y-m-d H:m:s'));     
// var_dump($dateTime->format('Y-m-d H:m:s'));
       
//validate that new date is greater than previous date==========================
        $action = "continue";
        if ($status == 'UPDATE' && $argv[1]!='update_all') {
            $previous_date = Validator::IsNull($lastUpdateTableRow) ? strtotime('0000-00-00 00:00:00') : strtotime($lastUpdateTableRow->format('Y-m-d H:m:s'));
            $new_date = strtotime($dateTime->format('Y-m-d H:m:s'));

            if (Validator::isLowerThan($new_date, $previous_date, true)){ 
                $action = "exit";
            }         
        }

        //SET last_update to CREATE
        $unit->setLastUpdate($dateTime);

        //for below variables if syncEntitySetAssociation or syncEntitySetParam
        //return null then all is ok
        //else return error
//$region_edu_admin_id===========================================================================                  
    $fRegionEduAdmin = CRUDUtils::syncEntitySetAssociation($unit, $region_edu_admin, 'RegionEduAdmins', 'regionEduAdmin', 'RegionEduAdmin', false); 
    if (!validator::IsNull($fRegionEduAdmin)) {$error_messages["errors"][] = $fRegionEduAdmin; }
             
//$edu_admin_id===========================================================================
    $fEduAdmin = CRUDUtils::syncEntitySetAssociation($unit, $edu_admin, 'EduAdmins', 'eduAdmin', 'EduAdmin', false);
    if (!validator::IsNull($fEduAdmin)) {$error_messages["errors"][] = $fEduAdmin; }
      
//$transfer_area_id=========================================================================== 
    $fTransferArea = CRUDUtils::syncEntitySetAssociation($unit, $transfer_area, 'TransferAreas', 'transferArea', 'TransferArea', false);
    if (!validator::IsNull($fTransferArea)) {$error_messages["errors"][] = $fTransferArea; }
    
//$municipality_id===========================================================================
    $fMunicipality = CRUDUtils::syncEntitySetAssociation($unit, $municipality, 'Municipalities', 'municipality', 'Municipality', false);
    if (!validator::IsNull($fMunicipality)) {$error_messages["errors"][] = $fMunicipality; }
    
//$prefecture_id===========================================================================
    $fPrefecture = CRUDUtils::syncEntitySetAssociation($unit, $prefecture, 'Prefectures', 'prefecture', 'Prefecture', false);
    if (!validator::IsNull($fPrefecture)) {$error_messages["errors"][] = $fPrefecture; }
    
//$education_level_id===========================================================================
    $fEducationLevel = CRUDUtils::syncEntitySetAssociation($unit, $education_level, 'EducationLevels', 'educationLevel', 'EducationLevel', false);                   
    if (!validator::IsNull($fEducationLevel)) {$error_messages["errors"][] = $fEducationLevel; }
    
//$school_unit_type_id===========================================================================
    $fSchoolUnitType = CRUDUtils::syncEntitySetAssociation($unit, $school_unit_type, 'SchoolUnitTypes', 'schoolUnitType', 'SchoolUnitType');
    if (!validator::IsNull($fSchoolUnitType)) {$error_messages["errors"][] = $fSchoolUnitType; }
    
//$state_id===========================================================================
    $fState = CRUDUtils::syncEntitySetAssociation($unit, $state, 'States', 'state', 'State');
    if (!validator::IsNull($fState)) {$error_messages["errors"][] = $fState; }

//$unit_dns===========================================================================
   $fUnitDns = CRUDUtils::syncEntitySetParam($unit, $unit_dns, 'SchoolUnitUnitDns', 'unit_dns');
    if (!validator::IsNull($fUnitDns)) {$error_messages["errors"][] = $fUnitDns; }    
    
//$fax_number===========================================================================
   $fFaxNumber = CRUDUtils::syncEntitySetParam($unit, $fax_number, 'SchoolUnitFaxNumber', 'fax_number');
    if (!validator::IsNull($fFaxNumber)) {$error_messages["errors"][] = $fFaxNumber; }    
    
//$phone_number===========================================================================
   $fPhoneNumber = CRUDUtils::syncEntitySetParam($unit, $phone_number, 'PhoneNumber', 'phoneNumber');
    if (!validator::IsNull($fPhoneNumber)) {$error_messages["errors"][] = $fPhoneNumber; }    
    
//$email===========================================================================
   $fEmail = CRUDUtils::syncEntitySetParam($unit, $email, 'Email', 'email');
    if (!validator::IsNull($fEmail)) {$error_messages["errors"][] = $fEmail; }      
    
//$street_address===========================================================================
   $fStreetAddress = CRUDUtils::syncEntitySetParam($unit, $street_address, 'StreetAddress', 'street_address');
    if (!validator::IsNull($fStreetAddress)) {$error_messages["errors"][] = $fStreetAddress; }                   
    
//$postal_code===========================================================================
   $fPostalCode = CRUDUtils::syncEntitySetParam($unit, $postal_code, 'PostalCode', 'postal_code');
   if (!validator::IsNull($fPostalCode)) {$error_messages["errors"][] = $fPostalCode; }                 
   
//$special_name============================================================================
   $fSpecialType = CRUDUtils::syncEntitySetParam($unit, $special_name, 'SpecialName', 'specialName');
   if (!validator::IsNull($fSpecialType)) {$error_messages["errors"][] = $fSpecialType; }

//$name=========================================================================

    $checkVars = array("ΔΗΜΟΤΙΚΟ ΣΧΟΛΕΙΟ Α","ΔΗΜΟΤΙΚΟ ΣΧΟΛΕΙΟ",
                       "ΝΗΠΙΑΓΩΓΕΙΟ Α","ΝΗΠΙΑΓΩΓΕΙΟ",
                       "ΔΗΜΟΤΙΚΟ ΣΧΟΛΕΙΟ ΑΑΑΑΑΑΑΑΑΑΑΑΑ",
                       "ΔΗΜΟΤΙΚΟ ΣΧΟΛΕΙΟ ΑΑΑΑΑΑΑΑΑΑΑΑ",
                       "ΔΗΜΟΤΙΚΟ ΣΧΟΛΕΙΟ ΑΑΑΑΑΑΑΑΑΑΑ",
                       "ΔΗΜΟΤΙΚΟ ΣΧΟΛΕΙΟ Χ","ΝΗΠΙΑΓΩΓΕΙΟ Χ",
                       "ΔΗΜΟΤΙΚΟ ΣΧΟΛΕΙΟ Ο");
    
    if (! trim($name) )
        $error_messages["errors"][] =  ExceptionMessages::MissingSchoolUnitNameValue.$name.ExceptionMessages::SyncExceptionCodePreMessage.ExceptionCodes::MissingSchoolUnitNameValue;
    else if (in_array(trim($name), $checkVars)){
        $error_messages["garbages"][] = ExceptionMessages::GarbageRowSchoolUnitNameValue .' name = ' . $name . ' id = '.$fSchoolUnit['id'].ExceptionMessages::SyncExceptionCodePreMessage.ExceptionCodes::GarbageRowSchoolUnitNameValue;
        $action='exit_garbage';
    } else {
        $unit->setName(Validator::ToValue($name));
    }
      
//check if a unit has same name,edu_admin and special name with another one
      if ($status == 'CREATE') {
        $checkDuplicate = $entityManager->getRepository('SchoolUnits')->findOneBy(array('name'        => $unit->getName(),
                                                                                        'eduAdmin'    => $unit->getEduAdmin(),
                                                                                        'specialName' => $unit->getSpecialName()
                                                                                   ));
    
        if (count($checkDuplicate) !== 0)
            $error_messages["errors"][] = constant('ExceptionMessages::DuplicatedSchoolUnitValue') . ':' . $unit->getSchoolUnitId() . constant('ExceptionMessages::SyncExceptionCodePreMessage'). constant('ExceptionCodes::DuplicatedSchoolUnitValue');                 
      }
      
//print_r($error_messages);
//echo $action;

    if (!$error_messages && $action === 'continue' && ($status == ('UPDATE' || 'CREATE')) ){                        

        //insert to db==================================================================  
        $entityManager->persist($unit);
        $entityManager->flush($unit);
       
        //various messages======================================================                   
                          
        if ($status === 'UPDATE' ){            

            $updates++;
            $final_results["status"] = ExceptionCodes::SuccessSyncUpdateSchoolUnitsRecord;
            $final_results["message"] = ExceptionMessages::SuccessSyncUpdateSchoolUnitsRecord;
            $final_results["action"] = 'update';
            $final_results["school_unit_id"] = $unit->getSchoolUnitId();
            $results["all_updates"][]=$final_results;
            
                           //find lab_ids and change state if needed================================     
                            $findLabs = $entityManager->getRepository('Labs')->findBy(array( 'schoolUnit' => $unit->getSchoolUnitId()));
                            $fSchoolUnitStateId = $unit->getState()->getStateId();

                             foreach ($findLabs as $findLab) {
                                 $fLabSchoolUnitId = $findLab->getSchoolUnit()->getSchoolUnitId();
                                 $fLabId = $findLab->getLabId(); 
                                 $fLabStateId = $findLab->getState()->getStateId();

                                 //check if updated school unit has different state value from lab state
                                 if ( ($fLabStateId !== $fSchoolUnitStateId ) && ($fLabStateId != 3) )  {

                                     //mmsch parameters
                                     $params_transitions = array("lab_id" => $fLabId,
                                                                "state" => 3,//$fSchoolUnitStateId 
                                                                "transition_date" => date('Y-m-d H:i:s'),
                                                                "transition_justification" => "Αλλαγή Κατάστασης με βάση των συγχρονισμό σχολικών μονάδων",
                                                                "transition_source" => "mmsch"
                                                                );

                                     //make the http request to MYLAB with cURL                             
                                     $data_transitions = SYNCUtils::apiRequest($Options['Server_MyLab'], $Options['Server_MyLab_username'], $Options['Server_MyLab_password'], 'lab_transitions', 'POST', $params_transitions);

                                     if ($data_transitions["status"] != 200){
                                         $error_messages["errors"][] = $data_transitions["message"] . " Κωδικός Σχολικής Μονάδας : " . $fLabSchoolUnitId . " Κωδικός Εργαστηρίου : " . $fLabId; 
                                     } else {
                                         echo  "Changed lab state of lab_id = " . $fLabId . " from school_unit_id " .$fLabSchoolUnitId . "\n";
                                     }

                                 }

                             }
            
    
                            
        } else if ($status === 'CREATE'){

            $inserts++;
            $final_results["status"] = ExceptionCodes::SuccessSyncSchoolUnitsRecord;
            $final_results["message"] = ExceptionMessages::SuccessSyncSchoolUnitsRecord;
            $final_results["action"] = 'insert';
            $final_results["school_unit_id"] = $unit->getSchoolUnitId();
            $results["all_inserts"][]=$final_results;
        }

        //CIRCUIT===============================================================
        //======================================================================
        if ( (!Validator::IsNull($school_unit['circuits'])) && (!Validator::IsEmptyArray($school_unit['circuits'])) ){
            foreach ($school_unit['circuits'] as $circuit){
          
                $circuit_infos = addCircuit(  $circuit["circuit_id"],$circuit["phone_number"],
                                              $circuit["updated_date"], $circuit["status"],                        
                                              $circuit["circuit_type_id"], $school_unit_id
                                              ); 

                $all_circuit_infos[] = $circuit_infos;
                if (($circuit_infos['circuit_results']['action'] == 'error') || ($circuit_infos['circuit_results']['action'] == 'unexpected_error')) {
                    $circuit_failure++; 
                    $results["all_circuit_errors"][]=$circuit_infos['circuit_results'];
                }else
                    $circuit_success++ ;
                
            }
        }   
         //WORKER===============================================================
        //======================================================================
        if ( (!Validator::IsNull($school_unit['workers'])) && (!Validator::IsEmptyArray($school_unit['workers'])) ){
            foreach ($school_unit['workers'] as $worker){

                $worker_infos = addWorker(  $worker['worker_id'], $worker['registry_no'], $worker['tax_number'], 
                                            $worker['lastname'], $worker['firstname'], $worker['fathername'], 
                                            $worker['sex'], $worker['worker_specialization_id'], $worker['worker_source_id'] 
                                          );

                $all_worker_infos[] = $worker_infos;
                if (($worker_infos['worker_results']['action'] == 'error') || ($worker_infos['worker_results']['action'] == 'unexpected_error')) {
                    $worker_failure++ ;
                    $results["all_worker_errors"][]=$worker_infos['worker_results'];
                } else
                    $worker_success++ ;


                $school_unit_worker_infos = addSchoolUnitWorker( $worker['unit_worker_id'], $school_unit_id,
                                                                 $worker['worker_id'], $worker['worker_position_id']
                                                                );

                $all_school_unit_worker_infos[] = $school_unit_worker_infos;
                if (($school_unit_worker_infos['school_unit_worker_results']['action'] == 'error') || ($school_unit_worker_infos['school_unit_worker_results']['action'] == 'unexpected_error')) {
                    $school_unit_worker_failure++ ;
                    $results["all_school_unit_worker_errors"][]=$school_unit_worker_infos['school_unit_worker_results'];
                } else
                    $school_unit_worker_success++ ;  

            }
        }   
 
    } else {

            $final_results["school_unit_id"] = $school_unit_id;

            if ($action === 'exit'){
                $final_results["status"] = ExceptionCodes::IgnoreSyncSchoolUnitsRecord;
                $final_results["message"] = ExceptionMessages::IgnoreSyncSchoolUnitsRecord;
                $final_results["action"] = 'ignore';
                $ignore_updates++;
            }else if ($action === 'exit_garbage'){
                $final_results["status"] = ExceptionCodes::GarbageSyncSchoolUnitsRecord;
                $final_results["message"] = ExceptionMessages::GarbageSyncSchoolUnitsRecord;
                $final_results["action"] = 'garbage_ignore';
                $garbages++;
            }else {
                $final_results["status"] = ExceptionCodes::FailureSyncSchoolUnitsRecord;
                $final_results["message"] = ExceptionMessages::FailureSyncSchoolUnitsRecord;
                $final_results["action"] = 'error';
                $errors++;
            }

       }   
       
                    $combinedData = array_merge($error_messages,$final_results,$all_circuit_infos,$all_worker_infos,$all_school_unit_worker_infos); //$combinedData = array_merge($mmsch_data, $error_messages,$final_results); change with this if you want extra infos 
                    $result["block_results"][] = $combinedData; 
  
                    if ($final_results["action"]!=='ignore'){
                        echo "SchoolUnitID : " . $final_results["school_unit_id"] . " Action : " . $final_results["action"] . " Record : " . $check_total_download . " on page block " . $params["page"] . "\n";
                    }
                    
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
                                        "garbages" => $garbages,
                                        "unexpected_errors" => $unexpected_errors,
                                        "ignore_updates" => $ignore_updates
                                );
        $all_logs["block_logs"][] = $block_log["block_log"];
      
         
        //merge block results and go to next block 
        $result_block[] = array_merge($result,$block_log); 
        $params["page"]++;
        //echo 'Results ' . $params["page"] . ' block';
    }while( ($params["page"]-1) * $params["pagesize"] < $data["total"]);

  
    
    //count log time,errors and success statistics
    foreach ($all_logs["block_logs"] as $option) {
      $all_inserts += $option['inserts'];
      $all_updates += $option['updates'];
      $all_errors += $option['errors'];
      $all_garbages += $option['garbages'];
      $all_unexpected_errors += $option['unexpected_errors'];
      $all_ignore_updates += $option['ignore_updates'];
    }
    
    $results["all_logs"] = array( "all_inserts" => $all_inserts,
                                  "all_updates" => $all_updates,
                                  "all_errors" => $all_errors,
                                  "all_garbages" => $all_garbages,
                                  "all_unexpected_errors" => $all_unexpected_errors,
                                  "all_ignore_updates" => $all_ignore_updates
                           );
    
    
    
    $sum_all = $results["all_logs"]["all_inserts"] + $results["all_logs"]["all_updates"] + $results["all_logs"]["all_errors"] + $results["all_logs"]["all_ignore_updates"];
    
    $false_block = $true_block =0;
    foreach ($result_block as $check_error_code){
      ($check_error_code["block_error_sync"] == true) ?  $false_block++ :  $true_block++;
    }
          
    $timer->stop();
    $results["time_stats"] = $timer->getFullStats();  
    
    $print_results = array_merge($result_block,$results);

    //echo JsonFunctions::toGreek(json_encode($print_results),TRUE);
    
    $filepath = realpath(basename(getenv("SCRIPT_NAME")));
    $filename = $timer->getTimeFileName('school_units');

    $cachePath = $filepath.$filename; 
    file_put_contents($cachePath,JsonFunctions::toGreek(json_encode($print_results),TRUE));
    $href = $Options["WebSyncFolder"].$filename;

    echo $timer->printFullStats();
    echo "Επεστράφησαν συνολικά " . $results["total"] . " στοιχεία από το mmsch \n" ;
    echo "Εισαγωγή " . $results["all_logs"]["all_inserts"] . " στοιχεία από το mmsch [INSERT] \n" ;
    echo "Ενημερώθηκαν " . $results["all_logs"]["all_updates"] . " στοιχεία από το mmsch [UPDATE] \n\n" ;
    echo "Βρέθηκαν " . $results["all_logs"]["all_ignore_updates"] . " ενημερωμένες εγγραφές κατά το συγχρονισμό με το mmsch  και αγνοήθηκαν [IGNORE UPDATES] \n\n" ;
    echo "Βρέθηκαν " . $results["all_logs"]["all_errors"] . " προειδοποιήσεις για το συγχρονισμό με το mmsch [ERRORS] \n" ;
    echo "Βρέθηκαν " . $results["all_logs"]["all_garbages"] . " δοκιμαστικές εγγραφές κατά το συγχρονισμό με το mmsch  και αγνοήθηκαν [IGNORE GARBAGES] \n" ;
    echo "Βρέθηκαν " . $results["all_logs"]["all_unexpected_errors"] . " κρίσιμα λάθη για το συγχρονισμό με το mmsch [CRITICAL ERRORS] \n" ;
        echo "Βρέθηκαν " . $circuit_success . " δημιουργιες/ενημερωσεις κυκλωματων για το συγχρονισμό με το mmsch [CΙRCUIT SUCCESS] \n" ;
        echo "Βρέθηκαν " . $circuit_failure . " λαθη/μη αναμενομενα λαθη κυκλωματων για το συγχρονισμό με το mmsch [CΙRCUIT FAILURE] \n" ;
        echo "Βρέθηκαν " . $worker_success . " δημιουργιες/ενημερωσεις εργαζόμενων για το συγχρονισμό με το mmsch [WORKER SUCCESS] \n" ;
        echo "Βρέθηκαν " . $worker_failure . " λαθη/μη αναμενομενα λαθη εργαζόμενων για το συγχρονισμό με το mmsch [WORKER FAILURE] \n" ;
        echo "Βρέθηκαν " . $school_unit_worker_success . " δημιουργιες/ενημερωσεις συσχετισης εργαζομενων-μονάδας για το συγχρονισμό με το mmsch [SCHOOL UNIT WORKER SUCCESS] \n" ;
        echo "Βρέθηκαν " . $school_unit_worker_failure . " λαθη/μη αναμενομενα λαθη εργαζομενων-μονάδας για το συγχρονισμό με το mmsch [SCHOOL UNIT WORKER FAILURE] \n" ;
    echo "\n Finished Sync School_Units table. View results at " . $href . "\n";
    
} catch (Exception $e) {
    throw $e;
}
    
?>