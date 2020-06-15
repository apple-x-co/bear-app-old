<?php
declare(strict_types=1);
namespace AppCore\Domain\Service;

use AppCore\Domain\Model\User\User;
use Ray\Query\Annotation\Query;

// 可能な限りドメインサービスのは避ける
// エンティティや値ブジェクトに定義できるものであれば、そこに定義する

// ドメインオブジェクトは、値オブジェクトやエンティティと同じ括りである。
// ただし、ドメインに基づいているものであり、それを実現するサービスであれば、ドメインサービスである。

final class UserService
{
    /**
     * @param User $user
     *
     * @return bool
     */
    public function exists(User $user) : bool
    {
        $users = $this->getUserByEmail($user->getEmail()->val());

        return ! empty($users);
    }

    /**
     * @param string $email
     *
     * @return array<array{id: int, username: string, email: string, created_at: string, updated_at: string}>
     *
     * @Query(id="user_by_email", type="row")
     */
    private function getUserByEmail(string $email) : array
    {
        unset($email);
    }
}
