<?php

declare(strict_types=1);

namespace AppCore\Infrastructure\Service;

use AppCore\Domain\Model\User\UserId;
use AppCore\UseCase\UserQueryServiceInterface;
use AppCore\UseCase\UserXxxDto;

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
