<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * LabWorkers
 *
 * @ORM\Table(name="lab_workers", indexes={@ORM\Index(name="lab_idx", columns={"lab_id"}), @ORM\Index(name="worker_idx", columns={"worker_id"}), @ORM\Index(name="worker_position_idx", columns={"worker_position_id"})})
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


}
