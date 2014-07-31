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
 * @param type $region_edu_admin
 * @param type $name
 * @param type $pagesize
 * @param type $page
 * @param type $searchtype
 * @param type $ordertype
 * @param type $orderby
 * @return type
 * @throws Exception
 */

function GetRegionEduAdmins( $region_edu_admin_id, $name,
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
                            "rea.regionEduAdminId"   => "region_edu_admin_id",
                            "rea.name"               => "name"
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "region_edu_admin_id";
        else
        {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        } 
        
//$region_edu_admin_id=================================================================
        if (Validator::Exists('region_edu_admin_id', $params)){
            CRUDUtils::setFilter($qb, $region_edu_admin_id, "rea", "regionEduAdminId", "regionEduAdminId", "id", ExceptionMessages::InvalidRegionEduAdminIDType, ExceptionCodes::InvalidRegionEduAdminIDType);
        } 

//$name=========================================================================
        if (Validator::Exists('name', $params)){
            CRUDUtils::setSearchFilter($qb, $name, "rea", "name", $searchtype, ExceptionMessages::InvalidRegionEduAdminNameType, ExceptionCodes::InvalidRegionEduAdminNameType);    
        }
        
//execution=====================================================================
        $qb->select('rea');
        $qb->from('RegionEduAdmins', 'rea');
        $qb->orderBy(array_search($orderby, $columns), $ordertype);

//pagination and results========================================================      
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        $results->getQuery()->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $results->getQuery()->setMaxResults($pagesize) : null;

//data results==================================================================       
        $count = 0;
        foreach ($results as $regioneduadmin)
        {

            $result["data"][] = array(
                                            "region_edu_admin_id"    => $regioneduadmin->getRegionEduAdminId(),
                                            "name"                   => $regioneduadmin->getName()
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

                               
//                                foreach ($arrayMunicipalities as $arrayMunicipality){ 
//                              
//                                    $municipality["municipality_info"][] = array("municipality_id" => $arrayMunicipality->getMunicipalityId(),
//                                                                                "name" => $arrayMunicipality->getName()  
//                                                                               );
//                                }
//
//                            $transfer_area["transfer_area_info"][] = array("tranfer_area_id" => $arrayTransferArea->getTransferAreaId(),
//                                                                            "name" => $arrayTransferArea->getName(),
//                                                                            "municipalities"=>$municipality
//                                                                           );  
//                        }
//                         
//                    $edu_admin["edu_admin_info"][] = array("edu_admin_id" =>$arrayEduAdmin->getEduAdminId(),
//                                                            "name" => $arrayEduAdmin->getName(),
//                                                            "transfer_areas"=>$transfer_area
//                                                           );
//                }
//      
//        $result["data"][] = array("region_edu_admin_id" => $row->getRegionEduAdminId(), 
//                                  "name" => $row->getName(),
//                                  "edu_admins"=>$edu_admin             
//                                  );
//        }

?>