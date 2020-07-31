<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Module;

use AppCore\Domain\Application\User\UserCreateUseCase;
use AppCore\Domain\Application\User\UserDeleteUseCase;
use AppCore\Domain\Application\User\UserGetUseCase;
use AppCore\Domain\Application\User\UserListUseCase;
use AppCore\Domain\Application\User\UserUpdateUseCase;
use AppCore\Domain\Model\User\UserRepositoryInterface;
use AppCore\Domain\Service\UserDomainServiceInterface;
use AppCore\Infrastructure\Persistence\RDB\UserRepository;
use AppCore\Infrastructure\Persistence\RDB\UsersCounter;
use AppCore\Infrastructure\Persistence\RDB\UsersFinder;
use AppCore\Infrastructure\Service\UserDomainService;
use AppCore\UseCase\User\Create\UserCreateUseCaseInterface;
use AppCore\UseCase\User\Delete\UserDeleteUseCaseInterface;
use AppCore\UseCase\User\Get\UserGetUseCaseInterface;
use AppCore\UseCase\User\Get\UserListUseCaseInterface;
use AppCore\UseCase\User\Update\UserUpdateUseCaseInterface;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;

final class DddCoreModule extends AbstractModule
{
    protected function configure()
    {
        // Domain
        $this->bind(UserDomainServiceInterface::class)->to(UserDomainService::class)->in(Scope::SINGLETON);

        // Infrastructure
        $this->bind(UserRepositoryInterface::class)->to(UserRepository::class)->in(Scope::SINGLETON);
        $this->bind('')->annotatedWith('find_users')->to(UsersFinder::class);
        $this->bind('')->annotatedWith('count_users')->to(UsersCounter::class);

        // UseCase
        $this->bind(UserCreateUseCaseInterface::class)->to(UserCreateUseCase::class)->in(Scope::SINGLETON);
        $this->bind(UserDeleteUseCaseInterface::class)->to(UserDeleteUseCase::class)->in(Scope::SINGLETON);
        $this->bind(UserGetUseCaseInterface::class)->to(UserGetUseCase::class)->in(Scope::SINGLETON);
        $this->bind(UserListUseCaseInterface::class)->to(UserListUseCase::class)->in(Scope::SINGLETON);
        $this->bind(UserUpdateUseCaseInterface::class)->to(UserUpdateUseCase::class)->in(Scope::SINGLETON);
    }
}
