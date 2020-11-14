<?php

namespace App\Twig;
use Doctrine\Common\Persistence\ManagerRegistry;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;



class UserStatsExtension extends AbstractExtension {

    public $manager;

    public function __construct($manager){
        $this->manager = $manager;
    }


    public function getFilters() {
       
        return [
            
            new TwigFilter('user_stats', [$this, 'userStatsFilter']),
        ];
    }

   


    public function userStatsFilter($user){
$following_repo = $this->manager->getRepository('App:Following');
$publication_repo = $this->manager->getRepository('App:Publication');
$like_repo = $this->manager->getRepository('App:Like');


$user_following=$following_repo->findBy(array("user" => $user));
$user_followers=$following_repo->findBy(array("followed" => $user));
//findBy me saca todo las publicaciones cuya propiedad user q es un id sea el id $user q me llega
$user_publications=$publication_repo->findBy(array("user" => $user));
$user_likes = $like_repo->findBy(array("user" => $user));



$result = array(
    'following' => count($user_following),
    "followers" => count($user_followers),
    "publications" => count($user_publications),
    "likes" => count($user_likes)
);
    

return $result;

    }





}


