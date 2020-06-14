<?php
declare(strict_types=1);

namespace AppCore\Infrastructure\Persistence\Query;

use AppCore\Domain\Model\Email;
use AppCore\Domain\Model\User\User;
use AppCore\Domain\Model\User\UserId;
use AppCore\Domain\Model\User\UserName;
use AppCore\Domain\Model\User\UserQueryInterface;
use Ray\Di\Di\Named;
use Ray\Query\RowInterface;
use Ray\Query\RowListInterface;

final class UserQuery implements UserQueryInterface
{
    /** @var callable */
    private $createUser;

    /** @var RowListInterface */
    private $getUsers;

    /** @var RowInterface */
    private $getUser;

    /** @var callable */
    private $deleteUser;

    /**
     * UserQuery constructor.
     *
     * @param callable $createUser
     * @param RowListInterface $getUsers
     * @param RowInterface $getUser
     * @param callable $deleteUser
     *
     * @Named("createUser=user_insert, getUsers=users_list, getUser=user_by_id, deleteUser=user_delete")
     */
    public function __construct(
        callable $createUser,
        RowListInterface $getUsers,
        RowInterface $getUser,
        callable $deleteUser
    ) {
        $this->createUser = $createUser;
        $this->getUsers   = $getUsers;
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
    public function store(User $user): void
    {
        ($this->createUser)([
            'username' => $user->getUserName()->val(),
            'email'    => $user->getEmail()->val()
        ]);
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