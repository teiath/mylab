<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * RegionEduAdmins
 *
 * @ORM\Table(name="region_edu_admins")
 * @ORM\Entity
 */
class RegionEduAdmins
{
    /**
     * @var integer
     *
     * @ORM\Column(name="region_edu_admin_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $regionEduAdminId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    //getter and setter
    
    public function getRegionEduAdminId() {
        return $this->regionEduAdminId;
    }

    public function setRegionEduAdminId($regionEduAdminId) {
        $this->regionEduAdminId = $regionEduAdminId;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }


}