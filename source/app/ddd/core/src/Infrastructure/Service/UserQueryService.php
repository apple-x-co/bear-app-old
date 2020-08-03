<?php

declare(strict_types=1);

namespace AppCore\Infrastructure\Service;

use AppCore\Domain\User\UserId;
use AppCore\Application\User\UserQueryServiceInterface;
use AppCore\Application\User\UserXxxDto;

class UserQueryService implements UserQueryServiceInterface
{
    /**
     * @inheritDoc
     */
    public function fetchByUserId(UserId $userId): UserXxxDto
    {
        return new UserXxxDto();
    }
}
