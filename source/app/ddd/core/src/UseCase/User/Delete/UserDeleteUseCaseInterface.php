<?php

declare(strict_types=1);

namespace AppCore\UseCase\User\Delete;

interface UserDeleteUseCaseInterface
{
    /**
     * @param UserDeleteRequest $request
     */
    public function handle(UserDeleteRequest $request): void;
}
