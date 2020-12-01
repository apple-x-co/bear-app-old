<?php

declare(strict_types=1);

namespace AppCore\Infrastructure\Persistence;

use AppCore\Domain\Shared\Email;
use AppCore\Domain\User\Exception\UserNotFoundException;
use AppCore\Domain\User\User;
use AppCore\Domain\User\UserId;
use AppCore\Domain\User\UserName;
use AppCore\Domain\User\UserRepositoryInterface;
use Aura\Sql\ExtendedPdoInterface;
use Generator;
use Ray\Di\Di\Named;
use Ray\Query\RowInterface;
use Ray\Query\RowListInterface;
use function sprintf;

final class UserRepository implements UserRepositoryInterface
{
    /** @var ExtendedPdoInterface */
    private $pdo;

    /** @var callable */
    private $createUser;

    /** @var callable */
    private $updateUser;

    /** @var RowListInterface */
    private $getUsers;

    /** @var callable */
    private $countUsers;

    /** @var callable */
    private $findUsers;

    /** @var RowInterface */
    private $getUser;

    /** @var callable */
    private $deleteUser;

    /**
     * UserRepository constructor.
     *
     * @param ExtendedPdoInterface $pdo
     * @param callable             $createUser
     * @param callable             $updateUser
     * @param RowListInterface     $getUsers
     * @param callable             $countUsers
     * @param callable             $findUsers
     * @param RowInterface         $getUser
     * @param callable             $deleteUser
     *
     * @Named("createUser=user_insert, updateUser=user_update, getUsers=users_list, countUsers=count_users, findUsers=find_users, getUser=user_by_id, deleteUser=user_delete")
     */
    public function __construct(
        ExtendedPdoInterface $pdo,
        callable $createUser,
        callable $updateUser,
        RowListInterface $getUsers,
        callable $countUsers,
        callable $findUsers,
        RowInterface $getUser,
        callable $deleteUser
    ) {
        $this->pdo = $pdo;
        $this->createUser = $createUser;
        $this->updateUser = $updateUser;
        $this->getUsers = $getUsers;
        $this->countUsers = $countUsers;
        $this->findUsers = $findUsers;
        $this->getUser = $getUser;
        $this->deleteUser = $deleteUser;
    }

    /**
     * {@inheritdoc}
     */
    public function get(int $id) : User
    {
        $array = ($this->getUser)(['id' => $id]);

        if (empty($array)) {
            throw new UserNotFoundException(sprintf('user(id:%d) not found.', $id));
        }

        return $this->arrayToModel($array);
    }

    /**
     * {@inheritdoc}
     */
    public function all() : array
    {
        $all = ($this->getUsers)([]);

        $users = [];

        foreach ($all as $array) {
            $users[] = $this->arrayToModel($array);
        }

        return $users;
    }

    /**
     * {@inheritdoc}
     */
    public function count(array $conditions = []) : int
    {
        return ($this->countUsers)($conditions);
    }

    /**
     * {@inheritdoc}
     */
    public function find(array $conditions = [], array $options = []) : Generator
    {
        $generator = ($this->findUsers)($conditions, $options);

        foreach ($generator as $array) {
            yield $this->arrayToModel($array);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function store(User $user) : User
    {
        if ($user->isNew()) {
            ($this->createUser)([
                'username' => $user->getUserName()->val(),
                'email' => $user->getEmail()->val(),
                'created_at' => (new \DateTimeImmutable())->format('Y-m-d H:i:s'),
                'updated_at' => (new \DateTimeImmutable())->format('Y-m-d H:i:s')
            ]);

            $id = $this->pdo->lastInsertId('id');

            return User::reconstruct(
                new UserId((int) $id),
                $user->getUserName(),
                $user->getEmail()
            );
        }

        if (! $user->isDirty()) {
            return $user;
        }

        ($this->updateUser)([
            'id' => $user->getId()->val(),
            'username' => $user->getUserName()->val(),
            'email' => $user->getEmail()->val(),
            'updated_at' => (new \DateTimeImmutable())->format('Y-m-d H:i:s')
        ]);

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(int $id) : void
    {
        ($this->deleteUser)([
            'id' => $id
        ]);
    }

    /**
     * @param array|iterable $array
     *
     * @return User
     */
    private function arrayToModel(array $array) : User
    {
        return User::reconstruct(
            new UserId((int) $array['id']),
            new UserName($array['username']),
            new Email($array['email'])
        );
    }
}
