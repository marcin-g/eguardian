<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIWOZ\EguardianBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Description of VisitRepository
 *
 * @author Marcin
 */
class UserRepository extends EntityRepository {

    public function getUserByLogin($login) {
        $query = $this->getEntityManager()
                        ->createQuery(
                                'SELECT u FROM SIWOZ:EguardianBundle:Entity:User u
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
    //put your code here
}
