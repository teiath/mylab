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
 * @param type $municipality_id
 * @param type $name
 * @param type $transfer_area
 * @param type $prefecture
 * @param type $pagesize
 * @param int $page
 * @param type $searchtype
 * @param type $ordertype
 * @param type $orderby
 * @return string
 * @throws Exception
 */

function GetMunicipalities( $municipality_id, $name, $transfer_area, $prefecture,
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
                            "m.municipalityId"      => "municipality_id",
                            "m.name"                => "name",
                            "ta.transferAreaId"     => "transfer_area_id",
                            "ta.name"               => "transfer_area_name" ,
                            "p.prefectureId"        => "prefecture_id",
                            "p.name"                => "prefecture_name"
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "municipality_id";
        else
        {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        } 
        
//$municipality_id=================================================================
        if (Validator::Exists('municipality_id', $params)){
            CRUDUtils::setFilter($qb, $municipality_id, "m", "municipalityId", "municipalityId", "id", ExceptionMessages::InvalidMunicipalityIDType, ExceptionCodes::InvalidMunicipalityIDType);
        } 

//$name=========================================================================
        if (Validator::Exists('name', $params)){
            CRUDUtils::setSearchFilter($qb, $name, "m", "name", $searchtype, ExceptionMessages::InvalidMunicipalityNameType, ExceptionCodes::InvalidMunicipalityNameType);    
        }

//$transfer_area===============================================================
        if (Validator::Exists('transfer_area', $params)){
            CRUDUtils::setFilter($qb, $transfer_area, "ta", "transferAreaId", "name", "id,value", ExceptionMessages::InvalidTransferAreaType, ExceptionCodes::InvalidTransferAreaType);
        } 
        
//$prefecture=============================================================
        if (Validator::Exists('prefecture', $params)){
            CRUDUtils::setFilter($qb, $prefecture, "p", "prefectureId", "name", "id,value", ExceptionMessages::InvalidPrefectureType, ExceptionCodes::InvalidPrefectureType);
        }    
        
//execution=====================================================================
        $qb->select('m');
        $qb->from('Municipalities', 'm');
        $qb->leftjoin('m.transferArea', 'ta');
        $qb->leftjoin('m.prefecture', 'p');
        $qb->orderBy(array_search($orderby, $columns), $ordertype);

//pagination and results========================================================      
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        $results->getQuery()->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $results->getQuery()->setMaxResults($pagesize) : null;

//data results==================================================================       
        $count = 0;
        foreach ($results as $municipality)
        {

            $result["data"][] = array(
                                            "municipality_id"       => $municipality->getMunicipalityId(),
                                            "name"                  => $municipality->getName(),
                                            "transfer_area_id"      => Validator::IsNull($municipality->getTransferArea()) ? Validator::ToNull() : $municipality->getTransferArea()->getTransferAreaId(),                              
                                            "transfer_area_name"    => Validator::IsNull($municipality->getTransferArea()) ? Validator::ToNull() : $municipality->getTransferArea()->getName(),
                                            "prefecture_id"         => Validator::IsNull($municipality->getPrefecture()) ? Validator::ToNull() : $municipality->getPrefecture()->getPrefectureId(),
                                            "prefecture_name"       => Validator::IsNull($municipality->getPrefecture()) ? Validator::ToNull() : $municipality->getPrefecture()->getName()
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
              
//            $result["data"][] = array("municipality_id" => $row->getMunicipalityId(), 
//                                      "name" => $row->getName(),
//                                      "prefecture_id" => $oPrefecture->getPrefectureId(),
//                                      "prefecture" => $oPrefecture->getName(),
//                                      "transfer_area_id" => $oTransferarea->getTransferAreaId(),
//                                      "transfer_area" => $oTransferarea->getName(),
//                                      "edu_admin_id" => $oEduAdmin->getEduAdminId(),
//                                      "edu_admin" => $oEduAdmin->getName(),
//                                      "region_edu_admin_id" => $oRegionEduAdmin->getRegionEduAdminId(),
//                                      "region_edu_admin" => $oRegionEduAdmin->getName()
//                        );
//        }

?>