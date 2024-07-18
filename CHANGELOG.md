# Changelog

## 1.0.1

* Add missing return type to UserExtension.php
* Improve AbstractTestCase

## 1.0.0

* Move repository from eightmarq/user-bundle to schvoy/user-bundle
* Bump composer packages, increase minimum versions (php to 8.3, Symfony to 7.1)
* Replace eightmarq/core-bundle with schvoy/base-entity-bundle
* Update code because of package bumps
* Add test environment for PhpUnit tests
* Add PhpUnit tests
* Add `before-commit`, `code-quality` and `tests` composer scripts
* Update README.md
* Extend `Schvoy\UserBundle\EventSubscriber\PasswordHashingDoctrineEventSubscriber` to hash passwords during update

## 0.9.0

* Change composer.json requirements
* Add new `Schvoy\UserBundle\EventSubscriber\PasswordHashingDoctrineEventSubscriber`
* Remove unnecessary type cast from User entity

## 0.8.3

* Change composer.json requirements

## 0.8.2

* Fix PasswordUpdater
* Update README.md

## 0.8.1

* Fix UserRepository::upgradePassword 
* Add PasswordAuthenticatedUserInterface to User entity

## 0.8.0

* Update required php version to 8.1
* Update required symfony version to 6.1

## 0.7.0

### Change

* Replace annotations to PHP8 attributes
* Remove unnecessary doc blocks

## 0.6.1

### Change 

* Update to PHP8 

## 0.6.0

### Change

* Modify `Schvoy\UserBundle\Entity\User` entity to a MappedSuperclass
* Modify `Schvoy\UserBundle\Repository\UserRepository` to be more general
* Remove `Schvoy\UserBundle\Entity\User` entity from Doctrine interface definition

## 0.5.0

### Added

* Added `Schvoy\UserBundle\Entity\User` entity
* Added `Schvoy\UserBundle\Repository\UserRepository` repository
* Added `Schvoy\UserBundle\Security\PasswordUpdater`