<?php
declare(strict_types=1);
namespace AppCore\Infrastructure\Persistence\Query;

use AppCore\Domain\Model\Email;
use AppCore\Domain\Model\User\User;
use AppCore\Domain\Model\User\UserId;
use AppCore\Domain\Model\User\UserName;
use AppCore\Domain\Model\User\UserQueryInterface;
use Generator;

final class FakeUserQuery implements UserQueryInterface
{
    /**
     * {@inheritdoc}
     */
    public function get(int $id) : User
    {
        return $this->arrayToModel([
            'id' => 1,
            'username' => 'bear',
            'email' => 'bear@example.com'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function all() : array
    {
        return [
            $this->arrayToModel([
                'id' => 1,
                'username' => 'bear',
                'email' => 'bear@example.com'
            ])
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function count(array $conditions = []) : int
    {
        return 1;
    }

    /**
     * {@inheritdoc}
     */
    public function find(array $conditions = [], array $options = []) : Generator
    {
        yield $this->arrayToModel([
            'id' => 1,
            'username' => 'bear',
            'email' => 'bear@example.com'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function store(User $user) : User
    {
        if ($user->isNew()) {
            return new User(
                new UserId(1),
                $user->getUserName(),
                $user->getEmail()
            );
        }

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(int $id) : void
    {
    }

    /**
     * @param array $array
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
