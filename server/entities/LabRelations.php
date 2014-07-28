<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * LabRelations
 *
 * @ORM\Table(name="lab_relations", indexes={@ORM\Index(name="lab_idx", columns={"lab_id"}), @ORM\Index(name="school_unit_idx", columns={"school_unit_id"}), @ORM\Index(name="relation_type_idx", columns={"relation_type_id"}), @ORM\Index(name="circuit_idx", columns={"circuit_id"})})
 * @ORM\Entity
 */
class LabRelations
{
    /**
     * @var integer
     *
     * @ORM\Column(name="lab_relation_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $labRelationId;

    /**
     * @var integer
     *
     * @ORM\Column(name="lab_id", type="integer", nullable=false)
     */
    private $labId;

    /**
     * @var integer
     *
     * @ORM\Column(name="school_unit_id", type="integer", nullable=false)
     */
    private $schoolUnitId;

    /**
     * @var integer
     *
     * @ORM\Column(name="relation_type_id", type="integer", nullable=false)
     */
    private $relationTypeId;

    /**
     * @var integer
     *
     * @ORM\Column(name="circuit_id", type="integer", nullable=true)
     */
    private $circuitId;


}
