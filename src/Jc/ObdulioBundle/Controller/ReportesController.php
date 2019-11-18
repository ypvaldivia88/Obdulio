<?php

namespace Jc\ObdulioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\Query\ResultSetMapping;

class ReportesController extends Controller
{
    public function operativoAction(){
        if($this->getUser()==NULL){return $this->redirectToRoute('rh_usuarios_login');}
        $em = $this->getDoctrine()->getManager();   
        
        $rsm = new ResultSetMapping();

        $query = $em->createNativeQuery('SELECT username FROM usuarios', $rsm);
        $users = $query->getResult();
        
        //listado de unidades
        $articulos = $em->getRepository('JcObdulioBundle:Unidad')->findAll();
        //listado de tipos de productos
        $tipos = $em->getRepository('JcObdulioBundle:Tipoproducto')->findAll();
        //listado de productos
        $productos = $em->getRepository('JcObdulioBundle:Producto')->findAll();
        //plan mensual de cada unidad para cada producto
        
        return $this->render('JcObdulioBundle:Reportes:operativo.html.twig', array('usuarios' => $users));
    }
}
