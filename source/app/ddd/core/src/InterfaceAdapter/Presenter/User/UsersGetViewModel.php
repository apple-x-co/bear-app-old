<?php

declare(strict_types=1);

namespace AppCore\InterfaceAdapter\Presenter\User;

use AppCore\Application\User\Get\UserListOutputData;
use JsonSerializable;

class UsersGetViewModel implements JsonSerializable
{
    /** @var int */
    private $id;

    /** @var string */
    private $user_name;

    /** @var string */
    private $email;

    /**
     * UsersGetViewModel constructor.
     *
     * @param UserListOutputData $output
     */
    public function __construct(UserListOutputData $output)
    {
        $this->id = $output->getId();
        $this->user_name = $output->getUserName();
        $this->email = $output->getEmail();
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'username' => $this->user_name,
            'email' => $this->email
        ];
    }
}
