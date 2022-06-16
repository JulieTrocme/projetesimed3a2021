<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TShopProduitImage
 *
 * @ORM\Table(name="t_shop_produit_image")
 * @ORM\Entity
 */
class TShopProduitImage
{
    /**
     * @var int
     *
     * @ORM\Column(name="pi_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $piId;

    /**
     * @var int
     *
     * @ORM\Column(name="pi_id_produit", type="integer", nullable=false)
     */
    private $piIdProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="pi_img", type="string", length=255, nullable=false)
     */
    private $piImg;

    /**
     * @var int
     *
     * @ORM\Column(name="pi_order", type="integer", nullable=false)
     */
    private $piOrder;

    /**
     * @ORM\ManyToOne(targetEntity=TShopProduit::class)
     * @ORM\JoinColumn(name="pi_id_produit", referencedColumnName="pr_id")
     */
    private TShopProduit $produit;

    /**
     * @return TShopProduit
     */
    public function getProduit(): TShopProduit
    {
        return $this->produit;
    }

    /**
     * @param TShopProduit $produit
     */
    public function setProduit(TShopProduit $produit): void
    {
        $this->produit = $produit;
    }

    public function getPiId(): ?int
    {
        return $this->piId;
    }

    public function getPiIdProduit(): ?int
    {
        return $this->piIdProduit;
    }

    public function setPiIdProduit(int $piIdProduit): self
    {
        $this->piIdProduit = $piIdProduit;

        return $this;
    }

    public function getPiImg(): ?string
    {
        return $this->piImg;
    }

    public function setPiImg(string $piImg): self
    {
        $this->piImg = $piImg;

        return $this;
    }

    public function getPiOrder(): ?int
    {
        return $this->piOrder;
    }

    public function setPiOrder(int $piOrder): self
    {
        $this->piOrder = $piOrder;

        return $this;
    }


}
