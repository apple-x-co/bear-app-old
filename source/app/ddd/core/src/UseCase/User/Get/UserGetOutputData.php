<?php

declare(strict_types=1);

namespace AppCore\UseCase\User\Get;

use AppCore\Domain\Model\User\User;

final class UserGetOutputData
{
    /** @var int */
    private $id;

    /** @var string */
    private $userName;

    /** @var string */
    private $email;

    /**
     * UserGetOutputData constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->id = $user->getId()->val();
        $this->userName = $user->getUserName()->val();
        $this->email = $user->getEmail()->val();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
