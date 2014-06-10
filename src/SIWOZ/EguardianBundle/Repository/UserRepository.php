<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIWOZ\EguardianBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Entity\GuardianUser;
use Doctrine\ORM\Entity\SeniorUser;
use Doctrine\ORM\Entity\User;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Description of VisitRepository
 *
 * @author Marcin
 */
class UserRepository extends EntityRepository implements UserProviderInterface {
    /* function __construct($em, Mapping\ClassMetadata $class)
      {
      parent::__construct($em, $class);
      $this->CI =& get_instance(); // looks strange
      } */

    public function loadUserByUsername($username) {
        // make a call to your webservice here
        $em = $this->getEntityManager();
        $userData = $this->getUserByUsername($username);
        // pretend it returns an array on success, false if there is no user

        return $userData;
    }

    public function refreshUser(UserInterface $user) {
        if (!$user instanceof WebserviceUser) {
            throw new UnsupportedUserException(
            sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class) {
        return $class === 'SIWOZ\EguardianBundle\Entity\User';
    }

    public function getUserByUsername($username) {
        $query = $this->getEntityManager()
                        ->createQuery(
                                'SELECT u FROM SIWOZ\EguardianBundle\Entity\User u
                                WHERE u.username = :username'
                        )->setParameter('username', $username);
        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function addUser($user) {
        $em = $this->getEntityManager();
        $em->persist($user);
        $em->flush();
    }

    public function updateUser($user) {
        $em = $this->getEntityManager();
        $originalUser = $this->getUserByUsername($user->getUsername());
        $originalPlace = $originalUser->getPlace();
        $modifiedPlace = $user->getPlace();
        if ($modifiedPlace->getStreet() != null) {
            $originalPlace->setStreet($modifiedPlace->getStreet());
        }
        if ($modifiedPlace->getStreetNo() != null) {
            $originalPlace->setStreetNo($modifiedPlace->getStreetNo());
        }
        if ($modifiedPlace->getApartmentNo() != null) {
            $originalPlace->setApartmentNo($modifiedPlace->getApartmentNo());
        }

        if ($modifiedPlace->getCity() != null) {
            $originalPlace->setCity($modifiedPlace->getCity());
        }

        if ($modifiedPlace->getPostCode() != null) {
            $originalPlace->setPostCode($modifiedPlace->getPostCode());
        }

        if ($modifiedPlace->getTelephoneNumber() != null) {
            $originalPlace->setTelephoneNumber($modifiedPlace->getTelephoneNumber());
        }
        $em->merge($originalPlace);
        $em->merge($originalUser);
        $em->flush();
        return $originalUser;
    }

    public function updateRegistrationId($user, $id) {
        $em = $this->getEntityManager();
        $user->setRegistrationId($id);
        $em->flush();
    }

    public function addGuardianToSenior($guardianLogin, $seniorLogin) {
        $em = $this->getEntityManager();
        $senior = $this->getUserByUsername($seniorLogin);
        $guardian = $this->getUserByUsername($guardianLogin);
        $senior->addGuardian($guardian);
        $guardian->addSenior($senior);
        $em->flush();
        return $guardian;
    }

    public function removeGuardianToSenior($guardianLogin, $seniorLogin) {
        $em = $this->getEntityManager();
        $senior = $this->getUserByUsername($seniorLogin);
        $guardian = $this->getUserByUsername($guardianLogin);
        $senior->removeGuardian($guardian);
        $guardian->removeSenior($senior);
        $em->flush();
        return $guardian;
    }

    //put your code here
}
