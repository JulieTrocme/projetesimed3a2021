<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TShopUser
 *
 * @ORM\Table(name="t_shop_user")
 * @ORM\Entity
 */
class TShopUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="u_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $uId;

    /**
     * @var int
     *
     * @ORM\Column(name="u_id_rang", type="integer", nullable=false)
     */
    private $uIdRang;

    /**
     * @var string|null
     *
     * @ORM\Column(name="u_email", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $uEmail = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="u_password", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $uPassword = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="u_date_creation", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $uDateCreation = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="u_date_modification", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $uDateModification = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="u_date_connexion", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $uDateConnexion = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="u_token_password", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $uTokenPassword = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="u_token_email", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $uTokenEmail = 'NULL';

    /**
     * @var bool
     *
     * @ORM\Column(name="u_actif", type="boolean", nullable=false)
     */
    private $uActif = '0';

    public function getUId(): ?int
    {
        return $this->uId;
    }

    public function getUIdRang(): ?int
    {
        return $this->uIdRang;
    }

    public function setUIdRang(int $uIdRang): self
    {
        $this->uIdRang = $uIdRang;

        return $this;
    }

    public function getUEmail(): ?string
    {
        return $this->uEmail;
    }

    public function setUEmail(?string $uEmail): self
    {
        $this->uEmail = $uEmail;

        return $this;
    }

    public function getUPassword(): ?string
    {
        return $this->uPassword;
    }

    public function setUPassword(?string $uPassword): self
    {
        $this->uPassword = $uPassword;

        return $this;
    }

    public function getUDateCreation(): ?\DateTimeInterface
    {
        return $this->uDateCreation;
    }

    public function setUDateCreation(?\DateTimeInterface $uDateCreation): self
    {
        $this->uDateCreation = $uDateCreation;

        return $this;
    }

    public function getUDateModification(): ?\DateTimeInterface
    {
        return $this->uDateModification;
    }

    public function setUDateModification(?\DateTimeInterface $uDateModification): self
    {
        $this->uDateModification = $uDateModification;

        return $this;
    }

    public function getUDateConnexion(): ?\DateTimeInterface
    {
        return $this->uDateConnexion;
    }

    public function setUDateConnexion(?\DateTimeInterface $uDateConnexion): self
    {
        $this->uDateConnexion = $uDateConnexion;

        return $this;
    }

    public function getUTokenPassword(): ?string
    {
        return $this->uTokenPassword;
    }

    public function setUTokenPassword(?string $uTokenPassword): self
    {
        $this->uTokenPassword = $uTokenPassword;

        return $this;
    }

    public function getUTokenEmail(): ?string
    {
        return $this->uTokenEmail;
    }

    public function setUTokenEmail(?string $uTokenEmail): self
    {
        $this->uTokenEmail = $uTokenEmail;

        return $this;
    }

    public function getUActif(): ?bool
    {
        return $this->uActif;
    }

    public function setUActif(bool $uActif): self
    {
        $this->uActif = $uActif;

        return $this;
    }


}
