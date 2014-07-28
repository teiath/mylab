<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * SchoolUnitTypes
 *
 * @ORM\Table(name="school_unit_types", indexes={@ORM\Index(name="education_level_idx", columns={"education_level_id"})})
 * @ORM\Entity
 */
class SchoolUnitTypes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="school_unit_type_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $schoolUnitTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="initials", type="string", length=255, nullable=true)
     */
    private $initials;

    /**
     * @var integer
     *
     * @ORM\Column(name="education_level_id", type="integer", nullable=true)
     */
    private $educationLevelId;


}
