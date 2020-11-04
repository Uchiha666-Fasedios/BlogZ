<?php

namespace BackendBundle\Controller;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $user_repo = $em->getRepository("BackendBundle:User");
        $user = $user_repo->find(1);

        echo ' bienvenido '.$user->getName() .' '. $user->getSurname(). '<br>';
        var_dump($user);
die();
        return $this->render('BackendBundle:Default:index.html.twig');
    }
}
