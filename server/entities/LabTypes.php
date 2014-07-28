<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * LabTypes
 *
 * @ORM\Table(name="lab_types")
 * @ORM\Entity
 */
class LabTypes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="lab_type_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $labTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="full_name", type="string", length=255, nullable=true)
     */
    private $fullName;

    //getter and setter
    
    public function getLabTypeId() {
        return $this->labTypeId;
    }

    public function setLabTypeId($labTypeId) {
        $this->labTypeId = $labTypeId;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getFullName() {
        return $this->fullName;
    }

    public function setFullName($fullName) {
        $this->fullName = $fullName;
    }


}