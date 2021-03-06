<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIWOZ\EguardianBundle\Repository;

use Doctrine\ORM\EntityRepository;
use SIWOZ\EguardianBundle\Entity\SeniorNotification;

/**
 * Description of GuardianNotificationRepository
 *
 * @author Marcin
 */
class GuardianNotificationRepository extends EntityRepository {

    public function addNotification($notification) {
        $em = $this->getEntityManager();
        $em->persist($notification);
        $em->flush();
    }

    public function getNotificationToSend() {
        $query = $this->getEntityManager()
                ->createQuery(
                'SELECT n FROM SIWOZ\EguardianBundle\Entity\GuardianNotification n
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

    public function updateFailNotification(GuardianNotification $notification) {
        $em = $this->getEntityManager();
        if ($notification->getTry() == 5) {
            $notification->setState(2);
        } else {
            $notification->setTry($notification->getTry() + 1);
        }
        $em->merge($notification);
        $em->flush();
    }

}
