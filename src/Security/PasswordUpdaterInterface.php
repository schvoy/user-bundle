<?php

declare(strict_types=1);

namespace Schvoy\UserBundle\Security;

use Symfony\Component\Security\Core\User\UserInterface;

interface PasswordUpdaterInterface
{
    public function hashPassword(UserInterface $user, string $plainPassword): void;
}
