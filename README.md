# EightMarq - User bundle

This bundle provides a basic user entity and user repository,
that can be used immediately without so much effort, just a few small steps needed to use it.
However, these are extendable and you can add additional properties easily.

## Installation

```bash
composer require eightmarq/user-bundle
```

## Usage

### Make your own `UserRepository`

```php
<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use EightMarq\UserBundle\Repository\UserRepository as BaseUserRepository;

class UserRepository extends BaseUserRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
}
```

### Make your own `User` entity

```php
<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use EightMarq\UserBundle\Entity\User as BaseUser;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'users')]
class User extends BaseUser
{
   
}
```

### security.yaml

```yaml
security:
    password_hashers:
        App\Entity\User:
            algorithm: argon2i

    providers:
        app_user_provider:
            entity:
                class: App\Entity\User
                property: email
    [...]
```

## Event subscriber

The `EightMarq\UserBundle\EventSubscriber\PasswordHashingDoctrineEventSubscriber` automatically hashes the plain password, when during a new user entity creation.

In some cases, you don't need this behavior, so you can disable it with the following code:

```php
    PasswordHashingDoctrineEventSubscriber::setEnabled(false);
```

And after that you can re-enable it: 

```php
    PasswordHashingDoctrineEventSubscriber::setEnabled(true);
```

## Configuration reference

No configuration