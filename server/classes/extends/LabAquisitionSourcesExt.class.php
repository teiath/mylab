<?php

/**
*
* @version 1.0
* @author  ΤΕΙ Αθήνας
* @package api\classes\extends
*/

require_once('classes/models/LabAquisitionSources.class.php');

class LabAquisitionSourcesExt extends LabAquisitionSources {
    private $rowsArray ;
    private $objsArray ;
        
    public function __construct(PDO $db) 
    {
        if ( ( ! is_array( $this->rowsArray ) ) && $db ) 
        {
           //self::getAll($db, null);
        }
    }

    public function getRowsArray($rowId=0)
    {
        if ($rowId)
            return $this->rowsArray[$rowId];
        else
            return $this->rowsArray;
    }
        
    public function getObjsArray($rowId=0) 
    {
        if ($rowId)
            return $this->objsArray[$rowId];
        else
            return $this->objsArray;
    }
        
    public function getAll(PDO $db, $filter, $and=true, $sort=null) 
    {
        $this->rowsArray = array();
        $this->objsArray = array();
        
        $objs = self::findByFilter($db, $filter, $and, $sort);

        foreach($objs as $obj)
        {
            $this->rowsArray[$obj->getLabAquisitionSourceId()] = $obj->getLabAquisitionSourceId(); 
            $this->objsArray[$obj->getLabAquisitionSourceId()] = $obj;
        }
    }
    
    public function getAllWithLimit(PDO $db, $filter, $and=true, $sort=null, $start=null, $count=null) 
    {
        $this->rowsArray = array();
        $this->objsArray = array();
        
        $objs = self::findByFilterWithLimit($db, $filter, $and, $sort, $start, $count);

        foreach($objs as $obj)
        {
            $this->rowsArray[$obj->getLabAquisitionSourceId()] = $obj->getLabAquisitionSourceId(); 
            $this->objsArray[$obj->getLabAquisitionSourceId()] = $obj;
        }
    }
    
    public function searchArrayForID($id, $rowId=0)
    {
        if ($rowId)
            $obj = $this->objsArray[$rowId][$id];
        else
            $obj = $this->objsArray[$id];
        
        if ($obj)
            $this->assignByArray($obj->toArray());
        else
            $this->assignDefaultValues ();
        
        return $this;
    }
    
    public function searchArrayForValue($name, $rowId=0)
    {
        if ($rowId)
            $id = array_search($name, $this->getRowsArray($rowId));
        else
            $id = array_search($name, $this->getRowsArray());
                
        $obj = $this->objsArray[$id];
        
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