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
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="SIWOZ\EguardianBundle\Repository\UserRepository")
 * @ORM\Table(name="user")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"guardian" = "GuardianUser", "senior" = "SeniorUser"})
 * @Discriminator(field = "discr", map = {"guardian" = "SIWOZ\EguardianBundle\Entity\GuardianUser", "senior" = "SIWOZ\EguardianBundle\Entity\SeniorUser"})
 */
class User implements UserInterface, \Serializable {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Type("integer")
     * @Groups({"Default", "All"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Type("string")
     * @Groups({"Default", "All"})
     */
    protected $username;

    /**
     * @ORM\Column(type="string", length=500)
     * @Type("string")
     * @Groups({"None"})
     */
    protected $password;

    /**
     * @ORM\OneToOne(targetEntity="Place",cascade={"persist","remove"}, fetch="EAGER")
     * @ORM\JoinColumn(name="place_id", referencedColumnName="id")
     * @Type("SIWOZ\EguardianBundle\Entity\Place")
     * @Groups({"All"})
     */
    protected $place;

    /**
     * @ORM\Column(type="string", length=512)
     * @Type("string")
     * @Groups({"None"})
     * 
     */
    protected $registrationId;

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
     * @param string registrationId
     * @return User
     */
    public function setRegistrationId($registrationId) {
        $this->registrationId = $registrationId;

        return $this;
    }

    /**
     * Get registrationId
     *
     * @return string 
     */
    public function getRegistrationId() {
        return $this->registrationId;
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
