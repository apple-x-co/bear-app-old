<?php

declare(strict_types=1);

namespace AppCore\Domain\User;

use Generator;

interface UserRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return User
     */
    public function get(int $id) : User;

    /**
     * @return User[]
     */
    public function all() : array;

    /**
     * @param array<string, string|int|array> $conditions
     *
     * @return int
     *
     * @deprecated QueryModuleを利用してアクセスパターン毎にメソッドを用意する
     */
    public function count(array $conditions = []) : int;

    /**
     * @param array<string, string|int|array>                                             $conditions
     * @param array{order?: \AppCore\Infrastructure\OrderBy[], limit?: int, offset?: int} $options
     *
     * @return Generator
     *
     * @deprecated QueryModuleを利用してアクセスパターン毎にメソッドを用意する
     */
    public function find(array $conditions = [], array $options = []) : Generator;

    /**
     * @param User $user
     *
     * @return User
     */
    public function store(User $user) : User;

    /**
     * @param int $id
     */
    public function delete(int $id) : void;
}
