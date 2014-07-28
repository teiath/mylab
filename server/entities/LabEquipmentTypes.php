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
     * @var integer
     *
     * @ORM\Column(name="lab_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $labId;

    /**
     * @var integer
     *
     * @ORM\Column(name="equipment_type_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $equipmentTypeId;

    /**
     * @var integer
     *
     * @ORM\Column(name="items", type="integer", nullable=true)
     */
    private $items;


}
