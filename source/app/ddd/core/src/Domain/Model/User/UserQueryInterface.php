<?php
declare(strict_types=1);

namespace AppCore\Domain\Model\User;

use Generator;

interface UserQueryInterface
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
     * @param array $conditions
     *
     * @return int
     */
    public function count(array $conditions = []) : int;

    /**
     * @param array $conditions
     * @param array $options
     *
     * @return Generator
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