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
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="SIWOZ\EguardianBundle\Repository\EventRepository")
 * 
 */
class VisitEvent extends Event {

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Visit",cascade={"persist","remove"})
     * @ORM\JoinColumn(name="visit_id", referencedColumnName="id")
     * @Type("SIWOZ\EguardianBundle\Entity\Visit")
     * @Groups({"Default", "All"})
     */
    protected $visit;

    /**
     * @var integer
     * @Type("integer")
     * @Groups({"Default", "All"})
     */
    protected $id;

    /**
     * @var \DateTime
     * @Type("DateTime")
     * @Groups({"Default", "All"})
     */
    protected $startDate;

    /**
     * @var integer
     * @Type("integer")
     * @Groups({"Default", "All"})
     */
    protected $interval;

    /**
     * @var \SIWOZ\EguardianBundle\Entity\SeniorUser
     * @Type("SIWOZ\EguardianBundle\Entity\SeniorUser")
     * @Groups({"Default", "All"})
     */
    protected $senior;

    /**
     * @var \SIWOZ\EguardianBundle\Entity\GuardianUser
     * @Type("SIWOZ\EguardianBundle\Entity\GuardianUser")
     * @Groups({"Default", "All"})
     */
    protected $guardian;


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
     * @return VisitEvent
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
     * @param integer $interval
     * @return VisitEvent
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;

        return $this;
    }

    /**
     * Get interval
     *
     * @return integer 
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * Set visit
     *
     * @param \SIWOZ\EguardianBundle\Entity\Visit $visit
     * @return VisitEvent
     */
    public function setVisit(\SIWOZ\EguardianBundle\Entity\Visit $visit = null)
    {
        $this->visit = $visit;

        return $this;
    }

    /**
     * Get visit
     *
     * @return \SIWOZ\EguardianBundle\Entity\Visit 
     */
    public function getVisit()
    {
        return $this->visit;
    }

    /**
     * Set senior
     *
     * @param \SIWOZ\EguardianBundle\Entity\SeniorUser $senior
     * @return VisitEvent
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
     * @return VisitEvent
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
    /**
     * @var \DateTime
     * @Type("DateTime")
     * @Groups({"Default", "All"})
     */
    protected $endDate;


    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return VisitEvent
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
