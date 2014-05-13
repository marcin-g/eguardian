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

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Groups;

class EventData {

    /**
     * @Type("SIWOZ\EguardianBundle\Entity\Event")
     * @Groups({"Default", "All"})
     */
    
    protected $event;

    public function __construct($event=null) {
        
        $this->event=$event;
    }

    
    public function getEvent() {
        return $this->event;
    }   
    
    public function setEvent($event) {
        $this->event = $event;
    }
}
