<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * LabTransitions
 *
 * @ORM\Table(name="lab_transitions", indexes={@ORM\Index(name="from_state_idx", columns={"from_state"}), @ORM\Index(name="to_state_idx", columns={"to_state"}), @ORM\Index(name="lab_idx", columns={"lab_id"})})
 * @ORM\Entity
 */
class LabTransitions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="lab_transition_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $labTransitionId;

    /**
     * @var integer
     *
     * @ORM\Column(name="lab_id", type="integer", nullable=true)
     */
    private $labId;

    /**
     * @var integer
     *
     * @ORM\Column(name="from_state", type="integer", nullable=true)
     */
    private $fromState;

    /**
     * @var integer
     *
     * @ORM\Column(name="to_state", type="integer", nullable=true)
     */
    private $toState;

    /**
     * @var string
     *
     * @ORM\Column(name="transition_justification", type="string", length=255, nullable=true)
     */
    private $transitionJustification;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="transition_date", type="date", nullable=true)
     */
    private $transitionDate;

    /**
     * @var string
     *
     * @ORM\Column(name="transition_source", type="string", nullable=true)
     */
    private $transitionSource;


}
