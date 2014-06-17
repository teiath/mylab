<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Prefectures
 *
 * @ORM\Table(name="prefectures")
 * @ORM\Entity
 */
class Prefectures
{
    /**
     * @var integer
     *
     * @ORM\Column(name="prefecture_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $prefectureId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;


}
