<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Module;

use AppCore\Domain\Model\User\UserRepositoryInterface;
use AppCore\Infrastructure\Persistence\RDB\UserRepository;
use AppCore\Infrastructure\Persistence\RDB\UsersCounter;
use AppCore\Infrastructure\Persistence\RDB\UsersFinder;
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
