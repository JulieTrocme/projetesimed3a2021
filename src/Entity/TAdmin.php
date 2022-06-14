<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TAdmin
 *
 * @ORM\Table(name="t_admin")
 * @ORM\Entity
 */
class TAdmin
{
    /**
     * @var int
     *
     * @ORM\Column(name="ad_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $adId;

    /**
     * @var string
     *
     * @ORM\Column(name="ad_login", type="string", length=100, nullable=false)
     */
    private $adLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="ad_password", type="string", length=100, nullable=false)
     */
    private $adPassword;

    public function getAdId(): ?int
    {
        return $this->adId;
    }

    public function getAdLogin(): ?string
    {
        return $this->adLogin;
    }

    public function setAdLogin(string $adLogin): self
    {
        $this->adLogin = $adLogin;

        return $this;
    }

    public function getAdPassword(): ?string
    {
        return $this->adPassword;
    }

    public function setAdPassword(string $adPassword): self
    {
        $this->adPassword = $adPassword;

        return $this;
    }


}
