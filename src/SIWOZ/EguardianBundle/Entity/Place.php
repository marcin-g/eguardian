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
 * @ORM\Table(name="place")
 */
class Place {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    protected $street;

    /**
     * @ORM\Column(name="street_no", type="string", length=200)
     */
    protected $streetNo;
    /**
     * @ORM\Column(name="apartment_no", type="string", length=200)
     */
    protected $apartmentNo;
    
    /**
     * @ORM\Column(type="string", length=200)
     */
    protected $City;
    
    /**
     * @ORM\Column(name="postcode", type="string", length=5)
     */
    protected $PostCode;
    
    
    /**
     * @ORM\Column(name="telephone_number", type="string", length=11)
     */
    protected $TelephoneNumber;
    

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
     * Set street
     *
     * @param string $street
     * @return Place
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set streetNo
     *
     * @param string $streetNo
     * @return Place
     */
    public function setStreetNo($streetNo)
    {
        $this->streetNo = $streetNo;

        return $this;
    }

    /**
     * Get streetNo
     *
     * @return string 
     */
    public function getStreetNo()
    {
        return $this->streetNo;
    }

    /**
     * Set apartmentNo
     *
     * @param string $apartmentNo
     * @return Place
     */
    public function setApartmentNo($apartmentNo)
    {
        $this->apartmentNo = $apartmentNo;

        return $this;
    }

    /**
     * Get apartmentNo
     *
     * @return string 
     */
    public function getApartmentNo()
    {
        return $this->apartmentNo;
    }

    /**
     * Set City
     *
     * @param string $city
     * @return Place
     */
    public function setCity($city)
    {
        $this->City = $city;

        return $this;
    }

    /**
     * Get City
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->City;
    }

    /**
     * Set PostCode
     *
     * @param string $postCode
     * @return Place
     */
    public function setPostCode($postCode)
    {
        $this->PostCode = $postCode;

        return $this;
    }

    /**
     * Get PostCode
     *
     * @return string 
     */
    public function getPostCode()
    {
        return $this->PostCode;
    }

    /**
     * Set TelephoneNumber
     *
     * @param string $telephoneNumber
     * @return Place
     */
    public function setTelephoneNumber($telephoneNumber)
    {
        $this->TelephoneNumber = $telephoneNumber;

        return $this;
    }

    /**
     * Get TelephoneNumber
     *
     * @return string 
     */
    public function getTelephoneNumber()
    {
        return $this->TelephoneNumber;
    }
}
