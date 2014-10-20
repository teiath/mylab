<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * LabWorkers
 *
 * @ORM\Table(name="lab_workers", indexes={@ORM\Index(name="lab_idx", columns={"lab_id"}), @ORM\Index(name="mylab_worker_idx", columns={"worker_id"}), @ORM\Index(name="worker_position_idx", columns={"worker_position_id"})})
 * @ORM\Entity
 */
class LabWorkers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="lab_worker_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $labWorkerId;

    /**
     * @var string
     *
     * @ORM\Column(name="worker_email", type="string", length=255, nullable=true)
     */
    private $workerEmail;

    /**
     * @var integer
     *
     * @ORM\Column(name="worker_status", type="integer", nullable=false)
     */
    private $workerStatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="worker_start_service", type="date", nullable=true)
     */
    private $workerStartService;

    /**
     * @var \Labs
     *
     * @ORM\ManyToOne(targetEntity="Labs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lab_id", referencedColumnName="lab_id")
     * })
     */
    private $lab;

    /**
     * @var \MylabWorkers
     *
     * @ORM\ManyToOne(targetEntity="\MylabWorkers")
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
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="insertLabWorkerBy", type="date", nullable=true)
     */
    private $insertLabWorkerBy;

    /**
     * @var string
     *
     * @ORM\Column(name="insertBy", type="string", length=45, nullable=true)
     */
    private $insertBy;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deleteLabWorkerBy", type="date", nullable=true)
     */
    private $deleteLabWorkerBy;

    /**
     * @var string
     *
     * @ORM\Column(name="deleteBy", type="string", length=45, nullable=true)
     */
    private $deleteBy;
    
    //getter and setter

    public function getLabWorkerId() {
        return $this->labWorkerId;
    }

    public function setLabWorkerId($labWorkerId) {
        $this->labWorkerId = $labWorkerId;
    }

    public function getWorkerEmail() {
        return $this->workerEmail;
    }

    public function setWorkerEmail($workerEmail) {
        $this->workerEmail = $workerEmail;
    }

    public function getWorkerStatus() {
        return $this->workerStatus;
    }

    public function setWorkerStatus($workerStatus) {
        $this->workerStatus = $workerStatus;
    }

    public function getWorkerStartService() {
        return $this->workerStartService;
    }

    public function setWorkerStartService(\DateTime $workerStartService) {
         $this->workerStartService = $workerStartService;
//        if(is_string($workerStartService) && $workerStartService != '') {
//            $this->workerStartService = \DateTime::createFromFormat('Y-m-d', $workerStartService);
//        } else if($workerStartService instanceof \DateTime) {
//            $this->workerStartService = $workerStartService;
//        }
    }

    public function getLab() {
        return $this->lab;
    }

    public function setLab(\Labs $lab) {
        $this->lab = $lab;
    }

    public function getWorker() {
        return $this->worker;
    }

    public function setWorker(\MylabWorkers $worker) {
        $this->worker = $worker;
    }

    public function getWorkerPosition() {
        return $this->workerPosition;
    }

    public function setWorkerPosition(\WorkerPositions $workerPosition) {
        $this->workerPosition = $workerPosition;
    }

    public function getInsertLabWorkerBy() {
        return $this->insertLabWorkerBy;
    }

    public function setInsertLabWorkerBy(\DateTime $insertLabWorkerBy) {
        $this->insertLabWorkerBy = $insertLabWorkerBy;
    }

    public function getInsertBy() {
        return $this->insertBy;
    }

    public function setInsertBy($insertBy) {
        $this->insertBy = $insertBy;
    }

    public function getDeleteLabWorkerBy() {
        return $this->deleteLabWorkerBy;
    }

    public function setDeleteLabWorkerBy(\DateTime $deleteLabWorkerBy) {
        $this->deleteLabWorkerBy = $deleteLabWorkerBy;
    }

    public function getDeleteBy() {
        return $this->deleteBy;
    }

    public function setDeleteBy($deleteBy) {
        $this->deleteBy = $deleteBy;
    }


}