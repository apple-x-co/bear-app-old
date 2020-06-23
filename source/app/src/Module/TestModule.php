<?php
declare(strict_types=1);
namespace MyVendor\MyProject\Module;

use AppCore\Domain\Model\User\UserQueryInterface;
use AppCore\Infrastructure\Persistence\Query\FakeUserQuery;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;

final class TestModule extends AbstractModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->bind(UserQueryInterface::class)->to(FakeUserQuery::class)->in(Scope::SINGLETON);
    }
}
