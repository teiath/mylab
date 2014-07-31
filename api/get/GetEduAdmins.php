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
 * @param type $edu_admin_id
 * @param type $name
 * @param type $edu_admin_code
 * @param type $region_edu_admin
 * @param type $pagesize
 * @param type $page
 * @param type $searchtype
 * @param type $ordertype
 * @param type $orderby
 * @return type
 * @throws Exception
 */

function GetEduAdmins($edu_admin_id, $name, $edu_admin_code, $region_edu_admin,
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
                            "ea.eduAdminId"         => "edu_admin_id",
                            "ea.name"               => "name",
                            "ea.eduAdminCode"       => "edu_admin_code",
                            "rea.regionEduAdminId"  => "region_edu_admin_id" ,
                            "rea.name"              => "region_edu_admin_name"
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "edu_admin_id";
        else
        {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        } 
        
//$edu_admin_id=================================================================
        if (Validator::Exists('edu_admin_id', $params)){
            CRUDUtils::setFilter($qb, $edu_admin_id, "ea", "eduAdminId", "eduAdminId", "id", ExceptionMessages::InvalidEduAdminIDType, ExceptionCodes::InvalidCircuitIDType);
        } 

//$name=========================================================================
        if (Validator::Exists('name', $params)){
            CRUDUtils::setSearchFilter($qb, $name, "ea", "name", $searchtype, ExceptionMessages::InvalidEduAdminNameType, ExceptionCodes::InvalidEduAdminNameType);    
        }

//$edu_admin_code===============================================================
        if (Validator::Exists('edu_admin_code', $params)){
            CRUDUtils::setFilter($qb, $edu_admin_code, "ea", "eduAdminCode", "eduAdminCode", "value", ExceptionMessages::InvalidEduAdminCodeType, ExceptionCodes::InvalidCircuitUpdatedDateType);
        } 
        
//$region_edu_admin=============================================================
        if (Validator::Exists('region_edu_admin', $params)){
            CRUDUtils::setFilter($qb, $region_edu_admin, "rea", "regionEduAdminId", "name", "id,value", ExceptionMessages::InvalidRegionEduAdminType, ExceptionCodes::InvalidCircuitStatusType);
        }    
        
//execution=====================================================================
        $qb->select('ea');
        $qb->from('EduAdmins', 'ea');
        $qb->leftjoin('ea.regionEduAdmin', 'rea');
        $qb->orderBy(array_search($orderby, $columns), $ordertype);

//pagination and results========================================================      
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        $results->getQuery()->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $results->getQuery()->setMaxResults($pagesize) : null;

//data results==================================================================       
        $count = 0;
        foreach ($results as $eduadmin)
        {

            $result["data"][] = array(
                                            "edu_admin_id"           => $eduadmin->getEduAdminId(),
                                            "name"                   => $eduadmin->getName(),
                                            "edu_admin_code"         => $eduadmin->getEduAdminCode(),                              
                                            "region_edu_admin_id"    => $eduadmin->getRegionEduAdmin()->getRegionEduAdminId(),
                                            "region_edu_admin_name"  => $eduadmin->getRegionEduAdmin()->getName()
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


   
        

                    
//        foreach ($countRows as $row) {
//  
//        //retrieve transfer_area
//        $transfer_area["transfer_area_info"] = array();   
//        $filter = array( new DFC(TransferAreasExt::FIELD_EDU_ADMIN_ID,$row->getEduAdminId(), DFC::EXACT));
//        $sort = array( new DSC(TransferAreasExt::FIELD_EDU_ADMIN_ID, DSC::ASC) );
//        $arrayTransferAreas = $oTransferAreas->findByFilter($db, $filter, true, $sort);  
//            
//            foreach ($arrayTransferAreas as $arrayTransferArea){
//             
//                //retrieve municipality
//                $municipality["municipality_info"] = array();   
//                $filter = array( new DFC(MunicipalitiesExt::FIELD_TRANSFER_AREA_ID,$arrayTransferArea->getTransferAreaId(), DFC::EXACT));
//                $sort = array( new DSC(MunicipalitiesExt::FIELD_TRANSFER_AREA_ID, DSC::ASC) );
//                $arrayMunicipalities = $oMunicipalities->findByFilter($db, $filter, true, $sort);
//
//                    foreach ($arrayMunicipalities as $arrayMunicipality){ 
//                        
//                        $municipality["municipality_info"][] = array("municipality_id" => $arrayMunicipality->getMunicipalityId(),
//                                                                     "name" => $arrayMunicipality->getName()  
//                                                                   );
//                    }
//
//                $transfer_area["transfer_area_info"][] = array("transfer_area_id" => $arrayTransferArea->getTransferAreaId(),
//                                                                "name" => $arrayTransferArea->getName(),
//                                                                "municipalities"=>$municipality
//                                                               );  
//             }            
//            
//        $result["data"][] = array("edu_admin_id" => $row->getEduAdminId(), 
//                                  "name" => $row->getName(),
//                                  "region_edu_admin_id" => $oRegionEduAdmins->searchArrayForID( $row->getRegionEduAdminId() )->getRegionEduAdminId(),
//                                  "region_edu_admin" => $oRegionEduAdmins->searchArrayForID( $row->getRegionEduAdminId() )->getName(),
//                                  "transfer_areas"=>$transfer_area
//                            );
//        }

?> 