<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class Workers extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='Workers';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='workers';
	const SQL_INSERT='INSERT INTO `workers` (`worker_id`,`registry_no`,`tax_number`,`lastname`,`firstname`,`fathername`,`sex`,`worker_specialization_id`) VALUES (?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `workers` (`registry_no`,`tax_number`,`lastname`,`firstname`,`fathername`,`sex`,`worker_specialization_id`) VALUES (?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `workers` SET `worker_id`=?,`registry_no`=?,`tax_number`=?,`lastname`=?,`firstname`=?,`fathername`=?,`sex`=?,`worker_specialization_id`=? WHERE `worker_id`=?';
	const SQL_SELECT_PK='SELECT * FROM `workers` WHERE `worker_id`=?';
	const SQL_DELETE_PK='DELETE FROM `workers` WHERE `worker_id`=?';
	const FIELD_WORKER_ID=1219319683;
	const FIELD_REGISTRY_NO=432040266;
	const FIELD_TAX_NUMBER=-664035018;
	const FIELD_LASTNAME=2009015098;
	const FIELD_FIRSTNAME=257115970;
	const FIELD_FATHERNAME=-1451925312;
	const FIELD_SEX=998727597;
	const FIELD_WORKER_SPECIALIZATION_ID=-1527535385;
	private static $PRIMARY_KEYS=array(self::FIELD_WORKER_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_WORKER_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_WORKER_ID=>'worker_id',
		self::FIELD_REGISTRY_NO=>'registry_no',
		self::FIELD_TAX_NUMBER=>'tax_number',
		self::FIELD_LASTNAME=>'lastname',
		self::FIELD_FIRSTNAME=>'firstname',
		self::FIELD_FATHERNAME=>'fathername',
		self::FIELD_SEX=>'sex',
		self::FIELD_WORKER_SPECIALIZATION_ID=>'worker_specialization_id');
	private static $PROPERTY_NAMES=array(
		self::FIELD_WORKER_ID=>'workerId',
		self::FIELD_REGISTRY_NO=>'registryNo',
		self::FIELD_TAX_NUMBER=>'taxNumber',
		self::FIELD_LASTNAME=>'lastname',
		self::FIELD_FIRSTNAME=>'firstname',
		self::FIELD_FATHERNAME=>'fathername',
		self::FIELD_SEX=>'sex',
		self::FIELD_WORKER_SPECIALIZATION_ID=>'workerSpecializationId');
	private static $PROPERTY_TYPES=array(
		self::FIELD_WORKER_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_REGISTRY_NO=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_TAX_NUMBER=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_LASTNAME=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_FIRSTNAME=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_FATHERNAME=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SEX=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_WORKER_SPECIALIZATION_ID=>Db2PhpEntity::PHP_TYPE_INT);
	private static $FIELD_TYPES=array(
		self::FIELD_WORKER_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_REGISTRY_NO=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_TAX_NUMBER=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_LASTNAME=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_FIRSTNAME=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_FATHERNAME=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_SEX=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,1,0,true),
		self::FIELD_WORKER_SPECIALIZATION_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_WORKER_ID=>null,
		self::FIELD_REGISTRY_NO=>null,
		self::FIELD_TAX_NUMBER=>null,
		self::FIELD_LASTNAME=>null,
		self::FIELD_FIRSTNAME=>null,
		self::FIELD_FATHERNAME=>null,
		self::FIELD_SEX=>null,
		self::FIELD_WORKER_SPECIALIZATION_ID=>null);
	private $workerId;
	private $registryNo;
	private $taxNumber;
	private $lastname;
	private $firstname;
	private $fathername;
	private $sex;
	private $workerSpecializationId;

	/**
	 * set value for worker_id Ο κωδικός του εργαζόμενου.
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $workerId
	 * @return Workers
	 */
	public function &setWorkerId($workerId) {
		$this->notifyChanged(self::FIELD_WORKER_ID,$this->workerId,$workerId);
		$this->workerId=$workerId;
		return $this;
	}

	/**
	 * get value for worker_id Ο κωδικός του εργαζόμενου.
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @return mixed
	 */
	public function getWorkerId() {
		return $this->workerId;
	}

	/**
	 * set value for registry_no Ο αριθμός μητρώου του εργαζόμενου.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $registryNo
	 * @return Workers
	 */
	public function &setRegistryNo($registryNo) {
		$this->notifyChanged(self::FIELD_REGISTRY_NO,$this->registryNo,$registryNo);
		$this->registryNo=$registryNo;
		return $this;
	}

	/**
	 * get value for registry_no Ο αριθμός μητρώου του εργαζόμενου.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getRegistryNo() {
		return $this->registryNo;
	}

	/**
	 * set value for tax_number Το ΑΦΜ του εργαζόμενου.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $taxNumber
	 * @return Workers
	 */
	public function &setTaxNumber($taxNumber) {
		$this->notifyChanged(self::FIELD_TAX_NUMBER,$this->taxNumber,$taxNumber);
		$this->taxNumber=$taxNumber;
		return $this;
	}

	/**
	 * get value for tax_number Το ΑΦΜ του εργαζόμενου.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getTaxNumber() {
		return $this->taxNumber;
	}

	/**
	 * set value for lastname Το επίθετο του εργαζόμενου.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $lastname
	 * @return Workers
	 */
	public function &setLastname($lastname) {
		$this->notifyChanged(self::FIELD_LASTNAME,$this->lastname,$lastname);
		$this->lastname=$lastname;
		return $this;
	}

	/**
	 * get value for lastname Το επίθετο του εργαζόμενου.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getLastname() {
		return $this->lastname;
	}

	/**
	 * set value for firstname Το όνομα του εργαζόμενου.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $firstname
	 * @return Workers
	 */
	public function &setFirstname($firstname) {
		$this->notifyChanged(self::FIELD_FIRSTNAME,$this->firstname,$firstname);
		$this->firstname=$firstname;
		return $this;
	}

	/**
	 * get value for firstname Το όνομα του εργαζόμενου.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getFirstname() {
		return $this->firstname;
	}

	/**
	 * set value for fathername Το όνομα πατρός του εργαζόμενου.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $fathername
	 * @return Workers
	 */
	public function &setFathername($fathername) {
		$this->notifyChanged(self::FIELD_FATHERNAME,$this->fathername,$fathername);
		$this->fathername=$fathername;
		return $this;
	}

	/**
	 * get value for fathername Το όνομα πατρός του εργαζόμενου.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getFathername() {
		return $this->fathername;
	}

	/**
	 * set value for sex Το φύλο του εργαζόμενου.
	 *
	 * type:VARCHAR,size:1,default:null,nullable
	 *
	 * @param mixed $sex
	 * @return Workers
	 */
	public function &setSex($sex) {
		$this->notifyChanged(self::FIELD_SEX,$this->sex,$sex);
		$this->sex=$sex;
		return $this;
	}

	/**
	 * get value for sex Το φύλο του εργαζόμενου.
	 *
	 * type:VARCHAR,size:1,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSex() {
		return $this->sex;
	}

	/**
	 * set value for worker_specialization_id ο κωδικός ειδικότητας του εργαζόμενου.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $workerSpecializationId
	 * @return Workers
	 */
	public function &setWorkerSpecializationId($workerSpecializationId) {
		$this->notifyChanged(self::FIELD_WORKER_SPECIALIZATION_ID,$this->workerSpecializationId,$workerSpecializationId);
		$this->workerSpecializationId=$workerSpecializationId;
		return $this;
	}

	/**
	 * get value for worker_specialization_id ο κωδικός ειδικότητας του εργαζόμενου.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getWorkerSpecializationId() {
		return $this->workerSpecializationId;
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
			self::FIELD_WORKER_ID=>$this->getWorkerId(),
			self::FIELD_REGISTRY_NO=>$this->getRegistryNo(),
			self::FIELD_TAX_NUMBER=>$this->getTaxNumber(),
			self::FIELD_LASTNAME=>$this->getLastname(),
			self::FIELD_FIRSTNAME=>$this->getFirstname(),
			self::FIELD_FATHERNAME=>$this->getFathername(),
			self::FIELD_SEX=>$this->getSex(),
			self::FIELD_WORKER_SPECIALIZATION_ID=>$this->getWorkerSpecializationId());
	}


	/**
	 * return array with the field id as index and the field value as value for the identifier fields.
	 *
	 * @return array
	 */
	public function getPrimaryKeyValues() {
		return array(
			self::FIELD_WORKER_ID=>$this->getWorkerId());
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
	 * Match by attributes of passed example instance and return matched rows as an array of Workers instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param Workers $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Workers[]
	 */
	public static function findByExample(PDO $db,Workers $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of Workers instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Workers[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `workers`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of Workers instances
	 *
	 * @param PDOStatement $stmt
	 * @return Workers[]
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
	 * returns the result as an array of Workers instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return Workers[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new Workers();
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
	 * Execute select query and return matched rows as an array of Workers instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return Workers[]
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
		$sql='DELETE FROM `workers`'
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
		$this->setWorkerId($result['worker_id']);
		$this->setRegistryNo($result['registry_no']);
		$this->setTaxNumber($result['tax_number']);
		$this->setLastname($result['lastname']);
		$this->setFirstname($result['firstname']);
		$this->setFathername($result['fathername']);
		$this->setSex($result['sex']);
		$this->setWorkerSpecializationId($result['worker_specialization_id']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return Workers
	 */
	public static function findById(PDO $db,$workerId) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
		$stmt->bindValue(1,$workerId);
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
		$o=new Workers();
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
		$stmt->bindValue(1,$this->getWorkerId());
		$stmt->bindValue(2,$this->getRegistryNo());
		$stmt->bindValue(3,$this->getTaxNumber());
		$stmt->bindValue(4,$this->getLastname());
		$stmt->bindValue(5,$this->getFirstname());
		$stmt->bindValue(6,$this->getFathername());
		$stmt->bindValue(7,$this->getSex());
		$stmt->bindValue(8,$this->getWorkerSpecializationId());
	}


	/**
	 * Insert this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function insertIntoDatabase(PDO $db) {
		if (null===$this->getWorkerId()) {
			$stmt=self::prepareStatement($db,self::SQL_INSERT_AUTOINCREMENT);
			$stmt->bindValue(1,$this->getRegistryNo());
			$stmt->bindValue(2,$this->getTaxNumber());
			$stmt->bindValue(3,$this->getLastname());
			$stmt->bindValue(4,$this->getFirstname());
			$stmt->bindValue(5,$this->getFathername());
			$stmt->bindValue(6,$this->getSex());
			$stmt->bindValue(7,$this->getWorkerSpecializationId());
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
			$this->setWorkerId($lastInsertId);
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
		$stmt->bindValue(9,$this->getWorkerId());
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
		$stmt->bindValue(1,$this->getWorkerId());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Fetch LabWorkers's which this Workers references.
	 * `workers`.`worker_id` -> `lab_workers`.`worker_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return LabWorkers[]
	 */
	public function fetchLabWorkersCollection(PDO $db, $sort=null) {
		$filter=array(LabWorkers::FIELD_WORKER_ID=>$this->getWorkerId());
		return LabWorkers::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch SchoolUnitWorkers's which this Workers references.
	 * `workers`.`worker_id` -> `school_unit_workers`.`worker_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return SchoolUnitWorkers[]
	 */
	public function fetchSchoolUnitWorkersCollection(PDO $db, $sort=null) {
		$filter=array(SchoolUnitWorkers::FIELD_WORKER_ID=>$this->getWorkerId());
		return SchoolUnitWorkers::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch WorkerSpecializations which references this Workers. Will return null in case reference is invalid.
	 * `workers`.`worker_specialization_id` -> `worker_specializations`.`worker_specialization_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return WorkerSpecializations
	 */
	public function fetchWorkerSpecializations(PDO $db, $sort=null) {
		$filter=array(WorkerSpecializations::FIELD_WORKER_SPECIALIZATION_ID=>$this->getWorkerSpecializationId());
		$result=WorkerSpecializations::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'Workers');
	}

	/**
	 * get single Workers instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return Workers
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new Workers();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of Workers from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return Workers[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('Workers') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>