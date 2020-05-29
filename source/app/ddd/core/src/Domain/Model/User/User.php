<?php declare(strict_types=1);


namespace AppCore\Domain\Model\User;


use AppCore\Domain\Model\ModelTrait;

final class User
{
    use ModelTrait;

    /** @var UserId */
    private $id;

    /** @var UserName */
    private $userName;

    /**
     * User constructor.
     *
     * @param UserId|null $id
     * @param UserName $userName
     */
    public function __construct(?UserId $id, UserName $userName)
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