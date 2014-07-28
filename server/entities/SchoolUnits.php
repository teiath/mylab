<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * SchoolUnits
 *
 * @ORM\Table(name="school_units", indexes={@ORM\Index(name="school_unit_region_edu_admin_idx", columns={"region_edu_admin_id"}), @ORM\Index(name="school_unit_edu_admin_idx", columns={"edu_admin_id"}), @ORM\Index(name="school_unit_transfer_area_idx", columns={"transfer_area_id"}), @ORM\Index(name="school_unit_municipality_idx", columns={"municipality_id"}), @ORM\Index(name="school_unit_prefecture_idx", columns={"prefecture_id"}), @ORM\Index(name="school_unit_education_level_idx", columns={"education_level_id"}), @ORM\Index(name="school_unit_school_unit_type_idx", columns={"school_unit_type_id"}), @ORM\Index(name="school_unit_school_states_idx", columns={"state_id"})})
 * @ORM\Entity
 */
class SchoolUnits
{
    /**
     * @var integer
     *
     * @ORM\Column(name="school_unit_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $schoolUnitId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="special_name", type="string", length=255, nullable=true)
     */
    private $specialName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_update", type="datetime", nullable=true)
     */
    private $lastUpdate;

    /**
     * @var string
     *
     * @ORM\Column(name="fax_number", type="string", length=255, nullable=true)
     */
    private $faxNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number", type="string", length=255, nullable=true)
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="street_address", type="string", length=255, nullable=true)
     */
    private $streetAddress;

    /**
     * @var integer
     *
     * @ORM\Column(name="postal_code", type="integer", nullable=true)
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="unit_dns", type="string", length=100, nullable=true)
     */
    private $unitDns;

    /**
     * @var \EducationLevels
     *
     * @ORM\ManyToOne(targetEntity="EducationLevels")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="education_level_id", referencedColumnName="education_level_id")
     * })
     */
    private $educationLevel;

    /**
     * @var \EduAdmins
     *
     * @ORM\ManyToOne(targetEntity="EduAdmins")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="edu_admin_id", referencedColumnName="edu_admin_id")
     * })
     */
    private $eduAdmin;

    /**
     * @var \Municipalities
     *
     * @ORM\ManyToOne(targetEntity="Municipalities")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="municipality_id", referencedColumnName="municipality_id")
     * })
     */
    private $municipality;

    /**
     * @var \Prefectures
     *
     * @ORM\ManyToOne(targetEntity="Prefectures")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="prefecture_id", referencedColumnName="prefecture_id")
     * })
     */
    private $prefecture;

    /**
     * @var \RegionEduAdmins
     *
     * @ORM\ManyToOne(targetEntity="RegionEduAdmins")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="region_edu_admin_id", referencedColumnName="region_edu_admin_id")
     * })
     */
    private $regionEduAdmin;

    /**
     * @var \SchoolUnitTypes
     *
     * @ORM\ManyToOne(targetEntity="SchoolUnitTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="school_unit_type_id", referencedColumnName="school_unit_type_id")
     * })
     */
    private $schoolUnitType;

    /**
     * @var \States
     *
     * @ORM\ManyToOne(targetEntity="States")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="state_id", referencedColumnName="state_id")
     * })
     */
    private $state;

    /**
     * @var \TransferAreas
     *
     * @ORM\ManyToOne(targetEntity="TransferAreas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="transfer_area_id", referencedColumnName="transfer_area_id")
     * })
     */
    private $transferArea;

    //getter and setter
    
    public function getSchoolUnitId() {
        return $this->schoolUnitId;
    }

    public function setSchoolUnitId($schoolUnitId) {
        $this->schoolUnitId = $schoolUnitId;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getSpecialName() {
        return $this->specialName;
    }

    public function setSpecialName($specialName) {
        $this->specialName = $specialName;
    }

    public function getLastUpdate() {
        return $this->lastUpdate;
    }

    public function setLastUpdate(\DateTime $lastUpdate) {
        $this->lastUpdate = $lastUpdate;
    }

    public function getFaxNumber() {
        return $this->faxNumber;
    }

    public function setFaxNumber($faxNumber) {
        $this->faxNumber = $faxNumber;
    }

    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getStreetAddress() {
        return $this->streetAddress;
    }

    public function setStreetAddress($streetAddress) {
        $this->streetAddress = $streetAddress;
    }

    public function getPostalCode() {
        return $this->postalCode;
    }

    public function setPostalCode($postalCode) {
        $this->postalCode = $postalCode;
    }

    public function getUnitDns() {
        return $this->unitDns;
    }

    public function setUnitDns($unitDns) {
        $this->unitDns = $unitDns;
    }

    public function getEducationLevel() {
        return $this->educationLevel;
    }

    public function setEducationLevel(\EducationLevels $educationLevel) {
        $this->educationLevel = $educationLevel;
    }

    public function getEduAdmin() {
        return $this->eduAdmin;
    }

    public function setEduAdmin(\EduAdmins $eduAdmin) {
        $this->eduAdmin = $eduAdmin;
    }

    public function getMunicipality() {
        return $this->municipality;
    }

    public function setMunicipality(\Municipalities $municipality) {
        $this->municipality = $municipality;
    }

    public function getPrefecture() {
        return $this->prefecture;
    }

    public function setPrefecture(\Prefectures $prefecture) {
        $this->prefecture = $prefecture;
    }

    public function getRegionEduAdmin() {
        return $this->regionEduAdmin;
    }

    public function setRegionEduAdmin(\RegionEduAdmins $regionEduAdmin) {
        $this->regionEduAdmin = $regionEduAdmin;
    }

    public function getSchoolUnitType() {
        return $this->schoolUnitType;
    }

    public function setSchoolUnitType(\SchoolUnitTypes $schoolUnitType) {
        $this->schoolUnitType = $schoolUnitType;
    }

    public function getState() {
        return $this->state;
    }

    public function setState(\States $state) {
        $this->state = $state;
    }

    public function getTransferArea() {
        return $this->transferArea;
    }

    public function setTransferArea(\TransferAreas $transferArea) {
        $this->transferArea = $transferArea;
    }


}