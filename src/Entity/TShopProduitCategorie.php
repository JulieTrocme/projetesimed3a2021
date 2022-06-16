<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TShopProduitCategorie
 *
 * @ORM\Table(name="t_shop_produit_categorie")
 * @ORM\Entity
 */
class TShopProduitCategorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="ca_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $caId;

    /**
     * @var string
     *
     * @ORM\Column(name="ca_titre", type="string", length=255, nullable=false)
     */
    private $caTitre;

    /**
     * @var string
     *
     * @ORM\Column(name="ca_desc", type="string", length=255, nullable=false)
     */
    private $caDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="ca_seo_url", type="string", length=255, nullable=false)
     */
    private $caSeoUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="ca_seo_desc", type="string", length=255, nullable=false)
     */
    private $caSeoDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="ca_seo_titre", type="string", length=255, nullable=false)
     */
    private $caSeoTitre;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ca_page_id", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $caPageId = NULL;

    /**
     * @var int
     *
     * @ORM\Column(name="ca_actif", type="integer", nullable=false)
     */
    private $caActif = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ca_date_update", type="datetime", nullable=false, options={"default"="current_timestamp()"})
     */
    private $caDateUpdate = null;

    /**
     * @var int
     *
     * @ORM\Column(name="ca_ordre", type="integer", nullable=false)
     */
    private $caOrdre;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity=TShopProduitCategorie2::class, mappedBy="cat", orphanRemoval=true)
     *
     */
    private Collection $souscats;

    /**
     * @return Collection
     */
    public function getSouscats(): Collection
    {
        return $this->souscats;
    }

    /**
     * @param Collection $souscats
     */
    public function setSouscats(Collection $souscats): void
    {
        $this->souscats = $souscats;
    }

    public function __construct()
    {
        $this->souscats = new ArrayCollection();
    }

    public function getCaId(): ?int
    {
        return $this->caId;
    }

    public function getCaTitre(): ?string
    {
        return $this->caTitre;
    }

    public function setCaTitre(string $caTitre): self
    {
        $this->caTitre = $caTitre;

        return $this;
    }

    public function getCaDesc(): ?string
    {
        return $this->caDesc;
    }

    public function setCaDesc(string $caDesc): self
    {
        $this->caDesc = $caDesc;

        return $this;
    }

    public function getCaSeoUrl(): ?string
    {
        return $this->caSeoUrl;
    }

    public function setCaSeoUrl(string $caSeoUrl): self
    {
        $this->caSeoUrl = $caSeoUrl;

        return $this;
    }

    public function getCaSeoDesc(): ?string
    {
        return $this->caSeoDesc;
    }

    public function setCaSeoDesc(string $caSeoDesc): self
    {
        $this->caSeoDesc = $caSeoDesc;

        return $this;
    }

    public function getCaSeoTitre(): ?string
    {
        return $this->caSeoTitre;
    }

    public function setCaSeoTitre(string $caSeoTitre): self
    {
        $this->caSeoTitre = $caSeoTitre;

        return $this;
    }

    public function getCaPageId(): ?int
    {
        return $this->caPageId;
    }

    public function setCaPageId(?int $caPageId): self
    {
        $this->caPageId = $caPageId;

        return $this;
    }

    public function getCaActif(): ?int
    {
        return $this->caActif;
    }

    public function setCaActif(int $caActif): self
    {
        $this->caActif = $caActif;

        return $this;
    }

    public function getCaDateUpdate(): ?\DateTimeInterface
    {
        return $this->caDateUpdate;
    }

    public function setCaDateUpdate(\DateTimeInterface $caDateUpdate): self
    {
        $this->caDateUpdate = $caDateUpdate;

        return $this;
    }

    public function getCaOrdre(): ?int
    {
        return $this->caOrdre;
    }

    public function setCaOrdre(int $caOrdre): self
    {
        $this->caOrdre = $caOrdre;

        return $this;
    }


}
