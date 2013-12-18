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
    
    
    /**
     * Rejestracja do systemu
     * 
     * @return type
     */
    public function registerAction() {
        return $this->render('UserBundle:User:register.html.twig');
    }
    
    /**
     * Przypomnienie hasła
     * 
     */
    public function recoverAction() {
        return $this->render('UserBundle:User:recover.html.twig');
    }
}
