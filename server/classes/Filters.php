<?php

class Filters {
    
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
    
    
     public static function AllLabsCounter($sqlFrom,$sqlWhere){
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

    
    
}

?>