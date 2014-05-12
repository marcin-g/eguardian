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

/**
 * @ORM\Entity(repositoryClass="SIWOZ\EguardianBundle\Repository\UserRepository")
 * @ORM\Table(name="guardian_user")
 */
class GuardianUser extends User {

    /**
     * @ORM\ManyToMany(targetEntity="SeniorUser", inversedBy="guardians")
     * @ORM\JoinColumn(name="senior_user_id", referencedColumnName="id")
     * @Type("ArrayCollection<SIWOZ\EguardianBundle\Entity\SeniorUser>")
     * @MaxDepth(0)
     */
    protected $seniors;

    public function __construct() {
        $this->seniors = new ArrayCollection();
    }

    /**
     * @var integer
     * @Type("integer")
     */
    protected $id;

    /**
     * @var string
     * @Type("string")
     */
    protected $username;

    /**
     * @var string
     * @Type("string")
     */
    protected $password;

    /**
     * @var \SIWOZ\EguardianBundle\Entity\Place
     * @Type("SIWOZ\EguardianBundle\Entity\Place")
     */
    protected $place;

    /**
     * Add seniors
     *
     * @param \SIWOZ\EguardianBundle\Entity\SeniorUser $seniors
     * @return GuardianUser
     */
    public function addSenior(\SIWOZ\EguardianBundle\Entity\SeniorUser $seniors) {
        $this->seniors[] = $seniors;

        return $this;
    }

    /**
     * Remove seniors
     *
     * @param \SIWOZ\EguardianBundle\Entity\SeniorUser $seniors
     */
    public function removeSenior(\SIWOZ\EguardianBundle\Entity\SeniorUser $seniors) {
        $this->seniors->removeElement($seniors);
    }

    /**
     * Get seniors
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSeniors() {
        return $this->seniors;
    }

    /**
     * @var string
     * @Type("string")
     */
    protected $registeredId;

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
        return array('ROLE_USER','ROLE_ADMIN');
    }

}
