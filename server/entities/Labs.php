<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Labs
 *
 * @ORM\Table(name="labs", indexes={@ORM\Index(name="lab_type_idx", columns={"lab_type_id"}), @ORM\Index(name="state_idx", columns={"state_id"}), @ORM\Index(name="source_idx", columns={"lab_source_id"}), @ORM\Index(name="school_unit_id", columns={"school_unit_id"})})
 * @ORM\Entity
 */
class Labs
{
    /**
     * @var integer
     *
     * @ORM\Column(name="lab_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $labId;

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
     * @ORM\Column(name="creation_date", type="datetime", nullable=true)
     */
    private $creationDate;

    /**
     * @var string
     *
     * @ORM\Column(name="created_by", type="string", length=255, nullable=true)
     */
    private $createdBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_updated", type="datetime", nullable=true)
     */
    private $lastUpdated;

    /**
     * @var string
     *
     * @ORM\Column(name="updated_by", type="string", length=255, nullable=true)
     */
    private $updatedBy;

    /**
     * @var string
     *
     * @ORM\Column(name="positioning", type="string", length=255, nullable=true)
     */
    private $positioning;

    /**
     * @var string
     *
     * @ORM\Column(name="comments", type="string", length=255, nullable=true)
     */
    private $comments;

    /**
     * @var integer
     *
     * @ORM\Column(name="operational_rating", type="integer", nullable=true)
     */
    private $operationalRating;

    /**
     * @var integer
     *
     * @ORM\Column(name="technological_rating", type="integer", nullable=true)
     */
    private $technologicalRating;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ellak", type="boolean", nullable=false)
     */
    private $ellak=false;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="submitted", type="boolean", nullable=false)
     */
    private $submitted=false;
    
    /**
     * @var \LabSources
     *
     * @ORM\ManyToOne(targetEntity="LabSources")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lab_source_id", referencedColumnName="lab_source_id")
     * })
     */
    private $labSource;

    /**
     * @var \LabTypes
     *
     * @ORM\ManyToOne(targetEntity="LabTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lab_type_id", referencedColumnName="lab_type_id")
     * })
     */
    private $labType;

    /**
     * @var \SchoolUnits
     *
     * @ORM\ManyToOne(targetEntity="SchoolUnits")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="school_unit_id", referencedColumnName="school_unit_id")
     * })
     */
    private $schoolUnit;

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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="EquipmentTypes", inversedBy="lab")
     * @ORM\JoinTable(name="lab_equipment_types",
     *   joinColumns={
     *     @ORM\JoinColumn(name="lab_id", referencedColumnName="lab_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="equipment_type_id", referencedColumnName="equipment_type_id")
     *   }
     * )
     */
    private $equipmentType;

    /**
     * @var integer
     * 
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $mmSyncId;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $mmSyncLastUpdateDate;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->equipmentType = new \Doctrine\Common\Collections\ArrayCollection();
    }

    //getter and setter
    
    public function getLabId() {
        return $this->labId;
    }

    public function setLabId($labId) {
        $this->labId = $labId;
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

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTime $creationDate) {
        $this->creationDate = $creationDate;
    }

    public function getCreatedBy() {
        return $this->createdBy;
    }

    public function setCreatedBy($createdBy) {
        $this->createdBy = $createdBy;
    }

    public function getLastUpdated() {
        return $this->lastUpdated;
    }

    public function setLastUpdated(\DateTime $lastUpdated) {
        $this->lastUpdated = $lastUpdated;
    }

    public function getUpdatedBy() {
        return $this->updatedBy;
    }

    public function setUpdatedBy($updatedBy) {
        $this->updatedBy = $updatedBy;
    }

    public function getPositioning() {
        return $this->positioning;
    }

    public function setPositioning($positioning) {
        $this->positioning = $positioning;
    }

    public function getComments() {
        return $this->comments;
    }

    public function setComments($comments) {
        $this->comments = $comments;
    }

    public function getOperationalRating() {
        return $this->operationalRating;
    }

    public function setOperationalRating($operationalRating) {
        $this->operationalRating = $operationalRating;
    }

    public function getTechnologicalRating() {
        return $this->technologicalRating;
    }

    public function setTechnologicalRating($technologicalRating) {
        $this->technologicalRating = $technologicalRating;
    }

    public function getEllak() {
        return $this->ellak;
    }

    public function setEllak($ellak) {
        $this->ellak = $ellak;
    }
    
    public function getSubmitted() {
        return $this->submitted;
    }

    public function setSubmitted($submitted) {
        $this->submitted = $submitted;
    }

    public function getLabSource() {
        return $this->labSource;
    }

    public function setLabSource(\LabSources $labSource) {
        $this->labSource = $labSource;
    }

    public function getLabType() {
        return $this->labType;
    }

    public function setLabType(\LabTypes $labType) {
        $this->labType = $labType;
    }

    public function getSchoolUnit() {
        return $this->schoolUnit;
    }

    public function setSchoolUnit(\SchoolUnits $schoolUnit) {
        $this->schoolUnit = $schoolUnit;
    }

    public function getState() {
        return $this->state;
    }

    public function setState(\States $state=null) {
        $this->state = $state;
    }

    public function getEquipmentType() {
        return $this->equipmentType;
    }

    public function setEquipmentType(\Doctrine\Common\Collections\Collection $equipmentType) {
        $this->equipmentType = $equipmentType;
    }

    public function getMmSyncId() {
        return $this->mmSyncId;
    }

    public function setMmSyncId($mmSyncId) {
        $this->mmSyncId = $mmSyncId;
    }

    public function getMmSyncLastUpdateDate() {
        return $this->mmSyncLastUpdateDate;
    }

    public function setMmSyncLastUpdateDate(\DateTime $mmSyncLastUpdateDate) {
        $this->mmSyncLastUpdateDate = $mmSyncLastUpdateDate;
    }

}