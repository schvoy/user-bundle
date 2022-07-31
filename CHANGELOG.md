# Changelog

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

* Modify `EightMarq\UserBundle\Entity\User` entity to a MappedSuperclass
* Modify `EightMarq\UserBundle\Repository\UserRepository` to be more general
* Remove `EightMarq\UserBundle\Entity\User` entity from Doctrine interface definition

## 0.5.0

### Added

* Added `EightMarq\UserBundle\Entity\User` entity
* Added `EightMarq\UserBundle\Repository\UserRepository` repository
* Added `EightMarq\UserBundle\Security\PasswordUpdater`