<?php declare(strict_types=1);


namespace AppCore\Application\User;


use AppCore\Domain\Model\Email;
use AppCore\Domain\Model\User\UserName;

final class UserCreateCommand
{
    /** @var UserName */
    private $userName;

    /** @var Email */
    private $email;

    /**
     * UserCreateCommand constructor.
     *
     * @param UserName $userName
     * @param Email $email
     */
    public function __construct(UserName $userName, Email $email)
    {
        $this->userName = $userName;
        $this->email    = $email;
    }

    /**
     * @return UserName
     */
    public function getUserName(): UserName
    {
        return $this->userName;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }
}