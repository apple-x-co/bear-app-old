<?php

declare(strict_types=1);

namespace AppCore\UseCase\User\Create;

interface UserCreateUseCaseInterface
{
    /**
     * @param UserCreateRequest $request
     *
     * @return UserCreateResponse
     */
    public function handle(UserCreateRequest $request): UserCreateResponse;
}
