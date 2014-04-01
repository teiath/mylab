<?php

/**
*
* @version 1.4
* @author  ΤΕΙ Αθήνας
* @package api\classes\extends
*/

require_once('classes/models/LabTypes.class.php');

class LabTypesExt extends LabTypes
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

        /**
         * get rowsArray array with results 
         *
         * example results :
         * [rowsArray:LabTypesExt:private] => Array
         *     (
         *         [4] => ΓΩΝΙΑ
         *         [3] => ΕΡΓΑΣΤΗΡΙΟ ΤΟΜΕΑ
         *     )
         * 
         * @param int $rowId Id of aquisition_source
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
         * example results :
         * [objsArray:LabTypesExt:private] => Array
         *   (
         *       [4] => LabTypes Object
         *           (
         *               [labTypeId:LabTypes:private] => 4
         *               [name:LabTypes:private] => ΓΩΝΙΑ
         *               [fullName:LabTypes:private] => ΓΩΝΙΑ Η/Υ
         *               [oldInstance:Db2PhpEntityBase:private] => 
         *           )
         *
         *       [3] => LabTypes Object
         *           (
         *               [labTypeId:LabTypes:private] => 3
         *               [name:LabTypes:private] => ΕΡΓΑΣΤΗΡΙΟ ΤΟΜΕΑ
         *               [fullName:LabTypes:private] => ΕΡΓΑΣΤΗΡΙΟ ΤΟΜΕΑ
         *               [oldInstance:Db2PhpEntityBase:private] => 
         *           )
         *
         *   )
         * 
         * @param int $rowId Id of aquisition_source
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
	 * get sql ORDER BY part from DSCs from protected static function buildSqlOrderBy
	 *
	 * @param array $sort array of DSC instances
	 * @return string
	 */ 
        public static function buildSqlOrderByPublic($sort)
        {
            return self::buildSqlOrderBy($sort); 
        }

        /**
         * Get all results from findByFilter(query by filter) and create arrays.
         *
         * Create rowsArray array with the lab_type_id as index and the lab_type name as value.
         * Create objsArray array with the lab_type_id as index and the value as value.  
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
                $this->rowsArray[$obj->getLabTypeId()] = $obj->getName(); 
                $this->objsArray[$obj->getLabTypeId()] = $obj; 
            }
        }

        /**
         * Get all results from findByFilterWithLimit(query by filter) and create arrays.
         *
         * Create rowsArray array with the lab_type_id as index and the lab_type name as value.
         * Create objsArray array with the lab_type_id as index and the value as value.  
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
                $this->rowsArray[$obj->getLabTypeId()] = $obj->getName(); 
                $this->objsArray[$obj->getLabTypeId()] = $obj; 
            }
        }

	/**
	 * search with id to return array with values of the id
	 *
	 * @param int $id id of lab_type
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
	 * @param string $name name of lab_type
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
	 * Will return matched rows as an array of LabTypes instances with limit.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
         * @param int $startAt is the starting point 
         * @param int $pagesize is the duration
	 * @return LabTypes[]
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

            //if ($pagesize && ($pagesize <> Parameters::AllPageSize))
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
	 * Will return an array of LabTypes which contain count value at LabTypeId field.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @return LabTypes[]
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
            
            foreach ($this->getPrimaryKeyValues() as $fieldId=>$value) 
            {
                    $filter[]=new DFC($fieldId, $value, DFC::EXACT);
            }

            return 0!=count(self::findByFilter($db, $filter, true));
        }
}
?>