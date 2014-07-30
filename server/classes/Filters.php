<?php

class Filters {
   
    /**
     * Get infos about school_unit of conjunction between the unit_dns and the edu_admin_code params 
     * also include default param state active school_unit
     *
     * Will return 
     * Array
     *       (
     *         [0] => Array
     *                     (
     *                      [school_unit_id] => "value"
     *                      [unit_dns] => "value"
     *                      [edu_admin_code] => "value"
     *                    )
     *       )
     *
     * @param string $unit_dns the unit_dns of a school_unit
     * @param string $edu_admin_code the edu_admin_code of a school_unit
     * @param int $state_id the state of a school unit default is active school_unit
     * @return array
     */    
    public static function getFullSchoolUnitDns($unit_dns, $edu_admin_code, $state_id){
        global $db;
        
        $state_id = 1 ; //active school unit
        $sql = "SELECT school_units.school_unit_id,school_units.unit_dns,edu_admins.edu_admin_code 
                FROM school_units 
                LEFT JOIN edu_admins ON school_units.edu_admin_id = edu_admins.edu_admin_id
                WHERE school_units.unit_dns = '".$unit_dns."'
                AND edu_admins.edu_admin_code = '".$edu_admin_code."'
                AND school_units.state_id='".$state_id."'";

        $stmt = $db->query( $sql );
        $full_unit_dns = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
        return $full_unit_dns;
    }
    
    /**
     * Get all labs with the school_unit_id parameter
     * 
     * Will return
     * Array
     *      (
     *       [0] => "value"
     *       [1] => "value"
     *      )
     * 
     * @param int $school_unit_id the school_unit
     * @return array
     */  
    public static function getLabsfromSchoolUnit($school_unit_id){
      global $db;
      
      $sql = "SELECT lab_id 
              FROM labs 
              WHERE school_unit_id='".$school_unit_id."'";
      $stmt = $db->query( $sql );
      $lab_id = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
     
      return $lab_id;
    }
       
    /**
     * Get all labs with the worker registry_no parameter 
     * and default parameters : worker_status is active and worker_position is lab responsible.
     * 
     * Will return
     * Array
     *      (
     *       [0] => "value"
     *       [1] => "value"
     *      )
     * 
     * @param int $registry_no the worker registry_no
     * @return array
     */  
     public static function getLabsfromRegistryNo($registry_no){
        global $db;
      
        $sql = "SELECT lab_workers.lab_id
                FROM lab_workers
                LEFT JOIN workers ON workers.worker_id = lab_workers.worker_id 
                WHERE  lab_workers.worker_position_id = 2
                AND lab_workers.worker_status = 1
                AND workers.registry_no='".$registry_no."'";
        $stmt = $db->query( $sql );
        $lab_id = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

        return $lab_id; 
     }
     
    /**
     * Get all school_units with the worker registry_no parameter 
     * and default parameters : worker_status is active and worker_position is lab responsible.
     * 
     * Will return
     * Array
     *      (
     *       [0] => "value"
     *       [1] => "value"
     *      )
     * 
     * @param int $registry_no the worker registry_no
     * @return array
     */  
     public static function getSchoolUnitsfromRegistryNo($registry_no){
        global $db;
      
        $sql = "SELECT DISTINCT school_units.school_unit_id 
                FROM school_units
                LEFT JOIN labs ON school_units.school_unit_id = labs.school_unit_id
                LEFT JOIN lab_workers ON labs.lab_id = lab_workers.lab_id 
                LEFT JOIN workers ON lab_workers.worker_id = workers.worker_id 
                WHERE  lab_workers.worker_position_id = 2
                AND lab_workers.worker_status = 1
                AND workers.registry_no='".$registry_no."'";
        $stmt = $db->query( $sql );
        $lab_id = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

        return $lab_id; 
     }
     
     
     
    /**
     * Get all labs with the worker edu_admin_code parameter 
     * 
     * Will return
     * Array
     *      (
     *       [0] => "value"
     *       [1] => "value"
     *      )
     * 
     * @param int $edu_admin_code the worker edu_admin_code
     * @return array
     */  
     public static function getLabsfromEduAdminCode($edu_admin_code){
        global $db;
      
        $sql = "SELECT labs.lab_id
                FROM labs
                LEFT JOIN school_units ON school_units.school_unit_id = labs.school_unit_id
                LEFT JOIN edu_admins ON edu_admins.edu_admin_id = school_units.edu_admin_id
                WHERE edu_admins.edu_admin_code='".$edu_admin_code."'";
        $stmt = $db->query( $sql );
        $lab_id = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

        return $lab_id; 
     }
     
    /**
     * Get all school_units with the worker edu_admin_code parameter 
     * 
     * Will return
     * Array
     *      (
     *       [0] => "value"
     *       [1] => "value"
     *      )
     * 
     * @param int $edu_admin_code the worker edu_admin_code
     * @return array
     */  
     public static function getSchoolUnitsfromEduAdminCode($edu_admin_code){
        global $db;
      
        $sql = "SELECT school_units.school_unit_id
                FROM school_units
                LEFT JOIN edu_admins ON edu_admins.edu_admin_id = school_units.edu_admin_id
                WHERE edu_admins.edu_admin_code='".$edu_admin_code."'";
        $stmt = $db->query( $sql );
        $school_unit_id = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

        return $school_unit_id; 
     }
     
 //==============================================================================
     
     
    public static function AllLabTypes(){
         global $db;
        
        $sql = "SELECT lab_type_id,name FROM lab_types";
        $stmt = $db->query( $sql );
        $lab_types = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($lab_types as $lab_type) {
            $lab_type_id=$lab_type['lab_type_id'];
            $lab_type_name=$lab_type['name'];         
            $sql_array[$lab_type_id]=$lab_type_name;
        }
        
        return $sql_array;
    }
    
    
     public static function AllLabsCounter($sqlFrom,$sqlWhere,$sqlPermissions){
        global $db;
        
        $sql = "SELECT lab_type_id,name FROM lab_types";
        $stmt = $db->query( $sql );
        $lab_types = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($lab_types as $lab_type) {
            $lab_type_id=$lab_type['lab_type_id'];
            $lab_type_name=$lab_type['name'];
            
            $sql_array[$lab_type_id]=$lab_type_name;
            $sql_count_if[] =' COUNT(if(tb1.lab_type_id = '.$lab_type_id.', 1, null)) AS count_lab_type_'.$lab_type_id;
        }
            $sql_count_if = implode(",", $sql_count_if);   
            
        $sql='SELECT '
       . $sql_count_if
       .' FROM ( SELECT DISTINCT labs.lab_id, labs.lab_type_id, labs.school_unit_id  '
       . $sqlFrom 
       . $sqlWhere
       . $sqlPermissions
       .' ) AS tb1';

        $stmt = $db->query( $sql );
        $lab_types_per_schools = $stmt->fetch(PDO::FETCH_ASSOC);
  
        $all_labs_counts=array();                            

        $i=1;
        foreach ($lab_types_per_schools as $lab_type_count) {
                $all_labs_counts[$sql_array[$i]] = $lab_type_count;
                $i++;     
        }
        
        return $all_labs_counts;
    }
   
    public static function LabsCounter($sqlFrom,$sqlWhere){
        global $db;
        
        $sql = "SELECT lab_type_id,name FROM lab_types";
        $stmt = $db->query( $sql );
        $lab_types = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            foreach ($lab_types as $lab_type) {
                $lab_type_id=$lab_type['lab_type_id'];
                $sql_count_if[] =' COUNT(if(tb1.lab_type_id = '.$lab_type_id.', 1, null)) AS count_lab_type_'.$lab_type_id;
            }
                $sql_count_if = implode(",", $sql_count_if);   
            
        $sql='SELECT '
       . $sql_count_if . ' ,tb1.school_unit_id '
       .' FROM ( SELECT DISTINCT labs.lab_id, labs.lab_type_id, labs.school_unit_id  '
       . $sqlFrom
       . $sqlWhere
       .' ) AS tb1 GROUP BY tb1.school_unit_id';

            $stmt = $db->query( $sql );
            $lab_types_per_schools = $stmt->fetchAll(PDO::FETCH_ASSOC);
                               
        foreach ($lab_types_per_schools as $lab_types_per_school)
        {
            $lab_types_per_school_unit[ $lab_types_per_school["school_unit_id"] ] = $lab_types_per_school;
        }
            
        return $lab_types_per_school_unit;
    }
    
    public static function LabsCounterNull () {
           
    $sql_array = self::AllLabTypes();
                   
    foreach ($sql_array as $lab_type_name) {
        $null_labs[$lab_type_name] = '0';    
    }
    return $null_labs;
    }

   
     public static function ExtBasicFilter($filter_param, $table_name, $table_column_name, $searchtype, $ex_message, $ex_code ) {
      
            global $db;    
                      
            $param = Validator::toArray($filter_param);

            $paramFilters = array();

            foreach ($param as $values)
            {
                $paramWordsFilters = array();

                if ( Validator::isNull($values) )
                    $paramWordsFilters[] = "$table_name.$table_column_name is null";
                else if ( Validator::IsValue($values) )
                {
                    if ( $searchtype == SearchEnumTypes::Exact )
                        $paramWordsFilters[] = "$table_name.$table_column_name = ". $db->quote( Validator::toValue($values) );
                    else if ( $searchtype == SearchEnumTypes::Contain )
                        $paramWordsFilters[] = "$table_name.$table_column_name like ". $db->quote( '%'.Validator::toValue($values).'%' );
                    else
                    {
                        $words = Validator::toArray($values, " ");

                        foreach ($words as $word)
                        {
                            switch ($searchtype)
                            {
                                case SearchEnumTypes::ContainAll :
                                case SearchEnumTypes::ContainAny :
                                    $paramWordsFilters[] = "$table_name.$table_column_name like ". $db->quote( '%'.Validator::toValue($word).'%' );
                                    break;
                                case SearchEnumTypes::StartWith :
                                    $paramWordsFilters[] = "$table_name.$table_column_name like ". $db->quote( Validator::toValue($word).'%' );
                                    break;
                                case SearchEnumTypes::EndWith :
                                    $paramWordsFilters[] = "$table_name.$table_column_name like ". $db->quote( '%'.Validator::toValue($word) );
                                    break;
                            }
                        }
                    }
                }
                else
                    throw new Exception($ex_message." : ".$values, $ex_code);


                switch ($searchtype)
                {
                    case SearchEnumTypes::ContainAny :
                        $paramFilters[] = "(" . implode(" OR ", $paramWordsFilters) . ")";
                        break;
                    default :
                        $paramFilters[] = "(" . implode(" AND ", $paramWordsFilters) . ")";
                        break;
                }

            }

            $filter = "(" . implode(" OR ", $paramFilters) . ")";
            
            return $filter;
    }
  
    
    public static function BasicVocabularyFilter($filter_param, $table_name, $table_column_id, $table_column_name, $ex_message, $ex_code ) {
            
            global $db;  
            $param = Validator::toArray($filter_param);

            $paramFilters = array();

            foreach ($param as $values)
            {
                if ( Validator::isNull($values) )
                    $paramFilters[] = "$table_name.$table_column_name is null";
                else if ( Validator::isID($values) )
                    $paramFilters[] = "$table_name.$table_column_id = ". $db->quote( Validator::toID($values) );
                else if ( Validator::isValue($values) )
                    $paramFilters[] = "$table_name.$table_column_name = ". $db->quote( Validator::toValue($values) );
                else
                    throw new Exception($ex_message . " : " . $values, $ex_code);
            }

            $filter = "(" . implode(" OR ", $paramFilters) . ")";
            
            return $filter;
        
    }
    
       public static function BasicFilter($filter_param, $table_name, $table_column_id, $table_column_name, $filter_validators, $ex_message, $ex_code ) {
            
            global $db;  
            $param = Validator::toArray($filter_param);
            $validators = Validator::toArray($filter_validators);
            
            $paramFilters = array();
            
            foreach ($param as $values)
            {

                if (in_array('null', $validators, true) && Validator::isNull($values) ) {
                        $paramFilters[] = "$table_name.$table_column_name is null";
                } elseif (in_array('id', $validators, true) && Validator::IsID($values)) {
                        $paramFilters[] = "$table_name.$table_column_id = ". $db->quote( Validator::toID($values) );
                } elseif (in_array('value', $validators, true) && Validator::IsValue($values) ) {
                        $paramFilters[] = "$table_name.$table_column_name = ". $db->quote( Validator::toValue($values) );
                } elseif (in_array('numeric', $validators, true) && Validator::IsNumeric($values)) { 
                        $paramFilters[] = "$table_name.$table_column_name = ". $db->quote( Validator::ToNumeric($values) );
                } else {
                    throw new Exception($ex_message . " : " . $values, $ex_code);
                }
 
            }
            
            $filter = "(" . implode(" OR ", $paramFilters) . ")";
            
            
            return $filter;
        
    }
    
    public static function DateBasicFilter($filter_param, $table_name, $table_column_name, $filter_validators, $ex_message, $ex_code ) {

         global $db;  
         $param = Validator::toArray($filter_param);
         $validators = Validator::toArray($filter_validators);

         $paramFilters = array();

         foreach ($param as $values)
         {

             if (in_array('null', $validators, true) && Validator::isNull($values) ) {
                     $paramFilters[] = "$table_name.$table_column_name is null";
             } elseif (in_array('date', $validators, true) && Validator::IsDate($values,'Y-m-d')) {
                     $paramFilters[] = "$table_name.$table_column_name  like ". $db->quote( '%'.Validator::ToDate($values,'Y-m-d').'%' );
             } elseif (in_array('greater', $validators, true) && Validator::IsDate($values,'Y-m-d')) {
                     $paramFilters[] = "$table_name.$table_column_name >= ". $db->quote( Validator::ToDate($values,'Y-m-d') );
             } elseif (in_array('lower', $validators, true) && Validator::IsDate($values,'Y-m-d')) { 
                     $paramFilters[] = "$table_name.$table_column_name =< ". $db->quote( Validator::ToDate($values,'Y-m-d') );
             } else {
                 throw new Exception($ex_message . " : " . $values, $ex_code);
             }

         }

         $filter = "(" . implode(" OR ", $paramFilters) . ")";


         return $filter;

    }

    public static function setFilter ($qb, $filter_param, $table_name, $table_column_id, $table_column_name, $filter_validators, $ex_message, $ex_code) {
         global $db;

         $param = Validator::toArray($filter_param);
         $validators = Validator::toArray($filter_validators);  

         $orx = $qb->expr()->orX();

         foreach ($param as $values)
         {
              if (in_array('null', $validators, true) && Validator::isNull($values) ) 
                   $orx->add($qb->expr()->isNull($table_name.".".$table_column_id));
              elseif (in_array('id', $validators, true) && Validator::IsID($values)) 
                  $orx->add($qb->expr()->eq($table_name.".".$table_column_id, $db->quote(Validator::toID($values))));
              elseif (in_array('value', $validators, true) && Validator::IsValue($values) ) 
                  $orx->add($qb->expr()->eq($table_name.".".$table_column_name, $db->quote(Validator::toValue($values))));
              elseif (in_array('numeric', $validators, true) && Validator::IsNumeric($values)) 
                  $orx->add($qb->expr()->eq($table_name.".".$table_column_name, $db->quote(Validator::ToNumeric($values))));
              elseif (in_array('date', $validators, true) && Validator::IsDate($values,'Y-m-d'))
                    $orx->add($qb->expr()->like($table_name.".".$table_column_name, $db->quote('%'.Validator::ToDate($values,'Y-m-d').'%' )));
              elseif (in_array('greater', $validators, true) && Validator::IsDate($values,'Y-m-d')) 
                   $orx->add($qb->expr()->gte($table_name.".".$table_column_name, $db->quote(Validator::ToDate($values,'Y-m-d'))));
              elseif (in_array('lower', $validators, true) && Validator::IsDate($values,'Y-m-d'))  
                   $orx->add($qb->expr()->lte($table_name.".".$table_column_name, $db->quote(Validator::ToDate($values,'Y-m-d'))));
              else
                  throw new Exception($ex_message . " : " . $values, $ex_code);
         }


        $qb->andWhere($orx);
        
    }  
    
    public static function setSearchFilter ($qb, $filter_param, $table_name, $table_column_name, $searchtype, $ex_message, $ex_code) {
        global $db;
            
        $param = Validator::toArray($filter_param);
  
        foreach ($param as $values)
        {
          $orx = $qb->expr()->orX();
          $andx = $qb->expr()->andX();

            if ( Validator::isNull($values) )
                 $andx->add($qb->expr()->isNull($table_name.".".$table_column_name));
            else if ( Validator::IsValue($values) )
            {
                if ( $searchtype == SearchEnumTypes::Exact )
                    $orx->add($qb->expr()->eq($table_name.".".$table_column_name, $db->quote(Validator::toValue($values))));
                else if ( $searchtype == SearchEnumTypes::Contain )
                    $orx->add($qb->expr()->like($table_name.".".$table_column_name, $db->quote('%'.Validator::toValue($values).'%')));
                else
                {
                    $words = Validator::toArray($values, " ");

                    foreach ($words as $word)
                    {
                        switch ($searchtype)
                        {
                            case SearchEnumTypes::ContainAll :
                                $andx->add($qb->expr()->like($table_name.".".$table_column_name, $db->quote('%'.Validator::toValue($word).'%')));
                                break;
                            case SearchEnumTypes::ContainAny :
                                $orx->add($qb->expr()->like($table_name.".".$table_column_name, $db->quote('%'.Validator::toValue($word).'%')));
                                break;
                            case SearchEnumTypes::StartWith :
                                $orx->add($qb->expr()->like($table_name.".".$table_column_name, $db->quote(Validator::toValue($word).'%')));
                                break;
                            case SearchEnumTypes::EndWith :
                                 $orx->add($qb->expr()->like($table_name.".".$table_column_name, $db->quote('%'.Validator::toValue($word))));
                                break;
                        }
                    }
                }
            }
            else
                throw new Exception($ex_message . " : " . $values, $ex_code);
  
        switch ($searchtype)
        {
            case SearchEnumTypes::ContainAll :
                $qb->andWhere($andx);
                break;
            default :
                $qb->andWhere($orx);
                break;
        }
                            
        }
    } 
           
    public static function getSearchType($searchtype, $params) {
         
        if ( Validator::Missing('searchtype', $params) )
            $searchtype = SearchEnumTypes::ContainAll ;
        else if ( SearchEnumTypes::isValidValue( $searchtype ) || SearchEnumTypes::isValidName( $searchtype ) )
            $searchtype = SearchEnumTypes::getValue($searchtype);
        else
            throw new Exception(ExceptionMessages::InvalidSearchType." : ".$searchtype, ExceptionCodes::InvalidSearchType);
        
        return $searchtype;
    }
       
    public static function getOrderType($ordertype, $params) {
         
        if ( Validator::Missing('ordertype', $params) )
            $ordertype = OrderEnumTypes::ASC ;
        else if ( OrderEnumTypes::isValidValue( $ordertype ) || OrderEnumTypes::isValidName( $ordertype ) )
            $ordertype = OrderEnumTypes::getValue($ordertype);
        else
            throw new Exception(ExceptionMessages::InvalidOrderType." : ".$ordertype, ExceptionCodes::InvalidOrderType);
        
        return $ordertype;
    }
   
}

?>