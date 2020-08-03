<?php

declare(strict_types=1);

namespace AppCore\Domain\User;

use AppCore\Domain\Shared\Email;
use AppCore\Domain\ModelTrait;

final class User
{
    use ModelTrait;

    /** @var UserId */
    private $id;

    /** @var UserName */
    private $userName;

    /** @var Email */
    private $email;

    /**
     * User constructor.
     *
     * @param UserName $userName
     * @param Email    $email
     */
    public function __construct(UserName $userName, Email $email)
    {
        $this->userName = $userName;
        $this->email = $email;
    }

    /**
     * @param UserId   $id
     * @param UserName $userName
     * @param Email    $email
     *
     * @return User
     */
    public static function reconstruct(UserId $id, UserName $userName, Email $email): User
    {
        $user = new User($userName, $email);
        $user->id = $id;
        $user->isNew(false);

        return $user;
    }

    /**
     * @return UserId
     */
    public function getId() : UserId
    {
        return $this->id;
    }

    /**
     * @return UserName
     */
    public function getUserName() : UserName
    {
        return $this->userName;
    }

    /**
     * @return Email
     */
    public function getEmail() : Email
    {
        return $this->email;
    }

    /**
     * @param UserName $userName
     */
    public function changeUserName(UserName $userName) : void
    {
        $this->setDirtyProperty('userName');
        $this->userName = $userName;
    }

    /**
     * @param Email $email
     */
    public function changeEmail(Email $email) : void
    {
        $this->setDirtyProperty('email');
        $this->email = $email;
    }
}
