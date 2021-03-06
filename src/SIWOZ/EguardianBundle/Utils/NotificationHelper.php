<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIWOZ\EguardianBundle\Utils;

use SIWOZ\EguardianBundle\Entity\SeniorNotification;
use SIWOZ\EguardianBundle\Entity\EventData;
use SIWOZ\EguardianBundle\Entity\SeniorNotificationAdapter;
use SIWOZ\EguardianBundle\Entity\Event;
use SIWOZ\EguardianBundle\Entity\Alarm;
use SIWOZ\EguardianBundle\Entity\AlarmData;
use SIWOZ\EguardianBundle\Entity\AlarmAdapter;
use Buzz\Message\Request as BuzzRequest;
use JMS\Serializer;
use JMS\Serializer\SerializationContext;

/**
 * Description of NotificationHelper
 *
 * @author Marcin
 */
class NotificationHelper {

    private $serializer;

    function __construct() {
        $this->serializer = Serializer\SerializerBuilder::create()->build();
        // $this->serializer =  $this->getConfigurationPool()->getContainer()->get('jms_serializer');
    }

    public function createEventNotificationRequest(SeniorNotification $notification) {
        $newNotification = new SeniorNotificationAdapter();
        $newNotification->addRegistration_ids($notification->getRegistrationId());
        $newNotification->setData(new EventData($notification->getEvent()));
        $jsonContent = $this->serializer->serialize($newNotification, 'json', SerializationContext::create()->enableMaxDepthChecks()->setGroups(array('Default')));

        $request = new BuzzRequest('POST', '/gcm/send', 'http://android.googleapis.com');
        $request->addHeaders(array('Authorization: key=AIzaSyDeBer0F239bCMm5TnVQrz83NLKkAHc58o
          '));
        $request->addHeaders(array('Content-type: application/json'));
        $request->addHeaders(array('Content-length: ' . strlen((string) $jsonContent)));
        $request->setContent($jsonContent);
        return $request;
    }

    public function createEventNotificationRequestFromEvent($event) {
        $newNotification = new SeniorNotificationAdapter();
        $newNotification->addRegistration_ids($event->getSenior()->getRegistrationId());
        $newNotification->setData(new EventData($event));
        $jsonContent = $this->serializer->serialize($newNotification, 'json', SerializationContext::create()->enableMaxDepthChecks()->setGroups(array('Notification')));

        $request = new BuzzRequest('POST', '/gcm/send', 'http://android.googleapis.com');
        $request->addHeaders(array('Authorization: key=AIzaSyDeBer0F239bCMm5TnVQrz83NLKkAHc58o
          '));
        $request->addHeaders(array('Content-type: application/json'));
        $request->addHeaders(array('Content-length: ' . strlen((string) $jsonContent)));
        $request->setContent($jsonContent);
        return $request;
    }

    public function createAlarmRequest(Alarm $alarm) {
        $newNotification = new AlarmAdapter();
        $newNotification->addRegistration_ids($alarm->getGuardian()->getRegistrationId());
        $newNotification->setData(new AlarmData($alarm));
        $jsonContent = $this->serializer->serialize($newNotification, 'json', SerializationContext::create()->enableMaxDepthChecks()->setGroups(array('Default')));

        $request = new BuzzRequest('POST', '/gcm/send', 'http://android.googleapis.com');
        $request->addHeaders(array('Authorization: key=AIzaSyDeBer0F239bCMm5TnVQrz83NLKkAHc58o
          '));
        $request->addHeaders(array('Content-type: application/json'));
        $request->addHeaders(array('Content-length: ' . strlen((string) $jsonContent)));
        $request->setContent($jsonContent);
        return $request;
    }

}
