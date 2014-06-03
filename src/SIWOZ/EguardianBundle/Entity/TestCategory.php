<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIWOZ\EguardianBundle\Entity;

use JMS\Serializer\Annotation\Type;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="test_category")
 */
class TestCategory {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Type("integer")
     * @Groups({"All"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=200)
     * @Type("string")
     * @Groups({"Default", "All","Notification"})
     */
    protected $name;
    
    
    /**
     * @ORM\Column(type="string", length=500)
     * @Type("string")
     * @Groups({"Default", "All","Notification"})
     */
    protected $description;
    
    /**
     * @ORM\Column(type="string", length=50)
     * @Type("string")
     * @Groups({"Default", "All","Notification"})
     */
    protected $unit;




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
     * @return TestCategory
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
     * Set description
     *
     * @param string $description
     * @return TestCategory
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set unit
     *
     * @param string $unit
     * @return TestCategory
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string 
     */
    public function getUnit()
    {
        return $this->unit;
    }
}
