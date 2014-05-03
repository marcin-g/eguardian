<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SIWOZ\EguardianBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Serializer\Serializer;
//use JMS\SerializerBundle\Serializer;
use JMS\Serializer;

/**
 * Description of UserController
 *
 * @author Marcin
 */
class UserController extends Controller {

    private $serializer;

    function __construct() {
       $this->serializer = Serializer\SerializerBuilder::create()->build();
       // $this->serializer =  $this->getConfigurationPool()->getContainer()->get('jms_serializer');
    }

    public function placeAction($id) {
        $place = $this->getDoctrine()->getRepository('EguardianBundle:Place')->find($id);
        $jsonContent = $this->serializer->serialize($place, 'json');
        return new Response($jsonContent);
    }

    public function putPlaceAction() {
        $json = $this->getRequest()->getContent();
        $em = $this->getDoctrine()->getManager();
        $place = $this->serializer->deserialize($json, 'SIWOZ\EguardianBundle\Entity\Place', 'json');
        $em->persist($place);
        $em->flush();
        return new Response($this->serializer->serialize($place, 'json'));
    }

    public function putSeniorUserAction() {
        /* $place=new Place();
          $place->setApartmentNo("1");
          $place->setCity("Zaniemyl");
          $place->setPostCode("32444");
          $place->setStreet("Libelrer");
          $place->setStreetNo("2");
          $place->setTelephoneNumber("64545666");
          $user=new SeniorUser();
          $user->setLogin("testLogin");
          $user->setPassword("123");
          $user->setPlace($place);
          return new Response($this->serializer->serialize($user, 'json')); */


        $json = $this->getRequest()->getContent();
        $em = $this->getDoctrine()->getManager();
        $seniorUser = $this->serializer->deserialize($json, 'SIWOZ\EguardianBundle\Entity\SeniorUser', 'json');
        $em->persist($seniorUser);
        $em->flush();
        return new Response($this->serializer->serialize($seniorUser, 'json'));
    }

    public function putGuardianUserAction() {
        $json = $this->getRequest()->getContent();
        $em = $this->getDoctrine()->getManager();
        $guardianUser = $this->serializer->deserialize($json, 'SIWOZ\EguardianBundle\Entity\GuardianUser', 'json');
        $em->persist($guardianUser);
        $em->flush();
        return new Response($this->serializer->serialize($guardianUser, 'json'));
    }
   public function addGuardianToSeniorAction() {
        $json = $this->getRequest()->getContent();
        $em = $this->getDoctrine()->getManager();
        $guardianUser = $this->serializer->deserialize($json, 'SIWOZ\EguardianBundle\Entity\GuardianUser', 'json');
        $em->persist($guardianUser);
        $em->flush();
        return new Response($this->serializer->serialize($guardianUser, 'json'));
    }
    
    public function getUserAction($id){
        $user= $this->getDoctrine()->getRepository('EguardianBundle:User')->find($id);
        return new Response($this->serializer->serialize($user, 'json'));
    }
    

}
