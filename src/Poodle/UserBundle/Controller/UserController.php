<?php

namespace Poodle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    
    /**
     * Logowanie do systemu.
     * 
     * @param type $name
     * @return type
     */
    public function loginAction()
    {
        return $this->render('UserBundle:User:login.html.twig');
    }
}
