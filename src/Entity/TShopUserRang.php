<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TShopUserRang
 *
 * @ORM\Table(name="t_shop_user_rang")
 * @ORM\Entity
 */
class TShopUserRang
{
    /**
     * @var int
     *
     * @ORM\Column(name="r_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $rId;

    /**
     * @var string
     *
     * @ORM\Column(name="r_libelle", type="string", length=255, nullable=false)
     */
    private $rLibelle;

    public function getRId(): ?int
    {
        return $this->rId;
    }

    public function getRLibelle(): ?string
    {
        return $this->rLibelle;
    }

    public function setRLibelle(string $rLibelle): self
    {
        $this->rLibelle = $rLibelle;

        return $this;
    }


}
