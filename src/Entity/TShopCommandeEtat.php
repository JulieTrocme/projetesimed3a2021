<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TShopCommandeEtat
 *
 * @ORM\Table(name="t_shop_commande_etat")
 * @ORM\Entity
 */
class TShopCommandeEtat
{
    /**
     * @var int
     *
     * @ORM\Column(name="et_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $etId;

    /**
     * @var string
     *
     * @ORM\Column(name="et_libelle", type="string", length=50, nullable=false)
     */
    private $etLibelle;

    public function getEtId(): ?int
    {
        return $this->etId;
    }

    public function getEtLibelle(): ?string
    {
        return $this->etLibelle;
    }

    public function setEtLibelle(string $etLibelle): self
    {
        $this->etLibelle = $etLibelle;

        return $this;
    }


}
