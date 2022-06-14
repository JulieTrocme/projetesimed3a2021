<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TShopUserAdresse
 *
 * @ORM\Table(name="t_shop_user_adresse")
 * @ORM\Entity
 */
class TShopUserAdresse
{
    /**
     * @var int
     *
     * @ORM\Column(name="a_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $aId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="a_id_pays", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $aIdPays = NULL;

    /**
     * @var int
     *
     * @ORM\Column(name="a_id_user", type="integer", nullable=false)
     */
    private $aIdUser;

    /**
     * @var string|null
     *
     * @ORM\Column(name="a_nom", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $aNom = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="a_prenom", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $aPrenom = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="a_adresse_1", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $aAdresse1 = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="a_adresse_2", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $aAdresse2 = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="a_ville", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $aVille = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="a_code", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $aCode = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="a_telephone_1", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $aTelephone1 = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="a_telephone_2", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $aTelephone2 = 'NULL';

    /**
     * @var bool
     *
     * @ORM\Column(name="a_actif", type="boolean", nullable=false)
     */
    private $aActif = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="a_date_creation", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $aDateCreation = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="a_date_modification", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $aDateModification = 'NULL';

    public function getAId(): ?int
    {
        return $this->aId;
    }

    public function getAIdPays(): ?int
    {
        return $this->aIdPays;
    }

    public function setAIdPays(?int $aIdPays): self
    {
        $this->aIdPays = $aIdPays;

        return $this;
    }

    public function getAIdUser(): ?int
    {
        return $this->aIdUser;
    }

    public function setAIdUser(int $aIdUser): self
    {
        $this->aIdUser = $aIdUser;

        return $this;
    }

    public function getANom(): ?string
    {
        return $this->aNom;
    }

    public function setANom(?string $aNom): self
    {
        $this->aNom = $aNom;

        return $this;
    }

    public function getAPrenom(): ?string
    {
        return $this->aPrenom;
    }

    public function setAPrenom(?string $aPrenom): self
    {
        $this->aPrenom = $aPrenom;

        return $this;
    }

    public function getAAdresse1(): ?string
    {
        return $this->aAdresse1;
    }

    public function setAAdresse1(?string $aAdresse1): self
    {
        $this->aAdresse1 = $aAdresse1;

        return $this;
    }

    public function getAAdresse2(): ?string
    {
        return $this->aAdresse2;
    }

    public function setAAdresse2(?string $aAdresse2): self
    {
        $this->aAdresse2 = $aAdresse2;

        return $this;
    }

    public function getAVille(): ?string
    {
        return $this->aVille;
    }

    public function setAVille(?string $aVille): self
    {
        $this->aVille = $aVille;

        return $this;
    }

    public function getACode(): ?string
    {
        return $this->aCode;
    }

    public function setACode(?string $aCode): self
    {
        $this->aCode = $aCode;

        return $this;
    }

    public function getATelephone1(): ?string
    {
        return $this->aTelephone1;
    }

    public function setATelephone1(?string $aTelephone1): self
    {
        $this->aTelephone1 = $aTelephone1;

        return $this;
    }

    public function getATelephone2(): ?string
    {
        return $this->aTelephone2;
    }

    public function setATelephone2(?string $aTelephone2): self
    {
        $this->aTelephone2 = $aTelephone2;

        return $this;
    }

    public function getAActif(): ?bool
    {
        return $this->aActif;
    }

    public function setAActif(bool $aActif): self
    {
        $this->aActif = $aActif;

        return $this;
    }

    public function getADateCreation(): ?\DateTimeInterface
    {
        return $this->aDateCreation;
    }

    public function setADateCreation(?\DateTimeInterface $aDateCreation): self
    {
        $this->aDateCreation = $aDateCreation;

        return $this;
    }

    public function getADateModification(): ?\DateTimeInterface
    {
        return $this->aDateModification;
    }

    public function setADateModification(?\DateTimeInterface $aDateModification): self
    {
        $this->aDateModification = $aDateModification;

        return $this;
    }


}
