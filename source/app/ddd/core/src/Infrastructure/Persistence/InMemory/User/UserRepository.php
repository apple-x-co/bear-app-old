<?php declare(strict_types=1);


namespace AppCore\Infrastructure\Persistence\InMemory\User;


use AppCore\Domain\Model\User\Exception\UserNotFoundException;
use AppCore\Domain\Model\User\User;
use AppCore\Domain\Model\User\UserRepositoryInterface;

final class UserRepository implements UserRepositoryInterface
{
    /** @var User[] */
    private $users = [];

    /**
     * @inheritDoc
     */
    public function get(int $id): User
    {
        $users = $this->find(['id' => $id], []);
        if (empty($users)) {
            throw new UserNotFoundException(sprintf('id : %d', $id));
        }

        return $users[0];
    }

    /**
     * @inheritDoc
     */
    public function find(array $conditions, array $options = []): array
    {
        return $this->users;
    }

    /**
     * @inheritDoc
     */
    public function one(array $conditions, array $options = []): ?User
    {
        $users = $this->find($conditions, []);
        if (empty($users)) {
            return null;
        }

        return $users[0];
    }

    /**
     * @inheritDoc
     */
    public function getAll(array $options = []): array
    {
        return $this->find([], $options);
    }

    /**
     * @inheritDoc
     */
    public function store(User $user): void
    {
        $this->users[] = $user;
    }

    /**
     * @inheritDoc
     */
    public function remove(User $user): void
    {
        // TODO: Implement remove() method.
    }
}