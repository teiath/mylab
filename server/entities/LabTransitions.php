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

    /**
     * @var \States
     *
     * @ORM\ManyToOne(targetEntity="States")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="from_state", referencedColumnName="state_id")
     * })
     */
    private $fromState;

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
     * @var \States
     *
     * @ORM\ManyToOne(targetEntity="States")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="to_state", referencedColumnName="state_id")
     * })
     */
    private $toState;

    //getter and setter

    public function getLabTransitionId() {
        return $this->labTransitionId;
    }

    public function setLabTransitionId($labTransitionId) {
        $this->labTransitionId = $labTransitionId;
    }

    public function getTransitionJustification() {
        return $this->transitionJustification;
    }

    public function setTransitionJustification($transitionJustification) {
        $this->transitionJustification = $transitionJustification;
    }

    public function getTransitionDate() {
        return $this->transitionDate;
    }

    public function setTransitionDate(\DateTime $transitionDate) {
        $this->transitionDate = $transitionDate;
    }

    public function getTransitionSource() {
        return $this->transitionSource;
    }

    public function setTransitionSource($transitionSource) {
        $this->transitionSource = $transitionSource;
    }

    public function getFromState() {
        return $this->fromState;
    }

    public function setFromState(\States $fromState) {
        $this->fromState = $fromState;
    }

    public function getLab() {
        return $this->lab;
    }

    public function setLab(\Labs $lab) {
        $this->lab = $lab;
    }

    public function getToState() {
        return $this->toState;
    }

    public function setToState(\States $toState) {
        $this->toState = $toState;
    }


}