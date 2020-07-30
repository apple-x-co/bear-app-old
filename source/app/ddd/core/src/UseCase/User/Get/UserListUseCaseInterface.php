<?php

declare(strict_types=1);

namespace AppCore\UseCase\User\Get;

use Generator;

interface UserListUseCaseInterface
{
    /**
     * @return Generator
     */
    public function handle(): Generator;
}
