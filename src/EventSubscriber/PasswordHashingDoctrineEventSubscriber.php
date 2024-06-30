<?php

declare(strict_types=1);

namespace Schvoy\UserBundle\EventSubscriber;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Schvoy\UserBundle\Entity\User;
use Schvoy\UserBundle\Security\PasswordUpdaterInterface;

#[AsDoctrineListener(event: Events::prePersist)]
#[AsDoctrineListener(event: Events::preUpdate)]
class PasswordHashingDoctrineEventSubscriber
{
    private static $enabled = true;

    public static function setEnabled(bool $enabled)
    {
        self::$enabled = $enabled;
    }

    public function __construct(private readonly PasswordUpdaterInterface $passwordUpdater)
    {
    }

    public function prePersist(PrePersistEventArgs $args): void
    {
        $this->handlePasswordHashing($args);
    }

    public function preUpdate(PreUpdateEventArgs $args): void
    {
        $this->handlePasswordHashing($args);
    }

    private function handlePasswordHashing(PreUpdateEventArgs|PrePersistEventArgs $args): void
    {
        $entity = $args->getObject();

        if ($entity instanceof User && self::$enabled) {
            $this->passwordUpdater->hashPassword($entity, $entity->getPassword());
        }
    }
}
