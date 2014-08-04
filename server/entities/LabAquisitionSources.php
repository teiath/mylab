<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * LabAquisitionSources
 *
 * @ORM\Table(name="lab_aquisition_sources", indexes={@ORM\Index(name="aquisition_source_idx", columns={"aquisition_source_id"}), @ORM\Index(name="lab_idx", columns={"lab_id"})})
 * @ORM\Entity
 */
class LabAquisitionSources
{
    /**
     * @var integer
     *
     * @ORM\Column(name="lab_aquisition_source_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $labAquisitionSourceId;

    /**
     * @var \Year
     *
     * @ORM\Column(name="aquisition_year", columnDefinition="YEAR", nullable=true)
     */
    private $aquisitionYear;

    /**
     * @var string
     *
     * @ORM\Column(name="aquisition_comments", type="string", length=255, nullable=true)
     */
    private $aquisitionComments;

    /**
     * @var \AquisitionSources
     *
     * @ORM\ManyToOne(targetEntity="AquisitionSources")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="aquisition_source_id", referencedColumnName="aquisition_source_id")
     * })
     */
    private $aquisitionSource;

    /**
     * @var \Labs
     *
     * @ORM\ManyToOne(targetEntity="Labs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lab_id", referencedColumnName="lab_id")
     * })
     */
    private $lab;

    //getter and setter

    public function getLabAquisitionSourceId() {
        return $this->labAquisitionSourceId;
    }

    public function setLabAquisitionSourceId($labAquisitionSourceId) {
        $this->labAquisitionSourceId = $labAquisitionSourceId;
    }

    public function getAquisitionYear() {
        return $this->aquisitionYear;
    }

//    public function setAquisitionYear(\DateTime $aquisitionYear) {
//        
//        if(is_string($aquisitionYear) && $aquisitionYear != '') {
//            $this->aquisitionYear = \DateTime::createFromFormat('Y-m-d H:i:s', $aquisitionYear);
//        } else if($aquisitionYear instanceof \DateTime) {
//           $this->aquisitionYear = $aquisitionYear;
//        }
//    }

    public function setAquisitionYear($aquisitionYear) {
        $this->aquisitionYear = $aquisitionYear;
    }
    
    public function getAquisitionComments() {
        return $this->aquisitionComments;
    }

    public function setAquisitionComments($aquisitionComments) {
        $this->aquisitionComments = $aquisitionComments;
    }

    public function getAquisitionSource() {
        return $this->aquisitionSource;
    }

    public function setAquisitionSource(\AquisitionSources $aquisitionSource) {
        $this->aquisitionSource = $aquisitionSource;
    }

    public function getLab() {
        return $this->lab;
    }

    public function setLab(\Labs $lab) {
        $this->lab = $lab;
    }

      
}