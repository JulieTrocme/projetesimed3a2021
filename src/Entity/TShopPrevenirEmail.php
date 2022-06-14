<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TShopPrevenirEmail
 *
 * @ORM\Table(name="t_shop_prevenir_email")
 * @ORM\Entity
 */
class TShopPrevenirEmail
{
    /**
     * @var int
     *
     * @ORM\Column(name="pe_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $peId;

    /**
     * @var string
     *
     * @ORM\Column(name="pe_email", type="string", length=255, nullable=false)
     */
    private $peEmail;

    /**
     * @var int
     *
     * @ORM\Column(name="pe_id_produit", type="integer", nullable=false)
     */
    private $peIdProduit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pe_date_demande", type="datetime", nullable=false)
     */
    private $peDateDemande;

    public function getPeId(): ?int
    {
        return $this->peId;
    }

    public function getPeEmail(): ?string
    {
        return $this->peEmail;
    }

    public function setPeEmail(string $peEmail): self
    {
        $this->peEmail = $peEmail;

        return $this;
    }

    public function getPeIdProduit(): ?int
    {
        return $this->peIdProduit;
    }

    public function setPeIdProduit(int $peIdProduit): self
    {
        $this->peIdProduit = $peIdProduit;

        return $this;
    }

    public function getPeDateDemande(): ?\DateTimeInterface
    {
        return $this->peDateDemande;
    }

    public function setPeDateDemande(\DateTimeInterface $peDateDemande): self
    {
        $this->peDateDemande = $peDateDemande;

        return $this;
    }


}
