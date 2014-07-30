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
 * @param type $lab_transition_id
 * @param type $transition_date
 * @param type $transition_source
 * @param type $lab_id
 * @param type $lab_name
 * @param type $from_state
 * @param type $to_state
 * @param type $pagesize
 * @param int $page
 * @param type $searchtype
 * @param type $ordertype
 * @param type $orderby
 * @return string
 * @throws Exception
 */
 
function GetLabTransitions( $lab_transition_id, $transition_date, $transition_source, 
                            $from_state, $to_state, $lab_id, $lab_name,
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
                            "lt.labTransitionId" => "lab_transition_id",
                            "lt.transitionDate" => "transition_date",
                            "lt.transitionSource" => "transition_source",
                            "fs.stateId" => "from_state_id",
                            "fs.name" => "from_state_id",
                            "ts.stateId" => "from_state_id",
                            "ts.name" => "from_state_id",
                            "l.labId" => "lab_id",
                            "l.name" => "lab_name"
                        );
       
       if ( Validator::Missing('orderby', $params) )
            $orderby = "lab_id";
       else
       {   
            $orderby = Validator::ToLower($orderby);
            if (!in_array($orderby, $columns))
                throw new Exception(ExceptionMessages::InvalidOrderBy." : ".$orderby, ExceptionCodes::InvalidOrderBy);
       }  
    
//$lab_transition_id============================================================
    if (Validator::Exists('lab_transition_id', $params)){
        CRUDUtils::setFilter($qb, $lab_transition_id, "lt", "labTransitionId", "labTransitionId", "id", ExceptionMessages::InvalidLabTransitionIDType, ExceptionCodes::InvalidLabTransitionSourceType);
    } 
      
//$transition_date==============================================================
    if (Validator::Exists('transition_date', $params)){
        CRUDUtils::setFilter($qb, $transition_date, "lt", "transitionDate", "transitionDate", "date", ExceptionMessages::InvalidLabTransitionDateType, ExceptionCodes::InvalidLabTransitionSourceType);
    }   
         
//$transition_source============================================================
    if (Validator::Exists('transition_source', $params)){
        CRUDUtils::setFilter($qb, $transition_source, "lt", "transitionSource", "name", "value", ExceptionMessages::InvalidLabTransitionSourceType, ExceptionCodes::InvalidLabTransitionSourceType);
    } 
 
//$from_state===================================================================
    if (Validator::Exists('from_state', $params)){
        CRUDUtils::setFilter($qb, $from_state, "fs", "stateId", "name", "null,id,value", ExceptionMessages::InvalidStateType, ExceptionCodes::InvalidStateType);
    } 
    
//$to_state=====================================================================
    if (Validator::Exists('to_state', $params)){
        CRUDUtils::setFilter($qb, $to_state, "ts", "stateId", "name", "id,value", ExceptionMessages::InvalidStateType, ExceptionCodes::InvalidStateType); 
    }
    
//$lab_id=======================================================================
    if (Validator::Exists('lab_id', $params)){
        CRUDUtils::setFilter($qb, $lab_id, "l", "labId", "labId", "id", ExceptionMessages::InvalidLabIDType, ExceptionCodes::InvalidLabIDType);
    } 
    
//$lab_name=====================================================================
    if (Validator::Exists('lab_name', $params)){
        CRUDUtils::setSearchFilter($qb, $lab_name, "l", "name", $searchtype, ExceptionMessages::InvalidLabNameType, ExceptionCodes::InvalidLabNameType);   
    }
 
 //execution====================================================================

        $qb->select('lt');
        $qb->from('LabTransitions', 'lt');
        $qb->leftjoin('lt.fromState', 'fs');
        $qb->leftjoin('lt.toState', 'ts');
        $qb->leftjoin('lt.lab', 'l');
        $qb->orderBy(array_search($orderby, $columns), $ordertype);
 
        if ($permit_labs !== 'ALLRESULTS'){
            $qb->andWhere($qb->expr()->in('l.labId', ':ids'))
                ->setParameter('ids', $permit_labs);
        }
  
//pagination and results========================================================     
        $results = new Doctrine\ORM\Tools\Pagination\Paginator($qb->getQuery());
        $result["total"] = count($results);
        $results->getQuery()->setFirstResult($pagesize * ($page-1));
        $pagesize!==Parameters::AllPageSize ? $results->getQuery()->setMaxResults($pagesize) : null;

//data results==================================================================       
        $count = 0;
        foreach ($results as $labtransition)
        {

            $result["data"][] = array(              
                                        "lab_transition_id"  => $labtransition->getLabTransitionId(),
                                        "transition_date"    => $labtransition->getTransitionDate()->format('Y-m-d'),
                                        "transition_source"  => $labtransition->getTransitionSource(),
                                        "from_state_id"      => Validator::IsNull($labtransition->getFromState()) ? Validator::ToNull() : $labtransition->getFromState()->getStateId(),
                                        "from_state_name"    => Validator::IsNull($labtransition->getFromState()) ? Validator::ToNull() : $labtransition->getFromState()->getName(),
                                        "to_state_id"        => $labtransition->getToState()->getStateId(),
                                        "to_state_name"      => $labtransition->getToState()->getName(),
                                        "lab_id"             => $labtransition->getLab()->getLabId(),
                                        "lab_name"           => $labtransition->getLab()->getName()

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