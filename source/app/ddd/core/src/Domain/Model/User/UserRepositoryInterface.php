<?php declare(strict_types=1);


namespace AppCore\Domain\Model\User;


interface UserRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return User
     */
    public function get(int $id): User;

    /**
     * @param array $conditions
     *
     * @return int
     */
    public function count(array $conditions): int;

    /**
     * @param array $conditions
     * @param array $options
     *
     * @return User[]
     */
    public function find(array $conditions, array $options = []): array;

    /**
     * @param array $conditions
     * @param array $options
     *
     * @return User|null
     */
    public function one(array $conditions, array $options = []): ?User;

    /**
     * @param array $options
     *
     * @return User[]
     */
    public function getAll(array $options = []): array;

    /**
     * @param User $user
     *
     * @return void
     */
    public function store(User $user): void;

    /**
     * @param User $user
     *
     * @return void
     */
    public function remove(User $user): void;

    /**
     * @param User $user
     *
     * @return array{
     *     user_name: string,
     *     email: string
     * }
     */
    public function toRawData(User $user): array;

    /**
     * @param array $conditions
     *
     * @return array
     */
    public function makeWhere(array $conditions): array;
}