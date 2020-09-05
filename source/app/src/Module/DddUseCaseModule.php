<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Module;

use AppCore\Application\User\Create\UserCreateUseCase;
use AppCore\Application\User\Delete\UserDeleteUseCase;
use AppCore\Application\User\Get\UserGetUseCase;
use AppCore\Application\User\Get\UserListUseCase;
use AppCore\Application\User\Update\UserUpdateUseCase;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;

final class DddUseCaseModule extends AbstractModule
{
    protected function configure()
    {
        $this->bind(UserCreateUseCase::class)->to(UserCreateUseCase::class)->in(Scope::SINGLETON);
        $this->bind(UserDeleteUseCase::class)->to(UserDeleteUseCase::class)->in(Scope::SINGLETON);
        $this->bind(UserGetUseCase::class)->to(UserGetUseCase::class)->in(Scope::SINGLETON);
        $this->bind(UserListUseCase::class)->to(UserListUseCase::class)->in(Scope::SINGLETON);
        $this->bind(UserUpdateUseCase::class)->to(UserUpdateUseCase::class)->in(Scope::SINGLETON);
    }
}
