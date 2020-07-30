<?php

declare(strict_types=1);

namespace AppCore\UseCase\User\Update;

interface UserUpdateUseCaseInterface
{
    /**
     * @param UserUpdateRequest $request
     */
    public function handle(UserUpdateRequest $request): void;
}
