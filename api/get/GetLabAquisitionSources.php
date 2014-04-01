<?php
/**
 *
 * @version 1.4
 * @author  ΤΕΙ Αθήνας
 * @package GET
 */

header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @param type $lab
 * @param type $aquisition_source
 * @param type $pagesize
 * @param int $page
 * @return string
 * @throws Exception
 */
 
function GetLabAquisitionSources($lab,$aquisition_source,$aquisition_year,$pagesize, $page) {
    global $db;
    global $app;
   
    $filter = array();
    $result = array();  

    $result["data"] = array();
    $controller = $app->environment();
    $controller = substr($controller["PATH_INFO"], 1);
    
    $result["function"] = $controller;
    $result["method"] = $app->request()->getMethod();

    try {
        
        //pagination 
        $page = Pagination::Page($page);
        $pagesize = Pagination::Pagesize($pagesize);
        $startAt = Pagination::StartPagesizeFrom($page, $pagesize);
        
        //= $lab ==================================================

            $oLabs = new LabsExt($db);

            $paramFilter = array();
            $arrayValues = preg_split("/[\s]*[,][\s]*/",$lab);

            foreach ($arrayValues as $lab)
            {
                $lab = trim($lab);

                if (is_numeric($lab))
                {
                    $paramFilter[] = new DFC(LabsExt::FIELD_LAB_ID, $lab, DFC::EXACT);
                }
                else if ($lab)
                {
                    $paramFilter[] = new DFC(LabsExt::FIELD_NAME, $lab, DFC::EXACT);
                }
            }
           
            if ( count($paramFilter) > 0 )
            {
                $oLabs->getAll($db, $paramFilter, false);
            } 
            
            $paramFilter = array();
            foreach ($oLabs->getObjsArray() as $oLab)
            {
                 $paramFilter[] = new DFC(LabAquisitionSourcesExt::FIELD_LAB_ID, $oLab->getLabId(), DFC::EXACT);
            }
            
            if ( count($paramFilter) > 0 )
            {
                $filter[] = new DFCAggregate($paramFilter, false);
            } 
                     
        //$aquisition_source==============================================================================
 
            $oAquisitionSources = new AquisitionSourcesExt($db);
            $oAquisitionSources ->getAll($db);

            $paramFilter = array();
            $arrayValues = preg_split("/[\s]*[,][\s]*/", $aquisition_source);

            foreach ($arrayValues as $aquisition_source)
            {
                $aquisition_source = trim($aquisition_source);

                if (is_numeric($aquisition_source))
                {
                    $paramFilter[] = new DFC(LabAquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, $aquisition_source, DFC::EXACT);
                }
                else if ($aquisition_source)
                {
                    $oAquisitionSources->searchArrayForValue($aquisition_source);
                    $paramFilter[] = new DFC(LabAquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, $oAquisitionSources->getAquisitionSourceId(), DFC::EXACT);
                }
            }

            if ( count($paramFilter) > 0 )
            {
                $filter[] = new DFCAggregate($paramFilter, false);
            } 


            //$aquisition_year==============================================================================
            if ($aquisition_year){
                
            $paramFilter = array();
            $arrayValues = preg_split("/[\s]*[,][\s]*/", $aquisition_year);

            foreach ($arrayValues as $aquisition_year)
            {
                $aquisition_year = trim($aquisition_year);

               // if (is_numeric($aquisition_year))
               // {
                    $paramFilter[] = new DFC(LabAquisitionSourcesExt::FIELD_AQUISITION_YEAR, $aquisition_year, DFC::EXACT);
               // }
                
            }

            if ( count($paramFilter) > 0 )
            {
                $filter[] = new DFCAggregate($paramFilter, false);
            } 
            
            }
            
        //==============================================================================  
           
        //sorting aquisition_sources by name and Initialize object $oLabAquisitionSource
        $sort = array( new DSC(LabAquisitionSourcesExt::FIELD_LAB_ID, DSC::ASC),
                       new DSC(LabAquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, DSC::ASC) 
                      );
        $oLabAquisitionSources = new LabAquisitionSourcesExt($db);
        
        //find total results by filter
        $totalRows = $oLabAquisitionSources->findByFilterAsCount($db, $filter, true);
        $result["total"] = $total = $totalRows[0]->getLabId();
        $result["total"] = (int)$total;
        
        //check if $page input from user, is valid
        $maxPage = Pagination::checkMaxPage($total, $page, $pagesize);
        
        if ($pagesize)        
            //$countRows = $oLabAquisitionSources->findByFilterWithLimit($db, $filter, true, $sort, $startAt, $pagesize);
            $oLabAquisitionSources->getAllWithLimit($db, $filter, true, $sort, $startAt, $pagesize);
        else
           // $countRows = $oLabAquisitionSources->findByFilter($db, $filter, true, $sort);
            $oLabAquisitionSources->getAll($db, $filter, true, $sort);
        
        //$result["count"] = count( $countRows );
        $result["count"] = count( $oLabAquisitionSources->getObjsArray());

//        if (count( $countRows ) > 0)
        if (count( $oLabAquisitionSources->getObjsArray() ) > 0)
        {
            $labsFilter = array();
            $aquisition_sourcesFilter = array();

           // foreach ($countRows as $rows)
            foreach ($oLabAquisitionSources->getObjsArray() as $rows)
            {
                $labsFilter[] = new DFC(LabsExt::FIELD_LAB_ID, $rows->getLabId(), DFC::EXACT);
                $aquisition_sourcesFilter[] = new DFC(AquisitionSourcesExt::FIELD_AQUISITION_SOURCE_ID, $rows->getAquisitionSourceId(), DFC::EXACT);
            }

            $oLabs->getAll($db, Validator::ToUniqueObject($labsFilter), false);
            $oAquisitionSources->getAll($db, Validator::ToUniqueObject($aquisition_sourcesFilter), false);
        }
            

   
        foreach ($oLabAquisitionSources->getObjsArray() as $row) {
       // foreach ($countRows as $row) {
            $result["data"][] = array("lab_aquisition_source_id" =>$row->getLabAquisitionSourceId(),
                                      "lab_id" => $row->getLabId(),
                                      "lab" => $oLabs->searchArrayForID( $row->getLabId())->getName(), //$oLabs->getName(),
                                      "aquisition_source_id" => $row->getAquisitionSourceId(),
                                      "aquisition_source" => $oAquisitionSources->searchArrayForID( $row->getAquisitionSourceId())->getName(), //$oAquisitionSources->getName()
                                      "aquisition_year" => $row->getAquisitionYear(),
                                      "aquisition_comments" => $row->getAquisitionComments()
                                );
        }
        
        //return pagination values 
        $pagination = array(
            "page" => (int)$page,
            "maxPage" => (int)$maxPage,
            "pagesize" => (int)$pagesize
        ); 
        
        $result["pagination"]=$pagination; 

        $result["status"] = ExceptionCodes::NoErrors;
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".ExceptionMessages::NoErrors;
    } catch (Exception $e) {
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
} 

?>