<?php

declare(strict_types=1);

namespace EightMarq\UserBundle\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;
use EightMarq\UserBundle\Entity\User;
use EightMarq\UserBundle\Security\PasswordUpdaterInterface;

class PasswordHashingDoctrineEventSubscriber implements EventSubscriber
{
    private static $enabled = true;

    public static function setEnabled(bool $enabled)
    {
        self::$enabled = $enabled;
    }

    public function __construct(
        private readonly PasswordUpdaterInterface $passwordUpdater
    ) {
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
        ];
    }

    public function prePersist(PrePersistEventArgs $args): void
    {
        $entity = $args->getObject();

        if ($entity instanceof User && self::$enabled) {
            $this->passwordUpdater->hashPassword($entity, $entity->getPassword());
        }
    }
}
