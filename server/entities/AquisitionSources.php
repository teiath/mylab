<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * AquisitionSources
 *
 * @ORM\Table(name="aquisition_sources")
 * @ORM\Entity
 */
class AquisitionSources
{
    /**
     * @var integer
     *
     * @ORM\Column(name="aquisition_source_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $aquisitionSourceId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    //getter and setter
    
    public function getAquisitionSourceId() {
        return $this->aquisitionSourceId;
    }

    public function setAquisitionSourceId($aquisitionSourceId) {
        $this->aquisitionSourceId = $aquisitionSourceId;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }


}