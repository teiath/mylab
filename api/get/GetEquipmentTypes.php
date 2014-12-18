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
 * @global type $entityManager
 * @global type $app
 * @param type $equipment_type_id
 * @param type $name
 * @param type $equipment_category
 * @param type $pagesize
 * @param type $page
 * @param type $searchtype
 * @param type $ordertype
 * @param type $orderby
 * @return type
 * @throws Exception
 */

function GetEquipmentTypes( $equipment_type_id,$name,$equipment_category,
                            $pagesize, $page, $searchtype, $ordertype, $orderby ) {
  
    global $entityManager, $app;

    $qb = $entityManager->createQueryBuilder();
    $result = array();  

    $result["data"] = array();
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    
    try {
 
//user permissions==============================================================
//not required 
           
//$page - $pagesize - $searchtype - $ordertype =================================
       $page = Pagination::getPage($page, $params);
       $pagesize = Pagination::getPagesize($pagesize, $params, true);     
       $searchtype = Filters::getSearchType($searchtype, $params);
       $ordertype =  Filters::getOrderType($ordertype, $params);
    
 //$orderby=====================================================================
       $columns = array(
                            "eqt.equipmentTypeId"      => "equipment_type_id",
                            "eqt.name"                 => "name",
                            "eqc.equipmentCategoryId"  => "equipment_category_id",
                            "eqc.name"                 => "equipment_category_name"
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "equipment_type_id";
        else
        {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        } 
        
//$equipment_type_id============================================================
        if (Validator::Exists('equipment_type_id', $params)){
            CRUDUtils::setFilter($qb, $equipment_type_id, "eqt", "equipmentTypeId", "equipmentTypeId", "id", ExceptionMessages::InvalidEquipmentTypeIDType, ExceptionCodes::InvalidEquipmentTypeIDType);
        } 

//$name=========================================================================
        if (Validator::Exists('name', $params)){
            CRUDUtils::setSearchFilter($qb, $name, "eqt", "name", $searchtype, ExceptionMessages::InvalidEquipmentTypeNameType, ExceptionCodes::InvalidEquipmentTypeNameType);    
        }  

//$equipment_category===========================================================
        if (Validator::Exists('equipment_category', $params)){
            CRUDUtils::setFilter($qb, $equipment_category, "eqc", "equipmentCategoryId", "name", "id,value", ExceptionMessages::InvalidEquipmentCategoryType, ExceptionCodes::InvalidEquipmentCategoryType);
        } 
        
//execution=====================================================================
        $qb->select('eqt');
        $qb->from('EquipmentTypes', 'eqt');
        $qb->leftjoin('eqt.equipmentCategory', 'eqc');
        $qb->orderBy(array_search($orderby, $columns), $ordertype);

//pagination and results========================================================      
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        $results->getQuery()->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $results->getQuery()->setMaxResults($pagesize) : null;

//data results==================================================================       
        $count = 0;
        foreach ($results as $equipmenttype)
        {

            $result["data"][] = array(
                                        "equipment_type_id"          => $equipmenttype->getEquipmentTypeId(),
                                        "name"                       => $equipmenttype->getName(),                                 
                                        "equipment_category_id"      => $equipmenttype->getEquipmentCategory()->getEquipmentCategoryId(),
                                        "equipment_category_name"    => $equipmenttype->getEquipmentCategory()->getName()
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