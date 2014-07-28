<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * RelationTypes
 *
 * @ORM\Table(name="relation_types")
 * @ORM\Entity
 */
class RelationTypes
{
    /**
     * @var integer
     *
     * @ORM\Column(name="relation_type_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $relationTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    //getter and setter
    
    public function getRelationTypeId() {
        return $this->relationTypeId;
    }

    public function setRelationTypeId($relationTypeId) {
        $this->relationTypeId = $relationTypeId;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }


}