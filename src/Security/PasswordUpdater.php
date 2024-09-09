<?php

declare(strict_types=1);

namespace Schvoy\UserBundle\Security;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class PasswordUpdater implements PasswordUpdaterInterface
{
    protected UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function hashPassword(UserInterface $user, string $plainPassword): void
    {
        if (strlen($plainPassword) === 0) {
            return;
        }

        if (!$user instanceof PasswordAuthenticatedUserInterface) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        if (
            null !== $user->getPassword()
            && false === $this->userPasswordHasher->needsRehash($user)
        ) {
            return;
        }

        $password = $this->userPasswordHasher->hashPassword($user, $plainPassword);

        $user->setPassword($password);
        $user->eraseCredentials();
    }
}
