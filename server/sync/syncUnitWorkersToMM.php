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
    
    //set allowed unit types to sync with mm
    //'1'=ΣΕΠΕΗΥ
    $allowedLabTypes = array ( '1' );

    
    //init and start timer
    $timer=new Timing;
    $timer->start();
    
    try{ 
    echo $Messages["infos"][] = "Starting Sync Script Workers MyLab-MM\r\n";
    
    //execution=================================================================
    $qb = $entityManager->createQueryBuilder();
    $qb->select('lw,mlw,wp,ws,l');
    $qb->from('LabWorkers', 'lw');
    $qb->leftjoin('lw.worker', 'mlw');
    $qb->leftjoin('lw.workerPosition', 'wp');
    $qb->leftjoin('mlw.workerSpecialization', 'ws');
    $qb->leftjoin('lw.lab', 'l');
    $qb->andWhere($qb->expr()->isNotNull('l.mmSyncId'));
    $qb->andWhere($qb->expr()->eq('l.submitted', ':value'))->setParameter('value',1);
    $qb->andWhere($qb->expr()->in('l.labType', ':labTypes'))->setParameter('labTypes', $allowedLabTypes);
    $qb->andWhere($qb->expr()->orX( 
                                    $qb->expr()->isNull('lw.mmWorkerSyncLastUpdateDate'),
                                    $qb->expr()->lt('lw.mmWorkerSyncLastUpdateDate', 'lw.insertLabWorkerBy'),
                                    $qb->expr()->lt('lw.mmWorkerSyncLastUpdateDate', 'lw.deleteLabWorkerBy')
                                    ));
    $qb->orderBy('lw.labWorkerId','ASC');

//pagination and results========================================================      
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        
        if ($result["total"]==0) {
           echo $Messages["infos"][] = "Δεν βρέθηκαν εργαζόμενοι προς ενημέρωση\r\n";
        } else {
           
           foreach($results AS $row) {
               
               echo $Messages["infos"][] = 'Συγχρονισμός Εργαζόμενου με Κωδικό ΜΜ : '. $row->getLab()->getMmSyncId(). "...\r\n";
               $unitWorkerMethod = $unitWorkerData = $workerPositionData = $addUnitWorkerData = $workerData = $addWorkerData = $error = null; 
               $postUnitWorkerParams = $putUnitWorkerParams = $deleteUnitWorkerParams = null;
               
//worker properties=============================================================
//check if worker found at mm database else insert worker=======================
                $labWorker_registry_no = array ("registry_no" => $row->getWorker()->getRegistryNo());
                if (Validator::IsNull($labWorker_registry_no['registry_no'])){
                    $Messages["infos"][] ='Δεν βρέθηκε Αριθμός Μητρώου στα στοιχεία του Εργαζόμενου '. $labWorker_registry_no['registry_no'];
                    $error++;
                }

                $workerData = SYNCUtils::apiRequest($Options['Server_Mmsch'], $Options['Server_Mmsch_username'], $Options['Server_Mmsch_password'], 'workers', 'GET', $labWorker_registry_no );
                if ($workerData['status']=='200' && $workerData['total']=='1') {
                     $Messages["infos"][] ='Βρέθηκε ο Εργαζόμενος στην β.δ. του ΜΜ με Αριθμό Μητρώου '. $labWorker_registry_no['registry_no'];
                     $worker_id = $workerData['data'][0]['worker_id'];
                }else{
                    $Messages["infos"][] ='Δεν Βρέθηκε ο Εργαζόμενος στην β.δ. του ΜΜ με Αριθμό Μητρώου '. $labWorker_registry_no['registry_no'];
                    //added worker to mm database===============================
                    $workerParams = array (
                                            "registry_no" => $row->getWorker()->getRegistryNo(),
                                            "lastname" => $row->getWorker()->getLastname(),
                                            "firstname" => $row->getWorker()->getFirstname(),
                                            "fathername" => $row->getWorker()->getFathername(),
                                            "source" => "MyLab",
                                        );
                            
                    $addWorkerData = SYNCUtils::apiRequest($Options['Server_Mmsch'], $Options['Server_Mmsch_username'], $Options['Server_Mmsch_password'], 'workers', 'POST', $workerParams);
                    if($addWorkerData['status'] == 200) {
                         $Messages["infos"][] = 'Ο Εργαζόμενος με τα στοιχεία του καταχωρήθηκε επιτυχώς στην β.δ. ΜΜ';
                         $worker_id = $addWorkerData['worker_id'];
                    } else {
                        $Messages["infos"][] = 'Η καταχώρηση των στοιχείων του εργαζόμενου στην β.δ. ΜΜ δεν ολοκληρώθηκε επιτυχώς';
                        $error++;
                    }
                    
                } 
               
//worker position properties====================================================
                $worker_position_name = array ("worker_position" => $row->getWorkerPosition()->getName());
                if (Validator::IsNull($worker_position_name['worker_position'])){
                    $Messages["infos"][] ='Δεν βρέθηκε η Θέση Ευθύνης του Εργαζόμενου '. $worker_position_name['worker_position'];
                    $error++;
                }

                $workerPositionData = SYNCUtils::apiRequest($Options['Server_Mmsch'], $Options['Server_Mmsch_username'], $Options['Server_Mmsch_password'], 'worker_positions', 'GET', $worker_position_name );
                if ($workerPositionData['status']=='200' && $workerPositionData['total']=='1') {
                echo     $Messages["infos"][] ='Βρέθηκε η Θέση Ευθύνης του Εργαζόμενου '. $worker_position_name['worker_position'];
                     $worker_position_id = $workerPositionData['data'][0]['worker_position_id'];
                }else{
                    $Messages["infos"][] ='Error in worker_position table'.$workerPositionData['message'];
                    $error++;
                }   
  
//unit worker position properties===============================================
                $unit_worker = array ("mm_id" => $row->getLab()->getMmSyncId());             
                if (Validator::IsNull($unit_worker['mm_id'])){
                     $Messages["infos"][] ='Δεν βρέθηκε η Μονάδα για τον Εργαζόμενο '. $unit_worker['mm_id'];
                    $error++;
                }
                
                $unitWorkerParams = array ("unit" => $row->getLab()->getMmSyncId(),'worker_position' => $worker_position_id );
                $unitWorkerData = SYNCUtils::apiRequest($Options['Server_Mmsch'], $Options['Server_Mmsch_username'], $Options['Server_Mmsch_password'], 'unit_workers', 'GET', $unitWorkerParams );
                if ($unitWorkerData['status']=='200' && $unitWorkerData['total']=='1') {
                    $Messages["infos"][] ='Βρέθηκε o Εργαζόμενος να έχει θέση ευθύνης σε Μονάδα '. $unit_worker['mm_id'];
                    $unit_worker_id = $unitWorkerData['data'][0]['unit_worker_id'];
                        
                        //check if worker status has value=3 and delete from MM unit workers OR Update with new worker
                        if ($row->getWorkerStatus() == '3') {
                            $unitWorkerMethod = 'DELETE';
                        } else { 
                            $unitWorkerMethod = 'PUT';
                        }

                } else if ($unitWorkerData['status']=='200' && $unitWorkerData['total'] == '0') {
      
                        //check if worker status has value=3 and delete from MM unit workers OR Update with new worker
                        if ($row->getWorkerStatus() == '3') {
                            $unitWorkerMethod = 'INIT_DELETE';
                        } else { 
                            $unitWorkerMethod = 'POST';
                        }
                        
                } else {
                    $Messages["infos"][] ='Error in unit_worker table'.$unitWorkerData['message'];
                    $error++;
                }
                         
//unit_worker===================================================================
                if ($error==null) { 
                                    
                    $postUnitWorkerParams = array ('worker' => $worker_id , 'mm_id' => $row->getLab()->getMmSyncId() , 'worker_position' => $worker_position_id );    
                    $putUnitWorkerParams = array ('unit_worker_id' => $unit_worker_id, 'worker' => $worker_id , 'mm_id' => $row->getLab()->getMmSyncId() , 'worker_position' => $worker_position_id );  
                    $deleteUnitWorkerParams = array ('unit_worker_id' => $unit_worker_id);  
                            
                    //select functionality
                        if ($unitWorkerMethod == 'PUT') {
                             $Messages["infos"][] = 'Ενημέρωση Συσχέτισης Εργαζόμενου στο ΜΜ';
                            $addUnitWorkerData = SYNCUtils::apiRequest($Options['Server_Mmsch'], $Options['Server_Mmsch_username'], $Options['Server_Mmsch_password'], 'unit_workers', 'PUT', $putUnitWorkerParams);
                        } else if ($unitWorkerMethod == 'DELETE') {
                            $Messages["infos"][] = 'Διαγραφή Συσχέτισης Εργαζόμενου στο ΜΜ';
                            $addUnitWorkerData = SYNCUtils::apiRequest($Options['Server_Mmsch'], $Options['Server_Mmsch_username'], $Options['Server_Mmsch_password'], 'unit_workers', 'DELETE', $deleteUnitWorkerParams); 
                        } else if ($unitWorkerMethod == 'INIT_DELETE') {
                            $Messages["infos"][] = 'Δεν υπάρχει Συσχέτισης Εργαζόμενου στο ΜΜ';
                            $addUnitWorkerData['status'] = 200;
                        }else {
                            $Messages["infos"][] = 'Δημιουργία Νέας συσχέτισης Εργαζόμενου στο ΜΜ';
                            $addUnitWorkerData = SYNCUtils::apiRequest($Options['Server_Mmsch'], $Options['Server_Mmsch_username'], $Options['Server_Mmsch_password'], 'unit_workers', 'POST', $postUnitWorkerParams);
                        }
                    
                    if($addUnitWorkerData['status'] == 200) {
                        //init lab worker entity for update row=================
                        $LabWorker = CRUDUtils::findIDParam($row->getLabWorkerId(), 'LabWorkers', 'LabWorker'); 
                        $LabWorker->setMmWorkerSyncLastUpdateDate(new \DateTime (date('Y-m-d H:i:s')));
                        $entityManager->persist($LabWorker);
                        $entityManager->flush($LabWorker);
                        $entityManager->clear($LabWorker);
                        $Messages["infos"][] = 'Ο Εργαζόμενος συγχρονίστηκε με Κωδικό Εργαζόμενου '.$row->getLabWorkerId(). ' και Κωδικό ΜΜ '.$row->getLab()->getMmSyncId();
                    } else {
                        $Messages["infos"][] = 'Λάθος στην διαδικασία του συγχρονισμού '.$addUnitWorkerData['message'];
                        $Messages["infos"][] = 'Ο Εργαζόμενος δεν συγχρονίστηκε';
                    }  

                
                } else {
                      $Messages["infos"][] = 'Λάθη στην προετοιμασία του συγχρονισμού'; 
                }
        
               
           }    
        }
               
        
    //debug=====================================================================
    $result["DQL"] =  trim(preg_replace('/\s\s+/', ' ', $qb->getDQL()));
    $result["SQL"] =  trim(preg_replace('/\s\s+/', ' ', $qb->getQuery()->getSQL()));   
      
    //var_dump($result);
    //var_dump($Messages);
    $timer->stop();
    $resultTime["time_stats"] = $timer->getFullStats();
    $print_results = array_merge($Messages,$resultTime);

    $filepath = $Options["SyncLogFolder"];
    $filename = $timer->getTimeFileName('MylabWorkersMM');

    $cachePath = $filepath.$filename;
    $test = file_put_contents($cachePath,JsonFunctions::toGreek(json_encode($print_results),TRUE));

    $href = $Options["WebSyncFolder"].$filename;
    echo $timer->printFullStats();
    echo '</br> Finished Sync MyLab with MM. </br> View results at <a href='.$href.'>MylabWorkersMM.json</a>  ' ; 
    
} catch (Exception $e) {
    throw $e;
}

?>