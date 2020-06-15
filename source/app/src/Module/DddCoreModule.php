<?php
declare(strict_types=1);
namespace MyVendor\MyProject\Module;

use AppCore\Application\User\UserApplicationService;
use AppCore\Domain\Model\User\UserQueryInterface;
use AppCore\Domain\Service\UserService;
use AppCore\Infrastructure\Persistence\Query\UserQuery;
use AppCore\Infrastructure\Persistence\Query\UsersCounter;
use AppCore\Infrastructure\Persistence\Query\UsersFinder;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;

final class DddCoreModule extends AbstractModule
{
    protected function configure()
    {
        // Application
        $this->bind(UserApplicationService::class)->in(Scope::SINGLETON);

        // Domain
        $this->bind(UserService::class)->in(Scope::SINGLETON);

        // Infrastructure
        $this->bind(UserQueryInterface::class)->to(UserQuery::class)->in(Scope::SINGLETON);
        $this->bind('')->annotatedWith('find_users')->to(UsersFinder::class);
        $this->bind('')->annotatedWith('count_users')->to(UsersCounter::class);
    }
}
