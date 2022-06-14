<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TShopCommandeLigne
 *
 * @ORM\Table(name="t_shop_commande_ligne")
 * @ORM\Entity
 */
class TShopCommandeLigne
{
    /**
     * @var int
     *
     * @ORM\Column(name="cl_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $clId;

    /**
     * @var int
     *
     * @ORM\Column(name="cl_cde_id", type="integer", nullable=false)
     */
    private $clCdeId;

    /**
     * @var int
     *
     * @ORM\Column(name="cl_art_id", type="integer", nullable=false)
     */
    private $clArtId;

    /**
     * @var int
     *
     * @ORM\Column(name="cl_art_prix_id", type="integer", nullable=false)
     */
    private $clArtPrixId;

    /**
     * @var int
     *
     * @ORM\Column(name="cl_qte", type="integer", nullable=false)
     */
    private $clQte;

    /**
     * @var string
     *
     * @ORM\Column(name="cl_mtn", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $clMtn;

    public function getClId(): ?int
    {
        return $this->clId;
    }

    public function getClCdeId(): ?int
    {
        return $this->clCdeId;
    }

    public function setClCdeId(int $clCdeId): self
    {
        $this->clCdeId = $clCdeId;

        return $this;
    }

    public function getClArtId(): ?int
    {
        return $this->clArtId;
    }

    public function setClArtId(int $clArtId): self
    {
        $this->clArtId = $clArtId;

        return $this;
    }

    public function getClArtPrixId(): ?int
    {
        return $this->clArtPrixId;
    }

    public function setClArtPrixId(int $clArtPrixId): self
    {
        $this->clArtPrixId = $clArtPrixId;

        return $this;
    }

    public function getClQte(): ?int
    {
        return $this->clQte;
    }

    public function setClQte(int $clQte): self
    {
        $this->clQte = $clQte;

        return $this;
    }

    public function getClMtn(): ?string
    {
        return $this->clMtn;
    }

    public function setClMtn(string $clMtn): self
    {
        $this->clMtn = $clMtn;

        return $this;
    }


}
