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
class MedicineEvent extends Event {

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Medicine",cascade={"persist","remove"})
     * @ORM\JoinColumn(name="medicine_id", referencedColumnName="id")
     * @Type("SIWOZ\EguardianBundle\Entity\Medicine")
     * @Groups({"Default", "All","Notification"})
     * 
     */
    protected $medicine;

    /**
     * @var integer
     * @Type("int")
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
     * @return MedicineEvent
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
     * @return MedicineEvent
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
     * Set medicine
     *
     * @param \SIWOZ\EguardianBundle\Entity\Medicine $medicine
     * @return MedicineEvent
     */
    public function setMedicine(\SIWOZ\EguardianBundle\Entity\Medicine $medicine = null)
    {
        $this->medicine = $medicine;

        return $this;
    }

    /**
     * Get medicine
     *
     * @return \SIWOZ\EguardianBundle\Entity\Medicine 
     */
    public function getMedicine()
    {
        return $this->medicine;
    }

    /**
     * Set senior
     *
     * @param \SIWOZ\EguardianBundle\Entity\SeniorUser $senior
     * @return MedicineEvent
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
     * @return MedicineEvent
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
     * @return MedicineEvent
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
