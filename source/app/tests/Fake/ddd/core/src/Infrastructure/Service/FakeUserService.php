<?php
declare(strict_types=1);
namespace AppCore\Infrastructure\Service;

use AppCore\Domain\Model\User\User;
use AppCore\Domain\Service\UserServiceInterface;

final class FakeUserService implements UserServiceInterface
{
    /**
     * @param User $user
     *
     * @return bool
     */
    public function exists(User $user) : bool
    {
        return false;
    }
}
