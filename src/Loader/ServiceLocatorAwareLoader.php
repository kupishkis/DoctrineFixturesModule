<?php

namespace KupDoctrineFixtures\Loader;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;

class ServiceLocatorAwareLoader extends Loader
{
    private $serviceLocator;

    public function __construct(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function addFixture(FixtureInterface $fixture)
    {
        if ($fixture instanceof ServiceLocatorAwareInterface) {
            $fixture->setServiceLocator($this->serviceLocator);
        }

        parent::addFixture($fixture);
    }
}
