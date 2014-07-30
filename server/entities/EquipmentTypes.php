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

    //getter and setter
    
    public function getEquipmentTypeId() {
        return $this->equipmentTypeId;
    }

    public function setEquipmentTypeId($equipmentTypeId) {
        $this->equipmentTypeId = $equipmentTypeId;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getEquipmentCategory() {
        return $this->equipmentCategory;
    }

    public function setEquipmentCategory(\EquipmentCategories $equipmentCategory) {
        $this->equipmentCategory = $equipmentCategory;
    }

    
}