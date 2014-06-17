<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * EquipmentTypes
 *
 * @ORM\Table(name="equipment_types", indexes={@ORM\Index(name="equipment_category_idx", columns={"equipment_category_id"})})
 * @ORM\Entity
 */
class EquipmentTypes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="equipment_type_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $equipmentTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var \EquipmentCategories
     *
     * @ORM\ManyToOne(targetEntity="EquipmentCategories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipment_category_id", referencedColumnName="equipment_category_id")
     * })
     */
    private $equipmentCategory;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Labs", mappedBy="equipmentType")
     */
    private $lab;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lab = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
