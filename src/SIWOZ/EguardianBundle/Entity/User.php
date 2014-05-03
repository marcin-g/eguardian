<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIWOZ\EguardianBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;

/**
 * @ORM\Entity(repositoryClass="SIWOZ\EguardianBundle\Repository\UserRepository")
 * @ORM\Table(name="user")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"guardian" = "GuardianUser", "senior" = "SeniorUser"})
 * @Discriminator(field = "discr", map = {"guardian" = "SIWOZ\EguardianBundle\Entity\GuardianUser", "senior" = "SIWOZ\EguardianBundle\Entity\SeniorUser"})
 */
class User {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Type("integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Type("string")
     */
    protected $login;
    
    /**
     * @ORM\Column(type="string", length=500)
     * @Type("string")
     */
    protected $password;

   
    /**
     * @ORM\OneToOne(targetEntity="Place",cascade={"persist"})
     * @ORM\JoinColumn(name="place_id", referencedColumnName="id")
     * @Type("SIWOZ\EguardianBundle\Entity\Place")
     */
    protected $place;



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
     * Set place
     *
     * @param \SIWOZ\EguardianBundle\Entity\Place $place
     * @return User
     */
    public function setPlace(\SIWOZ\EguardianBundle\Entity\Place $place = null)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return \SIWOZ\EguardianBundle\Entity\Place 
     */
    public function getPlace()
    {
        return $this->place;
    }
}
