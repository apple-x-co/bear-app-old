<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Module;

use AppCore\Domain\User\UserDomainService;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;

final class DddDomainModule extends AbstractModule
{
    protected function configure()
    {
        $this->bind(UserDomainService::class)->in(Scope::SINGLETON);
    }
}
