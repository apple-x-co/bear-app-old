<?php
declare(strict_types=1);
namespace MyVendor\MyProject\Module;

use josegonzalez\Dotenv\Loader;
use Ray\AuraSqlModule\AuraSqlModule;
use Ray\Di\AbstractModule;

final class TestModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $env = dirname(__DIR__, 2) . '/.env';
        if (file_exists($env)) {
            (new Loader($env))->parse()->putenv(true);
        }

        $this->install(
            new AuraSqlModule(
                getenv('APP_DB_DNS'),
                getenv('APP_DB_USER'),
                getenv('APP_DB_PASS'),
                getenv('APP_SLAVE_DB_HOSTS')
            )
        );
    }
}
