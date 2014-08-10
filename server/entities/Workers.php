<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Workers
 *
 * @ORM\Table(name="workers", indexes={@ORM\Index(name="specialization_code_idx", columns={"worker_specialization_id"}, @ORM\Index(name="source_idx", columns={"source_id"}))})
 * @ORM\Entity
 */
class Workers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="worker_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $workerId;

    /**
     * @var string
     *
     * @ORM\Column(name="registry_no", type="string", length=255, nullable=true)
     */
    private $registryNo;

    /**
     * @var string
     *
     * @ORM\Column(name="tax_number", type="string", length=255, nullable=true)
     */
    private $taxNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="fathername", type="string", length=255, nullable=true)
     */
    private $fathername;

    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", length=1, nullable=true)
     */
    private $sex;

    /**
     * @var \WorkerSpecializations
     *
     * @ORM\ManyToOne(targetEntity="WorkerSpecializations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="worker_specialization_id", referencedColumnName="worker_specialization_id")
     * })
     */
    private $workerSpecialization;
    
    /**
     * @var \Sources
     *
     * @ORM\ManyToOne(targetEntity="Sources")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="source_id", referencedColumnName="source_id")
     * })
     */
    private $source;
    
    //getter and setter
    
    public function getWorkerId() {
        return $this->workerId;
    }

    public function setWorkerId($workerId) {
        $this->workerId = $workerId;
    }

    public function getRegistryNo() {
        return $this->registryNo;
    }

    public function setRegistryNo($registryNo) {
        $this->registryNo = $registryNo;
    }

    public function getTaxNumber() {
        return $this->taxNumber;
    }

    public function setTaxNumber($taxNumber) {
        $this->taxNumber = $taxNumber;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    public function getFathername() {
        return $this->fathername;
    }

    public function setFathername($fathername) {
        $this->fathername = $fathername;
    }

    public function getSex() {
        return $this->sex;
    }

    public function setSex($sex) {
        $this->sex = $sex;
    }

    public function getWorkerSpecialization() {
        return $this->workerSpecialization;
    }

    public function setWorkerSpecialization(\WorkerSpecializations $workerSpecialization) {
        $this->workerSpecialization = $workerSpecialization;
    }
    
    public function getSource() {
        return $this->source;
    }

    public function setSource(\Sources $source) {
        $this->source = $source;
    }


}