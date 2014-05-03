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

/**
 * @ORM\Entity(repositoryClass="SIWOZ\EguardianBundle\Repository\EventRepository")
 * 
 */
class MedicineEvent extends Event {

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Medicine")
     * @ORM\JoinColumn(name="medicine_id", referencedColumnName="id")
     * @Type("SIWOZ\EguardianBundle\Entity\Medicine")
     * 
     */
    protected $medicine;

    /**
     * @var integer
     * @Type("int")
     */
    protected $id;

    /**
     * @var \DateTime
     * @Type("date")
     */
    protected $startDate;

    /**
     * @var \DateTime
     * @Type("date")
     */
    protected $interval;

    /**
     * @var \SIWOZ\EguardianBundle\Entity\SeniorUser
     * @Type("SIWOZ\EguardianBundle\Entity\SeniorUser")
     */
    protected $senior;

    /**
     * @var \SIWOZ\EguardianBundle\Entity\GuardianUser
     * @Type("SIWOZ\EguardianBundle\Entity\GuardianUser")
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
     * @param \DateTime $interval
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
     * @return \DateTime 
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
}
