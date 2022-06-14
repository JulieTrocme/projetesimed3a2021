<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TSiteCarouselText
 *
 * @ORM\Table(name="t_site_carousel_text")
 * @ORM\Entity
 */
class TSiteCarouselText
{
    /**
     * @var int
     *
     * @ORM\Column(name="tc_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tcId;

    /**
     * @var string
     *
     * @ORM\Column(name="tc_titre", type="string", length=255, nullable=false)
     */
    private $tcTitre;

    /**
     * @var string
     *
     * @ORM\Column(name="tc_desc", type="text", length=65535, nullable=false)
     */
    private $tcDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="tc_lien", type="string", length=255, nullable=false)
     */
    private $tcLien;

    /**
     * @var string
     *
     * @ORM\Column(name="tc_lien_externe", type="string", length=255, nullable=false)
     */
    private $tcLienExterne;

    /**
     * @var string
     *
     * @ORM\Column(name="tc_lien_libelle", type="string", length=255, nullable=false)
     */
    private $tcLienLibelle;

    /**
     * @var int
     *
     * @ORM\Column(name="tc_lien_actif", type="integer", nullable=false)
     */
    private $tcLienActif;

    /**
     * @var int
     *
     * @ORM\Column(name="tc_type", type="integer", nullable=false)
     */
    private $tcType;

    public function getTcId(): ?int
    {
        return $this->tcId;
    }

    public function getTcTitre(): ?string
    {
        return $this->tcTitre;
    }

    public function setTcTitre(string $tcTitre): self
    {
        $this->tcTitre = $tcTitre;

        return $this;
    }

    public function getTcDesc(): ?string
    {
        return $this->tcDesc;
    }

    public function setTcDesc(string $tcDesc): self
    {
        $this->tcDesc = $tcDesc;

        return $this;
    }

    public function getTcLien(): ?string
    {
        return $this->tcLien;
    }

    public function setTcLien(string $tcLien): self
    {
        $this->tcLien = $tcLien;

        return $this;
    }

    public function getTcLienExterne(): ?string
    {
        return $this->tcLienExterne;
    }

    public function setTcLienExterne(string $tcLienExterne): self
    {
        $this->tcLienExterne = $tcLienExterne;

        return $this;
    }

    public function getTcLienLibelle(): ?string
    {
        return $this->tcLienLibelle;
    }

    public function setTcLienLibelle(string $tcLienLibelle): self
    {
        $this->tcLienLibelle = $tcLienLibelle;

        return $this;
    }

    public function getTcLienActif(): ?int
    {
        return $this->tcLienActif;
    }

    public function setTcLienActif(int $tcLienActif): self
    {
        $this->tcLienActif = $tcLienActif;

        return $this;
    }

    public function getTcType(): ?int
    {
        return $this->tcType;
    }

    public function setTcType(int $tcType): self
    {
        $this->tcType = $tcType;

        return $this;
    }


}
