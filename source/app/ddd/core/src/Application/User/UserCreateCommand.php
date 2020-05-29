<?php declare(strict_types=1);


namespace AppCore\Application\User;


use AppCore\Domain\Model\User\UserName;

final class UserCreateCommand
{
    /** @var UserName */
    private $userName;

    /**
     * UserCreateCommand constructor.
     *
     * @param UserName $userName
     */
    public function __construct(UserName $userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return UserName
     */
    public function getUserName(): UserName
    {
        return $this->userName;
    }
}