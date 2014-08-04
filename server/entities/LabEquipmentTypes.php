<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="lab_equipment_types", indexes={@ORM\Index(name="equipment_type_idx", columns={"equipment_type_id"}), @ORM\Index(name="lab_idx", columns={"lab_id"})})
 * @ORM\Entity
 */
class LabEquipmentTypes
{
    /**
     * 
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Labs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lab_id", referencedColumnName="lab_id")
     * })
     */
    private $lab;
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="EquipmentTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipment_type_id", referencedColumnName="equipment_type_id")
     * })
     */
    private $equipmentType;

    /**
     * @var integer
     *
     * @ORM\Column(name="items", type="integer", length=11, nullable=true)
     */
    private $items;
    
    
    public function __construct($lab, $labEquipmentType)
    {
        $this->lab = $lab;
        $this->labEquipmentType = $labEquipmentType;
    }

    
    
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