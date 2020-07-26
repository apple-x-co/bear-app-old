<?php

declare(strict_types=1);

namespace AppCore\Application\User\Assembler;

use AppCore\Application\User\Dto\UserData;
use AppCore\Domain\Model\User\User;

final class UserAssembler
{
    /**
     * @param User $user
     *
     * @return UserData
     */
    public function toDto(User $user) : UserData
    {
        return new UserData($user);
    }
}
