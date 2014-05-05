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


/**
 * Description of VisitRepository
 *
 * @author Marcin
 */
class UserRepository extends EntityRepository {

    public function getUserByLogin($login) {
        $query = $this->getEntityManager()
                        ->createQuery(
                                'SELECT u FROM SIWOZ\EguardianBundle\Entity\User u
                                WHERE u.login = :login'
                        )->setParameter('login', $login);
        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
     public function addUser($user){
        $em = $this->getEntityManager();
        $em->persist($user);
        $em->flush();
    }
    public function updateUser($user){
        $em = $this->getEntityManager();
        $em->merge($user);
        $em->flush();
    }
    
    public function addGuardianToSenior($guardianLogin, $seniorLogin){
        $em = $this->getEntityManager();
        $senior=$this->getUserByLogin($seniorLogin);
        $guardian=$this->getUserByLogin($guardianLogin);
        $senior->addGuardian($guardian);
        $guardian->addSenior($senior);
        $em->flush();
        return $guardian;
    }
    public function removeGuardianToSenior($guardianLogin, $seniorLogin){
        $em = $this->getEntityManager();
        $senior=$this->getUserByLogin($seniorLogin);
        $guardian=$this->getUserByLogin($guardianLogin);
        $senior->removeGuardian($guardian);
        $guardian->removeSenior($senior);
        $em->flush();
        return $guardian;
    }
    //put your code here
}
