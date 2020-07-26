<?php

declare(strict_types=1);

namespace AppCore\Application\User\Command;

final class UserUpdateCommand
{
    /** @var int */
    private $id;

    /** @var string|null */
    private $userName;

    /** @var string|null */
    private $email;

    /**
     * UserUpdateCommand constructor.
     *
     * @param int         $id
     * @param string|null $userName
     * @param string|null $email
     */
    public function __construct(int $id, ?string $userName, ?string $email)
    {
        $this->id = $id;
        $this->userName = $userName;
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getUserName() : ?string
    {
        return $this->userName;
    }

    /**
     * @return string|null
     */
    public function getEmail() : ?string
    {
        return $this->email;
    }
}
