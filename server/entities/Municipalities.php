<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Municipalities
 *
 * @ORM\Table(name="municipalities", indexes={@ORM\Index(name="transfer_area_idx", columns={"transfer_area_id"}), @ORM\Index(name="prefecture_idx", columns={"prefecture_id"})})
 * @ORM\Entity
 */
class Municipalities
{
    /**
     * @var integer
     *
     * @ORM\Column(name="municipality_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $municipalityId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="transfer_area_id", type="integer", nullable=true)
     */
    private $transferAreaId;

    /**
     * @var integer
     *
     * @ORM\Column(name="prefecture_id", type="integer", nullable=true)
     */
    private $prefectureId;


}
