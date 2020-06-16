<?php
declare(strict_types=1);
namespace AppCore\Domain\Service;

use AppCore\Domain\Model\User\User;
use Ray\Di\Di\Named;
use Ray\Query\Annotation\Query;
use Ray\Query\RowInterface;

// 可能な限りドメインサービスのは避ける
// エンティティや値ブジェクトに定義できるものであれば、そこに定義する

// ドメインオブジェクトは、値オブジェクトやエンティティと同じ括りである。
// ただし、ドメインに基づいているものであり、それを実現するサービスであれば、ドメインサービスである。

final class UserService
{
    /** @var RowInterface */
    private $getUser;

    /**
     * UserService constructor.
     *
     * @param RowInterface $getUser
     *
     * @Named("getUser=user_by_email")
     */
    public function __construct(RowInterface $getUser)
    {
        $this->getUser = $getUser;
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public function exists(User $user) : bool
    {
        $array = ($this->getUser)(['email' => $user->getEmail()->val()]);

        return ! empty($array);
    }
}
