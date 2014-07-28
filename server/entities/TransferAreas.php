<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * TransferAreas
 *
 * @ORM\Table(name="transfer_areas", indexes={@ORM\Index(name="edu_admin_idx", columns={"edu_admin_id"})})
 * @ORM\Entity
 */
class TransferAreas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="transfer_area_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $transferAreaId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="edu_admin_id", type="integer", nullable=true)
     */
    private $eduAdminId;


}
