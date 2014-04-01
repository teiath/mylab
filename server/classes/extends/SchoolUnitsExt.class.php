<?php

/**
*
* @version 1.0
* @author  ΤΕΙ Αθήνας
* @package api\classes\extends
*/

require_once('classes/models/SchoolUnits.class.php');
//require_once('classes/extends/LabsExt.class.php');
//require_once('classes/extends/SchoolUnitTypesExt.class.php');

class SchoolUnitsExt extends SchoolUnits {
   
    private static $rowsArray ;
    private static $objsArray ;
        
    public function __construct(PDO $db) 
    {
        if ( ( ! is_array( self::$rowsArray ) ) && $db ) 
        {
           //self::getAll($db, null);
        }
    }

    public function getRowsArray() 
    {
        return self::$rowsArray;
    }
        
    public function getObjsArray() 
    {
        return self::$objsArray;
    }
    
    public static function buildSqlOrderByPublic($sort)
    {
     return self::buildSqlOrderBy($sort); 
    }
    
    public static function getAll(PDO $db, $filter, $and=true, $sort=null) 
    {
        self::$rowsArray = array();
        self::$objsArray = array();
        
        $objs = self::findByFilter($db, $filter, $and, $sort);

        foreach($objs as $obj)
        {
            self::$rowsArray[$obj->getSchoolUnitId()] = $obj->getName(); 
            self::$objsArray[$obj->getSchoolUnitId()] = $obj; 
        }
    }

    /**
     * Query table, for computation vocabulary count.
     * 
     * Will return an array of AquisitionSources which contain count value at AquisitionSourceId field.
     *
     * @param PDO $db a PDO Database instance
     * @return AquisitionSources[]
     */
    public static function getAllCount(PDO $db) 
    {
        $fieldNames = array_values(self::getFieldNames());

        $sql='SELECT count(*) as '.$fieldNames[0].' FROM `'.self::SQL_TABLE_NAME.'`';

        $stmt=self::prepareStatement($db, $sql);

        return self::fromStatement($stmt);
    }
//=========================================================================================================================================================================================

//    public static function getAllWithLimit(PDO $db, $filter, $and=true, $sort=null, $start=null, $count=null) 
//    {
//        self::$rowsArray = array();
//        self::$objsArray = array();
//        
//        $objs = self::findByFilterWithLimit($db, $filter, $and, $sort, $start, $count);
//
//        foreach($objs as $obj)
//        {
//            self::$rowsArray[$obj->getSchoolUnitId()] = $obj->getName(); 
//            self::$objsArray[$obj->getSchoolUnitId()] = $obj; 
//        }
//    }
 
//=========================================================================================================================================================================================
    public function searchArrayForID($id)
    {
        $obj = self::$objsArray[$id];
        
        if ($obj)
            $this->assignByArray($obj->toArray());
        else
            $this->assignDefaultValues ();
        
        return $this;
    }

//=========================================================================================================================================================================================
    public function searchArrayForValue($name)
    {
        $id = array_search($name, $this->getRowsArray());
        
        $obj = self::$objsArray[$id];
        
        if ($obj)
        {
            $this->assignByArray($obj->toArray());
        }
        else
        {
            $this->null;
        }
        
        return $this;
    }

//=========================================================================================================================================================================================
//    public static function findByFilterWithLimit(PDO $db, $filter, $and=true, $sort=null, $start=null, $count=null) 
//    {
//		if (!($filter instanceof DFCInterface)) 
//        {
//			$filter=new DFCAggregate($filter, $and);
//		}
//		$sql='SELECT * FROM `'.self::SQL_TABLE_NAME.'`'
//		. self::buildSqlWhere($filter, $and, false, true)
//		. self::buildSqlOrderBy($sort);
//                
//        if (isset($count) && !isset($start)) $start = 0;
//
//        if (isset($start) && isset($count))
//            $sql .=' LIMIT '.$start.', '.$count;
//        
//		$stmt=self::prepareStatement($db, $sql);
//		self::bindValuesForFilter($stmt, $filter);
//		return self::fromStatement($stmt);
//	}
	
//=========================================================================================================================================================================================
//    public static function findDistinctByFilterWithLimit(PDO $db, $filter, $and=true, $sort=null, $start=null, $count=null) 
//    {
//		if (!($filter instanceof DFCInterface)) 
//        {
//			$filter=new DFCAggregate($filter, $and);
//		}
//		$sql='SELECT DISTINCT school_units.school_unit_id FROM `'.self::SQL_TABLE_NAME.'`'
//		. self::buildSqlWhere($filter, $and, false, true)
//		. self::buildSqlOrderBy($sort);
//                
//         if (isset($count) && !isset($start)) $start = 0;
//
//        if (isset($start) && isset($count))
//            $sql .=' LIMIT '.$start.', '.$count;
//        
//		$stmt=self::prepareStatement($db, $sql);
//		self::bindValuesForFilter($stmt, $filter);
//		return self::fromStatement($stmt);
//	}
        
//=========================================================================================================================================================================================
//    public static function findByFilterAsCount(PDO $db, $filter, $and=true) 
//    {
//        $fieldNames = array_values(self::getFieldNames());
//
//        if (!($filter instanceof DFCInterface)) 
//        {
//            $filter=new DFCAggregate($filter, $and);
//        }
//        $sql='SELECT count(*) as '.$fieldNames[0].' FROM `'.self::SQL_TABLE_NAME.'`'
//        . self::buildSqlWhere($filter, $and, false, true);
//
//        $stmt=self::prepareStatement($db, $sql);
//        self::bindValuesForFilter($stmt, $filter);
// 
//        return self::fromStatement($stmt);
//    }

//=========================================================================================================================================================================================
//    public function insertIntoArray()
//    {
//        self::$rowsArray[$this->getSchoolUnitId()] = $this->getName(); 
//        self::$objsArray[$this->getSchoolUnitId()] = $this; 
//    }
 
//=========================================================================================================================================================================================
    public static function findByIDs(PDO $db, $ids) 
    {
        $fieldNames = array_values(self::getFieldNames());
        
        //$sql_join_order =' LEFT JOIN school_unit_types ON school_units.school_unit_type_id=school_unit_types.school_unit_type_id';        
        //SchoolUnitTypesExt::buildSqlOrderBy($sort);
        
        
        $sql='SELECT * FROM `'
                .self::SQL_TABLE_NAME.'`'
              //.self::buildSqlWhere($filter, $and, false, true)
              //.$sql_join_order
                .' WHERE '.$fieldNames[0].' in ('.$ids.')'
                .' ORDER BY FIELD(school_unit_id ,'.$ids.')';
                //. self::buildSqlOrderBy($sort);
                //.SchoolUnitTypesExt::buildSqlOrderBy($sort);
        
            //echo $sql;
		$stmt=$db->query($sql);
		return self::fromExecutedStatement($stmt);
    }
 
//=========================================================================================================================================================================================
    public static function findBySqlJoinAsCount(PDO $db, $filter, $ext_filters=null, $and=true ) {

    if (!($filter instanceof DFCInterface)) 
    {
        $filter=new DFCAggregate($filter, $and);
    }
    
    $sql_join =' LEFT JOIN labs ON school_units.school_unit_id=labs.school_unit_id ';
    $sql_prepend=' WHERE ';

    if ($filter->count()!=0){
    $sql_filters ='' ;
    } else {
    $sql_filters =' 1 ' ;
    }
      
        if ($ext_filters['lab_id']){
         $i=0;
         $sql_filters .=' AND (' ;
         $counter=count($ext_filters['lab_id']);
             if ($counter==1){
                // $sql_filters .=' labs.lab_id LIKE CONCAT("%",'. $ext_filters['lab_id'][0]->getValue().',"%")';
                 $sql_filters .=' labs.lab_id = '. $ext_filters['lab_id'][0]->getValue();
             } else {
                 $prefix='';
                 for ($i=0;$i<$counter;$i++) {    
                // $sql_filters .=$prefix.' labs.lab_id LIKE CONCAT("%",'. $ext_filters['lab_id'][$i]->getValue().',"%")';
                    $sql_filters .=$prefix.' labs.lab_id = '. $ext_filters['lab_id'][$i]->getValue();
                    $prefix=' OR';
                 }
             } 
         $sql_filters .=' )';
        }    

        if ($ext_filters['lab_type']){
         $i=0;
         $sql_filters .=' AND (' ;
         $counter=count($ext_filters['lab_type']);
             if ($counter==1){
                 $sql_filters .=' labs.lab_type_id = '. $ext_filters['lab_type'][0]->getValue();
             } else {
                 $prefix='';
                 for ($i=0;$i<$counter;$i++) {    
                    $sql_filters .=$prefix.' labs.lab_type_id = '. $ext_filters['lab_type'][$i]->getValue();
                    $prefix=' OR';
                 }
             } 
         $sql_filters .=' )';
        }   
        
        if ($ext_filters['lab_state']){
         $i=0;
         $sql_filters .=' AND (' ;
         $counter=count($ext_filters['lab_state']);
             if ($counter==1){
                 $sql_filters .=' labs.state_id = '. $ext_filters['lab_state'][0]->getValue();
             } else {
                 $prefix='';
                 for ($i=0;$i<$counter;$i++) {    
                    $sql_filters .=$prefix.' labs.state_id = '. $ext_filters['lab_state'][$i]->getValue();
                    $prefix=' OR';
                 }
             } 
         $sql_filters .=' )';
        } 

        if ($ext_filters['operational_rating']){
         $i=0;
         $sql_filters .=' AND (' ;
         $counter=count($ext_filters['operational_rating']);
             if ($counter==1){
                 $sql_filters .=' labs.operational_rating = '. $ext_filters['operational_rating'][0]->getValue();
             } else {
                 $prefix='';
                 for ($i=0;$i<$counter;$i++) {    
                    $sql_filters .=$prefix.' labs.operational_rating = '. $ext_filters['operational_rating'][$i]->getValue();
                    $prefix=' OR';
                 }
             } 
         $sql_filters .=' )';
        } 
        
        if ($ext_filters['technological_rating']){
         $i=0;
         $sql_filters .=' AND (' ;
         $counter=count($ext_filters['technological_rating']);
             if ($counter==1){
                 $sql_filters .=' labs.technological_rating = '. $ext_filters['technological_rating'][0]->getValue();
             } else {
                 $prefix='';
                 for ($i=0;$i<$counter;$i++) {    
                    $sql_filters .=$prefix.' labs.technological_rating = '. $ext_filters['technological_rating'][$i]->getValue();
                    $prefix=' OR';
                 }
             } 
         $sql_filters .=' )';
        } 
        
        if ($ext_filters['aquisition_source']){
               $i=0;
               $sql_join .=' LEFT JOIN lab_aquisition_sources ON lab_aquisition_sources.lab_id=labs.lab_id';
               $sql_filters .=' AND (';
               $counter=count($ext_filters['aquisition_source']);
                   if ($counter==1){
                       $sql_filters .=' lab_aquisition_sources.aquisition_source_id = '. $ext_filters['aquisition_source'][0]->getValue();
                   } else {
                       $prefix='';
                       for ($i=0;$i<$counter;$i++) {    
                            $sql_filters .=$prefix.' lab_aquisition_sources.aquisition_source_id = '. $ext_filters['aquisition_source'][$i]->getValue();
                            $prefix =' OR';
                       }
                   } 
               $sql_filters .=' )';
        } 

        if ($ext_filters['equipment_type']){
            $i=0;
            $sql_join .=' LEFT JOIN lab_equipment_types ON lab_equipment_types.lab_id=labs.lab_id';
            $sql_filters .=' AND (';
            $counter=count($ext_filters['equipment_type']);
                if ($counter==1){
                    $sql_filters .=' lab_equipment_types.equipment_type_id = '. $ext_filters['equipment_type'][0]->getValue();
                } else {
                    $prefix='';
                    for ($i=0;$i<$counter;$i++) {    
                        $sql_filters .=$prefix.' lab_equipment_types.equipment_type_id = '. $ext_filters['equipment_type'][$i]->getValue();
                        $prefix=' OR';
                    }
                } 
            $sql_filters .=' )';
        } 

        if ($ext_filters['lab_worker']){
            $i=0;
            $sql_join .=' LEFT JOIN lab_workers ON lab_workers.lab_id=labs.lab_id';
            $sql_filters .=' AND (';
            $counter=count($ext_filters['lab_worker']);
                if ($counter==1){
                    $sql_filters .=' lab_workers.worker_id = '. $ext_filters['lab_worker'][0]->getValue();
                } else {
                    $prefix='';
                    for ($i=0;$i<$counter;$i++) {    
                        $sql_filters .=$prefix.' lab_workers.worker_id = '. $ext_filters['lab_worker'][$i]->getValue();
                        $prefix=' OR';
                    }
                } 
            $sql_filters .=' )';
        }
        
    $fieldNames = array_values(self::getFieldNames());     
//      $sql='SELECT count(DISTINCT school_units.school_unit_id) as '.$fieldNames[0].' FROM school_units'
      $sql='SELECT count(DISTINCT school_units.school_unit_id) as '.$fieldNames[0].', count(DISTINCT labs.lab_id) as '.$fieldNames[1].' FROM school_units'
            . $sql_join
            . $sql_prepend
            . self::buildSqlWhere($filter, $and, true, false)
            . $sql_filters;       
                //echo $sql;
    $stmt=self::prepareStatement($db, $sql);
    self::bindValuesForFilter($stmt, $filter);
    return self::fromStatement($stmt);                
}
 
//=========================================================================================================================================================================================

public static function findBySqlJoinAsLabsCount (PDO $db, $filter, $ext_filters=null, $and=true, $oLabTypes=null) {

    if (!($filter instanceof DFCInterface)) 
    {
        $filter=new DFCAggregate($filter, $and);
    }
    
   // global $db;
   // $oLabs=new LabTypesExt($db);
   // $arr=$oLabs->getRowsArray();

    foreach ($oLabTypes->getRowsArray() as $lab_type_id=>$lab_type_name) {
        $sql_array[$lab_type_id]=$lab_type_name;
        $sql_count_if[] =' COUNT(if(tb1.lab_type_id = '.$lab_type_id.', 1, null)) AS count_lab_type_'.$lab_type_id;
    }
        $sql_count_if = implode(",", $sql_count_if);   
             
    $sql_join =' LEFT JOIN labs ON school_units.school_unit_id=labs.school_unit_id ';
    $sql_prepend=' WHERE ';

    if ($filter->count()!=0){
    $sql_filters =" ";
    } else {
    $sql_filters =' 1 ';
    }

    
        if ($ext_filters['lab_id']){
         $i=0;
         $sql_filters .=' AND (' ;
         $counter=count($ext_filters['lab_id']);
             if ($counter==1){
                 $sql_filters .=' labs.lab_id = '. $ext_filters['lab_id'][0]->getValue();
             } else {
                 $prefix='';
                 for ($i=0;$i<$counter;$i++) {    
                    $sql_filters .=$prefix.' labs.lab_id = '. $ext_filters['lab_id'][$i]->getValue();
                    $prefix=' OR';
                 }
             } 
         $sql_filters .=' )';
        }    

        if ($ext_filters['lab_type']){
         $i=0;
         $sql_filters .=' AND (' ;
         $counter=count($ext_filters['lab_type']);
             if ($counter==1){
                 $sql_filters .=' labs.lab_type_id = '. $ext_filters['lab_type'][0]->getValue();
             } else {
                 $prefix='';
                 for ($i=0;$i<$counter;$i++) {    
                    $sql_filters .=$prefix.' labs.lab_type_id = '. $ext_filters['lab_type'][$i]->getValue();
                    $prefix=' OR';
                 }
             } 
         $sql_filters .=' )';
        }  
        
        if ($ext_filters['lab_state']){
         $i=0;
         $sql_filters .=' AND (' ;
         $counter=count($ext_filters['lab_state']);
             if ($counter==1){
                 $sql_filters .=' labs.state_id = '. $ext_filters['lab_state'][0]->getValue();
             } else {
                 $prefix='';
                 for ($i=0;$i<$counter;$i++) {    
                    $sql_filters .=$prefix.' labs.state_id = '. $ext_filters['lab_state'][$i]->getValue();
                    $prefix=' OR';
                 }
             } 
         $sql_filters .=' )';
        } 
        
        if ($ext_filters['operational_rating']){
         $i=0;
         $sql_filters .=' AND (' ;
         $counter=count($ext_filters['operational_rating']);
             if ($counter==1){
                 $sql_filters .=' labs.operational_rating = '. $ext_filters['operational_rating'][0]->getValue();
             } else {
                 $prefix='';
                 for ($i=0;$i<$counter;$i++) {    
                    $sql_filters .=$prefix.' labs.operational_rating = '. $ext_filters['operational_rating'][$i]->getValue();
                    $prefix=' OR';
                 }
             } 
         $sql_filters .=' )';
        } 
        
        if ($ext_filters['technological_rating']){
         $i=0;
         $sql_filters .=' AND (' ;
         $counter=count($ext_filters['technological_rating']);
             if ($counter==1){
                 $sql_filters .=' labs.technological_rating = '. $ext_filters['technological_rating'][0]->getValue();
             } else {
                 $prefix='';
                 for ($i=0;$i<$counter;$i++) {    
                    $sql_filters .=$prefix.' labs.technological_rating = '. $ext_filters['technological_rating'][$i]->getValue();
                    $prefix=' OR';
                 }
             } 
         $sql_filters .=' )';
        } 
        
        if ($ext_filters['aquisition_source']){
               $i=0;
               $sql_join .=' LEFT JOIN lab_aquisition_sources ON lab_aquisition_sources.lab_id=labs.lab_id';
               $sql_filters .=' AND (';
               $counter=count($ext_filters['aquisition_source']);
                   if ($counter==1){
                       $sql_filters .=' lab_aquisition_sources.aquisition_source_id = '. $ext_filters['aquisition_source'][0]->getValue();
                   } else {
                       $prefix='';
                       for ($i=0;$i<$counter;$i++) {    
                            $sql_filters .=$prefix.' lab_aquisition_sources.aquisition_source_id = '. $ext_filters['aquisition_source'][$i]->getValue();
                            $prefix =' OR';
                       }
                   } 
               $sql_filters .=' )';
        } 

        if ($ext_filters['equipment_type']){
            $i=0;
            $sql_join .=' LEFT JOIN lab_equipment_types ON lab_equipment_types.lab_id=labs.lab_id';
            $sql_filters .=' AND (';
            $counter=count($ext_filters['equipment_type']);
                if ($counter==1){
                    $sql_filters .=' lab_equipment_types.equipment_type_id = '. $ext_filters['equipment_type'][0]->getValue();
                } else {
                    $prefix='';
                    for ($i=0;$i<$counter;$i++) {    
                        $sql_filters .=$prefix.' lab_equipment_types.equipment_type_id = '. $ext_filters['equipment_type'][$i]->getValue();
                        $prefix=' OR';
                    }
                } 
            $sql_filters .=' )';
        } 
        
        if ($ext_filters['lab_worker']){
            $i=0;
            $sql_join .=' LEFT JOIN lab_workers ON lab_workers.lab_id=labs.lab_id';
            $sql_filters .=' AND (';
            $counter=count($ext_filters['lab_worker']);
                if ($counter==1){
                    $sql_filters .=' lab_workers.worker_id = '. $ext_filters['lab_worker'][0]->getValue();
                } else {
                    $prefix='';
                    for ($i=0;$i<$counter;$i++) {    
                        $sql_filters .=$prefix.' lab_workers.worker_id = '. $ext_filters['lab_worker'][$i]->getValue();
                        $prefix=' OR';
                    }
                } 
            $sql_filters .=' )';
        }

     $sql='SELECT'
            . $sql_count_if
            .' FROM ( SELECT DISTINCT labs.lab_id,labs.lab_type_id'
            .' FROM `'.self::SQL_TABLE_NAME.'`'
            . $sql_join
             .$sql_prepend
            . self::buildSqlWhere($filter, $and, true, false)
            . $sql_filters
            .' ) AS tb1';
//    echo $sql;
        $stmt=self::prepareStatement($db, $sql);
        self::bindValuesForFilter($stmt, $filter);
        $all_labs_counts = self::fromExecutedStatementCountLabs($stmt,$sql_array);
    
    return $all_labs_counts;

}

//=========================================================================================================================================================================================
    public static function fromExecutedStatementCountLabs(PDOStatement $stmt,$sql_array) {
         
    $affected=$stmt->execute();
    if (false===$affected) {
                    $stmt->closeCursor();
                    throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
            }
              
    $all_labs_counts=array();               
    $rows=$stmt->fetch(PDO::FETCH_ASSOC);

            $i=1;
             foreach ($rows as $lab_type_name) {
                 $all_labs_counts[$sql_array[$i]] = $lab_type_name;
                 $i++;
            }
            
    $stmt->closeCursor();
    return $all_labs_counts; 
    }     
    
    
//========================================================================================================================================================================================= 
     public static function findBySqlJoinBeta(PDO $db, $filter, $ext_filters=null, $sort_field=null, $sort_mode=null, $and=true) {
    
        if (!($filter instanceof DFCInterface)) 
        {
            $filter=new DFCAggregate($filter, $and);
        }
        
        $sql_join =' LEFT JOIN labs ON school_units.school_unit_id=labs.school_unit_id ';
        $sql_prepend=' WHERE ';
        
        if ($filter->count()!=0){
        $sql_filters =' ' ;
        } else {
        $sql_filters =' 1 ' ;
        }
           
        
            if ($ext_filters['lab_id']){
             $i=0;
             $sql_filters .=' AND (' ;
             $counter=count($ext_filters['lab_id']);
                 if ($counter==1){
                    // $sql_filters .=' labs.lab_id LIKE CONCAT("%",'. $ext_filters['lab_id'][0]->getValue().',"%")';
                     $sql_filters .=' labs.lab_id = '. $ext_filters['lab_id'][0]->getValue();
                 } else {
                     $prefix='';
                     for ($i=0;$i<$counter;$i++) {    
                    // $sql_filters .=$prefix.' labs.lab_id LIKE CONCAT("%",'. $ext_filters['lab_id'][$i]->getValue().',"%")';
                        $sql_filters .=$prefix.' labs.lab_id = '. $ext_filters['lab_id'][$i]->getValue();
                        $prefix=' OR';
                     }
                 } 
             $sql_filters .=' )';
            }    
        
            if ($ext_filters['lab_type']){
             $i=0;
             $sql_filters .=' AND (' ;
             $counter=count($ext_filters['lab_type']);
                 if ($counter==1){
                     $sql_filters .=' labs.lab_type_id = '. $ext_filters['lab_type'][0]->getValue();
                 } else {
                     $prefix='';
                     for ($i=0;$i<$counter;$i++) {    
                        $sql_filters .=$prefix.' labs.lab_type_id = '. $ext_filters['lab_type'][$i]->getValue();
                        $prefix=' OR';
                     }
                 } 
             $sql_filters .=' )';
            }  
            
            if ($ext_filters['lab_state']){
             $i=0;
             $sql_filters .=' AND (' ;
             $counter=count($ext_filters['lab_state']);
                 if ($counter==1){
                     $sql_filters .=' labs.state_id = '. $ext_filters['lab_state'][0]->getValue();
                 } else {
                     $prefix='';
                     for ($i=0;$i<$counter;$i++) {    
                        $sql_filters .=$prefix.' labs.state_id = '. $ext_filters['lab_state'][$i]->getValue();
                        $prefix=' OR';
                     }
                 } 
             $sql_filters .=' )';
            } 
         
            if ($ext_filters['operational_rating']){
             $i=0;
             $sql_filters .=' AND (' ;
             $counter=count($ext_filters['operational_rating']);
                 if ($counter==1){
                     $sql_filters .=' labs.operational_rating = '. $ext_filters['operational_rating'][0]->getValue();
                 } else {
                     $prefix='';
                     for ($i=0;$i<$counter;$i++) {    
                        $sql_filters .=$prefix.' labs.operational_rating = '. $ext_filters['operational_rating'][$i]->getValue();
                        $prefix=' OR';
                     }
                 } 
             $sql_filters .=' )';
            } 

            if ($ext_filters['technological_rating']){
             $i=0;
             $sql_filters .=' AND (' ;
             $counter=count($ext_filters['technological_rating']);
                 if ($counter==1){
                     $sql_filters .=' labs.technological_rating = '. $ext_filters['technological_rating'][0]->getValue();
                 } else {
                     $prefix='';
                     for ($i=0;$i<$counter;$i++) {    
                        $sql_filters .=$prefix.' labs.technological_rating = '. $ext_filters['technological_rating'][$i]->getValue();
                        $prefix=' OR';
                     }
                 } 
             $sql_filters .=' )';
            } 
               
            if ($ext_filters['aquisition_source']){
                   $i=0;
                   $sql_join .=' LEFT JOIN lab_aquisition_sources ON lab_aquisition_sources.lab_id=labs.lab_id';
                   $sql_filters .=' AND (';
                   $counter=count($ext_filters['aquisition_source']);
                       if ($counter==1){
                           $sql_filters .=' lab_aquisition_sources.aquisition_source_id = '. $ext_filters['aquisition_source'][0]->getValue();
                       } else {
                           $prefix='';
                           for ($i=0;$i<$counter;$i++) {    
                                $sql_filters .=$prefix.' lab_aquisition_sources.aquisition_source_id = '. $ext_filters['aquisition_source'][$i]->getValue();
                                $prefix =' OR';
                           }
                       } 
                   $sql_filters .=' )';
            } 

            if ($ext_filters['equipment_type']){
                $i=0;
                $sql_join .=' LEFT JOIN lab_equipment_types ON lab_equipment_types.lab_id=labs.lab_id';
                $sql_filters .=' AND (';
                $counter=count($ext_filters['equipment_type']);
                    if ($counter==1){
                        $sql_filters .=' lab_equipment_types.equipment_type_id = '. $ext_filters['equipment_type'][0]->getValue();
                    } else {
                        $prefix='';
                        for ($i=0;$i<$counter;$i++) {    
                            $sql_filters .=$prefix.' lab_equipment_types.equipment_type_id = '. $ext_filters['equipment_type'][$i]->getValue();
                            $prefix=' OR';
                        }
                    } 
                $sql_filters .=' )';
            } 
    
        if ($ext_filters['lab_worker']){
            $i=0;
            $sql_join .=' LEFT JOIN lab_workers ON lab_workers.lab_id=labs.lab_id';
            $sql_filters .=' AND (';
            $counter=count($ext_filters['lab_worker']);
                if ($counter==1){
                    $sql_filters .=' lab_workers.worker_id = '. $ext_filters['lab_worker'][0]->getValue();
                } else {
                    $prefix='';
                    for ($i=0;$i<$counter;$i++) {    
                        $sql_filters .=$prefix.' lab_workers.worker_id = '. $ext_filters['lab_worker'][$i]->getValue();
                        $prefix=' OR';
                    }
                } 
            $sql_filters .=' )';
        }
            
               //=sorting by other tables  	

         switch ($sort_field) {
             case 'region_edu_admin' :
                 $sort = new DSC(RegionEduAdminsExt::FIELD_NAME , $sort_mode);
                 $sql_join_order_name = " , region_edu_admins.name , school_units.name"; 
                 $sql_join_order = " LEFT JOIN region_edu_admins ON school_units.region_edu_admin_id=region_edu_admins.region_edu_admin_id";
                 $sql_join_order_field= RegionEduAdminsExt::buildSqlOrderByPublic($sort).', `school_units`.`name` ASC';
                 break;
             case 'edu_admin':
                $sort = new DSC(EduAdminsExt::FIELD_NAME , $sort_mode);
                $sql_join_order_name = " , edu_admins.name , school_units.name";
                $sql_join_order =" LEFT JOIN edu_admins ON school_units.edu_admin_id=edu_admins.edu_admin_id";
                $sql_join_order_field= EduAdminsExt::buildSqlOrderByPublic($sort).', `school_units`.`name` ASC';
                break;
             case 'transfer_area' :
                 $sort = new DSC(TransferAreasExt::FIELD_NAME , $sort_mode);
                 $sql_join_order_name = " , transfer_areas.name , school_units.name";
                 $sql_join_order =" LEFT JOIN transfer_areas ON school_units.transfer_area_id=transfer_areas.transfer_area_id";
                 $sql_join_order_field= TransferAreasExt::buildSqlOrderByPublic($sort).', `school_units`.`name` ASC';
                 break;
             case 'municipality' :
                 $sort = new DSC(MunicipalitiesExt::FIELD_NAME , $sort_mode);
                 $sql_join_order_name = " , municipalities.name , school_units.name";
                 $sql_join_order =" LEFT JOIN municipalities ON school_units.municipality_id=municipalities.municipality_id";
                 $sql_join_order_field= MunicipalitiesExt::buildSqlOrderByPublic($sort).', `school_units`.`name` ASC';
                 //$sql_join_order_field= " ORDER BY `municipalities`.`name` DESC, `school_units`.`name` ASC ";
                 break;
             case 'prefecture' :
                 $sort = new DSC(PrefecturesExt::FIELD_NAME , $sort_mode);
                 $sql_join_order_name = " , prefectures.name , school_units.name";
                 $sql_join_order =" LEFT JOIN prefectures ON school_units.prefecture_id=prefectures.prefecture_id";
                 $sql_join_order_field= PrefecturesExt::buildSqlOrderByPublic($sort).', `school_units`.`name` ASC';
                 break;
            case 'education_level' :
                $sort = new DSC(EducationLevelsExt::FIELD_NAME , $sort_mode);
                 $sql_join_order_name = " , education_levels.name , school_units.name"; 
                 $sql_join_order = " LEFT JOIN education_levels ON school_units.education_level_id=education_levels.education_level_id";
                 $sql_join_order_field= EducationLevelsExt::buildSqlOrderByPublic($sort).', `school_units`.`name` ASC';
                 break; 
             case 'school_unit_types' :
                 $sort = new DSC(SchoolUnitTypesExt::FIELD_NAME , $sort_mode);
                 $sql_join_order_name = " , school_unit_types.name , school_units.name"; 
                 $sql_join_order = " LEFT JOIN school_unit_types ON school_units.school_unit_type_id=school_unit_types.school_unit_type_id";
                 $sql_join_order_field= SchoolUnitTypesExt::buildSqlOrderByPublic($sort).', `school_units`.`name` ASC';
                 break;      
             default:
                if ($sort_field=="school_unit_id")
                    $sort = new DSC(SchoolUnitsExt::FIELD_SCHOOL_UNIT_ID , $sort_mode); 
                else if ($sort_field=="name")
                    $sort = new DSC(SchoolUnitsExt::FIELD_NAME , $sort_mode);
                $sql_join_order_name= "";
                $sql_join_order ="";
                $sql_join_order_field= self::buildSqlOrderBy($sort);
         }      
        
        $sql='SELECT DISTINCT school_units.school_unit_id'
                .$sql_join_order_name
                .' FROM school_units' 
                . $sql_join
                . $sql_join_order
                . $sql_prepend
                . self::buildSqlWhere($filter, $and, true, false)
                . $sql_filters
                . $sql_join_order_field;
        
        $stmt=self::prepareStatement($db, $sql);
        self::bindValuesForFilter($stmt, $filter);
        return self::fromStatement($stmt);
    }               

//=========================================================================================================================================================================================

     public static function findBySqlJoinWithLimitBeta(PDO $db, $filter, $ext_filters=null, $sort_field=null, $sort_mode=null, $and=true, $start=null, $count=null) {

        if (!($filter instanceof DFCInterface)) 
        {
            $filter=new DFCAggregate($filter, $and);
        }
        
        $sql_join =' LEFT JOIN labs ON school_units.school_unit_id=labs.school_unit_id ';
        $sql_prepend=' WHERE ';
        
        if ($filter->count()!=0){
        $sql_filters =' ' ;
        } else {
        $sql_filters =' 1 ' ;
        }
         

            if ($ext_filters['lab_id']){
             $i=0;
             $sql_filters .=' AND (' ;
             $counter=count($ext_filters['lab_id']);
                 if ($counter==1){
                     $sql_filters .=' labs.lab_id = '. $ext_filters['lab_id'][0]->getValue();
                 } else {
                     $prefix='';
                     for ($i=0;$i<$counter;$i++) {    
                     $sql_filters .=$prefix.' labs.lab_id = '. $ext_filters['lab_id'][$i]->getValue();
                     $prefix=' OR';
                     }
                 } 
             $sql_filters .=' )';
            }    
        
            if ($ext_filters['lab_type']){
             $i=0;
             $sql_filters .=' AND (' ;
             $counter=count($ext_filters['lab_type']);
                 if ($counter==1){
                     $sql_filters .=' labs.lab_type_id = '. $ext_filters['lab_type'][0]->getValue();
                 } else {
                     $prefix='';
                     for ($i=0;$i<$counter;$i++) {    
                     $sql_filters .=$prefix.' labs.lab_type_id = '. $ext_filters['lab_type'][$i]->getValue();
                     $prefix=' OR';
                     }
                 } 
             $sql_filters .=' )';
            }     
        
            if ($ext_filters['lab_state']){
            $i=0;
            $sql_filters .=' AND (' ;
            $counter=count($ext_filters['lab_state']);
                if ($counter==1){
                    $sql_filters .=' labs.state_id = '. $ext_filters['lab_state'][0]->getValue();
                } else {
                    $prefix='';
                    for ($i=0;$i<$counter;$i++) {    
                       $sql_filters .=$prefix.' labs.state_id = '. $ext_filters['lab_state'][$i]->getValue();
                       $prefix=' OR';
                    }
                } 
            $sql_filters .=' )';
           } 
        
            if ($ext_filters['operational_rating']){
             $i=0;
             $sql_filters .=' AND (' ;
             $counter=count($ext_filters['operational_rating']);
                 if ($counter==1){
                     $sql_filters .=' labs.operational_rating = '. $ext_filters['operational_rating'][0]->getValue();
                 } else {
                     $prefix='';
                     for ($i=0;$i<$counter;$i++) {    
                        $sql_filters .=$prefix.' labs.operational_rating = '. $ext_filters['operational_rating'][$i]->getValue();
                        $prefix=' OR';
                     }
                 } 
             $sql_filters .=' )';
            } 

            if ($ext_filters['technological_rating']){
             $i=0;
             $sql_filters .=' AND (' ;
             $counter=count($ext_filters['technological_rating']);
                 if ($counter==1){
                     $sql_filters .=' labs.technological_rating = '. $ext_filters['technological_rating'][0]->getValue();
                 } else {
                     $prefix='';
                     for ($i=0;$i<$counter;$i++) {    
                        $sql_filters .=$prefix.' labs.technological_rating = '. $ext_filters['technological_rating'][$i]->getValue();
                        $prefix=' OR';
                     }
                 } 
             $sql_filters .=' )';
            } 
        
            if ($ext_filters['aquisition_source']){
                   $i=0;
                   $sql_join .=' LEFT JOIN lab_aquisition_sources ON lab_aquisition_sources.lab_id=labs.lab_id';
                   $sql_filters .=' AND (';
                   $counter=count($ext_filters['aquisition_source']);
                       if ($counter==1){
                           $sql_filters .=' lab_aquisition_sources.aquisition_source_id = '. $ext_filters['aquisition_source'][0]->getValue();
                       } else {
                           $prefix='';
                           for ($i=0;$i<$counter;$i++) {    
                           $sql_filters .=$prefix.' lab_aquisition_sources.aquisition_source_id = '. $ext_filters['aquisition_source'][$i]->getValue();
                           $prefix =' OR';
                           }
                       } 
                   $sql_filters .=' )';
            } 

            if ($ext_filters['equipment_type']){
                $i=0;
                $sql_join .=' LEFT JOIN lab_equipment_types ON lab_equipment_types.lab_id=labs.lab_id';
                $sql_filters .=' AND (';
                $counter=count($ext_filters['equipment_type']);
                    if ($counter==1){
                        $sql_filters .=' lab_equipment_types.equipment_type_id = '. $ext_filters['equipment_type'][0]->getValue();
                    } else {
                        $prefix='';
                        for ($i=0;$i<$counter;$i++) {    
                        $sql_filters .=$prefix.' lab_equipment_types.equipment_type_id = '. $ext_filters['equipment_type'][$i]->getValue();
                        $prefix=' OR';
                        }
                    } 
                $sql_filters .=' )';
            } 
     
        if ($ext_filters['lab_worker']){
            $i=0;
            $sql_join .=' LEFT JOIN lab_workers ON lab_workers.lab_id=labs.lab_id';
            $sql_filters .=' AND (';
            $counter=count($ext_filters['lab_worker']);
                if ($counter==1){
                    $sql_filters .=' lab_workers.worker_id = '. $ext_filters['lab_worker'][0]->getValue();
                } else {
                    $prefix='';
                    for ($i=0;$i<$counter;$i++) {    
                        $sql_filters .=$prefix.' lab_workers.worker_id = '. $ext_filters['lab_worker'][$i]->getValue();
                        $prefix=' OR';
                    }
                } 
            $sql_filters .=' )';
        }
        //=sorting by other tables  	

         switch ($sort_field) {
             case 'region_edu_admin' :
                 $sort = new DSC(RegionEduAdminsExt::FIELD_NAME , $sort_mode);
                 $sql_join_order_name = " , region_edu_admins.name , school_units.name"; 
                 $sql_join_order = " LEFT JOIN region_edu_admins ON school_units.region_edu_admin_id=region_edu_admins.region_edu_admin_id";
                 $sql_join_order_field= RegionEduAdminsExt::buildSqlOrderByPublic($sort).', `school_units`.`name` ASC';
                 break;
             case 'edu_admin':
                $sort = new DSC(EduAdminsExt::FIELD_NAME , $sort_mode);
                $sql_join_order_name = " , edu_admins.name , school_units.name";
                $sql_join_order =" LEFT JOIN edu_admins ON school_units.edu_admin_id=edu_admins.edu_admin_id";
                $sql_join_order_field= EduAdminsExt::buildSqlOrderByPublic($sort).', `school_units`.`name` ASC';
                break;
             case 'transfer_area' :
                 $sort = new DSC(TransferAreasExt::FIELD_NAME , $sort_mode);
                 $sql_join_order_name = " , transfer_areas.name , school_units.name";
                 $sql_join_order =" LEFT JOIN transfer_areas ON school_units.transfer_area_id=transfer_areas.transfer_area_id";
                 $sql_join_order_field= TransferAreasExt::buildSqlOrderByPublic($sort).', `school_units`.`name` ASC';
                 break;
             case 'municipality' :
                 $sort = new DSC(MunicipalitiesExt::FIELD_NAME , $sort_mode);
                 $sql_join_order_name = " , municipalities.name , school_units.name";
                 $sql_join_order =" LEFT JOIN municipalities ON school_units.municipality_id=municipalities.municipality_id";
                 $sql_join_order_field= MunicipalitiesExt::buildSqlOrderByPublic($sort).', `school_units`.`name` ASC';
                 //$sql_join_order_field= " ORDER BY `municipalities`.`name` DESC, `school_units`.`name` ASC ";
                 break;
             case 'prefecture' :
                 $sort = new DSC(PrefecturesExt::FIELD_NAME , $sort_mode);
                 $sql_join_order_name = " , prefectures.name , school_units.name";
                 $sql_join_order =" LEFT JOIN prefectures ON school_units.prefecture_id=prefectures.prefecture_id";
                 $sql_join_order_field= PrefecturesExt::buildSqlOrderByPublic($sort).', `school_units`.`name` ASC';
                 break;
            case 'education_level' :
                $sort = new DSC(EducationLevelsExt::FIELD_NAME , $sort_mode);
                 $sql_join_order_name = " , education_levels.name , school_units.name"; 
                 $sql_join_order = " LEFT JOIN education_levels ON school_units.education_level_id=education_levels.education_level_id";
                 $sql_join_order_field= EducationLevelsExt::buildSqlOrderByPublic($sort).', `school_units`.`name` ASC';
                 break; 
             case 'school_unit_type' :
                 $sort = new DSC(SchoolUnitTypesExt::FIELD_NAME , $sort_mode);
                 $sql_join_order_name = " , school_unit_types.name , school_units.name"; 
                 $sql_join_order = " LEFT JOIN school_unit_types ON school_units.school_unit_type_id=school_unit_types.school_unit_type_id";
                 $sql_join_order_field= SchoolUnitTypesExt::buildSqlOrderByPublic($sort).', `school_units`.`name` ASC';
                 break;      
             default:
                if ($sort_field=="school_unit_id")
                    $sort = new DSC(SchoolUnitsExt::FIELD_SCHOOL_UNIT_ID , $sort_mode); 
                else if ($sort_field=="name")
                    $sort = new DSC(SchoolUnitsExt::FIELD_NAME , $sort_mode);
                $sql_join_order_name= "";
                $sql_join_order ="";
                $sql_join_order_field= self::buildSqlOrderBy($sort);
         }      
        
        $sql='SELECT DISTINCT school_units.school_unit_id'
                .$sql_join_order_name
                .' FROM school_units' 
                . $sql_join
                . $sql_join_order
                . $sql_prepend
                . self::buildSqlWhere($filter, $and, true, false)
                . $sql_filters
                . $sql_join_order_field;

        if (isset($count) && !isset($start)) $start = 0;
        if (isset($start) && isset($count))
                $sql .=' LIMIT '.$start.', '.$count;
        
     // echo $sql;    
        $stmt=self::prepareStatement($db, $sql);
        self::bindValuesForFilter($stmt, $filter);
      //return array("query"=>self::fromStatement($stmt), "data" =>  LabsExt::fromStatement($stmt));
        return self::fromStatement($stmt);
    }
    
    
    
    
 
//=========================================================================================================================================================================================
//    public static function findBySqlJoin(PDO $db, $filter, $ext_filters=null, $and=true, $sort=null) {
//    
//        if (!($filter instanceof DFCInterface)) 
//        {
//            $filter=new DFCAggregate($filter, $and);
//        }
//        
//        $sql_join =' LEFT JOIN labs ON school_units.school_unit_id=labs.school_unit_id ';
//        $sql_prepend=' WHERE ';
//        
//        if ($filter->count()!=0){
//        $sql_filters =' ' ;
//        } else {
//        $sql_filters ='1' ;
//        }
//
//            if ($ext_filters['lab_id']){
//             $i=0;
//             $sql_filters .=' AND (' ;
//             $counter=count($ext_filters['lab_id']);
//                 if ($counter==1){
//                    // $sql_filters .=' labs.lab_id LIKE CONCAT("%",'. $ext_filters['lab_id'][0]->getValue().',"%")';
//                     $sql_filters .=' labs.lab_id = '. $ext_filters['lab_id'][0]->getValue();
//                 } else {
//                     $prefix='';
//                     for ($i=0;$i<$counter;$i++) {    
//                    // $sql_filters .=$prefix.' labs.lab_id LIKE CONCAT("%",'. $ext_filters['lab_id'][$i]->getValue().',"%")';
//                        $sql_filters .=$prefix.' labs.lab_id = '. $ext_filters['lab_id'][$i]->getValue();
//                        $prefix=' OR';
//                     }
//                 } 
//             $sql_filters .=' )';
//            }    
//        
//            if ($ext_filters['lab_type']){
//             $i=0;
//             $sql_filters .=' AND (' ;
//             $counter=count($ext_filters['lab_type']);
//                 if ($counter==1){
//                     $sql_filters .=' labs.lab_type_id = '. $ext_filters['lab_type'][0]->getValue();
//                 } else {
//                     $prefix='';
//                     for ($i=0;$i<$counter;$i++) {    
//                        $sql_filters .=$prefix.' labs.lab_type_id = '. $ext_filters['lab_type'][$i]->getValue();
//                        $prefix=' OR';
//                     }
//                 } 
//             $sql_filters .=' )';
//            }     
//        
//            if ($ext_filters['aquisition_source']){
//                   $i=0;
//                   $sql_join .=' LEFT JOIN labs_have_aquisition_sources ON labs_have_aquisition_sources.lab_id=labs.lab_id';
//                   $sql_filters .=' AND (';
//                   $counter=count($ext_filters['aquisition_source']);
//                       if ($counter==1){
//                           $sql_filters .=' labs_have_aquisition_sources.aquisition_source_id = '. $ext_filters['aquisition_source'][0]->getValue();
//                       } else {
//                           $prefix='';
//                           for ($i=0;$i<$counter;$i++) {    
//                                $sql_filters .=$prefix.' labs_have_aquisition_sources.aquisition_source_id = '. $ext_filters['aquisition_source'][$i]->getValue();
//                                $prefix =' OR';
//                           }
//                       } 
//                   $sql_filters .=' )';
//            } 
//
//            if ($ext_filters['equipment_type']){
//                $i=0;
//                $sql_join .=' LEFT JOIN labs_have_equipment_types ON labs_have_equipment_types.lab_id=labs.lab_id';
//                $sql_filters .=' AND (';
//                $counter=count($ext_filters['equipment_type']);
//                    if ($counter==1){
//                        $sql_filters .=' labs_have_equipment_types.equipment_type_id = '. $ext_filters['equipment_type'][0]->getValue();
//                    } else {
//                        $prefix='';
//                        for ($i=0;$i<$counter;$i++) {    
//                            $sql_filters .=$prefix.' labs_have_equipment_types.equipment_type_id = '. $ext_filters['equipment_type'][$i]->getValue();
//                            $prefix=' OR';
//                        }
//                    } 
//                $sql_filters .=' )';
//            } 
//            
//             
//        $sql='SELECT DISTINCT school_units.school_unit_id FROM school_units' 
//                . $sql_join
//                . $sql_prepend
//                . self::buildSqlWhere($filter, $and, true, false)
//                . $sql_filters
//                . self::buildSqlOrderBy($sort);
//            
//        $stmt=self::prepareStatement($db, $sql);
//        self::bindValuesForFilter($stmt, $filter);
//        return self::fromStatement($stmt);                
//        
//    }
  
//=========================================================================================================================================================================================
//   public static function findBySqlJoinWithLimit_old(PDO $db, $filter, $ext_filters=null, $and=true, $sort=null, $start=null, $count=null) {
//
//        if (!($filter instanceof DFCInterface)) 
//        {
//            $filter=new DFCAggregate($filter, $and);
//        }
//        
//        /*
//            if ($lab_type_filters){
//                $i=0;
//                $sql_filters .=' AND (' ;
//                $counter=count($lab_type_filters);
//                    if ($counter==1){
//                        $sql_filters .=' labs.lab_type_id = '. $lab_type_filters[0]->getValue();
//                    } else {
//                        for ($i=0;$i<$counter;$i++) {    
//                        $sql_filters .=' labs.lab_type_id = '. $lab_type_filters[$i]->getValue().' OR';
//                        }
//                    } 
//                $sql_filters .=' )';
//            }
//          
//            if ($aquisition_filters){
//                   $i=0;
//                   $sql_join .=' LEFT JOIN labs_have_aquisition_sources ON labs_have_aquisition_sources.lab_id=labs.lab_id';
//                   $filter ? $sql_filters .=' AND (' : $sql_filters .=' (';
//                   $counter=count($aquisition_filters);
//                       if ($counter==1){
//                           $sql_filters .=' labs_have_aquisition_sources.aquisition_source_id = '. $aquisition_filters[0]->getValue();
//                       } else {
//                           for ($i=0;$i<$counter;$i++) {    
//                           $sql_filters .=' labs_have_aquisition_sources.aquisition_source_id = '. $aquisition_filters[$i]->getValue().' OR';
//                           }
//                       } 
//                   $sql_filters .=' )';
//               }
//
//            if ($equipment_type_filters){
//                $i=0;
//                $sql_join .=' LEFT JOIN labs_have_equipment_types ON labs_have_equipment_types.lab_id=labs.lab_id';
//                $sql_filters .=' AND (';
//                $counter=count($equipment_type_filters);
//                    if ($counter==1){
//                        $sql_filters .=' labs_have_equipment_types.equipment_type_id = '. $equipment_type_filters[0]->getValue();
//                    } else {
//                        for ($i=0;$i<$counter;$i++) {    
//                        $sql_filters .=' labs_have_equipment_types.equipment_type_id = '. $equipment_type_filters[$i]->getValue().' OR';
//                        }
//                    } 
//                $sql_filters .=' )';
//            }
//          
//          */ 
//        
//        $sql_join =' LEFT JOIN labs ON school_units.school_unit_id=labs.school_unit_id ';
//        $sql_prepend=' WHERE ';
//        
//        if ($filter->count()!=0){
//        $sql_filters =' ' ;
//        } else {
//        $sql_filters ='1' ;
//        }
//
//            if ($ext_filters['lab_type']){
//             $i=0;
//             $sql_filters .=' AND (' ;
//             $counter=count($ext_filters['lab_type']);
//                 if ($counter==1){
//                     $sql_filters .=' labs.lab_type_id = '. $ext_filters['lab_type'][0]->getValue();
//                 } else {
//                     $prefix='';
//                     for ($i=0;$i<$counter;$i++) {    
//                     $sql_filters .=$prefix.' labs.lab_type_id = '. $ext_filters['lab_type'][$i]->getValue();
//                     $prefix=' OR';
//                     }
//                 } 
//             $sql_filters .=' )';
//            }     
//        
//            if ($ext_filters['aquisition_source']){
//                   $i=0;
//                   $sql_join .=' LEFT JOIN labs_have_aquisition_sources ON labs_have_aquisition_sources.lab_id=labs.lab_id';
//                   $sql_filters .=' AND (';
//                   $counter=count($ext_filters['aquisition_source']);
//                       if ($counter==1){
//                           $sql_filters .=' labs_have_aquisition_sources.aquisition_source_id = '. $ext_filters['aquisition_source'][0]->getValue();
//                       } else {
//                           for ($i=0;$i<$counter;$i++) {    
//                           $sql_filters .=' labs_have_aquisition_sources.aquisition_source_id = '. $ext_filters['aquisition_source'][$i]->getValue().' OR';
//                           }
//                       } 
//                   $sql_filters .=' )';
//            } 
//
//            if ($ext_filters['equipment_type']){
//                $i=0;
//                $sql_join .=' LEFT JOIN labs_have_equipment_types ON labs_have_equipment_types.lab_id=labs.lab_id';
//                $sql_filters .=' AND (';
//                $counter=count($ext_filters['equipment_type']);
//                    if ($counter==1){
//                        $sql_filters .=' labs_have_equipment_types.equipment_type_id = '. $ext_filters['equipment_type'][0]->getValue();
//                    } else {
//                        $prefix='';
//                        for ($i=0;$i<$counter;$i++) {    
//                        $sql_filters .=$prefix.' labs_have_equipment_types.equipment_type_id = '. $ext_filters['equipment_type'][$i]->getValue();
//                        $prefix=' OR';
//                        }
//                    } 
//                $sql_filters .=' )';
//            } 
//            
//             
//        $sql='SELECT DISTINCT school_units.school_unit_id  FROM school_units' 
//                . $sql_join
//                . $sql_prepend
//                . self::buildSqlWhere($filter, $and, true, false)
//                . $sql_filters
//                . self::buildSqlOrderBy($sort);
//        
//        if (isset($count) && !isset($start)) $start = 0;
//        if (isset($start) && isset($count))
//                $sql .=' LIMIT '.$start.', '.$count;
//      //echo $sql;    
//        $stmt=self::prepareStatement($db, $sql);
//        self::bindValuesForFilter($stmt, $filter);
//      //return array("query"=>self::fromStatement($stmt), "data" =>"test");
//        return self::fromStatement($stmt);
//    }
  
//=========================================================================================================================================================================================
//      public static function findBySqlJoinWithLimit(PDO $db, $filter, $ext_filters=null, $and=true, $sort=null, $start=null, $count=null) {
//
//        if (!($filter instanceof DFCInterface)) 
//        {
//            $filter=new DFCAggregate($filter, $and);
//        }
//        
//        /*
//            if ($lab_type_filters){
//                $i=0;
//                $sql_filters .=' AND (' ;
//                $counter=count($lab_type_filters);
//                    if ($counter==1){
//                        $sql_filters .=' labs.lab_type_id = '. $lab_type_filters[0]->getValue();
//                    } else {
//                        for ($i=0;$i<$counter;$i++) {    
//                        $sql_filters .=' labs.lab_type_id = '. $lab_type_filters[$i]->getValue().' OR';
//                        }
//                    } 
//                $sql_filters .=' )';
//            }
//          
//            if ($aquisition_filters){
//                   $i=0;
//                   $sql_join .=' LEFT JOIN labs_have_aquisition_sources ON labs_have_aquisition_sources.lab_id=labs.lab_id';
//                   $filter ? $sql_filters .=' AND (' : $sql_filters .=' (';
//                   $counter=count($aquisition_filters);
//                       if ($counter==1){
//                           $sql_filters .=' labs_have_aquisition_sources.aquisition_source_id = '. $aquisition_filters[0]->getValue();
//                       } else {
//                           for ($i=0;$i<$counter;$i++) {    
//                           $sql_filters .=' labs_have_aquisition_sources.aquisition_source_id = '. $aquisition_filters[$i]->getValue().' OR';
//                           }
//                       } 
//                   $sql_filters .=' )';
//               }
//
//            if ($equipment_type_filters){
//                $i=0;
//                $sql_join .=' LEFT JOIN labs_have_equipment_types ON labs_have_equipment_types.lab_id=labs.lab_id';
//                $sql_filters .=' AND (';
//                $counter=count($equipment_type_filters);
//                    if ($counter==1){
//                        $sql_filters .=' labs_have_equipment_types.equipment_type_id = '. $equipment_type_filters[0]->getValue();
//                    } else {
//                        for ($i=0;$i<$counter;$i++) {    
//                        $sql_filters .=' labs_have_equipment_types.equipment_type_id = '. $equipment_type_filters[$i]->getValue().' OR';
//                        }
//                    } 
//                $sql_filters .=' )';
//            }
//          
//          */ 
//        
//        $sql_join =' LEFT JOIN labs ON school_units.school_unit_id=labs.school_unit_id ';
//        $sql_prepend=' WHERE ';
//        
//        if ($filter->count()!=0){
//        $sql_filters =' ' ;
//        } else {
//        $sql_filters ='1' ;
//        }
//
//            if ($ext_filters['lab_id']){
//             $i=0;
//             $sql_filters .=' AND (' ;
//             $counter=count($ext_filters['lab_id']);
//                 if ($counter==1){
//                     $sql_filters .=' labs.lab_id = '. $ext_filters['lab_id'][0]->getValue();
//                 } else {
//                     $prefix='';
//                     for ($i=0;$i<$counter;$i++) {    
//                     $sql_filters .=$prefix.' labs.lab_id = '. $ext_filters['lab_id'][$i]->getValue();
//                     $prefix=' OR';
//                     }
//                 } 
//             $sql_filters .=' )';
//            }    
//        
//            if ($ext_filters['lab_type']){
//             $i=0;
//             $sql_filters .=' AND (' ;
//             $counter=count($ext_filters['lab_type']);
//                 if ($counter==1){
//                     $sql_filters .=' labs.lab_type_id = '. $ext_filters['lab_type'][0]->getValue();
//                 } else {
//                     $prefix='';
//                     for ($i=0;$i<$counter;$i++) {    
//                     $sql_filters .=$prefix.' labs.lab_type_id = '. $ext_filters['lab_type'][$i]->getValue();
//                     $prefix=' OR';
//                     }
//                 } 
//             $sql_filters .=' )';
//            }     
//        
//            if ($ext_filters['aquisition_source']){
//                   $i=0;
//                   $sql_join .=' LEFT JOIN labs_have_aquisition_sources ON labs_have_aquisition_sources.lab_id=labs.lab_id';
//                   $sql_filters .=' AND (';
//                   $counter=count($ext_filters['aquisition_source']);
//                       if ($counter==1){
//                           $sql_filters .=' labs_have_aquisition_sources.aquisition_source_id = '. $ext_filters['aquisition_source'][0]->getValue();
//                       } else {
//                           $prefix='';
//                           for ($i=0;$i<$counter;$i++) {    
//                           $sql_filters .=$prefix.' labs_have_aquisition_sources.aquisition_source_id = '. $ext_filters['aquisition_source'][$i]->getValue();
//                           $prefix =' OR';
//                           }
//                       } 
//                   $sql_filters .=' )';
//            } 
//
//            if ($ext_filters['equipment_type']){
//                $i=0;
//                $sql_join .=' LEFT JOIN labs_have_equipment_types ON labs_have_equipment_types.lab_id=labs.lab_id';
//                $sql_filters .=' AND (';
//                $counter=count($ext_filters['equipment_type']);
//                    if ($counter==1){
//                        $sql_filters .=' labs_have_equipment_types.equipment_type_id = '. $ext_filters['equipment_type'][0]->getValue();
//                    } else {
//                        $prefix='';
//                        for ($i=0;$i<$counter;$i++) {    
//                        $sql_filters .=$prefix.' labs_have_equipment_types.equipment_type_id = '. $ext_filters['equipment_type'][$i]->getValue();
//                        $prefix=' OR';
//                        }
//                    } 
//                $sql_filters .=' )';
//            } 
//            
//       //=sorting by other tables  	
//      // $sql_join_order =' LEFT JOIN school_unit_types ON school_units.school_unit_type_id=school_unit_types.school_unit_type_id';
//      //  $sql_join_order =' LEFT JOIN municipalities ON school_units.municipality_id=municipalities.municipality_id';     
//     //  SchoolUnitTypesExt::buildSqlOrderBy($sort);
//      // $sql_type=' ASC';
//      // $sql_order_by=' ORDER BY school_unit_types.name'.$sql_type; 
//        
//        $sql='SELECT DISTINCT school_units.school_unit_id , municipalities.name  FROM school_units' 
//                . $sql_join
//                . $sql_join_order
//                . $sql_prepend
//                . self::buildSqlWhere($filter, $and, true, false)
//                . $sql_filters
//                
//                . self::buildSqlOrderBy($sort);
//               // .  MunicipalitiesExt::buildSqlOrderByPublic($sort);
//                   // .$sql_order_by;
//                
//        if (isset($count) && !isset($start)) $start = 0;
//        if (isset($start) && isset($count))
//                $sql .=' LIMIT '.$start.', '.$count;
//        
//       // echo $sql;    
//        $stmt=self::prepareStatement($db, $sql);
//        self::bindValuesForFilter($stmt, $filter);
//     //   return array("query"=>self::fromStatement($stmt), "data" =>  LabsExt::fromStatement($stmt));
//        return self::fromStatement($stmt);
//    }
    
//=========================================================================================================================================================================================

    
}


?>