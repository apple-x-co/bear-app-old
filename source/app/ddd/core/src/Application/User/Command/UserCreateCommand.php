<?php

declare(strict_types=1);

namespace AppCore\Application\User\Command;

final class UserCreateCommand
{
    /** @var string */
    private $userName;

    /** @var string */
    private $email;

    /**
     * UserCreateCommand constructor.
     *
     * @param string $userName
     * @param string $email
     */
    public function __construct(string $userName, string $email)
    {
        $this->userName = $userName;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getUserName() : string
    {
        return $this->userName;
    }

    /**
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }
}
