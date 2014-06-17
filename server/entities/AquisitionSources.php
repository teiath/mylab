<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * AquisitionSources
 *
 * @ORM\Table(name="aquisition_sources")
 * @ORM\Entity
 */
class AquisitionSources
{
    /**
     * @var integer
     *
     * @ORM\Column(name="aquisition_source_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $aquisitionSourceId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;


}
