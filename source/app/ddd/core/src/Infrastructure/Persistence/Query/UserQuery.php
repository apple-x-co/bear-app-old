<?php
declare(strict_types=1);

namespace AppCore\Infrastructure\Persistence\Query;

use AppCore\Domain\Model\Email;
use AppCore\Domain\Model\User\User;
use AppCore\Domain\Model\User\UserId;
use AppCore\Domain\Model\User\UserName;
use AppCore\Domain\Model\User\UserQueryInterface;
use Aura\Sql\ExtendedPdoInterface;
use Generator;
use Ray\Di\Di\Named;
use Ray\Query\RowInterface;
use Ray\Query\RowListInterface;

final class UserQuery implements UserQueryInterface
{
    /** @var ExtendedPdoInterface */
    private $pdo;

    /** @var callable */
    private $createUser;

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
     * UserQuery constructor.
     *
     * @param ExtendedPdoInterface $pdo
     * @param callable $createUser
     * @param RowListInterface $getUsers
     * @param callable $countUsers
     * @param callable $findUsers
     * @param RowInterface $getUser
     * @param callable $deleteUser
     *
     * @Named("createUser=user_insert, getUsers=users_list, countUsers=count_users, findUsers=find_users, getUser=user_by_id, deleteUser=user_delete")
     */
    public function __construct(
        ExtendedPdoInterface $pdo,
        callable $createUser,
        RowListInterface $getUsers,
        callable $countUsers,
        callable $findUsers,
        RowInterface $getUser,
        callable $deleteUser
    ) {
        $this->pdo        = $pdo;
        $this->createUser = $createUser;
        $this->getUsers   = $getUsers;
        $this->countUsers = $countUsers;
        $this->findUsers  = $findUsers;
        $this->getUser    = $getUser;
        $this->deleteUser = $deleteUser;
    }

    /**
     * @inheritDoc
     */
    public function get(int $id): User
    {
        $array = ($this->getUser)(['id' => $id]);

        return new User(
            new UserId((int)$array['id']),
            new UserName($array['username']),
            new Email($array['email'])
        );
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        $all = ($this->getUsers)([]);

        $users = [];

        foreach ($all as $array) {
            $users[] = new User(
                new UserId((int)$array['id']),
                new UserName($array['username']),
                new Email($array['email'])
            );
        }

        return $users;
    }


    /**
     * @inheritDoc
     */
    public function count(array $conditions = []): int
    {
        return ($this->countUsers)($conditions);
    }

    /**
     * @inheritDoc
     */
    public function find(array $conditions = [], array $options = []): Generator
    {
        $generator = ($this->findUsers)($conditions, $options);

        foreach ($generator as $array) {
            yield new User(
                new UserId((int)$array['id']),
                new UserName($array['username']),
                new Email($array['email'])
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function store(User $user): User
    {
        ($this->createUser)([
            'username' => $user->getUserName()->val(),
            'email'    => $user->getEmail()->val()
        ]);

        $id = $this->pdo->lastInsertId('id');

        return new User(
            new UserId((int)$id),
            $user->getUserName(),
            $user->getEmail()
        );
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id): void
    {
        ($this->deleteUser)([
            'id' => $id
        ]);
    }
}