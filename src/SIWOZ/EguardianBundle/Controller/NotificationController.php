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

/**
 * Description of EventController
 *
 * @author Marcin
 */
class NotificationController extends Controller {

    private $serializer;

    function __construct() {
        $this->serializer = Serializer\SerializerBuilder::create()->build();
        // $this->serializer =  $this->getConfigurationPool()->getContainer()->get('jms_serializer');
    }

    public function sendAction() {
        $data = new \SIWOZ\EguardianBundle\Entity\Data();
        $data->setKey("klucz");
        $data->setValue("wartosc");
        $arrayData = new ArrayCollection();
        $arrayData->add($data);
        $notification = new \SIWOZ\EguardianBundle\Entity\Notification();
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
         $request->addHeaders(array('Content-length: ' . strlen((string)$jsonContent)));
         $request->setContent($jsonContent);
        $client = new FileGetContents();
        $client->send($request, $response);


        return new Response($response);
    }

}
