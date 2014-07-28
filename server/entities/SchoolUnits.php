<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * SchoolUnits
 *
 * @ORM\Table(name="school_units", indexes={@ORM\Index(name="school_unit_region_edu_admin_idx", columns={"region_edu_admin_id"}), @ORM\Index(name="school_unit_edu_admin_idx", columns={"edu_admin_id"}), @ORM\Index(name="school_unit_transfer_area_idx", columns={"transfer_area_id"}), @ORM\Index(name="school_unit_municipality_idx", columns={"municipality_id"}), @ORM\Index(name="school_unit_prefecture_idx", columns={"prefecture_id"}), @ORM\Index(name="school_unit_education_level_idx", columns={"education_level_id"}), @ORM\Index(name="school_unit_school_unit_type_idx", columns={"school_unit_type_id"}), @ORM\Index(name="school_unit_school_states_idx", columns={"state_id"})})
 * @ORM\Entity
 */
class SchoolUnits
{
    /**
     * @var integer
     *
     * @ORM\Column(name="school_unit_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $schoolUnitId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="special_name", type="string", length=255, nullable=true)
     */
    private $specialName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_update", type="datetime", nullable=true)
     */
    private $lastUpdate;

    /**
     * @var string
     *
     * @ORM\Column(name="fax_number", type="string", length=255, nullable=true)
     */
    private $faxNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number", type="string", length=255, nullable=true)
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="street_address", type="string", length=255, nullable=true)
     */
    private $streetAddress;

    /**
     * @var integer
     *
     * @ORM\Column(name="postal_code", type="integer", nullable=true)
     */
    private $postalCode;

    /**
     * @var integer
     *
     * @ORM\Column(name="region_edu_admin_id", type="integer", nullable=true)
     */
    private $regionEduAdminId;

    /**
     * @var integer
     *
     * @ORM\Column(name="edu_admin_id", type="integer", nullable=true)
     */
    private $eduAdminId;

    /**
     * @var integer
     *
     * @ORM\Column(name="transfer_area_id", type="integer", nullable=true)
     */
    private $transferAreaId;

    /**
     * @var integer
     *
     * @ORM\Column(name="municipality_id", type="integer", nullable=true)
     */
    private $municipalityId;

    /**
     * @var integer
     *
     * @ORM\Column(name="prefecture_id", type="integer", nullable=true)
     */
    private $prefectureId;

    /**
     * @var integer
     *
     * @ORM\Column(name="education_level_id", type="integer", nullable=true)
     */
    private $educationLevelId;

    /**
     * @var integer
     *
     * @ORM\Column(name="school_unit_type_id", type="integer", nullable=true)
     */
    private $schoolUnitTypeId;

    /**
     * @var integer
     *
     * @ORM\Column(name="state_id", type="integer", nullable=true)
     */
    private $stateId;

    /**
     * @var string
     *
     * @ORM\Column(name="unit_dns", type="string", length=100, nullable=true)
     */
    private $unitDns;


}
