<?php

declare(strict_types=1);

namespace AppCore\Application\User;

use AppCore\Domain\User\UserId;

interface UserQueryServiceInterface
{
    /**
     * @param UserId $userId
     *
     * @return UserXxxDto
     */
    public function fetchByUserId(UserId $userId): UserXxxDto;
}
