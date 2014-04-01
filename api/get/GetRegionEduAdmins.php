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
 * @param type $pagesize
 * @param int $page
 * @return string
 * @throws Exception
 */

function GetRegionEduAdmins($pagesize, $page) {
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
        $pagesize = 0; 
     
        //$edu_admin===========================================================================
        $oEduAdmins = new EduAdminsExt($db);
        $oEduAdmins->getAll($db);
      
        //$transfer_area==============================================================================           
        $oTransferAreas = new TransferAreasExt($db);
        $oTransferAreas->getAll($db);     

        //$municipalities==============================================================================           
        $oMunicipalities = new MunicipalitiesExt($db);
        $oMunicipalities->getAll($db); 
   
        //==============================================================================

        $sort = array( new DSC(RegionEduAdminsExt::FIELD_NAME, DSC::ASC) );

        $oRegionEduAdmins = new RegionEduAdminsExt($db);
        $totalRows = $oRegionEduAdmins->findByFilterAsCount($db, $filter, true);
        $result["total"] = $totalRows[0]->getRegionEduAdminId();
        
        if ($pagesize)        
            $countRows = $oRegionEduAdmins->findByFilterWithLimit($db, $filter, true, $sort, $startat, $pagesize);
        else
            $countRows = $oRegionEduAdmins->findByFilter($db, $filter, true, $sort);
        
        $result["count"] = count( $countRows );
         
        foreach ($countRows as $row) {
            
            //retrieve edu_admins
            $edu_admin["edu_admin_info"] = array();   
            $filter = array( new DFC(EduAdminsExt::FIELD_REGION_EDU_ADMIN_ID, $row->getRegionEduAdminId(), DFC::EXACT) );
            $sort = array( new DSC(EduAdminsExt::FIELD_EDU_ADMIN_ID, DSC::ASC) );
            $arrayEduAdmins = $oEduAdmins->findByFilter($db, $filter, true, $sort);

                foreach ($arrayEduAdmins as $arrayEduAdmin){
                    
                    //retrieve transfer_area
                    $transfer_area["transfer_area_info"] = array();   
                    $filter = array( new DFC(TransferAreasExt::FIELD_EDU_ADMIN_ID,$arrayEduAdmin->getEduAdminId(), DFC::EXACT));
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

                            $transfer_area["transfer_area_info"][] = array("tranfer_area_id" => $arrayTransferArea->getTransferAreaId(),
                                                                            "name" => $arrayTransferArea->getName(),
                                                                            "municipalities"=>$municipality
                                                                           );  
                        }
                         
                    $edu_admin["edu_admin_info"][] = array("edu_admin_id" =>$arrayEduAdmin->getEduAdminId(),
                                                            "name" => $arrayEduAdmin->getName(),
                                                            "transfer_areas"=>$transfer_area
                                                           );
                }
      
        $result["data"][] = array("region_edu_admin_id" => $row->getRegionEduAdminId(), 
                                  "name" => $row->getName(),
                                  "edu_admins"=>$edu_admin             
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