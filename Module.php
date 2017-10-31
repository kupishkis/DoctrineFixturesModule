<?php

namespace KupDoctrineFixtures;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\ModuleManagerInterface;
use Zend\EventManager\EventInterface;
use KupDoctrineFixtures\Command\LoadFixturesCommand;

class Module implements AutoloaderProviderInterface, InitProviderInterface
{
    public function getAutoloaderConfig(): array
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/',
                ],
            ],
        ];
    }

    public function getConfig(): array
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function init(ModuleManagerInterface $moduleManager)
    {
        $moduleManager->getEventManager()->getSharedManager()->attach(
            'doctrine',
            'loadCli.post',
            function (EventInterface $e) {
                $command = new LoadFixturesCommand();
                $command->setServiceLocator($e->getParam('ServiceManager'));
                $e->getTarget()->add($command);
            });
    }
}
