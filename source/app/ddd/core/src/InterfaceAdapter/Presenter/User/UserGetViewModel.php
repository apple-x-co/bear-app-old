<?php

declare(strict_types=1);

namespace AppCore\InterfaceAdapter\Presenter\User;

use AppCore\UseCase\User\Get\UserGetOutputData;
use JsonSerializable;

class UserGetViewModel implements JsonSerializable
{
    /** @var int */
    private $id;

    /** @var string */
    private $user_name;

    /** @var string */
    private $email;

    /**
     * UserGetViewModel constructor.
     *
     * @param UserGetOutputData $output
     */
    public function __construct(UserGetOutputData $output)
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
