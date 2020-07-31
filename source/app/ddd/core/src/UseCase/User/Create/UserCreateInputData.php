<?php

declare(strict_types=1);

namespace AppCore\UseCase\User\Create;

final class UserCreateInputData
{
    /** @var string */
    private $userName;

    /** @var string */
    private $email;

    /**
     * UserCreateInputData constructor.
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
