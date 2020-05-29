<?php declare(strict_types=1);


namespace MyVendor\MyProject\Module;


use AppCore\Application\User\UserService as ApplicationUserService;
use AppCore\Domain\Model\User\UserRepositoryInterface;
use AppCore\Domain\Service\UserService as DomainUserService;
use AppCore\Infrastructure\Persistence\InMemory\User\UserRepository;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;

final class DddCoreModule extends AbstractModule
{
    protected function configure()
    {
        // Application
        $this->bind(ApplicationUserService::class)->in(Scope::SINGLETON);

        // Domain
        $this->bind(DomainUserService::class)->in(Scope::SINGLETON);

        // Infrastructure
        $this->bind(UserRepositoryInterface::class)->to(UserRepository::class)->in(Scope::SINGLETON);
    }
}