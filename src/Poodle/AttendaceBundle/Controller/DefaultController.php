<?php

namespace Poodle\AttendaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PoodleAttendaceBundle:Default:index.html.twig', array('name' => $name));
    }
}
