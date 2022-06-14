<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TShopPays
 *
 * @ORM\Table(name="t_shop_pays")
 * @ORM\Entity
 */
class TShopPays
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
     * @var string|null
     *
     * @ORM\Column(name="p_libelle", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $pLibelle = 'NULL';

    /**
     * @var string|null
     *
     * @ORM\Column(name="p_libelle_eng", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $pLibelleEng = 'NULL';

    public function getPId(): ?int
    {
        return $this->pId;
    }

    public function getPLibelle(): ?string
    {
        return $this->pLibelle;
    }

    public function setPLibelle(?string $pLibelle): self
    {
        $this->pLibelle = $pLibelle;

        return $this;
    }

    public function getPLibelleEng(): ?string
    {
        return $this->pLibelleEng;
    }

    public function setPLibelleEng(?string $pLibelleEng): self
    {
        $this->pLibelleEng = $pLibelleEng;

        return $this;
    }


}
