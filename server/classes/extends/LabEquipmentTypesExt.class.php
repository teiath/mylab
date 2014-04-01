<?php

/**
*
* @version 1.0
* @author  ΤΕΙ Αθήνας
* @package api\classes\extends
*/

require_once('classes/models/LabEquipmentTypes.class.php');

class LabEquipmentTypesExt extends LabEquipmentTypes {
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
            self::$rowsArray[$obj->getLabId()] = $obj->getLabId(); 
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
            self::$rowsArray[$obj->getLabId()] = $obj->getLabId(); 
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
   
        
        
        
        
    public static function findByFilterBeta(PDO $db, $filter, $ext_filters, $and=true, $sort=null, $start=null, $count=null) 
    {
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
        
        if ($ext_filters['equipment_categories']){
               $i=0;
               $sql_join .=' LEFT JOIN `equipment_types` ON equipment_types.equipment_type_id=lab_equipment_types.equipment_type_id LEFT JOIN `equipment_categories` ON equipment_categories.equipment_category_id=equipment_types.equipment_category_id';
               $sql_filters .=' AND (';
               $counter=count($ext_filters['equipment_categories']);
                   if ($counter==1){
                       $sql_filters .=' equipment_categories.equipment_category_id = '. $ext_filters['equipment_categories'][0]->getValue();
                   } else {
                       $prefix='';
                       for ($i=0;$i<$counter;$i++) {    
                            $sql_filters .=$prefix.' equipment_categories.equipment_category_id = '. $ext_filters['equipment_categories'][$i]->getValue();
                            $prefix =' OR';
                       }
                   } 
               $sql_filters .=' )';
           }  

//                             lab_equipment_types.lab_id as lab_id,
//                             lab_equipment_types.equipment_type_id as lab_equipment_type_id,
//                             lab_equipment_types.items as items,
//                             equipment_types.equipment_type_id as equipment_type_id,
//                             equipment_types.name as equipment_type_name,
//                             equipment_types.equipment_category_id as equipment_type_category_id,
//                             equipment_categories.equipment_category_id as equipment_category_id,
//                             equipment_categories.name as equipment_category_name
		$sql='SELECT *'
                .' FROM `'.self::SQL_TABLE_NAME.'`'
                .$sql_join
                .$sql_prepend
                .self::buildSqlWhere($filter, $and, true, false)
                .$sql_filters;
                
		//. self::buildSqlWhere($filter, $and, false, true)
		//. self::buildSqlOrderBy($sort);

        if (isset($start) && isset($count))
            $sql .=' LIMIT '.$start.', '.$count;
        
		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

        
        
        
        
        
        
        
        
        
        
        
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

    public static function findByFilterJoinAsCount(PDO $db, $filter, $ext_filters, $and=true) 
    {
        $fieldNames = array_values(self::getFieldNames());

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
        
        if ($ext_filters['equipment_categories']){
            $i=0;
            $sql_join .=' LEFT JOIN `equipment_types` ON equipment_types.equipment_type_id=lab_equipment_types.equipment_type_id LEFT JOIN `equipment_categories` ON equipment_categories.equipment_category_id=equipment_types.equipment_category_id';
            $sql_filters .=' AND (';
            $counter=count($ext_filters['equipment_categories']);
                if ($counter==1){
                    $sql_filters .=' equipment_categories.equipment_category_id = '. $ext_filters['equipment_categories'][0]->getValue();
                } else {
                    $prefix='';
                    for ($i=0;$i<$counter;$i++) {    
                         $sql_filters .=$prefix.' equipment_categories.equipment_category_id = '. $ext_filters['equipment_categories'][$i]->getValue();
                         $prefix =' OR';
                    }
                } 
            $sql_filters .=' )';
        }    
        
        $sql='SELECT count(*) as '.$fieldNames[0].' FROM `'.self::SQL_TABLE_NAME.'`'
                . $sql_join
                . $sql_prepend
                . self::buildSqlWhere($filter, $and, true, false)
                . $sql_filters; 
        //. self::buildSqlWhere($filter, $and, false, true);

        $stmt=self::prepareStatement($db, $sql);
        self::bindValuesForFilter($stmt, $filter);
 
        return self::fromStatement($stmt);
    }
    
    public static function updateByFilter(PDO $db, $filter, $update_field, $and=true ) 
    {
        $updateFilters=array();
        $fieldNames = array_values(self::getFieldNames());
        
        if (!($filter instanceof DFCInterface)) {
            $filter=new DFCAggregate($filter, $and);
        }
                
        if (Validator::IsValue($update_field))
            $updatedFields = Validator::ToArray($update_field);
        else if (Validator::IsArray($update_field))
            $updatedFields = Validator::ToArray($update_field);
        else 
            throw new Exception;

        foreach ($updatedFields as $updatedField){
            
            if (Validator::IsArray($updatedField,'=')) {                
                $fUpdatedField  = Validator::ToArray($updatedField,'=');
            
                if (in_array($fUpdatedField[0], $fieldNames, true))  
                    $updateFilters[] = self::SQL_TABLE_NAME.'.'.$fUpdatedField[0] . '=' . $fUpdatedField[1];
                else
                    throw new Exception;
                
            } else 
                throw new Exception;
        }
        $implode_fields=implode(", ", $updateFilters);
        
        $sql='UPDATE '.self::SQL_TABLE_NAME.' SET '
        . $implode_fields
        . self::buildSqlWhere($filter, $and, true, true);
       echo $sql;
        
        $stmt=self::prepareStatement($db, $sql);
        self::bindValuesForFilter($stmt, $filter);
        return self::fromStatement($stmt);
    }
    
    public function insertIntoArray()
    {
        self::$rowsArray[$this->getLabId()] = $this->getLabId(); 
        self::$objsArray[$this->getLabId()] = $this; 
    }
    
    /**
     * check if this instance exists in the database with DFC::EXACT 
     *
     * @param PDO $db
     * @return bool
     */              
    public function existsInDatabase(PDO $db) {
            $filter=array();
            foreach ($this->getPrimaryKeyValues() as $fieldId=>$value) {
                    $filter[]=new DFC($fieldId, $value, DFC::EXACT);
            }
            return 0!=count(self::findByFilter($db, $filter, true));
    }
}

?>