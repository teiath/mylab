<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * EquipmentCategories
 *
 * @ORM\Table(name="equipment_categories")
 * @ORM\Entity
 */
class EquipmentCategories
{
    /**
     * @var integer
     *
     * @ORM\Column(name="equipment_category_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $equipmentCategoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    //getter and setter
    
    public function getEquipmentCategoryId() {
        return $this->equipmentCategoryId;
    }

    public function setEquipmentCategoryId($equipmentCategoryId) {
        $this->equipmentCategoryId = $equipmentCategoryId;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }


}