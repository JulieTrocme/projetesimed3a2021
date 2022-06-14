<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TShopProduitMaison
 *
 * @ORM\Table(name="t_shop_produit_maison")
 * @ORM\Entity
 */
class TShopProduitMaison
{
    /**
     * @var int
     *
     * @ORM\Column(name="pm_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pmId;

    /**
     * @var string
     *
     * @ORM\Column(name="pm_libelle", type="string", length=255, nullable=false)
     */
    private $pmLibelle;

    /**
     * @var string
     *
     * @ORM\Column(name="pm_image", type="string", length=255, nullable=false)
     */
    private $pmImage;

    public function getPmId(): ?int
    {
        return $this->pmId;
    }

    public function getPmLibelle(): ?string
    {
        return $this->pmLibelle;
    }

    public function setPmLibelle(string $pmLibelle): self
    {
        $this->pmLibelle = $pmLibelle;

        return $this;
    }

    public function getPmImage(): ?string
    {
        return $this->pmImage;
    }

    public function setPmImage(string $pmImage): self
    {
        $this->pmImage = $pmImage;

        return $this;
    }


}
