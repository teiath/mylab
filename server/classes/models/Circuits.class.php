<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class Circuits extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='Circuits';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='circuits';
	const SQL_INSERT='INSERT INTO `circuits` (`circuit_id`,`phone_number`,`updated_date`,`status`,`circuit_type_id`,`school_unit_id`) VALUES (?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `circuits` (`phone_number`,`updated_date`,`status`,`circuit_type_id`,`school_unit_id`) VALUES (?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `circuits` SET `circuit_id`=?,`phone_number`=?,`updated_date`=?,`status`=?,`circuit_type_id`=?,`school_unit_id`=? WHERE `circuit_id`=?';
	const SQL_SELECT_PK='SELECT * FROM `circuits` WHERE `circuit_id`=?';
	const SQL_DELETE_PK='DELETE FROM `circuits` WHERE `circuit_id`=?';
	const FIELD_CIRCUIT_ID=464965621;
	const FIELD_PHONE_NUMBER=-1033800450;
	const FIELD_UPDATED_DATE=-894814602;
	const FIELD_STATUS=-136797002;
	const FIELD_CIRCUIT_TYPE_ID=324654502;
	const FIELD_SCHOOL_UNIT_ID=170924207;
	private static $PRIMARY_KEYS=array(self::FIELD_CIRCUIT_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_CIRCUIT_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_CIRCUIT_ID=>'circuit_id',
		self::FIELD_PHONE_NUMBER=>'phone_number',
		self::FIELD_UPDATED_DATE=>'updated_date',
		self::FIELD_STATUS=>'status',
		self::FIELD_CIRCUIT_TYPE_ID=>'circuit_type_id',
		self::FIELD_SCHOOL_UNIT_ID=>'school_unit_id');
	private static $PROPERTY_NAMES=array(
		self::FIELD_CIRCUIT_ID=>'circuitId',
		self::FIELD_PHONE_NUMBER=>'phoneNumber',
		self::FIELD_UPDATED_DATE=>'updatedDate',
		self::FIELD_STATUS=>'status',
		self::FIELD_CIRCUIT_TYPE_ID=>'circuitTypeId',
		self::FIELD_SCHOOL_UNIT_ID=>'schoolUnitId');
	private static $PROPERTY_TYPES=array(
		self::FIELD_CIRCUIT_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_PHONE_NUMBER=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_UPDATED_DATE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_STATUS=>Db2PhpEntity::PHP_TYPE_BOOL,
		self::FIELD_CIRCUIT_TYPE_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_SCHOOL_UNIT_ID=>Db2PhpEntity::PHP_TYPE_INT);
	private static $FIELD_TYPES=array(
		self::FIELD_CIRCUIT_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_PHONE_NUMBER=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,45,0,true),
		self::FIELD_UPDATED_DATE=>array(Db2PhpEntity::JDBC_TYPE_TIMESTAMP,19,0,true),
		self::FIELD_STATUS=>array(Db2PhpEntity::JDBC_TYPE_BIT,0,0,true),
		self::FIELD_CIRCUIT_TYPE_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_SCHOOL_UNIT_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_CIRCUIT_ID=>null,
		self::FIELD_PHONE_NUMBER=>null,
		self::FIELD_UPDATED_DATE=>null,
		self::FIELD_STATUS=>null,
		self::FIELD_CIRCUIT_TYPE_ID=>null,
		self::FIELD_SCHOOL_UNIT_ID=>null);
	private $circuitId;
	private $phoneNumber;
	private $updatedDate;
	private $status;
	private $circuitTypeId;
	private $schoolUnitId;

	/**
	 * set value for circuit_id Ο κωδικός του τηλεφωνικού κυκλώματος.
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $circuitId
	 * @return Circuits
	 */
	public function &setCircuitId($circuitId) {
		$this->notifyChanged(self::FIELD_CIRCUIT_ID,$this->circuitId,$circuitId);
		$this->circuitId=$circuitId;
		return $this;
	}

	/**
	 * get value for circuit_id Ο κωδικός του τηλεφωνικού κυκλώματος.
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @return mixed
	 */
	public function getCircuitId() {
		return $this->circuitId;
	}

	/**
	 * set value for phone_number Ο αριθμός του τηλεφωνικού κυκλώματος.
	 *
	 * type:VARCHAR,size:45,default:null,nullable
	 *
	 * @param mixed $phoneNumber
	 * @return Circuits
	 */
	public function &setPhoneNumber($phoneNumber) {
		$this->notifyChanged(self::FIELD_PHONE_NUMBER,$this->phoneNumber,$phoneNumber);
		$this->phoneNumber=$phoneNumber;
		return $this;
	}

	/**
	 * get value for phone_number Ο αριθμός του τηλεφωνικού κυκλώματος.
	 *
	 * type:VARCHAR,size:45,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPhoneNumber() {
		return $this->phoneNumber;
	}

	/**
	 * set value for updated_date  Η ημερομηνίας ενημέρωσης της εγγραφής του τηλεφωνικού κυκλώματος.
	 *
	 * type:DATETIME,size:19,default:null,nullable
	 *
	 * @param mixed $updatedDate
	 * @return Circuits
	 */
	public function &setUpdatedDate($updatedDate) {
		$this->notifyChanged(self::FIELD_UPDATED_DATE,$this->updatedDate,$updatedDate);
		$this->updatedDate=$updatedDate;
		return $this;
	}

	/**
	 * get value for updated_date  Η ημερομηνίας ενημέρωσης της εγγραφής του τηλεφωνικού κυκλώματος.
	 *
	 * type:DATETIME,size:19,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getUpdatedDate() {
		return $this->updatedDate;
	}

	/**
	 * set value for status Η λειτουργική κατάσταση του τηλεφωνικού κυκλώματος (1=ΕΝΕΡΓΗ,0=ΑΝΕΝΕΡΓΗ),
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @param mixed $status
	 * @return Circuits
	 */
	public function &setStatus($status) {
		$this->notifyChanged(self::FIELD_STATUS,$this->status,$status);
		$this->status=$status;
		return $this;
	}

	/**
	 * get value for status Η λειτουργική κατάσταση του τηλεφωνικού κυκλώματος (1=ΕΝΕΡΓΗ,0=ΑΝΕΝΕΡΓΗ),
	 *
	 * type:BIT,size:0,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * set value for circuit_type_id Ο κωδικός του τύπου του τηλεφωνικού κυκλώματος. 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $circuitTypeId
	 * @return Circuits
	 */
	public function &setCircuitTypeId($circuitTypeId) {
		$this->notifyChanged(self::FIELD_CIRCUIT_TYPE_ID,$this->circuitTypeId,$circuitTypeId);
		$this->circuitTypeId=$circuitTypeId;
		return $this;
	}

	/**
	 * get value for circuit_type_id Ο κωδικός του τύπου του τηλεφωνικού κυκλώματος. 
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getCircuitTypeId() {
		return $this->circuitTypeId;
	}

	/**
	 * set value for school_unit_id Ο κωδικός της σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $schoolUnitId
	 * @return Circuits
	 */
	public function &setSchoolUnitId($schoolUnitId) {
		$this->notifyChanged(self::FIELD_SCHOOL_UNIT_ID,$this->schoolUnitId,$schoolUnitId);
		$this->schoolUnitId=$schoolUnitId;
		return $this;
	}

	/**
	 * get value for school_unit_id Ο κωδικός της σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getSchoolUnitId() {
		return $this->schoolUnitId;
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
			self::FIELD_CIRCUIT_ID=>$this->getCircuitId(),
			self::FIELD_PHONE_NUMBER=>$this->getPhoneNumber(),
			self::FIELD_UPDATED_DATE=>$this->getUpdatedDate(),
			self::FIELD_STATUS=>$this->getStatus(),
			self::FIELD_CIRCUIT_TYPE_ID=>$this->getCircuitTypeId(),
			self::FIELD_SCHOOL_UNIT_ID=>$this->getSchoolUnitId());
	}


	/**
	 * return array with the field id as index and the field value as value for the identifier fields.
	 *
	 * @return array
	 */
	public function getPrimaryKeyValues() {
		return array(
			self::FIELD_CIRCUIT_ID=>$this->getCircuitId());
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
	 * Match by attributes of passed example instance and return matched rows as an array of Circuits instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param Circuits $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Circuits[]
	 */
	public static function findByExample(PDO $db,Circuits $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of Circuits instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Circuits[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `circuits`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of Circuits instances
	 *
	 * @param PDOStatement $stmt
	 * @return Circuits[]
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
	 * returns the result as an array of Circuits instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return Circuits[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new Circuits();
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
	 * Execute select query and return matched rows as an array of Circuits instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return Circuits[]
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
		$sql='DELETE FROM `circuits`'
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
		$this->setCircuitId($result['circuit_id']);
		$this->setPhoneNumber($result['phone_number']);
		$this->setUpdatedDate($result['updated_date']);
		$this->setStatus($result['status']);
		$this->setCircuitTypeId($result['circuit_type_id']);
		$this->setSchoolUnitId($result['school_unit_id']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return Circuits
	 */
	public static function findById(PDO $db,$circuitId) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
		$stmt->bindValue(1,$circuitId);
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
		$o=new Circuits();
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
		$stmt->bindValue(1,$this->getCircuitId());
		$stmt->bindValue(2,$this->getPhoneNumber());
		$stmt->bindValue(3,$this->getUpdatedDate());
		$stmt->bindValue(4,$this->getStatus());
		$stmt->bindValue(5,$this->getCircuitTypeId());
		$stmt->bindValue(6,$this->getSchoolUnitId());
	}


	/**
	 * Insert this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function insertIntoDatabase(PDO $db) {
		if (null===$this->getCircuitId()) {
			$stmt=self::prepareStatement($db,self::SQL_INSERT_AUTOINCREMENT);
			$stmt->bindValue(1,$this->getPhoneNumber());
			$stmt->bindValue(2,$this->getUpdatedDate());
			$stmt->bindValue(3,$this->getStatus());
			$stmt->bindValue(4,$this->getCircuitTypeId());
			$stmt->bindValue(5,$this->getSchoolUnitId());
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
			$this->setCircuitId($lastInsertId);
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
		$stmt->bindValue(7,$this->getCircuitId());
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
		$stmt->bindValue(1,$this->getCircuitId());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Fetch LabRelations's which this Circuits references.
	 * `circuits`.`circuit_id` -> `lab_relations`.`circuit_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return LabRelations[]
	 */
	public function fetchLabRelationsCollection(PDO $db, $sort=null) {
		$filter=array(LabRelations::FIELD_CIRCUIT_ID=>$this->getCircuitId());
		return LabRelations::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch CircuitTypes which references this Circuits. Will return null in case reference is invalid.
	 * `circuits`.`circuit_type_id` -> `circuit_types`.`circuit_type_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return CircuitTypes
	 */
	public function fetchCircuitTypes(PDO $db, $sort=null) {
		$filter=array(CircuitTypes::FIELD_CIRCUIT_TYPE_ID=>$this->getCircuitTypeId());
		$result=CircuitTypes::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch SchoolUnits which references this Circuits. Will return null in case reference is invalid.
	 * `circuits`.`school_unit_id` -> `school_units`.`school_unit_id`
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
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'Circuits');
	}

	/**
	 * get single Circuits instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return Circuits
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new Circuits();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of Circuits from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return Circuits[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('Circuits') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>