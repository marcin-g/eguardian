<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIWOZ\EguardianBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="SIWOZ\EguardianBundle\Repository\MedicineRepository")
 * @ORM\Table(name="medicine")
 */
class Medicine {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Type("integer")
     * @Groups({"Default", "All"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=200)
     * @Type("string")
     * @Groups({"Default", "All","Notification"})
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=200)
     * @Type("string")
     * @Groups({"Default", "All","Notification"})
     */
    protected $dose;

    /**
     * @ORM\ManyToOne(targetEntity="MedicineCategory", inversedBy="medicines")
     * @ORM\JoinColumn(name="medicine_category_id", referencedColumnName="id")
     * @Type("SIWOZ\EguardianBundle\Entity\MedicineCategory")
     * @Groups({"Default", "All","Notification"})
     */
    protected $medicineCategory;


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
     * @return Medicine
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
     * Set dose
     *
     * @param string $dose
     * @return Medicine
     */
    public function setDose($dose)
    {
        $this->dose = $dose;

        return $this;
    }

    /**
     * Get dose
     *
     * @return string 
     */
    public function getDose()
    {
        return $this->dose;
    }

    /**
     * Set medicineCategory
     *
     * @param \SIWOZ\EguardianBundle\Entity\MedicineCategory $medicineCategory
     * @return Medicine
     */
    public function setMedicineCategory(\SIWOZ\EguardianBundle\Entity\MedicineCategory $medicineCategory = null)
    {
        $this->medicineCategory = $medicineCategory;

        return $this;
    }

    /**
     * Get medicineCategory
     *
     * @return \SIWOZ\EguardianBundle\Entity\MedicineCategory 
     */
    public function getMedicineCategory()
    {
        return $this->medicineCategory;
    }
}
