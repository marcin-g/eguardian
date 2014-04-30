<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIWOZ\EguardianBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * 
 */
class SeniorUser  extends User{
    
    /**
     * @ORM\ManyToMany(targetEntity="GuardianUser", inversedBy="seniors")
     * @ORM\JoinColumn(name="guardian_user_id", referencedColumnName="id")
     */
    protected $guardians;

      
      public function __construct() {
        $this->guardians = new ArrayCollection();
    }

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $password;

    /**
     * @var \SIWOZ\EguardianBundle\Entity\Place
     */
    private $placeId;


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
     * Set login
     *
     * @param string $login
     * @return SeniorUser
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return SeniorUser
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Add guardians
     *
     * @param \SIWOZ\EguardianBundle\Entity\GuardianUser $guardians
     * @return SeniorUser
     */
    public function addGuardian(\SIWOZ\EguardianBundle\Entity\GuardianUser $guardians)
    {
        $this->guardians[] = $guardians;

        return $this;
    }

    /**
     * Remove guardians
     *
     * @param \SIWOZ\EguardianBundle\Entity\GuardianUser $guardians
     */
    public function removeGuardian(\SIWOZ\EguardianBundle\Entity\GuardianUser $guardians)
    {
        $this->guardians->removeElement($guardians);
    }

    /**
     * Get guardians
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGuardians()
    {
        return $this->guardians;
    }

    /**
     * Set placeId
     *
     * @param \SIWOZ\EguardianBundle\Entity\Place $placeId
     * @return SeniorUser
     */
    public function setPlaceId(\SIWOZ\EguardianBundle\Entity\Place $placeId = null)
    {
        $this->placeId = $placeId;

        return $this;
    }

    /**
     * Get placeId
     *
     * @return \SIWOZ\EguardianBundle\Entity\Place 
     */
    public function getPlaceId()
    {
        return $this->placeId;
    }
}
