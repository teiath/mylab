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
     * @var integer
     *
     * @ORM\Column(name="lab_id", type="integer", nullable=true)
     */
    private $labId;

    /**
     * @var integer
     *
     * @ORM\Column(name="worker_id", type="integer", nullable=true)
     */
    private $workerId;

    /**
     * @var integer
     *
     * @ORM\Column(name="worker_position_id", type="integer", nullable=true)
     */
    private $workerPositionId;

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


}
