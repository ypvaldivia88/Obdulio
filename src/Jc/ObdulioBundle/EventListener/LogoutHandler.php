<?php
namespace Jc\ObdulioBundle\EventListener;

use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine; // for Symfony 2.1.0+

/**
 * Do post logout stuff
 */
class LogoutHandler implements LogoutHandlerInterface
{

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * Constructor
     * @param EntityManager $em
     */
    public function __construct(SecurityContext $securityContext, Doctrine $doctrine)
    {
        $this->securityContext = $securityContext;
        $this->em              = $doctrine->getEntityManager();
    }

    /**
     * Do post logout stuff
     */
    public function logout(Request $request, Response $response, TokenInterface $authToken)
    {
        if($authToken->getUser()==NULL)
            return $this->redirectToRoute('rh_usuarios_logout');

        $user = $authToken->getUser();
        $temp = new \DateTime();
        $usuario = $this->em->getRepository('JcObdulioBundle:Usuarios')->find($user->getId());
        $usuario->setUltimoDeslogueo($temp);
        $usuario->setActivo(false);
        $this->em->flush();

        return ;
    }
}