<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIWOZ\EguardianBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Discriminator;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Exclude;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

/**
 * @ORM\Entity(repositoryClass="SIWOZ\EguardianBundle\Repository\UserRepository")
 * @ORM\Table(name="user")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"guardian" = "GuardianUser", "senior" = "SeniorUser"})
 * @Discriminator(field = "discr", map = {"guardian" = "SIWOZ\EguardianBundle\Entity\GuardianUser", "senior" = "SIWOZ\EguardianBundle\Entity\SeniorUser"})
 * @ExclusionPolicy("none")
 */
class User implements UserInterface, \Serializable {

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
    protected $username;

    /**
     * @ORM\Column(type="string", length=500)
     * @Type("string")
     * @Exclude
     * 
     */
    protected $password;

    /**
     * @ORM\OneToOne(targetEntity="Place",cascade={"persist","remove"})
     * @ORM\JoinColumn(name="place_id", referencedColumnName="id")
     * @Type("SIWOZ\EguardianBundle\Entity\Place")
     */
    protected $place;

    /**
     * @ORM\Column(type="string", length=512)
     * @Type("string")
     * @Exclude
     * 
     */
    protected $registeredId;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set login
     *
     * @param string $login
     * @return User
     */
    public function setUsername($username) {
        $this->username = $username;

        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set place
     *
     * @param \SIWOZ\EguardianBundle\Entity\Place $place
     * @return User
     */
    public function setPlace(\SIWOZ\EguardianBundle\Entity\Place $place = null) {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return \SIWOZ\EguardianBundle\Entity\Place 
     */
    public function getPlace() {
        return $this->place;
    }

    /**
     * Set registeredId
     *
     * @param string $registeredId
     * @return User
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
        return array('NONE');
    }

    public function getSalt() {
        return null;
    }

    public function eraseCredentials() {
        
    }

    public function serialize() {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->salt,
        ));
    }

    public function unserialize($serialized) {
        list (
                $this->id,
                $this->username,
                $this->password,
                $this->salt
                ) = unserialize($serialized);
    }

}
