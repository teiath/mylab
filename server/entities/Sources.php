<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Sources
 *
 * @ORM\Table(name="sources")
 * @ORM\Entity
 */
class Sources
{
    /**
     * @var integer
     *
     * @ORM\Column(name="source_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $sourceId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    //getter and setter

    public function getSourceId() {
        return $this->sourceId;
    }

    public function setSourceId($sourceId) {
        $this->sourceId = $sourceId;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
    
}