<?php
 
header("Content-Type: text/html; charset=utf-8");

/**
 * 
 * @global type $db
 * @global type $Options
 * @param type $equipment_category
 * @param type $pagesize
 * @param int $page
 * @return string
 * @throws Exception
 */

function GetEquipmentTypes($equipment_category, $pagesize, $page) {
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
 
    try
    {
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
             
        //= $equipment_category =======================================================
        $oEquipmentCategories = new EquipmentCategoriesExt($db);
        $oEquipmentCategories->getAll($db);
 
        $paramFilter = array();
        $arrayValues = preg_split("/[\s]*[,][\s]*/", $equipment_category);

        foreach ($arrayValues as $equipment_category)
        {
            $equipment_category = trim($equipment_category);
            
            if (is_numeric($equipment_category))
            {
                $paramFilter[] = new DFC(EquipmentTypesExt::FIELD_EQUIPMENT_CATEGORY_ID, $equipment_category, DFC::EXACT);
            }
            else if ($equipment_category)
            {
                $oEquipmentCategories->searchArrayForValue($equipment_category);
                $paramFilter[] = new DFC(EquipmentTypesExt::FIELD_EQUIPMENT_CATEGORY_ID, $oEquipmentCategories->getEquipmentCategoryId(), DFC::EXACT);
            }
        }
        
        if ( count($paramFilter) > 0 )
        {
            $filter[] = new DFCAggregate($paramFilter, false);
        }   
        //==============================================================================   

        $sort = array( new DSC(EquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, DSC::ASC) );

        $oEquipmentTypes = new EquipmentTypesExt($db);
        $totalRows = $oEquipmentTypes->findByFilterAsCount($db, $filter, true);
        $result["total"] = $totalRows[0]->getEquipmentTypeId();
        
        if ($pagesize)             
            $countRows = $oEquipmentTypes->findByFilterWithLimit($db, $filter, true, $sort, $startat, $pagesize);
        else
            $countRows = $oEquipmentTypes->findByFilter($db, $filter, true, $sort);
        
        $result["count"] = count( $countRows );

        foreach ($countRows as $row) {
            $result["data"][] = array("equipment_type_id" => $row->getEquipmentTypeId(),
                                      "name" => $row->getName(),
                                      "equipment_category" => $oEquipmentCategories->searchArrayForID( $row->getEquipmentCategoryId() )->getName()
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