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

class AlarmData {

     //@Type("SIWOZ\EguardianBundle\Entity\Alarm")
    /**
     * @Groups({"Default", "All", "Notification"})
     */
    
    protected $alarm;

    public function __construct($alarm=null) {
        
        $this->alarm=$alarm;
    }

    
    public function getAlarm() {
        return $this->alarm;
    }   
    
    public function setAlarm($alarm) {
        $this->alarm = $alarm;
    }
}
