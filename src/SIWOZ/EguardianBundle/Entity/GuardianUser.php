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
class GuardianUser  extends User{
    
    /**
     * @ORM\ManyToMany(targetEntity="SeniorUser", inversedBy="guardians")
     * @ORM\JoinColumn(name="senior_user_id", referencedColumnName="id")
     */
    
    protected $seniors;

 
      public function __construct() {
        $this->seniors = new ArrayCollection();
    }

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $login;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var \SIWOZ\EguardianBundle\Entity\Place
     */
    protected $placeId;


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
     * @return GuardianUser
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
     * @return GuardianUser
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
     * Add seniors
     *
     * @param \SIWOZ\EguardianBundle\Entity\SeniorUser $seniors
     * @return GuardianUser
     */
    public function addSenior(\SIWOZ\EguardianBundle\Entity\SeniorUser $seniors)
    {
        $this->seniors[] = $seniors;

        return $this;
    }

    /**
     * Remove seniors
     *
     * @param \SIWOZ\EguardianBundle\Entity\SeniorUser $seniors
     */
    public function removeSenior(\SIWOZ\EguardianBundle\Entity\SeniorUser $seniors)
    {
        $this->seniors->removeElement($seniors);
    }

    /**
     * Get seniors
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSeniors()
    {
        return $this->seniors;
    }

    /**
     * Set placeId
     *
     * @param \SIWOZ\EguardianBundle\Entity\Place $placeId
     * @return GuardianUser
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
