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
     * @var \Prefectures
     *
     * @ORM\ManyToOne(targetEntity="Prefectures")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="prefecture_id", referencedColumnName="prefecture_id")
     * })
     */
    private $prefecture;

    /**
     * @var \TransferAreas
     *
     * @ORM\ManyToOne(targetEntity="TransferAreas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="transfer_area_id", referencedColumnName="transfer_area_id")
     * })
     */
    private $transferArea;

    //getter and setter

    public function getMunicipalityId() {
        return $this->municipalityId;
    }

    public function setMunicipalityId($municipalityId) {
        $this->municipalityId = $municipalityId;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getPrefecture() {
        return $this->prefecture;
    }

    public function setPrefecture(\Prefectures $prefecture) {
        $this->prefecture = $prefecture;
    }

    public function getTransferArea() {
        return $this->transferArea;
    }

    public function setTransferArea(\TransferAreas $transferArea) {
        $this->transferArea = $transferArea;
    }


}