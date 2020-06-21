<?php
declare(strict_types=1);
namespace AppCore\Infrastructure\Persistence\Query;

use AppCore\Domain\Model\Email;
use AppCore\Domain\Model\User\Exception\UserNotFoundException;
use AppCore\Domain\Model\User\User;
use AppCore\Domain\Model\User\UserId;
use AppCore\Domain\Model\User\UserName;
use AppCore\Domain\Model\User\UserQueryInterface;
use Aura\Sql\ExtendedPdoInterface;
use Generator;
use Ray\Di\Di\Named;
use Ray\Query\RowInterface;
use Ray\Query\RowListInterface;
use function sprintf;

final class UserQuery implements UserQueryInterface
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
     * UserQuery constructor.
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
                'email' => $user->getEmail()->val()
            ]);

            $id = $this->pdo->lastInsertId('id');

            return new User(
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
            'email' => $user->getEmail()->val()
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
        $user = new User(
            new UserId((int) $array['id']),
            new UserName($array['username']),
            new Email($array['email'])
        );
        $user->isNew(false);

        return $user;
    }
}
