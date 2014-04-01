<?php

/**
*
* @version 1.0
* @author  ΤΕΙ Αθήνας
* @package api\classes\extends
*/

require_once('classes/models/EduAdmins.class.php');

class EduAdminsExt extends EduAdmins
{
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
            self::$rowsArray[$obj->getEduAdminId()] = $obj->getName(); 
            self::$objsArray[$obj->getEduAdminId()] = $obj; 
        }
    }
    
    public static function getAllWithLimit(PDO $db, $filter, $and=true, $sort=null, $start=null, $count=null) 
    {
        self::$rowsArray = array();
        self::$objsArray = array();
        
        $objs = self::findByFilterWithLimit($db, $filter, $and, $sort, $start, $count);

        foreach($objs as $obj)
        {
            self::$rowsArray[$obj->getEduAdminId()] = $obj->getName(); 
            self::$objsArray[$obj->getEduAdminId()] = $obj; 
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

    public static function findByFilterWithLimitBeta(PDO $db, $filter, $sort_field=null, $sort_mode=null, $and=true, $start=null, $count=null) 
    {
        if (!($filter instanceof DFCInterface)) 
        {
            $filter=new DFCAggregate($filter, $and);
        }
        
        switch ($sort_field) {
             case 'region_edu_admin' :
                 $sort = new DSC(RegionEduAdminsExt::FIELD_NAME , $sort_mode);
                 $sql_join_order_name = ", region_edu_admins.name as region_edu_admin_name "; 
                 $sql_join_order = " LEFT JOIN region_edu_admins ON region_edu_admins.region_edu_admin_id=edu_admins.region_edu_admin_id";
                 $sql_join_order_field= RegionEduAdminsExt::buildSqlOrderByPublic($sort).', `edu_admins`.`name` ASC';
                 break;
            default: 
            if ($sort_field=="edu_admin_id")
                $sort = new DSC(EduAdminsExt::FIELD_EDU_ADMIN_ID , $sort_mode); 
            else if ($sort_field=="name")
                $sort = new DSC(EduAdminsExt::FIELD_NAME , $sort_mode);
            $sql_join_order_name= "";
            $sql_join_order ="";
            $sql_join_order_field= self::buildSqlOrderBy($sort);
         } 
        
         $sql='SELECT edu_admins.edu_admin_id, edu_admins.name, edu_admins.region_edu_admin_id'
                .$sql_join_order_name
                .' FROM  `'.self::SQL_TABLE_NAME.'`' 
                .$sql_join_order
                .self::buildSqlWhere($filter, $and, true, true)
                .$sql_join_order_field;

        if (isset($count) && !isset($start)) $start = 0;
   
        if (isset($start) && isset($count))
            $sql .=' LIMIT '.$start.', '.$count;
        
        
        //echo $sql;
        $stmt=self::prepareStatement($db, $sql);
        self::bindValuesForFilter($stmt, $filter);
        return self::fromStatement($stmt);
    }      
    
        public static function findByFilterBeta(PDO $db, $filter, $sort_field=null, $sort_mode=null, $and=true ) 
    {
        if (!($filter instanceof DFCInterface)) 
        {
            $filter=new DFCAggregate($filter, $and);
        }
   
        switch ($sort_field) {
             case 'region_edu_admin' :
                 $sort = new DSC(RegionEduAdminsExt::FIELD_NAME , $sort_mode);
                 $sql_join_order_name = ", region_edu_admins.name as region_edu_admin_name "; 
                 $sql_join_order = " LEFT JOIN region_edu_admins ON region_edu_admins.region_edu_admin_id=edu_admins.region_edu_admin_id";
                 $sql_join_order_field= RegionEduAdminsExt::buildSqlOrderByPublic($sort).', `edu_admins`.`name` ASC';
                 break;
            default: 
            if ($sort_field=="edu_admin_id")
                $sort = new DSC(EduAdminsExt::FIELD_EDU_ADMIN_ID , $sort_mode); 
            else if ($sort_field=="name")
                $sort = new DSC(EduAdminsExt::FIELD_NAME , $sort_mode);
            $sql_join_order_name= "";
            $sql_join_order ="";
            $sql_join_order_field= self::buildSqlOrderBy($sort);
         } 
        
         $sql='SELECT edu_admins.edu_admin_id, edu_admins.name, edu_admins.region_edu_admin_id'
                .$sql_join_order_name
                .' FROM `'.self::SQL_TABLE_NAME.'`' 
                .$sql_join_order
                .self::buildSqlWhere($filter, $and, true, true)
                .$sql_join_order_field;
        
        //echo $sql;
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
        self::$rowsArray[$this->getEduAdminId()] = $this->getName(); 
        self::$objsArray[$this->getEduAdminId()] = $this; 
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