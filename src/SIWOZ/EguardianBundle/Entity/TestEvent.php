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
class TestEvent extends Event {

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Test",cascade={"persist","remove"})
     * @ORM\JoinColumn(name="test_id", referencedColumnName="id")
     * @Type("SIWOZ\EguardianBundle\Entity\Test")
     * @Groups({"Default", "All","Notification"})
     */
    protected $test;

    /**
     * @var integer
     * @Type("integer")
     * @Groups({"Default", "All"})
     */
    protected $id;

    /**
     * @var \DateTime
     * @Type("DateTime")
     * @Groups({"Default", "All","Notification"})
     */
    protected $startDate;

    /**
     * @var integer
     * @Type("integer")
     * @Groups({"Default", "All","Notification"})
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
     * @return TestEvent
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
     * @return TestEvent
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
     * Set test
     *
     * @param \SIWOZ\EguardianBundle\Entity\Test $test
     * @return TestEvent
     */
    public function setTest(\SIWOZ\EguardianBundle\Entity\Test $test = null)
    {
        $this->test = $test;

        return $this;
    }

    /**
     * Get test
     *
     * @return \SIWOZ\EguardianBundle\Entity\Test 
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * Set senior
     *
     * @param \SIWOZ\EguardianBundle\Entity\SeniorUser $senior
     * @return TestEvent
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
     * @return TestEvent
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
     * @Groups({"Default", "All","Notification"})
     */
    protected $endDate;

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return TestEvent
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
