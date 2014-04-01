<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class Municipalities extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='Municipalities';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='municipalities';
	const SQL_INSERT='INSERT INTO `municipalities` (`municipality_id`,`name`,`transfer_area_id`,`prefecture_id`) VALUES (?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `municipalities` (`name`,`transfer_area_id`,`prefecture_id`) VALUES (?,?,?)';
	const SQL_UPDATE='UPDATE `municipalities` SET `municipality_id`=?,`name`=?,`transfer_area_id`=?,`prefecture_id`=? WHERE `municipality_id`=?';
	const SQL_SELECT_PK='SELECT * FROM `municipalities` WHERE `municipality_id`=?';
	const SQL_DELETE_PK='DELETE FROM `municipalities` WHERE `municipality_id`=?';
	const FIELD_MUNICIPALITY_ID=764304362;
	const FIELD_NAME=-1337684513;
	const FIELD_TRANSFER_AREA_ID=-174083315;
	const FIELD_PREFECTURE_ID=-1174580527;
	private static $PRIMARY_KEYS=array(self::FIELD_MUNICIPALITY_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_MUNICIPALITY_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_MUNICIPALITY_ID=>'municipality_id',
		self::FIELD_NAME=>'name',
		self::FIELD_TRANSFER_AREA_ID=>'transfer_area_id',
		self::FIELD_PREFECTURE_ID=>'prefecture_id');
	private static $PROPERTY_NAMES=array(
		self::FIELD_MUNICIPALITY_ID=>'municipalityId',
		self::FIELD_NAME=>'name',
		self::FIELD_TRANSFER_AREA_ID=>'transferAreaId',
		self::FIELD_PREFECTURE_ID=>'prefectureId');
	private static $PROPERTY_TYPES=array(
		self::FIELD_MUNICIPALITY_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_NAME=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_TRANSFER_AREA_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_PREFECTURE_ID=>Db2PhpEntity::PHP_TYPE_INT);
	private static $FIELD_TYPES=array(
		self::FIELD_MUNICIPALITY_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_NAME=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_TRANSFER_AREA_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_PREFECTURE_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_MUNICIPALITY_ID=>null,
		self::FIELD_NAME=>null,
		self::FIELD_TRANSFER_AREA_ID=>null,
		self::FIELD_PREFECTURE_ID=>null);
	private $municipalityId;
	private $name;
	private $transferAreaId;
	private $prefectureId;

	/**
	 * set value for municipality_id Ο κωδικός του δήμου.
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $municipalityId
	 * @return Municipalities
	 */
	public function &setMunicipalityId($municipalityId) {
		$this->notifyChanged(self::FIELD_MUNICIPALITY_ID,$this->municipalityId,$municipalityId);
		$this->municipalityId=$municipalityId;
		return $this;
	}

	/**
	 * get value for municipality_id Ο κωδικός του δήμου.
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @return mixed
	 */
	public function getMunicipalityId() {
		return $this->municipalityId;
	}

	/**
	 * set value for name Το όνομα του δήμου. 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $name
	 * @return Municipalities
	 */
	public function &setName($name) {
		$this->notifyChanged(self::FIELD_NAME,$this->name,$name);
		$this->name=$name;
		return $this;
	}

	/**
	 * get value for name Το όνομα του δήμου. 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * set value for transfer_area_id Ο κωδικός της περιοχής μετάθεσης.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $transferAreaId
	 * @return Municipalities
	 */
	public function &setTransferAreaId($transferAreaId) {
		$this->notifyChanged(self::FIELD_TRANSFER_AREA_ID,$this->transferAreaId,$transferAreaId);
		$this->transferAreaId=$transferAreaId;
		return $this;
	}

	/**
	 * get value for transfer_area_id Ο κωδικός της περιοχής μετάθεσης.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getTransferAreaId() {
		return $this->transferAreaId;
	}

	/**
	 * set value for prefecture_id Ο κωδικός του νομού.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $prefectureId
	 * @return Municipalities
	 */
	public function &setPrefectureId($prefectureId) {
		$this->notifyChanged(self::FIELD_PREFECTURE_ID,$this->prefectureId,$prefectureId);
		$this->prefectureId=$prefectureId;
		return $this;
	}

	/**
	 * get value for prefecture_id Ο κωδικός του νομού.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getPrefectureId() {
		return $this->prefectureId;
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
			self::FIELD_MUNICIPALITY_ID=>$this->getMunicipalityId(),
			self::FIELD_NAME=>$this->getName(),
			self::FIELD_TRANSFER_AREA_ID=>$this->getTransferAreaId(),
			self::FIELD_PREFECTURE_ID=>$this->getPrefectureId());
	}


	/**
	 * return array with the field id as index and the field value as value for the identifier fields.
	 *
	 * @return array
	 */
	public function getPrimaryKeyValues() {
		return array(
			self::FIELD_MUNICIPALITY_ID=>$this->getMunicipalityId());
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
	 * Match by attributes of passed example instance and return matched rows as an array of Municipalities instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param Municipalities $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Municipalities[]
	 */
	public static function findByExample(PDO $db,Municipalities $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of Municipalities instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Municipalities[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `municipalities`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of Municipalities instances
	 *
	 * @param PDOStatement $stmt
	 * @return Municipalities[]
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
	 * returns the result as an array of Municipalities instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return Municipalities[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new Municipalities();
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
	 * Execute select query and return matched rows as an array of Municipalities instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return Municipalities[]
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
		$sql='DELETE FROM `municipalities`'
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
		$this->setMunicipalityId($result['municipality_id']);
		$this->setName($result['name']);
		$this->setTransferAreaId($result['transfer_area_id']);
		$this->setPrefectureId($result['prefecture_id']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return Municipalities
	 */
	public static function findById(PDO $db,$municipalityId) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
		$stmt->bindValue(1,$municipalityId);
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
		$o=new Municipalities();
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
		$stmt->bindValue(1,$this->getMunicipalityId());
		$stmt->bindValue(2,$this->getName());
		$stmt->bindValue(3,$this->getTransferAreaId());
		$stmt->bindValue(4,$this->getPrefectureId());
	}


	/**
	 * Insert this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function insertIntoDatabase(PDO $db) {
		if (null===$this->getMunicipalityId()) {
			$stmt=self::prepareStatement($db,self::SQL_INSERT_AUTOINCREMENT);
			$stmt->bindValue(1,$this->getName());
			$stmt->bindValue(2,$this->getTransferAreaId());
			$stmt->bindValue(3,$this->getPrefectureId());
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
			$this->setMunicipalityId($lastInsertId);
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
		$stmt->bindValue(5,$this->getMunicipalityId());
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
		$stmt->bindValue(1,$this->getMunicipalityId());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Fetch SchoolUnits's which this Municipalities references.
	 * `municipalities`.`municipality_id` -> `school_units`.`municipality_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return SchoolUnits[]
	 */
	public function fetchSchoolUnitsCollection(PDO $db, $sort=null) {
		$filter=array(SchoolUnits::FIELD_MUNICIPALITY_ID=>$this->getMunicipalityId());
		return SchoolUnits::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Prefectures which references this Municipalities. Will return null in case reference is invalid.
	 * `municipalities`.`prefecture_id` -> `prefectures`.`prefecture_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Prefectures
	 */
	public function fetchPrefectures(PDO $db, $sort=null) {
		$filter=array(Prefectures::FIELD_PREFECTURE_ID=>$this->getPrefectureId());
		$result=Prefectures::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch TransferAreas which references this Municipalities. Will return null in case reference is invalid.
	 * `municipalities`.`transfer_area_id` -> `transfer_areas`.`transfer_area_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return TransferAreas
	 */
	public function fetchTransferAreas(PDO $db, $sort=null) {
		$filter=array(TransferAreas::FIELD_TRANSFER_AREA_ID=>$this->getTransferAreaId());
		$result=TransferAreas::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'Municipalities');
	}

	/**
	 * get single Municipalities instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return Municipalities
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new Municipalities();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of Municipalities from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return Municipalities[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('Municipalities') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>