<?php

/**
*
* @version 1.4
* @author  ΤΕΙ Αθήνας
* @package api\classes\extends
*/

require_once('classes/models/EquipmentCategories.class.php');

class EquipmentCategoriesExt extends EquipmentCategories
{
    private $rowsArray;
    private $objsArray;
    
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

    /**
     * get rowsArray array with results 
     *
     * example results :
     * [rowsArray:EquipmentCategoriesExt:private] => Array
     *     (
     *          [2] => ΔΙΚΤΥΑΚΟΣ ΕΞΟΠΛΙΣΜΟΣ 
     *          [3] => ΠΕΡΙΦΕΡΕΙΑΚΕΣ ΣΥΣΚΕΥΕΣ 
     *          [1] => ΥΠΟΛΟΓΙΣΤΙΚΟΣ ΕΞΟΠΛΙΣΜΟΣ
     *     )
     * 
     * @param int $rowId Id of equipment_category
     * @return array Array if $rowId=0 or String if $rowId>0 and $rowId=found   
     */
    public function getRowsArray($rowId=0)
    {
        if ($rowId)
            return $this->rowsArray[$rowId];
        else
            return $this->rowsArray;
    }
    
    /**
    * get objsArray array with results  
    *
    * example  results :
    * [objsArray:EquipmentCategoriesExt:private] => Array
    *   ( 
    *       [2] => EquipmentCategories Object 
    *           ( 
    *               [equipmentCategoryId:EquipmentCategories:private] => 2 
    *               [name:EquipmentCategories:private] => ΔΙΚΤΥΑΚΟΣ ΕΞΟΠΛΙΣΜΟΣ 
    *               [oldInstance:Db2PhpEntityBase:private] =>
    *           ) 
    * 
    *       [3] => EquipmentCategories Object 
    *           ( 
    *               [equipmentCategoryId:EquipmentCategories:private] => 3
    *               [name:EquipmentCategories:private] => ΠΕΡΙΦΕΡΕΙΑΚΕΣ ΣΥΣΚΕΥΕΣ 
    *               [oldInstance:Db2PhpEntityBase:private] => 
    *           ) 
    * 
    *       [1] => EquipmentCategories Object 
    *           ( 
    *               [equipmentCategoryId:EquipmentCategories:private] => 1 
    *               [name:EquipmentCategories:private] => ΥΠΟΛΟΓΙΣΤΙΚΟΣ ΕΞΟΠΛΙΣΜΟΣ 
    *               [oldInstance:Db2PhpEntityBase:private] => 
    *           ) 
    *   )
    * @param int $rowId Id of equipment_category
    * @return array  Array of objects if $rowId=0 or Object if $rowId>0 and $rowId=found   
    */   
    public function getObjsArray($rowId=0) 
    {
        if ($rowId)
            return $this->objsArray[$rowId];
        else
            return $this->objsArray;
    }

    /**
     * Get all results from findByFilter(query by filter) and create arrays.
     *
     * Create rowsArray array with the equipment_category_id as index and the equipment_category name as value.
     * Create objsArray array with the equipment_category_id as index and the value as value.  
     * 
     * @param PDO $db
     * @param array $filter array of DFC instances defining the conditions
     * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
     * @param array $sort array of DSC instances
     */ 
    public function getAll(PDO $db, $filter, $and=true, $sort=null) 
    {
        $this->rowsArray = array();
        $this->objsArray = array();
        
        $objs = self::findByFilter($db, $filter, $and, $sort);

        foreach($objs as $obj)
        {
            $this->rowsArray[$obj->getEquipmentCategoryId()] = $obj->getName(); 
            $this->objsArray[$obj->getEquipmentCategoryId()] = $obj; 
        }
    }
    
     /**
     * Get all results from findByFilterWithLimit(query by filter) and create arrays.
     *
     * Create rowsArray array with the equipment_category_id as index and the equipment_category name as value.
     * Create objsArray array with the equipment_category_id as index and the value as value.  
     * 
     * @param PDO $db
     * @param array $filter array of DFC instances defining the conditions
     * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
     * @param array $sort array of DSC instances
     * @param int $startAt is the starting point 
     * @param int $pagesize is the duration
     */      
    public function getAllWithLimit(PDO $db, $filter, $and=true, $sort=null, $startAt=null, $pagesize=null) 
    {
        $this->rowsArray = array();
        $this->objsArray = array();
        
        $objs = self::findByFilterWithLimit($db, $filter, $and, $sort, $startAt, $pagesize);

        foreach($objs as $obj)
        {
            $this->rowsArray[$obj->getEquipmentCategoryId()] = $obj->getName(); 
            $this->objsArray[$obj->getEquipmentCategoryId()] = $obj; 
        }
    }
    
    /**
     * search with id to return array with values of the id
     *
     * @param int $id id of equipment_category
     * @return array
     */    
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
    
    /**
     * search with name to return array with values of the name's id
     *
     * @param string $name name of equipment_category
     * @return array
     */ 
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
    
    /**
     * Query by filter with limit.
     *
     * The filter can be either an hash with the field id as index and the value as filter value,
     * or a array of DFC instances.
     *
     * Limit is used to limit your MySQL query results to those that fall within a specified range.
     * 
     * Will return matched rows as an array of EquipmentCategories instances with limit.
     *
     * @param PDO $db a PDO Database instance
     * @param array $filter array of DFC instances defining the conditions
     * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
     * @param array $sort array of DSC instances
     * @param int $startAt is the starting point 
     * @param int $pagesize is the duration
     * @return EquipmentCategories[]
     */
    public static function findByFilterWithLimit(PDO $db, $filter, $and=true, $sort=null, $startAt=null, $pagesize=null) 
    {
		if (!($filter instanceof DFCInterface)) 
        {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `'.self::SQL_TABLE_NAME.'`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

                //if (isset($startAt) && isset($pagesize))
                $sql .=' LIMIT '.$startAt.', '.$pagesize;
        
		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

    /**
     * Query by filter for computation the count of results with filter.
     *
     * The filter can be either an hash with the field id as index and the value as filter value,
     * or a array of DFC instances.
     * 
     * Will return an array of EquipmentCategories which contain count value at EquipmentCategoryId field.
     *
     * @param PDO $db a PDO Database instance
     * @param array $filter array of DFC instances defining the conditions
     * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
     * @return EquipmentCategories[]
     */
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