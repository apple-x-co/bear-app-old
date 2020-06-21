<?php
declare(strict_types=1);
namespace AppCore\Application\User;

use Generator;

interface UserQueryServiceInterface
{
    /**
     * @return Generator
     */
    public function list() : Generator;
}
