<?php

declare(strict_types=1);

namespace Schvoy\UserBundle\Tests\Fixtures\Entity;

use Doctrine\ORM\Mapping as ORM;
use Schvoy\UserBundle\Entity\User as BaseUser;

#[ORM\Entity]
#[ORM\Table]
class User extends BaseUser
{
}
