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
 * @param type $school_unit_id
 * @param type $name
 * @param type $special_name
 * @param type $last_update
 * @param type $fax_number
 * @param type $phone_number
 * @param type $email
 * @param type $street_address
 * @param type $postal_code
 * @param type $unit_dns
 * @param type $region_edu_admin
 * @param type $edu_admin
 * @param type $transfer_area
 * @param type $municipality
 * @param type $prefecture
 * @param type $education_level
 * @param type $school_unit_type
 * @param type $state
 * @param type $pagesize
 * @param int $page
 * @param type $searchtype
 * @param type $ordertype
 * @param type $orderby
 * @return string
 * @throws Exception
 */

function GetSchoolUnits( $school_unit_id, $name, $special_name, $last_update, $fax_number, $phone_number, $email, $street_address, $postal_code, $unit_dns,
                         $region_edu_admin, $edu_admin, $transfer_area, $municipality, $prefecture, $education_level, $school_unit_type, $state,
                         $school_unit,
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
//    $permissions = UserRoles::getUserPermissions($app->request->user);
//
//    if (Validator::IsNull($permissions['permit_labs'])){
//        throw new Exception(ExceptionMessages::NoPermissionsError, ExceptionCodes::NoPermissionsError);     
//    }else { 
//        $permit_labs = $permissions['permit_labs'];
//    }
    
//$page - $pagesize - $searchtype - $ordertype =================================
       $page = Pagination::getPage($page, $params);
       $pagesize = Pagination::getPagesize($pagesize, $params);     
       $searchtype = Filters::getSearchType($searchtype, $params);
       $ordertype =  Filters::getOrderType($ordertype, $params);
  
//$orderby======================================================================
       $columns = array(
                            "su.schoolUnitId"       => "school_unit_id",
                            "su.name"               => "name",
                            "su.specialName"        => "special_name",
                            "su.lastUpdate"         => "last_update",
                            "su.postalCode"         => "postal_code",
                            "su.unitDns"            => "unit_dns",
                            "rea.regionEduAdminId"  => "region_edu_admin_id",
                            "rea.name"              => "region_edu_admin_name",
                            "ea.eduAdminId"         => "edu_admin_id",
                            "ea.name"               => "edu_admin_name",
                            "ta.transferAreaId"     => "transfer_area_id",
                            "ta.name"               => "transfer_area_name",
                            "m.municipalityId"      => "municipality_id",
                            "m.name"                => "municipality_name",
                            "p.prefectureId"        => "prefecture_id",
                            "p.name"                => "prefecture_name",
                            "el.educationLevelId"   => "education_level_id",
                            "el.name"               => "education_level_name",
                            "sut.schoolUnitTypeId"  => "school_unit_type_id",
                            "sut.name"              => "school_unit_type_name",
                            "s.stateId"             => "state_id",
                            "s.name"                => "state_name"
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "school_unit_id";
        else
        {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
        } 
    
//$school_unit_id===============================================================
        if (Validator::Exists('school_unit_id', $params)){
            CRUDUtils::setFilter($qb, $school_unit_id, "su", "schoolUnitId", "schoolUnitId", "id", ExceptionMessages::InvalidSchoolUnitIDType, ExceptionCodes::InvalidSchoolUnitIDType);
        } 

//$name=========================================================================
        if (Validator::Exists('name', $params)){
            CRUDUtils::setSearchFilter($qb, $name, "su", "name", $searchtype, ExceptionMessages::InvalidSchoolUnitNameType, ExceptionCodes::InvalidSchoolUnitNameType);    
        } 
        
//$special_name=================================================================
        if (Validator::Exists('special_name', $params)){
            CRUDUtils::setSearchFilter($qb, $special_name, "su", "special_name", $searchtype, ExceptionMessages::InvalidSchoolUnitSpecialNameType, ExceptionCodes::InvalidSchoolUnitSpecialNameType);    
        } 
        
//$last_update==================================================================
        if (Validator::Exists('last_update', $params)){
            CRUDUtils::setFilter($qb, $last_update, "su", "lastUpdate", "lastUpdate", "date", ExceptionMessages::InvalidSchoolUnitLastUpdateType, ExceptionCodes::InvalidSchoolUnitLastUpdateType);
        }  
        
//$fax_number===================================================================
        if (Validator::Exists('fax_number', $params)){
            CRUDUtils::setSearchFilter($qb, $fax_number, "su", "fax_number", $searchtype, ExceptionMessages::InvalidSchoolUnitFaxNumberType, ExceptionCodes::InvalidSchoolUnitFaxNumberType);    
        } 
        
//$phone_number=================================================================
        if (Validator::Exists('phone_number', $params)){
            CRUDUtils::setSearchFilter($qb, $phone_number, "su", "phone_number", $searchtype, ExceptionMessages::InvalidSchoolUnitPhoneNumberType, ExceptionCodes::InvalidSchoolUnitPhoneNumberType);    
        } 
        
//$email========================================================================
        if (Validator::Exists('email', $params)){
            CRUDUtils::setFilter($qb, $email, "su", "email", "email", "null,value", ExceptionMessages::InvalidSchoolUnitEmailType, ExceptionCodes::InvalidSchoolUnitEmailType);
        } 
        
//$street_address===============================================================
        if (Validator::Exists('street_address', $params)){
            CRUDUtils::setSearchFilter($qb, $street_address, "su", "street_address", $searchtype, ExceptionMessages::InvalidSchoolUnitStreetAddressType, ExceptionCodes::InvalidSchoolUnitStreetAddressType);    
        } 
        
//$postal_code==================================================================
        if (Validator::Exists('postal_code', $params)){
            CRUDUtils::setSearchFilter($qb, $postal_code, "su", "postal_code", $searchtype, ExceptionMessages::InvalidSchoolUnitPostalCodeType, ExceptionCodes::InvalidSchoolUnitPostalCodeType);    
        }
        
//$unit_dns=====================================================================
        if (Validator::Exists('unit_dns', $params)){
            CRUDUtils::setFilter($qb, $unit_dns, "su", "unitDns", "unitDns", "null,value", ExceptionMessages::InvalidSchoolUnitUnitDns, ExceptionCodes::InvalidSchoolUnitUnitDns);
        } 
               
//$region_edu_admin=============================================================
        if (Validator::Exists('region_edu_admin', $params)){
            CRUDUtils::setFilter($qb, $region_edu_admin, "rea", "regionEduAdminId", "name", "null,id,value", ExceptionMessages::InvalidRegionEduAdminType, ExceptionCodes::InvalidRegionEduAdminType);
        }
        
//$edu_admin====================================================================
        if (Validator::Exists('edu_admin', $params)){
            CRUDUtils::setFilter($qb, $edu_admin, "ea", "eduAdminId", "name", "null,id,value", ExceptionMessages::InvalidEduAdminType, ExceptionCodes::InvalidEduAdminType);
        }
        
//$transfer_area================================================================
        if (Validator::Exists('transfer_area', $params)){
            CRUDUtils::setFilter($qb, $transfer_area, "ta", "transferAreaId", "name", "null,id,value", ExceptionMessages::InvalidTransferAreaType, ExceptionCodes::InvalidTransferAreaType);
        }
        
//$municipality=================================================================
        if (Validator::Exists('municipality', $params)){
            CRUDUtils::setFilter($qb, $municipality, "m", "municipalityId", "name", "null,id,value", ExceptionMessages::InvalidMunicipalityType, ExceptionCodes::InvalidMunicipalityType);
        }
        
//$prefecture===================================================================
        if (Validator::Exists('prefecture', $params)){
            CRUDUtils::setFilter($qb, $prefecture, "p", "prefectureId", "name", "null,id,value", ExceptionMessages::InvalidPrefectureType, ExceptionCodes::InvalidPrefectureType);
        }
        
//$education_level==============================================================
        if (Validator::Exists('education_level', $params)){
            CRUDUtils::setFilter($qb, $education_level, "el", "educationLevelId", "name", "null,id,value", ExceptionMessages::InvalidEducationLevelType, ExceptionCodes::InvalidEducationLevelType);
        }
        
//$school_unit_type=============================================================
        if (Validator::Exists('school_unit_type', $params)){
            CRUDUtils::setFilter($qb, $school_unit_type, "sut", "schoolUnitTypeId", "name", "null,id,value", ExceptionMessages::InvalidSchoolUnitTypeType, ExceptionCodes::InvalidSchoolUnitTypeType);
        }

//$state========================================================================
        if (Validator::Exists('state', $params)){
            CRUDUtils::setFilter($qb, $state, "s", "stateId", "name", "null,id,value", ExceptionMessages::InvalidStateType, ExceptionCodes::InvalidStateType);
        } 

//balander parameter============================================================        
if (Validator::Exists('school_unit', $params)){

    if (Validator::IsID($school_unit))
        CRUDUtils::setFilter($qb, $school_unit, "su", "schoolUnitId", "schoolUnitId", "startWith", ExceptionMessages::InvalidSchoolUnitIDType, ExceptionCodes::InvalidSchoolUnitIDType);
    else
        CRUDUtils::setSearchFilter($qb, $school_unit, "su", "name", $searchtype, ExceptionMessages::InvalidSchoolUnitNameType, ExceptionCodes::InvalidSchoolUnitNameType);    
} 

 //execution====================================================================
        $qb->select('su');
        $qb->from('SchoolUnits', 'su');
        $qb->leftjoin('su.regionEduAdmin', 'rea');
        $qb->leftjoin('su.eduAdmin', 'ea');
        $qb->leftjoin('su.transferArea', 'ta');
        $qb->leftjoin('su.municipality', 'm');
        $qb->leftjoin('su.prefecture', 'p');
        $qb->leftjoin('su.educationLevel', 'el');
        $qb->leftjoin('su.schoolUnitType', 'sut');
        $qb->leftjoin('su.state', 's');
        $qb->orderBy(array_search($orderby, $columns), $ordertype);

//        if ($permit_labs !== 'ALLRESULTS'){
//            $qb->andWhere($qb->expr()->in('l.labId', ':ids'))
//                ->setParameter('ids', $permit_labs);
//        }
        
//pagination and results========================================================      
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        $results->getQuery()->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $results->getQuery()->setMaxResults($pagesize) : null;

//data results==================================================================       
        $count = 0;
        foreach ($results as $schoolunit)
        {

            $result["data"][] = array(
                                        "school_unit_id"            => $schoolunit->getSchoolUnitId(),
                                        "name"                      => $schoolunit->getName(),
                                        "special_name"              => $schoolunit->getSpecialName(),
                                        "last_update"               => $schoolunit->getLastUpdate(),
                                        "fax_number"                => $schoolunit->getFaxNumber(),
                                        "phone_number"              => $schoolunit->getPhoneNumber(),
                                        "email"                     => $schoolunit->getEmail(),
                                        "street_address"            => $schoolunit->getStreetAddress(),
                                        "postal_code"               => $schoolunit->getPostalCode(),
                                        "unit_dns"                  => $schoolunit->getUnitDns(),
                                        "region_edu_admin_id"       => Validator::IsNull($schoolunit->getRegionEduAdmin()) ? Validator::ToNull() : $schoolunit->getRegionEduAdmin()->getRegionEduAdminId(),
                                        "region_edu_admin_name"     => Validator::IsNull($schoolunit->getRegionEduAdmin()) ? Validator::ToNull() : $schoolunit->getRegionEduAdmin()->getRegionEduAdminId(),
                                        "edu_admin_id"              => Validator::IsNull($schoolunit->getEduAdmin()) ? Validator::ToNull() : $schoolunit->getEduAdmin()->getEduAdminId(),
                                        "edu_admin_name"            => Validator::IsNull($schoolunit->getEduAdmin()) ? Validator::ToNull() : $schoolunit->getEduAdmin()->getName(),
                                        "transfer_area_id"          => Validator::IsNull($schoolunit->getTransferArea()) ? Validator::ToNull() : $schoolunit->getTransferArea()->getTransferAreaId(),
                                        "transfer_area_name"        => Validator::IsNull($schoolunit->getTransferArea()) ? Validator::ToNull() : $schoolunit->getTransferArea()->getName(),
                                        "municipality_id"           => Validator::IsNull($schoolunit->getMunicipality()) ? Validator::ToNull() : $schoolunit->getMunicipality()->getMunicipalityId(),
                                        "municipality_name"         => Validator::IsNull($schoolunit->getMunicipality()) ? Validator::ToNull() : $schoolunit->getMunicipality()->getName(),
                                        "prefecture_id"             => Validator::IsNull($schoolunit->getPrefecture()) ? Validator::ToNull() : $schoolunit->getPrefecture()->getPrefectureId(),
                                        "prefecture_name"           => Validator::IsNull($schoolunit->getPrefecture()) ? Validator::ToNull() : $schoolunit->getPrefecture()->getName(),
                                        "education_level_id"        => Validator::IsNull($schoolunit->getEducationLevel()) ? Validator::ToNull() : $schoolunit->getEducationLevel()->getEducationLevelId(),
                                        "education_level_name"      => Validator::IsNull($schoolunit->getEducationLevel()) ? Validator::ToNull() : $schoolunit->getEducationLevel()->getName(),
                                        "school_unit_type_id"       => Validator::IsNull($schoolunit->getSchoolUnitType()) ? Validator::ToNull() : $schoolunit->getSchoolUnitType()->getSchoolUnitTypeId(),
                                        "school_unit_type_name"     => Validator::IsNull($schoolunit->getSchoolUnitType()) ? Validator::ToNull() : $schoolunit->getSchoolUnitType()->getName(),
                                        "state_id"                  => Validator::IsNull($schoolunit->getState()) ? Validator::ToNull() : $schoolunit->getState()->getStateId(),
                                        "state_name"                => Validator::IsNull($schoolunit->getState()) ? Validator::ToNull() : $schoolunit->getState()->getName()
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