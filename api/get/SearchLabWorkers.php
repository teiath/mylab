<?php
/**
 *
 * @version 1.0.1
 * @author  ΤΕΙ Αθήνας
 * @package GET
 * 
 * 
 */
 
header("Content-Type: text/html; charset=utf-8");

function SearchLabWorkers ( $lab_worker_id, $worker_status, $worker_start_service,
                            $lab_id, $lab_name, $worker_position, $worker, $worker_registry_no,
                            $lab_type, $school_unit_id, $school_unit_name, $lab_state,                      
                            $region_edu_admin, $edu_admin, $transfer_area, $municipality, $prefecture,
                            $education_level, $school_unit_type, $school_unit_state, 
                            $pagesize, $page, $orderby, $ordertype, $searchtype, $exportdatatype  ) {

    global $db;
    global $app;
    
    $filter = array();
            
    $result = array();
    
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["data"] = array();
    $result["controller"] = __FUNCTION__;
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();

    try
    {
    //======================================================================================================================
    //= Paging
    //======================================================================================================================

        if ( Validator::isMissing('searchtype') )
            $searchtype = SearchEnumTypes::Contain;
        else if ( SearchEnumTypes::isValidValue( $searchtype ) || SearchEnumTypes::isValidName( $searchtype ) )
            $searchtype = SearchEnumTypes::getValue($searchtype);
        else
            throw new Exception(ExceptionMessages::InvalidSearchType." : ".$searchtype, ExceptionCodes::InvalidSearchType);
        
        if ( Validator::isMissing('page') )
            $page = 1;
        else if ( Validator::isNull($page) )
            throw new Exception(ExceptionMessages::MissingPageValue, ExceptionCodes::MissingPageValue);
        elseif ( Validator::isArray($page) )
            throw new Exception(ExceptionMessages::InvalidPageArray, ExceptionCodes::InvalidPageArray);
        elseif (Validator::isLowerThan($page, 0, true) )
            throw new Exception(ExceptionMessages::InvalidPageNumber, ExceptionCodes::InvalidPageNumber);
        elseif (!Validator::isGreaterThan($page, 0) )
            throw new Exception(ExceptionMessages::InvalidPageType, ExceptionCodes::InvalidPageType);
        else
            $page = Validator::toInteger($page);

        
        if ( Validator::isMissing('pagesize') )
            $pagesize = Parameters::DefaultPageSize;
        else if ( Validator::isEqualTo($pagesize, 0) )
            $pagesize = Parameters::AllPageSize;
        else if ( Validator::isNull($pagesize) )
            throw new Exception(ExceptionMessages::MissingPageSizeValue, ExceptionCodes::MissingPageSizeValue);
        elseif ( Validator::isArray($pagesize) )
            throw new Exception(ExceptionMessages::InvalidPageSizeArray, ExceptionCodes::InvalidPageSizeArray);
        elseif ( (Validator::isLowerThan($pagesize, 0) ) )
            throw new Exception(ExceptionMessages::InvalidPageSizeNumber, ExceptionCodes::InvalidPageSizeNumber);
        elseif (!Validator::isGreaterThan($pagesize, 0) )
            throw new Exception(ExceptionMessages::InvalidPageSizeType, ExceptionCodes::InvalidPageSizeType);
        else
            $pagesize = Validator::toInteger($pagesize);
        
//======================================================================================================================
//= $lab_worker_id
//======================================================================================================================

        if ( Validator::isExists('lab_worker_id') )
        {
            $table_name = "lab_workers";
            $table_column_id = "lab_worker_id";
            $table_column_name = "lab_worker_id";
            $filter_validators = 'null,id';

            $filter[] = Filters::BasicFilter( $lab_worker_id, $table_name, $table_column_id, $table_column_name, $filter_validators,
                                               ExceptionMessages::InvalidLabWorkerIDType, ExceptionCodes::InvalidLabWorkerIDType);

        }
        
//======================================================================================================================
//= $worker_status
//======================================================================================================================

        if ( Validator::isExists('worker_status') )
        {
            $table_name = "lab_workers";
            $table_column_id = "worker_status";
            $table_column_name = "worker_status";
            $filter_validators = 'null,numeric';

            $filter[] = Filters::BasicFilter( $worker_status, $table_name, $table_column_id, $table_column_name, $filter_validators,
                                               ExceptionMessages::InvalidLabWorkerStatusType, ExceptionCodes::InvalidLabWorkerStatusType);

        }
        
//======================================================================================================================
//= $worker_start_service
//======================================================================================================================

        if ( Validator::isExists('worker_start_service') )
        {
            $table_name = "lab_workers";
            $table_column_name = "worker_start_service";
            $filter_validators = 'null,date';

            $filter[] = Filters::DateBasicFilter( $worker_start_service, $table_name, $table_column_name, $filter_validators,
                                                  ExceptionMessages::InvalidLabWorkerStartServiceType, ExceptionCodes::InvalidLabWorkerStartServiceType);

        }
        
//======================================================================================================================
//= $worker
//======================================================================================================================

        if ( Validator::isExists('worker') )
        {

            $table_name = "workers";
            $table_column_id = "worker_id";
            $table_column_name = "lastname";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $worker, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidWorkerType, ExceptionCodes::InvalidWorkerType);
            
    }  
 
//======================================================================================================================
//= $worker_registry_no
//======================================================================================================================

        if ( Validator::isExists('registry_no') )
        {

            $table_name = "workers";
            $table_column_id = "registry_no";
            $table_column_name = "registry_no";
            $filter_validators = 'null,value';
            
            $filter[] = Filters::BasicFilter( $worker_registry_no, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidWorkerRegistryNoType, ExceptionCodes::InvalidWorkerRegistryNoType);
            
    } 
    
 //======================================================================================================================
//= $worker_position
//======================================================================================================================

        if ( Validator::isExists('worker_position') )
        {

            $table_name = "worker_positions";
            $table_column_id = "worker_position_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $worker_position, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidWorkerPositionType, ExceptionCodes::InvalidWorkerPositionType);
            
    }   
//======================================================================================================================
//= $lab
//======================================================================================================================

        if ( Validator::isExists('lab_id') )
        {
            $table_name = "labs";
            $table_column_id = "lab_id";
            $table_column_name = "lab_id";
            $filter_validators = 'null,id';

            $filter[] = Filters::BasicFilter( $lab_id, $table_name, $table_column_id, $table_column_name, $filter_validators,
                                               ExceptionMessages::InvalidLabIDType, ExceptionCodes::InvalidLabIDType);

        }
        
//======================================================================================================================
//= $lab_name
//======================================================================================================================

        if ( Validator::isExists('lab_name') )
        {
            $table_name = "labs";
            $table_column_name = "name";

            $filter[] =  Filters::ExtBasicFilter($lab_name, $table_name, $table_column_name, $searchtype, 
                                                 ExceptionMessages::InvalidLabNameType, ExceptionCodes::InvalidLabNameType ); 
            
        }
 
//======================================================================================================================
//= $lab_type
//======================================================================================================================

        if ( Validator::isExists('lab_type') )
        {

            $table_name = "lab_types";
            $table_column_id = "lab_type_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $lab_type, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidLabTypeType, ExceptionCodes::InvalidLabTypeType);
            
        }
        
//======================================================================================================================
//= $school_unit_id
//======================================================================================================================

        if ( Validator::isExists('school_unit_id') )
        {

            $table_name = "school_units";
            $table_column_id = "school_unit_id";
            $table_column_name = "school_unit_id";
            $filter_validators = 'null,id';
            
            $filter[] = Filters::BasicFilter( $school_unit_id, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidSchoolUnitIDType, ExceptionCodes::InvalidSchoolUnitIDType);
            
    }
        
//======================================================================================================================
//= $school_unit_name
//======================================================================================================================

        if ( Validator::isExists('school_unit_name') )
        {
            $table_name = "school_units";
            $table_column_name = "name";

            $filter[] =  Filters::ExtBasicFilter($school_unit_name, $table_name, $table_column_name, $searchtype, 
                                                 ExceptionMessages::InvalidSchoolUnitNameType, ExceptionCodes::InvalidSchoolUnitNameType ); 
            
        }
    
//======================================================================================================================
//= $lab_state
//======================================================================================================================

        if ( Validator::isExists('lab_state') )
        {

            $table_name = "lab_states";
            $table_column_id = "state_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $lab_state, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidStateType, ExceptionCodes::InvalidStateType);
            
        }

//======================================================================================================================
//= $region_edu_admin
//======================================================================================================================

        if ( Validator::isExists('region_edu_admin') )
        {

            $table_name = "region_edu_admins";
            $table_column_id = "region_edu_admin_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $region_edu_admin, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidRegionEduAdminType, ExceptionCodes::InvalidRegionEduAdminType);
            
        }

//======================================================================================================================
//= $edu_admin
//======================================================================================================================

        if ( Validator::isExists('edu_admin') )
        {

            $table_name = "edu_admins";
            $table_column_id = "edu_admin_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $edu_admin, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidEduAdminType, ExceptionCodes::InvalidEduAdminType);

        }

//======================================================================================================================
//= $transfer_area
//======================================================================================================================

        if ( Validator::isExists('transfer_area') )
        {
            $table_name = "transfer_areas";
            $table_column_id = "transfer_area_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $transfer_area, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidTransferAreaType, ExceptionCodes::InvalidTransferAreaType);

        }

//======================================================================================================================
//= $municipality
//======================================================================================================================

        if ( Validator::isExists('municipality') )
        {
            
            $table_name = "municipalities";
            $table_column_id = "municipality_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
              
            $filter[] = Filters::BasicFilter( $municipality, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidMunicipalityType, ExceptionCodes::InvalidMunicipalityType);

        }
        
//======================================================================================================================
//= $prefecture
//======================================================================================================================

        if ( Validator::isExists('prefecture') )
        {
            $table_name = "prefectures";
            $table_column_id = "prefecture_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';

            $filter[] = Filters::BasicFilter( $prefecture, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidPrefectureType, ExceptionCodes::InvalidPrefectureType);

        }

//======================================================================================================================
//= $education_level
//======================================================================================================================

        if ( Validator::isExists('education_level') )
        {
            $table_name = "education_levels";
            $table_column_id = "education_level_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $education_level, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidEducationLevelType, ExceptionCodes::InvalidEducationLevelType);

        }
        
 //======================================================================================================================
//= $school_unit_type
//======================================================================================================================

        if ( Validator::isExists('school_unit_type') )
        {
            $table_name = "school_unit_types";
            $table_column_id = "school_unit_type_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $school_unit_type, $table_name, $table_column_id, $table_column_name, $filter_validators,  
                                              ExceptionMessages::InvalidSchoolUnitTypeType, ExceptionCodes::InvalidSchoolUnitTypeType);
            
        }     
        
//======================================================================================================================
//= $school_unit_state
//======================================================================================================================

        if ( Validator::isExists('school_unit_state') )
        {
            $table_name = "school_unit_states";
            $table_column_id = "state_id";
            $table_column_name = "name";
            $filter_validators = 'null,id,value';
            
            $filter[] = Filters::BasicFilter( $school_unit_state, $table_name, $table_column_id, $table_column_name, $filter_validators, 
                                              ExceptionMessages::InvalidStateType, ExceptionCodes::InvalidStateType);

        }
               
//======================================================================================================================
//= $exportdatatype
//======================================================================================================================
        
        if ( Validator::isMissing('exportdatatype') )
            $exportdatatype = ExportDataEnumTypes::JSON;
        else if ( ExportDataEnumTypes::isValidValue( $exportdatatype ) || ExportDataEnumTypes::isValidName( $exportdatatype ) ) {
            $exportdatatype = ExportDataEnumTypes::getValue($exportdatatype);
            $pagesize = Parameters::AllPageSize;
        } else
            throw new Exception(ExceptionMessages::InvalidExportDataType." : ".$searchtype, ExceptionCodes::InvalidExportDataType);
   
//======================================================================================================================
//= $ordertype
//======================================================================================================================

        if ( Validator::isMissing('ordertype') )
            $ordertype = OrderEnumTypes::ASC ;
        else if ( OrderEnumTypes::isValidValue( $ordertype ) || OrderEnumTypes::isValidName( $ordertype ) )
            $ordertype = OrderEnumTypes::getValue($ordertype);
        else
            throw new Exception(ExceptionMessages::InvalidOrderType." : ".$ordertype, ExceptionCodes::InvalidOrderType);      
        
//======================================================================================================================
//= $orderby
//======================================================================================================================

        if ( Validator::isExists('orderby') )
        {
            $columns = array(
                "lab_worker_id",
                "lab_id", "lab",
                "worker_id", "registry_no",
                "worker_position_id", "worker_position",
                "worker_status", "worker_start_service"
            );

            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        }
        else
            $orderby = "lab_worker_id";

//======================================================================================================================
//= E X E C U T E
//======================================================================================================================

       $sqlSelect = "SELECT 
                        lab_workers.lab_worker_id,
                        lab_workers.worker_email,
                        lab_workers.worker_status,
                        lab_workers.worker_start_service,
                        workers.worker_id,
                        workers.registry_no,
                        workers.tax_number,
                        workers.firstname,
                        workers.lastname,
                        workers.fathername,
                        workers.sex,
                        worker_specializations.worker_specialization_id,
                        worker_specializations.name as worker_specialization,
                        worker_positions.worker_position_id,
                        worker_positions.name as worker_position,     
                        
                        labs.lab_id,
                        labs.name as lab,
                        labs.special_name,
                        labs.creation_date,
                        labs.created_by,
                        labs.last_updated,
                        labs.updated_by,
                        labs.positioning,
                        labs.comments,
                        labs.operational_rating,
                        labs.technological_rating,
                        lab_types.lab_type_id, 
                        lab_types.name as lab_type, 
                        lab_states.state_id as lab_state_id, 
                        lab_states.name as lab_state_name,
                        school_units.school_unit_id, 
                        school_units.name as school_unit,                                
                        school_unit_states.state_id as school_unit_state_id, 
                        school_unit_states.name as school_unit_state_name,
                        region_edu_admins.region_edu_admin_id, 
                        region_edu_admins.name as region_edu_admin, 
                        edu_admins.edu_admin_id, 
                        edu_admins.name as edu_admin, 
                        transfer_areas.transfer_area_id, 
                        transfer_areas.name as transfer_area, 
                        prefectures.prefecture_id, 
                        prefectures.name as prefecture, 
                        municipalities.municipality_id, 
                        municipalities.name as municipality, 
                        education_levels.education_level_id, 
                        education_levels.name as education_level, 
                        school_unit_types.school_unit_type_id, 
                        school_unit_types.name as school_unit_type
                       ";

        $sqlFrom = "FROM lab_workers
                                LEFT JOIN labs using (lab_id)
                                LEFT JOIN workers using (worker_id)
                                LEFT JOIN worker_positions using (worker_position_id)
                                LEFT JOIN worker_specializations ON workers.worker_specialization_id = worker_specializations.worker_specialization_id
                                LEFT JOIN lab_types ON labs.lab_type_id = lab_types.lab_type_id 
                                LEFT JOIN states lab_states ON labs.state_id = lab_states.state_id                               
                                LEFT JOIN school_units using (school_unit_id)
                                LEFT JOIN region_edu_admins using (region_edu_admin_id) 
                                LEFT JOIN edu_admins using (edu_admin_id) 
                                LEFT JOIN transfer_areas using (transfer_area_id)
                                LEFT JOIN prefectures using (prefecture_id)
                                LEFT JOIN municipalities using (municipality_id)
                                LEFT JOIN education_levels using (education_level_id)
                                LEFT JOIN school_unit_types using (school_unit_type_id)
                                LEFT JOIN states school_unit_states ON school_units.state_id = school_unit_states.state_id
                                ";

        $sqlWhere = (count($filter) > 0 ? " WHERE " . implode(" AND ", $filter) : "" );
        $sqlOrder = " ORDER BY ". $orderby ." ". $ordertype;
        $sqlLimit = ($page && $pagesize) ? " LIMIT ".(($page - 1) * $pagesize).", ".$pagesize : "";

        $result["filters"] = $filter;
        //#############find total total lab_workers without filter of limits(page and pagesize)
        $sql = "SELECT count(lab_workers.lab_worker_id) as total_lab_workers " . $sqlFrom . $sqlWhere;
        //echo "<br><br>".$sql."<br><br>";

        $stmt = $db->query( $sql );
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        $result["total"] = $rows["total_lab_workers"];
        
        //check if $page input from user, is valid
        $maxPage = Pagination::checkMaxPage($rows["total_lab_workers"], $page, $pagesize);
        
        //#############find count lab_workers with filter of limits(page and pagesize)
        $sql = $sqlSelect . $sqlFrom . $sqlWhere . $sqlOrder . $sqlLimit ;
        //echo "<br><br>".$sql."<br><br>";

        $stmt = $db->query( $sql );
        $array_lab_workers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result["count"] = $stmt->rowCount();
     
       
        //create array with lab_workers,labs,school_units ids
        if (count($array_lab_workers)>0){
            $prefix = '';
            $worker_ids = '';
            $lab_ids = '';
            $school_unit_ids = '';
            
            foreach ($array_lab_workers as $array_lab_worker)
            {
                $worker_ids .= $prefix . '"' . $array_lab_worker["worker_id"] . '"';
                $lab_ids .= $prefix . '"' . $array_lab_worker["lab_id"] . '"';
                $school_unit_ids .= $prefix . '"' . $array_lab_worker["school_unit_id"] . '"';
                $prefix = ', ';
            }                       
        } else {
            $worker_ids = "0";
            $lab_ids = "0";
            $school_unit_ids = "0";
        }
                
        //find lab types per school unit       
        $result["all_labs_by_type"] = Filters::AllLabsCounter($sqlFrom,$sqlWhere);

        $school_unit_ids = Validator::ToUniqueString($school_unit_ids);
          
//======================================================================================================================
//= R E S U L T S
//======================================================================================================================
        
        foreach ($array_lab_workers as $lab_worker)
        {
            $data = array(
                "lab_worker_id"             => $lab_worker["lab_worker_id"] ? (int)$lab_worker["lab_worker_id"] : null,                
                "worker_status"             => $lab_worker["worker_status"] ? (int)$lab_worker["worker_status"] : null,
                "worker_start_service"      => $lab_worker["worker_start_service"],
                "email"                     => $lab_worker["worker_email"] ,
                "worker_id"                 => $lab_worker["worker_id"] ? (int)$lab_worker["worker_id"] : null,
                "registry_no"               => $lab_worker["registry_no"],
                "tax_number"                => $lab_worker["tax_number"],
                "firstname"                 => $lab_worker["firstname"] ,
                "lastname"                  => $lab_worker["lastname"] ,
                "fathername"                => $lab_worker["fathername"] ,
                "sex"                       => $lab_worker["sex"],
                "worker_specialization_id"  => $lab_worker["worker_specialization_id"],
                "worker_specialization"     => $lab_worker["worker_specialization"] ,
                "worker_position_id"        => $lab_worker["worker_position_id"] ,
                "worker_position"           => $lab_worker["worker_position"],
                
//            );
//            
//                //$array_lab
//                $data["lab"][] = array(
                    "lab_id"                    => $lab_worker["lab_id"] ? (int)$lab_worker["lab_id"] : null,
                    "lab"                       => $lab_worker["lab"],
                    "special_name"              => $lab_worker["special_name"],
                    "creation_date"             => $lab_worker["creation_date"],
                    "created_by"                => $lab_worker["created_by"],
                    "last_updated"              => $lab_worker["last_updated"] ,
                    "updated_by"                => $lab_worker["updated_by"] ,
                    "positioning"               => $lab_worker["positioning"] ,
                    "comments"                  => $lab_worker["comments"] ,
                    "operational_rating"        => $lab_worker["operational_rating"],
                    "technological_rating"      => $lab_worker["technological_rating"],
                    "lab_type_id"               => $lab_worker["lab_type_id"],
                    "lab_type"                  => $lab_worker["lab_type"] ,
                    "lab_state_id"              => $lab_worker["lab_state_id"]? (int)$lab_worker["lab_state_id"] : null,
                    "lab_state"                 => $lab_worker["lab_state_name"],
//                );
//
//                //$array_school_unit
//                $data["school_unit"][] = array(
                    "school_unit_id"            => $lab_worker["school_unit_id"]? (int)$lab_worker["school_unit_id"] : null,
                    "school_unit"               => $lab_worker["school_unit"] ,
                    "school_unit_state_id"      => $lab_worker["school_unit_state_id"]? (int)$lab_worker["school_unit_state_id"] : null,
                    "school_unit_state"         => $lab_worker["school_unit_state_name"],         
                    "region_edu_admin_id"       => $lab_worker["region_edu_admin_id"] ? (int)$lab_worker["region_edu_admin_id"] : null,
                    "region_edu_admin"          => $lab_worker["region_edu_admin"],
                    "edu_admin_id"              => $lab_worker["edu_admin_id"] ? (int)$lab_worker["edu_admin_id"] : null,
                    "edu_admin"                 => $lab_worker["edu_admin"],
                    "transfer_area_id"          => $lab_worker["transfer_area_id"] ? (int)$lab_worker["transfer_area_id"] : null,
                    "transfer_area"             => $lab_worker["transfer_area"],
                    "prefecture_id"             => $lab_worker["prefecture_id"] ? (int)$lab_worker["prefecture_id"] : null,
                    "prefecture"                => $lab_worker["prefecture"],
                    "municipality_id"           => $lab_worker["municipality_id"] ? (int)$lab_worker["municipality_id"] : null,
                    "municipality"              => $lab_worker["municipality"],
                    "education_level_id"        => $lab_worker["education_level_id"] ? (int)$lab_worker["education_level_id"] : null,
                    "education_level"           => $lab_worker["education_level"],
                    "school_unit_type_id"       => $lab_worker["school_unit_type_id"] ? (int)$lab_worker["school_unit_type_id"] : null,
                    "school_unit_type"          => $lab_worker["school_unit_type"]
                );  
            
            $result["data"][] = $data;
        }  

        //return pagination values 
        $pagination = array(
            "page" => (int)$page,
            "maxPage" => (int)$maxPage,
            "pagesize" => (int)$pagesize
        ); 
        
        $result["pagination"]=$pagination;     
        $result["status"] = ExceptionCodes::NoErrors;;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".ExceptionMessages::NoErrors;

    } 
    catch (Exception $e) 
    {
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();

    }

    if ( Validator::IsExists('debug') )
    {
        $result["sql"] =  trim(preg_replace('/\s\s+/', ' ', $sql));
    }
  
    if ($exportdatatype == 'JSON'){
        return $result;
    } else if ($exportdatatype == 'XLSX') {
        SearchLabWorkersExt::ExcelCreate($result);
        exit;
    } else if ($exportdatatype == 'PDF'){
        SearchLabWorkersExt::PdfCreate($result);
        exit;
    } else {
       return 'false';
    }

}
?>