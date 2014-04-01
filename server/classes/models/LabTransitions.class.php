<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class LabTransitions extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='LabTransitions';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='lab_transitions';
	const SQL_INSERT='INSERT INTO `lab_transitions` (`lab_transition_id`,`lab_id`,`from_state`,`to_state`,`transition_justification`,`transition_date`,`transition_source`) VALUES (?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `lab_transitions` (`lab_id`,`from_state`,`to_state`,`transition_justification`,`transition_date`,`transition_source`) VALUES (?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `lab_transitions` SET `lab_transition_id`=?,`lab_id`=?,`from_state`=?,`to_state`=?,`transition_justification`=?,`transition_date`=?,`transition_source`=? WHERE `lab_transition_id`=?';
	const SQL_SELECT_PK='SELECT * FROM `lab_transitions` WHERE `lab_transition_id`=?';
	const SQL_DELETE_PK='DELETE FROM `lab_transitions` WHERE `lab_transition_id`=?';
	const FIELD_LAB_TRANSITION_ID=704170417;
	const FIELD_LAB_ID=-98863313;
	const FIELD_FROM_STATE=1039181022;
	const FIELD_TO_STATE=12278639;
	const FIELD_TRANSITION_JUSTIFICATION=-1505297622;
	const FIELD_TRANSITION_DATE=-1770004362;
	const FIELD_TRANSITION_SOURCE=275269347;
	private static $PRIMARY_KEYS=array(self::FIELD_LAB_TRANSITION_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_LAB_TRANSITION_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_LAB_TRANSITION_ID=>'lab_transition_id',
		self::FIELD_LAB_ID=>'lab_id',
		self::FIELD_FROM_STATE=>'from_state',
		self::FIELD_TO_STATE=>'to_state',
		self::FIELD_TRANSITION_JUSTIFICATION=>'transition_justification',
		self::FIELD_TRANSITION_DATE=>'transition_date',
		self::FIELD_TRANSITION_SOURCE=>'transition_source');
	private static $PROPERTY_NAMES=array(
		self::FIELD_LAB_TRANSITION_ID=>'labTransitionId',
		self::FIELD_LAB_ID=>'labId',
		self::FIELD_FROM_STATE=>'fromState',
		self::FIELD_TO_STATE=>'toState',
		self::FIELD_TRANSITION_JUSTIFICATION=>'transitionJustification',
		self::FIELD_TRANSITION_DATE=>'transitionDate',
		self::FIELD_TRANSITION_SOURCE=>'transitionSource');
	private static $PROPERTY_TYPES=array(
		self::FIELD_LAB_TRANSITION_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_LAB_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_FROM_STATE=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_TO_STATE=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_TRANSITION_JUSTIFICATION=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_TRANSITION_DATE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_TRANSITION_SOURCE=>Db2PhpEntity::PHP_TYPE_STRING);
	private static $FIELD_TYPES=array(
		self::FIELD_LAB_TRANSITION_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_LAB_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_FROM_STATE=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_TO_STATE=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_TRANSITION_JUSTIFICATION=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_TRANSITION_DATE=>array(Db2PhpEntity::JDBC_TYPE_DATE,10,0,true),
		self::FIELD_TRANSITION_SOURCE=>array(Db2PhpEntity::JDBC_TYPE_CHAR,6,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_LAB_TRANSITION_ID=>null,
		self::FIELD_LAB_ID=>null,
		self::FIELD_FROM_STATE=>null,
		self::FIELD_TO_STATE=>null,
		self::FIELD_TRANSITION_JUSTIFICATION=>null,
		self::FIELD_TRANSITION_DATE=>null,
		self::FIELD_TRANSITION_SOURCE=>null);
	private $labTransitionId;
	private $labId;
	private $fromState;
	private $toState;
	private $transitionJustification;
	private $transitionDate;
	private $transitionSource;

	/**
	 * set value for lab_transition_id Ο κωδικός κατάστασης λειτουργικής μετάβασης ενός σχολικού εργαστηρίου.
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $labTransitionId
	 * @return LabTransitions
	 */
	public function &setLabTransitionId($labTransitionId) {
		$this->notifyChanged(self::FIELD_LAB_TRANSITION_ID,$this->labTransitionId,$labTransitionId);
		$this->labTransitionId=$labTransitionId;
		return $this;
	}

	/**
	 * get value for lab_transition_id Ο κωδικός κατάστασης λειτουργικής μετάβασης ενός σχολικού εργαστηρίου.
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @return mixed
	 */
	public function getLabTransitionId() {
		return $this->labTransitionId;
	}

	/**
	 * set value for lab_id Ο κωδικός σχολικού εργαστηρίου.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $labId
	 * @return LabTransitions
	 */
	public function &setLabId($labId) {
		$this->notifyChanged(self::FIELD_LAB_ID,$this->labId,$labId);
		$this->labId=$labId;
		return $this;
	}

	/**
	 * get value for lab_id Ο κωδικός σχολικού εργαστηρίου.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getLabId() {
		return $this->labId;
	}

	/**
	 * set value for from_state Η προηγούμενη κατάσταση λειτουργικότητας του σχολικού εργαστηρίου.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $fromState
	 * @return LabTransitions
	 */
	public function &setFromState($fromState) {
		$this->notifyChanged(self::FIELD_FROM_STATE,$this->fromState,$fromState);
		$this->fromState=$fromState;
		return $this;
	}

	/**
	 * get value for from_state Η προηγούμενη κατάσταση λειτουργικότητας του σχολικού εργαστηρίου.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getFromState() {
		return $this->fromState;
	}

	/**
	 * set value for to_state Η τρέχουσα κατάσταση λειτουργικότητας του σχολικού εργαστηρίου.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $toState
	 * @return LabTransitions
	 */
	public function &setToState($toState) {
		$this->notifyChanged(self::FIELD_TO_STATE,$this->toState,$toState);
		$this->toState=$toState;
		return $this;
	}

	/**
	 * get value for to_state Η τρέχουσα κατάσταση λειτουργικότητας του σχολικού εργαστηρίου.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getToState() {
		return $this->toState;
	}

	/**
	 * set value for transition_justification Η αιτιολογία αλλάγης της κατάστασης μετάβασης λειτουργικότητας  του σχολικού εργαστηρίου.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $transitionJustification
	 * @return LabTransitions
	 */
	public function &setTransitionJustification($transitionJustification) {
		$this->notifyChanged(self::FIELD_TRANSITION_JUSTIFICATION,$this->transitionJustification,$transitionJustification);
		$this->transitionJustification=$transitionJustification;
		return $this;
	}

	/**
	 * get value for transition_justification Η αιτιολογία αλλάγης της κατάστασης μετάβασης λειτουργικότητας  του σχολικού εργαστηρίου.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getTransitionJustification() {
		return $this->transitionJustification;
	}

	/**
	 * set value for transition_date Η ημερομηνία αλλάγης της κατάστασης μετάβασης λειτουργικότητας  του σχολικού εργαστηρίου.
	 *
	 * type:DATE,size:10,default:null,nullable
	 *
	 * @param mixed $transitionDate
	 * @return LabTransitions
	 */
	public function &setTransitionDate($transitionDate) {
		$this->notifyChanged(self::FIELD_TRANSITION_DATE,$this->transitionDate,$transitionDate);
		$this->transitionDate=$transitionDate;
		return $this;
	}

	/**
	 * get value for transition_date Η ημερομηνία αλλάγης της κατάστασης μετάβασης λειτουργικότητας  του σχολικού εργαστηρίου.
	 *
	 * type:DATE,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getTransitionDate() {
		return $this->transitionDate;
	}

	/**
	 * set value for transition_source Η πρωτογενής πηγή αλλάγης της κατάστασης μετάβασης λειτουργικότητας  του σχολικού εργαστηρίου (mmsch ή mylab).
	 *
	 * type:ENUM,size:6,default:null,nullable
	 *
	 * @param mixed $transitionSource
	 * @return LabTransitions
	 */
	public function &setTransitionSource($transitionSource) {
		$this->notifyChanged(self::FIELD_TRANSITION_SOURCE,$this->transitionSource,$transitionSource);
		$this->transitionSource=$transitionSource;
		return $this;
	}

	/**
	 * get value for transition_source Η πρωτογενής πηγή αλλάγης της κατάστασης μετάβασης λειτουργικότητας  του σχολικού εργαστηρίου (mmsch ή mylab).
	 *
	 * type:ENUM,size:6,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getTransitionSource() {
		return $this->transitionSource;
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
			self::FIELD_LAB_TRANSITION_ID=>$this->getLabTransitionId(),
			self::FIELD_LAB_ID=>$this->getLabId(),
			self::FIELD_FROM_STATE=>$this->getFromState(),
			self::FIELD_TO_STATE=>$this->getToState(),
			self::FIELD_TRANSITION_JUSTIFICATION=>$this->getTransitionJustification(),
			self::FIELD_TRANSITION_DATE=>$this->getTransitionDate(),
			self::FIELD_TRANSITION_SOURCE=>$this->getTransitionSource());
	}


	/**
	 * return array with the field id as index and the field value as value for the identifier fields.
	 *
	 * @return array
	 */
	public function getPrimaryKeyValues() {
		return array(
			self::FIELD_LAB_TRANSITION_ID=>$this->getLabTransitionId());
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
	 * Match by attributes of passed example instance and return matched rows as an array of LabTransitions instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param LabTransitions $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return LabTransitions[]
	 */
	public static function findByExample(PDO $db,LabTransitions $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of LabTransitions instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return LabTransitions[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `lab_transitions`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of LabTransitions instances
	 *
	 * @param PDOStatement $stmt
	 * @return LabTransitions[]
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
	 * returns the result as an array of LabTransitions instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return LabTransitions[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new LabTransitions();
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
	 * Execute select query and return matched rows as an array of LabTransitions instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return LabTransitions[]
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
		$sql='DELETE FROM `lab_transitions`'
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
		$this->setLabTransitionId($result['lab_transition_id']);
		$this->setLabId($result['lab_id']);
		$this->setFromState($result['from_state']);
		$this->setToState($result['to_state']);
		$this->setTransitionJustification($result['transition_justification']);
		$this->setTransitionDate($result['transition_date']);
		$this->setTransitionSource($result['transition_source']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return LabTransitions
	 */
	public static function findById(PDO $db,$labTransitionId) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
		$stmt->bindValue(1,$labTransitionId);
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
		$o=new LabTransitions();
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
		$stmt->bindValue(1,$this->getLabTransitionId());
		$stmt->bindValue(2,$this->getLabId());
		$stmt->bindValue(3,$this->getFromState());
		$stmt->bindValue(4,$this->getToState());
		$stmt->bindValue(5,$this->getTransitionJustification());
		$stmt->bindValue(6,$this->getTransitionDate());
		$stmt->bindValue(7,$this->getTransitionSource());
	}


	/**
	 * Insert this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function insertIntoDatabase(PDO $db) {
		if (null===$this->getLabTransitionId()) {
			$stmt=self::prepareStatement($db,self::SQL_INSERT_AUTOINCREMENT);
			$stmt->bindValue(1,$this->getLabId());
			$stmt->bindValue(2,$this->getFromState());
			$stmt->bindValue(3,$this->getToState());
			$stmt->bindValue(4,$this->getTransitionJustification());
			$stmt->bindValue(5,$this->getTransitionDate());
			$stmt->bindValue(6,$this->getTransitionSource());
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
			$this->setLabTransitionId($lastInsertId);
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
		$stmt->bindValue(8,$this->getLabTransitionId());
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
		$stmt->bindValue(1,$this->getLabTransitionId());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Fetch States which references this LabTransitions. Will return null in case reference is invalid.
	 * `lab_transitions`.`from_state` -> `states`.`state_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return States
	 */
	public function fetchStates(PDO $db, $sort=null) {
		$filter=array(States::FIELD_STATE_ID=>$this->getFromState());
		$result=States::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch Labs which references this LabTransitions. Will return null in case reference is invalid.
	 * `lab_transitions`.`lab_id` -> `labs`.`lab_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Labs
	 */
	public function fetchLabs(PDO $db, $sort=null) {
		$filter=array(Labs::FIELD_LAB_ID=>$this->getLabId());
		$result=Labs::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch States1 which references this LabTransitions. Will return null in case reference is invalid.
	 * `lab_transitions`.`to_state` -> `states`.`state_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return States1
	 */
	public function fetchStates1(PDO $db, $sort=null) {
		$filter=array(States1::FIELD_STATE_ID=>$this->getToState());
		$result=States1::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'LabTransitions');
	}

	/**
	 * get single LabTransitions instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return LabTransitions
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new LabTransitions();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of LabTransitions from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return LabTransitions[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('LabTransitions') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>