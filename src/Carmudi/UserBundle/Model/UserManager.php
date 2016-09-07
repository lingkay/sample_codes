<?php

namespace Carmudi\UserBundle\Model;

use Doctrine\ORM\EntityManager;
use Carmudi\UserBundle\Entity\User;


class UserManager
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getUserData($userid)
    {
        $user_objects = $this->em->getRepository('CarmudiUserBundle:User')->find($userid);
        /*$name = $user_objects->getUserName();
        $email = $user_objects->getEmail();
        $conf = $user_objects->getConf();
        $user_arr = array ('name'=>$name, 'email'=>$email, 'conf'=>$conf);

        return $user_arr;*/
        $data = $user_objects->toData();
        return $data;
        
    }

}
