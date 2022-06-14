<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TSiteCarousel
 *
 * @ORM\Table(name="t_site_carousel")
 * @ORM\Entity
 */
class TSiteCarousel
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
     * @ORM\Column(name="ca_image", type="string", length=255, nullable=false)
     */
    private $caImage;

    /**
     * @var string
     *
     * @ORM\Column(name="ca_lien", type="string", length=255, nullable=false)
     */
    private $caLien;

    /**
     * @var string
     *
     * @ORM\Column(name="ca_lien_libelle", type="string", length=255, nullable=false)
     */
    private $caLienLibelle;

    /**
     * @var int
     *
     * @ORM\Column(name="ca_actif", type="integer", nullable=false)
     */
    private $caActif;

    /**
     * @var string
     *
     * @ORM\Column(name="ca_lien_externe", type="string", length=255, nullable=false)
     */
    private $caLienExterne;

    /**
     * @var int
     *
     * @ORM\Column(name="ca_lien_actif", type="integer", nullable=false)
     */
    private $caLienActif;

    /**
     * @var int
     *
     * @ORM\Column(name="ca_order", type="integer", nullable=false)
     */
    private $caOrder;

    /**
     * @var string
     *
     * @ORM\Column(name="ca_titre", type="string", length=255, nullable=false)
     */
    private $caTitre;

    /**
     * @var string
     *
     * @ORM\Column(name="ca_titre_color", type="string", length=255, nullable=false)
     */
    private $caTitreColor;

    /**
     * @var string
     *
     * @ORM\Column(name="ca_desc", type="text", length=65535, nullable=false)
     */
    private $caDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="ca_desc_color", type="string", length=255, nullable=false)
     */
    private $caDescColor;

    /**
     * @var int
     *
     * @ORM\Column(name="ca_text_actif", type="integer", nullable=false)
     */
    private $caTextActif;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ca_last_update", type="datetime", nullable=false)
     */
    private $caLastUpdate;

    public function getCaId(): ?int
    {
        return $this->caId;
    }

    public function getCaImage(): ?string
    {
        return $this->caImage;
    }

    public function setCaImage(string $caImage): self
    {
        $this->caImage = $caImage;

        return $this;
    }

    public function getCaLien(): ?string
    {
        return $this->caLien;
    }

    public function setCaLien(string $caLien): self
    {
        $this->caLien = $caLien;

        return $this;
    }

    public function getCaLienLibelle(): ?string
    {
        return $this->caLienLibelle;
    }

    public function setCaLienLibelle(string $caLienLibelle): self
    {
        $this->caLienLibelle = $caLienLibelle;

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

    public function getCaLienExterne(): ?string
    {
        return $this->caLienExterne;
    }

    public function setCaLienExterne(string $caLienExterne): self
    {
        $this->caLienExterne = $caLienExterne;

        return $this;
    }

    public function getCaLienActif(): ?int
    {
        return $this->caLienActif;
    }

    public function setCaLienActif(int $caLienActif): self
    {
        $this->caLienActif = $caLienActif;

        return $this;
    }

    public function getCaOrder(): ?int
    {
        return $this->caOrder;
    }

    public function setCaOrder(int $caOrder): self
    {
        $this->caOrder = $caOrder;

        return $this;
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

    public function getCaTitreColor(): ?string
    {
        return $this->caTitreColor;
    }

    public function setCaTitreColor(string $caTitreColor): self
    {
        $this->caTitreColor = $caTitreColor;

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

    public function getCaDescColor(): ?string
    {
        return $this->caDescColor;
    }

    public function setCaDescColor(string $caDescColor): self
    {
        $this->caDescColor = $caDescColor;

        return $this;
    }

    public function getCaTextActif(): ?int
    {
        return $this->caTextActif;
    }

    public function setCaTextActif(int $caTextActif): self
    {
        $this->caTextActif = $caTextActif;

        return $this;
    }

    public function getCaLastUpdate(): ?\DateTimeInterface
    {
        return $this->caLastUpdate;
    }

    public function setCaLastUpdate(\DateTimeInterface $caLastUpdate): self
    {
        $this->caLastUpdate = $caLastUpdate;

        return $this;
    }


}
