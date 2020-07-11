<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Module;

use BEAR\Package\AbstractAppModule;
use BEAR\Package\PackageModule;
use BEAR\Package\Provide\Router\AuraRouterModule;
use BEAR\Resource\Module\JsonSchemaModule;
use josegonzalez\Dotenv\Loader;
use Ray\AuraSqlModule\AuraSqlModule;
use Ray\AuraSqlModule\AuraSqlQueryModule;
use Ray\Query\SqlQueryModule;

use function assert;
use function dirname;
use function file_exists;
use function getenv;
use function is_string;

class AppModule extends AbstractAppModule
{
    protected function configure(): void
    {
        $env = dirname(__DIR__, 2) . '/.env';
        if (file_exists($env)) {
            (new Loader($env))->parse()->putenv(true);
        }

        $appDir = $this->appMeta->appDir;

        // DB
        $db_dns = getenv('APP_DB_DNS');
        $db_user = getenv('APP_DB_USER');
        $db_pass = getenv('APP_DB_PASS');
        $db_slave = getenv('APP_SLAVE_DB_HOSTS');
        assert(is_string($db_dns));
        assert(is_string($db_user));
        assert(is_string($db_pass));
        assert(is_string($db_slave));
        $this->install(
            new AuraSqlModule(
                $db_dns,
                $db_user,
                $db_pass,
                $db_slave
            )
        );
        $this->install(new AuraSqlQueryModule('mysql'));
        $this->install(new SqlQueryModule($appDir . '/var/sql'));

        // Json Schema
        $this->install(
            new JsonSchemaModule(
                $appDir . '/var/json_schema',
                $appDir . '/var/json_validate'
            )
        );

        // Router
        $this->install(new AuraRouterModule($appDir . '/var/conf/aura.route.php'));

        // DDD
        $this->install(new DddCoreModule());

        // BEAR.Package
        $this->install(new PackageModule());
    }
}
