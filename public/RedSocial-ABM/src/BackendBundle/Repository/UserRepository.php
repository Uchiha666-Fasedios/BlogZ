<?php

namespace BackendBundle\Repository;

//use Symfony\Component\HttpKernel\Bundle\Bundle;

class UserRepository extends \Doctrine\ORM\EntityRepository //ES PROPIO DE SYMFONY esto extiende el propio repositorio q ya tiene la clase user
{

public function getFollowingUsers($user){

    $em = $this->getEntityManager();// dentro de un repositorio el entyty manager se saca asi
    $following_repo = $em->getRepository("BackendBundle:Following");//getRepository me trae todos los metodos de consulta q tiene el modelo por defecto mas los q yo alla añadido si le configuro un repositorio
        $following=$following_repo->findBy(array('user' => $user));//agarro los q estoy siguiendo porqe estoy buscando en following(siguiendo) los q tengan el id user del logeado 

        $following_array=array();
        foreach ($following as $follow) {
            $following_array[]=$follow->getFollowed();//los metemos en el vector getFollowed el id del q estoy siguiendo
        }
        $user_repo = $em->getRepository("BackendBundle:User");//getRepository me trae todos los metodos de consulta q tiene el modelo por defecto mas los q yo alla añadido si le configuro un repositorio
    $users=$user_repo->createQueryBuilder('u')//el alias u e los usuarios
    ->where("u.id != :user AND u.id IN (:following)")//:user :followin lo especifico en los setParameter..->where y cuando el id sea diferente a el id del logeado y cuando el id coincida con  following(es un array)  q son los id de los q estoy siguiendo
    ->setParameter('user', $user->getId())
    ->setParameter('following', $following_array)
    ->orderBy('u.id', 'DESC');

    return $users;
}

}