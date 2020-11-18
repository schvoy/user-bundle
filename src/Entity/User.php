<?php

/**
 * This file is part of the EightMarq Symfony bundles.
 *
 * (c) Norbert Schvoy <norbert.schvoy@eightmarq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace EightMarq\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EightMarq\CoreBundle\Entity\BaseEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\MappedSuperclass()
 */
class User extends BaseEntity implements UserInterface
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=180, unique=true)
     */
    protected string $email;

    /**
     * @var array
     *
     * @ORM\Column(type="json")
     */
    protected array $roles = [];

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected string $password;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getEmail();
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;

        // Guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param array $roles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string)$this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {

    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {

    }
}
