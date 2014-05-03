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
/**
 * @ORM\Entity(repositoryClass="SIWOZ\EguardianBundle\Repository\UserRepository")
 * 
 */
class SeniorUser  extends User{
    
    /**
     * @ORM\ManyToMany(targetEntity="GuardianUser", inversedBy="seniors")
     * @ORM\JoinColumn(name="guardian_user_id", referencedColumnName="id")
     * @Type("ArrayCollection<SIWOZ\EguardianBundle\Entity\GuardianUser>")
     */
    protected $guardians;

      
      public function __construct() {
        $this->guardians = new ArrayCollection();
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
    protected $login;

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
}
