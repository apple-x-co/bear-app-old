<?php

declare(strict_types=1);

namespace MyVendor\MyProject\Module;

use Ray\Di\AbstractModule;

final class DddCoreModule extends AbstractModule
{
    protected function configure()
    {
        $this->install(new DddDomainModule());
        $this->install(new DddInfrastructureModule());
        $this->install(new DddUseCaseModule());
    }
}
