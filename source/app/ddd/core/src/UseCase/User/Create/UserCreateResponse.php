<?php

declare(strict_types=1);

namespace AppCore\UseCase\User\Create;

use AppCore\Domain\Model\User\User;

final class UserCreateResponse
{
    /** @var int */
    private $id;

    /**
     * UserData constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->id = $user->getId()->val();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
