<?php
declare(strict_types=1);

namespace AppCore\Domain\Model\User;

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
     * @param User $user
     */
    public function store(User $user) : void;

    /**
     * @param int $id
     */
    public function delete(int $id) : void;
}