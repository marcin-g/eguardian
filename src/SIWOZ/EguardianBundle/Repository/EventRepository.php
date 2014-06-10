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
use SIWOZ\EguardianBundle\Entity\Meal;
use SIWOZ\EguardianBundle\Entity\Visit;
use SIWOZ\EguardianBundle\Entity\Test;
use SIWOZ\EguardianBundle\Entity\Medicine;

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
    public function getMeal($id) {
        $query = $this->getEntityManager()
                        ->createQuery(
                                'SELECT e FROM SIWOZ\EguardianBundle\Entity\Meal e
                                WHERE e.id = :id'
                        )->setParameter('id', $id);
        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
    public function getMedicine($id) {
        $query = $this->getEntityManager()
                        ->createQuery(
                                'SELECT e FROM SIWOZ\EguardianBundle\Entity\Medicine e
                                WHERE e.id = :id'
                        )->setParameter('id', $id);
        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
    public function getVisit($id) {
        $query = $this->getEntityManager()
                        ->createQuery(
                                'SELECT e FROM SIWOZ\EguardianBundle\Entity\Visit e
                                WHERE e.id = :id'
                        )->setParameter('id', $id);
        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
    public function getTest($id) {
        $query = $this->getEntityManager()
                        ->createQuery(
                                'SELECT e FROM SIWOZ\EguardianBundle\Entity\Test e
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
        $senior = $query->getSingleResult();
        $query = $this->getEntityManager()
                        ->createQuery(
                                'SELECT u FROM SIWOZ\EguardianBundle\Entity\User u
                                WHERE u.id = :id'
                        )->setParameter('id', $event->getGuardian()->getId());
        $guardian = $query->getSingleResult();
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

    public function updateEvent(Event $event) {
        $em = $this->getEntityManager();
        $oldEvent = $this->getEvent($event->getId());
        if ($event->getStartDate() != null) {
            $oldEvent->setStartDate($event->getStartDate());
        }
        if ($event->getEndDate() != null) {
            $oldEvent->setEndDate($event->getStartDate());
        }
        if ($event->getGuardian() != null) {
            $oldEvent->setGuardian($event->getStartDate());
        }
        if ($event->getSenior() != null) {
            $oldEvent->setSenior($event->getStartDate());
        }
        if ($event->getInterval() != null) {
            $oldEvent->setInterval($event->getStartDate());
        }
        switch (get_class($event)) {
            case 'SIWOZ\EguardianBundle\Entity\MealEvent':
                $this->updateMeal($event->getMeal(), $em);
                break;
            case 'SIWOZ\EguardianBundle\Entity\TestEvent':
                $this->updateTest($event->getTest(), $em);
                break;
            case 'SIWOZ\EguardianBundle\Entity\VisitEvent':
                $this->updateVisit($event->getVisit(), $em);
                break;
            case 'SIWOZ\EguardianBundle\Entity\MedicineEvent':
                $this->updateMedicine($event->getMedicine(), $em);
                break;

            default:
                break;
        }
        $em->merge($oldEvent);
        $em->flush();
        return $oldEvent;
    }
    
    private function updateMeal(Meal $meal, $em){
        $oldMeal=  $this->getMeal($meal->getId());
        if($meal->getDescription()!=NULL){
            $oldMeal->setDescription($meal->getDescription());
        }
        if($meal->getName()!=NULL){
            $oldMeal->setName($meal->getName());
        }
        $em->merge($oldMeal);
   
    }

    private function updateMedicine(Medicine $medicine, $em){
        $oldMedicine=$this->getMedicine($medicine->getId());
        if($medicine->getDose()!=NULL){
            $oldMedicine->setDose($medicine->getDose());
        }
        if($medicine->getName()!=NULL){
            $oldMedicine->setName($medicine->getName());
        }
        if($medicine->getMedicineCategory()!=NULL){
            $oldMedicine->setMedicineCategory($medicine->getMedicineCategory());
        }
        $em->merge($oldMedicine);
    }
    private function updateTest(Test $test, $em){
        $oldTest=  $this->getTest($test->getId());
        if($test->getName()!=NULL){
            $oldTest->setName($test->getName());
        }
        if($test->getTestCategory()!=NULL){
            $oldTest->setTestCategory($test->getTestCategory());
        }
        $em->merge($oldTest);
    }
    private function updateVisit(Visit $visit, $em){
        $oldVisit= $this->getVisit($visit->getId());
        if($visit->getDoctorName()!=null){
            $oldVisit->setDoctorName($visit->getDoctorName());
        }
        if($visit->getPlace()!=null){
            $oldVisit->setPlace($visit->getPlace());
        }
        if($visit->getName()!=null){
            $oldVisit->setName($visit->getName());
        }
        $em->merge($oldVisit);
    }
    public function deleteEvent($event) {
        $em = $this->getEntityManager();
        $em->remove($event);
        $em->flush();
    }

}
