<?php

declare(strict_types=1);

namespace AppCore\Application\User\Get;

use AppCore\Application\User\Get\UserGetInputData;

interface UserGetUseCaseInterface
{
    /**
     * @param UserGetInputData $input
     *
     * @return UserGetOutputData
     */
    public function handle(UserGetInputData $input): UserGetOutputData;
}
