<?php

/**
*
* @version 1.0
* @author  ΤΕΙ Αθήνας
* @package api\classes\extends
*/

require_once('classes/models/Labs.class.php');

class LabsExt extends Labs {
    
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
        
    public static function getAll(PDO $db, $filter, $and=true, $sort=null) 
    {
        self::$rowsArray = array();
        self::$objsArray = array();
        
        $objs = self::findByFilter($db, $filter, $and, $sort);

        foreach($objs as $obj)
        {
            self::$rowsArray[$obj->getLabId()] = $obj->getName(); 
            self::$objsArray[$obj->getLabId()] = $obj; 
        }
    }
    
    public static function getAllWithLimit(PDO $db, $filter, $and=true, $sort=null, $start=null, $count=null) 
    {
        self::$rowsArray = array();
        self::$objsArray = array();
        
        $objs = self::findByFilterWithLimit($db, $filter, $and, $sort, $start, $count);

        foreach($objs as $obj)
        {
            self::$rowsArray[$obj->getLabId()] = $obj->getName(); 
            self::$objsArray[$obj->getLabId()] = $obj; 
        }
    }
    
    public function searchArrayForID($id)
    {
        $obj = self::$objsArray[$id];
        
        if ($obj)
            $this->assignByArray($obj->toArray());
        else
            $this->assignDefaultValues ();
        
        return $this;
    }
    
    public function searchArrayForValue($name)
    {
        $id = array_search($name, $this->getRowsArray());
        
        $obj = self::$objsArray[$id];
        
        if ($obj)
        {
            $this->assignByArray($obj->toArray());
        }
        
        return $this;
    }
 
//=========================================================================================================================================================================================

    public static function findByFilterWithLimit(PDO $db, $filter, $and=true, $sort=null, $start=null, $count=null) 
    {
        if (!($filter instanceof DFCInterface)) 
        {
            $filter=new DFCAggregate($filter, $and);
        }
        $sql='SELECT * FROM `'.self::SQL_TABLE_NAME.'`'
        . self::buildSqlWhere($filter, $and, false, true)
        . self::buildSqlOrderBy($sort);

        if (isset($start) && isset($count))
            $sql .=' LIMIT '.$start.', '.$count;
        
		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
    }
  
//=========================================================================================================================================================================================

    public static function findByFilterBeta(PDO $db, $filter, $ext_filters=null, $and=true, $sort_field=null, $sort_mode=null, $start=null, $count=null) 
    {
        
        global $Options;
        if (!($filter instanceof DFCInterface)) 
        {
            $filter=new DFCAggregate($filter, $and);
        }
        
        $sql_join='';
        $sql_prepend=' WHERE ';

        if ($filter->count()!=0){
        $sql_filters ='';
        } else {
        $sql_filters =' 1 ';
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
               
        switch ($sort_field) {
             case 'lab_type' :
                 $sort = new DSC(LabTypesExt::FIELD_NAME , $sort_mode);
                 $sql_join_order_name = ", lab_types.name as lab_type_name "; 
                 $sql_join_order = " LEFT JOIN lab_types ON lab_types.lab_type_id=labs.lab_type_id";
                 $sql_join_order_field= LabTypesExt::buildSqlOrderByPublic($sort).', `labs`.`name` ASC';
                 break;
             case 'school_unit':
                $sort = new DSC(SchoolUnitsExt::FIELD_NAME , $sort_mode);
                $sql_join_order_name = ", school_units.name as shool_unit_name";
                $sql_join_order =" LEFT JOIN school_units ON labs.school_unit_id=school_units.school_unit_id";
                $sql_join_order_field= SchoolUnitsExt::buildSqlOrderByPublic($sort).', `labs`.`name` ASC';
                break;
            default:
//            if ($sort_field=="lab_id")
//                $sort = new DSC(LabsExt::FIELD_LAB_ID , $sort_mode); 
//            else if ($sort_field=="name")
//                $sort = new DSC(LabsExt::FIELD_NAME , $sort_mode);
//            else if ($sort_field=="creation_date")
//                $sort = new DSC(LabsExt::FIELD_CREATION_DATE , $sort_mode);
      
        $columns = LabsExt::getFieldNames();
        $key = array_search ($sort_field, $columns);
        $sort = new DSC($key , $sort_mode);                   
                
           
            $sql_join_order_name= "";
            $sql_join_order ="";
            $sql_join_order_field= self::buildSqlOrderBy($sort);
         } 
        
//        $sql='SELECT * FROM `'.self::SQL_TABLE_NAME.'`'
//        . self::buildSqlWhere($filter, $and, false, true)
//        . self::buildSqlOrderBy($sort);
        
         $sql='SELECT DISTINCT labs.lab_id, labs.name, labs.special_name, labs.creation_date, labs.created_by, labs.last_updated , labs.updated_by , labs.positioning , labs.comments, labs.operational_rating, labs.technological_rating, labs.lab_type_id, labs.school_unit_id, labs.state_id, labs.lab_source_id'
                .$sql_join_order_name
                .' FROM `'.self::SQL_TABLE_NAME.'`'
                .$sql_join
                .$sql_join_order
                .$sql_prepend
                .self::buildSqlWhere($filter, $and, true, false)
                .$sql_filters
                .$sql_join_order_field;

//        if (isset($count) && !isset($start)) $start = 0;
//        if (isset($start) && isset($count) && $count!=0)
//            $sql .=' LIMIT '.$start.', '.$count;
//        if ($count && ($count <> $Options["AllPageSize"]))
//        {
//            $start = $start ? ($start - 1) * $count : 0;
//            $sql .=' LIMIT '.$start.', '.$count;
//        }
//        
        if (isset($count) && !isset($start)) $start = 0;
        if (isset($start) && isset($count))
                $sql .=' LIMIT '.$start.', '.$count;
         
 // $sql .=' LIMIT '.$start.', '.$count;      

        $stmt=self::prepareStatement($db, $sql);
        self::bindValuesForFilter($stmt, $filter);
        return self::fromStatement($stmt);
    }
    

//=========================================================================================================================================================================================

    public static function findByFilterAsCount(PDO $db, $filter, $and=true) 
    {
        $fieldNames = array_values(self::getFieldNames());

        if (!($filter instanceof DFCInterface)) 
        {
            $filter=new DFCAggregate($filter, $and);
        }
        $sql='SELECT count(*) as '.$fieldNames[0].' FROM `'.self::SQL_TABLE_NAME.'`'
        . self::buildSqlWhere($filter, $and, false, true);

        $stmt=self::prepareStatement($db, $sql);
        self::bindValuesForFilter($stmt, $filter);
 
        return self::fromStatement($stmt);
    }
 
//=========================================================================================================================================================================================

    
    public static function findByFilterJoinAsCount(PDO $db, $filter, $ext_filters=null, $and=true) 
    {

        if (!($filter instanceof DFCInterface)) 
        {
            $filter=new DFCAggregate($filter, $and);
        }
        
        $sql_join ='';
        $sql_prepend=' WHERE ';

        if ($filter->count()!=0){
        $sql_filters ='' ;
        } else {
        $sql_filters =' 1 ' ;
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

        //$sql='SELECT count(*) as '.$fieldNames[0].' FROM `'.self::SQL_TABLE_NAME.'`'
        $sql='SELECT count(DISTINCT labs.lab_id) as '.$fieldNames[0].' FROM `'.self::SQL_TABLE_NAME.'`'
                . $sql_join
                . $sql_prepend
                . self::buildSqlWhere($filter, $and, true, false)
                . $sql_filters; 

        $stmt=self::prepareStatement($db, $sql);
        self::bindValuesForFilter($stmt, $filter);
        return self::fromStatement($stmt);
    }

//=========================================================================================================================================================================================

    public static function findBySqlJoinAsLabsCount (PDO $db, $filter, $ext_filters=null, $and=true , $oLabTypes=null) {

    if (!($filter instanceof DFCInterface)) 
    {
        $filter=new DFCAggregate($filter, $and);
    }
    
    foreach ($oLabTypes->getRowsArray() as $lab_type_id=>$lab_type_name) {
            $sql_array[$lab_type_id]=$lab_type_name;
            $sql_count_if[] =' COUNT(if(tb1.lab_type_id = '.$lab_type_id.', 1, null)) AS count_lab_type_'.$lab_type_id;
        }
    
    $sql_count_if = implode(",", $sql_count_if);
    $sql_join=' ';
    //$sql_join =' LEFT JOIN school_units ON school_units.school_unit_id=labs.school_unit_id ';
    $sql_prepend=' WHERE ';

    if ($filter->count()!=0){
    $sql_filters =" ";
    } else {
    $sql_filters =' 1 ';
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
    
    
//    $filter_new = self::buildSqlWhere($filter, $and, true, true);

//    $sql='SELECT' 
//         . $sql_count_if  
//         .' FROM `'.self::SQL_TABLE_NAME.'`'
//         .$filter_new;
       
    //$filter_new = self::buildSqlWhere($filter, $and, true, false);
     $sql='SELECT'
            . $sql_count_if
            .' FROM ( SELECT DISTINCT labs.lab_id,labs.lab_type_id'
            .' FROM `'.self::SQL_TABLE_NAME.'`'
            . $sql_join
            . $sql_prepend
            //. $filter_new
            . self::buildSqlWhere($filter, $and, true, false)
            . $sql_filters
            .' ) AS tb1';
 //echo $sql;
    $stmt=self::prepareStatement($db, $sql);
    self::bindValuesForFilter($stmt, $filter);
    $all_labs_counts = self::fromExecutedStatementCountLabs($stmt,$sql_array);
 
    return $all_labs_counts;

    } 
 
//=========================================================================================================================================================================================

    public static function findBySqlJoinAsLabsCountNull (PDO $db, $oLabTypes=null) {
    
    //$oLabs=new LabTypesExt($db);
   // $arr=$oLabs->getRowsArray();
           
    foreach ($oLabTypes->getRowsArray() as $lab_type_name) {
        $sql_array[$lab_type_name] = '0';      
    }

    return $sql_array;
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

    public function insertIntoArray()
    {
        self::$rowsArray[$this->getLabId()] = $this->getName(); 
        self::$objsArray[$this->getLabId()] = $this; 
    }

//=========================================================================================================================================================================================

    public static function findByIDs(PDO $db, $ids) 
    {
        $fieldNames = array_values(self::getFieldNames());
        
        $sql='SELECT * FROM `'
                .self::SQL_TABLE_NAME.'`'
              //  .self::buildSqlWhere($filter, $and, false, true)
                .' WHERE '.$fieldNames[0].' in ('.$ids.')';
            //echo $sql;
		$stmt=$db->query($sql);
		return self::fromExecutedStatement($stmt);
    }

//=========================================================================================================================================================================================

         public static function findLabTypes($arrayLabs) 
    {
        
        $lab["counter_lab_types"][] = array();
        $data["count_labs_sepey"]=0;
        $data["count_labs_troxilato"]=0;
        $data["count_labs_general"]=0;
        $data["count_labs_gwnia"]=0;
        $data["count_labs_allo"]=0;
        $data["count_null"]=0;
        $data["count_false_value"]=0;
                
        foreach ($arrayLabs as $arrayLab) {
            if ($arrayLab->getLabTypeId()==1){
                $data["count_labs_sepey"]++; 
            } else if ($arrayLab->getLabTypeId()==2) {
                $data["count_labs_troxilato"]++; 
            } else if ($arrayLab->getLabTypeId()==3) {
                $data["count_labs_general"]++; 
            } else if ($arrayLab->getLabTypeId()==4) {
                $data["count_labs_gwnia"]++; 
            } else if ($arrayLab->getLabTypeId()==5){
                $data["count_labs_allo"]++; 
            } else if ($arrayLab->getLabTypeId()==null){
                $data["count_labs_null"]++; 
            } else {
                $data["count_false_value"]++; 
            }
        }
          
	return $lab["counter_lab_types"][]=$data; 
    }   
            
}
?>