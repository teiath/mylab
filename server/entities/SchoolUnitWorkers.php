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
     * @var integer
     *
     * @ORM\Column(name="school_unit_id", type="integer", nullable=true)
     */
    private $schoolUnitId;

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


}
