<?php

/**
*
* @version 1.0
* @author  ΤΕΙ Αθήνας
* @package api\classes\extends
*/

//require_once('classes/models/States.class.php');
//
//class StatesExt extends States
//{
//    private static $rowsArray ;
//    private static $objsArray ;
//        
//    public function __construct(PDO $db) 
//    {
//        if ( ( ! is_array( self::$rowsArray ) ) && $db ) 
//        {
//           //self::getAll($db, null);
//        }
//    }
//
//    public function getRowsArray() 
//    {
//        return self::$rowsArray;
//    }
//        
//    public function getObjsArray() 
//    {
//        return self::$objsArray;
//    }
//    
//    public static function buildSqlOrderByPublic($sort)
//    {
//     return self::buildSqlOrderBy($sort); 
//    }
//        
//    public static function getAll(PDO $db, $filter, $and=true, $sort=null) 
//    {
//        self::$rowsArray = array();
//        self::$objsArray = array();
//        
//        $objs = self::findByFilter($db, $filter, $and, $sort);
//
//        foreach($objs as $obj)
//        {
//            self::$rowsArray[$obj->getStateId()] = $obj->getName(); 
//            self::$objsArray[$obj->getStateId()] = $obj; 
//        }
//    }
//    
//    public static function getAllWithLimit(PDO $db, $filter, $and=true, $sort=null, $start=null, $count=null) 
//    {
//        self::$rowsArray = array();
//        self::$objsArray = array();
//        
//        $objs = self::findByFilterWithLimit($db, $filter, $and, $sort, $start, $count);
//
//        foreach($objs as $obj)
//        {
//            self::$rowsArray[$obj->getStateId()] = $obj->getName(); 
//            self::$objsArray[$obj->getStateId()] = $obj; 
//        }
//    }
//    
//    public function searchArrayForID($id)
//    {
//        $obj = self::$objsArray[$id];
//        
//        if ($obj)
//            $this->assignByArray($obj->toArray());
//        else
//            $this->assignDefaultValues ();
//        
//        return $this;
//    }
//    
//    public function searchArrayForValue($name)
//    {
//        $id = array_search($name, $this->getRowsArray());
//        
//        $obj = self::$objsArray[$id];
//        
//        if ($obj)
//        {
//            $this->assignByArray($obj->toArray());
//        }
//        
//        return $this;
//    }
//    
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
//        if (isset($start) && isset($count))
//            $sql .=' LIMIT '.$start.', '.$count;
//        
//		$stmt=self::prepareStatement($db, $sql);
//		self::bindValuesForFilter($stmt, $filter);
//		return self::fromStatement($stmt);
//	}
//
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
//
//    public function insertIntoArray()
//    {
//        self::$rowsArray[$this->getStateId()] = $this->getName(); 
//        self::$objsArray[$this->getStateId()] = $this; 
//    }
//    
//    public function existsInDatabase(PDO $db) {
//            $filter=array();
//            foreach ($this->getPrimaryKeyValues() as $fieldId=>$value) {
//                    $filter[]=new DFC($fieldId, $value, DFC::EXACT);
//            }
//            return 0!=count(self::findByFilter($db, $filter, true));
//    }
//}

require_once('classes/models/States.class.php');

class StatesExt extends States
{
    private $rowsArray ;
    private $objsArray ;
    
    /**
     * costructor
     *
     * @param PDO $db
     */      
    public function __construct(PDO $db) 
    {
        if ( ( ! is_array( $this->rowsArray ) ) && $db ) 
        {
           //self::getAll($db, null);
        }
    }

    public function getRowsArray() 
    {
        return $this->rowsArray;
    }
        
    public function getObjsArray() 
    {
        return $this->objsArray;
    }
    
    public static function buildSqlOrderByPublic($sort)
    {
     return self::buildSqlOrderBy($sort); 
    }
        
    public function getAll(PDO $db, $filter, $and=true, $sort=null) 
    {
        $this->rowsArray = array();
        $this->objsArray = array();
        
        $objs = self::findByFilter($db, $filter, $and, $sort);

        foreach($objs as $obj)
        {
            $this->rowsArray[$obj->getStateId()] = $obj->getName(); 
            $this->objsArray[$obj->getStateId()] = $obj; 
        }
    }
    
    public function getAllWithLimit(PDO $db, $filter, $and=true, $sort=null, $start=null, $count=null) 
    {
        $this->rowsArray = array();
        $this->objsArray = array();
        
        $objs = self::findByFilterWithLimit($db, $filter, $and, $sort, $start, $count);

        foreach($objs as $obj)
        {
            $this->rowsArray[$obj->getStateId()] = $obj->getName(); 
            $this->objsArray[$obj->getStateId()] = $obj; 
        }
    }
    
    public function searchArrayForID($id)
    {
        $obj = $this->objsArray[$id];
        
        if ($obj)
            $this->assignByArray($obj->toArray());
        else
            $this->assignDefaultValues ();
        
        return $this;
    }
    
    public function searchArrayForValue($name)
    {
        $id = array_search($name, $this->getRowsArray());
        
        $obj = $this->objsArray[$id];
        
        if ($obj)
        {
            $this->assignByArray($obj->toArray());
        }
        
        return $this;
    }
    
    public static function findByFilterWithLimit(PDO $db, $filter, $and=true, $sort=null, $startAt=null, $pagesize=null) 
    {
		if (!($filter instanceof DFCInterface)) 
        {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `'.self::SQL_TABLE_NAME.'`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

        if (isset($startAt) && isset($pagesize))
            $sql .=' LIMIT '.$startAt.', '.$pagesize;
        
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

    public function insertIntoArray()
    {
        $this->rowsArray[$this->getStateId()] = $this->getName(); 
        $this->objsArray[$this->getStateId()] = $this; 
    }
    
    public function existsInDatabase(PDO $db) {
            $filter=array();
            foreach ($this->getPrimaryKeyValues() as $fieldId=>$value) {
                    $filter[]=new DFC($fieldId, $value, DFC::EXACT);
            }
            return 0!=count(self::findByFilter($db, $filter, true));
    }
}

?>