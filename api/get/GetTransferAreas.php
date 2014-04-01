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
 * @param type $edu_admin
 * @param type $pagesize
 * @param int $page
 * @return string
 * @throws Exception
 */

function GetTransferAreas($edu_admin, $pagesize, $page) {
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
//        
//        if ($pagesize == (string)Parameters::AllPageSize)
//            $pagesize = Parameters::AllPageSize;
//        else if (! $pagesize)
//            $pagesize = Parameters::DefaultPageSize;
//        else if (intval($pagesize) < 0)
//	        throw new Exception(ExceptionMessages::InvalidPageSizeNumber." : ".$pagesize, ExceptionCodes::InvalidPageSizeNumber);
//        else if (!is_numeric($pagesize))
//	        throw new Exception(ExceptionMessages::InvalidPageSizeType." : ".$pagesize, ExceptionCodes::InvalidPageSizeType);
//        else if ($pagesize > $Options["MaxPageSize"])
//	        throw new Exception(ExceptionMessages::InvalidPageSizeNumber." : ".$pagesize, ExceptionCodes::InvalidPageSizeNumber);
        if ($pagesize == (string)$Options["AllPageSize"])
            $pagesize = $Options["AllPageSize"];
        else if (! $pagesize)
            $pagesize = $Options["PageSize"];
        else if (intval($pagesize) < 0)
	        throw new Exception(ExceptionMessages::InvalidPageSizeNumber." : ".$pagesize, ExceptionCodes::InvalidPageSizeNumber);
        else if (!is_numeric($pagesize))
	        throw new Exception(ExceptionMessages::InvalidPageSizeType." : ".$pagesize, ExceptionCodes::InvalidPageSizeType);
        else if ($pagesize > $Options["MaxPageSize"])
                throw new Exception(ExceptionMessages::InvalidPageSizeNumber." : ".$pagesize, ExceptionCodes::InvalidPageSizeNumber);
    
        $startat = ($page -1) * $pagesize;
        $pagesize = 0;
        
        //= $edu_admin =========================================================
        $oEduAdmins = new EduAdminsExt($db);
        $oEduAdmins->getAll($db);
                
        $paramFilter = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/", $edu_admin);

        foreach ($arrayValues as $edu_admin)
        {
            $edu_admin = trim($edu_admin);
            
            if (is_numeric($edu_admin))
            {
                $paramFilter[] = new DFC(TransferAreasExt::FIELD_EDU_ADMIN_ID, $edu_admin, DFC::EXACT);
            }
            else if ($edu_admin)
            {
                $oEduAdmins->searchArrayForValue($edu_admin);
                $paramFilter[] = new DFC(TransferAreasExt::FIELD_EDU_ADMIN_ID, $oEduAdmins->getEduAdminId(), DFC::EXACT);
            }
        }
        
        if ( count($paramFilter) > 0 )
        {
            $filter[] = new DFCAggregate($paramFilter, false);
        }
        
        //= $region_edu_admin =========================================================
        $oRegionEduAdmins = new RegionEduAdminsExt($db);
        $oRegionEduAdmins->getAll($db);  
        //============================================================================== 
        
        //$municipalities==============================================================================           
        $oMunicipalities = new MunicipalitiesExt($db);
        $oMunicipalities->getAll($db); 
        //============================================================================== 

        $sort = array( new DSC(TransferAreas::FIELD_NAME, DSC::ASC) );

        $oTransferAreas = new TransferAreasExt($db);
        $totalRows = $oTransferAreas->findByFilterAsCount($db, $filter, true);
        $result["total"] = $totalRows[0]->getTransferAreaId();
        
        if ($pagesize)        
            $countRows = $oTransferAreas->findByFilterWithLimit($db, $filter, true, $sort, $startat, $pagesize);
        else
            $countRows = $oTransferAreas->findByFilter($db, $filter, true, $sort);
        
        $result["count"] = count( $countRows );
        
        foreach ($countRows as $row) {
            $oEduAdmin = $oEduAdmins->searchArrayForID( $row->getEduAdminId());
            $oRegionEduAdmin = $oRegionEduAdmins->searchArrayForID( $oEduAdmin->getRegionEduAdminId() );
                   
            //retrieve municipality
            $municipality["municipality_info"] = array();   
            $filter = array( new DFC(MunicipalitiesExt::FIELD_TRANSFER_AREA_ID,$row->getTransferAreaId(), DFC::EXACT));
            $sort = array( new DSC(MunicipalitiesExt::FIELD_TRANSFER_AREA_ID, DSC::ASC) );
            $arrayMunicipalities = $oMunicipalities->findByFilter($db, $filter, true, $sort);

                foreach ($arrayMunicipalities as $arrayMunicipality){ 

                    $municipality["municipality_info"][] = array("municipality_id" => $arrayMunicipality->getMunicipalityId(),
                                                                 "name" => $arrayMunicipality->getName()  
                                                               );
                }
            
            $result["data"][] = array("transfer_area_id" => $row->getTransferAreaId(), 
                                      "name" => $row->getName(),
                                      "edu_admin_id" => $oEduAdmin->getEduAdminId(),
                                      "edu_admin" => $oEduAdmin->getName(),
                                      "region_edu_admin_id" => $oRegionEduAdmin->getRegionEduAdminId(),
                                      "region_edu_admin" => $oRegionEduAdmin->getName(),
                                      "municipalities"=>$municipality
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