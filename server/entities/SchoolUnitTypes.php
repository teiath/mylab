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
     * @ORM\GeneratedValue(strategy="NONE")
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
     * @var \EducationLevels
     *
     * @ORM\ManyToOne(targetEntity="EducationLevels")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="education_level_id", referencedColumnName="education_level_id")
     * })
     */
    private $educationLevel;

    //getter and setter
    
    public function getSchoolUnitTypeId() {
        return $this->schoolUnitTypeId;
    }

    public function setSchoolUnitTypeId($schoolUnitTypeId) {
        $this->schoolUnitTypeId = $schoolUnitTypeId;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getInitials() {
        return $this->initials;
    }

    public function setInitials($initials) {
        $this->initials = $initials;
    }

    public function getEducationLevel() {
        return $this->educationLevel;
    }

    public function setEducationLevel(\EducationLevels $educationLevel) {
        $this->educationLevel = $educationLevel;
    }

   
}