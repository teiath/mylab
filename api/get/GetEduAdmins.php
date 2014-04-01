<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @param type $region_edu_admin
 * @param type $pagesize
 * @param int $page
 * @return string
 * @throws Exception
 */

function GetEduAdmins($region_edu_admin, $pagesize, $page, $sort_field, $sort_mode ) {
    global $db;
    global $Options;
    global $app;
    
    $filter = array();
    $result = array();  

    $result["data"] = array();
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();
    
    try {
        
        //= Pages ==============================================================
        if (! $page)
            $page = 1;
        else if (intval($page) < 0)
	        throw new Exception(ExceptionMessages::InvalidPageNumber." : ".$page, ExceptionCodes::InvalidPageNumber);
        else if (!is_numeric($page))
	        throw new Exception(ExceptionMessages::InvalidPageType." : ".$page, ExceptionCodes::InvalidPageType);
        
        if (! $pagesize)
                $pagesize = $Options["PageSize"];
        else if (intval($pagesize) < 0)
	        throw new Exception(ExceptionMessages::InvalidPageSizeNumber." : ".$pagesize, ExceptionCodes::InvalidPageSizeNumber);
        else if (!is_numeric($pagesize))
	        throw new Exception(ExceptionMessages::InvalidPageSizeType." : ".$pagesize, ExceptionCodes::InvalidPageSizeType);
        else if ($pagesize > $Options["MaxPageSize"])
	        throw new Exception(ExceptionMessages::InvalidPageSizeNumber." : ".$pagesize, ExceptionCodes::InvalidPageSizeNumber);

        $startat = ($page -1) * $pagesize;
        $pagesize = 0; //set $pagesize=0 if you want to "cancel" pagesize functionality
        
        //= Sort Mode Labs=================================================
        if (isset($sort_mode))
        {
            $columns = array("ASC", "DESC");
            
            if (!in_array(strtoupper($sort_mode), $columns))
                throw new Exception(ExceptionMessages::InvalidSortModeType." : ".$sort_mode, ExceptionCodes::InvalidSortModeType);
  
            if ($sort_mode === "DESC")
                $sort_mode = 1;
            else if ($sort_mode === "ASC")
                $sort_mode = 0;
  
        }
        else
            $sort_mode = 0;
         
        //= Sort Field Labs=================================================
          if (isset($sort_field))
        {
            $columns = array("edu_admin_id","name","region_edu_admin");
             
            if (!in_array($sort_field, $columns))
                throw new Exception(ExceptionMessages::InvalidSortFieldType." : ".$sort_field, ExceptionCodes::InvalidSortFieldType);
        }
        else
            $sort_field = "name";
        
        
        //= $region_edu_admin ==================================================
        $oRegionEduAdmins = new RegionEduAdminsExt($db);
        $oRegionEduAdmins->getAll($db);
        
        $paramFilter = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/", $region_edu_admin);

        foreach ($arrayValues as $region_edu_admin)
        {
            $region_edu_admin = trim($region_edu_admin);
            
            if (is_numeric($region_edu_admin))
            {
                $paramFilter[] = new DFC(EduAdminsExt::FIELD_REGION_EDU_ADMIN_ID, $region_edu_admin, DFC::EXACT);
            }
            else if ($region_edu_admin)
            {
                $oRegionEduAdmins->searchArrayForValue($region_edu_admin);
                $paramFilter[] = new DFC(EduAdminsExt::FIELD_REGION_EDU_ADMIN_ID, $oRegionEduAdmins->getRegionEduAdminId(), DFC::EXACT);
            }
        }
        
        if ( count($paramFilter) > 0 )
        {
            $filter[] = new DFCAggregate($paramFilter, false);
        }   
        
        //$transfer_area==============================================================================           
        $oTransferAreas = new TransferAreasExt($db);
        $oTransferAreas->getAll($db);
        
        //$municipalities==============================================================================           
        $oMunicipalities = new MunicipalitiesExt($db);
        $oMunicipalities->getAll($db); 
        //==============================================================================        
    
        //$sort = array( new DSC(EduAdminsExt::FIELD_NAME, DSC::ASC) );

        $oEduAdmins = new EduAdminsExt($db);
        $totalRows = $oEduAdmins->findByFilterAsCount($db, $filter, true);
        $result["total"] = $totalRows[0]->getEduAdminId();
        
        if ($pagesize)
            //$countRows = $oEduAdmins->findByFilterWithLimit($db, $filter, true, $sort, $startat, $pagesize);
            $countRows = $oEduAdmins->findByFilterWithLimitBeta($db, $filter, $sort_field, $sort_mode, true, $startat, $pagesize);
        else
          //  $countRows = $oEduAdmins->findByFilter($db, $filter, true, $sort);
            $countRows = $oEduAdmins->findByFilterBeta($db, $filter, $sort_field, $sort_mode, true);
        
        $result["count"] = count( $countRows );
                    
        foreach ($countRows as $row) {
  
        //retrieve transfer_area
        $transfer_area["transfer_area_info"] = array();   
        $filter = array( new DFC(TransferAreasExt::FIELD_EDU_ADMIN_ID,$row->getEduAdminId(), DFC::EXACT));
        $sort = array( new DSC(TransferAreasExt::FIELD_EDU_ADMIN_ID, DSC::ASC) );
        $arrayTransferAreas = $oTransferAreas->findByFilter($db, $filter, true, $sort);  
            
            foreach ($arrayTransferAreas as $arrayTransferArea){
             
                //retrieve municipality
                $municipality["municipality_info"] = array();   
                $filter = array( new DFC(MunicipalitiesExt::FIELD_TRANSFER_AREA_ID,$arrayTransferArea->getTransferAreaId(), DFC::EXACT));
                $sort = array( new DSC(MunicipalitiesExt::FIELD_TRANSFER_AREA_ID, DSC::ASC) );
                $arrayMunicipalities = $oMunicipalities->findByFilter($db, $filter, true, $sort);

                    foreach ($arrayMunicipalities as $arrayMunicipality){ 
                        
                        $municipality["municipality_info"][] = array("municipality_id" => $arrayMunicipality->getMunicipalityId(),
                                                                     "name" => $arrayMunicipality->getName()  
                                                                   );
                    }

                $transfer_area["transfer_area_info"][] = array("transfer_area_id" => $arrayTransferArea->getTransferAreaId(),
                                                                "name" => $arrayTransferArea->getName(),
                                                                "municipalities"=>$municipality
                                                               );  
             }            
            
        $result["data"][] = array("edu_admin_id" => $row->getEduAdminId(), 
                                  "name" => $row->getName(),
                                  "region_edu_admin_id" => $oRegionEduAdmins->searchArrayForID( $row->getRegionEduAdminId() )->getRegionEduAdminId(),
                                  "region_edu_admin" => $oRegionEduAdmins->searchArrayForID( $row->getRegionEduAdminId() )->getName(),
                                  "transfer_areas"=>$transfer_area
                            );
        }

        $result["status"] = ExceptionCodes::NoErrors;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".ExceptionMessages::NoErrors;
    } catch (Exception $e) {
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
} 

?>