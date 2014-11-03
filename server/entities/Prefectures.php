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
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $prefectureId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    //getter and setter
    
    public function getPrefectureId() {
        return $this->prefectureId;
    }

    public function setPrefectureId($prefectureId) {
        $this->prefectureId = $prefectureId;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }


}