<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * TAdmin
 *
 * @ORM\Table(name="t_admin")
 * @ORM\Entity
 * @method string getUserIdentifier()
 */
class TAdmin implements UserInterface
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


    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles[] = 'ROLE_ADMIN';

        return array_unique($roles);
    }


    public function getPassword()
    {
        return (string) $this->getAdPassword();
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUsername()
    {
        return (string) $this->getAdLogin();
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
    }
}
