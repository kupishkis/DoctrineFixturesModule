# KupDoctrineFixtures module (fork of EwgoDoctrineFixtures module)

## About

The KupDoctrineFixtures module provides ZF2 integration with the [Doctrine Fixtures](https://github.com/doctrine/data-fixtures) library.
Difference from EwgoDoctrineFixtures is that this module actually supports fixtures loading from single file.

## Installation

``` bash
$ php composer.phar require kupishkis/doctrine-fixtures-module
```

Add "KupDoctrineFixtures" to the list of loaded modules.

## Configuration

Add the paths to the fixtures in your modules configuration
``` php
array(
    'doctrinefixtures' => array(
        'paths' => array(
            'MyModule' => __DIR__ . '/../src/MyModule/DataFixtures/ORM'
        )
    )
)
```

## Usage

Create your fixture classes.  
You can implement **Zend\ServiceManager\ServiceLocatorAwareInterface** in order to use the ServiceManager in your fixture class.  
You can also directly extend **EwgoDoctrineFixtures\Fixture\ServiceLocatorAwareAbstractFixture** in order to get the benefits of both ServiceLocatorAwareInterface and AbstractFixture.

``` php
namespace MyModule\DataFixtures\ORM;

use KupDoctrineFixtures\Fixture\ServiceLocatorAwareAbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use MyModule\Entity\User;

class LoadUserData extends ServiceLocatorAwareAbstractFixture
{
    public function load(ObjectManager $manager)
    {
        // Encode the password any way you want
        $password = $this->serviceLocator->get('MySuperEncoder')->encode('myAwesomePassword');

        $user = new User();
        $user->setUsername('test');
        $user->setPassword($password);
        $user->setPassword('test@test.com');

        $manager->persist($user);
        $manager->flush();
    }
}
```

``` bash
$ vendor/bin/doctrine-module fixtures:load
```
See the help (--help) for options.

For more information see the [Doctrine Fixtures documentation](https://github.com/doctrine/data-fixtures).
