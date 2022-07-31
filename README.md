# EightMarq - User bundle

[WIP] User bundle 

## Requirements

> Important! PHP 8.1 is required for this bundle, because in this bundle we use typed properties feature!

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

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="users")
 */
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

## Configuration reference

No configuration