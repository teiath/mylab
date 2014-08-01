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
 * @param type $lab_id
 * @param type $lab_name
 * @param type $equipment_type_id
 * @param type $equipment_type_name
 * @param type $items
 * @param type $pagesize
 * @param type $page
 * @param type $searchtype
 * @param type $ordertype
 * @param type $orderby
 * @return type
 * @throws Exception
 */

function GetLabEquipmentTypes( $lab_id, $lab_name, $equipment_type_id, $equipment_type_name,
                               $items, 
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
    
//set user permissions==========================================================
    $permissions = UserRoles::getUserPermissions($app->request->user);

    if (Validator::IsNull($permissions['permit_labs'])){
        throw new Exception(ExceptionMessages::NoPermissionsError, ExceptionCodes::NoPermissionsError);     
    }else { 
        $permit_labs = $permissions['permit_labs'];
    }
    
//$page - $pagesize - $searchtype - $ordertype =================================
       $page = Pagination::getPage($page, $params);
       $pagesize = Pagination::getPagesize($pagesize, $params);     
       $searchtype = Filters::getSearchType($searchtype, $params);
       $ordertype =  Filters::getOrderType($ordertype, $params);
               
//$orderby======================================================================
       $columns = array(
                            "l.labId"             => "lab_id",
                            "l.name"              => "lab_name",
                            "eqt.equipmentTypeId" => "equipment_type_id" ,
                            "eqt.name"            => "equipment_type_name",
                           "leqt.items"           => "items"
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "lab_id";
        else
        {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        }
                      
//$lab_id=======================================================================
        if (Validator::Exists('lab_id', $params)){
            Filters::setFilter($qb, $lab_id, "l", "labId", "labId", "id", ExceptionMessages::InvalidWorkerIDType, ExceptionCodes::InvalidWorkerIDType);
        } 

//$lab_name=====================================================================
        if (Validator::Exists('lab_name', $params)){
            Filters::setSearchFilter($qb, $lab_name, "l", "name", $searchtype, ExceptionMessages::InvalidWorkerFirstnameType, ExceptionCodes::InvalidWorkerFirstnameType);    
        } 
        
//$equipment_type_id============================================================
        if (Validator::Exists('equipment_type_id', $params)){
            Filters::setFilter($qb, $equipment_type_id, "eqt", "equipmentTypeId", "equipmentTypeId", "id", ExceptionMessages::InvalidWorkerRegistryNoType, ExceptionCodes::InvalidWorkerRegistryNoType);    
        }

//$equipment_type_name==========================================================
        if (Validator::Exists('equipment_type_name', $params)){
            Filters::setSearchFilter ($qb, $equipment_type_name, "eqt", "name", $searchtype, ExceptionMessages::InvalidWorkerLastnameType, ExceptionCodes::InvalidWorkerLastnameType);
        }  

//$items========================================================================
        if (Validator::Exists('items', $params)){
            Filters::setSearchFilter($qb, $items, "leqt", "items", $searchtype, ExceptionMessages::InvalidWorkerFatherNameType, ExceptionCodes::InvalidWorkerFatherNameType);    
        } 
    
//execution=====================================================================
        $qb->select('leqt');
        $qb->from('LabEquipmentTypes', 'leqt');
        $qb->leftjoin('leqt.lab', 'l');
        $qb->leftjoin('leqt.equipmentType', 'eqt'); 
        $qb->orderBy(array_search($orderby, $columns), $ordertype);
        
        if ($permit_labs !== 'ALLRESULTS'){
            $qb->andWhere($qb->expr()->in('l.labId', ':ids'))
                ->setParameter('ids', $permit_labs);
        }

//pagination and results========================================================     
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery(), false);
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
                                        "equipment_type_id"     => $labequipmenttypes->getEquipmentType()->getEquipmentTypeId(),
                                        "equipment_type_name"   => $labequipmenttypes->getEquipmentType()->getName(),
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