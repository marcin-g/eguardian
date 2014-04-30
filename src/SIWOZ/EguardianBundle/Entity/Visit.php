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
 * @ORM\Table(name="visit")
 */
class Visit {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    protected $name;
    
    
 
    /**
     * @ORM\Column(type="string", length=200)
     */
    protected $doctorName;

   
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
     * Set name
     *
     * @param string $name
     * @return Visit
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set doctorName
     *
     * @param string $doctorName
     * @return Visit
     */
    public function setDoctorName($doctorName)
    {
        $this->doctorName = $doctorName;

        return $this;
    }

    /**
     * Get doctorName
     *
     * @return string 
     */
    public function getDoctorName()
    {
        return $this->doctorName;
    }

    /**
     * Set placeId
     *
     * @param \SIWOZ\EguardianBundle\Entity\Place $placeId
     * @return Visit
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
