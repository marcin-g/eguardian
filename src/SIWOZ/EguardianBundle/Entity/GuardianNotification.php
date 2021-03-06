<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notification
 *
 * @author Marcin
 */
namespace SIWOZ\EguardianBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="SIWOZ\EguardianBundle\Repository\GuardianNotificationRepository")
 * @ORM\Table(name="guardian_notification")
 */
class GuardianNotification {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Type("integer")
     * @Groups({"Default", "All"})
    */
    protected $id;

    /**
     * @ORM\Column(type="string", length=512)
     * @Type("string")
     * @Groups({"Default", "All"})
     */
    protected $registrationId;

    /**
     * @ORM\ManyToOne(targetEntity="SeniorNotification")
     * @ORM\JoinColumn(name="senior_notifaction_id", referencedColumnName="id")
     * @Type("SIWOZ\EguardianBundle\Entity\SeniorNotification")
     * @Groups({"Default", "All"})
     */
    protected $seniorNotification;
    

    /**
     * @ORM\Column(type="smallint")
     * @Type("integer")
     * @Groups({"Default", "All"})
     */
    protected $state;
    
    /**
     * @ORM\Column(type="smallint")
     * @Type("integer")
     * @Groups({"Default", "All"})
     */
    protected $try;
    
    
    /**
     * @ORM\Column(name="send_date", type="datetime")
     * @Type("DateTime")
     * @Groups({"Default", "All"})
     */
    protected $sendDate;
  
    public function __construct() {
        $this->try=0;
    }

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
     * Set state
     *
     * @param integer $state
     * @return SeniorNotification
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return integer 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set sendDate
     *
     * @param \DateTime $sendDate
     * @return SeniorNotification
     */
    public function setSendDate($sendDate)
    {
        $this->sendDate = $sendDate;

        return $this;
    }

    /**
     * Get sendDate
     *
     * @return \DateTime 
     */
    public function getSendDate()
    {
        return $this->sendDate;
    }

    /**
     * Set seniorNotification
     *
     * @param \SIWOZ\EguardianBundle\Entity\SeniorNotification $seniorNotification
     * @return SeniorNotification
     */
    public function setSeniorNotification(\SIWOZ\EguardianBundle\Entity\SeniorNotification $seniorNotification = null)
    {
        $this->seniorNotification = $seniorNotification;

        return $this;
    }

    /**
     * Get seniorNotification
     *
     * @return \SIWOZ\EguardianBundle\Entity\SeniorNotification 
     */
    public function getSeniorNotification()
    {
        return $this->seniorNotification;
    }

    /**
     * Set registrationId
     *
     * @param string $registrationId
     * @return SeniorNotification
     */
    public function setRegistrationId($registrationId)
    {
        $this->registrationId = $registrationId;

        return $this;
    }

    /**
     * Get registrationId
     *
     * @return string 
     */
    public function getRegistrationId()
    {
        return $this->registrationId;
    }

    /**
     * Set try
     *
     * @param integer $try
     * @return SeniorNotification
     */
    public function setTry($try)
    {
        $this->try = $try;

        return $this;
    }

    /**
     * Get try
     *
     * @return integer 
     */
    public function getTry()
    {
        return $this->try;
    }
}
