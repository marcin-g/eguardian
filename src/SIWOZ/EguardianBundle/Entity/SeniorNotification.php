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

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Groups;

/*
 * @ORM\Entity
 * @ORM\Table(name="entity")
 */
class Notification {

    protected $id;

    /**
     * @Type("string")
     * @Groups({"Default", "All"})
     */
    protected $registration_id;

    /**
     * @Type("SIWOZ\EguardianBundle\Entity\Event")
     * @Groups({"Default", "All"})
     */
    protected $event;
    

    /**
     * @Type("SIWOZ\EguardianBundle\Entity\Event")
     * @Groups({"Default", "All"})
     */
    protected $state;
    
    
    /**
     * @Type("SIWOZ\EguardianBundle\Entity\Event")
     * @Groups({"Default", "All"})
     */
    protected $dateToSend;
    

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
