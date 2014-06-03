<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIWOZ\EguardianBundle\Repository;

use Doctrine\ORM\EntityRepository;
use SIWOZ\EguardianBundle\Entity\SeniorNotification;
use SIWOZ\EguardianBundle\Entity\GuardianNotificationNotification;

/**
 * Description of SeniorNotificationRepository
 *
 * @author Marcin
 */
class SeniorNotificationRepository extends EntityRepository {

    public function addNotification($notification) {
        $em = $this->getEntityManager();
        $em->persist($notification);
        $em->flush();
    }

    public function getNotificationToSend() {
        $query = $this->getEntityManager()
                ->createQuery(
                'SELECT n FROM SIWOZ\EguardianBundle\Entity\SeniorNotification n
                                WHERE n.state=0 and n.sendDate < CURRENT_DATE()'
        );
        try {
            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function updateNotification($notification) {
        $em = $this->getEntityManager();
        $em->merge($notification);
        $em->flush();
    }

    public function updateSuccesNotification($notification) {
        $em = $this->getEntityManager();
        $notification->setState(1);
        $newDate = $notification->getSendDate()->add(new \DateInterval('PT' . $notification->getEvent()->getInterval() . 'M'));
        if ($newDate < $notification->getEvent()->getEndDate()) {
            $newNotification = new SeniorNotification();
            $newNotification->setEvent($notification->getEvent());
            $newNotification->setRegistrationId($notification->getRegistrationId());
            $newNotification->setState(0);
            $newNotification->setSendDate($newDate);
            $em->persist($newNotification);
        }
        $em->merge($notification);
        $em->flush();
    }

    public function updateFailNotification(SeniorNotification $notification) {
        $em = $this->getEntityManager();
        if ($notification->getTry() == 5) {
            $notification->setState(2);
            $newNotification = new GuardianNotificationNotification();
            $newNotification->setSeniorNotification($notification->getEvent());
            $newNotification->setRegistrationId($notification->getEvent()->getGuardian()->getRegistrationId());
            $newNotification->setState(0);
            $newNotification->setSendDate(new \DateTime());
            $em->persist($newNotification);
        } else {
            $notification->setTry($notification->getTry() + 1);
        }
        $em->merge($notification);
        $em->flush();
    }

    public function getNotificationById($id) {
        $query = $this->getEntityManager()
                        ->createQuery(
                                'SELECT e FROM SIWOZ\EguardianBundle\Entity\Event e
                                WHERE e.id=:id'
                        )->setParameter('id', $id);
        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            
        }
    }

}
