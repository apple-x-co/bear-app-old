<?php

declare(strict_types=1);

namespace AppCore\Domain\User;

use Ray\Di\Di\Named;
use Ray\Query\RowInterface;

final class UserDomainService
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
