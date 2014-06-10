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
use JMS\Serializer\SerializationContext;

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
        $this->getDoctrine()->getRepository('EguardianBundle:User')->addUser($seniorUser);
        $em->persist($seniorUser);
        $em->flush();
        return new Response($this->serializer->serialize($seniorUser, 'json', SerializationContext::create()->enableMaxDepthChecks()->setGroups(array('Default'))));
    }

    public function putGuardianUserAction() {
        $json = $this->getRequest()->getContent();
        $guardianUser = $this->serializer->deserialize($json, 'SIWOZ\EguardianBundle\Entity\GuardianUser', 'json');
        $this->getDoctrine()->getRepository('EguardianBundle:User')->addUser($guardianUser);
        return new Response($this->serializer->serialize($guardianUser, 'json', SerializationContext::create()->enableMaxDepthChecks()->setGroups(array('Default'))));
    }

    public function addGuardianToSeniorAction($guardianLogin, $seniorLogin) {
        //$json = $this->getRequest()->getContent();
        //$seniorUser = $this->serializer->deserialize($json, 'SIWOZ\EguardianBundle\Entity\GuardianUser', 'json');
        $guardianUser = $this->getDoctrine()->getRepository('EguardianBundle:User')->addGuardianToSenior($guardianLogin, $seniorLogin);
        return new Response($this->serializer->serialize($guardianUser, 'json'), SerializationContext::create()->enableMaxDepthChecks()->setGroups(array('All')));
    }

    public function removeGuardianToSeniorAction($guardianLogin, $seniorLogin) {
        //$seniorUser = $this->serializer->deserialize($json, 'SIWOZ\EguardianBundle\Entity\GuardianUser', 'json');
        $guardianUser = $this->getDoctrine()->getRepository('EguardianBundle:User')->removeGuardianToSenior($guardianLogin, $seniorLogin);
        return new Response($this->serializer->serialize($guardianUser, 'json', SerializationContext::create()->enableMaxDepthChecks()->setGroups(array('All'))));
    }

    public function getUserAction($login) {
        $user = $this->getDoctrine()->getRepository('EguardianBundle:User')->getUserByUsername($login);
        return new Response($this->serializer->serialize($user, 'json', SerializationContext::create()->enableMaxDepthChecks()->setGroups(array('All'))));
    }

    public function updateUserAction() {
        $json = $this->getRequest()->getContent();
        $user = $this->serializer->deserialize($json, 'SIWOZ\EguardianBundle\Entity\User', 'json');
        $user = $this->getDoctrine()->getRepository('EguardianBundle:User')->updateUser($user);
        return new Response($this->serializer->serialize($user, 'json', SerializationContext::create()->enableMaxDepthChecks()->setGroups(array('All'))));
    }
    public function updateGuardianUserAction() {
        $json = $this->getRequest()->getContent();
        $user = $this->serializer->deserialize($json, 'SIWOZ\EguardianBundle\Entity\GuardianUser', 'json');
        $user = $this->getDoctrine()->getRepository('EguardianBundle:User')->updateUser($user);
        return new Response($this->serializer->serialize($user, 'json', SerializationContext::create()->enableMaxDepthChecks()->setGroups(array('All'))));
    }

    public function updateRegistrationIdAction() {
        $json = $this->getRequest()->getContent();
        $user=$this->get("security.context")->getToken()->getUser();
        $obj = json_decode($json);
        $id=$obj->{'RegistrationId'};
        $this->getDoctrine()->getRepository('EguardianBundle:User')->updateRegistrationId($user,$id);
        return new Response($this->serializer->serialize($user, 'json', SerializationContext::create()->enableMaxDepthChecks()->setGroups(array('All'))));
    }

    public function loginAction() {
        return new Response($this->serializer->serialize($this->get("security.context")->getToken()->getUser(), 'json', SerializationContext::create()->enableMaxDepthChecks()->setGroups(array('All'))));
    }

    public function loginGuardianAction() {
        return new Response($this->serializer->serialize($this->get("security.context")->getToken()->getUser(), 'json', SerializationContext::create()->enableMaxDepthChecks()->setGroups(array('All'))));
    }

}
