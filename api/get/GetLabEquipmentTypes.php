<?php
/**
 *
 * @version 2.0
 * @author  ΤΕΙ Αθήνας
 * @package GET
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

function GetLabEquipmentTypes( $lab_id, $lab_name, $equipment_type_id, $equipment_type_name,
                               $items, 
                               $pagesize, $page, $searchtype, $ordertype, $orderby ) {
    
//    global $db;
//    global $Options;
//    global $app;
//    
//    $filter = array();
//    $result = array();  
//
//    $result["data"] = array();
//    $controller = $app->environment();
//    $controller = substr($controller["PATH_INFO"], 1);
//    
//    $result["function"] = $controller;
//    $result["method"] = $app->request()->getMethod();
//    $result["lab"] = lab;
//    $result["equipment_type"] = $equipment_type;
//    $result["equipment_category"] = $equipment_category;
//    
//    try {
//        
//        //= Pages ==============================================================
//        if (! $page)
//            $page = 1;
//        else if (intval($page) < 0)
//	        throw new Exception(ExceptionMessages::InvalidPageNumber." : ".$page, ExceptionCodes::InvalidPageNumber);
//        else if (!is_numeric($page))
//	        throw new Exception(ExceptionMessages::InvalidPageType." : ".$page, ExceptionCodes::InvalidPageType);
//        
//        if (! $pagesize)
//                $pagesize = $Options["PageSize"];
//        else if (intval($pagesize) < 0)
//	        throw new Exception(ExceptionMessages::InvalidPageSizeNumber." : ".$pagesize, ExceptionCodes::InvalidPageSizeNumber);
//        else if (!is_numeric($pagesize))
//	        throw new Exception(ExceptionMessages::InvalidPageSizeType." : ".$pagesize, ExceptionCodes::InvalidPageSizeType);
//        else if ($pagesize > $Options["MaxPageSize"])
//                throw new Exception(ExceptionMessages::InvalidPageSizeNumber." : ".$pagesize, ExceptionCodes::InvalidPageSizeNumber);
//        
//        $startat = ($page -1) * $pagesize;    
//
//        //= $lab ==================================================
//
//            $oLabs = new LabsExt($db);
//
//            $paramFilter = array();
//            $arrayValues = preg_split("/[\s]*[,][\s]*/",$lab);
//
//            foreach ($arrayValues as $lab)
//            {
//                $lab = trim($lab);
//
//                if (is_numeric($lab))
//                {
//                    $paramFilter[] = new DFC(LabsExt::FIELD_LAB_ID, $lab, DFC::EXACT);
//                }
//                else if ($lab)
//                {
//                    $paramFilter[] = new DFC(LabsExt::FIELD_NAME, $lab, DFC::EXACT);
//                }
//            }
//           
//            if ( count($paramFilter) > 0 )
//            {
//                $oLabs->getAll($db, $paramFilter, false);
//            } 
//            
//            $paramFilter = array();
//            foreach ($oLabs->getObjsArray() as $oLab)
//            {
//                 $paramFilter[] = new DFC(LabEquipmentTypesExt::FIELD_LAB_ID, $oLab->getLabId(), DFC::EXACT);
//            }
//            
//            if ( count($paramFilter) > 0 )
//            {
//                $filter[] = new DFCAggregate($paramFilter, false);
//            } 
//        
//        //$equipment_type==============================================================================
//   
//            $oEquipmentTypes = new EquipmentTypesExt($db);
//            $oEquipmentTypes ->getAll($db);
//
//            $paramFilter = array();
//            $arrayValues = preg_split("/[\s]*[,][\s]*/", $equipment_type);
//
//            foreach ($arrayValues as $equipment_type)
//            {
//                $equipment_type = trim($equipment_type);
//
//                if (is_numeric($equipment_type))
//                {
//                    $paramFilter[] = new DFC(LabEquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $equipment_type, DFC::EXACT);
//                }
//                else if ($equipment_type)
//                {   
//                  //$arrayEquipmentTypes= $oEquipmentTypes->findByFilter($db, new DFC(EquipmentTypesExt::FIELD_NAME, $equipment_type, DFC::EXACT));
//                  //$filter[] = new DFC(LabEquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $arrayEquipmentTypes[0]->getEquipmentTypeId(), DFC::EXACT);
//                    $oEquipmentTypes->searchArrayForValue($equipment_type);
//                    $paramFilter[] = new DFC(LabEquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $oEquipmentTypes->getEquipmentTypeId(), DFC::EXACT);
//                }
//            }
//
//            if ( count($paramFilter) > 0 )
//            {
//                $filter[] = new DFCAggregate($paramFilter, false);
//            } 
//            
//        //= $equipment_category =======================================================
//        $oEquipmentCategories = new EquipmentCategoriesExt($db);
//        $oEquipmentCategories->getAll($db);
// 
//        $equipment_categories_filters = array();
//        $arrayValues = preg_split("/[\s]*[,][\s]*/", $equipment_category);
//
//        foreach ($arrayValues as $equipment_category)
//        {
//            $equipment_category = trim($equipment_category);
//            
//            if (is_numeric($equipment_category))
//            {
//                $equipment_categories_filters[] = new DFC(EquipmentTypesExt::FIELD_EQUIPMENT_CATEGORY_ID, $equipment_category, DFC::EXACT);
//            }
//            else if ($equipment_category)
//            {
//                $oEquipmentCategories->searchArrayForValue($equipment_category);
//                $equipment_categories_filters[] = new DFC(EquipmentTypesExt::FIELD_EQUIPMENT_CATEGORY_ID, $oEquipmentCategories->getEquipmentCategoryId(), DFC::EXACT);
//            }
//        }
//        
////        if ( count($paramFilter) > 0 )
////        {
////            $filter[] = new DFCAggregate($paramFilter, false);
////        } 
//        //==============================================================================        
//    
//        //multiple filters for Labs 
//        $ext_filters = array(
//            "equipment_categories"=>$equipment_categories_filters
//        );
//        
//        $sort = array( new DSC(LabEquipmentTypesExt::FIELD_LAB_ID, DSC::ASC),
//                       new DSC(LabEquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, DSC::ASC));
//
//        $oLabEquipmentTypes = new LabEquipmentTypesExt($db);
//       // $totalRows = $oLabEquipmentTypes->findByFilterAsCount($db, $filter, true);
//        $totalRows = $oLabEquipmentTypes->findByFilterJoinAsCount($db, $filter, $ext_filters, true); 
//       
//        $result["total"] = $totalRows[0]->getLabId();
//        
//        $countRows = $oLabEquipmentTypes->findByFilterBeta($db, $filter, $ext_filters, true, $sort, $startat, $pagesize);
////        if ($pagesize)        
////            $countRows = $oLabEquipmentTypes->findByFilterWithLimit($db, $filter, true, $sort, $startat, $pagesize);
////        else
////            $countRows = $oLabEquipmentTypes->findByFilter($db, $filter, true, $sort);
////        
//        $result["count"] = count( $countRows );
//        
//        if (count( $countRows ) > 0)
//        {
//            $labsFilter = array();
//            $equipment_typesFilter = array();
//
//            foreach ($countRows as $rows)
//            {
//                $labsFilter[] = new DFC(LabsExt::FIELD_LAB_ID, $rows->getLabId(), DFC::EXACT);
//                $equipment_typesFilter[] = new DFC(EquipmentTypesExt::FIELD_EQUIPMENT_TYPE_ID, $rows->getEquipmentTypeId(), DFC::EXACT);
//            }
//
//            $oLabs->getAll($db, Validator::ToUniqueObject($labsFilter), false);
//            $oEquipmentTypes->getAll($db, Validator::ToUniqueObject($equipment_typesFilter), false);
//        }
//        
//        foreach ($countRows as $row) {
//            //$oLab = $row->fetchLabs($db);
//            //$oEquipmentType = $row->fetchEquipmentTypes($db);
//            $result["data"][] = array(  "lab_id" => $row->getLabId(),
//                                        "lab" => $oLabs->searchArrayForID( $row->getLabId())->getName(), //$oLabs->getName(),
//                                        "equipment_type_id" => $row->getEquipmentTypeId(),
//                                        "equipment_type" =>  $oEquipmentTypes->searchArrayForID( $row->getEquipmentTypeId())->getName(), //$oEquipmentType->getName(),
//                                        "items" => $row->getItems()
//                                );
//        }
//
//        $result["status"] = ExceptionCodes::NoErrors;
//        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".ExceptionMessages::NoErrors;
//    } catch (Exception $e) {
//        $result["status"] = $e->getCode();
//        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
//    } 
//    return $result;
//} 

    global $entityManager, $app;

    $qb = $entityManager->createQueryBuilder();
    $result = array();  

    $result["data"] = array();
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    
    try {  
    
//$page - $pagesize - $searchtype - $ordertype =================================
       $page = Pagination::getPage($page, $params);
       $pagesize = Pagination::getPagesize($pagesize, $params);     
       $searchtype = Filters::getSearchType($searchtype, $params);
       $ordertype =  Filters::getOrderType($ordertype, $params);
               
//$orderby======================================================================
       $columns = array(
            "l.labId" => "lab_id",
            "l.name" => "lab_name",
            "eqt.equipmentTypeId" => "equipment_type_id" ,
            "eqt.name" => "equipment_type_name",
            "leqt.items" => "items"
             );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "lab_id";
        else
        {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        }
                      
//$lab_id====================================================================
        if (Validator::Exists('lab_id', $params)){
            Filters::setFilter($qb, $lab_id, "l", "labId", "labId", "id", ExceptionMessages::InvalidWorkerIDType, ExceptionCodes::InvalidWorkerIDType);
        } 

//$lab_name====================================================================
        if (Validator::Exists('lab_name', $params)){
            Filters::setSearchFilter($qb, $lab_name, "l", "name", $searchtype, ExceptionMessages::InvalidWorkerFirstnameType, ExceptionCodes::InvalidWorkerFirstnameType);    
        } 
        
//$equipment_type_id==============================================================
        if (Validator::Exists('equipment_type_id', $params)){
            Filters::setFilter($qb, $equipment_type_id, "eqt", "equipmentTypeId", "equipmentTypeId", "id", ExceptionMessages::InvalidWorkerRegistryNoType, ExceptionCodes::InvalidWorkerRegistryNoType);    
        }

//$equipment_type_name=====================================================================
        if (Validator::Exists('equipment_type_name', $params)){
            Filters::setSearchFilter ($qb, $equipment_type_name, "eqt", "name", $searchtype, ExceptionMessages::InvalidWorkerLastnameType, ExceptionCodes::InvalidWorkerLastnameType);
        }  

//$items===================================================================
        if (Validator::Exists('items', $params)){
            Filters::setSearchFilter($qb, $items, "leqt", "items", $searchtype, ExceptionMessages::InvalidWorkerFatherNameType, ExceptionCodes::InvalidWorkerFatherNameType);    
        } 
    
//execution=====================================================================
        $qb->select('leqt');
        $qb->from('LabEquipmentTypes', 'leqt');
        $qb->leftjoin('leqt.labId', 'l');
     //   $qb->leftjoin('leqt.EquipmentTypes', 'eqt'); 
        $qb->orderBy(array_search($orderby, $columns), $ordertype);

//pagination and results========================================================     
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        $results->getQuery()->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $results->getQuery()->setMaxResults($pagesize) : null;

//data results==================================================================       
        $count = 0;
        foreach ($results as $labequipmenttypes)
        {

            $result["data"][] = array(
                                        "lab_id"                => $labequipmenttypes->getLab()->getLabId(),
                                        "lab_name"              => $labequipmenttypes->getLab()->getName(),
                                        "equipment_type_id"     => $labequipmenttypes->getEquipmenType()->getEquipmenTypeId(),
                                        "equipment_type_name"   => $labequipmenttypes->getEquipmenType()->getName(),
                                        "items"                 => $labequipmenttypes->getItems(),
                                    );
            $count++;
        }
        $result["count"] = $count;
   
//pagination results============================================================     
        $maxPage = Pagination::getMaxPage($result["total"],$page,$pagesize);
        $pagination = array( "page" => $page,   
                             "maxPage" => $maxPage, 
                             "pagesize" => $pagesize 
                            );    
        $result["pagination"]=$pagination;
           
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
    
    return $result;       
           
}

?>