<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class Labs extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='Labs';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='labs';
	const SQL_INSERT='INSERT INTO `labs` (`lab_id`,`name`,`special_name`,`creation_date`,`created_by`,`last_updated`,`updated_by`,`positioning`,`comments`,`operational_rating`,`technological_rating`,`lab_type_id`,`school_unit_id`,`state_id`,`lab_source_id`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `labs` (`name`,`special_name`,`creation_date`,`created_by`,`last_updated`,`updated_by`,`positioning`,`comments`,`operational_rating`,`technological_rating`,`lab_type_id`,`school_unit_id`,`state_id`,`lab_source_id`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `labs` SET `lab_id`=?,`name`=?,`special_name`=?,`creation_date`=?,`created_by`=?,`last_updated`=?,`updated_by`=?,`positioning`=?,`comments`=?,`operational_rating`=?,`technological_rating`=?,`lab_type_id`=?,`school_unit_id`=?,`state_id`=?,`lab_source_id`=? WHERE `lab_id`=?';
	const SQL_SELECT_PK='SELECT * FROM `labs` WHERE `lab_id`=?';
	const SQL_DELETE_PK='DELETE FROM `labs` WHERE `lab_id`=?';
	const FIELD_LAB_ID=198695797;
	const FIELD_NAME=-263420173;
	const FIELD_SPECIAL_NAME=-323509575;
	const FIELD_CREATION_DATE=1045435814;
	const FIELD_CREATED_BY=1397475190;
	const FIELD_LAST_UPDATED=1279936634;
	const FIELD_UPDATED_BY=-267669309;
	const FIELD_POSITIONING=724218033;
	const FIELD_COMMENTS=-964397476;
	const FIELD_OPERATIONAL_RATING=1673212178;
	const FIELD_TECHNOLOGICAL_RATING=-523296366;
	const FIELD_LAB_TYPE_ID=-1349256666;
	const FIELD_SCHOOL_UNIT_ID=-252251565;
	const FIELD_STATE_ID=956215281;
	const FIELD_LAB_SOURCE_ID=-1772976091;
	private static $PRIMARY_KEYS=array(self::FIELD_LAB_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_LAB_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_LAB_ID=>'lab_id',
		self::FIELD_NAME=>'name',
		self::FIELD_SPECIAL_NAME=>'special_name',
		self::FIELD_CREATION_DATE=>'creation_date',
		self::FIELD_CREATED_BY=>'created_by',
		self::FIELD_LAST_UPDATED=>'last_updated',
		self::FIELD_UPDATED_BY=>'updated_by',
		self::FIELD_POSITIONING=>'positioning',
		self::FIELD_COMMENTS=>'comments',
		self::FIELD_OPERATIONAL_RATING=>'operational_rating',
		self::FIELD_TECHNOLOGICAL_RATING=>'technological_rating',
		self::FIELD_LAB_TYPE_ID=>'lab_type_id',
		self::FIELD_SCHOOL_UNIT_ID=>'school_unit_id',
		self::FIELD_STATE_ID=>'state_id',
		self::FIELD_LAB_SOURCE_ID=>'lab_source_id');
	private static $PROPERTY_NAMES=array(
		self::FIELD_LAB_ID=>'labId',
		self::FIELD_NAME=>'name',
		self::FIELD_SPECIAL_NAME=>'specialName',
		self::FIELD_CREATION_DATE=>'creationDate',
		self::FIELD_CREATED_BY=>'createdBy',
		self::FIELD_LAST_UPDATED=>'lastUpdated',
		self::FIELD_UPDATED_BY=>'updatedBy',
		self::FIELD_POSITIONING=>'positioning',
		self::FIELD_COMMENTS=>'comments',
		self::FIELD_OPERATIONAL_RATING=>'operationalRating',
		self::FIELD_TECHNOLOGICAL_RATING=>'technologicalRating',
		self::FIELD_LAB_TYPE_ID=>'labTypeId',
		self::FIELD_SCHOOL_UNIT_ID=>'schoolUnitId',
		self::FIELD_STATE_ID=>'stateId',
		self::FIELD_LAB_SOURCE_ID=>'labSourceId');
	private static $PROPERTY_TYPES=array(
		self::FIELD_LAB_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_NAME=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SPECIAL_NAME=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_CREATION_DATE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_CREATED_BY=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_LAST_UPDATED=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_UPDATED_BY=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_POSITIONING=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_COMMENTS=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_OPERATIONAL_RATING=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_TECHNOLOGICAL_RATING=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_LAB_TYPE_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_SCHOOL_UNIT_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_STATE_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_LAB_SOURCE_ID=>Db2PhpEntity::PHP_TYPE_INT);
	private static $FIELD_TYPES=array(
		self::FIELD_LAB_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_NAME=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_SPECIAL_NAME=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_CREATION_DATE=>array(Db2PhpEntity::JDBC_TYPE_TIMESTAMP,19,0,true),
		self::FIELD_CREATED_BY=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_LAST_UPDATED=>array(Db2PhpEntity::JDBC_TYPE_TIMESTAMP,19,0,true),
		self::FIELD_UPDATED_BY=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_POSITIONING=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_COMMENTS=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_OPERATIONAL_RATING=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_TECHNOLOGICAL_RATING=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_LAB_TYPE_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_SCHOOL_UNIT_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_STATE_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_LAB_SOURCE_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_LAB_ID=>null,
		self::FIELD_NAME=>null,
		self::FIELD_SPECIAL_NAME=>null,
		self::FIELD_CREATION_DATE=>null,
		self::FIELD_CREATED_BY=>null,
		self::FIELD_LAST_UPDATED=>null,
		self::FIELD_UPDATED_BY=>null,
		self::FIELD_POSITIONING=>null,
		self::FIELD_COMMENTS=>null,
		self::FIELD_OPERATIONAL_RATING=>null,
		self::FIELD_TECHNOLOGICAL_RATING=>null,
		self::FIELD_LAB_TYPE_ID=>null,
		self::FIELD_SCHOOL_UNIT_ID=>null,
		self::FIELD_STATE_ID=>null,
		self::FIELD_LAB_SOURCE_ID=>null);
	private $labId;
	private $name;
	private $specialName;
	private $creationDate;
	private $createdBy;
	private $lastUpdated;
	private $updatedBy;
	private $positioning;
	private $comments;
	private $operationalRating;
	private $technologicalRating;
	private $labTypeId;
	private $schoolUnitId;
	private $stateId;
	private $labSourceId;

	/**
	 * set value for lab_id Ο κωδικός ενός σχολικού εργαστηρίου.
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $labId
	 * @return Labs
	 */
	public function &setLabId($labId) {
		$this->notifyChanged(self::FIELD_LAB_ID,$this->labId,$labId);
		$this->labId=$labId;
		return $this;
	}

	/**
	 * get value for lab_id Ο κωδικός ενός σχολικού εργαστηρίου.
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @return mixed
	 */
	public function getLabId() {
		return $this->labId;
	}

	/**
	 * set value for name Το όνομα του σχολικού εργαστηρίου.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $name
	 * @return Labs
	 */
	public function &setName($name) {
		$this->notifyChanged(self::FIELD_NAME,$this->name,$name);
		$this->name=$name;
		return $this;
	}

	/**
	 * get value for name Το όνομα του σχολικού εργαστηρίου.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * set value for special_name Το ειδικό όνομα του σχολικού εργαστηρίου.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $specialName
	 * @return Labs
	 */
	public function &setSpecialName($specialName) {
		$this->notifyChanged(self::FIELD_SPECIAL_NAME,$this->specialName,$specialName);
		$this->specialName=$specialName;
		return $this;
	}

	/**
	 * get value for special_name Το ειδικό όνομα του σχολικού εργαστηρίου.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSpecialName() {
		return $this->specialName;
	}

	/**
	 * set value for creation_date Η ημερομηνία δημιουργίας της εγγραφής του σχολικού εργαστηρίου.
	 *
	 * type:DATETIME,size:19,default:null,nullable
	 *
	 * @param mixed $creationDate
	 * @return Labs
	 */
	public function &setCreationDate($creationDate) {
		$this->notifyChanged(self::FIELD_CREATION_DATE,$this->creationDate,$creationDate);
		$this->creationDate=$creationDate;
		return $this;
	}

	/**
	 * get value for creation_date Η ημερομηνία δημιουργίας της εγγραφής του σχολικού εργαστηρίου.
	 *
	 * type:DATETIME,size:19,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getCreationDate() {
		return $this->creationDate;
	}

	/**
	 * set value for created_by Ο υπεύθυνος δημιουργίας του σχολικού εργαστηρίου. 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $createdBy
	 * @return Labs
	 */
	public function &setCreatedBy($createdBy) {
		$this->notifyChanged(self::FIELD_CREATED_BY,$this->createdBy,$createdBy);
		$this->createdBy=$createdBy;
		return $this;
	}

	/**
	 * get value for created_by Ο υπεύθυνος δημιουργίας του σχολικού εργαστηρίου. 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getCreatedBy() {
		return $this->createdBy;
	}

	/**
	 * set value for last_updated Η τελευταία ενημέρωση της εγγραφής του σχολικού εργαστηρίου.
	 *
	 * type:DATETIME,size:19,default:null,nullable
	 *
	 * @param mixed $lastUpdated
	 * @return Labs
	 */
	public function &setLastUpdated($lastUpdated) {
		$this->notifyChanged(self::FIELD_LAST_UPDATED,$this->lastUpdated,$lastUpdated);
		$this->lastUpdated=$lastUpdated;
		return $this;
	}

	/**
	 * get value for last_updated Η τελευταία ενημέρωση της εγγραφής του σχολικού εργαστηρίου.
	 *
	 * type:DATETIME,size:19,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getLastUpdated() {
		return $this->lastUpdated;
	}

	/**
	 * set value for updated_by Ο υπεύθυνος ενημέρωσης του σχολικού εργαστηρίου.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $updatedBy
	 * @return Labs
	 */
	public function &setUpdatedBy($updatedBy) {
		$this->notifyChanged(self::FIELD_UPDATED_BY,$this->updatedBy,$updatedBy);
		$this->updatedBy=$updatedBy;
		return $this;
	}

	/**
	 * get value for updated_by Ο υπεύθυνος ενημέρωσης του σχολικού εργαστηρίου.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getUpdatedBy() {
		return $this->updatedBy;
	}

	/**
	 * set value for positioning Η γεω-τοπογραφική θέσης του σχολικού εργαστηρίου.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $positioning
	 * @return Labs
	 */
	public function &setPositioning($positioning) {
		$this->notifyChanged(self::FIELD_POSITIONING,$this->positioning,$positioning);
		$this->positioning=$positioning;
		return $this;
	}

	/**
	 * get value for positioning Η γεω-τοπογραφική θέσης του σχολικού εργαστηρίου.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPositioning() {
		return $this->positioning;
	}

	/**
	 * set value for comments Σχόλια για το σχολικό εργαστηρίο.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $comments
	 * @return Labs
	 */
	public function &setComments($comments) {
		$this->notifyChanged(self::FIELD_COMMENTS,$this->comments,$comments);
		$this->comments=$comments;
		return $this;
	}

	/**
	 * get value for comments Σχόλια για το σχολικό εργαστηρίο.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getComments() {
		return $this->comments;
	}

	/**
	 * set value for operational_rating Η λειτουργική απόδοση του σχολικού εργαστηρίου.
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $operationalRating
	 * @return Labs
	 */
	public function &setOperationalRating($operationalRating) {
		$this->notifyChanged(self::FIELD_OPERATIONAL_RATING,$this->operationalRating,$operationalRating);
		$this->operationalRating=$operationalRating;
		return $this;
	}

	/**
	 * get value for operational_rating Η λειτουργική απόδοση του σχολικού εργαστηρίου.
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getOperationalRating() {
		return $this->operationalRating;
	}

	/**
	 * set value for technological_rating Η τεχνολογική απόδοση του σχολικού εργαστηρίου.
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $technologicalRating
	 * @return Labs
	 */
	public function &setTechnologicalRating($technologicalRating) {
		$this->notifyChanged(self::FIELD_TECHNOLOGICAL_RATING,$this->technologicalRating,$technologicalRating);
		$this->technologicalRating=$technologicalRating;
		return $this;
	}

	/**
	 * get value for technological_rating Η τεχνολογική απόδοση του σχολικού εργαστηρίου.
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getTechnologicalRating() {
		return $this->technologicalRating;
	}

	/**
	 * set value for lab_type_id Ο κωδικός του τύπου εργαστηρίου.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $labTypeId
	 * @return Labs
	 */
	public function &setLabTypeId($labTypeId) {
		$this->notifyChanged(self::FIELD_LAB_TYPE_ID,$this->labTypeId,$labTypeId);
		$this->labTypeId=$labTypeId;
		return $this;
	}

	/**
	 * get value for lab_type_id Ο κωδικός του τύπου εργαστηρίου.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getLabTypeId() {
		return $this->labTypeId;
	}

	/**
	 * set value for school_unit_id Ο κωδικός της σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $schoolUnitId
	 * @return Labs
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
	 * set value for state_id Ο κωδικός της λειτουργικής κατάστασης του σχολικού εργαστηρίου.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $stateId
	 * @return Labs
	 */
	public function &setStateId($stateId) {
		$this->notifyChanged(self::FIELD_STATE_ID,$this->stateId,$stateId);
		$this->stateId=$stateId;
		return $this;
	}

	/**
	 * get value for state_id Ο κωδικός της λειτουργικής κατάστασης του σχολικού εργαστηρίου.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getStateId() {
		return $this->stateId;
	}

	/**
	 * set value for lab_source_id Ο κωδικός της πρωτογενής πηγής εισαγωγής σχολικού εργαστηρίου.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $labSourceId
	 * @return Labs
	 */
	public function &setLabSourceId($labSourceId) {
		$this->notifyChanged(self::FIELD_LAB_SOURCE_ID,$this->labSourceId,$labSourceId);
		$this->labSourceId=$labSourceId;
		return $this;
	}

	/**
	 * get value for lab_source_id Ο κωδικός της πρωτογενής πηγής εισαγωγής σχολικού εργαστηρίου.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getLabSourceId() {
		return $this->labSourceId;
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
			self::FIELD_LAB_ID=>$this->getLabId(),
			self::FIELD_NAME=>$this->getName(),
			self::FIELD_SPECIAL_NAME=>$this->getSpecialName(),
			self::FIELD_CREATION_DATE=>$this->getCreationDate(),
			self::FIELD_CREATED_BY=>$this->getCreatedBy(),
			self::FIELD_LAST_UPDATED=>$this->getLastUpdated(),
			self::FIELD_UPDATED_BY=>$this->getUpdatedBy(),
			self::FIELD_POSITIONING=>$this->getPositioning(),
			self::FIELD_COMMENTS=>$this->getComments(),
			self::FIELD_OPERATIONAL_RATING=>$this->getOperationalRating(),
			self::FIELD_TECHNOLOGICAL_RATING=>$this->getTechnologicalRating(),
			self::FIELD_LAB_TYPE_ID=>$this->getLabTypeId(),
			self::FIELD_SCHOOL_UNIT_ID=>$this->getSchoolUnitId(),
			self::FIELD_STATE_ID=>$this->getStateId(),
			self::FIELD_LAB_SOURCE_ID=>$this->getLabSourceId());
	}


	/**
	 * return array with the field id as index and the field value as value for the identifier fields.
	 *
	 * @return array
	 */
	public function getPrimaryKeyValues() {
		return array(
			self::FIELD_LAB_ID=>$this->getLabId());
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
	 * Match by attributes of passed example instance and return matched rows as an array of Labs instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param Labs $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Labs[]
	 */
	public static function findByExample(PDO $db,Labs $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of Labs instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return Labs[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `labs`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of Labs instances
	 *
	 * @param PDOStatement $stmt
	 * @return Labs[]
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
	 * returns the result as an array of Labs instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return Labs[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new Labs();
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
	 * Execute select query and return matched rows as an array of Labs instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return Labs[]
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
		$sql='DELETE FROM `labs`'
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
		$this->setLabId($result['lab_id']);
		$this->setName($result['name']);
		$this->setSpecialName($result['special_name']);
		$this->setCreationDate($result['creation_date']);
		$this->setCreatedBy($result['created_by']);
		$this->setLastUpdated($result['last_updated']);
		$this->setUpdatedBy($result['updated_by']);
		$this->setPositioning($result['positioning']);
		$this->setComments($result['comments']);
		$this->setOperationalRating($result['operational_rating']);
		$this->setTechnologicalRating($result['technological_rating']);
		$this->setLabTypeId($result['lab_type_id']);
		$this->setSchoolUnitId($result['school_unit_id']);
		$this->setStateId($result['state_id']);
		$this->setLabSourceId($result['lab_source_id']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return Labs
	 */
	public static function findById(PDO $db,$labId) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
		$stmt->bindValue(1,$labId);
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
		$o=new Labs();
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
		$stmt->bindValue(1,$this->getLabId());
		$stmt->bindValue(2,$this->getName());
		$stmt->bindValue(3,$this->getSpecialName());
		$stmt->bindValue(4,$this->getCreationDate());
		$stmt->bindValue(5,$this->getCreatedBy());
		$stmt->bindValue(6,$this->getLastUpdated());
		$stmt->bindValue(7,$this->getUpdatedBy());
		$stmt->bindValue(8,$this->getPositioning());
		$stmt->bindValue(9,$this->getComments());
		$stmt->bindValue(10,$this->getOperationalRating());
		$stmt->bindValue(11,$this->getTechnologicalRating());
		$stmt->bindValue(12,$this->getLabTypeId());
		$stmt->bindValue(13,$this->getSchoolUnitId());
		$stmt->bindValue(14,$this->getStateId());
		$stmt->bindValue(15,$this->getLabSourceId());
	}


	/**
	 * Insert this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function insertIntoDatabase(PDO $db) {
		if (null===$this->getLabId()) {
			$stmt=self::prepareStatement($db,self::SQL_INSERT_AUTOINCREMENT);
			$stmt->bindValue(1,$this->getName());
			$stmt->bindValue(2,$this->getSpecialName());
			$stmt->bindValue(3,$this->getCreationDate());
			$stmt->bindValue(4,$this->getCreatedBy());
			$stmt->bindValue(5,$this->getLastUpdated());
			$stmt->bindValue(6,$this->getUpdatedBy());
			$stmt->bindValue(7,$this->getPositioning());
			$stmt->bindValue(8,$this->getComments());
			$stmt->bindValue(9,$this->getOperationalRating());
			$stmt->bindValue(10,$this->getTechnologicalRating());
			$stmt->bindValue(11,$this->getLabTypeId());
			$stmt->bindValue(12,$this->getSchoolUnitId());
			$stmt->bindValue(13,$this->getStateId());
			$stmt->bindValue(14,$this->getLabSourceId());
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
			$this->setLabId($lastInsertId);
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
		$stmt->bindValue(16,$this->getLabId());
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
		$stmt->bindValue(1,$this->getLabId());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Fetch LabAquisitionSources's which this Labs references.
	 * `labs`.`lab_id` -> `lab_aquisition_sources`.`lab_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return LabAquisitionSources[]
	 */
	public function fetchLabAquisitionSourcesCollection(PDO $db, $sort=null) {
		$filter=array(LabAquisitionSources::FIELD_LAB_ID=>$this->getLabId());
		return LabAquisitionSources::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch LabEquipmentTypes's which this Labs references.
	 * `labs`.`lab_id` -> `lab_equipment_types`.`lab_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return LabEquipmentTypes[]
	 */
	public function fetchLabEquipmentTypesCollection(PDO $db, $sort=null) {
		$filter=array(LabEquipmentTypes::FIELD_LAB_ID=>$this->getLabId());
		return LabEquipmentTypes::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch LabRelations's which this Labs references.
	 * `labs`.`lab_id` -> `lab_relations`.`lab_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return LabRelations[]
	 */
	public function fetchLabRelationsCollection(PDO $db, $sort=null) {
		$filter=array(LabRelations::FIELD_LAB_ID=>$this->getLabId());
		return LabRelations::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch LabTransitions's which this Labs references.
	 * `labs`.`lab_id` -> `lab_transitions`.`lab_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return LabTransitions[]
	 */
	public function fetchLabTransitionsCollection(PDO $db, $sort=null) {
		$filter=array(LabTransitions::FIELD_LAB_ID=>$this->getLabId());
		return LabTransitions::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch LabWorkers's which this Labs references.
	 * `labs`.`lab_id` -> `lab_workers`.`lab_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return LabWorkers[]
	 */
	public function fetchLabWorkersCollection(PDO $db, $sort=null) {
		$filter=array(LabWorkers::FIELD_LAB_ID=>$this->getLabId());
		return LabWorkers::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch LabSources which references this Labs. Will return null in case reference is invalid.
	 * `labs`.`lab_source_id` -> `lab_sources`.`lab_source_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return LabSources
	 */
	public function fetchLabSources(PDO $db, $sort=null) {
		$filter=array(LabSources::FIELD_LAB_SOURCE_ID=>$this->getLabSourceId());
		$result=LabSources::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch LabTypes which references this Labs. Will return null in case reference is invalid.
	 * `labs`.`lab_type_id` -> `lab_types`.`lab_type_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return LabTypes
	 */
	public function fetchLabTypes(PDO $db, $sort=null) {
		$filter=array(LabTypes::FIELD_LAB_TYPE_ID=>$this->getLabTypeId());
		$result=LabTypes::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch SchoolUnits which references this Labs. Will return null in case reference is invalid.
	 * `labs`.`school_unit_id` -> `school_units`.`school_unit_id`
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
	 * Fetch States which references this Labs. Will return null in case reference is invalid.
	 * `labs`.`state_id` -> `states`.`state_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return States
	 */
	public function fetchStates(PDO $db, $sort=null) {
		$filter=array(States::FIELD_STATE_ID=>$this->getStateId());
		$result=States::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}


	/**
	 * get element as DOM Document
	 *
	 * @return DOMDocument
	 */
	public function toDOM() {
		return self::hashToDomDocument($this->toHash(), 'Labs');
	}

	/**
	 * get single Labs instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return Labs
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new Labs();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of Labs from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return Labs[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('Labs') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>