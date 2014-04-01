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
 * @param type $lab
 * @param type $equipment_type
 * @param type $pagesize
 * @param int $page
 * @return string
 * @throws Exception
 */

function GetLabEquipmentTypes($lab, $equipment_type, $equipment_category, $pagesize, $page) {
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
    $result["lab"] = lab;
    $result["equipment_type"] = $equipment_type;
    $result["equipment_category"] = $equipment_category;
    
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
                 $paramFilter[] = new DFC(LabEquipmentTypesExt::FIELD_LAB_ID, $oLab->getLabId(), DFC::EXACT);
            }
            
            if ( count($paramFilter) > 0 )
            {
                $filter[] = new DFCAggregate($paramFilter, false);
            } 
        
        //$equipment_type==============================================================================
   
            $oEquipmentTypes = new EquipmentTypesExt($db);
            $oEquipmentTypes ->getAll($db);

            $paramFilter = array();
            $arrayValues = preg_split("/[\s]*[,][\s]*/", $equipment_type);

            foreach ($arrayValues as $equipment_type)
            {
                $equipment_type = trim($equipment_type);

                if (is_numeric($equipment_type))
                {
                    $paramFilter[] = new DFC(LabEquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $equipment_type, DFC::EXACT);
                }
                else if ($equipment_type)
                {   
                  //$arrayEquipmentTypes= $oEquipmentTypes->findByFilter($db, new DFC(EquipmentTypesExt::FIELD_NAME, $equipment_type, DFC::EXACT));
                  //$filter[] = new DFC(LabEquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $arrayEquipmentTypes[0]->getEquipmentTypeId(), DFC::EXACT);
                    $oEquipmentTypes->searchArrayForValue($equipment_type);
                    $paramFilter[] = new DFC(LabEquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $oEquipmentTypes->getEquipmentTypeId(), DFC::EXACT);
                }
            }

            if ( count($paramFilter) > 0 )
            {
                $filter[] = new DFCAggregate($paramFilter, false);
            } 
            
        //= $equipment_category =======================================================
        $oEquipmentCategories = new EquipmentCategoriesExt($db);
        $oEquipmentCategories->getAll($db);
 
        $equipment_categories_filters = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/", $equipment_category);

        foreach ($arrayValues as $equipment_category)
        {
            $equipment_category = trim($equipment_category);
            
            if (is_numeric($equipment_category))
            {
                $equipment_categories_filters[] = new DFC(EquipmentTypesExt::FIELD_EQUIPMENT_CATEGORY_ID, $equipment_category, DFC::EXACT);
            }
            else if ($equipment_category)
            {
                $oEquipmentCategories->searchArrayForValue($equipment_category);
                $equipment_categories_filters[] = new DFC(EquipmentTypesExt::FIELD_EQUIPMENT_CATEGORY_ID, $oEquipmentCategories->getEquipmentCategoryId(), DFC::EXACT);
            }
        }
        
//        if ( count($paramFilter) > 0 )
//        {
//            $filter[] = new DFCAggregate($paramFilter, false);
//        } 
        //==============================================================================        
    
        //multiple filters for Labs 
        $ext_filters = array(
            "equipment_categories"=>$equipment_categories_filters
        );
        
        $sort = array( new DSC(LabEquipmentTypesExt::FIELD_LAB_ID, DSC::ASC),
                       new DSC(LabEquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, DSC::ASC));

        $oLabEquipmentTypes = new LabEquipmentTypesExt($db);
       // $totalRows = $oLabEquipmentTypes->findByFilterAsCount($db, $filter, true);
        $totalRows = $oLabEquipmentTypes->findByFilterJoinAsCount($db, $filter, $ext_filters, true); 
       
        $result["total"] = $totalRows[0]->getLabId();
        
        $countRows = $oLabEquipmentTypes->findByFilterBeta($db, $filter, $ext_filters, true, $sort, $startat, $pagesize);
//        if ($pagesize)        
//            $countRows = $oLabEquipmentTypes->findByFilterWithLimit($db, $filter, true, $sort, $startat, $pagesize);
//        else
//            $countRows = $oLabEquipmentTypes->findByFilter($db, $filter, true, $sort);
//        
        $result["count"] = count( $countRows );
        
        if (count( $countRows ) > 0)
        {
            $labsFilter = array();
            $equipment_typesFilter = array();

            foreach ($countRows as $rows)
            {
                $labsFilter[] = new DFC(LabsExt::FIELD_LAB_ID, $rows->getLabId(), DFC::EXACT);
                $equipment_typesFilter[] = new DFC(EquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $rows->getEquipmentTypeId(), DFC::EXACT);
            }

            $oLabs->getAll($db, Validator::ToUniqueObject($labsFilter), false);
            $oEquipmentTypes->getAll($db, Validator::ToUniqueObject($equipment_typesFilter), false);
        }
        
        foreach ($countRows as $row) {
            //$oLab = $row->fetchLabs($db);
            //$oEquipmentType = $row->fetchEquipmentTypes($db);
            $result["data"][] = array(  "lab_id" => $row->getLabId(),
                                        "lab" => $oLabs->searchArrayForID( $row->getLabId())->getName(), //$oLabs->getName(),
                                        "equipment_type_id" => $row->getEquipmentTypeId(),
                                        "equipment_type" =>  $oEquipmentTypes->searchArrayForID( $row->getEquipmentTypeId())->getName(), //$oEquipmentType->getName(),
                                        "items" => $row->getItems()
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