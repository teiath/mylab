<?php
    header("Content-Type: text/html; charset=utf-8");
    
    chdir("../");
    require_once('system/includes.php');
    
    global $Options; 
    global $entityManager;
    
    //set allowed unit types to sync with mm
    //'1'=ΣΕΠΕΗΥ
    $allowedLabTypes = array ( '1' );
    
    
    
    //execution=================================================================
    $qb = $entityManager->createQueryBuilder();
    $qb->select('l');
    $qb->from('Labs', 'l');
    $qb->andWhere($qb->expr()->eq('l.submitted', ':value'))->setParameter('value',1);
    $qb->andWhere($qb->expr()->in('l.labType', ':labTypes'))->setParameter('labTypes', $allowedLabTypes);
    $qb->andWhere($qb->expr()->orX(
                                    $qb->expr()->isNull('l.mmSyncId'),
                                    $qb->expr()->lt('l.mmSyncLastUpdateDate', 'l.lastUpdated')
                                    ));

//pagination and results========================================================      
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        
        if ($result["total"]==0) {
            $Messages["infos"][] = 'Δεν βρέθηκαν μονάδες προς ενημέρωση';
        } else {
            
        foreach($results AS $row) {
            $Messages["infos"][] = 'Συγχρονισμός Μονάδας με Κωδικό LabId : '. $row->getLabId(). ' και Όνομα : ' .$row->getName()."...\r\n";
            $unitData = $unitTypeData = $Data = $syncData = $error = null;   
            
                //found school_unit properties======================================
                $school_unit_id = array ("school_unit_id" => $row->getSchoolUnit()->getSchoolUnitId());
                if (Validator::IsNull($school_unit_id)) {
                    $Messages["infos"][] ='Δεν βρέθηκε η Μονάδα με Κωδικό ΜΜ '. $school_unit_id['school_unit_id'];
                    $error++;
                }

                $unitData = SYNCUtils::apiRequest($Options['Server_MyLab'], $Options['Server_MyLab_username'], $Options['Server_MyLab_password'], 'school_units', 'GET', $school_unit_id );
                if ($unitData['status']=='200' && $unitData['total']=='1') {
                     $Messages["infos"][] = 'Βρέθηκε η Μονάδα με Κωδικό ΜΜ ' . $school_unit_id['school_unit_id'];
                     $edu_admin = $unitData['data'][0]['edu_admin_name'];
                     $region_edu_admin = $unitData['data'][0]['region_edu_admin_name'];
                     $prefecture = $unitData['data'][0]['prefecture_name'];
                     $transfer_area = $unitData['data'][0]['transfer_area_name'];
                     $municipality = $unitData['data'][0]['municipality_name'];
                     $municipality_community = $unitData['data'][0]['municipality_community_name'];
                     $implementation_entity = $unitData['data'][0]['implementation_entity_name'];//den iparxei!!!
                     $legal_character = $unitData['data'][0]['legal_character_name'];//den iparxei!!!         
                     $postal_code = $unitData['data'][0]['postal_code'];
                     $street_address = $unitData['data'][0]['street_address'];
                     $latitude = $unitData['data'][0]['latitude'];//den iparxei!!!
                     $longitude = $unitData['data'][0]['longitude'];//den iparxei!!!
                }else{
                    $Messages["infos"][] ='Error in units table'.$unitData['message'];
                    $error++;
                }

                //unit_type properties==============================================
                $unit_type_name = array ("unit_type" => $row->getLabType()->getName());
                if (Validator::IsNull($unit_type_name)){
                    $Messages["infos"][] ='Δεν βρέθηκε ο Τύπος Μονάδας '. $unit_type_name['unit_type'];
                    $error++;
                }

                $unitTypeData = SYNCUtils::apiRequest($Options['Server_Mm'], $Options['Server_Mm_username'], $Options['Server_Mm_password'], 'unit_types', 'GET', $unit_type_name );
                if ($unitTypeData['status']=='200' && $unitTypeData['total']=='1') {
                     $Messages["infos"][] ='Βρέθηκε ο Τύπος Μονάδας '. $unit_type_name['unit_type'];
                     $category = $unitTypeData['data'][0]['category'];
                     $education_level = $unitTypeData['data'][0]['education_level'];
                }else{
                    $Messages["infos"][] ='Error in unit_types table'.$unitTypeData['message'];
                    $error++;
                }    
            
            //Check method type POST or PUT
            if (Validator::IsNull($row->getMmSyncId())) {
                $method = 'POST';
                $extraParams = array();

                    //check if already exist!!
                    $name = array ("name" => $row->getName());
                    $data = SYNCUtils::apiRequest($Options['Server_Mmsch'], $Options['Server_Mmsch_username'], $Options['Server_Mmsch_password'], 'units', 'GET', $name );
                    if ($data['total']!='0') {
                        $Messages["infos"][] ='Η μονάδα υπάρχει ήδη στο ΜΜ με το ίδιο όνομα '.$name['name'];
                        $error++;
                    }

            } else {
                $method = 'PUT';
                $extraParams = array('mm_id' => $row->getMmSyncId());
            }
                           
            //Prepare params for api request to mm
            $lastUpdate = $row->getLastUpdated();
            $modifyDateTime = new \DateTime('now');
            $params = array_merge($extraParams, array(
                                                    "name"              => $row->getName(),
                                                    "special_name"      => $row->getSpecialName(),
                                                    "last_update"       => $lastUpdate instanceof \DateTime ? $lastUpdate->format('Y-m-d H:i:s') : $modifyDateTime->format('Y-m-d H:i:s'),
                                                    "positioning"       => $row->getPositioning(),
                                                    "comments"          => $row->getComments(),
                                                    "unit_type"         => $row->getLabType()->getName(),
                                                    "state"             => $row->getState()->getName(),
                                                    "source"            => 'MyLab',
                                                    "category"          => $category,
                                                    "last_sync"         => $modifyDateTime->format('Y-m-d H:i:s'),                
                                                    "education_level"   => $education_level,
                                                    "region_edu_admin"          => $region_edu_admin,
                                                    "edu_admin"                 => $edu_admin,
                                                    "implementation_entity"     =>$implementation_entity,
                                                    "transfer_area"             => $transfer_area,
                                                    "municipality"              => $municipality,
                                                    "municipality_community"    => $municipality_community,
                                                    "prefecture"                => $prefecture,                   
                                                    "legal_character"           => $legal_character,
                                                    "postal_code"               => $postal_code,              
                                                    "street_address"            => $street_address,  
                                                    "latitude"                  => $latitude,
                                                    "longitude"                 => $longitude
                                                    ));
            var_dump($params);
                
                //make the http request to MMS with cURL
                if ($error==null) { 
                $syncData = SYNCUtils::apiRequest($Options['Server_Mmsch'], $Options['Server_Mmsch_username'], $Options['Server_Mmsch_password'], 'units', $method, $params);
                    if($syncData['status'] == 200) {
                       if($method == 'POST') {
                           $row->setMmSyncId($syncData['data'][0]['mm_id']);
                       }          
                       $row->setMmSyncLastUpdateDate($modifyDateTime->add(new \DateInterval('PT2M')));
                    } else {
                        $Messages["infos"][] = 'Λάθος στην διαδικασία του συγχρονισμού '.$syncData['message'];
                        $Messages["infos"][] = 'Η Μονάδα δεν συγχρονίστηκε';
                    }
                    $Messages["infos"][] = 'Η Μονάδα συγχρονίστηκε με Κωδικό ΜΜ '.$row->getMmSyncId(). ' και Όνομα Μονάδας '.$row->getName();
                } else {
                    $Messages["infos"][] = 'Λάθη στην προετοιμασία του συγχρονισμού'; 
                }
        }
                  
//debug=========================================================================
        //$result["DQL"] =  trim(preg_replace('/\s\s+/', ' ', $qb->getDQL()));
        //$result["SQL"] =  trim(preg_replace('/\s\s+/', ' ', $qb->getQuery()->getSQL()));
  
    }
        var_dump($Messages);
?>