<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
 
class FollowingExtension extends AbstractExtension {
   
    public $manager;

    public function __construct($manager){
        $this->manager = $manager;
    }
 
    public function getFilters() {
       
        return [
            
            new TwigFilter('following', [$this, 'followingFilter']),
        ];
    }
 
    public function followingFilter($user, $followed){
        $following_repo = $this->manager->getRepository('App:Following');
        $user_following = $following_repo->findOneBy(array(
            "user" => $user,
            "followed" => $followed
        ));
 
        if(!empty($user_following) && is_object($user_following)){
            $result = true;
        }else{
            $result = false;
        }
 
        return $result;
    }
 
}