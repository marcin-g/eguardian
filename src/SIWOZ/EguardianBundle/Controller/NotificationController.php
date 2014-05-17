<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIWOZ\EguardianBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer;
use Curl\Curl;
use Buzz\Message\Request as BuzzRequest;
use Buzz\Message\Response as BuzzResponse;
use Buzz\Client\FileGetContents;
use SIWOZ\EguardianBundle\Utils\NotificationHelper;

/**
 * Description of EventController
 *
 * @author Marcin
 */
class NotificationController extends Controller {

    private $serializer;
    private $helper;

    function __construct() {
        $this->serializer = Serializer\SerializerBuilder::create()->build();
        $this->helper = new NotificationHelper();
        // $this->serializer =  $this->getConfigurationPool()->getContainer()->get('jms_serializer');
    }

    public function sendAction() {
        $data = new \SIWOZ\EguardianBundle\Entity\EventData();
        $place = new \SIWOZ\EguardianBundle\Entity\Place();
        $place->setApartmentNo("1");
        $place->setCity("Zaniemyl");
        $place->setPostCode("32444");
        $place->setStreet("Libelrer");
        $place->setStreetNo("2");
        $place->setTelephoneNumber("64545666");
        $data->setEvent($place);
        $notification = new \SIWOZ\EguardianBundle\Entity\SeniorNotificationAdapter();
        $notification->setData($data);
        $registration_ids = new ArrayCollection();
        $registration_ids->add("APA91bGGTv7U4_gtXVp_cLl02_8OrAeSNt3QlcGJIpux5zC_CbRrW8AdgUEyOt4YLoL3qD6toNGsT945nzph2KX_8XGckhYx6lIsvhuS2pUbbTtzBfRrbJJ3TlbulzS86mV8MfKtUP9i3pOh7senelUq1IJHrjSooCnc2sO08rD6bgdjvHtGNI4");
        $notification->setRegistration_ids($registration_ids);
        $jsonContent = $this->serializer->serialize($notification, 'json');

        $request = new BuzzRequest('POST', '/gcm/send', 'http://android.googleapis.com');
        $response = new BuzzResponse();
        $request->addHeaders(array('Authorization: key=AIzaSyDeBer0F239bCMm5TnVQrz83NLKkAHc58o
          '));
        $request->addHeaders(array('Content-type: application/json'));
        $request->addHeaders(array('Content-length: ' . strlen((string) $jsonContent)));
        $request->setContent($jsonContent);
        $client = new FileGetContents();
        $client->send($request, $response);

/*
        if ($response->isOk()) {
            $json_decoded = json_decode($response->getContent());
            if ($json_decoded->success == 1) {

                return new Response("elo");
            }
        }*/
        //return new Response($jsonContent);
        return new Response($response);
    }

    public function sendSeniorNotificationAction() {

        $notifications = $this->getDoctrine()->getRepository('EguardianBundle:SeniorNotification')->getNotificationToSend();
        $client = new FileGetContents();
        foreach ($notifications as $notification) {
            $request = $this->helper->createEventNotificationRequest($notification);
            $response = new BuzzResponse();
            $client->send($request, $response);
            if ($response->isOk()) {
                $json_decoded = json_decode($response->getContent());
                if ($json_decoded->success == 1) {
                    $this->getDoctrine()->getRepository('EguardianBundle:SeniorNotification')->updateSuccesNotification($notification);
                } else {
                    $this->getDoctrine()->getRepository('EguardianBundle:SeniorNotification')->updateFailNotification($notification);
                }
            }
            $this->getDoctrine()->getRepository('EguardianBundle:SeniorNotification')->updateFailNotification($notification);
        }
        return new Response("OK");
    }
    
     public function sendGuardianNotificationAction() {

        $notifications = $this->getDoctrine()->getRepository('EguardianBundle:GuardianNotification')->getNotificationToSend();
        $client = new FileGetContents();
        foreach ($notifications as $notification) {
            $request = $this->helper->createEventNotificationRequest($notification);
            $response = new BuzzResponse();
            $client->send($request, $response);
            if ($response->isOk()) {
                $json_decoded = json_decode($response->getContent());
                if ($json_decoded->success == 1) {
                    $this->getDoctrine()->getRepository('EguardianBundle:GuardianNotification')->updateSuccesNotification($notification);
                } else {
                    $this->getDoctrine()->getRepository('EguardianBundle:GuardianNotification')->updateFailNotification($notification);
                }
            }
            $this->getDoctrine()->getRepository('EguardianBundle:GuardianNotification')->updateFailNotification($notification);
        }
        return new Response("OK");
    }

}
