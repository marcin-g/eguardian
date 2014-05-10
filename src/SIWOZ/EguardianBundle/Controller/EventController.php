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
        return new Response($this->serializer->serialize($mealEvent, 'json'));
    }

    public function putTestEventAction() {
        $json = $this->getRequest()->getContent();
        $testEvent = $this->serializer->deserialize($json, 'SIWOZ\EguardianBundle\Entity\TestEvent', 'json');
        $this->getDoctrine()->getRepository('EguardianBundle:Event')->addEvent($testEvent);
        return new Response($this->serializer->serialize($testEvent, 'json'));
    }

    public function putMedicineEventAction() {
        $json = $this->getRequest()->getContent();
        $medicineEvent = $this->serializer->deserialize($json, 'SIWOZ\EguardianBundle\Entity\MedicineEvent', 'json');
        $this->getDoctrine()->getRepository('EguardianBundle:Event')->addEvent($medicineEvent);
        return new Response($this->serializer->serialize($medicineEvent, 'json'));
    }

    public function putVisitEventAction() {
        $json = $this->getRequest()->getContent();
        $visitEvent = $this->serializer->deserialize($json, 'SIWOZ\EguardianBundle\Entity\VisitEvent', 'json');
        $this->getDoctrine()->getRepository('EguardianBundle:Event')->addEvent($visitEvent);
        return new Response($this->serializer->serialize($visitEvent, 'json'));
    }

    public function getEventAction($id) {
        $event = $this->getDoctrine()->getRepository('EguardianBundle:Event')->getEvent($id);
        return new Response($this->serializer->serialize($event, 'json'));
    }

    public function updateEventAction() {
        $json = $this->getRequest()->getContent();
        $event = $this->serializer->deserialize($json, 'SIWOZ\EguardianBundle\Entity\Event', 'json');
        $event = $this->getDoctrine()->getRepository('EguardianBundle:Event')->updateEvent($event);
        return new Response($this->serializer->serialize($event, 'json'));
    }

    public function deleteEventAction() {
        $json = $this->getRequest()->getContent();
        $event = $this->serializer->deserialize($json, 'SIWOZ\EguardianBundle\Entity\Event', 'json');
        $this->getDoctrine()->getRepository('EguardianBundle:Event')->deleteEvent($event);
        return new Response("OK");
    }

    public function getEventsAction($className) {
        $user = $this->get("security.context")->getToken()->getUser();
        $events = $this->getDoctrine()->getRepository('EguardianBundle:Event')->getEvents($user,$className);
        return new Response($this->serializer->serialize($events, 'json'));
    }

}
