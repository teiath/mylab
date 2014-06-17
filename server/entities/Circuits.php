<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Circuits
 *
 * @ORM\Table(name="circuits", indexes={@ORM\Index(name="circuit_type_idx", columns={"circuit_type_id"}), @ORM\Index(name="school_unit_idx", columns={"school_unit_id"})})
 * @ORM\Entity
 */
class Circuits
{
    /**
     * @var integer
     *
     * @ORM\Column(name="circuit_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $circuitId;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number", type="string", length=45, nullable=true)
     */
    private $phoneNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_date", type="datetime", nullable=true)
     */
    private $updatedDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status;

    /**
     * @var \CircuitTypes
     *
     * @ORM\ManyToOne(targetEntity="CircuitTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="circuit_type_id", referencedColumnName="circuit_type_id")
     * })
     */
    private $circuitType;

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
