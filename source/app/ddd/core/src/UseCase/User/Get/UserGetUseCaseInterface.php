<?php

declare(strict_types=1);

namespace AppCore\UseCase\User\Get;

use AppCore\UseCase\User\Get\UserGetRequest;

interface UserGetUseCaseInterface
{
    /**
     * @param UserGetRequest $request
     *
     * @return UserGetResponse
     */
    public function handle(UserGetRequest $request): UserGetResponse;
}
