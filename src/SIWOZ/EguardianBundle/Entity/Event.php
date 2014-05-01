<?php

namespace SIWOZ\EguardianBundle\Entity;

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
 * @ORM\DiscriminatorColumn(name="discr", type="smallint")
 * @ORM\DiscriminatorMap({"0" = "MealEvent", "1" = "VisitEvent","2" = "MedicineEvent","3" = "TestEvent"})
 */
class Event {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="SeniorUser")
     * @ORM\JoinColumn(name="senior_user_id", referencedColumnName="id")
     */
    protected $senior;
    
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="GuardianUser")
     * @ORM\JoinColumn(name="guardian_user_id", referencedColumnName="id")
     */
    protected $guardian;
    
    
    /**
     * @ORM\Column(name="start_date", type="date")
     */
    protected $startDate;
    
    /**
     * @ORM\Column(name="interval", type="date")
     */
    protected $interval;    
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Event
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set interval
     *
     * @param \DateTime $interval
     * @return Event
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;

        return $this;
    }

    /**
     * Get interval
     *
     * @return \DateTime 
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * Set senior
     *
     * @param \SIWOZ\EguardianBundle\Entity\SeniorUser $senior
     * @return Event
     */
    public function setSenior(\SIWOZ\EguardianBundle\Entity\SeniorUser $senior = null)
    {
        $this->senior = $senior;

        return $this;
    }

    /**
     * Get senior
     *
     * @return \SIWOZ\EguardianBundle\Entity\SeniorUser 
     */
    public function getSenior()
    {
        return $this->senior;
    }

    /**
     * Set guardian
     *
     * @param \SIWOZ\EguardianBundle\Entity\GuardianUser $guardian
     * @return Event
     */
    public function setGuardian(\SIWOZ\EguardianBundle\Entity\GuardianUser $guardian = null)
    {
        $this->guardian = $guardian;

        return $this;
    }

    /**
     * Get guardian
     *
     * @return \SIWOZ\EguardianBundle\Entity\GuardianUser 
     */
    public function getGuardian()
    {
        return $this->guardian;
    }
}
