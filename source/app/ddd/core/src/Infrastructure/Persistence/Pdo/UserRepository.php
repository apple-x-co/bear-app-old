<?php
declare(strict_types=1);

namespace AppCore\Infrastructure\Persistence\Pdo;

use AppCore\Domain\Model\User\User;
use AppCore\Domain\Model\User\UserRepositoryInterface;

final class UserRepository implements UserRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function get(int $id): User
    {
        // TODO: Implement get() method.
    }

    /**
     * @inheritDoc
     */
    public function count(array $conditions): int
    {
        // TODO: Implement count() method.
    }

    /**
     * @inheritDoc
     */
    public function find(array $conditions, array $options = []): array
    {
        // TODO: Implement find() method.
    }

    /**
     * @inheritDoc
     */
    public function one(array $conditions, array $options = []): ?User
    {
        // TODO: Implement one() method.
    }

    /**
     * @inheritDoc
     */
    public function getAll(array $options = []): array
    {
        // TODO: Implement getAll() method.
    }

    /**
     * @inheritDoc
     */
    public function store(User $user): void
    {
        // TODO: Implement store() method.
    }

    /**
     * @inheritDoc
     */
    public function remove(User $user): void
    {
        // TODO: Implement remove() method.
    }

    /**
     * @inheritDoc
     */
    public function toRawData(User $user): array
    {
        // TODO: Implement toRawData() method.
    }

    /**
     * @inheritDoc
     */
    public function makeWhere(array $conditions): array
    {
        // TODO: Implement makeWhere() method.
    }
}