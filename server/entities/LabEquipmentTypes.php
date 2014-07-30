<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * LabEquipmentTypes
 * 
 * @ORM\Table(name="lab_equipment_types", indexes={@ORM\Index(name="equipment_type_idx", columns={"equipment_type_id"}), @ORM\Index(name="lab_idx", columns={"lab_id"})})
 * @ORM\Entity
 */
class LabEquipmentTypes
{
    
    /**
     * @ORM\@Id @ORM\@ManyToOne(targetEntity="Labs", inversedBy="Labs") 
     *

     * })
     * 
     */
    private $labId;
    
    /**
     * @var \EquipmentTypes
     *
     * @ORM\Column(name="lab_equipment_type_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="EquipmentTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipment_type_id", referencedColumnName="equipment_type_id")
     * })
     */
    private $labEquipmentTypeId;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="items", type="integer", length=11, nullable=true)
     */
    private $items;
    
 
    public function __construct($lab_id, $equipment_type_id)
    {
        $this->lab_id = $lab_id;
        $this->equipment_type_id = $equipment_type_id;
    }

    //getter and setter
    
    public function getLab()
    {
        return $this->lab;
    }
    
    public function setLab(\Labs $lab) {
        $this->lab = $lab;
    }

    public function getEquipmentType()
    {
        return $this->equipmentType;
    }
    
    public function setEquipmentType(\EquipmentTypes $equipmentType) {
        $this->equipmentType = $equipmentType;
    }
    
    public function getItems() {
        return $this->items;
    }

    public function setItems($items) {
        $this->items = $items;
    }
}