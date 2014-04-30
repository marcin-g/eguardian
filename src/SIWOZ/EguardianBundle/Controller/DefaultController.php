<?php

namespace SIWOZ\EguardianBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return new Response('<html><body>elo</body></html>');
    }
    public function helloAction($name)
    {
        return $this->render('EguardianBundle:Default:index.html.twig', array('name' => $name));
    }
}
