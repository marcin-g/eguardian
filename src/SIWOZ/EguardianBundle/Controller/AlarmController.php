<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIWOZ\EguardianBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of AlarmController
 *
 * @author Marcin
 */
class AlarmController extends Controller {

    public function putAlarm() {
        $json = $this->getRequest()->getContent();
        $alarm = $this->serializer->deserialize($json, 'SIWOZ\EguardianBundle\Entity\Alarm', 'json');
        $this->getDoctrine()->getRepository('EguardianBundle:Alarm')->addAlarm($alarm);
        return new Response($this->serializer->serialize($alarm, 'json', SerializationContext::create()->enableMaxDepthChecks()->setGroups(array('Default'))));
    }

    public function sendAlarm($alarm) {
        $client = new FileGetContents();
        $request = $this->helper->createEventNotificationRequest($alarm);
        $response = new BuzzResponse();
        $client->send($request, $response);
        if ($response->isOk()) {
            $json_decoded = json_decode($response->getContent());
            if ($json_decoded->success == 1) {
                $this->getDoctrine()->getRepository('EguardianBundle:Alarm')->updateSuccesNotification($alarm);
            } else {
                $this->getDoctrine()->getRepository('EguardianBundle:Alarm')->updateFailNotification($alarm);
            }
        }
        $this->getDoctrine()->getRepository('EguardianBundle:Alarm')->updateFailNotification($alarm);
    }

    public function sendAlarms() {

        $alarms = $this->getDoctrine()->getRepository('EguardianBundle:Alarm')->getAlarmToSend();
        foreach ($alarms as $alarm) {
            $this->sendAlarm($alarm);
        }
        return new Response("OK");
    }

}
