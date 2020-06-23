<?php
declare(strict_types=1);
namespace MyVendor\MyProject\Module;

use AppCore\Domain\Model\User\UserQueryInterface;
use AppCore\Domain\Service\UserServiceInterface;
use AppCore\Infrastructure\Persistence\Query\FakeUserQuery;
use AppCore\Infrastructure\Service\FakeUserService;
use Ray\AuraSqlModule\AuraSqlModule;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;

final class TestModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        // DB
        $this->install(new AuraSqlModule('sqlite::memory:'));

        // Domain
        $this->bind(UserServiceInterface::class)->to(FakeUserService::class)->in(Scope::SINGLETON);

        // Infrastructure
        $this->bind(UserQueryInterface::class)->to(FakeUserQuery::class)->in(Scope::SINGLETON);
    }
}
