<?php
declare(strict_types=1);
namespace MyVendor\MyProject\Module;

use AppCore\Application\User\UserApplicationService;
use AppCore\Domain\Model\User\UserRepositoryInterface;
use AppCore\Domain\Service\UserService;
use AppCore\Infrastructure\Persistence\InMemory\User\UserRepository;
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
        $this->bind(UserRepositoryInterface::class)->to(UserRepository::class)->in(Scope::SINGLETON);
    }
}
