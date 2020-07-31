<?php

declare(strict_types=1);

namespace AppCore\UseCase;

use AppCore\Domain\Model\User\UserId;

interface UserQueryServiceInterface
{
    /**
     * @param UserId $userId
     *
     * @return UserXxxDto
     */
    public function fetchByUserId(UserId $userId): UserXxxDto;
}
