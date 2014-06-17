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
     * @var \DateTime
     *
     * @ORM\Column(name="aquisition_year", type="date", nullable=true)
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


}
