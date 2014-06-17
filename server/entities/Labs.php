<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Labs
 *
 * @ORM\Table(name="labs", indexes={@ORM\Index(name="lab_type_idx", columns={"lab_type_id"}), @ORM\Index(name="lab_school_unit_idx", columns={"school_unit_id"}), @ORM\Index(name="state_idx", columns={"state_id"}), @ORM\Index(name="source_idx", columns={"lab_source_id"})})
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
     * Constructor
     */
    public function __construct()
    {
        $this->equipmentType = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
