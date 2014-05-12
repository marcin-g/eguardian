<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIWOZ\EguardianBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="SIWOZ\EguardianBundle\Repository\UserRepository")
 * @ORM\Table(name="senior_user")
 * 
 */
class SeniorUser extends User {

    /**
     * @ORM\ManyToMany(targetEntity="GuardianUser", inversedBy="seniors")
     * @ORM\JoinColumn(name="guardian_user_id", referencedColumnName="id")
     * @Type("ArrayCollection<SIWOZ\EguardianBundle\Entity\GuardianUser>")
     * @MaxDepth(2)
     * @Groups({"All"})
     */
    protected $guardians;

    public function __construct() {
        $this->guardians = new ArrayCollection();
    }

    /**
     * @var integer
     * @Type("integer")
     * @Groups({"Default", "All"})
     */
    protected $id;

    /**
     * @var string
     * @Type("string")
     * @Groups({"Default", "All"})
     */
    protected $username;

    /**
     * @var string
     * @Type("string")
     * @Groups({"None"})
     */
    protected $password;

    /**
     * @var \SIWOZ\EguardianBundle\Entity\Place
     * @Type("SIWOZ\EguardianBundle\Entity\Place")
     * @Groups({"All"})
     */
    protected $place;

    /**
     * Add guardians
     *
     * @param \SIWOZ\EguardianBundle\Entity\GuardianUser $guardians
     * @return SeniorUser
     */
    public function addGuardian(\SIWOZ\EguardianBundle\Entity\GuardianUser $guardians) {
        $this->guardians[] = $guardians;

        return $this;
    }

    /**
     * Remove guardians
     *
     * @param \SIWOZ\EguardianBundle\Entity\GuardianUser $guardians
     */
    public function removeGuardian(\SIWOZ\EguardianBundle\Entity\GuardianUser $guardians) {
        $this->guardians->removeElement($guardians);
    }

    /**
     * Get guardians
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGuardians() {
        return $this->guardians;
    }

    /**
     * @var string
     * @Type("string")
     * @Groups({"None"})
     */
    protected $registeredId;

    /**
     * Set registeredId
     *
     * @param string $registeredId
     * @return SeniorUser
     */
    public function setRegisteredId($registeredId) {
        $this->registeredId = $registeredId;

        return $this;
    }

    /**
     * Get registeredId
     *
     * @return string 
     */
    public function getRegisteredId() {
        return $this->registeredId;
    }

    public function getRoles() {
        return array('ROLE_USER');
    }

}
