<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Module;

use AppCore\Domain\User\UserRepositoryInterface;
use AppCore\Infrastructure\Persistence\UserRepository;
use AppCore\Infrastructure\Persistence\UsersCounter;
use AppCore\Infrastructure\Persistence\UsersFinder;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;

final class DddInfrastructureModule extends AbstractModule
{
    protected function configure()
    {
        $this->bind(UserRepositoryInterface::class)->to(UserRepository::class)->in(Scope::SINGLETON);
        $this->bind('')->annotatedWith('find_users')->to(UsersFinder::class);
        $this->bind('')->annotatedWith('count_users')->to(UsersCounter::class);
    }
}
