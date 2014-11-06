<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * WorkerSpecializations
 *
 * @ORM\Table(name="worker_specializations")
 * @ORM\Entity
 */
class WorkerSpecializations
{
    /**
     * @var integer
     *
     * @ORM\Column(name="worker_specialization_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $workerSpecializationId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    //getter and setter
    
    public function getWorkerSpecializationId() {
        return $this->workerSpecializationId;
    }

    public function setWorkerSpecializationId($workerSpecializationId) {
        $this->workerSpecializationId = $workerSpecializationId;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }


}