<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * LabSources
 *
 * @ORM\Table(name="lab_sources")
 * @ORM\Entity
 */
class LabSources
{
    /**
     * @var integer
     *
     * @ORM\Column(name="lab_source_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $labSourceId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    //getter and setter

    public function getLabSourceId() {
        return $this->labSourceId;
    }

    public function setLabSourceId($labSourceId) {
        $this->labSourceId = $labSourceId;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }


}