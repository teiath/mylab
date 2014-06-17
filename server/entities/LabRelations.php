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
     * @var \Circuits
     *
     * @ORM\ManyToOne(targetEntity="Circuits")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="circuit_id", referencedColumnName="circuit_id")
     * })
     */
    private $circuit;

    /**
     * @var \Labs
     *
     * @ORM\ManyToOne(targetEntity="Labs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lab_id", referencedColumnName="lab_id")
     * })
     */
    private $lab;

    /**
     * @var \RelationTypes
     *
     * @ORM\ManyToOne(targetEntity="RelationTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="relation_type_id", referencedColumnName="relation_type_id")
     * })
     */
    private $relationType;

    /**
     * @var \SchoolUnits
     *
     * @ORM\ManyToOne(targetEntity="SchoolUnits")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="school_unit_id", referencedColumnName="school_unit_id")
     * })
     */
    private $schoolUnit;


}
