<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Module;

use AppCore\Application\User\Create\UserCreateUseCaseInterface;
use AppCore\Application\User\Delete\UserDeleteUseCaseInterface;
use AppCore\Application\User\Get\UserGetUseCaseInterface;
use AppCore\Application\User\Get\UserListUseCaseInterface;
use AppCore\Application\User\Update\UserUpdateUseCaseInterface;
use AppCore\Domain\User\UserCreateUseCase;
use AppCore\Domain\User\UserDeleteUseCase;
use AppCore\Domain\User\UserGetUseCase;
use AppCore\Domain\User\UserListUseCase;
use AppCore\Domain\User\UserUpdateUseCase;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;

final class DddUseCaseModule extends AbstractModule
{
    protected function configure()
    {
        $this->bind(UserCreateUseCaseInterface::class)->to(UserCreateUseCase::class)->in(Scope::SINGLETON);
        $this->bind(UserDeleteUseCaseInterface::class)->to(UserDeleteUseCase::class)->in(Scope::SINGLETON);
        $this->bind(UserGetUseCaseInterface::class)->to(UserGetUseCase::class)->in(Scope::SINGLETON);
        $this->bind(UserListUseCaseInterface::class)->to(UserListUseCase::class)->in(Scope::SINGLETON);
        $this->bind(UserUpdateUseCaseInterface::class)->to(UserUpdateUseCase::class)->in(Scope::SINGLETON);
    }
}
