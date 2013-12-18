<?php

namespace Poodle\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TestBundle:Admin:index.html.twig', array('name' => $name));
    }
}
