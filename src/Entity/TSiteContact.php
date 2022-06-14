<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TSiteContact
 *
 * @ORM\Table(name="t_site_contact")
 * @ORM\Entity
 */
class TSiteContact
{
    /**
     * @var int
     *
     * @ORM\Column(name="sc_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $scId;

    /**
     * @var string
     *
     * @ORM\Column(name="sc_adresse", type="string", length=255, nullable=false)
     */
    private $scAdresse;

    /**
     * @var string
     *
     * @ORM\Column(name="sc_tel", type="string", length=255, nullable=false)
     */
    private $scTel;

    /**
     * @var string
     *
     * @ORM\Column(name="sc_email", type="string", length=255, nullable=false)
     */
    private $scEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="sc_horaire", type="string", length=255, nullable=false)
     */
    private $scHoraire;

    public function getScId(): ?int
    {
        return $this->scId;
    }

    public function getScAdresse(): ?string
    {
        return $this->scAdresse;
    }

    public function setScAdresse(string $scAdresse): self
    {
        $this->scAdresse = $scAdresse;

        return $this;
    }

    public function getScTel(): ?string
    {
        return $this->scTel;
    }

    public function setScTel(string $scTel): self
    {
        $this->scTel = $scTel;

        return $this;
    }

    public function getScEmail(): ?string
    {
        return $this->scEmail;
    }

    public function setScEmail(string $scEmail): self
    {
        $this->scEmail = $scEmail;

        return $this;
    }

    public function getScHoraire(): ?string
    {
        return $this->scHoraire;
    }

    public function setScHoraire(string $scHoraire): self
    {
        $this->scHoraire = $scHoraire;

        return $this;
    }


}
