<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TShopPromo
 *
 * @ORM\Table(name="t_shop_promo")
 * @ORM\Entity
 */
class TShopPromo
{
    /**
     * @var int
     *
     * @ORM\Column(name="p_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pId;

    /**
     * @var string
     *
     * @ORM\Column(name="p_libelle", type="string", length=255, nullable=false)
     */
    private $pLibelle;

    /**
     * @var string
     *
     * @ORM\Column(name="p_remise", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $pRemise = '0.00';

    /**
     * @var int
     *
     * @ORM\Column(name="p_livraison", type="integer", nullable=false)
     */
    private $pLivraison = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="p_type", type="integer", nullable=false)
     */
    private $pType = 0;

    /**
     * @var string|null
     *
     * @ORM\Column(name="p_desc", type="text", length=65535, nullable=true, options={"default"="NULL"})
     */
    private $pDesc = 'NULL';

    /**
     * @var int
     *
     * @ORM\Column(name="p_delete", type="integer", nullable=false)
     */
    private $pDelete = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="p_actif", type="integer", nullable=false)
     */
    private $pActif = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="p_date_begin", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $pDateBegin = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="p_date_end", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $pDateEnd = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="p_a_partir", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $pAPartir = '0.00';

    public function getPId(): ?int
    {
        return $this->pId;
    }

    public function getPLibelle(): ?string
    {
        return $this->pLibelle;
    }

    public function setPLibelle(string $pLibelle): self
    {
        $this->pLibelle = $pLibelle;

        return $this;
    }

    public function getPRemise(): ?string
    {
        return $this->pRemise;
    }

    public function setPRemise(string $pRemise): self
    {
        $this->pRemise = $pRemise;

        return $this;
    }

    public function getPLivraison(): ?int
    {
        return $this->pLivraison;
    }

    public function setPLivraison(int $pLivraison): self
    {
        $this->pLivraison = $pLivraison;

        return $this;
    }

    public function getPType(): ?int
    {
        return $this->pType;
    }

    public function setPType(int $pType): self
    {
        $this->pType = $pType;

        return $this;
    }

    public function getPDesc(): ?string
    {
        return $this->pDesc;
    }

    public function setPDesc(?string $pDesc): self
    {
        $this->pDesc = $pDesc;

        return $this;
    }

    public function getPDelete(): ?int
    {
        return $this->pDelete;
    }

    public function setPDelete(int $pDelete): self
    {
        $this->pDelete = $pDelete;

        return $this;
    }

    public function getPActif(): ?int
    {
        return $this->pActif;
    }

    public function setPActif(int $pActif): self
    {
        $this->pActif = $pActif;

        return $this;
    }

    public function getPDateBegin(): ?\DateTimeInterface
    {
        return $this->pDateBegin;
    }

    public function setPDateBegin(?\DateTimeInterface $pDateBegin): self
    {
        $this->pDateBegin = $pDateBegin;

        return $this;
    }

    public function getPDateEnd(): ?\DateTimeInterface
    {
        return $this->pDateEnd;
    }

    public function setPDateEnd(?\DateTimeInterface $pDateEnd): self
    {
        $this->pDateEnd = $pDateEnd;

        return $this;
    }

    public function getPAPartir(): ?string
    {
        return $this->pAPartir;
    }

    public function setPAPartir(?string $pAPartir): self
    {
        $this->pAPartir = $pAPartir;

        return $this;
    }


}
