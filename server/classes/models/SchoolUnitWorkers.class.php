<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class SchoolUnitWorkers extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='SchoolUnitWorkers';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='school_unit_workers';
	const SQL_INSERT='INSERT INTO `school_unit_workers` (`school_unit_worker_id`,`school_unit_id`,`worker_id`,`worker_position_id`) VALUES (?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `school_unit_workers` (`school_unit_id`,`worker_id`,`worker_position_id`) VALUES (?,?,?)';
	const SQL_UPDATE='UPDATE `school_unit_workers` SET `school_unit_worker_id`=?,`school_unit_id`=?,`worker_id`=?,`worker_position_id`=? WHERE `school_unit_worker_id`=?';
	const SQL_SELECT_PK='SELECT * FROM `school_unit_workers` WHERE `school_unit_worker_id`=?';
	const SQL_DELETE_PK='DELETE FROM `school_unit_workers` WHERE `school_unit_worker_id`=?';
	const FIELD_SCHOOL_UNIT_WORKER_ID=-1810889885;
	const FIELD_SCHOOL_UNIT_ID=-310749932;
	const FIELD_WORKER_ID=1109533363;
	const FIELD_WORKER_POSITION_ID=231706969;
	private static $PRIMARY_KEYS=array(self::FIELD_SCHOOL_UNIT_WORKER_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_SCHOOL_UNIT_WORKER_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_SCHOOL_UNIT_WORKER_ID=>'school_unit_worker_id',
		self::FIELD_SCHOOL_UNIT_ID=>'school_unit_id',
		self::FIELD_WORKER_ID=>'worker_id',
		self::FIELD_WORKER_POSITION_ID=>'worker_position_id');
	private static $PROPERTY_NAMES=array(
		self::FIELD_SCHOOL_UNIT_WORKER_ID=>'schoolUnitWorkerId',
		self::FIELD_SCHOOL_UNIT_ID=>'schoolUnitId',
		self::FIELD_WORKER_ID=>'workerId',
		self::FIELD_WORKER_POSITION_ID=>'workerPositionId');
	private static $PROPERTY_TYPES=array(
		self::FIELD_SCHOOL_UNIT_WORKER_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_SCHOOL_UNIT_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_WORKER_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_WORKER_POSITION_ID=>Db2PhpEntity::PHP_TYPE_INT);
	private static $FIELD_TYPES=array(
		self::FIELD_SCHOOL_UNIT_WORKER_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_SCHOOL_UNIT_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_WORKER_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_WORKER_POSITION_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_SCHOOL_UNIT_WORKER_ID=>null,
		self::FIELD_SCHOOL_UNIT_ID=>null,
		self::FIELD_WORKER_ID=>null,
		self::FIELD_WORKER_POSITION_ID=>null);
	private $schoolUnitWorkerId;
	private $schoolUnitId;
	private $workerId;
	private $workerPositionId;

	/**
	 * set value for school_unit_worker_id Ο κωδικός εργαζομένου μιας σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $schoolUnitWorkerId
	 * @return SchoolUnitWorkers
	 */
	public function &setSchoolUnitWorkerId($schoolUnitWorkerId) {
		$this->notifyChanged(self::FIELD_SCHOOL_UNIT_WORKER_ID,$this->schoolUnitWorkerId,$schoolUnitWorkerId);
		$this->schoolUnitWorkerId=$schoolUnitWorkerId;
		return $this;
	}

	/**
	 * get value for school_unit_worker_id Ο κωδικός εργαζομένου μιας σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @return mixed
	 */
	public function getSchoolUnitWorkerId() {
		return $this->schoolUnitWorkerId;
	}

	/**
	 * set value for school_unit_id Ο κωδικός σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $schoolUnitId
	 * @return SchoolUnitWorkers
	 */
	public function &setSchoolUnitId($schoolUnitId) {
		$this->notifyChanged(self::FIELD_SCHOOL_UNIT_ID,$this->schoolUnitId,$schoolUnitId);
		$this->schoolUnitId=$schoolUnitId;
		return $this;
	}

	/**
	 * get value for school_unit_id Ο κωδικός σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getSchoolUnitId() {
		return $this->schoolUnitId;
	}

	/**
	 * set value for worker_id Ο κωδικός εργαζόμενου.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $workerId
	 * @return SchoolUnitWorkers
	 */
	public function &setWorkerId($workerId) {
		$this->notifyChanged(self::FIELD_WORKER_ID,$this->workerId,$workerId);
		$this->workerId=$workerId;
		return $this;
	}

	/**
	 * get value for worker_id Ο κωδικός εργαζόμενου.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getWorkerId() {
		return $this->workerId;
	}

	/**
	 * set value for worker_position_id Ο κωδικός θέσης ευθύνης του εργαζόμενου.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $workerPositionId
	 * @return SchoolUnitWorkers
	 */
	public function &setWorkerPositionId($workerPositionId) {
		$this->notifyChanged(self::FIELD_WORKER_POSITION_ID,$this->workerPositionId,$workerPositionId);
		$this->workerPositionId=$workerPositionId;
		return $this;
	}

	/**
	 * get value for worker_position_id Ο κωδικός θέσης ευθύνης του εργαζόμενου.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getWorkerPositionId() {
		return $this->workerPositionId;
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
			self::FIELD_SCHOOL_UNIT_WORKER_ID=>$this->getSchoolUnitWorkerId(),
			self::FIELD_SCHOOL_UNIT_ID=>$this->getSchoolUnitId(),
			self::FIELD_WORKER_ID=>$this->getWorkerId(),
			self::FIELD_WORKER_POSITION_ID=>$this->getWorkerPositionId());
	}


	/**
	 * return array with the field id as index and the field value as value for the identifier fields.
	 *
	 * @return array
	 */
	public function getPrimaryKeyValues() {
		return array(
			self::FIELD_SCHOOL_UNIT_WORKER_ID=>$this->getSchoolUnitWorkerId());
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
	 * Match by attributes of passed example instance and return matched rows as an array of SchoolUnitWorkers instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param SchoolUnitWorkers $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return SchoolUnitWorkers[]
	 */
	public static function findByExample(PDO $db,SchoolUnitWorkers $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of SchoolUnitWorkers instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return SchoolUnitWorkers[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `school_unit_workers`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of SchoolUnitWorkers instances
	 *
	 * @param PDOStatement $stmt
	 * @return SchoolUnitWorkers[]
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
	 * returns the result as an array of SchoolUnitWorkers instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return SchoolUnitWorkers[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new SchoolUnitWorkers();
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
	 * Execute select query and return matched rows as an array of SchoolUnitWorkers instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return SchoolUnitWorkers[]
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
		$sql='DELETE FROM `school_unit_workers`'
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
		$this->setSchoolUnitWorkerId($result['school_unit_worker_id']);
		$this->setSchoolUnitId($result['school_unit_id']);
		$this->setWorkerId($result['worker_id']);
		$this->setWorkerPositionId($result['worker_position_id']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return SchoolUnitWorkers
	 */
	public static function findById(PDO $db,$schoolUnitWorkerId) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
		$stmt->bindValue(1,$schoolUnitWorkerId);
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
		$o=new SchoolUnitWorkers();
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
		$stmt->bindValue(1,$this->getSchoolUnitWorkerId());
		$stmt->bindValue(2,$this->getSchoolUnitId());
		$stmt->bindValue(3,$this->getWorkerId());
		$stmt->bindValue(4,$this->getWorkerPositionId());
	}


	/**
	 * Insert this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function insertIntoDatabase(PDO $db) {
		if (null===$this->getSchoolUnitWorkerId()) {
			$stmt=self::prepareStatement($db,self::SQL_INSERT_AUTOINCREMENT);
			$stmt->bindValue(1,$this->getSchoolUnitId());
			$stmt->bindValue(2,$this->getWorkerId());
			$stmt->bindValue(3,$this->getWorkerPositionId());
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
			$this->setSchoolUnitWorkerId($lastInsertId);
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
		$stmt->bindValue(5,$this->getSchoolUnitWorkerId());
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
		$stmt->bindValue(1,$this->getSchoolUnitWorkerId());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Fetch SchoolUnits which references this SchoolUnitWorkers. Will return null in case reference is invalid.
	 * `school_unit_workers`.`school_unit_id` -> `school_units`.`school_unit_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return SchoolUnits
	 */
	public function fetchSchoolUnits(PDO $db, $sort=null) {
		$filter=array(SchoolUnits::FIELD_SCHOOL_UNIT_ID=>$this->getSchoolUnitId());
		$result=SchoolUnits::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch Workers which references this SchoolUnitWorkers. Will return null in case reference is invalid.
	 * `school_unit_workers`.`worker_id` -> `workers`.`worker_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Workers
	 */
	public function fetchWorkers(PDO $db, $sort=null) {
		$filter=array(Workers::FIELD_WORKER_ID=>$this->getWorkerId());
		$result=Workers::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch WorkerPositions which references this SchoolUnitWorkers. Will return null in case reference is invalid.
	 * `school_unit_workers`.`worker_position_id` -> `worker_positions`.`worker_position_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return WorkerPositions
	 */
	public function fetchWorkerPositions(PDO $db, $sort=null) {
		$filter=array(WorkerPositions::FIELD_WORKER_POSITION_ID=>$this->getWorkerPositionId());
		$result=WorkerPositions::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'SchoolUnitWorkers');
	}

	/**
	 * get single SchoolUnitWorkers instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return SchoolUnitWorkers
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new SchoolUnitWorkers();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of SchoolUnitWorkers from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return SchoolUnitWorkers[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('SchoolUnitWorkers') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>