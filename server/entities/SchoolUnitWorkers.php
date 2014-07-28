<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * SchoolUnitWorkers
 *
 * @ORM\Table(name="school_unit_workers", indexes={@ORM\Index(name="school_unit_idx", columns={"school_unit_id"}), @ORM\Index(name="worker_idx", columns={"worker_id"}), @ORM\Index(name="worker_position_idx", columns={"worker_position_id"})})
 * @ORM\Entity
 */
class SchoolUnitWorkers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="school_unit_worker_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $schoolUnitWorkerId;

    /**
     * @var \SchoolUnits
     *
     * @ORM\ManyToOne(targetEntity="SchoolUnits")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="school_unit_id", referencedColumnName="school_unit_id")
     * })
     */
    private $schoolUnit;

    /**
     * @var \Workers
     *
     * @ORM\ManyToOne(targetEntity="Workers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="worker_id", referencedColumnName="worker_id")
     * })
     */
    private $worker;

    /**
     * @var \WorkerPositions
     *
     * @ORM\ManyToOne(targetEntity="WorkerPositions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="worker_position_id", referencedColumnName="worker_position_id")
     * })
     */
    private $workerPosition;

    //getter and setter
    
    public function getSchoolUnitWorkerId() {
        return $this->schoolUnitWorkerId;
    }

    public function setSchoolUnitWorkerId($schoolUnitWorkerId) {
        $this->schoolUnitWorkerId = $schoolUnitWorkerId;
    }

    public function getSchoolUnit() {
        return $this->schoolUnit;
    }

    public function setSchoolUnit(\SchoolUnits $schoolUnit) {
        $this->schoolUnit = $schoolUnit;
    }

    public function getWorker() {
        return $this->worker;
    }

    public function setWorker(\Workers $worker) {
        $this->worker = $worker;
    }

    public function getWorkerPosition() {
        return $this->workerPosition;
    }

    public function setWorkerPosition(\WorkerPositions $workerPosition) {
        $this->workerPosition = $workerPosition;
    }


}