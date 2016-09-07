<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            //Framework bundles
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new FOS\RestBundle\FOSRestBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new FOS\OAuthServerBundle\FOSOAuthServerBundle(),
            new Nelmio\ApiDocBundle\NelmioApiDocBundle(),
            new FOS\HttpCacheBundle\FOSHttpCacheBundle(),
            new Bazinga\Bundle\HateoasBundle\BazingaHateoasBundle(),
            new Hautelook\TemplatedUriBundle\HautelookTemplatedUriBundle(),
            new Bazinga\Bundle\RestExtraBundle\BazingaRestExtraBundle(),
            
            //Carmudi Bundles
            new Carmudi\AdminBundle\CarmudiAdminBundle(),
            new Carmudi\UserBundle\CarmudiUserBundle(),
            new Carmudi\ApiBundle\CarmudiApiBundle(),
            new Carmudi\FixtureBundle\CarmudiFixtureBundle(),
            new Carmudi\BaseBundle\CarmudiBaseBundle(),
            new Carmudi\CarBundle\CarmudiCarBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
           // $bundles[] = new AppBundle\AppBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }

}
