<?php

declare(strict_types=1);

namespace AppCore\Domain\User;

interface UserDomainServiceInterface
{
    public function exists(User $user) : bool;
}
