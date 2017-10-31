<?php

namespace KupDoctrineFixtures\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

abstract class ServiceLocatorAwareAbstractFixture extends AbstractFixture implements ServiceLocatorAwareInterface
{
    protected $serviceLocator;

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function getServiceLocator(): ServiceLocatorInterface
    {
        return $this->serviceLocator;
    }
}
