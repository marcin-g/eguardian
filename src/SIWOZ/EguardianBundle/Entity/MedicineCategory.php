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
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="medicine_category")
 */
class MedicineCategory {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Type("integer")
     * @Groups({"All"})
     * 
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=200)
     * @Type("string")
     * @Groups({"Default", "All"})
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Medicine", mappedBy="medicineCategory")
     * @Type("ArrayCollection<SIWOZ\EguardianBundle\Entity\Medicine>")
     * @Groups({"All"})
     */
    protected $medicines;

    public function __construct() {
        $this->medicines = new ArrayCollection();
    }



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
     * @return MedicineCategory
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
     * Add medicines
     *
     * @param \SIWOZ\EguardianBundle\Entity\Medicine $medicines
     * @return MedicineCategory
     */
    public function addMedicine(\SIWOZ\EguardianBundle\Entity\Medicine $medicines)
    {
        $this->medicines[] = $medicines;

        return $this;
    }

    /**
     * Remove medicines
     *
     * @param \SIWOZ\EguardianBundle\Entity\Medicine $medicines
     */
    public function removeMedicine(\SIWOZ\EguardianBundle\Entity\Medicine $medicines)
    {
        $this->medicines->removeElement($medicines);
    }

    /**
     * Get medicines
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedicines()
    {
        return $this->medicines;
    }
}
