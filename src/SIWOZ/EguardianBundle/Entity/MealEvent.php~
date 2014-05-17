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
class MealEvent extends Event {

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Meal",cascade={"persist","remove"})
     * @ORM\JoinColumn(name="meal_id", referencedColumnName="id")
     * @Type("SIWOZ\EguardianBundle\Entity\Meal")
     * @Groups({"Default", "All"})
     */
    protected $meal;

    /**
     * @var integer
     * @Type("integer")
     * @Groups({"Default", "All"})
     * 
     */
    protected $id;

    /**
     * @var \DateTime
     * @Type("DateTime")
     * @Groups({"Default", "All"})
     */
    protected $startDate;

    /**
     * @var \integer
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
     * @return MealEvent
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
     * @return MealEvent
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
     * Set meal
     *
     * @param \SIWOZ\EguardianBundle\Entity\Meal $meal
     * @return MealEvent
     */
    public function setMeal(\SIWOZ\EguardianBundle\Entity\Meal $meal = null)
    {
        $this->meal = $meal;

        return $this;
    }

    /**
     * Get meal
     *
     * @return \SIWOZ\EguardianBundle\Entity\Meal 
     */
    public function getMeal()
    {
        return $this->meal;
    }

    /**
     * Set senior
     *
     * @param \SIWOZ\EguardianBundle\Entity\SeniorUser $senior
     * @return MealEvent
     */
    public function setSenior(\SIWOZ\EguardianBundle\Entity\SeniorUser $senior)
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
     * @return MealEvent
     */
    public function setGuardian(\SIWOZ\EguardianBundle\Entity\GuardianUser $guardian)
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
     * @return MealEvent
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
