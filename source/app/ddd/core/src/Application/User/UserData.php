<?php declare(strict_types=1);


namespace AppCore\Application\User;


use AppCore\Domain\Model\User\UserId;
use AppCore\Domain\Model\User\UserName;

final class UserData
{
    /** @var UserId */
    private $id;

    /** @var UserName */
    private $userName;

    /**
     * UserData constructor.
     *
     * @param UserId $id
     * @param UserName $userName
     */
    public function __construct(UserId $id, UserName $userName)
    {
        $this->id       = $id;
        $this->userName = $userName;
    }

    /**
     * @return UserId
     */
    public function getId(): UserId
    {
        return $this->id;
    }

    /**
     * @return UserName
     */
    public function getUserName(): UserName
    {
        return $this->userName;
    }
}