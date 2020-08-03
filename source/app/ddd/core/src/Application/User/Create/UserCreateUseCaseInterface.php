<?php

declare(strict_types=1);

namespace AppCore\Application\User\Create;

interface UserCreateUseCaseInterface
{
    /**
     * @param UserCreateInputData $input
     *
     * @return UserCreateOutputData
     */
    public function handle(UserCreateInputData $input): UserCreateOutputData;
}
