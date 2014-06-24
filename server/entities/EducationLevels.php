<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * EducationLevels
 *
 * @ORM\Table(name="education_levels")
 * @ORM\Entity
 */
class EducationLevels
{
    /**
     * @var integer
     *
     * @ORM\Column(name="education_level_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $educationLevelId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;


}