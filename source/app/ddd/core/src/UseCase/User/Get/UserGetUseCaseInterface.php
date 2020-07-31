<?php

declare(strict_types=1);

namespace AppCore\UseCase\User\Get;

use AppCore\UseCase\User\Get\UserGetInputData;

interface UserGetUseCaseInterface
{
    /**
     * @param UserGetInputData $input
     *
     * @return UserGetOutputData
     */
    public function handle(UserGetInputData $input): UserGetOutputData;
}
