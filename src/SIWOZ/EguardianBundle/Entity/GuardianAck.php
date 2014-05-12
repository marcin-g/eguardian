<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace SIWOZ\EguardianBundle\Entity;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Discriminator;
/**
 * Description of GuardianAck
 *
 * @author Marcin
 */
class GuardianNotification extends Entity {
    protected $id;
    protected $event;
    protected $sendDate;
    protected $try;
    protected $state;
}
