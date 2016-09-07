<?php

namespace Carmudi\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

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
        
        $str = $user.$password.$company;
        $key = md5($str(rand(), TRUE));
        
        $output->writeln($key);
    }
}