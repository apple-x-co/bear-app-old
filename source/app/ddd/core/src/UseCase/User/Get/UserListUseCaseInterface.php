<?php

declare(strict_types=1);

namespace AppCore\UseCase\User\Get;

use Generator;

interface UserListUseCaseInterface
{
    /**
     * @return Generator|UserListOutputData[]
     */
    public function handle(): Generator;
}
