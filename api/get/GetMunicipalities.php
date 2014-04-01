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
 * @param type $prefecture
 * @param type $transfer_area
 * @param type $pagesize
 * @param int $page
 * @return string
 * @throws Exception
 */

function GetMunicipalities($prefecture, $transfer_area, $pagesize, $page) {
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
        
        //= $prefecture ========================================================
        
 /* old version which exams for notfound values
  *  
        $oPrefectures = new PrefecturesExt($db);
        $oPrefectures->getAll($db);
   
        if (is_numeric($prefecture)) {
            $filter[] = new DFC(MunicipalitiesExt::FIELD_PREFECTURE_ID, $prefecture, DFC::EXACT);
            $filter_check = new DFC(PrefecturesExt::FIELD_PREFECTURE_ID, $prefecture, DFC::EXACT);
        } else if ($prefecture) {
            $oPrefectures->searchArrayForValue($prefecture);
            $filter[] = new DFC(MunicipalitiesExt::FIELD_PREFECTURE_ID, $oPrefectures->getPrefectureId(), DFC::EXACT);
            $filter_check = new DFC(PrefecturesExt::FIELD_NAME, $prefecture, DFC::EXACT);
        }
        
        if ( $prefecture && (count($oPrefectures->findByFilter($db, $filter_check, true)) < 1)){
         throw new Exception(ExceptionMessages::InvalidPrefectureValue." : ".$prefecture, ExceptionCodes::InvalidPrefectureValue);
        }
   */     
        $oPrefectures = new PrefecturesExt($db);
        $oPrefectures->getAll($db);

        $paramFilter = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/", $prefecture);

        foreach ($arrayValues as $prefecture)
        {
            $prefecture = trim($prefecture);
            
            if (is_numeric($prefecture))
            {
                $paramFilter[] = new DFC(MunicipalitiesExt::FIELD_PREFECTURE_ID, $prefecture, DFC::EXACT);
            }
            else if ($prefecture)
            {
                $oPrefectures->searchArrayForValue($prefecture);
                $paramFilter[] = new DFC(MunicipalitiesExt::FIELD_PREFECTURE_ID, $oPrefectures->getPrefectureId(), DFC::EXACT);
            }
        }
        
        if ( count($paramFilter) > 0 )
        {
            $filter[] = new DFCAggregate($paramFilter, false);
        }     
        
        //= $transfer_area ========================================================
        $oTransferareas = new TransferAreasExt($db);
        $oTransferareas->getAll($db);
       
        $paramFilter = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/", $transfer_area);

        foreach ($arrayValues as $transfer_area)
        {
            $transfer_area = trim($transfer_area);
            
            if (is_numeric($transfer_area))
            {
                $paramFilter[] = new DFC(MunicipalitiesExt::FIELD_TRANSFER_AREA_ID, $transfer_area, DFC::EXACT);
            }
            else if ($transfer_area)
            {
                $oTransferareas->searchArrayForValue($transfer_area);
                $paramFilter[] = new DFC(MunicipalitiesExt::FIELD_TRANSFER_AREA_ID, $oTransferareas->getTransferareaId(), DFC::EXACT);
            }
        }
        
        if ( count($paramFilter) > 0 )
        {
            $filter[] = new DFCAggregate($paramFilter, false);
        } 
      
        //$edu_admin===========================================================================
        $oEduAdmins = new EduAdminsExt($db);
        $oEduAdmins->getAll($db);

        //$region_edu_admin==============================================================================           
        $oRegionEduAdmins = new RegionEduAdminsExt($db);
        $oRegionEduAdmins->getAll($db);

        //==============================================================================        
    
        $sort = array( new DSC(MunicipalitiesExt::FIELD_NAME, DSC::ASC) );

        $oMunicipality = new MunicipalitiesExt($db);
        $totalRows = $oMunicipality->findByFilterAsCount($db, $filter, true);
        $result["total"] = $totalRows[0]->getMunicipalityId();
        
        if ($pagesize)
            $countRows = $oMunicipality->findByFilterWithLimit($db, $filter, true, $sort, $startat, $pagesize);
        else
            $countRows = $oMunicipality->findByFilter($db, $filter, true, $sort);
        
        $result["count"] = count( $countRows );

        foreach ($countRows as $row) {

            $oPrefecture = $oPrefectures->searchArrayForID( $row->getPrefectureId() );
            $oTransferarea = $oTransferareas->searchArrayForID($row->getTransferAreaId() );
            $oEduAdmin = $oEduAdmins->searchArrayForID( $oTransferarea->getEduAdminId() );
            $oRegionEduAdmin = $oRegionEduAdmins->searchArrayForID( $oEduAdmin->getRegionEduAdminId() );
            
            $result["data"][] = array("municipality_id" => $row->getMunicipalityId(), 
                                      "name" => $row->getName(),
                                      "prefecture_id" => $oPrefecture->getPrefectureId(),
                                      "prefecture" => $oPrefecture->getName(),
                                      "transfer_area_id" => $oTransferarea->getTransferAreaId(),
                                      "transfer_area" => $oTransferarea->getName(),
                                      "edu_admin_id" => $oEduAdmin->getEduAdminId(),
                                      "edu_admin" => $oEduAdmin->getName(),
                                      "region_edu_admin_id" => $oRegionEduAdmin->getRegionEduAdminId(),
                                      "region_edu_admin" => $oRegionEduAdmin->getName()
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