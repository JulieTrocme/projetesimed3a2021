<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TShopCommande
 *
 * @ORM\Table(name="t_shop_commande")
 * @ORM\Entity
 */
class TShopCommande
{
    /**
     * @var int
     *
     * @ORM\Column(name="cde_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cdeId;

    /**
     * @var int
     *
     * @ORM\Column(name="cde_cli_id", type="integer", nullable=false)
     */
    private $cdeCliId;

    /**
     * @var int
     *
     * @ORM\Column(name="cde_etat_id", type="integer", nullable=false)
     */
    private $cdeEtatId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cde_date", type="datetime", nullable=false)
     */
    private $cdeDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cde_mtn", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $cdeMtn = '0.00';

    /**
     * @var int|null
     *
     * @ORM\Column(name="cde_liv_id", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $cdeLivId = NULL;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cde_fac_id", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $cdeFacId = NULL;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cde_liv_type", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $cdeLivType = NULL;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cde_pay_type", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $cdePayType = NULL;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="cde_pay_date", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $cdePayDate;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cde_pay_mtn", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $cdePayMtn = NULL;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cde_mtn_fdp", type="decimal", precision=10, scale=2, nullable=true, options={"default"="NULL"})
     */
    private $cdeMtnFdp = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="cde_com", type="text", length=65535, nullable=true, options={"default"="NULL"})
     */
    private $cdeCom = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="cde_code_promo", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $cdeCodePromo = 'NULL';

    /**
     * @var int|null
     *
     * @ORM\Column(name="cde_num_transaction", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $cdeNumTransaction = NULL;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cde_num", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $cdeNum = NULL;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity=TShopCommandeLigne::class, mappedBy="commande", orphanRemoval=true)
     *
     */
    private Collection $lignes;

    /**
     * @return Collection
     */
    public function getLignes(): Collection
    {
        return $this->lignes;
    }

    /**
     * @param Collection $lignes
     */
    public function setLignes(Collection $lignes): void
    {
        $this->lignes = $lignes;
    }

    /**
     * @return TShopUser
     */
    public function getUser(): TShopUser
    {
        return $this->user;
    }

    /**
     * @param TShopUser $user
     */
    public function setUser(TShopUser $user): void
    {
        $this->user = $user;
    }

    /**
     * @ORM\ManyToOne(targetEntity=TShopUser::class)
     * @ORM\JoinColumn(name="cde_cli_id", referencedColumnName="u_id")
     */
    private TShopUser $user;

    public function getCdeId(): ?int
    {
        return $this->cdeId;
    }

    public function getCdeCliId(): ?int
    {
        return $this->cdeCliId;
    }

    public function setCdeCliId(int $cdeCliId): self
    {
        $this->cdeCliId = $cdeCliId;

        return $this;
    }

    public function getCdeEtatId(): ?int
    {
        return $this->cdeEtatId;
    }

    public function setCdeEtatId(int $cdeEtatId): self
    {
        $this->cdeEtatId = $cdeEtatId;

        return $this;
    }

    public function getCdeDate(): ?\DateTimeInterface
    {
        return $this->cdeDate;
    }

    public function setCdeDate(\DateTimeInterface $cdeDate): self
    {
        $this->cdeDate = $cdeDate;

        return $this;
    }

    public function getCdeMtn(): ?string
    {
        return $this->cdeMtn;
    }

    public function setCdeMtn(?string $cdeMtn): self
    {
        $this->cdeMtn = $cdeMtn;

        return $this;
    }

    public function getCdeLivId(): ?int
    {
        return $this->cdeLivId;
    }

    public function setCdeLivId(?int $cdeLivId): self
    {
        $this->cdeLivId = $cdeLivId;

        return $this;
    }

    public function getCdeFacId(): ?int
    {
        return $this->cdeFacId;
    }

    public function setCdeFacId(?int $cdeFacId): self
    {
        $this->cdeFacId = $cdeFacId;

        return $this;
    }

    public function getCdeLivType(): ?int
    {
        return $this->cdeLivType;
    }

    public function setCdeLivType(?int $cdeLivType): self
    {
        $this->cdeLivType = $cdeLivType;

        return $this;
    }

    public function getCdePayType(): ?int
    {
        return $this->cdePayType;
    }

    public function setCdePayType(?int $cdePayType): self
    {
        $this->cdePayType = $cdePayType;

        return $this;
    }

    public function getCdePayDate(): ?\DateTimeInterface
    {
        return $this->cdePayDate;
    }

    public function setCdePayDate(?\DateTimeInterface $cdePayDate): self
    {
        $this->cdePayDate = $cdePayDate;

        return $this;
    }

    public function getCdePayMtn(): ?int
    {
        return $this->cdePayMtn;
    }

    public function setCdePayMtn(?int $cdePayMtn): self
    {
        $this->cdePayMtn = $cdePayMtn;

        return $this;
    }

    public function getCdeMtnFdp(): ?string
    {
        return $this->cdeMtnFdp;
    }

    public function setCdeMtnFdp(?string $cdeMtnFdp): self
    {
        $this->cdeMtnFdp = $cdeMtnFdp;

        return $this;
    }

    public function getCdeCom(): ?string
    {
        return $this->cdeCom;
    }

    public function setCdeCom(?string $cdeCom): self
    {
        $this->cdeCom = $cdeCom;

        return $this;
    }

    public function getCdeCodePromo(): ?string
    {
        return $this->cdeCodePromo;
    }

    public function setCdeCodePromo(?string $cdeCodePromo): self
    {
        $this->cdeCodePromo = $cdeCodePromo;

        return $this;
    }

    public function getCdeNumTransaction(): ?int
    {
        return $this->cdeNumTransaction;
    }

    public function setCdeNumTransaction(?int $cdeNumTransaction): self
    {
        $this->cdeNumTransaction = $cdeNumTransaction;

        return $this;
    }

    public function getCdeNum(): ?int
    {
        return $this->cdeNum;
    }

    public function setCdeNum(?int $cdeNum): self
    {
        $this->cdeNum = $cdeNum;

        return $this;
    }


}
