<?php

namespace SIWOZ\EguardianBundle\Entity;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Discriminator;
use JMS\Serializer\Annotation\Groups;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of Event
 *
 * @author Marcin
 */
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="SIWOZ\EguardianBundle\Repository\EventRepository")
 * @ORM\Table(name="event")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"meal" = "MealEvent", "visit" = "VisitEvent","medicine" = "MedicineEvent","test" = "TestEvent"})
 * @Discriminator(field = "discr", map = {"meal":"SIWOZ\EguardianBundle\Entity\MealEvent", "visit":"SIWOZ\EguardianBundle\Entity\VisitEvent","medicine":"SIWOZ\EguardianBundle\Entity\MedicineEvent","test":"SIWOZ\EguardianBundle\Entity\TestEvent"})
 */
class Event {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Type("integer")
     * @Groups({"All"})
     */
    protected $id;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="SeniorUser")
     * @ORM\JoinColumn(name="senior_user_id", referencedColumnName="id")
     * @Type("SIWOZ\EguardianBundle\Entity\SeniorUser")
     * @Groups({"Default", "All"})
     */
    protected $senior;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="GuardianUser")
     * @ORM\JoinColumn(name="guardian_user_id", referencedColumnName="id")
     * @Type("SIWOZ\EguardianBundle\Entity\GuardianUser")
     * @Groups({"Default", "All"})
     */
    protected $guardian;

    /**
     * @ORM\Column(name="start_date", type="datetime")
     * @Type("DateTime")
     * @Groups({"Default", "All","Notification"})
     */
    protected $startDate;
      /**
     * @ORM\Column(name="end_date", type="datetime")
     * @Type("DateTime")
     * @Groups({"Default", "All","Notification"})
     */
    protected $endDate;

    /**
     * @ORM\Column(name="event_interval", type="integer")
     * @Type("integer")
     * @Groups({"Default", "All","Notification"})
     */
    protected $interval;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Event
     */
    public function setStartDate($startDate) {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate() {
        return $this->startDate;
    }

    /**
     * Set interval
     *
     * @param integer $interval
     * @return Event
     */
    public function setInterval($interval) {
        $this->interval = $interval;

        return $this;
    }

    /**
     * Get interval
     *
     * @return integer
     */
    public function getInterval() {
        return $this->interval;
    }

    /**
     * Set senior
     *
     * @param \SIWOZ\EguardianBundle\Entity\SeniorUser $senior
     * @return Event
     */
    public function setSenior(\SIWOZ\EguardianBundle\Entity\SeniorUser $senior) {
        $this->senior = $senior;

        return $this;
    }

    /**
     * Get senior
     *
     * @return \SIWOZ\EguardianBundle\Entity\SeniorUser 
     */
    public function getSenior() {
        return $this->senior;
    }

    /**
     * Set guardian
     *
     * @param \SIWOZ\EguardianBundle\Entity\GuardianUser $guardian
     * @return Event
     */
    public function setGuardian(\SIWOZ\EguardianBundle\Entity\GuardianUser $guardian) {
        $this->guardian = $guardian;

        return $this;
    }

    /**
     * Get guardian
     *
     * @return \SIWOZ\EguardianBundle\Entity\GuardianUser 
     */
    public function getGuardian() {
        return $this->guardian;
    }


    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Event
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }
}
