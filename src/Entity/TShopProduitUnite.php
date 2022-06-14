<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TShopProduitUnite
 *
 * @ORM\Table(name="t_shop_produit_unite")
 * @ORM\Entity
 */
class TShopProduitUnite
{
    /**
     * @var int
     *
     * @ORM\Column(name="pu_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $puId;

    /**
     * @var int
     *
     * @ORM\Column(name="pu_id_produit", type="integer", nullable=false)
     */
    private $puIdProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="pu_unite", type="string", length=255, nullable=false)
     */
    private $puUnite;

    /**
     * @var string
     *
     * @ORM\Column(name="pu_prix", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $puPrix;

    /**
     * @var int
     *
     * @ORM\Column(name="pu_order", type="integer", nullable=false)
     */
    private $puOrder = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="pu_libelle", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $puLibelle = 'NULL';

    public function getPuId(): ?int
    {
        return $this->puId;
    }

    public function getPuIdProduit(): ?int
    {
        return $this->puIdProduit;
    }

    public function setPuIdProduit(int $puIdProduit): self
    {
        $this->puIdProduit = $puIdProduit;

        return $this;
    }

    public function getPuUnite(): ?string
    {
        return $this->puUnite;
    }

    public function setPuUnite(string $puUnite): self
    {
        $this->puUnite = $puUnite;

        return $this;
    }

    public function getPuPrix(): ?string
    {
        return $this->puPrix;
    }

    public function setPuPrix(string $puPrix): self
    {
        $this->puPrix = $puPrix;

        return $this;
    }

    public function getPuOrder(): ?int
    {
        return $this->puOrder;
    }

    public function setPuOrder(int $puOrder): self
    {
        $this->puOrder = $puOrder;

        return $this;
    }

    public function getPuLibelle(): ?string
    {
        return $this->puLibelle;
    }

    public function setPuLibelle(?string $puLibelle): self
    {
        $this->puLibelle = $puLibelle;

        return $this;
    }


}
