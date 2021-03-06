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

/**
 * Description of EventController
 *
 * @author Marcin
 */
class EventController extends Controller {

    private $serializer;

    function __construct() {
        $this->serializer = Serializer\SerializerBuilder::create()->build();
        // $this->serializer =  $this->getConfigurationPool()->getContainer()->get('jms_serializer');
    }

    public function putMealEventAction() {
        $json = $this->getRequest()->getContent();
        $mealEvent = $this->serializer->deserialize($json, 'SIWOZ\EguardianBundle\Entity\MealEvent', 'json');
        $this->getDoctrine()->getRepository('EguardianBundle:Event')->addEvent($mealEvent);
        return new Response($this->serializer->serialize($mealEvent, 'json', SerializationContext::create()->enableMaxDepthChecks()->setGroups(array('Default'))));
    }

    public function putTestEventAction() {
        $json = $this->getRequest()->getContent();
        $testEvent = $this->serializer->deserialize($json, 'SIWOZ\EguardianBundle\Entity\TestEvent', 'json');
        $this->getDoctrine()->getRepository('EguardianBundle:Event')->addEvent($testEvent);
        return new Response($this->serializer->serialize($testEvent, 'json', SerializationContext::create()->enableMaxDepthChecks()->setGroups(array('Default'))));
    }

    public function putMedicineEventAction() {
        $json = $this->getRequest()->getContent();
        $medicineEvent = $this->serializer->deserialize($json, 'SIWOZ\EguardianBundle\Entity\MedicineEvent', 'json');
        $this->getDoctrine()->getRepository('EguardianBundle:Event')->addEvent($medicineEvent);
        return new Response($this->serializer->serialize($medicineEvent, 'json', SerializationContext::create()->enableMaxDepthChecks()->setGroups(array('Default'))));
    }

    public function putVisitEventAction() {
        $json = $this->getRequest()->getContent();
        $visitEvent = $this->serializer->deserialize($json, 'SIWOZ\EguardianBundle\Entity\VisitEvent', 'json');
        $this->getDoctrine()->getRepository('EguardianBundle:Event')->addEvent($visitEvent);
        return new Response($this->serializer->serialize($visitEvent, 'json', SerializationContext::create()->enableMaxDepthChecks()->setGroups(array('Default'))));
    }

    public function getEventAction($id) {
        $event = $this->getDoctrine()->getRepository('EguardianBundle:Event')->getEvent($id);
        return new Response($this->serializer->serialize($event, 'json', SerializationContext::create()->enableMaxDepthChecks()->setGroups(array('Default'))));
    }

    public function updateEventAction($className) {
        $json = $this->getRequest()->getContent();
        $event = $this->serializer->deserialize($json, $className, 'json');
        $event = $this->getDoctrine()->getRepository('EguardianBundle:Event')->updateEvent($event);
        if ($event != null) {
            return new Response($this->serializer->serialize($event, 'json', SerializationContext::create()->enableMaxDepthChecks()->setGroups(array('Default'))));
        }
        else{
            throw $this->createNotFoundException('The event or '.substr($className,strrpos($className,'\\'+1).' not found'));
        }
    }

    public function deleteEventAction($type, $id) {
//        $json = $this->getRequest()->getContent();
//        $event = $this->serializer->deserialize($json, 'SIWOZ\EguardianBundle\Entity\Event', 'json');
        $this->getDoctrine()->getRepository('EguardianBundle:SeniorNotification')->deleteNotifcationsByEventId($id);
        $this->getDoctrine()->getRepository('EguardianBundle:Event')->deleteEventById($id);
        return new Response("OK");
    }

    public function getEventsAction($className) {
        $user = $this->get("security.context")->getToken()->getUser();
        $events = $this->getDoctrine()->getRepository('EguardianBundle:Event')->getEvents($user, $className);
        return new Response($this->serializer->serialize($events, 'json', SerializationContext::create()->enableMaxDepthChecks()->setGroups(array('Default'))));
    }

}
