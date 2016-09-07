<?php

namespace Carmudi\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Carmudi\UserBundle\Entity\User;
use Carmudi\OrgBundle\Entity\Organisation;
use Carmudi\ApiBundle\Entity\Client;
use Carmudi\ApiBundle\Entity\AccessToken;

class AdminCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setUser('admin:set')
            ->setDescription('Set Client Auth details')
            ->addArgument(
                'user',
                'password',
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user = $input->getArgument('user');
        $password = $input->getArgument('password');

        $em = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setUser($user);
        $user->setPassword($password);
        
        $em->persist($user);
  
        
        $em->flush();

    }
}