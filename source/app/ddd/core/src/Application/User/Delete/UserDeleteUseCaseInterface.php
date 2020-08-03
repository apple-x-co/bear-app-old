<?php

declare(strict_types=1);

namespace AppCore\Application\User\Delete;

interface UserDeleteUseCaseInterface
{
    /**
     * @param UserDeleteInputData $input
     */
    public function handle(UserDeleteInputData $input): void;
}
