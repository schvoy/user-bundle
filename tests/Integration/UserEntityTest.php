<?php

declare(strict_types=1);

namespace Schvoy\UserBundle\Tests\Integration;

use Schvoy\UserBundle\EventSubscriber\PasswordHashingDoctrineEventSubscriber;
use Schvoy\UserBundle\Tests\AbstractTestCase;
use Schvoy\UserBundle\Tests\Fixtures\Entity\User;
use Override;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
class UserEntityTest extends AbstractTestCase
{
    public function testCreateUserEntity(): void
    {
        $entity = new User();
        $entity->setEmail('test-user@example.com');
        $entity->setPassword('test');

        $this->entityManager->persist($entity);
        $this->flush();

        $this->assertNotEquals('test', $entity->getPassword());
        $this->assertTrue(str_starts_with($entity->getPassword(), '$2y$13'));
    }

    public function testUpdateUserEntityWithoutPasswordUpdate(): void
    {
        $entity = new User();
        $entity->setEmail('test-user@example.com');
        $entity->setPassword('test');

        $this->entityManager->persist($entity);
        $this->flush();

        $this->assertNotEquals('test', $entity->getPassword());
        $this->assertTrue(str_starts_with($entity->getPassword(), '$2y$13'));

        $oldPassword = $entity->getPassword();

        // Fetch
        $entity = $this->getEntity($entity->getId());

        // Update
        $entity->setEmail('test-user2@example.com');

        $this->flush();

        $this->assertEquals($oldPassword, $entity->getPassword());
    }

    public function testUpdateUserEntityPassword(): void
    {
        $entity = new User();
        $entity->setEmail('test-user@example.com');
        $entity->setPassword('test');

        $this->entityManager->persist($entity);
        $this->flush();

        $this->assertNotEquals('test', $entity->getPassword());
        $this->assertTrue(str_starts_with($entity->getPassword(), '$2y$13'));

        $oldPassword = $entity->getPassword();

        // Fetch
        $entity = $this->getEntity($entity->getId());

        // Update
        $entity->setPassword('test2');

        $this->flush();

        $this->assertNotEquals($oldPassword, $entity->getPassword());
        $this->assertNotEquals('test2', $entity->getPassword());
        $this->assertTrue(str_starts_with($entity->getPassword(), '$2y$13'));
    }

    public function testCreateUserWithDisabledPasswordUpdaterEntity(): void
    {
        PasswordHashingDoctrineEventSubscriber::setEnabled(false);

        $entity = new User();
        $entity->setEmail('test-user@example.com');
        $entity->setPassword('test');

        $this->entityManager->persist($entity);
        $this->flush();

        $this->assertEquals('test', $entity->getPassword());
        $this->assertFalse(str_starts_with($entity->getPassword(), '$2y$13'));

        PasswordHashingDoctrineEventSubscriber::setEnabled(true);
    }

    #[Override]
    protected function getEntityClass(): string
    {
        return User::class;
    }
}
