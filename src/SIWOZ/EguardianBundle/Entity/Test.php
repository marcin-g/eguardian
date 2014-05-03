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
 * @ORM\Entity(repositoryClass="SIWOZ\EguardianBundle\Repository\TestRepository")
 * @ORM\Table(name="test")
 */
class Test {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Type("integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=200)
     * @Type("string")
     */
    protected $name;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="TestCategory")
     * @ORM\JoinColumn(name="test_category_id", referencedColumnName="id")
     * @Type("SIWOZ\EguardianBundle\Entity\TestCategory")
     */
    protected $testCategory;

   
    

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
     * @return Test
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
     * Set testCategory
     *
     * @param \SIWOZ\EguardianBundle\Entity\TestCategory $testCategory
     * @return Test
     */
    public function setTestCategory(\SIWOZ\EguardianBundle\Entity\TestCategory $testCategory = null)
    {
        $this->testCategory = $testCategory;

        return $this;
    }

    /**
     * Get testCategory
     *
     * @return \SIWOZ\EguardianBundle\Entity\TestCategory 
     */
    public function getTestCategory()
    {
        return $this->testCategory;
    }
}
