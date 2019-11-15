<?php

namespace Jc\ObdulioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ReportesController extends Controller
{
    public function operativoAction(){
        if($this->getUser()==NULL){return $this->redirectToRoute('rh_usuarios_login');}
        $em = $this->getDoctrine()->getManager();          
        
        return $this->render('JcObdulioBundle:Reportes:operativo.html.twig');
    }
}
