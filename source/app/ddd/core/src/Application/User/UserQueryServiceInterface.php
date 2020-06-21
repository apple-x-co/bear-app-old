<?php
declare(strict_types=1);
namespace AppCore\Application\User;

use Generator;

// 参照毎にメソッド・オブジェクトに分ける

interface UserQueryServiceInterface
{
    /**
     * @return Generator
     */
    public function list() : Generator;
}
