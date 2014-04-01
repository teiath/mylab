<?php

/**
 * 
 *
 * @version 1.107
 * @package entity
 */
class SchoolUnits extends Db2PhpEntityBase implements Db2PhpEntityModificationTracking {
	private static $CLASS_NAME='SchoolUnits';
	const SQL_IDENTIFIER_QUOTE='`';
	const SQL_TABLE_NAME='school_units';
	const SQL_INSERT='INSERT INTO `school_units` (`school_unit_id`,`name`,`special_name`,`last_update`,`fax_number`,`phone_number`,`email`,`street_address`,`postal_code`,`region_edu_admin_id`,`edu_admin_id`,`transfer_area_id`,`municipality_id`,`prefecture_id`,`education_level_id`,`school_unit_type_id`,`state_id`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_INSERT_AUTOINCREMENT='INSERT INTO `school_units` (`name`,`special_name`,`last_update`,`fax_number`,`phone_number`,`email`,`street_address`,`postal_code`,`region_edu_admin_id`,`edu_admin_id`,`transfer_area_id`,`municipality_id`,`prefecture_id`,`education_level_id`,`school_unit_type_id`,`state_id`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
	const SQL_UPDATE='UPDATE `school_units` SET `school_unit_id`=?,`name`=?,`special_name`=?,`last_update`=?,`fax_number`=?,`phone_number`=?,`email`=?,`street_address`=?,`postal_code`=?,`region_edu_admin_id`=?,`edu_admin_id`=?,`transfer_area_id`=?,`municipality_id`=?,`prefecture_id`=?,`education_level_id`=?,`school_unit_type_id`=?,`state_id`=? WHERE `school_unit_id`=?';
	const SQL_SELECT_PK='SELECT * FROM `school_units` WHERE `school_unit_id`=?';
	const SQL_DELETE_PK='DELETE FROM `school_units` WHERE `school_unit_id`=?';
	const FIELD_SCHOOL_UNIT_ID=1093962805;
	const FIELD_NAME=-2008763563;
	const FIELD_SPECIAL_NAME=-1846129381;
	const FIELD_LAST_UPDATE=684908168;
	const FIELD_FAX_NUMBER=712571893;
	const FIELD_PHONE_NUMBER=-1193733628;
	const FIELD_EMAIL=2144873490;
	const FIELD_STREET_ADDRESS=2010784770;
	const FIELD_POSTAL_CODE=837476567;
	const FIELD_REGION_EDU_ADMIN_ID=1605924821;
	const FIELD_EDU_ADMIN_ID=-2131280578;
	const FIELD_TRANSFER_AREA_ID=-1376430205;
	const FIELD_MUNICIPALITY_ID=-1906880332;
	const FIELD_PREFECTURE_ID=422638107;
	const FIELD_EDUCATION_LEVEL_ID=1098050999;
	const FIELD_SCHOOL_UNIT_TYPE_ID=273138022;
	const FIELD_STATE_ID=-2040145069;
	private static $PRIMARY_KEYS=array(self::FIELD_SCHOOL_UNIT_ID);
	private static $AUTOINCREMENT_FIELDS=array(self::FIELD_SCHOOL_UNIT_ID);
	private static $FIELD_NAMES=array(
		self::FIELD_SCHOOL_UNIT_ID=>'school_unit_id',
		self::FIELD_NAME=>'name',
		self::FIELD_SPECIAL_NAME=>'special_name',
		self::FIELD_LAST_UPDATE=>'last_update',
		self::FIELD_FAX_NUMBER=>'fax_number',
		self::FIELD_PHONE_NUMBER=>'phone_number',
		self::FIELD_EMAIL=>'email',
		self::FIELD_STREET_ADDRESS=>'street_address',
		self::FIELD_POSTAL_CODE=>'postal_code',
		self::FIELD_REGION_EDU_ADMIN_ID=>'region_edu_admin_id',
		self::FIELD_EDU_ADMIN_ID=>'edu_admin_id',
		self::FIELD_TRANSFER_AREA_ID=>'transfer_area_id',
		self::FIELD_MUNICIPALITY_ID=>'municipality_id',
		self::FIELD_PREFECTURE_ID=>'prefecture_id',
		self::FIELD_EDUCATION_LEVEL_ID=>'education_level_id',
		self::FIELD_SCHOOL_UNIT_TYPE_ID=>'school_unit_type_id',
		self::FIELD_STATE_ID=>'state_id');
	private static $PROPERTY_NAMES=array(
		self::FIELD_SCHOOL_UNIT_ID=>'schoolUnitId',
		self::FIELD_NAME=>'name',
		self::FIELD_SPECIAL_NAME=>'specialName',
		self::FIELD_LAST_UPDATE=>'lastUpdate',
		self::FIELD_FAX_NUMBER=>'faxNumber',
		self::FIELD_PHONE_NUMBER=>'phoneNumber',
		self::FIELD_EMAIL=>'email',
		self::FIELD_STREET_ADDRESS=>'streetAddress',
		self::FIELD_POSTAL_CODE=>'postalCode',
		self::FIELD_REGION_EDU_ADMIN_ID=>'regionEduAdminId',
		self::FIELD_EDU_ADMIN_ID=>'eduAdminId',
		self::FIELD_TRANSFER_AREA_ID=>'transferAreaId',
		self::FIELD_MUNICIPALITY_ID=>'municipalityId',
		self::FIELD_PREFECTURE_ID=>'prefectureId',
		self::FIELD_EDUCATION_LEVEL_ID=>'educationLevelId',
		self::FIELD_SCHOOL_UNIT_TYPE_ID=>'schoolUnitTypeId',
		self::FIELD_STATE_ID=>'stateId');
	private static $PROPERTY_TYPES=array(
		self::FIELD_SCHOOL_UNIT_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_NAME=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_SPECIAL_NAME=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_LAST_UPDATE=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_FAX_NUMBER=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_PHONE_NUMBER=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_EMAIL=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_STREET_ADDRESS=>Db2PhpEntity::PHP_TYPE_STRING,
		self::FIELD_POSTAL_CODE=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_REGION_EDU_ADMIN_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EDU_ADMIN_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_TRANSFER_AREA_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_MUNICIPALITY_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_PREFECTURE_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_EDUCATION_LEVEL_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_SCHOOL_UNIT_TYPE_ID=>Db2PhpEntity::PHP_TYPE_INT,
		self::FIELD_STATE_ID=>Db2PhpEntity::PHP_TYPE_INT);
	private static $FIELD_TYPES=array(
		self::FIELD_SCHOOL_UNIT_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,false),
		self::FIELD_NAME=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_SPECIAL_NAME=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_LAST_UPDATE=>array(Db2PhpEntity::JDBC_TYPE_TIMESTAMP,19,0,true),
		self::FIELD_FAX_NUMBER=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_PHONE_NUMBER=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_EMAIL=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_STREET_ADDRESS=>array(Db2PhpEntity::JDBC_TYPE_VARCHAR,255,0,true),
		self::FIELD_POSTAL_CODE=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_REGION_EDU_ADMIN_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_EDU_ADMIN_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_TRANSFER_AREA_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_MUNICIPALITY_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_PREFECTURE_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_EDUCATION_LEVEL_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_SCHOOL_UNIT_TYPE_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true),
		self::FIELD_STATE_ID=>array(Db2PhpEntity::JDBC_TYPE_INTEGER,10,0,true));
	private static $DEFAULT_VALUES=array(
		self::FIELD_SCHOOL_UNIT_ID=>null,
		self::FIELD_NAME=>null,
		self::FIELD_SPECIAL_NAME=>null,
		self::FIELD_LAST_UPDATE=>null,
		self::FIELD_FAX_NUMBER=>null,
		self::FIELD_PHONE_NUMBER=>null,
		self::FIELD_EMAIL=>null,
		self::FIELD_STREET_ADDRESS=>null,
		self::FIELD_POSTAL_CODE=>null,
		self::FIELD_REGION_EDU_ADMIN_ID=>null,
		self::FIELD_EDU_ADMIN_ID=>null,
		self::FIELD_TRANSFER_AREA_ID=>null,
		self::FIELD_MUNICIPALITY_ID=>null,
		self::FIELD_PREFECTURE_ID=>null,
		self::FIELD_EDUCATION_LEVEL_ID=>null,
		self::FIELD_SCHOOL_UNIT_TYPE_ID=>null,
		self::FIELD_STATE_ID=>null);
	private $schoolUnitId;
	private $name;
	private $specialName;
	private $lastUpdate;
	private $faxNumber;
	private $phoneNumber;
	private $email;
	private $streetAddress;
	private $postalCode;
	private $regionEduAdminId;
	private $eduAdminId;
	private $transferAreaId;
	private $municipalityId;
	private $prefectureId;
	private $educationLevelId;
	private $schoolUnitTypeId;
	private $stateId;

	/**
	 * set value for school_unit_id Ο κωδικός μιας σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @param mixed $schoolUnitId
	 * @return SchoolUnits
	 */
	public function &setSchoolUnitId($schoolUnitId) {
		$this->notifyChanged(self::FIELD_SCHOOL_UNIT_ID,$this->schoolUnitId,$schoolUnitId);
		$this->schoolUnitId=$schoolUnitId;
		return $this;
	}

	/**
	 * get value for school_unit_id Ο κωδικός μιας σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,primary,unique,autoincrement
	 *
	 * @return mixed
	 */
	public function getSchoolUnitId() {
		return $this->schoolUnitId;
	}

	/**
	 * set value for name Το όνομα της σχολικής μονάδας.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $name
	 * @return SchoolUnits
	 */
	public function &setName($name) {
		$this->notifyChanged(self::FIELD_NAME,$this->name,$name);
		$this->name=$name;
		return $this;
	}

	/**
	 * get value for name Το όνομα της σχολικής μονάδας.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * set value for special_name Το ειδικό όνομα της σχολικής μονάδας.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $specialName
	 * @return SchoolUnits
	 */
	public function &setSpecialName($specialName) {
		$this->notifyChanged(self::FIELD_SPECIAL_NAME,$this->specialName,$specialName);
		$this->specialName=$specialName;
		return $this;
	}

	/**
	 * get value for special_name Το ειδικό όνομα της σχολικής μονάδας.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getSpecialName() {
		return $this->specialName;
	}

	/**
	 * set value for last_update Η τελευταία ενημέρωση της εγγραφής της σχολικής μονάδας.
	 *
	 * type:DATETIME,size:19,default:null,nullable
	 *
	 * @param mixed $lastUpdate
	 * @return SchoolUnits
	 */
	public function &setLastUpdate($lastUpdate) {
		$this->notifyChanged(self::FIELD_LAST_UPDATE,$this->lastUpdate,$lastUpdate);
		$this->lastUpdate=$lastUpdate;
		return $this;
	}

	/**
	 * get value for last_update Η τελευταία ενημέρωση της εγγραφής της σχολικής μονάδας.
	 *
	 * type:DATETIME,size:19,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getLastUpdate() {
		return $this->lastUpdate;
	}

	/**
	 * set value for fax_number Το φαξ της σχολικής μονάδας.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $faxNumber
	 * @return SchoolUnits
	 */
	public function &setFaxNumber($faxNumber) {
		$this->notifyChanged(self::FIELD_FAX_NUMBER,$this->faxNumber,$faxNumber);
		$this->faxNumber=$faxNumber;
		return $this;
	}

	/**
	 * get value for fax_number Το φαξ της σχολικής μονάδας.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getFaxNumber() {
		return $this->faxNumber;
	}

	/**
	 * set value for phone_number Το τηλεφωνο της σχολικής μονάδας.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $phoneNumber
	 * @return SchoolUnits
	 */
	public function &setPhoneNumber($phoneNumber) {
		$this->notifyChanged(self::FIELD_PHONE_NUMBER,$this->phoneNumber,$phoneNumber);
		$this->phoneNumber=$phoneNumber;
		return $this;
	}

	/**
	 * get value for phone_number Το τηλεφωνο της σχολικής μονάδας.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPhoneNumber() {
		return $this->phoneNumber;
	}

	/**
	 * set value for email Το ηλεκτρονικό ταχυδρομείο της σχολικής μονάδας. 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $email
	 * @return SchoolUnits
	 */
	public function &setEmail($email) {
		$this->notifyChanged(self::FIELD_EMAIL,$this->email,$email);
		$this->email=$email;
		return $this;
	}

	/**
	 * get value for email Το ηλεκτρονικό ταχυδρομείο της σχολικής μονάδας. 
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * set value for street_address Η διεύθυνση της σχολικής μονάδας.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @param mixed $streetAddress
	 * @return SchoolUnits
	 */
	public function &setStreetAddress($streetAddress) {
		$this->notifyChanged(self::FIELD_STREET_ADDRESS,$this->streetAddress,$streetAddress);
		$this->streetAddress=$streetAddress;
		return $this;
	}

	/**
	 * get value for street_address Η διεύθυνση της σχολικής μονάδας.
	 *
	 * type:VARCHAR,size:255,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getStreetAddress() {
		return $this->streetAddress;
	}

	/**
	 * set value for postal_code Ο ταχυδρομικός κωδικός της σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @param mixed $postalCode
	 * @return SchoolUnits
	 */
	public function &setPostalCode($postalCode) {
		$this->notifyChanged(self::FIELD_POSTAL_CODE,$this->postalCode,$postalCode);
		$this->postalCode=$postalCode;
		return $this;
	}

	/**
	 * get value for postal_code Ο ταχυδρομικός κωδικός της σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,nullable
	 *
	 * @return mixed
	 */
	public function getPostalCode() {
		return $this->postalCode;
	}

	/**
	 * set value for region_edu_admin_id Ο κωδικος της περιφέρειας εκπαίδευσης της σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $regionEduAdminId
	 * @return SchoolUnits
	 */
	public function &setRegionEduAdminId($regionEduAdminId) {
		$this->notifyChanged(self::FIELD_REGION_EDU_ADMIN_ID,$this->regionEduAdminId,$regionEduAdminId);
		$this->regionEduAdminId=$regionEduAdminId;
		return $this;
	}

	/**
	 * get value for region_edu_admin_id Ο κωδικος της περιφέρειας εκπαίδευσης της σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getRegionEduAdminId() {
		return $this->regionEduAdminId;
	}

	/**
	 * set value for edu_admin_id Ο κωδικος της διεύθυνσης εκπαίδευσης της σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $eduAdminId
	 * @return SchoolUnits
	 */
	public function &setEduAdminId($eduAdminId) {
		$this->notifyChanged(self::FIELD_EDU_ADMIN_ID,$this->eduAdminId,$eduAdminId);
		$this->eduAdminId=$eduAdminId;
		return $this;
	}

	/**
	 * get value for edu_admin_id Ο κωδικος της διεύθυνσης εκπαίδευσης της σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getEduAdminId() {
		return $this->eduAdminId;
	}

	/**
	 * set value for transfer_area_id Ο κωδικος της περιοχής μετάθεσης της σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $transferAreaId
	 * @return SchoolUnits
	 */
	public function &setTransferAreaId($transferAreaId) {
		$this->notifyChanged(self::FIELD_TRANSFER_AREA_ID,$this->transferAreaId,$transferAreaId);
		$this->transferAreaId=$transferAreaId;
		return $this;
	}

	/**
	 * get value for transfer_area_id Ο κωδικος της περιοχής μετάθεσης της σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getTransferAreaId() {
		return $this->transferAreaId;
	}

	/**
	 * set value for municipality_id Ο κωδικος του δήμου της σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $municipalityId
	 * @return SchoolUnits
	 */
	public function &setMunicipalityId($municipalityId) {
		$this->notifyChanged(self::FIELD_MUNICIPALITY_ID,$this->municipalityId,$municipalityId);
		$this->municipalityId=$municipalityId;
		return $this;
	}

	/**
	 * get value for municipality_id Ο κωδικος του δήμου της σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getMunicipalityId() {
		return $this->municipalityId;
	}

	/**
	 * set value for prefecture_id Ο κωδικος του νομού της σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $prefectureId
	 * @return SchoolUnits
	 */
	public function &setPrefectureId($prefectureId) {
		$this->notifyChanged(self::FIELD_PREFECTURE_ID,$this->prefectureId,$prefectureId);
		$this->prefectureId=$prefectureId;
		return $this;
	}

	/**
	 * get value for prefecture_id Ο κωδικος του νομού της σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getPrefectureId() {
		return $this->prefectureId;
	}

	/**
	 * set value for education_level_id Ο κωδικος της βαθμίδας εκπαίδευσης της σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $educationLevelId
	 * @return SchoolUnits
	 */
	public function &setEducationLevelId($educationLevelId) {
		$this->notifyChanged(self::FIELD_EDUCATION_LEVEL_ID,$this->educationLevelId,$educationLevelId);
		$this->educationLevelId=$educationLevelId;
		return $this;
	}

	/**
	 * get value for education_level_id Ο κωδικος της βαθμίδας εκπαίδευσης της σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getEducationLevelId() {
		return $this->educationLevelId;
	}

	/**
	 * set value for school_unit_type_id Ο κωδικος του τύπου σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $schoolUnitTypeId
	 * @return SchoolUnits
	 */
	public function &setSchoolUnitTypeId($schoolUnitTypeId) {
		$this->notifyChanged(self::FIELD_SCHOOL_UNIT_TYPE_ID,$this->schoolUnitTypeId,$schoolUnitTypeId);
		$this->schoolUnitTypeId=$schoolUnitTypeId;
		return $this;
	}

	/**
	 * get value for school_unit_type_id Ο κωδικος του τύπου σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getSchoolUnitTypeId() {
		return $this->schoolUnitTypeId;
	}

	/**
	 * set value for state_id Ο κωδικος  της λειτουργικής κατάστασης της σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @param mixed $stateId
	 * @return SchoolUnits
	 */
	public function &setStateId($stateId) {
		$this->notifyChanged(self::FIELD_STATE_ID,$this->stateId,$stateId);
		$this->stateId=$stateId;
		return $this;
	}

	/**
	 * get value for state_id Ο κωδικος  της λειτουργικής κατάστασης της σχολικής μονάδας.
	 *
	 * type:INT,size:10,default:null,index,nullable
	 *
	 * @return mixed
	 */
	public function getStateId() {
		return $this->stateId;
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
			self::FIELD_SCHOOL_UNIT_ID=>$this->getSchoolUnitId(),
			self::FIELD_NAME=>$this->getName(),
			self::FIELD_SPECIAL_NAME=>$this->getSpecialName(),
			self::FIELD_LAST_UPDATE=>$this->getLastUpdate(),
			self::FIELD_FAX_NUMBER=>$this->getFaxNumber(),
			self::FIELD_PHONE_NUMBER=>$this->getPhoneNumber(),
			self::FIELD_EMAIL=>$this->getEmail(),
			self::FIELD_STREET_ADDRESS=>$this->getStreetAddress(),
			self::FIELD_POSTAL_CODE=>$this->getPostalCode(),
			self::FIELD_REGION_EDU_ADMIN_ID=>$this->getRegionEduAdminId(),
			self::FIELD_EDU_ADMIN_ID=>$this->getEduAdminId(),
			self::FIELD_TRANSFER_AREA_ID=>$this->getTransferAreaId(),
			self::FIELD_MUNICIPALITY_ID=>$this->getMunicipalityId(),
			self::FIELD_PREFECTURE_ID=>$this->getPrefectureId(),
			self::FIELD_EDUCATION_LEVEL_ID=>$this->getEducationLevelId(),
			self::FIELD_SCHOOL_UNIT_TYPE_ID=>$this->getSchoolUnitTypeId(),
			self::FIELD_STATE_ID=>$this->getStateId());
	}


	/**
	 * return array with the field id as index and the field value as value for the identifier fields.
	 *
	 * @return array
	 */
	public function getPrimaryKeyValues() {
		return array(
			self::FIELD_SCHOOL_UNIT_ID=>$this->getSchoolUnitId());
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
	 * Match by attributes of passed example instance and return matched rows as an array of SchoolUnits instances
	 *
	 * @param PDO $db a PDO Database instance
	 * @param SchoolUnits $example an example instance defining the conditions. All non-null properties will be considered a constraint, null values will be ignored.
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return SchoolUnits[]
	 */
	public static function findByExample(PDO $db,SchoolUnits $example, $and=true, $sort=null) {
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
	 * Will return matched rows as an array of SchoolUnits instances.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $filter array of DFC instances defining the conditions
	 * @param boolean $and true if conditions should be and'ed, false if they should be or'ed
	 * @param array $sort array of DSC instances
	 * @return SchoolUnits[]
	 */
	public static function findByFilter(PDO $db, $filter, $and=true, $sort=null) {
		if (!($filter instanceof DFCInterface)) {
			$filter=new DFCAggregate($filter, $and);
		}
		$sql='SELECT * FROM `school_units`'
		. self::buildSqlWhere($filter, $and, false, true)
		. self::buildSqlOrderBy($sort);

		$stmt=self::prepareStatement($db, $sql);
		self::bindValuesForFilter($stmt, $filter);
		return self::fromStatement($stmt);
	}

	/**
	 * Will execute the passed statement and return the result as an array of SchoolUnits instances
	 *
	 * @param PDOStatement $stmt
	 * @return SchoolUnits[]
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
	 * returns the result as an array of SchoolUnits instances without executing the passed statement
	 *
	 * @param PDOStatement $stmt
	 * @return SchoolUnits[]
	 */
	public static function fromExecutedStatement(PDOStatement $stmt) {
		$resultInstances=array();
		while($result=$stmt->fetch(PDO::FETCH_ASSOC)) {
			$o=new SchoolUnits();
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
	 * Execute select query and return matched rows as an array of SchoolUnits instances.
	 *
	 * The query should of course be on the table for this entity class and return all fields.
	 *
	 * @param PDO $db a PDO Database instance
	 * @param string $sql
	 * @return SchoolUnits[]
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
		$sql='DELETE FROM `school_units`'
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
		$this->setSchoolUnitId($result['school_unit_id']);
		$this->setName($result['name']);
		$this->setSpecialName($result['special_name']);
		$this->setLastUpdate($result['last_update']);
		$this->setFaxNumber($result['fax_number']);
		$this->setPhoneNumber($result['phone_number']);
		$this->setEmail($result['email']);
		$this->setStreetAddress($result['street_address']);
		$this->setPostalCode($result['postal_code']);
		$this->setRegionEduAdminId($result['region_edu_admin_id']);
		$this->setEduAdminId($result['edu_admin_id']);
		$this->setTransferAreaId($result['transfer_area_id']);
		$this->setMunicipalityId($result['municipality_id']);
		$this->setPrefectureId($result['prefecture_id']);
		$this->setEducationLevelId($result['education_level_id']);
		$this->setSchoolUnitTypeId($result['school_unit_type_id']);
		$this->setStateId($result['state_id']);
	}

	/**
	 * Get element instance by it's primary key(s).
	 * Will return null if no row was matched.
	 *
	 * @param PDO $db
	 * @return SchoolUnits
	 */
	public static function findById(PDO $db,$schoolUnitId) {
		$stmt=self::prepareStatement($db,self::SQL_SELECT_PK);
		$stmt->bindValue(1,$schoolUnitId);
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
		$o=new SchoolUnits();
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
		$stmt->bindValue(1,$this->getSchoolUnitId());
		$stmt->bindValue(2,$this->getName());
		$stmt->bindValue(3,$this->getSpecialName());
		$stmt->bindValue(4,$this->getLastUpdate());
		$stmt->bindValue(5,$this->getFaxNumber());
		$stmt->bindValue(6,$this->getPhoneNumber());
		$stmt->bindValue(7,$this->getEmail());
		$stmt->bindValue(8,$this->getStreetAddress());
		$stmt->bindValue(9,$this->getPostalCode());
		$stmt->bindValue(10,$this->getRegionEduAdminId());
		$stmt->bindValue(11,$this->getEduAdminId());
		$stmt->bindValue(12,$this->getTransferAreaId());
		$stmt->bindValue(13,$this->getMunicipalityId());
		$stmt->bindValue(14,$this->getPrefectureId());
		$stmt->bindValue(15,$this->getEducationLevelId());
		$stmt->bindValue(16,$this->getSchoolUnitTypeId());
		$stmt->bindValue(17,$this->getStateId());
	}


	/**
	 * Insert this instance into the database
	 *
	 * @param PDO $db
	 * @return mixed
	 */
	public function insertIntoDatabase(PDO $db) {
		if (null===$this->getSchoolUnitId()) {
			$stmt=self::prepareStatement($db,self::SQL_INSERT_AUTOINCREMENT);
			$stmt->bindValue(1,$this->getName());
			$stmt->bindValue(2,$this->getSpecialName());
			$stmt->bindValue(3,$this->getLastUpdate());
			$stmt->bindValue(4,$this->getFaxNumber());
			$stmt->bindValue(5,$this->getPhoneNumber());
			$stmt->bindValue(6,$this->getEmail());
			$stmt->bindValue(7,$this->getStreetAddress());
			$stmt->bindValue(8,$this->getPostalCode());
			$stmt->bindValue(9,$this->getRegionEduAdminId());
			$stmt->bindValue(10,$this->getEduAdminId());
			$stmt->bindValue(11,$this->getTransferAreaId());
			$stmt->bindValue(12,$this->getMunicipalityId());
			$stmt->bindValue(13,$this->getPrefectureId());
			$stmt->bindValue(14,$this->getEducationLevelId());
			$stmt->bindValue(15,$this->getSchoolUnitTypeId());
			$stmt->bindValue(16,$this->getStateId());
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
			$this->setSchoolUnitId($lastInsertId);
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
		$stmt->bindValue(18,$this->getSchoolUnitId());
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
		$stmt->bindValue(1,$this->getSchoolUnitId());
		$affected=$stmt->execute();
		if (false===$affected) {
			$stmt->closeCursor();
			throw new Exception($stmt->errorCode() . ':' . var_export($stmt->errorInfo(), true), 0);
		}
		$stmt->closeCursor();
		return $affected;
	}

	/**
	 * Fetch Circuits's which this SchoolUnits references.
	 * `school_units`.`school_unit_id` -> `circuits`.`school_unit_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Circuits[]
	 */
	public function fetchCircuitsCollection(PDO $db, $sort=null) {
		$filter=array(Circuits::FIELD_SCHOOL_UNIT_ID=>$this->getSchoolUnitId());
		return Circuits::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch LabRelations's which this SchoolUnits references.
	 * `school_units`.`school_unit_id` -> `lab_relations`.`school_unit_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return LabRelations[]
	 */
	public function fetchLabRelationsCollection(PDO $db, $sort=null) {
		$filter=array(LabRelations::FIELD_SCHOOL_UNIT_ID=>$this->getSchoolUnitId());
		return LabRelations::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch Labs's which this SchoolUnits references.
	 * `school_units`.`school_unit_id` -> `labs`.`school_unit_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Labs[]
	 */
	public function fetchLabsCollection(PDO $db, $sort=null) {
		$filter=array(Labs::FIELD_SCHOOL_UNIT_ID=>$this->getSchoolUnitId());
		return Labs::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch SchoolUnitWorkers's which this SchoolUnits references.
	 * `school_units`.`school_unit_id` -> `school_unit_workers`.`school_unit_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return SchoolUnitWorkers[]
	 */
	public function fetchSchoolUnitWorkersCollection(PDO $db, $sort=null) {
		$filter=array(SchoolUnitWorkers::FIELD_SCHOOL_UNIT_ID=>$this->getSchoolUnitId());
		return SchoolUnitWorkers::findByFilter($db, $filter, true, $sort);
	}

	/**
	 * Fetch EducationLevels which references this SchoolUnits. Will return null in case reference is invalid.
	 * `school_units`.`education_level_id` -> `education_levels`.`education_level_id`
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
	 * Fetch EduAdmins which references this SchoolUnits. Will return null in case reference is invalid.
	 * `school_units`.`edu_admin_id` -> `edu_admins`.`edu_admin_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return EduAdmins
	 */
	public function fetchEduAdmins(PDO $db, $sort=null) {
		$filter=array(EduAdmins::FIELD_EDU_ADMIN_ID=>$this->getEduAdminId());
		$result=EduAdmins::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch Municipalities which references this SchoolUnits. Will return null in case reference is invalid.
	 * `school_units`.`municipality_id` -> `municipalities`.`municipality_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return Municipalities
	 */
	public function fetchMunicipalities(PDO $db, $sort=null) {
		$filter=array(Municipalities::FIELD_MUNICIPALITY_ID=>$this->getMunicipalityId());
		$result=Municipalities::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch Prefectures which references this SchoolUnits. Will return null in case reference is invalid.
	 * `school_units`.`prefecture_id` -> `prefectures`.`prefecture_id`
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
	 * Fetch RegionEduAdmins which references this SchoolUnits. Will return null in case reference is invalid.
	 * `school_units`.`region_edu_admin_id` -> `region_edu_admins`.`region_edu_admin_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return RegionEduAdmins
	 */
	public function fetchRegionEduAdmins(PDO $db, $sort=null) {
		$filter=array(RegionEduAdmins::FIELD_REGION_EDU_ADMIN_ID=>$this->getRegionEduAdminId());
		$result=RegionEduAdmins::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch SchoolUnitTypes which references this SchoolUnits. Will return null in case reference is invalid.
	 * `school_units`.`school_unit_type_id` -> `school_unit_types`.`school_unit_type_id`
	 *
	 * @param PDO $db a PDO Database instance
	 * @param array $sort array of DSC instances
	 * @return SchoolUnitTypes
	 */
	public function fetchSchoolUnitTypes(PDO $db, $sort=null) {
		$filter=array(SchoolUnitTypes::FIELD_SCHOOL_UNIT_TYPE_ID=>$this->getSchoolUnitTypeId());
		$result=SchoolUnitTypes::findByFilter($db, $filter, true, $sort);
		return empty($result) ? null : $result[0];
	}

	/**
	 * Fetch States which references this SchoolUnits. Will return null in case reference is invalid.
	 * `school_units`.`state_id` -> `states`.`state_id`
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
	 * Fetch TransferAreas which references this SchoolUnits. Will return null in case reference is invalid.
	 * `school_units`.`transfer_area_id` -> `transfer_areas`.`transfer_area_id`
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
		return self::hashToDomDocument($this->toHash(), 'SchoolUnits');
	}

	/**
	 * get single SchoolUnits instance from a DOMElement
	 *
	 * @param DOMElement $node
	 * @return SchoolUnits
	 */
	public static function fromDOMElement(DOMElement $node) {
		$o=new SchoolUnits();
		$o->assignByHash(self::domNodeToHash($node, self::$FIELD_NAMES, self::$DEFAULT_VALUES, self::$FIELD_TYPES));
			$o->notifyPristine();
		return $o;
	}

	/**
	 * get all instances of SchoolUnits from the passed DOMDocument
	 *
	 * @param DOMDocument $doc
	 * @return SchoolUnits[]
	 */
	public static function fromDOMDocument(DOMDocument $doc) {
		$instances=array();
		foreach ($doc->getElementsByTagName('SchoolUnits') as $node) {
			$instances[]=self::fromDOMElement($node);
		}
		return $instances;
	}

}
?>