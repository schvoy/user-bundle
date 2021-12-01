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

namespace EightMarq\UserBundle\Security;

use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class PasswordUpdater implements PasswordUpdaterInterface
{
    protected EncoderFactoryInterface $encoderFactory;

    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    public function hashPassword(UserInterface $user, string $plainPassword): void
    {
        if (strlen($plainPassword) === 0) {
            return;
        }

        $encoder = $this->encoderFactory->getEncoder($user);
        $password = $encoder->encodePassword($plainPassword, null);

        $user->setPassword($password);
        $user->eraseCredentials();
    }
}