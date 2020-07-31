<?php

declare(strict_types=1);

namespace AppCore\UseCase\User\Update;

interface UserUpdateUseCaseInterface
{
    /**
     * @param UserUpdateInputData $input
     */
    public function handle(UserUpdateInputData $input): void;
}
