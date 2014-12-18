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
 * @param type $lab_id
 * @param type $name
 * @param type $special_name
 * @param type $creation_date
 * @param type $created_by
 * @param type $last_updated
 * @param type $updated_by
 * @param type $operational_rating
 * @param type $technological_rating
 * @param type $ellak
 * @param type $submitted
 * @param type $lab_type
 * @param type $school_unit
 * @param type $state
 * @param type $lab_source
 * @param type $pagesize
 * @param type $page
 * @param type $searchtype
 * @param type $ordertype
 * @param type $orderby
 * @return string
 * @throws Exception
 */
                    
function GetLabs( $lab_id, $name, $special_name, $creation_date, $created_by, $last_updated, $updated_by, $operational_rating, $technological_rating, $ellak, $submitted, 
                  $lab_type, $school_unit, $state, $lab_source, 
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
       $pagesize = Pagination::getPagesize($pagesize, $params);     
       $searchtype = Filters::getSearchType($searchtype, $params);
       $ordertype =  Filters::getOrderType($ordertype, $params);
       
//$orderby======================================================================
       $columns = array(
                            "l.labId"               => "lab_id",
                            "l.name"                => "name",
                            "l.specialName"         => "special_name",
                            "l.creationDate"        => "creation_date",     
                            "l.createdBy"           => "created_by",
                            "l.lastUpdated"         => "last_updated",
                            "l.updatedBy"           => "updated_by",
                            "l.operationalRating"   => "operational_rating",
                            "l.technologicalRating" => "technological_rating",
                            "l.ellak"               => "ellak",
                            "l.submitted"           => "submitted", 
                            "lt.labTypeId"          => "lab_type_id",
                            "lt.name"               => "lab_type_name",
                            "su.schoolUnitId"       => "school_unit_id",
                            "su.name"               => "school_unit_name",
                            "s.stateId"             => "state_id",
                            "s.name"                => "state_name",
                            "ls.labSourceId"        => "lab_source_id",
                            "ls.name"               => "lab_source_name"
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
            CRUDUtils::setFilter($qb, $lab_id, "l", "labId", "labId", "id", ExceptionMessages::InvalidLabIDType, ExceptionCodes::InvalidLabIDType);
        } 

//$name=========================================================================
        if (Validator::Exists('name', $params)){
            CRUDUtils::setSearchFilter($qb, $name, "l", "name", $searchtype, ExceptionMessages::InvalidLabNameType, ExceptionCodes::InvalidLabNameType);    
        } 
        
//$special_name=================================================================
        if (Validator::Exists('special_name', $params)){
            CRUDUtils::setSearchFilter($qb, $special_name, "l", "specialName", $searchtype, ExceptionMessages::InvalidLabSpecialNameType, ExceptionCodes::InvalidLabSpecialNameType);    
        } 

//$creation_date================================================================
        if (Validator::Exists('creation_date', $params)){
            CRUDUtils::setFilter($qb, $creation_date, "l", "creationDate", "creationDate", "date", ExceptionMessages::InvalidLabCreationDateType, ExceptionCodes::InvalidLabCreationDateType);
        } 
      
//$created_by===================================================================
        if (Validator::Exists('created_by', $params)){
            CRUDUtils::setSearchFilter($qb, $created_by, "l", "createdBy", $searchtype, ExceptionMessages::InvalidLabCreatedByType, ExceptionCodes::InvalidLabCreatedByType);    
        } 
        
//$last_updated=================================================================
        if (Validator::Exists('last_updated', $params)){
            CRUDUtils::setFilter($qb, $last_updated, "l", "lastUpdated", "lastUpdated", "date", ExceptionMessages::InvalidlabLastUpdatedType, ExceptionCodes::InvalidlabLastUpdatedType);
        }  

//$updated_by===================================================================
        if (Validator::Exists('updated_by', $params)){
            CRUDUtils::setSearchFilter($qb, $updated_by, "l", "updatedBy", $searchtype, ExceptionMessages::InvalidLabUpdatedByType, ExceptionCodes::InvalidLabUpdatedByType);    
        } 

//$operational_rating===========================================================
        if (Validator::Exists('operational_rating', $params)){
            CRUDUtils::setFilter($qb, $operational_rating, "l", "operationalRating", "operationalRating", "numeric", ExceptionMessages::InvalidLabTechnologicalRatingType, ExceptionCodes::InvalidLabTechnologicalRatingType);
        }  
        
//$technological_rating=========================================================
        if (Validator::Exists('technological_rating', $params)){
            CRUDUtils::setFilter($qb, $technological_rating, "l", "technologicalRating", "technologicalRating", "numeric", ExceptionMessages::InvalidLabOperationalRatingType, ExceptionCodes::InvalidLabOperationalRatingType);
        }  
        
//$ellak========================================================================
        if (Validator::Exists('ellak', $params)){
            CRUDUtils::setFilter($qb, $ellak, "l", "ellak", "ellak", "boolean", ExceptionMessages::InvalidLabEllakType, ExceptionCodes::InvalidLabEllakType);
        }  
        
//$submitted====================================================================
        if (Validator::Exists('submitted', $params)){
            CRUDUtils::setFilter($qb, $submitted, "l", "submitted", "submitted", "boolean", ExceptionMessages::InvalidLabSubmittedType, ExceptionCodes::InvalidLabSubmittedType);
        }  
        
//$lab_type=====================================================================
        if (Validator::Exists('lab_type', $params)){
            CRUDUtils::setFilter($qb, $lab_type, "lt", "labTypeId", "name", "null,id,value", ExceptionMessages::InvalidLabTypeType, ExceptionCodes::InvalidLabTypeType);
        } 
        
//$school_unit========================================================================
if (Validator::Exists('school_unit', $params)){
    CRUDUtils::setFilter($qb, $school_unit, "su", "schoolUnitId", "name", "null,id,value", ExceptionMessages::InvalidSchoolUnitTypeType, ExceptionCodes::InvalidSchoolUnitTypeType);
} 
        
//$state========================================================================
        if (Validator::Exists('state', $params)){
            CRUDUtils::setFilter($qb, $state, "s", "stateId", "name", "null,id,value", ExceptionMessages::InvalidStateType, ExceptionCodes::InvalidStateType);
        } 

//$lab_source========================================================================
if (Validator::Exists('lab_source', $params)){
    CRUDUtils::setFilter($qb, $lab_source, "ls", "labSourceId", "name", "null,id,value", ExceptionMessages::InvalidLabSourceType, ExceptionCodes::InvalidLabSourceType);
} 
 
 //execution====================================================================
        $qb->select('l');
        $qb->from('Labs', 'l');
        $qb->leftjoin('l.labType', 'lt');
        $qb->leftjoin('l.schoolUnit', 'su');
        $qb->leftjoin('l.state', 's');
        $qb->leftjoin('l.labSource', 'ls');
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
        foreach ($results as $lab)
        {

            $result["data"][] = array(
                                        "lab_id"                => $lab->getLabId(),
                                        "name"                  => $lab->getName(),
                                        "special_name"          => $lab->getSpecialName(),
                                        "creation_date"         => $lab->getCreationDate(),
                                        "created_by"            => $lab->getCreatedBy(),
                                        "last_updated"          => $lab->getLastUpdated(),
                                        "updated_by"            => $lab->getUpdatedBy(),
                                        "operational_rating"    => $lab->getOperationalRating(),
                                        "technological_rating"  => $lab->getTechnologicalRating(),
                                        "ellak"                 => $lab->getEllak(),
                                        "submitted"             => $lab->getSubmitted(),                                     
                                        "lab_type_id"           => Validator::IsNull($lab->getLabType()) ? Validator::ToNull() : $lab->getLabType()->getLabTypeId(),
                                        "lab_type_name"         => Validator::IsNull($lab->getLabType()) ? Validator::ToNull() : $lab->getLabType()->getName(),
                                        "school_unit_id"        => Validator::IsNull($lab->getSchoolUnit()) ? Validator::ToNull() : $lab->getSchoolUnit()->getSchoolUnitId(),
                                        "school_unit_name"      => Validator::IsNull($lab->getSchoolUnit()) ? Validator::ToNull() : $lab->getSchoolUnit()->getName(),
                                        "state_id"              => Validator::IsNull($lab->getState()) ? Validator::ToNull() : $lab->getState()->getStateId(),
                                        "state_name"            => Validator::IsNull($lab->getState()) ? Validator::ToNull() : $lab->getState()->getName(),
                                        "lab_source_id"         => Validator::IsNull($lab->getLabSource()) ? Validator::ToNull() : $lab->getLabSource()->getLabSourceId(),
                                        "lab_source_name"       => Validator::IsNull($lab->getLabSource()) ? Validator::ToNull() : $lab->getLabSource()->getName()
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