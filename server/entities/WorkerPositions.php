<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * WorkerPositions
 *
 * @ORM\Table(name="worker_positions")
 * @ORM\Entity
 */
class WorkerPositions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="worker_position_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $workerPositionId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name = '0';

    //getter and setter

    public function getWorkerPositionId() {
        return $this->workerPositionId;
    }

    public function setWorkerPositionId($workerPositionId) {
        $this->workerPositionId = $workerPositionId;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }


}