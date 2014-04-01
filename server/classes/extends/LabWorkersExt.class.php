<?php

/**
*
* @version 1.0
* @author  ΤΕΙ Αθήνας
* @package api\classes\extends
*/

require_once('classes/models/LabWorkers.class.php');

class LabWorkersExt extends LabWorkers {
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
            self::$rowsArray[$obj->getLabWorkerId()] = $obj->getLabWorkerId(); 
            self::$objsArray[$obj->getLabWorkerId()] = $obj;
        }
    }
      
    public static function getAllWithLimit(PDO $db, $filter, $and=true, $sort=null, $start=null, $count=null) 
    {
        self::$rowsArray = array();
        self::$objsArray = array();
        
        $objs = self::findByFilterWithLimit($db, $filter, $and, $sort, $start, $count);

        foreach($objs as $obj)
        {
            self::$rowsArray[$obj->getLabWorkerId()] = $obj->getLabWorkerId(); 
            self::$objsArray[$obj->getLabWorkerId()] = $obj;
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

    public static function updateByFilter(PDO $db, $update_field, $filter, $and=true ) 
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
                
        $sql='UPDATE '.self::SQL_TABLE_NAME.' SET '
        . implode(", ", $updateFilters)
        . self::buildSqlWhere($filter, $and, true, true);
        //echo $sql;
        
        $stmt=self::prepareStatement($db, $sql);
        self::bindValuesForFilter($stmt, $filter);
        return self::fromStatement($stmt);
    }
    
    
    public function insertIntoArray()
    {
        self::$rowsArray[$this->getLabWorkerId()] = $this->getLabWorkerId(); 
        self::$objsArray[$this->getLabWorkerId()] = $this;
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