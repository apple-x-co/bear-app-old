<?php
declare(strict_types=1);
namespace MyVendor\MyProject\Module;

use Ray\AuraSqlModule\AuraSqlModule;
use Ray\Di\AbstractModule;

final class TestModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        // DB
        $db_dns = sprintf('sqlite:%s/var/db/unit_test.sqlite3', dirname(__DIR__, 2));
        $this->install(new AuraSqlModule($db_dns));
    }
}
