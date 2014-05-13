<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIWOZ\EguardianBundle\Repository;

use Doctrine\ORM\EntityRepository;
use SIWOZ\EguardianBundle\Entity\Event;
use SIWOZ\EguardianBundle\Entity\SeniorNotification;

/**
 * Description of VisitRepository
 *
 * @author Marcin
 */
class EventRepository extends EntityRepository {

    public function getEvent($id) {
        $query = $this->getEntityManager()
                        ->createQuery(
                                'SELECT e FROM SIWOZ\EguardianBundle\Entity\Event e
                                WHERE e.id = :id'
                        )->setParameter('id', $id);
        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function getEvents($user, $className) {
        $qb = $this->getEntityManager()->createQueryBuilder();
        if (in_array('ROLE_ADMIN', $user->getRoles())) {
            $qb->select('e')
                    ->from($className, 'e')
                    ->where('e.guardian= :user')
                    ->setParameter('user', $user);
        } else {

            $qb->select('e')
                    ->from($className, 'e')
                    ->where('e.senior= :user')
                    ->setParameter('user', $user);
        }
        try {
            $q = $qb->getQuery();
            return $q->execute();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function addEvent(Event $event) {
        $em = $this->getEntityManager();
        $query = $this->getEntityManager()
                        ->createQuery(
                                'SELECT u FROM SIWOZ\EguardianBundle\Entity\User u
                                WHERE u.id = :id'
                        )->setParameter('id', $event->getSenior()->getId());
        $senior=$query->getSingleResult();
        $query = $this->getEntityManager()
                        ->createQuery(
                                'SELECT u FROM SIWOZ\EguardianBundle\Entity\User u
                                WHERE u.id = :id'
                        )->setParameter('id', $event->getGuardian()->getId());
        $guardian=$query->getSingleResult();
        $event->setGuardian($guardian);
        $event->setSenior($senior);
        $em->persist($event);
        $newNotification = new SeniorNotification();
        $newNotification->setEvent($event);
        $newNotification->setRegistrationId($event->getSenior()->getRegistrationId());
        $newNotification->setState(0);
        $newNotification->setSendDate($event->getStartDate());
        $em->persist($newNotification);
        $em->flush();
    }

    public function updateEvent($event) {
        $em = $this->getEntityManager();
        $em->merge($event);
        $em->flush();
    }

    public function deleteEvent($event) {
        $em = $this->getEntityManager();
        $em->remove($event);
        $em->flush();
    }

}
