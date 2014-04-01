<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class SchoolUnitTypes extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='SchoolUnitTypes';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='school_unit_types';
	const SQL_INSERT='INSERT INTO `school_unit_types` (`school_unit_type_id`,`name`,`initials`,`education_level_id`) VALUES (?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `school_unit_types` (`name`,`initials`,`education_level_id`) VALUES (?,?,?)';
	const SQL_UPDATE='UPDATE `school_unit_types` SET `school_unit_type_id`=?,`name`=?,`initials`=?,`education_level_id`=? WHERE `school_unit_type_id`=?';
	const SQL_SELECT_PK='SELECT * FROM `school_unit_types` WHERE `school_unit_type_id`=?';
	const SQL_DELETE_PK='DELETE FROM `school_unit_types` WHERE `school_unit_type_id`=?';
	const FIELD_SCHOOL_UNIT_TYPE_ID=537225643;
	const FIELD_NAME=428222896;
	const FIELD_INITIALS=-730454444;
	const FIELD_EDUCATION_LEVEL_ID=552380626;
	private static $PRIMARY_KEYS=array(self::FIELD_SCHOOL_UNIT_TYPE_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_SCHOOL_UNIT_TYPE_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_SCHOOL_UNIT_TYPE_ID=>'school_unit_type_id',
		self::FIELD_NAME=>'name',
		self::FIELD_INITIALS=>'initials',
		self::FIELD_EDUCATION_LEVEL_ID=>'education_level_id');
	private static $PROPERTY_NAMES=array(
		self::FIELD_SCHOOL_UNIT_TYPE_ID=>'schoolUnitTypeId',
		self::FIELD_NAME=>'name',
		self::FIELD_INITIALS=>'initials',
		self::FIELD_EDUCATION_LEVEL_ID=>'educationLevelId');
	private static $PROPERTY_TYPES=array(
		self::FIELD_SCHOOL_UNIT_TYPE_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_NAME=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_INITIALS=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EDUCATION_LEVEL_ID=>Db2PhpEntity::PHP_TYPE_INT);
	private static $FIELD_TYPES=array(
		self::FIELD_SCHOOL_UNIT_TYPE_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_NAME=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_INITIALS=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_EDUCATION_LEVEL_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_SCHOOL_UNIT_TYPE_ID=>null,
		self::FIELD_NAME=>null,
		self::FIELD_INITIALS=>null,
		self::FIELD_EDUCATION_LEVEL_ID=>null);
	private $schoolUnitTypeId;
	private $name;
	private $initials;
	private $educationLevelId;

	/**
	 * set value for school_unit_type_id Ο κωδικός του τύπου σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $schoolUnitTypeId
	 * @return SchoolUnitTypes
	 */
	public function &setSchoolUnitTypeId($schoolUnitTypeId) {
		$this->notifyChanged(self::FIELD_SCHOOL_UNIT_TYPE_ID,$this->schoolUnitTypeId,$schoolUnitTypeId);
		$this->schoolUnitTypeId=$schoolUnitTypeId;
		return $this;
	}

	/**
	 * get value for school_unit_type_id Ο κωδικός του τύπου σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @return mixed
	 */
	public function getSchoolUnitTypeId() {
		return $this->schoolUnitTypeId;
	}

	/**
	 * set value for name Το όνομα του τύπου σχολικής μονάδας.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $name
	 * @return SchoolUnitTypes
	 */
	public function &setName($name) {
		$this->notifyChanged(self::FIELD_NAME,$this->name,$name);
		$this->name=$name;
		return $this;
	}

	/**
	 * get value for name Το όνομα του τύπου σχολικής μονάδας.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * set value for initials Τα αρχικά του τύπου σχολικής μονάδας.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $initials
	 * @return SchoolUnitTypes
	 */
	public function &setInitials($initials) {
		$this->notifyChanged(self::FIELD_INITIALS,$this->initials,$initials);
		$this->initials=$initials;
		return $this;
	}

	/**
	 * get value for initials Τα αρχικά του τύπου σχολικής μονάδας.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getInitials() {
		return $this->initials;
	}

	/**
	 * set value for education_level_id Ο κωδικός της βαθμίδας εκπαίδευσης.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $educationLevelId
	 * @return SchoolUnitTypes
	 */
	public function &setEducationLevelId($educationLevelId) {
		$this->notifyChanged(self::FIELD_EDUCATION_LEVEL_ID,$this->educationLevelId,$educationLevelId);
		$this->educationLevelId=$educationLevelId;
		return $this;
	}

	/**
	 * get value for education_level_id Ο κωδικός της βαθμίδας εκπαίδευσης.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getEducationLevelId() {
		return $this->educationLevelId;
	}

	/**
	 * Get table name
	 *
	 * @return string
	 */
	public static function getTableName() {
		return self::SQL_TABLE_NAME;
	}

	/**
	 * Get array with field id as index and field name as value
	 *
	 * @return array
	 */
	public static function getFieldNames() {
		return self::$FIELD_NAMES;
	}

	/**
	 * Get array with field id as index and property name as value
	 *
	 * @return array
	 */
	public static function getPropertyNames() {
		return self::$PROPERTY_NAMES;
	}

	/**
	 * get the field name for the passed field id.
	 *
	 * @param int $fieldId
	 * @param bool $fullyQualifiedName true if field name should be qualified by table name
	 * @return string field name for the passed field id, null if the field doesn't exist
	 */
	public static function getFieldNameByFieldId($fieldId, $fullyQualifiedName=true) {
		if (!array_key_exists($fieldId, self::$FIELD_NAMES)) {
			return null;
		}
		$fieldName=self::SQL_IDENTIFIER_QUOTE . self::$FIELD_NAMES[$fieldId] . self::SQL_IDENTIFIER_QUOTE;
		if ($fullyQualifiedName) {
			return self::SQL_IDENTIFIER_QUOTE . self::SQL_TABLE_NAME . self::SQL_IDENTIFIER_QUOTE . '.' . $fieldName;
		}
		return $fieldName;
	}

	/**
	 * Get array with field ids of identifiers
	 *
	 * @return array
	 */
	public static function getIdentifierFields() {
		return self::$PRIMARY_KEYS;
	}

	/**
	 * Get array with field ids of autoincrement fields
	 *
	 * @return array
	 */
	public static function getAutoincrementFields() {
		return self::$AUTOINCREMENT_FIELDS;
	}

	/**
	 * Get array with field id as index and property type as value
	 *
	 * @return array
	 */
	public static function getPropertyTypes() {
		return self::$PROPERTY_TYPES;
	}

	/**
	 * Get array with field id as index and field type as value
	 *
	 * @return array
	 */
	public static function getFieldTypes() {
		return self::$FIELD_TYPES;
	}

	/**
	 * Assign default values according to table
	 * 
	 */
	public function assignDefaultValues() {
		$this->assignByArray(self::$DEFAULT_VALUES);
	}


	/**
	 * return hash with the field name as index and the field value as value.
	 *
	 * @return array
	 */
	public function toHash() {
		$array=$this->toArray();
		$hash=array();
		foreach ($array as $fieldId=>$value) {
			$hash[self::$FIELD_NAMES[$fieldId]]=$value;
		}
		return $hash;
	}

	/**
	 * return array with the field id as index and the field value as value.
	 *
	 * @return array
	 */
	public function toArray() {
		return array(
			self::FIELD_SCHOOL_UNIT_TYPE_ID=>$this->getSchoolUnitTypeId(),
			self::FIELD_NAME=>$this->getName(),
			self::FIELD_INITIALS=>$this->getInitials(),
			self::FIELD_EDUCATION_LEVEL_ID=>$this->getEducationLevelId());
	}


	/**
	 * return array with the field id as index and the field value as value for the identifier fields.
	 *
	 * @return array
	 */
	public function getPrimaryKeyValues() {
		return array(
			self::FIELD_SCHOOL_UNIT_TYPE_ID=>$this->getSchoolUnitTypeId());
	}

	/**
	 * cached statements
	 *
	 * @var array<string,array<string,PDOStatement>>
	 */
	private static $stmts=array();
	private static $cacheStatements=true;
	
	/**
	 * prepare passed string as statement or return cached if enabled and available
	 *
	 * @param PDO $db
	 * @param string $statement
	 * @return PDOStatement
	 */
	protected static function prepareStatement(PDO $db, $statement) {
		if(self::isCacheStatements()) {
			if (in_array($statement, array(self::SQL_INSERT, self::SQL_INSERT_AUTOINCREMENT, self::SQL_UPDATE, self::SQL_SELECT_PK, self::SQL_DELETE_PK))) {
				$dbInstanceId=spl_object_hash($db);
				if (empty(self::$stmts[$statement][$dbInstanceId])) {
					self::$stmts[$statement][$dbInstanceId]=$db->prepare($statement);
				}
				return self::$stmts[$statement][$dbInstanceId];
			}
		}
		return $db->prepare($statement);
	}

	/**
	 * Enable statement cache
	 *
	 * @param bool $cache
	 */
	public static function setCacheStatements($cache) {
		self::$cacheStatements=true==$cache;
	}

	/**
	 * Check if statement cache is enabled
	 *
	 * @return bool
	 */
	public static function isCacheStatements() {
		return self::$cacheStatements;
	}
	
	/**
	 * check if this instance exists in the database
	 *
	 * @param PDO $db
	 * @return bool
	 */
	public function existsInDatabase(PDO $db) {
		$filter=array();
		foreach ($this->getPrimaryKeyValues() as $fieldId=>$value) {
			$filter[]=new DFC($fieldId, $value, DFC::EXACT_NULLSAFE);
		}
		return 0!=count(self::findByFilter($db, $filter, true));
	}
	
	/**
	 * Update to database if exists, otherwise insert
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function updateInsertToDatabase(PDO $db) {
		if ($this->existsInDatabase($db)) {
			return $this->updateToDatabase($db);
		} else {
			return $this->insertIntoDatabase($db);
		}
	}

	/**
	 * Query by Example.
	 *
	 * Match by attributes of passed example instance and return matched rows as an array of SchoolUnitTypes instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param SchoolUnitTypes $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return SchoolUnitTypes[]
	 */
	public static function findByExample(PDO $db,SchoolUnitTypes $example, $and=true, $sort=null) {
		$exampleValues=$example->toArray();
		$filter=array();
		foreach ($exampleValues as $fieldId=>$value) {
			if (null!==$value) {
				$filter[$fieldId]=$value;
			}
		}
		return self::findByFilter($db, $filter, $and, $sort);
	}

	/**
	 * Query by filter.
	 *
	 * The filter can be either an hash with the field id as index and the value as filter value,
	 * or a array of DFC instances.
	 *
	 * Will return matched rows as an array of SchoolUnitTypes instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return SchoolUnitTypes[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `school_unit_types`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of SchoolUnitTypes instances
	 *
	 * @param PDOStatement $stmt
	 * @return SchoolUnitTypes[]
	 */
	public static function fromStatement(PDOStatement $stmt) {
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		return self::fromExecutedStatement($stmt);
	}

	/**
	 * returns the result as an array of SchoolUnitTypes instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return SchoolUnitTypes[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new SchoolUnitTypes();
			$o->assignByHash($result);
			$o->notifyPristine();
			$resultInstances[]=$o;
		}
		$stmt->closeCursor();
		return $resultInstances;
	}

	/**
	 * Get sql WHERE part from filter.
	 *
	 * @param array $filter
	 * @param bool $and
	 * @param bool $fullyQualifiedNames true if field names should be qualified by table name
	 * @param bool $prependWhere true if WHERE should be prepended to conditions
	 * @return string
	 */
	public static function buildSqlWhere($filter, $and, $fullyQualifiedNames=true, $prependWhere=false) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		return $filter->buildSqlWhere(new self::$CLASS_NAME, $fullyQualifiedNames, $prependWhere);
	}

	/**
	 * get sql ORDER BY part from DSCs
	 *
	 * @param array $sort array of DSC instances
	 * @return string
	 */
	protected static function buildSqlOrderBy($sort) {
		return DSC::buildSqlOrderBy(new self::$CLASS_NAME, $sort);
	}

	/**
	 * bind values from filter to statement
	 *
	 * @param PDOStatement $stmt
	 * @param DFCInterface $filter
	 */
	public static function bindValuesForFilter(PDOStatement &$stmt, DFCInterface $filter) {
		$filter->bindValuesForFilter(new self::$CLASS_NAME, $stmt);
	}

	/**
	 * Execute select query and return matched rows as an array of SchoolUnitTypes instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return SchoolUnitTypes[]
	 */
	public static function findBySql(PDO $db, $sql) {
		$stmt=$db->query($sql);
		return self::fromExecutedStatement($stmt);
	}

	/**
	 * Delete rows matching the filter
	 *
	 * The filter can be either an hash with the field id as index and the value as filter value,
	 * or a array of DFC instances.
	 *
	 * @param PDO $db
	 * @param array $filter
	 * @param bool $and
	 * @return mixed
	 */
	public static function deleteByFilter(PDO $db, $filter, $and=true) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		if (0==count($filter)) {
			throw new InvalidArgumentException('refusing to delete without filter'); // just comment out this line if you are brave
		}
		$sql='DELETE FROM `school_unit_types`'
		. self::buildSqlWhere($filter, $and, false, true);
		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Assign values from array with the field id as index and the value as value
	 *
	 * @param array $array
	 */
	public function assignByArray($array) {
		$result=array();
		foreach ($array as $fieldId=>$value) {
			$result[self::$FIELD_NAMES[$fieldId]]=$value;
		}
		$this->assignByHash($result);
	}

	/**
	 * Assign values from hash where the indexes match the tables field names
	 *
	 * @param array $result
	 */
	public function assignByHash($result) {
		$this->setSchoolUnitTypeId($result['school_unit_type_id']);
		$this->setName($result['name']);
		$this->setInitials($result['initials']);
		$this->setEducationLevelId($result['education_level_id']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return SchoolUnitTypes
	 */
	public static function findById(PDO $db,$schoolUnitTypeId) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
		$stmt->bindValue(1,$schoolUnitTypeId);
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$result=$stmt->fetch(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		if(!$result) {
			return null;
		}
		$o=new SchoolUnitTypes();
		$o->assignByHash($result);
		$o->notifyPristine();
		return $o;
	}

	/**
	 * Bind all values to statement
	 *
	 * @param PDOStatement $stmt
	 */
	protected function bindValues(PDOStatement &$stmt) {
		$stmt->bindValue(1,$this->getSchoolUnitTypeId());
		$stmt->bindValue(2,$this->getName());
		$stmt->bindValue(3,$this->getInitials());
		$stmt->bindValue(4,$this->getEducationLevelId());
	}


	/**
	 * Insert this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function insertIntoDatabase(PDO $db) {
		if (null===$this->getSchoolUnitTypeId()) {
			$stmt=self::prepareStatement($db,self::SQL_INSERT_AUTOINCREMENT);
			$stmt->bindValue(1,$this->getName());
			$stmt->bindValue(2,$this->getInitials());
			$stmt->bindValue(3,$this->getEducationLevelId());
		} else {
			$stmt=self::prepareStatement($db,self::SQL_INSERT);
			$this->bindValues($stmt);
		}
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$lastInsertId=$db->lastInsertId();
		if (false!==$lastInsertId) {
			$this->setSchoolUnitTypeId($lastInsertId);
		}
		$stmt->closeCursor();
		$this->notifyPristine();
		return $affected;
	}


	/**
	 * Update this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function updateToDatabase(PDO $db) {
		$stmt=self::prepareStatement($db,self::SQL_UPDATE);
		$this->bindValues($stmt);
		$stmt->bindValue(5,$this->getSchoolUnitTypeId());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		$this->notifyPristine();
		return $affected;
	}


	/**
	 * Delete this instance from the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function deleteFromDatabase(PDO $db) {
		$stmt=self::prepareStatement($db,self::SQL_DELETE_PK);
		$stmt->bindValue(1,$this->getSchoolUnitTypeId());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Fetch SchoolUnits's which this SchoolUnitTypes references.
	 * `school_unit_types`.`school_unit_type_id` -> `school_units`.`school_unit_type_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return SchoolUnits[]
	 */
	public function fetchSchoolUnitsCollection(PDO $db, $sort=null) {
		$filter=array(SchoolUnits::FIELD_SCHOOL_UNIT_TYPE_ID=>$this->getSchoolUnitTypeId());
		return SchoolUnits::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch EducationLevels which references this SchoolUnitTypes. Will return null in case reference is invalid.
	 * `school_unit_types`.`education_level_id` -> `education_levels`.`education_level_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return EducationLevels
	 */
	public function fetchEducationLevels(PDO $db, $sort=null) {
		$filter=array(EducationLevels::FIELD_EDUCATION_LEVEL_ID=>$this->getEducationLevelId());
		$result=EducationLevels::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'SchoolUnitTypes');
	}

	/**
	 * get single SchoolUnitTypes instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return SchoolUnitTypes
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new SchoolUnitTypes();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of SchoolUnitTypes from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return SchoolUnitTypes[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('SchoolUnitTypes') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>