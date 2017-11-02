<?php declare(strict_types=1);

namespace KupDoctrineFixtures\Loader;

use Doctrine\Common\DataFixtures\Loader as OrgLoader;

class Loader extends OrgLoader
{
    public function loadFromFile(string $fileName)
    {
        if (!is_readable($fileName)) {
            throw new \InvalidArgumentException(sprintf('"%s" does not exist or is not readable', $fileName));
        }

        $fixtures = [];

        require_once $fileName;

        $declared = get_declared_classes();
        foreach ($declared as $className) {
            if (!$this->isTransient($className)) {
                $fixture = new $className;
                $fixtures[] = $fixture;
                $this->addFixture($fixture);
            }
        }
    }
}
