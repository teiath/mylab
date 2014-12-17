<?php
/**
 *
 * @version 2.0
 * @author  ΤΕΙ Αθήνας
 * @package GET
 */
 
header("Content-Type: text/html; charset=utf-8");

function FindLabWorkers ( $lab_worker_id, $lab_worker_status, $lab_worker_start_service, $lab_worker_position, 
                          $worker_registry_no, $worker_uid, $worker_firstname, $worker_lastname, 
                          $lab_id, $lab_name, $submitted, $lab_type, $lab_state,
                          $school_unit_id, $school_unit_name,
                          $region_edu_admin, $edu_admin, $transfer_area, $municipality, $prefecture, 
                          $education_level, $school_unit_type, $school_unit_state, 
                          $pagesize, $page, $orderby, $ordertype, $searchtype, $export ) {

    global $entityManager, $app , $Options;

    $qb = $entityManager->createQueryBuilder();
    $result = array();  

    $result["data"] = array();
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();

    try {
        
//set user permissions==========================================================
//NO lab,school_units,lab_workers filtered by user role
    
//$export=======================================================================       
        if ( Validator::Missing('export', $params) )
            $export = ExportDataEnumTypes::JSON;
        else if ( ExportDataEnumTypes::isValidValue( $export ) || ExportDataEnumTypes::isValidName( $export ) ) {
            $export = ExportDataEnumTypes::getValue($export);
        } else
            throw new Exception(ExceptionMessages::InvalidExportType." : ".$export, ExceptionCodes::InvalidExportType);
        
//$page - $pagesize - $searchtype - $ordertype =================================
       $page = Pagination::getPage($page, $params);   
       $searchtype = Filters::getSearchType($searchtype, $params);
       $ordertype =  Filters::getOrderType($ordertype, $params);
  
       if ($export == 'XLSX')
            $pagesize = Parameters::ExportPageSize;
       else
            $pagesize = Pagination::getPagesize($pagesize, $params);
       
//$orderby======================================================================
       $columns = array(
                            "mlw.workerId"     => "worker_id",
                            "mlw.registryNo"   => "registry_no",
                            "mlw.uid"          => "worker_uid",
                            "mlw.firstname"    => "firstname",
                            "mlw.lastname"     => "lastname", 
                            "mlw.fathername"   => "fathername",
                            "mlw.email"        => "email",  
                            "mlwws.workerSpecializationId"  => "worker_specialization_id",
                            "mlwws.name"                    => "worker_specialization_name",
                            "mlwls.labSourceId"             => "worker_lab_source_id",
                            "mlwls.name"                    => "worker_lab_source_name",
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "worker_id";
        else
        {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        } 
        
//$lab_worker_id================================================================
    if (Validator::Exists('lab_worker_id', $params)){
        CRUDUtils::setFilter($qb, $lab_worker_id, "lw", "labWorkerId", "labWorkerId", "id", ExceptionMessages::InvalidLabWorkerIDType, ExceptionCodes::InvalidLabWorkerIDType);
    } 
      
//$lab_worker_status============================================================
    if (Validator::Exists('lab_worker_status', $params)){
        CRUDUtils::setFilter($qb, $lab_worker_status, "lw", "workerStatus", "workerStatus", "numeric", ExceptionMessages::InvalidLabWorkerStatusType, ExceptionCodes::InvalidLabWorkerStatusType);
    }   
         
//$lab_worker_start_service=====================================================
    if (Validator::Exists('lab_worker_start_service', $params)){
        CRUDUtils::setFilter($qb, $lab_worker_start_service, "lw", "workerStartService", "workerStartService", "date", ExceptionMessages::InvalidLabWorkerStartServiceType, ExceptionCodes::InvalidLabWorkerStartServiceType);
    } 
        
//$lab_worker_position==========================================================
    if (Validator::Exists('lab_worker_position', $params)){
        CRUDUtils::setFilter($qb, $lab_worker_position, "wp", "workerPositionId", "name", "id,value", ExceptionMessages::InvalidWorkerPositionType, ExceptionCodes::InvalidWorkerPositionType);
    } 
 
//$worker_registry_no===========================================================
        if (Validator::Exists('worker_registry_no', $params)){
            CRUDUtils::setFilter($qb, $worker_registry_no, "mlw", "registryNo", "registryNo", "numeric", ExceptionMessages::InvalidMylabWorkerRegistryNoType, ExceptionCodes::InvalidMylabWorkerRegistryNoType);    
        }
        
//$worker_uid===================================================================
        if (Validator::Exists('worker_uid', $params)){
            CRUDUtils::setSearchFilter($qb, $worker_uid, "mlw", "uid", $searchtype, ExceptionMessages::InvalidMylabWorkerUidType, ExceptionCodes::InvalidMylabWorkerUidType);    
        } 
   
//$worker_firstname=============================================================
        if (Validator::Exists('worker_firstname', $params)){
            CRUDUtils::setSearchFilter($qb, $worker_firstname, "mlw", "firstname", $searchtype, ExceptionMessages::InvalidMylabWorkerFirstnameType, ExceptionCodes::InvalidMylabWorkerFirstnameType);    
        } 

//$worker_lastname==============================================================
        if (Validator::Exists('worker_lastname', $params)){
            CRUDUtils::setSearchFilter ($qb, $worker_lastname, "mlw", "lastname", $searchtype, ExceptionMessages::InvalidMylabWorkerLastnameType, ExceptionCodes::InvalidMylabWorkerLastnameType);
        }  
        
//$lab_id=======================================================================
        if (Validator::Exists('lab_id', $params)){
            CRUDUtils::setFilter($qb, $lab_id, "l", "labId", "labId", "id", ExceptionMessages::InvalidLabIDType, ExceptionCodes::InvalidLabIDType);
        } 

//$lab_name=====================================================================
        if (Validator::Exists('lab_name', $params)){
            CRUDUtils::setSearchFilter($qb, $lab_name, "l", "name", $searchtype, ExceptionMessages::InvalidLabNameType, ExceptionCodes::InvalidLabNameType);    
        } 
  
//$submitted====================================================================
        if (Validator::Exists('submitted', $params)){
            CRUDUtils::setFilter($qb, $submitted, "l", "submitted", "submitted", "boolean", ExceptionMessages::InvalidLabSubmittedType, ExceptionCodes::InvalidLabSubmittedType);
        }  
        
 //$lab_type====================================================================
        if (Validator::Exists('lab_type', $params)){
            CRUDUtils::setFilter($qb, $lab_type, "lt", "labTypeId", "name", "null,id,value", ExceptionMessages::InvalidLabTypeType, ExceptionCodes::InvalidLabTypeType);
        }
        
//$lab_state====================================================================
        if (Validator::Exists('lab_state', $params)){
            CRUDUtils::setFilter($qb, $lab_state, "s", "stateId", "name", "null,id,value", ExceptionMessages::InvalidStateType, ExceptionCodes::InvalidStateType);
        } 
   
//$school_unit_id===============================================================
        if (Validator::Exists('school_unit_id', $params)){
            CRUDUtils::setFilter($qb, $school_unit_id, "su", "schoolUnitId", "schoolUnitId", "id", ExceptionMessages::InvalidSchoolUnitIDType, ExceptionCodes::InvalidSchoolUnitIDType);
        } 

//$school_unit_name=============================================================
        if (Validator::Exists('school_unit_name', $params)){
            CRUDUtils::setSearchFilter($qb, $school_unit_name, "su", "name", $searchtype, ExceptionMessages::InvalidSchoolUnitNameType, ExceptionCodes::InvalidSchoolUnitNameType);    
        } 
        
 //$region_edu_admin============================================================
        if (Validator::Exists('region_edu_admin', $params)){
            CRUDUtils::setFilter($qb, $region_edu_admin, "rea", "regionEduAdminId", "name", "null,id,value", ExceptionMessages::InvalidRegionEduAdminType, ExceptionCodes::InvalidRegionEduAdminType);
        }
        
//$edu_admin====================================================================
        if (Validator::Exists('edu_admin', $params)){
            CRUDUtils::setFilter($qb, $edu_admin, "ea", "eduAdminId", "name", "null,id,value", ExceptionMessages::InvalidEduAdminType, ExceptionCodes::InvalidEduAdminType);
        }
        
//$transfer_area================================================================
        if (Validator::Exists('transfer_area', $params)){
            CRUDUtils::setFilter($qb, $transfer_area, "ta", "transferAreaId", "name", "null,id,value", ExceptionMessages::InvalidTransferAreaType, ExceptionCodes::InvalidTransferAreaType);
        }
        
//$municipality=================================================================
        if (Validator::Exists('municipality', $params)){
            CRUDUtils::setFilter($qb, $municipality, "m", "municipalityId", "name", "null,id,value", ExceptionMessages::InvalidMunicipalityType, ExceptionCodes::InvalidMunicipalityType);
        }
        
//$prefecture===================================================================
        if (Validator::Exists('prefecture', $params)){
            CRUDUtils::setFilter($qb, $prefecture, "p", "prefectureId", "name", "null,id,value", ExceptionMessages::InvalidPrefectureType, ExceptionCodes::InvalidPrefectureType);
        }
        
//$education_level==============================================================
        if (Validator::Exists('education_level', $params)){
            CRUDUtils::setFilter($qb, $education_level, "el", "educationLevelId", "name", "null,id,value", ExceptionMessages::InvalidEducationLevelType, ExceptionCodes::InvalidEducationLevelType);
        }
        
//$school_unit_type=============================================================
        if (Validator::Exists('school_unit_type', $params)){
            CRUDUtils::setFilter($qb, $school_unit_type, "sut", "schoolUnitTypeId", "name", "null,id,value", ExceptionMessages::InvalidSchoolUnitTypeType, ExceptionCodes::InvalidSchoolUnitTypeType);
        }

//$school_unit_state============================================================
        if (Validator::Exists('school_unit_state', $params)){
            CRUDUtils::setFilter($qb, $school_unit_state, "sus", "stateId", "name", "null,id,value", ExceptionMessages::InvalidStateType, ExceptionCodes::InvalidStateType);
        } 
        
 //execution====================================================================
        
        //get count of mylabWorkers with DICTINCT value
        $qb->select('mlw.workerId')->distinct();     
        $qb->from('LabWorkers', 'lw');   
        $qb->leftjoin('lw.lab', 'l')->leftjoin('lw.worker', 'mlw')->leftjoin('lw.workerPosition', 'wp')->leftjoin('l.schoolUnit', 'su')
           ->leftjoin('l.state', 's')->leftjoin('l.labType', 'lt')->leftjoin('l.labSource', 'ls')->leftjoin('su.regionEduAdmin', 'rea')
           ->leftjoin('su.eduAdmin', 'ea')->leftjoin('su.transferArea', 'ta')->leftjoin('su.municipality', 'm')->leftjoin('su.prefecture', 'p')
           ->leftjoin('su.educationLevel', 'el')->leftjoin('su.schoolUnitType', 'sut')->leftjoin('su.state', 'sus');     
        $qb->orderBy('mlw.workerId', 'ASC');

        $query = $qb->getQuery();
        $workerResults = $query->getResult();
        $result["total"] = count($workerResults);
        
        //create array with lab_workers ids
        if ($result["total"]>0) {
            $prefix = '';$worker_ids ='';
            foreach ($workerResults as $workerResult)
            {
                $worker_ids .= $prefix . $workerResult['workerId'];
                $prefix = ', ';
            }                       
        } else {
            throw new Exception(ExceptionMessages::InvalidLabWorkerValue,ExceptionCodes::ReferencesEquipmentTypeLabEquipmentTypes);  
        }
        
 //=============================================================================
          
        $iqb = $entityManager->createQueryBuilder();
        $iqb->select('mlw.workerId,mlw.registryNo,mlw.uid,mlw.firstname,mlw.lastname,mlw.fathername,mlw.email,
                      mlwws.workerSpecializationId,mlwws.name as workerSpecializationName,
                      mlwls.labSourceId as workerLabSourceId,mlwls.name as workerLabSourceName');
        $iqb->from('MylabWorkers','mlw');
        $iqb->leftjoin('mlw.workerSpecialization', 'mlwws')->
              leftjoin('mlw.labSource', 'mlwls');
        $iqb->where($iqb->expr()->in('mlw.workerId', $worker_ids));
        $iqb->orderBy(array_search($orderby, $columns), $ordertype);
                
        $iquery = $iqb->getQuery();
          
        //pagination and results================================================      
        $iquery->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $iquery->setMaxResults($pagesize) : null;
        $iworkerResults = $iquery->getResult();  
        
        //data results==========================================================              
        $count = 0;
        foreach ($iworkerResults as $iworkerResult) { 
           $wResult[] = array ( 'worker_id' => $iworkerResult['workerId'],
                                'registry_no' => $iworkerResult['registryNo'],
                                'worker_uid' => $iworkerResult['uid'],
                                'firstname' => $iworkerResult['firstname'],
                                'lastname' => $iworkerResult['lastname'],
                                'fathername' => $iworkerResult['fathername'],
                                'email' => $iworkerResult['email'],
                                'worker_specialization_id' => $iworkerResult['workerSpecializationId'],
                                'worker_specialization_name' => $iworkerResult['workerSpecializationName'],
                                'worker_lab_source_id' => $iworkerResult['workerLabSourceId'],
                                'worker_lab_source_name' => $iworkerResult['workerLabSourceName']              
                                );
          
            $count++;
        }
        $result["data"] = $wResult;    
        $result["count"] = $count;
         //print_r($result);
        
//pagination results============================================================     
        $maxPage = Pagination::getMaxPage($result["total"],$page,$pagesize);
        $pagination = array( "page" => $page,   
                             "maxPage" => $maxPage, 
                             "pagesize" => $pagesize 
                            );    
        $result["pagination"] = $pagination;
       
//result_messages===============================================================      
        $result["status"] = ExceptionCodes::NoErrors;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".ExceptionMessages::NoErrors;
    } catch (Exception $e) {
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    
//debug=========================================================================
    
   if ( Validator::IsTrue( $params["debug"]  ) )
   {
        $result["DQL"] =  trim(preg_replace('/\s\s+/', ' ', $qb->getDQL()));
        $result["SQL"] =  trim(preg_replace('/\s\s+/', ' ', $qb->getQuery()->getSQL()));
   }

    if ($export == 'JSON'){
        return $result;
    } else if ($export == 'XLSX') {
       $xlsx_filename = FindLabWorkersExt::ExcelCreate($result);
       unset($result['data']);
       return array("result"=>$result,"tmp_xlsx_filepath" => $Options["WebTmpFolder"].$xlsx_filename);
       // exit;
    } else if ($export == 'PDF'){
       return $result;
    } else if ($export == 'PHP_ARRAY'){
       return print_r($result);
    } else {     
       return $result;
    }
    
}

?>