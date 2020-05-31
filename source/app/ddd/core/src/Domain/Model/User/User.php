<?php declare(strict_types=1);


namespace AppCore\Domain\Model\User;


use AppCore\Domain\Model\Email;
use AppCore\Domain\Model\ModelTrait;

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
     * @param UserId $id
     * @param UserName $userName
     * @param Email $email
     */
    public function __construct(?UserId $id, UserName $userName, Email $email)
    {
        $this->id       = $id;
        $this->userName = $userName;
        $this->email    = $email;
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

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }
}