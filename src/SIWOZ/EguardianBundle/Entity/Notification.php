<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notification
 *
 * @author Marcin
 */

namespace SIWOZ\EguardianBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Groups;

class Notification {

    protected $id;

    /**
     * @Type("string")
     * @Groups({"Default", "All"})
     */
    protected $name;
    /**
     * @Type("ArrayCollection<string>")
     * @Groups({"Default", "All"})
     */
    protected $registration_ids;

    /**
     * @Type("SIWOZ\EguardianBundle\Entity\Data")
     * @Groups({"Default", "All"})
     */
    protected $data;
    

    public function __construct() {
        $this->registration_ids = new ArrayCollection();
    }

    public function getName() {
        return $this->name;
    }

    public function getData() {
        return $this->data;
    }

    public function getRegistration_ids() {
        return $this->registration_ids;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function setRegistration_ids($registration_ids) {
        $this->registration_ids = $registration_ids;
    }

}
