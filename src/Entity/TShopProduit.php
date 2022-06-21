<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TShopProduit
 *
 * @ORM\Table(name="t_shop_produit")
 * @ORM\Entity
 */
class TShopProduit
{
    /**
     * @var int
     *
     * @ORM\Column(name="pr_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $prId;

    /**
     * @var int
     *
     * @ORM\Column(name="pr_id_cat1", type="integer", nullable=false)
     */
    private $prIdCat1;

    /**
     * @var int
     *
     * @ORM\Column(name="pr_id_cat2", type="integer", nullable=false)
     */
    private $prIdCat2;

    /**
     * @var int
     *
     * @ORM\Column(name="pr_id_maison", type="integer", nullable=false)
     */
    private $prIdMaison;

    /**
     * @var int
     *
     * @ORM\Column(name="pr_cat_order", type="integer", nullable=false)
     */
    private $prCatOrder = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="pr_stock", type="integer", nullable=false)
     */
    private $prStock = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="pr_titre", type="string", length=255, nullable=false)
     */
    private $prTitre;

    /**
     * @var string
     *
     * @ORM\Column(name="pr_desc_short", type="text", length=65535, nullable=false)
     */
    private $prDescShort;

    /**
     * @var string
     *
     * @ORM\Column(name="pr_desc", type="text", length=65535, nullable=false)
     */
    private $prDesc;

    /**
     * @var int
     *
     * @ORM\Column(name="pr_tva", type="integer", nullable=false)
     */
    private $prTva = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pr_date_creation", type="datetime", nullable=false)
     */
    private $prDateCreation;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="pr_date_modification", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $prDateModification;

    /**
     * @var string
     *
     * @ORM\Column(name="pr_seo_url", type="string", length=255, nullable=false)
     */
    private $prSeoUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="pr_seo_titre", type="string", length=255, nullable=false)
     */
    private $prSeoTitre;

    /**
     * @var string
     *
     * @ORM\Column(name="pr_seo_desc", type="string", length=255, nullable=false)
     */
    private $prSeoDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="pr_ref", type="string", length=255, nullable=false)
     */
    private $prRef;

    /**
     * @var int
     *
     * @ORM\Column(name="pr_mise_avant", type="integer", nullable=false)
     */
    private $prMiseAvant = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="pr_mise_avant_panier", type="integer", nullable=false)
     */
    private $prMiseAvantPanier = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="pr_nouveaux", type="integer", nullable=false)
     */
    private $prNouveaux = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="pr_particularite", type="integer", nullable=false)
     */
    private $prParticularite = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="pr_archive", type="integer", nullable=false)
     */
    private $prArchive = 0;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="pr_date_archive", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $prDateArchive;

    /**
     * @var int
     *
     * @ORM\Column(name="pr_actif", type="integer", nullable=false)
     */
    private $prActif = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="pr_popu", type="integer", nullable=false)
     */
    private $prPopu = 0;

    /**
     * @var double
     *
     * @ORM\Column(name="pr_prix", type="decimal",precision=2, scale=1, nullable=false)
     */
    private $prPrix;

    /**
     * @return float
     */
    public function getPrPrix(): float
    {
        return $this->prPrix;
    }

    /**
     * @param float $prPrix
     */
    public function setPrPrix(float $prPrix): void
    {
        $this->prPrix = $prPrix;
    }

    /**
     * @ORM\ManyToOne(targetEntity=TShopProduitCategorie::class)
     * @ORM\JoinColumn(name="pr_id_cat1", referencedColumnName="ca_id")
     */
    private TShopProduitCategorie $cat;

    /**
     * @ORM\ManyToOne(targetEntity=TShopProduitCategorie2::class)
     * @ORM\JoinColumn(name="pr_id_cat2", referencedColumnName="ca_id")
     */
    private TShopProduitCategorie2 $cat2;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity=TShopProduitImage::class, mappedBy="produit", orphanRemoval=true)
     *
     */
    private Collection $images;

    /**
     * @return Collection
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    /**
     * @param Collection $images
     */
    public function setImages(Collection $images): void
    {
        $this->images = $images;
    }


    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    /**
     * @return TShopProduitCategorie2
     */
    public function getCat2(): TShopProduitCategorie2
    {
        return $this->cat2;
    }

    /**
     * @param TShopProduitCategorie2 $cat2
     */
    public function setCat2(TShopProduitCategorie2 $cat2): void
    {
        $this->cat2 = $cat2;
    }

    /**
     * @return TShopProduitCategorie
     */
    public function getCat(): TShopProduitCategorie
    {
        return $this->cat;
    }

    /**
     * @param TShopProduitCategorie $cat
     */
    public function setCat(TShopProduitCategorie $cat): void
    {
        $this->cat = $cat;
    }

    public function getPrId(): ?int
    {
        return $this->prId;
    }

    public function getPrIdCat1(): ?int
    {
        return $this->prIdCat1;
    }

    public function setPrIdCat1(int $prIdCat1): self
    {
        $this->prIdCat1 = $prIdCat1;

        return $this;
    }

    public function getPrIdCat2(): ?int
    {
        return $this->prIdCat2;
    }

    public function setPrIdCat2(int $prIdCat2): self
    {
        $this->prIdCat2 = $prIdCat2;

        return $this;
    }

    public function getPrIdMaison(): ?int
    {
        return $this->prIdMaison;
    }

    public function setPrIdMaison(int $prIdMaison): self
    {
        $this->prIdMaison = $prIdMaison;

        return $this;
    }

    public function getPrCatOrder(): ?int
    {
        return $this->prCatOrder;
    }

    public function setPrCatOrder(int $prCatOrder): self
    {
        $this->prCatOrder = $prCatOrder;

        return $this;
    }

    public function getPrStock(): ?int
    {
        return $this->prStock;
    }

    public function setPrStock(int $prStock): self
    {
        $this->prStock = $prStock;

        return $this;
    }

    public function getPrTitre(): ?string
    {
        return $this->prTitre;
    }

    public function setPrTitre(string $prTitre): self
    {
        $this->prTitre = $prTitre;

        return $this;
    }

    public function getPrDescShort(): ?string
    {
        return $this->prDescShort;
    }

    public function setPrDescShort(string $prDescShort): self
    {
        $this->prDescShort = $prDescShort;

        return $this;
    }

    public function getPrDesc(): ?string
    {
        return $this->prDesc;
    }

    public function setPrDesc(string $prDesc): self
    {
        $this->prDesc = $prDesc;

        return $this;
    }

    public function getPrTva(): ?int
    {
        return $this->prTva;
    }

    public function setPrTva(int $prTva): self
    {
        $this->prTva = $prTva;

        return $this;
    }

    public function getPrDateCreation(): ?\DateTimeInterface
    {
        return $this->prDateCreation;
    }

    public function setPrDateCreation(\DateTimeInterface $prDateCreation): self
    {
        $this->prDateCreation = $prDateCreation;

        return $this;
    }

    public function getPrDateModification(): ?\DateTimeInterface
    {
        return $this->prDateModification;
    }

    public function setPrDateModification(?\DateTimeInterface $prDateModification): self
    {
        $this->prDateModification = $prDateModification;

        return $this;
    }

    public function getPrSeoUrl(): ?string
    {
        return $this->prSeoUrl;
    }

    public function setPrSeoUrl(string $prSeoUrl): self
    {
        $this->prSeoUrl = $prSeoUrl;

        return $this;
    }

    public function getPrSeoTitre(): ?string
    {
        return $this->prSeoTitre;
    }

    public function setPrSeoTitre(string $prSeoTitre): self
    {
        $this->prSeoTitre = $prSeoTitre;

        return $this;
    }

    public function getPrSeoDesc(): ?string
    {
        return $this->prSeoDesc;
    }

    public function setPrSeoDesc(string $prSeoDesc): self
    {
        $this->prSeoDesc = $prSeoDesc;

        return $this;
    }

    public function getPrRef(): ?string
    {
        return $this->prRef;
    }

    public function setPrRef(string $prRef): self
    {
        $this->prRef = $prRef;

        return $this;
    }

    public function getPrMiseAvant(): ?int
    {
        return $this->prMiseAvant;
    }

    public function setPrMiseAvant(int $prMiseAvant): self
    {
        $this->prMiseAvant = $prMiseAvant;

        return $this;
    }

    public function getPrMiseAvantPanier(): ?int
    {
        return $this->prMiseAvantPanier;
    }

    public function setPrMiseAvantPanier(int $prMiseAvantPanier): self
    {
        $this->prMiseAvantPanier = $prMiseAvantPanier;

        return $this;
    }

    public function getPrNouveaux(): ?int
    {
        return $this->prNouveaux;
    }

    public function setPrNouveaux(int $prNouveaux): self
    {
        $this->prNouveaux = $prNouveaux;

        return $this;
    }

    public function getPrParticularite(): ?int
    {
        return $this->prParticularite;
    }

    public function setPrParticularite(int $prParticularite): self
    {
        $this->prParticularite = $prParticularite;

        return $this;
    }

    public function getPrArchive(): ?int
    {
        return $this->prArchive;
    }

    public function setPrArchive(int $prArchive): self
    {
        $this->prArchive = $prArchive;

        return $this;
    }

    public function getPrDateArchive(): ?\DateTimeInterface
    {
        return $this->prDateArchive;
    }

    public function setPrDateArchive(?\DateTimeInterface $prDateArchive): self
    {
        $this->prDateArchive = $prDateArchive;

        return $this;
    }

    public function getPrActif(): ?int
    {
        return $this->prActif;
    }

    public function setPrActif(int $prActif): self
    {
        $this->prActif = $prActif;

        return $this;
    }

    public function getPrPopu(): ?int
    {
        return $this->prPopu;
    }

    public function setPrPopu(int $prPopu): self
    {
        $this->prPopu = $prPopu;

        return $this;
    }


}
