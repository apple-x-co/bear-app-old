<?php
declare(strict_types=1);
namespace AppCore\Infrastructure\Service;

use AppCore\Domain\Model\User\User;
use AppCore\Domain\Service\UserServiceInterface;
use Ray\Di\Di\Named;
use Ray\Query\RowInterface;

final class UserService implements UserServiceInterface
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
