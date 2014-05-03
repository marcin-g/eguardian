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
        $registration_ids->add("h7senelUq1IJHrjSooCnc2sO08rD6bgdjvHtGNI4");
        $notification->setRegistration_ids($registration_ids);
        $jsonContent = $this->serializer->serialize($notification, 'json');
        // $response=new Response($jsonContent);

        /*  $curl = new Curl();

          $curl->setHeader("Content-Type", "application/json");
          $curl->setHeader("Authorization", "key=AIzaSyDeBer0F239bCMm5TnVQrz83NLKkAHc58o
          ");
          $curl->post("https://android.googleapis.com/gcm/send", array($jsonContent)); */
        /*    $request = new Request();
          $request->setMethod("POST");
          $request->headers->set("Content-Type","application/json");
          $request->headers->set("Authorization","key=AIzaSyDeBer0F239bCMm5TnVQrz83NLKkAHc58o
          ");
          $request->request=$jsonContent; */
        /* $subRequest = $request->duplicate(array(), null, $path);

          $httpKernel = $this->container->get('http_kernel');
          $response = $httpKernel->handle(
          $subRequest,
          HttpKernelInterface::SUB_REQUEST
          ); */
        // $curl->close();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: key=AIzaSyDeBer0F239bCMm5TnVQrz83NLKkAHc58o
','Content-type: application/json')); // Assuming you're requesting JSON


        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonContent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $resulta = curl_exec($ch);
        if (curl_errno($ch)) {
            
        return new Response(curl_error($ch));
        } else {
            curl_close($ch);
        }
        
        return new Response($resulta);
// If using JSON...
        //  $data = json_decode($response);
        return new Response($response);
    }

}
