<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIWOZ\EguardianBundle\Repository;

use Doctrine\ORM\EntityRepository;
use SIWOZ\EguardianBundle\Entity\Alarm;

/**
 * Description of AlarmNotificationRepository
 *
 * @author Marcin
 */
class AlarmRepository extends EntityRepository {

    public function addAlarm($alarm) {
        $em = $this->getEntityManager();
        $em->persist($alarm);
        $em->flush();
    }

    public function getAlarmToSend() {
        $query = $this->getEntityManager()
                ->createQuery(
                'SELECT n FROM SIWOZ\EguardianBundle\Entity\Alarm n
                                WHERE n.state=0'
        );
        try {
            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }

    public function updateNotification($alarm) {
        $em = $this->getEntityManager();
        $em->merge($alarm);
        $em->flush();
    }

    public function updateSuccesNotification($alarm) {
        $em = $this->getEntityManager();
        $alarm->setState(1);
        $em->merge($alarm);
        $em->flush();
    }

    public function updateFailNotification(Alarm $alarm) {
        $em = $this->getEntityManager();
        if ($alarm->getTry() == 5) {
            $alarm->setState(2);
        } else {
            $alarm->setTry($alarm->getTry() + 1);
        }
        $em->merge($alarm);
        $em->flush();
    }

}
