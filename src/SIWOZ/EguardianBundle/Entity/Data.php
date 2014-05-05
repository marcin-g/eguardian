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

class Data {

    /**
     * @Type("string")
     */
    protected $key;

    /**
     * @Type("string")
     */
    protected $value;
    /**
     * @Type("SIWOZ\EguardianBundle\Entity\Place")
     */
    protected $place;

    public function getKey() {
        return $this->key;
    }

    public function getValue() {
        return $this->value;
    }
    
    public function getPlace() {
        return $this->place;
    }

    public function setKey($key) {
        $this->key = $key;
    }

    public function setValue($value) {
        $this->value = $value;
    }    
    
    public function setPlace($place) {
        $this->place = $place;
    }


}
