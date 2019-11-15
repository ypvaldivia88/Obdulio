<?php

namespace Jc\ObdulioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller{
    public function loginAction()
    {
        if($this->getUser()!=NULL){return $this->redirectToRoute('inicio');}
        $authenticationUtils = $this->get('security.authentication_utils');
        
        $error = $authenticationUtils->getLastAuthenticationError();
        
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('JcObdulioBundle:Security:login.html.twig', array('last_username' => $lastUsername, 'error' => $error));
    }
    
    public function loginCheckAction(){

    }
}
