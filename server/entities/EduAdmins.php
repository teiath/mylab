<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * EduAdmins
 *
 * @ORM\Table(name="edu_admins", indexes={@ORM\Index(name="region_edu_admin_idx", columns={"region_edu_admin_id"})})
 * @ORM\Entity
 */
class EduAdmins
{
    /**
     * @var integer
     *
     * @ORM\Column(name="edu_admin_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $eduAdminId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="edu_admin_code", type="string", length=45, nullable=true)
     */
    private $eduAdminCode;

    /**
     * @var integer
     *
     * @ORM\Column(name="region_edu_admin_id", type="integer", nullable=true)
     */
    private $regionEduAdminId;


}
