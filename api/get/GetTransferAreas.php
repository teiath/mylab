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
 * @global type $app
 * @param type $transfer_area_id
 * @param type $name
 * @param type $edu_admin
 * @param type $pagesize
 * @param int $page
 * @param type $searchtype
 * @param type $ordertype
 * @param type $orderby
 * @return string
 * @throws Exception
 */

function GetTransferAreas( $transfer_area_id, $name, $edu_admin,
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
        
//$page - $pagesize - $searchtype - $ordertype =================================
       $page = Pagination::getPage($page, $params);
       $pagesize = Pagination::getPagesize($pagesize, $params, true);     
       $searchtype = Filters::getSearchType($searchtype, $params);
       $ordertype =  Filters::getOrderType($ordertype, $params);
    
 //$orderby=====================================================================
       $columns = array(
                            "ta.transferAreaId"    => "transfer_area_id",
                            "ta.name"              => "name",
                            "ea.eduAdminId"        => "edu_admin_id" ,
                            "ea.name"              => "edu_admin_name"
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "transfer_area_id";
        else
        {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        } 
        
//$transfer_area_id=================================================================
        if (Validator::Exists('transfer_area_id', $params)){
            CRUDUtils::setFilter($qb, $transfer_area_id, "ta", "transferAreaId", "transferAreaId", "id", ExceptionMessages::InvalidTransferAreaIDType, ExceptionCodes::InvalidTransferAreaIDType);
        } 

//$name=========================================================================
        if (Validator::Exists('name', $params)){
            CRUDUtils::setSearchFilter($qb, $name, "ta", "name", $searchtype, ExceptionMessages::InvalidTransferAreaNameType, ExceptionCodes::InvalidTransferAreaNameType);    
        }

//$edu_admin===============================================================
        if (Validator::Exists('edu_admin', $params)){
            CRUDUtils::setFilter($qb, $edu_admin, "ea", "eduAdminId", "name", "id,value", ExceptionMessages::InvalidEduAdminType, ExceptionCodes::InvalidEduAdminType);
        }  
        
//execution=====================================================================
        $qb->select('ta');
        $qb->from('TransferAreas', 'ta');
        $qb->leftjoin('ta.eduAdmin', 'ea');
        $qb->orderBy(array_search($orderby, $columns), $ordertype);

//pagination and results========================================================      
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        $results->getQuery()->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $results->getQuery()->setMaxResults($pagesize) : null;

//data results==================================================================       
        $count = 0;
        foreach ($results as $transferarea)
        {

            $result["data"][] = array(
                                            "transfer_area_id"      => $transferarea->getTransferAreaId(),
                                            "name"                  => $transferarea->getName(),                         
                                            "edu_admin_id"          => Validator::IsNull($transferarea->getEduAdmin()) ? Validator::ToNull() : $transferarea->getEduAdmin()->getEduAdminId(),
                                            "edu_admin_name"        => Validator::IsNull($transferarea->getEduAdmin()) ? Validator::ToNull() : $transferarea->getEduAdmin()->getName()
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
     
        
      
//                foreach ($arrayMunicipalities as $arrayMunicipality){ 
//
//                    $municipality["municipality_info"][] = array("municipality_id" => $arrayMunicipality->getMunicipalityId(),
//                                                                 "name" => $arrayMunicipality->getName()  
//                                                               );
//                }
//            
//            $result["data"][] = array("transfer_area_id" => $row->getTransferAreaId(), 
//                                      "name" => $row->getName(),
//                                      "edu_admin_id" => $oEduAdmin->getEduAdminId(),
//                                      "edu_admin" => $oEduAdmin->getName(),
//                                      "region_edu_admin_id" => $oRegionEduAdmin->getRegionEduAdminId(),
//                                      "region_edu_admin" => $oRegionEduAdmin->getName(),
//                                      "municipalities"=>$municipality
//                                );
//        }

?>