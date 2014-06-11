<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIWOZ\EguardianBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer;
use JMS\Serializer\SerializationContext;
use Buzz\Client\FileGetContents;
use Buzz\Message\Request as BuzzRequest;
use Buzz\Message\Response as BuzzResponse;
use SIWOZ\EguardianBundle\Utils\NotificationHelper;

/**
 * Description of AlarmController
 *
 * @author Marcin
 */
class AlarmController extends Controller {

    private $serializer;
    private $helper;

    function __construct() {
        $this->serializer = Serializer\SerializerBuilder::create()->build();
        $this->helper = new NotificationHelper();
        // $this->serializer =  $this->getConfigurationPool()->getContainer()->get('jms_serializer');
    }
    public function putAlarmAction() {
        //$json = $this->getRequest()->getContent();
        //$alarm = $this->serializer->deserialize($json, 'SIWOZ\EguardianBundle\Entity\Alarm', 'json');
        //$this->getDoctrine()->getRepository('EguardianBundle:Alarm')->addAlarm($alarm);
        $user = $this->get("security.context")->getToken()->getUser();

        if (in_array('ROLE_USER', $user->getRoles())) {
            $alarm=$this->getDoctrine()->getRepository('EguardianBundle:Alarm')->generateAlarms($user);
            return new Response($this->serializer->serialize($alarm, 'json', SerializationContext::create()->enableMaxDepthChecks()->setGroups(array('Default'))));
        } else{
            throw $this->createNotFoundException('The user  not found');
        }
    }

    public function sendAlarmAction($alarm) {
        $client = new FileGetContents();
        $request = $this->helper->createAlarmRequest($alarm);
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
        return $request->getContent();
    }

    public function sendAlarmsAction() {
        
        $alarms = $this->getDoctrine()->getRepository('EguardianBundle:Alarm')->getAlarmToSend();
        foreach ($alarms as $alarm) {
            $this->sendAlarmAction($alarm);
        }
        return new Response("OK");
    }

}
