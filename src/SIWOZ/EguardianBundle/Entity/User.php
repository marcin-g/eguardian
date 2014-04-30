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
 * @ORM\Table(name="user")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"guardian" = "GuardianUser", "senior" = "SeniorUser"})
 */
class User {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $login;
    
    /**
     * @ORM\Column(type="string", length=500)
     */
    protected $password;

   
    /**
     * @ORM\OneToOne(targetEntity="Place")
     * @ORM\JoinColumn(name="place_id", referencedColumnName="id")
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
     * @return User
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
     * @return User
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
     * Set placeId
     *
     * @param \SIWOZ\EguardianBundle\Entity\Place $placeId
     * @return User
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
