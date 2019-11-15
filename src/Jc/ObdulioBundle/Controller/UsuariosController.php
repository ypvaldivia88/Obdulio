<?php

namespace Jc\ObdulioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormError;
use Jc\ObdulioBundle\Entity\Usuarios;
use Jc\ObdulioBundle\Form\UsuariosType;
use Jc\ObdulioBundle\Form\UsuariosProvincialesType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UsuariosController extends Controller
{
    public function homeAction() {
        $em = $this->getDoctrine()->getManager();   

       
        return $this->render('JcObdulioBundle:Usuarios:home.html.twig');
    }
    
    public function indexAction(){
        if($this->getUser()==NULL){return $this->redirectToRoute('rh_usuarios_login');}
        $em = $this->getDoctrine()->getManager();  
        
        
            $users = $em->getRepository('JcObdulioBundle:Usuarios')->TodoNacional();
        
        $deleteFormAjax = $this->createCustomForm(':USER_ID', 'DELETE', 'rh_usuarios_delete');
        
        return $this->render('JcObdulioBundle:Usuarios:index.html.twig', array(
            'users' => $users, 
            'delete_form_ajax' => $deleteFormAjax->createView()));
    }
    
    public function editAction($id){
        if($this->getUser()==NULL){return $this->redirectToRoute('rh_usuarios_login');}
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('JcObdulioBundle:Usuarios')->find($id);
        
        if(!$user)
        {
            $messageException = $this->get('translator')->trans('Usuario no encontrado.');
            throw $this->createNotFoundException($messageException);
        }

           $form = $this->createEditForm($user);
        
        return $this->render('JcObdulioBundle:Usuarios:edit.html.twig', array('user' => $user, 'form' => $form->createView()));
    }
    
    public function createFormComun(Usuarios $entity, $id){
        $rol = $entity->getRole();
        $role='';
        $valor='';
        if($rol == 'ROLE_ADMINISTRADOR_NACIONAL'){
            $role = 'ROLE_ADMINISTRADOR_NACIONAL';
            $valor='Administrador Nacional';
        }    
        elseif($rol == 'ROLE_ADMINISTRADOR_PROVINCIAL'){
            $role = 'ROLE_ADMINISTRADOR_PROVINCIAL';
            $valor='Administrador Provincial';
        }
        elseif($rol == 'ROLE_CAPITAL_HUMANO_NACIONAL'){
            $role = 'ROLE_CAPITAL_HUMANO_NACIONAL';
            $valor='Capital Humano Nacional';
        }
        elseif($rol == 'ROLE_CAPITAL_HUMANO_PROVINCIAL'){
            $role = 'ROLE_CAPITAL_HUMANO_PROVINCIAL';
            $valor='Capital Humano Provincial';
        }
        elseif($rol == 'ROLE_DIRECTOR_PROVINCIAL'){
            $role = 'ROLE_DIRECTOR_PROVINCIAL';
            $valor='Director Provincial';
        }
        elseif($rol == 'ROLE_DIRECTOR_MUNICIPAL'){
            $role = 'ROLE_DIRECTOR_MUNICIPAL';
            $valor='Director Municipal';
        }
        elseif($rol == 'ROLE_ECONOMICO_MUNICIPAL'){
            $role = 'ROLE_ECONOMICO_MUNICIPAL';
            $valor='Económico Municipal';
        }
        elseif($rol == 'ROLE_SEGURIDAD_SALUD'){
            $role = 'ROLE_SEGURIDAD_SALUD';
            $valor='Seguridad y Salud';
        }
        elseif($rol == 'ROLE_CAPACITACION'){
            $role = 'ROLE_CAPACITACION';
            $valor='Capacitación';
        }
        
        $form = $this->get('form.factory')->createNamedBuilder('usuario', 'form', $entity)//$this->createFormBuilder($entity)
            ->add('username')
            ->add('password', 'password')
            ->add('role', 'choice', array('choices'=>array($role=>$valor)))
            ->add('isActive', 'checkbox')
            ->add('save', 'submit', array('label' => ''))
            ->setAction($this->generateUrl('rh_usuarios_update', array('id' => $entity->getId())))
            ->setMethod('PUT') 
            ->getForm();
        
        return $form;
    }
    
    public function createFormProvincial(Usuarios $entity, $id){
        $form = $this->get('form.factory')->createNamedBuilder('usuario', 'form', $entity)//$this->createFormBuilder($entity)
            ->add('username')
            ->add('password', 'password')
            ->add('role', 'choice', array('choices'=>array(
                'ROLE_ADMINISTRADOR_PROVINCIAL'=>'Administrador Provincial', 
                'ROLE_CAPITAL_HUMANO_PROVINCIAL'=>'Capital Humano Provincial', 
                'ROLE_DIRECTOR_PROVINCIAL'=>'Director Provincial', 
                'ROLE_DIRECTOR_MUNICIPAL'=>'Director Municipal',
                'ROLE_ECONOMICO_MUNICIPAL'=>'Económico Municipal',
                'ROLE_SEGURIDAD_SALUD'=>'Seguridad y Salud',
                'ROLE_CAPACITACION'=>'Capacitación')))
            ->add('isActive', 'checkbox')
            ->add('save', 'submit', array('label' => ''))
            ->setAction($this->generateUrl('rh_usuarios_update', array('id' => $entity->getId())))
            ->setMethod('PUT') 
            ->getForm();
        
        return $form;
    }
    
    private function createEditForm(Usuarios $entity){
        $form = $this->createForm(new UsuariosType(), $entity, array('action' => $this->generateUrl('rh_usuarios_update', array('id' => $entity->getId())), 'method' => 'PUT'));        
        return $form;
    }
    
    public function updateAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();
        
        $user = $em->getRepository('JcObdulioBundle:Usuarios')->find($id);

        if(!$user)
        {
            $messageException = $this->get('translator')->trans('Usuario no encontrado.');
            throw $this->createNotFoundException($messageException);
        }
        
        $old_avatar = $user->getAvatar();
        $old_nombre = $user->getNombreCompleto();
        $user->setAvatar(
            new UploadedFile($this->getParameter('avatar_directory').'/'.$user->getAvatar(),$user->getAvatar())
        );         
        
        $temp=new UploadedFile($user->getAvatar(),$user->getAvatar());        
        $temp=$temp->getClientOriginalName(); 
        
        /*if($old_avatar!="avatar.jpg" && $old_cid!=$trabajador->getCid())
            unlink($this->getParameter('avatar_directory').'/'.$old_avatar);*/
        
        /*$userLogueado = $this->getUser();// lo obtien desde el extends 
        if($userLogueado->getRole() == 'ROLE_ADMINISTRADOR_NACIONAL')*/
           $form = $this->createEditForm($user);     
        /*elseif($userLogueado->getRole() == 'ROLE_ADMINISTRADOR_PROVINCIAL')
           $form = $this->createFormProvincial($user, $id); */
        /*else
           $form = $this->createFormComun($user, $id);*/
        
        //$form = $this->createEditForm($user);
        $form->handleRequest($request);
        
        if($form->get('avatar')->getData()=="")
            $user->setAvatar($temp);
        else{
            $file = $user->getAvatar();
            $fileName = $this->get('app.avatar_uploader')->upload($file, $user->getNombreCompleto());
            $user->setAvatar($fileName);           
        }
        
        if(($old_avatar!="avatar.jpg" && $old_nombre!=$user->getNombreCompleto()) || ($old_avatar!="avatar.jpg" && $form->get('avatar')->getData()!=""))
            unlink($this->getParameter('avatar_directory').'/'.$old_avatar);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $password = $form->get('password')->getData();
            
            //para imprimir en pantalla este valor en modo de prueba
            //print_r($password);
            //exit();
            
            if(!empty($password))
            {
                $encoder = $this->container->get('security.password_encoder');
                $encoded = $encoder->encodePassword($user, $password);
                $user->setPassword($encoded);
            }
            else
            {
                $recoverPass = $this->recoverPass($id);
                $user->setPassword($recoverPass[0]['password']);                
            }
            
            if($form->get('role')->getData() == 'ROLE_ADMINISTRADOR')
            {
                $user->setIsActive(1);
            }

            $em->flush();
            
            $successMessage = $this->get('translator')->trans('El usuario ha sido modificado.');
            $this->addFlash('mensaje', $successMessage);

           // return $this->redirectToRoute('rh_usuarios_edit', array('id' => $user->getId()));
            return $this->redirectToRoute('rh_usuarios_index');
        }

       return $this->render('JcObdulioBundle:Usuarios:edit.html.twig', array('user' => $user, 'form' => $form->createView()));
    }
    
    private function recoverPass($id){
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT u.password
            FROM JcObdulioBundle:Usuarios u
            WHERE u.id = :id'    
        )->setParameter('id', $id);
        
        $currentPass = $query->getResult();
        
        return $currentPass;
    }
    
    public function addAction(){
       $user = new Usuarios();
            $form = $this->createForm(new UsuariosType(), $user, array(
                  'action' => $this->generateUrl('rh_usuarios_create'),
                  'method' => 'POST'
              ))  ;
       return $this->render('JcObdulioBundle:Usuarios:add.html.twig',array('form' => $form->createView()));
    }
    
    private function createCreateForm(Usuarios $entity){
      $form = $this->createForm(new UsuariosType(), $entity, array(
          'action' => $this->generateUrl('rh_usuarios_create'),
          'method' => 'POST'
      ))  ;     
      
      return $form;
    }
    
    public function createAction(Request $request){
        if($this->getUser()==NULL){return $this->redirectToRoute('rh_usuarios_login');}
       $user = new Usuarios();
       $form = $this->createCreateForm($user);
       $form->handleRequest($request);
       
       if($form->isValid()){
           
           if($form->get('avatar')->getData()=="")
                $user->setAvatar('avatar.jpg');
           else{
                $file = $user->getAvatar();
                $fileName = $this->get('app.avatar_uploader')->upload($file, $user->getNombreCompleto());
                $user->setAvatar($fileName);
            }
           
           $password = $form->get('password')->getData();
           
            $passwordConstraint = new Assert\NotBlank();
            $errorList = $this->get('validator')->validate($password, $passwordConstraint);
            
            if(count($errorList) == 0)
            {           
               $encoder = $this->container->get('security.password_encoder');
               $encoded = $encoder->encodePassword($user, $password);
               $user->setPassword($encoded);           

               $em = $this->getDoctrine()->getManager();
               $em->persist($user);
               $em->flush();

               $successMessage = $this->get('translator')->trans('El usuario ha sido creado.');
               $this->addFlash('mensaje', $successMessage);

               return $this->redirectToRoute('rh_usuarios_index');
            }
            else
            {
                $errorMessage = new FormError($errorList[0]->getMessage());
                $form->get('password')->addError($errorMessage);
            }   
       }
       
      return $this->render('JcObdulioBundle:Usuarios:add.html.twig',array('form' => $form->createView()));
    }
    
    public function viewAction($id){
        if($this->getUser()==NULL){return $this->redirectToRoute('rh_usuarios_login');}
        $repository = $this->getDoctrine()->getRepository('JcObdulioBundle:Usuarios');
        
        $user = $repository->find($id);
        
        $em = $this->getDoctrine()->getManager();
        $user1=$em->getRepository('JcObdulioBundle:Usuarios')->findUsuarioById($id);

        if(!$user)
            throw $this->createNotFoundException('Usuario no encontrado.');
        

        $deleteForm = $this->createCustomForm($user->getId(), 'DELETE', 'rh_usuarios_delete');
        

        return $this->render('JcObdulioBundle:Usuarios:view.html.twig', array('user'
            => $user1[0], 'delete_form' => $deleteForm->createView()));
    }
    
    public function cambioAction($id){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('JcObdulioBundle:Usuarios')->find($id);
        
        if(!$user)
        {
            $messageException = $this->get('translator')->trans('Usuario no encontrado.');
            throw $this->createNotFoundException($messageException);
        }
        
        $form = $this->createFormCambio($user);     
        
        return $this->render('JcObdulioBundle:Usuarios:cambio.html.twig', array('user' => $user, 'form' => $form->createView()));
    }
    
    public function createFormCambio(Usuarios $entity){
        $form = $this->get('form.factory')->createNamedBuilder('usuario', 'form', $entity)//$this->createFormBuilder($entity)
            ->add('password', 'password')
            ->add('repetir', 'password', array(
               'mapped' => false,
               'attr' => array('class' => 'form-control'),
            ))
            ->add('save', 'submit', array('label' => ''))
            ->setAction($this->generateUrl('rh_usuarios_cambiar', array('id' => $entity->getId())))
            ->setMethod('PUT') 
            ->getForm();
        
        return $form;
    }
    
    public function cambiarAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();
        
        $user = $em->getRepository('JcObdulioBundle:Usuarios')->find($id);

        if(!$user)
        {
            $messageException = $this->get('translator')->trans('Usuario no encontrado.');
            throw $this->createNotFoundException($messageException);
        }
        
        $form = $this->createFormCambio($user);     
        
        //$form = $this->createEditForm($user);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $password = $form->get('password')->getData();
            
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $password);
            $user->setPassword($encoded);
            
            $em->flush();
            
            $successMessage = $this->get('translator')->trans('La contraseña ha sido cambiada.');
            $this->addFlash('mensaje', $successMessage);
            return $this->redirectToRoute('rh_usuarios_cambio', array('id' => $user->getId()));
        }
        return $this->redirectToRoute('rh_usuarios_cambio', array('id' => $user->getId()));
    }
    
    public function deleteAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        
        $user = $em->getRepository('JcObdulioBundle:Usuarios')->find($id);
        
        if(!$user)
        {
            $messageException = $this->get('translator')->trans('Usuario no encontrado.');
            throw $this->createNotFoundException($messageException);
        }
        
        $allUsers = $em->getRepository('JcObdulioBundle:Usuarios')->findAll();
        $countUsers = count($allUsers);
        
        //$form = $this->createDeleteForm($user);
        $form = $this->createCustomForm($user->getId(), 'DELETE', 'rh_usuarios_delete');
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            if($request->isXMLHttpRequest())
            {
                $res = $this->deleteUser($user->getRole(), $em, $user);
                
                return new Response(
                    json_encode(array('removed' => $res['removed'], 'message' => $res['message'], 'countUsers' => $countUsers)),
                    200,
                    array('Content-Type' => 'application/json')
                );
            }
            
            $res = $this->deleteUser($user->getRole(), $em, $user);

            $this->addFlash($res['alert'], $res['message']);
            return $this->redirectToRoute('rh_usuarios_index'); 
        }
    }
    
    private function deleteUser($role, $em, $user){
            if($user->getAvatar()!='avatar.jpg')
                unlink($this->getParameter('avatar_directory').'/'.$user->getAvatar());
            
            $em->remove($user);
            $em->flush();
            
            $message = ('El usuario ha sido eliminado.');
            $removed = 1;
            $alert = 'mensaje';
        
        
        return array('removed' => $removed, 'message' => $message, 'alert' => $alert);
    }
    
    private function createCustomForm($id, $method, $route){
        return $this->createFormBuilder()
            ->setAction($this->generateUrl($route, array('id' => $id)))
            ->setMethod($method)
            ->getForm();
    }
}
